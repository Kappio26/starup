-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2024 at 01:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `startup`
--

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_order` int(22) NOT NULL,
  `id_user` int(22) NOT NULL,
  `username` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `nama_paket` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `waktu_order` datetime NOT NULL,
  `status_order` varchar(50) NOT NULL DEFAULT 'pending',
  `nama_pegawai` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_order`, `id_user`, `username`, `no_telp`, `alamat`, `nama_paket`, `harga`, `waktu_order`, `status_order`, `nama_pegawai`) VALUES
(1, 7, 'abil', '089123211223', 'gowa', 'Cuci Mobil', '50.000', '2023-11-21 19:00:00', 'Batal', NULL),
(2, 7, 'abil', '089123211223', 'gowa', 'Cuci Motor', '25.000', '2023-11-21 19:00:00', 'Batal', NULL),
(3, 7, 'abil', '089123211223', 'gowa', 'Cuci Motor', '25.000', '2023-11-21 19:00:00', 'selesai', 'arip'),
(4, 7, 'abil', '089123211223', 'gowa', 'Cuci Motor', '25.000', '2023-11-21 12:11:00', 'Batal', NULL),
(5, 7, 'abil', '089123211223', 'gowa', 'Cuci Motor', '25.000', '2023-11-21 12:12:00', 'selesai', 'parhan'),
(6, 7, 'abil', '089123211223', 'gowa', 'Cuci Motor', '25.000', '2023-11-21 12:26:00', 'selesai', 'parhan'),
(7, 7, 'abil', '089123211223', 'gowa', 'Cuci Motor', '25.000', '2023-11-21 12:26:00', 'Batal', NULL),
(8, 7, 'abil', '089123211223', 'gowa', 'Cuci Motor', '25.000', '2023-11-21 12:26:00', 'selesai', 'parhan'),
(9, 7, 'abil', '089123211223', 'gowa', 'Cuci Motor', '25.000', '2023-11-21 22:00:00', 'selesai', 'parhan'),
(11, 7, 'abil', '089123211223', 'gowa', 'Cuci Mobil', '50.000', '2023-11-21 23:31:00', 'selesai', 'parhan'),
(12, 7, 'abil', '089123211223', 'gowa', 'Cuci Mobil', '50.000', '2023-11-22 02:50:00', 'proses', 'rapi'),
(13, 7, 'abil', '089123211223', 'gowa', 'Cuci Mobil', '50.000', '2023-11-24 10:41:00', 'proses', 'rapi'),
(14, 7, 'abil', '089123211223', 'gowa', 'Cuci Mobil', '50.000', '2023-11-24 11:57:00', 'proses', 'arip'),
(15, 7, 'abil', '089123211223', 'gowa', 'Cuci Mobil', '50.000', '2023-11-24 11:57:00', 'proses', 'rapi'),
(16, 7, 'abil', '089123211223', 'gowa', 'Cuci Motor', '25.000', '2023-12-08 09:11:00', 'selesai', 'parhan'),
(17, 7, 'abil', '089123211223', 'gowa', 'Cuci Motor', '25.000', '2023-12-15 11:13:00', 'sudah terbayar', NULL),
(18, 10, 'pian', '081222323238', 'dangko', 'Cuci Mobil', '50.000', '2023-12-19 08:54:00', 'pending', NULL),
(19, 7, 'abil', '089123211223', 'gowa', 'Cuci Mobil', '50.000', '2023-12-19 10:45:00', 'proses', 'rapi'),
(20, 7, 'abil', '089123211223', 'gowa', 'Cuci Motor', '25.000', '2024-01-16 14:49:00', 'proses', 'rapi'),
(21, 8, 'rapi', '089232312242', 'ablam', 'Cuci Motor', '25.000', '2024-05-29 12:37:00', 'selesai', NULL),
(22, 8, 'rapi', '089232312242', 'ablam', 'Cuci Motor', '25.000', '2024-05-29 12:37:00', 'proses', 'rapi'),
(23, 9, 'parhan', '082132333242', 'Kanjilo, Barombong, Gowa, South Sulawesi, Sulawesi, 92123, Indonesia', 'Cuci Motor', '25.000', '2024-05-31 10:20:00', 'pending', NULL),
(24, 9, 'parhan', '082132333242', 'Kanjilo, Barombong, Gowa, South Sulawesi, Sulawesi, 92123, Indonesia', 'Cuci Motor', '25.000', '2024-05-31 11:21:00', 'pending', NULL),
(25, 17, 'edi', '085123123123', 'Jalan Metro Tanjung Bunga, Osaka Garden, Tanjung Merdeka, Tamalate, Makassar, South Sulawesi, Sulawesi, 90225, Indonesia', 'Cuci Motor', '25.000', '2024-05-31 10:53:00', 'pending', NULL),
(26, 17, 'edi', '085123123123', 'Garessi, Barru, South Sulawesi, Sulawesi, 90712, Indonesia', 'Cuci Motor', '25.000', '2024-05-31 12:57:00', 'pending', NULL),
(27, 18, 'sari', '085123123123', 'ablam', 'Cuci Mobil', '50.000', '2024-06-03 09:42:00', 'selesai', NULL),
(28, 19, 'aul', '082132333242', 'antang', 'Cuci Motor', '25.000', '2024-06-09 08:53:00', 'proses', 'arip'),
(29, 19, 'aul', '082132333242', 'antang', 'Cuci Motor', '25.000', '2024-06-09 09:02:00', 'proses', 'rapi'),
(30, 8, 'rapi', '089232312242', 'Masjid Baitul Azis Pasar Induk Minasa Maupa, Jalan Terminal Swadaya, Tompobalang, Somba Opu, Gowa, South Sulawesi, Sulawesi, 92111, Indonesia', 'Cuci Becak', '15.000', '2024-06-13 09:08:00', 'pending', NULL),
(31, 20, 'satria', '085123123123', '', 'Cuci Becak', '15.000', '2024-06-22 09:25:00', 'pending', NULL),
(32, 20, 'satria', '085123123123', 'BBPP Batangkaluku, Jalan Bukit Tamarunang, Tamarunang, Somba Opu, Gowa, South Sulawesi, Sulawesi, 92113, Indonesia', 'Cuci Becak', '15.000', '2024-06-22 09:26:00', 'pending', NULL),
(33, 20, 'satria', '085123123123', 'Tinggimae, Barombong, Gowa, South Sulawesi, Sulawesi, 92123, Indonesia', 'Cuci Becak', '15.000', '2024-06-22 08:26:00', 'pending', NULL),
(34, 20, 'satria', '085123123123', 'Bontosunggu, Bajeng, Gowa, South Sulawesi, Sulawesi, 92152, Indonesia', 'Cuci Becak', '15.000', '2024-06-22 09:26:00', 'pembayaran terkonfirmasi', NULL),
(35, 18, 'sari', '085123123123', 'Jalan Lobak, Wajo Baru, Bontoala, Makassar, South Sulawesi, Sulawesi, 90153, Indonesia', 'Cuci Mobil', '50.000', '2024-06-24 11:01:00', 'sudah terbayar', NULL),
(36, 18, 'sari', '085123123123', 'Jalan Lobak, Wajo Baru, Bontoala, Makassar, South Sulawesi, Sulawesi, 90153, Indonesia', 'Cuci Motor', '25.000', '2024-06-24 11:05:00', 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id_user` int(22) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `level_user` varchar(25) NOT NULL,
  `target_harian` int(11) NOT NULL,
  `jumlah_cucian` int(11) NOT NULL,
  `status_target` varchar(255) NOT NULL,
  `total_cucian` int(11) NOT NULL,
  `lat` varchar(250) DEFAULT NULL,
  `lon` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id_user`, `nama`, `alamat`, `no_hp`, `username`, `password`, `level_user`, `target_harian`, `jumlah_cucian`, `status_target`, `total_cucian`, `lat`, `lon`) VALUES
(7, 'abil', 'Polombangkeng Utara, Takalar, Barugaya, South Sulawesi, Sulawesi, Indonesia', '089123211223', 'abil', '14e1b600b1fd579f47433b88e8d85291', 'user', 0, 0, '', 0, '-5.164215766372331', '119.43737846919733'),
(8, 'rapi', 'Masjid Baitul Azis Pasar Induk Minasa Maupa, Jalan Terminal Swadaya, Tompobalang, Somba Opu, Gowa, South Sulawesi, Sulawesi, 92111, Indonesia', '089232312242', 'rapi', '1f32aa4c9a1d2ea010adcf2348166a04', 'admin', 0, 0, '', 0, '-5.212017017428033', '119.45651228678578'),
(9, '', 'Kanjilo, Barombong, Gowa, South Sulawesi, Sulawesi, 92123, Indonesia', '', 'parhan', '1f32aa4c9a1d2ea010adcf2348166a04', 'pegawai', 6, 0, '', 0, '-5.164215766372331', '119.43737846919733'),
(10, 'pian', 'dangko', '081222323238', 'pian', '827ccb0eea8a706c4c34a16891f84e7b', 'user', 0, 0, '', 0, '-5.164215766372331', '119.43737846919733'),
(11, 'isnal', 'gowa', '082132333242', 'isnal', '827ccb0eea8a706c4c34a16891f84e7b', 'user', 0, 0, '', 0, '-5.164215766372331', '119.43737846919733'),
(14, 'arip', 'Kompleks TNI AL Dewaruci, Melayu, Wajo, Makassar, South Sulawesi, Sulawesi, 90172, Indonesia', '082132333242', 'arip', '827ccb0eea8a706c4c34a16891f84e7b', 'pegawai', 0, 0, '', 0, '-5.123537540497791', '119.41775619989565'),
(15, 'ntaps', 'alamat', '085123123123', 'superadmin', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'user', 0, 0, '', 0, '-5.164215766372331', '119.43737846919733'),
(16, 'fadil', 'Batua, Manggala, Makassar, South Sulawesi, Sulawesi, 90233, Indonesia', '085123123123', 'fadil', 'ed2e19985ad3a06c810efa1e53e70832', 'user', 0, 0, '', 0, '-5.257882531308212', '119.40985632638257'),
(17, 'edi', 'Garessi, Barru, South Sulawesi, Sulawesi, 90712, Indonesia', '085123123123', 'edi', 'ed2e19985ad3a06c810efa1e53e70832', 'user', 0, 0, '', 0, '-4.444997369727273', '119.63378904853018'),
(18, 'sari', 'Jalan Lobak, Wajo Baru, Bontoala, Makassar, South Sulawesi, Sulawesi, 90153, Indonesia', '085123123123', 'sari', '827ccb0eea8a706c4c34a16891f84e7b', 'user', 0, 0, '', 0, '', ''),
(19, 'aul', 'Jalan Bonto Mene, Banta-Bantaeng, Rappocini, Makassar, South Sulawesi, Sulawesi, 90221, Indonesia', '082132333242', 'aul', '1f32aa4c9a1d2ea010adcf2348166a04', 'user', 0, 0, '', 0, '-5.166058822784478', '119.42991483334701'),
(20, 'satria', 'Bontosunggu, Bajeng, Gowa, South Sulawesi, Sulawesi, 92152, Indonesia', '085123123123', 'satria', '827ccb0eea8a706c4c34a16891f84e7b', 'user', 0, 0, '', 0, '-5.261314383570743', '119.42501589681025'),
(21, 'kappi', 'maros', '08928127126663', 'kappi', '827ccb0eea8a706c4c34a16891f84e7b', 'admin', 0, 0, '', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_order` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id_user` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user_login` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
