<?php
defined('BASEPATH') or exit('No direct script access allowed');

class peserta extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('training/peserta_model');
        $this->load->model('training/m_data');
        $this->load->model('Hris_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('DataKaryawan_model');
    }

    public function index()
    {

        if (isset($_GET['idkelas']) and isset($_GET['idkaryawan'])) {
            $idkelas = $this->input->get('idkelas');
            $idkaryawan = $this->input->get('idkaryawan');
            $data['peserta'] = $this->peserta_model->get_peserta($idkelas, $idkaryawan)->result();
            $data['kelas'] = $this->m_data->get_data('tb_kelas')->result();
            $data['karyawan'] = $this->m_data->get_data('data_karyawan')->result();
        } else if (isset($_GET['idkelas'])) {
            $idkelas = $this->input->get('idkelas');
            $data['peserta'] = $this->peserta_model->get_peserta2($idkelas)->result();
            $data['kelas'] = $this->m_data->get_data('tb_kelas')->result();
            $data['karyawan'] = $this->m_data->get_data('data_karyawan')->result();
        } else if (isset($_GET['idkaryawan'])) {
            $idkaryawan = $this->input->get('idkaryawan');
            $data['peserta'] = $this->peserta_model->get_peserta3($idkaryawan)->result();
            $data['kelas'] = $this->m_data->get_data('tb_kelas')->result();
            $data['karyawan'] = $this->m_data->get_data('data_karyawan')->result();
        } else {
            $data['peserta'] = $this->peserta_model->get_peserta4()->result();
            $data['kelas'] = $this->m_data->get_data('tb_kelas')->result();
            $data['karyawan'] = $this->m_data->get_data('data_karyawan')->result();
        }
        $data['title'] = '  ';
        $data['user'] = $this->Hris_model->ambilUser();
        $data['DataPosisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('training/peserta', $data);
        $this->load->view('templates/footer');
    }

    public function hapus($id)
    {
        $where = array(
            'id_peserta' => $id
        );
        $this->m_data->delete_data($where, 'tb_peserta');
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Data Peserta Ujian berhasil di hapus !</h4></div>');
        redirect('training/peserta');
    }


    public function edit($id)
    {
        $data['peserta'] = $this->peserta_model->get_joinpeserta($id);
        $data['posisi'] = $this->m_data->get_data('data_posisi')->result();
        $data['karyawan'] = $this->m_data->get_data('data_karyawan')->result();
        $data['jenis_ujian'] = $this->m_data->get_data('tb_jenis_ujian')->result();
        $data['user'] = $this->Hris_model->ambilUser();
        $data['title'] = 'peserta ujian';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('training/peserta_edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $peserta         = $this->input->post('peserta');
        $posisi             = $this->input->post('posisi');
        $tanggal        = $this->input->post('tanggal');
        $jam            = $this->input->post('jam');
        $durasi_ujian        = $this->input->post('durasi_ujian');
        $jenis            = $this->input->post('jenis');
        $timer_ujian         = $durasi_ujian * 60;
        $where  = array('id_peserta' => $this->input->post('id'));

        if ($peserta == '' || $posisi == '' || $tanggal == '' || $jam == '' || $durasi_ujian == '' || $jenis == '') {

            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> semua field harus diisi semua !</h4></div>');
            redirect('training/Peserta');
        } else {
            $data = array(
                'id_karyawan'        => $peserta,
                'id_posisi'        => $posisi,
                'id_jenis_ujian'    => $jenis,
                'tanggal_ujian'        => $tanggal,
                'jam_ujian'            => $jam,
                'durasi_ujian'            => $durasi_ujian,
                'timer_ujian'            => $timer_ujian,
                'status_ujian'            => 1

            );

            $this->m_data->update_data($where, $data, 'tb_peserta');
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Data berhasil di Update.</h4></div>');
            redirect('training/peserta');
        }
        $data['user'] = $this->Hris_model->ambilUser();
        $data['title'] = 'peserta ujian';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('training/peserta', $data);
        $this->load->view('templates/footer');
    }
}
