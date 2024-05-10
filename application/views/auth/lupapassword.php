<div class="pt">PT. SAHAWARE TEK<span>NOLOGI INDONESIA</span> </div>
<div class="wrapper">
    <div style="text-align: center;" class="mt-3">
        <h3>Lupa Password ?</h3>
    </div>
    <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert" style="text-align: center;">
            <?= validation_errors(); ?>
        </div>
    <?php endif; ?>
    <?= $this->session->flashdata('message'); ?>
    <form action="<?= base_url('auth/lupapassword'); ?>" method="post">
        <div class="field">
            <input type="text" name="email" placeholder="Masukan email anda">
            <label>Email</label>
        </div>
        <div class="field mt-4">
            <input type="submit" value="Reset password">
        </div>
        <div class="field" style="text-align: center;">
            <div class="pass-link"><a href="<?= base_url('auth'); ?>">Kembali ke login</a></div>
        </div>
    </form>
</div>