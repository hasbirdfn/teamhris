<li class="nav-item">
    <a href="#" class="nav-link" style="color: #ffffff;">
        <i class="nav-icon fas fa-user-edit"></i>
        <p>
            Performances
            <i class="right fas fa-angle-right"></i>
        </p>
    </a>
    <?php if ($this->session->userdata('level') !== 'leader')
        if ($this->session->userdata('level') !== 'biasa') { ?>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url('Performances/PenilaianKinerja') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                    <p>Penilaian Kinerja</p>
                </a>
            </li>
        </ul>
    <?php } ?>

    <?php if ($this->session->userdata('level') !== 'leader')
        if ($this->session->userdata('level') !== 'biasa') { ?>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url('Performances/PenilaianKuesioner') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                    <p>Penilaian Kuesioner</p>
                </a>
            </li>
        </ul>
    <?php } ?>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= base_url('Performances/MenilaiDiriSendiri') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                <p>Menilai Diri Sendiri</p>
            </a>
        </li>
    </ul>


    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= base_url('Performances/MenilaiLeader') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                <p>Menilai Leader</p>
            </a>
        </li>
    </ul>

    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= base_url('Performances/MenilaiRekan1') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                <p>Menilai Rekan 1</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= base_url('Performances/MenilaiRekan2') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                <p>Menilai Rekan 2</p>
            </a>
        </li>
    </ul>

    <?php if ($this->session->userdata('level') !== 'biasa') { ?>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url('Performances/Akumulasi') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                    <p>Akumulasi Penilaian</p>
                </a>
            </li>
        </ul>
    <?php } ?>
<li class="nav-item">
    <a href="#" class="nav-link" style="color: #ffffff;">
        <i class="nav-icon fas fa-chalkboard-teacher"></i>
        <p>
            Training
            <i class="right fas fa-angle-right"></i>
        </p>
    </a>
    <?php if ($this->session->userdata('level') !== 'biasa') { ?>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url('training/soal_ujian') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                    <p>Kelola Data Soal</p>
                </a>
            </li>
        </ul>

        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url('training/peserta') ?>" class=" nav-link " style=" background-color: #ffffff; color: black;">
                    <p>Kelola Peserta Ujian</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url('training/Hasil_ujian') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                    <p>Hasil Ujian</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url('training/file_soal') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                    <p>Pelatihan Tipe Berkas</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url('training/dataadmin') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                    <p>Riwayat Pelatihan</p>
                </a>
            </li>
        </ul>
    <?php } ?>
    <?php if ($this->session->userdata('level') !== 'hc') { ?>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url('training/jadwal_ujian') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                    <p>Jadwal Ujian</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url('training/Ruang_hasil') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                    <p>Hasil Ujian</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url('training/Filesoal_karyawan') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                    <p>Pelatihan Berkas soal</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url('training/datakeseluruhan') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                    <p>Riwayat Hasil Pelatihan</p>
                </a>
            </li>
        </ul>

    <?php } ?>
</li>