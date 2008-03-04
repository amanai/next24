-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Мар 04 2008 г., 12:02
-- Версия сервера: 5.0.45
-- Версия PHP: 5.2.4
-- 
-- БД: `next24`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `action`
-- 

DROP TABLE IF EXISTS `action`;
CREATE TABLE IF NOT EXISTS `action` (
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

-- --------------------------------------------------------

-- 
-- Структура таблицы `album`
-- 

DROP TABLE IF EXISTS `album`;
CREATE TABLE IF NOT EXISTS `album` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL,
  `thumbnail_id` bigint(20) NOT NULL,
  `name` varchar(255) character set cp1251 NOT NULL,
  `access` tinyint(4) NOT NULL,
  `is_onmain` tinyint(4) NOT NULL,
  `creation_date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- 
-- Дамп данных таблицы `album`
-- 

INSERT INTO `album` VALUES (1, 2, 10, 'Осень2', 2, 1, '2008-01-14 21:00:00');
INSERT INTO `album` VALUES (3, 2, 3, 'Мои фото', 1, 1, '2008-01-14 21:20:35');
INSERT INTO `album` VALUES (5, 1, 5, 'Весна', 1, 1, '2008-01-17 00:00:00');
INSERT INTO `album` VALUES (7, 1, 15, 'Зима', 2, 1, '2008-01-23 03:21:22');
INSERT INTO `album` VALUES (8, 1, 20, 'Лето', 0, 1, '2008-01-23 03:21:28');
INSERT INTO `album` VALUES (9, 1, 23, 'йцйцуцйу', 2, 1, '2008-02-08 01:43:25');

-- --------------------------------------------------------

-- 
-- Структура таблицы `answers`
-- 

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` bigint(20) NOT NULL auto_increment,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text character set utf8,
  `creation_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=4 ;

-- 
-- Дамп данных таблицы `answers`
-- 

INSERT INTO `answers` VALUES (1, 1, 1, 'Ответ 1', '2008-03-02');
INSERT INTO `answers` VALUES (2, 2, 1, 'Ответ 2', '2008-03-02');
INSERT INTO `answers` VALUES (3, 1, 1, 'Ответ 3', '2008-03-02');

-- --------------------------------------------------------

-- 
-- Структура таблицы `ban_history`
-- 

DROP TABLE IF EXISTS `ban_history`;
CREATE TABLE IF NOT EXISTS `ban_history` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `banned_by` int(11) default NULL,
  `warning_id` int(11) default NULL,
  `banned_date` datetime default NULL,
  `banned_till` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `ban_history`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `bc_tags`
-- 

DROP TABLE IF EXISTS `bc_tags`;
CREATE TABLE IF NOT EXISTS `bc_tags` (
  `id` bigint(20) NOT NULL auto_increment,
  `blogs_catalog_id` bigint(20) NOT NULL,
  `name` varchar(255) character set cp1251 NOT NULL,
  `posts_num` bigint(20) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `sortfield` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `bc_tags`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `blog_comments`
-- 

DROP TABLE IF EXISTS `blog_comments`;
CREATE TABLE IF NOT EXISTS `blog_comments` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL,
  `avatar_id` bigint(20) NOT NULL,
  `warning_id` bigint(20) NOT NULL,
  `blog_post_id` bigint(20) NOT NULL,
  `text` text character set cp1251 NOT NULL,
  `mood` varchar(100) character set cp1251 NOT NULL,
  `creation_date` datetime NOT NULL,
  `adm_redacted` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

-- 
-- Дамп данных таблицы `blog_comments`
-- 

INSERT INTO `blog_comments` VALUES (3, 2, 0, 0, 1, 'dsa\r\n32r23r', '23', '2008-01-01 00:00:00', 0);
INSERT INTO `blog_comments` VALUES (6, 1, 0, 0, 1, 'asdf23r', '0', '2008-02-05 02:28:17', 0);
INSERT INTO `blog_comments` VALUES (8, 1, 0, 0, 1, 'g34g45g', '0', '2008-02-05 02:28:21', 0);
INSERT INTO `blog_comments` VALUES (9, 1, 0, 0, 1, 'фыв234к', '0', '2008-02-05 02:31:42', 0);
INSERT INTO `blog_comments` VALUES (10, 1, 0, 0, 1, 'ацуцу', '0', '2008-02-05 02:31:47', 0);
INSERT INTO `blog_comments` VALUES (12, 1, 0, 0, 1, '23445еп45рп54р6', '0', '2008-02-05 02:33:53', 0);
INSERT INTO `blog_comments` VALUES (13, 1, 0, 0, 1, 'цукцук', '0', '2008-02-05 02:35:13', 0);
INSERT INTO `blog_comments` VALUES (14, 1, 0, 0, 1, 'фук23', '0', '2008-02-05 02:35:16', 0);
INSERT INTO `blog_comments` VALUES (15, 1, 0, 0, 1, '23423423423423423', '0', '2008-02-05 02:35:19', 0);
INSERT INTO `blog_comments` VALUES (16, 1, 0, 0, 1, 'ыцаца', '0', '2008-02-05 02:35:22', 0);
INSERT INTO `blog_comments` VALUES (17, 1, 0, 0, 1, '23423к', '0', '2008-02-05 02:35:24', 0);
INSERT INTO `blog_comments` VALUES (18, 1, 0, 0, 3, 'фыв32ук32к23', '0', '2008-02-05 02:39:20', 0);
INSERT INTO `blog_comments` VALUES (19, 1, 0, 0, 3, 'ва34е45', '0', '2008-02-05 02:39:21', 0);
INSERT INTO `blog_comments` VALUES (21, 1, 0, 0, 1, '3r23r23', '0', '2008-02-05 02:44:05', 0);
INSERT INTO `blog_comments` VALUES (24, 1, 0, 0, 9, 'sdfsdf', '0', '2008-02-05 03:34:46', 0);
INSERT INTO `blog_comments` VALUES (25, 1, 0, 0, 1, 'weqwe', '0', '2008-02-08 19:34:24', 0);
INSERT INTO `blog_comments` VALUES (26, 1, 0, 0, 3, 'алексей', '0', '2008-02-15 01:43:11', 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `blog_posts`
-- 

DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` bigint(20) NOT NULL auto_increment,
  `blog_id` bigint(20) NOT NULL,
  `ub_tree_id` bigint(20) NOT NULL,
  `bc_tags_id` bigint(20) NOT NULL,
  `title` varchar(255) character set cp1251 NOT NULL,
  `small_text` text character set cp1251 NOT NULL,
  `full_text` text character set cp1251 NOT NULL,
  `creation_date` date NOT NULL,
  `access` tinyint(4) NOT NULL,
  `allowcomments` tinyint(4) NOT NULL,
  `comments` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `mood` varchar(100) character set cp1251 NOT NULL,
  `avatar_id` bigint(20) NOT NULL,
  `creation_ip` varchar(15) character set cp1251 NOT NULL,
  `bbp_status` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- 
-- Дамп данных таблицы `blog_posts`
-- 

INSERT INTO `blog_posts` VALUES (1, 1, 1, 0, 'post1', 'smal text', 'sdfs\r\nfwer\r\ng34g\r\n5r\r\ng45\r\nh45\r\nh45', '2008-01-01', 1, 1, 13, 42, '3', 1, '127.0.0.1', 1);
INSERT INTO `blog_posts` VALUES (3, 1, 18, 0, 'post35543434', '2323assdfvdf', '0f234fr34ft34', '2008-02-08', 1, 1, 2, 15, '2', 0, '127.0.0.1', 0);
INSERT INTO `blog_posts` VALUES (4, 1, 1, 0, 'post 4', 'asd', 'ft34t3434t34', '2008-01-04', 1, 1, 1, 1, '1', 1, '127.0.0.1', 1);
INSERT INTO `blog_posts` VALUES (5, 1, 1, 0, 'post 4', 'asd', 'ft34t3434t34', '2008-01-04', 1, 1, 0, 1, '1', 1, '127.0.0.1', 1);
INSERT INTO `blog_posts` VALUES (8, 1, 18, 0, 'sdfdsf', 'sdf34ft', '34tr34', '2008-02-05', 2, 1, 0, 0, '1', 0, '127.0.0.1', 1);
INSERT INTO `blog_posts` VALUES (9, 1, 2, 0, 'pppp23', 'dsf', '423r', '2008-02-05', 2, 1, 1, 2, '2', 0, '127.0.0.1', 1);

-- --------------------------------------------------------

-- 
-- Структура таблицы `blogs`
-- 

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL,
  `title` varchar(255) character set cp1251 NOT NULL,
  `access` tinyint(4) NOT NULL,
  `creation_date` date NOT NULL,
  `creation_ip` varchar(15) character set cp1251 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `blogs`
-- 

INSERT INTO `blogs` VALUES (1, 1, 'Мой блог', 1, '2008-01-30', '127.0.0.1');

-- --------------------------------------------------------

-- 
-- Структура таблицы `blogs_catalog`
-- 

DROP TABLE IF EXISTS `blogs_catalog`;
CREATE TABLE IF NOT EXISTS `blogs_catalog` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) character set cp1251 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- 
-- Дамп данных таблицы `blogs_catalog`
-- 

INSERT INTO `blogs_catalog` VALUES (1, 'Кат 1');
INSERT INTO `blogs_catalog` VALUES (2, 'Кат 1.1');
INSERT INTO `blogs_catalog` VALUES (3, 'Кат 1.2');
INSERT INTO `blogs_catalog` VALUES (4, 'Кат 2');
INSERT INTO `blogs_catalog` VALUES (5, 'Кат 3');
INSERT INTO `blogs_catalog` VALUES (6, 'Кат 4');
INSERT INTO `blogs_catalog` VALUES (7, 'Кат 4.1');
INSERT INTO `blogs_catalog` VALUES (8, 'Кат 4.2');
INSERT INTO `blogs_catalog` VALUES (9, 'Кат 4.3');

-- --------------------------------------------------------

-- 
-- Структура таблицы `controller`
-- 

DROP TABLE IF EXISTS `controller`;
CREATE TABLE IF NOT EXISTS `controller` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) character set cp1251 default NULL,
  `description` varchar(255) character set cp1251 default NULL,
  `request_key` varchar(80) default NULL,
  `admin` int(1) default NULL,
  `default` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- 
-- Дамп данных таблицы `controller`
-- 

INSERT INTO `controller` VALUES (1, 'IndexController', 'Непонятно какой', 'Index', 0, 1);
INSERT INTO `controller` VALUES (2, 'TestController', 'Тестовый', 'Test', 0, NULL);
INSERT INTO `controller` VALUES (3, 'UserController', 'Управление профилем пользователя', 'User', 0, NULL);
INSERT INTO `controller` VALUES (4, 'RightsController', 'Управление правами', 'Rights', 0, NULL);
INSERT INTO `controller` VALUES (7, 'PhotoCommentController', 'Комментарии к фотоальбомам', 'PhotoComment', 0, NULL);
INSERT INTO `controller` VALUES (8, 'AlbumController', 'Фотоальбомы', 'Album', 0, NULL);
INSERT INTO `controller` VALUES (9, 'PhotoController', 'Фотографии фотоальбомов', 'Photo', 0, NULL);
INSERT INTO `controller` VALUES (10, 'BlogController', 'Блоги', 'Blog', 0, NULL);
INSERT INTO `controller` VALUES (11, 'AdminController', 'Администрирование', 'Admin', 1, 0);
INSERT INTO `controller` VALUES (12, 'AdminParameterController', 'Управление параметрами конфигурации', 'AdminParameter', 1, NULL);
INSERT INTO `controller` VALUES (13, 'AdminUserController', 'Управление пользователями системы', 'AdminUser', 1, NULL);
INSERT INTO `controller` VALUES (14, 'UserTypeController', 'Управление группами пользователей', 'UserType', 1, NULL);
INSERT INTO `controller` VALUES (15, 'QuestionAnswerController', 'Вопросы-ответы', 'QuestionAnswer', 0, NULL);

-- --------------------------------------------------------

-- 
-- Структура таблицы `friend`
-- 

DROP TABLE IF EXISTS `friend`;
CREATE TABLE IF NOT EXISTS `friend` (
  `id` bigint(20) NOT NULL auto_increment,
  `friend_id` bigint(20) NOT NULL,
  `group_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `note` varchar(100) NOT NULL,
  `is_mutual` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `friend`
-- 

INSERT INTO `friend` VALUES (1, 2, 0, 1, 'мой друг', 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `friend_group`
-- 

DROP TABLE IF EXISTS `friend_group`;
CREATE TABLE IF NOT EXISTS `friend_group` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `editable` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `friend_group`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `moods`
-- 

DROP TABLE IF EXISTS `moods`;
CREATE TABLE IF NOT EXISTS `moods` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(100) character set cp1251 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Дамп данных таблицы `moods`
-- 

INSERT INTO `moods` VALUES (1, 1, 'Ок');
INSERT INTO `moods` VALUES (2, 1, 'ммм');
INSERT INTO `moods` VALUES (3, 1, 'фак');

-- --------------------------------------------------------

-- 
-- Структура таблицы `option_data`
-- 

DROP TABLE IF EXISTS `option_data`;
CREATE TABLE IF NOT EXISTS `option_data` (
  `Id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `option_data`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `param`
-- 

DROP TABLE IF EXISTS `param`;
CREATE TABLE IF NOT EXISTS `param` (
  `id` int(11) NOT NULL auto_increment,
  `param_group_id` int(11) default NULL,
  `name` varchar(50) character set cp1251 default NULL,
  `value` text character set cp1251,
  `php_type` varchar(40) character set cp1251 default NULL COMMENT 'string, float, integer, array, boolean. default - string',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

-- 
-- Дамп данных таблицы `param`
-- 

INSERT INTO `param` VALUES (1, 1, 'param_x', '3341', 'integer');
INSERT INTO `param` VALUES (4, 2, 'param1', '333str', 'string');
INSERT INTO `param` VALUES (28, 1, 'param_y', '34.23', 'float');
INSERT INTO `param` VALUES (29, 0, 'asdsad', '23', 'string');
INSERT INTO `param` VALUES (31, 9, 'param_x', '10', 'integer');
INSERT INTO `param` VALUES (34, 8, 'album_per_page', '2', 'integer');
INSERT INTO `param` VALUES (35, 8, 'top_per_page', '12', 'integer');
INSERT INTO `param` VALUES (36, 4, 'comment_per_page', '2', 'integer');

-- --------------------------------------------------------

-- 
-- Структура таблицы `param_group`
-- 

DROP TABLE IF EXISTS `param_group`;
CREATE TABLE IF NOT EXISTS `param_group` (
  `id` int(11) NOT NULL auto_increment,
  `label` varchar(80) character set cp1251 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- 
-- Дамп данных таблицы `param_group`
-- 

INSERT INTO `param_group` VALUES (1, 'BlogController');
INSERT INTO `param_group` VALUES (2, 'Controller2');
INSERT INTO `param_group` VALUES (3, 'IndexController');
INSERT INTO `param_group` VALUES (4, 'PhotoController');
INSERT INTO `param_group` VALUES (5, 'AdminParameterController');
INSERT INTO `param_group` VALUES (6, 'RightsController');
INSERT INTO `param_group` VALUES (7, 'PhotoCommentController');
INSERT INTO `param_group` VALUES (8, 'AlbumController');
INSERT INTO `param_group` VALUES (9, 'AdminController');
INSERT INTO `param_group` VALUES (10, 'TestController');
INSERT INTO `param_group` VALUES (11, 'UserController');
INSERT INTO `param_group` VALUES (12, 'QuestionAnswerController');

-- --------------------------------------------------------

-- 
-- Структура таблицы `photo`
-- 

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL,
  `album_id` bigint(20) NOT NULL,
  `name` varchar(255) character set cp1251 NOT NULL,
  `path` varchar(255) character set cp1251 NOT NULL,
  `thumbnail` varchar(255) character set cp1251 NOT NULL,
  `is_rating` tinyint(4) NOT NULL,
  `is_onmain` tinyint(4) NOT NULL,
  `access` tinyint(4) NOT NULL,
  `voices` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `creation_date` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `album_id` (`album_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

-- 
-- Дамп данных таблицы `photo`
-- 

INSERT INTO `photo` VALUES (1, 1, 1, 'осень22', 'asd', 'as', 1, 1, 1, 1, 2, '2008-01-21 14:20:12');
INSERT INTO `photo` VALUES (3, 2, 3, 'моя фотка', 'wewer', 'er43', 1, 1, 0, 0, 0, '2008-01-21 14:21:12');
INSERT INTO `photo` VALUES (7, 1, 1, 'asasd3', '387cd1fec97b13b1beaa786f33fe2dd5.jpg', '', 0, 1, 1, 0, 0, '2008-01-22 20:26:06');
INSERT INTO `photo` VALUES (10, 1, 1, '', '72ae57b683699af82beb8ac09b5dfd9f.jpg', '', 1, 1, 2, 0, 0, '2008-01-22 20:32:40');
INSERT INTO `photo` VALUES (13, 2, 3, 'a', 'adf', 'dasf', 1, 1, 1, 0, 0, '2008-01-02 00:00:00');
INSERT INTO `photo` VALUES (15, 1, 7, 'М2', 'dca3c730965beac6703ac73758a0259d.jpg', '', 0, 0, 2, 0, 0, '2008-01-23 03:29:53');
INSERT INTO `photo` VALUES (17, 1, 9, '12', 'b2f4bf92d7042c6304563dd0b3daaf71.jpg', 'b2f4bf92d7042c6304563dd0b3daaf71.jpg', 1, 1, 1, 2, -2, '2008-01-23 03:31:23');
INSERT INTO `photo` VALUES (18, 1, 7, 'М157футбол', 'f1bf3e85dd373ecc2fe015ab9349b2e3.jpg', 'f1bf3e85dd373ecc2fe015ab9349b2e3.jpg', 0, 0, 2, 1, 5, '2008-01-23 03:31:37');
INSERT INTO `photo` VALUES (20, 1, 9, '433', 'a7ff7b6a48987713cc27e253d9756ef1.jpg', 'a7ff7b6a48987713cc27e253d9756ef1.jpg', 1, 1, 1, 6, 13, '2008-01-23 03:33:26');
INSERT INTO `photo` VALUES (23, 1, 9, '7', 'eb037c0605feaa5519c2baf469ecdb8e.jpg', 'eb037c0605feaa5519c2baf469ecdb8e.jpg', 1, 0, 1, 2, 6, '2008-01-23 05:06:38');
INSERT INTO `photo` VALUES (26, 1, 9, '', 'd9210b5285f23b2f27f3cdfed91f0bd3.jpg', 'd9210b5285f23b2f27f3cdfed91f0bd3.jpg', 0, 0, 1, 1, 2, '2008-02-08 01:43:44');

-- --------------------------------------------------------

-- 
-- Структура таблицы `photo_comment`
-- 

DROP TABLE IF EXISTS `photo_comment`;
CREATE TABLE IF NOT EXISTS `photo_comment` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL,
  `avatar_id` bigint(20) NOT NULL,
  `warning_id` bigint(20) NOT NULL,
  `photo_id` bigint(20) NOT NULL,
  `text` text character set cp1251 NOT NULL,
  `mood` varchar(100) character set cp1251 NOT NULL,
  `creation_date` datetime NOT NULL,
  `adm_redacted` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- 
-- Дамп данных таблицы `photo_comment`
-- 

INSERT INTO `photo_comment` VALUES (1, 1, 0, 0, 1, 'comment 1', '', '2007-01-11 00:00:00', 0);
INSERT INTO `photo_comment` VALUES (2, 1, 0, 0, 1, 'Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст Текст текст', '', '2008-05-12 00:00:00', 0);
INSERT INTO `photo_comment` VALUES (3, 1, 0, 0, 2, 'coomment qweqwe', '1', '2008-01-22 13:45:03', 0);
INSERT INTO `photo_comment` VALUES (11, 1, 0, 0, 23, '3432', '0', '2008-01-23 05:07:40', 0);
INSERT INTO `photo_comment` VALUES (12, 1, 0, 0, 17, 'fwfe234r34gt3', '0', '2008-01-23 05:07:44', 0);
INSERT INTO `photo_comment` VALUES (13, 1, 0, 0, 17, 'f34f34f34f3', '0', '2008-01-23 05:07:48', 0);
INSERT INTO `photo_comment` VALUES (14, 1, 0, 0, 23, 'qwd123ed12', '0', '2008-02-26 19:34:15', 0);
INSERT INTO `photo_comment` VALUES (15, 1, 0, 0, 23, 'asf23r23423432423423234\r\nfd34t34\r\ngwerg3\r\nмама', '0', '2008-02-26 19:34:25', 0);
INSERT INTO `photo_comment` VALUES (16, 1, 0, 0, 20, 'фыв23у32423', '0', '2008-02-26 19:40:31', 0);
INSERT INTO `photo_comment` VALUES (18, 2, 0, 0, 23, '23у32к23к23', '0', '2008-02-26 19:40:59', 0);
INSERT INTO `photo_comment` VALUES (19, 2, 0, 0, 20, 'вйв2332к2323к', '0', '2008-02-26 19:41:04', 0);
INSERT INTO `photo_comment` VALUES (20, 1, 0, 0, 23, 'фывыфвыфвыфвфы', '0', '2008-02-26 20:12:33', 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `photo_vote`
-- 

DROP TABLE IF EXISTS `photo_vote`;
CREATE TABLE IF NOT EXISTS `photo_vote` (
  `id` bigint(20) NOT NULL auto_increment,
  `photo_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `ip` varchar(255) character set cp1251 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

-- 
-- Дамп данных таблицы `photo_vote`
-- 

INSERT INTO `photo_vote` VALUES (15, 20, 1, '127.0.0.1');
INSERT INTO `photo_vote` VALUES (16, 26, 1, '127.0.0.1');
INSERT INTO `photo_vote` VALUES (17, 23, 1, '127.0.0.1');
INSERT INTO `photo_vote` VALUES (19, 23, 2, '127.0.0.1');
INSERT INTO `photo_vote` VALUES (20, 20, 2, '127.0.0.1');
INSERT INTO `photo_vote` VALUES (21, 17, 1, '127.0.0.1');

-- --------------------------------------------------------

-- 
-- Структура таблицы `qq_tags`
-- 

DROP TABLE IF EXISTS `qq_tags`;
CREATE TABLE IF NOT EXISTS `qq_tags` (
  `question_id` int(11) NOT NULL,
  `question_tag_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- Дамп данных таблицы `qq_tags`
-- 

INSERT INTO `qq_tags` VALUES (1, 2, 1);
INSERT INTO `qq_tags` VALUES (1, 1, 1);
INSERT INTO `qq_tags` VALUES (2, 1, 1);
INSERT INTO `qq_tags` VALUES (3, 3, 2);

-- --------------------------------------------------------

-- 
-- Структура таблицы `question_tags`
-- 

DROP TABLE IF EXISTS `question_tags`;
CREATE TABLE IF NOT EXISTS `question_tags` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(100) character set utf8 default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`),
  FULLTEXT KEY `name_2` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=4 ;

-- 
-- Дамп данных таблицы `question_tags`
-- 

INSERT INTO `question_tags` VALUES (1, 'Tag');
INSERT INTO `question_tags` VALUES (2, 'Tag 1');
INSERT INTO `question_tags` VALUES (3, 'Tag 2');

-- --------------------------------------------------------

-- 
-- Структура таблицы `questions`
-- 

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` bigint(20) NOT NULL auto_increment,
  `questions_cat_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `a_count` int(11) NOT NULL,
  `q_text` text character set utf8,
  `creation_date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=62 ;

-- 
-- Дамп данных таблицы `questions`
-- 

INSERT INTO `questions` VALUES (1, 1, 1, 0, 'вопрос?', '2001-01-05 10:00:00');
INSERT INTO `questions` VALUES (2, 2, 1, 0, 'Вопрос 2?', '2002-01-08 00:00:00');
INSERT INTO `questions` VALUES (3, 1, 1, 0, 'Вопрос 3?', '1987-06-07 00:00:00');

-- --------------------------------------------------------

-- 
-- Структура таблицы `questions_cat`
-- 

DROP TABLE IF EXISTS `questions_cat`;
CREATE TABLE IF NOT EXISTS `questions_cat` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(100) character set utf8 default NULL,
  `sortfield` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=3 ;

-- 
-- Дамп данных таблицы `questions_cat`
-- 

INSERT INTO `questions_cat` VALUES (1, 'Категория 1', 0);
INSERT INTO `questions_cat` VALUES (2, 'Категория 2', 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `session`
-- 

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `id` varchar(100) character set cp1251 NOT NULL default '',
  `lastaction` int(10) NOT NULL default '0',
  `ip` char(15) character set cp1251 NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- 
-- Дамп данных таблицы `session`
-- 

INSERT INTO `session` VALUES ('qc1plutdsv08sj57k22u1mlkp5', 1203255596, '');

-- --------------------------------------------------------

-- 
-- Структура таблицы `session_vars`
-- 

DROP TABLE IF EXISTS `session_vars`;
CREATE TABLE IF NOT EXISTS `session_vars` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) character set cp1251 default NULL,
  `session` varchar(100) character set cp1251 default NULL,
  `value` text character set cp1251,
  PRIMARY KEY  (`id`),
  KEY `sessionID` (`session`)
) ENGINE=MyISAM AUTO_INCREMENT=895 DEFAULT CHARSET=utf8 AUTO_INCREMENT=895 ;

-- 
-- Дамп данных таблицы `session_vars`
-- 

INSERT INTO `session_vars` VALUES (892, 'qc1plutdsv08sj57k22u1mlkp5', 'qc1plutdsv08sj57k22u1mlkp5', '');
INSERT INTO `session_vars` VALUES (893, 'user', 'qc1plutdsv08sj57k22u1mlkp5', 'a:26:{s:2:"id";s:1:"1";s:10:"first_name";s:10:"Админ";s:11:"middle_name";s:16:"Иванович";s:9:"last_name";s:14:"Админов";s:5:"email";s:0:"";s:5:"login";s:5:"admin";s:4:"pass";s:5:"admin";s:10:"birth_date";N;s:6:"gender";s:1:"0";s:5:"about";s:0:"";s:8:"interest";s:0:"";s:8:"reg_date";s:1:"0";s:11:"su_vis_date";s:1:"0";s:8:"group_id";s:1:"0";s:10:"country_id";s:1:"0";s:4:"city";s:0:"";s:4:"hash";s:0:"";s:6:"status";s:1:"0";s:8:"tabs_map";s:7:"1111111";s:10:"reputation";s:1:"0";s:9:"nextmoney";s:1:"0";s:12:"user_type_id";s:1:"1";s:6:"banned";s:1:"0";s:17:"registration_date";s:10:"2008-01-04";s:4:"name";s:10:"Админ";s:6:"rights";s:1868:"a:11:{s:15:"IndexController";a:1:{s:11:"IndexAction";a:1:{i:0;s:4:"sub2";}}s:14:"TestController";a:5:{s:11:"IndexAction";a:0:{}s:12:"DeleteAction";a:0:{}s:10:"EditAction";a:0:{}s:9:"AddAction";a:0:{}s:10:"SaveAction";a:0:{}}s:14:"UserController";a:4:{s:11:"LoginAction";a:0:{}s:12:"LogoutAction";a:0:{}s:17:"ViewprofileAction";a:0:{}s:16:"PhotoAlbumAction";a:0:{}}s:16:"RightsController";a:2:{s:11:"IndexAction";a:0:{}s:10:"SaveAction";a:0:{}}s:22:"PhotoCommentController";a:1:{s:17:"CommentListAction";a:0:{}}s:15:"AlbumController";a:10:{s:14:"LastListAction";a:0:{}s:13:"TopListAction";a:0:{}s:10:"UserAction";a:0:{}s:12:"CreateAction";a:0:{}s:12:"UploadAction";a:0:{}s:10:"SaveAction";a:0:{}s:16:"UploadFormAction";a:0:{}s:16:"CreateFormAction";a:0:{}s:10:"ListAction";a:0:{}s:14:"ListSaveAction";a:0:{}}s:15:"PhotoController";a:9:{s:13:"TopListAction";a:0:{}s:11:"AlbumAction";a:0:{}s:10:"ViewAction";a:0:{}s:10:"UserAction";a:0:{}s:10:"EditAction";a:0:{}s:13:"CommentAction";a:0:{}s:15:"RatePhotoAction";a:0:{}s:19:"CommentDeleteAction";a:0:{}s:10:"SaveAction";a:0:{}}s:14:"BlogController";a:12:{s:10:"EditAction";a:0:{}s:10:"SaveAction";a:0:{}s:16:"EditBranchAction";a:0:{}s:16:"SaveBranchAction";a:0:{}s:10:"PostAction";a:0:{}s:14:"CommentsAction";a:0:{}s:17:"SaveCommentAction";a:0:{}s:17:"EditCommentAction";a:0:{}s:19:"DeleteCommentAction";a:0:{}s:14:"PostEditAction";a:0:{}s:14:"PostSaveAction";a:0:{}s:16:"PostDeleteAction";a:0:{}}s:15:"AdminController";a:4:{s:11:"LoginAction";a:0:{}s:15:"LoginFormAction";a:0:{}s:13:"DesktopAction";a:0:{}s:12:"LogoutAction";a:0:{}}s:24:"AdminParameterController";a:4:{s:15:"GroupListAction";a:0:{}s:15:"EditGroupAction";a:0:{}s:16:"SaveParamsAction";a:0:{}s:17:"DeleteParamAction";a:0:{}}s:19:"AdminUserController";a:4:{s:12:"DeleteAction";a:0:{}s:10:"ListAction";a:0:{}s:10:"EditAction";a:0:{}s:10:"SaveAction";a:0:{}}}";}');
INSERT INTO `session_vars` VALUES (894, 'LAST_PATH', 'qc1plutdsv08sj57k22u1mlkp5', '/next24/Admin/Desktop');

-- --------------------------------------------------------

-- 
-- Структура таблицы `subaction`
-- 

DROP TABLE IF EXISTS `subaction`;
CREATE TABLE IF NOT EXISTS `subaction` (
  `id` int(11) NOT NULL auto_increment,
  `action_id` int(11) default NULL,
  `name` varchar(50) character set cp1251 default NULL,
  PRIMARY KEY  (`id`),
  KEY `action_idIdx` (`action_id`),
  KEY `nameIdex` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Дамп данных таблицы `subaction`
-- 

INSERT INTO `subaction` VALUES (1, 1, 'sub1');
INSERT INTO `subaction` VALUES (2, 1, 'sub2');

-- --------------------------------------------------------

-- 
-- Структура таблицы `test`
-- 

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) character set cp1251 NOT NULL default '',
  `value` text character set cp1251 NOT NULL,
  `check` enum('y','n') character set cp1251 NOT NULL default 'y',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `test`
-- 

INSERT INTO `test` VALUES (1, '', 'значение в утф8', 'y');

-- --------------------------------------------------------

-- 
-- Структура таблицы `ub_tree`
-- 

DROP TABLE IF EXISTS `ub_tree`;
CREATE TABLE IF NOT EXISTS `ub_tree` (
  `id` bigint(20) NOT NULL auto_increment,
  `blog_id` bigint(20) NOT NULL,
  `blogs_catalog_id` int(11) NOT NULL,
  `blog_banner_id` bigint(20) NOT NULL,
  `name` varchar(255) character set cp1251 NOT NULL,
  `access` tinyint(4) NOT NULL,
  `key` varchar(255) character set cp1251 NOT NULL,
  `level` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED AUTO_INCREMENT=19 ;

-- 
-- Дамп данных таблицы `ub_tree`
-- 

INSERT INTO `ub_tree` VALUES (1, 1, 1, 0, 'Мой раздел423', 1, '', 0);
INSERT INTO `ub_tree` VALUES (2, 1, 1, 0, 'v233', 1, '', 0);
INSERT INTO `ub_tree` VALUES (18, 1, 1, 0, 'asdsdfsdf', 1, '', 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `user_right`
-- 

DROP TABLE IF EXISTS `user_right`;
CREATE TABLE IF NOT EXISTS `user_right` (
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

-- --------------------------------------------------------

-- 
-- Структура таблицы `user_type`
-- 

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(11) NOT NULL default '0',
  `name` varchar(50) character set cp1251 default NULL,
  `description` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- 
-- Дамп данных таблицы `user_type`
-- 

INSERT INTO `user_type` VALUES (0, 'Гость', 'Незарегестрированный пользователь');
INSERT INTO `user_type` VALUES (1, 'Админ', 'Администраторы сайта');

-- --------------------------------------------------------

-- 
-- Структура таблицы `users`
-- 

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL auto_increment,
  `first_name` varchar(50) character set cp1251 NOT NULL,
  `middle_name` varchar(50) character set cp1251 NOT NULL,
  `last_name` varchar(50) character set cp1251 NOT NULL,
  `email` varchar(255) character set cp1251 NOT NULL,
  `login` varchar(255) character set cp1251 NOT NULL,
  `pass` varchar(255) character set cp1251 default NULL,
  `birth_date` date default NULL,
  `gender` tinyint(4) NOT NULL,
  `about` text character set cp1251 NOT NULL,
  `interest` text character set cp1251 NOT NULL,
  `reg_date` int(11) NOT NULL,
  `su_vis_date` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `city` varchar(255) character set cp1251 NOT NULL,
  `hash` varchar(255) character set cp1251 NOT NULL,
  `status` tinyint(4) NOT NULL,
  `tabs_map` varchar(100) character set cp1251 NOT NULL default '1111111',
  `reputation` double NOT NULL,
  `nextmoney` double NOT NULL,
  `user_type_id` tinyint(4) default NULL,
  `banned` tinyint(4) NOT NULL,
  `registration_date` date default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Дамп данных таблицы `users`
-- 

INSERT INTO `users` VALUES (1, 'Админ', 'Иванович', 'Админов', '', 'admin', 'admin', NULL, 0, '', '', 0, 0, 0, 0, '', '', 0, '1111111', 0, 0, 1, 0, '2008-01-04');
INSERT INTO `users` VALUES (2, 'Тест', 'Пользователь', 'Фамилия', 'a@email.com', 'hunter', 'user', NULL, 1, 'asd', 'qd', 12121212, 123123, 1, 1, 'город', 'sdfdsfsd', 1, '1111111', 0, 0, 0, 1, '2008-02-09');
        