<?php


namespace config;
defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

class HWF_ErrorHandler{

    public function __construct()
    {
        error_reporting(E_ALL | E_STRICT);

        if(DEBUG_MODE === "TRUE"){
            ini_set('display_errors', 'On');
            ini_set('log_errors', 0);
            ob_start();
            set_error_handler([$this, "error_handler"]);
            register_shutdown_function([$this, 'fatal_error_handler']);
        }
        else{
            ini_set('display_errors', 'off');
            ini_set('log_errors', 1);
            ini_set("error_log", ROOT . '../logs/error_log.log');
        }
    }

    public function debugHandler($errorArray)
    {
        if (file_exists(ROOT.'/config/debug.php')) {
            require_once(ROOT.'/config/debug.php');
        }
    }

    public function error_handler($errno, $errstr, $errfile, $errline)
    {
        if (error_reporting() & $errno) {
            $errors = array(
                E_ERROR => 'E_ERROR',
                E_WARNING => 'E_WARNING',
                E_PARSE => 'E_PARSE',
                E_NOTICE => 'E_NOTICE',
                E_CORE_ERROR => 'E_CORE_ERROR',
                E_CORE_WARNING => 'E_CORE_WARNING',
                E_COMPILE_ERROR => 'E_COMPILE_ERROR',
                E_COMPILE_WARNING => 'E_COMPILE_WARNING',
                E_USER_ERROR => 'E_USER_ERROR',
                E_USER_WARNING => 'E_USER_WARNING',
                E_USER_NOTICE => 'E_USER_NOTICE',
                E_STRICT => 'E_STRICT',
                E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR',
                E_DEPRECATED => 'E_DEPRECATED',
                E_USER_DEPRECATED => 'E_USER_DEPRECATED',
            );

            switch ($errno) {
                case E_ERROR:
                    $errno = 'E_ERROR';
                    break;
                
                    case E_WARNING: 
                    $errno = 'E_WARNING';
                    break;
                    
                
                    case E_PARSE: 
                    $errno = 'E_PARSE';
                    break;
                    
                
                    case E_NOTICE: 
                    $errno = 'E_NOTICE';
                    break;
                    
                
                    case E_CORE_ERROR: 
                    $errno = 'E_CORE_ERROR';
                    break;
                    
                
                    case E_CORE_WARNING:
                    $errno = 'E_CORE_WARNING';
                    break;
                    
                
                    case E_COMPILE_ERROR:
                    $errno = 'E_COMPILE_ERROR';
                    break;
                    
                
                    case E_COMPILE_WARNING: 
                    $errno = 'E_COMPILE_WARNING';
                    break;
                    
                
                    case E_USER_ERROR: 
                    $errno = 'E_USER_ERROR';
                    break;
                    
                
                    case E_USER_WARNING:
                    $errno = 'E_USER_WARNING';
                    break;
                    
                
                    case E_USER_NOTICE:
                    $errno = 'E_USER_NOTICE';
                    break;
                    
                
                    case E_STRICT: 
                    $errno = 'E_STRICT';
                    break;
                    
                
                    case E_RECOVERABLE_ERROR:
                    $errno = 'E_RECOVERABLE_ERROR';
                    break;
                    
                
                    case E_DEPRECATED:
                    $errno = 'E_DEPRECATED';
                    break;
                    
                
                    case E_USER_DEPRECATED: 
                    $errno = 'E_USER_DEPRECATED';
                    break;
                    
                    default: $errno = 'ERROR';
                    break;
                }   

            $errorArray = [
                [
                    'type' => $errno,
                    'message' => $errstr,
                    'file' => $errfile,
                    'line' => $errline
                ]
            ];


            $this->debugHandler($errorArray);
        }

        return true;
    }

    public function fatal_error_handler()
    {
        if ($error = error_get_last() and $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
            ob_end_clean();
            $this->error_handler($error['type'], $error['message'], $error['file'], $error['line']);
        } else {
            ob_end_flush();
        }
    }

    
}