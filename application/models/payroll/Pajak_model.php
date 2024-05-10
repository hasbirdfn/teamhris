<?php

class Pajak_model extends CI_Model
{
    public function tampilPajakKaryawan()
    {
        $this->db->select('*, pp.id as id_pajak');
        $this->db->from('payroll___pajak pp');
        $this->db->join('data_karyawan dk', 'dk.id_karyawan = pp.id_datakaryawan');
        $this->db->join('payroll___datapajak pd', 'pd.id = pp.id_datapajak');
        $this->db->order_by('pp.id_datakaryawan', 'asc');
        return  $this->db->get()->result_array();
    }

    public function tambahPajakKaryawan()
    {
        $data = [
            'id_datakaryawan' => $this->input->post('nik_nama'),
            'id_datapajak' => $this->input->post('golongan_kode'),
        ];
        $this->db->insert('payroll___pajak', $data);
    }

    public function ubahPajakKaryawan()
    {
        $data = [
            'id_datakaryawan' => $this->input->post('nik_nama'),
            'id_datapajak' => $this->input->post('golongan_kode'),
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('payroll___pajak', $data);
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('payroll___pajak');
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
            golongan like '%" . $searchValue . "%' or 
            nik like'%" . $searchValue . "%' or 
            kode like'%" . $searchValue . "%' ) ";
        }
        // if ($searchGender != '') {
        //     $search_arr[] = " ='" . $searchGender . "' ";
        // }
        if (count($search_arr) > 0) {
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('payroll___pajak pp');
        $this->db->join('data_karyawan dk', 'dk.id_karyawan = pp.id_datakaryawan');
        $this->db->join('payroll___datapajak pd', 'pd.id = pp.id_datapajak');
        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('payroll___pajak pp');
        $this->db->join('data_karyawan dk', 'dk.id_karyawan = pp.id_datakaryawan');
        $this->db->join('payroll___datapajak pd', 'pd.id = pp.id_datapajak');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*, pp.id as id_pajak');
        $this->db->from('payroll___pajak pp');
        $this->db->join('data_karyawan dk', 'dk.id_karyawan = pp.id_datakaryawan');
        $this->db->join('payroll___datapajak pd', 'pd.id = pp.id_datapajak');
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
                "golongan" => $record->golongan,
                "kode" => $record->kode,
                "aksi" => '<button class="badge" style="background-color: gold; color: black;" data-toggle="modal" data-target="#ubahPajakKaryawan' . $record->id_pajak . '"><i class="fas fa-edit"></i> Edit</button>
                <button class="badge" style="background-color: #cc0000; color: antiquewhite" data-toggle="modal" data-target="#modal-sm' . $record->id_pajak . '"><i class="fas fa-trash-alt"></i> Hapus</button>',
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
