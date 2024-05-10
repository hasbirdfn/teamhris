<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5">
            <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                    <?php foreach ($dataposisi as $dp): ?>
                        <?php if ($dp['id_posisi'] == $user['id_posisi']): ?>
                            <?= $dp['nama_posisi']; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-7">
                            <h2 class="lead mb-3"><b>
                                    <?= $user['nama_karyawan']; ?>
                                </b></h2>
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small mb-2"><span class="fa-li"><i class="fas fa-envelope"></i></span> Email:
                                    <?= $user['email']; ?>
                                </li>
                                <li class="small mb-2"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                    Alamat:
                                    <?= $user['alamat']; ?>
                                </li>
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telepon:
                                    <?= $user['telepon']; ?>
                                </li>
                            </ul>
                        </div>
                        <div class="col-5 text-center">
                            <img src="<?= base_url('dist/img/profile/') . $user['foto'] ?>" alt="user-avatar"
                                class="img-circle img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <a href="<?= base_url('hris/ubahProfile'); ?>" class="btn btn-sm"
                            style="background-color: #8b0000; color: white;">
                            <i class="fas fa-user-edit"></i> Ubah Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>