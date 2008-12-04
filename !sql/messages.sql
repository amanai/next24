CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL auto_increment,
  `header` varchar(255) character set cp1251 NOT NULL,
  `m_text` text character set cp1251 NOT NULL,
  `send_date` int(11) NOT NULL,
  `author_id` bigint(20) NOT NULL,
  `recipient_id` bigint(20) NOT NULL,
  `avatar_id` bigint(20) NOT NULL,
  `is_read` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;