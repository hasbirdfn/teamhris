<div class="container-fluid">

    <div class="card">
        <div class="card-header" style="color: white; background-color: #8b0000;">
            <h4> Filter Data Penilaian Kuesioner</h4>
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
                            <option value="">--Pilih Tahun --</option>
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
                    <?php if (count($penilaiankuesioner) > 0) { ?>
                        <a class="btn btn-outline-success  ml-2"
                            href="<?= base_url('Performances/PenilaianKuesioner/cetakkuesioner?bulan=' . $bulan), '&tahun=' . $tahun ?>"><i
                                class="fas fa-print"></i> Cetak Laporan</a>
                    <?php } else { ?>
                        <button type="button" class="btn btn-outline-success ml-2" data-toggle="modal"
                            data-target="#exampleModal"><i class="fas fa-print"></i> Cetak Laporan</button>
                    <?php } ?>
                </div>

            </div>
        </form>
    </div>

    <div class="alert alert" style="background-color: #8b0000; color: white;">
        Menampilkan penilaian kuesioner Bulan:<span class="fofnt-weight-bold">
            <?php echo $bulan ?>
        </span> Tahun:<span class="fofnt-weight-bold">
            <?php echo $tahun ?>
    </div>
    <div class="card">
        <div class="card-body">

            <!-- validation crud -->
            <?php if (validation_errors()): ?>
                <div class="alert alert-default" role="alert" style="background-color: #800000;">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-lg-4">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>

            <!-- perulangan -->
            <?php

            $jml_data = count($penilaiankuesioner);
            if ($jml_data > 0) { ?>
                <!-- jml data > 0 artinya jika nilai lebih dari nol maka data atau nilainya itu ada -->

                <table id="example1" class="table table-bordered table-striped">
                    <thead style="text-align: center; background-color: #8b0000; color: white;  ">
                        <tr>
                            <th>No</th>
                            <th>NIK & Nama Penilai</th>
                            <th>NIK & Nama Menilai</th>
                            <th>Total Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($penilaiankuesioner as $pr): ?>
                            <tr style=" text-align: center;">
                                <td>
                                    <?= $no++; ?>
                                </td>

                                <td>
                                    <?= $pr['nik_penilai'], "<br>" .
                                        $pr['nama_karyawan_penilai']; ?>
                                </td>
                                <td>
                                    <?= $pr['nik_menilai'], "<br>" .
                                        $pr['nama_karyawan_menilai']; ?>
                                </td>

                                <td>
                                    <?= $pr['total_nilai'] ?>
                                </td>
                                <td>
                                    <a class="badge"
                                        href="<?= base_url() ?>Performances/PenilaianKuesioner/detail/<?= $pr['id_penilaian_kuesioner'] ?>"
                                        type="button" style="background-color: #d4d4d4" ;><i class="fas fa-share"></i>
                                        Detail
                                    </a>
                                </td>

                            </tr>
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



<!-- Modal cetak kuesioner -->
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
                Data Penilaian Kuesioner masih kosong.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" style="background-color: #8b0000; color: white;"
                    data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Akhir modal cetak kuesioner -->