<?php

class Auth_model extends CI_Model
{
    public function ambilUser($username)
    {
        return $this->db->get_where('data_karyawan', ['nik' => $username])->row_array();
    }

    public function ubahPassword()
    {
        $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);

        $this->db->set('password', $password);
        $this->db->where('email', $this->session->userdata('reset_email'));
        $this->db->update('data_karyawan');

        $this->session->unset_userdata('reset_email');
    }
}
