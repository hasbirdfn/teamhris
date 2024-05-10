<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">

            <?php if ($this->session->userdata('level') !== 'biasa')
                if ($this->session->userdata('level') !== 'leader') { ?>

                <?php } ?>

            <div class="card">
                <div class="card-header" style="background: #8b0000; color: #ffffff;">
                    <b>Saran</b>
                </div>
                <div class="card-body">
                    <?= $saran ?>
                </div>
            </div>
            <form method=" POST">
                <div class=" table-responsive">
                    <table id="" class="table table-bordered table-striped">
                        <thead style="background-color: #8b0000; color: white;">
                            <tr style="text-align: center;">
                                <th>No</th>
                                <th>Soal</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            $total = 0;
                            ?>
                            <?php foreach ($detailkuesioner as $dk):
                                $total = $total + $dk["nilai"];
                                ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <?= $no++ ?>
                                    </td>

                                    <td>
                                        <?= $dk['kuesioner'] ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?= $dk['nilai'] ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan=2><b>TOTAL NILAI</b></td>
                                <td class="text-center" style="color: black;">
                                    <?= $total ?>
                                </td>
                            </tr>

                        </tbody>

                    </table>
                    <a class="badge" href=<?= base_url("Performances/PenilaianKuesioner") ?> type="button"
                        style="background-color: #d4d4d4" ;><i class="fas fa-reply"></i>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>