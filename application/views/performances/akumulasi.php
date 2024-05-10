<!-- akumulasi  ngeload berdasarkan level -->
<!-- level ceo -->
<?php
if ($this->session->userdata('level') === 'ceo') {
    $this->load->view('performances/akumulasi_admin');

} ?>
<!-- level hc -->
<?php
if ($this->session->userdata('level') === 'hc') {
    $this->load->view('performances/akumulasi_admin');

} ?>