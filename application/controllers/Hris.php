<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hris extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Hris_model');
        $this->load->model('DataPosisi_model', 'DataPosisi');
        $this->load->model('payroll/PengajuanGaji_model', 'PengajuanGaji');
        $this->load->model('payroll/PengajuanRateMitra_model', 'RateMitra');
        if (!$this->session->userdata('nik')) {
            redirect('Auth');
        }
    }

    public function index()
    {

        $tahunbulan = date("Y") . date("m");
        $data['title'] = "Dashboard";
        $data['user'] = $this->Hris_model->ambilUser();
        $data['laporan_gk'] = $this->PengajuanGaji->laporan($tahunbulan);
        $data['laporan_type'] = $this->PengajuanGaji->laporanType($tahunbulan);
        $data['laporan_rm'] = $this->RateMitra->laporan($tahunbulan);
        $data['bariskaryawan'] = $this->db->get('data_karyawan')->num_rows();
        $data['barisposisi'] = $this->db->get('data_posisi')->num_rows();
        $data['barismitra'] = $this->db->get('data_mitra')->num_rows();
        $data['barispelamar'] = $this->db->get('recruitment___pelamar')->num_rows();


        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }

        $data['akumulasi'] = $this->Hris_model->laporan($bulantahun);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('hris/dashboard', $data);
        $this->load->view('templates/footer');
    }


    public function cetakPdf() // ini dipakai untuk ceo dan hc
    {
        $data['title'] = "Nilai Perbulan Karyawan";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }

        $data['cetak_dashboard_pdf'] = $this->Hris_model->cetakNilaiDashboard($bulantahun);
        // printr($data['cetak_akumulasi']);
        $this->load->view('templates/header', $data);
        $this->load->view('hris/cetak_pdf_dashboard', $data);
    }
    public function cetakPdfKaryawan()
    {
        $data['title'] = "Nilai Perbulan Karyawan";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }

        $data['cetak_dashboard_pdf'] = $this->Hris_model->cetakNilaiDashboard($bulantahun);
        // printr($data['cetak_akumulasi']);
        $this->load->view('templates/header', $data);
        $this->load->view('hris/cetak_pdf_dashboard_karyawan', $data);
    }

    public function cetakExcelCEO()
    {
        $data['title'] = "Nilai Perbulan Karyawan";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }

        $data['cetak_dashboard_excel'] = $this->Hris_model->cetakNilaiDashboard($bulantahun);
        // printr($data['cetak_akumulasi']);
        $this->load->view('hris/cetak_excel_dashboard_ceo', $data);
    }
    public function cetakExcelHC()
    {
        $data['title'] = "Nilai Perbulan Karyawan";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }

        $data['cetak_dashboard_excel'] = $this->Hris_model->cetakNilaiDashboard($bulantahun);
        // printr($data['cetak_akumulasi']);
        $this->load->view('hris/cetak_excel_dashboard_hc', $data);
    }

    public function cetakExcelKaryawan()
    {
        $data['title'] = "Nilai Perbulan Karyawan";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }

        $data['cetak_dashboard_excel'] = $this->Hris_model->cetakNilaiDashboard($bulantahun);
        // printr($data['cetak_akumulasi']);
        $this->load->view('hris/cetak_excel_dashboard_karyawan', $data);
    }


    public function profile()
    {
        $data['title'] = 'Profile';
        $data['dataposisi'] = $this->DataPosisi->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('hris/profile', $data);
        $this->load->view('templates/footer');
    }

    public function ubahPassword()
    {
        $data['title'] = "Ubah Password";
        $data['user'] = $this->Hris_model->ambilUser();

        $this->form_validation->set_rules('password_lama', 'Password lama', 'required|trim', [
            'required' => 'Password lama harus diisi'
        ]);
        $this->form_validation->set_rules('password_baru1', 'Password Baru', 'required|trim|min_length[3]|matches[password_baru2]', [
            'required' => 'Password lama harus diisi',
            'matches' => 'Password tidak cocok!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password_baru2', 'Konfirmasi Password', 'required|trim|matches[password_baru1]', [
            'required' => 'Password lama harus diisi',
            'matches' => 'Password tidak cocok!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('hris/ubahpassword', $data);
            $this->load->view('templates/footer');
        } else {
            $password_lama = $this->input->post('password_lama');
            $password_baru = $this->input->post('password_baru1');

            if (!password_verify($password_lama, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert" style="background-color:#8b0000; color:white;" role="alert">Password lama salah!</div>');
                redirect('Hris/ubahPassword');
            } else {
                if ($password_lama == $password_baru) {
                    $this->session->set_flashdata('message', '<div class="alert" style="background-color:#8b0000; color:white;" role="alert"> Password baru tidak boleh sama dengan password lama!</div>');
                    redirect('Hris/ubahPassword');
                } else {
                    // jika password sudah ok
                    $this->Hris_model->ubahPassword($password_baru);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Password berhasil diubah!</div>');
                    redirect('Hris/ubahPassword');
                }
            }
        }
    }

    public function ubahProfile()
    {
        $data['title'] = 'Ubah Profile';
        $data['user'] = $this->Hris_model->ambilUser();

        $this->form_validation->set_rules('nama', 'Full name', 'required|trim');
        $this->form_validation->set_rules('email', 'Full name', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Full name', 'required|trim');
        $this->form_validation->set_rules('telepon', 'Full name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('hris/ubahprofile', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Hris_model->ubahProfile($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Profile anda berhasil diubah!</div>');
            redirect('Hris/profile');
        }
    }

    public function filter_per_type()
    {
        $bulan = $this->input->post('bulanType');
        $tahun = $this->input->post('tahunType');
        $bulantahun = $tahun . $bulan;

        $data = $this->PengajuanGaji->laporanType($bulantahun);
        echo json_encode($data);
    }

    public function filter_per_status()
    {
        $bulan = $this->input->post('bulanStatus');
        $tahun = $this->input->post('tahunStatus');
        $bulantahun = $tahun . $bulan;

        $data = $this->PengajuanGaji->laporan($bulantahun);
        echo json_encode($data);
    }

    public function filter_per_mitra()
    {
        $bulan = $this->input->post('bulanMitra');
        $tahun = $this->input->post('tahunMitra');
        $bulantahun = $tahun . $bulan;

        $data = $this->RateMitra->laporan($bulantahun);
        echo json_encode($data);
    }
}
