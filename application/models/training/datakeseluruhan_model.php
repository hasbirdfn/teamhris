<?php

class datakeseluruhan_model extends CI_Model
{
    public function getAlldatakeseluruhan()
    {
        // return $this->db->get('data_karyawan')->result_array();
        $this->db->select('*');
        $this->db->from('data_keseluruhan');
        return $this->db->get()->result_array();
    }

    public function tambahdatakeseluruhan($dokumen)
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'kategori' => htmlspecialchars($this->input->post('kategori')),
            'ulasan' => htmlspecialchars($this->input->post('ulasan')),
            'file' => $dokumen,

        ];
        $this->db->insert('data_keseluruhan', $data);
    }

    public function ubahDatakeseluruhan()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'kategori' => htmlspecialchars($this->input->post('kategori')),
            'ulasan' => htmlspecialchars($this->input->post('ulasan')),
            'file' => htmlspecialchars($this->input->post('dokumen')),

        ];

        $this->db->where('id_keseluruhan', $this->input->post('id_keseluruhan'));
        $this->db->update('data_keseluruhan', $data);
    }
    public function download($file)
    {
        $query = $this->db->get_where('data_keseluruhan', array('file' => $file));
        return $query->row_array();
    }

    public function hapus($id_keseluruhan)
    {
        $this->db->where('id_keseluruhan', $id_keseluruhan);
        $this->db->delete('data_keseluruhan');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}
