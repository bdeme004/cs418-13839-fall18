-- MySQL dump 10.13  Distrib 5.5.50, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: mysqltest
-- ------------------------------------------------------
-- Server version	5.5.50-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `mysqltest`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `mysqltest` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `mysqltest`;

--
-- Table structure for table `oduScores`
--

DROP TABLE IF EXISTS `oduScores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oduScores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `opponent` varchar(30) NOT NULL,
  `visitorPoints` int(11) NOT NULL,
  `oduPoints` int(11) NOT NULL,
  `notes` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oduScores`
--

LOCK TABLES `oduScores` WRITE;
/*!40000 ALTER TABLE `oduScores` DISABLE KEYS */;
INSERT INTO `oduScores` VALUES (1,'Albany',17,31,'2017-09-02 13:06:05');
INSERT INTO `oduScores` VALUES (2,'UMASS',7,17,'2017-09-09 12:00:00');
/*!40000 ALTER TABLE `oduScores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;



CREATE DATABASE /*!32312 IF NOT EXISTS*/ `cars` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `cars`;


CREATE TABLE IF NOT EXISTS `makes` (
  `make_id` int(11) NOT NULL,
  `make_name` varchar(65) NOT NULL,
  `hq` text NOT NULL,
  `make_notes` text NOT NULL,
  PRIMARY KEY (`make_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `makes`
--

INSERT INTO `makes` (`make_id`, `make_name`, `hq`, `make_notes`) VALUES
(1, 'Ford', 'Dearborn, Michigan, USA', 'Best make'),
(2, 'Chevrolet', 'Detroit, Michigan, USA', 'A good second best');

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE IF NOT EXISTS `models` (
  `model_id` int(11) NOT NULL,
  `make_id` int(11) NOT NULL,
  `make_name` varchar(65) NOT NULL,
  `horsepower` int(11) NOT NULL,
  `num_doors` int(11) NOT NULL,
  `make_notes` text NOT NULL,
  PRIMARY KEY (`model_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`model_id`, `make_id`, `make_name`, `horsepower`, `num_doors`, `make_notes`) VALUES
(1, 1, 'mustang gt', 435, 2, 'crazy awesome car'),
(2, 1, 'ford focus', 123, 4, 'cheaper car'),
(3, 2, 'camaro ss', 650, 2, 'looks good on paper...'),
(4, 2, 'impala', 197, 4, 'really not worth buying...');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-03  9:17:48
