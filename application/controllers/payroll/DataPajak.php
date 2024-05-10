<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataPajak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll/DataPajak_model', 'DataPajak');
        $this->load->model('Hris_model', 'Hris');

        if (!$this->session->userdata('nik')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['title'] = "Data Pajak";
        $data['datapajak'] = $this->DataPajak->tampilDataPajak();
        $data['golongan'] = ['Tidak Kawin (TK)', 'Kawin (K)', 'Kawin + Istri (KI)'];
        $data['user'] = $this->Hris->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/datapajak', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = "Data Pajak";
        $data['datapajak'] = $this->DataPajak->tampilDataPajak();
        $data['user'] = $this->Hris->ambilUser();

        $this->form_validation->set_rules('golongan', 'Golongan', 'required', [
            'required' => 'Golongan harus diisi !'
        ]);
        $this->form_validation->set_rules('kode', 'Kode', 'required', [
            'required' => 'Kode harus diisi !'
        ]);
        $this->form_validation->set_rules('tarif', 'Tarif', 'required', [
            'required' => 'Tarif harus diisi !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('payroll/datapajak', $data);
            $this->load->view('templates/footer');
        } else {
            $this->DataPajak->tambahDataPajak();
            $this->session->set_flashdata('message', 'Data berhasil ditambahkan!');
            redirect('payroll/DataPajak');
        }
    }

    public function ubah()
    {
        $data['title'] = "Data Pajak";
        $data['datapajak'] = $this->DataPajak->tampilDataPajak();
        $data['user'] = $this->Hris->ambilUser();

        $this->form_validation->set_rules('golongan', 'Golongan', 'required', [
            'required' => 'Golongan harus diisi !'
        ]);
        $this->form_validation->set_rules('kode', 'Kode', 'required', [
            'required' => 'Kode harus diisi !'
        ]);
        $this->form_validation->set_rules('tarif', 'Tarif', 'required', [
            'required' => 'Tarif harus diisi !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('payroll/datapajak', $data);
            $this->load->view('templates/footer');
        } else {
            $this->DataPajak->ubahDataPajak();
            $this->session->set_flashdata('message', 'Data berhasil diubah!');
            redirect('payroll/DataPajak');
        }
    }

    public function hapus($id)
    {
        if ($this->DataPajak->hapus($id)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus');
        }
        redirect('payroll/DataPajak');
    }
}
