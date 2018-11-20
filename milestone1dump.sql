-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 29, 2018 at 04:15 PM
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
  `body` text NOT NULL,
  `creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chKey` int(11) NOT NULL AUTO_INCREMENT,
  `avatar` text NOT NULL,
  PRIMARY KEY (`chKey`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channel1`
--

INSERT INTO `channel1` (`user`, `body`, `creation`, `chKey`, `avatar`) VALUES
('bdemerch', 'mooose', '2018-10-22 23:26:14', 1, '15408263468060.png'),
('bdemerch', '15,000 is too many dogs', '2018-10-28 17:26:08', 2, '15408263468060.png'),
('bdemerch', 'mooses are goos creature', '2018-10-29 01:46:57', 3, '15408263468060.png'),
('bdemerch', 'mooses', '2018-10-29 01:47:04', 4, '15408263468060.png'),
('bdemerch', 'lol, goos creature', '2018-10-29 01:47:19', 5, '15408263468060.png'),
('bdemerch', 'mooses are not goos creature. mooses are moos creature!', '2018-10-29 01:47:54', 6, '15408263468060.png'),
('bdemerch', 'no, but why is it on a delay...?', '2018-10-29 01:48:08', 8, '15408263468060.png'),
('bdemerch', 'MOOSES', '2018-10-29 16:08:18', 43, 'img/'),
('bdemerch', 'guikkhnl', '2018-10-29 16:01:52', 42, 'img/'),
('bdemerch', 'guikkhnl', '2018-10-29 16:01:29', 41, 'img/');

-- --------------------------------------------------------

--
-- Table structure for table `channel2`
--

DROP TABLE IF EXISTS `channel2`;
CREATE TABLE IF NOT EXISTS `channel2` (
  `user` varchar(10) NOT NULL,
  `body` text NOT NULL,
  `creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chKey` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`chKey`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channel2`
--

INSERT INTO `channel2` (`user`, `body`, `creation`, `chKey`) VALUES
('bdemerch', 'mooose', '2018-10-22 23:26:14', 1),
('bdemerch', '15,000 is too many dogs', '2018-10-28 17:26:08', 2);

-- --------------------------------------------------------

--
-- Table structure for table `channel3`
--

DROP TABLE IF EXISTS `channel3`;
CREATE TABLE IF NOT EXISTS `channel3` (
  `user` varchar(10) NOT NULL,
  `body` text NOT NULL,
  `creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chKey` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`chKey`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channel3`
--

INSERT INTO `channel3` (`user`, `body`, `creation`, `chKey`) VALUES
('bdemerch', 'mooose', '2018-10-22 23:26:14', 1),
('bdemerch', '15,000 is too many dogs', '2018-10-28 17:26:08', 2);

-- --------------------------------------------------------

--
-- Table structure for table `channel4`
--

DROP TABLE IF EXISTS `channel4`;
CREATE TABLE IF NOT EXISTS `channel4` (
  `user` varchar(10) NOT NULL,
  `body` text NOT NULL,
  `creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chKey` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`chKey`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channel4`
--

INSERT INTO `channel4` (`user`, `body`, `creation`, `chKey`) VALUES
('bdemerch', 'mooose', '2018-10-22 23:26:14', 1),
('bdemerch', '15,000 is too many dogs', '2018-10-28 17:26:08', 2);

-- --------------------------------------------------------

--
-- Table structure for table `channel5`
--

DROP TABLE IF EXISTS `channel5`;
CREATE TABLE IF NOT EXISTS `channel5` (
  `user` varchar(10) NOT NULL,
  `body` text NOT NULL,
  `creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chKey` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`chKey`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channel5`
--

INSERT INTO `channel5` (`user`, `body`, `creation`, `chKey`) VALUES
('bdemerch', 'mooose', '2018-10-22 23:26:14', 1),
('bdemerch', '15,000 is too many dogs', '2018-10-28 17:26:08', 2);

-- --------------------------------------------------------

--
-- Table structure for table `channellist`
--

DROP TABLE IF EXISTS `channellist`;
CREATE TABLE IF NOT EXISTS `channellist` (
  `chIndex` int(11) NOT NULL AUTO_INCREMENT,
  `chTitle` text NOT NULL,
  `chReplies` int(11) NOT NULL DEFAULT '0' COMMENT 'This isn''t strictly necessary. But I sort of suspect it''s good to have.',
  `chUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'This isn''t strictly necessary. But I sort of suspect it''s good to have.',
  `chPrivate` int(11) NOT NULL DEFAULT '0',
  `chAllowedUsers` varchar(5) NOT NULL DEFAULT 'ALL',
  PRIMARY KEY (`chIndex`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channellist`
--

INSERT INTO `channellist` (`chIndex`, `chTitle`, `chReplies`, `chUpdated`, `chPrivate`, `chAllowedUsers`) VALUES
(1, 'I\'m fully expecting problems here.', 0, '2018-10-22 18:19:43', 0, 'ALL'),
(2, 'testingwithnooddcharas', 0, '2018-10-22 18:21:03', 0, 'ALL'),
(3, 'Private Channel Test', 0, '2018-10-22 18:21:48', 1, 'ALL');
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
  `avatar` text NOT NULL,
  PRIMARY KEY (`handle`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`handle`, `name`, `passcode`, `email`, `avatar`) VALUES
('@mater', 'Tow Mater', '@mater', 'mater@rsprings.gov', '15408259583499.png'),
('@sally', 'Sally Carrera', '@sally', 'porsche@rsprings.gov', '15408259634168.png'),
('@doc', 'Doc Hudson', '@doc', 'hornet@rsprings.gov', '15408259361210.png'),
('@mcmissile', 'Finn McMissile', '@mcmissile', 'topsecret@agent.org', '15408259411731.png'),
('@mcqueen', 'Lightning McQueen', '@mcqueen', 'kachow@rusteze.com', '15408259521527.png'),
('@chick', 'Chick Hicks', '@chick', 'chinga@cars.com', '15408259306433.png'),
('bdemerch', 'Bethany DeMerchant', 'bdemerch', 'bdeme004@odu.edu', '15408263468060.png'),
('803box', 'Bethany DeMerchant', '803box', '803box@gmail.com', '15408263410150.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
