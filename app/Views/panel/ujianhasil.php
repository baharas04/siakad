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
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td width="15%">Nama</td>
                                <td>: <?= $jawaban->nama ?></td>
                            </tr>
                            <tr>
                                <td width="15%">NIS</td>
                                <td>: <?= $jawaban->nis ?></td>
                            </tr>
                            <tr>
                                <td width="15%">Nilai</td>
                                <td>: <?= $jawaban->nilai ?></td>
                            </tr>
                            <tr>
                                <td width="15%">Benar</td>
                                <td>: <?= $jawaban->benar ?></td>
                            </tr>
                            <tr>
                                <td width="15%">Salah</td>
                                <td>: <?= $jawaban->salah ?></td>
                            </tr>
                            <tr>
                                <td width="15%">Waktu Submit</td>
                                <td>: <?php echo tanggal(date('Y-m-d', strtotime($jawaban->waktu))) . ' ' . date('H:i', strtotime($jawaban->waktu)) ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>

                    <?php $nomor = 1;
                    foreach ($soal as $data) : ?>
                        <input type="hidden" name="idsoal[]" value="<?php echo $data->idsoal; ?>">
                        <input type="hidden" name="idkuis" value="<?php echo $data->idkuis; ?>">
                        <div class="table-wrap">
                            <table class="table table-striped ujian">
                                <tbody>
                                    <tr>
                                        <td width="5%"><?php echo $nomor ?>.</td>
                                        <td><?php echo $data->soal; ?></td>
                                        <td width="10%"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>A. <input name="pilihan[<?php echo $data->idsoal ?>]" type="radio" <?php if ($data->jawabandetail && $data->jawabandetail->jawaban == 'A') echo 'checked'; ?> value="A" disabled> <?php echo $data->a; ?> </td>
                                        <td>
                                            <?php if ($data->kunci == "A") {
                                                echo '<i class="fa fa-check text-success"></i>';
                                            } else {
                                                echo '<i class="fa fa-times text-danger"></i>';
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>B. <input name="pilihan[<?php echo $data->idsoal ?>]" type="radio" <?php if ($data->jawabandetail && $data->jawabandetail->jawaban == 'B') echo 'checked'; ?> value="B" disabled> <?php echo $data->b; ?></td>
                                        <td>
                                            <?php if ($data->kunci == "B") {
                                                echo '<i class="fa fa-check text-success"></i>';
                                            } else {
                                                echo '<i class="fa fa-times text-danger"></i>';
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>C. <input name="pilihan[<?php echo $data->idsoal ?>]" type="radio" <?php if ($data->jawabandetail && $data->jawabandetail->jawaban == 'C') echo 'checked'; ?> value="C" disabled> <?php echo $data->c; ?>
                                        </td>
                                        <td>
                                            <?php if ($data->kunci == "C") {
                                                echo '<i class="fa fa-check text-success"></i>';
                                            } else {
                                                echo '<i class="fa fa-times text-danger"></i>';
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>D. <input name="pilihan[<?php echo $data->idsoal ?>]" type="radio" <?php if ($data->jawabandetail && $data->jawabandetail->jawaban == 'D') echo 'checked'; ?> value="D" disabled> <?php echo $data->d; ?>
                                        </td>
                                        <td>
                                            <?php if ($data->kunci == "D") {
                                                echo '<i class="fa fa-check text-success"></i>';
                                            } else {
                                                echo '<i class="fa fa-times text-danger"></i>';
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-danger">Bobot Soal : <?= $data->bobot ?></td>
                                    </tr>
                                    <br>
                                </tbody>
                            </table>
                        </div>
                    <?php $nomor++;
                    endforeach ?>
                </div>
            </div>
        </div>
    </div>

</div>


<?= $this->endSection(); ?>