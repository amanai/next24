-- EMS SQL Manager
-- Table: ������� ����� ������� � ��������� � �������� �� ��������

CREATE TABLE `social_pos_criteria_votes` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `social_pos_id` int NOT NULL COMMENT 'social_pos.ID �������',
  `social_criteria_id` int NOT NULL COMMENT 'social_criteria.ID �������� ����������� � �������',
  `votes_sum` int NOT NULL COMMENT '����� ����� ������ ����� �������� ���� �������',
  `votes_count` int NOT NULL COMMENT '����� ����� ������',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='������� ����� �������(social_pos) � ���������(social_criteria) � �������� �� ��������';
