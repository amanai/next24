-- EMS SQL Manager
-- Table: �����-������� ��� ����� ��������� � ��������� ������ ������� � ���� ����������

CREATE TABLE `social_tree_criteria` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `social_tree_id` int NOT NULL COMMENT 'social_tree.ID ������� � ������',
  `social_criteria_id` int NOT NULL COMMENT 'social_criteria.ID ��������',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='�����-������� ��� ����� ���������(social_tree) � ��������� ������(social_criteria) ������� � ���� ����������';
