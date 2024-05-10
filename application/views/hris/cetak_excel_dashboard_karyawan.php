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
            <th class="text-center">Nilai Kinerja</th>
            <th class="text-center">Nilai Kuesioner</th>
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
            if ($nik !== $ndk['nik'] && $level !== "hc") {
                continue;
            }
            $nilai_kinerja = ($ndk['waktu'] / $ndk['total_kinerja']) * 100;
            $nilai = ($nilai_kinerja + $ndk['total_nilai_kuesioner']) / 2;
            ?>
            <tr>
                <td style="text-align: center;">
                    <?= $no++; ?>
                </td>

                <td style="text-align: center;">
                    <?= "'" . $ndk['nik'] . "' <br> " . $ndk['nama_karyawan']; ?>
                </td>

                <td style="text-align: center;">
                    <?= number_format((float) $nilai_kinerja, 2, '.', ''); ?>
                </td>
                <td style="text-align: center;">
                    <?= number_format((float) $ndk['total_nilai_kuesioner'], 2, '.', ''); ?>
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