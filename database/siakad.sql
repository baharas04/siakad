-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221031.25fe766a26
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2025 at 11:51 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siakad`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `idguru` int(11) NOT NULL,
  `idpengguna` int(11) NOT NULL,
  `nip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`idguru`, `idpengguna`, `nip`) VALUES
(1, 7, '0185918525'),
(2, 8, '123');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `idjawaban` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `idkuis` int(11) NOT NULL,
  `benar` varchar(255) NOT NULL,
  `salah` varchar(255) NOT NULL,
  `nilai` varchar(255) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jawabandetail`
--

CREATE TABLE `jawabandetail` (
  `idjawabandetail` int(11) NOT NULL,
  `idjawaban` int(11) NOT NULL,
  `idsoal` text NOT NULL,
  `jawaban` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatansekolah`
--

CREATE TABLE `kegiatansekolah` (
  `idkegiatansekolah` int(11) NOT NULL,
  `namakegiatan` varchar(250) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `lokasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kegiatansekolah`
--

INSERT INTO `kegiatansekolah` (`idkegiatansekolah`, `namakegiatan`, `deskripsi`, `tanggal`, `lokasi`) VALUES
(1, 'makan paku', '<p>test yuhuuu</p>\r\n', '2024-08-31 09:49:00', 'Jalan Letjen TNI Dr. H. Ibnu Sutowo, Talang Klp., Kecamatan Alang-Alang Lebar, Kota Palembang');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `idkelas` int(11) NOT NULL,
  `kelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`idkelas`, `kelas`) VALUES
(4, '10 IPA 1'),
(5, '10 IPA 2'),
(6, '10 IPA 3'),
(7, '10 IPS 1'),
(8, '10 IPS 2'),
(9, '10 IPS 3');

-- --------------------------------------------------------

--
-- Table structure for table `kuis`
--

CREATE TABLE `kuis` (
  `idkuis` int(11) NOT NULL,
  `idkelas` int(11) NOT NULL,
  `idguru_pengguna` int(11) NOT NULL,
  `matapelajaran` varchar(200) NOT NULL,
  `judul` text NOT NULL,
  `isi` text NOT NULL,
  `waktumulai` datetime NOT NULL,
  `waktuakhir` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kuis`
--

INSERT INTO `kuis` (`idkuis`, `idkelas`, `idguru_pengguna`, `matapelajaran`, `judul`, `isi`, `waktumulai`, `waktuakhir`) VALUES
(8, 4, 8, 'Bahasa Indonesia', 'Ujain Bahasa Indonesia 26 Juni 2023 - Kelas 10 IPA 1', '<p>Harap jawab ujian dengan benar</p>\r\n', '2023-07-08 15:00:00', '2023-07-08 22:30:00'),
(9, 4, 7, 'Matematika', 'Ujian Matematika 26 Juni 2023', '<p>Harap jawab ujian dengan benar</p>\n', '2023-06-26 15:30:00', '2023-06-26 15:50:00'),
(10, 5, 8, 'Bahasa Indonesia', 'Ujain Bahasa Indonesia 26 Juni 2023 - Kelas 10 IPA 2', '<p>Harap jawab ujian dengan benar</p>\n', '2023-06-26 15:00:00', '2023-06-26 16:00:00'),
(12, 4, 7, 'Bahasa Indonesia', 'testing', '<p>adsasd</p>\r\n', '2024-08-31 10:05:00', '2024-09-07 10:05:00'),
(13, 4, 7, 'Bahasa Indonesia', 'Ujian akhir kenaikan kelas', '<p>ini ujian test aja</p>\r\n', '2024-08-31 08:00:00', '2024-09-01 09:00:00'),
(14, 4, 7, 'Bahasa Indonesia', 'testing', '<p>sadsad</p>\r\n', '2024-08-31 16:27:00', '2024-08-31 17:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `kurikulum`
--

CREATE TABLE `kurikulum` (
  `idkurikulum` int(11) NOT NULL,
  `namakurikulum` varchar(250) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kurikulum`
--

INSERT INTO `kurikulum` (`idkurikulum`, `namakurikulum`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Merdeka Belajar', '<p>sadasd</p>\r\n', '2024-08-31 09:36:51', '2024-08-31 09:39:12');

-- --------------------------------------------------------

--
-- Table structure for table `matapelajaran`
--

CREATE TABLE `matapelajaran` (
  `idmatapelajaran` int(11) NOT NULL,
  `matapelajaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matapelajaran`
--

INSERT INTO `matapelajaran` (`idmatapelajaran`, `matapelajaran`) VALUES
(1, 'Bahasa Indonesia'),
(2, 'Bahasa Inggris'),
(3, 'Matematika'),
(4, 'Ilmu Pengetahuan Alam'),
(5, 'Ilmu Pengetahuan Sosial'),
(6, 'Seni Budaya');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `idpengguna` int(11) NOT NULL,
  `nama` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `nohp` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`idpengguna`, `nama`, `email`, `password`, `nohp`, `foto`, `level`) VALUES
(1, 'Administrator', 'admin@gmail.com', 'admin', '0895182951', '', 'Admin'),
(5, 'Jesika', 'jesika@gmail.com', 'jesika', '0895182591', '', 'Siswa'),
(7, 'Yayan S.pd', 'yayan@gmail.com', 'yayan', '0859182951', '', 'Guru'),
(8, 'Amin Setiabudi S.pd', 'amin@gmail.com', 'amin', '08591289521', '', 'Guru'),
(11, 'Budi', 'budi@gmail.com', 'budi', '0895182951', '', 'Siswa'),
(12, 'Dr. Albert', 'pimpinan@gmail.com', 'pimpinan', '08591289521', '', 'Pimpinan');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `idpengumuman` int(11) NOT NULL,
  `judul` text NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`idpengumuman`, `judul`, `tanggal`, `deskripsi`, `foto`) VALUES
(4, 'Pengumuman Libur Semester', '2025-07-01', 'Kami memberitahukan bahwa libur semester akan dimulai pada tanggal 1 Juli 2025 hingga 31 Juli 2025. Semua kegiatan akademik akan dihentikan sementara selama periode ini.', '1745825557_0ec9f3dec6fbd8c052ab.jpeg'),
(5, 'Ujian Tengah Semester (UTS)', '2025-11-05', 'Ujian Tengah Semester (UTS) untuk semua mata pelajaran akan dilaksanakan pada tanggal 5 November 2025 hingga 10 November 2025. Harap mempersiapkan diri dengan baik.', '1745825736_64969b14a53b9e5b3419.png');

-- --------------------------------------------------------

--
-- Table structure for table `prestasi`
--

CREATE TABLE `prestasi` (
  `idprestasi` int(11) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prestasi`
--

INSERT INTO `prestasi` (`idprestasi`, `judul`, `tanggal`, `deskripsi`, `foto`) VALUES
(1, 'Juara 1 Lomba Cerdas Cermat', '2025-04-01', 'Tim siswa kami berhasil meraih Juara 1 dalam Lomba Cerdas Cermat yang diadakan oleh Universitas Islam Negeri Raden Fatah Palembang. Prestasi ini membanggakan sekolah dan kami bangga dengan pencapaian ini.', '1745825849_33dd48f2acb007913957.jpg'),
(2, 'Juara 2 Kompetisi Futsal', '2025-04-29', ' Siswa kami meraih Juara 2 dalam Kompetisi Futsal antar-sekolah tingkat kota yang diselenggarakan pada bulan April 2025. Ini merupakan pencapaian yang luar biasa dan penuh perjuangan.', '1745825915_3f083df72d0c59d69aa6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `idsiswa` int(11) NOT NULL,
  `idpengguna` int(11) NOT NULL,
  `idkelas` int(11) NOT NULL,
  `nis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`idsiswa`, `idpengguna`, `idkelas`, `nis`) VALUES
(1, 5, 4, '02859185'),
(4, 11, 4, '999');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `idsoal` int(11) NOT NULL,
  `idkuis` int(11) NOT NULL,
  `soal` text NOT NULL,
  `a` text NOT NULL,
  `b` text NOT NULL,
  `c` text NOT NULL,
  `d` text NOT NULL,
  `kunci` varchar(255) NOT NULL,
  `bobot` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`idsoal`, `idkuis`, `soal`, `a`, `b`, `c`, `d`, `kunci`, `bobot`) VALUES
(13, 8, '<p>Gedung-gedung puskesmas pada tingkat kecamatan dan kelurahan di wilayah Jakarta Timur berada dalam kondisi yang tidak baik. Banyak di antara gedung-gedung tersebut bangunannya hampir roboh. Sejumlah 53 puskesmas dari 88 bangunan terhitung rusak. Banyak bangunan puskesmas yang pada bagian kusen dan temboknya mulai retak. Ide pokok / Gagasan utama pada paragraf di atas adalah &hellip;</p>\r\n', 'Kerusakan gedung puskesmas', 'Kerusakan bangunan yang disebabkan oleh rayap', 'Banyak bangunan rusak di Jawa Timur', 'Jumlah bangunan yang rusak', 'A', '20'),
(14, 8, '<p>(1) Orang yang suka merokok sangat berpotensi tekena penyakit jantung dan paru-paru. (2) Dampak lain yang berhubungan dengan keturunan yakni berakibat pada kemandulan. (3) Bagi seorang ibu hami, jika dia seorang perokok, maka ia akan mengalami gangguan ada janinnya.(4) Demikianlah bahaya dari merokok.</p>\r\n\r\n<p>Kalimat utama paragraf di atas terletak pada kalimat ke &hellip;</p>\r\n', '(4)', '(1)', '(3)', '(2)', 'A', '20'),
(15, 8, '<p>Seluruh pegolf putri Indonesia yang saat ini telah ikut serta dalam pemusatan pelatihan nasional untuk SEA Games Thailand, di akhir tahun ini mereka menampilkan penampilan yang buruk pada babak pertama turnamen Indonesia Open ke-30 yang dilangsungkan di Dumai Indah Jakarta. Kritikan yang benar pada isi paragraf di atas ialah &hellip;</p>\r\n', 'Seharusnya pegolf tersebut menjaga citra pegolf putri Indonesia jangan sampai berpenampilan buruk bagaimanapun caranya', 'Namanya juga manusia pastilah sekali-kali akan jatuh juga', 'Memang semua pegolf putri selalu berpenampilan buruk', 'Penampilan buruk tersebut wajar karena mereka tampil tanpa persiapan', 'A', '20'),
(16, 8, '<p>Sepak bola adalah cabang olah raga yang telah merakyat di kalangan masyarakat. Permainan olah raga tersebut telah dikenal oleh setiap orang. Sepak bola bukan hanya kegemaran kaum lelaki, kaum wanita juga banyak yang menggemari olah raga ini. Ide pokok dari kutipan paragraf tersebut ialah &hellip;</p>\r\n', 'Olahraga sepak bola', 'Kegemaran laki-laki', 'Keikutsertaan wanita', 'Sepak bola olah raga dunia', 'A', '20'),
(17, 8, '<p>Angin bertiup sepoi-sepou. Cuaca begitu cerah cemerlang terkena sinar rembulan. Bintang-bintang bertaburan di atas langit seperti permata bertebaran di atas permadani. Di sebelah sana melancarlah biduk para nelayan yang sedang mengadu nasib dan untung, menentang besarnya gelombang yang penuh dengan marabahaya. Latar dari kutipan novel tersebut ialah &hellip;</p>\r\n', 'Malam hari di langit biru', 'Malam hari di laut lepas', 'Pagi hari di samudera raya', 'Siang hari di tengah laut', 'B', '20'),
(18, 10, '<p>Kotagede tidak bisa dibantah lagi sudah menjadi sentra kerajinan perak terkuat di Indonesia, melewati Bali, Lombok, dan Kendari. Berbagai macam kerajinan perak yang telah diolah sehingga menjadi berbagai macam bentuk lewat beragam metode, semuanya dihasilkan di Kotagede. Semenjak tahun 1970-an, kerajinan perak hasil produksi Kotagede telah banyak diminati wisatawan domestik ataupun mancanegara. Kerajinan tersebut sangat beragam diantaranya yakni berbentuk perhiasan, peralatan rumah tangga, maupun aksesoris perhiasan. Kalimat ini pada paragraf tersebut terletak pada kalimat &hellip;</p>\r\n', 'Ketiga', 'Kedua', 'Pertama', 'Keempat', 'A', '50'),
(19, 10, '<p>Sekolah Rinda menyelenggarakan perlombaan pidato bahasa Indonesia. Rinda merupakan salah satu dari pesertanya, perwakilan dari kelas 7 A. Ia menghafal keseluruhan dari teks pidato dengan penuh gembira dan semangat. Harapannya adalah ia ingin memberikan yang sesuatu hal yang terbaik kepada teman-teman sekelasnya. Di saat perlombaan Rinda memperoleh nomor undian ke-2. Setelah nama Rinda dipanggil, Rinda berjalan perlahan menuju podium. Keringat dinginnya mulai mengucur deras, konsentrasinya pecah dan perlahan hilang. Tak satu pun kata yang diucapkannya, kecuali salam pembukaan. Selanjutnya Rinda berhenti begitu saja dan segera pergi meninggalkan ruangan. Berikut ini yang merupakan kalimat buku harian yang sesuai dengan ilustrasi di atas ialah &hellip;</p>\r\n', 'Rinda begitu kecewa sekali dengan penampilan buruknya pada saat perlombaan', 'Kekecewaannya selalu ia tumpahkan di buku harian miliknya', 'Perasaanku pada saat tampil ke depan mimbar benar-benar cukup mengecewakan', 'Hari ini perasaanku tidak menentu, marah, sedih, kesal, kecewa bercampur aduk menjadi satu.', 'D', '50'),
(21, 12, '<p>sebutkan 1</p>\r\n', 'aa', 'dd', 'ss', 'ss', 'A', '20'),
(22, 13, '<p>manakah dibawah ini yang merupakan kalimat yang benar?</p>\r\n', 'dasdsad', 'ahay', 'asdsad', 'sadsadsa', 'B', '20'),
(23, 14, '<p>dsad</p>\r\n', 'asd', 'sad', 'sad', 'asd', 'B', '20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`idguru`),
  ADD KEY `idpengguna` (`idpengguna`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`idjawaban`),
  ADD KEY `idkuis` (`idkuis`),
  ADD KEY `idsiswa` (`idsiswa`);

--
-- Indexes for table `jawabandetail`
--
ALTER TABLE `jawabandetail`
  ADD PRIMARY KEY (`idjawabandetail`),
  ADD KEY `idjawaban` (`idjawaban`);

--
-- Indexes for table `kegiatansekolah`
--
ALTER TABLE `kegiatansekolah`
  ADD PRIMARY KEY (`idkegiatansekolah`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`idkelas`);

--
-- Indexes for table `kuis`
--
ALTER TABLE `kuis`
  ADD PRIMARY KEY (`idkuis`),
  ADD KEY `idkelas` (`idkelas`);

--
-- Indexes for table `kurikulum`
--
ALTER TABLE `kurikulum`
  ADD PRIMARY KEY (`idkurikulum`);

--
-- Indexes for table `matapelajaran`
--
ALTER TABLE `matapelajaran`
  ADD PRIMARY KEY (`idmatapelajaran`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`idpengguna`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`idpengumuman`);

--
-- Indexes for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`idprestasi`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`idsiswa`),
  ADD KEY `idpengguna` (`idpengguna`),
  ADD KEY `idkelas` (`idkelas`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`idsoal`),
  ADD KEY `idkuis` (`idkuis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `idguru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `idjawaban` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jawabandetail`
--
ALTER TABLE `jawabandetail`
  MODIFY `idjawabandetail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kegiatansekolah`
--
ALTER TABLE `kegiatansekolah`
  MODIFY `idkegiatansekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `idkelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kuis`
--
ALTER TABLE `kuis`
  MODIFY `idkuis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kurikulum`
--
ALTER TABLE `kurikulum`
  MODIFY `idkurikulum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `matapelajaran`
--
ALTER TABLE `matapelajaran`
  MODIFY `idmatapelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `idpengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `idpengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `idprestasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `idsiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `idsoal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`idsiswa`) REFERENCES `siswa` (`idsiswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_ibfk_2` FOREIGN KEY (`idkuis`) REFERENCES `kuis` (`idkuis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jawabandetail`
--
ALTER TABLE `jawabandetail`
  ADD CONSTRAINT `jawabandetail_ibfk_1` FOREIGN KEY (`idjawaban`) REFERENCES `jawaban` (`idjawaban`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`idkelas`) REFERENCES `kelas` (`idkelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `soal_ibfk_1` FOREIGN KEY (`idkuis`) REFERENCES `kuis` (`idkuis`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
