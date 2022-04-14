<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  HTTP Request
//  Desc: Handles the http request and returns a command for the CommandResolver
//
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

namespace CharlesHopkinsIV\Core\Request;


class HttpRequest extends Request {

    public function init() {

        $this->properties[$_SERVER['REQUEST_METHOD']] = $_REQUEST;

        $this->path         = (empty($_SERVER['REQUEST_URI'])) ? '' : $_SERVER['REQUEST_URI'];
    }
}
