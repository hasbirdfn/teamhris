<div class="container-fluid">

    <div class="card">
        <div class="card-header" style="color: white; background-color: #8b0000;">
            <h4> Filter Data Penilaian Kinerja</h4>
        </div>

        <form class="form-horizontal">
            <div class="card-body">
                <div class="form-group row">
                    <label for="bulan" class="col-form-label">Bulan: </label>
                    <div class="col-md-2">
                        <select class="form-control select2" name="bulan">
                            <option value="">-- Pilih Bulan --</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <label for="tahun" class="col-form-label">Tahun: </label>
                    <div class="col-md-2 ">
                        <select class="form-control" name="tahun">
                            <option value="">-- Pilih Tahun --</option>
                            <?php $tahun = date('Y');
                            for ($i = 2020; $i < $tahun + 3; $i++) { ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php
                    if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
                        $bulan = $_GET['bulan'];
                        $tahun = $_GET['tahun'];
                        $bulantahun = $bulan . $tahun;
                    } else {
                        $bulan = date('m');
                        $tahun = date('Y');
                        $bulantahun = $bulan . $tahun;

                    }

                    ?>
                    <button type="submit" class="btn btn-outline-success ml-auto"><i class="fas fa-eye"> Tampilkan
                            Data
                        </i>
                    </button>
                    <?php if (count($jamkerja) > 0) { ?>
                        <a class="btn btn-outline-success  ml-2"
                            href="<?= base_url('Performances/PenilaianKinerja/cetakkinerja?bulan=' . $bulan), '&tahun=' . $tahun ?>"><i
                                class="fas fa-print"></i> Cetak PDF</a>
                        <a class="btn btn-outline-success ml-2"
                            href="<?= base_url('Performances/PenilaianKinerja/cetakExcel?bulan=' . $bulan), '&tahun=' . $tahun ?>"><i
                                class="fas fa-print"></i> Cetak Excel</a>
                    <?php } else { ?>
                        <button type="button" class="btn btn-outline-success ml-2" data-toggle="modal"
                            data-target="#exampleModal"><i class="fas fa-print"></i> Cetak PDF</button>
                        <button type="button" class="btn btn-outline-success ml-2" data-toggle="modal"
                            data-target="#exampleModal"><i class="fas fa-print"></i> Cetak Excel</button>
                    <?php } ?>
                </div>

            </div>
        </form>
    </div>

    <div class="alert alert" style="background-color: #8b0000; color: white;">
        Menampilkan penilaian kinerja Bulan:<span class="fofnt-weight-bold">
            <?php echo $bulan ?>
        </span> Tahun:<span class="fofnt-weight-bold">
            <?php echo $tahun ?>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="form-group row">
                <div class="col-mb-auto">
                    <a class="btn btn-outline-success" href="<?= base_url('performances/JamKerja') ?>" ;><i
                            class="fas fa-plus"></i>
                        Input Penilaian
                    </a> <br>
                </div>
            </div>
            <!-- perulangan -->
            <?php

            $jml_data = count($jamkerja);
            if ($jml_data > 0) { ?>
                <!-- jml data > 0 artinya jika nilai lebih dari nol maka data atau nilainya itu ada -->

                <table id="example1" class="table table-bordered table-striped">
                    <thead style="text-align: center; background-color: #8b0000; color: white;  ">
                        <tr>
                            <th>No</th>
                            <th>NIK & Nama Karyawan</th>
                            <th>Done Kerja</th>
                            <th>Total Kerja</th>
                            <th>Nilai</th>
                            <th>Kategorisasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php
                        foreach ($jamkerja as $jk):
                            $nilai = 0;
                            if ($jk['total_kinerja'] != 0) {
                                $nilai = ($jk['waktu'] / $jk['total_kinerja']) * 100;
                            }
                            ?>
                            <tr style=" text-align: center;">
                                <td>
                                    <?= $no++; ?>
                                    </th>
                                <td>
                                    <?= $jk['nik'], "<br>" .
                                        $jk['nama_karyawan']; ?>
                                </td>
                                <td>
                                    <?= $jk['waktu']; ?>
                                </td>
                                <td>
                                    <?= $jk['total_kinerja']; ?>


                                <td>
                                    <?= number_format((float) $nilai, 2, '.', ''); ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    if ($nilai >= 80 && $nilai <= 100) {
                                        echo "Sangat Baik";
                                    } else if ($nilai >= 60 && $nilai <= 79) {
                                        echo "Baik";
                                    } else if ($nilai >= 40 && $nilai <= 59) {
                                        echo "Cukup";
                                    } else if ($nilai >= 20 && $nilai <= 39) {
                                        echo "Kurang";
                                    } else if ($nilai >= 0 && $nilai <= 19) {
                                        echo "Sangat Kurang";
                                    }
                                    ?>

                                </td>

                            <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <span class="badge badge-danger"><i class="fas fa-info-circle"></i>
                    Data masih kosong, silahkan pilih bulan dan tahun terlebih dahulu!</span>
            <?php } ?>
        </div>
    </div>
    <!-- /.card-body -->
</div>



<!-- Modal cetak penlilaian kinerja -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Data Penilaian Kinerja masih kosong.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" style="background-color: #8b0000; color:#ffffff;"
                    data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Akhir modal cetak penlilaian kinerja -->


<script>
    const nik_nama = document.getElementById("nik_nama");
    const id_posisi = document.getElementById("id_posisi");
    nik_nama.onchange = function (e) {
        const nik = e.target.value;
        fetch(`/teamhris/performances/penilaiankinerja/ajax_category?nik=${nik}`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then(response => response.json())
            .then(response => {
                id_posisi.value = response?.nama_posisi || ""
            })
    }
</script>


<script>
    $(function () {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });
        <?php if ($this->session->flashdata('message')): ?>
            const flashData = <?= json_encode($this->session->flashdata('message')) ?>;
            Toast.fire({
                icon: 'success',
                title: flashData
            })
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            const flashData = <?= json_encode($this->session->flashdata('error')) ?>;
            Toast.fire({
                icon: 'error',
                title: flashData
            })
        <?php endif; ?>
        <?php if (validation_errors()): ?>
            const flashData = <?= json_encode(validation_errors()) ?>;
            Toast.fire({
                icon: 'error',
                title: flashData
            })
        <?php endif; ?>
    });
</script>