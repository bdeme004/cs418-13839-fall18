-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 16, 2018 at 01:02 PM
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
-- Database: `channels`
--
CREATE DATABASE IF NOT EXISTS `channels` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `channels`;

-- --------------------------------------------------------

--
-- Table structure for table `channel1`
--

DROP TABLE IF EXISTS `channel1`;
CREATE TABLE IF NOT EXISTS `channel1` (
  `user` varchar(10) NOT NULL,
  `body` varchar(255) NOT NULL,
  `creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chKey` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`chKey`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `channel2`
--

DROP TABLE IF EXISTS `channel2`;
CREATE TABLE IF NOT EXISTS `channel2` (
  `user` varchar(10) NOT NULL,
  `body` varchar(255) NOT NULL,
  `creation` timestamp NOT NULL,
  `chKey` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`chKey`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `channel3`
--

DROP TABLE IF EXISTS `channel3`;
CREATE TABLE IF NOT EXISTS `channel3` (
  `user` varchar(10) NOT NULL,
  `body` varchar(255) NOT NULL,
  `creation` timestamp NOT NULL,
  `chKey` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`chKey`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `channel4`
--

DROP TABLE IF EXISTS `channel4`;
CREATE TABLE IF NOT EXISTS `channel4` (
  `user` varchar(10) NOT NULL,
  `body` varchar(255) NOT NULL,
  `creation` timestamp NOT NULL,
  `chKey` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`chKey`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `channel5`
--

DROP TABLE IF EXISTS `channel5`;
CREATE TABLE IF NOT EXISTS `channel5` (
  `user` varchar(10) NOT NULL,
  `body` varchar(255) NOT NULL,
  `creation` timestamp NOT NULL,
  `chKey` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`chKey`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
--
-- Database: `users`
--
CREATE DATABASE IF NOT EXISTS `users` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `users`;

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

DROP TABLE IF EXISTS `usertable`;
CREATE TABLE IF NOT EXISTS `usertable` (
  `handle` varchar(10) NOT NULL,
  `name` varchar(45) NOT NULL,
  `passcode` varchar(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`handle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`handle`, `name`, `passcode`, `email`) VALUES
('@mater', 'Tow Mater', '@mater', 'mater@rsprings.gov'),
('@sally', 'Sally Carrera', '@sally', 'porsche@rsprings.gov'),
('@doc', 'Doc Hudson', '@doc', 'hornet@rsprings.gov'),
('@mcmissile', 'Finn McMissile', '@mcmissile', 'topsecret@agent.org'),
('@mcqueen', 'Lightning McQueen', '@mcqueen', 'kachow@rusteze.com'),
('@chick', 'Chick Hicks', '@chick', 'chinga@cars.com'),
('bdemerch', 'Bethany DeMerchant', 'bdemerch', 'bdeme004@odu.edu');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
