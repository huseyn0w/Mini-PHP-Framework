<?php

namespace controllers;

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

class Pages extends \config\HWF_Controller {

    private $db;

    public function index(){
        $this->db = $this->model('tasks');
        $all_tasks = $this->db->all_tasks();

        $this->view('index', $all_tasks);
    }

    public function admin()
    {
        $this->view('admin/index');
    }

    public function aboutFramework()
    {
        $this->view('about-framework');
    }




}
 