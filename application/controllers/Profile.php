<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('ModelUser');
    }
    public function index()
    {
        $data['title'] = 'Profile Saya';
        $data['user'] = $this->ModelUser->ambilUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('hris/profile', $data);
        $this->load->view('templates/footer');
    }
    public function ubahprofile()
    {
        $data['title'] = 'Ubah Profile';
        $data['User'] = $this->ModelUser->ambilUser();

        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama Tidak Boleh Kosong'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('hris/ubahprofile', $data);
            $this->load->view('templates/footer');
        } else {
            $nama = $this->input->post('name', true);
            $email = $this->input->post('email', true);

            ///jika gambar di upload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['upload_path'] = './dist/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $congig['max_size'] = '3000';
                $config['max_width'] = '1024';
                $config['max_height'] = '1000';
                $config['file_name'] = 'pro' . time();

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $gambar_lama = $data['user']['image'];
                    if ($gambar_lama != 'default.jpg') {
                        unlink(FCPATH . 'dist/img/profile/' . $gambar_lama);
                    }
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                }
            }

            $this->db->set('name', $nama);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Profil Berhasil Diubah</div>');
            redirect('user');
        }
    }
}