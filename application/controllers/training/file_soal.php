<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class File_soal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('training/filesoal_model');
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
        $data['datapes'] = $this->filesoal_model->getAllfilesoal();
        $data['user'] = $this->Hris_model->ambilUser();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['jenis_ujian'] = $this->m_data->get_data('tb_jenis_ujian')->result_array();

        // printr($data['datapes']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('training/file_soal', $data);
        $this->load->view('templates/footer');
    }

    // public function tambah()
    // {

    //     $data['title'] = "Data Soal";
    //     $data['filesoal'] = $this->filesoal_model->getAllfilesoal();
    //     $data['user'] = $this->Hris_model->ambilUser();
    //     $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
    //     $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
    //     $data['jenis_ujian'] = $this->m_data->get_data('tb_jenis_ujian')->result_array();

    //     $this->form_validation->set_rules('posisi', 'Posisi', 'required', [
    //         'required' => 'Posisi harus diisi !'
    //     ]);
    //     $this->form_validation->set_rules('tanggal_ujian', 'Tanggal', 'required', [
    //         'required' => 'Tanggal harus diisi !'
    //     ]);

    //     $this->form_validation->set_rules('jenis_ujian', 'jenis ujian', 'required', [
    //         'required' => 'jenis ujian harus diisi !'
    //     ]);
    //     $this->form_validation->set_rules('durasi_ujian', 'Durasi ujian', 'required', [
    //         'required' => 'Tanggal harus diisi !'
    //     ]);

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/navbar', $data);
    //         $this->load->view('templates/sidebar', $data);
    //         $this->load->view('training/file_soal', $data);
    //         $this->load->view('templates/footer');
    //     } else {
    //         // $data = $this->upload_berkas();
    //         // $dokumen = $data['file_name'];
    //         $this->Filesoal_model->tambahfilesoal();
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
    //         redirect('training/File_soal');
    //     }
    // }

    public function ubah()
    {
        $data['title'] = "Data Soal";
        $data['filesoal'] = $this->filesoal_model->getAllfilesoal();
        $data['user'] = $this->Hris_model->ambilUser();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['jenis_ujian'] = $this->m_data->get_data('tb_jenis_ujian')->result_array();

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
            $this->load->view('training/file_soal', $data);
            $this->load->view('templates/footer');
        } else {
            // $data = $this->upload_berkas();
            // $dokumen = $data['file_name'];
            $this->Filesoal_model->UbahFilesoal();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('training/File_soal');
        }
    }
    public function download_hasil($filename)
    {
        // Menentukan path file yang akan didownload
        $file_path = './dist/cv/' . $filename;
        if (!file_exists($file_path)) {
            redirect('training/File_soal');
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
    public function hapus($id_pes)
    {
        if ($this->filesoal_model->hapus($id_pes)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus');
        }
        redirect('training/File_soal');
    }




    public function uploadtambah()
    {
        // Load library untuk upload file
        $this->load->library('upload');

        // Konfigurasi upload file
        $config['upload_path'] = './dist/cv';
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['max_size'] = 2048; // dalam kilobita

        $this->upload->initialize($config);

        // Lakukan upload file
        if ($this->upload->do_upload('dokumen_soal')) {
            // Jika upload berhasil, simpan nama file ke database
            $filename = $this->upload->data('file_name');
            $data = [
                'file_soal' => $filename,
                'id_karyawan' => $this->input->post('nama_karyawan'),
                'tanggal_ujian' => $this->input->post('tanggal_ujian'),
                'id_jenis_ujian' => $this->input->post('jenis_ujian'),
                'durasi_ujian' => $this->input->post('durasi_ujian'),
            ];

            $this->db->insert('data_pes', $data);
            // Tampilkan pesan berhasil
            $this->session->set_flashdata('message', 'Data Berhasil Dikirim.');
        } else {
            // Jika upload gagal, tampilkan pesan error
            $this->session->set_flashdata('error', $this->upload->display_errors());
        }

        // Redirect kembali ke halaman profil
        redirect('training/file_soal');
    }

    public function uploadubah()
    {
        // Load library untuk upload file
        $this->load->library('upload');

        // Konfigurasi upload file
        $config['upload_path'] = './dist/cv';
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['max_size'] = 2048; // dalam kilobita

        $this->upload->initialize($config);

        // Lakukan upload file
        if ($this->upload->do_upload('dokumen_soal')) {
            // Jika upload berhasil, simpan nama file ke database
            $filename = $this->upload->data('file_name');
            $data = [
                'file_soal' => $filename,
                'id_karyawan' => $this->input->post('nama_karyawan'),
                'tanggal_ujian' => $this->input->post('tanggal_ujian'),
                'id_jenis_ujian' => $this->input->post('jenis_ujian'),
                'durasi_ujian' => $this->input->post('durasi_ujian'),
            ];
            $this->db->where('id_pes', $this->input->post('id_pes'));

            $this->db->update('data_pes', $data);
            // Tampilkan pesan berhasil
            $this->session->set_flashdata('message', 'Data Berhasil Dikirim.');
        } else {
            // Jika upload gagal, tampilkan pesan error
            $this->session->set_flashdata('error', $this->upload->display_errors());
        }

        // Redirect kembali ke halaman profil
        redirect('training/file_soal');
    }
}