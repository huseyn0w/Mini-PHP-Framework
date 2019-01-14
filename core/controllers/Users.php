<?php
namespace controllers;

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');


class Users extends \config\HWF_Controller
{
    private $email, $login, $password, $password_confirm, $name;


    public function login()
    {
        if ($this->isAjax()) {

        } else {
            if (isset($_POST['login_me'])) {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $result = $this->filterDataBeforeRegistration($_POST);

                if ($result === true) {
                    $userModel = $this->model('users');
                    $queryResult = $userModel->authorization($this->email, $this->password);
                    if ($queryResult) {
                        redirect(HOME_DIR);
                    } else {
                        $_SESSION['error_message'] = 'Wrong credentials, please try again!';
                        redirect(HOME_DIR.'/login');
                        exit;
                    }
                }
            }
            $this->view('login');
        }

    }

    public function register()
    {
        if ($this->isAjax()) {
            if( isset($_POST['name']) && isset($_POST['value']) ){
                $input_name = $_POST['name'];
                $input_value = $_POST['value'];
                if($input_name === "email"){
                    $input_value = filter_var($input_value,FILTER_SANITIZE_EMAIL);
                    if (filter_var($input_value, FILTER_VALIDATE_EMAIL)) {
                        $result = $this->checkFromDatabase($input_name, $input_value);
                        echo $result;
                    } else {
                        $result = [
                            'type' => 'email',
                            'answer' => "This is not a valid email address!"
                        ];
                        echo \json_encode($result);
                    }
                }
                elseif ($input_name === "login"){
                    $input_value = filter_var($input_value,FILTER_SANITIZE_STRING);
                    if ($input_value) {
                        $result = $this->checkFromDatabase($input_name, $input_value);
                        echo $result;
                    } else {
                        echo ("This is not a valid login");
                    }
                }
            }
            die;
        } else {
            if(isset($_POST['register_me'])){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $result = $this->filterDataBeforeRegistration($_POST);
                if($result === true){
                    $userModel = $this->model('users');
                    $queryResult = $userModel->register($this->email, $this->login, $this->password, $this->name);
                    if($queryResult === true){
                        redirect(HOME_DIR);
                    }
                }
                $_SESSION['error'] = $queryResult;
                redirect(HOME_DIR . '/register');
            }
            $this->view('register');
        }
    }

    public function logout(){
        unset($_SESSION['email']);
        unset($_SESSION['name']);
        session_destroy();
        redirect(HOME_DIR);
    }


    private function filterDataBeforeRegistration($array){

        $errors = [];

        if(isset($array['email'])){
            $this->email = filter_var($array['email'], FILTER_SANITIZE_EMAIL);
            if (empty($this->email)) {
                $errors['email_error'] = "Email is empty";
            }
        }
        
        if(isset($array['login'])){
            $this->login = filter_var($array['login'], FILTER_SANITIZE_STRING);
            if (empty($this->login)) {
                $errors['login_error'] = "Login is empty";
            }
        }
        if(isset($array['password'])){
            $this->password = filter_var($array['password']);
            if(empty($this->password)){
                $errors['password_error'] = "Password is empty";
            }
        }
        if(isset($array['password_confirm'])){
            $this->password_confirm = filter_var($array['password_confirm']);
            if(empty($this->password_confirm)){
                $errors['password_confirm_error'] = "Password confirm field is empty";
            }
        }
        if(isset($array['password']) && isset($array['password_confirm'])){
            if($this->password !== $this->password_confirm){
                $errors['password_confirm_error'] = "Password and Password confirm field is empty";
            }
        }
        if(isset($array['name'])){
            $this->name = filter_var($array['name'], FILTER_SANITIZE_STRING);
            if(empty($this->name)){
                $errors['name_error'] = "Password and Password confirm field is empty";
            }
        }

        if(!empty($errors)){
            return $errors;
        }

        return true;
    }

    private function checkFromDatabase($input_name, $input_value)
    {
        $userModel = $this->model('users');

        if($input_name === "email"){
            $result = [
                'type' => 'email', 
                'answer' => $userModel->checkEmailExist($input_value)
            ];
            return \json_encode($result);
        }
        elseif($input_name === "login"){
            $result = [
                'type' => 'login',
                'answer' => $userModel->checkLoginExist($input_value)
            ];
            return \json_encode($result);
        }
    }


}