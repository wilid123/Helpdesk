-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2023 at 08:23 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hdra`
--

-- --------------------------------------------------------

--
-- Table structure for table `masyarakat`
--

CREATE TABLE `masyarakat` (
  `id_masyarakat` int(6) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` enum('Masyarakat') NOT NULL,
  `id_sec` int(6) NOT NULL,
  `foto_masyarakat` varchar(255) NOT NULL,
  `blokir` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `masyarakat`
--

INSERT INTO `masyarakat` (`id_masyarakat`, `nama`, `username`, `password`, `level`, `id_sec`, `foto_masyarakat`, `blokir`) VALUES
(31, '123', '123', '202cb962ac59075b964b07152d234b70', 'Masyarakat', 1, 'UserImage.png', 'Yes'),
(32, 'qwerty', 'qwe', '202cb962ac59075b964b07152d234b70', 'Masyarakat', 2, '63b726d180201d61c5a76ecd39a08bae.jpg', 'No'),
(35, 'mnbvc', 'mnb', '202cb962ac59075b964b07152d234b70', 'Masyarakat', 3, 'UserImage.png', 'No'),
(37, 'asdfg', 'asd', '202cb962ac59075b964b07152d234b70', 'Masyarakat', 4, 'UserImage.png', 'No'),
(40, 'Anom', 'Kanjeng Anom', '202cb962ac59075b964b07152d234b70', 'Masyarakat', 5, '', ''),
(41, 'Ardiansyah', 'ardian', '202cb962ac59075b964b07152d234b70', 'Masyarakat', 6, '', ''),
(42, 'Falillah', 'yarham', '202cb962ac59075b964b07152d234b70', 'Masyarakat', 7, '', ''),
(43, 'Danishwara', 'Danish', '202cb962ac59075b964b07152d234b70', 'Masyarakat', 1, '', ''),
(44, 'Deni Rasya Gumilang', 'DEMIGOD', '202cb962ac59075b964b07152d234b70', 'Masyarakat', 10, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id_modul` int(11) NOT NULL,
  `nama_modul` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL,
  `static_content` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `publish` enum('Y','N') NOT NULL,
  `status` enum('Petugas','Admin','Masyarakat','All') NOT NULL,
  `aktif` enum('Y','N') NOT NULL,
  `urutan` int(8) NOT NULL,
  `link_seo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id_modul`, `nama_modul`, `icon`, `link`, `static_content`, `gambar`, `publish`, `status`, `aktif`, `urutan`, `link_seo`) VALUES
(2, 'Admin', 'fa-solid fa-user', '?module=datapetugas', 'Hello', '', 'Y', 'Admin', 'Y', 3, ''),
(3, 'Semua Pengaduan', 'fa-solid fa-house', '?module=spengaduan', 'Hello', '', 'Y', 'Admin', 'Y', 4, ''),
(5, 'Tanggapan', 'fa-solid fa-reply', '?module=tanggapan', 'Hello', '', 'Y', 'Petugas', 'Y', 7, ''),
(10, 'Pengaduan', 'fa-solid fa-pen-to-square', '?module=pmasyarakat', 'Hello', '', 'Y', 'Masyarakat', 'Y', 8, ''),
(11, 'Tanggapan', 'fa-solid fa-reply', '?module=tmasyarakat', 'Hello', '', 'Y', 'Masyarakat', 'Y', 9, ''),
(15, 'Masyarakat', 'fa-solid fa-users', '?module=datamasyarakat', 'Hello', '', 'Y', 'Petugas', 'Y', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int(11) NOT NULL,
  `tgl_pengaduan` date NOT NULL,
  `id_masyarakat` int(6) NOT NULL,
  `judul` varchar(30) NOT NULL,
  `isi_laporan` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` enum('Proses','Selesai','Diterima','Ditolak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `tgl_pengaduan`, `id_masyarakat`, `judul`, `isi_laporan`, `foto`, `status`) VALUES
(117, '2023-08-07', 32, 'Kucing  Melas', 'TEST  KEDUA', 'Screenshot (1).png', 'Ditolak');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(35) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` enum('Admin','Petugas') NOT NULL,
  `foto_petugas` varchar(255) NOT NULL,
  `blokir` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `username`, `password`, `level`, `foto_petugas`, `blokir`) VALUES
(30, 'Wildan Satya  Nugrahadi', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'Artboard 1.jpg', 'No'),
(32, 'Nico Gunawan Purba', 'nico', '4118af4d1a8ac07d93f11ce4f3bf1f58', 'Petugas', 'Gold (1).png', 'No'),
(34, 'Muhammad Ali Irfan', 'ali', '984d8144fa08bfc637d2825463e184fa', 'Petugas', 'Diamond (1).png', 'No'),
(35, 'Ferdiancyah', 'ferdi', '202cb962ac59075b964b07152d234b70', 'Petugas', 'WhatsApp Image 2023-07-12 at 12.53.25.jpeg', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `proses`
--

CREATE TABLE `proses` (
  `id_proses` int(11) NOT NULL,
  `id_pengaduan` int(11) NOT NULL,
  `tgl_proses` date NOT NULL,
  `p_proses` text NOT NULL,
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proses`
--

INSERT INTO `proses` (`id_proses`, `id_pengaduan`, `tgl_proses`, `p_proses`, `id_petugas`) VALUES
(5, 117, '2023-08-07', '', 30),
(6, 117, '2023-08-07', '', 30),
(7, 117, '2023-08-07', '', 30),
(8, 117, '2023-08-07', '', 30);

-- --------------------------------------------------------

--
-- Table structure for table `sec`
--

CREATE TABLE `sec` (
  `id_sec` int(6) NOT NULL,
  `section` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sec`
--

INSERT INTO `sec` (`id_sec`, `section`) VALUES
(1, 'ADM'),
(2, 'CA'),
(3, 'EI'),
(4, 'ENG PET'),
(5, 'FIN'),
(6, 'IFB'),
(7, 'IFC'),
(8, 'KTF'),
(9, 'LOG'),
(10, 'MC'),
(11, 'MFG PET'),
(12, 'MKT PET KTF'),
(13, 'MKT PF'),
(14, 'Proc'),
(15, 'QCC'),
(16, 'QCC PET'),
(17, 'SHE'),
(18, 'TC');

-- --------------------------------------------------------

--
-- Table structure for table `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id_tanggapan` int(11) NOT NULL,
  `id_pengaduan` int(11) NOT NULL,
  `tgl_tanggapan` date NOT NULL,
  `tanggapan` text NOT NULL,
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tanggapan`
--

INSERT INTO `tanggapan` (`id_tanggapan`, `id_pengaduan`, `tgl_tanggapan`, `tanggapan`, `id_petugas`) VALUES
(69, 117, '2023-08-07', 'Malas Sekali :)', 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`id_masyarakat`),
  ADD KEY `id_sec` (`id_sec`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id_modul`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `nik` (`id_masyarakat`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `proses`
--
ALTER TABLE `proses`
  ADD PRIMARY KEY (`id_proses`),
  ADD KEY `id_pengaduan` (`id_pengaduan`,`id_petugas`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `sec`
--
ALTER TABLE `sec`
  ADD PRIMARY KEY (`id_sec`);

--
-- Indexes for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`),
  ADD KEY `id_pengaduan` (`id_pengaduan`,`id_petugas`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `id_masyarakat` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id_modul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `proses`
--
ALTER TABLE `proses`
  MODIFY `id_proses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sec`
--
ALTER TABLE `sec`
  MODIFY `id_sec` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id_tanggapan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD CONSTRAINT `masyarakat_ibfk_1` FOREIGN KEY (`id_sec`) REFERENCES `sec` (`id_sec`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`id_masyarakat`) REFERENCES `masyarakat` (`id_masyarakat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proses`
--
ALTER TABLE `proses`
  ADD CONSTRAINT `proses_ibfk_1` FOREIGN KEY (`id_pengaduan`) REFERENCES `pengaduan` (`id_pengaduan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proses_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD CONSTRAINT `tanggapan_ibfk_1` FOREIGN KEY (`id_pengaduan`) REFERENCES `pengaduan` (`id_pengaduan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tanggapan_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
