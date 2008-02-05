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
# Table structure for table actions_list
#

DROP TABLE IF EXISTS `actions_list`;
CREATE TABLE `actions_list` (
  `id` int(11) NOT NULL auto_increment,
  `controller_id` int(11) default NULL,
  `name` varchar(50) default NULL,
  PRIMARY KEY  (`id`),
  KEY `controller_idIdx` (`controller_id`),
  KEY `nameIdx` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=cp1251;

#
# Dumping data for table actions_list
#

INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (1,1,'IndexAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (2,2,'IndexAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (3,2,'DeleteAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (4,2,'EditAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (5,2,'AddAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (6,2,'SaveAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (8,3,'LoginAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (9,3,'LogoutAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (10,4,'IndexAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (11,4,'SaveAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (12,3,'ViewprofileAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (13,7,'CommentListAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (14,3,'PhotoAlbumAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (15,8,'LastListAction');
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
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (35,10,'EditAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (36,10,'SaveAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (37,10,'EditBranchAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (38,10,'SaveBranchAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (39,10,'PostAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (40,10,'CommentsAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (41,10,'SaveCommentAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (42,10,'EditCommentAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (43,10,'DeleteCommentAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (44,10,'PostEditAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (45,10,'PostSaveAction');
INSERT INTO `actions_list` (`id`,`controller_id`,`name`) VALUES (46,10,'PostDeleteAction');

#
# Table structure for table albums
#

DROP TABLE IF EXISTS `albums`;
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

INSERT INTO `albums` (`id`,`user_id`,`thumbnail_id`,`name`,`access`,`is_onmain`,`creation_date`) VALUES (1,1,10,'�����',1,1,'2008-01-14 21:00:00');
INSERT INTO `albums` (`id`,`user_id`,`thumbnail_id`,`name`,`access`,`is_onmain`,`creation_date`) VALUES (3,2,3,'��� ����',1,1,'2008-01-14 21:20:35');
INSERT INTO `albums` (`id`,`user_id`,`thumbnail_id`,`name`,`access`,`is_onmain`,`creation_date`) VALUES (5,1,5,'�����',1,1,'2008-01-17 00:00:00');
INSERT INTO `albums` (`id`,`user_id`,`thumbnail_id`,`name`,`access`,`is_onmain`,`creation_date`) VALUES (7,1,15,'����',2,0,'2008-01-23 03:21:22');
INSERT INTO `albums` (`id`,`user_id`,`thumbnail_id`,`name`,`access`,`is_onmain`,`creation_date`) VALUES (8,1,17,'����',0,0,'2008-01-23 03:21:28');

#
# Table structure for table bc_tags
#

DROP TABLE IF EXISTS `bc_tags`;
CREATE TABLE `bc_tags` (
  `id` bigint(20) NOT NULL auto_increment,
  `blogs_catalog_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `posts_num` bigint(20) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `sortfield` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

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
  `text` text NOT NULL,
  `mood` varchar(100) NOT NULL,
  `creation_date` datetime NOT NULL,
  `adm_redacted` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=cp1251;

#
# Dumping data for table blog_comments
#

INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (3,2,0,0,1,'dsa\r\n32r23r','23','2008-01-01 00:00:00',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (6,1,0,0,1,'asdf23r','0','2008-02-05 02:28:17',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (8,1,0,0,1,'g34g45g','0','2008-02-05 02:28:21',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (9,1,0,0,1,'���234�','0','2008-02-05 02:31:42',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (10,1,0,0,1,'�����','0','2008-02-05 02:31:47',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (12,1,0,0,1,'23445��45��54�6','0','2008-02-05 02:33:53',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (13,1,0,0,1,'������','0','2008-02-05 02:35:13',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (14,1,0,0,1,'���23','0','2008-02-05 02:35:16',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (15,1,0,0,1,'23423423423423423','0','2008-02-05 02:35:19',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (16,1,0,0,1,'�����','0','2008-02-05 02:35:22',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (17,1,0,0,1,'23423�','0','2008-02-05 02:35:24',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (18,1,0,0,3,'���32��32�23','0','2008-02-05 02:39:20',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (19,1,0,0,3,'��34�45','0','2008-02-05 02:39:21',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (21,1,0,0,1,'3r23r23','0','2008-02-05 02:44:05',0);
INSERT INTO `blog_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`blog_post_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (24,1,0,0,9,'sdfsdf','0','2008-02-05 03:34:46',0);

#
# Table structure for table blog_posts
#

DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE `blog_posts` (
  `id` bigint(20) NOT NULL auto_increment,
  `blog_id` bigint(20) NOT NULL,
  `ub_tree_id` bigint(20) NOT NULL,
  `bc_tags_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `small_text` text NOT NULL,
  `full_text` text NOT NULL,
  `creation_date` date NOT NULL,
  `access` tinyint(4) NOT NULL,
  `allowcomments` tinyint(4) NOT NULL,
  `comments` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `mood` varchar(100) NOT NULL,
  `avatar_id` bigint(20) NOT NULL,
  `creation_ip` varchar(15) NOT NULL,
  `bbp_status` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=cp1251;

#
# Dumping data for table blog_posts
#

INSERT INTO `blog_posts` (`id`,`blog_id`,`ub_tree_id`,`bc_tags_id`,`title`,`small_text`,`full_text`,`creation_date`,`access`,`allowcomments`,`comments`,`views`,`mood`,`avatar_id`,`creation_ip`,`bbp_status`) VALUES (1,1,1,0,'post1','smal text','sdfs\r\nfwer\r\ng34g\r\n5r\r\ng45\r\nh45\r\nh45','2008-01-01',1,1,12,34,'3',1,'127.0.0.1',1);
INSERT INTO `blog_posts` (`id`,`blog_id`,`ub_tree_id`,`bc_tags_id`,`title`,`small_text`,`full_text`,`creation_date`,`access`,`allowcomments`,`comments`,`views`,`mood`,`avatar_id`,`creation_ip`,`bbp_status`) VALUES (3,1,18,0,'post355','2323assdfvdf','0f234fr34ft34','2008-02-05',1,1,1,12,'2',1,'127.0.0.1',1);
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
  `title` varchar(255) NOT NULL,
  `access` tinyint(4) NOT NULL,
  `creation_date` date NOT NULL,
  `creation_ip` varchar(15) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251;

#
# Dumping data for table blogs
#

INSERT INTO `blogs` (`id`,`user_id`,`title`,`access`,`creation_date`,`creation_ip`) VALUES (1,1,'��� ����',1,'2008-01-30','127.0.0.1');

#
# Table structure for table blogs_catalog
#

DROP TABLE IF EXISTS `blogs_catalog`;
CREATE TABLE `blogs_catalog` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=cp1251;

#
# Dumping data for table blogs_catalog
#

INSERT INTO `blogs_catalog` (`id`,`name`) VALUES (1,'��� 1');
INSERT INTO `blogs_catalog` (`id`,`name`) VALUES (2,'��� 1.1');
INSERT INTO `blogs_catalog` (`id`,`name`) VALUES (3,'��� 1.2');
INSERT INTO `blogs_catalog` (`id`,`name`) VALUES (4,'��� 2');
INSERT INTO `blogs_catalog` (`id`,`name`) VALUES (5,'��� 3');
INSERT INTO `blogs_catalog` (`id`,`name`) VALUES (6,'��� 4');
INSERT INTO `blogs_catalog` (`id`,`name`) VALUES (7,'��� 4.1');
INSERT INTO `blogs_catalog` (`id`,`name`) VALUES (8,'��� 4.2');
INSERT INTO `blogs_catalog` (`id`,`name`) VALUES (9,'��� 4.3');

#
# Table structure for table controllers_list
#

DROP TABLE IF EXISTS `controllers_list`;
CREATE TABLE `controllers_list` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=cp1251;

#
# Dumping data for table controllers_list
#

INSERT INTO `controllers_list` (`id`,`name`) VALUES (1,'IndexController');
INSERT INTO `controllers_list` (`id`,`name`) VALUES (2,'TestController');
INSERT INTO `controllers_list` (`id`,`name`) VALUES (3,'UserController');
INSERT INTO `controllers_list` (`id`,`name`) VALUES (4,'RightsController');
INSERT INTO `controllers_list` (`id`,`name`) VALUES (7,'PhotoCommentController');
INSERT INTO `controllers_list` (`id`,`name`) VALUES (8,'AlbumController');
INSERT INTO `controllers_list` (`id`,`name`) VALUES (9,'PhotoController');
INSERT INTO `controllers_list` (`id`,`name`) VALUES (10,'BlogController');

#
# Table structure for table moods
#

DROP TABLE IF EXISTS `moods`;
CREATE TABLE `moods` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=cp1251;

#
# Dumping data for table moods
#

INSERT INTO `moods` (`id`,`user_id`,`name`) VALUES (1,1,'��');
INSERT INTO `moods` (`id`,`user_id`,`name`) VALUES (2,1,'���');
INSERT INTO `moods` (`id`,`user_id`,`name`) VALUES (3,1,'���');

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

/*!40101 SET NAMES utf8 */;


/*!40101 SET NAMES cp1251 */;

#
# Table structure for table params
#

DROP TABLE IF EXISTS `params`;
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

INSERT INTO `params` (`id`,`group_name`,`item_name`,`value`) VALUES (1,'test_group','param1','Value1');
INSERT INTO `params` (`id`,`group_name`,`item_name`,`value`) VALUES (2,'test_group','param2','value2');

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
  `text` text NOT NULL,
  `mood` varchar(100) NOT NULL,
  `creation_date` datetime NOT NULL,
  `adm_redacted` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=cp1251;

#
# Dumping data for table photo_comments
#

INSERT INTO `photo_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`photo_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (1,1,0,0,1,'comment 1','','2007-01-11 00:00:00',0);
INSERT INTO `photo_comments` (`id`,`user_id`,`avatar_id`,`warning_id`,`photo_id`,`text`,`mood`,`creation_date`,`adm_redacted`) VALUES (2,1,0,0,1,'����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� ����� �����','','2008-05-12 00:00:00',0);
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
  `ip` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=cp1251;

#
# Dumping data for table photo_votes
#

INSERT INTO `photo_votes` (`id`,`photo_id`,`user_id`,`ip`) VALUES (6,20,1,'127.0.0.1');
INSERT INTO `photo_votes` (`id`,`photo_id`,`user_id`,`ip`) VALUES (7,16,1,'127.0.0.1');
INSERT INTO `photo_votes` (`id`,`photo_id`,`user_id`,`ip`) VALUES (8,21,1,'127.0.0.1');
INSERT INTO `photo_votes` (`id`,`photo_id`,`user_id`,`ip`) VALUES (9,17,1,'127.0.0.1');
INSERT INTO `photo_votes` (`id`,`photo_id`,`user_id`,`ip`) VALUES (10,19,1,'127.0.0.1');
INSERT INTO `photo_votes` (`id`,`photo_id`,`user_id`,`ip`) VALUES (11,23,1,'127.0.0.1');

#
# Table structure for table photos
#

DROP TABLE IF EXISTS `photos`;
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
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=cp1251;

#
# Dumping data for table photos
#

INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (1,1,1,'�����','asd','as',1,1,1,1,2,'2008-01-21 14:20:12');
INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (3,2,3,'��� �����','wewer','er43',1,1,0,0,0,'2008-01-21 14:21:12');
INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (5,1,5,'�����','sdfer5y5','34t34',1,1,1,4,14,'2008-01-22 04:20:12');
INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (7,1,1,'asasd','387cd1fec97b13b1beaa786f33fe2dd5.jpg','',0,1,1,0,0,'2008-01-22 20:26:06');
INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (10,1,1,'','72ae57b683699af82beb8ac09b5dfd9f.jpg','',1,1,0,0,0,'2008-01-22 20:32:40');
INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (13,2,3,'a','adf','dasf',1,1,1,0,0,'2008-01-02 00:00:00');
INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (15,1,7,'�2','dca3c730965beac6703ac73758a0259d.jpg','',0,0,1,0,0,'2008-01-23 03:29:53');
INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (17,1,8,'1','b2f4bf92d7042c6304563dd0b3daaf71.jpg','b2f4bf92d7042c6304563dd0b3daaf71.jpg',1,1,1,1,3,'2008-01-23 03:31:23');
INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (18,1,7,'�157','f1bf3e85dd373ecc2fe015ab9349b2e3.jpg','f1bf3e85dd373ecc2fe015ab9349b2e3.jpg',0,0,1,0,0,'2008-01-23 03:31:37');
INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (20,1,8,'4','a7ff7b6a48987713cc27e253d9756ef1.jpg','a7ff7b6a48987713cc27e253d9756ef1.jpg',1,1,1,5,13,'2008-01-23 03:33:26');
INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (21,1,8,'5','a4259f131005609d966516fcd014a3d1.jpg','a4259f131005609d966516fcd014a3d1.jpg',0,0,1,1,2,'2008-01-23 05:04:07');
INSERT INTO `photos` (`id`,`user_id`,`album_id`,`name`,`path`,`thumbnail`,`is_rating`,`is_onmain`,`access`,`voices`,`rating`,`creation_date`) VALUES (23,1,8,'7','eb037c0605feaa5519c2baf469ecdb8e.jpg','eb037c0605feaa5519c2baf469ecdb8e.jpg',1,0,1,1,1,'2008-01-23 05:06:38');

#
# Table structure for table session
#

DROP TABLE IF EXISTS `session`;
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

INSERT INTO `session` (`id`,`lastaction`,`ip`) VALUES ('nlsqs4bn910arcpsnehl7d1vd0',1202190240,'');

#
# Table structure for table session_vars
#

DROP TABLE IF EXISTS `session_vars`;
CREATE TABLE `session_vars` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `session` varchar(100) default NULL,
  `value` text,
  PRIMARY KEY  (`id`),
  KEY `sessionID` (`session`)
) ENGINE=MyISAM AUTO_INCREMENT=556 DEFAULT CHARSET=cp1251;

#
# Dumping data for table session_vars
#

INSERT INTO `session_vars` (`id`,`name`,`session`,`value`) VALUES (550,'user','nlsqs4bn910arcpsnehl7d1vd0','a:26:{s:2:\"id\";s:1:\"1\";s:10:\"first_name\";s:5:\"�����\";s:11:\"middle_name\";s:0:\"\";s:9:\"last_name\";s:7:\"�������\";s:5:\"email\";s:0:\"\";s:5:\"login\";s:5:\"admin\";s:4:\"pass\";s:5:\"admin\";s:10:\"birth_date\";N;s:6:\"gender\";s:1:\"0\";s:5:\"about\";s:0:\"\";s:8:\"interest\";s:0:\"\";s:8:\"reg_date\";s:1:\"0\";s:11:\"su_vis_date\";s:1:\"0\";s:8:\"group_id\";s:1:\"0\";s:10:\"country_id\";s:1:\"0\";s:4:\"city\";s:0:\"\";s:4:\"hash\";s:0:\"\";s:6:\"status\";s:1:\"0\";s:8:\"tabs_map\";s:7:\"1111111\";s:10:\"reputation\";s:1:\"0\";s:9:\"nextmoney\";s:1:\"0\";s:12:\"user_type_id\";s:1:\"1\";s:6:\"banned\";s:1:\"0\";s:17:\"registration_date\";N;s:4:\"name\";s:5:\"�����\";s:6:\"rights\";s:1443:\"a:8:{s:15:\"IndexController\";a:1:{s:11:\"IndexAction\";a:1:{i:0;s:4:\"sub2\";}}s:14:\"TestController\";a:5:{s:11:\"IndexAction\";a:0:{}s:12:\"DeleteAction\";a:0:{}s:10:\"EditAction\";a:0:{}s:9:\"AddAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:14:\"UserController\";a:4:{s:11:\"LoginAction\";a:0:{}s:12:\"LogoutAction\";a:0:{}s:17:\"ViewprofileAction\";a:0:{}s:16:\"PhotoAlbumAction\";a:0:{}}s:16:\"RightsController\";a:2:{s:11:\"IndexAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:22:\"PhotoCommentController\";a:1:{s:17:\"CommentListAction\";a:0:{}}s:15:\"AlbumController\";a:10:{s:14:\"LastListAction\";a:0:{}s:13:\"TopListAction\";a:0:{}s:10:\"UserAction\";a:0:{}s:12:\"CreateAction\";a:0:{}s:12:\"UploadAction\";a:0:{}s:10:\"SaveAction\";a:0:{}s:16:\"UploadFormAction\";a:0:{}s:16:\"CreateFormAction\";a:0:{}s:10:\"ListAction\";a:0:{}s:14:\"ListSaveAction\";a:0:{}}s:15:\"PhotoController\";a:9:{s:13:\"TopListAction\";a:0:{}s:11:\"AlbumAction\";a:0:{}s:10:\"ViewAction\";a:0:{}s:10:\"UserAction\";a:0:{}s:10:\"EditAction\";a:0:{}s:13:\"CommentAction\";a:0:{}s:15:\"RatePhotoAction\";a:0:{}s:19:\"CommentDeleteAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:14:\"BlogController\";a:12:{s:10:\"EditAction\";a:0:{}s:10:\"SaveAction\";a:0:{}s:16:\"EditBranchAction\";a:0:{}s:16:\"SaveBranchAction\";a:0:{}s:10:\"PostAction\";a:0:{}s:14:\"CommentsAction\";a:0:{}s:17:\"SaveCommentAction\";a:0:{}s:17:\"EditCommentAction\";a:0:{}s:19:\"DeleteCommentAction\";a:0:{}s:14:\"PostEditAction\";a:0:{}s:14:\"PostSaveAction\";a:0:{}s:16:\"PostDeleteAction\";a:0:{}}}\";}');
INSERT INTO `session_vars` (`id`,`name`,`session`,`value`) VALUES (551,'LAST_PATH','nlsqs4bn910arcpsnehl7d1vd0','/next24/Blog/EditBranch//id:1');
INSERT INTO `session_vars` (`id`,`name`,`session`,`value`) VALUES (552,'nlsqs4bn910arcpsnehl7d1vd0','nlsqs4bn910arcpsnehl7d1vd0','');

#
# Table structure for table subactions_list
#

DROP TABLE IF EXISTS `subactions_list`;
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

INSERT INTO `subactions_list` (`id`,`action_id`,`name`) VALUES (1,1,'sub1');
INSERT INTO `subactions_list` (`id`,`action_id`,`name`) VALUES (2,1,'sub2');

#
# Table structure for table test
#

DROP TABLE IF EXISTS `test`;
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
# Table structure for table ub_tree
#

DROP TABLE IF EXISTS `ub_tree`;
CREATE TABLE `ub_tree` (
  `id` bigint(20) NOT NULL auto_increment,
  `blog_id` bigint(20) NOT NULL,
  `blogs_catalog_id` int(11) NOT NULL,
  `blog_banner_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `access` tinyint(4) NOT NULL,
  `key` varchar(255) NOT NULL,
  `level` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=cp1251 ROW_FORMAT=FIXED;

#
# Dumping data for table ub_tree
#

INSERT INTO `ub_tree` (`id`,`blog_id`,`blogs_catalog_id`,`blog_banner_id`,`name`,`access`,`key`,`level`) VALUES (1,1,1,0,'��� ������42',1,'',0);
INSERT INTO `ub_tree` (`id`,`blog_id`,`blogs_catalog_id`,`blog_banner_id`,`name`,`access`,`key`,`level`) VALUES (2,1,1,0,'v233',1,'',0);
INSERT INTO `ub_tree` (`id`,`blog_id`,`blogs_catalog_id`,`blog_banner_id`,`name`,`access`,`key`,`level`) VALUES (18,1,1,0,'asdsdfsdf',1,'',0);

#
# Table structure for table user_types
#

DROP TABLE IF EXISTS `user_types`;
CREATE TABLE `user_types` (
  `id` int(11) NOT NULL default '0',
  `name` varchar(50) default NULL,
  `rights` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=cp1251 ROW_FORMAT=FIXED;

#
# Dumping data for table user_types
#

INSERT INTO `user_types` (`id`,`name`,`rights`) VALUES (0,'�����','a:8:{s:15:\"IndexController\";a:1:{s:11:\"IndexAction\";a:2:{i:0;s:4:\"sub1\";i:1;s:4:\"sub2\";}}s:14:\"TestController\";a:5:{s:11:\"IndexAction\";a:0:{}s:12:\"DeleteAction\";a:0:{}s:10:\"EditAction\";a:0:{}s:9:\"AddAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:14:\"UserController\";a:4:{s:11:\"LoginAction\";a:0:{}s:12:\"LogoutAction\";a:0:{}s:17:\"ViewprofileAction\";a:0:{}s:16:\"PhotoAlbumAction\";a:0:{}}s:16:\"RightsController\";a:2:{s:11:\"IndexAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:22:\"PhotoCommentController\";a:1:{s:17:\"CommentListAction\";a:0:{}}s:15:\"AlbumController\";a:10:{s:14:\"LastListAction\";a:0:{}s:13:\"TopListAction\";a:0:{}s:10:\"UserAction\";a:0:{}s:12:\"CreateAction\";a:0:{}s:12:\"UploadAction\";a:0:{}s:10:\"SaveAction\";a:0:{}s:16:\"UploadFormAction\";a:0:{}s:16:\"CreateFormAction\";a:0:{}s:10:\"ListAction\";a:0:{}s:14:\"ListSaveAction\";a:0:{}}s:15:\"PhotoController\";a:9:{s:13:\"TopListAction\";a:0:{}s:11:\"AlbumAction\";a:0:{}s:10:\"ViewAction\";a:0:{}s:10:\"UserAction\";a:0:{}s:10:\"EditAction\";a:0:{}s:13:\"CommentAction\";a:0:{}s:15:\"RatePhotoAction\";a:0:{}s:19:\"CommentDeleteAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:14:\"BlogController\";a:11:{s:10:\"EditAction\";a:0:{}s:10:\"SaveAction\";a:0:{}s:16:\"EditBranchAction\";a:0:{}s:16:\"SaveBranchAction\";a:0:{}s:10:\"PostAction\";a:0:{}s:14:\"CommentsAction\";a:0:{}s:17:\"SaveCommentAction\";a:0:{}s:17:\"EditCommentAction\";a:0:{}s:19:\"DeleteCommentAction\";a:0:{}s:14:\"PostEditAction\";a:0:{}s:14:\"PostSaveAction\";a:0:{}}}');
INSERT INTO `user_types` (`id`,`name`,`rights`) VALUES (1,'�����','a:8:{s:15:\"IndexController\";a:1:{s:11:\"IndexAction\";a:1:{i:0;s:4:\"sub2\";}}s:14:\"TestController\";a:5:{s:11:\"IndexAction\";a:0:{}s:12:\"DeleteAction\";a:0:{}s:10:\"EditAction\";a:0:{}s:9:\"AddAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:14:\"UserController\";a:4:{s:11:\"LoginAction\";a:0:{}s:12:\"LogoutAction\";a:0:{}s:17:\"ViewprofileAction\";a:0:{}s:16:\"PhotoAlbumAction\";a:0:{}}s:16:\"RightsController\";a:2:{s:11:\"IndexAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:22:\"PhotoCommentController\";a:1:{s:17:\"CommentListAction\";a:0:{}}s:15:\"AlbumController\";a:10:{s:14:\"LastListAction\";a:0:{}s:13:\"TopListAction\";a:0:{}s:10:\"UserAction\";a:0:{}s:12:\"CreateAction\";a:0:{}s:12:\"UploadAction\";a:0:{}s:10:\"SaveAction\";a:0:{}s:16:\"UploadFormAction\";a:0:{}s:16:\"CreateFormAction\";a:0:{}s:10:\"ListAction\";a:0:{}s:14:\"ListSaveAction\";a:0:{}}s:15:\"PhotoController\";a:9:{s:13:\"TopListAction\";a:0:{}s:11:\"AlbumAction\";a:0:{}s:10:\"ViewAction\";a:0:{}s:10:\"UserAction\";a:0:{}s:10:\"EditAction\";a:0:{}s:13:\"CommentAction\";a:0:{}s:15:\"RatePhotoAction\";a:0:{}s:19:\"CommentDeleteAction\";a:0:{}s:10:\"SaveAction\";a:0:{}}s:14:\"BlogController\";a:12:{s:10:\"EditAction\";a:0:{}s:10:\"SaveAction\";a:0:{}s:16:\"EditBranchAction\";a:0:{}s:16:\"SaveBranchAction\";a:0:{}s:10:\"PostAction\";a:0:{}s:14:\"CommentsAction\";a:0:{}s:17:\"SaveCommentAction\";a:0:{}s:17:\"EditCommentAction\";a:0:{}s:19:\"DeleteCommentAction\";a:0:{}s:14:\"PostEditAction\";a:0:{}s:14:\"PostSaveAction\";a:0:{}s:16:\"PostDeleteAction\";a:0:{}}}');

#
# Table structure for table users
#

DROP TABLE IF EXISTS `users`;
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=cp1251;

#
# Dumping data for table users
#

INSERT INTO `users` (`id`,`first_name`,`middle_name`,`last_name`,`email`,`login`,`pass`,`birth_date`,`gender`,`about`,`interest`,`reg_date`,`su_vis_date`,`group_id`,`country_id`,`city`,`hash`,`status`,`tabs_map`,`reputation`,`nextmoney`,`user_type_id`,`banned`,`registration_date`) VALUES (1,'�����','','�������','','admin','admin',NULL,0,'','',0,0,0,0,'','',0,'1111111',0,0,1,0,NULL);
INSERT INTO `users` (`id`,`first_name`,`middle_name`,`last_name`,`email`,`login`,`pass`,`birth_date`,`gender`,`about`,`interest`,`reg_date`,`su_vis_date`,`group_id`,`country_id`,`city`,`hash`,`status`,`tabs_map`,`reputation`,`nextmoney`,`user_type_id`,`banned`,`registration_date`) VALUES (2,'����','������������','�������','a@email.com','user','user',NULL,1,'asd','qd',12121212,123123,1,1,'�����','sdfdsfsd',1,'1111111',0,0,1,0,NULL);

/*!40101 SET NAMES utf8 */;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
