<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #8b0000;">
    <!-- Brand Logo -->
    <div class="mt-2"></div>
    <a href="<?= base_url('hris'); ?>" class="link p-3" style="color: #ffffff;">
        <img src="<?= base_url(); ?>dist/img/sahaware.jpg" alt="Sahaware Logo" class="brand-image img-circle elevation-3 mr-1" width="43" height="43">
        <span class="brand-text font-light" style="font-size:25px;">HRIS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="<?= base_url('hris') ?>" class="nav-link" style="color: #ffffff;">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php if ($this->session->userdata('level') !== 'leader')
                    if ($this->session->userdata('level') !== 'biasa') { ?>
                    <li class="nav-item">
                        <a href="" class="nav-link" style="color: #ffffff;">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Master Data
                                <i class="right fas fa-angle-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('master/DataKaryawan') ?>" class="nav-link" style="background-color: #ffffff; color: black;">
                                    <p>Data Karyawan</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('master/DataPosisi') ?>" class="nav-link" style="background-color: #ffffff; color: black;">
                                    <p>Data Posisi</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('master/SoalKuesioner') ?>" class="nav-link" style="background-color: #ffffff;color: black;">
                                    <p>Soal Kuesioner</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php
                if ($this->session->userdata('level') === 'leader' || $this->session->userdata('level') === 'biasa') {
                    $this->load->view('templates/sidebar_menilai'); // yang ingin di tampilkan pada sidebar leader dan menilai karyawans biasa
                } ?>


                <?php if ($this->session->userdata('level') === 'hc') {
                    $this->load->view('templates/sidebar_menilai'); // yang ingin di tampilkan pada sidebar hc
                    $this->load->view('templates/sidebar_hc');
                } ?>

                <?php if ($this->session->userdata('level') === 'ceo') {
                    $this->load->view('templates/sidebar_menilai'); // yang ingin di tampilkan pada sidebar hc
                    $this->load->view('templates/sidebar_ceo');
                } ?>
                <li class="nav-item">
                    <a href="<?= base_url('auth/logout'); ?>" class="nav-link" style="color: #ffffff;">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <?= $title; ?>
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">