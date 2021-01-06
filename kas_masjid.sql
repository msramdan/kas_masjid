-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2020 at 03:08 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kas_masjid`
--

-- --------------------------------------------------------

--
-- Table structure for table `categori_sumber`
--

CREATE TABLE `categori_sumber` (
  `categori_sumber_id` int(11) NOT NULL,
  `nama_categori_sumber` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categori_sumber`
--

INSERT INTO `categori_sumber` (`categori_sumber_id`, `nama_categori_sumber`) VALUES
(1, 'Infaq Kencleng'),
(2, 'QRIS'),
(3, 'Transfer'),
(4, 'Pihaj Ke 3 yang tidak terkait'),
(5, 'Laznas');

-- --------------------------------------------------------

--
-- Table structure for table `categori_tujuan`
--

CREATE TABLE `categori_tujuan` (
  `categori_tujuan_id` int(11) NOT NULL,
  `nama_categori_tujuan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categori_tujuan`
--

INSERT INTO `categori_tujuan` (`categori_tujuan_id`, `nama_categori_tujuan`) VALUES
(1, 'Operasional'),
(2, 'Gaji'),
(3, 'Pembayaran Listrik'),
(4, 'Imam Khotbah'),
(5, 'Cuci Karpet');

-- --------------------------------------------------------

--
-- Table structure for table `kas_masjid`
--

CREATE TABLE `kas_masjid` (
  `id_km` int(11) NOT NULL,
  `tgl_km` date NOT NULL,
  `uraian_km` varchar(200) NOT NULL,
  `masuk` int(11) NOT NULL,
  `keluar` int(11) NOT NULL,
  `jenis` enum('Masuk','Keluar') NOT NULL,
  `categori_sumber_id` int(11) DEFAULT NULL,
  `categori_tujuan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kas_masjid`
--

INSERT INTO `kas_masjid` (`id_km`, `tgl_km`, `uraian_km`, `masuk`, `keluar`, `jenis`, `categori_sumber_id`, `categori_tujuan_id`) VALUES
(44, '2020-12-31', 'test', 90000, 0, 'Masuk', 1, NULL),
(46, '2020-12-31', 'kdasjk', 0, 9000, 'Keluar', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kas_sosial`
--

CREATE TABLE `kas_sosial` (
  `id_ks` int(11) NOT NULL,
  `tgl_ks` date NOT NULL,
  `uraian_ks` varchar(200) NOT NULL,
  `masuk` int(11) NOT NULL,
  `keluar` int(11) NOT NULL,
  `jenis` enum('Masuk','Keluar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kas_sosial`
--

INSERT INTO `kas_sosial` (`id_ks`, `tgl_ks`, `uraian_ks`, `masuk`, `keluar`, `jenis`) VALUES
(3, '2020-03-24', 'bantu banjir', 0, 150000, 'Keluar'),
(5, '2020-03-20', 'Hamba Alloh', 1000000, 0, 'Masuk'),
(6, '2020-03-01', 'tes tanpa internet', 200000, 0, 'Masuk'),
(7, '2020-03-27', 'tes 123', 0, 10000, 'Keluar'),
(8, '2020-03-23', 'regek sos', 120000, 0, 'Masuk'),
(9, '2020-03-02', 'metu rg', 0, 15000, 'Keluar'),
(10, '2020-03-15', 'tes lg', 230000, 0, 'Masuk');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_username` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(100) NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `telepon` varchar(100) NOT NULL,
  `id_level` int(2) NOT NULL,
  `is_aktive` enum('1','2') NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_username`, `username`, `password`, `nama`, `email`, `alamat`, `kota`, `provinsi`, `telepon`, `id_level`, `is_aktive`, `create_date`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin Aplikasi', 'admin@kangramdan.com', 'Jln Dewi Sartika', 'Bekasi', 'Jawa Barat', '083874731480', 1, '1', '2020-05-22 16:40:14'),
(4, 'ramdan', '889752dcb81b4ad98ad6e36e9db2cd43', 'ramdan', 'genz9090@gmail.com', 'Jln Dewi Sartika', 'Bekasi', 'Jawa Barat', '083874731480', 2, '1', '2020-05-23 02:24:33'),
(5, 'alim123', '5de9bd14b133563257032b665b0d77df', 'alim', 'saepulramdan244@gmail.com', '', '', '', '', 2, '1', '2020-06-05 18:11:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id_level` int(2) NOT NULL,
  `nama_user_level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id_level`, `nama_user_level`) VALUES
(1, 'Admin'),
(2, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categori_sumber`
--
ALTER TABLE `categori_sumber`
  ADD PRIMARY KEY (`categori_sumber_id`);

--
-- Indexes for table `categori_tujuan`
--
ALTER TABLE `categori_tujuan`
  ADD PRIMARY KEY (`categori_tujuan_id`);

--
-- Indexes for table `kas_masjid`
--
ALTER TABLE `kas_masjid`
  ADD PRIMARY KEY (`id_km`),
  ADD KEY `categori_sumber_id` (`categori_sumber_id`),
  ADD KEY `categori_tujuan_id` (`categori_tujuan_id`);

--
-- Indexes for table `kas_sosial`
--
ALTER TABLE `kas_sosial`
  ADD PRIMARY KEY (`id_ks`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_username`),
  ADD KEY `id_level` (`id_level`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categori_sumber`
--
ALTER TABLE `categori_sumber`
  MODIFY `categori_sumber_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categori_tujuan`
--
ALTER TABLE `categori_tujuan`
  MODIFY `categori_tujuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kas_masjid`
--
ALTER TABLE `kas_masjid`
  MODIFY `id_km` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `kas_sosial`
--
ALTER TABLE `kas_sosial`
  MODIFY `id_ks` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_username` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id_level` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kas_masjid`
--
ALTER TABLE `kas_masjid`
  ADD CONSTRAINT `kas_masjid_ibfk_1` FOREIGN KEY (`categori_sumber_id`) REFERENCES `categori_sumber` (`categori_sumber_id`),
  ADD CONSTRAINT `kas_masjid_ibfk_2` FOREIGN KEY (`categori_tujuan_id`) REFERENCES `categori_tujuan` (`categori_tujuan_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `user_level` (`id_level`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
