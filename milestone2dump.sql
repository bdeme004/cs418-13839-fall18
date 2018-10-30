-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 30, 2018 at 06:25 PM
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `name` varchar(45) DEFAULT NULL,
  `passcode` varchar(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `avatar` text NOT NULL,
  `comment` varchar(240) NOT NULL DEFAULT '"This user hasn''t added a comment."',
  PRIMARY KEY (`handle`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
