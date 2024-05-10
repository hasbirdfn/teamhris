<!DOCTYPE html>
<html lang="en"><head>
    <title>Slip Gaji</title>
    <style>
        .table1 {
            border-collapse: collapse;
            width: 100%;
        }

        .table2 {
            border-collapse: collapse;
            width: 70%;
        }
        
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        
        th {
            text-align: center;
        }
        .table3 td{
            border: 0;
        }
    </style>
</head><body>
    <center>
        <h1>PT. Sahaware Teknologi Indonesia</h1>
        <h2>Slip Gaji Karyawan</h2>
        <hr style="color: black">
        <br>
    </center>


    <?php foreach ($slipgaji as $sg) : ?>

        <table class="table2">
            <tr>
                <td width="20%">NIK & Nama :</td>
                <td><?= $sg['nik'] ?> & <?= $sg['nama_karyawan'] ?></td>
            </tr>
            <tr>
                <td>Jabatan :</td>
                <td><?= $sg['nama_posisi'] ?></td>
            </tr>
            <tr>
                <td>Periode :</td>
                <td><?= substr($sg['bulan_tahun'],4,2) ?> / <?= substr($sg['bulan_tahun'],0,4) ?></td>
            </tr>
        </table>
        <br><br>
        <table class="table1">
            <tr>
                <th colspan="4" style="background-color: #dddddd;">Slip Gaji</th>
            </tr>
            <tr>
                <th colspan="2">Penerima</th>
                <th colspan="2">Potongan</th>
            </tr>
            <tr>
                <th>Keterangan</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td>Gaji Pokok</td>
                <td>Rp. <?= number_format($sg['gajipokok'], 0, ',', '.') ?></td>
                <td>Potongan</td>
                <td>Rp. <?= number_format($sg['potongan'], 0, ',', '.') ?></td>
            </tr>

            <tr>
                <td>Tunjangan Fungsional</td>
                <td>Rp. <?= number_format($sg['t_fungsional'], 0, ',', '.') ?></td>
                <td>Pajak</td>
                <td>Rp. <?= number_format($sg['pajak'], 0, ',', '.') ?></td>
            </tr>

            <tr>
                <td>Tunjangan Kinerja</td>
                <td>Rp. <?= number_format($sg['t_kinerja'], 0, ',', '.') ?></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>Tunjangan Kesehatan</td>
                <td>Rp. <?= number_format($sg['t_bpjs'], 0, ',', '.') ?></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>Tunjangan Jabatan</td>
                <td>Rp. <?= number_format($sg['t_jabatan'], 0, ',', '.') ?></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>Intensif + Project (Bonus)</td>
                <td>Rp. <?= number_format($sg['bonus'], 0, ',', '.') ?></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <th colspan="1" style="text-align: left;">Total Penerimaan : </th>
                <th style="text-align: left;">Rp. <?= number_format($sg['gajipokok']+$sg['t_fungsional']+$sg['t_kinerja']+$sg['t_bpjs']+$sg['t_jabatan']+$sg['bonus'], 0, ',', '.') ?></th>
                <th colspan="1" style="text-align: left;">Total Potongan : </th>
                <th style="text-align: left;">Rp. <?= number_format($sg['potongan']+$sg['pajak'], 0, ',', '.') ?></th>
            </tr>
            <tr>
                <th colspan="1" style="text-align: left; background-color: #dddddd;">Gaji : </th>
                <th colspan="3" style="text-align: right; background-color: #dddddd;">Rp. <?= number_format($sg['gajipokok']+$sg['t_fungsional']+$sg['t_kinerja']+$sg['t_bpjs']+$sg['t_jabatan']+$sg['bonus']-$sg['potongan']-$sg['pajak'], 0, ',', '.') ?></th>
            </tr>
        </table>
    <?php endforeach; ?>

    <table width="100%" class="table3">
        <tr>
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
</body></html>

<script type="text/javascript">
    window.print();
</script>