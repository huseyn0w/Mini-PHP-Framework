<?php

require_once('config/constants.php');

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

spl_autoload_register(function ($className) {

    $file = ROOT . '/'.str_replace("\\", '/', $className) . '.php';
    if(is_file($file)){
        require_once $file;
    }
    else{
        echo 'File '.$file.' not found!';
    }
});
  
//Framework start point
$init = new config\Core;
