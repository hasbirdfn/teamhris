<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataPosisi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataPosisi_model');
        $this->load->model('Hris_model');

        if (!$this->session->userdata('nik')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['title'] = "Data Posisi";
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/dataposisi', $data);
        $this->load->view('templates/footer');
    }
    public function tambah()
    {
        $data['title'] = "Data Posisi";
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();
        $this->form_validation->set_rules('posisi', 'Posisi', 'required', [
            'required' => 'Posisi harus diisi !'
        ]);
        $this->form_validation->set_rules('kode', 'kode', 'required', [
            'required' => 'kode harus diisi !'
        ]);



        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/dataposisi', $data);
            $this->load->view('templates/footer');
        } else {
            $this->DataPosisi_model->tambahDataPosisi();
            $this->session->set_flashdata('message', 'Data berhasil ditambahkan!');
            redirect('master/DataPosisi');
        }
    }

    public function ubah()
    {
        $data['title'] = "Data Posisi";
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();
        $this->form_validation->set_rules('posisi', 'Nama Posisi', 'required', [
            'required' => 'Posisi harus diisi !'
        ]);
        $this->form_validation->set_rules('kode', 'Kode', 'required', [
            'required' => 'Kode harus diisi !'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/dataposisi', $data);
            $this->load->view('templates/footer');
        } else {
            $this->DataPosisi_model->ubahDataPosisi();
            $this->session->set_flashdata('message', 'Data berhasil diedit!');
            redirect('master/DataPosisi');
        }
    }



    public function hapus($id_posisi)
    {
        if ($this->DataPosisi_model->hapus($id_posisi)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus!');
        }
        redirect('master/DataPosisi');
    }
}
