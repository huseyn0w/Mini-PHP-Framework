<?php

namespace controllers;

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

class Pages extends \config\HWF_Controller {

    private $db;

    public function index(){
        $this->db = $this->model('pages');
        $this->view('index');
    }

    public function admin()
    {
        $this->view('admin/index');
    }




}
 