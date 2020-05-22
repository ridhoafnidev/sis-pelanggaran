-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 22, 2020 at 06:47 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pelanggaran_siswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nip`, `nama_lengkap`, `no_hp`, `alamat`, `email`, `jenis_kelamin`) VALUES
(1, '112', 'aaa', '0822', 'adafdaf', 'dfadf@gadfa.com', 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `izin`
--

CREATE TABLE `izin` (
  `id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `kehadiran_id` char(2) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `izin_detail`
--

CREATE TABLE `izin_detail` (
  `id` int(11) NOT NULL,
  `izin_id` int(11) NOT NULL,
  `keterangan_izin` varchar(255) NOT NULL,
  `nis` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `izin_gerbang`
--

CREATE TABLE `izin_gerbang` (
  `id` int(11) NOT NULL,
  `izin_detail_id` int(11) NOT NULL,
  `masuk` varchar(10) NOT NULL,
  `keluar` varchar(10) NOT NULL,
  `tidak_masuk` varchar(10) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pelanggaran`
--

CREATE TABLE `jenis_pelanggaran` (
  `id` int(11) NOT NULL,
  `jenis_pelanggaran` varchar(255) NOT NULL,
  `poin` int(11) NOT NULL,
  `tindakan` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan_kelas`
--

CREATE TABLE `jurusan_kelas` (
  `id` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran`
--

CREATE TABLE `kehadiran` (
  `kode_kehadiran` char(2) NOT NULL,
  `jenis_kehadiran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `kelas`) VALUES
(1, 'X TKJ 2');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_siswa`
--

CREATE TABLE `kelas_siswa` (
  `id` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `nis` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `konseling`
--

CREATE TABLE `konseling` (
  `id` int(11) NOT NULL,
  `pelanggaran_detail_id` int(11) NOT NULL,
  `deskripsi_penanganan` text NOT NULL,
  `hasil_konseling` text NOT NULL,
  `rekomendasi` text NOT NULL,
  `guru_id` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `level`) VALUES
(1, 'Petugas Piket'),
(2, 'Bimbingan Konseling'),
(3, 'Petugas Gerbang'),
(4, 'Wakil Kepala Sekolah Kesiswaan'),
(5, 'Kepala Sekolah'),
(6, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

CREATE TABLE `pelanggaran` (
  `id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `kehadiran_id` char(2) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran_detail`
--

CREATE TABLE `pelanggaran_detail` (
  `id` int(11) NOT NULL,
  `pelanggaran_id` int(11) NOT NULL,
  `jenis_pelanggaran_id` int(11) NOT NULL,
  `nis` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nama_lengkap` varchar(100) NOT NULL,
  `nis` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `rombel` varchar(20) NOT NULL,
  `tempat_lahir` text NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `orang_tua` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `nipd` varchar(20) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `rt` varchar(50) NOT NULL,
  `rw` varchar(50) NOT NULL,
  `dusun` varchar(50) NOT NULL,
  `kelurahan` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `jenis_tinggal` varchar(50) NOT NULL,
  `alat_transportasi` varchar(100) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `skhun` varchar(50) NOT NULL,
  `penerima_kps` varchar(10) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `tahun_lahir_ayah` varchar(20) NOT NULL,
  `jenjang_pendidikan_ayah` varchar(50) NOT NULL,
  `pekerjaan_ayah` varchar(100) NOT NULL,
  `penghasilan_ayah` varchar(20) NOT NULL,
  `nik_ayah` varchar(20) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `tahun_lahir_ibu` varchar(20) NOT NULL,
  `jenjang_pendidikan_ibu` varchar(50) NOT NULL,
  `pekerjaan_ibu` varchar(100) NOT NULL,
  `penghasilan_ibu` varchar(20) NOT NULL,
  `nik_ibu` varchar(20) NOT NULL,
  `nama_wali` varchar(100) NOT NULL,
  `tahun_lahir_wali` varchar(50) NOT NULL,
  `jenjang_pendidikan_wali` varchar(50) NOT NULL,
  `pekerjaan_wali` varchar(50) NOT NULL,
  `penghasilan_wali` varchar(20) NOT NULL,
  `nik_wali` varchar(20) NOT NULL,
  `nomor_peserta_ujian` varchar(50) NOT NULL,
  `no_seri_ijazah` varchar(50) NOT NULL,
  `penerima_kip` varchar(10) NOT NULL,
  `nomor_kip` varchar(20) NOT NULL,
  `nama_kip` varchar(100) NOT NULL,
  `nomor_kks` varchar(20) NOT NULL,
  `no_registrasi_akta_lahir` varchar(50) NOT NULL,
  `bank` varchar(20) NOT NULL,
  `nomor_rekening_bank` varchar(50) NOT NULL,
  `rekening_atas_nama` varchar(100) NOT NULL,
  `layak_pip` varchar(20) NOT NULL,
  `alasan_layak_pip` varchar(100) NOT NULL,
  `kebutuhan_khusus` varchar(20) NOT NULL,
  `sekolah_asal` varchar(100) NOT NULL,
  `anak_keberapa` int(11) NOT NULL,
  `lintang` double NOT NULL,
  `bujur` double NOT NULL,
  `no_kk` varchar(50) NOT NULL,
  `berat_badan` int(11) NOT NULL,
  `tinggi_badan` int(11) NOT NULL,
  `lingkar_kepala` int(11) NOT NULL,
  `jumlah_saudara_kandung` int(11) NOT NULL,
  `jarak_rumah_ke_sekolah` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nama_lengkap`, `nis`, `alamat`, `no_hp`, `jenis_kelamin`, `rombel`, `tempat_lahir`, `tanggal_lahir`, `orang_tua`, `foto`, `nipd`, `nik`, `agama`, `rt`, `rw`, `dusun`, `kelurahan`, `kecamatan`, `kode_pos`, `jenis_tinggal`, `alat_transportasi`, `telepon`, `email`, `skhun`, `penerima_kps`, `nama_ayah`, `tahun_lahir_ayah`, `jenjang_pendidikan_ayah`, `pekerjaan_ayah`, `penghasilan_ayah`, `nik_ayah`, `nama_ibu`, `tahun_lahir_ibu`, `jenjang_pendidikan_ibu`, `pekerjaan_ibu`, `penghasilan_ibu`, `nik_ibu`, `nama_wali`, `tahun_lahir_wali`, `jenjang_pendidikan_wali`, `pekerjaan_wali`, `penghasilan_wali`, `nik_wali`, `nomor_peserta_ujian`, `no_seri_ijazah`, `penerima_kip`, `nomor_kip`, `nama_kip`, `nomor_kks`, `no_registrasi_akta_lahir`, `bank`, `nomor_rekening_bank`, `rekening_atas_nama`, `layak_pip`, `alasan_layak_pip`, `kebutuhan_khusus`, `sekolah_asal`, `anak_keberapa`, `lintang`, `bujur`, `no_kk`, `berat_badan`, `tinggi_badan`, `lingkar_kepala`, `jumlah_saudara_kandung`, `jarak_rumah_ke_sekolah`) VALUES
('ZULIAN RIZKI\r\n', '0025295263', 'Dusun 1 Ranah Sungkai XII Koto Kampar', '0822', 'Laki-Laki', 'X TKJ 2', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, '', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `password`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ridho Afni', 'Administrator', 'ridhoafni.dev', '$2y$10$zDzJCVw8x/B0brR2MCBhLefbvjU4pUxDbrC9/nZ1.6gyhKEomA6iu', '/photos/1/0.jpg', 'sIV9XRFlWUL1vqFqc0gdbw0jG6WWW4KSZuYtkwRrAVxsWvSu3A04x3SQwegR', '2020-02-25 05:27:37', '2020-02-25 05:32:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `izin`
--
ALTER TABLE `izin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `izin_FK_kehadiran` (`kehadiran_id`),
  ADD KEY `izin_FK` (`guru_id`);

--
-- Indexes for table `izin_detail`
--
ALTER TABLE `izin_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `izin_detail_FK` (`izin_id`),
  ADD KEY `izin_detail_FK_1` (`nis`);

--
-- Indexes for table `izin_gerbang`
--
ALTER TABLE `izin_gerbang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `izin_gerbang_FK` (`izin_detail_id`);

--
-- Indexes for table `jenis_pelanggaran`
--
ALTER TABLE `jenis_pelanggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusan_kelas`
--
ALTER TABLE `jurusan_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jurusan_kelas_FK` (`kelas_id`),
  ADD KEY `jurusan_kelas_FK_1` (`jurusan_id`);

--
-- Indexes for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`kode_kehadiran`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_siswa_FK` (`jurusan_id`),
  ADD KEY `kelas_siswa_FK_1` (`kelas_id`),
  ADD KEY `kelas_siswa_FK_2` (`nis`);

--
-- Indexes for table `konseling`
--
ALTER TABLE `konseling`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konseling_FK` (`pelanggaran_detail_id`),
  ADD KEY `konseling_FK_1` (`guru_id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggaran_FK` (`guru_id`),
  ADD KEY `pelanggaran_FK_kehadiran` (`kehadiran_id`);

--
-- Indexes for table `pelanggaran_detail`
--
ALTER TABLE `pelanggaran_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggaran_detail_FK_1` (`jenis_pelanggaran_id`),
  ADD KEY `izin_detail_FK` (`pelanggaran_id`) USING BTREE,
  ADD KEY `pelanggaran_detail_FK_2` (`nis`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `izin`
--
ALTER TABLE `izin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `izin_detail`
--
ALTER TABLE `izin_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `izin_gerbang`
--
ALTER TABLE `izin_gerbang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_pelanggaran`
--
ALTER TABLE `jenis_pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurusan_kelas`
--
ALTER TABLE `jurusan_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konseling`
--
ALTER TABLE `konseling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggaran_detail`
--
ALTER TABLE `pelanggaran_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `izin`
--
ALTER TABLE `izin`
  ADD CONSTRAINT `izin_FK` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `izin_FK_kehadiran` FOREIGN KEY (`kehadiran_id`) REFERENCES `kehadiran` (`kode_kehadiran`) ON UPDATE CASCADE;

--
-- Constraints for table `izin_detail`
--
ALTER TABLE `izin_detail`
  ADD CONSTRAINT `izin_detail_FK` FOREIGN KEY (`izin_id`) REFERENCES `izin` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `izin_detail_FK_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON UPDATE CASCADE;

--
-- Constraints for table `izin_gerbang`
--
ALTER TABLE `izin_gerbang`
  ADD CONSTRAINT `izin_gerbang_FK` FOREIGN KEY (`izin_detail_id`) REFERENCES `izin_detail` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `jurusan_kelas`
--
ALTER TABLE `jurusan_kelas`
  ADD CONSTRAINT `jurusan_kelas_FK` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jurusan_kelas_FK_1` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD CONSTRAINT `kelas_siswa_FK` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `kelas_siswa_FK_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `kelas_siswa_FK_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON UPDATE CASCADE;

--
-- Constraints for table `konseling`
--
ALTER TABLE `konseling`
  ADD CONSTRAINT `konseling_FK` FOREIGN KEY (`pelanggaran_detail_id`) REFERENCES `pelanggaran_detail` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `konseling_FK_1` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD CONSTRAINT `pelanggaran_FK` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pelanggaran_FK_kehadiran` FOREIGN KEY (`kehadiran_id`) REFERENCES `kehadiran` (`kode_kehadiran`) ON UPDATE CASCADE;

--
-- Constraints for table `pelanggaran_detail`
--
ALTER TABLE `pelanggaran_detail`
  ADD CONSTRAINT `pelanggaran_detail_FK` FOREIGN KEY (`pelanggaran_id`) REFERENCES `pelanggaran` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pelanggaran_detail_FK_1` FOREIGN KEY (`jenis_pelanggaran_id`) REFERENCES `jenis_pelanggaran` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pelanggaran_detail_FK_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
