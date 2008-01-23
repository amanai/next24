# SQLFront 3.2  (Build 14.11)

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin1 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='SYSTEM' */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=cp1251;

#
# Dumping data for table actions_list
#

INSERT INTO `actions_list` VALUES (1,1,'IndexAction');
INSERT INTO `actions_list` VALUES (2,2,'IndexAction');
INSERT INTO `actions_list` VALUES (3,2,'DeleteAction');
INSERT INTO `actions_list` VALUES (4,2,'EditAction');
INSERT INTO `actions_list` VALUES (5,2,'AddAction');
INSERT INTO `actions_list` VALUES (6,2,'SaveAction');
INSERT INTO `actions_list` VALUES (8,3,'LoginAction');
INSERT INTO `actions_list` VALUES (9,3,'LogoutAction');
INSERT INTO `actions_list` VALUES (10,4,'IndexAction');
INSERT INTO `actions_list` VALUES (11,4,'SaveAction');
INSERT INTO `actions_list` VALUES (12,3,'ViewprofileAction');
INSERT INTO `actions_list` VALUES (13,7,'CommentList');
INSERT INTO `actions_list` VALUES (14,3,'EditprofileAction');
INSERT INTO `actions_list` VALUES (15,3,'SaveprofileAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (35,8,'LastListAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (16,8,'TopListAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (17,9,'TopListAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (18,9,'AlbumAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (19,9,'ViewAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (20,9,'UserAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (21,8,'UserAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (22,8,'CreateAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (23,8,'UploadAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (24,8,'SaveAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (25,8,'UploadFormAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (26,8,'CreateFormAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (27,8,'CreateAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (28,8,'ListAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (29,9,'EditAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (30,9,'CommentAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (31,8,'ListSaveAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (32,9,'RatePhotoAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (33,9,'CommentDeleteAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (34,9,'SaveAction');


#
# Table structure for table albums
#

CREATE TABLE `albums` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL,
  `thumbnail_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `access` tinyint(4) NOT NULL,
  `is_onmain` tinyint(4) NOT NULL,
  `creation_date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=cp1251;


#
# Dumping data for table albums
#


#
# Table structure for table controllers_list
#

CREATE TABLE `controllers_list` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=cp1251;

#
# Dumping data for table controllers_list
#

INSERT INTO `controllers_list` VALUES (1,'IndexController');
INSERT INTO `controllers_list` VALUES (2,'TestController');
INSERT INTO `controllers_list` VALUES (3,'UserController');
INSERT INTO `controllers_list` VALUES (4,'RightsController');
INSERT INTO `controllers_list` VALUES (7,'PhotoCommentController');
INSERT INTO `controllers_list` VALUES (8,'AlbumController');
INSERT INTO `controllers_list` VALUES (9,'PhotoController');

#
# Table structure for table countries
#

CREATE TABLE `countries` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=cp1251;

#
# Dumping data for table countries
#

INSERT INTO `countries` VALUES (1,'Россия');
INSERT INTO `countries` VALUES (2,'Украина');
INSERT INTO `countries` VALUES (3,'Белорусия');

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
# Table structure for table photo_comments
#

CREATE TABLE `photo_comments` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL,
  `avatar_id` bigint(20) NOT NULL,
  `warning_id` bigint(20) NOT NULL,
  `photo_id` bigint(20) NOT NULL,
  `text` text NOT NULL,
  `mood` varchar(100) NOT NULL,
  `creation_date` datetime NOT NULL,
  `adm_redacted` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=cp1251;


#
# Dumping data for table photo_comments
#

INSERT INTO `photo_comments` VALUES (1,1,0,0,1,'comment 1','','2007-01-11 00:00:00',0);
INSERT INTO `photo_comments` VALUES (2,1,0,0,1,'Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст','','2008-05-12 00:00:00',0);

#
# Table structure for table photos
#

CREATE TABLE `photos` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL,
  `album_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `is_rating` tinyint(4) NOT NULL,
  `is_onmain` tinyint(4) NOT NULL,
  `access` tinyint(4) NOT NULL,
  `voices` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `creation_date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=cp1251;


#
# Dumping data for table photos
#

CREATE TABLE `photo_votes` (
  `id` bigint(20) NOT NULL auto_increment,
  `photo_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `ip` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=cp1251;


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
) ENGINE=MyISAM AUTO_INCREMENT=252 DEFAULT CHARSET=cp1251;


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

INSERT INTO `user_types` VALUES (0,'Гость','a:5:{s:15:\"IndexController\";a:1:{s:11:\"IndexAction\";a:2:{i:0;s:4:\"sub1\";i:1;s:4:\"sub2\";}}s:14:\"TestController\";a:5:{s:11:\"IndexAction\";a:0:{}s:12:\"DeleteAction\";a:0:{}s:10:\"EditAction\";a:0:{}s:9:\"AddAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:14:\"UserController\";a:4:{s:11:\"LoginAction\";a:0:{}s:12:\"LogoutAction\";a:0:{}s:17:\"ViewprofileAction\";a:0:{}s:17:\"EditprofileAction\";a:0:{}}s:16:\"RightsController\";a:2:{s:11:\"IndexAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:22:\"PhotoCommentController\";a:1:{s:11:\"CommentList\";a:0:{}}}');
INSERT INTO `user_types` VALUES (1,'Админ','a:5:{s:15:\"IndexController\";a:1:{s:11:\"IndexAction\";a:1:{i:0;s:4:\"sub2\";}}s:14:\"TestController\";a:5:{s:11:\"IndexAction\";a:0:{}s:12:\"DeleteAction\";a:0:{}s:10:\"EditAction\";a:0:{}s:9:\"AddAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:14:\"UserController\";a:5:{s:11:\"LoginAction\";a:0:{}s:12:\"LogoutAction\";a:0:{}s:17:\"ViewprofileAction\";a:0:{}s:17:\"EditprofileAction\";a:0:{}s:17:\"SaveprofileAction\";a:0:{}}s:16:\"RightsController\";a:2:{s:11:\"IndexAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:22:\"PhotoCommentController\";a:1:{s:11:\"CommentList\";a:0:{}}}');

#
# Table structure for table users
#

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL auto_increment,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) default NULL,
  `birth_date` date default NULL,
  `gender` tinyint(4) NOT NULL,
  `about` text NOT NULL,
  `interest` text NOT NULL,
  `reg_date` int(11) NOT NULL,
  `su_vis_date` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `tabs_map` varchar(100) NOT NULL default '1111111',
  `reputation` double NOT NULL,
  `nextmoney` double NOT NULL,
  `user_type_id` tinyint(4) default NULL,
  `banned` tinyint(4) NOT NULL,
  `registration_date` date default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251;

#
# Dumping data for table users
#

INSERT INTO `users` VALUES (1,'Админ','Админович','Админов','admin@next24.ru','admin','admin','1980-10-29',1,'Главный админ','1, 2, 3',0,0,0,2,'Донецк','',0,'1111111',0,0,1,0,'0000-00-00');

/*!40101 SET NAMES latin1 */;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
