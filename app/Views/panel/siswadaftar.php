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
                        <a href="<?= base_url('panel/siswatambah') ?>" class="btn btn-primary mb-4">Tambah Data</a>
                    <?php } ?>
                    <form method="post" accept="<?= base_url('panel/siswadaftar') ?>">
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="mb-2">Kelas</label>
                                    <select class="form-control" name="idkelas">
                                        <option value="">Semua</option>
                                        <?php foreach ($kelas as $kelas) { ?>
                                            <option value="<?= $kelas->idkelas ?>"><?= $kelas->kelas ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary text-white" style="margin-top:30px">Cari</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NIS</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">No. HP</th>
                                    <th scope="col">Email</th>
                                    <?php
                                    if (session('level') == 'Admin' || session('level') == 'Guru') { ?>
                                        <th scope="col">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($siswa as $row) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $row->nama; ?></td>
                                        <td><?= $row->nis; ?></td>
                                        <td><?= $row->kelas; ?></td>
                                        <td><?= $row->nohp; ?></td>
                                        <td><?= $row->email; ?></td>
                                        <?php
                                        if (session('level') == 'Admin' || session('level') == 'Guru') { ?>
                                            <td>
                                                <a href="<?= base_url('panel/siswaedit/' . $row->idsiswa) ?>" class="btn btn-warning m-1">Edit</a>
                                                <a href="<?= base_url('panel/siswahapus/' . $row->idsiswa) ?>" class="btn btn-danger m-1" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
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