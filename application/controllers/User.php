<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    /**
     * 登录页面渲染
     */
    public function index()
    {
        $this->load->view('admin/user_index');
    }

    public function login()
    {
        $data['user_name'] = $this->input->post('userName', true);
        $data['password'] = $this->input->post('password', true);
    }

}