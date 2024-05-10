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
            <table id="example1" class="table table-bordered table-striped">
                <thead style="background-color: #8b0000; color: #ffffff;">
                    <tr>
                        <th>No</th>
                        <th>Posisi</th>
                        <th>Nama</th>
                        <th>Hasil Tes (LINK)</th>
                        <th>Hasil Tes (FILE)</th>
                        <th>Nilai Tes (pg)</th>
                        <th>Nilai Tes</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($hasiltes as $ko) : ?>
                        <?php if ($ko['status'] == 'siap dinilai') : ?>

                        <?php else : ?>
                            <tr>
                                <th><?= $no++; ?></th>
                                <?php foreach ($dataposisi as $dp) : ?>
                                    <?php if ($dp['id_posisi'] == $ko['id_pekerjaan']) : ?>
                                        <td><?= $dp['nama_posisi']; ?></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <td><?= $ko['nama']; ?></td>
                                <td><?= $ko['hasil_link']; ?></td>
                                <td><a href="<?php echo base_url('Recruitment/hasiltes/download_file/' . $ko['hasil_file']); ?>"><span class="glyphicon glyphicon-download-alt">download</a></td>
                                <td><?= $ko['nilai_pg']; ?></td>
                                <td><?= $ko['nilai_tes']; ?></td>
                                <td>
                                    <?php if ($ko['status'] == 'sudah dinilai ') : ?>
                                        <button type="button" class="badge" style="background-color: #cc0000; color: antiquewhite" data-toggle="modal" data-target="#modal-sm<?= $ko['id_hasiltes'] ?>"><i class="fas fa-trash-alt"></i>Hapus</button>
                                    <?php else : ?>
                                        <button type="button" class="badge badge-success" color: antiquewhite" data-toggle="modal" data-target="#modal-nilai<?= $ko['id_hasiltes'] ?>"><i class="fas fa-pen-square"></i>Nilai</button>
                                        <button type="button" class="badge" style="background-color: #cc0000; color: antiquewhite" data-toggle="modal" data-target="#modal-sm<?= $ko['id_hasiltes'] ?>"><i class="fas fa-trash-alt"></i>Hapus</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>


<?php foreach ($hasiltes as $ko) : ?>
    <div class="modal fade" id="modal-sm<?= $ko['id_hasiltes']; ?>" tabindek="-1" role+dialog">
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
                    <a href="<?= base_url() ?>Recruitment/hasiltes/hapus/<?= $ko['id_hasiltes'] ?>" type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>




<?php foreach ($hasiltes as $ko) : ?>
    <div class="modal fade" id="modal-nilai<?= $ko['id_hasiltes']; ?>" tabindek="-1" role+dialog">
        <div class="modal-dialog modal-nilai">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Beri Nilai</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah siap untuk dinilai ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url() ?>Recruitment/hasiltes/siapnilai/<?= $ko['id_hasiltes'] ?>" type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Ya</a>
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