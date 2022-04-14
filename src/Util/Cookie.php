<?php

namespace CharlesHopkinsIV\Core\Util;

class Cookie
{

    public static function set($key, $val, $days = 7)
    {

        setcookie($key, $val, time() + 3600 * 24 * $days, "/");
        $_COOKIE[$key] = $val;
    }


    public static function get($key)
    {

        if(!empty($_COOKIE[$key])) return $_COOKIE[$key];
    }


    public static function unset($key)
    {

        setcookie($key, '', time() - 5615 ** 2, '/');
        unset($_COOKIE[$key]);
    }
}
