-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2023 at 05:50 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan_masyarakat`
--

-- --------------------------------------------------------

--
-- Table structure for table `masyarakats`
--

CREATE TABLE `masyarakats` (
  `nik` char(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `masyarakats`
--

INSERT INTO `masyarakats` (`nik`, `nama`, `username`, `password`, `telp`, `created_at`, `updated_at`) VALUES
('23748328642', 'Hamid ZZz', 'hamid', '$2y$10$0PEssVvur7.CwledDbaEI.J.gvmKqi0pmUNv6CajO0xtkgIolw/BC', '083424234234', '2023-10-25 08:40:50', '2023-10-25 08:40:50'),
('6253425438', 'Masyarakat', 'masyarakat', '$2y$10$qGitPQaRejBdywRTDtaAn.unxd7WAPJS05exsVBMnu2dhCT2S2IHa', '081231231232', '2023-11-12 23:35:45', '2023-11-13 02:28:11'),
('9284328642', 'Angga', 'angga', '$2y$10$PTsde/DBqorlVKPEMzTgDO3MF2Qln6ceY.RRra/bZQmoddFJUM9F.', '083422342234', '2023-10-28 22:30:53', '2023-10-28 22:30:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `masyarakats`
--
ALTER TABLE `masyarakats`
  ADD PRIMARY KEY (`nik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
