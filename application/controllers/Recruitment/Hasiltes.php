<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hasiltes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Recruitment/Hasiltes_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('Hris_model');
        $this->load->helper(array('url', 'download'));

        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        // printr($_SESSION);
        $data['title'] = "Hasil Tes";
        $data['hasiltes'] = $this->Hasiltes_model->getAllHasiltes();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('recruitment/hasiltes', $data);
        $this->load->view('templates/footer');
    }





    public function hapus($id_hasiltes)
    {
        if ($this->Hasiltes_model->hapus($id_hasiltes)) {
            $this->session->set_flashdata('message', 'Data Berhasil DiHapus.');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('Recruitment/hasiltes');
    }

    public function download_file($filename)
    {
        // Menentukan path file yang akan didownload
        $file_path = './dist/uploads/' . $filename;
        if (!file_exists($file_path)) {
            redirect('Recruitment/hasiltes');
        };
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($file_path));
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        readfile($file_path);
    }

    public function siapnilai($id)
    {
        $data = [
            'status' => 'siap dinilai'
        ];

        $this->db->where('id_hasiltes', $id);
        $this->db->update('recruitment___hasiltes', $data);
        $this->session->set_flashdata('message', 'Siap dinilai.');
        redirect('Recruitment/hasiltes');
    }
}
