<?php

defined ('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

class Controller{

    protected function view($filename){
        if(file_exists('../core/views/'.CURRENT_TEMPLATE.'/'.$filename.'.php')){
            require_once('../core/views/'.CURRENT_TEMPLATE.'/'. $filename . '.php');
        }
        else{
            require_once('../core/views/'.CURRENT_TEMPLATE.'404.php');
        }
    }

    protected function model($model){
        if(file_exists('../core/models/'.$filename.'.php')){
            require_once('../core/models/' . $filename . '.php');
        }
    }

    public function NotFound(){
        $this->view('404');
    }
    
}