<?php

namespace CharlesHopkinsIV\Core\Util;


class Mem
{

    private Memcached $Mc;

    public function __construct()
    {

        $this->Mc = new Memcached();
        $this->Mc->addServer("localhost", 11211);
    }


    public function get()
    {


    }


    public function set()
    {


    }


    public function getBytesUsed() : int
    {


    }


    public function getAllKeys() : array
    {

        
    }
}