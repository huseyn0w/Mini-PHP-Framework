<?php

namespace controllers;

use config\HWF_Controller as HWF_Controller;

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

class PageNotFound extends HWF_Controller{

    /**
     * Return 404 Page not found template
     */
    public function Index(){
        $this->view('404');
    }

}
 