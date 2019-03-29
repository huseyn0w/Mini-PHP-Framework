<?php

namespace controllers;
use config\HWF_Controller as HWF_Controller;

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

class Tasks extends HWF_Controller
{
    protected $name, $desc, $taskStatus, $taskArray;

    /**
     * Loads Create task template or/and Create task in database
     */
    public function create()
    {

        if(isset($_POST['add_task'])){
            if(!csrf_checkout()) redirect(HOME_DIR.'/');
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


    /**
     * Update task by its ID
     * @param int $id
     */
    public function update(int $id)
    {
        if (!isset($id)) redirect(HOME_DIR);
        $id = (int)$id;

        if (isset($_POST['update_task'])) {

            if(!csrf_checkout()) redirect(HOME_DIR.'/');

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
        }
        else{
            redirect(HOME_DIR);
        }
    }

    /**
     * Read task by its ID
     * @param int $id
     */
    public function read(int $id):void
    {
        if(!isset($id)) redirect(HOME_DIR);
        $id = (int)$id;
        $userModel = $this->model('tasks');
        $queryResult = $userModel->showTask($id);
        if (!$queryResult) redirect(HOME_DIR);

        if(is_array($queryResult) && !empty($queryResult)){
            $this->view('tasks/fulltask', $queryResult);
        }
    }

    /**
     * Deleted multiple tasks at once via using AJAX
     */
    public function deleteTasksAjax(){
        if(!$this->isAjax()) redirect(HOME_DIR);

        if(isset($_POST['taskArray'])){
            if(!csrf_checkout()) redirect(HOME_DIR.'/');
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

    /**
     * Delete single task via using Ajax
     * @param int $id
     */
    public function delete(int $id)
    {
        if(!isset($id) || !$this->isAjax() || !csrf_checkout()) redirect(HOME_DIR);

        $id = (int) $id;
        $userModel = $this->model('tasks');
        $queryResult = $userModel->deleteTask($id);
        if ($queryResult) {
            echo 1;
            return;
        }
        
    }
}