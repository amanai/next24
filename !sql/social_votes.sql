-- EMS SQL Manager
-- Table: Голоса за позиции, для предотвращения повторного голосования

CREATE TABLE `social_votes` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `social_pos_id` int NOT NULL COMMENT 'social_pos.ID позиции',
  `user_id` int NOT NULL COMMENT 'user.ID пользователя',
  `ip` varchar(255) NOT NULL COMMENT 'IP пользователя',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Голоса за позиции, для предотвращения повторного голосования';
