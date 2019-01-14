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
    if (isset($_SESSION['email'])) {
        return true;
    }
    return false;
}