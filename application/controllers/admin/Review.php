<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('review_model');
    }

    /**
     * 列表信息
     */
    public function listInfo()
    {

    }

    /**
     * 编辑
     */
    public function edit()
    {

    }

    /**
     * 删除->删除及其下级的所有评论
     */
    public function deletedInfo()
    {
        $id = (int)$this->input->post('id', true);
    }
}