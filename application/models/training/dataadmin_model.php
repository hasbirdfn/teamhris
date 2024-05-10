<?php

class dataadmin_model extends CI_Model
{
    public function getAllDataadmin()
    {
        // return $this->db->get('data_karyawan')->result_array();
        $this->db->select('*');
        $this->db->from('data_keseluruhan');
        return $this->db->get()->result_array();
    }
}
