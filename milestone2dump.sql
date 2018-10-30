-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 30, 2018 at 06:37 PM
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
-- Table structure for table `heliotrope`
--

DROP TABLE IF EXISTS `heliotrope`;
CREATE TABLE IF NOT EXISTS `heliotrope` (
  `chIndex` varchar(16) NOT NULL,
  `chTitle` text NOT NULL,
  `chPrivate` int(11) NOT NULL DEFAULT '0',
  `chAllowedUsers` varchar(5) NOT NULL DEFAULT 'ALL',
  `chReplies` int(11) NOT NULL DEFAULT '0' COMMENT 'This isn''t strictly necessary. But I sort of suspect it''s good to have.',
  `chUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'This isn''t strictly necessary. But I sort of suspect it''s good to have.',
  PRIMARY KEY (`chIndex`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `heliotrope`
--

INSERT INTO `heliotrope` (`chIndex`, `chTitle`, `chPrivate`, `chAllowedUsers`, `chReplies`, `chUpdated`) VALUES
('1', 'Very nervous!', 0, 'ALL', 0, '2018-10-30 10:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `lightsky`
--

DROP TABLE IF EXISTS `lightsky`;
CREATE TABLE IF NOT EXISTS `lightsky` (
  `chIndex` varchar(16) NOT NULL,
  `chTitle` text NOT NULL,
  `chPrivate` int(11) NOT NULL DEFAULT '0',
  `chAllowedUsers` varchar(5) NOT NULL DEFAULT 'ALL',
  `chReplies` int(11) NOT NULL DEFAULT '0' COMMENT 'This isn''t strictly necessary. But I sort of suspect it''s good to have.',
  `chUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'This isn''t strictly necessary. But I sort of suspect it''s good to have.',
  PRIMARY KEY (`chIndex`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `milan`
--

DROP TABLE IF EXISTS `milan`;
CREATE TABLE IF NOT EXISTS `milan` (
  `chIndex` varchar(16) NOT NULL,
  `chTitle` text NOT NULL,
  `chPrivate` int(11) NOT NULL DEFAULT '0',
  `chAllowedUsers` varchar(5) NOT NULL DEFAULT 'ALL',
  `chReplies` int(11) NOT NULL DEFAULT '0' COMMENT 'This isn''t strictly necessary. But I sort of suspect it''s good to have.',
  `chUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'This isn''t strictly necessary. But I sort of suspect it''s good to have.',
  PRIMARY KEY (`chIndex`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mint`
--

DROP TABLE IF EXISTS `mint`;
CREATE TABLE IF NOT EXISTS `mint` (
  `chIndex` varchar(16) NOT NULL,
  `chTitle` text NOT NULL,
  `chPrivate` int(11) NOT NULL DEFAULT '0',
  `chAllowedUsers` varchar(5) NOT NULL DEFAULT 'ALL',
  `chReplies` int(11) NOT NULL DEFAULT '0' COMMENT 'This isn''t strictly necessary. But I sort of suspect it''s good to have.',
  `chUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'This isn''t strictly necessary. But I sort of suspect it''s good to have.',
  PRIMARY KEY (`chIndex`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mint`
--

INSERT INTO `mint` (`chIndex`, `chTitle`, `chPrivate`, `chAllowedUsers`, `chReplies`, `chUpdated`) VALUES
('t15409236916362', 'Secret Agent Meeting', 0, 'ALL', 0, '2018-10-30 14:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `tearose`
--

DROP TABLE IF EXISTS `tearose`;
CREATE TABLE IF NOT EXISTS `tearose` (
  `chIndex` varchar(16) NOT NULL,
  `chTitle` text NOT NULL,
  `chPrivate` int(11) NOT NULL DEFAULT '0',
  `chAllowedUsers` varchar(5) NOT NULL DEFAULT 'ALL',
  `chReplies` int(11) NOT NULL DEFAULT '0' COMMENT 'This isn''t strictly necessary. But I sort of suspect it''s good to have.',
  `chUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'This isn''t strictly necessary. But I sort of suspect it''s good to have.',
  PRIMARY KEY (`chIndex`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tearose`
--

INSERT INTO `tearose` (`chIndex`, `chTitle`, `chPrivate`, `chAllowedUsers`, `chReplies`, `chUpdated`) VALUES
('t15409220590683', 'aaaaa', 0, 'ALL', 0, '2018-10-30 13:54:19'),
('t15409228019388', 'Counting Off', 0, 'ALL', 0, '2018-10-30 14:06:41');
--
-- Database: `threads`
--
CREATE DATABASE IF NOT EXISTS `threads` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `threads`;

-- --------------------------------------------------------

--
-- Table structure for table `t15409236916362`
--

DROP TABLE IF EXISTS `t15409236916362`;
CREATE TABLE IF NOT EXISTS `t15409236916362` (
  `user` varchar(10) NOT NULL,
  `body` text NOT NULL,
  `creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chKey` int(11) NOT NULL AUTO_INCREMENT,
  `avatar` text NOT NULL,
  PRIMARY KEY (`chKey`)
) ENGINE=MyISAM AUTO_INCREMENT=284 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t15409236916362`
--

INSERT INTO `t15409236916362` (`user`, `body`, `creation`, `chKey`, `avatar`) VALUES
('bdemerch', 'SECRET AGENT MEETING', '2018-10-30 18:22:52', 1, '15408921637358.png');
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
  `name` varchar(45) DEFAULT NULL,
  `passcode` varchar(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `avatar` text NOT NULL,
  `comment` varchar(240) NOT NULL DEFAULT '"This user hasn''t added a comment."',
  PRIMARY KEY (`handle`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`handle`, `name`, `passcode`, `email`, `avatar`, `comment`) VALUES
('@mater', 'Tow Mater', '@mater', 'mater@rsprings.gov', '15408259583499.png', 'Tow trucks tow things.'),
('@sally', 'Sally Carrera', '@sally', 'porsche@rsprings.gov', '15408259634168.png', 'Zoom Zoom.'),
('@doc', 'Doc Hudson', '@doc', 'hornet@rsprings.gov', '15408259361210.png', 'Zoom Zoom.'),
('@mcmissile', 'Finn McMissile', '@mcmissile', 'topsecret@agent.org', '15408259411731.png', 'Zoom Zoom?'),
('@mcqueen', 'Lightning McQueen', '@mcqueen', 'kachow@rusteze.com', '15408259521527.png', 'ZOOM ZOOM!'),
('@chick', 'Chick Hicks', '@chick', 'chinga@cars.com', '15408259306433.png', 'Zoom zoom.'),
('bdemerch', 'Bethany DeMerchant', 'bdemerch', 'bdeme004@odu.edu', '15408921637358.png', 'I added my own username because I kept having to stop and look up the car names.'),
('@TheMoosh', 'Misha', '@themoosh', 'moosh@moo.sh', 'default_img.png', 'STOP CODING AND PET ME');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
