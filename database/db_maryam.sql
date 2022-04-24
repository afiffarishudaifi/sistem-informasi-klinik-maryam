-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 24, 2022 at 06:57 AM
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
-- Database: `db_maryam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(35) NOT NULL,
  `alamat_admin` varchar(100) NOT NULL,
  `no_telp_admin` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `alamat_admin`, `no_telp_admin`) VALUES
(6, 'Gilang R', 'Kota Madiun', '084564564561'),
(7, 'Ahmad F', 'Kota Madiun', '084564564564');

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `id_antrian` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `keluhan` text NOT NULL,
  `umur` int(11) NOT NULL,
  `tanggal_daftar` datetime NOT NULL,
  `no_antrian` int(11) NOT NULL,
  `status_antrian` enum('Menunggu','Sudah Dipanggil') NOT NULL DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_penyakit`
--

CREATE TABLE `detail_penyakit` (
  `id_detail` int(11) NOT NULL,
  `id_rekam` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_resep`
--

CREATE TABLE `detail_resep` (
  `id_detail` int(11) NOT NULL,
  `id_resep` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah_obat` int(11) NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `tanggal_resep` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_resep`
--

INSERT INTO `detail_resep` (`id_detail`, `id_resep`, `id_obat`, `jumlah_obat`, `total_biaya`, `tanggal_resep`) VALUES
(3, 2, 3, 3, 30000, '2022-03-27 14:31:55'),
(4, 2, 3, 4, 40000, '2022-03-27 14:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `nik_dokter` varchar(16) NOT NULL,
  `nama_dokter` varchar(35) NOT NULL,
  `alamat_dokter` varchar(100) NOT NULL,
  `no_telp_dokter` int(13) NOT NULL,
  `status_dokter` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `foto_dokter` varchar(150) NOT NULL,
  `jenis_kelamin` enum('Laki - Laki','Perempuan') NOT NULL DEFAULT 'Laki - Laki',
  `tanggal_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`nik_dokter`, `nama_dokter`, `alamat_dokter`, `no_telp_dokter`, `status_dokter`, `foto_dokter`, `jenis_kelamin`, `tanggal_lahir`) VALUES
('3216549873216549', 'Meidina Putri Pitaloka', 'Kota Madiun Jawa Timur', 812541204, 'Aktif', 'docs/img/img_dokter/1648269627_224a183b4a7f04df968e.jpg', 'Perempuan', '2001-05-17');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `nama_kamar` varchar(50) NOT NULL,
  `biaya_kamar` varchar(15) NOT NULL,
  `status_kamar` enum('Kosong','Terisi') NOT NULL DEFAULT 'Kosong'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `nama_kamar`, `biaya_kamar`, `status_kamar`) VALUES
(1, 'Kamar 1A', '50000', 'Terisi'),
(2, 'Kamar 1B', '50000', 'Terisi'),
(3, 'Kamar 2A', '50000', 'Kosong'),
(4, 'Kamar 2B', '50000', 'Kosong');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `nik_karyawan` varchar(16) NOT NULL,
  `nama_karyawan` varchar(35) NOT NULL,
  `no_telp_karyawan` varchar(13) NOT NULL,
  `alamat_karyawan` varchar(100) NOT NULL,
  `status_karyawan` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `jenis_kelamin` enum('Laki - Laki','Perempuan') NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `foto_karyawan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`nik_karyawan`, `nama_karyawan`, `no_telp_karyawan`, `alamat_karyawan`, `status_karyawan`, `jenis_kelamin`, `tgl_lahir`, `foto_karyawan`) VALUES
('0212121212121212', 'Arya Bagus', '058965412325', 'Kota Madiun', 'Aktif', 'Laki - Laki', '2022-04-24', 'docs/img/img_karyawan/1650772533_cbdb5f285eee66158da5.png'),
('6541241254785451', 'Anin Artiana', '02132123212', 'Kota Kediri', 'Aktif', 'Perempuan', '2022-04-24', 'docs/img/img_karyawan/1650772284_9766fe2d632068e0f2a9.png'),
('6541241254785454', 'Naim Irfani', '08545745121', 'Kota Madiun', 'Aktif', 'Laki - Laki', '2022-04-24', 'docs/img/img_karyawan/1650772088_278e8e81e6129b0b6b9a.png');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_obat`
--

CREATE TABLE `kategori_obat` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_obat`
--

INSERT INTO `kategori_obat` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Tablet'),
(2, 'Sirup');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `stok_obat` int(11) NOT NULL,
  `harga_obat` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `id_kategori`, `nama_obat`, `stok_obat`, `harga_obat`) VALUES
(3, 2, 'Vitamin A', 86, 10000),
(4, 1, 'Vitamin B', 100, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `nik` varchar(16) NOT NULL,
  `nama_pasien` varchar(35) NOT NULL,
  `alamat_pasien` varchar(100) NOT NULL,
  `no_telp_pasien` varchar(13) NOT NULL,
  `jenis_kelamin` enum('Laki - Laki','Perempuan') NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` varchar(10) NOT NULL,
  `status` enum('Pasien Lama','Pasien Baru') DEFAULT 'Pasien Baru'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`nik`, `nama_pasien`, `alamat_pasien`, `no_telp_pasien`, `jenis_kelamin`, `tgl_lahir`, `agama`, `status`) VALUES
('3232323232323232', 'Afif Faris Hudaifi', 'Kota Madiun', '023541245782', 'Laki - Laki', '2022-04-24', 'Islam', 'Pasien Baru'),
('6565656565656565', 'Rizqunal Kafi', 'Kota Madiun', '02321232123', 'Laki - Laki', '2022-04-24', 'Kristen', 'Pasien Baru'),
('9898989898989898', 'Agus Wahyu', 'Kota Madiun', '089654784125', 'Laki - Laki', '2022-04-24', 'Islam', 'Pasien Baru');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `id_penyakit` int(11) NOT NULL,
  `nama_penyakit` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id_penyakit`, `nama_penyakit`, `deskripsi`) VALUES
(1, 'sakit kepala', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `id_poli` int(11) NOT NULL,
  `nama_poli` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`id_poli`, `nama_poli`) VALUES
(1, 'Poli Gigi');

-- --------------------------------------------------------

--
-- Table structure for table `rawat_inap`
--

CREATE TABLE `rawat_inap` (
  `id_inap` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `waktu_masuk` datetime NOT NULL,
  `waktu_keluar` date DEFAULT NULL,
  `lama_hari` int(11) DEFAULT NULL,
  `total_tagihan_inap` int(11) DEFAULT NULL,
  `status_inap` enum('Belum Selesai','Selesai') NOT NULL DEFAULT 'Belum Selesai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rawat_inap`
--

INSERT INTO `rawat_inap` (`id_inap`, `id_kamar`, `nik`, `waktu_masuk`, `waktu_keluar`, `lama_hari`, `total_tagihan_inap`, `status_inap`) VALUES
(2, 1, '8745123265991246', '2022-03-31 11:52:00', NULL, NULL, NULL, 'Belum Selesai'),
(3, 2, '2', '2022-04-11 16:40:00', NULL, NULL, 0, 'Belum Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `id_rekam` int(11) NOT NULL,
  `id_inap` int(11) DEFAULT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `nik_dokter` varchar(16) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `hasil_pemeriksaan` text NOT NULL,
  `saran_dokter` text NOT NULL,
  `tensi_darah` int(11) NOT NULL,
  `tanggal_rekam` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('Jalan','Inap') NOT NULL DEFAULT 'Jalan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekam_medis`
--

INSERT INTO `rekam_medis` (`id_rekam`, `id_inap`, `nik`, `nik_dokter`, `id_penyakit`, `hasil_pemeriksaan`, `saran_dokter`, `tensi_darah`, `tanggal_rekam`, `status`) VALUES
(5, 2, NULL, '3216549873216549', 1, 'bagus', 'bagus', 20, '2022-03-27 00:00:00', 'Inap');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `id_resep` int(11) NOT NULL,
  `id_rekam` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `status_bayar` enum('Lunas','Belum Lunas') NOT NULL DEFAULT 'Belum Lunas',
  `tagihan_obat` int(11) NOT NULL,
  `status` enum('Jalan','Inap') NOT NULL DEFAULT 'Jalan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`id_resep`, `id_rekam`, `tanggal`, `status_bayar`, `tagihan_obat`, `status`) VALUES
(2, 5, '2022-03-27', 'Belum Lunas', 0, 'Inap');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `nik_karyawan` varchar(16) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `oauth_id` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `level` enum('Admin','Pasien','Apoteker','Karyawan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nik`, `nik_karyawan`, `id_admin`, `email`, `oauth_id`, `password`, `level`) VALUES
(11, NULL, NULL, 6, 'gilang@gmail.com', '', 'fEuU7DjZf5ODYP/EdBl0yYrGeWoHLcijPK8Mgnc0TOSxbsz5+x84BUPkHZg7LTRuFE5j7ihLNRpXSCFCOHUqzJweXsQt30JMPurYEWsynghKRu32TQE=', 'Admin'),
(12, NULL, NULL, 7, 'ahmad@gmail.com', '', '3kvpMYQ2IbT2KBRizd0ZE0vHC39HY27TxjLX85igRJdyCe173fXAsBNtRzf48dxfaW2Wq0WUsPa2GJx6D5HizYYFccOMAE/5b/DKhCeG8u7ElfbKXg==', 'Admin'),
(20, NULL, '6541241254785454', NULL, 'naim@gmail.com', '', 'wZOp7uepKDFJ1iSA0uCewSdShLLkQ8dL1aBGenP76tkhYRvgm1MXIL3Csymz8x8G9ILP+bGfC35d8EJDSG935PcCuAg3ma8C5Dae1e3pFGLlgTeC', 'Karyawan'),
(22, NULL, '6541241254785451', NULL, 'anin@gmail.com', '', 'uWYGpbxlAwXNoAOsHXghcZZ23KQMgJ31f9zg7cG2uIkW51GG1VmLqx2eVIR/MOPz9lvY4ovbVklilBxGOnVKTMAdMxH28oFFe12my+JvZlX/w+zn', 'Apoteker'),
(23, NULL, '0212121212121212', NULL, 'arya@gmail.com', '', 'mRy6PG8wywnU6VXBWAPfWwNpPwWELXj3ARwwlSoDNI+tYCD80P3UnI640es3Ci2Bx+wtl+o44wSFttq6NYkFDhFxxdiT/IE9N9qX696LL1/Ey0xP', 'Karyawan'),
(28, '9898989898989898', NULL, NULL, 'agus@gmail.com', '', 'UnfU4yL4fMg6QLR5fNxOGANYMgFeeXbUfsOU32AdkemZGZBok5f/ex9NhgUfZztPeTXT+2RkBOGLQXGuvEN7wh6JDEFVya1tlk6wHwMMzc1y3+52', 'Pasien'),
(29, '6565656565656565', NULL, NULL, 'kafi@gmail.com', '', 'M2EEIMeAvR1iWEgxR5UDmL0vogtVzKTZ76JcNmR8NL0VvzDwH5Jd325R/mVDQ4WBXpaxrYFgUKISh6bgji0WbHxlS6mK71Wy4IdOCQhuS9LWfNG7', 'Pasien'),
(32, '3232323232323232', NULL, NULL, 'afiffaris5@gmail.com', '108858565960947332249', 'fe9HXK5JHGy1i8AaaZPlOjZFR0VgbFYr0syJzp5EP30QCw40Bh3RXRdLuQXcPpq1g2mZjtdO/1TIjwvranflsD0IxHW1E33mwxmlKGwQuGT0+DyN', 'Pasien');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id_antrian`),
  ADD KEY `nik` (`nik`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indexes for table `detail_penyakit`
--
ALTER TABLE `detail_penyakit`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_rekam` (`id_rekam`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indexes for table `detail_resep`
--
ALTER TABLE `detail_resep`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_resep` (`id_resep`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`nik_dokter`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nik_karyawan`);

--
-- Indexes for table `kategori_obat`
--
ALTER TABLE `kategori_obat`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id_penyakit`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id_poli`);

--
-- Indexes for table `rawat_inap`
--
ALTER TABLE `rawat_inap`
  ADD PRIMARY KEY (`id_inap`),
  ADD KEY `id_kamar` (`id_kamar`);

--
-- Indexes for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`id_rekam`),
  ADD KEY `id_inap` (`id_inap`),
  ADD KEY `nik` (`nik`),
  ADD KEY `nik_dokter` (`nik_dokter`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`id_resep`),
  ADD KEY `id_rekam` (`id_rekam`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `nik` (`nik`),
  ADD KEY `nik_karyawan` (`nik_karyawan`),
  ADD KEY `id_admin` (`id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id_antrian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detail_penyakit`
--
ALTER TABLE `detail_penyakit`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_resep`
--
ALTER TABLE `detail_resep`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori_obat`
--
ALTER TABLE `kategori_obat`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id_penyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
  MODIFY `id_poli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rawat_inap`
--
ALTER TABLE `rawat_inap`
  MODIFY `id_inap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `id_rekam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
  MODIFY `id_resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `antrian`
--
ALTER TABLE `antrian`
  ADD CONSTRAINT `antrian_ibfk_1` FOREIGN KEY (`id_poli`) REFERENCES `poli` (`id_poli`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `antrian_ibfk_2` FOREIGN KEY (`nik`) REFERENCES `pasien` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_resep`
--
ALTER TABLE `detail_resep`
  ADD CONSTRAINT `detail_resep_ibfk_1` FOREIGN KEY (`id_resep`) REFERENCES `resep` (`id_resep`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_resep_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `obat`
--
ALTER TABLE `obat`
  ADD CONSTRAINT `obat_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_obat` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rawat_inap`
--
ALTER TABLE `rawat_inap`
  ADD CONSTRAINT `rawat_inap_ibfk_1` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD CONSTRAINT `rekam_medis_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `pasien` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekam_medis_ibfk_2` FOREIGN KEY (`nik_dokter`) REFERENCES `dokter` (`nik_dokter`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekam_medis_ibfk_3` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekam_medis_ibfk_4` FOREIGN KEY (`id_inap`) REFERENCES `rawat_inap` (`id_inap`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `resep_ibfk_1` FOREIGN KEY (`id_rekam`) REFERENCES `rekam_medis` (`id_rekam`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `pasien` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`nik_karyawan`) REFERENCES `karyawan` (`nik_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
