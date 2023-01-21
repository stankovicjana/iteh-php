-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 06, 2022 at 09:15 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ciscenje`
--

-- --------------------------------------------------------

--
-- Table structure for table `radnik`
--

DROP TABLE IF EXISTS `radnik`;
CREATE TABLE IF NOT EXISTS `radnik` (
  `id` int(11) NOT NULL,
  `imePrezime` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `radnik`
--

INSERT INTO `radnik` (`id`, `imePrezime`) VALUES
(1, 'Jana Markovic'),
(2, 'Petra Milosevic'),
(3, 'Milivoje Marinkovic'),
(4, 'Nikola Peric');

-- --------------------------------------------------------

--
-- Table structure for table `termin`
--

DROP TABLE IF EXISTS `termin`;
CREATE TABLE IF NOT EXISTS `termin` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `usluga` bigint(20) NOT NULL,
  `klijent` varchar(50) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `lokacija` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`,`usluga`),
  KEY `usluga` (`usluga`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `termin`
--

INSERT INTO `termin` (`id`, `usluga`, `klijent`, `datum`, `lokacija`) VALUES
(1, 2, 'Andrea Mirkovic', '2022-02-14', 'Vozdovac'),
(2, 3, 'Mihajlo Pesic', '2022-01-16', 'Dedinje'),
(3, 5, 'Uros Milojkovic', '2022-02-22', 'Vracar'),
(4, 4, 'Milojko Maric', '2022-01-30', 'Vozdovac'),
(5, 3, 'Pera Jovanovic', '2022-03-15', 'Dedinje');

-- --------------------------------------------------------

--
-- Table structure for table `usluga`
--

DROP TABLE IF EXISTS `usluga`;
CREATE TABLE IF NOT EXISTS `usluga` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(30) DEFAULT NULL,
  `radnik_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `radnik` (`radnik_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usluga`
--

INSERT INTO `usluga` (`id`, `naziv`, `radnik_id`) VALUES
(1, 'Ciscenje duseka', 1),
(2, 'Ciscenje kreveta', 3),
(3, 'Ciscenje stolica', 3),
(4, 'Dubinsko pranje auta', 2),
(5, 'Dubinsko pranje kupatila', 4),
(6, 'Ciscenje kuhinje', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
