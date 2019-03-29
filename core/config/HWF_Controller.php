<?php

namespace config;

defined ('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

class HWF_Controller{

    /**
     * Loading view file from template
     * @param string $filename
     * @param array $data
     */
    protected function view(string $filename, $data = []):void{

        if($filename == 'index') $filename =  ucwords($filename);

        if(file_exists('../core/views/'.CURRENT_TEMPLATE.'/'.$filename.'.php')){
            require_once('../core/views/'.CURRENT_TEMPLATE.'/'.$filename . '.php');
        }
        else{
            $this->NotFound();
        }
    }


    /**
     * Loading Model Object from models folder
     * @param string $modelname
     * @return object
     */
    protected function model(string $modelname) :object {
        if(file_exists('../core/models/'.ucwords($modelname).'.php')){
            require_once('../core/models/' . ucwords($modelname) . '.php');
            return new $modelname;
        }
    }

    /**
     * Checking whether it is ajax request or not
     * @return bool
     */
    protected function isAjax():bool{
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        }
        return false;
    }


    /**
     * Filtering data in array
     * @param array $array
     * @return array|bool
     */
    protected function filter_data(array $array)
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

    /**
     * Return 404 page
     */
    public function NotFound(){
        return $this->view('404');
    }

    
}