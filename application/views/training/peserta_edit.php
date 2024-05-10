<div class="row">
    <div class="col-md-12">
    </div>
    <?php foreach ($peserta as $p) { ?>
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <center>
                    <h3 class="box-title">Edit Data</h3>
                </center>
                <p>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?= base_url('training/peserta/update'); ?>" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama peserta</label>
                        <input type="hidden" name="id" value="<?= $p->id_peserta ?>">
                        <div class="col-sm-10">
                            <select class="select2 form-control" name="peserta" required>
                                <option selected="selected" disabled="">- Pilih peserta Ujian -</option>
                                <?php foreach ($karyawan as $a) { ?>
                                <option value="<?= $a->id_karyawan ?>" <?php if ($a->nama_karyawan == $p->nama_karyawan) {
                                                                                    echo "selected='selected'";
                                                                                } ?>>
                                    <?= $a->nik; ?> | <?= $a->nama_karyawan; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Ujian Posisi</label>

                        <div class="col-sm-10">
                            <select class="select2 form-control" name="posisi" required value="">
                                <option selected="selected" disabled="">- Pilih Posisi Ujian -</option>
                                <?php foreach ($posisi as $a) { ?>
                                <option value="<?= $a->id_posisi ?>" <?php if ($p->nama_posisi == $a->nama_posisi) {
                                                                                    echo "selected='selected'";
                                                                                } ?>>
                                    <?= $a->kode; ?> | <?= $a->nama_posisi; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tanggal Ujian</label>

                        <div class="col-sm-10">
                            <div class="input-group date">
                                <input type="date" class="form-control pull-right" id="datepicker" name="tanggal"
                                    value="<?= $p->tanggal_ujian ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jam Ujian</label>

                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="time" class="form-control" id="timepicker" name="jam"
                                    value="<?= $p->jam_ujian ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jenis Ujian</label>

                        <div class="col-sm-10">
                            <select class="select2 form-control" name="jenis" required value="">
                                <option selected="selected" disabled="">- Pilih Jenis Ujian -</option>
                                <?php foreach ($jenis_ujian as $a) { ?>
                                <option value="<?= $a->id_jenis_ujian ?>" <?php if ($p->jenis_ujian == $a->jenis_ujian) {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>
                                    <?= $a->jenis_ujian; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Durasi </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="durasi_ujian" value="<?= $p->durasi_ujian ?>"
                                required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <button type="button" class="btn btn-default btn-flat" onclick="return history.go(-1)"
                                title="Kembali ke halaman sebelumnya"><span class="fa fa-arrow-left"></span>
                                Kembali</button>
                            <button type="submit" class="btn btn-primary btn-flat"
                                style="background-color: #8b0000; color: #ffffff;" title="Update peserta"><span
                                    class="fa fa-save"></span> Simpan</button>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                </div>
                <!-- /.box-footer -->
                <?php } ?>
            </form>
        </div>
    </div>
    <!-- /.col-->

</div>
<!-- ./row -->