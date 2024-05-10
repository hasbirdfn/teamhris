<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenilaianKuesioner extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('dompdf_gen');
        $this->load->model('performances/PenilaianKuesioner_model');
        $this->load->model('SoalKuesioner_model');
        $this->load->model('DataKaryawan_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('Hris_model');
        if (!$this->session->userdata('nik')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        // printr($_SESSION);
        $data['title'] = "Penilaian Kuesioner";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }

        $data['penilaiankuesioner'] = $this->db->query(
            "SELECT 
        pk.id_penilaian_kuesioner,
        pk.nik_penilai,
        pk.nik_menilai,
        dk_a.nama_karyawan AS nama_karyawan_penilai,
        dk_b.nama_karyawan AS nama_karyawan_menilai,
        pk.tanggal,
        pk.total_nilai,
        pk.saran,
        pk.total_soal
        FROM performances___penilaian_kuesioner pk
        INNER JOIN data_karyawan dk_a ON pk.nik_penilai = dk_a.nik 
        INNER JOIN data_karyawan dk_b ON pk.nik_menilai = dk_b.nik
        WHERE pk.tanggal='$bulantahun' 
        ORDER BY pk.nik_penilai"
        )->result_array();



        // $data['penilaiankuesioner'] = $this->PenilaianKuesioner_model->tampilPenilaianKuesioner();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['user'] = $this->Hris_model->ambilUser();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        // $data['penilaiankuesioner'] = $this->PenilaianKuesioner_model->tampilPenilaianKuesioner();

        // printr($data);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/penilaiankuesioner', $data);
        $this->load->view('templates/footer');
    }


    public function detail($id)
    {
        $data['title'] = 'Detail Kuesioner';
        $data['saran'] = $this->db->query("SELECT pk.saran FROM performances___penilaian_kuesioner pk
         WHERE pk.id_penilaian_kuesioner = '$id'")->row()->saran;
        $data['detailkuesioner'] = $this->db->query("SELECT
        dpk.id_kuesioner,
        sk.kuesioner, 
        dpk.id_penilaian_kuesioner,
        dpk.nik_penilai,
        dpk.nik_menilai,
        dpk.tanggal,
        dpk.nilai
        FROM performances___detail_penilaian_kuesioner dpk
        INNER JOIN soal_kuesioner sk ON sk.id_kuesioner = dpk.id_kuesioner
        WHERE dpk.id_penilaian_kuesioner = '$id'        
        ")->result_array();
        // printr($data['detailkuesioner']);
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['user'] = $this->Hris_model->ambilUser();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/detailkuesioner', $data);
        $this->load->view('templates/footer');
    }

    public function hapus($id)
    {
        if ($this->PenilaianKuesioner_model->hapus($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('Performances/PenilaianKuesioner');
    }

    public function cetakKuesioner()
    {
        $data['title'] = "Penilaian Kuesioner";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }

        $data['cetak_kuesioner'] = $this->PenilaianKuesioner_model->cetakKuesioner($bulantahun);
        $this->load->view('templates/header', $data);
        $this->load->view('performances/cetak_kuesioner', $data);
        // $this->session->set_flashdata('message', ' Berhasil Cetak PDF!');
        // redirect('performances/penilaiankinerja');
    }


}