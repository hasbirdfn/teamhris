<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class soal_ujian extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('training/Soal_model');
		$this->load->model('training/m_data');
		$this->load->model('Hris_model');
		$this->load->model('DataPosisi_model');
	}

	public function index()
	{
		$data['title'] = ' ';
		$data['user'] = $this->Hris_model->ambilUser();
		if (isset($_GET['id'])) {
			$id = $this->input->get('id');
			$data['soal_ujian'] = $this->db->query('SELECT * from tb_soal join data_posisi where tb_soal.id_posisi=data_posisi.id_posisi and data_posisi.id_posisi="' . $id . '" order by id_soal_ujian desc')->result();
			$data['kelas'] = $this->m_data->get_data('data_posisi')->result();
		} else {
			$data['soal_ujian'] = $this->db->query('SELECT * FROM tb_soal join data_posisi ON tb_soal.id_posisi=data_posisi.id_posisi order by id_soal_ujian desc')->result();
			$data['kelas'] = $this->m_data->get_data('data_posisi')->result();
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('training/soal_ujian', $data);
		$this->load->view('templates/footer');
	}
	public function edit($id)
	{
		$data['title'] = 'Data Soal';
		$data['soal'] = $this->Soal_model->get_joinsoal($id)->result();
		$data['kelas'] = $this->m_data->get_data('data_posisi')->result();
		$data['user'] = $this->Hris_model->ambilUser();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('training/soal_ujian_edit', $data);
		$this->load->view('templates/footer');
	}


	public function update()
	{
		$data['title'] = 'Edit Soal';
		$data['user'] = $this->Hris_model->ambilUser();
		$id 				= $this->input->post('id');
		$id_posisi 	= $this->input->post('id_posisi');
		$soal				= $this->input->post('soal');
		$a 					= $this->input->post('a');
		$b					= $this->input->post('b');
		$c					= $this->input->post('c');
		$d					= $this->input->post('d');
		$e					= $this->input->post('e');
		$kunci				= $this->input->post('kunci');

		$where = array('id_soal_ujian' => $id);
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
		$this->m_data->update_data($where, $data, 'tb_soal');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Selamat, Soal telah berhasil diupdate!</h4></div>');
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('training/soal_ujian', $data);
		$this->load->view('templates/footer');
		redirect(base_url('training/soal_ujian'));
	}

	public function hapus($id)
	{
		$data['title'] = 'Data Soal';
		$data['user'] = $this->Hris_model->ambilUser();
		$where = array(
			'id_soal_ujian' => $id
		);
		$this->m_data->delete_data($where, 'tb_soal');
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Perhatian, Data telah berhasil dihapus!</h4></div>');
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('training/soal_ujian', $data);
		$this->load->view('templates/footer');
		redirect('training/soal_ujian');
	}
	function import()
	{
		$data['DataPosisi'] = $this->DataPosisi_model->getAllDataPosisi();
		$config['allowed_types'] = 'xlsx|xls';
		$config['upload_path'] = './dist/import';
		$config['file_name'] = 'doc' . time();

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('import')) {
			$file = $this->upload->data();
			$reader = ReaderEntityFactory::createXLSXReader();

			$reader->open('./dist/import/' . $file['file_name']);
			foreach ($reader->getSheetIterator() as $sheet) {
				$numRow = 1;
				foreach ($sheet->getRowIterator() as $row) {
					foreach ($data['DataPosisi'] as $dp) {
						if ($dp['nama_posisi'] == $row->getCellAtIndex(0)) {
							$ds = $dp['id_posisi'];
						}
					}
					if ($numRow > 1) {
						$data = array(
							'id_posisi' => htmlspecialchars($ds),
							'pertanyaan' => htmlspecialchars($row->getCellAtIndex(1)),
							'a' => htmlspecialchars($row->getCellAtIndex(2)),
							'b' => htmlspecialchars($row->getCellAtIndex(3)),
							'c' => htmlspecialchars($row->getCellAtIndex(4)),
							'd' => htmlspecialchars($row->getCellAtIndex(5)),
							'e' => htmlspecialchars($row->getCellAtIndex(6)),
							'kunci_jawaban' => htmlspecialchars($row->getCellAtIndex(7)),
						);
						$this->Soal_model->import_data($data);
					}
					$numRow++;
				}
				$reader->close();
				unlink('./dist/import/' . $file['file_name']);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil diimport!</div>');
				redirect('training/soal_ujian');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
			redirect('training/soal_ujian');
		};
	}
}
