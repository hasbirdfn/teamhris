<?php

use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;

header("Content-type:application/octet-stream/");

header("Content-Disposition:attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0")
?>
<h3>Laporan Pengajuan Gaji Karyawan</h3>
<table>
    <tr>
        <td>
            <strong>Bulan</strong>
        </td>
        <td>: <?= $bulan ?></td>
    </tr>
    <tr>
        <td>
            <strong>Tahun</strong>
        </td>
        <td>: <?= $tahun ?></td>
    </tr>
</table>
<table border="1" width="100%">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">NIK</th>
            <th class="text-center">Nama Karyawan</th>
            <th class="text-center">Posisi</th>
            <th class="text-center">Gaji Pokok</th>
            <th class="text-center">Pajak</th>
            <th class="text-center">Tj. Kinerja</th>
            <th class="text-center">Tj. Fungsional</th>
            <th class="text-center">Tj. Jabatan</th>
            <th class="text-center">Tj. BPJS Kesehatan</th>
            <th class="text-center">Potongan</th>
            <th class="text-center">Bonus</th>
            <th class="text-center">Total Gaji</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $totalGajiPokok = 0;
        $totalPajak = 0;
        $totalTk = 0;
        $totalTf = 0;
        $totalTj = 0;
        $totalTb = 0;
        $totalPotongan = 0;
        $totalBonus = 0;
        $totalKeseluruhan = 0;
        ?>
        <?php foreach ($cetak_gaji as $g) : ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td class="text-center"><?= "'" . $g['nik'] . "'" ?></td>
                <td class="text-center"><?= $g['nama_karyawan']; ?></td>
                <td class="text-center"><?= $g['nama_posisi']; ?></td>
                <td class="text-center" style="padding: 5px;">Rp <?= number_format($g['gajipokok'], 0, ',', '.'); ?></td>
                <td class="text-center">Rp <?= number_format($g['pajak'], 0, ',', '.'); ?></td>
                <td class="text-center">Rp <?= number_format($g['t_kinerja'], 0, ',', '.'); ?></td>
                <td class="text-center">Rp <?= number_format($g['t_fungsional'], 0, ',', '.'); ?></td>
                <td class="text-center">Rp <?= number_format($g['t_jabatan'], 0, ',', '.'); ?></td>
                <td class="text-center">Rp <?= number_format($g['t_bpjs'], 0, ',', '.'); ?></td>
                <td class="text-center">Rp <?= number_format($g['potongan'], 0, ',', '.'); ?></td>
                <td class="text-center">Rp <?= number_format($g['bonus'], 0, ',', '.'); ?></td>
                <td class="text-center">Rp <?= number_format($g['total'], 0, ',', '.'); ?></td>
            </tr>
        <?php
            $totalGajiPokok = $totalGajiPokok + $g['gajipokok'];
            $totalPajak = $totalPajak + $g['pajak'];
            $totalTk = $totalTk + $g['t_kinerja'];
            $totalTf = $totalTf + $g['t_fungsional'];
            $totalTj = $totalTj + $g['t_jabatan'];
            $totalTb = $totalTb + $g['t_bpjs'];
            $totalPotongan = $totalPotongan + $g['potongan'];
            $totalBonus = $totalBonus + $g['bonus'];
            $totalKeseluruhan = $totalKeseluruhan + $g['total'];
        endforeach; ?>
        <tr>
            <th colspan="4" style="text-align: right;">Total : </th>
            <th style="text-align: left;">Rp <?= number_format($totalGajiPokok, 0, ',', '.'); ?></th>
            <th style="text-align: left;">Rp <?= number_format($totalPajak, 0, ',', '.'); ?></th>
            <th style="text-align: left;">Rp <?= number_format($totalTk, 0, ',', '.'); ?></th>
            <th style="text-align: left;">Rp <?= number_format($totalTf, 0, ',', '.'); ?></th>
            <th style="text-align: left;">Rp <?= number_format($totalTj, 0, ',', '.'); ?></th>
            <th style="text-align: left;">Rp <?= number_format($totalTb, 0, ',', '.'); ?></th>
            <th style="text-align: left;">Rp <?= number_format($totalPotongan, 0, ',', '.'); ?></th>
            <th style="text-align: left;">Rp <?= number_format($totalBonus, 0, ',', '.'); ?></th>
            <th style="text-align: left;">Rp <?= number_format($totalKeseluruhan, 0, ',', '.'); ?></th>
        </tr>
    </tbody>
</table>
<br>
<table width="100%" class="table3">
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td width="200px" style="text-align: center;">
            <p>Bandung, <?= date("d M Y") ?> <br> PT Sahaware Teknologi Indonesia</p>
            <br>
            <br>
            <p>_____________________</p>
            <p>Finance</p>
        </td>
    </tr>
</table>