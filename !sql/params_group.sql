# MySQL-Front 3.2  (Build 6.11)

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES 'utf8' */;

# Host: localhost    Database: next24
# ------------------------------------------------------
# Server version 5.0.45-community-nt
/*!40101 SET NAMES cp1251 */;


#
# Table structure for table params_group
#

DROP TABLE IF EXISTS `params_group`;
CREATE TABLE `params_group` (
  `id` int(11) NOT NULL auto_increment,
  `label` varchar(80) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=cp1251;

#
# Dumping data for table params_group
#

INSERT INTO `params_group` (`id`,`label`) VALUES (1,'BlogController');
INSERT INTO `params_group` (`id`,`label`) VALUES (2,'Controller2');

/*!40101 SET NAMES utf8 */;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
