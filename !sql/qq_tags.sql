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
-- Структура таблицы `qq_tags`
-- 

CREATE TABLE IF NOT EXISTS `qq_tags` (
  `question_id` int(11) NOT NULL,
  `question_tag_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- Дамп данных таблицы `qq_tags`
-- 

INSERT INTO `qq_tags` VALUES (4, 8);
INSERT INTO `qq_tags` VALUES (4, 7);
INSERT INTO `qq_tags` VALUES (4, 6);
INSERT INTO `qq_tags` VALUES (4, 7);
        