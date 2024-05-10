<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;


class JamKerja extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('dompdf_gen');
        $this->load->model('performances/JamKerja_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('DataKaryawan_model');
        $this->load->model('Hris_model');

        if (!$this->session->userdata('nik')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['title'] = "JamKerja";

        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }


        $data['jamkerja'] = $this->db->query("SELECT performances___inputjamkerja.*,
        data_karyawan.nama_karyawan, data_karyawan.id_posisi
        FROM performances___inputjamkerja
        INNER JOIN data_karyawan ON performances___inputjamkerja.nik=data_karyawan.nik
        WHERE performances___inputjamkerja.tanggal='$bulantahun'
        ORDER BY data_karyawan.nama_karyawan ASC")->result_array();


        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['user'] = $this->Hris_model->ambilUser();

        // printr($data);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/jamkerja', $data);
        $this->load->view('templates/footer');
    }

    public function import_excel()
    {
        if (isset($_FILES["import"]["name"])) {
            // print_r($_FILES["import"]);
            // die('data masuk');
            $path = $_FILES["import"]["tmp_name"];
            $reader = ReaderEntityFactory::createXLSXReader();
            $reader->open($path);
            $count = 0;
            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row) {
                    $count++;
                    if ($count == 1) {
                        continue;
                    }
                    $nik = $row->getCellAtIndex(0)->getValue();
                    $due_date = $row->getCellAtIndex(1)->getValue();
                    // var_dump($due_date);

                    $textduedate = serialize($due_date);
                    $textduedate = str_replace('O:8:"DateTime":3:', '', $textduedate);
                    $textduedate = str_replace('{s:4:"date";s:26:', '', $textduedate);
                    $textduedate = str_replace(';s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Europe/Berlin";}', '', $textduedate);
                    $textduedate = str_replace('"', '', $textduedate);
                    $textduedate = str_replace('00:00:00.000000', '', $textduedate);



                    $complete_date = $row->getCellAtIndex(2)->getValue();
                    $textcompletedate = serialize($complete_date);
                    $textcompletedate = str_replace('O:8:"DateTime":3:', '', $textcompletedate);
                    $textcompletedate = str_replace('{s:4:"date";s:26:', '', $textcompletedate);
                    $textcompletedate = str_replace(';s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Europe/Berlin";}', '', $textcompletedate);
                    $textcompletedate = str_replace('"', '', $textcompletedate);
                    $textcompletedate = str_replace('00:00:00.000000', '', $textcompletedate);

                    $keterangan = '';
                    if (!$complete_date || !$due_date) {
                        $keterangan = "Tidak Diisi";
                    } else if ($complete_date <= $due_date) {
                        $keterangan = "Tepat Waktu";
                    } else {
                        $keterangan = "Terlambat";
                    }
                    $data = [
                        "nik" => $nik,
                        'tanggal' => date("m/Y"),
                        'due_date' => $textduedate,
                        "complete_date" => $textcompletedate,
                        "keterangan" => $keterangan,
                    ];
                    // print_r($data);
                    $this->db->insert('performances___inputjamkerja', $data);
                }
            }
            $this->session->set_flashdata('message', ' Data Berhasil di import!');
            redirect('performances/JamKerja');
        } else {

            $this->session->set_flashdata('message', ' Data gagal import!');
            redirect('performances/JamKerja');
        }
    }


    public function tambah()
    {
        $data['title'] = "Jam Kerja";
        $data['jamkerja'] = $this->JamKerja_model->Tampiljamkerja();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['user'] = $this->Hris_model->ambilUser();

        // exit(1);
        // printr($_POST);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/jamkerja', $data);
        $this->load->view('templates/footer');
    }

    public function tambahproses()
    {
        $this->JamKerja_model->tambah(); // ngambil data dari model
        $this->session->set_flashdata('message', ' Data berhasil ditambahkan!');
        redirect('performances/JamKerja');

    }

    public function ubah()
    {
        $data['title'] = "Jam Kerja";
        $data['jamkerja'] = $this->JamKerja_model->Tampiljamkerja();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['user'] = $this->Hris_model->ambilUser();



        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/jamkerja', $data);
        $this->load->view('templates/footer');

        $this->JamKerja_model->ubahJamKerja();
        $this->session->set_flashdata('message', 'Data berhasil diubah!');
        redirect('performances/JamKerja');

    }

    public function hapus($id)
    {
        if ($this->JamKerja_model->hapus($id)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus');
        }
        redirect('performances/JamKerja');
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
?>