<?php

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');
class Core{

    private $controllerName = "Pages";
    private $methodName = "Index";
    private $params = [];

    public function __construct(){

        $url = $this->getURL();

        if (isset($url[0])) {
            if (file_exists('../core/controllers/' . ucwords($url[0]) . '.php')) {
                $this->controllerName = ucwords($url[0]);
            }
            else{
                $this->controllerName = "PageNotFound";
            }
            unset($url[0]);
        }
        
        if($this->controllerName === "PageNotFound"){
            require_once('../core/controllers/404.php');
        }
        else{
            require_once('../core/controllers/' . $this->controllerName . '.php');
        }

        $this->controllerName = new $this->controllerName;

        if (isset($url[1])) {
            if(method_exists($this->controllerName, ucwords($url[1]))){
                $this->methodName = ucwords($url[1]);   
            }
            else{
                $this->methodName = "NotFound";
            }
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];


        call_user_func_array([$this->controllerName, $this->methodName], $this->params);


        
    }

    protected function getURL(){

        if(isset($_GET['route'])){
            $url = rtrim($_GET['route'], '/');

            $url = filter_var($_GET['route'], FILTER_SANITIZE_URL);

            $url = explode('/', $url);

            return $url;
        }
    }
}