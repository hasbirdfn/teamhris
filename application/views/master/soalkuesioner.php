<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal"
                data-target="#exampleModal"><i class="fas fa-plus"></i>
                Tambah Soal Kuesioner
            </button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pertanyaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($soalkuesioner as $sk): ?>
                        <tr>
                            <th>
                                <?= $no++; ?>
                            </th>
                            <td>
                                <?= $sk['kuesioner']; ?>
                            </td>
                            <td>
                                <button class="badge" style="background-color: gold; color: black;" data-toggle="modal"
                                    data-target="#ubahKuesioner<?= $sk['id_kuesioner']; ?>"><i class="fas fa-edit"></i>
                                    Edit</button>
                                <button class="badge" style="background-color: #cc0000; color: antiquewhite"
                                    data-toggle="modal" data-target="#modal-sm<?= $sk['id_kuesioner']; ?>"><i
                                        class="fas fa-trash-alt"></i> Hapus</button>

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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pertanyaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url() ?>master/SoalKuesioner/tambah/" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kuesioner">Pertanyaan</label>
                        <input type="text" class="form-control" name="kuesioner" id="kuesioner"
                            placeholder="Masukan Pertanyaan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn" style="background-color: #8b0000; color:#ffffff;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir modal tambah -->


<!-- Modal Edit -->
<?php foreach ($soalkuesioner as $sk): ?>
    <div class="modal fade" id="ubahKuesioner<?= $sk['id_kuesioner']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pertanyaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url() ?>master/SoalKuesioner/ubah/" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id_kuesioner" value="<?= $sk['id_kuesioner']; ?>">
                        <div class="form-group">
                            <label for="posisi">Kuesioner</label>
                            <input type="text" class="form-control" name="kuesioner" id="kuesioner"
                                value="<?= $sk['kuesioner']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn" style="background-color: #8b0000; color:#ffffff;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- akhir modal aedit -->


<!-- Modal Hapus -->
<?php foreach ($soalkuesioner as $sk): ?>
    <div class="modal fade" id="modal-sm<?= $sk['id_kuesioner']; ?>">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Pertanyaan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk menghapus data ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url() ?>master/SoalKuesioner/hapus/<?= $sk['id_kuesioner'] ?>" type="submit"
                        class="btn" style="background-color: #8b0000; color:#ffffff;">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>

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