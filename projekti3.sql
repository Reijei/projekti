-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 28, 2018 at 08:57 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekti3`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_ID` int(25) NOT NULL AUTO_INCREMENT,
  `tunnus` varchar(25) NOT NULL,
  `salasana` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `usertype` varchar(10) NOT NULL,
  PRIMARY KEY (`admin_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `tunnus`, `salasana`, `email`, `usertype`) VALUES
(1, 'admin', 'salasana', 'email@testi.fi', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `asiakas`
--

DROP TABLE IF EXISTS `asiakas`;
CREATE TABLE IF NOT EXISTS `asiakas` (
  `AsiakasID` int(11) NOT NULL AUTO_INCREMENT,
  `Asiakas` varchar(25) NOT NULL,
  `Asiakasluokitus` varchar(25) NOT NULL,
  `Laskutusosoite` varchar(25) NOT NULL,
  `postinumero` varchar(25) NOT NULL,
  `toimipaikka` varchar(25) NOT NULL,
  `verkkolaskutunnus` varchar(11) NOT NULL,
  `operaattori` varchar(25) NOT NULL,
  `laskutusväli` varchar(25) NOT NULL,
  `vakuuttaja` varchar(25) NOT NULL,
  `yhteyshenkilö` varchar(25) NOT NULL,
  PRIMARY KEY (`AsiakasID`),
  UNIQUE KEY `AsiakasID` (`AsiakasID`),
  UNIQUE KEY `AsiakasID_2` (`AsiakasID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asiakas`
--

INSERT INTO `asiakas` (`AsiakasID`, `Asiakas`, `Asiakasluokitus`, `Laskutusosoite`, `postinumero`, `toimipaikka`, `verkkolaskutunnus`, `operaattori`, `laskutusväli`, `vakuuttaja`, `yhteyshenkilö`) VALUES
(1, 'name', 'luokitus', 'osoite', 'postinumero', 'toimipaikka', '123', 'operaattori', 'laskutusvali', 'vakuuttaja', 'yhteyshenkilo');

-- --------------------------------------------------------

--
-- Table structure for table `huoltohistoria`
--

DROP TABLE IF EXISTS `huoltohistoria`;
CREATE TABLE IF NOT EXISTS `huoltohistoria` (
  `HuoltoID` int(11) NOT NULL AUTO_INCREMENT,
  `LaiteID` int(25) NOT NULL,
  `Huoltopvm` date NOT NULL,
  `Sisaisethuomiot` text NOT NULL,
  PRIMARY KEY (`HuoltoID`),
  KEY `LaiteID` (`LaiteID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `huoltohistoria`
--

INSERT INTO `huoltohistoria` (`HuoltoID`, `LaiteID`, `Huoltopvm`, `Sisaisethuomiot`) VALUES
(2, 2, '2018-12-12', '2'),
(3, 2, '2018-12-12', ''),
(5, 2, '2018-12-12', 'asd'),
(1, 2, '2018-12-12', 'asd'),
(6, 2, '2018-12-12', 'asd'),
(7, 2, '2018-12-12', 'asd'),
(8, 2, '2018-12-12', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `laite`
--

DROP TABLE IF EXISTS `laite`;
CREATE TABLE IF NOT EXISTS `laite` (
  `LaiteID` int(11) NOT NULL AUTO_INCREMENT,
  `Sarjanumero` bigint(20) NOT NULL,
  `Nimi` varchar(25) NOT NULL,
  `Vuokra_hinta` decimal(10,0) NOT NULL,
  `Laitetyyppi` varchar(25) NOT NULL,
  `varaus_tila` varchar(25) NOT NULL,
  PRIMARY KEY (`LaiteID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laite`
--

INSERT INTO `laite` (`LaiteID`, `Sarjanumero`, `Nimi`, `Vuokra_hinta`, `Laitetyyppi`, `varaus_tila`) VALUES
(1, 1, '1', '1', '1', 'vapaa'),
(2, 123, 'esimnimi', '666', 'pora', 'vapaa'),
(3, 1234, 'nimi', '6969', 'perkele', 'vapaa'),
(6, 123444, 'niminmimi', '666', 'hieno', 'vapaa'),
(7, 123425, 'esimnimi', '666', 'hieno', 'vapaa'),
(8, 123123123, 'esimnimi', '55555', 'hieno', 'vapaa'),
(9, 111111, 'asdasdasd', '123123123', 'asd', 'varattu'),
(10, 33434, 'asd', '5', 'asd', 'vapaa');

-- --------------------------------------------------------

--
-- Table structure for table `tilaus`
--

DROP TABLE IF EXISTS `tilaus`;
CREATE TABLE IF NOT EXISTS `tilaus` (
  `TilausID` int(11) NOT NULL,
  `AsiakasID` int(11) NOT NULL,
  `LaiteID` int(11) NOT NULL,
  `alkpvm` int(11) NOT NULL,
  `loppupvm` int(11) NOT NULL,
  `tilaajan_puh` int(11) NOT NULL,
  `kesto` varchar(25) NOT NULL,
  `kohteen_nimi` varchar(25) NOT NULL,
  `kohteen_osoite` varchar(25) NOT NULL,
  `postinumero` int(11) NOT NULL,
  `toimipaikka` varchar(25) NOT NULL,
  `kohteen_yht` varchar(25) NOT NULL,
  `yhteyshenkilo_puh` int(11) NOT NULL,
  `osasto` varchar(25) NOT NULL,
  `tilatunniste` varchar(25) NOT NULL,
  PRIMARY KEY (`TilausID`),
  KEY `AsiakasID` (`AsiakasID`),
  KEY `LaiteID` (`LaiteID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
