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
                        <a href="<?= base_url('panel/kegiatansekolahtambah') ?>" class="btn btn-primary mb-4">Tambah Kegiatan</a>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Kegiatan</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Lokasi</th>
                                    <?php
                                    if (session('level') == 'Admin' || session('level') == 'Guru') { ?>
                                        <th scope="col">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($kegiatansekolah as $row) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $row->namakegiatan; ?></td>
                                        <td><?= $row->deskripsi; ?></td>
                                        <td><?= date('d-m-Y H:i', strtotime($row->tanggal)); ?></td>
                                        <td><?= $row->lokasi; ?></td>
                                        <?php
                                        if (session('level') == 'Admin' || session('level') == 'Guru') { ?>
                                            <td>
                                                <a href="<?= base_url('panel/kegiatansekolahedit/' . $row->idkegiatansekolah) ?>" class="btn btn-warning m-1">Edit</a>
                                                <a href="<?= base_url('panel/kegiatansekolahhapus/' . $row->idkegiatansekolah) ?>" class="btn btn-danger m-1" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Kegiatan?')">Hapus</a>
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