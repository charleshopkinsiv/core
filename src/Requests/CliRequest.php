<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  CLI Request
//  Desc: Handles the command line request and returns a command for the CommandResolver
//
//  Instructions: Use the following command to test via the command line
//
//  Command: index.php <path> <method> <arguments>
//    Ex:    index.php products get
//
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

namespace CharlesHopkinsIV\Core\Request;


class CliRequest extends Request {

    public function init() {

        $argv = $_SERVER['argv'];

        if(empty($argv[1]))
            exit('Must provide path and method.');

        $this->path = $argv[1];

        $this->path         = (empty($this->path)) ? '/' : $this->path;
    }
}
