<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruang_hasil extends CI_Controller
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
		$data['title'] = ' ';
		$data['user'] = $this->Hris_model->ambilUser();
		$id_karyawan = $_SESSION['id_karyawan'];
		$data['hasil_karyawan'] = $this->m_data->get_peserta($id_karyawan);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('training/hasil_karyawan', $data);
		$this->load->view('templates/footer');
	}
}