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

INSERT INTO `user_right` VALUES (148, 1, 15, 102, NULL, 1);