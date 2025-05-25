<html>
<title>Daftar Penjawab Ujian</title>

</html>
<style>
    table {
        border-color: #04AA6D;
        border: none;
    }

    table tr .text2 {
        text-align: right;
        font-size: 16px;
    }

    table tr .text {
        text-align: center;
        font-size: 16px;
    }

    #table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table tr td {
        font-size: 16px;
        padding: 7px;
    }

    table th {
        background-color: #04AA6D;
        padding-top: 10px;
        padding-bottom: 10px;
        color: white;
    }

    .paragraf {
        line-height: 1.8;
    }
</style>


<div style="padding-left:30px;padding-right:30px">
    <center>
        <h3 class="judul">LAPORAN UJIAN</h3>
    </center>
    <br>
    <table border="0">
        <tr>
            <td>Judul Ujian</td>
            <td>:<?= $kuis->judul ?></td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>:<?= $kuis->kelas ?></td>
        </tr>
        <tr>
            <td>Waktu Mulai</td>
            <td>: <?= tanggal(date("Y-m-d", strtotime($kuis->waktumulai))) . ' ' . date("H:i", strtotime($kuis->waktumulai)); ?>
            </td>
        </tr>
        <tr>
            <td>Waktu Akhir</td>
            <td>: <?= tanggal(date("Y-m-d", strtotime($kuis->waktuakhir))) . ' ' . date("H:i", strtotime($kuis->waktuakhir)); ?>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <table class="table table-hover" id="tabel" width="100%">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama</th>
                <th rowspan="2">NIS</th>
                <th colspan="3">Hasil Ujian</th>
                <th rowspan="2">Waktu Submit</th>
            </tr>
            <tr>
                <th>Benar</th>
                <th>Salah</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($jawaban as $data) : ?>
                <tr>
                    <td><?= $no ?></td>
                    <td>
                        <?= $data->nama ?>
                    </td>
                    <td>
                        <?= $data->nis ?>
                    </td>
                    <td>
                        <?= $data->benar ?>
                    </td>
                    <td>
                        <?= $data->salah ?>
                    </td>
                    <td>
                        <?= $data->nilai ?>
                    </td>
                    <td>
                        <?= tanggal(date('Y-m-d', strtotime($data->waktu))) . ' ' . date('H:i', strtotime($data->waktu)) ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>