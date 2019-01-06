<?php
require_once('config/constants.php');

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

spl_autoload_register(function ($className) {
    require_once 'config/' . $className . '.php';
});
  
//Framework start point
$init = new Core;
