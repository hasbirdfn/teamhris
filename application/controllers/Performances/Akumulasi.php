<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akumulasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('dompdf_gen');
        $this->load->model('performances/Akumulasi_model');
        $this->load->model('performances/PenilaianKuesioner_model');
        $this->load->model('performances/PenilaianKinerja_model');
        $this->load->model('DataKaryawan_model');
        $this->load->model('Hris_model');

        if (!$this->session->userdata('nik')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['title'] = "Akumulasi Penilaian";
        $data['user'] = $this->Hris_model->ambilUser();

        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }
        $data['akumulasi'] = $this->db->query("
        SELECT 
            jk.id_jamkerja,
            dk.nik,
            dk.nama_karyawan,
            jk.tanggal,
            (
                SELECT 
                    CASE 
                        WHEN SUM(pk.total_nilai) > 4 THEN SUM(pk.total_nilai) / 4
                        ELSE SUM(pk.total_nilai)
                    END AS nilai_kuesioner
                FROM 
                    performances___penilaian_kuesioner pk 
                WHERE 
                    pk.nik_menilai = dk.nik AND pk.tanggal LIKE '%$bulantahun%'
            ) AS total_nilai_kuesioner,
            (
                SELECT COUNT(jk2.nik)
                FROM performances___inputjamkerja jk2 
                WHERE jk2.nik = jk.nik AND jk2.tanggal = '$bulantahun'
                GROUP BY jk2.tanggal, jk2.nik
            ) AS total_kinerja,

            (
                SELECT COUNT(jamker.keterangan) 
                FROM performances___inputjamkerja jamker  
                WHERE jamker.keterangan = 'Tepat Waktu' AND jamker.nik = jk.nik AND jamker.tanggal = '$bulantahun'
            ) AS waktu
        FROM 
            data_karyawan dk 
            INNER JOIN performances___inputjamkerja jk ON jk.nik = dk.nik
        WHERE 
            jk.tanggal LIKE '%$bulantahun%'
        GROUP BY 
            jk.tanggal, dk.nik
    ")->result_array();
        // printr($data);
        //     FROM 
        //         data_karyawan dk
        //         INNER JOIN performances___inputjamkerja jamker ON jamker.nik = dk.nik
        //     WHERE 
        //         jamker.tanggal LIKE '%$bulantahun'
        // ")->result_array();


        // printr($data);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/akumulasi_admin', $data);
        $this->load->view('templates/footer');

    }


    public function cetakAkumulasi()
    {
        $data['title'] = "Akumulasi Karyawan";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }

        $data['cetak_akumulasi_admin'] = $this->Akumulasi_model->cetakAkumulasi($bulantahun);
        // printr($data['cetak_akumulasi_admin']);
        $this->load->view('templates/header', $data);
        $this->load->view('performances/cetak_pdf_akumulasi', $data);
    }

    public function cetakExcel()
    {
        $data['title'] = "Akumulasi Karyawan";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }

        $data['cetak_akumulasi_admin'] = $this->Akumulasi_model->cetakAkumulasi($bulantahun);
        // printr($data['cetak_akumulasi_admin']);
        $this->load->view('performances/cetak_excel_akumulasi', $data);
    }




}