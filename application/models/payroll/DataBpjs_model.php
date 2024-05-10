<?php

class DataBpjs_model extends CI_Model
{
    public function tampilDataBpjs()
    {
        return  $this->db->get('payroll___databpjs')->result_array();
    }

    public function tambahDataBpjs()
    {
        $data = [
            'kelas' => htmlspecialchars($this->input->post('kelas')),
            'nilai' => htmlspecialchars($this->input->post('nilai'))
        ];
        $this->db->insert('payroll___databpjs', $data);
    }

    public function ubahDataBpjs()
    {
        $data = [
            'kelas' => htmlspecialchars($this->input->post('kelas')),
            'nilai' => htmlspecialchars($this->input->post('nilai'))
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('payroll___databpjs', $data);
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('payroll___databpjs');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}
