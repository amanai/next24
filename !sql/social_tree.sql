-- EMS SQL Manager
-- Table: ������� ������ ���������� ��������

CREATE TABLE `social_tree` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `parent_id` int(11) NOT NULL default '0' COMMENT 'ID ��������. ������ � ������ ����� 2.',
  `name` varchar(255) NOT NULL COMMENT '��� �������',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='������� ������ ���������� ��������';
