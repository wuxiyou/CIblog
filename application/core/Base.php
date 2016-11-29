<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Base  控制器基类
 */
class Base extends CI_Controller
{
    protected $my_config = array();
    protected $curr_user = array();

    public function __construct()
    {
        parent::__construct();

        $this->load->vars('my_config', $this->my_config);
        $this->load->vars('curr_user', $this->curr_user);
    }
}