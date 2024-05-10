<div class="container-fluid">

  <div class="card">
    <!-- /.card-header -->
    <div class="card-body">
      <?php if (validation_errors()): ?>
        <div class="alert alert-danger" role="alert">
          <?= validation_errors(); ?>
        </div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('success')): ?>
        <div style="color: green;">
          <?php echo $this->session->flashdata('success'); ?>
        </div>
      <?php endif; ?>


      <form method="POST" action="<?= base_url('Performances/MenilaiDiriSendiri/simpan') ?>">
        <div class="form-group form-group col-md-4">
          <label>Menilai</label>
          <input required type="hidden" readonly value="<?= $user['id_karyawan']; ?>" id="id_karyawan"
            class="form-control" />
          <input required type="text" readonly value="<?= $user['nama_karyawan']; ?>" class="form-control" />
        </div>

        <div class="table-responsive">
          <table id="" class="table table-bordered table-striped">
            <thead style="background-color:  #8b0000; color: white;">
              <tr style="text-align: center;">
                <th style="text-align: center;">No</th>
                <th>Pertanyaan</th>
                <th>Jawaban</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              <?php foreach ($soalkuesioner as $sk): ?>
                <tr>
                  <td style="text-align: center;">
                    <?= $no++ ?>
                  </td>
                  <td>
                    <?= $sk['kuesioner'] ?>
                  </td>
                  <td>
                    <select required name="nilai[<?= $sk['id_kuesioner']; ?>]" class="form-control">
                      <option value="" selected>--Berikan Penilaian--</option>
                      <option value="5">Sangat Baik</option>
                      <option value="4">Baik</option>
                      <option value="3">Cukup</option>
                      <option value="2">Kurang Baik</option>
                      <option value="1">Sangat Kurang Baik</option>
                    </select>
                  </td>
                </tr>
              <?php endforeach; ?>
              <tr>
            </tbody>

          </table>
          <input autocomplete="off" required type="text" name="saran" placeholder="Masukan Saran Anda"
            class="form-control">
          <br>
          <button name="simpan" value="kirim" type="submit" class="btn btn-info">Simpan Penilaian</button>
        </div>
      </form>
    </div>



    <script>
      $(function () {
        var Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 5000
        });
        <?php if ($this->session->flashdata('message')): ?>
          const flashData = <?= json_encode($this->session->flashdata('message')) ?>;
          Toast.fire({
            icon: 'success',
            title: flashData
          })
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
          const flashData = <?= json_encode($this->session->flashdata('error')) ?>;
          Toast.fire({
            icon: 'error',
            title: flashData
          })
        <?php endif; ?>
        <?php if (validation_errors()): ?>
          const flashData = <?= json_encode(validation_errors()) ?>;
          Toast.fire({
            icon: 'error',
            title: flashData
          })
        <?php endif; ?>
      });
    </script>