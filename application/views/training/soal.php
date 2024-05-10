<form action="<?= base_url('training/Soal/insert'); ?>" method="post">
    <div class="box-body">

        <div class="form-horizontal">


            <div class="form-group">
                <label class="col-sm-2 control-label">Pilih Posisi</label>
                <div class="col-sm-10">
                    <select class="select2 form-control" name="id_posisi" required="">
                        <option value="">- Pilih Kategori Posisi -</option>
                        <?php foreach ($soal as $a) : ?>
                            <option value="<?= $a['id_posisi']; ?>"><?= $a['kode']; ?> |
                                <?= $a['nama_posisi']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Tulis Soal Ujian</label>
                <div class="col-sm-10">
                    <textarea class="soal" name="soal" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Jawaban A</label>
                <div class="col-sm-10">
                    <textarea rows="2" style="width: 100%" name="a" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Jawaban B</label>
                <div class="col-sm-10">
                    <textarea rows="2" style="width: 100%" name="b" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Jawaban C</label>
                <div class="col-sm-10">
                    <textarea rows="2" style="width: 100%" name="c" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Jawaban D</label>
                <div class="col-sm-10">
                    <textarea rows="2" style="width: 100%" name="d" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Jawaban E</label>
                <div class="col-sm-10">
                    <textarea rows="2" style="width: 100%" name="e" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Kunci Jawaban</label>
                <div class="col-sm-10">
                    <select class="form-control" name="kunci" required>
                        <option selected="selected" disabled="" value="">- Pilih Kunci Jawaban -</option>
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                        <option>D</option>
                        <option>E</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <a href="<?= base_url('training/soal_ujian') ?>" class="btn btn-default btn-flat"><span class="fa fa-arrow-left"></span> Kembali</a>
                    <button type="submit" class="btn btn-primary btn-flat" style="background-color: #8b0000; color: #ffffff;" title="Tambah Data Soal Ujian"><span class="fa fa-save"></span> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>