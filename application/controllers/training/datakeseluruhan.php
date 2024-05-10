<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class datakeseluruhan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('training/datakeseluruhan_model');
        $this->load->model('Hris_model');

        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Data Keseluruhan";
        $data['datakeseluruhan'] = $this->datakeseluruhan_model->getAlldatakeseluruhan();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('training/data_keseluruhan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {

        $data['title'] = "Data Keseluruhan";
        $data['datakeseluruhan'] = $this->datakeseluruhan_model->getAlldatakeseluruhan();
        $data['user'] = $this->Hris_model->ambilUser();


        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Nama harus diisi !',
        ]);
        $this->form_validation->set_rules('kategori', 'kategori', 'required', [
            'required' => 'Nama harus diisi !'
        ]);
        $this->form_validation->set_rules('ulasan', 'Ulasan', 'required', [
            'required' => 'Ulasan harus diisi !'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('training/data_keseluruhan', $data);
            $this->load->view('templates/footer');
        } else {
            $data = $this->upload_berkas();
            $dokumen = $data['file_name'];
            $this->datakeseluruhan_model->tambahdatakeseluruhan($dokumen);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('training/Datakeseluruhan');
        }
    }

    public function ubah()
    {
        $data['title'] = "Data Keseluruhan";
        $data['datakeseluruhan'] = $this->datakeseluruhan_model->getAlldatakeseluruhan();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Nama harus diisi !'
        ]);
        $this->form_validation->set_rules('kategori', 'Kategori', 'required', [
            'required' => 'kategori harus diisi !'
        ]);
        $this->form_validation->set_rules('ulasan', 'Ulasan', 'required', [
            'required' => 'Ulasan harus diisi !'
        ]);
        $this->form_validation->set_rules('file', 'Dokumen', 'required', [
            'required' => 'Dokumen harus diisi !'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('training/data_keseluruhan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->datakeseluruhan_model->ubahdatakeseluruhan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil diedit!</div>');
            redirect('training/Datakeseluruhan');
        }
    }
    public function download_hasil($filename)
    {
        // Menentukan path file yang akan didownload
        $file_path = './dist/uplod/' . $filename;
        if (!file_exists($file_path)) {
            redirect('training/data_keseluruhan');
        };
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($file_path));
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        readfile($file_path);
    }
    public function upload_berkas()
    {
        $config['upload_path'] = './dist/uplod';
        $config['max_size'] = '4024';
        $config['allowed_types'] = 'doc|docx|pdf';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('dokumen')) {
            return $this->upload->data();
        } else {
            return $this->upload->display_errors();
        }
    }
    public function hapus($id_keseluruhan)
    {
        if ($this->datakeseluruhan_model->hapus($id_keseluruhan)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus');
        }
        redirect('training/datakeseluruhan');
    }
}
