-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 21, 2024 at 04:18 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Tambahkan ini untuk membuat database jika belum ada
CREATE DATABASE IF NOT EXISTS `yrd-pos`;

-- Tambahkan ini untuk memilih database
USE `yrd-pos`;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yrd-pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int NOT NULL,
  `no_transaksi` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `kode_produk` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_produk` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `qty` int NOT NULL,
  `harga_jual` int NOT NULL,
  `total_harga` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `no_transaksi`, `tgl_transaksi`, `kode_produk`, `nama_produk`, `qty`, `harga_jual`, `total_harga`) VALUES
(57, 'TR0001', '2024-07-20', 'PD-002', 'Coca-cola', 1, 8000, 8000),
(58, 'TR0001', '2024-07-20', 'PD-005', 'Mie Instan', 2, 3000, 6000),
(60, 'TR0002', '2024-07-20', 'PD-001', 'Minyak', 1, 15000, 15000),
(62, 'TR0003', '2024-07-20', 'PD-006', 'Tepung Terigu', 1, 8000, 8000),
(63, 'TR0003', '2024-07-20', 'PD-007', 'Telur Ayam', 5, 2000, 10000),
(64, 'TR0003', '2024-07-20', 'PD-009', 'Beras', 1, 12000, 12000),
(65, 'TR0003', '2024-07-20', 'PD-004', 'Gula Pasir', 1, 13000, 13000),
(66, 'TR0004', '2024-07-20', 'PD-003', 'Aqua', 1, 5000, 5000),
(67, 'TR0004', '2024-07-20', 'PD-010', 'Roti Tawar', 1, 12000, 12000),
(87, 'TR0005', '2024-07-20', 'PD-008', 'Susu UHT', 1, 14550, 14550),
(88, 'TR0005', '2024-07-20', 'PD-004', 'Gula Pasir', 1, 12610, 12610),
(99, 'TR0006', '2024-07-20', 'PD-004', 'Gula Pasir', 1, 12610, 12610),
(100, 'TR0006', '2024-07-20', 'PD-006', 'Tepung Terigu', 2, 7760, 15520),
(101, 'TR0007', '2024-07-20', 'PD-001', 'Minyak', 1, 15000, 15000),
(102, 'TR0007', '2024-07-20', 'PD-004', 'Gula Pasir', 1, 13000, 13000),
(105, 'TR0008', '2024-07-20', 'PD-003', 'Aqua', 1, 4850, 4850),
(106, 'TR0008', '2024-07-20', 'PD-005', 'Mie Instan', 1, 2910, 2910),
(126, 'TR0009', '2024-07-21', 'PD-006', 'Tepung Terigu', 3, 8000, 24000),
(127, 'TR0009', '2024-07-21', 'PD-005', 'Mie Instan', 1, 3000, 3000),
(128, 'TR0009', '2024-07-21', 'PD-009', 'Beras', 1, 12000, 12000);

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `id_member` int NOT NULL,
  `nama_member` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `nik` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `nohp` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`id_member`, `nama_member`, `nik`, `alamat`, `nohp`) VALUES
(10, 'Supri', '1234567891234561', 'Jln. Kebo Iwa Barat', '082382918847'),
(12, 'Yuda', '1234567891234512', 'Jln. Gunung Agung', '082382918841');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int NOT NULL,
  `user_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_pengguna` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` int NOT NULL COMMENT '1-administrator\r\n2-supervisor\r\n3-operator',
  `nohp_pengguna` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `user_name`, `password`, `nama_pengguna`, `jabatan`, `nohp_pengguna`, `foto`) VALUES
(7, 'kasir1', '$2y$10$AgX6f1xxDaj0TctWKJJQOO8NeZ.ao1h8GBemEZ06c8qrOAlIc/nFe', 'Udin Surudin', 3, '081234567898', 'default.png'),
(8, 'admin', '$2y$10$NivunGHxhWJ/KpVAgMkKsO.oWduOOuPxMQ.azCAvm5lVDE62FlMGK', 'I Putu Yogi Pradnyana', 1, '081234567890', 'default.png'),
(9, 'kasir2', '$2y$10$uWDBN24SV5qU0mrWg.Xt/eBVMm4D/WPPnXOlD.JyJrOoewpf0EPwy', 'I Kadek Yuga Sutrisno', 3, '081234567899', 'default.png'),
(10, 'supervisor', '$2y$10$ZkY.1gkkZB.52Zsh8M3m0eR3Jhl3cw1x7lgX0Y8vpLpjUjDq69jAi', 'Ni Wayan Sumintri', 2, '081234567872', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `kode_produk` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_produk` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `satuan` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `harga_jual` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`kode_produk`, `nama_produk`, `satuan`, `harga_jual`) VALUES
('PD-001', 'Minyak', 'botol', 15000),
('PD-003', 'Aqua', 'botol', 5000),
('PD-004', 'Gula Pasir', 'kg', 13000),
('PD-005', 'Mie Instan', 'bungkus', 3000),
('PD-006', 'Tepung Terigu', 'kg', 8000),
('PD-007', 'Telur Ayam', 'butir', 2000),
('PD-008', 'Susu UHT', 'liter', 15000),
('PD-009', 'Beras', 'kg', 12000),
('PD-010', 'Roti Tawar', 'bungkus', 12000),
('PD-011', 'Kentang', 'kg', 15000),
('PD-012', 'Tomat', 'kg', 10000),
('PD-013', 'Bawang Merah', 'kg', 30000),
('PD-014', 'Bawang Putih', 'kg', 28000),
('PD-015', 'Cabe Rawit', 'kg', 35000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `no_transaksi` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `id_pengguna` int NOT NULL,
  `id_member` int DEFAULT NULL,
  `total_transaksi` int NOT NULL,
  `jml_bayar` int NOT NULL,
  `kembalian` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`no_transaksi`, `tgl_transaksi`, `id_pengguna`, `id_member`, `total_transaksi`, `jml_bayar`, `kembalian`) VALUES
('TR0001', '2024-07-20', 8, NULL, 14000, 20000, 6000),
('TR0002', '2024-07-20', 8, 10, 15000, 20000, 5000),
('TR0003', '2024-07-20', 8, 10, 43000, 50000, 7000),
('TR0004', '2024-07-20', 8, 12, 17000, 20000, 3000),
('TR0005', '2024-07-20', 8, 10, 27160, 50000, 22840),
('TR0006', '2024-07-20', 8, NULL, 28130, 30000, 1870),
('TR0007', '2024-07-20', 8, NULL, 28000, 30000, 2000),
('TR0008', '2024-07-20', 8, NULL, 7760, 10000, 2240),
('TR0009', '2024-07-21', 7, NULL, 39000, 50000, 11000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`kode_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_member` (`id_member`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id_member` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_member`) REFERENCES `pembeli` (`id_member`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
