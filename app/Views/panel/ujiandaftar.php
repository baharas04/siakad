<?= $this->extend('panel/templates/index'); ?>
<?= $this->section('page-content'); ?>
<?php
$this->db = db_connect();
$idpengguna = session('idpengguna');
if (session('level') == 'Siswa') {
    $siswa = $this->db->table('siswa')->where('idpengguna', $idpengguna)->get()->getRow();
    $idsiswa = $siswa->idsiswa;
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <?php
            $level = session()->get('level');
            if ($level == 'Admin' or $level == 'Guru' or $level == 'Pimpinan') { ?>
                <div class="card shadow mt-4">
                    <div class="card-body">
                        <h4 class="card-title"><?= $title ?></h4>
                        <?php
                        if (session('level') == 'Admin' || $level == 'Guru') { ?>
                            <a href="<?= base_url('panel/ujiantambah') ?>" class="btn btn-primary mb-4">Tambah Data</a>
                        <?php } ?>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tabel">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Guru</th>
                                        <th scope="col">Waktu</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Mata Pelajaran</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($ujian as $row) : ?>
                                        <tr>
                                            <th scope="row"><?= $i++ ?></th>
                                            <td><?= $row->nama; ?></td>
                                            <td>
                                                <br>
                                                Waktu Mulai : <?= tanggal(date("Y-m-d", strtotime($row->waktumulai))) . ' ' . date("H:i", strtotime($row->waktumulai)); ?>
                                                <br>
                                                Waktu Akhir : <?= tanggal(date("Y-m-d", strtotime($row->waktuakhir))) . ' ' . date("H:i", strtotime($row->waktuakhir)); ?>
                                            </td>
                                            <td><?= $row->kelas; ?></td>
                                            <td><?= $row->matapelajaran; ?></td>
                                            <td><?= $row->judul; ?></td>
                                            <td>
                                                <a href="<?= base_url('panel/ujianpenjawabcetak/' . $row->idkuis) ?>" class="btn btn-success m-1">Download Laporan Hasil Ujian</a>
                                                <a href="<?= base_url('panel/ujianpenjawab/' . $row->idkuis) ?>" class="btn btn-info m-1">Data Penjawab</a>
                                                <?php
                                                if (session('level') == 'Admin' or $level == 'Guru') { ?>
                                                    <a href="<?= base_url('panel/ujianedit/' . $row->idkuis) ?>" class="btn btn-warning m-1">Edit</a>
                                                    <a href="<?= base_url('panel/ujianhapus/' . $row->idkuis) ?>" class="btn btn-danger m-1" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if ($level == 'Siswa') { ?>
                <div class="card shadow mt-4">
                    <div class="card-body">
                        <h4 class="card-title"><?= $title ?></h4>
                        <?php if (!empty($kuis)) { ?>
                            <?php foreach ($kuis as $row) : ?>
                                <div class="card mb-5">
                                    <img class="card-img" src="<?= base_url('assets/') ?>foto/atas.webp" style="height: 250px;width:100%" alt="Bologna">
                                    <div class="card-img-overlay text-white d-flex flex-column justify-content-center">
                                        <h3 class="card-subtitle text-white mb-3"><?= $row->judul ?></h3>
                                        <div class="text-danger mb-3">
                                            Waktu Mulai : <?= tanggal(date("Y-m-d", strtotime($row->waktumulai))) . ' ' . date("H:i", strtotime($row->waktumulai)); ?>
                                            <br>
                                            Waktu Akhir : <?= tanggal(date("Y-m-d", strtotime($row->waktuakhir))) . ' ' . date("H:i", strtotime($row->waktuakhir)); ?>
                                        </div>
                                        <div class="card-text"><?php echo wordlimiter($row->isi, 10); ?></div>
                                        <a href="<?= base_url('panel/cetakkartuujian/' . $row->idkuis) ?>" class="btn btn-info ">Cetak Kartu Ujian</a>
                                        <?php
                                        $cekjawaban = count($this->db->table('jawaban')->where('idkuis', $row->idkuis)->where('idsiswa', $idsiswa)->get()->getResult());
                                        if ($cekjawaban == 0) {
                                            $waktu = date('Y-m-d H:i:s');
                                            if ($waktu > $row->waktuakhir) {
                                        ?>
                                                <a href="#" class="btn btn-secondary text-white">Ujian telah berakhir</a>
                                                <a href="<?= base_url('panel/ujianjawab/' . $row->idkuis) ?>" class="btn btn-success text-white">Jawab Ujian</a>
                                            <?php } else { ?>
                                                <div class="mulai" id="mulai-<?= $row->idkuis ?>" style="display: none;">
                                                    <a href="<?= base_url('panel/ujianjawab/' . $row->idkuis) ?>" class="btn btn-success text-white">Jawab Ujian</a>
                                                </div>
                                                <button class="btn btn-secondary demo" id="demo-<?= $row->idkuis ?>">Loading</button>
                                                <script>
                                                    var countDownDate<?= $row->idkuis ?> = new Date("<?php echo date("M d, Y H:i:s", strtotime($row->waktumulai)); ?>").getTime();
                                                    var x<?= $row->idkuis ?> = setInterval(function() {
                                                        var now = new Date().getTime();
                                                        var distance = countDownDate<?= $row->idkuis ?> - now;
                                                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                                        document.getElementById("demo-<?= $row->idkuis ?>").innerHTML = "Try Out Dimulai : " + days + " Hari " + hours + " Jam " +
                                                            minutes + " Menit " + seconds + " Detik Lagi";
                                                        document.getElementById("mulai-<?= $row->idkuis ?>").style.display = "none";
                                                        if (distance < 0) {
                                                            clearInterval(x<?= $row->idkuis ?>);
                                                            document.getElementById("demo-<?= $row->idkuis ?>").style.display = "none";
                                                            document.getElementById("mulai-<?= $row->idkuis ?>").style.display = "block";
                                                        }
                                                    }, 1000);
                                                </script>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <a href="<?= base_url('panel/ujianjawab/' . $row->idkuis)  ?>" class="btn btn-success text-white">Lihat hasil ujian</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php } else { ?>
                            <div class="single_blog">
                                <div class="single_blog_img">
                                    <a href="#"><img src="<?= base_url('assets/') ?>foto/kosong.jpg" width="100%"></a>
                                    <div class="blog_date text-center">
                                    </div>
                                    <div class="blog_content">
                                        <h4 class="post_title"><a href="#">Ujian Kosong</a></h4>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>