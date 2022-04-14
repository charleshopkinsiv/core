<?php

namespace CharlesHopkinsIV\Core\Util;

use \CharlesHopkinsIV\Core\Registry;


class Db
{

    private string $dbhost, $dbuser, $dbpass, $dbname;

    private static $instance;

    private function __construct(){

        $db_info = Registry::instance()->getConfig('DB');

        $this->dbhost = $db_info['dbhost'];
        $this->dbuser = $db_info['dbuser'];
        $this->dbpass = $db_info['dbpass'];
        $this->dbname = $db_info['dbname'];


        $dsn = 'mysql:host=' . $this->dbhost . ';dbname=' . $this->dbname;
        $options = [
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ];

        $this->dbh = new \PDO($dsn, $this->dbuser, $this->dbpass, $options);
    }


    public function query($sql){

        $this->stmt = $this->dbh->prepare($sql, [\PDO::ATTR_CURSOR => \PDO::CURSOR_SCROLL]);
        return $this;
    }


    public function bind($param, $value, $type = null){

        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = \PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = \PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = \PDO::PARAM_NULL;
                    break;
                default:
                    $type = \PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }


    public function execute(){

        if($this->stmt->execute()) 
            return $this;
    }


    public function resultSet(){

        $this->execute();
            return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function single(){

        $this->execute();
        $ROW = $this->stmt->fetch(\PDO::FETCH_ASSOC, \PDO::FETCH_ORI_NEXT);
        return $ROW;
    }


    public function next(){

        $ROW = $this->stmt->fetch(\PDO::FETCH_ASSOC, \PDO::FETCH_ORI_NEXT);
        return $ROW;
    }


    public function rowCount(){

        return $this->stmt->rowCount();
    }


    public function lastId() {
        
        return $this->dbh->lastInsertId();
    }

}
