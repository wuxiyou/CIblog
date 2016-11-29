<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    /**
     * 登录页面渲染
     */
    public function index()
    {
        list($usec, $sec) = explode(" ", microtime());
        $usec = $usec = intval($usec * 1000000);
        $usec = sprintf('%06d', $usec);
        echo $usec;exit;
        $this->load->view('admin/user_index');
    }

    public function login()
    {
        $data['user_name'] = $this->input->post('userName', true);
        $data['password'] = $this->input->post('password', true);
    }

    public function test()
    {
        try {
            $this->load->library('auth');
            $this->auth->test();
        } catch (Exception $e) {
            $json = array(
                'success' => false,
                'message' => $e->getMessage()
            );
        }
        echo json_encode($json);
        return false;
    }

}