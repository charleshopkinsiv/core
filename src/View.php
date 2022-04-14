<?php

namespace CharlesHopkinsIV\Core;

class View
{

    private $template;
    private $title;
    private $description;
    private $request;
    private $data;
    private $view_dir = __DIR__ . "/../../../../views/";

    public function __construct()
    {

        $reg = Registry::instance();

        //
        // Set Data
        //
        $this->title = $reg->getConfig('title');
        $this->description = $reg->getConfig('description');
        $this->request = Registry::instance()->getRequest();
    }


    public function setTemplate($file)
    {

        //
        // Check on the template file
        //
        if(is_file($this->view_dir . $file)) {

            $this->template = $this->view_dir . $file;
        }

        elseif(is_file($this->view_dir . $file . ".php")) {

            $this->template = $this->view_dir . $file . ".php";
        }

        elseif(is_file($file)) {

            $this->template = $file;
        }

        else {

            exit('Bad view.');
        }
    }


    public function getRequest() {

        return $this->request;
    }


    public function setData($key, $val)
    {

        $this->data[$key] = $val;
    }

    
    public function getData($key) 
    {

        if(isset($this->data[$key])) return $this->data[$key];

        return;
    }


    public function setTitle($title) 
    {

        $this->title = $title;
    }

    public function getTitle() : string
    {

        return $this->title;
    }


    public function setDescription($description) {

        $this->description = $description;
    }

    public function load() {

        include $this->template;
    }


    public function loadPart($part, $DATA = []) {

        $file = $this->view_dir . "parts/" . $part;

        if(file_exists($file)) {

            include $file;
            return;
        }

        elseif(file_exists($file . ".php")) {

            include $file . ".php";
            return;
        }

        return false;
    }
}

