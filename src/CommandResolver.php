<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  Command Resolver
//  Processes the request to load the right command script
//
/////////////////////////////////////////////////////////////////////////////////////////////////////////

namespace CharlesHopkinsIV\Core;

use Exceptions\BadCommandException;


private static $command_namespace = "\\CharlesHopkinsIv\\Core\\Commands\\";


class CommandResolver {

    public function __construct() {

        $this->registry = Registry::instance();
    }


    public function getCommand($request)
    {

        $COMMANDS = $this->registry->getConfig('commands');

        $path = $request->getPath();

        if($path == "" || $path == "/") { // Home / no path

            return self::$command_namespace . $COMMANDS['home'];
        } 
        elseif(!empty($COMMANDS[$path])) {

            return self::$command_namespace . $COMMANDS[$path];
        }
        elseif(!empty(implode("/", array_pop(explode("/", $path))))) { // Has variable at end

            $request->setProperty(array_pop(explode("/", $path)));
            return self::$command_namespace . implode("/", array_pop(explode("/", $path));
        }
        else {

            return self::$command_namespace . $COMMANDS['not-found'];
        }
    }
}