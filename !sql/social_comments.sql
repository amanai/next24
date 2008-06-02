-- EMS SQL Manager
-- Table: Таблица комментариев к социальным позициям

CREATE TABLE `social_comments` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'users.ID пользователя, написавшего комментарий',
  `avatar_id` int(11) NOT NULL COMMENT 'ID аватара',
  `warning_id` int(11) NOT NULL COMMENT 'warning.ID предупреждения, если оно было',
  `social_pos_id` int(11) NOT NULL COMMENT 'social_pos.ID позиции',
  `text` text NOT NULL COMMENT 'Текст комментария',
  `mood` varchar(100) default NULL COMMENT 'Настроение автора',
  `creation_date` datetime NOT NULL COMMENT 'Дата создания коментария',
  `adm_redacted` tinyint(4) NOT NULL default '0' COMMENT 'Отредактирован ли администратором',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Таблица комментариев к социальным позициям';
