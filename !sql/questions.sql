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
-- ��������� ������� `questions`
-- 

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` bigint(20) NOT NULL auto_increment,
  `questions_cat_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `a_count` int(11) NOT NULL,
  `q_text` text NOT NULL,
  `creation_date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

-- 
-- ���� ������ ������� `questions`
-- 

INSERT INTO `questions` VALUES (1, 1, 1, 0, '������?', '2001-01-05 10:00:00');
INSERT INTO `questions` VALUES (2, 2, 1, 0, '������ 2?', '2002-01-08 00:00:00');
INSERT INTO `questions` VALUES (3, 1, 1, 0, '������ 3?', '1987-06-07 00:00:00');
        