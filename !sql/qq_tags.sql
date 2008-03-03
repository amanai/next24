-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Мар 03 2008 г., 19:10
-- Версия сервера: 5.0.45
-- Версия PHP: 5.2.4
-- 
-- БД: `next`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `qq_tags`
-- 

DROP TABLE IF EXISTS `qq_tags`;
CREATE TABLE IF NOT EXISTS `qq_tags` (
  `question_id` int(11) NOT NULL,
  `question_tag_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- Дамп данных таблицы `qq_tags`
-- 

INSERT INTO `qq_tags` VALUES (1, 2, 1);
INSERT INTO `qq_tags` VALUES (1, 1, 1);
INSERT INTO `qq_tags` VALUES (2, 1, 1);
INSERT INTO `qq_tags` VALUES (3, 3, 2);
        