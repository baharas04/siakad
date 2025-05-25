<?= $this->extend('panel/templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mt-4">
                <div class="card-body">
                    <h4 class="card-title"><?= $title ?></h4>
                    <?php
                    if (session('level') == 'Admin' || session('level') == 'Guru') { ?>
                        <a href="<?= base_url('panel/matapelajarantambah') ?>" class="btn btn-primary mb-4">Tambah Data</a>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Mata Pelajaran</th>
                                    <?php
                                    if (session('level') == 'Admin' || session('level') == 'Guru') { ?>
                                        <th scope="col">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($matapelajaran as $row) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $row->matapelajaran; ?></td>
                                        <?php
                                        if (session('level') == 'Admin' || session('level') == 'Guru') { ?>
                                            <td>
                                                <a href="<?= base_url('panel/matapelajaranedit/' . $row->idmatapelajaran) ?>" class="btn btn-warning m-1">Edit</a>
                                                <a href="<?= base_url('panel/matapelajaranhapus/' . $row->idmatapelajaran) ?>" class="btn btn-danger m-1" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>