<?php

use \PDO as PDO;
use config\HWF_Model as HWF_Model;

class Users extends HWF_Model

{

    /**
     * Check if email exists in database
     * @param string $email
     * @return bool|int
     */
    public function checkEmailExist(string $email)
    {
      $result = $this->db->prepare('SELECT * FROM users WHERE `email` = ?');
      $result->execute([$email]);
      if($result){
          $count = $result->rowCount();
          return $count;
      }
      return false;
    }

    /**
     * Check if login exists in database
     * @param string $login
     * @return bool|int
     */
    public function checkLoginExist(string $login)
    {
        $result = $this->db->prepare('SELECT * FROM users WHERE `login` = ?');
        $result->execute([$login]);
        if ($result) {
            $count = $result->rowCount();
            return $count;
        }
        return false;

    }


    /**
     * User Registration
     * @param string $email
     * @param string $login
     * @param string $password
     * @param string $name
     * @return array|bool
     */
    public function register(string $email, string $login, string $password, string $name)
    {
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

    /**
     * Creating user session
     * @param string $email
     * @param int $id
     * @param int $status
     */
    private function createUserSession(string $email, int $id, int $status = 1):void
    {
      $_SESSION['email'] = $email;
      $_SESSION['user_id'] = $id;
      $_SESSION['status'] = $status;
    }

    /**
     * Authorization
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function authorization(string $email, string $password):bool
    {
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


    /**
     * Get current logged user credentials
     * @return array|bool
     */
    public function get_current_user_credentials(){
        if(!is_logged_in()) return false;
        $user_id = get_current_user_id();
        if(!$user_id) return false;
        $query = $this->db->prepare("SELECT * from `users` WHERE id = ?");
        $query->execute([$user_id]);
        if(!$result = $query->fetchAll(PDO::FETCH_ASSOC)) return false;
        return $result;
    }
} 