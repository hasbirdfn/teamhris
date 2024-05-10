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
            <table id="example1" class="table table-bordered table-striped">
                <thead style="background-color:  #8b0000; color: white;">
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan & Posisi</th>
                        <th>Kalkulasi Nilai</th>
                        <th>Sertifikat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($datanilai as $ds) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <?php foreach ($dataposisi as $dp) : ?>
                                <?php if ($dp['id_posisi'] == $ds['id_posisi']) : ?>
                                    <td><?= $ds['nama_karyawan']; ?> & <?= $dp['nama_posisi']; ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <td><?= $ds['kalkulasi_nilai']; ?></td>
                            <td><a href="<?php echo base_url('training/Lihatnilai/download_hasil/' . $ds['sertifikat']); ?>"><span class="glyphicon glyphicon-download-alt">
                                        Dowload Sertifikat</a>
                            </td>

                        </tr>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- modal untuk tambah data -->
<div class="modal fade" id="tambahdatanilai" tabindex="-1" aria-labelledby="tambahdatanilaiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahdatanilaiLabel">Tambah Data soal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('training/Berinilai/uploadtambah') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_karyawan_nama_posisi">Nama Karyawan & Posisi</label>
                        <select name="nama_karyawan" id="nama_karyawan_nama_posisi" class="form-control">
                            <option value="">-- Pilih Nama karyawan & posisi --</option>
                            <?php foreach ($datakaryawan as $ds) : ?>
                                <?php foreach ($dataposisi as $dp) : ?>
                                    <?php if ($dp['id_posisi'] == $ds['id_posisi']) : ?>
                                        <option value="<?= $ds['id_karyawan']; ?>"><?= $ds['nama_karyawan']; ?> -
                                            <?= $ds['nama_posisi'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kalkulasi</label>
                        <div class="col-sm-10">
                            <div class="input-group date">
                                <input type="text" class="form-control pull-right" id="kalkulasi" name="kalkulasi_nilai" placeholder="Beri nilai" autocomplete="off" required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dokumen">Sertifikat</label>
                        <input type="file" class="form-control" id="sertifikat" name="Sertifikat" placeholder="Masukan Dokumen">
                    </div>
                    <div class="box-footer">
                        <a href="<?= base_url('training/Beri_nilai') ?>" class="btn btn-default btn-flat"><span class="fa fa-arrow-left"></span>
                            Kembali</a>
                        <button type="submit" class="btn btn-primary btn-flat" style="background-color: #8b0000; color: #ffffff;"><span class="fa fa-save"></span>
                            Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir tambah Modal -->

<!-- modal untuk edit data -->
<?php foreach ($datanilai as $ds) : ?>
    <div class="modal fade" id="ubahdatanilai<?= $ds['id_nilai']; ?>" tabindex="-1" aria-labelledby="ubahdatanilaiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('training/Berinilai/uploadubah/') ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="text" name="id_nilai" value="<?= $ds['id_nilai']; ?>" hidden>
                        <div class="form-group">
                            <label for="nama_karyawan_nama_posisi">Nama Karyawan & Posisi</label>
                            <select name="nama_karyawan" id="nama_karyawan_nama_posisi" class="form-control">
                                <option value="">-- Pilih Nama karyawan & posisi --</option>
                                <?php foreach ($datakaryawan as $dk) : ?>
                                    <?php foreach ($dataposisi as $dp) : ?>
                                        <?php if ($dp['id_posisi'] == $dk['id_posisi']) : ?>
                                            <option value="<?= $dk['id_karyawan']; ?>"><?= $dk['nama_karyawan']; ?> -
                                                <?= $dp['nama_posisi'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kalkulasi</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input type="text" class="form-control pull-right" id="kalkulasi" name="kalkulasi_nilai" value="<?= $ds['kalkulasi_nilai']; ?>" placeholder="2019-12-30" autocomplete="off" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dokumen">Sertifikat</label>
                            <input type="file" class="form-control" id="sertifikat" name="Sertifikat" value="<?= $ds['sertifikat']; ?>" placeholder="Masukan Dokumen">
                        </div>
                        <div class="box-footer">
                            <a href="<?= base_url('training/Beri_nilai') ?>" class="btn btn-default btn-flat"><span class="fa fa-arrow-left"></span>
                                Kembali</a>
                            <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-save"></span>
                                Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<!-- Modal Hapus -->
<?php foreach ($datanilai as $ds) : ?>
    <div class="modal fade" id="modal-sm<?= $ds['id_nilai']; ?>" tabindek="-1" role+dialog">
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
                    <button type="button" class="btn" data-dismiss="modal" style="background-color: #d4d4d4;">Tidak</button>
                    <a href="<?= base_url() ?>training/Berinilai/hapus/<?= $ds['id_nilai'] ?>" type="submit" class="btn" style="background-color: #ff0000; color: white;">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>
<!-- akhir modal hapus -->