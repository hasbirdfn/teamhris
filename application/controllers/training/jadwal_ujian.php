<?php
defined('BASEPATH') or exit('No direct script access allowed');

class jadwal_ujian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('training/peserta_model');
        $this->load->model('training/m_data');
        $this->load->model('Hris_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('DataKaryawan_model');
    }

    public function index()
    {
        $data['title'] = '';
        $data['user'] = $this->Hris_model->ambilUser();
        $data['peserta'] = $this->db->query('SELECT *  FROM tb_peserta, data_karyawan, data_posisi, tb_jenis_ujian WHERE tb_peserta.id_jenis_ujian=tb_jenis_ujian.id_jenis_ujian and tb_peserta.id_posisi=data_posisi.id_posisi and tb_peserta.id_karyawan=data_karyawan.id_karyawan' . $this->session->userdata('nama') . ' ')->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('training/jadwal_ujian', $data);
        $this->load->view('templates/footer');
    }
}
// $data['peserta'] = $this->db->query('SELECT tb_peserta.id_peserta, data_posisi.kode, data_posisi.nama_posisi, data_posisi.id_posisi, data_karyawan.nama_karyawan, data_karyawan.nik, tanggal_ujian, jam_ujian, durasi_ujian, tb_jenis_ujian.jenis_ujian, status_ujian  FROM tb_peserta, data_posisi, data_karyawan, tb_jenis_ujian WHERE tb_peserta.id_jenis_ujian=tb_jenis_ujian.id_jenis_ujian and tb_peserta.id_posisi=data_posisi.id_posisi and tb_peserta.id_karyawan=data_karyawan.id_karyawan and data_karyawan.nama_karyawan="' . $this->session->userdata('nama') . '" ')->result();