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
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

#
# Dumping data for table action
#

DELETE FROM `action` WHERE controller_id IN (15, 16, 10) OR id IN (70);
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (15, 'List', NULL, NULL, 'user_questions');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (15, 'ViewQuestion', NULL, NULL, 'view_question');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (15, 'AnswerDelete', NULL, NULL, 'delete_answer');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (15, 'AddAnswer', NULL, NULL, 'add_answer');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (15, 'ManagedQuestion', NULL, NULL, 'managed_question');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (15, 'Delete', NULL, NULL, 'delete_question');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (9,'LastList',NULL,NULL,'last_photo');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (16,'CatalogList',1,NULL,'blog_catalog_list');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (16,'CatalogEdit',NULL,NULL,'blog_catalog_edit');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (16,'CatalogSave',NULL,NULL,'blog_catalog_save');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (16,'CatalogSaveTags',NULL,NULL,'blog_catalog_save_tags');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (16,'CatalogDeleteTag',NULL,NULL,'blog_catalog_delete_tag');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (10,'Edit',NULL,NULL,'blog_edit');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (10,'Save',NULL,NULL,'blog_save');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (10,'EditBranch',NULL,NULL,'blog_edit_branch');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (10,'SaveBranch',NULL,NULL,'blog_save_branch');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (10,'PostList',NULL,NULL,'posts');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (10,'Comments',NULL,NULL,'blog_post_comments');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (10,'SaveComment',NULL,NULL,'blog_save_comment');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (10,'EditComment',NULL,NULL,'blog_edit_comment');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (10,'DeleteComment',NULL,NULL,'blog_delete_comment');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (10,'PostEdit',NULL,NULL,'blog_post_edit');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (10,'PostSave',NULL,NULL,'blog_post_save');
INSERT INTO `action` (`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (10,'PostDelete',NULL,NULL,'blog_post_delete');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
