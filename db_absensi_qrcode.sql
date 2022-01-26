-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2019 at 10:46 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_absensi_qrcode`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi_keluar`
--

CREATE TABLE `absensi_keluar` (
  `absk_id` int(11) NOT NULL,
  `absk_kkdj_id` int(11) NOT NULL,
  `absk_sisw_id` int(11) NOT NULL,
  `absk_hadir` int(11) NOT NULL,
  `absk_izin` int(11) NOT NULL,
  `absk_alpa` int(11) NOT NULL,
  `absk_sakit` int(11) NOT NULL,
  `absk_matp_id` int(11) NOT NULL,
  `absk_seme_id` int(11) NOT NULL,
  `absk_izin_keterangan` text NOT NULL,
  `absk_alpa_keterangan` text NOT NULL,
  `absk_sakit_keterangan` text NOT NULL,
  `absk_tanggal` date NOT NULL,
  `absk_jam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `absensi_masuk`
--

CREATE TABLE `absensi_masuk` (
  `abse_id` int(11) NOT NULL,
  `abse_kkdj_id` int(11) NOT NULL,
  `abse_sisw_id` int(11) NOT NULL,
  `abse_hadir` int(11) NOT NULL,
  `abse_izin` int(11) NOT NULL,
  `abse_alpa` int(11) NOT NULL,
  `abse_sakit` int(11) NOT NULL,
  `abse_matp_id` int(11) NOT NULL,
  `abse_seme_id` int(11) NOT NULL,
  `abse_izin_keterangan` text NOT NULL,
  `abse_alpa_keterangan` text NOT NULL,
  `abse_sakit_keterangan` text NOT NULL,
  `abse_tanggal` date NOT NULL,
  `abse_jam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `angkatan`
--

CREATE TABLE `angkatan` (
  `angk_id` int(11) NOT NULL,
  `angk_nama` varchar(50) NOT NULL,
  `angk_keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `angkatan`
--

INSERT INTO `angkatan` (`angk_id`, `angk_nama`, `angk_keterangan`) VALUES
(1, '2017/2018', 'The Best'),
(2, '2018/2019', 'Good'),
(3, '2019/2020', 'Best');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `juru_id` int(11) NOT NULL,
  `juru_nama` varchar(50) NOT NULL,
  `juru_keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`juru_id`, `juru_nama`, `juru_keterangan`) VALUES
(1, 'RPL', 'Rekayasa Perangkat Lunak'),
(2, 'TKJ', 'Teknik Komputer Jaringan');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kela_id` int(11) NOT NULL,
  `kela_nama` varchar(5) NOT NULL,
  `kela_keterangan` text NOT NULL,
  `kela_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kela_id`, `kela_nama`, `kela_keterangan`, `kela_status`) VALUES
(1, 'X', 'Sepuluh / 1\n', 'Aktif'),
(2, 'XI', 'Sebelas / 1', 'Aktif'),
(3, 'XII', 'Duabelas / 1', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_detail`
--

CREATE TABLE `kelas_detail` (
  `kede_id` int(11) NOT NULL,
  `kede_detail` int(11) NOT NULL,
  `kede_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas_detail`
--

INSERT INTO `kelas_detail` (`kede_id`, `kede_detail`, `kede_status`) VALUES
(1, 1, 'Aktif'),
(2, 2, 'Aktif'),
(3, 3, 'Aktif'),
(4, 4, 'Aktif'),
(5, 5, 'Aktif'),
(6, 6, 'Aktif'),
(7, 7, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_kelas_detail_jurusan_angkatan`
--

CREATE TABLE `kelas_kelas_detail_jurusan_angkatan` (
  `kkdj_id` int(11) NOT NULL,
  `kkdj_kela_id` int(11) NOT NULL,
  `kkdj_kede_id` int(11) NOT NULL,
  `kkdj_juru_id` int(11) NOT NULL,
  `kkdj_angk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas_kelas_detail_jurusan_angkatan`
--

INSERT INTO `kelas_kelas_detail_jurusan_angkatan` (`kkdj_id`, `kkdj_kela_id`, `kkdj_kede_id`, `kkdj_juru_id`, `kkdj_angk_id`) VALUES
(2, 1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kelas_kelas_detail_jurusan_angkatan_siswa`
--

CREATE TABLE `kelas_kelas_detail_jurusan_angkatan_siswa` (
  `kksi_id` int(11) NOT NULL,
  `kksi_kkdj_id` int(11) NOT NULL,
  `kksi_sisw_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas_kelas_detail_jurusan_angkatan_siswa`
--

INSERT INTO `kelas_kelas_detail_jurusan_angkatan_siswa` (`kksi_id`, `kksi_kkdj_id`, `kksi_sisw_id`) VALUES
(12, 2, 3),
(13, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `lev_id` int(11) NOT NULL,
  `lev_nama` varchar(50) DEFAULT NULL,
  `lev_deskripsi` varchar(200) DEFAULT NULL,
  `lev_status` varchar(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`lev_id`, `lev_nama`, `lev_deskripsi`, `lev_status`, `created_date`) VALUES
(1, 'Administrator', '-', 'Aktif', '2019-05-01 23:20:02'),
(3, 'Siswa', '-', 'Aktif', '2019-08-28 04:01:50'),
(5, 'Guru', '-', 'Aktif', '2019-08-28 04:01:42');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `matp_id` int(11) NOT NULL,
  `matp_nama` varchar(50) NOT NULL,
  `matp_keterangan` text NOT NULL,
  `matp_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`matp_id`, `matp_nama`, `matp_keterangan`, `matp_status`) VALUES
(1, 'Pemograman Dasar', '-', 'Aktif'),
(2, 'Bahasa Indonesia', '-', 'Aktif'),
(3, 'Bahasa Inggris', '-', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_menu_id` int(11) DEFAULT '0',
  `menu_name` varchar(100) DEFAULT NULL,
  `menu_description` text,
  `menu_index` int(11) DEFAULT NULL,
  `menu_icon` varchar(100) DEFAULT NULL,
  `menu_url` varchar(200) DEFAULT NULL,
  `menu_status` varchar(10) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_menu_id`, `menu_name`, `menu_description`, `menu_index`, `menu_icon`, `menu_url`, `menu_status`, `created_date`) VALUES
(1, 0, 'Dashboard', '-', 1, 'fa fa-desktop', 'dashboard', 'Aktif', '2019-08-07 17:13:11'),
(27, 37, 'Pengguna', '-', 1, 'fa fa-caret-right', 'pengaturan/pengguna', 'Aktif', '2019-06-03 22:36:24'),
(37, 0, 'Pengaturan', '-', 11, 'fa fa-cogs', '#', 'Aktif', '2019-08-07 16:47:57'),
(61, 37, 'Level', '-', 2, 'fa fa-caret-right', 'pengaturan/level', 'Aktif', '2019-06-03 22:49:17'),
(63, 37, 'Menu', '-', 3, 'fa fa-caret-right', 'pengaturan/menu', 'Aktif', '2019-06-03 22:50:05'),
(64, 37, 'Hak Akses', '-', 4, 'fa fa-caret-right', 'pengaturan/hakAkses', 'Aktif', '2019-06-03 22:50:24'),
(113, 0, 'Referensi', '-', 6, 'fa fa-link', '#', 'Aktif', '2019-08-28 13:26:55'),
(115, 113, 'Kelas', '-', 3, 'fa fa-caret-right', 'referensi/kelas', 'Aktif', '2019-08-28 04:55:07'),
(116, 113, 'Kelas Detail', '-', 4, 'fa fa-caret-right', 'referensi/kelasDetail', 'Aktif', '2019-08-28 04:55:11'),
(117, 113, 'Angkatan', '-', 5, 'fa fa-caret-right', 'referensi/angkatan', 'Aktif', '2019-08-28 04:55:18'),
(118, 113, 'Jurusan', '-', 6, 'fa fa-caret-right', 'referensi/jurusan', 'Aktif', '2019-08-28 04:55:24'),
(119, 113, 'Mata Pelajaran', '-', 7, 'fa fa-caret-right', 'referensi/mataPelajaran', 'Aktif', '2019-08-28 04:55:30'),
(121, 113, 'Semester', '-', 8, 'fa fa-caret-right', 'referensi/semester', 'Aktif', '2019-08-28 04:56:37'),
(122, 0, 'Siswa', '-', 4, 'fa fa-group', 'siswa/data', 'Aktif', '2019-08-28 13:26:43'),
(123, 0, 'Guru', '-', 5, 'fa fa-user', 'guru/data', 'Aktif', '2019-08-28 13:26:48'),
(124, 0, 'Kelas', '-', 2, ' fa fa-university', 'kelas/data', 'Aktif', '2019-08-28 05:03:32'),
(125, 0, 'Pengajar', '-', 3, 'fa fa-graduation-cap', 'pengajar/data', 'Aktif', '2019-08-28 13:26:33'),
(126, 0, 'Absen', '-', 2, 'fa fa-database', 'absen/data', 'Aktif', '2019-08-29 06:23:44'),
(127, 0, 'Laporan', '-', 12, 'fa fa-file', '#', 'Aktif', '2019-09-02 17:38:39'),
(128, 127, 'Hari Ini', '-', 1, 'fa fa-file', 'laporan/hariIni', 'Aktif', '2019-09-09 05:47:22'),
(129, 127, 'Minggu Ini', '-', 2, 'fa fa-file', 'laporan/mingguIni', 'Aktif', '2019-09-07 02:04:59'),
(130, 127, 'Bulan Ini', '-', 3, 'fa fa-file', 'laporan/bulanIni', 'Aktif', '2019-09-07 02:04:43'),
(131, 127, 'Tahun Ini', '-', 4, 'fa fa-file', 'laporan/tahunIni', 'Aktif', '2019-09-07 02:05:32'),
(132, 127, 'Semua', '-', 5, 'fa fa-file', 'laporan/semua', 'Aktif', '2019-09-07 02:05:51');

-- --------------------------------------------------------

--
-- Table structure for table `pengajar`
--

CREATE TABLE `pengajar` (
  `pena_id` int(11) NOT NULL,
  `pena_user_id` int(11) NOT NULL,
  `pena_matp_id` int(11) NOT NULL,
  `pena_juru_id` int(11) NOT NULL,
  `pena_kkdj_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengajar`
--

INSERT INTO `pengajar` (`pena_id`, `pena_user_id`, `pena_matp_id`, `pena_juru_id`, `pena_kkdj_id`) VALUES
(1, 48, 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `role_aplikasi`
--

CREATE TABLE `role_aplikasi` (
  `rola_id` int(11) NOT NULL,
  `rola_menu_id` int(11) DEFAULT NULL,
  `rola_lev_id` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_aplikasi`
--

INSERT INTO `role_aplikasi` (`rola_id`, `rola_menu_id`, `rola_lev_id`, `created_date`) VALUES
(1, 1, 1, '2019-05-23 19:01:07'),
(13, 64, 1, '2019-06-11 10:26:01'),
(15, 27, 1, '2019-06-11 10:24:53'),
(16, 61, 1, '2019-06-11 10:25:03'),
(17, 63, 1, '2019-06-11 10:25:13'),
(18, 37, 1, '2019-06-11 10:35:04'),
(122, 113, 1, '2019-08-28 04:50:56'),
(124, 115, 1, '2019-08-28 04:56:57'),
(125, 116, 1, '2019-08-28 04:57:03'),
(127, 117, 1, '2019-08-28 04:57:19'),
(128, 118, 1, '2019-08-28 04:57:28'),
(130, 119, 1, '2019-08-28 04:57:59'),
(131, 121, 1, '2019-08-28 04:58:06'),
(132, 122, 1, '2019-08-28 04:59:12'),
(134, 124, 1, '2019-08-28 05:04:17'),
(135, 1, 5, '2019-08-28 13:01:19'),
(136, 125, 1, '2019-08-28 13:27:08'),
(138, 126, 5, '2019-09-01 12:46:14'),
(144, 127, 5, '2019-09-10 13:22:26'),
(145, 128, 5, '2019-09-10 13:22:38'),
(146, 129, 5, '2019-09-10 13:22:47'),
(147, 130, 5, '2019-09-10 13:22:58'),
(148, 131, 5, '2019-09-10 13:23:07');

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE `role_users` (
  `rolu_id` int(11) NOT NULL,
  `rolu_user_id` int(11) DEFAULT NULL,
  `rolu_lev_id` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`rolu_id`, `rolu_user_id`, `rolu_lev_id`, `created_at`, `created_date`) VALUES
(29, 31, 1, NULL, '2019-06-11 09:19:20'),
(38, 41, 3, NULL, '2019-08-07 16:05:44'),
(42, 45, 3, NULL, '2019-08-08 03:32:59'),
(45, 48, 5, NULL, '2019-08-28 07:39:35');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `seme_id` int(11) NOT NULL,
  `seme_nama` varchar(50) NOT NULL,
  `seme_keterangan` text NOT NULL,
  `seme_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`seme_id`, `seme_nama`, `seme_keterangan`, `seme_status`) VALUES
(1, 'Ganjil', 'Semester 1\n', 2),
(2, 'Genap', 'Semester 2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `sisw_id` int(11) NOT NULL,
  `sisw_nis` int(11) NOT NULL,
  `sisw_nama` varchar(50) NOT NULL,
  `sisw_asal_sekolah` varchar(50) NOT NULL,
  `sisw_no_hp` varchar(20) NOT NULL,
  `sisw_email` varchar(50) NOT NULL,
  `sisw_nisn` int(11) NOT NULL,
  `sisw_kela_id` int(11) NOT NULL,
  `sisw_qrcode` varchar(50) NOT NULL,
  `sisw_status` varchar(50) NOT NULL,
  `sisw_status_keluar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`sisw_id`, `sisw_nis`, `sisw_nama`, `sisw_asal_sekolah`, `sisw_no_hp`, `sisw_email`, `sisw_nisn`, `sisw_kela_id`, `sisw_qrcode`, `sisw_status`, `sisw_status_keluar`) VALUES
(3, 1123123, 'Bayu Rifki Alghifari', 'SMPN 2 NGAMPRAH', '08123123', 'bayurifkialgh@gmail.com', 2147483647, 2, '3.png', '', ''),
(4, 123123, 'Rifki Bayu Alghifari', 'SMPN 1 NGAMPRAH', '089123123', 'rifkibayu@gmail.com', 123123, 2, '4.png', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  `user_name` varchar(200) DEFAULT NULL,
  `user_phone` varchar(20) DEFAULT NULL,
  `user_address` varchar(250) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_name`, `user_phone`, `user_address`, `created_date`) VALUES
(31, 'administrator@gmail.com', 'utqQiS/p4vWKh3E81QVNBONFqJt14hRtvAx446gYROkV8.8kh11eS', 'Administrator', '08382225436', '-', '2019-08-14 12:00:47'),
(48, 'guru@guru.com', 'Tcwy2iRkbL/br7Y1yl5K1Oo8uW2OadJOiKWZhJQLoxmeTSXOuZjGy', 'Guru Kami', '081231234', 'Rumah Guru Kami', '2019-08-28 07:39:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi_keluar`
--
ALTER TABLE `absensi_keluar`
  ADD PRIMARY KEY (`absk_id`),
  ADD KEY `absk_kkdj_id` (`absk_kkdj_id`),
  ADD KEY `absk_sisw_id` (`absk_sisw_id`),
  ADD KEY `absk_matp_id` (`absk_matp_id`),
  ADD KEY `absk_seme_id` (`absk_seme_id`);

--
-- Indexes for table `absensi_masuk`
--
ALTER TABLE `absensi_masuk`
  ADD PRIMARY KEY (`abse_id`),
  ADD KEY `abse_kkdj_id` (`abse_kkdj_id`),
  ADD KEY `abse_sisw_id` (`abse_sisw_id`),
  ADD KEY `abse_matp_id` (`abse_matp_id`),
  ADD KEY `abse_seme_id` (`abse_seme_id`);

--
-- Indexes for table `angkatan`
--
ALTER TABLE `angkatan`
  ADD PRIMARY KEY (`angk_id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`juru_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kela_id`);

--
-- Indexes for table `kelas_detail`
--
ALTER TABLE `kelas_detail`
  ADD PRIMARY KEY (`kede_id`);

--
-- Indexes for table `kelas_kelas_detail_jurusan_angkatan`
--
ALTER TABLE `kelas_kelas_detail_jurusan_angkatan`
  ADD PRIMARY KEY (`kkdj_id`),
  ADD KEY `kkdj_kela_id` (`kkdj_kela_id`),
  ADD KEY `kkdj_kede_id` (`kkdj_kede_id`),
  ADD KEY `kkdj_juru_id` (`kkdj_juru_id`),
  ADD KEY `kkdj_angk_id` (`kkdj_angk_id`);

--
-- Indexes for table `kelas_kelas_detail_jurusan_angkatan_siswa`
--
ALTER TABLE `kelas_kelas_detail_jurusan_angkatan_siswa`
  ADD PRIMARY KEY (`kksi_id`),
  ADD KEY `kksi_sisw_id` (`kksi_sisw_id`),
  ADD KEY `kksi_kkdj_id` (`kksi_kkdj_id`),
  ADD KEY `kksi_kkdj_id_2` (`kksi_kkdj_id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`lev_id`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`matp_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `pengajar`
--
ALTER TABLE `pengajar`
  ADD PRIMARY KEY (`pena_id`),
  ADD KEY `pena_user_id` (`pena_user_id`),
  ADD KEY `pena_matp_id` (`pena_matp_id`),
  ADD KEY `pena_juru_id` (`pena_juru_id`),
  ADD KEY `pena_kkdj_id` (`pena_kkdj_id`);

--
-- Indexes for table `role_aplikasi`
--
ALTER TABLE `role_aplikasi`
  ADD PRIMARY KEY (`rola_id`),
  ADD KEY `rola_menu_id` (`rola_menu_id`),
  ADD KEY `rola_lev_id` (`rola_lev_id`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`rolu_id`),
  ADD KEY `rolu_user_id` (`rolu_user_id`),
  ADD KEY `rolu_lev_id` (`rolu_lev_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`seme_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`sisw_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi_keluar`
--
ALTER TABLE `absensi_keluar`
  MODIFY `absk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `absensi_masuk`
--
ALTER TABLE `absensi_masuk`
  MODIFY `abse_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `angkatan`
--
ALTER TABLE `angkatan`
  MODIFY `angk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `juru_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `kela_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas_detail`
--
ALTER TABLE `kelas_detail`
  MODIFY `kede_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kelas_kelas_detail_jurusan_angkatan`
--
ALTER TABLE `kelas_kelas_detail_jurusan_angkatan`
  MODIFY `kkdj_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kelas_kelas_detail_jurusan_angkatan_siswa`
--
ALTER TABLE `kelas_kelas_detail_jurusan_angkatan_siswa`
  MODIFY `kksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `lev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `matp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `pengajar`
--
ALTER TABLE `pengajar`
  MODIFY `pena_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role_aplikasi`
--
ALTER TABLE `role_aplikasi`
  MODIFY `rola_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `role_users`
--
ALTER TABLE `role_users`
  MODIFY `rolu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `seme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `sisw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
