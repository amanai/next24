-- EMS SQL Manager
-- Table: �������� ������ ���������� �������

CREATE TABLE `social_criteria` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `name` varchar(255) NOT NULL COMMENT '��� �������� (��������, "������������������")',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='�������� ������ ���������� �������';
