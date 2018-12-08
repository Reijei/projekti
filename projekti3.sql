-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 08, 2018 at 11:38 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asd`
--
CREATE DATABASE IF NOT EXISTS `asd` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `asd`;
--
-- Database: `projekti3`
--
CREATE DATABASE IF NOT EXISTS `projekti3` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projekti3`;

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
  `usertype` varchar(20) NOT NULL,
  PRIMARY KEY (`admin_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `tunnus`, `salasana`, `email`, `usertype`) VALUES
(1, 'admin', 'salasana', 'email@testi.fi', 'admin'),
(3, 'user', 'user', 'user@gmail.com', 'user');

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
  `laskutusvali` varchar(25) NOT NULL,
  `vakuuttaja` varchar(25) NOT NULL,
  `yhteyshenkilo` varchar(25) NOT NULL,
  PRIMARY KEY (`AsiakasID`)
) ENGINE=MyISAM AUTO_INCREMENT=283 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asiakas`
--

INSERT INTO `asiakas` (`AsiakasID`, `Asiakas`, `Asiakasluokitus`, `Laskutusosoite`, `postinumero`, `toimipaikka`, `verkkolaskutunnus`, `operaattori`, `laskutusvali`, `vakuuttaja`, `yhteyshenkilo`) VALUES
(256, 'Industless Oy', 'Asiakas', 'Viistokuja 3', '70200', 'Kuopio', '12345', 'OP', '30', 'Industless', 'Matti Meikäläinen');

-- --------------------------------------------------------

--
-- Table structure for table `asiakastilaus`
--

DROP TABLE IF EXISTS `asiakastilaus`;
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
('Industless Oy', 'Industlessoy@gmail.com', 'Savonia AMK', 'Opistotie 2', 'Tilauksen tiedot.');

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
  `Huom` text NOT NULL,
  PRIMARY KEY (`HuoltoID`),
  KEY `LaiteID` (`LaiteID`)
) ENGINE=MyISAM AUTO_INCREMENT=5033 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `huoltohistoria`
--

INSERT INTO `huoltohistoria` (`HuoltoID`, `LaiteID`, `Huoltopvm`, `Sisaisethuomiot`, `Huom`) VALUES
(5031, 2, '2018-11-20', 'Ei huomioitavaa', 'Ei huomioitavaa'),
(5032, 3, '2018-12-12', 'sdf', 'sdf');

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
  `seuraavahuolto` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`LaiteID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laite`
--

INSERT INTO `laite` (`LaiteID`, `Sarjanumero`, `Nimi`, `Vuokra_hinta`, `Laitetyyppi`, `varaus_tila`, `seuraavahuolto`) VALUES
(1, 60135, 'Puhdistin', '500', 'Puhdistin', 'vapaa', '2018-20-20'),
(2, 6049, 'Puhdistin', '305', 'Puhdistin', 'Vapaa', ''),
(10, 5031, 'Laite', '333', 'Laite', 'vapaa', NULL),
(11, 301648, 'Laite', '150', 'Laite', 'vapaa', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tilaus`
--

DROP TABLE IF EXISTS `tilaus`;
CREATE TABLE IF NOT EXISTS `tilaus` (
  `TilausID` int(11) NOT NULL AUTO_INCREMENT,
  `AsiakasID` int(11) NOT NULL,
  `LaiteID` int(11) NOT NULL,
  `alkpvm` int(11) NOT NULL,
  `loppupvm` int(11) NOT NULL,
  `tilaajan_puh` int(11) NOT NULL,
  `kesto` varchar(25) NOT NULL,
  `kohteen_nimi` varchar(25) NOT NULL,
  `kohteen_osoite` varchar(25) DEFAULT NULL,
  `postinumero` int(11) NOT NULL,
  `toimipaikka` varchar(25) NOT NULL,
  `kohteen_yht` varchar(25) NOT NULL,
  `yhteyshenkilo_puh` int(11) DEFAULT NULL,
  `osasto` varchar(25) NOT NULL,
  `tilatunniste` varchar(25) NOT NULL,
  PRIMARY KEY (`TilausID`),
  KEY `AsiakasID` (`AsiakasID`),
  KEY `LaiteID` (`LaiteID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tilaus`
--

INSERT INTO `tilaus` (`TilausID`, `AsiakasID`, `LaiteID`, `alkpvm`, `loppupvm`, `tilaajan_puh`, `kesto`, `kohteen_nimi`, `kohteen_osoite`, `postinumero`, `toimipaikka`, `kohteen_yht`, `yhteyshenkilo_puh`, `osasto`, `tilatunniste`) VALUES
(1, 3, 1, 234, 234, 234, '234', '234', NULL, 234, '234', '234', NULL, '234', '234'),
(2, 282, 7, 123, 123, 123, '123', 'asd', NULL, 123, 'asd', '123', NULL, '123', '123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
