<?php

class Controller{

    protected function view($filename){
        require_once('../core/views/'.$filename.'.php');
    }
    
}