<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#tambahDataBpjs"><i class="fas fa-plus"></i>
                Tambah Data BPJS
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead style="text-align: center; background-color: #ff0000; color: #ffffff;">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Nilai</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                    <?php $no = 1 ?>
                    <?php foreach ($databpjs as $db) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $db['kelas']; ?></td>
                            <td>RP <?= number_format($db['nilai'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="" class="badge" style="background-color: #fbff39; color: black;" data-toggle="modal" data-target="#ubahDataBpjs<?= $db['id']; ?>">Ubah</a>
                                <a href="" class="badge" style="background-color: #ff0000; color: black;" data-toggle="modal" data-target="#modal-sm<?= $db['id']; ?>">hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal tambah -->
<div class="modal fade" id="tambahDataBpjs" tabindex="-1" aria-labelledby="tambahDataBpjsLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDataBpjsLabel">Tambah Data BPJS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('payroll/databpjs/tambah'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Masukan kelas">
                    </div>
                    <div class="form-group">
                        <label for="nilai">Nilai</label>
                        <input type="text" class="form-control" id="nilai" name="nilai" placeholder="Masukan nilai">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal ubah -->
<?php foreach ($databpjs as $db) : ?>
    <div class="modal fade" id="ubahDataBpjs<?= $db['id']; ?>" tabindex="-1" aria-labelledby="ubahDataBpjsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahDataBpjsLabel">Ubah Data BPJS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('payroll/databpjs/ubah'); ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $db['id']; ?>">
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $db['kelas']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nilai">Nilai</label>
                            <input type="text" class="form-control" id="nilai" name="nilai" value="<?= $db['nilai']; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-danger">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal hapus -->
<?php foreach ($databpjs as $db) : ?>
    <div class="modal fade" id="modal-sm<?= $db['id']; ?>">
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
                    <button type="button" class="btn" data-dismiss="modal" style="background-color: #fbff39;">Tidak</button>
                    <a href="<?= base_url() ?>payroll/databpjs/hapus/<?= $db['id']  ?>" type="submit" class="btn btn-primary">Ya</a>
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