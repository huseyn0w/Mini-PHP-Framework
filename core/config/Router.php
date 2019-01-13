<?php
namespace config;

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');
class Router{

    private $route = [];


    private $routesMap = [
        "^$" => ["controller" => "Pages", "method" => "Index"],
        "^register/?$" => ["controller" => "Pages", "method" => "Register"],
        "^login/?$" => ["controller" => "Pages", "method" => "Login"],
        "^(?P<controller>[a-z-]+)/?(?P<method>[a-z-]+)?/?$" => [],
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
                http_response_code(404);
                require_once('../core/views/' . CURRENT_TEMPLATE . '/404.php');
                exit;
            }

        }
        else{
            http_response_code(404);
            require_once('../core/views/'. CURRENT_TEMPLATE .'/404.php');
            exit;
        }
        
    }

    private function findRoute()
    {
        $url = $this->getURL();


        $matchedCount = 0;

        foreach ($this->routesMap as $key => $value) {

            //print_arr($key);
            //print_arr($value).'\n';

            if (preg_match("#{$key}#i", $url, $matches)) {
                $matchedCount++;
                if(empty($value)){
                    foreach ($matches as $controller => $method) {
                        if ($method == "") {
                            $this->route = $value;

                        } else {
                            if (is_string($controller)) {

                                $this->route[$controller] = $this->controllerNameFix($method);

                                if (!isset($this->route['method'])) {
                                    $this->route['method'] = "Index";
                                }



                            }
                        }
                    }
                }
                else{
                    $this->route = $value;
                }
                break;
            }

        }
        if($matchedCount == 0) return false;
        return true;
    }

    private function controllerNameFix($controllername){
        $pattern = "#[\-_]+#";
        $replacement = " ";
        $controllername = preg_replace($pattern, $replacement, $controllername);
        $controllername = ucwords($controllername);
        $controllername = str_replace(" ", "", $controllername);
        return $controllername;
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