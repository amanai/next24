-- EMS SQL Manager
-- Table: bookmarks - ������� ������������ � ���������

CREATE TABLE `bookmarks_comments` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'ID ������������, ����������� �����������',
  `avatar_id` int(11) NOT NULL COMMENT 'ID �������',
  `warning_id` int(11) NOT NULL COMMENT 'ID ��������������, ���� ��� ����',
  `bookmark_id` int(11) NOT NULL COMMENT 'ID ��������',
  `text` text NOT NULL COMMENT '����� �����������',
  `mood` varchar(100) default NULL COMMENT '���������� ������',
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '���� �������� ����������',
  `adm_redacted` tinyint(4) NOT NULL default '0' COMMENT '�������������� �� ���������������',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='������� ������������ � ���������';
