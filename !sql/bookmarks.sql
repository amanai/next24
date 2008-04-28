-- EMS SQL Manager
-- Table: bookmarks - Таблица закладок

CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'ID пользователя, добавившего закладку',
  `bookmarks_tree_id` int(11) NOT NULL COMMENT 'ID раздела в дереве закладок',
  `url` text NOT NULL COMMENT 'URL закладки',
  `title` varchar(255) NOT NULL COMMENT 'Заголовок закладки',
  `description` text COMMENT 'Описание закладки',
  `is_public` tinyint(4) NOT NULL default '0' COMMENT 'Публичная ли закладка',
  `creation_date` datetime NOT NULL COMMENT 'Дата создания закладки',
  `views` int(11) NOT NULL default '0' COMMENT 'Число просмотров закладки',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Таблица закладок';
