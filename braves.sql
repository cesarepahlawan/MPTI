-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 26, 2024 at 10:35 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `braves`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `whatsapp_number` varchar(20) NOT NULL,
  `adminid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `email`, `whatsapp_number`, `adminid`) VALUES
('adminbraves', '$2a$12$ystEaXFjybu9d4y4GNzN6uAYOo4bh0VS4H.SnHg/NGcBTkzm7waoq', 'aryadifah@gmail.com', '628884000631', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `nama` varchar(50) NOT NULL,
  `jenis` enum('Huruf timbul akrilik menyala','Neon box','Stempel','Kusen aluminium') NOT NULL,
  `harga` int NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `produkid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`nama`, `jenis`, `harga`, `gambar`, `deskripsi`, `produkid`) VALUES
('Verdant Biosciences', 'Huruf timbul akrilik menyala', 16000, '99675.jpeg', 'Full acrilik lampu serta pemasangan', 5),
('Liquid Stamp Machine', 'Neon box', 9999, '97666.jpeg', 'Mesin yang digunakan untuk pembuatan stempel sesuai pemesanan', 6),
('Buka/Open BANK BRI', 'Kusen aluminium', 9999, '99860.jpeg', 'Contoh produk kusen almunium', 7),
('Kunci nama stempel', 'Stempel', 85000, '92645.jpeg', 'Stempel yang berupa gantungan kunci', 8),
('Stempel Flesh', 'Stempel', 85000, '55818.jpg', 'Stempel otomatis,  bisa 1 sampai 4 warna. Praktis. Tanpa Bantalan.', 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produkid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produkid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
