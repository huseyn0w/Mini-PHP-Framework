<?php
namespace controllers;

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');


class Users extends \config\HWF_Controller
{
    protected $email, $login, $password, $password_confirm, $name;


    public function login()
    {
        if ($this->isAjax()) {

        } else {
            if (isset($_POST['login_me'])) {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $result = $this->filter_data($_POST);

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

                $result = $this->filter_data($_POST);

                if(is_array($result) && !empty($result)){
                    $_SESSION['error'] = $result;
                    redirect(HOME_DIR . '/register');
                }

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