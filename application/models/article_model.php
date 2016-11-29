<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_model extends CI_Model
{
    const TABLE_NAME = 'article';
    public function saveInfo($data)
    {
        return $this->db->insert(self::TABLE_NAME, $data);
    }

    /**
     * 获取单篇文章及其评论
     */
    public function getRow($id, $type)
    {
        $review_info = array();
        $article_info = $this->db->select('id, title')->where(array('id' => $id))->get(self::TABLE_NAME, 1)->row_array();
        if ($type == 1) {
            $review_info = $this->db->where(array('article_id' => $id))->get('review')->result_array();
        }
        return $info = array(
            'article' => $article_info,
            'review' => $review_info
        );
    }
}