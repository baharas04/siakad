<?= $this->extend('panel/templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            <div class="card shadow">
                <img src="<?= base_url('foto/' . $row->foto) ?>" class="card-img-top" alt="prestasi" style="height: 300px; object-fit: cover;">
                <div class="card-body">
                    <h3 class="card-title"><?= esc($row->judul); ?></h3>
                    <p class="card-text">
                        <?= nl2br(esc($row->deskripsi)); ?>
                    </p>
                    <p class="card-text"><small class="text-muted">Tanggal: <?= esc($row->tanggal); ?></small></p>
                    <a href="<?= base_url('panel/dashboard') ?>" class="btn btn-secondary mt-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>