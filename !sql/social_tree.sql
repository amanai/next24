-- EMS SQL Manager
-- Table: Таблица Дерево социальных разделов

CREATE TABLE `social_tree` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `parent_id` int(11) NOT NULL default '0' COMMENT 'ID родителя. Уровня в дереве всего 2.',
  `name` varchar(255) NOT NULL COMMENT 'Имя раздела',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Таблица Дерево социальных разделов';
