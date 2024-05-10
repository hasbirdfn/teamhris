<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('dist/css/berinilai.css') ?>" type="text/css" />
    <link rel="stylesheet" href="<?= base_url() ?>plugins/fontawesome-free/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url() ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Beri Nilai</title>
</head>

<body>
    <div class="header">
        <img src="<?php echo base_url('dist/img/wave-4.jpg'); ?>" alt="Nama Gambar" style="background-repeat: no-repeat; width: 100%; height: 20vh; ">
        <p style="font-size: 2vw; position: absolute; top:4vw; color: #ffffff ; right: 2vw;"> <strong>PT. SAHAWARE TEKNOLOGI INDONESIA</strong> </p>
    </div>
    <div class="nilai">
        Tes Pelamar
    </div>
    <div class="conten">

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="bg-primary" style="color: white;">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Posisi</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Hasil Tes(Link)</th>
                        <th scope="col">Hasil Tes(File)</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($berinilai as $nm) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <?php foreach ($dataposisi as $dp) : ?>
                                <?php if ($dp['id_posisi'] == $nm['id_pekerjaan']) : ?>
                                    <td><?= $dp['nama_posisi']; ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <td><?= $nm['nama']; ?></td>
                            <td><?= $nm['hasil_link']  ?></td>
                            <td><a href="<?php echo base_url('Recruitment/Berinilai/download_file/' . $nm['hasil_file']); ?>"><span class="glyphicon glyphicon-download-alt">download hasil</a></td>
                            <td><?= $nm['status']; ?></td>
                            <td>
                                <button class="badge badge-success" data-toggle="modal" data-target="#modal-nilai<?= $nm['id_hasiltes']; ?>"><i class="fas fa-paper-plane"></i> Nilai</button>
                                <button type="button" class="badge badge-danger" data-toggle="modal" data-target="#modal-sm<?= $nm['id_hasiltes']; ?>"><i class="fas fa-trash-alt"></i>Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>


    <?php foreach ($berinilai as $nm) : ?>
        <div class="modal fade" id="modal-sm<?= $nm['id_hasiltes']; ?>" tabindek="-1" role+dialog">
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
                        <button type="button" class="btn" data-dismiss="modal" style="background-color: #d4d4d4;">Tidak</button>
                        <a href="<?= base_url() ?>Recruitment/berinilai/hapus/<?= $nm['id_hasiltes'] ?>" type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Ya</a>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    <?php endforeach; ?>

    <?php foreach ($berinilai as $nm) : ?>
        <div class="modal fade" id="modal-nilai<?= $nm['id_hasiltes']; ?>" tabindek="-1" role+dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="nilaiLabel">Beri Nilai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('Recruitment/berinilai/sudahnilai/' . $nm['id_hasiltes']) ?>" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id_hasiltes" value="<?= $nm['id_hasiltes']; ?>">
                            <div class="form-group">
                                <label for="nilai_tes">Nilai Tes</label>
                                <input type="text" class="form-control" id="nilai_tes" name="nilai_tes" placeholder="Masukan nilai">
                            </div>

                            <!-- modal footer  -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-danger" style="background-color: #8b0000; color: #ffffff;">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <script src="<?= base_url() ?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?= base_url() ?>plugins/toastr/toastr.min.js"></script>


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

</body>

</html>