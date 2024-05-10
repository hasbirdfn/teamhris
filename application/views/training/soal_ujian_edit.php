<div class="row">
    <div class="col-md-12">
        <!-- Tampilan untuk alert -->


        <?php foreach ($soal as $s) { ?>
        <!-- TUTUP Tampilan untuk alert -->
        <div class="box box-success" style="overflow-x: scroll;">
            <form action="<?= base_url('training/soal_ujian/update'); ?>" method="post">
                <div class="box-header">
                    <center>
                        <h4 class="box-title">Edit Data</h4>
                    </center>
                    <p>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Posisi</label>
                            <input type="hidden" name="id" value="<?= $s->id_soal_ujian ?>">
                            <div class="col-sm-10">
                                <select class="select2 form-control" name="id_posisi" required="">
                                    <option selected="selected" disabled="">- posisi -</option>
                                    <?php foreach ($kelas as $a) { ?>
                                    <option value="<?= $a->id_posisi ?>" <?php if ($s->nama_posisi == $a->nama_posisi) {
                                                                                    echo "selected='selected'";
                                                                                } ?>>
                                        <?= $a->kode; ?> | <?= $a->nama_posisi; ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tulis Soal Ujian</label>
                            <div class="col-sm-10">
                                <textarea name="soal" class="soal" required><?= $s->pertanyaan; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jawaban A</label>
                            <div class="col-sm-10">
                                <textarea rows="2" style="width: 100%" name="a" required><?= $s->a; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jawaban B</label>
                            <div class="col-sm-10">
                                <textarea rows="2" style="width: 100%" name="b" required><?= $s->b; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jawaban C</label>
                            <div class="col-sm-10">
                                <textarea rows="2" style="width: 100%" name="c" required><?= $s->c; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jawaban D</label>
                            <div class="col-sm-10">
                                <textarea rows="2" style="width: 100%" name="d" required><?= $s->d; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jawaban E</label>
                            <div class="col-sm-10">
                                <textarea rows="2" style="width: 100%" name="e" required><?= $s->e; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kunci Jawaban</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="kunci">
                                    <option <?php if ($s->kunci_jawaban == 'A') {
                                                    echo "selected='selected'";
                                                } ?>>A</option>
                                    <option <?php if ($s->kunci_jawaban == 'B') {
                                                    echo "selected='selected'";
                                                } ?>>B</option>
                                    <option <?php if ($s->kunci_jawaban == 'C') {
                                                    echo "selected='selected'";
                                                } ?>>C</option>
                                    <option <?php if ($s->kunci_jawaban == 'D') {
                                                    echo "selected='selected'";
                                                } ?>>D</option>
                                    <option <?php if ($s->kunci_jawaban == 'E') {
                                                    echo "selected='selected'";
                                                } ?>>E</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <button type="button" class="btn btn-default btn-flat" onclick="return history.go(-1)"
                                    title="Kembali ke halaman sebelumnya"><span class="fa fa-arrow-left"></span>
                                    Kembali</button>
                                <button type="submit" class="btn btn-primary btn-flat"
                                    style="background-color: #8b0000; color: #ffffff;"
                                    title="Tambah Data Soal Ujian"><span class="fa fa-save"></span> Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-footer -->
                <div class="box-footer">

                </div>
            </form>
        </div>
        <?php } ?>
    </div>
    <!-- /.col-->
</div>