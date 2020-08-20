# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.13-MariaDB)
# Database: trytrysee
# Generation Time: 2020-08-20 10:07:16 +0000
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
  `password` varchar(100) NOT NULL DEFAULT '' COMMENT '使用者密碼',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '使用者信箱',
  `gender` tinyint(2) NOT NULL COMMENT '0：女；1：男',
  `hobby` varchar(1000) NOT NULL DEFAULT '' COMMENT '使用者癖好......我是說興趣',
  `token` varchar(100) DEFAULT NULL COMMENT '使用者忘記密碼實戰家瑜網址後方之亂數',
  `token_create_time` timestamp NULL DEFAULT NULL,
  `token_expire_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `username`, `password`, `email`, `gender`, `hobby`, `token`, `token_create_time`, `token_expire_time`)
VALUES
	(1,'ri0806449','cd87cd5ef753a06ee79fc75dc7cfe66c','ri0806449@yahoo.com.tw',1,'睡覺打東東',NULL,'2020-08-20 10:02:33',NULL),
	(2,'mei','cd87cd5ef753a06ee79fc75dc7cfe66c','ri0806449@gmail.com',0,'吃飯睡覺打東東',NULL,'2020-08-20 10:02:33',NULL),
	(3,'don','cd87cd5ef753a06ee79fc75dc7cfe66c','ri0806449@hotmail.com.tw',1,'吃飯睡覺（我就是東東哭哭）',NULL,'2020-08-20 10:02:33',NULL),
	(4,'punhu','cd87cd5ef753a06ee79fc75dc7cfe66c','ri0806449@holemail.com',1,'小夫我要進來囉',NULL,'2020-08-20 10:02:33',NULL),
	(6,'qwerty','cd87cd5ef753a06ee79fc75dc7cfe66c','ri0806449@yahoo.com.tw',1,'wertuytrewrstdfghjk',NULL,'2020-08-20 10:02:33',NULL),
	(7,'qqlfk','cd87cd5ef753a06ee79fc75dc7cfe66c','ri0806449@yahoo.com.tw',1,'吃飯睡覺戳東東',NULL,'2020-08-20 10:02:33',NULL),
	(8,'thunder_cry','cd87cd5ef753a06ee79fc75dc7cfe66c','ri0806449@yahoo.com.tw',0,'打雷讓人害怕哭哭',NULL,'2020-08-20 10:02:33',NULL),
	(9,'qqqqqq','cd87cd5ef753a06ee79fc75dc7cfe66c','ri0806449@yahoo.com.tw',1,'qqqqqqqqqqq',NULL,'2020-08-20 10:02:33',NULL),
	(10,'test_reg','cd87cd5ef753a06ee79fc75dc7cfe66c','ri0806449@yahoo.com.tw',1,'qwerthjgkewarsdgfhjk',NULL,'2020-08-20 10:02:33',NULL),
	(11,'wwwww','cd87cd5ef753a06ee79fc75dc7cfe66c','ri0806449@yahoo.com.tw',1,'wefgdhrewghfretghrtegfhtre5r',NULL,'2020-08-20 10:02:33',NULL),
	(12,'qwqwqw','cd87cd5ef753a06ee79fc75dc7cfe66c','ri0806449@yahoo.com.tw',0,'qqqqqqqqqq',NULL,'2020-08-20 10:02:33',NULL),
	(13,'wewewe','cd87cd5ef753a06ee79fc75dc7cfe66c','ri0806449@yahoo.com.tw',1,'wedfsdfbvwdsf',NULL,'2020-08-20 10:02:33',NULL),
	(14,'qazqaz','cd87cd5ef753a06ee79fc75dc7cfe66c','ri0806449@yahoo.com.tw',0,'wergtyjukilo',NULL,'2020-08-20 10:02:33',NULL),
	(15,'test_final','cd87cd5ef753a06ee79fc75dc7cfe66c','ri0806449@yahoo.com.tw',0,'ewrgtdhjgkl;',NULL,'2020-08-20 10:02:33',NULL),
	(16,'assass','cd87cd5ef753a06ee79fc75dc7cfe66c','ri0806449@yahoo.com.tw',1,'sdafgdhfj',NULL,'2020-08-20 10:02:33',NULL),
	(17,'ssssss','cd87cd5ef753a06ee79fc75dc7cfe66c','ri0806449@yahoo.com.tw',1,'werthyukilop;\'oiuyt',NULL,'2020-08-20 10:02:33',NULL),
	(18,'zzzzzz','cd87cd5ef753a06ee79fc75dc7cfe66c','ri0806449@yahoo.com.tw',1,'efsgrdhtfyjgh',NULL,'2020-08-20 10:02:33',NULL),
	(19,'aaaaaa','cd87cd5ef753a06ee79fc75dc7cfe66c','ri0806449@yahoo.com.tw',1,'wdefgrhtyjukilo;p',NULL,'2020-08-20 10:02:33',NULL),
	(20,'xxxxxx','cd87cd5ef753a06ee79fc75dc7cfe66c','ri0806449@yahoo.com.tw',1,'當X戰警',NULL,'2020-08-20 10:02:33',NULL),
	(21,'sssss','cd87cd5ef753a06ee79fc75dc7cfe66c','qwerty@yahoo.com.tw',1,'dvfbfdgcg',NULL,'2020-08-20 10:02:33',NULL),
	(22,'hhhhhh','erth','ertyui@yahoo.com.tw',1,'wefdghjtret',NULL,'2020-08-20 10:02:33',NULL),
	(23,'steve','d69403e2673e611d4cbd3fad6fd1788e','dexster.wang@babyhome.com',1,'史蒂夫與戴夫已經去睡公園了','586326591538234796','2020-08-20 10:02:33',NULL),
	(28,'dave','1610838743cc90e3e4fdda748282d9b8','dexster.wang@babyhome.com.tw',1,'跟史蒂夫一起睡公園','15734832641247377636','0000-00-00 00:00:00','2020-08-20 12:18:40'),
	(29,'wwwwww','d785c99d298a4e9e6e13fe99e602ef42','qwegrhf@eghfgdn.com.tw',1,'sadfdgfndefwq',NULL,'2020-08-20 10:02:33',NULL);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
