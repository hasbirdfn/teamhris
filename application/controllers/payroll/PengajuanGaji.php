<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PengajuanGaji extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('dompdf_gen');
        $this->load->model('payroll/PengajuanGaji_model', 'PengajuanGaji');
        $this->load->model('payroll/Perhitungan_model', 'Perhitungan');
        $this->load->model('payroll/DataPajak_model', 'DataPajak');
        $this->load->model('payroll/Pajak_model', 'Pajak');
        $this->load->model('DataKaryawan_model', 'DataKaryawan');
        $this->load->model('Hris_model', 'Hris');
        if (!$this->session->userdata('nik')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['title'] = "Pengajuan Gaji Karyawan";
        $data['pengajuan'] = $this->PengajuanGaji->tampilPengajuan();
        $data['user'] = $this->Hris->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/PengajuanGaji', $data);
        $this->load->view('templates/footer');
    }

    public function generate()
    {
        $data['title'] = "Pengajuan Gaji Karyawan";
        $data['generate'] = $this->PengajuanGaji->generate();
        $data['pengajuan'] = $this->PengajuanGaji->tampilPengajuan();
        $data['user'] = $this->Hris->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/pengajuangaji', $data);
        $this->load->view('templates/footer');

        $this->session->set_flashdata('message', 'Data berhasil digenerate');
        redirect('payroll/PengajuanGaji');
    }

    public function status($id)
    {
        $this->PengajuanGaji->statusBayar($id);
        $this->session->set_flashdata('message', 'Status bayar berhasil diubah!');
        redirect('payroll/PengajuanGaji');
    }

    private function _kirimEmail()
    {
        $pdf = $this->dompdf->output();
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'belajarcoding78@gmail.com',
            'smtp_pass' => 'yivnmnsocwasssvv',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'wordwrap'  => TRUE
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('belajarcoding78@gmail.com', 'PT. Sahaware Teknologi Indonesia');
        $this->email->to($this->input->post('email'));

        $this->email->subject('Slip Gaji');

        $data = [
            'nama' => $this->input->post('nama_karyawan2'),
            'posisi' => $this->input->post('posisi2'),
            'nik' => $this->input->post('nik2'),
            'bulan_tahun' => $this->input->post('bulan_tahun'),
        ];
        $card = $this->load->view('payroll/pesan_email', $data, TRUE);
        $this->email->message($card);

        $this->email->attach($pdf, 'application/pdf', "Slip Gaji" . ".pdf", false);

        $r = $this->email->send();
        if (!$r) {
            // "Failed to send email:" . $this->email->print_debugger(array("header")));
            $this->session->set_flashdata('error', 'Gagal kirim!');
            redirect('payroll/PengajuanGaji');
        } else {
            // "Email sent"
            $this->session->set_flashdata('message', 'Slip gaji berhasil dikirim!');
            redirect('payroll/PengajuanGaji');
        }
    }
    // private function _kirimEmail()
    // {
    //     $pdf = $this->dompdf->output();
    //     $config = [
    //         'protocol' => 'smtp',
    //         'smtp_host' => 'ssl://smtp.googlemail.com',
    //         'smtp_port' => 465,
    //         'smtp_user' => 'belajarcoding78@gmail.com',
    //         'smtp_pass' => 'mxaghqdhdmsbcjmz',
    //         'mailtype' => 'html',
    //         'charset' => 'utf-8',
    //         'newline' => "\r\n",
    //         'wordwrap'  => TRUE
    //     ];

    //     $this->load->library('email', $config);
    //     $this->email->initialize($config);

    //     $this->email->from('belajarcoding78@gmail.com', 'PT. Sahaware Teknologi Indonesia');
    //     $this->email->to($this->input->post('email'));

    //     $this->email->subject('Slip Gaji');
    //     $this->email->message('Kirim slip gaji');

    //     $this->email->attach($pdf, 'application/pdf', "Slip Gaji" . ".pdf", false);

    //     $r = $this->email->send();
    //     if (!$r) {
    //         // "Failed to send email:" . $this->email->print_debugger(array("header")));
    //         $this->session->set_flashdata('error', 'Gagal kirim!');
    //         redirect('payroll/PengajuanGaji');
    //     } else {
    //         // "Email sent"
    //         $this->session->set_flashdata('message', 'Slip gaji berhasil dikirim!');
    //         redirect('payroll/PengajuanGaji');
    //     }
    // }

    public function upload_file()
    {
        $config['upload_path'] = './dist/slipgaji';
        $config['max_size'] = '4024';
        $config['allowed_types'] = 'doc|docx|pdf';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('slipgaji')) {
            return $this->upload->data();
        } else {
            return $this->upload->display_errors();
        }
    }

    // public function kirimSlip($id)
    // {
    //     $data = $this->PengajuanGaji->ambilKaryawanById($id);
    //     $this->_kirimEmail($data);
    // }

    public function kirimSlip($id)
    {
        $data['slipgaji'] = $this->PengajuanGaji->ambilKaryawanById($id);
        $this->load->view('payroll/cetak/cetakslippdf', $data);

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->_kirimEmail();
    }

    public function cetakGaji()
    {
        $data['title'] = "Pengajuan Gaji Karyawan";
        // ambil data dari form
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $bulantahun = $tahun . $bulan;
        $data['cetak_gaji'] = $this->PengajuanGaji->cetakGaji($bulantahun);
        if (count($data['cetak_gaji']) > 0) {
            $this->load->view('payroll/cetak/cetakgajipdf', $data);

            $paper_size = 'A4';
            $orientation = 'potrait';
            $html = $this->output->get_output();
            $this->dompdf->set_paper($paper_size, $orientation);

            $this->dompdf->load_html($html);
            $this->dompdf->render();
            $this->dompdf->stream('pengajuan_gaji.pdf', array('Attachment' => 0));
        } else {
            $this->session->set_flashdata('error', 'Tidak ada data untuk dicetak!');
            redirect('payroll/PengajuanGaji');
        }
    }

    public function excel()
    {
        $data['title'] = "Pengajuan Gaji Karyawan";
        // ambil data dari form
        $data['bulan'] = $this->input->post('bulan');
        $data['tahun'] = $this->input->post('tahun');
        $bulantahun = $data['tahun'] . $data['bulan'];
        $data['cetak_gaji'] = $this->PengajuanGaji->cetakGaji($bulantahun);
        if (count($data['cetak_gaji']) > 0) {
            $this->load->view('payroll/cetak/cetakgajiexcel', $data);
        } else {
            $this->session->set_flashdata('error', 'Tidak ada data untuk dicetak!');
            redirect('payroll/PengajuanGaji');
        }
    }

    public function cetak_slip($id)
    {
        $data['slipgaji'] = $this->PengajuanGaji->ambilKaryawanById($id);
        $this->load->view('payroll/cetak/cetakslippdf', $data);

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream('slip_gaji.pdf', array('Attachment' => 0));
    }

    public function list()
    {
        // POST data
        $postData = $this->input->post();

        // Get data
        $data = $this->PengajuanGaji->dataTable($postData);

        echo json_encode($data);
    }
}