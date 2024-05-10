<?php
header("Content-type:application/octet-stream/");

header("Content-Disposition:attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0")
?>
<h3>Laporan Pengajuan Rate Mitra</h3>
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
    <tr>
        <th class="text-center">No</th>
        <th class="text-center">Nama Perusahaan</th>
        <th class="text-center">Nama Karyawan</th>
        <th class="text-center">Keahlian</th>
        <th class="text-center">Tools</th>
        <th class="text-center">Rate Total</th>
    </tr>
    <?php
    $no = 1;
    $rate = 0;
    ?>
    <?php foreach ($cetak_rate as $g) :
        $k1 = unserialize($g['keahlian']);
        $k2 = serialize($k1);
        $k3 = array($k2);
        $k4 = array();
        for ($i = 0; $i < count($k3); $i++) {
            $k5 = unserialize($k3[$i]);
            $k4[] = implode(', ', $k5);
        }
        if (!is_null($k4)) {
            foreach ($k4 as $k) {
                $data_k = $k;
            }
        }

        $t1 = unserialize($g['tools']);
        $t2 = serialize($t1);
        $t3 = array($t2);
        $t4 = array();
        for ($i = 0; $i < count($t3); $i++) {
            $t5 = unserialize($t3[$i]);
            $t4[] = implode(', ', $t5);
        }
        if (!is_null($t4)) {
            foreach ($t4 as $t) {
                $data_t = $t;
            }
        }
    ?>

        <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td class="text-center"><?= $g['nama_perusahaan']; ?></td>
            <td class="text-center"><?= $g['nama_karyawan']; ?></td>
            <td class="text-center"><?= $data_k ?></td>
            <td class="text-center"><?= $data_t ?></td>
            <td class="text-center">Rp <?= number_format($g['rate_total'], 0, ',', '.'); ?></td>
        </tr>
    <?php
        $rate = $rate + $g['rate_total'];
    endforeach; ?>
    <tr>
        <th colspan="5" style="text-align: right;">Total : </th>
        <th style="text-align: right;">Rp <?= number_format($rate, 0, ',', '.'); ?></th>
    </tr>
</table>