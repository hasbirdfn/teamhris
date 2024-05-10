<div class="row">
    <div class="col-md-12">


        <!-- Default box -->
        <div class="box box-success" style="overflow-x: scroll;">
            <div class="box box-header">
                <center>
                    <h3 class="box-title">Hasil Ujian</h3>
                </center>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead style="background-color:  #8b0000; color: white;">
                        <tr>
                            <th width="1%">No</th>
                            <th> Posisi</th>
                            <th> Tanggal Ujian</th>
                            <th> Jam </th>
                            <th> Benar</th>
                            <th> Salah</th>
                            <th> Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($hasil_karyawan as $d) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d->nama_posisi; ?></td>
                            <td><?php echo date('d-m-y', strtotime($d->tanggal_ujian)); ?></td>
                            <td><?php echo date('H:i:s', strtotime($d->jam_ujian)); ?></td>
                            <td>
                                <?php
                                    if ($d->benar == '') {
                                        echo "<span class='btn btn-xs btn-warning'>Belum Ujian</span>";
                                    } else {
                                        echo $d->benar;
                                    }
                                    ?>
                            </td>
                            <td>
                                <?php
                                    if ($d->salah == '') {
                                        echo "<span class='btn btn-xs btn-warning'>Belum Ujian</span>";
                                    } else {
                                        echo $d->salah;
                                    }
                                    ?>
                            </td>
                            <td>
                                <?php
                                    if ($d->nilai == '') {
                                        echo "<span class='btn btn-xs btn-warning'>Belum Ujian</span>";
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