<?php

class DataMitra_model extends CI_Model
{
    public function getAllDataMitra()
    {
        $this->db->select('*');
        $this->db->from('data_mitra');
        $this->db->order_by('data_mitra.nama_perusahaan', 'asc');
        return  $this->db->get()->result_array();
    }

    public function getAllKeahlian()
    {
        $this->db->select('keahlian,tools');
        $this->db->from('data_mitra');
        return  $this->db->get()->result_array();
    }

    public function tambahDataMitra()
    {
        $rate = $this->input->post('rate_total');
        $data_replace = str_replace('Rp ', '', $rate);
        $data_replace = str_replace('.', '', $data_replace);
        $data = [
            'nama_perusahaan' => $this->input->post('perusahaan'),
            'nama_karyawan' => $this->input->post('nama'),
            'keahlian' => serialize($this->input->post('keahlian[]')),
            'tools' => serialize($this->input->post('tools[]')),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'alamat' => $this->input->post('alamat'),
            'rate_total' => $data_replace,
            'dokumen_kerjasama' => $this->input->post('dokumen_kerjasama'),
            'tanggal_masuk' => $this->input->post('tanggal_masuk'),
            'tanggal_keluar' => $this->input->post('tanggal_keluar'),
            'status' => 'Aktif'
        ];
        $this->db->insert('data_mitra', $data);
    }

    public function ubahDataMitra()
    {
        $rate = $this->input->post('rate_total');
        $data_replace = str_replace('Rp ', '', $rate);
        $data_replace = str_replace('.', '', $data_replace);
        $data = [
            'nama_perusahaan' => $this->input->post('perusahaan'),
            'nama_karyawan' => $this->input->post('nama'),
            'keahlian' => serialize($this->input->post('keahlian[]')),
            'tools' => serialize($this->input->post('tools[]')),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'alamat' => $this->input->post('alamat'),
            'rate_total' => $data_replace,
            'dokumen_kerjasama' => $this->input->post('dokumen_kerjasama'),
            'tanggal_masuk' => $this->input->post('tanggal_masuk'),
            'tanggal_keluar' => $this->input->post('tanggal_keluar'),
            'status' => $this->input->post('status')
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('data_mitra', $data);
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('data_mitra');
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
            nama_perusahaan like '%" . $searchValue . "%' or 
            keahlian like'%" . $searchValue . "%'or 
            tools like'%" . $searchValue . "%' ) ";
        }
        // if ($searchGender != '') {
        //     $search_arr[] = " ='" . $searchGender . "' ";
        // }
        if (count($search_arr) > 0) {
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('data_mitra');
        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('data_mitra');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        $this->db->from('data_mitra');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by('data_mitra.nama_perusahaan', 'asc');
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();
        $no = 1;
        foreach ($records as $record) {
            $k1 = unserialize($record->keahlian);
            $k2 = serialize($k1);
            $k3 = array($k2);
            $k4 = array();
            for ($i = 0; $i < count($k3); $i++) {
                $k5 = unserialize($k3[$i]);
                $k4[] = implode(', ', $k5);
            }

            $t1 = unserialize($record->tools);
            $t2 = serialize($t1);
            $t3 = array($t2);
            $t4 = array();
            for ($i = 0; $i < count($t3); $i++) {
                $t5 = unserialize($t3[$i]);
                $t4[] = implode(', ', $t5);
            }

            $data[] = array(
                "no" => $no++,
                "nama_perusahaan" => $record->nama_perusahaan,
                "nama" => $record->nama_karyawan,
                "keahlian" => $k4,
                "tools" => $t4,
                "email" => $record->email,
                "telepon" => $record->telepon,
                "alamat" => $record->alamat,
                "rate" => 'Rp ' . number_format($record->rate_total, 0, ', ', '.'),
                "dokumen" => '<a href="' . $record->dokumen_kerjasama . '" target="_blank">Link Dokumen</a>',
                "tgl_masuk" => $record->tanggal_masuk,
                "tgl_keluar" => $record->tanggal_keluar,
                "status" => $record->status,
                "aksi" => '<button type="button" onclick="myFunction' . $record->id . '()" id="ubahDataMitraEdit' . $record->id . '" class="badge" style="color: black; background-color: gold;" data-toggle="modal" data-target="#ubahDataMitra' . $record->id . '"><i class="fas fa-edit"></i> Edit</button>
                <button type="button" class="badge" style="color: antiquewhite; background-color:  #cc0000;" data-toggle="modal" data-target="#modal-sm' . $record->id . '"><i class="fas fa-trash-alt"></i> Hapus</button>',
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
