<?php
defined('BASEPATH') or exit('no direct script access allowed');

class peserta_model extends CI_Model
{
    public function get_joinpeserta($id)
    {
        $this->db->select('*');
        $this->db->from('tb_peserta');
        $this->db->join('data_posisi', 'tb_peserta.id_posisi=data_posisi.id_posisi');
        $this->db->join('data_karyawan', 'tb_peserta.id_karyawan=data_karyawan.id_karyawan');
        $this->db->join('tb_jenis_ujian', 'tb_peserta.id_jenis_ujian=tb_jenis_ujian.id_jenis_ujian');
        $this->db->where('tb_peserta.id_peserta', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_peserta($idkelas, $idkaryawan)
    {
        $array = array('tb_kelas.id_kelas' => $idkelas, '.id_karyawan' => $idkaryawan);
        $this->db->select('*');
        $this->db->from('tb_peserta');
        $this->db->join('data_posisi', 'tb_peserta.id_posisi=data_posisi.id_posisi');
        $this->db->join('data_karyawan', 'tb_peserta.id_karyawan=data_karyawan.id_karyawan');
        $this->db->join('tb_jenis_ujian', 'tb_peserta.id_jenis_ujian=tb_jenis_ujian.id_jenis_ujian');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas=data_posisi.id_kelas', 'left');
        $this->db->where($array);
        $this->db->order_by('id_peserta', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function get_peserta2($idkelas)
    {
        $this->db->select('*');
        $this->db->from('tb_peserta');
        $this->db->join('data_posisi', 'tb_peserta.id_posisi=data_posisi.id_posisi');
        $this->db->join('data_karyawan', 'tb_peserta.id_karyawan=data_karyawn.id_karyawan');
        $this->db->join('tb_jenis_ujian', 'tb_peserta.id_jenis_ujian=tb_jenis_ujian.id_jenis_ujian');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas=data_karyawan.id_kelas', 'left');
        $this->db->where('tb_kelas.id_kelas', $idkelas);
        $this->db->order_by('id_peserta', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function get_peserta3($idkaryawan)
    {
        $this->db->select('*');
        $this->db->from('tb_peserta');
        $this->db->join('data_posisi', 'tb_peserta.id_posisi=data_posisi.id_posisi');
        $this->db->join('data_karyawan', 'tb_peserta.id_karyawan=data_karyawan.id_karyawan');
        $this->db->join('tb_jenis_ujian', 'tb_peserta.id_jenis_ujian=tb_jenis_ujian.id_jenis_ujian');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas=data_karyawan.id_kelas', 'left');
        $this->db->where('data_karyawan.id_karyawan', $idkaryawan);
        $this->db->order_by('id_peserta', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function get_peserta4()
    {
        $this->db->select('*');
        $this->db->from('tb_peserta');
        $this->db->join('data_posisi', 'tb_peserta.id_posisi=data_posisi.id_posisi');
        $this->db->join('data_karyawan', 'tb_peserta.id_karyawan=data_karyawan.id_karyawan');
        $this->db->join('tb_jenis_ujian', 'tb_peserta.id_jenis_ujian=tb_jenis_ujian.id_jenis_ujian');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas=data_karyawan.id_kelas', 'left');
        $this->db->order_by('id_peserta', 'DESC');
        $query = $this->db->get();
        return $query;
    }
}
