<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class PenilaianKinerja extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('dompdf_gen');
        $this->load->model('performances/PenilaianKinerja_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('DataKaryawan_model');
        $this->load->model('Hris_model');

        if (!$this->session->userdata('nik')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        // printr($_SESSION);
        $data['title'] = "Penilaian Kinerja";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }

        // printr($bulantahun);
        $data['jamkerja'] = $this->db->query("
        SELECT 
            jk.id_jamkerja,
            jk.nik,
            MAX(dk.nama_karyawan) AS nama_karyawan,
            jk.tanggal,
            jk.keterangan,
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
        FROM performances___inputjamkerja jk
        JOIN data_karyawan dk ON jk.nik = dk.nik
        WHERE jk.tanggal = '$bulantahun'
        GROUP BY jk.nik
    ")->result_array();


        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['user'] = $this->Hris_model->ambilUser();

        // printr($data);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/penilaiankinerja', $data);
        $this->load->view('templates/footer');
    }



    private function nik_sudah_digunakan_by_month($nik)
    {
        $currentDate = date("m/Y");
        $query = $this->db->query("SELECT pk.nik FROM performances___inputjamkerja pk WHERE 
        pk.nik = '$nik' AND pk.tanggal = '$currentDate' ")->result_array();
        if (count($query) > 0) {
            return true;
        }
        return false;
    }



    public function cetakKinerja()
    {
        $data['title'] = "Penilaian Kinerja";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }

        $data['cetak_kinerja'] = $this->PenilaianKinerja_model->cetakKinerja($bulantahun);
        // printr($data['cetak_kinerja']);
        $this->load->view('templates/header', $data);
        $this->load->view('performances/cetak_kinerja', $data);

    }

    public function cetakExcel()
    {
        $data['title'] = "Penilaian Kinerja";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }
        $data['cetak_kinerja'] = $this->PenilaianKinerja_model->cetakKinerja($bulantahun);
        $this->load->view('performances/cetak_excel_kinerja', $data);
    }

    public function ajax_category()
    {
        $nik = $_GET["nik"];
        if (!$nik)
            return json_encode([]);
        $category = $this->db->query("SELECT
            data_posisi.nama_posisi
            FROM data_karyawan 
                INNER JOIN data_posisi ON data_posisi.id_posisi = data_karyawan.id_posisi 
                    WHERE data_karyawan.nik = '$nik'");
        print_r(json_encode($category->row()));
    }


}