<?php

namespace CharlesHopkinsIV\Core;


class FrontController {

    private $reg;

    private function __construct() {

        $this->reg = Registry::instance();
    }

    
    public static function run() {

        $instance = new FrontController();
        $this->reg->getApplicationHelper()->init();
        $instance->handleRequest();
    }


    private function handleRequest() {
        
        $request = $this->reg->getRequest();
        $resolver = new CommandResolver();
        $cmd = $resolver->getCommand($request);
        $cmd = new $cmd();
        $cmd->execute($request);
    }
}
