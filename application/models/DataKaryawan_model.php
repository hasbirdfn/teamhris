<?php

class DataKaryawan_model extends CI_Model
{
    public function getAllDataKaryawan()
    {
        // return $this->db->get('data_karyawan')->result_array();
        $this->db->select('*');
        $this->db->from('data_karyawan');
        $this->db->join('data_posisi', 'data_posisi.id_posisi = data_karyawan.id_posisi');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas = data_karyawan.id_kelas');
        $this->db->order_by('data_karyawan.nik', 'asc');
        return $this->db->get()->result_array();
    }
    public function getDataKaryawanExcept($nik)
    {
        // return $this->db->get('data_karyawan')->result_array();
        $this->db->select('*');
        $this->db->from('data_karyawan');
        $this->db->join('data_posisi', 'data_posisi.id_posisi = data_karyawan.id_posisi');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas = data_karyawan.id_kelas');
        $this->db->where("data_karyawan.nik !=", $nik);
        return $this->db->get()->result_array();
    }

    public function tambahDataKaryawan()
    {
        $email = $this->input->post('email');
        $gajipokok = htmlspecialchars($this->input->post('gajipokok'));
        $data_replace = str_replace('Rp ', '', $gajipokok);
        $data_replace = str_replace('.', '', $data_replace);
        $data = [
            'nik' => htmlspecialchars($this->input->post('nik')),
            'nama_karyawan' => htmlspecialchars($this->input->post('nama')),
            'id_posisi' => htmlspecialchars($this->input->post('posisi')),
            'id_kelas' => htmlspecialchars($this->input->post('id_kelas')),
            'email' => htmlspecialchars($email),
            'status' => 'Aktif',
            'gajipokok' => $data_replace,
            'nik_leader' => htmlspecialchars($this->input->post('nikleader')),
            'level' => htmlspecialchars($this->input->post('level')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'telepon' => htmlspecialchars($this->input->post('telepon')),
            'type' => htmlspecialchars($this->input->post('type')),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'foto' => 'default.jpg'

        ];
        $this->db->insert('data_karyawan', $data);
    }

    public function ubahDataKaryawan()
    {
        $email = $this->input->post('email');
        $gajipokok = htmlspecialchars($this->input->post('gajipokok'));
        $data_replace = str_replace('Rp ', '', $gajipokok);
        $data_replace = str_replace('.', '', $data_replace);
        $data = [
            'nik' => htmlspecialchars($this->input->post('nik')),
            'nama_karyawan' => htmlspecialchars($this->input->post('nama')),
            'id_posisi' => htmlspecialchars($this->input->post('posisi')),
            'id_kelas' => htmlspecialchars($this->input->post('id_kelas')),
            'email' => htmlspecialchars($email),
            'status' => htmlspecialchars($this->input->post('status')),
            'gajipokok' => $data_replace,
            'nik_leader' => htmlspecialchars($this->input->post('nikleader')),
            'level' => htmlspecialchars($this->input->post('level')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'telepon' => htmlspecialchars($this->input->post('telepon')),
            'type' => htmlspecialchars($this->input->post('type'))

        ];

        $this->db->where('id_karyawan', $this->input->post('id_karyawan'));
        $this->db->update('data_karyawan', $data);
    }

    public function hapus($id_karyawan)
    {
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->delete('data_karyawan');
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function import_data($data)
    {
        $jumlah = count($data);
        if ($jumlah > 0) {

            $this->db->select('*');
            $this->db->from('data_karyawan');
            $this->db->where('data_karyawan.nik', $data['nik']);
            $dataExist =  $this->db->get()->result_array();
            if (count($dataExist) == 0) {
                return $this->db->insert('data_karyawan', $data);
            } else {
                return false;
            }
        }
    }
}
