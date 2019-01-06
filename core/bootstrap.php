<?php


require_once('config/constants.php');

spl_autoload_register(function ($className) {
    require_once 'config/' . $className . '.php';
});
  
//Framework start point
$init = new Core;
