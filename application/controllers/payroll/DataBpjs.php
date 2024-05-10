<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataBpjs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll/DataBpjs_model', 'DataBpjs');
        $this->load->model('Hris_model', 'Hris');

        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Data BPJS";
        $data['databpjs'] = $this->DataBpjs->tampilDataBpjs();
        $data['user'] = $this->Hris->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/databpjs', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = "Data BPJS";
        $data['databpjs'] = $this->DataBpjs->tampilDataBpjs();
        $data['user'] = $this->Hris->ambilUser();

        $this->form_validation->set_rules('kelas', 'kelas', 'required', [
            'required' => 'kelas harus diisi !'
        ]);
        $this->form_validation->set_rules('nilai', 'nilai', 'required', [
            'required' => 'nilai harus diisi !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('payroll/databpjs', $data);
            $this->load->view('templates/footer');
        } else {
            $this->DataBpjs->tambahDataBpjs();
            $this->session->set_flashdata('message', 'Data berhasil ditambahkan!');
            redirect('payroll/databpjs');
        }
    }

    public function ubah()
    {
        $data['title'] = "Data BPJS";
        $data['databpjs'] = $this->DataBpjs->tampilDataBpjs();
        $data['user'] = $this->Hris->ambilUser();

        $this->form_validation->set_rules('kelas', 'kelas', 'required', [
            'required' => 'kelas harus diisi !'
        ]);
        $this->form_validation->set_rules('nilai', 'nilai', 'required', [
            'required' => 'nilai harus diisi !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('payroll/databpjs', $data);
            $this->load->view('templates/footer');
        } else {
            $this->DataBpjs->ubahDataBpjs();
            $this->session->set_flashdata('message', 'Data berhasil ditambahkan!');
            redirect('payroll/databpjs');
        }
    }

    public function hapus($id)
    {
        if ($this->DataBpjs->hapus($id)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus');
        }
        redirect('payroll/databpjs');
    }
}
