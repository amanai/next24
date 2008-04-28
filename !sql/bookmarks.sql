-- EMS SQL Manager
-- Table: bookmarks - ������� ��������

CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'ID ������������, ����������� ��������',
  `bookmarks_tree_id` int(11) NOT NULL COMMENT 'ID ������� � ������ ��������',
  `url` text NOT NULL COMMENT 'URL ��������',
  `title` varchar(255) NOT NULL COMMENT '��������� ��������',
  `description` text COMMENT '�������� ��������',
  `is_public` tinyint(4) NOT NULL default '0' COMMENT '��������� �� ��������',
  `creation_date` datetime NOT NULL COMMENT '���� �������� ��������',
  `views` int(11) NOT NULL default '0' COMMENT '����� ���������� ��������',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='������� ��������';
