<?php

namespace config;

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

use \PDO;

class HWF_Model{

    public function __construct(){
        //$this->establishConnection();
    }

    protected function establishConnection(){
        try {
            $dbh = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, array(
                PDO::ATTR_PERSISTENT => true
            ));
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die('problem with database!');
        }
    }

    public function selectAll($tableName)
    {

    }

    public function getBy($parameter, $orderBy = "ID DESC")
    {

    }
}