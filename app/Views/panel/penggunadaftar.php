<?= $this->extend('panel/templates/index'); ?>

<?= $this->section('page-content'); ?>


<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mt-4">
                <div class="card-header bg-dark py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-white"><?= $title ?></h6>
                </div>
                <div class="card-body">
                    <a href="<?= base_url('panel/penggunatambah') ?>" class="btn btn-primary mb-4">Tambah Data</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">No. HP</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($pengguna as $row) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $row->nama; ?></td>
                                        <td><?= $row->nohp; ?></td>
                                        <td><?= $row->email; ?></td>
                                        <td><?= $row->level; ?></td>
                                        <td>
                                            <?php
                                            if (session('idpengguna') != $row->idpengguna) {
                                            ?>
                                                <a href="<?= base_url('panel/penggunaedit/' . $row->idpengguna) ?>" class="btn btn-warning m-1">Edit</a>
                                                <a href="<?= base_url('panel/penggunahapus/' . $row->idpengguna) ?>" class="btn btn-danger m-1" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
                                            <?php } ?>
                                        </td>
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