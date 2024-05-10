<!DOCTYPE html>
<!---Coding By CodingLab | www.codinglabweb.com--->
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!--<title>Registration Form in HTML CSS</title>-->
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url() ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css" />
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() ?>plugins/toastr/toastr.min.css" />
    <!---Custom CSS File--->
    <link rel="stylesheet" href="<?= base_url() ?>dist/css/styleupload.css" type="text/css" />
    <title>Upload Hasil Tes</title>
</head>

<body>

    <section class="container">
        <header>Upload Hasil Tes</header>
        <form action="<?= base_url('Uploadtespelamar/upload_hasiltes') ?>" method="POST" enctype="multipart/form-data" class="form">
            <div class="input-box">
                <label>Nama</label>
                <input type="text" placeholder="Masukan Nama Anda" name="nama" required />
            </div>

            <div class="input-box">
                <label>Posisi</label>
                <select class="form-control" id="posisi" name="posisi">
                    <option>-- Pilih Posisi --</option>
                    <?php foreach ($dataposisi as $dp) : ?>
                        <option value="<?= $dp['id_posisi']; ?>"><?= $dp['nama_posisi']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="input-box">
                <label for="uploadlink">Upload Hasil Tes(LINK)</label>
                <input type="text" class="form-control" id="uploadlink" name="uploadlink">
            </div>
            <div class="input-box">
                <label for="uploadfile">Upload Hasil Tes(FILE)</label>
                <input type="file" class="form-control" id="uploadfile" name="uploadfile">
            </div>
            <button>Submit</button>
        </form>

    </section>
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