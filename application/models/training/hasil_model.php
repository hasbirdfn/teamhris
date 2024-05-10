<?php
defined('BASEPATH') or exit('no direct script access allowed');

class hasil_model extends CI_Model
{
    public function get_peserta($id_karyawan)
    {
        $this->db->select('*');
        $this->db->from('tb_peserta');
        $this->db->join('data_posisi', 'tb_peserta.id_posisi=data_posisi.id_posisi');
        $this->db->join('data_karyawan', 'tb_peserta.id_karyawan=data_karyawan.id_karyawan');
        $this->db->where('data_karyawan.id_karyawan', $id_karyawan);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_peserta2($id)
    {
        $this->db->select('*');
        $this->db->from('tb_peserta');
        $this->db->join('data_posisi', 'tb_peserta.id_posisi=data_posisi.id_posisi');
        $this->db->join('tb_jenis_ujian', 'tb_peserta.id_jenis_ujian=tb_jenis_ujian.id_jenis_ujian');
        $this->db->join('data_karyawan', 'tb_peserta.id_karyawan=data_karyawan.id_karyawan');
        $this->db->where('tb_peserta.id_posisi', $id);
        $this->db->order_by('nilai', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_peserta3()
    {
        $this->db->select('*');
        $this->db->from('tb_peserta');
        $this->db->join('data_posisi', 'tb_peserta.id_posisi=data_posisi.id_posisi');
        $this->db->join('tb_jenis_ujian', 'tb_peserta.id_jenis_ujian=tb_jenis_ujian.id_jenis_ujian');
        $this->db->join('data_karyawan', 'tb_peserta.id_karyawan=data_karyawan.id_karyawan');
        $this->db->order_by('nilai', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function cetak($id)
    {
        $this->db->select('*');
        $this->db->from('tb_peserta');
        $this->db->join('data_posisi', 'tb_peserta.id_posisi=data_posisi.id_posisi');
        $this->db->join('tb_jenis_ujian', 'tb_peserta.id_jenis_ujian=tb_jenis_ujian.id_jenis_ujian');
        $this->db->join('data_karyawan', 'tb_peserta.id_karyawan=data_karyawan.id_karyawan');
        $this->db->where('tb_peserta.id_peserta', $id);
        $query = $this->db->get();
        return $query->result();
    }
}
