# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#raanswer
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.23-0ubuntu0.18.04.1)
# Database: ve_test
# Generation Time: 2018-12-08 02:09:58 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table raanswer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `raanswer`;

CREATE TABLE `raanswer` (
  `RAAID` int(11) NOT NULL AUTO_INCREMENT,
  `RAID` int(11) DEFAULT NULL,
  `audioPath` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `raComment` varchar(4500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reserved2` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reserved3` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT b'0',
  PRIMARY KEY (`RAAID`),
  UNIQUE KEY `RAAID_UNIQUE` (`RAAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='read aloud answer';



# Dump of table rainfo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rainfo`;

CREATE TABLE `rainfo` (
  `RAID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `isFrequency` bit(1) DEFAULT NULL,
  `isDifficult` int(11) DEFAULT NULL,
  `isNew` bit(1) DEFAULT NULL,
  `isJJ` bit(1) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  `category` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `inputUser` int(11) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT b'0',
  PRIMARY KEY (`RAID`),
  UNIQUE KEY `RAID_UNIQUE` (`RAID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='read aloud info';



# Dump of table raquestion
# ------------------------------------------------------------

DROP TABLE IF EXISTS `raquestion`;

CREATE TABLE `raquestion` (
  `RAQID` int(11) NOT NULL AUTO_INCREMENT,
  `RAID` int(11) DEFAULT NULL,
  `content` varchar(4500) CHARACTER SET utf8 DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT b'0',
  PRIMARY KEY (`RAQID`),
  UNIQUE KEY `RAQID_UNIQUE` (`RAQID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
