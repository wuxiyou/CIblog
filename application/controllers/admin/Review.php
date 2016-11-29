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
        $list = $this->review_model->getRows();
        echo json_encode($list);
        return false;
    }

    /**
     * 编辑
     */
    public function edit()
    {
        try {
            $id = (int)$this->inpu->post('id', true);
            if (empty($id)) {
                throw new Exception('无效操作!');
            }
            $json['info'] = $this->review_model->getRow($id);
            $json['success'] = true;
        } catch (Exception $e) {
            $json = array('success' =>false, 'message' => $e->getMessage());
        }
        echo json_encode($json);
        return false;
    }

    /**
     * 删除->删除及其下级的所有评论
     */
    public function deletedInfo()
    {
        try {
            $id = (int)$this->input->post('id', true);
            if (empty($id)) {
                throw new Exception('无效操作!');
            }
        } catch(Exception $e) {

        }

    }
}