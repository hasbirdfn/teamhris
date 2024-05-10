<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class JamKerja_model extends CI_Model
{
    public function Tampiljamkerja()
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


    public function tambah()
    {

        $complete_date = $this->input->post('complete_date');
        $due_date = $this->input->post('due_date');

        if (empty($complete_date) || empty($due_date)) { // jika salah satu tanggal tidak diisi
            $keterangan = "Tidak Diisi";
        } else if ($complete_date <= $due_date) { // jika tanggal selesai kurang dari atau sama dengan tanggal jatuh tempo
            $keterangan = "Tepat Waktu";
        } else { // jika tanggal selesai lebih besar dari tanggal jatuh tempo
            $keterangan = "Terlambat";
        }

        echo "Keterangan: " . $keterangan;
        $data = [
            "nik" => $this->input->post("nik_nama"),
            'tanggal' => date("m/Y"),
            'due_date' => $due_date,
            "complete_date" => $complete_date,
            "keterangan" => $keterangan
        ];
        $this->db->insert('performances___inputjamkerja', $data);
    }


    public function ubahJamKerja()
    {
        $complete_date = $this->input->post('complete_date');
        $due_date = $this->input->post('due_date');

        if (empty($complete_date) || empty($due_date)) { // jika salah satu tanggal tidak diisi
            $keterangan = "Tidak Diisi";
        } else if ($complete_date <= $due_date) { // jika tanggal selesai kurang dari atau sama dengan tanggal jatuh tempo
            $keterangan = "Tepat Waktu";
        } else { // jika tanggal selesai lebih besar dari tanggal jatuh tempo
            $keterangan = "Terlambat";
        }

        echo "Keterangan: " . $keterangan;
        $data = [
            "nik" => $this->input->post("nik_nama"),
            'tanggal' => date("m/Y"),
            'due_date' => $due_date,
            'complete_date' => $complete_date,
            'keterangan' => $keterangan
        ];
        $this->db->where('id_jamkerja', $this->input->post('id_jamkerja'));
        $this->db->update('performances___inputjamkerja', $data);

        return ($this->db->affected_rows() > 0) ? true : false;
    }


    public function hapus($id_jamkerja)
    {
        $this->db->where('id_jamkerja', $id_jamkerja);
        $this->db->delete('performances___inputjamkerja');

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function import_excel($data)
    {
        $this->db->insert('performances_inputjamkerja', $data);
        return $this->db->affected_rows();
    }


}