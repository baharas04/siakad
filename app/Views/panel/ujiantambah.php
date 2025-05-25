<?= $this->extend('panel/templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mt-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('panel/ujiantambah') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control" name="judul" placeholder="Judul Ujian" required>
                        </div>
                        <?php
                        if (session('level') == 'Admin') {
                        ?>
                            <div class="form-group">
                                <label>Guru</label>
                                <select class="form-control" name="idguru_pengguna" required>
                                    <option value="">Pilih Guru</option>
                                    <?php foreach ($guru as $guru) { ?>
                                        <option value="<?= $guru->idpengguna ?>"><?= $guru->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php }
                        ?>
                        <?php
                        if (session('level') == 'Guru') {
                        ?>
                            <input type="hidden" class="form-control" name="idguru_pengguna" value="<?= session('idpengguna') ?>" required>
                        <?php }
                        ?>
                        <div class="form-group">
                            <label>Ujian Kelas</label>
                            <select class="form-control" name="kelas" required>
                                <option value="">Pilih Kelas</option>
                                <?php foreach ($kelas as $kelas) { ?>
                                    <option value="<?= $kelas->idkelas ?>"><?= $kelas->kelas ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <select class="form-control" name="matapelajaran" required>
                                <option value="">Pilih Kelas</option>
                                <?php foreach ($matapelajaran as $matapelajaran) { ?>
                                    <option value="<?= $matapelajaran->matapelajaran ?>"><?= $matapelajaran->matapelajaran ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Waktu Mulai Ujian</label>
                            <input type="datetime-local" class="form-control" name="waktumulai" value="" required>
                        </div>
                        <div class="form-group">
                            <label>Waktu Akhir Ujian</label>
                            <input type="datetime-local" class="form-control" name="waktuakhir" value="" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="isi" id="isi" rows="10"></textarea>
                            <script>
                                CKEDITOR.replace('isi');
                            </script>
                        </div>
                        <button type="submit" class="btn btn-primary float-right" name="tambah">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>