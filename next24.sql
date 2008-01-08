# SQLFront 3.2  (Build 14.11)

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin1 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='SYSTEM' */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;


# Host: localhost    Database: next24
# ------------------------------------------------------
# Server version 5.0.27-community-nt

/*!40101 SET NAMES cp1251 */;

#
# Table structure for table actions_list
#

CREATE TABLE `actions_list` (
  `id` int(11) NOT NULL auto_increment,
  `controller_id` int(11) default NULL,
  `name` varchar(50) default NULL,
  PRIMARY KEY  (`id`),
  KEY `controller_idIdx` (`controller_id`),
  KEY `nameIdx` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=cp1251;

#
# Dumping data for table actions_list
#

INSERT INTO `actions_list` VALUES (1,1,'IndexAction');
INSERT INTO `actions_list` VALUES (2,2,'IndexAction');
INSERT INTO `actions_list` VALUES (3,2,'DeleteAction');
INSERT INTO `actions_list` VALUES (4,2,'EditAction');
INSERT INTO `actions_list` VALUES (5,2,'AddAction');
INSERT INTO `actions_list` VALUES (6,2,'SaveAction');

#
# Table structure for table controllers_list
#

CREATE TABLE `controllers_list` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=cp1251;

#
# Dumping data for table controllers_list
#

INSERT INTO `controllers_list` VALUES (1,'IndexController');
INSERT INTO `controllers_list` VALUES (2,'TestController');

#
# Table structure for table params
#

CREATE TABLE `params` (
  `id` int(11) NOT NULL auto_increment,
  `group_name` varchar(50) default NULL,
  `item_name` varchar(50) default NULL,
  `value` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=cp1251;

#
# Dumping data for table params
#

INSERT INTO `params` VALUES (1,'test_group','param1','Value1');
INSERT INTO `params` VALUES (2,'test_group','param2','value2');

#
# Table structure for table session
#

CREATE TABLE `session` (
  `id` varchar(100) NOT NULL default '',
  `lastaction` int(10) NOT NULL default '0',
  `ip` char(15) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 ROW_FORMAT=FIXED;

#
# Dumping data for table session
#


#
# Table structure for table session_vars
#

CREATE TABLE `session_vars` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `session` varchar(100) default NULL,
  `value` text,
  PRIMARY KEY  (`id`),
  KEY `sessionID` (`session`)
) ENGINE=MyISAM AUTO_INCREMENT=153 DEFAULT CHARSET=cp1251;

#
# Dumping data for table session_vars
#


#
# Table structure for table subactions_list
#

CREATE TABLE `subactions_list` (
  `id` int(11) NOT NULL auto_increment,
  `action_id` int(11) default NULL,
  `name` varchar(50) default NULL,
  PRIMARY KEY  (`id`),
  KEY `action_idIdx` (`action_id`),
  KEY `nameIdex` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=cp1251;

#
# Dumping data for table subactions_list
#

INSERT INTO `subactions_list` VALUES (1,1,'sub1');
INSERT INTO `subactions_list` VALUES (2,1,'sub2');

#
# Table structure for table test
#

CREATE TABLE `test` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `value` text NOT NULL,
  `check` enum('y','n') NOT NULL default 'y',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

#
# Dumping data for table test
#


#
# Table structure for table user_types
#

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL default '0',
  `name` varchar(50) default NULL,
  `rights` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=cp1251 ROW_FORMAT=FIXED;

#
# Dumping data for table user_types
#

INSERT INTO `user_types` VALUES (0,'Гость','a:3:{s:15:\"IndexController\";a:1:{s:11:\"IndexAction\";a:2:{i:0;s:4:\"sub2\";i:1;s:4:\"sub1\";}}s:14:\"TestController\";a:5:{s:11:\"IndexAction\";a:0:{}s:12:\"DeleteAction\";a:0:{}s:10:\"EditAction\";a:0:{}s:9:\"AddAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:14:\"UserController\";a:2:{s:11:\"LoginAction\";a:0:{}s:12:\"LogoutAction\";a:0:{}}}');
INSERT INTO `user_types` VALUES (1,'Админ','a:3:{s:15:\"IndexController\";a:1:{s:11:\"IndexAction\";a:2:{i:0;s:4:\"sub2\";i:1;s:4:\"sub1\";}}s:14:\"TestController\";a:5:{s:11:\"IndexAction\";a:0:{}s:12:\"DeleteAction\";a:0:{}s:10:\"EditAction\";a:0:{}s:9:\"AddAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:14:\"UserController\";a:2:{s:11:\"LoginAction\";a:0:{}s:12:\"LogoutAction\";a:0:{}}}');

#
# Table structure for table users
#

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(20) default NULL,
  `pass` varchar(20) default NULL,
  `user_type_id` int(11) default NULL,
  `first_name` varchar(50) default NULL,
  `last_name` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

#
# Dumping data for table users
#

INSERT INTO `users` VALUES (1,'admin','admin',1,'Админ','Админов');

/*!40101 SET NAMES latin1 */;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
