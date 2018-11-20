-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2018 at 12:47 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projekti3`
--

-- --------------------------------------------------------

--
-- Table structure for table `asiakastilaus`
--

CREATE TABLE IF NOT EXISTS `asiakastilaus` (
  `asiakasNimi` varchar(25) NOT NULL,
  `asiakasSposti` varchar(25) NOT NULL,
  `asiakasYritys` varchar(25) NOT NULL,
  `asiakasYritysOsoite` varchar(25) NOT NULL,
  `asiakasHakemus` varchar(500) NOT NULL,
  PRIMARY KEY (`asiakasNimi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asiakastilaus`
--

INSERT INTO `asiakastilaus` (`asiakasNimi`, `asiakasSposti`, `asiakasYritys`, `asiakasYritysOsoite`, `asiakasHakemus`) VALUES
('ABC', 'ABC@ABC.ABC', 'Savonia AMK', 'Opistotie 2', 'Haluaisin tilata teiltä 5 puhdistinta'),
('semmottii', 'tÃ¤mmÃ¶ttii', 'sillattii', 'tommottii', 'kummottii'),
('abcs', 'asd.asd@asd.asd', 'asd', 'asd', 'asd'),
('UUSI', 'piaru@piaru.piaru', 'kikkihiiret', 'kikkihiirenkuja 56', 'Paljon kikkihiirejÃ¤ vaivaa home');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
