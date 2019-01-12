<?php

require_once('config/constants.php');
require_once('helpers/functions.php');

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

spl_autoload_register(function ($className) {

    $file = ROOT . '/'.str_replace("\\", '/', $className) . '.php';
    if(is_file($file)){
        require_once $file;
    }
    else{
        return false;
    }
});

$debug = new config\HWF_ErrorHandler;
  
//Framework start point
$init = new config\Router;


if(DEBUG_MODE){
    error_reporting(0);
}
