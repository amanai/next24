-- EMS SQL Manager
-- Table: Позиция социальных разделов

CREATE TABLE `social_pos` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `social_tree_id` int(11) NOT NULL default '0' COMMENT 'ID.Раздел в дереве',
  `user_id` int(11) NOT NULL default '0' COMMENT 'ID пользователя, добавившего позицию',
  `name` varchar(255) NOT NULL COMMENT 'Заголовок позиции',
  `creation_date` datetime NOT NULL COMMENT 'Дата создания позиции',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Позиция социальных разделов';
