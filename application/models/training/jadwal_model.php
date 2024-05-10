<?php
defined('BASEPATH') or exit('no direct script access allowed');

class jadwal_model extends CI_Model
{
    public function jadwal_ujian()
    {
        $this->db->select('*');
        $this->db->from('tb_peserta');
        $this->db->join('data_posisi', 'tb_peserta.id_posisi=data_posisi.id_posisi');
        $this->db->join('data_karyawan', 'tb_peserta.id_karyawan=data_karyawan.id_karyawan');
        $this->db->where('tb_peserta.id_peserta', $id);
        $query = $this->db->get();
        return $query->result();
    }
}
