-- EMS SQL Manager
-- Table: bookmarks - Таблица комментариев к закладкам

CREATE TABLE `bookmarks_comments` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'ID пользователя, написавшего комментарий',
  `avatar_id` int(11) NOT NULL COMMENT 'ID аватара',
  `warning_id` int(11) NOT NULL COMMENT 'ID предупреждения, если оно было',
  `bookmark_id` int(11) NOT NULL COMMENT 'ID закладки',
  `text` text NOT NULL COMMENT 'Текст комментария',
  `mood` varchar(100) default NULL COMMENT 'Настроение автора',
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата создания коментария',
  `adm_redacted` tinyint(4) NOT NULL default '0' COMMENT 'Отредактирован ли администратором',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Таблица комментариев к закладкам';
