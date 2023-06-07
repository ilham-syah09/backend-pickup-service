-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 07, 2023 at 03:24 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_paket`
--

-- --------------------------------------------------------

--
-- Table structure for table `ekspedisi`
--

CREATE TABLE `ekspedisi` (
  `id` int(11) NOT NULL,
  `ekspedisi` varchar(50) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ekspedisi`
--

INSERT INTO `ekspedisi` (`id`, `ekspedisi`, `createdAt`, `updatedAt`) VALUES
(3, 'JNE', '2023-05-23 08:01:12', '0000-00-00 00:00:00'),
(4, 'Silambat', '2023-05-23 08:01:19', '0000-00-00 00:00:00'),
(5, 'J&T', '2023-05-23 13:56:58', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id` int(11) NOT NULL,
  `namaPaket` varchar(255) NOT NULL,
  `berat` float NOT NULL,
  `jarak` float NOT NULL,
  `idUser` int(11) NOT NULL,
  `idEkspedisi` int(11) NOT NULL,
  `lati` varchar(100) NOT NULL,
  `longi` varchar(100) NOT NULL,
  `catatan` text DEFAULT NULL,
  `totalBiaya` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id`, `namaPaket`, `berat`, `jarak`, `idUser`, `idEkspedisi`, `lati`, `longi`, `catatan`, `totalBiaya`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'HP Samsul', 1, 328.9, 2, 4, '-6.871041612752357', '109.10836011171342', 'Gor Wisang Geni', 25000, 'Lunas', '2023-05-23 13:54:47', '2023-05-25 03:43:38');

-- --------------------------------------------------------

--
-- Table structure for table `pickup_keys`
--

CREATE TABLE `pickup_keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pickup_keys`
--

INSERT INTO `pickup_keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, '247c8062ab84fad43', 1, 0, 0, NULL, '2023-05-25 04:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `progres`
--

CREATE TABLE `progres` (
  `id` int(11) NOT NULL,
  `idPaket` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `catatan` text NOT NULL,
  `foto` text DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progres`
--

INSERT INTO `progres` (`id`, `idPaket`, `status`, `catatan`, `foto`, `createdAt`) VALUES
(1, 1, 'Dikirim', 'Paket telah dikirim ke alamat tujuan', NULL, '2023-05-23 14:10:58'),
(6, 1, 'Diterima', 'Diterima oleh ibunya syah', '86559c6f5d00bd8088285456a7bb2ffc.png', '2023-05-25 02:13:26');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `lati` varchar(100) NOT NULL,
  `longi` varchar(100) NOT NULL,
  `lintangBujur` varchar(100) NOT NULL,
  `maxJarak` int(3) NOT NULL,
  `hargaKm` int(11) NOT NULL,
  `hargaKg` int(7) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `lati`, `longi`, `lintangBujur`, `maxJarak`, `hargaKm`, `hargaKg`, `createdAt`, `updatedAt`) VALUES
(1, '-6.8698758875040085', '109.11970719695091', '-6.8698758875040085, 109.11970719695091', 3, 5000, 10000, '2023-05-23 12:58:14', '2023-06-03 11:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role_id` int(1) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `image` varchar(50) NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `role_id`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'admin', '$2y$10$ZdZIpysS8TWn8cTr5Awao.nEY4RXnkUYijO1YWhqSUQGgfrRLzFyi', 1, 0, 'default.png', '2023-04-05 16:13:20', NULL),
(2, 'Syah', 'syah@gmail.com', '$2y$10$ovxlZRyv1NFbrX/zmMJGiuUSIvjYDh83wxnhg1Qe2UFggASpZ/8TO', 2, 1, 'default.png', '2023-05-23 07:59:55', '2023-05-25 06:43:31'),
(15, 'Si Yoi', 'si.yoi@gmail.com', '$2y$10$88QJ5O2N3nheOTFARsGOTe5h4f0A9IgUrwiCgx6BpepdUUAmO9aGu', 2, 1, 'fe7e3428b390b5f959754742d7c2580a.jpg', '2023-05-25 07:06:35', '2023-05-25 09:17:20'),
(17, 'Bastian', 'bastian.nazaromi@gmail.com', '$2y$10$ZrxW5nnxkV1qBn14iw64H.rN0XhCSx0.NSMNpbADZ.2v.yKZzaq46', 2, 1, 'e99f16c3a81e6f37b3bd0270d2252f68.jpg', '2023-05-30 01:36:04', '2023-05-30 07:46:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ekspedisi`
--
ALTER TABLE `ekspedisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pickup_keys`
--
ALTER TABLE `pickup_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progres`
--
ALTER TABLE `progres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ekspedisi`
--
ALTER TABLE `ekspedisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pickup_keys`
--
ALTER TABLE `pickup_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `progres`
--
ALTER TABLE `progres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
