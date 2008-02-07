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
# Table structure for table params
#

DROP TABLE IF EXISTS `params`;
CREATE TABLE `params` (
  `id` int(11) NOT NULL auto_increment,
  `params_group_id` int(11) default NULL,
  `name` varchar(50) default NULL,
  `value` text,
  `php_type` varchar(40) default NULL COMMENT 'string, float, integer, array, boolean. default - string',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=cp1251;

#
# Dumping data for table params
#

INSERT INTO `params` (`id`,`params_group_id`,`name`,`value`,`php_type`) VALUES (1,1,'Post_per_Page','3','integer');
INSERT INTO `params` (`id`,`params_group_id`,`name`,`value`,`php_type`) VALUES (2,1,'param2','2.22','float');
INSERT INTO `params` (`id`,`params_group_id`,`name`,`value`,`php_type`) VALUES (4,2,'param1','333str','string');
INSERT INTO `params` (`id`,`params_group_id`,`name`,`value`,`php_type`) VALUES (5,0,'paramx','assd','');

/*!40101 SET NAMES utf8 */;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
