<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    const table = "user";

    /**
     * @param array     $data     注册参数
     * @param string    $data['user_name']   用户昵称
     * @param string    $data['password']    用户密码
     * @param string    $data['salt']        密码字符串
     * @return bool
     */
    public function saveUser($data)
    {
        $resInfo = $this->db->select('id')->from(self::table)->where(array('user_name' => $data['user_name']))->get()->row_array();

        if (!empty($resInfo)) {
            return $code = '-1001';  //说明该用户名已被注册
        }

        return $this->db->insert(self::table, $data);
    }

    public function login($data)
    {

        $resInfo = $this->db->select('id, salt')
            ->from(self::table)
            ->where(array('user_name' => $data['user_name'], 'status' => 1, 'deleted' => 0))
            ->get()
            ->row_array();
        if (empty($resInfo)) {
            return $code = '-1002';  // 用户不存在
        }
        $password = md5($data['password'].$resInfo['salt']);
        $res = $this->db->select('id')
            ->from(self::table)
            ->where(array('user_name' => $data['user_name'], 'password' => $password, 'status' => 1, 'deleted' => 0))
            ->get()
            ->row_array();
        return $res;
    }
}