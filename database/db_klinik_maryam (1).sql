-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 10, 2022 at 01:49 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_klinik_maryam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username_admin` varchar(255) NOT NULL,
  `password_admin` varchar(255) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `alamat_admin` text NOT NULL,
  `no_telp_admin` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username_admin`, `password_admin`, `nama_admin`, `alamat_admin`, `no_telp_admin`) VALUES
(1, 'admin1', 'U/5TxyQEkjvlP20Mf1UMYsAzFgJJIWNINij6p/cX43JMcj8vjdi/4ivQ4UAiLK8HcIGR/YBn2s7koAn5D0KRMaJn5NFrGdHuYyjXafskOc+8pRoJ+F8=', 'admin1', 'kediri', '089657456985');

-- --------------------------------------------------------

--
-- Table structure for table `detail resep`
--

CREATE TABLE `detail resep` (
  `id_detail` int(11) NOT NULL,
  `id_resep` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah_obat` int(11) NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_resep_inap`
--

CREATE TABLE `detail_resep_inap` (
  `id_detail` int(11) NOT NULL,
  `id_resep_inap` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah_obat` int(11) NOT NULL,
  `total_biaya` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `nama_dokter` varchar(50) NOT NULL,
  `alamat_dokter` text NOT NULL,
  `no_telp_dokter` varchar(20) NOT NULL,
  `status_dokter` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `foto_dokter` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `id_poli`, `nama_dokter`, `alamat_dokter`, `no_telp_dokter`, `status_dokter`, `foto_dokter`, `created_at`, `updated_at`) VALUES
(1, 4, 'faris', 'Kediri', '089654587589', 'Tidak Aktif', 'docs/img/img_dokter/noimage.jpg', '2022-01-29 22:56:14', '2022-01-31 20:26:31'),
(2, 6, 'faris', 'klsadjfkl', '154646468416', 'Tidak Aktif', 'docs/img/img_dokter/noimage.jpg', '2022-01-29 22:56:51', NULL),
(3, 4, 'afif', 'Kediri', '205456451', 'Aktif', 'docs/img/img_dokter/1643471883_8a42b57d371b6d85b368.png', '2022-01-29 22:58:03', '2022-01-31 22:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `hari`
--

CREATE TABLE `hari` (
  `id_hari` int(11) NOT NULL,
  `nama_hari` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hari`
--

INSERT INTO `hari` (`id_hari`, `nama_hari`, `created_at`, `updated_at`) VALUES
(2, 'Senin', '2022-01-25 13:31:19', '2022-01-29 09:10:40'),
(4, 'Selasa', '2022-02-02 20:00:55', NULL),
(5, 'Rabu', '2022-02-02 20:01:05', NULL),
(6, 'Kamis', '2022-02-02 20:01:11', NULL),
(7, 'Jumat', '2022-02-02 20:01:16', NULL),
(8, 'Sabtu', '2022-02-02 20:01:21', NULL),
(9, 'Minggu', '2022-02-02 20:01:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `created_at`, `updated_at`) VALUES
(1, 'Security', '2022-01-27 22:45:44', '2022-02-01 19:30:43'),
(2, 'Recepsionis', '2022-02-01 20:20:40', NULL),
(3, 'Office Boy', '2022-02-02 20:01:48', NULL),
(4, 'Perawat', '2022-02-02 20:01:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_dokter`
--

CREATE TABLE `jadwal_dokter` (
  `id_jadwal` int(11) NOT NULL,
  `id_hari` int(11) NOT NULL,
  `id_sesi` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `status_jadwal` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_dokter`
--

INSERT INTO `jadwal_dokter` (`id_jadwal`, `id_hari`, `id_sesi`, `id_dokter`, `status_jadwal`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 3, 'Aktif', '2022-02-03 09:09:01', '2022-02-03 03:08:45'),
(2, 2, 1, 1, 'Tidak Aktif', '2022-02-03 15:27:55', '2022-02-03 15:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `no_kamar` int(11) NOT NULL,
  `biaya_kamar` varchar(15) NOT NULL,
  `status_kamar` enum('Kosong','Terisi') NOT NULL DEFAULT 'Kosong'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `no_kamar`, `biaya_kamar`, `status_kamar`) VALUES
(1, 1, '50000', 'Kosong'),
(2, 2, '50000', 'Kosong'),
(3, 3, '50000', 'Kosong'),
(4, 4, '50000', 'Kosong'),
(5, 5, '50000', 'Kosong'),
(6, 6, '50000', 'Kosong');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `username_karyawan` varchar(50) NOT NULL,
  `password_karyawan` varchar(255) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `no_telp_karyawan` varchar(20) NOT NULL,
  `alamat_karyawan` text NOT NULL,
  `status_karyawan` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `foto_karyawan` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `id_jabatan`, `username_karyawan`, `password_karyawan`, `nama_karyawan`, `no_telp_karyawan`, `alamat_karyawan`, `status_karyawan`, `foto_karyawan`, `created_at`, `updated_at`) VALUES
(1, 2, 'karyawan1', 'zjpQ64LH67svG11uA//ToCK2SSGjZHpMfsKsDLwlew+8sFLwCupg0jwSRolE7IKtSwABDnQE/kwywFlEeaSLX7XgJUU9GXzcnGw8BPkJ1NpGucrrzlt2bUM=', 'karyawan1', '056985654125', 'Kediri', 'Aktif', 'n', '2022-01-28 21:45:52', '2022-02-01 20:28:48'),
(2, 4, 'karyawan2', 'nxg/x4QQdDTob7F5VN/Gre+p1qQW4gVejAIiPcKFbVD4z5Sasb4EoCrv2EfRQ6AT4M7ptrV9aey+SQAi1m+YdrR2hc/HOoRCVBx46Qgnsdb0l4HOLxYsUX8=', 'karyawan2', '089654213654', 'Kediri', 'Aktif', 'docs/img/img_karyawan/noimage.jpg', '2022-02-02 20:04:24', '2022-02-02 20:04:35');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(100) NOT NULL,
  `stok_obat` int(11) NOT NULL,
  `harga_obat` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `stok_obat`, `harga_obat`, `created_at`, `updated_at`) VALUES
(2, 'Antimo Anak', 100, 6000, '2022-01-26 11:48:56', '2022-01-29 09:11:08'),
(3, 'Vitamin A', 1000, 5000, '2022-02-02 20:30:11', NULL),
(4, 'Vitamin B', 1000, 5000, '2022-02-02 20:30:24', NULL),
(5, 'Vitamin C', 1000, 5000, '2022-02-02 20:30:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `username_pasien` varchar(50) NOT NULL,
  `password_pasien` varchar(255) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `alamat_pasien` text NOT NULL,
  `no_telp_pasien` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nik`, `username_pasien`, `password_pasien`, `nama_pasien`, `alamat_pasien`, `no_telp_pasien`, `created_at`, `updated_at`) VALUES
(2, '0256324157845123', 'pasien1', 'tBcQFe0Qk/D2IfAU8VffLZxP8mqVsj0VryvsYphJ9f+gVAevK1fHbQzt26PN/3Uwa2QRvtXVz0vjTFQZLG77CILuNSdWYLTBNF1nblOs4Ug5HRfAH48+', 'pasien satu', 'Kota Kediri', '089654254125', '2022-01-28 19:04:56', '2022-01-29 09:12:02'),
(3, '1234567891234567', 'pasien2', '7Qwmk4aHBUQVvlYWgrNd/R8uPz8XwhxGx9LFludsnC9Fov/xBA9jN7BCZiIpw3rFeZf5NIYCkIr/re5clvmdA78t+G45/1TqRwoZH1EWFG9ga0BfGoZG', 'pasien tiga', 'kediri', '0984738432', '2022-01-31 18:51:47', '2022-02-02 20:29:49'),
(4, '1234567891234567', 'pasien3', 'Pnu8jmzaQ16oggGMRxP5xJv9fFwyY2hVISIsRhDSaQOdBLNFApM77TQQOn/OgCwnjQr2oqXGkxjpigqs0O1zpb4MoKX++518f/jMr3MD1HCTH9xKIfxe', 'pasien tiga', 'kediri', '123456789123', '2022-01-31 18:53:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_inap`
--

CREATE TABLE `pendaftaran_inap` (
  `id_inap` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `waktu_masuk` datetime NOT NULL,
  `waktu_keluar` date DEFAULT NULL,
  `lama_hari` int(11) NOT NULL,
  `total_tagihan_inap` varchar(20) NOT NULL,
  `status_inap` enum('Belum Selesai','Selesai') NOT NULL DEFAULT 'Belum Selesai',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_rawat_jalan`
--

CREATE TABLE `pendaftaran_rawat_jalan` (
  `id_pendaftaran` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `keluhan` text NOT NULL,
  `umur` int(11) NOT NULL,
  `tanggal_daftar` datetime NOT NULL,
  `no_antrian` int(11) NOT NULL,
  `status_antrian` enum('Menunggu','Sudah Dipanggil') NOT NULL DEFAULT 'Menunggu',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendaftaran_rawat_jalan`
--

INSERT INTO `pendaftaran_rawat_jalan` (`id_pendaftaran`, `id_pasien`, `id_poli`, `id_jadwal`, `keluhan`, `umur`, `tanggal_daftar`, `no_antrian`, `status_antrian`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 1, 'sakit gigi saja', 20, '2022-02-03 00:00:00', 3, 'Menunggu', '2022-02-03 21:27:32', NULL),
(3, 3, 5, 1, 'anak sakit kepala', 22, '2022-02-04 00:00:00', 1, 'Menunggu', '2022-02-03 21:31:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `poliklinik`
--

CREATE TABLE `poliklinik` (
  `id_poli` int(11) NOT NULL,
  `nama_poli` varchar(30) NOT NULL,
  `status_poli` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Tidak Aktif',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poliklinik`
--

INSERT INTO `poliklinik` (`id_poli`, `nama_poli`, `status_poli`, `created_at`, `updated_at`) VALUES
(4, 'Gigi', 'Aktif', '2022-01-26 12:36:16', NULL),
(5, 'Anak', 'Aktif', '2022-01-26 12:37:01', NULL),
(6, 'Ibu', 'Aktif', '2022-01-29 09:12:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis_inap`
--

CREATE TABLE `rekam_medis_inap` (
  `id_rekam_inap` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `hasil_pemeriksaan` text NOT NULL,
  `saran_dokter` text NOT NULL,
  `tensi` int(11) NOT NULL,
  `waktu_rekam` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis_jalan`
--

CREATE TABLE `rekam_medis_jalan` (
  `id_pemeriksaan` int(11) NOT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `hasil_pemeriksaan` text NOT NULL,
  `saran_dokter` text NOT NULL,
  `tensi_darah` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `resep_inap`
--

CREATE TABLE `resep_inap` (
  `id_resep_inap` int(11) NOT NULL,
  `id_rekam_inap` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `resep_jalan`
--

CREATE TABLE `resep_jalan` (
  `id_resep` int(11) NOT NULL,
  `id_pemeriksaan` int(11) NOT NULL,
  `tagihan_obat` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sesi`
--

CREATE TABLE `sesi` (
  `id_sesi` int(11) NOT NULL,
  `nama_sesi` varchar(20) NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sesi`
--

INSERT INTO `sesi` (`id_sesi`, `nama_sesi`, `waktu_mulai`, `waktu_selesai`, `created_at`, `updated_at`) VALUES
(1, 'Sesi Satu', '07:00:00', '11:00:00', '2022-01-26 12:54:18', '2022-02-02 20:26:47'),
(3, 'Sesi dua', '13:00:00', '16:00:00', '2022-02-02 20:28:05', NULL),
(4, 'Sesi tiga', '17:00:00', '20:00:00', '2022-02-02 20:28:48', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `detail resep`
--
ALTER TABLE `detail resep`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_resep` (`id_resep`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `detail_resep_inap`
--
ALTER TABLE `detail_resep_inap`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_resep_inap` (`id_resep_inap`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indexes for table `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id_hari`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_hari` (`id_hari`),
  ADD KEY `id_sesi` (`id_sesi`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `pendaftaran_inap`
--
ALTER TABLE `pendaftaran_inap`
  ADD PRIMARY KEY (`id_inap`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_kamar` (`id_kamar`);

--
-- Indexes for table `pendaftaran_rawat_jalan`
--
ALTER TABLE `pendaftaran_rawat_jalan`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indexes for table `poliklinik`
--
ALTER TABLE `poliklinik`
  ADD PRIMARY KEY (`id_poli`);

--
-- Indexes for table `rekam_medis_inap`
--
ALTER TABLE `rekam_medis_inap`
  ADD PRIMARY KEY (`id_rekam_inap`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indexes for table `rekam_medis_jalan`
--
ALTER TABLE `rekam_medis_jalan`
  ADD PRIMARY KEY (`id_pemeriksaan`),
  ADD KEY `id_pendaftaran` (`id_pendaftaran`);

--
-- Indexes for table `resep_inap`
--
ALTER TABLE `resep_inap`
  ADD PRIMARY KEY (`id_resep_inap`),
  ADD KEY `id_rekam_inap` (`id_rekam_inap`);

--
-- Indexes for table `resep_jalan`
--
ALTER TABLE `resep_jalan`
  ADD PRIMARY KEY (`id_resep`),
  ADD KEY `id_pemeriksaan` (`id_pemeriksaan`);

--
-- Indexes for table `sesi`
--
ALTER TABLE `sesi`
  ADD PRIMARY KEY (`id_sesi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail resep`
--
ALTER TABLE `detail resep`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_resep_inap`
--
ALTER TABLE `detail_resep_inap`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hari`
--
ALTER TABLE `hari`
  MODIFY `id_hari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pendaftaran_inap`
--
ALTER TABLE `pendaftaran_inap`
  MODIFY `id_inap` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pendaftaran_rawat_jalan`
--
ALTER TABLE `pendaftaran_rawat_jalan`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `poliklinik`
--
ALTER TABLE `poliklinik`
  MODIFY `id_poli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rekam_medis_inap`
--
ALTER TABLE `rekam_medis_inap`
  MODIFY `id_rekam_inap` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekam_medis_jalan`
--
ALTER TABLE `rekam_medis_jalan`
  MODIFY `id_pemeriksaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `resep_inap`
--
ALTER TABLE `resep_inap`
  MODIFY `id_resep_inap` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resep_jalan`
--
ALTER TABLE `resep_jalan`
  MODIFY `id_resep` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sesi`
--
ALTER TABLE `sesi`
  MODIFY `id_sesi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail resep`
--
ALTER TABLE `detail resep`
  ADD CONSTRAINT `detail resep_ibfk_1` FOREIGN KEY (`id_resep`) REFERENCES `resep_jalan` (`id_resep`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail resep_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_resep_inap`
--
ALTER TABLE `detail_resep_inap`
  ADD CONSTRAINT `detail_resep_inap_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `detail_resep_inap_ibfk_2` FOREIGN KEY (`id_resep_inap`) REFERENCES `resep_inap` (`id_resep_inap`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`id_poli`) REFERENCES `poliklinik` (`id_poli`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD CONSTRAINT `jadwal_dokter_ibfk_1` FOREIGN KEY (`id_hari`) REFERENCES `hari` (`id_hari`),
  ADD CONSTRAINT `jadwal_dokter_ibfk_2` FOREIGN KEY (`id_sesi`) REFERENCES `sesi` (`id_sesi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_dokter_ibfk_3` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pendaftaran_inap`
--
ALTER TABLE `pendaftaran_inap`
  ADD CONSTRAINT `pendaftaran_inap_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pendaftaran_inap_ibfk_2` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pendaftaran_rawat_jalan`
--
ALTER TABLE `pendaftaran_rawat_jalan`
  ADD CONSTRAINT `pendaftaran_rawat_jalan_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pendaftaran_rawat_jalan_ibfk_2` FOREIGN KEY (`id_poli`) REFERENCES `poliklinik` (`id_poli`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pendaftaran_rawat_jalan_ibfk_3` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_dokter` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rekam_medis_inap`
--
ALTER TABLE `rekam_medis_inap`
  ADD CONSTRAINT `rekam_medis_inap_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekam_medis_inap_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rekam_medis_jalan`
--
ALTER TABLE `rekam_medis_jalan`
  ADD CONSTRAINT `rekam_medis_jalan_ibfk_2` FOREIGN KEY (`id_pendaftaran`) REFERENCES `pendaftaran_rawat_jalan` (`id_pendaftaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resep_inap`
--
ALTER TABLE `resep_inap`
  ADD CONSTRAINT `resep_inap_ibfk_1` FOREIGN KEY (`id_rekam_inap`) REFERENCES `rekam_medis_inap` (`id_rekam_inap`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resep_jalan`
--
ALTER TABLE `resep_jalan`
  ADD CONSTRAINT `resep_jalan_ibfk_1` FOREIGN KEY (`id_pemeriksaan`) REFERENCES `rekam_medis_jalan` (`id_pemeriksaan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
