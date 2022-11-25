-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2022 at 09:29 AM
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
-- Database: `rumah_sakit`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(3) NOT NULL,
  `dokter` varchar(50) NOT NULL,
  `spesialisasi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `dokter`, `spesialisasi`) VALUES
(311, 'dr. Annabeth Chase, Sp.B, FINACS, MPH', 'Bedah Umum'),
(312, 'dr. Jeon Wonwoo, Sp.B', 'Bedah Umum'),
(321, 'dr. Severus Snape, Sp.OT', 'Bedah Tulang'),
(322, 'dr. Seungkwan, Sp.OT', 'Bedah Tulang'),
(331, 'dr. Ariana Dumbledore, Sp. S, M.Kes, Ph.D', 'Saraf'),
(341, 'dr. Luke Castellan, Sp.JP.(K)., FIHA', 'Kardiologi'),
(351, 'dr. Mingyu, B.Med.,Sc.M.Epid.,MSc., Sp.A', 'Anak'),
(361, 'dr. Wen Junhui, Sp.OG, M.Kes', 'OBGYN');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_dokter`
--

CREATE TABLE `jadwal_dokter` (
  `id_jadwal` int(11) NOT NULL,
  `id_dokter` int(3) NOT NULL,
  `id_klinik` int(3) NOT NULL,
  `hari` varchar(6) NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `klinik`
--

CREATE TABLE `klinik` (
  `id_klinik` int(3) NOT NULL,
  `klinik` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klinik`
--

INSERT INTO `klinik` (`id_klinik`, `klinik`) VALUES
(101, 'Bedah Umum'),
(102, 'Bedah Tulang'),
(103, 'Saraf'),
(104, 'Kardiologi'),
(105, 'Anak'),
(106, 'OBGYN');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `no_rm` int(9) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `goldar` varchar(2) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `wn` varchar(20) NOT NULL,
  `status_kawin` varchar(11) NOT NULL,
  `no_wa` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`no_rm`, `nik`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `goldar`, `agama`, `wn`, `status_kawin`, `no_wa`, `email`, `alamat`) VALUES
(2, '1111222233334444', 'Elizabeth Darcy', 'P', 'West Californiaaa', '2014-06-23', 'O', 'Islam', '', 'Belum Kawin', '0899991232111', 'fanyu@gmail.com', 'Tokyo, Jepang'),
(3, '', '', '', '', '0000-00-00', 'Go', 'Agama', '', '', '', '', ''),
(4, '', '', '', '', '0000-00-00', 'Go', 'Agama', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pasien`
--

CREATE TABLE `riwayat_pasien` (
  `no_pendaftaran` int(17) NOT NULL,
  `no_rm` int(9) NOT NULL,
  `id_jadwal` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indexes for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_dokter` (`id_dokter`),
  ADD KEY `id_klinik` (`id_klinik`);

--
-- Indexes for table `klinik`
--
ALTER TABLE `klinik`
  ADD PRIMARY KEY (`id_klinik`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`no_rm`);

--
-- Indexes for table `riwayat_pasien`
--
ALTER TABLE `riwayat_pasien`
  ADD PRIMARY KEY (`no_pendaftaran`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `no_rm` (`no_rm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `no_rm` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD CONSTRAINT `jadwal_dokter_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`),
  ADD CONSTRAINT `jadwal_dokter_ibfk_2` FOREIGN KEY (`id_klinik`) REFERENCES `klinik` (`id_klinik`);

--
-- Constraints for table `riwayat_pasien`
--
ALTER TABLE `riwayat_pasien`
  ADD CONSTRAINT `riwayat_pasien_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_dokter` (`id_jadwal`),
  ADD CONSTRAINT `riwayat_pasien_ibfk_2` FOREIGN KEY (`no_rm`) REFERENCES `pasien` (`no_rm`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
