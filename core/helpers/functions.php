<?php

function print_arr($array)
{
    '<pre>'.print_r($array).'</pre>';
}

function redirect($link){
    header("Location: $link");
    exit;
}

function is_logged_in(){
    if( isset($_SESSION['email']) && isset($_SESSION['user_id']) )
    {
        return true;
    }
    return false;
}

function get_current_user_id()
{
    if( !is_logged_in() ) return false;
    return $_SESSION['user_id'];
}

function get_current_user_status(){
    if (!is_logged_in()) return false;
    return $_SESSION['status'];
}

function require_template_file($filename){
    $fileURL = false;
    if(file_exists(TEMPLATE_DIRECTORY_URL .'/'.$filename.'.php')){
        $fileURL = TEMPLATE_DIRECTORY_URL .'/'.$filename.'.php';
        return require_once($fileURL);
    }
    if(!$fileURL) echo "File {$filename}.php is not found";
    exit;
}

function generate_pagination(){
    $pages = new \helpers\Pagination();
}