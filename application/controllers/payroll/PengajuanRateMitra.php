<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PengajuanRateMitra extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('dompdf_gen');
        $this->load->model('payroll/Pajak_model', 'Pajak');
        $this->load->model('payroll/PengajuanRateMitra_model', 'RateMitra');
        $this->load->model('Hris_model', 'Hris');
        if (!$this->session->userdata('nik')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['title'] = "Pengajuan Rate Mitra";
        $data['ratemitra'] = $this->RateMitra->tampilRate();
        $data['user'] = $this->Hris->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/pengajuan_rate_mitra', $data);
        $this->load->view('templates/footer');
    }

    public function generate()
    {
        $data['title'] = "Pengajuan Rate Mitra";
        $data['generate'] = $this->RateMitra->generate();
        $data['ratemitra'] = $this->RateMitra->tampilRate();
        $data['user'] = $this->Hris->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/pengajuan_rate_mitra', $data);
        $this->load->view('templates/footer');

        $this->session->set_flashdata('message', 'Generate data berhasil!');
        redirect('payroll/PengajuanRateMitra');
    }

    public function status($id)
    {
        $this->RateMitra->statusBayar($id);
        $this->session->set_flashdata('message', 'Status bayar berhasil diubah!');
        redirect('payroll/PengajuanRateMitra');
    }

    public function list()
    {
        // POST data
        $postData = $this->input->post();

        // Get data
        $data = $this->RateMitra->getUsers($postData);

        echo json_encode($data);
    }

    public function cetakRate()
    {
        $data['title'] = "Pengajuan Rate Mitra";
        // ambil data dari form
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $bulantahun = $tahun . $bulan;
        $data['cetak_rate'] = $this->RateMitra->cetakRate($bulantahun);
        if (count($data['cetak_rate']) > 0) {
            $this->load->view('payroll/cetak/cetakratepdf', $data);

            $paper_size = 'A4';
            $orientation = 'potrait';
            $html = $this->output->get_output();
            $this->dompdf->set_paper($paper_size, $orientation);

            $this->dompdf->load_html($html);
            $this->dompdf->render();
            $this->dompdf->stream('pengajuan_rate_mitra.pdf', array('Attachment' => 0));
        } else {
            $this->session->set_flashdata('error', 'Tidak ada data untuk dicetak!');
            redirect('payroll/PengajuanRateMitra');
        }
    }

    public function cetakRateExcel()
    {
        $data['title'] = "Pengajuan Rate Mitra";
        // ambil data dari form
        $data['bulan'] = $this->input->post('bulan');
        $data['tahun'] = $this->input->post('tahun');
        $bulantahun = $data['tahun'] . $data['bulan'];
        $data['cetak_rate'] = $this->RateMitra->cetakRate($bulantahun);
        if (count($data['cetak_rate']) > 0) {
            $this->load->view('payroll/cetak/cetakrateexcel', $data);
        } else {
            $this->session->set_flashdata('error', 'Tidak ada data untuk dicetak!');
            redirect('payroll/PengajuanRateMitra');
        }
    }
}
