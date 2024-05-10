<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i>
                Tambah Posisi
            </button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Posisi</th>
                        <th>Kode</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($dataposisi as $dp) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $dp['nama_posisi']; ?></td>
                            <td><?= $dp['kode']; ?></td>
                            <td>
                                <button class="badge" style="background-color: gold; color: black;" data-toggle="modal" data-target="#ubahPosisi<?= $dp['id_posisi']; ?>"><i class="fas fa-edit"></i>
                                    Edit</button>
                                <button class="badge" style="background-color: #cc0000; color: antiquewhite" data-toggle="modal" data-target="#modal-sm<?= $dp['id_posisi']; ?>"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Posisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url() ?>master/DataPosisi/tambah/" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="posisi">Posisi</label>
                        <input type="text" class="form-control" name="posisi" id="posisi" placeholder="Masukan Posisi">
                    </div>
                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="text" class="form-control" name="kode" id="kode" placeholder="Masukan Posisi">
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
<!-- akhir modal tambah -->


<!-- Modal Edit -->
<?php foreach ($dataposisi as $dp) : ?>
    <div class="modal fade" id="ubahPosisi<?= $dp['id_posisi']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Posisi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url() ?>master/DataPosisi/ubah/" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id_posisi" value="<?= $dp['id_posisi']; ?>">
                        <div class="form-group">
                            <label for="posisi">Posisi</label>
                            <input type="text" class="form-control" name="posisi" id="posisi" value="<?= $dp['nama_posisi']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="posisi">Kode</label>
                            <input type="text" class="form-control" name="kode" id="kode" value="<?= $dp['kode']; ?>">
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
<?php endforeach; ?>
<!-- akhir modal aedit -->


<?php foreach ($dataposisi as $dp) : ?>
    <div class="modal fade" id="modal-sm<?= $dp['id_posisi']; ?>">
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
                    <a href="<?= base_url() ?>master/DataPosisi/hapus/<?= $dp['id_posisi'] ?>" type="submit" class="btn btn-primary" style="background-color: #8b0000; color: #ffffff;">Ya</a>
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