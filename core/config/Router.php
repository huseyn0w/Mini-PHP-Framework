<?php
namespace config;

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');
class Router{

    private $controllerName = "Pages";
    private $methodName = "Index";
    private $params = [];
    private $controllerRoot = '';

    private $route = [];


    private $routesMap = [
        "^$" => ["controller" => "Pages", "method" => "Index"],
        "^(?P<controller>[a-z-]+)/?(?P<method>[a-z-]+)?/?$" => []
    ];

    public function __construct(){


        if($this->findRoute()){
            extract($this->route);

            if($this->controllerMethodExist($controller, $method)){

                $obj = '\controllers\\'.$controller;

                $obj = new $obj;

                $obj->$method();
            }
            else{
                require_once('../core/views/' . CURRENT_TEMPLATE . '/404.php');
                exit;
            }

        }
        else{
            require_once('../core/views/'. CURRENT_TEMPLATE .'/404.php');
            exit;
        }
        
    }

    private function findRoute()
    {
        $url = $this->getURL();

        $matchedCount = 0;

        foreach ($this->routesMap as $key => $value) {

            if (preg_match("#$key#i", $url, $matches)) {
                $matchedCount++;
                foreach ($matches as $controller => $method) {
                    if ($method == "") {
                        $this->route = $value;
                    } 
                    else {
                        if (is_string($controller)) {
                            $this->route[$controller] = $method;



                            if (!isset($this->route['method'])) {
                                $this->route['method'] = "Index";
                            }
                        }
                    }
                }
            }

        }
        if($matchedCount == 0) return false;
        return true;
    }

    private function getURL(){

        if(isset($_GET['route'])){
            $url = rtrim($_GET['route'], '/');

            $url = filter_var($_GET['route'], FILTER_SANITIZE_URL);

            return $url;
        }
    }


    private function controllerMethodExist($controllerName, $methodName){
        if(!class_exists('\controllers\\'.$controllerName) || !method_exists('\controllers\\'.$controllerName, $methodName)){
            return false;
        }
        return true;
    }
}