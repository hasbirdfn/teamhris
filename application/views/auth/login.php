<div class="pt">PT. SAHAWARE TEK<span>NOLOGI INDONESIA</span> </div>
<div class="wrapper">
    <div class="title">Login</div>
    <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert" style="text-align: center;">
            <?= validation_errors(); ?>
        </div>
    <?php endif; ?>
    <?= $this->session->flashdata('message'); ?>
    <form action="<?= base_url('auth'); ?>" method="post">
        <div class="field">
            <input type="text" name="username">
            <label>Username</label>
        </div>
        <div class="field">
            <input type="password" name="password">
            <label>Password</label>
        </div>
        <div class="field" style="text-align: right;">
            <div class="pass-link"><a href="<?= base_url('auth/lupapassword'); ?>">Lupa Password?</a></div>
        </div>
        <div class="field">
            <input type="submit" value="Login">
        </div>
    </form>
</div>