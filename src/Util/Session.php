<?php

namespace CharlesHopkinsIV\Core\Util;


class Session
{

    private static $instance;

    private function __construct()
    {

        if(session_status() === PHP_SESSION_NONE) {

            session_start();

        }

    }
    
    
    public static function instance()
    {

        if(empty(self::$instance)) {

            self::$instance = new self();
        }

        return self::$instance;
    }


    public function set($key, $val)
    {

        $_SESSION[$key] = $val;
    }


    public function get($key)
    {

        if(!empty($_SESSION[$key])) return $_SESSION[$key];
    }

    
    public function unset($key)
    {

        if(!empty($_SESSION[$key])) unset($_SESSION[$key]);
    }
}