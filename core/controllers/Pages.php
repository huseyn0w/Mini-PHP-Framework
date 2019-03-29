<?php

namespace controllers;

use helpers\Pagination as Pagination;

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

class Pages extends \config\HWF_Controller {

    private $db;

    /**
     * Return Index Page by loading data or make ordering if there is any ajax request
     */
    public function index():void {

        if($this->isAjax()){
            if(isset($_POST['order'])){
                $order = filter_var($_POST['order'], FILTER_SANITIZE_STRING);
                if($order == "date" || $order == "status"){
                    $this->db = $this->model('tasks');
                    $currentPage = new Pagination();
                    $currentPage = $currentPage->getCurrentPage();
                    $all_tasks = $this->db->all_tasks($currentPage, $order);
                    $tasks_json = json_encode($all_tasks);
                    echo $tasks_json;
                }
                exit;
            }
        }


        $this->db = $this->model('tasks');
        $currentPage = new Pagination();
        $currentPage = $currentPage->getCurrentPage();
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


    /**
     * Return Admin Page or login page if user is not logged in
     */
    public function admin():void
    {
        if(!is_logged_in()){
            redirect(HOME_DIR . '/login/');
        }
        $this->view('admin/index');
    }

    /**
     * Return AboutFramework Page
     */
    public function aboutFramework():void
    {
        $this->view('about-framework');
    }




}
 