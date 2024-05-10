<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>
            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#tambahdatakeseluruhan"><i class="fas fa-plus"></i>
                Tambah Data
            </button>
            <table id="example1" class="table table-bordered table-striped">
                <thead style="background-color:  #8b0000; color: white;">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Ulasan</th>
                        <th>dokumen</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($datakeseluruhan as $dk) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $dk['nama']; ?></td>
                            <td><?= $dk['kategori']; ?></td>
                            <td><?= $dk['ulasan']; ?></td>
                            <td><?= $dk['file']; ?></td>
                            <td>
                                <button type="button" class="badge" style="color: antiquewhite; background-color:  #cc0000;" data-toggle="modal" data-target="#modal-sm<?= $dk['id_keseluruhan'] ?>"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- modal untuk tambah data -->
<div class="modal fade" id="tambahdatakeseluruhan" tabindex="-1" aria-labelledby="tambahdatakeseluruhanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahdatakeseluruhanLabel">Tambah Data </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('training/Datakeseluruhan/tambah') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama">
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukan Kategori">
                    </div>
                    <div class="form-group">
                        <label for="ulasan">Ulasan</label>
                        <textarea type="text" class="form-control" id="ulasan" name="ulasan" placeholder="Masukan Ulasan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="dokumen">Dokumen</label>
                        <input type="file" class="form-control" name="dokumen" placeholder="Masukan Dokumen">
                    </div>
                </div>
                <!-- modal footer  -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-danger" style="background-color: #8b0000; color: #ffffff;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir tambah Modal -->


<!-- Modal Hapus -->
<?php foreach ($datakeseluruhan as $dk) : ?>
    <div class="modal fade" id="modal-sm<?= $dk['id_keseluruhan']; ?>" tabindek="-1" role+dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    x
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk menghapus data ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url() ?>training/datakeseluruhan/hapus/<?= $dk['id_keseluruhan'] ?>" type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>
<!-- akhir modal hapus -->