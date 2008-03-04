-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- ����: localhost
-- ����� ��������: ��� 04 2008 �., 11:11
-- ������ �������: 5.0.45
-- ������ PHP: 5.2.4
-- 
-- ��: `next`
-- 

-- --------------------------------------------------------

-- 
-- ��������� ������� `controller`
-- 

DROP TABLE IF EXISTS `controller`;
CREATE TABLE `controller` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) character set cp1251 default NULL,
  `description` varchar(255) character set cp1251 default NULL,
  `request_key` varchar(80) default NULL,
  `admin` int(1) default NULL,
  `default` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- 
-- ���� ������ ������� `controller`
-- 

INSERT INTO `controller` VALUES (1, 'IndexController', '��������� �����', 'Index', 0, 1);
INSERT INTO `controller` VALUES (2, 'TestController', '��������', 'Test', 0, NULL);
INSERT INTO `controller` VALUES (3, 'UserController', '���������� �������� ������������', 'User', 0, NULL);
INSERT INTO `controller` VALUES (4, 'RightsController', '���������� �������', 'Rights', 0, NULL);
INSERT INTO `controller` VALUES (7, 'PhotoCommentController', '����������� � ������������', 'PhotoComment', 0, NULL);
INSERT INTO `controller` VALUES (8, 'AlbumController', '�����������', 'Album', 0, NULL);
INSERT INTO `controller` VALUES (9, 'PhotoController', '���������� ������������', 'Photo', 0, NULL);
INSERT INTO `controller` VALUES (10, 'BlogController', '�����', 'Blog', 0, NULL);
INSERT INTO `controller` VALUES (11, 'AdminController', '�����������������', 'Admin', 1, 0);
INSERT INTO `controller` VALUES (12, 'AdminParameterController', '���������� ����������� ������������', 'AdminParameter', 1, NULL);
INSERT INTO `controller` VALUES (13, 'AdminUserController', '���������� �������������� �������', 'AdminUser', 1, NULL);
INSERT INTO `controller` VALUES (14, 'UserTypeController', '���������� �������� �������������', 'UserType', 1, NULL);
INSERT INTO `controller` VALUES (15, 'QuestionAnswerController', '�������-������', 'QuestionAnswer', 0, NULL);
        