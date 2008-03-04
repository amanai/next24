-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Мар 04 2008 г., 11:11
-- Версия сервера: 5.0.45
-- Версия PHP: 5.2.4
-- 
-- БД: `next`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `action`
-- 

DROP TABLE IF EXISTS `action`;
CREATE TABLE `action` (
  `id` int(11) NOT NULL auto_increment,
  `controller_id` int(11) default NULL,
  `name` varchar(50) character set cp1251 default NULL,
  `default` int(1) default NULL,
  `page_title` varchar(255) default NULL,
  `request_key` varchar(80) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `Новый индекс` (`request_key`),
  KEY `controller_idIdx` (`controller_id`),
  KEY `nameIdx` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

-- 
-- Дамп данных таблицы `action`
-- 

INSERT INTO `action` VALUES (1, 1, 'Index', 1, NULL, 'home');
INSERT INTO `action` VALUES (2, 2, 'Index', 0, NULL, '');
INSERT INTO `action` VALUES (3, 2, 'Delete', NULL, NULL, NULL);
INSERT INTO `action` VALUES (4, 2, 'Edit', NULL, NULL, NULL);
INSERT INTO `action` VALUES (5, 2, 'Add', NULL, NULL, NULL);
INSERT INTO `action` VALUES (6, 2, 'Save', NULL, NULL, NULL);
INSERT INTO `action` VALUES (8, 3, 'Login', NULL, NULL, 'site_login');
INSERT INTO `action` VALUES (9, 3, 'Logout', NULL, NULL, 'site_logout');
INSERT INTO `action` VALUES (10, 4, 'Index', NULL, NULL, NULL);
INSERT INTO `action` VALUES (11, 4, 'Save', NULL, NULL, NULL);
INSERT INTO `action` VALUES (12, 3, 'Viewprofile', NULL, NULL, NULL);
INSERT INTO `action` VALUES (13, 7, 'CommentList', NULL, NULL, NULL);
INSERT INTO `action` VALUES (14, 3, 'PhotoAlbum', NULL, NULL, NULL);
INSERT INTO `action` VALUES (15, 8, 'LastList', NULL, NULL, 'last_albums');
INSERT INTO `action` VALUES (16, 8, 'TopList', NULL, NULL, 'top_albums');
INSERT INTO `action` VALUES (17, 9, 'TopList', NULL, NULL, NULL);
INSERT INTO `action` VALUES (18, 9, 'Album', NULL, NULL, 'albums_photo');
INSERT INTO `action` VALUES (19, 9, 'View', NULL, NULL, 'view_photo');
INSERT INTO `action` VALUES (20, 9, 'User', NULL, NULL, NULL);
INSERT INTO `action` VALUES (21, 8, 'User', NULL, NULL, NULL);
INSERT INTO `action` VALUES (22, 8, 'Create', NULL, NULL, NULL);
INSERT INTO `action` VALUES (23, 8, 'Upload', NULL, NULL, NULL);
INSERT INTO `action` VALUES (24, 8, 'Save', NULL, NULL, NULL);
INSERT INTO `action` VALUES (25, 8, 'UploadForm', NULL, NULL, 'upload_pic');
INSERT INTO `action` VALUES (26, 8, 'CreateForm', NULL, NULL, 'create_album');
INSERT INTO `action` VALUES (27, 8, 'Create', NULL, NULL, NULL);
INSERT INTO `action` VALUES (28, 8, 'List', NULL, NULL, 'albums');
INSERT INTO `action` VALUES (29, 9, 'Edit', NULL, NULL, 'edit_photo');
INSERT INTO `action` VALUES (30, 9, 'Comment', NULL, NULL, 'comment_photo');
INSERT INTO `action` VALUES (31, 8, 'ListSave', NULL, NULL, NULL);
INSERT INTO `action` VALUES (32, 9, 'RatePhoto', NULL, NULL, 'vote_photo');
INSERT INTO `action` VALUES (33, 9, 'CommentDelete', NULL, NULL, 'del_photo_comment');
INSERT INTO `action` VALUES (34, 9, 'Save', NULL, NULL, NULL);
INSERT INTO `action` VALUES (35, 10, 'Edit', NULL, NULL, NULL);
INSERT INTO `action` VALUES (36, 10, 'Save', NULL, NULL, NULL);
INSERT INTO `action` VALUES (37, 10, 'EditBranch', NULL, NULL, NULL);
INSERT INTO `action` VALUES (38, 10, 'SaveBranch', NULL, NULL, NULL);
INSERT INTO `action` VALUES (39, 10, 'Post', NULL, NULL, NULL);
INSERT INTO `action` VALUES (40, 10, 'Comments', NULL, NULL, NULL);
INSERT INTO `action` VALUES (41, 10, 'SaveComment', NULL, NULL, NULL);
INSERT INTO `action` VALUES (42, 10, 'EditComment', NULL, NULL, NULL);
INSERT INTO `action` VALUES (43, 10, 'DeleteComment', NULL, NULL, NULL);
INSERT INTO `action` VALUES (44, 10, 'PostEdit', NULL, NULL, NULL);
INSERT INTO `action` VALUES (45, 10, 'PostSave', NULL, NULL, NULL);
INSERT INTO `action` VALUES (46, 10, 'PostDelete', NULL, NULL, NULL);
INSERT INTO `action` VALUES (47, 11, 'Login', NULL, NULL, 'login');
INSERT INTO `action` VALUES (48, 11, 'LoginForm', NULL, NULL, 'loginform');
INSERT INTO `action` VALUES (49, 11, 'Desktop', 1, NULL, 'desktop');
INSERT INTO `action` VALUES (50, 11, 'Logout', NULL, NULL, 'logout');
INSERT INTO `action` VALUES (51, 12, 'GroupList', 1, NULL, 'param_group_list');
INSERT INTO `action` VALUES (52, 12, 'EditGroup', NULL, NULL, 'admin_edit_group');
INSERT INTO `action` VALUES (53, 12, 'SaveParams', NULL, NULL, 'admin_save_param');
INSERT INTO `action` VALUES (54, 12, 'DeleteParam', NULL, NULL, 'admin_del_param');
INSERT INTO `action` VALUES (55, 13, 'Delete', NULL, NULL, 'admin_user_delete');
INSERT INTO `action` VALUES (56, 13, 'List', NULL, NULL, 'admin_user_list');
INSERT INTO `action` VALUES (57, 13, 'Edit', NULL, NULL, 'admin_user_edit');
INSERT INTO `action` VALUES (58, 13, 'Save', NULL, NULL, 'admin_user_save');
INSERT INTO `action` VALUES (59, 14, 'List', 1, NULL, 'admin_user_group');
INSERT INTO `action` VALUES (60, 14, 'Edit', NULL, NULL, 'admin_user_group_edit');
INSERT INTO `action` VALUES (61, 14, 'Save', NULL, NULL, 'admin_user_group_save');
INSERT INTO `action` VALUES (62, 14, 'Controllers', NULL, NULL, 'admin_group_controllers');
INSERT INTO `action` VALUES (63, 14, 'ActionList', NULL, NULL, 'admin_group_action_list');
INSERT INTO `action` VALUES (64, 14, 'ChangeAccess', NULL, NULL, 'admin_user_change_access');
INSERT INTO `action` VALUES (65, 3, 'Profile', NULL, NULL, 'user_profile');
INSERT INTO `action` VALUES (67, 15, 'List', NULL, 'Вопросы-ответы', 'user_questions');
INSERT INTO `action` VALUES (68, 15, 'ViewQuestion', NULL, 'Вопрос пользователя', 'view_question');
INSERT INTO `action` VALUES (69, 15, 'AnswerDelete', NULL, 'Удалить ответ', 'delete_answer');
        