-- EMS SQL Manager
-- Table: bookmarks - ������� ����� ��������

CREATE TABLE `bookmarks_tags` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `name` varchar(100) NOT NULL COMMENT '��� ����',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='������� ����� ��������';
