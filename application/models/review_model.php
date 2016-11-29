<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review_model extends CI_Model
{
    const TABLE_NAME = 'review';

    /**
     * @param $data
     * @return mixed
     */
    public function saveInfo($data)
    {
       return $this->db->insert(self::TABLE_NAME, $data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getRow($id)
    {
        return $this->db->select()->from(self::TABLE_NAME)->where(array('id' => $id))->get()->row_array();
    }

    /**
     * @return mixed
     */
    public function getRows()
    {
        return $this->db->select()->from(self::TABLE_NAME)->where(array('deleted' => 0))->get()->result_array();
    }
}