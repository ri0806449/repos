# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.13-MariaDB)
# Database: trytrysee
# Generation Time: 2020-08-14 07:06:34 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '就是id',
  `username` varchar(30) NOT NULL COMMENT '使用者帳號',
  `password` varchar(30) NOT NULL DEFAULT '' COMMENT '使用者密碼',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '使用者信箱',
  `gender` tinyint(2) NOT NULL COMMENT '0：女；1：男',
  `hobby` varchar(1000) NOT NULL DEFAULT '' COMMENT '使用者癖好......我是說興趣',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `gender`, `hobby`)
VALUES
	(1,'thrive','qqq','ri0806449@yahoo.com',1,'吃飯睡覺打爆東東');

/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '就是id',
  `username` varchar(30) NOT NULL COMMENT '使用者帳號',
  `password` varchar(30) NOT NULL DEFAULT '' COMMENT '使用者密碼',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '使用者信箱',
  `gender` tinyint(2) NOT NULL COMMENT '0：女；1：男',
  `hobby` varchar(1000) NOT NULL DEFAULT '' COMMENT '使用者癖好......我是說興趣',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `username`, `password`, `email`, `gender`, `hobby`)
VALUES
	(1,'ri0806449','qqq','ri0806449@yahoo.com.tw',1,'吃飯睡覺打東東'),
	(2,'mei','qqq','ri0806449@gmail.com',0,'吃飯睡覺打東東'),
	(3,'don','qqq','ri0806449@hotmail.com.tw',1,'吃飯睡覺（我就是東東哭哭）'),
	(4,'punhu','qqq','ri0806449@holemail.com',1,'小夫我要進來囉'),
	(6,'qwerty','ddddd','ri0806449@yahoo.com.tw',1,'wertuytrewrstdfghjk'),
	(7,'qqlfk','qqqqq','ri0806449@yahoo.com.tw',1,'吃飯睡覺戳東東'),
	(8,'thunder_cry','qqqqq','ri0806449@yahoo.com.tw',0,'打雷讓人害怕哭哭'),
	(9,'qqqqqq','qqqqqq','ri0806449@yahoo.com.tw',1,'qqqqqqqqqqq'),
	(10,'test_reg','qqqqq','ri0806449@yahoo.com.tw',1,'qwerthjgkewarsdgfhjk'),
	(11,'wwwww','wwwww','ri0806449@yahoo.com.tw',1,'wefgdhrewghfretghrtegfhtre5r'),
	(12,'qwqwqw','qwqwqw','ri0806449@yahoo.com.tw',0,'qqqqqqqqqq'),
	(13,'wewewe','wewewe','ri0806449@yahoo.com.tw',1,'wedfsdfbvwdsf'),
	(14,'qazqaz','qazqaz','ri0806449@yahoo.com.tw',0,'wergtyjukilo'),
	(15,'test_final','qqqqqq','ri0806449@yahoo.com.tw',0,'ewrgtdhjgkl;'),
	(16,'assass','assass','ri0806449@yahoo.com.tw',1,'sdafgdhfj'),
	(17,'ssssss','ssssss','ri0806449@yahoo.com.tw',1,'werthyukilop;\'oiuyt');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
