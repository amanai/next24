-- EMS SQL Manager
-- Table: bookmarks - Таблица тегов закладок

CREATE TABLE `bookmarks_tags` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `name` varchar(100) NOT NULL COMMENT 'Имя тега',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Таблица тегов закладок';
