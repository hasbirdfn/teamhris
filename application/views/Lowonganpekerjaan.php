<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url('dist/css/lowongan.css') ?>" type="text/css" />
    <link rel="stylesheet" href="<?= base_url() ?>plugins/fontawesome-free/css/all.min.css" />
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url() ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css" />
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() ?>plugins/toastr/toastr.min.css" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <title>Tampilan Awal</title>
</head>

<body>
    <section class="foto">
        <div class="foto-carve">
            <div class="overlay">
                <div class="lowongan">
                    <h3>PT. Sahaware Teknologi Indonesia</h3>
                    <h2>Membuka kesempatan berkarir <br>bersama kami</h2>
                </div>
            </div>
        </div>
    </section>

    <div>
        <h4 style="font-family: Arial, Helvetica, sans-serif; text-align: center; font-size: 30px; margin-top: 2rem;">Lowongan Tersedia</h4>
    </div>
    <div class="container" style="margin: auto; max-width: fit-content; padding: 10px;">
        <div class="row justify-content-center">
            <?php foreach ($pekerjaan as $pk) : ?>
                <div class="card mx-2 mb-4" style="width: 18rem; font-family: Arial, Helvetica, sans-serif;">
                    <center>
                        <h3 style="font-family: Arial, Helvetica, sans-serif;"><?= $pk['nama_posisi']; ?></h3>
                    </center>
                    <img src="<?= base_url('dist/img/lowongan/') . $pk['foto']; ?>" class="card-img-top" alt="..." />
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <a href="<?= base_url() ?>DetailPekerjaan/index/<?= $pk['id_pekerjaan'] ?>" type="button" style="background-color: #d4d4d4; margin-right: 1rem;font-family: Arial, Helvetica, sans-serif; " ; class="btn btn-sm">Info Lengkap</a>
                            <a type="button" style="background-color: #d63638; font-family: Arial, Helvetica, sans-serif;" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#uploadcv<?= $pk['id_pekerjaan'] ?>">Upload CV</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>



    <?php foreach ($pekerjaan as $pk) : ?>
        <div class="modal fade" id="uploadcv<?= $pk['id_pekerjaan'] ?>" tabindex="-1" aria-labelledby="uploadcvLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadcvLabel">Masukan Data Anda</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('Lowonganpekerjaan/upload_cv') ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_posisi" value="<?= $pk['id_posisi'] ?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Anda">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Masukan Email Anda">
                            </div>
                            <label>Upload CV (PDF)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="cv" name="cv">
                                <label for="cv" class="custom-file-label">Masukan CV Anda</label>
                            </div>
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="int" class="form-control" id="telepon" name="telepon" placeholder="Masukan Nomor Telepon Anda">
                            </div>

                            <!-- modal footer  -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-danger">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>






    <footer class="footer-distributed">

        <div class="footer-left">
            <h3>PT.SAHAWARE TEKNOLOGI <span>INDONESIA</span></h3><br><br>
            <p class="footer-company-name">Copyright © 2023 <strong>PT.SAHAWARE TEKNOLOGI </strong> INDONESIA</p>
        </div>

        <div class="footer-center">
            <div>
                <i class="fa fa-map-marker"></i><a href="https://goo.gl/maps/QP4dvUvw1e3TRaMd9">
                    <p>Jl. Terusan Jakarta Utara, <span style="margin-right: 50hv;">Komplek Daichi No. 69 Antapani - Bandung 40282</span> </p>
                </a>
            </div>

            <div>
                <i class="fa fa-phone"></i>
                <p>0811-1244-040</p>
            </div>
            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="fredygunawan93@gmail.com">office@sahaware.co.id</a></p>
            </div>
        </div>
        <div class="footer-right">
            <p class="footer-company-about">
                <span>About the company</span>
                <strong>PT. Sahaware Teknologi Indonesia</strong> We are a software development service company from Bandung, Indonesia. Focuses on developing web and mobile applications by using the latest technology
            </p>
            <div class="footer-icons">
                <a href="https://web.facebook.com/sahaware.id"><i class="fa fa-facebook"></i></a>
                <a href="https://www.instagram.com/sahaware.id/"><i class="fa fa-instagram"></i></a>
                <a href="https://www.linkedin.com/company/sahaware/mycompany/"><i class="fa fa-linkedin"></i></a>
                <a href="https://twitter.com/sahaware"><i class="fa fa-twitter"></i></a>
                <a href="https://www.youtube.com/@sahawareindonesia2232/featured"><i class="fa fa-youtube"></i></a>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <script src="<?= base_url() ?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?= base_url() ?>plugins/toastr/toastr.min.js"></script>


    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
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