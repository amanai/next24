-- EMS SQL Manager
-- Table: Кросс-таблица для связи категорий и критериев оценки позиций в этих категориях

CREATE TABLE `social_tree_criteria` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `social_tree_id` int NOT NULL COMMENT 'social_tree.ID раздела в дереве',
  `social_criteria_id` int NOT NULL COMMENT 'social_criteria.ID критерия',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Кросс-таблица для связи категорий(social_tree) и критериев оценки(social_criteria) позиций в этих категориях';
