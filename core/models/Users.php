<?php

use \PDO as PDO;
use \PDOException as PDOException;

class Users extends config\HWF_Model

{
    private $db;

    public function __construct()
    {
        $this->db = $this->establishConnection();
    }

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
} 