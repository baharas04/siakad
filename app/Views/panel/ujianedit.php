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
                    <form action="<?= base_url('panel/ujianedit/' . $id) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control" name="judul" value="<?= $row->judul ?>" placeholder="Judul Ujian" required>
                        </div>
                        <?php
                        if (session('level') == 'Admin') {
                        ?>
                            <div class="form-group">
                                <label>Guru</label>
                                <select class="form-control" name="idguru_pengguna" required>
                                    <option value="">Pilih Guru</option>
                                    <?php foreach ($guru as $guru) { ?>
                                        <option <?php if ($guru->idpengguna == $row->idguru_pengguna) echo 'selected'; ?> value="<?= $guru->idpengguna ?>"><?= $guru->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php }
                        ?>
                        <?php
                        if (session('level') == 'Guru') {
                        ?>
                            <input type="hidden" class="form-control" name="idguru_pengguna" value="<?= $row->idguru_pengguna ?>" required>
                        <?php }
                        ?>
                        <div class="form-group">
                            <label>Ujian Kelas</label>
                            <select class="form-control" name="kelas" required>
                                <option value="">Pilih Kelas</option>
                                <?php foreach ($kelas as $kelas) { ?>
                                    <option <?php if ($row->idkelas == $kelas->idkelas) echo 'selected'; ?> value="<?= $kelas->idkelas ?>"><?= $kelas->kelas ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <select class="form-control" name="matapelajaran" required>
                                <option value="">Pilih Kelas</option>
                                <?php foreach ($matapelajaran as $matapelajaran) { ?>
                                    <option <?php if ($matapelajaran->matapelajaran == $row->matapelajaran) echo 'selected'; ?> value="<?= $matapelajaran->matapelajaran ?>"><?= $matapelajaran->matapelajaran ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Waktu Mulai Ujian</label>
                            <input type="datetime-local" class="form-control" name="waktumulai" value="<?= date("Y-m-d H:i", strtotime($row->waktumulai)) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Waktu Akhir Ujian</label>
                            <input type="datetime-local" class="form-control" name="waktuakhir" value="<?= date("Y-m-d H:i", strtotime($row->waktuakhir)) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="isi" id="isi" rows="10"><?= $row->isi ?></textarea>
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

    <div class="row">
        <div class="col">
            <div class="card shadow mt-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Soal</h6>
                </div>
                <div class="card-body">
                    <a href="#" data-toggle="modal" data-target="#tambahkuis" class="btn btn-primary">Tambah Soal</a>
                    <div class="modal fade" id="tambahkuis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Soal</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="<?= base_url('panel/soaltambah/' . $id) ?>" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label><span class="text-danger">*</span>Soal</label>
                                            <textarea name="soal" value="" class="form-control" id="soal"></textarea>
                                            <script>
                                                CKEDITOR.replace('soal');
                                            </script>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><span class="text-danger">*</span>Jawaban A</label>
                                                    <input type="text" name="a" value="" class="form-control" id="a" />
                                                </div>
                                                <div class="form-group">
                                                    <label><span class="text-danger">*</span>Jawaban B</label>
                                                    <input type="text" name="b" value="" class="form-control" id="b" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><span class="text-danger">*</span>Jawaban C</label>
                                                    <input type="text" name="c" value="" class="form-control" id="c" />
                                                </div>
                                                <div class="form-group">
                                                    <label><span class="text-danger">*</span>Jawaban D</label>
                                                    <input type="text" name="d" value="" class="form-control" id="d" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><span class="text-danger">*</span>Kunci Jawaban</label>
                                            <select name="kunci" value="" class="form-control" id="kunci">
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label><span class="text-danger">*</span>Bobot Soal</label>
                                            <input type="number" name="bobot" value="" class="form-control bobot" required>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary float-right pull-right" type="submit" name="tambah" value="tambah">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered" id="tabel">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col" style="width:100px !important">Soal</th>
                                    <th scope="col">A</th>
                                    <th scope="col">B</th>
                                    <th scope="col">C</th>
                                    <th scope="col">D</th>
                                    <th scope="col">Kunci</th>
                                    <th scope="col">Bobot</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($soal as $soal) : ?>
                                    <td><?php echo $i; ?></td>
                                    <td width="150px"><?php echo $soal->soal ?></td>
                                    <td><?php echo $soal->a ?></td>
                                    <td><?php echo $soal->b ?></td>
                                    <td><?php echo $soal->c ?></td>
                                    <td><?php echo $soal->d ?></td>
                                    <td><?php echo $soal->kunci ?></td>
                                    <td><?php echo $soal->bobot ?></td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#edit<?= $i ?>" class="btn btn-warning btn-sm m-1">Edit Soal</a>
                                        <a href="<?= base_url('panel/soalhapus/' . $soal->idsoal) ?>"" class=" btn btn-danger btn-sm m-1" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?')">Hapus</a>
                                    </td>
                                    </tr>
                                    <div class="modal fade" id="edit<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Soal</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="<?= base_url('panel/soaledit') ?>" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label><span class="text-danger">*</span>Soal <?= $i ?></label>
                                                            <textarea name="soal" value="" class="form-control" id="soal<?= $i ?>"><?= $soal->soal ?></textarea>
                                                            <input type="hidden" name="idsoal" class="form-control" value="<?= $soal->idsoal ?>">
                                                            <input type="hidden" name="idkuis" class="form-control" value="<?= $soal->idkuis ?>">
                                                            <script>
                                                                CKEDITOR.replace('soal<?= $i ?>');
                                                            </script>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label><span class="text-danger">*</span>Jawaban A</label>
                                                                    <input type="text" name="a" value="<?= $soal->a ?>" class="form-control" id="a" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label><span class="text-danger">*</span>Jawaban B</label>
                                                                    <input type="text" name="b" value="<?= $soal->b ?>" class="form-control" id="b" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label><span class="text-danger">*</span>Jawaban C</label>
                                                                    <input type="text" name="c" value="<?= $soal->c ?>" class="form-control" id="c" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label><span class="text-danger">*</span>Jawaban D</label>
                                                                    <input type="text" name="d" value="<?= $soal->d ?>" class="form-control" id="d" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label><span class="text-danger">*</span>Kunci Jawaban</label>
                                                            <select name="kunci" value="" class="form-control" id="kunci">
                                                                <option <?php if ($soal->kunci == 'A') echo 'selected'; ?> value="A">A</option>
                                                                <option <?php if ($soal->kunci == 'B') echo 'selected'; ?> value="B">B</option>
                                                                <option <?php if ($soal->kunci == 'C') echo 'selected'; ?> value="C">C</option>
                                                                <option <?php if ($soal->kunci == 'D') echo 'selected'; ?> value="D">D</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label><span class="text-danger">*</span>Bobot Soal</label>
                                                            <input type="number" name="bobot" value="<?= $soal->bobot ?>" class="form-control bobot" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <button class="btn btn-primary float-right pull-right" type="submit" name="edit" value="edit">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php $i++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const bobotInputs = document.querySelectorAll(".bobot");
    bobotInputs.forEach((input, index) => {
        input.addEventListener("input", function() {
            const value = this.value;
            if (value.length > 2) {
                this.value = value.slice(0, 2);
            } else {}
        });
    });
</script>
<?= $this->endSection(); ?>