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
-- ��������� ������� `answers`
-- 

CREATE TABLE IF NOT EXISTS `answers` (
  `id` bigint(20) NOT NULL auto_increment,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `avatar_id` int(11) NOT NULL,
  `warning_id` int(11) NOT NULL,
  `mood` int(11) NOT NULL,
  `adm_redacted` int(11) NOT NULL,
  `text` text character set utf8,
  `creation_date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=cp1251 PACK_KEYS=0 AUTO_INCREMENT=6 ;

-- 
-- ���� ������ ������� `answers`
-- 

INSERT INTO `answers` VALUES (5, 4, 1, 0, 0, 0, 0, '�����', '2008-03-07 18:23:30');
        