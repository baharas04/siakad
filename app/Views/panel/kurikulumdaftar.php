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
                        <a href="<?= base_url('panel/kurikulumtambah') ?>" class="btn btn-primary mb-4">Tambah Kurikulum</a>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Kurikulum</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Tanggal</th>
                                    <?php
                                    if (session('level') == 'Admin' || session('level') == 'Guru') { ?>
                                        <th scope="col">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($kurikulum as $row) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $row->namakurikulum; ?></td>
                                        <td><?= $row->deskripsi; ?></td>
                                        <td><?= $row->updated_at; ?></td>
                                        <?php
                                        if (session('level') == 'Admin' || session('level') == 'Guru') { ?>
                                            <td>
                                                <a href="<?= base_url('panel/kurikulumedit/' . $row->idkurikulum) ?>" class="btn btn-warning m-1">Edit</a>
                                                <a href="<?= base_url('panel/kurikulumhapus/' . $row->idkurikulum) ?>" class="btn btn-danger m-1" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Kurikulum?')">Hapus</a>
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