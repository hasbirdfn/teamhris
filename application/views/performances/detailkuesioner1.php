<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">

            <?php if ($this->session->userdata('level') !== 'biasa')
                if ($this->session->userdata('level') !== 'leader') { ?>

                <?php } ?>


            <form method="POST">
                <div class=" table-responsive">
                    <table id="" class="table table-bordered table-striped">
                        <thead style="background-color: #8b0000; color: white;">
                            <tr style="text-align: center;">
                                <th>No</th>
                                <th>NIk & Nama Karyawan</th>
                                <th>Nilai Kinerja</th>
                                <th>Nilai Kuesioner</th>
                                <th>Total</th>
                                <th>Kategorisasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            ?>
                            <?php foreach ($detailkuesioner1 as $d):
                                $total_nilai = ($d['nilai_kinerja'] + $d['nilai_kuesioner']) / 2;
                                ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <?= $no++ ?>
                                    </td>

                                    <td style="text-align: center;">
                                        <?= $d['nik'], "<br>" .
                                            $d['nama_karyawan']; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?= $d['nilai_kinerja'] ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?= $d['nilai_kuesioner'] ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?= $total_nilai; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php
                                        if ($total_nilai >= 80 && $total_nilai <= 100) {
                                            echo "Sangat Baik";
                                        } else if ($total_nilai >= 60 && $total_nilai <= 79) {
                                            echo "Baik";
                                        } else if ($total_nilai >= 40 && $total_nilai <= 59) {
                                            echo "Cukup";
                                        } else if ($total_nilai >= 20 && $total_nilai <= 39) {
                                            echo "Kurang";
                                        } else if ($total_nilai >= 0 && $total_nilai <= 19) {
                                            echo "Sangat Kurang";
                                        }
                                        ?>

                                    </td>

                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>

                    <a class="badge" href=<?= base_url("performances/PenilaianKuesioner") ?> type="button"
                        style="background-color: #d4d4d4" ;><i class="fas fa-reply"></i>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>