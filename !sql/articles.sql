-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Мар 19 2008 г., 19:53
-- Версия сервера: 5.0.45
-- Версия PHP: 5.2.4
-- 
-- БД: `next`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `article_pages`
-- 

DROP TABLE IF EXISTS `article_pages`;
CREATE TABLE IF NOT EXISTS `article_pages` (
  `id` bigint(20) NOT NULL auto_increment,
  `article_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `p_text` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Структура таблицы `article_votes`
-- 

DROP TABLE IF EXISTS `article_votes`;
CREATE TABLE IF NOT EXISTS `article_votes` (
  `id` bigint(20) NOT NULL auto_increment,
  `article_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `ip` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Структура таблицы `articles`
-- 

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` bigint(20) NOT NULL auto_increment,
  `articles_tree_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `allowcomments` tinyint(4) NOT NULL,
  `rate_status` tinyint(4) NOT NULL,
  `rate` bigint(20) NOT NULL,
  `votes` bigint(20) NOT NULL,
  `comments` bigint(20) NOT NULL,
  `views` bigint(20) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Структура таблицы `articles_tree`
-- 

DROP TABLE IF EXISTS `articles_tree`;
CREATE TABLE IF NOT EXISTS `articles_tree` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `key` varchar(255) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
        