<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruang_ujian extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('training/peserta_model');
		$this->load->model('training/m_data');
		$this->load->model('Hris_model');
		$this->load->model('DataPosisi_model');
		$this->load->model('DataKaryawan_model');
		$this->load->model('training/Soal_model');
	}

	public function soal($id_peserta)
	{
		$data['title'] = ' ';
		$data['user'] = $this->Hris_model->ambilUser();
		// printr($data['user']);
		$id = $this->db->query('SELECT * FROM tb_peserta WHERE id_peserta="' . $id_peserta . '"  ')->row_array();
		$soal_ujian = $this->db->query('SELECT * FROM tb_soal WHERE id_posisi="' . $id['id_posisi'] . '" ORDER BY RAND()');
		$where = array('id_peserta' => $id_peserta);
		$data2 = array('status_ujian_ujian' => 1);
		$this->m_data->update_data($where, $data2, 'tb_peserta');
		$time = $id['timer_ujian'];
		$data['soal'] = $soal_ujian->result();
		$data['total_soal'] = $soal_ujian->num_rows();
		$data['max_time'] = $time;
		$data['id'] = $id;
		// printr($data);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('training/soalujian', $data);
		$this->load->view('templates/footer');
	}

	public function jawab_aksi()
	{
		$data['title'] = ' ';
		$data['user'] = $this->Hris_model->ambilUser();
		$id_peserta = $this->input->post('id_peserta');
		$jumlah 	= $_POST['jumlah_soal'];
		$id_soal 	= $_POST['soal'];
		$jawaban 	= $_POST['jawaban'];
		for ($i = 0; $i < $jumlah; $i++) {
			$nomor = $id_soal[$i];
			$jawaban[$nomor];
			$data_jawaban[] = array(
				'id_peserta' => $id_peserta,
				'id_soal_ujian' => $nomor,
				'jawaban' => $jawaban[$nomor]
			);
		}
		$this->db->insert_batch('tb_jawaban', $data_jawaban);
		$cek = $this->db->query('SELECT id_jawaban, jawaban, tb_soal.kunci_jawaban FROM tb_jawaban join tb_soal ON tb_jawaban.id_soal_ujian=tb_soal.id_soal_ujian WHERE id_peserta="' . $id_peserta . '"');
		$jumlah = $cek->num_rows();
		foreach ($cek->result_array() as $d) {
			$where = $d['id_jawaban'];
			if ($d['jawaban'] == $d['kunci_jawaban']) {
				$data = array(
					'skor' => 1,
				);
				$this->m_data->UpdateNilai($where, $data, 'tb_jawaban');
			} else {
				$data = array(
					'skor' => 0,
				);
				$this->m_data->UpdateNilai($where, $data, 'tb_jawaban');
			}
		}

		$benar = 0;
		$salah = 0;
		$total_nilai = 0;
		$cek2 = $this->db->query('SELECT id_jawaban, jawaban, skor, tb_soal.kunci_jawaban FROM tb_jawaban join tb_soal ON tb_jawaban.id_soal_ujian=tb_soal.id_soal_ujian WHERE id_peserta="' . $id_peserta . '"');
		$jumlah = $cek2->num_rows();
		$where = $id_peserta;
		foreach ($cek2->result_array() as $c) {
			if ($c['jawaban'] == $c['kunci_jawaban']) {
				$benar++;
			} else {
				$salah++;
			}
			$total_nilai += $c['skor'] / $jumlah * 100;
		}
		$data = array(
			'benar' => $benar,
			'salah' => $salah,
			'status_ujian' => 2,
			'status_ujian_ujian' => 2,
			'nilai' => $total_nilai
		);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->m_data->UpdateNilai2($where, $data, 'tb_peserta');
		$this->load->view('templates/footer');
		redirect('training/jadwal_ujian');
	}
}
