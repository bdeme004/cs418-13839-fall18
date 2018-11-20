-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 20, 2018 at 12:10 PM
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
  `chArchived` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`chIndex`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
  `chArchived` int(11) DEFAULT '0',
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
  `chArchived` int(11) NOT NULL DEFAULT '0',
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
  `chArchived` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`chIndex`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `chArchived` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`chIndex`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
--
-- Database: `threads`
--
CREATE DATABASE IF NOT EXISTS `threads` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `threads`;

-- --------------------------------------------------------

--
-- Table structure for table `t15420755835785`
--

DROP TABLE IF EXISTS `t15420755835785`;
CREATE TABLE IF NOT EXISTS `t15420755835785` (
  `user` varchar(13) NOT NULL,
  `body` text NOT NULL,
  `creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chKey` int(11) NOT NULL AUTO_INCREMENT,
  `avatar` text NOT NULL,
  PRIMARY KEY (`chKey`)
) ENGINE=MyISAM AUTO_INCREMENT=283 DEFAULT CHARSET=latin1;
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
  `handle` varchar(13) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `passcode` varchar(13) NOT NULL,
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
('@mater', 'Tow Mater', '@mater', 'mater@rsprings.gov', '15422236415563.png', 'Tow trucks tow things.'),
('@sally', 'Sally Carrera', '@sally', 'porsche@rsprings.gov', '15408259634168.png', 'Zoom Zoom.'),
('@doc', 'Doc Hudson', '@doc', 'hornet@rsprings.gov', '15408259361210.png', 'Zoom Zoom.'),
('@mcmissile', 'Finn McMissile', '@mcmissile', 'topsecret@agent.org', '15408259411731.png', 'Zoom Zoom?'),
('@mcqueen', 'Lightning McQueen', '@mcqueen', 'kachow@rusteze.com', 'default_img.png', 'ZOOM ZOOM!'),
('@chick', 'Chick Hicks', '@chick', 'chinga@cars.com', '15408259306433.png', 'Zoom zoom.'),
('bdemerch', 'Bethany DeMerchant', 'bdemerch', 'bdeme004@odu.edu', '15426710113260.jpg', 'I added my own username because I kept having to stop and look up the car names.'),
('@Silas', NULL, 'silas', 'de.bethj@gmail.com', 'default_img.png', '\"This user hasn\'t added a comment.\"'),
('@TheMoosh', 'MOOSH', '@themoosh', 'moosh@moo.sh', 'default_img.png', 'STOP CODING AND PET ME'),
('@mome', NULL, 'mome', 'TRACIDEMERCHANT@GMAIL.COM', 'default_img.png', '\"This user hasn\'t added a comment.\"'),
('ADMINISTRATOR', NULL, 'ADMINISTRATOR', '803box@gmail.com', 'default_img.png', '\"This user hasn\'t added a comment.\"'),
('<p> cat</p>', NULL, 'cat', 'mome@mome', 'default_img.png', '\"This user hasn\'t added a comment.\"');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
