<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perhitungan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll/Perhitungan_model', 'Perhitungan');
        $this->load->model('Hris_model', 'Hris');
        $this->load->model('DataKaryawan_model', 'Datakaryawan');
        if (!$this->session->userdata('nik')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['title'] = "Perhitungan Gaji Karyawan";
        $data['perhitungan'] = $this->Perhitungan->tampilPerhitungan();
        $data['datakaryawan'] = $this->Datakaryawan->getAllDataKaryawan();
        $data['user'] = $this->Hris->ambilUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/perhitungangaji', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = "Perhitungan Gaji Karyawan";
        $data['perhitungan'] = $this->Perhitungan->tampilPerhitungan();
        $data['datakaryawan'] = $this->Datakaryawan->getAllDataKaryawan();
        $data['user'] = $this->Hris->ambilUser();

        $this->form_validation->set_rules('nik_nama', 'nik_nama', 'required|is_unique[payroll___perhitungan.id_datakaryawan]', [
            'required' => 'NIK & Nama Karyawan harus diisi !',
            'is_unique' => 'NIK & Nama Sudah Terdaftar !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('payroll/perhitungangaji', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Perhitungan->tambahPerhitungan();
            $this->session->set_flashdata('message', 'Data berhasil ditambahkan!');
            redirect('payroll/Perhitungan');
        }
    }

    public function ubah()
    {
        $data['title'] = "Perhitungan Gaji Karyawan";
        $data['perhitungan'] = $this->Perhitungan->tampilPerhitungan();
        $data['datakaryawan'] = $this->Datakaryawan->getAllDataKaryawan();
        $data['user'] = $this->Hris->ambilUser();

        $this->form_validation->set_rules('nik_nama', 'nik_nama', 'required', [
            'required' => 'NIK & Nama Karyawan harus diisi !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('payroll/perhitungangaji', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Perhitungan->ubahPerhitungan();
            $this->session->set_flashdata('message', 'Data berhasil diubah!');
            redirect('payroll/Perhitungan');
        }
    }

    public function hapus($id)
    {
        if ($this->Perhitungan->hapus($id)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus');
        }
        redirect('payroll/Perhitungan');
    }

    public function tabel()
    {
        // POST data
        $postData = $this->input->post();

        // Get data
        $data = $this->Perhitungan->dataTable($postData);

        echo json_encode($data);
    }
}
