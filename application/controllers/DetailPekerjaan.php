<?php
defined('BASEPATH') or exit('No direct script access allowed');



class DetailPekerjaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Recruitment/Pekerjaan_model');
        $this->load->model('DataPosisi_model', 'posisi');
    }
    public function index($id)
    {
        $data['title'] = 'Detail Pekerjaan';
        $data['pekerjaan'] = $this->Pekerjaan_model->ambilUserById($id);
        $deskripsi_pekerjaan = $this->Pekerjaan_model->deskripsi($id);
        $kualifikasi = $this->Pekerjaan_model->kualifikasi($id);
        $data['posisi'] = $this->posisi->getAllDataPosisi();


        $array_deskripsi = [];
        if (!is_null($deskripsi_pekerjaan)) {
            foreach ($deskripsi_pekerjaan as $dp) {
                $array_deskripsi = explode("\n", $dp);
            }
        }
        $data['array_deskripsi'] = $array_deskripsi;


        $array_kualifikasi = [];
        if (!is_null($kualifikasi)) {
            foreach ($kualifikasi as $dp) {
                $array_kualifikasi = explode("\n", $dp);
            }
        }
        $data['array_kualifikasi'] = $array_kualifikasi;
        $this->load->view('detailpekerjaan', $data);
    }

    public function upload_cv()
    {
        $id = $this->input->post('id');
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
            $this->session->set_flashdata('message', 'Data berhasil dikirim');
        } else {
            // Jika upload gagal, tampilkan pesan error
            $this->session->set_flashdata('error', $this->upload->display_errors());
        }

        // Redirect kembali ke halaman profil
        redirect('DetailPekerjaan/index/' . $id);
    }
}
