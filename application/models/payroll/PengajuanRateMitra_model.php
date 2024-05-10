<?php

class PengajuanRateMitra_model extends CI_Model
{
    public function tampilRate()
    {
        $this->db->select('pm.*, dm.nama_karyawan, dm.email, dm.nama_perusahaan, dm.keahlian, dm.tools');
        $this->db->from('payroll___pengajuanratemitra pm');
        $this->db->join('data_mitra dm', 'dm.id = pm.id_datamitra');
        return  $this->db->get()->result_array();
    }

    public function generate()
    {
        $date = date("Y") . date("m", strtotime('+1 month'));
        $this->db->where('status', 'Belum dibayar');
        $this->db->where('bulan_tahun', $date);
        $this->db->delete('payroll___pengajuanratemitra');
        $this->db->affected_rows();

        $this->db->select($date . ' as bulan_tahun, dm.id, dm.rate_total');
        $this->db->from('data_mitra dm ');
        $this->db->where('dm.status !=', 'Tidak Aktif');
        $this->db->where('dm.id NOT IN (SELECT id_datamitra FROM payroll___pengajuanratemitra WHERE bulan_tahun ="' . $date . '" AND status = "Sudah dibayar")');
        $nextRate = $this->db->get()->result_array();
        foreach ($nextRate as $nr) {
            $data = [
                'bulan_tahun' => $nr['bulan_tahun'],
                'id_datamitra' => $nr['id'],
                'rate_total' => $nr['rate_total'],
                'status' => 'Belum dibayar'
            ];
            $this->db->insert('payroll___pengajuanratemitra', $data);
        }
    }

    public function statusBayar($id)
    {
        $data = [
            'status' => 'Sudah dibayar'
        ];

        $this->db->where('id', $id);
        $this->db->update('payroll___pengajuanratemitra', $data);
    }

    function getUsers($postData = null)
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

        // Custom search filter 
        $searchBulan = $postData['searchBulan'];
        $searchBulanTahun = $postData['searchTahun'] . $searchBulan;

        ## Search 
        $search_arr = array();
        $searchQuery = "";
        if ($searchValue != '') {
            $search_arr[] = " (nama_karyawan like '%" . $searchValue . "%' or 
            nama_perusahaan like '%" . $searchValue . "%' or 
            keahlian like'%" . $searchValue . "%' or 
            tools like'%" . $searchValue . "%' ) ";
        }
        if ($searchBulanTahun != '') {
            $search_arr[] = " bulan_tahun='" . $searchBulanTahun . "' ";
        }
        // if ($searchGender != '') {
        //     $search_arr[] = " ='" . $searchGender . "' ";
        // }
        if (count($search_arr) > 0) {
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        // $this->db->select('lg.*, dk.nama_karyawan, dk.nik, dk.email');
        $this->db->from('payroll___pengajuanratemitra pm');
        $this->db->join('data_mitra dm', 'dm.id = pm.id_datamitra');
        // $records = $this->db->get('payroll___pengajuangaji')->result();
        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('payroll___pengajuanratemitra pm');
        $this->db->join('data_mitra dm', 'dm.id = pm.id_datamitra');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('pm.*, dm.nama_karyawan, dm.email, dm.nama_perusahaan, dm.keahlian, dm.tools');
        $this->db->from('payroll___pengajuanratemitra pm');
        $this->db->join('data_mitra dm', 'dm.id = pm.id_datamitra');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        // $this->db->order_by($columnName, $columnSortOrder);
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
                "nama_karyawan" => $record->nama_karyawan,
                "keahlian" => $k4,
                "tools" => $t4,
                "rate_total" => 'Rp ' . number_format($record->rate_total, 0, ', ', '.'),
                "status" => $record->status,
                "aksi" => '<button class="badge" style="background-color: #fbff39;" href="" data-toggle="modal" data-target="#modal-sm' . $record->id . '"><i class="fas fa-check-circle"></i> Status Bayar</button>',
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

    public function cetakRate($bulantahun)
    {
        $this->db->select('pm.*, dm.nama_karyawan, dm.email, dm.nama_perusahaan, dm.keahlian, dm.tools');
        $this->db->from('payroll___pengajuanratemitra pm');
        $this->db->join('data_mitra dm', 'dm.id = pm.id_datamitra');
        $this->db->where('bulan_tahun', $bulantahun);
        return  $this->db->get()->result_array();
    }

    public function laporan($bulantahun)
    {
        $this->db->select("(SELECT SUM(rate_total) FROM `payroll___pengajuanratemitra` WHERE bulan_tahun = '" . $bulantahun . "' AND status = 'Sudah dibayar') AS Sudah
        ,
        (SELECT SUM(rate_total) FROM `payroll___pengajuanratemitra` WHERE bulan_tahun = '" . $bulantahun . "' AND status = 'Belum dibayar') AS Belum");
        // $this->db->from('payroll___pengajuangaji');
        $hasil = $this->db->get()->result_array();
        if ($hasil[0]['Sudah'] == null) {
            $hasil[0]['Sudah'] = 0;
        }
        if ($hasil[0]['Belum'] == null) {
            $hasil[0]['Belum'] = 0;
        }
        return $hasil;
    }
}
