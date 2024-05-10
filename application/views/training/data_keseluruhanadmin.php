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
            <table id="example1" class="table table-bordered table-striped">
                <thead style="background-color:  #8b0000; color: white;">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Ulasan</th>
                        <th>dokumen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($dataadmin as $dk) : ?>
                    <tr>
                        <th><?= $no++; ?></th>
                        <td><?= $dk['nama']; ?></td>
                        <td><?= $dk['kategori']; ?></td>
                        <td><?= $dk['ulasan']; ?></td>
                        <td><a href="<?php echo base_url('training/dataadmin/download_file/' . $dk['file']); ?>"><span
                                    class="glyphicon glyphicon-download-alt">Download Dokumen</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>