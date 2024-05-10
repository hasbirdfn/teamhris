<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#tambahBpjsKaryawan"><i class="fas fa-plus"></i>
                Tambah BPJS Karyawan
            </button>
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Karyawan</th>
                        <th>Kelas</th>
                        <th>Nilai</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($bpjskaryawan as $bk) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $bk['nik']; ?></td>
                            <td><?= $bk['nama_karyawan']; ?></td>
                            <td><?= $bk['kelas']; ?></td>
                            <td>Rp <?= number_format($bk['nilai'], 0, ',', '.'); ?></td>
                            <td><?= $bk['jumlah']; ?></td>
                            <td>Rp <?= number_format($bk['total'], 0, ',', '.'); ?></td>
                            <td style="text-align: center;">
                                <a href="" class="badge" style="background-color: #fbff39; color: black;" data-toggle="modal" data-target="#ubahBpjsKaryawan<?= $bk['id_bpjs']; ?>">ubah</a>
                                <a href="" class="badge" style="background-color: #ff0000; color: white;" data-toggle="modal" data-target="#modal-sm<?= $bk['id_bpjs']; ?>">hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- Modal tambah -->
<div class="modal fade" id="tambahBpjsKaryawan" tabindex="-1" aria-labelledby="tambahBpjsKaryawanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahBpjsKaryawanLabel">Tambah Bpjs Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('payroll/bpjs/tambah'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nik_nama">NIK & Nama Karyawan</label>
                        <select name="nik_nama" id="nik_nama" class="form-control">
                            <option value="">-- Pilih NIK & Nama --</option>
                            <?php foreach ($datakaryawan as $dk) : ?>
                                <option value="<?= $dk['id_karyawan']; ?>"><?= $dk['nik']; ?> - <?= $dk['nama_karyawan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select name="kelas_nilai" id="kelas" class="form-control" onchange="hitungtotal()">
                            <option value="">-- Pilih Kelas dan nilai --</option>
                            <?php foreach ($databpjs as $db) : ?>
                                <option value="<?= $db['id']; ?>"><?= $db['kelas']; ?> - Rp <?= number_format($db['nilai'], 0, ',', '.'); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah.." onkeyup="hitungtotal()">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="hidden" class="form-control" id="total2" name="total2">
                                <input type="text" disabled class="form-control" id="total" name="total">
                            </div>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal ubah -->
<?php foreach ($bpjskaryawan as $bk) : ?>
    <div class="modal fade" id="ubahBpjsKaryawan<?= $bk['id_bpjs']; ?>" tabindex="-1" aria-labelledby="ubahBpjsKaryawanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahBpjsKaryawanLabel">Ubah Bpjs Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('payroll/bpjs/ubah'); ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $bk['id_bpjs']; ?>">
                        <div class="form-group">
                            <label for="nik_nama">NIK & Nama Karyawan</label>
                            <select name="nik_nama" id="nik_nama" class="form-control">
                                <option value="">-- Pilih NIK & Nama --</option>
                                <?php foreach ($datakaryawan as $dk) : ?>
                                    <?php if ($dk['id_karyawan'] == $bk['id_datakaryawan']) : ?>
                                        <option value="<?= $dk['id_karyawan']; ?>" selected><?= $dk['nik']; ?> - <?= $dk['nama_karyawan'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $dk['id_karyawan']; ?>"><?= $dk['nik']; ?> - <?= $dk['nama_karyawan'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select name="kelas_nilai" id="kelas_ubah" class="form-control" onchange="hitungtotalubah()">
                                <option value="">-- Pilih Kelas dan nilai --</option>
                                <?php foreach ($databpjs as $db) : ?>
                                    <?php if ($db['id'] == $bk['id_databpjs']) : ?>
                                        <option value="<?= $db['id']; ?>" selected><?= $db['kelas']; ?> - Rp <?= number_format($db['nilai'], 0, ',', '.'); ?></option>
                                    <?php else : ?>
                                        <option value="<?= $db['id']; ?>"><?= $db['kelas']; ?> - Rp <?= number_format($db['nilai'], 0, ',', '.'); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="text" class="form-control" id="jumlah_ubah" name="jumlah" value="<?= $bk['jumlah']; ?>" onkeyup="hitungtotalubah()">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="total">Total</label>
                                    <input type="hidden" class="form-control" id="total2_ubah" name="total2" value="<?= $bk['total']; ?>">
                                    <input type=" text" disabled class="form-control" id="total_ubah" name="total" value="<?= $bk['total']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class=" modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-danger">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal hapus -->
<?php foreach ($bpjskaryawan as $bk) : ?>
    <div class="modal fade" id="modal-sm<?= $bk['id_bpjs']; ?>">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk menghapus data ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn" data-dismiss="modal" style="background-color: #fbff39;">Tidak</button>
                    <a href="<?= base_url() ?>payroll/bpjs/hapus/<?= $bk['id_bpjs']  ?>" type="submit" class="btn btn-primary">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>

<script>
    function hitungtotal() {
        var nilai = $("#kelas option:selected").text();
        var ambilNilai = nilai.split(" - Rp ");
        var ambilNilaia = ambilNilai[1].replace(".", "");
        var jumlah = document.getElementById("jumlah").value;
        var total = jumlah * ambilNilaia;

        document.getElementById("total2").value = total
        document.getElementById("total").value = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0,
            minimumFractionDigits: 0
        }).format(total);
    }

    function hitungtotalubah() {
        alert('ubah');
        var nilaiUbah = $("#kelas_ubah option:selected").text();
        alert(nilaiUbah);
        var ambilNilaiUbah = nilaiUbah.split(" - Rp ");
        var ambilNilaiaUbah = ambilNilaiUbah[1].replace(".", "");
        var jumlahUbah = document.getElementById("jumlah_ubah").value;
        var totalUbah = jumlahUbah * ambilNilaiaUbah;
        alert(totalUbah);

        document.getElementById("total2_ubah").value = totalUbah
        document.getElementById("total_ubah").value = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0,
            minimumFractionDigits: 0
        }).format(total);
    }
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