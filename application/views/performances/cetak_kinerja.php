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
        <h2>Hasil Penilaian Kinerja</h2>
    </center>

    <?php
    if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];
        $bulantahun = $bulan . $tahun;
    } else {
        $bulan = date('m');
        $tahun = date('Y');
        $bulantahun = $bulan . $tahun;
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
                <th class="text-center">Done Kerja</th>
                <th class="text-center">Total Kerja</th>
                <th class="text-center">Nilai</th>
                <th class="text-center">Kategorisasi</th>

            </tr>
        </thead>
        <?php $no = 1; ?>
        <?php foreach ($cetak_kinerja as $ck):
            $nilai = ($ck['waktu'] / $ck['total_kinerja']) * 100; ?>
            <tr>
                <td class="text-center">
                    <?= $no++ ?>
                </td>
                <td class="text-center">
                    <?= $ck['nik'], "<br>" .
                        $ck['nama_karyawan']; ?>
                </td>
                <td class="text-center">
                    <?= $ck['waktu']; ?>
                </td>
                <td class="text-center">
                    <?= $ck['total_kinerja']; ?>
                <td class="text-center">
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