-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- ����: localhost
-- ����� ��������: ��� 07 2008 �., 18:34
-- ������ �������: 5.0.45
-- ������ PHP: 5.2.4
-- 
-- ��: `next`
-- 

-- --------------------------------------------------------

-- 
-- ��������� ������� `question_tags`
-- 

CREATE TABLE IF NOT EXISTS `question_tags` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(100) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=9 ;

-- 
-- ���� ������ ������� `question_tags`
-- 

INSERT INTO `question_tags` VALUES (6, '��� 1');
INSERT INTO `question_tags` VALUES (7, '���');
INSERT INTO `question_tags` VALUES (8, '���');
        