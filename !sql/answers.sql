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
-- ��������� ������� `answers`
-- 

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS "answers" (
  "id" bigint(20) NOT NULL auto_increment,
  "question_id" int(11) NOT NULL,
  "user_id" int(11) NOT NULL,
  "text" text NOT NULL,
  "creation_date" date NOT NULL,
  PRIMARY KEY  ("id")
) AUTO_INCREMENT=4 ;

-- 
-- ���� ������ ������� `answers`
-- 

INSERT INTO `answers` VALUES (1, 1, 1, '����� 1', '2008-03-02');
INSERT INTO `answers` VALUES (2, 2, 1, '����� 2', '2008-03-02');
INSERT INTO `answers` VALUES (3, 1, 1, '����� 3', '2008-03-02');
        