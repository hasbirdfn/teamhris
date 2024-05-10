<?php

class SoalKuesioner_model extends CI_Model {
    public function getAllSoalKuesioner() 
    {
        return $this->db->get('soal_kuesioner')->result_array();
    }
    public function tambahSoalKuesioner()
    {
        $data = [
            'kuesioner' => $this->input->post('kuesioner'),
        ];
        $this->db->insert('soal_kuesioner', $data);
    }

    public function ubahSoalKuesioner()
    {
        $data = [
            "kuesioner" => $this->input->post('kuesioner', true),
        ];

        $this->db->where('id_kuesioner', $this->input->post('id_kuesioner'));
        $this->db->update('soal_kuesioner', $data);
    }

    public function hapus($id_kuesioner)
    {
        $this->db->where('id_kuesioner', $id_kuesioner);
        $this->db->delete('soal_kuesioner');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}