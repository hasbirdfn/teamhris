<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>
                        <?= $bariskaryawan; ?>
                    </h3>
                    <p>Jumlah Karyawan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="<?= base_url('master/DataKaryawan'); ?>" class="small-box-footer">Info Lengkap <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>
                        <?= $barisposisi; ?>
                    </h3>
                    <p>Jumlah Posisi</p>
                </div>
                <div class="icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <a href="<?= base_url('master/DataPosisi'); ?>" class="small-box-footer">Info Lengkap <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>
                        <?= $barismitra; ?>
                    </h3>
                    <p>Jumlah Mitra</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-lock"></i>
                </div>
                <a href="<?= base_url('master/DataMitra'); ?>" class="small-box-footer">Info Lengkap <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>
                        <?= $barispelamar; ?>
                    </h3>
                    <p>Jumlah Pelamar</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="<?= base_url('Recruitment/pelamar'); ?>" class="small-box-footer">Info Lengkap <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <?php switch (date('m')) {
        case '01':
            $bulan = 'Januari';
            break;
        case '02':
            $bulan = 'Februari';
            break;
        case '03':
            $bulan = 'Maret';
            break;
        case '04':
            $bulan = 'April';
            break;
        case '05':
            $bulan = 'Mei';
            break;
        case '06':
            $bulan = 'Juni';
            break;
        case '07':
            $bulan = 'Juli';
            break;
        case '08':
            $bulan = 'Agustus';
            break;
        case '09':
            $bulan = 'September';
            break;
        case '10':
            $bulan = 'Oktober';
            break;
        case '11':
            $bulan = 'November';
            break;
        case '12':
            $bulan = 'Desember';
            break;
    } ?>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header" style="background-color: #8b0000;">
                    <h3 class="card-title" style="color: white;">Laporan Gaji Bulan
                        <?= $bulan; ?> (Office/Project Base)
                    </h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="get" action="<?= base_url('hris/filter_per_type'); ?>">
                        <div class="card-body p-0">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <select class="form-control select2" id="bulan_type" name="bulan_type">
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <select class="form-control select2" id="tahun_type" name="tahun_type">
                                        <?php for ($i = date('Y'); $i >= 2020; $i--) : ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                    <div class="col-lg-12">
                        <canvas id="type"></canvas>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-4">
            <div class="card">
                <div class="card-header" style="background-color: #8b0000;">
                    <h3 class="card-title" style="color: white;">Laporan Gaji Karyawan Bulan
                        <?= $bulan; ?>
                    </h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="get" action="<?= base_url('hris/filter_per_status'); ?>">
                        <div class="card-body p-0">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <select class="form-control select2" id="bulan_status" name="bulan_status">
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <select class="form-control select2" id="tahun_status" name="tahun_status">
                                        <?php for ($i = date('Y'); $i >= 2020; $i--) : ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                    <div class="col-lg-12">
                        <canvas id="karyawan"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header" style="background-color: #8b0000;">
                    <h3 class="card-title" style="color: white;">Laporan Rate Mitra Bulan
                        <?= $bulan; ?>
                    </h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="get" action="<?= base_url('hris/filter_mitra'); ?>">

                        <div class="card-body p-0">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <select class="form-control select2" id="bulan_mitra" name="bulan_mitra">
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <select class="form-control select2" id="tahun_mitra" name="tahun_mitra">
                                        <?php for ($i = date('Y'); $i >= 2020; $i--) : ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                    <div class="col-lg-12">
                        <canvas id="mitra"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" style="color: white; background-color: #8b0000;">
            <h4> Filter Data Penilaian Karyawan</h4>
        </div>
        <form class="form-horizontal">
            <div class="card-body">
                <div class="form-group row">
                    <label for="bulan" class="col-form-label">Bulan: </label>
                    <div class="col-md-2">
                        <select class="form-control select2" name="bulan">
                            <option value="">-- Pilih Bulan --</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <label for="tahun" class="col-form-label">Tahun: </label>
                    <div class="col-md-2">
                        <select class="form-control" name="tahun">
                            <option value="">-- Pilih Tahun --</option>
                            <?php $tahun = date('Y');
                            for ($i = 2020; $i < $tahun + 3; $i++) { ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php } ?>
                        </select>
                    </div>
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
                    <button type="submit" class="btn btn-outline-success ml-auto"><i class="fas fa-eye"> Tampilkan
                            Data
                        </i>
                    </button>

                    <?php if (count($akumulasi) > 0) { ?>
                        <a class="btn btn-outline-success ml-2" href="<?= base_url('Hris/cetakPdf?bulan=' . $bulan), '&tahun=' . $tahun ?>"><i class="fas fa-print"></i> Cetak PDF</a>
                        <a class="btn btn-outline-success ml-2" href="<?= base_url('Hris/cetakExcelHC?bulan=' . $bulan), '&tahun=' . $tahun ?>"><i class="fas fa-print"></i> Cetak Excel</a>
                    <?php } else { ?>
                        <button type="button" class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-print"></i> Cetak PDF</button>
                        <button type="button" class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-print"></i> Cetak Excel</button>
                    <?php } ?>

                </div>
        </form>
    </div>
</div>
<div class="alert alert" style="background-color: #8b0000; color: white;">
    Menampilkan Penilaian Karyawan Bulan:<span class="font-weight-bold">
        <?php echo $bulan ?>
    </span> Tahun:<span class="font-weight-bold">
        <?php echo $tahun ?>
</div>


<div class="card">
    <div class="card-body">

        <?php

        $jml_data = COUNT($akumulasi);
        if ($jml_data > 0) { ?>
            <table id="example1" class="table table-bordered table-striped">
                <thead style="text-align: center;  background-color:#8b0000; color: white;">
                    <tr>
                        <th>No</th>
                        <th>Bulan/Tahun</th>
                        <th>Karyawan</th>
                        <th>Nilai</th>
                        <th>Kategorisasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php
                    $nik = $this->session->userdata("nik");
                    $level = $this->session->userdata("level");

                    foreach ($akumulasi as $ak) :
                        if ($nik === $ak['nik'] && $level !== "hc" && $level !== "ceo")
                            continue;
                        $nilai_kinerja = ($ak['waktu'] / $ak['total_kinerja']) * 100;
                        $nilaiakumulasi = ($nilai_kinerja + $ak['total_nilai_kuesioner']) / 2;
                    ?>
                        <tr style="text-align: center;">
                            <td>
                                <?= $no++; ?>
                            </td>
                            <td>
                                <?= $ak['tanggal'] ?>
                            </td>
                            <td>
                                <?= $ak['nik'], "<br>" .
                                    $ak['nama_karyawan']; ?>
                            </td>

                            <td>
                                <?= number_format((float) $nilaiakumulasi, 2, '.', '') ?>
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
        <?php } else { ?>
            <span class="badge badge-danger"><i class="fas fa-info-circle"></i>
                Data masih kosong, silahkan memilih bulan dan tahun!</span>
        <?php } ?>

    </div>
</div>
<!-- /.card-body -->
</div>

<!-- Modal cetak akumulasi keseluruhan -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Data penilaian masih kosong.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" style="background-color: #8b0000; color: white;" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<script>
    const a = <?= $laporan_gk[0]['Sudah'] ?>;
    const b = <?= $laporan_gk[0]['Belum'] ?>;

    const karyawan = document.getElementById('karyawan');
    const d_karyawan = {
        labels: [
            'Sudah dibayar',
            'Belum dibayar'
        ],
        datasets: [{
            label: 'Gaji Karyawan',
            data: [a, b],
            backgroundColor: [
                '#28a745',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    new Chart(karyawan, {
        type: 'pie',
        data: d_karyawan,
        options: {
            legend: {
                display: true,
                labels: {
                    display: false,
                    fontSize: 10
                }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var totalData = data['datasets'][0]['data'][tooltipItem['index']];
                        if (parseInt(totalData) >= 1000) {
                            return data['labels'][tooltipItem['index']] + ': Rp ' + totalData.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        } else {
                            return 'Rp ' + totalData;
                        }
                    }
                }
            }
        }
    });

    const c = <?= $laporan_rm[0]['Sudah'] ?>;
    const d = <?= $laporan_rm[0]['Belum'] ?>;
    const mitra = document.getElementById('mitra');
    const d_mitra = {
        labels: [
            'Sudah dibayar',
            'Belum dibayar'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [c, d],
            backgroundColor: [
                '#28a745',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    new Chart(mitra, {
        type: 'pie',
        data: d_mitra,
        options: {
            legend: {
                display: true,
                labels: {
                    display: false,
                    fontSize: 10
                }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var totalData = data['datasets'][0]['data'][tooltipItem['index']];
                        if (parseInt(totalData) >= 1000) {
                            return data['labels'][tooltipItem['index']] + ': Rp ' + totalData.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        } else {
                            return 'Rp ' + totalData;
                        }
                    }
                }
            }
        }
    });

    const e = <?= $laporan_type[0]['Office'] ?>;
    const f = <?= $laporan_type[0]['Project'] ?>;
    const type = document.getElementById('type');
    const d_type = {
        labels: [
            'Office',
            'Project Base'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [e, f],
            backgroundColor: [
                '#28a745',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    new Chart(type, {
        type: 'pie',
        data: d_type,
        options: {
            // maintainAspectRatio: false,
            legend: {
                display: true,
                labels: {
                    display: false,
                    fontSize: 10
                }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var totalData = data['datasets'][0]['data'][tooltipItem['index']];
                        if (parseInt(totalData) >= 1000) {
                            return data['labels'][tooltipItem['index']] + ': Rp ' + totalData.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        } else {
                            return 'Rp ' + totalData;
                        }
                    }
                }
            }
        }
    });

    let d2 = new Date();
    let m2 = d2.getMonth() + 1
    let year = d2.getFullYear()
    let month = ('0' + m2).slice(-2);
    document.getElementById("bulan_type").value = month;
    document.getElementById("bulan_status").value = month;
    document.getElementById("bulan_mitra").value = month;
    document.getElementById("tahun_type").value = year;
    document.getElementById("tahun_status").value = year;
    document.getElementById("tahun_mitra").value = year;
    // document.getElementById("bulan_status").value = month;
</script>

<script type="text/javascript">
    // START TYPE
    $('#bulan_type,#tahun_type').change(function() {
        bulanType = document.getElementById('bulan_type').value;
        tahunType = document.getElementById('tahun_type').value;
        $.ajax({
            url: '<?= base_url() ?>hris/filter_per_type',
            dataType: 'json',
            type: "POST",
            data: {
                bulanType,
                tahunType
            },
            success: function(result) {

                const e2 = result[0]['Office'];
                const f2 = result[0]['Project'];
                const type = document.getElementById('type');
                const d_type = {
                    labels: [
                        'Office',
                        'Project Base'
                    ],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [e2, f2],
                        backgroundColor: [
                            '#28a745',
                            'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                    }]
                };

                new Chart(type, {
                    type: 'pie',
                    data: d_type,
                    options: {
                        // maintainAspectRatio: false,
                        legend: {
                            display: true,
                            labels: {
                                display: false,
                                fontSize: 10
                            }
                        },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    var totalData = data['datasets'][0]['data'][tooltipItem['index']];
                                    if (parseInt(totalData) >= 1000) {
                                        return data['labels'][tooltipItem['index']] + ': Rp ' + totalData.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    } else {
                                        return 'Rp ' + totalData;
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    });
    // END TYPE

    // START TYPE
    $('#bulan_status,#tahun_status').change(function() {
        bulanStatus = document.getElementById('bulan_status').value;
        tahunStatus = document.getElementById('tahun_status').value;
        $.ajax({
            url: '<?= base_url() ?>hris/filter_per_status',
            dataType: 'json',
            type: "POST",
            data: {
                bulanStatus,
                tahunStatus
            },
            success: function(result) {

                const a2 = result[0]['Sudah'];
                const b2 = result[0]['Belum'];

                const karyawan = document.getElementById('karyawan');
                const d_karyawan = {
                    labels: [
                        'Sudah dibayar',
                        'Belum dibayar'
                    ],
                    datasets: [{
                        label: 'Gaji Karyawan',
                        data: [a2, b2],
                        backgroundColor: [
                            '#28a745',
                            'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                    }]
                };

                new Chart(karyawan, {
                    type: 'pie',
                    data: d_karyawan,
                    options: {
                        legend: {
                            display: true,
                            labels: {
                                display: false,
                                fontSize: 10
                            }
                        },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    var totalData = data['datasets'][0]['data'][tooltipItem['index']];
                                    if (parseInt(totalData) >= 1000) {
                                        return data['labels'][tooltipItem['index']] + ': Rp ' + totalData.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    } else {
                                        return 'Rp ' + totalData;
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    });
    // END TYPE

    // START TYPE
    $('#bulan_mitra,#tahun_mitra').change(function() {
        bulanMitra = document.getElementById('bulan_mitra').value;
        tahunMitra = document.getElementById('tahun_mitra').value;
        $.ajax({
            url: '<?= base_url() ?>hris/filter_per_mitra',
            dataType: 'json',
            type: "POST",
            data: {
                bulanMitra,
                tahunMitra
            },
            success: function(result) {

                const c2 = result[0]['Sudah'];
                const d2 = result[0]['Belum'];

                const mitra = document.getElementById('mitra');
                const d_mitra = {
                    labels: [
                        'Sudah dibayar',
                        'Belum dibayar'
                    ],
                    datasets: [{
                        label: 'Rate Mitra',
                        data: [c2, d2],
                        backgroundColor: [
                            '#28a745',
                            'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                    }]
                };

                new Chart(mitra, {
                    type: 'pie',
                    data: d_mitra,
                    options: {
                        legend: {
                            display: true,
                            labels: {
                                display: false,
                                fontSize: 10
                            }
                        },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    var totalData = data['datasets'][0]['data'][tooltipItem['index']];
                                    if (parseInt(totalData) >= 1000) {
                                        return data['labels'][tooltipItem['index']] + ': Rp ' + totalData.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    } else {
                                        return 'Rp ' + totalData;
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    });
    // END TYPE
</script>

<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });
        <?php if ($this->session->flashdata('message')) : ?>
            const flashData = <?= json_encode($this->session->flashdata('message')) ?>;
            Toast.fire({
                icon: 'success',
                title: flashData
            })
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')) : ?>
            const flashData = <?= json_encode($this->session->flashdata('error')) ?>;
            Toast.fire({
                icon: 'error',
                title: flashData
            })
        <?php endif; ?>
        <?php if (validation_errors()) : ?>
            const flashData = <?= json_encode(validation_errors()) ?>;
            Toast.fire({
                icon: 'error',
                title: flashData
            })
        <?php endif; ?>
    });
</script>