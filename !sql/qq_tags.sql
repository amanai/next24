-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- ����: localhost
-- ����� ��������: ��� 03 2008 �., 19:10
-- ������ �������: 5.0.45
-- ������ PHP: 5.2.4
-- 
-- ��: `next`
-- 

-- --------------------------------------------------------

-- 
-- ��������� ������� `qq_tags`
-- 

DROP TABLE IF EXISTS `qq_tags`;
CREATE TABLE IF NOT EXISTS `qq_tags` (
  `question_id` int(11) NOT NULL,
  `question_tag_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `qq_tags`
-- 

INSERT INTO `qq_tags` VALUES (1, 2, 1);
INSERT INTO `qq_tags` VALUES (1, 1, 1);
INSERT INTO `qq_tags` VALUES (2, 1, 1);
INSERT INTO `qq_tags` VALUES (3, 3, 2);
        