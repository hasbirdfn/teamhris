<?php
class peserta_tambah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('training/peserta_model');
        $this->load->model('Hris_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('DataKaryawan_model');
        $this->load->model('training/m_data');
    }

    public function index()
    {
        $data['title'] = ' ';
        $data['user'] = $this->Hris_model->ambilUser();
        if (isset($_GET['kelas'])) {
            $id = $this->input->get('kelas');
            $data['karyawan'] = $this->db->query('SELECT * from data_karyawan join tb_kelas where data_karyawan.id_kelas=tb_kelas.id_kelas and tb_kelas.id_kelas="' . $id . '"')->result();

            $data['kelas'] = $this->m_data->get_data('tb_kelas')->result();
            $data['posisi'] = $this->m_data->get_data('data_posisi')->result();
            $data['jenis_ujian'] = $this->m_data->get_data('tb_jenis_ujian')->result();
        } else {
            $data['karyawan'] = $this->db->query('SELECT * from data_karyawan join tb_kelas where data_karyawan.id_kelas=tb_kelas.id_kelas')->result();
            $data['kelas'] = $this->m_data->get_data('tb_kelas')->result();
            $data['posisi'] = $this->m_data->get_data('data_posisi')->result();
            $data['jenis_ujian'] = $this->m_data->get_data('tb_jenis_ujian')->result();
        }


        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('training/peserta_tambah', $data);
        $this->load->view('templates/footer');
    }

    public function insert_()
    {
        $data['title'] = 'Tambah Peserta';
        $data['user'] = $this->Hris_model->ambilUser();
        $data['posisi'] = $this->m_data->get_data('data_posisi')->result_array();

        $posisi             = $this->input->post('id_posisi');
        $tanggal_ujian        = $this->input->post('tanggal');
        $jam_ujian            = $this->input->post('jam');
        $deadline            = $this->input->post('jam');
        $id_jenis_ujian            = $this->input->post('id_jenis_ujian');
        $durasi_ujian        = $this->input->post('durasi_ujian');

        if ($posisi == '' || $tanggal_ujian == '' || $jam_ujian == '' || $deadline == '' || $durasi_ujian == '' || $id_jenis_ujian == '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Input Data Peserta Gagal !</h4> Cek kembali data yang diinputkan.</div>');
            redirect('training/peserta_tambah');
        } else {
            $this->m_data->insert_multiple();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Peserta Ujian berhasil dibuat !</h4></div>');
            redirect('training/Peserta', $data);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('training/peserta_tambah', $data);
        $this->load->view('templates/footer');
    }
}