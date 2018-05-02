-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2018 at 09:14 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_onparking`
--

-- --------------------------------------------------------

--
-- Table structure for table `kantong_parkir`
--

CREATE TABLE `kantong_parkir` (
  `id_kantongParkir` int(2) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kapasitas` int(4) NOT NULL,
  `terpakai` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `plat_nomor` varchar(10) NOT NULL,
  `jenis` enum('Motor','Mobil') NOT NULL,
  `merk` varchar(20) NOT NULL,
  `tipe` varchar(20) NOT NULL,
  `id_mahasiswa` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswas`
--

CREATE TABLE `mahasiswas` (
  `id` int(6) NOT NULL,
  `email` varchar(255) NOT NULL,
  `api_token` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nif` char(5) NOT NULL,
  `prodi` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswas`
--

INSERT INTO `mahasiswas` (`id`, `email`, `api_token`, `password`, `nama`, `nif`, `prodi`, `updated_at`, `created_at`) VALUES
(1, 'afan@gmail.com', '', 'password', '', '', '', '2018-04-26 01:06:50', '2018-04-26 01:06:50'),
(11, 'afanazmi@gmail.com', '$2y$10$kXok8ONO0.zUdNEMtsnBxu4zEcn6lW7mVdja5XoDONU7kZIsLCL9.', '$2y$10$fmcgSQnIbTQp9.gITEZ0uO.ZMjgbpjlOIJwMJY4DNHe/Q4qRAFZTm', 'Muhammad Afan', '11547', 'KOMSI', '2018-04-30 01:25:33', '2018-04-30 01:25:33'),
(19, 'afan123azmy@gmail.com', '$2y$10$HUkz4ORgwOZm4bz80ZfYF.isUw.UhtvbuOQtu33mTomR6jfWmG6He', '$2y$10$uFWotVtea9v9f09U.0yCUuzTxZ7Crkk1G.CLeRjNqtoRqRacbUy/S', 'Afan Azmi', '11548', 'KOMSI', '2018-04-30 06:51:23', '2018-04-30 06:51:23');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_04_28_100925_update_mahasiswas_add_remember_token', 1);

-- --------------------------------------------------------

--
-- Table structure for table `parkir`
--

CREATE TABLE `parkir` (
  `id_parkir` int(10) NOT NULL,
  `id_mahasiswa` int(6) NOT NULL,
  `plat_nomor` varchar(10) NOT NULL,
  `id_kantongParkir` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kantong_parkir`
--
ALTER TABLE `kantong_parkir`
  ADD PRIMARY KEY (`id_kantongParkir`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`plat_nomor`),
  ADD KEY `fk_idUser` (`id_mahasiswa`);

--
-- Indexes for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nif` (`nif`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parkir`
--
ALTER TABLE `parkir`
  ADD PRIMARY KEY (`id_parkir`),
  ADD KEY `fk_idUserParkir` (`id_mahasiswa`),
  ADD KEY `fk_platNomor` (`plat_nomor`),
  ADD KEY `fk_idKantongParkir` (`id_kantongParkir`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kantong_parkir`
--
ALTER TABLE `kantong_parkir`
  MODIFY `id_kantongParkir` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `parkir`
--
ALTER TABLE `parkir`
  MODIFY `id_parkir` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD CONSTRAINT `fk_idUser` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswas` (`id`);

--
-- Constraints for table `parkir`
--
ALTER TABLE `parkir`
  ADD CONSTRAINT `fk_idKantongParkir` FOREIGN KEY (`id_kantongParkir`) REFERENCES `kantong_parkir` (`id_kantongParkir`),
  ADD CONSTRAINT `fk_idUserParkir` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswas` (`id`),
  ADD CONSTRAINT `fk_platNomor` FOREIGN KEY (`plat_nomor`) REFERENCES `kendaraan` (`plat_nomor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
