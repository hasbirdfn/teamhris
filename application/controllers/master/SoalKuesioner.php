<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SoalKuesioner extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SoalKuesioner_model');
        $this->load->model('Hris_model');
        if (!$this->session->userdata('nik')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['title'] = "Soal Kuesioner";
        $data['soalkuesioner'] = $this->SoalKuesioner_model->getAllSoalKuesioner();
        $data['user'] = $this->Hris_model->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/soalkuesioner', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = "Soal Kuesioner";
        $data['soalkuesioner'] = $this->SoalKuesioner_model->getAllSoalKuesioner();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->form_validation->set_rules('kuesioner', 'Pertanyaan', 'required', [
            'required' => 'Kuesioner harus diisi !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/soalkuesioner', $data);
            $this->load->view('templates/footer');
        } else {
            $this->SoalKuesioner_model->tambahSoalKuesioner();
            $this->session->set_flashdata('message', 'Data berhasil ditambahkan!');
            redirect('master/SoalKuesioner');
        }
    }

    public function ubah()
    {
        $data['title'] = "Pertanyaan ";
        $data['soalkuesioner'] = $this->SoalKuesioner_model->getAllSoalKuesioner();
        $data['user'] = $this->Hris_model->ambilUser();
        $this->form_validation->set_rules('kuesioner', 'Pertanyaan', 'required', [
            'required' => 'Kuesioner harus diisi !'
        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/soalkuesioner', $data);
            $this->load->view('templates/footer');
        } else {
            $this->SoalKuesioner_model->ubahSoalKuesioner();
            $this->session->set_flashdata('message', 'Data berhasil diedit!');
            redirect('master/SoalKuesioner');
        }
    }

    public function hapus($id_kuesioner)
    {
        if ($this->SoalKuesioner_model->hapus($id_kuesioner)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus!');
        }
        redirect('master/SoalKuesioner');
    }
}