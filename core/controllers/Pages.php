<?php
defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

class Pages extends Controller{

    public function Index(){
        $this->view('index');
    }
}
 