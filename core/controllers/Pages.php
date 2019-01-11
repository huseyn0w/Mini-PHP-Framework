<?php

namespace controllers;

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

class Pages extends \config\HWF_Controller {

    public function index(){
        $this->model('pages');
        $this->view('index');
    }

    public function test(){
        echo 'hehey';
    }

}
 