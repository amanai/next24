-- EMS SQL Manager
-- Table: bookmarks - Таблица закладок

CREATE TABLE `bookmarks_tree` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `parent_id` int(11) NOT NULL default '0' COMMENT 'ID родителя. Уровня в дереве всего 2.',
  `user_id` int(11) NOT NULL COMMENT 'ID пользователя, который добавил раздел',
  `name` varchar(100) NOT NULL COMMENT 'Имя раздела',
  `active` tinyint(4) NOT NULL default '0' COMMENT 'Активен ли раздел. Поле нужно для организации модерации.',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Таблица дерево закладок';