-- EMS SQL Manager
-- Table: ������ �� �������, ��� �������������� ���������� �����������

CREATE TABLE `social_votes` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `social_pos_id` int NOT NULL COMMENT 'social_pos.ID �������',
  `user_id` int NOT NULL COMMENT 'user.ID ������������',
  `ip` varchar(255) NOT NULL COMMENT 'IP ������������',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='������ �� �������, ��� �������������� ���������� �����������';
