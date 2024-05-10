<?php

class Uploadtespelamar_model extends CI_Model
{
    public function ambilUser()
    {
        return $this->db->get_where('recruitment___pelamar', ['id_pelamar' => $this->session->userdata('id_pelamar')])->row_array();
    }
    public function getAllhasiltes()
    {
        // return $this->db->get('data_karyawan')->result_array();
        $this->db->select('*');
        $this->db->from('recruitment___hasiltes');
        return  $this->db->get()->result_array();
    }
    public function download($file)
    {
        $query = $this->db->get_where('recruitment___pelamar', array('file_cv' => $file));
        return $query->row_array();
    }
}
