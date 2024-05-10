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
        <h2>Bukti Penilaian Kuesioner</h2>
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
            </td>
        </tr>
    </table>
    <table id="example1" class="table table-bordered table-striped">
        <thead style="text-align: center;">
            <tr>
                <th>No</th>
                <th>NIK & Nama Penilai</th>
                <th>NIK & Nama Menilai</th>
                <th>Bulan Penilaian</th>
                <th>Total Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1 ?>
            <?php foreach ($cetak_kuesioner as $pr): ?>
                <tr style="text-align: center;">
                    <th>
                        <?= $no++; ?>
                    </th>

                    <td>
                        <?= $pr['nik_penilai'], "<br>" .
                            $pr['nama_karyawan_penilai']; ?>
                    </td>

                    <td>
                        <?= $pr['nik_menilai'], "<br>" .
                            $pr['nama_karyawan_menilai']; ?>
                    </td>
                    <td>
                        <?= $pr['tanggal']; ?>
                    </td>
                    <td>
                        <?= $pr['total_nilai']; ?>
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