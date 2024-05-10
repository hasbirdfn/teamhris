<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Lowonganpekerjaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Recruitment/pekerjaan_model');
    }
    public function index()
    {
        $data['title'] = 'Lowonganpekerjaan';
        $data['pekerjaan'] = $this->pekerjaan_model->tampilPekerjaan();
        $this->load->view('Lowonganpekerjaan', $data);
    }

    public function upload_cv()
    {
        // Load library untuk upload file
        $this->load->library('upload');

        // Konfigurasi upload file
        $config['upload_path'] = './dist/cv';
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['max_size'] = 2048; // dalam kilobita

        $this->upload->initialize($config);

        // Lakukan upload file
        if ($this->upload->do_upload('cv')) {
            // Jika upload berhasil, simpan nama file ke database
            $filename = $this->upload->data('file_name');
            $data = [
                'file_cv' => $filename,
                'email' => $this->input->post('email'),
                'status' => 'pelamar',
                'id_pekerjaan' => $this->input->post('id_posisi'),
                'nama' => $this->input->post('nama'),
                'telepon' => $this->input->post('telepon'),
            ];

            $this->db->insert('recruitment___pelamar', $data);
            // Tampilkan pesan berhasil
            $this->session->set_flashdata('message', 'Data Berhasil Dikirim.');
        } else {
            // Jika upload gagal, tampilkan pesan error
            $this->session->set_flashdata('error', $this->upload->display_errors());
        }

        // Redirect kembali ke halaman profil
        redirect('Lowonganpekerjaan');
    }
}
