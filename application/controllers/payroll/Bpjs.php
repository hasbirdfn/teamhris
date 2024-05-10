<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bpjs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll/Bpjs_model', 'Bpjs');
        $this->load->model('Hris_model', 'Hris');
        $this->load->model('DataKaryawan_model', 'Datakaryawan');
        $this->load->model('payroll/DataBpjs_model', 'Databpjs');

        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "BPJS Karyawan";
        $data['bpjskaryawan'] = $this->Bpjs->tampilBpjsKaryawan();
        $data['datakaryawan'] = $this->Datakaryawan->getAllDataKaryawan();
        $data['databpjs'] = $this->Databpjs->tampilDataBpjs();
        $data['user'] = $this->Hris->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/bpjs', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = "BPJS Karyawan";
        $data['bpjskaryawan'] = $this->Bpjs->tampilBpjsKaryawan();
        $data['datakaryawan'] = $this->Datakaryawan->getAllDataKaryawan();
        $data['databpjs'] = $this->Databpjs->tampilDataBpjs();
        $data['user'] = $this->Hris->ambilUser();

        $this->form_validation->set_rules('nik_nama', 'nik_nama', 'required|is_unique[payroll___bpjs.id_datakaryawan]', [
            'required' => 'NIK & Nama Karyawan harus diisi !',
            'is_unique' => 'NIK & Nama Sudah Terdaftar !'
        ]);
        $this->form_validation->set_rules('kelas_nilai', 'kelas_nilai', 'required', [
            'required' => 'Golongan & Kode harus diisi !'
        ]);
        $this->form_validation->set_rules('jumlah', 'jumlah', 'required|numeric', [
            'required' => 'Jumlah harus diisi !',
            'numeric' => 'Jumlah harus angka'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('payroll/bpjs', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Bpjs->tambahBpjsKaryawan();
            $this->session->set_flashdata('message', 'Data berhasil ditambahkan!');
            redirect('payroll/bpjs');
        }
    }

    public function ubah()
    {
        $data['title'] = "BPJS Karyawan";
        $data['bpjskaryawan'] = $this->Bpjs->tampilBpjsKaryawan();
        $data['datakaryawan'] = $this->Datakaryawan->getAllDataKaryawan();
        $data['databpjs'] = $this->Databpjs->tampilDataBpjs();
        $data['user'] = $this->Hris->ambilUser();

        $this->form_validation->set_rules('nik_nama', 'nik_nama', 'required', [
            'required' => 'NIK & Nama Karyawan harus diisi !'
        ]);
        $this->form_validation->set_rules('kelas_nilai', 'kelas_nilai', 'required', [
            'required' => 'Golongan & Kode harus diisi !'
        ]);
        $this->form_validation->set_rules('jumlah', 'jumlah', 'required|numeric', [
            'required' => 'Jumlah harus diisi !',
            'numeric' => 'Jumlah harus angka'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('payroll/bpjs', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Bpjs->ubahBpjsKaryawan();
            $this->session->set_flashdata('message', 'Data berhasil diubah!');
            redirect('payroll/bpjs');
        }
    }

    public function hapus($id)
    {
        if ($this->Bpjs->hapus($id)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus');
        }
        redirect('payroll/bpjs');
    }
}
