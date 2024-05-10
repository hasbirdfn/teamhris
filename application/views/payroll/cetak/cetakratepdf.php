<!DOCTYPE html>
<html><head>
    <title><?= $title ?></title>
    <style type="text/css">
        body {
            font-family: Arial;
            color: black;
        }
    </style>
</head><body>
    <center>
        <h1>PT. Sahaware Teknologi Indonesia</h1>
        <h2>Daftar Rate Total Mitra</h2>
    </center>

    <table>
        <tr>
            <td>Bulan</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Tahun</td>
            <td>:</td>
            <td></td>
        </tr>
    </table>
    <table class="table table-bordered table-triped" border="1">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nama Perusahaan</th>
            <th class="text-center">Nama Karyawan</th>
            <th class="text-center">Keahlian</th>
            <th class="text-center">Tools</th>
            <th class="text-center">Rate Total</th>
        </tr>
        <?php $no = 1; ?>
        <?php foreach ($cetak_rate as $g) : ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td class="text-center"><?= $g['nama_perusahaan']; ?></td>
                <td class="text-center"><?= $g['nama_karyawan']; ?></td>
                <td class="text-center"><?= $g['keahlian']; ?></td>
                <td class="text-center"><?= $g['tools']; ?></td>
                <td class="text-center">Rp <?= number_format($g['rate_total'], 0, ',', '.'); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <th colspan="4" style="text-align: right;">Total : </th>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td></td>
            <td width="200px">
                <p>Bandung, <?= date("d M Y") ?> <br> Finance</p>
                <br>
                <br>
                <p>_____________________</p>
            </td>
        </tr>
    </table>
</body></html>

<script type="text/javascript">
    window.print();
</script>