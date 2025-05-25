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
                    <form action="<?= base_url('panel/kegiatansekolahtambah') ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="namakegiatan">Nama Kegiatan</label>
                            <input type="text" class="form-control" id="namakegiatan" name="namakegiatan" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal Kegiatan</label>
                            <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="form-group">
                            <label for="lokasi">Lokasi Kegiatan</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Kegiatan</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary float-right" name="tambah">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('deskripsi');
</script>
<?= $this->endSection(); ?>