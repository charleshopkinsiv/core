<?php

namespace CharlesHopkinsIV\Core\Visitor;


class Visitor
{

    private int $id;
    private string $user_agent;
    private string $ip_address;
    private int $visit_count;
    private VisitorMapper $mapper;

    private static $instance;

    private function __construct()
    {

        $this->user_agent = !empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT']   : '';
        $this->ip_address = !empty($_SERVER['REMOTE_ADDR'])     ? $_SERVER['REMOTE_ADDR']       : '';

        $this->mapper   = new VisitorMapper;
        $DATA           = $this->mapper->getVisitor($this->ip_address, $this->user_agent);

        $this->visit_count  = $DATA['visits'];
        $this->id           = $DATA['id'];
    }


    public static function instance() {

        if(empty(self::$instance)) {

            self::$instance = new self();
        }

        return self::$instance;
    }


    public function incrementVisitCount() 
    {

        if(!empty($this->ip_address)
        && !empty($this->user_agent)) {

            $this->visit_count = $this->visitCount();

            $this->visit_count++;

            $this->mapper->update($this);
        }
    }


    public function getId()
    {

        return $this->id;
    }


    public function visitCount()
    {

        if(empty($this->visit_count)) {

            $this->visit_count = $this->mapper->getCount($this->ip_address, $this->user_agent);
        }

        return $this->visit_count;
    }
}
