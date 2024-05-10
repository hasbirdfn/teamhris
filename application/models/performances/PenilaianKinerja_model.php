<?php

class PenilaianKinerja_model extends CI_Model
{
    public function Tampilpenilaiankinerja()
    { //model ini akan di tampilkan pada penilaian kinerja
        $this->db->select('data_karyawan.*, 
            performances___inputjamkerja.id_jamkerja,
            performances___inputjamkerja.nik,
            performances___inputjamkerja.tanggal,
            performances___inputjamkerja.due_date,
            performances___inputjamkerja.complete_date,
            performances___inputjamkerja.keterangan,
            (SELECT 
                data_posisi.nama_posisi 
                    FROM data_posisi
                        WHERE data_posisi.id_posisi = data_karyawan.id_posisi) AS nama_posisi
        ');
        $this->db->from('performances___inputjamkerja');
        $this->db->join('data_karyawan', 'data_karyawan.nik = performances___inputjamkerja.nik');
        return $this->db->get()->result_array();
    }


    public function import_data($data)
    {
        $this->db->insert('performances_inputjamkerja', $data);
        return $this->db->affected_rows();
    }

    public function cetakKinerja($bulantahun)
    {
        $query = $this->db->query("
        SELECT 
        jk.id_jamkerja,
        jk.nik,
        MAX(dk.nama_karyawan) AS nama_karyawan,
        jk.tanggal,
        jk.keterangan,
        (
            SELECT COUNT(jk2.nik)
            FROM performances___inputjamkerja jk2 
            WHERE jk2.nik = jk.nik AND jk2.tanggal = '$bulantahun'
            GROUP BY jk2.tanggal, jk2.nik
        ) AS total_kinerja,
        (
            SELECT COUNT(jamker.keterangan) 
            FROM performances___inputjamkerja jamker  
            WHERE jamker.keterangan = 'Tepat Waktu' AND jamker.nik = jk.nik AND jamker.tanggal = '$bulantahun'
        ) AS waktu
    FROM performances___inputjamkerja jk
    JOIN data_karyawan dk ON jk.nik = dk.nik
    WHERE jk.tanggal = '$bulantahun'
    GROUP BY jk.nik
    ");
        return $query->result_array();

    }
}