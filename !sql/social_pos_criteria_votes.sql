-- EMS SQL Manager
-- Table: Таблица связи позиции с критерием и голосами по критерию

CREATE TABLE `social_pos_criteria_votes` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `social_pos_id` int NOT NULL COMMENT 'social_pos.ID позиции',
  `social_criteria_id` int NOT NULL COMMENT 'social_criteria.ID критерия привязаного к позиции',
  `votes_sum` int NOT NULL COMMENT 'Общая сумма оценок этого критерия этой позиции',
  `votes_count` int NOT NULL COMMENT 'Общее число оценок',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Таблица связи позиции(social_pos) с критерием(social_criteria) и голосами по критерию';
