<div class="countainer-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success" style="overflow-x: scroll;">
                <div class="box-header">
                    <center>
                        <h4 class="box-title">Daftar Soal Ujian</h4>
                    </center>
                </div>
                <form action="" method="get" class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">posisi</label>
                            <div class="col-sm-10">
                                <select class="select2 form-control" name="id" required="">
                                    <option selected="selected" disabled="">- Pilih posisi -</option>
                                    <?php foreach ($kelas as $a) { ?>
                                        <option value="<?= $a->id_posisi ?>"><?= $a->kode; ?> |
                                            <?= $a->nama_posisi; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <a href="<?= base_url('training/soal_ujian'); ?>" class="btn btn-default btn-flat"><span class="fa fa-refresh"></span> Refresh</a>
                                <button type="submit" class="btn btn-primary btn-flat" title="Filter Data posisi"><span class="fa fa-filter"></span> Filter</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">

                    </div>
                    <!-- /.box-footer -->
                </form>

            </div>
            <?= $this->session->flashdata('message'); ?>
            <!-- Default box -->
            <div class="box box-success" style="overflow-x: scroll;">
                <div class="box-header">
                    <h3 class="box-title"></h3>

                    <a href="<?= base_url('training/soal') ?>"><button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-default"><span class="fa fa-plus"></span>
                            Tambah Soal</button></a>

                    <a href="<?php echo base_url('master/DataPosisi'); ?>"><button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#"><i class="fas fa-plus"></i>Data
                            Posisi</button></a>
                </div>

                <table id="example1" class="table table-bordered table-striped">
                    <thead style="background-color:  #8b0000; color: white;">
                        <tr>
                            <th width="1%">No</th>
                            <th width="10%">Kode </th>
                            <th width="20%">posisi</th>
                            <th>Soal Ujian</th>
                            <th width="13%">Kunci Jawaban</th>
                            <th width="8%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($soal_ujian as $d) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $d->kode; ?></td>
                                <td><?php echo $d->nama_posisi; ?></td>
                                <td>
                                    <?php echo $d->pertanyaan; ?>

                                    <ol type="A">
                                        <li>
                                            <?php if ('A' == $d->kunci_jawaban) {
                                                echo "<b>";
                                                echo $d->a;
                                                echo "</b>";
                                            } else {
                                                echo $d->a;
                                            }
                                            ?>
                                        </li>
                                        <li>
                                            <?php if ('B' == $d->kunci_jawaban) {
                                                echo "<b>";
                                                echo $d->b;
                                                echo "</b>";
                                            } else {
                                                echo $d->b;
                                            }
                                            ?>
                                        </li>
                                        <li>
                                            <?php if ('C' == $d->kunci_jawaban) {
                                                echo "<b>";
                                                echo $d->c;
                                                echo "</b>";
                                            } else {
                                                echo $d->c;
                                            }
                                            ?>
                                        </li>
                                        <li>
                                            <?php if ('D' == $d->kunci_jawaban) {
                                                echo "<b>";
                                                echo $d->d;
                                                echo "</b>";
                                            } else {
                                                echo $d->d;
                                            }
                                            ?>
                                        </li>
                                        <li>
                                            <?php if ('E' == $d->kunci_jawaban) {
                                                echo "<b>";
                                                echo $d->e;
                                                echo "</b>";
                                            } else {
                                                echo $d->e;
                                            }
                                            ?>
                                        </li>
                                    </ol>
                                </td>
                                <td><b><?php echo $d->kunci_jawaban; ?></b></td>
                                <td>
                                    <a class="badge" style="color: black; background-color: gold" href="<?= base_url() ?>training/soal_ujian/edit/<?= $d->id_soal_ujian ?>"><i class="fas fa-edit"></i> Edit</a>
                                    <a class="badge" style="color: antiquewhite; background-color:  #cc0000;" href="<?= base_url() ?>training/soal_ujian/hapus/<?= $d->id_soal_ujian ?>"><i class="fas fa-trash-alt"></i>Hapus</a>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.col-->
    </div>
</div>
<div class="modal fade" id="importdatasoal" tabindek="-1" role+dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="<?= base_url('training/soal_ujian/import') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="import" name="import" accept=".xlsx,.xls">
                            <label class="custom-file-label" for="import">Choose file</label>
                        </div>
                    </div>
                    <!-- modal footer  -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn" style="background-color: #cc0000; color: antiquewhite;">Import</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- akhir modal hapus -->