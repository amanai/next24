-- EMS SQL Manager
-- Table: ������� ������������ � ���������� ��������

CREATE TABLE `social_comments` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'users.ID ������������, ����������� �����������',
  `avatar_id` int(11) NOT NULL COMMENT 'ID �������',
  `warning_id` int(11) NOT NULL COMMENT 'warning.ID ��������������, ���� ��� ����',
  `social_pos_id` int(11) NOT NULL COMMENT 'social_pos.ID �������',
  `text` text NOT NULL COMMENT '����� �����������',
  `mood` varchar(100) default NULL COMMENT '���������� ������',
  `creation_date` datetime NOT NULL COMMENT '���� �������� ����������',
  `adm_redacted` tinyint(4) NOT NULL default '0' COMMENT '�������������� �� ���������������',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='������� ������������ � ���������� ��������';
