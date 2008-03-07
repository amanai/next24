-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Мар 07 2008 г., 18:33
-- Версия сервера: 5.0.45
-- Версия PHP: 5.2.4
-- 
-- БД: `next`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `questions`
-- 

CREATE TABLE IF NOT EXISTS `questions` (
  `id` bigint(20) NOT NULL auto_increment,
  `questions_cat_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `a_count` int(11) NOT NULL,
  `q_text` text character set utf8,
  `creation_date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=cp1251 PACK_KEYS=0 AUTO_INCREMENT=5 ;

-- 
-- Дамп данных таблицы `questions`
-- 

INSERT INTO `questions` VALUES (4, 1, 1, 1, 'Вопрос?', '2008-03-07 18:22:44');
        