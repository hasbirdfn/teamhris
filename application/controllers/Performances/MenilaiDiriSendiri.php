<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenilaiDiriSendiri extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataPosisi_model');
        $this->load->model('DataKaryawan_model');
        $this->load->model('SoalKuesioner_model');
        $this->load->model('Hris_model');
        if (!$this->session->userdata('nik')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $nik = $this->session->userdata("nik");
        $data['title'] = "Menilai Diri Sendiri";
        $data['user'] = $this->Hris_model->ambilUser();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getDataKaryawanExcept($nik);
        $data['soalkuesioner'] = $this->SoalKuesioner_model->getAllSoalKuesioner();



        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/menilaidirisendiri', $data);
        $this->load->view('templates/footer');
    }

    public function simpan()
    {
        $id_penilaian_kuesioner = $this->insert_tabel_penilaian_kuesioner();
        $this->insert_tabel_detail_penilaian_kuesioner($id_penilaian_kuesioner);
        redirect("performances/MenilaiDiriSendiri");
        $this->session->set_flashdata('message', ' Data berhasil disimpan!');
        redirect('Performances/MenilaiDiriSendiri');
    }

    private function insert_tabel_detail_penilaian_kuesioner($id_penilaian_kuesioner)
    {
        $post = $this->input->post();
        $nik_penilai = $this->session->userdata("nik");
        $nik_menilai = $this->session->userdata("nik");

        foreach ($post["nilai"] as $id_kuesioner => $nilai):
            $data_insert_tabel_performances__detail_penilaian_kuesioner = [
                "id_kuesioner" => $id_kuesioner,
                "id_penilaian_kuesioner" => $id_penilaian_kuesioner,
                "nik_penilai" => $nik_penilai,
                "nik_menilai" => $nik_menilai,
                "tanggal" => date("m/Y"),
                "nilai" => $nilai
            ];
            $this->db->insert(
                "performances___detail_penilaian_kuesioner",
                $data_insert_tabel_performances__detail_penilaian_kuesioner
            ); //
            // echo "<pre>" . print_r($data_insert_tabel_performances__detail_penilaian_kuesioner, true) . "</pre>";
        endforeach;
        $this->session->set_flashdata('message', ' Data berhasil disimpan!');
        redirect('Performances/MenilaiDiriSendiri');
    }

    private function insert_tabel_penilaian_kuesioner()
    {
        $post = $this->input->post();
        $nik_penilai = $this->session->userdata("nik");
        $nik_menilai = $this->session->userdata("nik");
        $total_nilai = array_sum($post["nilai"]);
        $total_soal = count($post["nilai"]);

        $data_insert_tabel_performances___penilaian_kuesioner = [
            "nik_penilai" => $nik_penilai,
            "nik_menilai" => $nik_menilai,
            "tanggal" => date("m/Y"),
            "total_nilai" => $total_nilai,
            "total_soal" => $total_soal,
            "saran" => $post['saran']
        ];
        $this->db->insert("performances___penilaian_kuesioner", $data_insert_tabel_performances___penilaian_kuesioner);
        return $this->db->insert_id();
        $this->session->set_flashdata('message', ' Data berhasil disimpan!');
        redirect('Performances/MenilaiDiriSendiri');
    }

}