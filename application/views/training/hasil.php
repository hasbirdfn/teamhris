<div class="row">
    <div class="col-md-12">

        <div class="box box-success" style="overflow-x: scroll;">
            <div class="box-header">
                <center>
                    <h4 class="box-title">Hasil Pelatihan</h4>
                </center>
            </div>
            <form action="" method="get" class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Posisi</label>
                        <div class="col-sm-10">
                            <select class="select2 form-control" name="id" required="">
                                <option selected="selected" disabled="">- Pilih Posisi -</option>
                                <?php foreach ($posisi as $a) { ?>
                                    <option value="<?= $a->id_posisi ?>"><?= $a->kode; ?> | <?= $a->nama_posisi; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="<?= base_url('training/hasil_ujian'); ?>" class="btn btn-default btn-flat"><span class="fa fa-refresh"></span> Refresh</a>
                            <button type="submit" class="btn btn-primary btn-flat" title="Filter Data Soal Ujian"><span class="fa fa-filter"></span> Filter</button>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                </div>
                <!-- /.box-footer -->
            </form>

        </div>

        <!-- Default box -->
        <div class="box box-success" style="overflow-x: scroll;">

            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead style="background-color:  #8b0000; color: white;">
                        <tr>
                            <th width="1%">No</th>
                            <th>Nama Karyawan</th>
                            <th>NIK</th>
                            <th>posisi</th>
                            <th>Tanggal Ujian</th>
                            <th>Jam Ujian</th>
                            <th>Jenis Ujian</th>
                            <th>Benar</th>
                            <th>Salah</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($hasil as $d) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $d->nama_karyawan; ?></td>
                                <td><?php echo $d->nik; ?></td>
                                <td><?php echo $d->nama_posisi; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($d->tanggal_ujian)); ?></td>
                                <td><?php echo date('H:i:s', strtotime($d->jam_ujian)); ?></td>
                                <td><?php echo $d->jenis_ujian; ?></td>
                                <td>
                                    <?php
                                    if ($d->benar == '') {
                                        echo "<span class='btn btn-xs btn-default'>Belum Ujian</span>";
                                    } else {
                                        echo $d->benar;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($d->salah == '') {
                                        echo "<span class='btn btn-xs btn-default'>Belum Ujian</span>";
                                    } else {
                                        echo $d->salah;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($d->nilai == '') {
                                        echo "<span class='btn btn-xs btn-default'>Belum Ujian</span>";
                                    } else {
                                        echo $d->nilai;
                                    }
                                    ?>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.col-->
    </div>