<?php

class Perhitungan_model extends CI_Model
{
    public function tampilPerhitungan()
    {
        $this->db->select('dk.nik,dk.nama_karyawan,dk.id_karyawan,pp.*,pp.id as id_perhitungan');
        $this->db->from('payroll___perhitungan pp');
        $this->db->join('data_karyawan dk', 'dk.id_karyawan = pp.id_datakaryawan');
        $this->db->order_by('pp.id_datakaryawan', 'asc');
        return  $this->db->get()->result_array();
    }

    public function tambahPerhitungan()
    {
        $data = [
            'id_datakaryawan' => $this->input->post('nik_nama'),
            't_kinerja' => $this->input->post('t_kinerja'),
            't_fungsional' => $this->input->post('t_fungsional'),
            't_jabatan' => $this->input->post('t_jabatan'),
            't_bpjs' => $this->input->post('t_bpjs'),
            'potongan' => $this->input->post('potongan'),
            'bonus' => $this->input->post('bonus')
        ];
        $data_replace = str_replace('Rp ', '', $data);
        $data_replace = str_replace('.', '', $data_replace);
        $this->db->insert('payroll___perhitungan', $data_replace);
    }

    public function ubahPerhitungan()
    {
        $data = [
            'id_datakaryawan' => $this->input->post('nik_nama'),
            't_kinerja' => $this->input->post('t_kinerja'),
            't_fungsional' => $this->input->post('t_fungsional'),
            't_jabatan' => $this->input->post('t_jabatan'),
            't_bpjs' => $this->input->post('t_bpjs'),
            'potongan' => $this->input->post('potongan'),
            'bonus' => $this->input->post('bonus')
        ];
        $data_replace = str_replace('Rp ', '', $data);
        $data_replace = str_replace('.', '', $data_replace);
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('payroll___perhitungan', $data_replace);
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('payroll___perhitungan');
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    function dataTable($postData = null)
    {

        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        ## Search 
        $search_arr = array();
        $searchQuery = "";
        if ($searchValue != '') {
            $search_arr[] = " (nama_karyawan like '%" . $searchValue . "%' or  
            nik like'%" . $searchValue . "%' ) ";
        }
        // if ($searchGender != '') {
        //     $search_arr[] = " ='" . $searchGender . "' ";
        // }
        if (count($search_arr) > 0) {
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('payroll___perhitungan pp');
        $this->db->join('data_karyawan dk', 'dk.id_karyawan = pp.id_datakaryawan');
        // $records = $this->db->get('payroll___pengajuangaji')->result();
        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('payroll___perhitungan pp');
        $this->db->join('data_karyawan dk', 'dk.id_karyawan = pp.id_datakaryawan');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('dk.nik,dk.nama_karyawan,dk.id_karyawan,pp.*,pp.id as id_perhitungan');
        $this->db->from('payroll___perhitungan pp');
        $this->db->join('data_karyawan dk', 'dk.id_karyawan = pp.id_datakaryawan');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by('dk.nik', 'asc');
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();
        $no = 1;
        foreach ($records as $record) {

            $data[] = array(
                "no" => $no++,
                "nik_nama" => $record->nik . ' - ' . $record->nama_karyawan,
                "kinerja" => 'Rp ' . number_format($record->t_kinerja, 0, ', ', '.'),
                "fungsional" => 'Rp ' . number_format($record->t_fungsional, 0, ', ', '.'),
                "jabatan" => 'Rp ' . number_format($record->t_jabatan, 0, ', ', '.'),
                "bpjs" => 'Rp ' . number_format($record->t_bpjs, 0, ', ', '.'),
                "potongan" => 'Rp ' . number_format($record->potongan, 0, ', ', '.'),
                "bonus" => 'Rp ' . number_format($record->bonus, 0, ', ', '.'),
                "aksi" => '<button class="badge" style="background-color: gold; color: black;" data-toggle="modal" data-target="#ubahPerhitungan' . $record->id_perhitungan . '"><i class="fas fa-edit"></i> Edit</button>
                <button class="badge" style="background-color: #cc0000; color: antiquewhite" data-toggle="modal" data-target="#modal-sm' . $record->id_perhitungan . '"><i class="fas fa-trash-alt"></i> Hapus</button>',
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }
}
