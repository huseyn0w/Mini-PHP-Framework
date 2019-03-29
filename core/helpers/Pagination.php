<?php

namespace helpers;

defined('EXTERNAL_ACCESS') or die('EXTERNAL ACCESS DENIED!');

class Pagination extends \config\HWF_Controller{

    private $currentPage = 1;

    public function __construct()
    {
        $string = implode('/', $_GET);
        $array = [];
        $array = explode('/', $string);
        if (isset($array[1]) && $array[1] == 'page') {
            if (isset($array[2])) {
                $this->currentPage = (int)$array[2];
                if ($this->currentPage == 0) {
                    $this->currentPage = 1;
                }
            } 
            else {
                $this->currentPage = 1;
            }

        } 
        else {
            $this->currentPage = 1;
        }

        
    }

    public function renderPagination()
    {
        $userModel = $this->model('pagination');
        $totalPageCount = $userModel->pageCount();

        $paginationData = [
            'activePage' => $this->currentPage,
            'totalPageCount' => $totalPageCount
        ];


        $this->view('tasks/pagination', $paginationData);
    }

    public function getCurrentPage(){
        return $this->currentPage;
    }



}