<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upload extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Hris_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
    }

    public function index()
    {
        $data['title'] = "Data Keseluruhan";
        $data['user'] = $this->Hris_model->ambilUser();

        $this->load->view('upload_form', array('error' => ' '));
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('training/upload', $data);
        $this->load->view('templates/footer');
    }

    public function do_upload()
    {
        // Konfigurasi upload file
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;

        $this->upload->initialize($config);

        // Validasi deadline
        $upload_time = $this->input->post('upload_time');
        $deadline = strtotime('2023-05-01 23:59:59'); // Deadline pada 1 Mei 2023 pukul 23:59:59
        $upload_timestamp = strtotime($upload_time);

        if ($upload_timestamp > $deadline) {
            // Jika waktu unggah melebihi deadline
            echo 'Maaf, waktu pengunggahan telah berakhir';
            return;
        }

        // Validasi tipe file
        $file_type = $this->input->post('file_type');
        if ($file_type !== 'pdf' && $file_type !== 'doc' && $file_type !== 'docx') {
            // Jika tipe file tidak diizinkan
            echo 'Maaf, tipe file yang diunggah tidak diizinkan';
            return;
        }

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('upload_form', $error);
        } else {
            $this->load->view('upload_success');
        }
    }
}
