<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-6">
            <!-- general form elements -->
            <div class="card">
                <?= $this->session->flashdata('message'); ?>
                <div class="card-header" style="background-color: #8b0000;">
                    <h3 class="card-title" style="color: #ffffff;">Password</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="<?= base_url('hris/ubahPassword') ?>" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="password_lama">Password Lama</label>
                            <input type="password" class="form-control" id="password_lama" name="password_lama"
                                placeholder="Masukan Password Lama">
                            <?= form_error('password_lama', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="password_baru1">Password Baru</label>
                            <input type="password" class="form-control" id="password_baru1" name="password_baru1"
                                placeholder="Masukan Password Baru">
                            <?= form_error('password_baru1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="password_baru2">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_baru2" name="password_baru2"
                                placeholder="Konfirmasi Password">
                            <?= form_error('password_baru2', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-danger" style="background-color: #8b0000;">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->