-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- ����: localhost
-- ����� ��������: ��� 03 2008 �., 19:08
-- ������ �������: 5.0.45
-- ������ PHP: 5.2.4
-- 
-- ��: `next`
-- 

-- --------------------------------------------------------

-- 
-- ��������� ������� `question_tags`
-- 

DROP TABLE IF EXISTS `question_tags`;
CREATE TABLE IF NOT EXISTS `question_tags` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`),
  FULLTEXT KEY `name_2` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- ���� ������ ������� `question_tags`
-- 

INSERT INTO `question_tags` VALUES (1, 'Tag');
INSERT INTO `question_tags` VALUES (2, 'Tag 1');
INSERT INTO `question_tags` VALUES (3, 'Tag 2');
        