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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- 
-- Дамп данных таблицы `controller`
-- 

INSERT INTO `controller` VALUES (20, 'AdminArticleController', NULL, 'AdminArticle', 1, NULL);



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
) ENGINE=MyISAM AUTO_INCREMENT=166 DEFAULT CHARSET=utf8 AUTO_INCREMENT=166 ;

-- 
-- Дамп данных таблицы `action`
-- 

INSERT INTO `action` VALUES (160, 20, 'ResetRate', NULL, NULL, 'reset_article_rate');
INSERT INTO `action` VALUES (161, 20, 'ShowTree', NULL, NULL, 'article_tree');
INSERT INTO `action` VALUES (162, 20, 'ManagedSection', NULL, NULL, 'managed_section');
INSERT INTO `action` VALUES (163, 20, 'DeleteSection', NULL, NULL, 'delete_article_section');
INSERT INTO `action` VALUES (164, 20, 'DeleteArticle', NULL, NULL, 'admin_delete_article');
INSERT INTO `action` VALUES (165, 20, 'SetCompetition', NULL, NULL, 'set_competition');


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
) ENGINE=MyISAM AUTO_INCREMENT=283 DEFAULT CHARSET=utf8 AUTO_INCREMENT=283 ;

-- 
-- Дамп данных таблицы `user_right`
-- 

INSERT INTO `user_right` VALUES (277, 1, 20, 160, NULL, 1);
INSERT INTO `user_right` VALUES (278, 1, 20, 161, NULL, 1);
INSERT INTO `user_right` VALUES (279, 1, 20, 162, NULL, 1);
INSERT INTO `user_right` VALUES (280, 1, 20, 163, NULL, 1);
INSERT INTO `user_right` VALUES (281, 1, 20, 164, NULL, 1);
INSERT INTO `user_right` VALUES (282, 1, 20, 165, NULL, 1);
        