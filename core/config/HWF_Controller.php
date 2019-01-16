<?php

namespace config;

defined ('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

class HWF_Controller{

    protected function view($filename, $data = []){
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

    protected function isAjax(){
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        }
        return false;
    }

    protected function pagination(){

    }

    protected function filter_data($array)
    {

        $errors = [];

        if (isset($array['email'])) {
            $this->email = filter_var($array['email'], FILTER_SANITIZE_EMAIL);
            if (empty($this->email)) {
                $errors['email_error'] = "Email is empty";
            }
        }

        if (isset($array['login'])) {
            $this->login = filter_var($array['login'], FILTER_SANITIZE_STRING);
            if (empty($this->login)) {
                $errors['login_error'] = "Login is empty";
            }
        }
        if (isset($array['password'])) {
            $this->password = filter_var($array['password']);
            if (empty($this->password)) {
                $errors['password_error'] = "Password is empty";
            }
        }
        if (isset($array['password_confirm'])) {
            $this->password_confirm = filter_var($array['password_confirm']);
            if (empty($this->password_confirm)) {
                $errors['password_confirm_error'] = "Password confirm field is empty";
            }
        }
        if (isset($array['password']) && isset($array['password_confirm'])) {
            if ($this->password !== $this->password_confirm) {
                $errors['password_confirm_error'] = "Password and Password confirm field is empty";
            }
        }
        if (isset($array['name'])) {
            $this->name = filter_var($array['name'], FILTER_SANITIZE_STRING);
            if (empty($this->name)) {
                $errors['name_error'] = "Password and Password confirm field is empty";
            }
        }

        if (isset($array['desc'])) {
            $this->desc = filter_var($array['desc'], FILTER_SANITIZE_STRING);
            if (empty($this->desc)) {
                $errors['name_error'] = "Description field is empty";
            }
        }

        if (isset($array['task-status'])) {
            $this->taskStatus = (int) filter_var($array['task-status'], FILTER_SANITIZE_NUMBER_INT);
            
            if ($this->taskStatus !== 0 && $this->taskStatus !== 1) {
                $errors['task_error'] = "Task status is empty";
            }
        }

        if (isset($array['taskArray'])) {

            $filteredArray = [];

            foreach( $array['taskArray'] as $arrayItem ){
                $filteredArray[] = (int) $arrayItem;
            }

            $this->taskArray = $filteredArray;
        }

        if (!empty($errors)) {
            return $errors;
        }

        return true;
    }

    public function NotFound(){
        $this->view('404');
    }
    
}