-- EMS SQL Manager
-- Table: ������� ���������� ��������

CREATE TABLE `social_pos` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `social_tree_id` int(11) NOT NULL default '0' COMMENT 'ID.������ � ������',
  `user_id` int(11) NOT NULL default '0' COMMENT 'ID ������������, ����������� �������',
  `name` varchar(255) NOT NULL COMMENT '��������� �������',
  `creation_date` datetime NOT NULL COMMENT '���� �������� �������',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='������� ���������� ��������';
