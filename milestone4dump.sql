-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 10, 2018 at 01:24 PM
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

--
-- Table structure for table `direct`
--

DROP TABLE IF EXISTS `direct`;
CREATE TABLE IF NOT EXISTS `direct` (
  `thIndex` varchar(26) NOT NULL,
  `user` varchar(13) DEFAULT NULL,
  `avatar` text,
  `user2` varchar(13) DEFAULT NULL,
  `avatar2` text,
  `newest` text COMMENT 'the most recent message',
  `chKey` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date modified; named ''chKey'' for compatibility',
  PRIMARY KEY (`thIndex`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `chUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'This isn''t strictly necessary. But I sort of suspect it''s good to have.',
  `chArchived` int(11) NOT NULL DEFAULT '0',
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
  `chUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'This isn''t strictly necessary. But I sort of suspect it''s good to have.',
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
  `chUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'This isn''t strictly necessary. But I sort of suspect it''s good to have.',
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
  `chUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'This isn''t strictly necessary. But I sort of suspect it''s good to have.',
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
  `chUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'This isn''t strictly necessary. But I sort of suspect it''s good to have.',
  `chArchived` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`chIndex`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
--
-- Database: `direct`
--
CREATE DATABASE IF NOT EXISTS `direct` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `direct`;

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

DROP TABLE IF EXISTS `reactions`;
CREATE TABLE IF NOT EXISTS `reactions` (
  `thIndex` varchar(16) NOT NULL,
  `chKey` int(11) NOT NULL,
  `rxCode` int(2) NOT NULL,
  `userOP` text NOT NULL,
  `userRX` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
--
-- Database: `threads`
--
CREATE DATABASE IF NOT EXISTS `threads` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `threads`;


--
-- Table structure for table `reactions`
--

DROP TABLE IF EXISTS `reactions`;
CREATE TABLE IF NOT EXISTS `reactions` (
  `thIndex` varchar(16) NOT NULL,
  `chKey` int(11) NOT NULL,
  `rxCode` int(2) NOT NULL,
  `userOP` text NOT NULL,
  `userRX` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
--
-- Database: `users`
--
CREATE DATABASE IF NOT EXISTS `users` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `users`;

DELIMITER $$
--
-- Functions
--
DROP FUNCTION IF EXISTS `fetchcode`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `fetchcode` () RETURNS TEXT CHARSET latin1 NO SQL
BEGIN
RETURN (SELECT potato FROM `data` WHERE chKey=1);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

DROP TABLE IF EXISTS `data`;
CREATE TABLE IF NOT EXISTS `data` (
  `chKey` int(11) NOT NULL AUTO_INCREMENT,
  `potato` text NOT NULL,
  PRIMARY KEY (`chKey`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`chKey`, `potato`) VALUES
(1, '82558fb986dcd5a695b74c7c0623ad85bbcfffc4'),
(2, '8a0da6951437616cd4ccf5e1faed6bd810867c48');

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
('@mater', 'Tow Mater', '@mater', 'mater@rsprings.gov', 'https://www.gravatar.com/avatar/65ff88ee5edcce639c8544d824c6e544?d=identicon&s=50', 'Tow trucks tow things.'),
('@sally', 'Sally Carrera', '@sally', 'porsche@rsprings.gov', 'https://www.gravatar.com/avatar/101265fcf141c6fb4a98e520735e2419?d=identicon&s=50', 'Zoom Zoom.'),
('@doc', 'Doc Hudson', '@doc', 'hornet@rsprings.gov', 'https://www.gravatar.com/avatar/936cb3b6e701c67af2337eac72f8451d?d=identicon&s=50', 'Zoom Zoom.'),
('@mcmissile', 'Finn McMissile', '@mcmissile', 'topsecret@agent.org', 'https://www.gravatar.com/avatar/e6810e5428b5ef81f2c41c5fff797db4?d=identicon&s=50', 'Zoom Zoom?'),
('@mcqueen', 'Lightning McQueen', '@mcqueen', 'kachow@rusteze.com', 'https://www.gravatar.com/avatar/kachow@rusteze.com?d=identicon&s=50', 'ZOOM ZOOM!'),
('@chick', 'Chick Hicks', '@chick', 'chinga@cars.com', 'https://www.gravatar.com/avatar/2a4237a9a1676a06923482291c63de8f?d=identicon&s=50', 'Zoom zoom.'),
('bdemerch', 'Bethany DeMerchant', 'bdemerch', 'bdeme004@odu.edu', 'https://www.gravatar.com/avatar/bdeme004@odu.edu?d=identicon&s=50', 'I added my own username because I kept having to stop and look up the car names.'),
('ADMINISTRATOR', NULL, 'ADMINISTRATOR', '803box@gmail.com', 'https://www.gravatar.com/avatar/85443a34eb6e41dffef11e2bb9a7fe32?d=identicon&s=50', 'This user hasn\'t added a comment.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
