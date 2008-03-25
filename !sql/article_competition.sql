-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Мар 25 2008 г., 22:57
-- Версия сервера: 5.0.45
-- Версия PHP: 5.2.4
-- 
-- БД: `next`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `article_competition`
-- 

CREATE TABLE `article_competition` (
  `id` bigint(20) NOT NULL auto_increment,
  `id_article_tree` bigint(20) NOT NULL,
  `data_begin` datetime NOT NULL,
  `data_end` datetime NOT NULL,
  `reward` double default NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `article_competition`
-- 

        