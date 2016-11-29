<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model
{
    const TABLE_NAME = 'category';
    public function getRows()
    {
        return $this->db->select('id,title')->from(self::TABLE_NAME)->where(array('deleted' => 0))->get()->result_array();
    }

    public function save($data)
    {
        return $this->db->insert(self::TABLE_NAME, $data);
    }

    public function updateInfo($data)
    {
        if (empty($data['id']) && !filter_var($data['id'], FILTER_VALIDATE_INT)) return false;
        return $this->db->update(self::TABLE_NAME, $data, array('id' => $data['id']));
    }

    public function getRow($id)
    {
        if (empty($id)) return false;
        return $this->db->select('id, title')->from(self::TABLE_NAME)->where(array('id' => intval($id)))->get()->row_array();
    }
}