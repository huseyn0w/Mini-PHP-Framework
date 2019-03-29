<?php

namespace config;


defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

use \PDO as PDO;
use \PDOException as PDOException;

class HWF_Model{

    protected $db;

    public function __construct(){
        $this->db = $this->establishConnection();
    }

    protected function establishConnection(){

        try {
            $dbh = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $file = $e->getFile();
            $message = $e->getMessage();
            $line = $e->getLine();
            $errorArray = [
                [
                    'type' => 'PDO Exception',
                    'message' => $message,
                    'filename' => $file,
                    'line' => $line,
                ]
            ];
            $debug = new HWF_ErrorHandler;
            $debug->debugHandler($errorArray);
            exit;
        }
        return $dbh;

    }

    public function create()
    {

    }

    public function read()
    {

    }

    public function update()
    {

    }

    public function delete($data, $tableName)
    {

    }

    public function customQuery($query){

    }

    public function selectAll($tableName)
    {

    }

    public function get_By($parameter, $orderBy = "ID DESC")
    {

    }

    public function select($data, $tableName)
    {

    }


    public function selectCount()
    {
        
    }
}