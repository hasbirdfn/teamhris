<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-4">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>
            <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#tambahSoalRecruitment"><i class="fas fa-plus"></i>
                Tambah Soal
            </button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Posisi</th>
                        <th>Link Soal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($soalrecruitment as $sr) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $sr['nama_posisi']; ?></td>
                            <td><?= $sr['link_soal']; ?></td>
                            <td>
                                <button type="button" class="btn btn-default" style="font-size: 14px; color: black; background-color: #ffcc00;" data-toggle="modal" data-target="#ubahSoalRecruitment<?= $sr['id_soal_recruitment'] ?>">edit</button>
                                <button type="button" class="btn btn-danger" style="font-size: 12px; color: white; background-color:  #cc0000;" data-toggle="modal" data-target="#modal-sm<?= $sr['id_soal_recruitment'] ?>">hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>


<!-- Modal Tambah -->
<div class="modal fade" id="tambahSoalRecruitment" tabindex="-1" aria-labelledby="tambahSoalRecruitmentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahSoalRecruitmentLabel">Tambah Soal Recruitment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/soalrecruitment/tambah'); ?>" method="POST">
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
                        <label for="link_soal">Link Soal</label>
                        <input type="text" class="form-control" id="link_soal" name="link_soal" placeholder="Masukan Link Soal">
                    </div>

                    <!-- footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- Akhir Modal Tambah -->


<!-- Modal edit -->
<?php foreach ($soalrecruitment as $sr) : ?>
    <div class="modal fade" id="ubahSoalRecruitment<?= $sr['id_soal_recruitment'] ?>" tabindex="-1" aria-labelledby="ubahSoalRecruitmentLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahSoalRecruitmentLabel">Ubah Soal Recruitment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('master/soalrecruitment/ubah'); ?>" method="POST">
                    <input type="hidden" name="id_soal_recruitment" value="<?= $sr['id_soal_recruitment']; ?>">
                    <div class="form-group">
                        <label for="posisi">Posisi</label>
                        <select class="form-control" id="posisi" name="posisi">
                            <option>-- Pilih Posisi --</option>
                            <?php foreach ($dataposisi as $dp) : ?>
                                <option value="<?= $dp['id_posisi']; ?>"><?= $dp['nama_posisi']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="link_soal">Link Soal</label>
                        <input type="text" class="form-control" id="link_soal" name="link_soal" value="<?= $sr['link_soal']; ?>">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
<?php endforeach; ?>
<!-- Akhir Modal edit -->

<!-- Modal hapus -->
<?php foreach ($soalrecruitment as $sr) : ?>
    <div class="modal fade" id="modal-sm<?= $sr['id_soal_recruitment'] ?>">
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
                    <a href="<?= base_url() ?>master/soalrecruitment/hapus/<?= $sr['id_soal_recruitment']  ?>" type="submit" class="btn btn-primary">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>
<!-- Akhir Modal Hapus -->