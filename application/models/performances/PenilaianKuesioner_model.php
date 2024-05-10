<?php

class PenilaianKuesioner_model extends CI_Model
{
    public function tampilPenilaianKuesioner()
    {
        $query = $this->db->query("SELECT 
        pk.id_penilaian_kuesioner,
        pk.nik_penilai,
        pk.nik_menilai,
        dk_a.nama_karyawan AS nama_karyawan_penilai,
        dk_b.nama_karyawan AS nama_karyawan_menilai,
        pk.tanggal,
        pk.total_nilai,
        pk.saran,
        pk.total_soal
        FROM performances___penilaian_kuesioner pk
        INNER JOIN data_karyawan dk_a ON pk.nik_penilai = dk_a.nik 
        INNER JOIN data_karyawan dk_b ON pk.nik_menilai = dk_b.nik 
        ");
        return $query->result_array();
    }


    public function ambilUserById($id)
    {
        return $this->db->get_where('performances___penilaian_kuesioner', ['id_penilaian_kuesioner' => $id])->result_array();
    }
    public function hapus($id_penilaian_kuesioner)
    {
        $this->db->where('id_penilaian_kuesioner', $id_penilaian_kuesioner);
        $this->db->delete('performances___penilaian_kuesioner');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
    public function cetakKuesioner($bulantahun)
    {
        $query = $this->db->query("SELECT 
        pk.id_penilaian_kuesioner,
        pk.nik_penilai,
        pk.nik_menilai,
        dk_a.nama_karyawan AS nama_karyawan_penilai,
        dk_b.nama_karyawan AS nama_karyawan_menilai,
        pk.tanggal,
        pk.total_nilai,
        pk.saran,
        pk.total_soal
        FROM performances___penilaian_kuesioner pk
        INNER JOIN data_karyawan dk_a ON pk.nik_penilai = dk_a.nik 
        INNER JOIN data_karyawan dk_b ON pk.nik_menilai = dk_b.nik 
        WHERE 
        pk.tanggal LIKE '%$bulantahun'");
        return $query->result_array();
    }

    public function kategorisasiKuesioner()
    {
        $total_soal = $this->input->post('total_soal');
        $nilai = $this->input->post('nilai');
        $total_nilai = ($total_soal / $nilai) * 100;
        // pr rumus penilaian kuesioner

        if ($total_nilai >= 80 && $total_nilai <= 100) {
            $kategorisasi = "Sangat Baik";
        } else if ($total_nilai >= 60 && $total_nilai <= 79) {
            $kategorisasi = "Baik";
        } else if ($total_nilai >= 40 && $total_nilai <= 59) {
            $kategorisasi = "Cukup";
        } else if ($total_nilai >= 20 && $total_nilai <= 39) {
            $kategorisasi = "Kurang";
        } else if ($total_nilai >= 0 && $total_nilai <= 19) {
            $kategorisasi = "Sangat Kurang";
        }
        echo "Kategorisasi: " . $kategorisasi;
        $data = [
            "nik_penilai" => $this->input->post("nik_penilai"),
            'nik_menilai' => $this->input->post("nik_menilai"),
            'tanggal' => date("m/Y"),
            'total_nilai' => $total_nilai,
            'total_soal' => $total_soal,
            "kategorisasi" => $kategorisasi,
        ];
        $this->db->insert('performances___penilaian_kuesioner', $data);
    }
}