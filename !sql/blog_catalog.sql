# MySQL-Front 3.2  (Build 6.11)

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES 'utf8' */;

# Host: localhost    Database: next24
# ------------------------------------------------------
# Server version 5.0.45-community-nt

#
# Table structure for table blog_catalog
#

DROP TABLE IF EXISTS `blog_catalog`;
CREATE TABLE `blog_catalog` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) character set cp1251 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

#
# Dumping data for table blog_catalog
#

INSERT INTO `blog_catalog` (`id`,`name`) VALUES (1,'Кат 1');
INSERT INTO `blog_catalog` (`id`,`name`) VALUES (2,'Кат 1.1');
INSERT INTO `blog_catalog` (`id`,`name`) VALUES (3,'Кат 1.23355');
INSERT INTO `blog_catalog` (`id`,`name`) VALUES (4,'Кат 2');
INSERT INTO `blog_catalog` (`id`,`name`) VALUES (5,'Кат 3_2');
INSERT INTO `blog_catalog` (`id`,`name`) VALUES (6,'Кат 4');
INSERT INTO `blog_catalog` (`id`,`name`) VALUES (7,'Кат 4.1');
INSERT INTO `blog_catalog` (`id`,`name`) VALUES (8,'Кат 4.2');
INSERT INTO `blog_catalog` (`id`,`name`) VALUES (9,'Кат 4.3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
