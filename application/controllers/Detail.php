<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }
    public function index()
    {
        //视图渲染
    }

    /**
     *
     */
    public function singleInfo()
    {

    }
}