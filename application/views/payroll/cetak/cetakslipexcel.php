<?php
header("Content-type:application/octet-stream/");

header("Content-Disposition:attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0")
?>

<?php foreach ($slipgaji as $sg) : ?>

    <table style="width: 100%">
        <tr>
            <td width="20%">Nama Pegawai</td>
            <td width="2%">:</td>
            <td><?= $sg['nama_karyawan'] ?></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td><?= $sg['nik'] ?></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td><?= $sg['nama_posisi'] ?></td>
        </tr>
        <tr>
            <td>Bulan Tahun</td>
            <td>:</td>
            <td><?= $sg['bulan_tahun'] ?></td>
        </tr>
    </table>

    <table>
        <tr>
            <th class="text-center" width="5%">No</th>
            <th class="text-center">Keterangan</th>
            <th class="text-center">Jumlah</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Gaji Pokok</td>
            <td>Rp. <?= number_format($sg['gajipokok'], 0, ',', '.') ?></td>
        </tr>

        <tr>
            <td>2</td>
            <td>BPJS Kesehatan</td>
            <td>Rp. <?= number_format($sg['bpjs'], 0, ',', '.') ?></td>
        </tr>

        <tr>
            <td>3</td>
            <td>Pajak Karyawan</td>
            <td>Rp. <?= number_format($sg['pajak'], 0, ',', '.') ?></td>
        </tr>

        <tr>
            <td>4</td>
            <td>Tunjangan Kinerja</td>
            <td>Rp. <?= number_format($sg['t_kinerja'], 0, ',', '.') ?></td>
        </tr>

        <tr>
            <td>5</td>
            <td>Tunjangan Fungsional</td>
            <td>Rp. <?= number_format($sg['t_fungsional'], 0, ',', '.') ?></td>
        </tr>

        <tr>
            <td>6</td>
            <td>Tunjangan Jabatan</td>
            <td>Rp. <?= number_format($sg['t_jabatan'], 0, ',', '.') ?></td>
        </tr>

        <tr>
            <td>6</td>
            <td>Potongan</td>
            <td>Rp. <?= number_format($sg['potongan'], 0, ',', '.') ?></td>
        </tr>

        <tr>
            <td>7</td>
            <td>Bonus</td>
            <td>Rp. <?= number_format($sg['bonus'], 0, ',', '.') ?></td>
        </tr>

        <tr>
            <th colspan="2" style="text-align: right;">Total Gaji : </th>
            <th>Rp. <?= number_format($sg['total'], 0, ',', '.') ?></th>
        </tr>
    </table>
<?php endforeach; ?>
</body>

</html>