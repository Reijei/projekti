-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 20, 2018 at 09:18 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

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
  PRIMARY KEY (`admin_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `tunnus`, `salasana`, `email`) VALUES
(1, 'admin', 'salasana', 'email@testi.fi');

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
(1, 'asd', 'asd', 'asd', 'asd', 'asd', '123', 'asd', '123', 'asd', 'asd'),
(2, 'asdasd', 'asdasd', 'asdasd', '123123', 'asdasd', '123123', 'asdasd', '123123', 'asdasd', 'asdasd'),
(3, 'fgh', 'fgh', 'fgh', 'fgh', 'fgh', 'fgh', 'fgh', 'fgh', 'fgh', 'fgh'),
(282, 'bnm', 'bnm', 'bnm', 'bnm', 'bnm', 'bnm', 'bnm', 'bnbnmm', 'bnm', 'bnm'),
(281, 'zxc', 'zxc', 'zxc', 'zxc', 'zxc', 'zxc', 'zxc', 'zxc', 'zxc', 'zxc'),
(280, 'asdasd', 'vbn', 'vbn', 'vbnvbn', 'vbn', 'vbn', 'vbn', 'vbn', 'vbn', 'vbn'),
(279, 'asd', 'asdasd', 'asd', 'afgh', 'fgh', 'jkl', 'jkl', 'jkl', 'jkl', 'jkl'),
(278, 'asdasd', 'fgh', 'asdasd', '123123', 'fgh', 'fgh', 'asdasd', '123123', 'asdasd', 'fgh'),
(277, 'hjk', 'hjk', 'hjk', 'jhk', 'hjk', 'hjk', 'hjk', 'hjk', 'hjk', 'hjk');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `huoltohistoria`
--

INSERT INTO `huoltohistoria` (`HuoltoID`, `LaiteID`, `Huoltopvm`, `Sisaisethuomiot`, `Huom`) VALUES
(2, 2, '2018-11-20', '2', '2');

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

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
(9, 111111, 'asdasdasd', '123123123', 'asd', 'varattu');

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
('ABC', 'ABC@ABC.ABC', 'Savonia AMK', 'Opistotie 2', 'Tilaisin puhdistimen.');



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
