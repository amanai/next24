-- EMS SQL Manager
-- Table: Критерии оценки социальной позиции

CREATE TABLE `social_criteria` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `name` varchar(255) NOT NULL COMMENT 'Имя критерия (например, "производительность")',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Критерии оценки социальной позиции';
