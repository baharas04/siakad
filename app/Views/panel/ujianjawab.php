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
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Soal</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= base_url('panel/ujianjawabsimpan/') ?>" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <?php $nomor = 1;
                        shuffle($soal);
                        foreach ($soal as $data) : ?>
                            <?= form_hidden('idsoal[]', $data->idsoal) ?>
                            <?= form_hidden('idkuis', $data->idkuis) ?>
                            <div class="table-responsive">
                                <table class="table table-striped ujian">
                                    <tbody id="questionTable<?= $nomor ?>">
                                        <tr>
                                            <td width="10px"><?= $nomor ?>.</td>
                                            <td><?= $data->soal ?></td>
                                        </tr>
                                        <?php
                                        $options = [
                                            ['A', $data->a],
                                            ['B', $data->b],
                                            ['C', $data->c],
                                            ['D', $data->d]
                                        ];

                                        shuffle($options);
                                        $angka = 1;
                                        foreach ($options as $option) {
                                        ?>
                                            <tr>
                                                <td></td>
                                                <td><?= chr($angka + 64); ?>. <?= form_radio('pilihan[' . $data->idsoal . ']', $option[0], false, 'required') ?> <?= $option[1] ?></td>
                                            </tr>
                                        <?php
                                            $angka++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <br>
                        <?php
                            $nomor++;
                        endforeach; ?>
                        <div class="mulai" style="display: none;">
                        </div>
                        <?php
                        if ($nomor >= 2) { ?>
                            <div class="simpan">
                                <button class="btn btn-secondary demo">Loading</button>
                                <p class="text-danger mt-3 mb-2">
                                    Harap menekan tombol simpan sebelum waktu habis, jika waktu ujian telah habis tombol simpan akan hilang, dan jawaban anda tidak tersimpan</p>
                                </p>

                            </div>
                        <?php } ?>
                        <button type="submit" class="btn btn-primary btn-block" name="simpan" value="simpan" onclick="return confirm('Apakah anda yakin ingin mengsubmit jawaban ? Jawaban yang telah di submit tidak dapat dirubah kembali')">Simpan</button>
                        <?php
                        $php_date = $kuis->waktuakhir;
                        $js_date = date("M d, Y H:i:s", strtotime($php_date));
                        ?>
                        <script>
                            var countDownDate = new Date("<?php echo $js_date; ?>").getTime();
                            var x = setInterval(function() {
                                var now = new Date().getTime();
                                var distance = countDownDate - now;
                                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                document.querySelector(".demo").innerHTML = "Batas Simpan Ujian Tersisa : " + days + " Hari " + hours + " Jam " +
                                    minutes + " Menit " + seconds + " Detik Lagi";
                                document.querySelector(".mulai").style.display = "none";
                                if (distance < 0) {
                                    clearInterval(x);
                                    document.querySelector(".demo").style.display = "none";
                                    document.querySelector(".mulai").style.display = "block";
                                    document.querySelector(".simpan").style.display = "none";
                                } else {

                                }
                            }, 1000);
                        </script>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>