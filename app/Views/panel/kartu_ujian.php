<!DOCTYPE html>
<html>

<head>
    <title>Kartu Ujian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .kartu-ujian {
            border: 1px solid #000;
            padding: 20px;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .details {
            margin-bottom: 20px;
        }

        .details div {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="kartu-ujian">
        <div class="header">
            <h1>Kartu Ujian</h1>
        </div>
        <div class="details">
            <div><strong>ID:</strong> <?= $id_ujian ?></div>
            <div><strong>Nama:</strong> <?= $siswa->nama ?></div>
            <div><strong>Kelas:</strong> <?= $siswa->kelas ?></div>
            <div><strong>Mata Pelajaran:</strong> <?= $kuis->matapelajaran ?></div>
            <div><strong>Judul Ujian:</strong> <?= $kuis->judul ?></div>
            <div><strong>Waktu Ujian:</strong> <?= $waktu_ujian ?></div>
        </div>
    </div>
</body>

</html>