<?php
defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

class PageNotFound extends Controller{

    public function Index(){
        $this->view('404');
    }

}
 