<?php


namespace config;
defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

class HWF_ErrorHandler{

    public function __construct()
    {
        error_reporting(E_ALL | E_STRICT);
        ini_set('display_errors', 'On');
        ob_start();
        set_error_handler([$this, "error_handler"]);
        register_shutdown_function([$this,'fatal_error_handler']);
    }

    public function debugHandler($errorArray)
    {
        if (file_exists('../core/config/debug.php')) {
            require_once('../core/config/debug.php');
        }
    }

    public function error_handler($errno, $errstr, $errfile, $errline)
    {
    // если ошибка попадает в отчет (при использовании оператора "@" error_reporting() вернет 0)
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

            echo "we detected an error!";
        }

    // не запускаем внутренний обработчик ошибок PHP
        return true;
    }

    public function fatal_error_handler()
    {
    // если была ошибка и она фатальна
        if ($error = error_get_last() and $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
        // очищаем буффер (не выводим стандартное сообщение об ошибке)
            ob_end_clean();
        // запускаем обработчик ошибок
            $this->error_handler($error['type'], $error['message'], $error['file'], $error['line']);
        } else {
        // отправка (вывод) буфера и его отключение
            ob_end_flush();
        }
    }

    
}