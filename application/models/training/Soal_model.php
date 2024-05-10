<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Soal_model extends CI_Model
{

    public function get_joinsoal($id)
    {
        $query = 'SELECT * FROM tb_soal join data_posisi ON tb_soal.id_posisi=data_posisi.id_posisi WHERE tb_soal.id_soal_ujian="' . $id . '"';
        return $this->db->query($query);
    }
    public function import()
    {
        if (isset($_POST["submit"])) {
            $file = $_FILES['import']['tmp_name'];
            $handle = fopen($file, "r");
            while (($filedata = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $data = [
                    'pertanyaan' => htmlspecialchars($filedata[0]),
                    'a' => htmlspecialchars($filedata[1]),
                    'b' => htmlspecialchars($filedata[2]),
                    'c' => htmlspecialchars($filedata[3]),
                    'd' => htmlspecialchars($filedata[4]),
                    'e' => htmlspecialchars($filedata[5]),
                    'kunci_jawaban' => htmlspecialchars($filedata[6]),

                ];
                $this->db->insert('tb_soal', $data);
                return $this->db->insert_id();
            }
            fclose($handle);
            redirect('training/Soal_ujian');
        }
    }

    public function import_data($data)
    {
        $jumlah = count($data);
        if ($jumlah > 0) {
            $this->db->insert('tb_soal', $data);
        }
    }
}