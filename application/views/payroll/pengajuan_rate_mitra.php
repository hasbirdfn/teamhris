<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background-color: #8b0000;">
                    <h3 class="card-title" style="color: white;">Cetak Data</h3>
                </div>
                <form class="form-horizontal" method="post" action="<?= base_url('payroll/PengajuanRateMitra/cetakRateExcel'); ?>">
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
                            <a class="btn btn-outline-success" href="<?= base_url('payroll/PengajuanRateMitra/generate'); ?>"><i class="fas fa-archive"></i> Generate Data <?= $bulan; ?></a>
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
            <table id="data" class="table table-bordered table-striped">
                <thead style="background-color: #8b0000; color: #ffffff;">
                    <tr>
                        <th>No</th>
                        <th>Nama Perusahaan</th>
                        <th>Nama Karyawan</th>
                        <th>Keahlian</th>
                        <th>Tools</th>
                        <th>Rate Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- Modal status -->
<?php foreach ($ratemitra as $rm) : ?>
    <div class="modal fade" id="modal-sm<?= $rm['id']; ?>">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Status Bayar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk ubah status bayar <b><?= $rm['nama_karyawan']; ?></b>?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url() ?>payroll/PengajuanRateMitra/status/<?= $rm['id']  ?>" type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#month').html($('#bulan option:selected').text());
        var userDataTable = $('#data').DataTable({
            'responsive': true,
            'orderable': true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'searching': true, // Remove default Search Control
            'ajax': {
                'url': '<?= base_url() ?>payroll/PengajuanRateMitra/list',
                'data': function(data) {
                    data.searchBulan = $('#bulan').val();
                    data.searchTahun = $('#tahun').val();
                }
            },
            'columns': [{
                    data: 'no'
                },
                {
                    data: 'nama_perusahaan'
                },
                {
                    data: 'nama_karyawan'
                },
                {
                    data: 'keahlian'
                },
                {
                    data: 'tools'
                },
                {
                    data: 'rate_total'
                },
                {
                    data: 'status'
                },
                {
                    data: 'aksi'
                }
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
</script>