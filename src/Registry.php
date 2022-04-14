<?php
/////////////////////////////////////////////////////////////////////////////////////////
//
//  Registry Class
//
/////////////////////////////////////////////////////////////////////////////////////////

namespace CharlesHopkinsIV\Core;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use \CharlesHopkinsIV\Core\Account\Account;
use \CharlesHopkinsIV\Core\Visitor\Visitor;
use \CharlesHopkinsIV\Core\Util\Db;


class Registry {

    private static $instance = null;
    private $request;
    private $config;
    private $ERRORS;


    private function __construct() {}


    public static function instance(): self 
    {

        if(empty(self::$instance)) {

            self::$instance = new self();
        }

        return self::$instance;
    }


    public function getDb()
    {

        if(empty($this->db)) {

            $this->db = new Db();
        }

        return $this->db;
    }


    public function getApplicationHelper()
    {

        return new ApplicationHelper();
    }


    public function setRequest($request)
    {

        $this->request = $request;
    }


    public function getRequest()
    {

        return $this->request;
    }


    public function setConfig($config)
    {

        if(file_exists($config)) {

            $this->config = json_decode(file_get_contents($config), 1);
        }

        else {

            throw new \Exception("Error with config file.");
        }
    }


    public function getConfig($key)
    {

        if(empty($this->config)) {

            $this->config = json_decode(file_get_contents(ApplicationHelper::getConfigFile()), 1);
        }

        if(!empty($this->config[$key])) return $this->config[$key];

        return;
    }


    public function setError(string $error) {

        $this->ERRORS[] = $error;

    }


    public function getErrors() {

        return $this->ERRORS;
    }
}


