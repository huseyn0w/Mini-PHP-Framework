<?php
session_start();

require_once('config/constants.php');

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

spl_autoload_register(function (string $className) {

    $file = ROOT . '/'.str_replace("\\", '/', $className) . '.php';
    if(is_file($file)){
        require_once $file;
    }
    else{
        return false;
    }

});

$debug = new config\HWF_ErrorHandler;

require_once('helpers/functions.php');
require_once('config/routes.php');


//Framework start point
$init = new config\Router($routesMap);


if(DEBUG_MODE){
    error_reporting(0);
}
