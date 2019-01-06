<?php

class Core{

    private $controllerName = "Pages";
    private $methodName = "Front";
    private $params = [];
    private $url = null;

    public function __construct(){
        $url = $this->getURL();
        require_once ('../core/controllers/'. $this->controllerName . '/' . $this->methodName . '.php');
        return new $this->methodName;
    }

    public function getURL(){
        return 'here will be a url';
    }
}