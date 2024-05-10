<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pekerjaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Recruitment/Pekerjaan_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('Hris_model');

        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        // printr($_SESSION);
        $data['title'] = "Pekerjaan";
        $data['pekerjaan'] = $this->Pekerjaan_model->tampilPekerjaan();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('recruitment/pekerjaan', $data);
        $this->load->view('templates/footer');
    }


    public function tambah_pekerjaan()
    {
        // Load library untuk upload file
        $this->load->library('upload');

        // Konfigurasi upload file
        $config['upload_path'] = './dist/img/lowongan/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $congig['max_size'] = '3000';
        $config['file_name'] = 'pro' . time();

        $this->upload->initialize($config);

        // Lakukan upload file
        if ($this->upload->do_upload('foto')) {
            // Jika upload berhasil, simpan nama file ke database
            $filename = $this->upload->data('file_name');
            $data = [
                'id_posisi' => htmlspecialchars($this->input->post('posisi')),
                'deskripsi_pekerjaan' => htmlspecialchars($this->input->post('deskripsi_pekerjaan')),
                'kualifikasi' => htmlspecialchars($this->input->post('kualifikasi')),
                'tanggal_berakhir' => htmlspecialchars($this->input->post('tanggal_berakhir')),
                'foto' => $filename,
            ];

            $this->db->insert('recruitment___pekerjaan', $data);
            // Tampilkan pesan berhasil
            $this->session->set_flashdata('message', 'Data Berhasil Ditambah.');
        } else {
            // Jika upload gagal, tampilkan pesan error
            $this->session->set_flashdata('error', $this->upload->display_errors());
        }

        // Redirect kembali ke halaman profil
        redirect('Recruitment/Pekerjaan');
    }




    public function ubah_pekerjaan()
    {
        // Load library untuk upload file
        $this->load->library('upload');

        // Konfigurasi upload file
        $config['upload_path'] = './dist/img/lowongan/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $congig['max_size'] = '3000';
        $config['file_name'] = 'pro' . time();

        $this->upload->initialize($config);

        // Ambil ID pekerjaan dari form input
        $id_pekerjaan = $this->input->post('id_pekerjaan');

        // Ambil data pekerjaan dari database berdasarkan ID
        $data_pekerjaan = $this->db->get_where('recruitment___pekerjaan', ['id_pekerjaan' => $id_pekerjaan])->row_array();

        // Lakukan upload file jika ada perubahan pada gambar
        if ($this->upload->do_upload('foto')) {
            // Jika upload berhasil, simpan nama file ke database
            $filename = $this->upload->data('file_name');
            $data_pekerjaan['foto'] = $filename;
        }

        // Update data pekerjaan dengan data yang diambil dari form input atau hasil upload file
        $data_pekerjaan['id_posisi'] = htmlspecialchars($this->input->post('posisi'));
        $data_pekerjaan['deskripsi_pekerjaan'] = htmlspecialchars($this->input->post('deskripsi_pekerjaan'));
        $data_pekerjaan['kualifikasi'] = htmlspecialchars($this->input->post('kualifikasi'));
        $data_pekerjaan['tanggal_berakhir'] = htmlspecialchars($this->input->post('tanggal_berakhir'));
        // Simpan data pekerjaan yang sudah diupdate ke database
        $this->db->where('id_pekerjaan', $id_pekerjaan);
        $this->db->update('recruitment___pekerjaan', $data_pekerjaan);

        // Tampilkan pesan berhasil
        $this->session->set_flashdata('message', 'Data Berhasil Diubah.');

        // Redirect kembali ke halaman profil
        redirect('Recruitment/pekerjaan');
    }

    public function hapus($id_pekerjaan)
    {
        if ($this->Pekerjaan_model->hapus($id_pekerjaan)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('Recruitment/pekerjaan');
    }
}
