<?php

namespace config;


defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

use \PDO as PDO;
use \PDOException as PDOException;

class HWF_Model{

    public function __construct(){
        $this->establishConnection();
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

    }

    

    public function selectAll($tableName)
    {

    }

    public function getBy($parameter, $orderBy = "ID DESC")
    {

    }
}