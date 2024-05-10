<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead style="background-color: #8b0000; color: #ffffff;">
                    <tr style="text-align: center;">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Posisi</th>
                        <th>Email</th>
                        <th>File CV</th>
                        <th>Nomor Telepon</th>
                        <th>Hasil Interview</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($pelamar as $ds) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $ds['nama']; ?></td>
                            <?php foreach ($dataposisi as $dp) : ?>
                                <?php if ($dp['id_posisi'] == $ds['id_pekerjaan']) : ?>
                                    <td><?= $dp['nama_posisi']; ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <td><?= $ds['email']; ?></td>
                            <td><a href="<?php echo base_url('Recruitment/Pelamar/download_file/' . $ds['file_cv']); ?>"><span class="glyphicon glyphicon-download-alt">Download CV</a></td>
                            <td><?= $ds['telepon']  ?></td>
                            <td><a href="<?php echo base_url('Recruitment/Pelamar/download_hasil/' . $ds['hasil_interview']); ?>"><span class="glyphicon glyphicon-download-alt">Hasil Interview</a></td>
                            <td><?= $ds['status']; ?></td>
                            <td>
                                <?php if ($ds['status'] == 'pelamar') : ?>
                                    <button class="badge badge-success" data-toggle="modal" data-target="#interviewModal<?= $ds['id_pelamar']; ?>"><i class="fas fa-paper-plane"></i> Jadwalkan Interview</button>
                                <?php elseif ($ds['status'] == 'Proses Interview') : ?>
                                    <button class="badge" data-toggle="modal" style="background-color: 	#000080; color: antiquewhite" data-target="#jadwalModal<?= $ds['id_pelamar']; ?>"><i class="fas fa-calendar-alt"></i>Lihat Jadwal Interview</button>
                                    <button class="badge badge-warning" data-toggle="modal" data-target="#hasilModal<?= $ds['id_pelamar']; ?>"><i class="fas fa-paper-plane"></i>Hasil Interiview</button>
                                <?php elseif ($ds['status'] == 'lulus') : ?>
                                    <button class="badge" style="background-color: 	#353a57; color: antiquewhite" data-toggle="modal" data-target="#soalModal<?= $ds['id_pelamar']; ?>"><i class="fas fa-paper-plane"></i> Kirim Soal</button>
                                <?php elseif ($ds['status'] == 'Proses Pengerjaan Soal') : ?>
                                    <button class="badge" style="background-color: 	#135e96; color: #ffffff" data-toggle="modal" data-target="#nilaiModal<?= $ds['id_pelamar']; ?>"><i class="fas fa-pen"></i> Beri Nilai</button>
                                <?php endif; ?>
                                <button type="button" class="badge" style="background-color: #cc0000; color: antiquewhite" data-toggle="modal" data-target="#modal-sm<?= $ds['id_pelamar'] ?>"><i class="fas fa-trash-alt"></i>hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>



<!-- Modal Hapus -->
<?php foreach ($pelamar as $ds) : ?>
    <div class="modal fade" id="modal-sm<?= $ds['id_pelamar']; ?>" tabindek="-1" role+dialog">
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
                    <a href="<?= base_url() ?>Recruitment/pelamar/hapus/<?= $ds['id_pelamar'] ?>" type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>
<!-- akhir modal hapus --






<!-- Modal kirim slip -->
<?php foreach ($pelamar as $ds) : ?>
    <div class="modal fade" id="interviewModal<?= $ds['id_pelamar']; ?>" tabindex="-1" aria-labelledby="interviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="interviewModalLabel">Jadwalkan Interview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('Recruitment/Pelamar/interview/' . $ds['id_pelamar']) ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="email" id="email" value="<?= $ds['email']; ?>">
                        <input type="hidden" name="id_pekerjaan" value="<?= $ds['id_pekerjaan']; ?>">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Interview</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                        </div>
                        <div class="form-group">
                            <label for="mulai">Jam Mulai:</label>
                            <input type="time" id="mulai" name="mulai" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="akhir">Jam Berakhir:</label>
                            <input type="time" id="akhir" name="akhir" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="gmeet">Link Interview</label>
                            <input type="text" class="form-control" id="gmeet" name="gmeet">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Kirim</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<?php foreach ($pelamar as $ds) : ?>
    <!-- Modal jadwal -->
    <div class="modal fade" id="jadwalModal<?= $ds['id_pelamar']; ?>" tabindex="-1" aria-labelledby="jadwalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jadwalModalLabel">Lihat Jadwal Interview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('Recruitment/Pelamar/interview/' . $ds['id_pelamar']) ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="email" id="email" value="<?= $ds['email']; ?>">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Interview</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $ds['tanggal_interview']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="mulai">Jam Mulai:</label>
                            <input type="time" id="mulai" name="mulai" class="form-control" value="<?= $ds['jam_mulai']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="akhir">Jam Berakhir:</label>
                            <input type="time" id="akhir" name="akhir" class="form-control" value="<?= $ds['jam_berakhir']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="gmeet">Link Google Meet</label>
                            <input type="text" class="form-control" id="gmeet" name="gmeet" value="<?= $ds['link_interview']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>


                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<?php foreach ($pelamar as $ds) : ?>
    <!-- Modal kirim Soal -->
    <div class="modal fade" id="soalModal<?= $ds['id_pelamar']; ?>" tabindex="-1" aria-labelledby="soalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="soalModalLabel">Kirim Soal Tes </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('Recruitment/Pelamar/soal/' . $ds['id_pelamar']) ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="email" id="email" value="<?= $ds['email']; ?>">
                        <input type="hidden" name="id_pekerjaan" value="<?= $ds['id_pekerjaan']; ?>">
                        <div class="form-group">
                            <label>Posisi</label>
                            <select class="form-control" id="posisi" name="posisi">
                                <option>-- Pilih Posisi --</option>
                                <?php foreach ($dataposisi as $dp) : ?>
                                    <option value="<?= $dp['id_posisi']; ?>"><?= $dp['nama_posisi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pg">Soal PG (Link)</label>
                            <input type="text" class="form-control" id="pg" name="pg">
                        </div>
                        <div class="form-group">
                            <label for="essay">Soal Tes (File)</label>
                            <input type="file" class="form-control" id="essay" name="essay">
                        </div>
                        <div class="form-group">
                            <label for="linkuploadjawaban">Link Upload Jawaban</label>
                            <input type="text" class="form-control" name="linkuploadjawaban">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Kirim</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>







<?php foreach ($pelamar as $ds) : ?>
    <!-- Modal kirim Nilai -->
    <div class="modal fade" id="nilaiModal<?= $ds['id_pelamar']; ?>" tabindex="-1" aria-labelledby="nilaiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="soalModalLabel">Beri nilai dan Surat diterima/ ditolak </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('Recruitment/Pelamar/nilai/' . $ds['id_pelamar']) ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="email" id="email" value="<?= $ds['email']; ?>">
                        <input type="hidden" name="id" id="email" value="<?= $ds['id_pelamar']; ?>">
                        <input type="hidden" name="id_pekerjaan" value="<?= $ds['id_pekerjaan']; ?>">
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select id="status<?= $ds['id_pelamar']; ?>" name="status<?= $ds['id_pelamar']; ?>" class="form-control" onchange="changeStatus<?= $ds['id_pelamar']; ?>()">
                                <option value="diterima">Diterima</option>
                                <option value="ditolak" selected>Ditolak</option>
                            </select>
                        </div>
                        <div id="nilai<?= $ds['id_pelamar']; ?>">

                        </div>
                        <script>
                            function clear<?= $ds['id_pelamar']; ?>() {
                                const nilai = document.getElementById('nilai<?= $ds['id_pelamar']; ?>');
                                nilai.textContent = '';
                            }

                            function changeStatus<?= $ds['id_pelamar']; ?>() {
                                var e = document.getElementById('status<?= $ds['id_pelamar']; ?>');
                                const nilai = document.getElementById('nilai<?= $ds['id_pelamar']; ?>');
                                console.log(nilai);
                                if (e.value == 'ditolak') {
                                    clear<?= $ds['id_pelamar']; ?>();
                                    const node = document.createElement('div');
                                    node.innerHTML = `
                                    <div class="form-group">
                                        <label for="pg">Nilai pg:</label>
                                        <input type="text"  name="nilaipg" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="nilaites">Nilai Tes :</label>
                                        <input type="text"  name="nilaites" class="form-control">
                                    </div>
        
                                    <div class="form-group">
                                        <label for="berkas">Upload Berkas (penolakan):</label>
                                        <input type="file" id="berkas" name="berkas" class="form-control">
                                    </div>`;

                                    nilai.appendChild(node);
                                } else if (e.value == 'diterima') {
                                    var e = document.getElementById('status<?= $ds['id_pelamar']; ?>');
                                    clear<?= $ds['id_pelamar']; ?>();
                                    const node = document.createElement('div');
                                    node.innerHTML = `
                                    <div class="form-group">
                                        <label for="nilaipg">Nilai Pg:</label>
                                        <input type="text" id="nilaipg" name="nilaipg" class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="nilaites">Nilai Tes:</label>
                                        <input type="text" id="nilaites" name="nilaites" class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="berkas">Upload Berkas (diterima):</label>
                                        <input type="file" id="berkas" name="berkas" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="jadwal">Jadwal Bertemu</label>
                                        <input type="date" id="jadwal" name="jadwal" class="form-control">
                                    </div>
                                     <div class="form-group">
                                    <label for="mulai">Jam Mulai:</label>
                                    <input type="time" id="mulai" name="mulai" class="form-control">
                                     </div>
                                     <div class="form-group">
                                    <label for="akhir">Jam Berakhir:</label>
                                    <input type="time" id="akhir" name="akhir" class="form-control">
                                      </div>
                                    
                                    <div class="form-group">
                                        <label for="bertemu">Bertemu dengan:</label>
                                        <input type="text" id="bertemu" name="bertemu" class="form-control">
                                    </div>
                                    `;
                                    nilai.appendChild(node);

                                }
                            }
                            // e.addEventListener('change', changeStatus)
                        </script>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Kirim</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal hasil interview -->
<?php foreach ($pelamar as $ds) : ?>
    <div class="modal fade" id="hasilModal<?= $ds['id_pelamar']; ?>" tabindex="-1" aria-labelledby="hasilModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hasilModalLabel">Hasil Interview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('Recruitment/Pelamar/tambah_hasil_interview/' . $ds['id_pelamar']) ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="email" id="email" value="<?= $ds['email']; ?>">
                        <input type="hidden" name="id" id="email" value="<?= $ds['id_pelamar']; ?>">
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select id="status<?= $ds['id_pelamar']; ?>" name="status<?= $ds['id_pelamar']; ?>" class="form-control" onchange="toggleForm('form<?= $ds['id_pelamar']; ?>', this.value)">
                                <option value="Tidak Lulus">Tidak Lulus</option>
                                <option value="Lulus" selected>Lulus</option>
                            </select>
                        </div>
                        <div id="form<?= $ds['id_pelamar']; ?>"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn" style="background-color: #8b0000; color: #ffffff;">Kirim</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    function toggleForm(id, status) {
        var form = document.getElementById(id);
        if (status == 'Lulus') {
            form.innerHTML = `
      <div class="form-group">
        <label for="hasil_interview">Upload Lulus Interview:</label>
        <input type="file" name="hasil_interview" class="form-control">
      </div>
    `;
        } else if (status == 'Tidak Lulus') {
            form.innerHTML = `
      <div class="form-group">
        <label for="hasil_interview">Upload Tidak Lulus Interview:</label>
        <input type="file" name="hasil_interview" class="form-control">
      </div>
    `;
        }
    }
</script>




<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


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