-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2024 at 08:51 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundryku`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `transaksi_id` int(11) DEFAULT NULL,
  `paket_id` int(11) DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `total_harga` double DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `total_pajak` int(11) DEFAULT NULL,
  `total_diskon` int(11) DEFAULT NULL,
  `total_asli` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `transaksi_id`, `paket_id`, `qty`, `total_harga`, `keterangan`, `total_bayar`, `total_pajak`, `total_diskon`, `total_asli`) VALUES
(85, 112, 4, 2, 34100, NULL, NULL, 3100, 0, 31000),
(86, 113, 4, 2, 34100, NULL, 35000, 3100, 0, 31000),
(87, 114, 4, 2, 34100, NULL, 50000, 3100, 0, 31000),
(88, 115, 4, 2, 34100, NULL, NULL, 3100, 0, 31000),
(89, 116, 4, 1, 17600, NULL, NULL, 1600, 0, 16000),
(90, 117, 4, 2, 30690, NULL, NULL, 2790, 3100, 31000),
(91, 118, 4, 2, 30690, NULL, NULL, 2790, 3100, 31000),
(92, 119, 4, 2, 30690, NULL, NULL, 2790, 3100, 31000);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `nama_member` varchar(100) DEFAULT NULL,
  `alamat_member` text DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `telp_member` varchar(15) DEFAULT NULL,
  `no_ktp` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `nama_member`, `alamat_member`, `jenis_kelamin`, `telp_member`, `no_ktp`) VALUES
(5, 'Abang Fikrii', 'Ciamiss', 'L', '0821340411', '123456789'),
(6, 'Rizky jernad', 'Jalan Subak Pakel', 'L', '04141412414', '43552525'),
(9, 'aguscuki', 'ffrreferfer', 'L', '31314234', '43241224'),
(10, 'baru', 'cscavdav', 'L', 'vdvvvdfvfd', 'ff4r34r43r34r34');

-- --------------------------------------------------------

--
-- Table structure for table `outlet`
--

CREATE TABLE `outlet` (
  `id_outlet` int(11) NOT NULL,
  `nama_outlet` varchar(100) DEFAULT NULL,
  `alamat_outlet` text DEFAULT NULL,
  `telp_outlet` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `outlet`
--

INSERT INTO `outlet` (`id_outlet`, `nama_outlet`, `alamat_outlet`, `telp_outlet`) VALUES
(26, 'Outlet Mawares', 'Jalan Mawarrkuuzyy', '081243555656332'),
(27, 'outlet batantax', 'batantaaxx', '45363663424'),
(28, 'outlet monang maningg', 'monang maning', '5335455');

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `jenis_paket` enum('kiloan','selimut','bedcover','kaos','lain') DEFAULT NULL,
  `nama_paket` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `outlet_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `jenis_paket`, `nama_paket`, `harga`, `outlet_id`) VALUES
(4, 'kiloan', 'Paket Kering Wangi', 15000, 26),
(5, 'kiloan', 'Paket Expressxxx', 7000, 26);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `outlet_id` int(11) DEFAULT NULL,
  `kode_invoice` varchar(100) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  `batas_waktu` datetime DEFAULT NULL,
  `tgl_pembayaran` datetime DEFAULT NULL,
  `biaya_tambahan` int(11) DEFAULT NULL,
  `diskon` double DEFAULT NULL,
  `pajak` double DEFAULT NULL,
  `status` enum('baru','proses','selesai','diambil') DEFAULT NULL,
  `status_bayar` enum('dibayar','belum') DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `outlet_id`, `kode_invoice`, `member_id`, `tgl`, `batas_waktu`, `tgl_pembayaran`, `biaya_tambahan`, `diskon`, `pajak`, `status`, `status_bayar`, `user_id`) VALUES
(112, 26, 'INV202402124749', 9, '2024-02-12 01:50:00', '2024-02-19 12:00:00', NULL, 1000, 0, 0.1, 'baru', 'belum', 13),
(113, 26, 'INV202402120950', 9, '2024-02-12 01:50:15', '2024-02-19 12:00:00', '2024-02-12 02:44:09', 1000, 0, 0.1, 'baru', 'dibayar', 13),
(114, 26, 'INV202402122750', 9, '2024-02-12 01:50:33', '2024-02-19 12:00:00', '2024-02-12 02:53:54', 1000, 0, 0.1, 'baru', 'dibayar', 13),
(115, 26, 'INV202402123950', 9, '2024-02-12 01:50:53', '2024-02-19 12:00:00', NULL, 1000, 0, 0.1, 'baru', 'belum', 13),
(116, 26, 'INV202402190858', 5, '2024-02-19 03:58:25', '2024-02-26 12:00:00', NULL, 1000, 0, 0.1, 'baru', 'belum', 13),
(117, 26, 'INV202402194306', 9, '2024-02-19 04:06:53', '2024-02-26 12:00:00', NULL, 1000, 0.1, 0.1, 'baru', 'belum', 13),
(118, 26, 'INV202402242135', 9, '2024-02-24 08:35:36', '2024-03-02 12:00:00', NULL, 1000, 0.1, 0.1, 'baru', 'belum', 13),
(119, 26, 'INV202402240838', 9, '2024-02-24 08:38:14', '2024-03-02 12:00:00', NULL, 1000, 0.1, 0.1, 'baru', 'belum', 32);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `outlet_id` int(11) DEFAULT NULL,
  `role` enum('admin','kasir','owner') DEFAULT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `outlet_id`, `role`, `gambar`) VALUES
(13, 'tioatrik', 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, 'admin', 'rayul-_M6gy9oHgII-unsplash.jpg'),
(15, 'rizky', 'rizky', 'd41d8cd98f00b204e9800998ecf8427e', NULL, 'kasir', 'bjj2.jpg'),
(26, 'adsda', 'dash', 'dashb', NULL, 'admin', 'fitnes.jpg'),
(32, 'kasir', 'kasir', 'c7911af3adbd12a035b289556d96470a', 26, 'kasir', 'job-skilvul-modal-1658473807321.jpg'),
(33, 'owner', 'owner', '72122ce96bfec66e2396d2e25225d70a', NULL, 'owner', 'logo-hero2.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `transaksi_id` (`transaksi_id`),
  ADD KEY `paket_id` (`paket_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`id_outlet`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`),
  ADD KEY `outlet_id` (`outlet_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `outlet_id` (`outlet_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `outlet_id` (`outlet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `outlet`
--
ALTER TABLE `outlet`
  MODIFY `id_outlet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id_transaksi`),
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id_paket`);

--
-- Constraints for table `paket`
--
ALTER TABLE `paket`
  ADD CONSTRAINT `paket_ibfk_1` FOREIGN KEY (`outlet_id`) REFERENCES `outlet` (`id_outlet`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`outlet_id`) REFERENCES `outlet` (`id_outlet`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `member` (`id_member`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`outlet_id`) REFERENCES `outlet` (`id_outlet`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
