<?php

class Datapelamar_model extends CI_Model
{
    public function getAllDatapelamar()
    {
        return $this->db->get('data_pelamar')->result_array();
    }
    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('data_pelamar');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}
