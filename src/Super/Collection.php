<?php

namespace CharlesHopkinsIV\Core\Super;


abstract class Collection implements \Iterator 
{

    protected array $ITEMS;
    protected int $pointer = 0;

    public function __construct()
    {


    }


    public function current()
    {

        return $this->ITEMS[$this->pointer];
    }


    public function key()
    {

        return $this->pointer;
    }


    public function next()
    {

        $this->pointer++;
    }


    public function rewind()
    {

        $this->pointer = 0;
    }


    public function valid()
    {
        
        return isset($this->ITEMS[$this->pointer]);
    }
}
