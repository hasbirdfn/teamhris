<li class="nav-item">
    <a href="#" class="nav-link" style="color: #ffffff;">
        <i class="nav-icon fas fa-money-bill"></i>
        <p>
            Payroll
            <i class="right fas fa-angle-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview nav-sidebar nav-child-indent">
        <li class="nav-item">
            <a href="#" class="nav-link" style="background-color: #ffffff; color: black;">
                <p>
                    Setting Pajak
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('payroll/datapajak') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                        <p>Data Pajak</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('payroll/pajak') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                        <p>Pajak Karyawan</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <ul class="nav nav-treeview nav-sidebar nav-child-indent">
        <li class="nav-item">
            <a href="#" class="nav-link" style="background-color: #ffffff; color: black;">
                <p>
                    Setting BPJS Kesehatan
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('payroll/databpjs') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                        <p>Data BPJS</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('payroll/bpjs') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                        <p>BPJS Karyawan</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= base_url('payroll/perhitungangaji') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                <p>Perhitungan Gaji</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= base_url('payroll/mitra') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                <p>Contract Mitra</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview nav-sidebar nav-child-indent">
        <li class="nav-item">
            <a href="#" class="nav-link" style="background-color: #ffffff; color: black;">
                <p>
                    Laporan
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('payroll/laporangaji') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                        <p>Laporan Gaji Karyawan</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('payroll/laporanmitra') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                        <p>Laporan Mitra</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="#" class="nav-link" style="color: #ffffff;">
        <i class="nav-icon fas fa-user-plus"></i>
        <p>
            Recruitment
            <i class="right fas fa-angle-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= base_url('Recruitment/kelola') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                <p>Pekerjaan</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= base_url('Recruitment/Datapelamar') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                <p>Pelamar</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= base_url('jadwal') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                <p>Soal Recruitment</p>
            </a>
        </li>
    </ul>
</li>