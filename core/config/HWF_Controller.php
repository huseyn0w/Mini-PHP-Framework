<?php

namespace config;

defined ('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

class HWF_Controller{

    protected function view($filename){
        if(file_exists('../core/views/'.CURRENT_TEMPLATE.'/'.ucwords($filename).'.php')){
            require_once('../core/views/'.CURRENT_TEMPLATE.'/'. ucwords($filename) . '.php');
        }
        else{
            $this->NotFound();
        }
    }

    protected function model($modelname){
        if(file_exists('../core/models/'.ucwords($modelname).'.php')){
            require_once('../core/models/' . ucwords($modelname) . '.php');
            return new $modelname;
        }
    }

    public function NotFound(){
        $this->view('404');
    }
    
}