<div class="container-fluid">

    <div class="card">
        <div class="card-header" style="color: white; background-color: #8b0000;">
            <h4> Filter Data Jam Kerja</h4>
        </div>

        <form class="form-horizontal">
            <div class="card-body">
                <div class="form-group row">
                    <label for="bulan" class="col-form-label">Bulan: </label>
                    <div class="col-md-2">
                        <select class="form-control select2" name="bulan">
                            <option value="">-- Pilih Bulan--</option>
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
                            <option value="">--Pilih Tahun--</option>
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
                    <button type="submit" class="btn btn-outline-success ml-3"><i class="fas fa-eye"> Tampilkan
                            Data
                        </i>
                    </button>

                </div>

            </div>
        </form>
    </div>

    <div class="alert alert" style="background-color: #8b0000; color: white;">
        Menampilkan Jam Kerja Bulan:<span class="fofnt-weight-bold">
            <?php echo $bulan ?>
        </span> Tahun:<span class="fofnt-weight-bold">
            <?php echo $tahun ?>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="form-group row">
                <div class="col-mb-auto">
                    <button type="button" class="btn btn-outline-success" data-toggle="modal"
                        data-target="#tambahJamKerja"><i class="fas fa-plus"></i>
                        Tambah Penilaian
                    </button>
                    <button type="button" class="btn btn-outline-success" data-toggle="modal"
                        data-target="#importJamKerja"><i class="fas fa-plus"></i>
                        Import
                    </button>
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
                            <th>Due Date</th>
                            <th>Complete Date</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($jamkerja as $jam):
                            // $selisih_hari = ($jam['complate_date'] - $jam['due_date']); ?>


                            <tr style=" text-align: center;">
                                <td>
                                    <?= $no++; ?>
                                </td>
                                <td>
                                    <?= $jam['nik'], "<br>" .
                                        $jam['nama_karyawan']; ?>
                                </td>

                                <td>
                                    <?= $jam['due_date']; ?>
                                </td>

                                <td>
                                    <?= $jam['complete_date']; ?>
                                </td>
                                <td>
                                    <?= $jam['keterangan']; ?>
                                </td>


                                <th>
                                    <button class="badge" style="background-color: gold; color: black;" data-toggle="modal"
                                        data-target="#ubahJamKerja<?= $jam['id_jamkerja']; ?>"><i class="fas fa-edit"></i>
                                        Edit</button>
                                    <button class="badge" style="background-color: #cc0000; color: antiquewhite"
                                        data-toggle="modal" data-target="#modal-sm<?= $jam['id_jamkerja']; ?>"><i
                                            class="fas fa-trash-alt"></i>
                                        Hapus</button>
                                </th>
                            <?php endforeach; ?>
                    </tbody>
                </table>
                <a class="badge" href=<?= base_url("Performances/PenilaianKinerja") ?> type="button"
                    style="background-color: #d4d4d4" ;><i class="fas fa-reply"></i>
                    Kembali
                </a>
            <?php } else { ?>
                <span class="badge badge-danger"><i class="fas fa-info-circle"></i>
                    Data masih kosong, silahkan pilih bulan dan tahun terlebih dahulu!</span>
            <?php } ?>
        </div>
    </div>
</div>
</div>



<!-- modal untuk tambah data -->
<div class="modal fade" id="tambahJamKerja" tabindex="-1" aria-labelledby="tambahJamKerjaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahJamKerjaLabel">Tambah Penilaian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('performances/JamKerja/tambahproses') ?>" method="POST">
                <div class="modal-body">
                    <div class=" form-group">

                        <label>NIK & Nama Karyawan</label>
                        <select class="form-control" name="nik_nama" id="nik_nama">
                            <option>-- Pilih Karyawan --</option>
                            <?php foreach ($datakaryawan as $dk): ?>
                                <option value="<?= $dk['nik']; ?>"><?= $dk['nik']; ?> - <?= $dk['nama_karyawan']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Posisi</label>
                        <input type="text" readonly id="id_posisi" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="due_date">Due Date</label>
                        <input type="date" class="form-control" id="due_date" name="due_date">
                    </div>
                    <div class="form-group">
                        <label for="complete_date">Complete Date</label>
                        <input type="date" class="form-control" id="complete_date" name="complete_date">
                    </div>


                    <!-- modal footer  -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn"
                            style="background-color: #8b0000; color:#ffffff;">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- import modal -->
<div class="modal fade" id="importJamKerja" tabindek="-1" role+dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('performances/JamKerja/import_excel') ?>" method="POST"
                enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="import" name="import" accept=".xlsx,.xls">
                            <label class="custom-file-label" for="import">Choose file</label>
                        </div>
                    </div>
                    <!-- modal footer  -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn"
                            style="background-color: #8b0000; color:#ffffff;">Import</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Akhir tambah data masal Modal -->



<!-- Modal informasi Data -->
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


<!-- Modal edit data -->
<?php foreach ($jamkerja as $jam): ?>
    <div class="modal fade" id="ubahJamKerja<?= $jam['id_jamkerja']; ?>" tabindex="-1" aria-labelledby="ubahJamKerjaLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahJamKerjaLabel">Ubah Data Karyawan</h5><br>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="<?= base_url('performances/JamKerja/ubah') ?>" method="POST">
                    <div class="modal-body">
                        <h6 style="color: black;"><i>WAJIB MEMILIH NIK & NAMA KARYAWAN KEMBALI, SEBELUM MERUBAH NILAI!!</i>
                        </h6>
                        <input type="hidden" name="id_jamkerja" value="<?= $jam['id_jamkerja']; ?>">
                        <div class=" form-group">
                            <label>NIK & Nama Karyawan</label>
                            <select class="form-control" name="nik_nama" id="nik_nama" placeholder="-- Pilih Karyawan --">
                                <?php foreach ($datakaryawan as $dk): ?>
                                    <?php if ($dk['nik'] == $jam['nik']): ?>
                                        <option value="<?= $dk['nik']; ?>" selected><?= $dk['nama_karyawan'] ?></option>
                                    <?php else: ?>
                                        <option value="<?= $dk['nik']; ?>"><?= $dk['nama_karyawan'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Posisi</label>
                            <?php foreach ($datakaryawan as $dk): ?>
                                <?php if ($dk['nik'] == $jam['nik']): ?>
                                    <?php foreach ($dataposisi as $dp): ?>
                                        <?php if ($dp['id_posisi'] == $dk['id_posisi']): ?>
                                            <input type="text" readonly id="id_posisi" class="form-control"
                                                value="<?= $dp['nama_posisi']; ?>" />
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <!-- <input type="text" readonly id="id_posisi" class="form-control" /> -->
                        </div>

                        <div class="form-group">
                            <label for="due_date">Due Date</label>
                            <input type="date" class="form-control" id="due_date" name="due_date"
                                value="<?= $jam['due_date']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="complete_date">Complete Date</label>
                            <input type="date" class="form-control" id="complete_date" name="complete_date"
                                value="<?= $jam['complete_date']; ?>">
                        </div>
                        <!-- modal footer  -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn"
                                style="background-color: #8b0000; color:#ffffff;">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<!-- Modal Hapus -->
<?php foreach ($jamkerja as $jam): ?>
    <div class="modal fade" id="modal-sm<?= $jam['id_jamkerja']; ?>" tabindek="-1" role+dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk menghapus data ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn" data-dismiss="modal" style="background-color: #d4d4d4;">Tidak</button>
                    <a href="<?= base_url() ?>performances/JamKerja/hapus/<?= $jam['id_jamkerja'] ?>" type="submit"
                        class="btn" style="background-color: #8b0000; color:#ffffff;">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>
</div>
</div>

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