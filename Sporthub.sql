-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2024 at 09:45 AM
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
-- Database: `dbno013`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `useradmin` varchar(10) NOT NULL,
  `passadmin` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`useradmin`, `passadmin`) VALUES
('admin1', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `idmember` int(10) NOT NULL,
  `namemember` varchar(20) NOT NULL,
  `addressmember` varchar(20) NOT NULL,
  `telmember` varchar(20) NOT NULL,
  `statusmember` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`idmember`, `namemember`, `addressmember`, `telmember`, `statusmember`, `status`) VALUES
(8, 'Pleum', '', 'abc123', '', ''),
(10, 'AAA', '', '123', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `idpro` int(10) NOT NULL,
  `namepro` varchar(20) NOT NULL,
  `detailpro` varchar(50) NOT NULL,
  `price` int(10) NOT NULL,
  `discount` int(10) NOT NULL,
  `picpro` varchar(100) NOT NULL,
  `numberpro` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`idpro`, `namepro`, `detailpro`, `price`, `discount`, `picpro`, `numberpro`) VALUES
(45, 'เสื้อบอล Liverpool', 'Liverpool สีแดง', 1090, 5, 'liverr.png', 20),
(47, 'เสื้อบอล Barcelona', 'Barcelona', 1090, 5, 'Barcelona.png', 50),
(48, 'เสื้อบอล Paris', 'Paris', 1090, 5, 'paris.png', 50),
(49, 'เสื้อบาส Boston', 'Boston', 1190, 5, 'Boston.png', 50),
(50, 'เสื้อบาส Brooklyn', 'Brooklyn', 1190, 5, 'brooklyn.jpg', 50),
(51, 'เสื้อบาส Dallas', 'Dallas', 1190, 5, 'Dallas.png', 50),
(52, 'เสื้อบาส Lakers', 'Lakers', 1190, 5, 'lakers.png', 50),
(53, 'รองเท้าฟุตบอล ADIDAS', 'COPA PURE II LEAGUE FIRM GROUND', 1800, 5, 'Copa_Pure_II_League_Firm_Ground_IE7492_01_standard_hover.avif', 555),
(54, 'ถุงเท้า ADI 23', 'ADIDAS ADI 23', 590, 5, 'adi_23_HT5027_03_standard_hover.avif', 555),
(55, 'ถุงเท้า ADI 24', 'ADIDAS ADI 24', 590, 5, 'adi_24_AEROREADY_IM8924_03_standard.png', 555),
(56, 'กางเกงขาสั้น ADIDAS', 'ADIDAS Entrada 22', 600, 5, 'Entrada_22_H57504_01_laydown.avif', 100),
(57, 'กางเกงขาสั้น ADIDAS', 'ADIDAS Entrada 22 สีเทา', 600, 5, 'Entrada_22_H57505_01_laydown.avif', 100),
(58, 'กางเกงขาสั้น ADIDAS', 'ADIDAS Entrada 22 สีแดง', 600, 5, 'Entrada_22_H61735_01_laydown.png', 100),
(59, 'กางเกงขาสั้น ADIDAS', 'ADIDAS Entrada 22 สีน้ำเงิน', 600, 5, 'Entrada_22_H57506_01_laydown.png', 100);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `idreview` int(10) NOT NULL,
  `idmember` varchar(20) NOT NULL,
  `idsale` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `idsale` int(10) NOT NULL,
  `sum` varchar(30) NOT NULL,
  `dayorder` varchar(30) NOT NULL,
  `idmember` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`idsale`, `sum`, `dayorder`, `idmember`) VALUES
(13, '1035.5', '2024-08-13 10:36:51', '8'),
(14, '2270.5', '2024-08-25 08:08:22', '8'),
(15, '1121', '2024-08-25 08:17:20', '10');

-- --------------------------------------------------------

--
-- Table structure for table `saledetail`
--

CREATE TABLE `saledetail` (
  `idsaledetail` int(10) NOT NULL,
  `idsale` varchar(20) NOT NULL,
  `idpro` varchar(20) NOT NULL,
  `numbersale` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `saledetail`
--

INSERT INTO `saledetail` (`idsaledetail`, `idsale`, `idpro`, `numbersale`) VALUES
(12, '13', '45', '1'),
(13, '14', '53', '1'),
(14, '14', '55', '1'),
(15, '15', '55', '1'),
(16, '15', '54', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`idmember`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idpro`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`idreview`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`idsale`);

--
-- Indexes for table `saledetail`
--
ALTER TABLE `saledetail`
  ADD PRIMARY KEY (`idsaledetail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `idmember` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `idpro` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `idreview` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `idsale` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `saledetail`
--
ALTER TABLE `saledetail`
  MODIFY `idsaledetail` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
