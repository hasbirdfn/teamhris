<?php

class Lihatnilai_model extends CI_Model
{
    public function getAllLihatnilai()
    {

        $this->db->select('*');
        $this->db->from('data_nilai');
        // return $this->db->get('data_karyawan')->result_array();
        $this->db->join('data_karyawan', 'data_karyawan.id_karyawan = data_nilai.id_karyawan');
        return $this->db->get()->result_array();
    }
    public function getAllnilai()
    {

        $this->db->select('*');
        $this->db->from('data_nilai');
        // return $this->db->get('data_karyawan')->result_array();
        $this->db->join('data_karyawan', 'data_karyawan.id_karyawan = data_nilai.id_karyawan');
        $this->db->where('data_nilai.id_karyawan', $this->session->userdata('id_karyawan'));
        return $this->db->get()->result_array();
    }
    public function tambahLihatnilai()
    {
        $data = [
            'id_karyawan' => htmlspecialchars($this->input->post('nama karyawan')),
            'kalkulasi_nilai' => htmlspecialchars($this->input->post('kalkulasi nilai')),
            // 'id_jenis_ujian' => htmlspecialchars($this->input->post('jenis ujian')),
            // 'durasi_ujian' => htmlspecialchars($this->input->post('durasi ujian')),
            // 'sertifikat' => $filename,
            // 'file_jawaban' => $filename,

        ];
        $this->db->insert('data_nilai', $data);
    }

    public function ubahDatanilai($data)
    {
        $data = [
            'nama_karyawan' => htmlspecialchars($this->input->post('nama')),
            'id_posisi' => htmlspecialchars($this->input->post('posisi')),
            'kalkulasi_nilai' => htmlspecialchars($this->input->post('tanggal ujian')),
            'sertifikat' => htmlspecialchars($this->input->post('sertifikat')),
            // 'file_jawaban' => htmlspecialchars($this->input->post('dokumen_jawaban')),

        ];

        $this->db->where('id_nilai', $this->input->post('id_nilai'));
        $this->db->update('data_nilai', $data);
    }
    public function download($file)
    {
        $query = $this->db->get_where('data_nilai', array('file' => $file));
        return $query->row_array();
    }

    public function hapus($id_nilai)
    {
        $this->db->where('id_nilai', $id_nilai);
        $this->db->delete('data_nilai');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}