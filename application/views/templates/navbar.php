<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color:#d4d4d4;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <h2>PT. SAHAWARE TEKNOLOGI INDONESIA</h2>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class=" navbar-nav ml-auto">


                <li class="nav-item mb-3">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline" style="color: black;">
                            <?= $user['nama_karyawan']; ?>
                        </span>
                        <img class="img-profile rounded-circle"
                            src="<?= base_url('dist/img/profile/') . $user['foto']; ?>" alt="admin" height="40px"
                            width="40px">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('hris/profile'); ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="<?= base_url('hris/ubahpassword'); ?>">
                            <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                            Ubah Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <div class="modal fade" id="logoutModal">
            <div class="modal-dialog logoutModal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Logout</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin akan logout ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn" data-dismiss="modal"
                            style="background-color: #d4d4d4;">Tidak</button>
                        <a href="<?= base_url('auth/logout') ?>" type="submit" class="btn"
                            style="background-color: #8b0000; color:white">Ya</a>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>