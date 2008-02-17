# MySQL-Front 3.2  (Build 6.11)

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES 'utf8' */;

# Host: localhost    Database: next24
# ------------------------------------------------------
# Server version 5.0.45-community-nt

#
# Table structure for table action
#

DROP TABLE IF EXISTS `action`;
CREATE TABLE `action` (
  `id` int(11) NOT NULL auto_increment,
  `controller_id` int(11) default NULL,
  `name` varchar(50) character set cp1251 default NULL,
  `default` int(1) default NULL,
  `page_title` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  KEY `controller_idIdx` (`controller_id`),
  KEY `nameIdx` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

#
# Dumping data for table action
#

INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (1,1,'Index',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (2,2,'Index',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (3,2,'Delete',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (4,2,'Edit',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (5,2,'Add',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (6,2,'Save',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (8,3,'Login',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (9,3,'Logout',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (10,4,'Index',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (11,4,'Save',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (12,3,'Viewprofile',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (13,7,'CommentList',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (14,3,'PhotoAlbum',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (15,8,'LastList',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (16,8,'TopList',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (17,9,'TopList',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (18,9,'Album',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (19,9,'View',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (20,9,'User',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (21,8,'User',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (22,8,'Create',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (23,8,'Upload',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (24,8,'Save',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (25,8,'UploadForm',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (26,8,'CreateForm',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (27,8,'Create',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (28,8,'List',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (29,9,'Edit',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (30,9,'Comment',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (31,8,'ListSave',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (32,9,'RatePhoto',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (33,9,'CommentDelete',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (34,9,'Save',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (35,10,'Edit',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (36,10,'Save',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (37,10,'EditBranch',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (38,10,'SaveBranch',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (39,10,'Post',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (40,10,'Comments',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (41,10,'SaveComment',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (42,10,'EditComment',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (43,10,'DeleteComment',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (44,10,'PostEdit',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (45,10,'PostSave',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (46,10,'PostDelete',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (47,11,'Login',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (48,11,'LoginForm',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (49,11,'Desktop',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (50,11,'Logout',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (51,12,'GroupList',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (52,12,'EditGroup',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (53,12,'SaveParams',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (54,12,'DeleteParam',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (55,13,'Delete',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (56,13,'List',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (57,13,'Edit',NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`) VALUES (58,13,'Save',NULL,NULL);

#
# Table structure for table albums
#

DROP TABLE IF EXISTS `albums`;
CREATE TABLE `albums` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL,
  `thumbnail_id` bigint(20) NOT NULL,
  `name` varchar(255) character set cp1251 NOT NULL,
  `access` tinyint(4) NOT NULL,
  `is_onmain` tinyint(4) NOT NULL,
  `creation_date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

#
# Dumping data for table albums
#

INSERT INTO `albums` (`id`,`user_id`,`thumbnail_id`,`name`,`access`,`is_onmain`,`creation_date`) VALUES (1,1,10,'Осень2',1,1,'2008-01-14 21:00:00');
INSERT INTO `albums` (`id`,`user_id`,`thumbnail_id`,`name`,`access`,`is_onmain`,`creation_date`) VALUES (3,2,3,'Мои фото',1,1,'2008-01-14 21:20:35');
INSERT INTO `albums` (`id`,`user_id`,`thumbnail_id`,`name`,`access`,`is_onmain`,`creation_date`) VALUES (5,1,5,'Весна',1,1,'2008-01-17 00:00:00');
INSERT INTO `albums` (`id`,`user_id`,`thumbnail_id`,`name`,`access`,`is_onmain`,`creation_date`) VALUES (7,1,15,'Зима',2,0,'2008-01-23 03:21:22');
INSERT INTO `albums` (`id`,`user_id`,`thumbnail_id`,`name`,`access`,`is_onmain`,`creation_date`) VALUES (8,1,20,'Лето',0,0,'2008-01-23 03:21:28');
INSERT INTO `albums` (`id`,`user_id`,`thumbnail_id`,`name`,`access`,`is_onmain`,`creation_date`) VALUES (9,1,0,'йцйцуцйу',1,0,'2008-02-08 01:43:25');

#
# Table structure for table ban_history
#

DROP TABLE IF EXISTS `ban_history`;
CREATE TABLE `ban_history` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `banned_by` int(11) default NULL,
  `warning_id` int(11) default NULL,
  `banned_date` datetime default NULL,
  `banned_till` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Dumping data for table ban_history
#


#
# Table structure for table bc_tags
#

DROP TABLE IF EXISTS `bc_tags`;
CREATE TABLE `bc_tags` (
  `id` bigint(20) NOT NULL auto_increment,
  `blogs_catalog_id` bigint(20) NOT NULL,
  `name` varchar(255) character set cp1251 NOT NULL,
  `posts_num` bigint(20) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `sortfield` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Dumping data for table bc_tags
#


#
# Table structure for table blog_comments
#

DROP TABLE IF EXISTS `blog_comments`;
CREATE TABLE `blog_comments` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL,
  `avatar_id` bigint(20) NOT NULL,
  `warning_id` bigint(20) NOT NULL,
  `blog_post_id` bigint(20) NOT NULL,
  `text` text character set cp1251 NOT NULL,
  `mood` varchar(100) character set cp1251 NOT NULL,
  `creation_date` datetime NOT NULL,
  `adm_redacted` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

#
# Dumping data for table blog_comments
#

INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (3,2,0,0,1,'dsa\r\n32r23r','23','2008-01-01 00:00:00',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (6,1,0,0,1,'asdf23r','0','2008-02-05 02:28:17',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (8,1,0,0,1,'g34g45g','0','2008-02-05 02:28:21',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (9,1,0,0,1,'фыв234к','0','2008-02-05 02:31:42',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (10,1,0,0,1,'ацуцу','0','2008-02-05 02:31:47',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (12,1,0,0,1,'23445еп45рп54р6','0','2008-02-05 02:33:53',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (13,1,0,0,1,'цукцук','0','2008-02-05 02:35:13',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (14,1,0,0,1,'фук23','0','2008-02-05 02:35:16',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (15,1,0,0,1,'23423423423423423','0','2008-02-05 02:35:19',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (16,1,0,0,1,'ыцаца','0','2008-02-05 02:35:22',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (17,1,0,0,1,'23423к','0','2008-02-05 02:35:24',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (18,1,0,0,3,'фыв32ук32к23','0','2008-02-05 02:39:20',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (19,1,0,0,3,'ва34е45','0','2008-02-05 02:39:21',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (21,1,0,0,1,'3r23r23','0','2008-02-05 02:44:05',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (24,1,0,0,9,'sdfsdf','0','2008-02-05 03:34:46',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (25,1,0,0,1,'weqwe','0','2008-02-08 19:34:24',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (26,1,0,0,3,'алексей','0','2008-02-15 01:43:11',0);

#
# Table structure for table blog_posts
#

DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE `blog_posts` (
  `id` bigint(20) NOT NULL auto_increment,
  `blog_id` bigint(20) NOT NULL,
  `ub_tree_id` bigint(20) NOT NULL,
  `bc_tags_id` bigint(20) NOT NULL,
  `title` varchar(255) character set cp1251 NOT NULL,
  `small_text` text character set cp1251 NOT NULL,
  `full_text` text character set cp1251 NOT NULL,
  `creation_date` date NOT NULL,
  `access` tinyint(4) NOT NULL,
  `allowcomments` tinyint(4) NOT NULL,
  `comments` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `mood` varchar(100) character set cp1251 NOT NULL,
  `avatar_id` bigint(20) NOT NULL,
  `creation_ip` varchar(15) character set cp1251 NOT NULL,
  `bbp_status` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

#
# Dumping data for table blog_posts
#

INSERT INTO `blog_posts` (`id`,`blog_id`,`ub_tree_id`,`bc_tags_id`,`title`,`small_text`,`full_text`,`creation_date`,`access`,`allowcomments`,`comments`,`views`,`mood`,`avatar_id`,`creation_ip`,`bbp_status`) VALUES (1,1,1,0,'post1','smal text','sdfs\r\nfwer\r\ng34g\r\n5r\r\ng45\r\nh45\r\nh45','2008-01-01',1,1,13,42,'3',1,'127.0.0.1',1);
INSERT INTO `blog_posts` (`id`,`blog_id`,`ub_tree_id`,`bc_tags_id`,`title`,`small_text`,`full_text`,`creation_date`,`access`,`allowcomments`,`comments`,`views`,`mood`,`avatar_id`,`creation_ip`,`bbp_status`) VALUES (3,1,18,0,'post35543434','2323assdfvdf','0f234fr34ft34','2008-02-08',1,1,2,15,'2',0,'127.0.0.1',0);
INSERT INTO `blog_posts` (`id`,`blog_id`,`ub_tree_id`,`bc_tags_id`,`title`,`small_text`,`full_text`,`creation_date`,`access`,`allowcomments`,`comments`,`views`,`mood`,`avatar_id`,`creation_ip`,`bbp_status`) VALUES (4,1,1,0,'post 4','asd','ft34t3434t34','2008-01-04',1,1,1,1,'1',1,'127.0.0.1',1);
INSERT INTO `blog_posts` (`id`,`blog_id`,`ub_tree_id`,`bc_tags_id`,`title`,`small_text`,`full_text`,`creation_date`,`access`,`allowcomments`,`comments`,`views`,`mood`,`avatar_id`,`creation_ip`,`bbp_status`) VALUES (5,1,1,0,'post 4','asd','ft34t3434t34','2008-01-04',1,1,0,1,'1',1,'127.0.0.1',1);
INSERT INTO `blog_posts` (`id`,`blog_id`,`ub_tree_id`,`bc_tags_id`,`title`,`small_text`,`full_text`,`creation_date`,`access`,`allowcomments`,`comments`,`views`,`mood`,`avatar_id`,`creation_ip`,`bbp_status`) VALUES (8,1,18,0,'sdfdsf','sdf34ft','34tr34','2008-02-05',2,1,0,0,'1',0,'127.0.0.1',1);
INSERT INTO `blog_posts` (`id`,`blog_id`,`ub_tree_id`,`bc_tags_id`,`title`,`small_text`,`full_text`,`creation_date`,`access`,`allowcomments`,`comments`,`views`,`mood`,`avatar_id`,`creation_ip`,`bbp_status`) VALUES (9,1,2,0,'pppp23','dsf','423r','2008-02-05',2,1,1,2,'2',0,'127.0.0.1',1);

#
# Table structure for table blogs
#

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL,
  `title` varchar(255) character set cp1251 NOT NULL,
  `access` tinyint(4) NOT NULL,
  `creation_date` date NOT NULL,
  `creation_ip` varchar(15) character set cp1251 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Dumping data for table blogs
#

INSERT INTO `blogs` (`id`,`user_id`,`title`,`access`,`creation_date`,`creation_ip`) VALUES (1,1,'Мой блог',1,'2008-01-30','127.0.0.1');

#
# Table structure for table blogs_catalog
#

DROP TABLE IF EXISTS `blogs_catalog`;
CREATE TABLE `blogs_catalog` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) character set cp1251 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

#
# Dumping data for table blogs_catalog
#

INSERT INTO `blogs_catalog` (`id`,`name`) VALUES (1,'Кат 1');
INSERT INTO `blogs_catalog` (`id`,`name`) VALUES (2,'Кат 1.1');
INSERT INTO `blogs_catalog` (`id`,`name`) VALUES (3,'Кат 1.2');
INSERT INTO `blogs_catalog` (`id`,`name`) VALUES (4,'Кат 2');
INSERT INTO `blogs_catalog` (`id`,`name`) VALUES (5,'Кат 3');
INSERT INTO `blogs_catalog` (`id`,`name`) VALUES (6,'Кат 4');
INSERT INTO `blogs_catalog` (`id`,`name`) VALUES (7,'Кат 4.1');
INSERT INTO `blogs_catalog` (`id`,`name`) VALUES (8,'Кат 4.2');
INSERT INTO `blogs_catalog` (`id`,`name`) VALUES (9,'Кат 4.3');

#
# Table structure for table controller
#

DROP TABLE IF EXISTS `controller`;
CREATE TABLE `controller` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) character set cp1251 default NULL,
  `description` varchar(255) character set cp1251 default NULL,
  `request_key` varchar(80) default NULL,
  `admin` int(1) default NULL,
  `default` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

#
# Dumping data for table controller
#

INSERT INTO `controller` (`id`,`name`,`description`,`request_key`,`admin`,`default`) VALUES (1,'IndexController',NULL,'Index',0,NULL);
INSERT INTO `controller` (`id`,`name`,`description`,`request_key`,`admin`,`default`) VALUES (2,'TestController',NULL,'Test',0,NULL);
INSERT INTO `controller` (`id`,`name`,`description`,`request_key`,`admin`,`default`) VALUES (3,'UserController','Управление профилем пользователя','User',0,NULL);
INSERT INTO `controller` (`id`,`name`,`description`,`request_key`,`admin`,`default`) VALUES (4,'RightsController','Управление правами','Rights',0,NULL);
INSERT INTO `controller` (`id`,`name`,`description`,`request_key`,`admin`,`default`) VALUES (7,'PhotoCommentController','Комментарии к фотоальбомам','PhotoComment',0,NULL);
INSERT INTO `controller` (`id`,`name`,`description`,`request_key`,`admin`,`default`) VALUES (8,'AlbumController','Фотоальбомы','Album',0,NULL);
INSERT INTO `controller` (`id`,`name`,`description`,`request_key`,`admin`,`default`) VALUES (9,'PhotoController','Фотографии фотоальбомов','Photo',0,NULL);
INSERT INTO `controller` (`id`,`name`,`description`,`request_key`,`admin`,`default`) VALUES (10,'BlogController','Блоги','Blog',0,NULL);
INSERT INTO `controller` (`id`,`name`,`description`,`request_key`,`admin`,`default`) VALUES (11,'AdminController','Администрирование','Admin',1,NULL);
INSERT INTO `controller` (`id`,`name`,`description`,`request_key`,`admin`,`default`) VALUES (12,'AdminParameterController','Управление параметрами конфигурации','AdminParameter',1,NULL);
INSERT INTO `controller` (`id`,`name`,`description`,`request_key`,`admin`,`default`) VALUES (13,'AdminUserController','Управление пользователями системы','AdminUser',1,NULL);

#
# Table structure for table moods
#

DROP TABLE IF EXISTS `moods`;
CREATE TABLE `moods` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(100) character set cp1251 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Dumping data for table moods
#

INSERT INTO `moods` (`id`,`user_id`,`name`) VALUES (1,1,'Ок');
INSERT INTO `moods` (`id`,`user_id`,`name`) VALUES (2,1,'ммм');
INSERT INTO `moods` (`id`,`user_id`,`name`) VALUES (3,1,'фак');

#
# Table structure for table option_data
#

DROP TABLE IF EXISTS `option_data`;
CREATE TABLE `option_data` (
  `Id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Dumping data for table option_data
#


#
# Table structure for table param
#

DROP TABLE IF EXISTS `param`;
CREATE TABLE `param` (
  `id` int(11) NOT NULL auto_increment,
  `param_group_id` int(11) default NULL,
  `name` varchar(50) character set cp1251 default NULL,
  `value` text character set cp1251,
  `php_type` varchar(40) character set cp1251 default NULL COMMENT 'string, float, integer, array, boolean. default - string',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

#
# Dumping data for table param
#

INSERT INTO `param` (`id`,`param_group_id`,`name`,`value`,`php_type`) VALUES (1,1,'param_x','334','integer');
INSERT INTO `param` (`id`,`param_group_id`,`name`,`value`,`php_type`) VALUES (4,2,'param1','333str','string');
INSERT INTO `param` (`id`,`param_group_id`,`name`,`value`,`php_type`) VALUES (28,1,'param_y','34.2','float');
INSERT INTO `param` (`id`,`param_group_id`,`name`,`value`,`php_type`) VALUES (29,0,'asdsad','23','string');
INSERT INTO `param` (`id`,`param_group_id`,`name`,`value`,`php_type`) VALUES (31,9,'param_x','10','integer');

#
# Table structure for table param_group
#

DROP TABLE IF EXISTS `param_group`;
CREATE TABLE `param_group` (
  `id` int(11) NOT NULL auto_increment,
  `label` varchar(80) character set cp1251 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

#
# Dumping data for table param_group
#

INSERT INTO `param_group` (`id`,`label`) VALUES (1,'BlogController');
INSERT INTO `param_group` (`id`,`label`) VALUES (2,'Controller2');
INSERT INTO `param_group` (`id`,`label`) VALUES (3,'IndexController');
INSERT INTO `param_group` (`id`,`label`) VALUES (4,'PhotoController');
INSERT INTO `param_group` (`id`,`label`) VALUES (5,'AdminParameterController');
INSERT INTO `param_group` (`id`,`label`) VALUES (6,'RightsController');
INSERT INTO `param_group` (`id`,`label`) VALUES (7,'PhotoCommentController');
INSERT INTO `param_group` (`id`,`label`) VALUES (8,'AlbumController');
INSERT INTO `param_group` (`id`,`label`) VALUES (9,'AdminController');
INSERT INTO `param_group` (`id`,`label`) VALUES (10,'TestController');
INSERT INTO `param_group` (`id`,`label`) VALUES (11,'UserController');

#
# Table structure for table photo_comments
#

DROP TABLE IF EXISTS `photo_comments`;
CREATE TABLE `photo_comments` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL,
  `avatar_id` bigint(20) NOT NULL,
  `warning_id` bigint(20) NOT NULL,
  `photo_id` bigint(20) NOT NULL,
  `text` text character set cp1251 NOT NULL,
  `mood` varchar(100) character set cp1251 NOT NULL,
  `creation_date` datetime NOT NULL,
  `adm_redacted` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

#
# Dumping data for table photo_comments
#

INSERT INTO `photo_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`photo_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (1,1,0,0,1,'comment 1','','2007-01-11 00:00:00',0);
INSERT INTO `photo_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`photo_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (2,1,0,0,1,'Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст','','2008-05-12 00:00:00',0);
INSERT INTO `photo_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`photo_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (3,1,0,0,2,'coomment qweqwe','1','2008-01-22 13:45:03',0);
INSERT INTO `photo_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`photo_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (4,2,0,1,2,'comment from user #2','0','2008-01-23 00:00:00',1);
INSERT INTO `photo_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`photo_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (10,1,0,0,17,'asdsad','0','2008-01-23 05:07:37',0);
INSERT INTO `photo_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`photo_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (11,1,0,0,17,'3432','0','2008-01-23 05:07:40',0);
INSERT INTO `photo_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`photo_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (12,1,0,0,17,'fwfe234r34gt3','0','2008-01-23 05:07:44',0);
INSERT INTO `photo_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`photo_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (13,1,0,0,17,'f34f34f34f3','0','2008-01-23 05:07:48',0);

#
# Table structure for table photo_votes
#

DROP TABLE IF EXISTS `photo_votes`;
CREATE TABLE `photo_votes` (
  `id` bigint(20) NOT NULL auto_increment,
  `photo_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `ip` varchar(255) character set cp1251 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

#
# Dumping data for table photo_votes
#

INSERT INTO `photo_votes` (`id`,`photo_id`,`user_id`,`ip`) VALUES (6,20,1,'127.0.0.1');
INSERT INTO `photo_votes` (`id`,`photo_id`,`user_id`,`ip`) VALUES (7,16,1,'127.0.0.1');
INSERT INTO `photo_votes` (`id`,`photo_id`,`user_id`,`ip`) VALUES (8,21,1,'127.0.0.1');
INSERT INTO `photo_votes` (`id`,`photo_id`,`user_id`,`ip`) VALUES (9,17,1,'127.0.0.1');
INSERT INTO `photo_votes` (`id`,`photo_id`,`user_id`,`ip`) VALUES (10,19,1,'127.0.0.1');
INSERT INTO `photo_votes` (`id`,`photo_id`,`user_id`,`ip`) VALUES (11,23,1,'127.0.0.1');
INSERT INTO `photo_votes` (`id`,`photo_id`,`user_id`,`ip`) VALUES (12,5,1,'127.0.0.1');
INSERT INTO `photo_votes` (`id`,`photo_id`,`user_id`,`ip`) VALUES (13,18,1,'127.0.0.1');
INSERT INTO `photo_votes` (`id`,`photo_id`,`user_id`,`ip`) VALUES (14,26,1,'127.0.0.1');

#
# Table structure for table photos
#

DROP TABLE IF EXISTS `photos`;
CREATE TABLE `photos` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL,
  `album_id` bigint(20) NOT NULL,
  `name` varchar(255) character set cp1251 NOT NULL,
  `path` varchar(255) character set cp1251 NOT NULL,
  `thumbnail` varchar(255) character set cp1251 NOT NULL,
  `is_rating` tinyint(4) NOT NULL,
  `is_onmain` tinyint(4) NOT NULL,
  `access` tinyint(4) NOT NULL,
  `voices` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `creation_date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

#
# Dumping data for table photos
#

INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (1,1,1,'осень22','asd','as',1,1,1,1,2,'2008-01-21 14:20:12');
INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (3,2,3,'моя фотка','wewer','er43',1,1,0,0,0,'2008-01-21 14:21:12');
INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (7,1,1,'asasd3','387cd1fec97b13b1beaa786f33fe2dd5.jpg','',0,1,1,0,0,'2008-01-22 20:26:06');
INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (10,1,1,'','72ae57b683699af82beb8ac09b5dfd9f.jpg','',1,1,0,0,0,'2008-01-22 20:32:40');
INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (13,2,3,'a','adf','dasf',1,1,1,0,0,'2008-01-02 00:00:00');
INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (15,1,7,'М2','dca3c730965beac6703ac73758a0259d.jpg','',0,0,1,0,0,'2008-01-23 03:29:53');
INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (17,1,8,'12','b2f4bf92d7042c6304563dd0b3daaf71.jpg','b2f4bf92d7042c6304563dd0b3daaf71.jpg',1,1,1,1,3,'2008-01-23 03:31:23');
INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (18,1,7,'М157футбол','f1bf3e85dd373ecc2fe015ab9349b2e3.jpg','f1bf3e85dd373ecc2fe015ab9349b2e3.jpg',0,0,1,1,5,'2008-01-23 03:31:37');
INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (20,1,8,'433','a7ff7b6a48987713cc27e253d9756ef1.jpg','a7ff7b6a48987713cc27e253d9756ef1.jpg',1,1,1,5,13,'2008-01-23 03:33:26');
INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (23,1,8,'7','eb037c0605feaa5519c2baf469ecdb8e.jpg','eb037c0605feaa5519c2baf469ecdb8e.jpg',1,0,1,1,1,'2008-01-23 05:06:38');
INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (26,1,9,'','d9210b5285f23b2f27f3cdfed91f0bd3.jpg','d9210b5285f23b2f27f3cdfed91f0bd3.jpg',0,0,1,1,2,'2008-02-08 01:43:44');

#
# Table structure for table session
#

DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `id` varchar(100) character set cp1251 NOT NULL default '',
  `lastaction` int(10) NOT NULL default '0',
  `ip` char(15) character set cp1251 NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

#
# Dumping data for table session
#

INSERT INTO `session` (`id`,`lastaction`,`ip`) VALUES ('qc1plutdsv08sj57k22u1mlkp5',1203206033,'');

#
# Table structure for table session_vars
#

DROP TABLE IF EXISTS `session_vars`;
CREATE TABLE `session_vars` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) character set cp1251 default NULL,
  `session` varchar(100) character set cp1251 default NULL,
  `value` text character set cp1251,
  PRIMARY KEY  (`id`),
  KEY `sessionID` (`session`)
) ENGINE=MyISAM AUTO_INCREMENT=895 DEFAULT CHARSET=utf8;

#
# Dumping data for table session_vars
#

INSERT INTO `session_vars` (`id`,`name`,`session`,`value`) VALUES (892,'qc1plutdsv08sj57k22u1mlkp5','qc1plutdsv08sj57k22u1mlkp5','');
INSERT INTO `session_vars` (`id`,`name`,`session`,`value`) VALUES (893,'user','qc1plutdsv08sj57k22u1mlkp5','a:26:{s:2:\"id\";s:1:\"1\";s:10:\"first_name\";s:10:\"Админ\";s:11:\"middle_name\";s:16:\"Иванович\";s:9:\"last_name\";s:14:\"Админов\";s:5:\"email\";s:0:\"\";s:5:\"login\";s:5:\"admin\";s:4:\"pass\";s:5:\"admin\";s:10:\"birth_date\";N;s:6:\"gender\";s:1:\"0\";s:5:\"about\";s:0:\"\";s:8:\"interest\";s:0:\"\";s:8:\"reg_date\";s:1:\"0\";s:11:\"su_vis_date\";s:1:\"0\";s:8:\"group_id\";s:1:\"0\";s:10:\"country_id\";s:1:\"0\";s:4:\"city\";s:0:\"\";s:4:\"hash\";s:0:\"\";s:6:\"status\";s:1:\"0\";s:8:\"tabs_map\";s:7:\"1111111\";s:10:\"reputation\";s:1:\"0\";s:9:\"nextmoney\";s:1:\"0\";s:12:\"user_type_id\";s:1:\"1\";s:6:\"banned\";s:1:\"0\";s:17:\"registration_date\";s:10:\"2008-01-04\";s:4:\"name\";s:10:\"Админ\";s:6:\"rights\";s:1868:\"a:11:{s:15:\"IndexController\";a:1:{s:11:\"IndexAction\";a:1:{i:0;s:4:\"sub2\";}}s:14:\"TestController\";a:5:{s:11:\"IndexAction\";a:0:{}s:12:\"DeleteAction\";a:0:{}s:10:\"EditAction\";a:0:{}s:9:\"AddAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:14:\"UserController\";a:4:{s:11:\"LoginAction\";a:0:{}s:12:\"LogoutAction\";a:0:{}s:17:\"ViewprofileAction\";a:0:{}s:16:\"PhotoAlbumAction\";a:0:{}}s:16:\"RightsController\";a:2:{s:11:\"IndexAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:22:\"PhotoCommentController\";a:1:{s:17:\"CommentListAction\";a:0:{}}s:15:\"AlbumController\";a:10:{s:14:\"LastListAction\";a:0:{}s:13:\"TopListAction\";a:0:{}s:10:\"UserAction\";a:0:{}s:12:\"CreateAction\";a:0:{}s:12:\"UploadAction\";a:0:{}s:10:\"SaveAction\";a:0:{}s:16:\"UploadFormAction\";a:0:{}s:16:\"CreateFormAction\";a:0:{}s:10:\"ListAction\";a:0:{}s:14:\"ListSaveAction\";a:0:{}}s:15:\"PhotoController\";a:9:{s:13:\"TopListAction\";a:0:{}s:11:\"AlbumAction\";a:0:{}s:10:\"ViewAction\";a:0:{}s:10:\"UserAction\";a:0:{}s:10:\"EditAction\";a:0:{}s:13:\"CommentAction\";a:0:{}s:15:\"RatePhotoAction\";a:0:{}s:19:\"CommentDeleteAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:14:\"BlogController\";a:12:{s:10:\"EditAction\";a:0:{}s:10:\"SaveAction\";a:0:{}s:16:\"EditBranchAction\";a:0:{}s:16:\"SaveBranchAction\";a:0:{}s:10:\"PostAction\";a:0:{}s:14:\"CommentsAction\";a:0:{}s:17:\"SaveCommentAction\";a:0:{}s:17:\"EditCommentAction\";a:0:{}s:19:\"DeleteCommentAction\";a:0:{}s:14:\"PostEditAction\";a:0:{}s:14:\"PostSaveAction\";a:0:{}s:16:\"PostDeleteAction\";a:0:{}}s:15:\"AdminController\";a:4:{s:11:\"LoginAction\";a:0:{}s:15:\"LoginFormAction\";a:0:{}s:13:\"DesktopAction\";a:0:{}s:12:\"LogoutAction\";a:0:{}}s:24:\"AdminParameterController\";a:4:{s:15:\"GroupListAction\";a:0:{}s:15:\"EditGroupAction\";a:0:{}s:16:\"SaveParamsAction\";a:0:{}s:17:\"DeleteParamAction\";a:0:{}}s:19:\"AdminUserController\";a:4:{s:12:\"DeleteAction\";a:0:{}s:10:\"ListAction\";a:0:{}s:10:\"EditAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}}\";}');
INSERT INTO `session_vars` (`id`,`name`,`session`,`value`) VALUES (894,'LAST_PATH','qc1plutdsv08sj57k22u1mlkp5','/next24/Admin/Desktop');

#
# Table structure for table subactions_list
#

DROP TABLE IF EXISTS `subactions_list`;
CREATE TABLE `subactions_list` (
  `id` int(11) NOT NULL auto_increment,
  `action_id` int(11) default NULL,
  `name` varchar(50) character set cp1251 default NULL,
  PRIMARY KEY  (`id`),
  KEY `action_idIdx` (`action_id`),
  KEY `nameIdex` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Dumping data for table subactions_list
#

INSERT INTO `subactions_list` (`id`,`action_id`,`name`) VALUES (1,1,'sub1');
INSERT INTO `subactions_list` (`id`,`action_id`,`name`) VALUES (2,1,'sub2');

#
# Table structure for table test
#

DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) character set cp1251 NOT NULL default '',
  `value` text character set cp1251 NOT NULL,
  `check` enum('y','n') character set cp1251 NOT NULL default 'y',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Dumping data for table test
#

INSERT INTO `test` (`id`,`name`,`value`,`check`) VALUES (1,'','значение в утф8','y');

#
# Table structure for table ub_tree
#

DROP TABLE IF EXISTS `ub_tree`;
CREATE TABLE `ub_tree` (
  `id` bigint(20) NOT NULL auto_increment,
  `blog_id` bigint(20) NOT NULL,
  `blogs_catalog_id` int(11) NOT NULL,
  `blog_banner_id` bigint(20) NOT NULL,
  `name` varchar(255) character set cp1251 NOT NULL,
  `access` tinyint(4) NOT NULL,
  `key` varchar(255) character set cp1251 NOT NULL,
  `level` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

#
# Dumping data for table ub_tree
#

INSERT INTO `ub_tree` (`id`,`blog_id`,`blogs_catalog_id`,`blog_banner_id`,`name`,`access`,`key`,`level`) VALUES (1,1,1,0,'Мой раздел423',1,'',0);
INSERT INTO `ub_tree` (`id`,`blog_id`,`blogs_catalog_id`,`blog_banner_id`,`name`,`access`,`key`,`level`) VALUES (2,1,1,0,'v233',1,'',0);
INSERT INTO `ub_tree` (`id`,`blog_id`,`blogs_catalog_id`,`blog_banner_id`,`name`,`access`,`key`,`level`) VALUES (18,1,1,0,'asdsdfsdf',1,'',0);

#
# Table structure for table user_types
#

DROP TABLE IF EXISTS `user_types`;
CREATE TABLE `user_types` (
  `id` int(11) NOT NULL default '0',
  `name` varchar(50) character set cp1251 default NULL,
  `rights` text character set cp1251,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

#
# Dumping data for table user_types
#

INSERT INTO `user_types` (`id`,`name`,`rights`) VALUES (0,'Гость','a:9:{s:15:\"IndexController\";a:1:{s:11:\"IndexAction\";a:2:{i:0;s:4:\"sub1\";i:1;s:4:\"sub2\";}}s:14:\"TestController\";a:5:{s:11:\"IndexAction\";a:0:{}s:12:\"DeleteAction\";a:0:{}s:10:\"EditAction\";a:0:{}s:9:\"AddAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:14:\"UserController\";a:4:{s:11:\"LoginAction\";a:0:{}s:12:\"LogoutAction\";a:0:{}s:17:\"ViewprofileAction\";a:0:{}s:16:\"PhotoAlbumAction\";a:0:{}}s:16:\"RightsController\";a:2:{s:11:\"IndexAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:22:\"PhotoCommentController\";a:1:{s:17:\"CommentListAction\";a:0:{}}s:15:\"AlbumController\";a:10:{s:14:\"LastListAction\";a:0:{}s:13:\"TopListAction\";a:0:{}s:10:\"UserAction\";a:0:{}s:12:\"CreateAction\";a:0:{}s:12:\"UploadAction\";a:0:{}s:10:\"SaveAction\";a:0:{}s:16:\"UploadFormAction\";a:0:{}s:16:\"CreateFormAction\";a:0:{}s:10:\"ListAction\";a:0:{}s:14:\"ListSaveAction\";a:0:{}}s:15:\"PhotoController\";a:9:{s:13:\"TopListAction\";a:0:{}s:11:\"AlbumAction\";a:0:{}s:10:\"ViewAction\";a:0:{}s:10:\"UserAction\";a:0:{}s:10:\"EditAction\";a:0:{}s:13:\"CommentAction\";a:0:{}s:15:\"RatePhotoAction\";a:0:{}s:19:\"CommentDeleteAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:14:\"BlogController\";a:11:{s:10:\"EditAction\";a:0:{}s:10:\"SaveAction\";a:0:{}s:16:\"EditBranchAction\";a:0:{}s:16:\"SaveBranchAction\";a:0:{}s:10:\"PostAction\";a:0:{}s:14:\"CommentsAction\";a:0:{}s:17:\"SaveCommentAction\";a:0:{}s:17:\"EditCommentAction\";a:0:{}s:19:\"DeleteCommentAction\";a:0:{}s:14:\"PostEditAction\";a:0:{}s:14:\"PostSaveAction\";a:0:{}}s:15:\"AdminController\";a:2:{s:11:\"LoginAction\";a:0:{}s:15:\"LoginFormAction\";a:0:{}}}');
INSERT INTO `user_types` (`id`,`name`,`rights`) VALUES (1,'Админ','a:11:{s:15:\"IndexController\";a:1:{s:11:\"IndexAction\";a:1:{i:0;s:4:\"sub2\";}}s:14:\"TestController\";a:5:{s:11:\"IndexAction\";a:0:{}s:12:\"DeleteAction\";a:0:{}s:10:\"EditAction\";a:0:{}s:9:\"AddAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:14:\"UserController\";a:4:{s:11:\"LoginAction\";a:0:{}s:12:\"LogoutAction\";a:0:{}s:17:\"ViewprofileAction\";a:0:{}s:16:\"PhotoAlbumAction\";a:0:{}}s:16:\"RightsController\";a:2:{s:11:\"IndexAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:22:\"PhotoCommentController\";a:1:{s:17:\"CommentListAction\";a:0:{}}s:15:\"AlbumController\";a:10:{s:14:\"LastListAction\";a:0:{}s:13:\"TopListAction\";a:0:{}s:10:\"UserAction\";a:0:{}s:12:\"CreateAction\";a:0:{}s:12:\"UploadAction\";a:0:{}s:10:\"SaveAction\";a:0:{}s:16:\"UploadFormAction\";a:0:{}s:16:\"CreateFormAction\";a:0:{}s:10:\"ListAction\";a:0:{}s:14:\"ListSaveAction\";a:0:{}}s:15:\"PhotoController\";a:9:{s:13:\"TopListAction\";a:0:{}s:11:\"AlbumAction\";a:0:{}s:10:\"ViewAction\";a:0:{}s:10:\"UserAction\";a:0:{}s:10:\"EditAction\";a:0:{}s:13:\"CommentAction\";a:0:{}s:15:\"RatePhotoAction\";a:0:{}s:19:\"CommentDeleteAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:14:\"BlogController\";a:12:{s:10:\"EditAction\";a:0:{}s:10:\"SaveAction\";a:0:{}s:16:\"EditBranchAction\";a:0:{}s:16:\"SaveBranchAction\";a:0:{}s:10:\"PostAction\";a:0:{}s:14:\"CommentsAction\";a:0:{}s:17:\"SaveCommentAction\";a:0:{}s:17:\"EditCommentAction\";a:0:{}s:19:\"DeleteCommentAction\";a:0:{}s:14:\"PostEditAction\";a:0:{}s:14:\"PostSaveAction\";a:0:{}s:16:\"PostDeleteAction\";a:0:{}}s:15:\"AdminController\";a:4:{s:11:\"LoginAction\";a:0:{}s:15:\"LoginFormAction\";a:0:{}s:13:\"DesktopAction\";a:0:{}s:12:\"LogoutAction\";a:0:{}}s:24:\"AdminParameterController\";a:4:{s:15:\"GroupListAction\";a:0:{}s:15:\"EditGroupAction\";a:0:{}s:16:\"SaveParamsAction\";a:0:{}s:17:\"DeleteParamAction\";a:0:{}}s:19:\"AdminUserController\";a:4:{s:12:\"DeleteAction\";a:0:{}s:10:\"ListAction\";a:0:{}s:10:\"EditAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}}');

#
# Table structure for table users
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL auto_increment,
  `first_name` varchar(50) character set cp1251 NOT NULL,
  `middle_name` varchar(50) character set cp1251 NOT NULL,
  `last_name` varchar(50) character set cp1251 NOT NULL,
  `email` varchar(255) character set cp1251 NOT NULL,
  `login` varchar(255) character set cp1251 NOT NULL,
  `pass` varchar(255) character set cp1251 default NULL,
  `birth_date` date default NULL,
  `gender` tinyint(4) NOT NULL,
  `about` text character set cp1251 NOT NULL,
  `interest` text character set cp1251 NOT NULL,
  `reg_date` int(11) NOT NULL,
  `su_vis_date` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `city` varchar(255) character set cp1251 NOT NULL,
  `hash` varchar(255) character set cp1251 NOT NULL,
  `status` tinyint(4) NOT NULL,
  `tabs_map` varchar(100) character set cp1251 NOT NULL default '1111111',
  `reputation` double NOT NULL,
  `nextmoney` double NOT NULL,
  `user_type_id` tinyint(4) default NULL,
  `banned` tinyint(4) NOT NULL,
  `registration_date` date default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Dumping data for table users
#

INSERT INTO `users` (`id`,`first_name`,`middle_name`,`last_name`,`email`,`login`,`pass`,`birth_date`,`gender`,`about`,`interest`,`reg_date`,`su_vis_date`,`group_id`,`country_id`,`city`,`hash`,`status`,`tabs_map`,`reputation`,`nextmoney`,`user_type_id`,`banned`,`registration_date`) VALUES (1,'Админ','Иванович','Админов','','admin','admin',NULL,0,'','',0,0,0,0,'','',0,'1111111',0,0,1,0,'2008-01-04');
INSERT INTO `users` (`id`,`first_name`,`middle_name`,`last_name`,`email`,`login`,`pass`,`birth_date`,`gender`,`about`,`interest`,`reg_date`,`su_vis_date`,`group_id`,`country_id`,`city`,`hash`,`status`,`tabs_map`,`reputation`,`nextmoney`,`user_type_id`,`banned`,`registration_date`) VALUES (2,'Тест','Пользователь','Фамилия','a@email.com','русский24','user',NULL,1,'asd','qd',12121212,123123,1,1,'город','sdfdsfsd',1,'1111111',0,0,0,1,'2008-02-09');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
