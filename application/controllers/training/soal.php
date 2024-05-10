<?php
class soal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('training/Soal_model');
        $this->load->model('Hris_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('training/m_data');
    }

    public function index()
    {
        // menampilkan halaman soal
        $data['title'] = 'Tambah Soal';
        $data['soal'] = $this->m_data->get_data('data_posisi')->result_array();
        $data['user'] = $this->Hris_model->ambilUser();
        $data['DataPosisi'] = $this->DataPosisi_model->getAllDataPosisi();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('training/soal', $data);
        $this->load->view('templates/footer');
    }
    public function insert()
    {
        $id_posisi            = $this->input->post('id_posisi');
        $soal                = $this->input->post('soal');
        $a                     = $this->input->post('a');
        $b                    = $this->input->post('b');
        $c                    = $this->input->post('c');
        $d                    = $this->input->post('d');
        $e                    = $this->input->post('e');
        $kunci                = $this->input->post('kunci');
        $data = array(
            'id_posisi' => $id_posisi,
            'pertanyaan' => $soal,
            'a' => $a,
            'b' => $b,
            'c' => $c,
            'd' => $d,
            'e' => $e,
            'kunci_jawaban' => $kunci
        );
        // printr($data);
        $this->m_data->insert_data($data, 'tb_soal');

        $data['title'] = 'Tambah Soal';
        $data['soal'] = $this->m_data->get_data('data_posisi')->result_array();
        $data['user'] = $this->Hris_model->ambilUser();
        $data['DataPosisi'] = $this->DataPosisi_model->getAllDataPosisi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('training/soal', $data);
        $this->load->view('templates/footer');
        redirect('training/soal_ujian');
    }
}
