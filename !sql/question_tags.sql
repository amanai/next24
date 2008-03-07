-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Мар 07 2008 г., 18:34
-- Версия сервера: 5.0.45
-- Версия PHP: 5.2.4
-- 
-- БД: `next`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `question_tags`
-- 

CREATE TABLE IF NOT EXISTS `question_tags` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(100) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=9 ;

-- 
-- Дамп данных таблицы `question_tags`
-- 

INSERT INTO `question_tags` VALUES (6, 'тег 1');
INSERT INTO `question_tags` VALUES (7, 'тег');
INSERT INTO `question_tags` VALUES (8, 'тте');
        