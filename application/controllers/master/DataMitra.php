<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataMitra extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataMitra_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('Hris_model');

        if (!$this->session->userdata('nik')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['title'] = "Data Mitra";
        $data['datamitra'] = $this->DataMitra_model->getAllDataMitra();
        $data['keahlian'] = $this->DataMitra_model->getAllKeahlian();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/datamitra', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = "Data Mitra";
        $data['datamitra'] = $this->DataMitra_model->getAllDataMitra();
        $data['keahlian'] = $this->DataMitra_model->getAllKeahlian();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->form_validation->set_rules('perusahaan', 'Nama Perusahaan', 'required', [
            'required' => 'Nama Perusahaan harus diisi !'
        ]);
        $this->form_validation->set_rules('nama', 'Nama Karyawan', 'required', [
            'required' => 'Nama Karyawan harus diisi !'
        ]);
        $this->form_validation->set_rules('keahlian[]', 'Posisi', 'required', [
            'required' => 'Keahlian harus diisi !'
        ]);
        $this->form_validation->set_rules('tools[]', 'Posisi', 'required', [
            'required' => 'tools harus diisi !'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', [
            'required' => 'Email harus diisi !',
            'valid_email' => 'Yang Anda Masukan Bukan Email !'
        ]);
        $this->form_validation->set_rules('telepon', 'Telepon', 'required|numeric', [
            'numeric' => 'Telepon harus diisi dengan angka !'
        ]);
        $this->form_validation->set_rules('rate_total', 'tanggal_keluar', 'required', [
            'required' => 'Rate total harus diisi !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/datamitra', $data);
            $this->load->view('templates/footer');
        } else {
            $this->DataMitra_model->tambahDataMitra();
            $this->session->set_flashdata('message', 'Data berhasil ditambahkan!');
            redirect('master/DataMitra');
        }
    }

    public function ubah()
    {
        $data['title'] = "Data Mitra";
        $data['datamitra'] = $this->DataMitra_model->getAllDataMitra();
        $data['keahlian'] = $this->DataMitra_model->getAllKeahlian();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->form_validation->set_rules('perusahaan', 'Nama Perusahaan', 'required', [
            'required' => 'Nama Perusahaan harus diisi !'
        ]);
        $this->form_validation->set_rules('nama', 'Nama Karyawan', 'required', [
            'required' => 'Nama Karyawan harus diisi !'
        ]);
        $this->form_validation->set_rules('keahlian[]', 'Posisi', 'required', [
            'required' => 'Keahlian harus diisi !'
        ]);
        $this->form_validation->set_rules('tools[]', 'Posisi', 'required', [
            'required' => 'tools harus diisi !'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', [
            'required' => 'Email harus diisi !',
            'valid_email' => 'Yang Anda Masukan Bukan Email !'
        ]);
        $this->form_validation->set_rules('telepon', 'Telepon', 'required|numeric', [
            'numeric' => 'Telepon harus diisi dengan angka !'
        ]);
        $this->form_validation->set_rules('rate_total', 'tanggal_keluar', 'required', [
            'required' => 'Rate total harus diisi !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/datamitra', $data);
            $this->load->view('templates/footer');
        } else {
            $this->DataMitra_model->ubahDataMitra();
            $this->session->set_flashdata('message', 'Data berhasil diubah!');
            redirect('master/DataMitra');
        }
    }

    public function hapus($id_mitra)
    {
        if ($this->DataMitra_model->hapus($id_mitra)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus!');
        }
        redirect('master/DataMitra');
    }

    public function tabel()
    {
        // POST data
        $postData = $this->input->post();

        // Get data
        $data = $this->DataMitra_model->dataTable($postData);

        echo json_encode($data);
    }
}
