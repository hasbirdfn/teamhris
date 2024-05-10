<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#tambahPajakKaryawan"><i class="fas fa-plus"></i>
                Tambah Pajak Karyawan
            </button>
            <table id="data" class="table table-bordered table-striped">
                <thead style="background-color: #8b0000; color: #ffffff;">
                    <tr>
                        <th>No</th>
                        <th>NIK - Nama Karyawan</th>
                        <th>Golongan</th>
                        <th>Kode</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- Modal tambah -->
<div class="modal fade" id="tambahPajakKaryawan" tabindex="-1" aria-labelledby="tambahPajakKaryawanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPajakKaryawanLabel">Tambah Pajak Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('payroll/Pajak/tambah'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nik_nama">NIK & Nama Karyawan</label>
                        <select name="nik_nama" id="nik_nama" class="form-control">
                            <option value="">-- Pilih NIK & Nama --</option>
                            <?php foreach ($datakaryawan as $dk) : ?>
                                <option value="<?= $dk['id_karyawan']; ?>"><?= $dk['nik']; ?> - <?= $dk['nama_karyawan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="golongan_kode">Golongan & Kode</label>
                        <select name="golongan_kode" id="golongan_kode" class="form-control">
                            <option value="">-- Pilih Golongan & Kode --</option>
                            <?php foreach ($datapajak as $dp) : ?>
                                <option value="<?= $dp['id']; ?>"><?= $dp['golongan']; ?> - <?= $dp['kode'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal ubah -->
<?php foreach ($pajakkaryawan as $pk) : ?>
    <div class="modal fade" id="ubahPajakKaryawan<?= $pk['id_pajak']; ?>" tabindex="-1" aria-labelledby="ubahPajakKaryawanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahPajakKaryawanLabel">Ubah Pajak Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('payroll/Pajak/ubah'); ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $pk['id_pajak']; ?>">
                            <label for="nik_nama">NIK & Nama Karyawan</label>
                            <select name="nik_nama" id="nik_nama" class="form-control">
                                <option value="">-- Pilih NIK & Nama --</option>
                                <?php foreach ($datakaryawan as $dk) : ?>
                                    <?php if ($dk['id_karyawan'] == $pk['id_datakaryawan']) : ?>
                                        <option value="<?= $dk['id_karyawan']; ?>" selected><?= $dk['nik']; ?> - <?= $dk['nama_karyawan'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $dk['id_karyawan']; ?>"><?= $dk['nik']; ?> - <?= $dk['nama_karyawan'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="golongan_kode">Golongan & Kode</label>
                            <select name="golongan_kode" id="golongan_kode" class="form-control">
                                <option value="">-- Pilih Golongan & Kode --</option>
                                <?php foreach ($datapajak as $dp) : ?>
                                    <?php if ($dp['id'] == $pk['id_datapajak']) : ?>
                                        <option value="<?= $dp['id']; ?>" selected><?= $dp['golongan']; ?> - <?= $dp['kode'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $dp['id']; ?>"><?= $dp['golongan']; ?> - <?= $dp['kode'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal hapus -->
<?php foreach ($pajakkaryawan as $pk) : ?>
    <div class="modal fade" id="modal-sm<?= $pk['id_pajak']; ?>">
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
                    <a href="<?= base_url() ?>payroll/Pajak/hapus/<?= $pk['id_pajak']  ?>" type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Ya</a>
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
        <?php if (validation_errors()) : ?>
            const flashData = <?= json_encode(validation_errors()) ?>;
            Toast.fire({
                icon: 'error',
                title: flashData
            })
        <?php endif; ?>
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
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
                'url': '<?= base_url() ?>payroll/Pajak/tabel'
            },
            'columns': [{
                    data: 'no'
                },
                {
                    data: 'nik_nama'
                },
                {
                    data: 'golongan'
                },
                {
                    data: 'kode'
                },
                {
                    data: 'aksi'
                },
            ]
        });
    });
</script>