<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pajak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll/Pajak_model', 'Pajak');
        $this->load->model('Hris_model', 'Hris');
        $this->load->model('DataKaryawan_model', 'DataKaryawan');
        $this->load->model('payroll/DataPajak_model', 'DataPajak');
        if (!$this->session->userdata('nik')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['title'] = "Pajak Karyawan";
        $data['pajakkaryawan'] = $this->Pajak->tampilPajakKaryawan();
        $data['datakaryawan'] = $this->DataKaryawan->getAllDataKaryawan();
        $data['datapajak'] = $this->DataPajak->tampilDataPajak();
        $data['user'] = $this->Hris->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/pajakkaryawan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = "Pajak Karyawan";
        $data['pajakkaryawan'] = $this->Pajak->tampilPajakKaryawan();
        $data['datakaryawan'] = $this->DataKaryawan->getAllDataKaryawan();
        $data['datapajak'] = $this->DataPajak->tampilDataPajak();
        $data['user'] = $this->Hris->ambilUser();

        $this->form_validation->set_rules('nik_nama', 'nik_nama', 'required|is_unique[payroll___pajak.id_datakaryawan]', [
            'required' => 'NIK & Nama Karyawan harus diisi !',
            'is_unique' => 'NIK & Nama Sudah Terdaftar !'
        ]);
        $this->form_validation->set_rules('golongan_kode', 'Golongan', 'required', [
            'required' => 'Golongan & Kode harus diisi !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('payroll/pajakkaryawan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pajak->tambahPajakKaryawan();
            $this->session->set_flashdata('message', 'Data berhasil ditambahkan!');
            redirect('payroll/Pajak');
        }
    }

    public function ubah()
    {
        $data['title'] = "Pajak Karyawan";
        $data['pajakkaryawan'] = $this->Pajak->tampilPajakKaryawan();
        $data['datakaryawan'] = $this->DataKaryawan->getAllDataKaryawan();
        $data['datapajak'] = $this->DataPajak->tampilDataPajak();
        $data['user'] = $this->Hris->ambilUser();

        $this->form_validation->set_rules('nik_nama', 'nik_nama', 'required', [
            'required' => 'NIK & Nama Karyawan harus diisi !'
        ]);
        $this->form_validation->set_rules('golongan_kode', 'Golongan', 'required', [
            'required' => 'Golongan & Kode harus diisi !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('payroll/pajakkaryawan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pajak->ubahPajakKaryawan();
            $this->session->set_flashdata('message', 'Data berhasil diubah!');
            redirect('payroll/Pajak');
        }
    }

    public function hapus($id)
    {
        if ($this->Pajak->hapus($id)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus');
        }
        redirect('payroll/Pajak');
    }

    public function tabel()
    {
        // POST data
        $postData = $this->input->post();

        // Get data
        $data = $this->Pajak->dataTable($postData);

        echo json_encode($data);
    }
}
