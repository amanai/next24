CREATE TABLE `arbitration` (
  `id` bigint(20) NOT NULL auto_increment,
  `complaint_text` varchar(255) character set cp1251 default NULL,
  `user_id` bigint(20) default NULL,
  `complaint_on_user` bigint(20) default NULL,
  `arbitration_group_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE `arbitration_group` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) character set cp1251 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;