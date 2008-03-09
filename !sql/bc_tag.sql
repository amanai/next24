# MySQL-Front 3.2  (Build 6.11)

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES 'utf8' */;

# Host: localhost    Database: next24
# ------------------------------------------------------
# Server version 5.0.45-community-nt

#
# Table structure for table bc_tag
#

DROP TABLE IF EXISTS `bc_tag`;
CREATE TABLE `bc_tag` (
  `id` bigint(20) NOT NULL auto_increment,
  `blog_catalog_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `posts_num` bigint(20) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `sortfield` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

#
# Dumping data for table bc_tag
#

INSERT INTO `bc_tag` (`id`,`blog_catalog_id`,`name`,`posts_num`,`active`,`sortfield`) VALUES (1,5,'a3',1,1,1);
INSERT INTO `bc_tag` (`id`,`blog_catalog_id`,`name`,`posts_num`,`active`,`sortfield`) VALUES (2,5,'bbb',2,0,0);
INSERT INTO `bc_tag` (`id`,`blog_catalog_id`,`name`,`posts_num`,`active`,`sortfield`) VALUES (6,5,'12323432',0,1,0);
INSERT INTO `bc_tag` (`id`,`blog_catalog_id`,`name`,`posts_num`,`active`,`sortfield`) VALUES (7,5,'23324',0,0,0);
INSERT INTO `bc_tag` (`id`,`blog_catalog_id`,`name`,`posts_num`,`active`,`sortfield`) VALUES (8,5,'asdas',0,1,0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
