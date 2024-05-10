<div class="row">
    <div class="col-md-12">

        <?= $this->session->flashdata('message'); ?>

        <!-- Default box -->
        <div class="box box-success" style="overflow-x: scroll;">
            <div class="box-header">
                <center>
                    <h4 class="box-title">Jenis Ujian</h4>
                </center>
                <p>
                <h3 class="box-title"></h3>
                <a href="<?= base_url('training/peserta') ?>" class="btn btn-default btn-flat"><span
                        class="fa fa-arrow-left"></span> Kembali</a>
                <!-- /.box-header -->

                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead style="background-color:  #8b0000; color: white;">
                            <tr>
                                <th width="1%">No</th>
                                <th width="25%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($jenis_ujian as $m) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $m->jenis_ujian; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Tambah Data Jenis Ujian</h4>
                </div>
                <!-- /.form dengan modal -->
                <div class="modal-body">
                    <div id="modal-data-body">
                        <p>Loading...</p>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- /. modal import data siswa  -->


    <!-- /.box-body -->

    <!-- /.box-footer -->
    </form>
    <!-- /.tutup form dengan modal  -->
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>