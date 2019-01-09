<?php

namespace controllers;

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

class Pages extends \config\HWF_Controller {

    public function Index(){
        $this->model('pages');
        $this->view('index');
    }

    public function Test(){
        echo 'hehey';
    }

}
 