-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2024 at 12:31 PM
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
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(3) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `id_penulis` int(3) NOT NULL,
  `id_kategori` int(3) NOT NULL,
  `jumlah_hlm` int(4) NOT NULL,
  `tahun_terbit` varchar(4) NOT NULL,
  `tgl_masuk` datetime NOT NULL,
  `sinopsis` text NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `nama_file` text NOT NULL,
  `cover` text NOT NULL,
  `dilihat` int(11) NOT NULL,
  `total_pengunjung` int(11) DEFAULT 0,
  `total_pembaca` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `id_penulis`, `id_kategori`, `jumlah_hlm`, `tahun_terbit`, `tgl_masuk`, `sinopsis`, `isbn`, `lokasi`, `nama_file`, `cover`, `dilihat`, `total_pengunjung`, `total_pembaca`) VALUES
(1, 'Mengejar Designs', 1, 1, 32, '2020', '2021-06-26 18:44:43', 'Design Sprint itu metodologi yang udah terbukti buat nyelesain masalah lewat desain, bikin prototipe, & nge-test ide ke pengguna kita. Desain Sprint itu juga bisa nyelarasin visi tim kita supaya tujuan & hasilnya jelas & cepat.', '', '', 'file_1.pdf', 'cover_1.png', 0, 42, 0),
(2, 'The Wonderful', 2, 2, 130, '2008', '2021-06-26 18:52:02', 'Folklore, legends, myths and fairy tales have followed childhood through the ages, for every healthy youngster has a wholesome and instinctive love for stories fantastic, marvelous and manifestly unreal. The winged fairies of Grimm and Andersen have brought more happiness to childish hearts than all other human creationsa', '', '', 'file_2.pdf', 'cover_2.png', 0, 42, 0),
(3, 'Reinkarnasi', 3, 2, 167, '2013', '2021-06-26 18:54:08', 'Zaila, gadis 12 tahun yang sedang bermain ditepi sungai mencari ikan bersama teman-temannya tiba-tiba terpelaset dan terjatuh hingga tak sadarkan diri. Dari sinilah semuanya bermula. Ketika ia tersadar, ia tidak dalam raga dirinya melainkan berada di raga yang lain dan di zaman yang lain. Namanya Sekar. Seorang puteri keraton pada masa penjajahan belanda. Ternyata ia telah mundur ke 180 tahun silam, tepatnya pada tahun 1831.', '', '', 'file_3.pdf', 'cover_3.png', 3, 42, 3),
(4, 'Belajar HTML dasar', 4, 3, 120, '2000', '2024-05-24 05:54:07', 'buku proggraming html dasar adalah buku untuk belajar dasar dasar pemograman', '', '', 'file_4.pdf', 'cover_4.png', 5, 42, 5),
(12, 'React Beginner', 4, 3, 34, '2022', '2024-06-16 12:24:54', 'sebuah buku sederhana untuk seorang beginner react', '978-983-99557-100', 'Desa Lamajangg', 'file_12.pdf', 'cover_12.png', 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(3) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Desain'),
(2, 'Fantasy'),
(3, 'programming');

-- --------------------------------------------------------

--
-- Table structure for table `penulis`
--

CREATE TABLE `penulis` (
  `id_penulis` int(3) NOT NULL,
  `penulis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penulis`
--

INSERT INTO `penulis` (`id_penulis`, `penulis`) VALUES
(1, 'Rizki Mardita'),
(2, 'L. Frank Baum'),
(3, 'Ditta Hakha'),
(4, 'candra');

-- --------------------------------------------------------

--
-- Table structure for table `statistik`
--

CREATE TABLE `statistik` (
  `ip` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `hits` int(10) DEFAULT 1,
  `online` varchar(255) NOT NULL,
  `total_pembaca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statistik`
--

INSERT INTO `statistik` (`ip`, `tanggal`, `hits`, `online`, `total_pembaca`) VALUES
('::1', '2024-05-23', 114, '1716499967', 0),
('::1', '2024-05-24', 82, '1716546937', 0),
('::1', '2024-05-29', 1, '1716955812', 0),
('::1', '2024-06-07', 13, '1717730087', 0),
('::1', '2024-06-16', 18, '1718533882', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'default.svg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `name`, `photo`) VALUES
(6, 'candra', 'candra@gmail.com', 'candra', 'candra', 'default.svg'),
(7, 'ananda', 'ananda@gmail.com', '$2y$10$0h1qxJ06J2s.gqZSR/Td8.37mbhZI4pfa1/4as001L7RUDTbGqiVq', 'ananda', 'default.svg'),
(8, 'adel', 'adel@gmail.com', '$2y$10$4qhRTXGKqrKopCf4CYK0weNfAQqVM8iPbWk7YpC3YgqJePomsT3uy', 'adel', 'default.svg'),
(10, 'chankirana722@gmail.com', 'kirana@gmail.com', '$2y$10$QBa/GSWTU28kf5m8hc98MOqvwTOPFlo4jx6J70zp8vaIrwTaphWnm', 'kirana', 'default.svg'),
(11, 'alex', 'alex@gmail.com', '$2y$10$tAMJ2IWG68e3.rNKnrH5FOR742FFpU6VAczNJGMoCQUruUDYhgo8a', 'alex', 'default.svg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_penulis` (`id_penulis`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id_penulis`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id_penulis` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`id_penulis`) REFERENCES `penulis` (`id_penulis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
