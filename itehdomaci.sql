-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2021 at 07:31 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itehdomaci`
--

-- --------------------------------------------------------

--
-- Table structure for table `narukvice`
--

CREATE TABLE `narukvice` (
  `nar_id` int(8) NOT NULL,
  `naziv` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `godina_proizvodnje` int(4) NOT NULL,
  `cena` int(8) NOT NULL,
  `vlasnik_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `narukvice`
--

INSERT INTO `narukvice` (`nar_id`, `naziv`, `model`, `godina_proizvodnje`, `cena`, `vlasnik_id`) VALUES
(1, 'Pandora elegant', 'PP342R', 2017, 3500, 1),
(2, 'Pandora red', 'DRTXR', 2018, 6500, 1),
(3, 'Pandora Lala', '123Ultra', 2020, 10500, 1),
(4, 'Pandora x', '33ZZ', 2000, 11000, 1),
(5, 'Pandora white', 'FUNW', 2016, 2300, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vlasnik`
--

CREATE TABLE `vlasnik` (
  `vlasnik_id` int(8) NOT NULL,
  `ime_prezime` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vlasnik`
--

INSERT INTO `vlasnik` (`vlasnik_id`, `ime_prezime`, `username`, `password`) VALUES
(1, 'Aleksandra Simić', 'ana', 'ana'),
(5, 'Mina Milev', 'mina', 'mina'),
(6, 'Sofia Lenska', 'sofia', 'sofia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `narukvice`
--
ALTER TABLE `narukvice`
  ADD PRIMARY KEY (`nar_id`),
  ADD KEY `vlasnik_id` (`vlasnik_id`);

--
-- Indexes for table `vlasnik`
--
ALTER TABLE `vlasnik`
  ADD PRIMARY KEY (`vlasnik_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vlasnik`
--
ALTER TABLE `vlasnik`
  MODIFY `vlasnik_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `narukvice`
--
ALTER TABLE `narukvice`
  ADD CONSTRAINT `narukvice_ibfk_1` FOREIGN KEY (`vlasnik_id`) REFERENCES `vlasnik` (`vlasnik_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
