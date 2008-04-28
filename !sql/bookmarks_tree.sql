-- EMS SQL Manager
-- Table: bookmarks - ������� ��������

CREATE TABLE `bookmarks_tree` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `parent_id` int(11) NOT NULL default '0' COMMENT 'ID ��������. ������ � ������ ����� 2.',
  `user_id` int(11) NOT NULL COMMENT 'ID ������������, ������� ������� ������',
  `name` varchar(100) NOT NULL COMMENT '��� �������',
  `active` tinyint(4) NOT NULL default '0' COMMENT '������� �� ������. ���� ����� ��� ����������� ���������.',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='������� ������ ��������';