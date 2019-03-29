<?php
namespace config;

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');



class Router{


    private $route = [];

    private $routesMap = [];


    /**
     * Router constructor.
     * Finding Route and create instance of object or return 404 Page
     * @param $routesMap
     */
    public function __construct($routesMap){

        $this->routesMap = $routesMap;


        if($this->findRoute()){

            $controller = $this->route['controller'];
            $method = $this->route['method'];

            if(isset($this->route['id'])){
                $id = $this->route['id'];
            }

            if($this->controllerMethodExist($controller, $method)){


                $obj = '\controllers\\'.$controller;

                $obj = new $obj;

                if(isset($id)){
                    $obj->$method($id);
                }
                else{
                    $obj->$method();
                }
            }
            else{
                http_response_code(404);
                $hwfController = new HWF_Controller;
                $hwfController->NotFound();
            }

        }
        else{
            http_response_code(404);
            $hwfController = new HWF_Controller;
            $hwfController->NotFound();
        }
        
    }

     /**
     * Finding route through array in routes.php file and write controller, method names in $this->route array.
     * @return bool
     */
    private function findRoute() :bool
    {
        $url = $this->getURL();


        $matchedCount = 0;

        foreach ($this->routesMap as $key => $value) {

            if (preg_match("#{$key}#i", $url, $matches)) {
                $matchedCount++;

                //Check if RoutesMap array right side has defined controller or method names
                if(empty($value)) {
                    foreach ($matches as $key2 => $value2) {
                        // Remove ingeger keys from matches array
                        if (is_int($key2)) {
                            unset($matches[$key2]);
                        }
                    }

                    if (isset($matches['controller']) && !empty($matches['controller']) && is_string($matches['controller'])) {
                        $controller = $matches['controller'];
                    } else {
                        $controller = "Pages";
                    }

                    if (isset($matches['method']) && !empty($matches['method']) && is_string($matches['method'])) {
                        $method = $matches['method'];
                    } else {
                        $method = "Index";
                    }

                    $this->route['controller'] = $this->controllerNameFix($controller);
                    $this->route['method'] = $method;


                    if (isset($matches['id'])) {
                        $this->route['id'] = (int) $matches['id'];
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

    /**
     * Filter controllername by removing unnecessarry characters and making name in CamelCase format
     * @param string $controllerName
     * @return string
     */
    private function controllerNameFix(string $controllerName):string {
        $pattern = "#[\-_]+#";
        $replacement = " ";
        $controllerName = preg_replace($pattern, $replacement, $controllerName);
        $controllerName = ucwords($controllerName);
        $controllerName = str_replace(" ", "", $controllerName);
        return $controllerName;
    }

    /**
     * Getting Url from GET Method, Filter and returning it
     * @return string
     */
    private function getURL():string {

        if(isset($_GET['route'])){

            $url = rtrim($_GET['route'], '/');

            $url = filter_var($_GET['route'], FILTER_SANITIZE_URL);


            return $url;
        }
    }


    /**
     * Check whether controller class name file and method has been founded or not
     * @param string $controllerName
     * @param string $methodName
     * @return bool
     */
    private function controllerMethodExist(string $controllerName, string $methodName) :bool {
        if(!class_exists('\controllers\\'.$controllerName) || !method_exists('\controllers\\'.$controllerName, $methodName)){
            return false;
        }
        return true;
    }
}