-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Мар 10 2008 г., 14:30
-- Версия сервера: 5.0.45
-- Версия PHP: 5.2.4
-- 
-- БД: `next`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `action`
-- 

CREATE TABLE IF NOT EXISTS `action` (
  `id` int(11) NOT NULL auto_increment,
  `controller_id` int(11) default NULL,
  `name` varchar(50) character set cp1251 default NULL,
  `default` int(1) default NULL,
  `page_title` varchar(255) default NULL,
  `request_key` varchar(80) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `Новый индекс` (`request_key`),
  KEY `controller_idIdx` (`controller_id`),
  KEY `nameIdx` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=utf8 AUTO_INCREMENT=134 ;

-- 
-- Дамп данных таблицы `action`
-- 

INSERT INTO `action` VALUES (125, 17, 'Index', NULL, NULL, 'admin_questions');
INSERT INTO `action` VALUES (126, 17, 'CatList', NULL, NULL, 'admin_cat_list');
INSERT INTO `action` VALUES (127, 17, 'MoveCat', NULL, NULL, 'admin_move_cat');
INSERT INTO `action` VALUES (128, 17, 'ManagedCat', NULL, NULL, 'admin_managed_cat');
INSERT INTO `action` VALUES (129, 17, 'DeleteCat', NULL, NULL, 'delete_cat');
INSERT INTO `action` VALUES (130, 17, 'QuestionList', NULL, NULL, 'admin_question_list');
INSERT INTO `action` VALUES (131, 17, 'DeleteQuestion', NULL, NULL, 'admin_delete_question');
INSERT INTO `action` VALUES (132, 17, 'EditQuestion', NULL, NULL, 'admin_edit_question');
INSERT INTO `action` VALUES (133, 15, 'UserQuestions', NULL, NULL, 'my_questions');


-- 
-- Структура таблицы `controller`
-- 

CREATE TABLE IF NOT EXISTS `controller` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) character set cp1251 default NULL,
  `description` varchar(255) character set cp1251 default NULL,
  `request_key` varchar(80) default NULL,
  `admin` int(1) default NULL,
  `default` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- 
-- Дамп данных таблицы `controller`
-- 

INSERT INTO `controller` VALUES (17, 'AdminQuestionAnswerController', 'Управление вопросами и группами', 'AdminQuestionAnswer', 1, NULL);
        
        -- 
-- Структура таблицы `user_right`
-- 

CREATE TABLE IF NOT EXISTS `user_right` (
  `id` int(11) NOT NULL auto_increment,
  `user_type_id` int(11) default NULL,
  `controller_id` int(11) default NULL,
  `action_id` int(11) default NULL,
  `subaction_id` int(11) default NULL,
  `access` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=148 DEFAULT CHARSET=utf8 AUTO_INCREMENT=148 ;

-- 
-- Дамп данных таблицы `user_right`
-- 

INSERT INTO `user_right` VALUES (139, 1, 17, 125, NULL, 1);
INSERT INTO `user_right` VALUES (140, 1, 17, 126, NULL, 1);
INSERT INTO `user_right` VALUES (141, 1, 17, 127, NULL, 1);
INSERT INTO `user_right` VALUES (142, 1, 17, 128, NULL, 1);
INSERT INTO `user_right` VALUES (143, 1, 17, 129, NULL, 1);
INSERT INTO `user_right` VALUES (144, 1, 17, 130, NULL, 1);
INSERT INTO `user_right` VALUES (145, 1, 17, 131, NULL, 1);
INSERT INTO `user_right` VALUES (146, 1, 17, 132, NULL, 1);
INSERT INTO `user_right` VALUES (147, 1, 15, 133, NULL, 1);
        