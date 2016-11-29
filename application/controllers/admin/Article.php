<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('article_model');
        $this->load->library('validate');
    }

    /**
     * 视图渲染
     */
    public function index()
    {
        $this->load->view('');
    }

    /**
     * 文章列表
     */
    public function articleList()
    {
        $list = $this->category_model->getRows();
        echo json_encode($list);
        return false;
    }

    /**
     * 保存
     */
    public function saveArticle()
    {
        try {
            $data['category_id'] = (int)$this->input->post('category_id', true);
            $data['title'] = $this->input->post('title', true);
            if (empty($data['title'])) {
                throw new Exception('标题不能为空!');
            }
            $res = validate::length($data['title'], 25);
            if (!$res) {
                throw new Exception('文章标题不能超过25个中文字符!');
            }
            $data['comment'] = $this->input->post('comment');
            $data['is_top'] = (int)$this->input->post('is_top');  //是否置顶
            $id = (int)$this->input->post('id');
            $operate_type = $this->input->post('operate_type');
            if (empty($id) && $operate_type == 'save') {
                $this->article_m->saveInfo($data);
            } elseif (!empty($id) && $operate_type == 'edit') {
                $data['id'] = $id;
                $this->article_m->updateInfo($data);
            } else {
                throw new Exception('操作异常!');
            }
            $json = array('success' => true, 'message' => '操作成功!');
        } catch (Exception $e) {
            $json = array('success' => false, 'message' => $e->getMessage());
        }
        echo json_encode($json);
        return false;
    }

    /**
     * 编辑
     */
    public function editInfo()
    {
        try {
            $id = (int)$this->input->post('id');
            if (empty($id)) {
                throw new Exception('无效请求!');
            }
            $row = $this->article_m->getRow($id);
            $json = array('success' => true, 'info' => $row);
        } catch (Exception $e) {
            $json = array('success' => false, 'message' => $e->getMessage());
        }
        echo json_encode($json);
        return false;
    }
}