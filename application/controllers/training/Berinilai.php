<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Berinilai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('training/Berinilai_model');
        $this->load->model('Hris_model');
        $this->load->model('DataKaryawan_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('training/m_data');

        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Data Soal";
        $data['datanilai'] = $this->Berinilai_model->getAllBerinilai();
        $data['user'] = $this->Hris_model->ambilUser();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        // printr($data['datapes']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('training/Beri_nilai', $data);
        $this->load->view('templates/footer');
    }

    public function ubah()
    {
        $data['title'] = "Data Soal";
        $data['datanilai'] = $this->Berinilai_model->getAllBerinilai();
        $data['user'] = $this->Hris_model->ambilUser();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();

        $this->form_validation->set_rules('posisi', 'Posisi', 'required', [
            'required' => 'Posisi harus diisi !'
        ]);
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required', [
            'required' => 'Tanggal harus diisi !'
        ]);

        $this->form_validation->set_rules('jenis_ujian', 'jenis ujian', 'required', [
            'required' => 'jenis ujian harus diisi !'
        ]);
        $this->form_validation->set_rules('durasi_ujian', 'Durasi ujian', 'required', [
            'required' => 'Tanggal harus diisi !'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('training/Beri_nilai', $data);
            $this->load->view('templates/footer');
        } else {
            // $data = $this->upload_berkas();
            // $dokumen = $data['file_name'];
            $this->Berinilai_model->UbahBerinilai();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('training/Berinilai');
        }
    }
    public function download_hasil($filename)
    {
        // Menentukan path file yang akan didownload
        $file_path = './dist/record/' . $filename;
        if (!file_exists($file_path)) {
            redirect('training/Berinilai');
        };
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($file_path));
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        readfile($file_path);
    }
    public function upload_berkas()
    {
        $config['upload_path'] = './dist/record';
        $config['max_size'] = '4024';
        $config['allowed_types'] = 'doc|docx|pdf';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('dokumen_soal')) {
            return $this->upload->data();
        } else {
            return $this->upload->display_errors();
        }
    }
    public function hapus($id_nilai)
    {
        if ($this->Berinilai_model->hapus($id_nilai)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus');
        }
        redirect('training/Berinilai');
    }




    public function uploadtambah()
    {
        // Load library untuk upload file
        $this->load->library('upload');

        // Konfigurasi upload file
        $config['upload_path'] = './dist/record/';
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['max_size'] = 2048; // dalam kilobita

        $this->upload->initialize($config);

        // Lakukan upload file
        if ($this->upload->do_upload('Sertifikat')) {
            // Jika upload berhasil, simpan nama file ke database
            $filename = $this->upload->data('file_name');
            $data = [
                'sertifikat' => $filename,
                'id_karyawan' => $this->input->post('nama_karyawan'),
                'kalkulasi_nilai' => $this->input->post('kalkulasi_nilai'),
            ];

            $this->db->insert('data_nilai', $data);
            // Tampilkan pesan berhasil
            $this->session->set_flashdata('message', 'Data Berhasil Dikirim.');
        } else {
            // Jika upload gagal, tampilkan pesan error
            $this->session->set_flashdata('error', $this->upload->display_errors());
        }

        // Redirect kembali ke halaman profil
        redirect('training/Berinilai');
    }

    public function uploadubah()
    {
        // Load library untuk upload file
        $this->load->library('upload');

        // Konfigurasi upload file
        $config['upload_path'] = './dist/record/';
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['max_size'] = 2048; // dalam kilobita

        $this->upload->initialize($config);

        // Lakukan upload file
        if ($this->upload->do_upload('Sertifikat')) {
            // Jika upload berhasil, simpan nama file ke database
            $filename = $this->upload->data('file_name');
            $data = [
                'sertifikat' => $filename,
                'id_karyawan' => $this->input->post('nama_karyawan'),
                'kalkulasi_nilai' => $this->input->post('kalkulasi_nilai'),
            ];
            $this->db->where('id_nilai', $this->input->post('id_nilai'));

            $this->db->update('data_nilai', $data);
            // Tampilkan pesan berhasil
            $this->session->set_flashdata('message', 'Data Berhasil Dikirim.');
        } else {
            // Jika upload gagal, tampilkan pesan error
            $this->session->set_flashdata('error', $this->upload->display_errors());
        }

        // Redirect kembali ke halaman profil
        redirect('training/Berinilai');
    }
}
