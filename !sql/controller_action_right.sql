# MySQL-Front 3.2  (Build 6.11)

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES 'utf8' */;

# Host: localhost    Database: next24
# ------------------------------------------------------
# Server version 5.0.45-community-nt

#
# Table structure for table controller
#

INSERT INTO `controller` (`id`,`name`,`description`,`request_key`,`admin`,`default`) VALUES (16,'BlogAdminController','Управление блогами','BlogAdmin',1,NULL);


INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (71,16,'CatalogList',1,NULL,'blog_catalog_list');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (72,16,'CatalogEdit',NULL,NULL,'blog_catalog_edit');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (73,16,'CatalogSave',NULL,NULL,'blog_catalog_save');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (74,16,'CatalogSaveTags',NULL,NULL,'blog_catalog_save_tags');
INSERT INTO `action` (`id`,`controller_id`,`name`,`default`,`page_title`,`request_key`) VALUES (75,16,'CatalogDeleteTag',NULL,NULL,'blog_catalog_delete_tag');


INSERT INTO `user_right` (`id`,`user_type_id`,`controller_id`,`action_id`,`subaction_id`,`access`) VALUES (98,1,16,71,NULL,1);
INSERT INTO `user_right` (`id`,`user_type_id`,`controller_id`,`action_id`,`subaction_id`,`access`) VALUES (99,1,16,72,NULL,1);
INSERT INTO `user_right` (`id`,`user_type_id`,`controller_id`,`action_id`,`subaction_id`,`access`) VALUES (100,1,16,73,NULL,1);
INSERT INTO `user_right` (`id`,`user_type_id`,`controller_id`,`action_id`,`subaction_id`,`access`) VALUES (101,1,16,74,NULL,1);
INSERT INTO `user_right` (`id`,`user_type_id`,`controller_id`,`action_id`,`subaction_id`,`access`) VALUES (102,1,16,75,NULL,1);
INSERT INTO `user_right` (`id`,`user_type_id`,`controller_id`,`action_id`,`subaction_id`,`access`) VALUES (103,1,10,45,NULL,1);
INSERT INTO `user_right` (`id`,`user_type_id`,`controller_id`,`action_id`,`subaction_id`,`access`) VALUES (104,1,10,46,NULL,1);
INSERT INTO `user_right` (`id`,`user_type_id`,`controller_id`,`action_id`,`subaction_id`,`access`) VALUES (105,1,10,44,NULL,1);
INSERT INTO `user_right` (`id`,`user_type_id`,`controller_id`,`action_id`,`subaction_id`,`access`) VALUES (106,1,10,43,NULL,1);
INSERT INTO `user_right` (`id`,`user_type_id`,`controller_id`,`action_id`,`subaction_id`,`access`) VALUES (107,1,10,42,NULL,1);
INSERT INTO `user_right` (`id`,`user_type_id`,`controller_id`,`action_id`,`subaction_id`,`access`) VALUES (108,1,10,41,NULL,1);
INSERT INTO `user_right` (`id`,`user_type_id`,`controller_id`,`action_id`,`subaction_id`,`access`) VALUES (109,1,10,40,NULL,1);
INSERT INTO `user_right` (`id`,`user_type_id`,`controller_id`,`action_id`,`subaction_id`,`access`) VALUES (110,1,10,39,NULL,1);
INSERT INTO `user_right` (`id`,`user_type_id`,`controller_id`,`action_id`,`subaction_id`,`access`) VALUES (111,1,10,38,NULL,1);
INSERT INTO `user_right` (`id`,`user_type_id`,`controller_id`,`action_id`,`subaction_id`,`access`) VALUES (112,1,10,37,NULL,1);
INSERT INTO `user_right` (`id`,`user_type_id`,`controller_id`,`action_id`,`subaction_id`,`access`) VALUES (113,1,10,36,NULL,1);
INSERT INTO `user_right` (`id`,`user_type_id`,`controller_id`,`action_id`,`subaction_id`,`access`) VALUES (114,1,10,35,NULL,1);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
