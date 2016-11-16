<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Auth
 * 登录验证
 */
class Auth
{
    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('session');  //加载session
        $this->CI->load->helper('url');
        $this->CI->load->model('user_model');
    }

    /**
     * 登录控制器验证
     */
    public function loginValidate($data)
    {
        $user_name = $this->CI->session->userdata('user_name');
        if (!empty($user_name)) {
            site_url();  //已登录的  跳转到首页
        }

        if (empty($data) || !is_array($data)) {
            return array('success' => false, 'message' => '参数错误!');
        }

        if (empty($data['user_name']) || empty($data['password'])) {
            return array('success' => false, 'message' => '用户名或密码不能为空!');
        }

        $res = $this->CI->user_model->login($data);

        if ($res == 1002 || empty($res)) {
            return array('success' => false, 'message' => '该用户不存在!');
        }
        $this->CI->session->set_userdata('user_name', $data['user_name']);
        return true;
    }

    /**
     * 注册验证
     */
    public function registerValidate($data)
    {
        if (empty($data) || !is_array($data)) {
            return array('success' => false, 'message' => '参数错误');
        }

        if (empty($data['user_name']) || empty($data['password'])) {
            return array('success' => false, 'message' => '用户昵称或密码不能为空!');
        }

        $length = (strlen($data['user_name']) + mb_strlen($data['user_name'], 'utf-8')) /2;
        if ($length > 25) {
            return array('success' => false, 'message' => '用户昵称不能超过25个字符!');
        }
        $hash = $this->passwordSalt(8);
        $insert_data = array(
            'user_name' => strip_tags($data['user_name']),
            'password' => md5($data['password'].$hash),
            'salt' => $hash
        );
        $res = $this->CI->user_model->saveUser($insert_data);
        if ($res == '-1001') {
            return array('该昵称已被注册, 请更换另一个名称!');
        } elseif (!$res) {
            return array('注册失败!');
        } else {
            return true;
        }

    }

    /**
     * 生成随机的字符串
     *
     * @param int $length  字符串长度
     * @return string
     */
    private function passwordSalt($length = 6)
    {
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $returnStr = '';
        $max = count($length - 1);
        for ($i = 0; $i < $length; $i++) {
            $returnStr .= $str[rand(0, $max)];
        }

        return $returnStr;
    }
}