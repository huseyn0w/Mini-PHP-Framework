<?php

use helpers\Pagination as Pagination;


/**
 * Better version of print_r function to see array in browser
 * @param $array
 */
function print_arr($array):void
{
    echo '<pre>'.print_r($array).'</pre>';
}

/**
 * Redirecting
 * @param $link
 */
function redirect(string $link){
    header("Location: $link");
    exit;
}

/**
 * Checking whether user logged in. If yes, return true, else, false
 * @return bool
 */
function is_logged_in():bool{

    $result = isset($_SESSION['email']) && isset($_SESSION['user_id']) ?? false;
    return $result;

}

/**
 * Return current user id if user is logged or false if user isn't
 * @return mixed
 */
function get_current_user_id()
{
    if( !is_logged_in() ) return false;
    return $_SESSION['user_id'];
}
/**
 * Return current user status if user is logged or false if user isn't
 * @return mixed
 */
function get_current_user_status(){
    if (!is_logged_in()) return false;
    return $_SESSION['status'];
}

/**
 * @param string $filename
 * @return mixed
 */
function require_template_file(string $filename){
    $fileURL = TEMPLATE_DIRECTORY_URL .'/'.$filename.'.php';
    $fileURL = str_replace("\\", "/", $fileURL);
    if(file_exists($fileURL)){
        return require_once($fileURL);
    }
    else{
        $fileURL = false;
        if(!$fileURL) echo "File {$filename}.php is not found";
        exit;
    }
    
}

/**
 * Call Pagination Class instance to generate Pagination HTML
 */
function generate_pagination(){
    $pagination = new Pagination();
    return $pagination->renderPagination();
}

/**
 * Generate CSRF token string, writing it to the session and return it;
 * @return string
 * @throws Exception
 */
function generate_csrf_token() :string
{
    $_SESSION['token'] = bin2hex(random_bytes(32));
    $token = $_SESSION['token'];
    return $token;
}

/**
 * Return current crsf token value
 */
function get_current_token()
{
    if(!isset($_SESSION['token'])) return false;
    return $_SESSION['token'];

}

/**
 * Check if csrf field exist and equal to current generated token
 * @return bool
 */
function csrf_checkout() :bool
{
    $current_token = get_current_token();
    if( !isset($_POST['csrf']) || $current_token !== $_POST['csrf'] ){
        $_SESSION['error_csrf'] = 'Wrong token value';
        return false;
    }
    return true;
}