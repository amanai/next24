-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Мар 04 2008 г., 11:12
-- Версия сервера: 5.0.45
-- Версия PHP: 5.2.4
-- 
-- БД: `next`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `user_right`
-- 

DROP TABLE IF EXISTS `user_right`;
CREATE TABLE `user_right` (
  `id` int(11) NOT NULL auto_increment,
  `user_type_id` int(11) default NULL,
  `controller_id` int(11) default NULL,
  `action_id` int(11) default NULL,
  `subaction_id` int(11) default NULL,
  `access` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=97 DEFAULT CHARSET=utf8 AUTO_INCREMENT=97 ;

-- 
-- Дамп данных таблицы `user_right`
-- 

INSERT INTO `user_right` VALUES (1, 0, 11, 48, NULL, 1);
INSERT INTO `user_right` VALUES (2, 0, 11, 47, NULL, 1);
INSERT INTO `user_right` VALUES (3, 1, 11, 49, NULL, 1);
INSERT INTO `user_right` VALUES (4, 1, 11, 50, NULL, 1);
INSERT INTO `user_right` VALUES (5, 1, 14, 59, NULL, 1);
INSERT INTO `user_right` VALUES (6, 1, 14, 60, NULL, 1);
INSERT INTO `user_right` VALUES (7, 1, 14, 61, NULL, 1);
INSERT INTO `user_right` VALUES (8, 1, 14, 62, NULL, 1);
INSERT INTO `user_right` VALUES (9, 1, 14, 63, NULL, 1);
INSERT INTO `user_right` VALUES (10, 1, 14, 64, NULL, 1);
INSERT INTO `user_right` VALUES (11, 0, 14, 60, NULL, 1);
INSERT INTO `user_right` VALUES (12, 0, 14, 61, NULL, 0);
INSERT INTO `user_right` VALUES (13, 0, 9, 20, NULL, 1);
INSERT INTO `user_right` VALUES (14, 0, 9, 29, NULL, 1);
INSERT INTO `user_right` VALUES (15, 0, 9, 30, NULL, 1);
INSERT INTO `user_right` VALUES (16, 1, 8, 21, NULL, 1);
INSERT INTO `user_right` VALUES (17, 1, 8, 22, NULL, 1);
INSERT INTO `user_right` VALUES (18, 1, 8, 23, NULL, 1);
INSERT INTO `user_right` VALUES (19, 1, 8, 24, NULL, 1);
INSERT INTO `user_right` VALUES (20, 1, 8, 16, NULL, 1);
INSERT INTO `user_right` VALUES (21, 1, 8, 15, NULL, 1);
INSERT INTO `user_right` VALUES (22, 1, 13, 55, NULL, 1);
INSERT INTO `user_right` VALUES (23, 1, 13, 56, NULL, 1);
INSERT INTO `user_right` VALUES (24, 1, 13, 57, NULL, 1);
INSERT INTO `user_right` VALUES (25, 1, 13, 58, NULL, 1);
INSERT INTO `user_right` VALUES (26, 0, 7, 13, NULL, 1);
INSERT INTO `user_right` VALUES (27, 0, 10, 35, NULL, 1);
INSERT INTO `user_right` VALUES (28, 0, 10, 38, NULL, 1);
INSERT INTO `user_right` VALUES (29, 0, 10, 39, NULL, 1);
INSERT INTO `user_right` VALUES (30, 0, 10, 41, NULL, 1);
INSERT INTO `user_right` VALUES (31, 0, 10, 42, NULL, 1);
INSERT INTO `user_right` VALUES (32, 0, 1, 1, NULL, 1);
INSERT INTO `user_right` VALUES (33, 0, 4, 10, NULL, 1);
INSERT INTO `user_right` VALUES (34, 0, 3, 8, NULL, 1);
INSERT INTO `user_right` VALUES (35, 0, 3, 9, NULL, 1);
INSERT INTO `user_right` VALUES (36, 0, 3, 12, NULL, 1);
INSERT INTO `user_right` VALUES (37, 0, 3, 14, NULL, 1);
INSERT INTO `user_right` VALUES (38, 1, 12, 51, NULL, 1);
INSERT INTO `user_right` VALUES (39, 1, 12, 52, NULL, 1);
INSERT INTO `user_right` VALUES (40, 1, 12, 53, NULL, 1);
INSERT INTO `user_right` VALUES (41, 1, 12, 54, NULL, 1);
INSERT INTO `user_right` VALUES (42, 1, 7, 13, NULL, 0);
INSERT INTO `user_right` VALUES (43, 1, 9, 17, NULL, 1);
INSERT INTO `user_right` VALUES (44, 1, 9, 18, NULL, 1);
INSERT INTO `user_right` VALUES (45, 1, 9, 19, NULL, 1);
INSERT INTO `user_right` VALUES (46, 1, 9, 20, NULL, 1);
INSERT INTO `user_right` VALUES (47, 1, 9, 29, NULL, 1);
INSERT INTO `user_right` VALUES (48, 1, 9, 30, NULL, 1);
INSERT INTO `user_right` VALUES (49, 1, 9, 32, NULL, 1);
INSERT INTO `user_right` VALUES (50, 1, 9, 33, NULL, 1);
INSERT INTO `user_right` VALUES (51, 1, 9, 34, NULL, 1);
INSERT INTO `user_right` VALUES (52, 1, 8, 25, NULL, 1);
INSERT INTO `user_right` VALUES (53, 1, 8, 26, NULL, 1);
INSERT INTO `user_right` VALUES (54, 1, 8, 27, NULL, 1);
INSERT INTO `user_right` VALUES (55, 1, 8, 28, NULL, 1);
INSERT INTO `user_right` VALUES (56, 1, 8, 31, NULL, 1);
INSERT INTO `user_right` VALUES (57, 0, 2, 3, NULL, 0);
INSERT INTO `user_right` VALUES (58, 0, 2, 5, NULL, 0);
INSERT INTO `user_right` VALUES (59, 1, 1, 1, NULL, 1);
INSERT INTO `user_right` VALUES (60, 1, 3, 8, NULL, 1);
INSERT INTO `user_right` VALUES (61, 1, 3, 9, NULL, 1);
INSERT INTO `user_right` VALUES (62, 1, 3, 12, NULL, 1);
INSERT INTO `user_right` VALUES (63, 1, 3, 65, NULL, 1);
INSERT INTO `user_right` VALUES (64, 1, 3, 14, NULL, 1);
INSERT INTO `user_right` VALUES (65, 0, 9, 34, NULL, 1);
INSERT INTO `user_right` VALUES (66, 0, 9, 33, NULL, 1);
INSERT INTO `user_right` VALUES (67, 0, 9, 32, NULL, 1);
INSERT INTO `user_right` VALUES (68, 0, 9, 18, NULL, 1);
INSERT INTO `user_right` VALUES (69, 0, 9, 17, NULL, 1);
INSERT INTO `user_right` VALUES (70, 0, 9, 19, NULL, 1);
INSERT INTO `user_right` VALUES (71, 0, 3, 65, NULL, 1);
INSERT INTO `user_right` VALUES (72, 0, 8, 15, NULL, 1);
INSERT INTO `user_right` VALUES (73, 0, 8, 16, NULL, 1);
INSERT INTO `user_right` VALUES (74, 0, 8, 21, NULL, 1);
INSERT INTO `user_right` VALUES (75, 0, 8, 22, NULL, 1);
INSERT INTO `user_right` VALUES (76, 0, 8, 23, NULL, 1);
INSERT INTO `user_right` VALUES (77, 0, 8, 24, NULL, 1);
INSERT INTO `user_right` VALUES (78, 0, 8, 25, NULL, 1);
INSERT INTO `user_right` VALUES (79, 0, 8, 26, NULL, 1);
INSERT INTO `user_right` VALUES (80, 0, 8, 27, NULL, 1);
INSERT INTO `user_right` VALUES (81, 0, 8, 28, NULL, 1);
INSERT INTO `user_right` VALUES (82, 0, 8, 31, NULL, 1);
INSERT INTO `user_right` VALUES (83, 0, 10, 36, NULL, 1);
INSERT INTO `user_right` VALUES (84, 0, 10, 37, NULL, 1);
INSERT INTO `user_right` VALUES (85, 0, 10, 40, NULL, 1);
INSERT INTO `user_right` VALUES (86, 0, 10, 43, NULL, 1);
INSERT INTO `user_right` VALUES (87, 0, 10, 44, NULL, 1);
INSERT INTO `user_right` VALUES (88, 0, 10, 45, NULL, 1);
INSERT INTO `user_right` VALUES (89, 0, 10, 46, NULL, 1);
INSERT INTO `user_right` VALUES (90, 0, 15, 67, NULL, 1);
INSERT INTO `user_right` VALUES (91, 1, 15, 67, NULL, 1);
INSERT INTO `user_right` VALUES (92, 0, 15, 68, NULL, 1);
INSERT INTO `user_right` VALUES (93, 1, 15, 68, NULL, 1);
INSERT INTO `user_right` VALUES (94, 1, 15, 69, NULL, 1);
        