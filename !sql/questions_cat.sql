-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- ����: localhost
-- ����� ��������: ��� 03 2008 �., 19:07
-- ������ �������: 5.0.45
-- ������ PHP: 5.2.4
-- 
-- ��: `next`
-- 

-- --------------------------------------------------------

-- 
-- ��������� ������� `questions_cat`
-- 

DROP TABLE IF EXISTS `questions_cat`;
CREATE TABLE IF NOT EXISTS `questions_cat` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `sortfield` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=3 ;

-- 
-- ���� ������ ������� `questions_cat`
-- 

INSERT INTO `questions_cat` VALUES (1, '��������� 1', 0);
INSERT INTO `questions_cat` VALUES (2, '��������� 2', 0);