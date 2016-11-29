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
     * 获取单篇文章
     */
    public function getRow($id)
    {
        $article_info = $this->db->select('id, title')->where(array('id' => $id))->get(self::TABLE_NAME, 1)->row_array();
        $review_info = $this->db->eee()->where(array('article_id' => $id))->get('review')->result_array();
    }
}