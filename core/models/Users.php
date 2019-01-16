<?php

use \PDO as PDO;
use \PDOException as PDOException;

class Users extends config\HWF_Model

{
    // private $db;

    // public function __construct()
    // {
    //     $this->db = $this->establishConnection();
    // }

    public function checkEmailExist($email)
    {
      $result = $this->db->prepare('SELECT * FROM users WHERE `email` = ?');
      $result->execute([$email]);
      if($result){
          $count = $result->rowCount();
          return $count;
      }
    }

    public function checkLoginExist($login)
    {
        $result = $this->db->prepare('SELECT * FROM users WHERE `login` = ?');
        $result->execute([$login]);
        if ($result) {
            $count = $result->rowCount();
            return $count;
        }

    }


    public function register($email, $login, $password, $name){
        $user_exist = $this->checkLoginExist($login);
        $error = [];
        if($user_exist === 1){
            $error['error_login'] = "Login is exist, please choose another one";
        }
        $user_exist = $this->checkEmailExist($email);
        if($user_exist === 1){
            $error['error_email'] = "Email is exist, please choose another one";
        }
        if(!empty($error)) return $error;
        $password = password_hash($password, PASSWORD_BCRYPT);
        $result = $this->db->prepare('INSERT INTO users (`email`, `login`, `password`, `name`) VALUES (?,?,?,?)');
        if($result->execute([$email, $login, $password, $name])){
            $user_id = $this->db->lastInsertId();
            $this->createUserSession($email, $user_id);
            return true;
        }
        else{
            $error['error_general'] = "SOME SQL ERROR";
            return $error;
        }
            
    }

    private function createUserSession($email, $id, $status = 1){
      $_SESSION['email'] = $email;
      $_SESSION['user_id'] = $id;
      $_SESSION['status'] = $status;
    }

    public function authorization($email, $password){
        $result = $this->db->prepare('SELECT * FROM users WHERE `email` = ?');
        $result->execute([$email]);
        if ($result) {
            $count = $result->rowCount();
            if ($count > 0) {
                $row = $result->fetch();
                $user_id = $row['id'];
                $db_pass = $row['password'];
                $status = $row['status'];
                if(password_verify($password, $db_pass)) {
                    $this->createUserSession($email, $user_id, $status);
                    return true;
                }
            }
            return false;
        }
    }
} 