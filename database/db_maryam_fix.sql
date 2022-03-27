-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 27, 2022 at 11:09 AM
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
  `id_user` int(11) NOT NULL,
  `nama_admin` varchar(35) NOT NULL,
  `alamat_admin` varchar(100) NOT NULL,
  `no_telp_admin` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `id_user`, `nama_admin`, `alamat_admin`, `no_telp_admin`) VALUES
(1, 2, 'Jaya Hartono', 'Kota Madiun', '085697458123');

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

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id_antrian`, `nik`, `id_poli`, `keluhan`, `umur`, `tanggal_daftar`, `no_antrian`, `status_antrian`) VALUES
(1, '8745123265991246', 1, 'sakit gigi', 22, '2022-03-27 00:00:00', 1, 'Menunggu'),
(2, '8745123265991246', 1, 'gigi gusi', 23, '2022-03-27 00:00:00', 2, 'Menunggu');

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
(1, 1, 3, 3, 30000, '2022-03-27 14:31:55'),
(2, 1, 3, 2, 20000, '2022-03-27 14:31:55'),
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
(1, 'Kamar 1A', '50000', 'Terisi');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `nik_karyawan` varchar(16) NOT NULL,
  `id_user` int(11) NOT NULL,
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

INSERT INTO `karyawan` (`nik_karyawan`, `id_user`, `nama_karyawan`, `no_telp_karyawan`, `alamat_karyawan`, `status_karyawan`, `jenis_kelamin`, `tgl_lahir`, `foto_karyawan`) VALUES
('7410852096307410', 4, 'Mahesa Karyawan', '085641254123', 'Kota madiun', 'Aktif', 'Laki - Laki', '2021-11-10', 'docs/img/img_karyawan/1648271500_77694736cf8e5d5f55a5.png');

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
(3, 2, 'Vitamin A', 86, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `nik` varchar(16) NOT NULL,
  `id_user` int(11) NOT NULL,
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

INSERT INTO `pasien` (`nik`, `id_user`, `nama_pasien`, `alamat_pasien`, `no_telp_pasien`, `jenis_kelamin`, `tgl_lahir`, `agama`, `status`) VALUES
('8745123265991246', 7, 'Kautsa Pasien', 'kota madiun', '087451236541', 'Laki - Laki', '2021-10-07', 'Islam', 'Pasien Baru');

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
(2, 1, '8745123265991246', '2022-03-31 11:52:00', NULL, NULL, NULL, 'Belum Selesai');

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
(1, NULL, '8745123265991246', '3216549873216549', 1, 'hasil juga aman', 'saran dokter aman', 20, '2022-03-15 19:43:27', 'Jalan'),
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
(1, 1, '2022-03-08', 'Belum Lunas', 0, 'Jalan'),
(2, 5, '2022-03-27', 'Belum Lunas', 0, 'Inap');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `oauth_id` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `level` enum('Admin','Pasien','Apoteker','Karyawan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `oauth_id`, `password`, `level`) VALUES
(1, 'afiffaris5@gmail.com', '108858565960947332249', '', 'Pasien'),
(2, 'admin@gmail.com', '', '6z4cOSbH/gRIixMPDzRNZ3TjrzjLUp9RHyv/WruEBqmFkbDlYs1WknDh+j1OMhG9lly/KYIhRKf5g0dqvhqK/HTnrd8VEe+2hRzzYYbIDrUYE0uDp4I=', 'Admin'),
(4, '', '', '44ZnaYvNibvKD4ybbg33LdFdnBLJZR480yYvu976hF1aB5lqIl/sQ1ghYuOWkw88jNZ2Qtgxz8nq25bDgmbyrP6F5KX1fjY4evo50Y45kFeYJ+gnWjFA5wA=', 'Karyawan'),
(7, 'kautsa@gmail.com', '', 'AvVFJ9sSTCJ2TYH87WYTnELIz8Nfzl3TdKlE4DXUAoFzTONCoU6wA+BV4kodCqN4WSxDTCG7elq0pENqNt/hOuZaGP39Cg+uM+QSvTCuflLZw2BIP1wt', 'Pasien');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `id_user` (`id_user`);

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
  ADD PRIMARY KEY (`nik_karyawan`),
  ADD KEY `id_user` (`id_user`);

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
  ADD PRIMARY KEY (`nik`),
  ADD KEY `id_user` (`id_user`);

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
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id_antrian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori_obat`
--
ALTER TABLE `kategori_obat`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id_inap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `obat`
--
ALTER TABLE `obat`
  ADD CONSTRAINT `obat_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_obat` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pasien`
--
ALTER TABLE `pasien`
  ADD CONSTRAINT `pasien_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
