<!DOCTYPE html>
<html>

<head>
    <title>
        <?= $title ?>
    </title>
    <style type="text/css">
        body {
            font-family: Arial;
            color: black;
        }
    </style>
</head>

<body>
    <center>
        <h1>PT. Sahaware Teknologi Indonesia</h1>
        <h2>Hasil Akumulasi Penilaian</h2>
    </center>

    <?php
    if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];
        $bulantahun = $bulan . "/" . $tahun;
    } else {
        $bulan = date('m');
        $tahun = date('Y');
        $bulantahun = $bulan . "/" . $tahun;
    }
    ?>
    <table>
        <tr>
            <td>Bulan</td>
            <td>:</td>
            <td>
                <?= $bulan ?>
            </td>
        </tr>
        <tr>
            <td>Tahun</td>
            <td>:</td>
            <td>
                <?= $tahun ?>
        </tr>
    </table>
    <table class="table table-bordered table-triped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">NIK & Nama Karyawan</th>
                <th class="text-center">Nilai Kerja</th>
                <th class="text-center">Nilai Kuesioner</th>
                <th class="text-center">Nilai</th>
                <th class="text-center">Kategorisasi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            $total = 0;
            ?>
            <?php foreach ($cetak_akumulasi_admin as $ck):
                $nilai_kinerja = ($ck['waktu'] / $ck['total_kinerja']) * 100;
                $nilai = ($nilai_kinerja + $ck['total_nilai_kuesioner']) / 2;
                ?>
                <tr>
                    <td style="text-align: center;">
                        <?= $no++; ?>
                    </td>

                    <td style="text-align: center;">
                        <?= $ck['nik'], "<br>" .
                            $ck['nama_karyawan']; ?>
                    </td style="text-align: center;">

                    <td style="text-align: center;">
                        <?= number_format((float) $nilai_kinerja, 2, '.', ''); ?>
                    </td>
                    <td style="text-align: center;">
                        <?= number_format((float) $ck['total_nilai_kuesioner'], 2, '.', ''); ?>
                    </td>

                    <td style="text-align: center;">
                        <?= number_format((float) $nilai, 2, '.', ''); ?>

                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($nilai >= 80 && $nilai <= 100) {
                            echo "Sangat Baik";
                        } else if ($nilai >= 60 && $nilai <= 79) {
                            echo "Baik";
                        } else if ($nilai >= 40 && $nilai <= 59) {
                            echo "Cukup";
                        } else if ($nilai >= 20 && $nilai <= 39) {
                            echo "Kurang";
                        } else if ($nilai >= 0 && $nilai <= 19) {
                            echo "Sangat Kurang";
                        }
                        ?>

                    </td>

                </tr>
            <?php endforeach; ?>

        </tbody>

    </table>

    <table width="100%">
        <tr>
            <td></td>
            <td width="200px">
                <p>Bandung,
                    <?= date("d M Y") ?> <br>Human Capital
                </p>
                <br>
                <br>
                <p>Aisyiah Ummul Mutqinah S.Psi.M.Psi</p>

            </td>
        </tr>
    </table>
</body>

</html>


<script type="text/javascript">
    window.print();
</script>