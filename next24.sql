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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251;

#
# Dumping data for table actions_list
#

INSERT INTO `actions_list` VALUES (1,1,'IndexAction');

#
# Table structure for table controllers_list
#

CREATE TABLE `controllers_list` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `nameIdx` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# Dumping data for table controllers_list
#

/*!40101 SET NAMES latin1 */;

INSERT INTO `controllers_list` VALUES (1,'IndexController');

/*!40101 SET NAMES cp1251 */;

#
# Table structure for table params
#

CREATE TABLE `params` (
  `id` int(11) NOT NULL auto_increment,
  `group_name` varchar(50) default NULL,
  `item_name` varchar(50) default NULL,
  `value` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

#
# Dumping data for table params
#

INSERT INTO `params` VALUES (1,'test_group','param1','Value1');
INSERT INTO `params` VALUES (2,'test_group','param2','value2');

#
# Table structure for table session
#

CREATE TABLE `session` (
  `id` varchar(100) collate latin1_general_ci NOT NULL default '',
  `lastaction` int(10) NOT NULL default '0',
  `ip` char(15) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# Dumping data for table session
#

/*!40101 SET NAMES latin1 */;


/*!40101 SET NAMES cp1251 */;

#
# Table structure for table session_vars
#

CREATE TABLE `session_vars` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) collate latin1_general_ci NOT NULL default '',
  `session` varchar(100) collate latin1_general_ci NOT NULL default '',
  `value` text collate latin1_general_ci,
  PRIMARY KEY  (`id`),
  KEY `sessionID` (`session`)
) ENGINE=MyISAM AUTO_INCREMENT=175 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# Dumping data for table session_vars
#

/*!40101 SET NAMES latin1 */;


/*!40101 SET NAMES cp1251 */;

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=cp1251;

#
# Dumping data for table subactions_list
#

INSERT INTO `subactions_list` VALUES (1,1,'sub1');
INSERT INTO `subactions_list` VALUES (2,1,'sub2');

#
# Table structure for table user_types
#

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL default '0',
  `name` varchar(50) character set latin1 collate latin1_general_ci default NULL,
  `rights` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=cp1251 ROW_FORMAT=FIXED;

#
# Dumping data for table user_types
#

INSERT INTO `user_types` VALUES (0,'?????','a:1:{s:15:\"IndexController\";a:1:{s:11:\"IndexAction\";a:1:{i:0;s:4:\"sub2\";}}}');
CREATE TABLE `test` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `value` text NOT NULL,
  `check` enum('y','n') NOT NULL default 'y',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*!40101 SET NAMES latin1 */;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
