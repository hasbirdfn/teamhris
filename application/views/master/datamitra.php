<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <button type="button" class="btn btn-outline-success mb-2 tambahDataMitraClear" data-toggle="modal" data-target="#tambahDataMitra" id="tambahDataMitraClear"><i class="fas fa-plus"></i>
                Tambah Mitra
            </button>
            <table id="data" class="table table-bordered table-striped">
                <thead style="background-color: #8b0000; color: #ffffff;">
                    <tr>
                        <th>No</th>
                        <th>Nama Perusahaan</th>
                        <th>Nama Karyawan</th>
                        <th>Keahlian</th>
                        <th>Tools</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Rate Total</th>
                        <th>Dokumen KerjaSama</th>
                        <th>Tanggal Kerjasama</th>
                        <th>Tanggal Berakhir</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #8b0000;">
                    <h3 class="card-title" style="color: white;">Laporan Keahlian & Tools Mitra</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <canvas id="keahlian"></canvas>
                        </div>
                        <div class="col-lg-6">
                            <canvas id="Tools"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="tambahDataMitra" tabindex="-1" aria-labelledby="tambahDataMitraLabel" aria-hidden="true">
    <script>
        var drcounterNew = 0;
    </script>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDataMitraLabel">Tambah Data Mitra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/DataMitra/tambah'); ?>" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="nama_perusahaan">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="nama_perusahaan" name="perusahaan" placeholder="Masukan Nama Perusahaan">
                    </div>
                    <div class="form-group">
                        <label for="nama_karyawan">Nama Karyawan</label>
                        <input type="text" class="form-control" id="nama_karyawan" name="nama" placeholder="Masukan Nama Karyawan">
                    </div>
                    <div class="form-group">
                        <label for="keahlian">Keahlian</label>
                        <table id="myTable" class=" table order-list-new">
                            <tbody>
                                <tr class="row">
                                    <td class="col-sm-2" style="border:none;">
                                        <button id="addrowKeahlian" type="button" class="btn btn-success" style="width: 100%;"><i class="fas fa-plus"></i></button>
                                    </td>
                                    <td class="col-sm-10" style="border:none;">
                                        <input type="text" class="form-control" name="keahlian[]" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <input type="text" class="form-control" id="keahlian" name="keahlian" placeholder="Masukan keahlian"> -->
                    </div>
                    <div class="form-group">
                        <label for="tools">Tools</label>
                        <table id="myTable" class=" table order-list-new-tools">
                            <tbody>
                                <tr class="row">
                                    <td class="col-sm-2" style="border:none;">
                                        <button id="addrowTools" type="button" class="btn btn-success" style="width: 100%;"><i class="fas fa-plus"></i></button>
                                    </td>
                                    <td class="col-sm-10" style="border:none;">
                                        <input type="text" class="form-control" name="tools[]" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Masukan email">
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Masukan telepon">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan alamat">
                    </div>
                    <div class="form-group">
                        <label for="rate_total">Rate total</label>
                        <input type="text" class="form-control" id="rate_total" name="rate_total" placeholder="Masukan rate total">
                    </div>
                    <div class="form-group">
                        <label for="dokumen_kerjasama">Dokumen Kerjasama</label>
                        <input type="text" class="form-control" id="dokumen_kerjasama" name="dokumen_kerjasama" placeholder="Masukan URL dokumen">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_masuk">Tanggal Kerjasama</label>
                        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_keluar">Tanggal Berakhir</label>
                        <input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit -->
<?php foreach ($datamitra as $dm) : ?>
    <script>
        var drcounter = <?= count(unserialize($dm['keahlian'])) ?>;
    </script>
    <div class="modal fade" id="ubahDataMitra<?= $dm['id'] ?>" tabindex="-1" aria-labelledby="ubahDataMitraLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahDataMitraLabel">Ubah Data Mitra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('master/DataMitra/ubah'); ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $dm['id']; ?>">
                        <div class="form-group">
                            <label for="nama_perusahaan">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="nama_perusahaan" name="perusahaan" value="<?= $dm['nama_perusahaan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_karyawan">Nama Karyawan</label>
                            <input type="text" class="form-control" id="nama_karyawan" name="nama" value="<?= $dm['nama_karyawan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="keahlian">Keahlian</label>
                            <table id="myTable<?= $dm['id'] ?>" class=" table order-list<?= $dm['id'] ?>">
                                <tbody>
                                    <?php $datakeahlian = unserialize($dm['keahlian']) ?>
                                    <?php if (count($datakeahlian) > 0) : ?>
                                        <?php foreach ($datakeahlian as $key => $value) : ?>
                                            <tr class="row baris-keahlian">
                                                <td class="col-sm-2" style="border:none;">
                                                    <?php if ($key == 0) echo '<button id="addrow' . $dm['id'] . '" type="button" class="btn btn-success" style="width: 100%;"><i class="fas fa-plus"></i></button>'; ?>
                                                    <?php if ($key > 0) echo '<button type="button" class="btn btn-primary ibtnDel" style="width: 100%;"><i class="fas fa-trash"></i></button>'; ?>
                                                </td>
                                                <td class="col-sm-10 edit<?= $dm['id'] ?>" style="border:none;">
                                                    <input type="text" class="form-control" name="keahlian[]" value="<?= $value ?>" />
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr class="row baris-keahlian">
                                            <td class="col-sm-2" style="border:none;">
                                                <button id="addrow<?= $dm['id'] ?>" type="button" class="btn btn-success" style="width: 100%;"><i class="fas fa-plus"></i></button>
                                            </td>
                                            <td class="col-sm-10 edit<?= $dm['id'] ?>" style="border:none;">
                                                <input type="text" class="form-control" name="keahlian[]" />
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <!-- <input type="text" class="form-control" id="keahlian" name="keahlian" value="<?= $dm['keahlian']; ?>"> -->
                        </div>
                        <div class="form-group">
                            <label for="tools">Tools</label>
                            <table id="myTable<?= $dm['id'] ?>" class=" table order-list-tools<?= $dm['id'] ?>">
                                <tbody>
                                    <?php $datatools = unserialize($dm['tools']) ?>
                                    <?php if (count($datatools) > 0) : ?>
                                        <?php foreach ($datatools as $key => $value) : ?>
                                            <tr class="row baris-tools">
                                                <td class="col-sm-2" style="border:none;">
                                                    <?php if ($key == 0) echo '<button id="addrowtools' . $dm['id'] . '" type="button" class="btn btn-success" style="width: 100%;"><i class="fas fa-plus"></i></button>'; ?>
                                                    <?php if ($key > 0) echo '<button type="button" class="btn btn-primary ibtnDel" style="width: 100%;"><i class="fas fa-trash"></i></button>'; ?>
                                                </td>
                                                <td class="col-sm-10 edit<?= $dm['id'] ?>" style="border:none;">
                                                    <input type="text" class="form-control" name="tools[]" value="<?= $value ?>" />
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr class="row baris-tools">
                                            <td class="col-sm-2" style="border:none;">
                                                <button id="addrowtools<?= $dm['id'] ?>" type="button" class="btn btn-success" style="width: 100%;"><i class="fas fa-plus"></i></button>
                                            </td>
                                            <td class="col-sm-10 edit<?= $dm['id'] ?>" style="border:none;">
                                                <input type="text" class="form-control" name="tools[]" />
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <!-- <input type="text" class="form-control" id="tools" name="tools" value="<?= $dm['tools']; ?>"> -->
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= $dm['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="telepon">Telepon</label>
                            <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $dm['telepon']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $dm['alamat']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="rate_total">Rate total</label>
                            <input type="text" class="form-control" id="rate_total<?= $dm['id']; ?>" name="rate_total" value="Rp <?= number_format($dm['rate_total'], 0, ',', '.'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="dokumen_kerjasama">Dokumen Kerjasama</label>
                            <input type="text" class="form-control" id="dokumen_kerjasama" name="dokumen_kerjasama" value="<?= $dm['dokumen_kerjasama']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_masuk">Tanggal Kerjasama</label>
                            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?= $dm['tanggal_masuk']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_keluar">Tanggal Berakhir</label>
                            <input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar" value="<?= $dm['tanggal_keluar']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status">
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var rate_total<?= $dm['id']; ?> = document.getElementById('rate_total<?= $dm['id']; ?>');
        rate_total<?= $dm['id']; ?>.addEventListener('keyup', function(e) {
            rate_total<?= $dm['id']; ?>.value = formatRupiah(this.value, 'Rp ');
        });
    </script>
    <script>
        function myFunction<?= $dm['id'] ?>() {

            $("table#myTable<?= $dm['id'] ?>.order-list<?= $dm['id'] ?> tr").each(function() {
                var badCount = 0;
                var inputLength = $(this).find('input').length;
                $(this).find('input').each(function() {
                    if ($(this).val() == "") {
                        badCount++;
                    }
                });
                if (badCount == inputLength) {
                    $(this).remove();
                }
            });

            $("table#myTable<?= $dm['id'] ?>.order-list-tools<?= $dm['id'] ?> tr").each(function() {
                var badCount = 0;
                var inputLength = $(this).find('input').length;
                $(this).find('input').each(function() {
                    if ($(this).val() == "") {
                        badCount++;
                    }
                });
                if (badCount == inputLength) {
                    $(this).remove();
                }
            });
        }

        $("#addrow<?= $dm['id'] ?>").on("click", function() {
            var newRow<?= $dm['id'] ?> = $('<tr class="row baris-keahlian">');
            var cols<?= $dm['id'] ?> = "";
            cols<?= $dm['id'] ?> += '<td class="col-sm-2" style="border:none;"><button type="button" class="btn btn-primary ibtnDel" style="width: 100%;"><i class="fas fa-trash"></i></button></td>';
            cols<?= $dm['id'] ?> += '<td class="col-sm-10 edit<?= $dm['id'] ?>" style="border:none;"><input type="text" class="form-control" name="keahlian[]"/></td>';
            newRow<?= $dm['id'] ?>.append(cols<?= $dm['id'] ?>);
            $("table.order-list<?= $dm['id'] ?>").append(newRow<?= $dm['id'] ?>);
            drcounter++;
        });

        $("#addrowtools<?= $dm['id'] ?>").on("click", function() {
            var newRow<?= $dm['id'] ?> = $('<tr class="row baris-tools">');
            var cols<?= $dm['id'] ?> = "";
            cols<?= $dm['id'] ?> += '<td class="col-sm-2" style="border:none;"><button type="button" class="btn btn-primary ibtnDel" style="width: 100%;"><i class="fas fa-trash"></i></button></td>';
            cols<?= $dm['id'] ?> += '<td class="col-sm-10 edit<?= $dm['id'] ?>" style="border:none;"><input type="text" class="form-control" name="tools[]"/></td>';
            newRow<?= $dm['id'] ?>.append(cols<?= $dm['id'] ?>);
            $("table.order-list-tools<?= $dm['id'] ?>").append(newRow<?= $dm['id'] ?>);
            drcounter++;
        });

        $("table.order-list<?= $dm['id'] ?>").on("click", ".ibtnDel", function(event) {
            $(this).closest("tr").remove();
            drcounter -= 1
        });

        $("table.order-list-tools<?= $dm['id'] ?>").on("click", ".ibtnDel", function(event) {
            $(this).closest("tr").remove();
            drcounter -= 1
        });
    </script>
<?php endforeach; ?>

<?php foreach ($datamitra as $dm) : ?>
    <div class="modal fade" id="modal-sm<?= $dm['id'] ?>">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url() ?>master/DataMitra/hapus/<?= $dm['id']  ?>" type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>

<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        <?php if ($this->session->flashdata('message')) : ?>
            const flashData = <?= json_encode($this->session->flashdata('message')) ?>;
            Toast.fire({
                icon: 'success',
                title: flashData
            })
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')) : ?>
            const flashData = <?= json_encode($this->session->flashdata('error')) ?>;
            Toast.fire({
                icon: 'error',
                title: flashData
            })
        <?php endif; ?>
        <?php if (validation_errors()) : ?>
            const flashData = <?= json_encode(validation_errors()) ?>;
            Toast.fire({
                icon: 'error',
                title: flashData
            })
        <?php endif; ?>
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
$allKeahlian = [];
$allKeahlianCount = [];
foreach ($keahlian as $kt) {
    foreach (unserialize($kt['keahlian']) as $ktkt) {
        $keahlianexplode = explode(', ', $ktkt);
        $countKeahlian = count($keahlianexplode);
        for ($i = 0; $i < $countKeahlian; $i++) {
            if (!in_array($keahlianexplode[$i], $allKeahlian, true)) {
                array_push($allKeahlian, $keahlianexplode[$i]);
            }
            array_push($allKeahlianCount, $keahlianexplode[$i]);
        };
    }
}
$data = array_count_values($allKeahlianCount);
$datajs = json_encode(array_count_values($allKeahlianCount));
$dataTotal = 0;
foreach ($data as $dk => $value) {
    $namaKeahlian = $dk;
    $jumlahKeahlian = $value;
    // echo $namaKeahlian . '-' . $jumlahKeahlian;
}
// print_r(array_count_values($allKeahlianCount));
// print_r($data['Developer']);
?>

<?php
$allTools = [];
$allToolsCount = [];
foreach ($keahlian as $kt) {
    foreach (unserialize($kt['tools']) as $ktkt) {
        $Toolsexplode = explode(', ', $ktkt);
        $countTools = count($Toolsexplode);
        for ($i = 0; $i < $countTools; $i++) {
            if (!in_array($Toolsexplode[$i], $allTools, true)) {
                array_push($allTools, $Toolsexplode[$i]);
            }
            array_push($allToolsCount, $Toolsexplode[$i]);
        };
    }
}
$dataTools = array_count_values($allToolsCount);
$datajs = json_encode(array_count_values($allToolsCount));
$dataTotal = 0;
foreach ($dataTools as $dt => $value) {
    $namaTools = $dt;
    $jumlahTools = $value;
    // echo $namaKeahlian . '-' . $jumlahKeahlian;
}
// print_r(array_count_values($allToolsCount));
// print_r($data['Developer']);
?>

<script>
    const keahlian = document.getElementById('keahlian');
    new Chart(keahlian, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_keys(array_count_values($allKeahlianCount))) ?>,
            datasets: [{
                label: 'Keahlian',
                data: <?= json_encode(array_values(array_count_values($allKeahlianCount))) ?>,
                borderWidth: 1,
                barPercentage: 1,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const Tools = document.getElementById('Tools');
    new Chart(Tools, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_keys(array_count_values($allToolsCount))) ?>,
            datasets: [{
                label: 'Tools',
                data: <?= json_encode(array_values(array_count_values($allToolsCount))) ?>,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        dynamicRowsNew();
        var userDataTable = $('#data').DataTable({
            'responsive': true,
            'orderable': true,
            'ordering': true,
            'processing': true,
            'serverSide': true,
            "autoWidth": false,
            'serverMethod': 'post',
            'searching': true, // Remove default Search Control
            'ajax': {
                'url': '<?= base_url() ?>master/DataMitra/tabel'
            },
            'columns': [{
                    data: 'no'
                },
                {
                    data: 'nama_perusahaan'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'keahlian'
                },
                {
                    data: 'tools'
                },
                {
                    data: 'email'
                },
                {
                    data: 'telepon'
                },
                {
                    data: 'alamat'
                },
                {
                    data: 'rate'
                },
                {
                    data: 'dokumen'
                },
                {
                    data: 'tgl_masuk'
                },
                {
                    data: 'tgl_keluar'
                },
                {
                    data: 'status'
                },
                {
                    data: 'aksi'
                }
            ]
        });
    });

    function dynamicRowsNew() {
        $("#addrowKeahlian").on("click", function() {
            var newRow = $('<tr class="row add-new">');
            var cols = "";
            cols += '<td class="col-sm-2" style="border:none;"><button type="button" class="btn btn-primary ibtnDel" style="width: 100%;"><i class="fas fa-trash"></i></button></td>';
            cols += '<td class="col-sm-10" style="border:none;"><input type="text" class="form-control" name="keahlian[]"/></td>';
            newRow.append(cols);
            $("table.order-list-new").append(newRow);
            drcounterNew++;
        });

        $("#addrowTools").on("click", function() {
            var newRow = $('<tr class="row add-new">');
            var cols = "";
            cols += '<td class="col-sm-2" style="border:none;"><button type="button" class="btn btn-primary ibtnDel" style="width: 100%;"><i class="fas fa-trash"></i></button></td>';
            cols += '<td class="col-sm-10" style="border:none;"><input type="text" class="form-control" name="tools[]"/></td>';
            newRow.append(cols);
            $("table.order-list-new-tools").append(newRow);
            drcounterNew++;
        });

        $("#tambahDataMitraClear").on("click", function(event) {
            $('table.order-list-new tr.add-new').remove();
            $('table.order-list-new-tools tr.add-new').remove();
            drcounterNew = 0
        });

        $("table.order-list-new").on("click", ".ibtnDel", function(event) {
            $(this).closest("tr").remove();
            drcounter -= 1
        });

        $("table.order-list-new-tools").on("click", ".ibtnDel", function(event) {
            $(this).closest("tr").remove();
            drcounter -= 1
        });
    }

    var rate_total = document.getElementById('rate_total');
    rate_total.addEventListener('keyup', function(e) {
        rate_total.value = formatRupiah(this.value, 'Rp ');
    });

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
    }
</script>