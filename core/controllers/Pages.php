<?php

namespace controllers;

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

class Pages extends \config\HWF_Controller {

    private $db;

    public function index(){

        if($this->isAjax()){
            if(isset($_POST['order'])){
                $order = filter_var($_POST['order'], FILTER_SANITIZE_STRING);
                if($order == "date" || $order == "status"){
                    $this->db = $this->model('tasks');
                    $currentPage = new \helpers\Pagination('return');
                    $currentPage = $currentPage->getCurretpage();
                    $all_tasks = $this->db->all_tasks($currentPage, $order);
                    $tasks_json = json_encode($all_tasks);
                    echo $tasks_json;
                }
                exit;
            }
        }


        $this->db = $this->model('tasks');
        $currentPage = new \helpers\Pagination('return');
        $currentPage = $currentPage->getCurretpage();
        $all_tasks = $this->db->all_tasks($currentPage);

        $userArray = [];

        if(is_logged_in()){
            $userModel = $this->model('users');
            $userArray = $userModel->get_current_user_credentials();
        }


        $data = [
            'userArray' => $userArray,
            'tasksArray' => $all_tasks
        ];

        $this->view('index', $data);
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
 