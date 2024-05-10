<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenilaiRekan1 extends CI_Controller
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

    private function extract_nik_penilai()
    {
        $nik = $this->session->userdata("nik");
        $tgl_skrg = date("m/Y");
        $sudah_menilai = $this->db->query("SELECT pk.nik_menilai
        FROM performances___penilaian_kuesioner pk WHERE pk.nik_penilai ='$nik'")->result_array();

        $temp = [];
        foreach ($sudah_menilai as $item):
            $temp[] = $item['nik_menilai'];
        endforeach;
        return $temp;
    }

    public function index()
    {
        $nik = $this->session->userdata("nik");
        $data['title'] = "Menilai Rekan1";
        $data['user'] = $this->Hris_model->ambilUser();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getDataKaryawanExcept($nik);
        $data['sudah_menilai'] = $this->extract_nik_penilai();
        $data['soalkuesioner'] = $this->SoalKuesioner_model->getAllSoalKuesioner();
        $currentDate = date('m/Y');
        $data['datakaryawan'] = $this->db->query("SELECT 
        dk.nik,
        dk.nama_karyawan
        FROM data_karyawan dk
        WHERE dk.nik != '$nik'
        AND dk.nik NOT IN (SELECT pk.nik_menilai FROM performances___penilaian_kuesioner pk WHERE tanggal='$currentDate' AND pk.nik_penilai = '$nik')
        ")->result_array();
        // printr($data['datakaryawan']);



        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/menilairekan1', $data);
        $this->load->view('templates/footer');
    }

    public function simpan()
    {
        $id_penilaian_kuesioner = $this->insert_tabel_penilaian_kuesioner();
        $this->insert_tabel_detail_penilaian_kuesioner($id_penilaian_kuesioner);
        redirect('Performances/MenilaiRekan1');
        $this->session->set_flashdata('message', ' Data berhasil disimpan!');
        redirect('Performances/MenilaiRekan1');
    }

    private function insert_tabel_detail_penilaian_kuesioner($id_penilaian_kuesioner)
    {
        $post = $this->input->post();
        $nik_penilai = $this->session->userdata("nik");
        $nik_menilai = $post["nik_menilai"];

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
            );
            // echo "<pre>" . print_r($data_insert_tabel_performances__detail_penilaian_kuesioner, true) . "</pre>";
        endforeach;
        $this->session->set_flashdata('message', ' Data berhasil disimpan!');
        redirect('Performances/MenilaiRekan1');
    }

    private function insert_tabel_penilaian_kuesioner()
    {
        $post = $this->input->post();
        $nik_menilai = $post["nik_menilai"];
        $total_nilai = array_sum($post["nilai"]);
        $nik_penilai = $this->session->userdata("nik");
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
        redirect('Performances/MenilaiRekan1');
    }

}