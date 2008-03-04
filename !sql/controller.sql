-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Мар 04 2008 г., 11:11
-- Версия сервера: 5.0.45
-- Версия PHP: 5.2.4
-- 
-- БД: `next`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `controller`
-- 

DROP TABLE IF EXISTS `controller`;
CREATE TABLE `controller` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) character set cp1251 default NULL,
  `description` varchar(255) character set cp1251 default NULL,
  `request_key` varchar(80) default NULL,
  `admin` int(1) default NULL,
  `default` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- 
-- Дамп данных таблицы `controller`
-- 

INSERT INTO `controller` VALUES (1, 'IndexController', 'Непонятно какой', 'Index', 0, 1);
INSERT INTO `controller` VALUES (2, 'TestController', 'Тестовый', 'Test', 0, NULL);
INSERT INTO `controller` VALUES (3, 'UserController', 'Управление профилем пользователя', 'User', 0, NULL);
INSERT INTO `controller` VALUES (4, 'RightsController', 'Управление правами', 'Rights', 0, NULL);
INSERT INTO `controller` VALUES (7, 'PhotoCommentController', 'Комментарии к фотоальбомам', 'PhotoComment', 0, NULL);
INSERT INTO `controller` VALUES (8, 'AlbumController', 'Фотоальбомы', 'Album', 0, NULL);
INSERT INTO `controller` VALUES (9, 'PhotoController', 'Фотографии фотоальбомов', 'Photo', 0, NULL);
INSERT INTO `controller` VALUES (10, 'BlogController', 'Блоги', 'Blog', 0, NULL);
INSERT INTO `controller` VALUES (11, 'AdminController', 'Администрирование', 'Admin', 1, 0);
INSERT INTO `controller` VALUES (12, 'AdminParameterController', 'Управление параметрами конфигурации', 'AdminParameter', 1, NULL);
INSERT INTO `controller` VALUES (13, 'AdminUserController', 'Управление пользователями системы', 'AdminUser', 1, NULL);
INSERT INTO `controller` VALUES (14, 'UserTypeController', 'Управление группами пользователей', 'UserType', 1, NULL);
INSERT INTO `controller` VALUES (15, 'QuestionAnswerController', 'Вопросы-ответы', 'QuestionAnswer', 0, NULL);
        