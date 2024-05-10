<?php
header("Content-type:application/octet-stream/");

header("Content-Disposition:attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

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
<h3>Laporan Penilaian Karyawan Per Bulan</h3>
<table>
    <tr>
        <td>Bulan</td>
        <td>:
            <?= $bulan ?>
        </td>

    </tr>
    <tr>
        <td>Tahun</td>
        <td>:
            <?= $tahun ?>
        </td>

    </tr>
</table>
<br>
<table border="1" width="100%">

    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">NIK & Nama Karyawan</th>
            <th class="text-center">Nilai</th>
            <th class="text-center">Kategorisasi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php
        $nik = $this->session->userdata("nik");
        $level = $this->session->userdata("level");


        foreach ($cetak_dashboard_excel as $ndk):
            if ($nik !== $ndk['nik'] && $level !== "ceo") {
                continue;
            }
            $nilaiakumulasi = (($ndk['total_nilai_kuesioner']) + ($ndk['total_nilai_kinerja'])) / 2; ?>

            <tr>
                <td style="text-align: center;">
                    <?= $no++ ?>
                </td>

                <td style="text-align: center;">
                    <?= "'" . $ndk['nik'] . "' <br> " . $ndk['nama_karyawan']; ?>
                </td>

                <td style="text-align: center;">
                    <?= $nilaiakumulasi ?>
                </td>
                <td style="text-align: center;">
                    <?php

                    if ($nilaiakumulasi >= 80 && $nilaiakumulasi <= 100) {
                        echo "Sangat Baik";
                    } else if ($nilaiakumulasi >= 60 && $nilaiakumulasi <= 79) {
                        echo "Baik";
                    } else if ($nilaiakumulasi >= 40 && $nilaiakumulasi <= 59) {
                        echo "Cukup";
                    } else if ($nilaiakumulasi >= 20 && $nilaiakumulasi <= 39) {
                        echo "Kurang";
                    } else if ($nilaiakumulasi >= 0 && $nilaiakumulasi <= 19) {
                        echo "Sangat Kurang";
                    }
                    ?>

                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>

</table>