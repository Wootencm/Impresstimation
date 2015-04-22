# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.15)
# Database: printing
# Generation Time: 2015-01-21 16:54:31 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name_client` varchar(100) DEFAULT NULL,
  `first_name_sales_rep` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL,
  `last_name_client` varchar(100) DEFAULT NULL,
  `last_name_sales_rep` varchar(100) DEFAULT NULL,
  `pdf` varchar(11) DEFAULT NULL,
  `job_info` varchar(500) DEFAULT NULL,
  `estimate` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table services
# ------------------------------------------------------------

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `service_type` varchar(20) DEFAULT NULL,
  `offered` varchar(11) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `pp` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;

INSERT INTO `services` (`id`, `service_type`, `offered`, `category`, `price`, `pp`)
VALUES
	(1,'House Papers','Yes','Paper Type',10.5,'Pre'),
	(2,'Colored Paper','Yes','Paper Type',5,'Pre'),
	(3,'A2','Yes','Paper Size',0,'Pre'),
	(4,'A6','Yes','Paper Size',0,'Pre'),
	(7,'Black and White','Yes','Color Options',1,'Pre'),
	(8,'Double Hit','Yes','Color Options',1,'Pre'),
	(9,'Editing','Yes','Misc',4,'Post'),
	(10,'Bindary','Yes','Misc',5,'Post'),
	(13,'4-bar','Yes','Paper Size',0,'Pre'),
	(14,'Lee','Yes','Paper Size ',0,'Pre'),
	(15,'A7','Yes','Paper Size',NULL,'Pre'),
	(16,'A9','Yes','Paper Size',0,'Pre'),
	(17,'5.75\" square','Yes','Paper Size',NULL,'Pre'),
	(18,'6.5\" square','Yes','Paper Size',NULL,'Pre'),
	(19,'#10','Yes','Paper Size',NULL,'Pre'),
	(20,'Recycled Paper','Yes','Paper Type',NULL,'Pre'),
	(21,'Duotone','Yes','Color Options',NULL,'Pre'),
	(22,'Soy Inks','Yes','Color Options',NULL,'Pre'),
	(23,'Letter','Yes','Folding',NULL,'Post'),
	(24,'Half ','Yes','Folding',NULL,'Post'),
	(25,'Z','Yes','Folding',NULL,'Post'),
	(26,'Custom','Yes','Folding',NULL,'Post'),
	(27,'Letter','Yes','Paper Size ',NULL,'Pre'),
	(28,'Color 4c','Yes','Color Options',NULL,'Pre'),
	(29,'Spot Color','Yes','Color Options',NULL,'Pre'),
	(30,'Shredding','Yes','Color Options',NULL,'Pre'),
	(31,'100 lb. Gloss Text','Yes','Paper Weight',NULL,'Pre'),
	(32,'70 lb. Matte','Yes','Paper Weight',NULL,'Pre'),
	(33,'100 lb. Gloss','Yes','Paper Weight',NULL,'Pre'),
	(34,'80 lb. Matte','No','Paper Weight',NULL,'Pre'),
	(35,'No Hole','No','Hole Drilling',NULL,'Post'),
	(36,'3/16\"','Yes','Hole Drilling',NULL,'Post'),
	(37,'1/4\" ','Yes','Hole Drilling',NULL,'Post'),
	(38,'5/16\"','Yes','Hole Drilling',NULL,'Post'),
	(39,'Economy','Yes','Shipping',NULL,'Post'),
	(40,'Standard','Yes','Shipping',NULL,'Post'),
	(41,'Express','Yes','Shipping',NULL,'Post'),
	(42,'Rush','Yes','Shipping',NULL,'Post');

/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table usertable
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usertable`;

CREATE TABLE `usertable` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(200) DEFAULT '',
  `type` varchar(11) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `first_name` varchar(11) DEFAULT NULL,
  `last_name` varchar(11) DEFAULT NULL,
  `company` varchar(11) DEFAULT NULL,
  `industry` varchar(11) DEFAULT NULL,
  `phone_number` varchar(11) DEFAULT NULL,
  `address` varchar(11) DEFAULT NULL,
  `city` varchar(11) DEFAULT NULL,
  `zip_code` varchar(11) DEFAULT NULL,
  `state` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `usertable` WRITE;
/*!40000 ALTER TABLE `usertable` DISABLE KEYS */;

INSERT INTO `usertable` (`id`, `password`, `type`, `email`, `first_name`, `last_name`, `company`, `industry`, `phone_number`, `address`, `city`, `zip_code`, `state`)
VALUES
	(1,'test','admin','zubairs@vcu.edu','sahil','zubair','vcu','computer_sc','757-580-068','369 West P','Richmond','23517','VA'),
	(2,'test1','admin','wootencm@vcu.edu','Chris','Wooten','VCU','Computer_sc','804-658-920','7276 cold h','Mechanicsvi','23111','VA'),
	(3,'test2','admin','jacobia@vcu.edu','alex','jacobi','vcu','computer_sc','804-231-581','342 broad s','Richmond','23517','Va');

/*!40000 ALTER TABLE `usertable` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
