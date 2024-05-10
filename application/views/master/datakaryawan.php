<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#tambahDataKaryawan"><i class="fas fa-plus"></i>
                Tambah Karyawan
            </button>
            <!-- <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                data-target="#importDataKaryawan"><i class="fas fa-plus"></i>
                Import Data
            </button> -->
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Karyawan</th>
                        <th>Posisi</th>
                        <th>Kelas</th>
                        <th>Gaji Pokok</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($datakaryawan as $dk) : ?>
                        <tr>
                            <th>
                                <?= $no++; ?>
                            </th>
                            <td>
                                <?= $dk['nik']; ?>
                            </td>
                            <td>
                                <?= $dk['nama_karyawan']; ?>
                            </td>
                            <td>
                                <?= $dk['nama_posisi']; ?>
                            </td>
                            <td>
                                <?= $dk['nama_kelas']; ?>
                            </td>
                            <td>Rp
                                <?= number_format($dk['gajipokok'], 0, ',', '.'); ?>
                            </td>
                            <td>
                                <?= $dk['email']; ?>
                            </td>
                            <td>
                                <?= $dk['alamat']; ?>
                            </td>
                            <td>
                                <?= $dk['telepon']; ?>
                            </td>
                            <td>
                                <?= $dk['type']; ?>
                            </td>
                            <td>
                                <?= $dk['status']; ?>
                            </td>
                            <td>
                                <button type="button" class="badge" style="color: black; background-color: gold;" data-toggle="modal" data-target="#ubahDataKaryawan<?= $dk['id_karyawan']; ?>"><i class="fas fa-edit"></i> Edit</button>
                                <button type="button" class="badge" style="color: antiquewhite; background-color:  #cc0000;" data-toggle="modal" data-target="#modal-sm<?= $dk['id_karyawan'] ?>"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- modal untuk tambah data -->
<div class="modal fade" id="tambahDataKaryawan" tabindex="-1" aria-labelledby="tambahDataKaryawanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDataKaryawanLabel">Tambah Data Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/DataKaryawan/tambah') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukan NIK">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Karyawan</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Karyawan">
                    </div>
                    <div class="form-group">
                        <label>Posisi</label>
                        <select class="form-control" name="posisi">
                            <option value="">-- Pilih Posisi --</option>
                            <?php foreach ($dataposisi as $dp) : ?>
                                <option value="<?= $dp['id_posisi']; ?>"><?= $dp['nama_posisi']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <select class="form-control" name="id_kelas">
                            <option value="">-- Pilih Kelas --</option>
                            <?php foreach ($id_kelas as $tk) : ?>
                                <option value="<?= $tk['id_kelas']; ?>"><?= $tk['nama_kelas']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gaji">Gaji Pokok</label>
                        <input type="text" class="form-control" id="gaji" name="gajipokok" placeholder="Masukan Gaji Pokok">
                    </div>
                    <div class="form-group">
                        <label for="nikleader">NIK Leader</label>
                        <input type="text" class="form-control" id="nikleader" name="nikleader" placeholder="Masukan Level">
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="form-control" name="level">
                            <option value="">-- Pilih Level --</option>
                            <option value="hc">hc</option>
                            <option value="leader">leader</option>
                            <option value="biasa">biasa</option>
                            <option value="ceo">ceo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Masukan Email">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat">
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Masukan Nomor Telepon">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" name="type">
                            <option value="">-- Pilih Type Karyawan --</option>
                            <option value="Office">Office</option>
                            <option value="Project Base">Project Base</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password">
                    </div>


                    <!-- modal footer  -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir tambah Modal -->

<!-- Modal edit data -->
<?php foreach ($datakaryawan as $dk) : ?>
    <div class="modal fade" id="ubahDataKaryawan<?= $dk['id_karyawan']; ?>" tabindex="-1" aria-labelledby="ubahDataKaryawanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahDataKaryawanLabel">Ubah Data Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('master/DataKaryawan/ubah') ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id_karyawan" value="<?= $dk['id_karyawan']; ?>">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" value="<?= $dk['nik']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Karyawan</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $dk['nama_karyawan']; ?>"">
                    </div>
                    <div class=" form-group">
                            <label>Posisi</label>
                            <select class="form-control" name="posisi">
                                <option value="">-- Pilih Posisi --</option>
                                <?php foreach ($dataposisi as $dp) : ?>
                                    <?php if ($dp['id_posisi'] == $dk['id_posisi']) : ?>
                                        <option value="<?= $dp['id_posisi']; ?>" selected><?= $dp['nama_posisi'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $dp['id_posisi']; ?>"><?= $dp['nama_posisi'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class=" form-group">
                            <label>Kelas</label>
                            <select class="form-control" name="id_kelas">
                                <option value="">-- Pilih Kelas --</option>
                                <?php foreach ($id_kelas as $tk) : ?>
                                    <?php if ($tk['id_kelas'] == $dk['id_kelas']) : ?>
                                        <option value="<?= $tk['id_kelas']; ?>" selected><?= $tk['nama_kelas'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $tk['id_kelas']; ?>"><?= $tk['nama_kelas'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status">
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gaji">Gaji Pokok</label>
                            <input type="text" class="form-control" id="gaji<?= $dk['id_karyawan']; ?>" name="gajipokok" value="Rp <?= number_format($dk['gajipokok'], 0, ',', '.'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="nikleader">NIK Leader</label>
                            <input type="text" class="form-control" id="nikleader" name="nikleader" value="<?= $dk['nik_leader']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select class="form-control" name="level">
                                <option disabled>-- Pilih Level --</option>
                                <?php foreach ($level as $lv) : ?>
                                    <?php if ($lv == $dk['level']) : ?>
                                        <option value="<?= $lv; ?>" selected><?= $lv ?></option>
                                    <?php else : ?>
                                        <option value="<?= $lv; ?>"><?= $lv ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= $dk['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $dk['alamat']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="telepon">Telepon</label>
                            <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $dk['telepon']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control" name="type">
                                <option value="">-- Pilih Type Karyawan --</option>
                                <?php foreach ($type as $tp) : ?>
                                    <?php if ($tp == $dk['type']) : ?>
                                        <option value="<?= $tp; ?>" selected><?= $tp ?></option>
                                    <?php else : ?>
                                        <option value="<?= $tp; ?>"><?= $tp ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- modal footer  -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        var gaji<?= $dk['id_karyawan']; ?> = document.getElementById('gaji<?= $dk['id_karyawan']; ?>');
        gaji<?= $dk['id_karyawan']; ?>.addEventListener('keyup', function(e) {
            gaji<?= $dk['id_karyawan']; ?>.value = formatRupiah(this.value, 'Rp ');
        });
    </script>
<?php endforeach; ?>


<!-- Modal Hapus -->
<?php foreach ($datakaryawan as $dk) : ?>
    <div class="modal fade" id="modal-sm<?= $dk['id_karyawan']; ?>" tabindek="-1" role+dialog">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url() ?>master/DataKaryawan/hapus/<?= $dk['id_karyawan'] ?>" type="submit" class="btn" style="background-color: #8b0000; color: white;">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>
<!-- akhir modal hapus -->

<!-- Modal Hapus -->
<div class="modal fade" id="importDataKaryawan" tabindek="-1" role+dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/DataKaryawan/import') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="import" name="import" accept=".xlsx,.xls">
                            <label class="custom-file-label" for="import">Choose file</label>
                        </div>
                    </div>
                    <!-- modal footer  -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn" style="background-color: #8b0000; color:white;">Import</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- akhir modal hapus -->

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


    var gaji = document.getElementById('gaji');
    gaji.addEventListener('keyup', function(e) {
        gaji.value = formatRupiah(this.value, 'Rp ');
    });

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
    }
</script>