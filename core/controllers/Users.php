<?php
namespace controllers;

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');


class Users extends \config\HWF_Controller
{


    public function login()
    {
        if ($this->isAjax()) {

        } else {
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
            //print_arr($_POST);
            $this->view('register');
        }
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