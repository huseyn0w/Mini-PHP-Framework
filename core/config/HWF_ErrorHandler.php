<?php


namespace config;

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

class HWF_ErrorHandler{

    public function debugHandler($errorArray)
    {
        if (file_exists('../core/config/debug.php')) {
            require_once('../core/config/debug.php');
        }
    }
}