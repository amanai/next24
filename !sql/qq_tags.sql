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
-- ��������� ������� `qq_tags`
-- 

CREATE TABLE IF NOT EXISTS `qq_tags` (
  `question_id` int(11) NOT NULL,
  `question_tag_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- ���� ������ ������� `qq_tags`
-- 

INSERT INTO `qq_tags` VALUES (4, 8);
INSERT INTO `qq_tags` VALUES (4, 7);
INSERT INTO `qq_tags` VALUES (4, 6);
INSERT INTO `qq_tags` VALUES (4, 7);
        