<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#tambahpekerjaan"><i class="fas fa-plus"></i>
                Tambah Pekerjaan
            </button>
            <table id="example1" class="table table-bordered table-striped">
                <thead style="background-color: #8b0000; color: #ffffff;">
                    <tr>
                        <th>No</th>
                        <th>Posisi</th>
                        <th>Deskripsi Pekerjaan</th>
                        <th>Kualifikasi</th>
                        <th>Tanggal Berakhir</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($pekerjaan as $it) : ?>
                        <tr>
                            <th>
                                <?= $no++; ?>
                            </th>
                            <td>
                                <?= $it['nama_posisi']; ?>
                            </td>
                            <td>
                                <?= $it['deskripsi_pekerjaan']; ?>
                            </td>
                            <td>
                                <?= $it['kualifikasi']; ?>
                            </td>
                            <td>
                                <?= $it['tanggal_berakhir']; ?>
                            </td>
                            <td>
                                <?= $it['foto']; ?>
                            </td>
                            <td>
                                <button type="button" class="badge" style="background-color: gold; color: black;" data-toggle="modal" data-target="#ubahpekerjaan<?= $it['id_pekerjaan']; ?>"><i class="fas fa-edit"></i>edit</button>
                                <button type="button" class="badge" style="background-color: #cc0000; color: antiquewhite" data-toggle="modal" data-target="#modal-sm<?= $it['id_pekerjaan'] ?>"><i class="fas fa-trash-alt"></i>hapus</button>
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
<div class="modal fade" id="tambahpekerjaan" tabindex="-1" aria-labelledby="tambahpekerjaanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahpekerjaanLabel">Tambah Pekerjaan Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Recruitment/Pekerjaan/tambah_pekerjaan') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Posisi</label>
                        <select class="form-control" id="posisi" name="posisi">
                            <option>-- Pilih Posisi --</option>
                            <?php foreach ($dataposisi as $dp) : ?>
                                <option value="<?= $dp['id_posisi']; ?>"><?= $dp['nama_posisi']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_pekerjaan">Deskripsi Pekerjaan</label>
                        <textarea class="form-control" name="deskripsi_pekerjaan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="kualifikasi">Kualifikasi</label>
                        <textarea class="form-control" name="kualifikasi"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_berakhir">tanggal Berakhir</label>
                        <input type="date" class="form-control" id="tanggal_berakhir" name="tanggal_berakhir">
                    </div>
                    <label>Foto</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="foto" name="foto">
                        <label for="foto" class="custom-file-label">Pilih Foto</label>
                    </div>
                    <!-- modal footer  -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir tambah Modal -->

<!-- Modal edit data -->
<?php foreach ($pekerjaan as $it) : ?>
    <div class="modal fade" id="ubahpekerjaan<?= $it['id_pekerjaan']; ?>" tabindex="-1" aria-labelledby="ubahpekerjaanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahpekerjaanLabel">Ubah Pekerjaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('Recruitment/Pekerjaan/ubah_pekerjaan') ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="id_pekerjaan" value="<?= $it['id_pekerjaan']; ?>">
                        <div class="form-group">
                            <label>Posisi</label>
                            <select class="form-control" name="posisi">
                                <option value="">-- Pilih Posisi --</option>
                                <?php foreach ($dataposisi as $dp) : ?>
                                    <?php if ($dp['id_posisi'] == $dk['id_posisi']) : ?>
                                        <option value="<?= $dp['id_posisi']; ?>" selected><?= $dp['nama_posisi'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $dp['id_posisi']; ?>"><?= $dp['nama_posisi'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_pekerjaan">Deskripsi Pekerjaan</label>
                            <textarea class="form-control" name="deskripsi_pekerjaan"><?= $it['deskripsi_pekerjaan']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="kualifikasi">Kualifikasi</label>
                            <textarea class="form-control" name="kualifikasi"><?= $it['kualifikasi']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_berakhir">Tanggal Berakhir</label>
                            <input type="date" class="form-control" id="tanggal_berakhir" name="tanggal_berakhir" value="<?= $it['tanggal_berakhir']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto" value="<?= $it['foto']; ?>">
                        </div>
                        <!-- modal footer  -->
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



<!-- Modal Hapus -->
<?php foreach ($pekerjaan as $it) : ?>
    <div class="modal fade" id="modal-sm<?= $it['id_pekerjaan']; ?>" tabindek="-1" role+dialog">
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
                    <a href="<?= base_url() ?>Recruitment/pekerjaan/hapus/<?= $it['id_pekerjaan'] ?>" type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>
<!-- akhir modal hapus -->


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