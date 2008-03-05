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
  `request_key` varchar(80) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `Новый индекс` (`request_key`),
  KEY `controller_idIdx` (`controller_id`),
  KEY `nameIdx` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

#
# Dumping data for table action
#

INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (1,1,'Index',1,NULL,'home');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (2,2,'Index',0,NULL,'');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (3,2,'Delete',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (4,2,'Edit',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (5,2,'Add',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (6,2,'Save',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (8,3,'Login',NULL,NULL,'site_login');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (9,3,'Logout',NULL,NULL,'site_logout');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (10,4,'Index',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (11,4,'Save',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (12,3,'Viewprofile',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (13,7,'CommentList',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (14,3,'PhotoAlbum',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (15,8,'LastList',NULL,NULL,'last_albums');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (16,8,'TopList',NULL,NULL,'top_albums');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (17,9,'TopList',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (18,9,'Album',NULL,NULL,'albums_photo');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (19,9,'View',NULL,NULL,'view_photo');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (20,9,'User',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (21,8,'User',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (22,8,'Create',NULL,NULL,'save_album');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (23,8,'Upload',NULL,NULL,'upload_photo_form');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (24,8,'Save',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (25,8,'UploadForm',NULL,NULL,'upload_pic');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (26,8,'CreateForm',NULL,NULL,'create_album');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (27,8,'Create',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (28,8,'List',NULL,NULL,'albums');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (29,9,'Edit',NULL,NULL,'edit_photo');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (30,9,'Comment',NULL,NULL,'comment_photo');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (31,8,'ListSave',NULL,NULL,'save_album_list');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (32,9,'RatePhoto',NULL,NULL,'vote_photo');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (33,9,'CommentDelete',NULL,NULL,'del_photo_comment');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (34,9,'Save',NULL,NULL,'save_photo_list');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (35,10,'Edit',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (36,10,'Save',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (37,10,'EditBranch',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (38,10,'SaveBranch',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (39,10,'Post',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (40,10,'Comments',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (41,10,'SaveComment',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (42,10,'EditComment',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (43,10,'DeleteComment',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (44,10,'PostEdit',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (45,10,'PostSave',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (46,10,'PostDelete',NULL,NULL,NULL);
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (47,11,'Login',NULL,NULL,'login');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (48,11,'LoginForm',NULL,NULL,'loginform');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (49,11,'Desktop',1,NULL,'desktop');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (50,11,'Logout',NULL,NULL,'logout');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (51,12,'GroupList',1,NULL,'param_group_list');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (52,12,'EditGroup',NULL,NULL,'admin_edit_group');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (53,12,'SaveParams',NULL,NULL,'admin_save_param');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (54,12,'DeleteParam',NULL,NULL,'admin_del_param');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (55,13,'Delete',NULL,NULL,'admin_user_delete');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (56,13,'List',NULL,NULL,'admin_user_list');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (57,13,'Edit',NULL,NULL,'admin_user_edit');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (58,13,'Save',NULL,NULL,'admin_user_save');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (59,14,'List',1,NULL,'admin_user_group');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (60,14,'Edit',NULL,NULL,'admin_user_group_edit');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (61,14,'Save',NULL,NULL,'admin_user_group_save');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (62,14,'Controllers',NULL,NULL,'admin_group_controllers');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (63,14,'ActionList',NULL,NULL,'admin_group_action_list');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (64,14,'ChangeAccess',NULL,NULL,'admin_user_change_access');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (65,3,'Profile',NULL,NULL,'user_profile');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (67,15,'List',NULL,'Р’РѕРїСЂРѕСЃС‹-РѕС‚РІРµС‚С‹','user_questions');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (68,15,'ViewQuestion',NULL,'Р’РѕРїСЂРѕСЃ РїРѕР»СЊР·РѕРІР°С‚РµР»СЏ','view_question');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (69,15,'AnswerDelete',NULL,'РЈРґР°Р»РёС‚СЊ РѕС‚РІРµС‚','delete_answer');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
