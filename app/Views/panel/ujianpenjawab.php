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
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" name="judul" value="<?= $kuis->judul ?>" placeholder="Judul Ujian" readonly>
                    </div>
                    <div class="form-group">
                        <label>Ujian Kelas</label>
                        <input type="text" class="form-control" name="kelas" value="<?= $kuis->kelas ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Waktu Mulai Ujian</label>
                        <input type="datetime-local" class="form-control" name="waktumulai" value="<?= $kuis->waktumulai ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Waktu Akhir Ujian</label>
                        <input type="datetime-local" class="form-control" name="waktuakhir" value="<?= $kuis->waktuakhir ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" name="isi" id="isi" rows="10" readonly><?= $kuis->isi ?></textarea>
                        <script>
                            CKEDITOR.replace('isi');
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card shadow mt-4">
                <div class="card-body">
                    <a href="<?= base_url('panel/ujianpenjawabcetak/' . $kuis->idkuis) ?>" class="btn btn-success float-right btn-sm m-1 mb-4">Download Laporan Hasil Ujian</a>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered" id="tabel">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NIS</th>
                                    <th scope="col">Nilai</th>
                                    <th scope="col">Benar</th>
                                    <th scope="col">Salah</th>
                                    <th scope="col">Waktu Submit</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor = 1;
                                foreach ($jawaban as $data) :
                                ?>

                                    <td><?= $nomor; ?></td>
                                    <td><?= $data->nama; ?></td>
                                    <td><?= $data->nis; ?></td>
                                    <td><?= $data->nilai; ?></td>
                                    <td><?= $data->benar; ?></td>
                                    <td><?= $data->salah; ?></td>
                                    <td><?= tanggal(date('Y-m-d', strtotime($data->waktu))) . ' ' . date('H:i', strtotime($data->waktu)); ?></td>
                                    <td>
                                        <a href="<?= base_url('panel/ujianhasiljawaban/' . $data->idjawaban . '/' . $kuis->idkuis) ?>" class="btn btn-success m-1">Jawaban</a>
                                        <a href="<?= base_url('panel/ujianjawabanhapus/' . $data->idjawaban . '/' . $kuis->idkuis) ?>" class="btn btn-danger m-1" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
                                    </td>

                                <?php
                                    $nomor++;
                                endforeach
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>