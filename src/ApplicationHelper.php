<?php

namespace CharlesHopkinsIV\Core;


use Requests\HttpRequest;
use Requests\CliRequest;


class ApplicationHelper {

    private $reg;
    private static $config_file = __DIR__ . "/../../../../data/config.json";


    public function __construct() 
    {

        $this->reg = Registry::instance();
    }


    public function init() 
    {

        $this->reg->setRequest($this->loadRequest());
        $this->setupOptions();
    }


    public function loadRequest()
    {

        if(isset($_SERVER['REQUEST_METHOD'])) {

            return new  HttpRequest();
        } 
        else {

            return new  CliRequest();
        }
    }


    public function setupOptions() 
    {

        $this->reg->setConfig(self::$config_file);
    }
}
