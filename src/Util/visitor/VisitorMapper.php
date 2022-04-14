<?php

namespace CharlesHopkinsIV\Core\Visitor;


use CharlesHopkinsIV\Super\Mapper;


class VisitorMapper extends Mapper
{

    public static $instance;

    public function __construct() {

        $this->table = "visitors";

        parent::__construct();
    }


    public static function instance()
    {

        if(empty(self::$instance)) {

            self::$instance = new self();
        }

        return self::$instance;
    }


    public function getVisitor($ip_address, $user_agent) 
    {

        $VISITOR = [];

        $sql = "SELECT * 
        FROM visitors 
        WHERE ip_address = '" . $ip_address . "' 
        AND user_agent = '" . $user_agent . "'";

        $VISITOR = $this->db->query($sql)->single();
    
        if(empty($VISITOR)) {

            $sql = "INSERT INTO visitors
                SET ip_address = '" . $ip_address . "',
                    user_agent = '" . $user_agent . "', 
                    visits = 1";

            $this->db->query($sql)->execute();
            
            return [
                'id' => $this->db->lastId(),
                'visits' => 1
            ];
        }

        return $VISITOR;
    }
}
