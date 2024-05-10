<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berinilai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Recruitment/Hasiltes_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('Hris_model');
        $this->load->helper(array('url', 'download'));
    }

    public function index()
    {
        // printr($_SESSION);
        $data['title'] = "Beri Nilai";
        $data['berinilai'] = $this->Hasiltes_model->tampilhasiltes();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->load->view('recruitment/berinilai', $data);
    }
    public function hapus($id_hasiltes)
    {
        if ($this->Hasiltes_model->hapus($id_hasiltes)) {
            $this->session->set_flashdata('message', 'Data Berhasil DiHapus.');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('Recruitment/berinilai');
    }

    public function download_file($filename)
    {
        // Menentukan path file yang akan didownload
        $file_path = './dist/uploads/' . $filename;
        if (!file_exists($file_path)) {
            redirect('Recruitment/berinilai');
        };
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($file_path));
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        readfile($file_path);
    }

    public function sudahnilai($id)
    {
        $data = [
            'status' => 'sudah dinilai ',
            'nilai_pg' => htmlspecialchars($this->input->post('nilai_pg')),
            'nilai_tes' => htmlspecialchars($this->input->post('nilai_tes')),
        ];

        $this->db->where('id_hasiltes', $id);
        $this->db->update('recruitment___hasiltes', $data);
        $this->session->set_flashdata('message', 'Berhasil dinilai.');
        redirect('Recruitment/berinilai');
    }
}
