<?php

namespace controllers;

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

class Tasks extends \config\HWF_Controller
{
    protected $name, $desc, $taskStatus, $taskArray;

    // public function index()
    // {
    //     $this->db = $this->model('tasks');
    //     $all_tasks = $this->db->all_tasks();

    //     $this->view('index', $all_tasks);
    // }

    public function create()
    {
        if(isset($_POST['add_task'])){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $result = $this->filter_data($_POST);

            if (is_array($result) && !empty($result)) {
                $_SESSION['error'] = $result;
                redirect(HOME_DIR . '/tasks/create');
            }

            if ($result === true) {
                $userModel = $this->model('tasks');
                $queryResult = $userModel->createTask($this->name, $this->desc);
                if ($queryResult === true) {
                    redirect(HOME_DIR);
                }
            }
            $_SESSION['error'] = $queryResult;
            redirect(HOME_DIR . '/tasks/create');
        }
        $this->view('tasks/create');
    }


    public function update($id = false)
    {
        if (!$id) redirect(HOME_DIR);
        $id = (int)$id;

        if (isset($_POST['update_task'])) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $result = $this->filter_data($_POST);



            if (is_array($result) && !empty($result)) {
                $_SESSION['error'] = $result;
                redirect(HOME_DIR . '/tasks/edit');
            }

            if ($result === true) {
                $userModel = $this->model('tasks');
                $queryResult = $userModel->updateTask($id, $this->name, $this->desc, $this->taskStatus);
                if ($queryResult === true) {
                    redirect(HOME_DIR);
                }
            }
            $_SESSION['error'] = $queryResult;
            redirect(HOME_DIR . '/tasks/edit');
        }
        $userModel = $this->model('tasks');
        $loadTask = $userModel->showTask($id);
        if (is_array($loadTask) && !empty($loadTask)) {
            $this->view('tasks/edit', $loadTask);
            exit;
        }
        redirect(HOME_DIR); 
    }

    public function read($id = false)
    {
        if(!$id) redirect(HOME_DIR);
        $id = (int)$id;
        $userModel = $this->model('tasks');
        $queryResult = $userModel->showTask($id);
        if (!$queryResult) redirect(HOME_DIR);

        if(is_array($queryResult) && !empty($queryResult)){
            $this->view('tasks/fulltask', $queryResult);
        }
    }

    public function deleteTasks(){
        if(!$this->isAjax()) redirect(HOME_DIR);

        if(isset($_POST['taskArray'])){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $result = $this->filter_data($_POST);
            if (is_array($result) && !empty($result)) {
                $_SESSION['error'] = $result;
                redirect(HOME_DIR . '/tasks/');
            }

            if ($result === true) {
                $userModel = $this->model('tasks');
                $queryResult = $userModel->deleteSelectedTask($this->taskArray);
                if ($queryResult === true) {
                    echo 1;
                    return;
                }
            }
        }
    }

    public function delete($id = false)
    {
        if(!$id) redirect(HOME_DIR);
        $id = (int) $id;
        $userModel = $this->model('tasks');
        $queryResult = $userModel->deleteTask($id);
        if ($queryResult === true) {
            echo 1;
            return;
        }
        
    }
}