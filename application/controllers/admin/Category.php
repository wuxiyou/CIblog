<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
    }

    public function index()
    {
        $this->load->view();
    }

    public function categoryList()
    {

    }

    public function save()
    {
        try {
            $data['title'] = $this->input->post('title', true);
            $data['sort'] = (int)$this->input->post('sort', true);
            $id = (int)$this->input->post('id');
            $operate_type = $this->input->post('operate_type');

            if (empty($data['title'])) {
                throw new Exception('分类标题不能为空!');
            }
            $this->load->library('validate');
            $res = validate::length($data['title'], 25);
            if (!$res) {
                throw new Exception('分类名称不能超过25个中文!');
            }
            if (empty($id) && $operate_type == 'save') {
                $saveRes = $this->category_model->save($data);
                if (!$saveRes) {
                    throw new Exception('添加失败!');
                }
            } elseif (!empty($id) && $operate_type == 'edit') {
                $data['id'] = $id;
                $this->category_model->updateOne($data);
            } else {
                throw new Exception('操作错误!');
            }
            $json = array('success' => true, 'message' => '操作失败!');
        } catch (Exception $e) {
            $json = array('success' => false, 'message' => $e->getMessage());
        }

        echo json_encode($json);
        return false;
    }

    public function edit()
    {
        
    }
}