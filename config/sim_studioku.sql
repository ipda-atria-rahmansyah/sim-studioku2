-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2026 at 09:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sim_studioku`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_studio` int(11) NOT NULL,
  `tanggal_booking` datetime DEFAULT current_timestamp(),
  `tanggal_penggunaan` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `durasi_menit` int(11) NOT NULL,
  `total_harga` decimal(12,2) NOT NULL,
  `batas_pembayaran` int(11) DEFAULT NULL,
  `batas_bayar_sampai` datetime DEFAULT NULL,
  `status` enum('menunggu_pembayaran','menunggu_verifikasi','dikonfirmasi','selesai','dibatalkan','kadaluarsa') NOT NULL DEFAULT 'menunggu_pembayaran'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_booking`, `id_user`, `id_studio`, `tanggal_booking`, `tanggal_penggunaan`, `jam_mulai`, `jam_selesai`, `durasi_menit`, `total_harga`, `batas_pembayaran`, `batas_bayar_sampai`, `status`) VALUES
(1, 2, 1, '2026-06-03 15:28:51', '2026-06-04', '15:30:00', '16:00:00', 30, 15000.00, NULL, NULL, 'dikonfirmasi'),
(2, 2, 1, '2026-06-04 09:17:56', '2026-06-03', '09:00:00', '10:30:00', 90, 45000.00, NULL, NULL, 'menunggu_pembayaran'),
(3, 2, 1, '2026-06-04 09:44:48', '2026-06-04', '09:43:00', '09:26:00', -17, -8500.00, NULL, NULL, 'menunggu_pembayaran'),
(4, 2, 1, '2026-06-04 10:31:12', '2026-06-13', '12:31:00', '13:31:00', 60, 30000.00, NULL, NULL, 'menunggu_pembayaran'),
(5, 2, 1, '2026-06-04 11:31:17', '2026-06-05', '12:30:00', '13:30:00', 60, 30000.00, NULL, '2026-06-04 07:31:17', 'kadaluarsa'),
(6, 2, 2, '2026-06-04 14:04:46', '2026-06-04', '17:04:00', '18:04:00', 60, 42000.00, NULL, '2026-06-04 10:04:46', 'menunggu_verifikasi'),
(7, 2, 2, '2026-06-04 14:17:50', '2026-06-05', '14:17:00', '16:17:00', 120, 84000.00, NULL, '2026-06-04 10:17:50', 'dikonfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id_otp` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_otp` varchar(6) NOT NULL,
  `expired_at` datetime NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_booking` int(11) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `tanggal_bayar` datetime DEFAULT current_timestamp(),
  `status_verifikasi` enum('pending','disetujui','ditolak') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_booking`, `bukti_pembayaran`, `tanggal_bayar`, `status_verifikasi`) VALUES
(1, 2, '1780539493_1U_2025_03_01.png', '2026-06-04 09:18:13', 'ditolak'),
(2, 1, '1780539515_1U_2025_12_18.png', '2026-06-04 09:18:35', 'disetujui'),
(3, 6, '1780556697_Screenshot 2024-07-11 152744.png', '2026-06-04 14:04:57', ''),
(4, 7, '1780557479_Screenshot 2024-07-22 091805.png', '2026-06-04 14:17:59', 'disetujui');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id_pengaturan` int(11) NOT NULL,
  `batas_pembayaran_default` int(11) NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id_pengaturan`, `batas_pembayaran_default`, `updated_at`) VALUES
(1, 60, '2026-06-03 10:46:10');

-- --------------------------------------------------------

--
-- Table structure for table `studio`
--

CREATE TABLE `studio` (
  `id_studio` int(11) NOT NULL,
  `nama_studio` varchar(100) NOT NULL,
  `harga_per_10_menit` decimal(10,2) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `kapasitas` int(11) NOT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studio`
--

INSERT INTO `studio` (`id_studio`, `nama_studio`, `harga_per_10_menit`, `deskripsi`, `foto`, `kapasitas`, `status`) VALUES
(1, 'Studio A', 5000.00, 'Studio Indoor', '', 4, 'aktif'),
(2, 'Studio B1', 7000.00, 'Studio Outdoor1', '1780473765_1U_2025_03_01.png', 6, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL DEFAULT 'customer',
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `no_hp`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ipda atria', 'cc@gmail.com', '082119730602', '$2y$10$607BhZuC1fdc5fbd6uzFAuM8HrQcxOHEZzBguiRPpaRM0z59g9kry', 'admin', 'aktif', '2026-06-03 11:36:09', '2026-06-03 11:45:03'),
(2, 'simcus', 'cus@gmail.com', '082119730702', '$2y$10$8gCP191g3kEtJym1Oi4sU.qiftaT4iqCe/s9FNLaisr//5SChQ4ra', 'customer', 'aktif', '2026-06-03 11:57:55', '2026-06-03 11:57:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `fk_booking_user` (`id_user`),
  ADD KEY `fk_booking_studio` (`id_studio`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id_otp`),
  ADD KEY `fk_otp_user` (`id_user`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD UNIQUE KEY `id_booking` (`id_booking`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indexes for table `studio`
--
ALTER TABLE `studio`
  ADD PRIMARY KEY (`id_studio`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id_otp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `studio`
--
ALTER TABLE `studio`
  MODIFY `id_studio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_booking_studio` FOREIGN KEY (`id_studio`) REFERENCES `studio` (`id_studio`),
  ADD CONSTRAINT `fk_booking_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `otp`
--
ALTER TABLE `otp`
  ADD CONSTRAINT `fk_otp_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_booking` FOREIGN KEY (`id_booking`) REFERENCES `booking` (`id_booking`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
