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
            <a href="<?php echo base_url('training/Lihatnilai'); ?>"><button type="button"
                    class="btn btn-outline-success" data-toggle="modal" data-target="#tambahdatasoal">
                    Lihat Nilai
                </button></a>
            <table id="example1" class="table table-bordered table-striped">
                <thead style="background-color:  #8b0000; color: white;">
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan & Posisi</th>
                        <th>Tanggal Ujian</th>
                        <th>Jenis Ujian</th>
                        <th>Durasi Ujian</th>
                        <th>Soal</th>
                        <th>Jawaban</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($datapes as $dk) : ?>
                    <tr>
                        <th><?= $no++; ?></th>
                        <?php foreach ($dataposisi as $dp) : ?>
                        <?php if ($dp['id_posisi'] == $dk['id_posisi']) : ?>
                        <td><?= $dk['nama_karyawan']; ?> & <?= $dp['nama_posisi']; ?></td>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <td><?= $dk['tanggal_ujian']; ?></td>
                        <td><?= $dk['jenis_ujian']; ?></td>
                        <td><?= $dk['durasi_ujian']; ?></td>
                        <td><a
                                href="<?php echo base_url('training/Filesoal_karyawan/download_hasil/' . $dk['file_soal']); ?>"><span
                                    class="glyphicon glyphicon-download-alt">Download Dokumen</a></td>
                        <td><?= $dk['file_jawaban']; ?></td>
                        <td>
                            <button type="button" class="badge" style="color: black; background-color: gold;"
                                data-toggle="modal" data-target="#ubahdatasoal<?= $dk['id_pes']; ?>"><i
                                    class="fas fa-edit"></i>
                                Tambah Jawaban</button>
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
<div class="modal fade" id="tambahdatasoal" tabindex="-1" aria-labelledby="tambahdatasoalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahdatakeseluruhanLabel">Tambah Data soal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('training/file_soal/uploadtambah') ?>" method="POST"
                enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_karyawan_nama_posisi">Nama Karyawan & Posisi</label>
                        <select name="nama_karyawan" id="nama_karyawan_nama_posisi" class="form-control">
                            <option value="">-- Pilih Nama karyawan & posisi --</option>
                            <?php foreach ($datakaryawan as $dk) : ?>
                            <?php foreach ($dataposisi as $dp) : ?>
                            <?php if ($dp['id_posisi'] == $dk['id_posisi']) : ?>
                            <option value="<?= $dk['id_karyawan']; ?>"><?= $dk['nama_karyawan']; ?> -
                                <?= $dk['nama_posisi'] ?></option>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php endforeach; ?>
                        </select>
                        <?php foreach ($datakaryawan as $dk) : ?>
                        <input type="hidden" name="tanggal_ujian">
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tanggal Ujian</label>
                        <div class="col-sm-10">
                            <div class="input-group date">
                                <input type="date" class="form-control pull-right" id="date" name="tanggal_ujian"
                                    placeholder="2019-12-30" autocomplete="off" required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jenis Ujian</label>
                        <div class="form-group">
                            <select class="form-control" name="jenis_ujian">
                                <option value="">-- Pilih jenis ujian --</option>
                                <?php foreach ($jenis_ujian as $a) : ?>
                                <option value="<?= $a['id_jenis_ujian']; ?>"><?= $a['jenis_ujian']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Durasi Ujian</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="durasi_ujian"
                                placeholder="Masukan Waktu Lama Ujian dalam Menit" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="dokumen">Soal</label>
                        <input type="file" class="form-control" id="dokumen_soal" name="dokumen_soal"
                            placeholder="Masukan Dokumen">
                    </div>
                    <div class="form-group">
                        <label for="dokumen">Jawaban</label>
                        <input type="file" class="form-control" name="dokumen jawaban" placeholder="Masukan Dokumen">
                    </div>
                    <div class="box-footer">
                        <a href="<?= base_url('training/file_soal_karyawan') ?>" class="btn btn-default btn-flat"><span
                                class="fa fa-arrow-left"></span>
                            Kembali</a>
                        <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-save"></span>
                            Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir tambah Modal -->

<!-- modal untuk edit data -->
<?php foreach ($datapes as $dk) : ?>
<div class="modal fade" id="ubahdatasoal<?= $dk['id_pes']; ?>" tabindex="-1" aria-labelledby="ubahdatasoalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data soal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('training/Filesoal_karyawan/uploadubah/' . $dk['id_pes']) ?>" method="POST"
                enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="id_pes" value="<?= $dk['id_pes']; ?>" hidden>

                        <div class="form-group">
                            <label for="dokumen">Jawaban</label>
                            <input type="file" class="form-control" name="dokumen_jawaban"
                                placeholder="Masukan Dokumen">
                        </div>
                        <div class="box-footer">
                            <a href="<?= base_url('training/Filesoal_karyawan') ?>"
                                class="btn btn-default btn-flat"><span class="fa fa-arrow-left"></span>
                                Kembali</a>
                            <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-save"></span>
                                Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>


<!-- Modal Hapus -->
<?php foreach ($datapes as $dk) : ?>
<div class="modal fade" id="modal-sm<?= $dk['id_pes']; ?>" tabindek="-1" role+dialog">
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
                <a href="<?= base_url() ?>training/file_soal/hapus/<?= $dk['id_pes'] ?>" type="submit" class="btn"
                    style="background-color: #8b0000; color: #ffffff;">Ya</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php endforeach; ?>
<!-- akhir modal hapus -->