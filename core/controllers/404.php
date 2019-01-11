<?php

namespace controllers;

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

class PageNotFound extends HWF_Controller{

    public function Index(){
        $this->view('404');
    }

}
 