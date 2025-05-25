<?= $this->extend('panel/templates/index'); ?>
<?= $this->section('page-content'); ?>
<?php
$this->db = db_connect();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mt-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                </div>
                <div class="card-body">
                    <h4 class="card-title"><?= $title ?></h4>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered" id="tabel">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Guru</th>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Mata Pelajaran</th>
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
                                    $guru = $this->db->table('pengguna')->where('idpengguna', $data->idguru_pengguna)->get()->getRow();

                                ?>

                                    <td><?= $nomor; ?></td>
                                    <td><?= $data->judul; ?></td>
                                    <td><?= $guru->nama; ?></td>
                                    <td>
                                        <br>
                                        Waktu Mulai : <?= tanggal(date("Y-m-d", strtotime($data->waktumulai))) . ' ' . date("H:i", strtotime($data->waktumulai)); ?>
                                        <br>
                                        Waktu Akhir : <?= tanggal(date("Y-m-d", strtotime($data->waktuakhir))) . ' ' . date("H:i", strtotime($data->waktuakhir)); ?>
                                    </td>
                                    <td><?= $data->matapelajaran; ?></td>
                                    <td><?= $data->nilai; ?></td>
                                    <td><?= $data->benar; ?></td>
                                    <td><?= $data->salah; ?></td>
                                    <td><?= tanggal(date('Y-m-d', strtotime($data->waktu))) . ' ' . date('H:i', strtotime($data->waktu)); ?></td>
                                    <td>
                                        <a href="<?= base_url('panel/ujianhasiljawaban/' . $data->idjawaban . '/' . $data->idkuis) ?>" class="btn btn-success m-1">Jawaban</a>
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