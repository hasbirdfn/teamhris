<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class dataadmin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('training/dataadmin_model');
        $this->load->model('Hris_model');

        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Data Total Training";
        $data['dataadmin'] = $this->dataadmin_model->getAlldataadmin();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('training/data_keseluruhanadmin', $data);
        $this->load->view('templates/footer');
    }

    public function download_file($filename)
    {
        // Menentukan path file yang akan didownload
        $file_path = './dist/uplod/' . $filename;
        if (!file_exists($file_path)) {
            redirect('training/Dataadmin');
        };
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($file_path));
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        readfile($file_path);
    }
}
