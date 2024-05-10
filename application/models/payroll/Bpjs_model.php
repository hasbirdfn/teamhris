<?php

class Bpjs_model extends CI_Model
{
    public function tampilBpjsKaryawan()
    {
        $this->db->select('dk.nik,dk.nama_karyawan,dk.id_karyawan,pd.kelas,pd.nilai,pd.id,pb.*,pb.id as id_bpjs');
        $this->db->from('payroll___bpjs pb');
        $this->db->join('data_karyawan dk', 'dk.id_karyawan = pb.id_datakaryawan');
        $this->db->join('payroll___databpjs pd', 'pd.id = pb.id_databpjs');
        $this->db->order_by('pb.id_datakaryawan', 'asc');
        return  $this->db->get()->result_array();
    }

    public function tambahBpjsKaryawan()
    {
        $data = [
            'id_datakaryawan' => $this->input->post('nik_nama'),
            'id_databpjs' => $this->input->post('kelas_nilai'),
            'jumlah' => $this->input->post('jumlah'),
            'total' => $this->input->post('total2')
        ];
        $this->db->insert('payroll___bpjs', $data);
    }

    public function ubahBpjsKaryawan()
    {
        $data = [
            'id_datakaryawan' => $this->input->post('nik_nama'),
            'id_databpjs' => $this->input->post('kelas_nilai'),
            'jumlah' => $this->input->post('jumlah'),
            'total' => $this->input->post('total2')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('payroll___bpjs', $data);
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('payroll___bpjs');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}
