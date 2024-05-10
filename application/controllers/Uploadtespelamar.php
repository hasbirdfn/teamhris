<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Uploadtespelamar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('recruitment/Uploadtespelamar_model');
        $this->load->model('DataPosisi_model');
    }
    public function index()
    {
        $data['title'] = 'Upload Hasil Tes';
        $data['hasiltes'] = $this->Uploadtespelamar_model->getAllhasiltes();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $this->load->view('uploadtespelamar', $data);
    }

    public function upload_hasiltes()
    {
        // Load library untuk upload file
        $this->load->library('upload');

        // Konfigurasi upload file
        $config['upload_path'] = './dist/uploads';
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['max_size'] = 2048; // dalam kilobita

        $this->upload->initialize($config);

        // Lakukan upload file
        if ($this->upload->do_upload('uploadfile')) {
            // Jika upload berhasil, simpan nama file ke database
            $filename = $this->upload->data('file_name');
            $data = [
                'id_pekerjaan' => $this->input->post('posisi'),
                'hasil_link' => $this->input->post('uploadlink'),
                'hasil_file' => $filename,
                'nama' => $this->input->post('nama'),

            ];

            // Tampilkan pesan berhasil
            $this->db->insert('recruitment___hasiltes', $data);
            // Tampilkan pesan berhasil
            $this->session->set_flashdata('message', 'Hasil Tes Berhasil Dikirim.');
        } else {
            // Jika upload gagal, tampilkan pesan error
            $this->session->set_flashdata('error', $this->upload->display_errors());
        }

        // Redirect kembali ke halaman profil
        redirect('uploadtespelamar');
    }
}
