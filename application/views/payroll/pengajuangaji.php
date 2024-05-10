<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background-color: #8b0000;">
                    <h3 class="card-title" style="color: white;">Cetak Data</h3>
                </div>
                <form class="form-horizontal" method="post" action="<?= base_url('payroll/PengajuanGaji/excel'); ?>">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label">Bulan</label>
                            <div class="col">
                                <select class="form-control select2" id="bulan" name="bulan" onChange="myNewFunction(this);">
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
                            <label for="tahun" class="col-form-label">Tahun</label>
                            <div class="col">
                                <select class="form-control select2" id="tahun" name="tahun">
                                    <?php for ($i = date('Y'); $i >= 2020; $i--) : ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-outline-success ml-2"><i class="fas fa-print"></i> Cetak Data</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
        </div>
        <?php switch (date('m')) {
            case '01':
                $bulan = 'Februari';
                break;
            case '02':
                $bulan = 'Maret';
                break;
            case '03':
                $bulan = 'April';
                break;
            case '04':
                $bulan = 'Mei';
                break;
            case '05':
                $bulan = 'Juni';
                break;
            case '06':
                $bulan = 'Juli';
                break;
            case '07':
                $bulan = 'Agustus';
                break;
            case '08':
                $bulan = 'September';
                break;
            case '09':
                $bulan = 'Oktober';
                break;
            case '10':
                $bulan = 'November';
                break;
            case '11':
                $bulan = 'Desember';
                break;
            case '12':
                $bulan = 'Januari';
                break;
        } ?>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header" style="background-color: #8b0000;">
                    <h3 class="card-title" style="color: white;">Generate Data</h3>
                </div>
                <form class="form-horizontal">
                    <div class="card-body">
                        <div class="form-group row">
                            <a class="btn btn-outline-success" href="<?= base_url('payroll/PengajuanGaji/generate'); ?>"><i class="fas fa-archive"></i> Generate Data <?= $bulan; ?></a>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
        </div>
    </div>

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <h3>Bulan <div id="month" style="display: inline;"></div>
            </h3>
            <div class="table-responsive">
                <table id="data" class="table table-bordered table-striped">
                    <thead style="background-color: #8b0000; color: #ffffff;">
                        <tr>
                            <th>No</th>
                            <th>NIK - Nama Karyawan</th>
                            <th>Posisi</th>
                            <th>Gaji Pokok</th>
                            <th>Pajak</th>
                            <th>Tj. Kinerja</th>
                            <th>Tj. Fungsional</th>
                            <th>Tj. Jabatan</th>
                            <th>Tj. BPJS Kesehatan</th>
                            <th>Potongan</th>
                            <th>Bonus</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- Modal status -->
<?php foreach ($pengajuan as $pg) : ?>
    <div class="modal fade" id="modal-sm<?= $pg['id']; ?>">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Status Bayar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk ubah status bayar <b><?= $pg['nama_karyawan']; ?></b>?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url() ?>payroll/PengajuanGaji/status/<?= $pg['id']  ?>" type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Ya</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php foreach ($pengajuan as $pg) : ?>
    <!-- Modal kirim slip -->
    <div class="modal fade" id="kirimSlipModal<?= $pg['id']; ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Preview Slip Gaji</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" action="<?= base_url() ?>payroll/PengajuanGaji/kirimSlip/<?= $pg['id']  ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $pg['id']; ?>">
                        <input type="hidden" name="email" value="<?= $pg['email']; ?>">
                        <input type="hidden" name="bulan_tahun" value="<?= $pg['bulan_tahun']; ?>">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="nik" class="col-form-label">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" disabled value="<?= $pg['nik']; ?>">
                                <input type="hidden" class="form-control" id="nik" name="nik2" value="<?= $pg['nik']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="nama" class="col-form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama_karyawan" disabled value="<?= $pg['nama_karyawan']; ?>">
                                <input type="hidden" class="form-control" id="nama" name="nama_karyawan2" value="<?= $pg['nama_karyawan']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="posisi" class="col-form-label">Posisi</label>
                                <input type="text" class="form-control" id="posisi" name="posisi" disabled value="<?= $pg['nama_posisi']; ?>">
                                <input type="hidden" class="form-control" id="posisi" name="posisi2" value="<?= $pg['nama_posisi']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="gaji" class="col-form-label">Gaji Pokok</label>
                                <input type="text" class="form-control" id="gaji" name="gaji" disabled value="Rp <?= number_format($pg['gajipokok'], 0, ',', '.'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="kinerja" class="col-form-label">Tunjangan kinerja</label>
                                <input type="text" class="form-control" id="kinerja" name="kinerja" disabled value="Rp <?= number_format($pg['t_kinerja'], 0, ',', '.'); ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="pajak" class="col-form-label">Pajak</label>
                                <input type="text" class="form-control" id="pajak" name="pajak" disabled value="Rp <?= number_format($pg['pajak'], 0, ',', '.'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="nama" class="col-form-label">Tunjangan Jabatan</label>
                                <input type="text" class="form-control" id="nama" name="jabatan" disabled value="Rp <?= number_format($pg['t_jabatan'], 0, ',', '.'); ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="nama" class="col-form-label">Tunjangan Fungsional</label>
                                <input type="text" class="form-control" id="nama" name="fungsional" disabled value="Rp <?= number_format($pg['t_fungsional'], 0, ',', '.'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="bpjs" class="col-form-label">Tunjangan BPJS Kesehatan</label>
                                <input type="text" class="form-control" id="bpjs" name="bpjs" disabled value="Rp <?= number_format($pg['t_bpjs'], 0, ',', '.'); ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="nama" class="col-form-label">Potongan</label>
                                <input type="text" class="form-control" id="nama" name="potongan" disabled value="Rp <?= number_format($pg['potongan'], 0, ',', '.'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="nama" class="col-form-label">Bonus</label>
                                <input type="text" class="form-control" id="nama" name="bonus" disabled value="Rp <?= number_format($pg['bonus'], 0, ',', '.'); ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="nama" class="col-form-label">Total</label>
                                <input type="text" class="form-control" id="nama" name="total" disabled value="Rp <?= number_format($pg['total'], 0, ',', '.'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal -->
<?php endforeach; ?>

<script type="text/javascript">
    $(document).ready(function() {

        $('#month').html($('#bulan option:selected').text());
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
                'url': '<?= base_url() ?>payroll/PengajuanGaji/list',
                'data': function(data) {
                    data.searchBulan = $('#bulan').val();
                    data.searchTahun = $('#tahun').val();
                }
            },
            'columns': [{
                    data: 'no'
                },
                {
                    data: 'nik_nama'
                },
                {
                    data: 'posisi'
                },
                {
                    data: 'gaji'
                },
                {
                    data: 'pajak'
                },
                {
                    data: 'kinerja'
                },
                {
                    data: 'fungsional'
                },
                {
                    data: 'jabatan'
                },
                {
                    data: 'bpjs'
                },
                {
                    data: 'potongan'
                },
                {
                    data: 'bonus'
                },
                {
                    data: 'total'
                },
                {
                    data: 'status'
                },
                {
                    data: 'aksi'
                },
            ]
        });

        $('#bulan,#tahun').change(function() {
            userDataTable.draw();
        });
    });
</script>

<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
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
    });

    let d = new Date();
    let m = d.getMonth() + 1
    let month = ('0' + m).slice(-2);
    document.getElementById("bulan").value = month;

    function myNewFunction(sel) {
        $('#month').html(sel.options[sel.selectedIndex].text);
    }
    // $('#bulan').change(function() {
    //     alert()
    // });
</script>