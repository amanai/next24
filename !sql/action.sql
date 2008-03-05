-- phpMyAdmin SQL Dump
-- version 2.11.3
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 05 2008 г., 18:12
-- Версия сервера: 5.0.45
-- Версия PHP: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- База данных: `next24`
--

-- --------------------------------------------------------

--
-- Структура таблицы `action`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Дамп данных таблицы `action`
--

INSERT INTO `action` (`id`, `controller_id`, `name`, `default`, `page_title`, `request_key`) VALUES
(1, 1, 'Index', 1, NULL, 'home'),
(2, 2, 'Index', 0, NULL, ''),
(3, 2, 'Delete', NULL, NULL, NULL),
(4, 2, 'Edit', NULL, NULL, NULL),
(5, 2, 'Add', NULL, NULL, NULL),
(6, 2, 'Save', NULL, NULL, NULL),
(8, 3, 'Login', NULL, NULL, 'site_login'),
(9, 3, 'Logout', NULL, NULL, 'site_logout'),
(10, 4, 'Index', NULL, NULL, NULL),
(11, 4, 'Save', NULL, NULL, NULL),
(12, 3, 'Viewprofile', NULL, NULL, NULL),
(13, 7, 'CommentList', NULL, NULL, NULL),
(14, 3, 'PhotoAlbum', NULL, NULL, NULL),
(15, 8, 'LastList', NULL, NULL, 'last_albums'),
(16, 8, 'TopList', NULL, NULL, 'top_albums'),
(17, 9, 'TopList', NULL, NULL, 'top_photo'),
(18, 9, 'Album', NULL, NULL, 'albums_photo'),
(19, 9, 'View', NULL, NULL, 'view_photo'),
(20, 9, 'User', NULL, NULL, NULL),
(21, 8, 'User', NULL, NULL, NULL),
(22, 8, 'Create', NULL, NULL, 'save_album'),
(23, 8, 'Upload', NULL, NULL, 'upload_photo_form'),
(24, 8, 'Save', NULL, NULL, NULL),
(25, 8, 'UploadForm', NULL, NULL, 'upload_pic'),
(26, 8, 'CreateForm', NULL, NULL, 'create_album'),
(27, 8, 'Create', NULL, NULL, NULL),
(28, 8, 'List', NULL, NULL, 'albums'),
(29, 9, 'Edit', NULL, NULL, 'edit_photo'),
(30, 9, 'Comment', NULL, NULL, 'comment_photo'),
(31, 8, 'ListSave', NULL, NULL, 'save_album_list'),
(32, 9, 'RatePhoto', NULL, NULL, 'vote_photo'),
(33, 9, 'CommentDelete', NULL, NULL, 'del_photo_comment'),
(34, 9, 'Save', NULL, NULL, 'save_photo_list'),
(35, 10, 'Edit', NULL, NULL, NULL),
(36, 10, 'Save', NULL, NULL, NULL),
(37, 10, 'EditBranch', NULL, NULL, NULL),
(38, 10, 'SaveBranch', NULL, NULL, NULL),
(39, 10, 'Post', NULL, NULL, NULL),
(40, 10, 'Comments', NULL, NULL, NULL),
(41, 10, 'SaveComment', NULL, NULL, NULL),
(42, 10, 'EditComment', NULL, NULL, NULL),
(43, 10, 'DeleteComment', NULL, NULL, NULL),
(44, 10, 'PostEdit', NULL, NULL, NULL),
(45, 10, 'PostSave', NULL, NULL, NULL),
(46, 10, 'PostDelete', NULL, NULL, NULL),
(47, 11, 'Login', NULL, NULL, 'login'),
(48, 11, 'LoginForm', NULL, NULL, 'loginform'),
(49, 11, 'Desktop', 1, NULL, 'desktop'),
(50, 11, 'Logout', NULL, NULL, 'logout'),
(51, 12, 'GroupList', 1, NULL, 'param_group_list'),
(52, 12, 'EditGroup', NULL, NULL, 'admin_edit_group'),
(53, 12, 'SaveParams', NULL, NULL, 'admin_save_param'),
(54, 12, 'DeleteParam', NULL, NULL, 'admin_del_param'),
(55, 13, 'Delete', NULL, NULL, 'admin_user_delete'),
(56, 13, 'List', NULL, NULL, 'admin_user_list'),
(57, 13, 'Edit', NULL, NULL, 'admin_user_edit'),
(58, 13, 'Save', NULL, NULL, 'admin_user_save'),
(59, 14, 'List', 1, NULL, 'admin_user_group'),
(60, 14, 'Edit', NULL, NULL, 'admin_user_group_edit'),
(61, 14, 'Save', NULL, NULL, 'admin_user_group_save'),
(62, 14, 'Controllers', NULL, NULL, 'admin_group_controllers'),
(63, 14, 'ActionList', NULL, NULL, 'admin_group_action_list'),
(64, 14, 'ChangeAccess', NULL, NULL, 'admin_user_change_access'),
(65, 3, 'Profile', NULL, NULL, 'user_profile'),
(67, 15, 'List', NULL, 'Р’РѕРїСЂРѕСЃС‹-РѕС‚РІРµС‚С‹', 'user_questions'),
(68, 15, 'ViewQuestion', NULL, 'Р’РѕРїСЂРѕСЃ РїРѕР»СЊР·РѕРІР°С‚РµР»СЏ', 'view_question'),
(69, 15, 'AnswerDelete', NULL, 'РЈРґР°Р»РёС‚СЊ РѕС‚РІРµС‚', 'delete_answer'),
(70, 9, 'LastList', NULL, NULL, 'last_photo');
