<!-- ngeload berdasarkan level -->
<!-- level ceo dan Level hc -->
<?php
if ($this->session->userdata('level') === 'hc' || $this->session->userdata('level') === 'ceo')
  $this->load->view('hris/dashboard_hc'); {

} ?>
<!-- level karyawan dan leader -->
<?php
if ($this->session->userdata('level') === 'leader' || $this->session->userdata('level') === 'biasa')
  $this->load->view('hris/dashboard_karyawan'); {

} ?>