<div class="pt">PT. SAHAWARE TEK<span>NOLOGI INDONESIA</span> </div>
<div class="wrapper">
    <div style="text-align: center;" class="mt-3">
        <h1 class="h4 text-gray-900">Reset password</h1>
        <h5 class="mb-4"><?= $this->session->userdata('reset_email'); ?></h5>
    </div>
    <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert" style="text-align: center;">
            <?= validation_errors(); ?>
        </div>
    <?php endif; ?>
    <?= $this->session->flashdata('message'); ?>
    <form action="<?= base_url('auth/ubahpassword'); ?>" method="post">
        <div class="field">
            <input type="password" name="password1">
            <label>Password baru</label>
        </div>
        <div class="field">
            <input type="password" name="password2">
            <label>Konfirmasi password</label>
        </div>
        <div class="field mt-5">
            <input type="submit" value="Reset password">
        </div>
    </form>
</div>