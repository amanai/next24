-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Фев 18 2009 г., 22:09
-- Версия сервера: 5.0.45
-- Версия PHP: 5.2.4
-- 
-- БД: `gek_next24`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `GTDCategories`
-- 

DROP TABLE IF EXISTS `GTDCategories`;
CREATE TABLE IF NOT EXISTS `GTDCategories` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `parent_id` int(11) default NULL,
  `category_name` varchar(256) default NULL,
  `level` int(1) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `category_name_2` (`category_name`),
  KEY `user_id` (`user_id`,`parent_id`),
  KEY `level` (`level`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=23 ;

-- 
-- Дамп данных таблицы `GTDCategories`
-- 

INSERT INTO `GTDCategories` VALUES (1, 1, 0, 'Категория #1', 1);
INSERT INTO `GTDCategories` VALUES (2, 1, 1, 'Подкатегория', 2);
INSERT INTO `GTDCategories` VALUES (3, 1, 1, 'Подкатегория 2', 2);
INSERT INTO `GTDCategories` VALUES (4, 1, 2, 'Подкатегория 3', 3);
INSERT INTO `GTDCategories` VALUES (17, 1, 7, '34534', NULL);
INSERT INTO `GTDCategories` VALUES (7, 1, 1, 'рнг', NULL);
INSERT INTO `GTDCategories` VALUES (6, 1, 3, 'дльб', NULL);
INSERT INTO `GTDCategories` VALUES (5, 1, 4, '6768', NULL);
INSERT INTO `GTDCategories` VALUES (18, 1, 5, 'ghjgh', NULL);
INSERT INTO `GTDCategories` VALUES (19, 1, 7, 'dfgdfg', NULL);
INSERT INTO `GTDCategories` VALUES (20, 1, 19, 'dfgdg', NULL);
INSERT INTO `GTDCategories` VALUES (21, 1, 7, 'etrwertfdbxvc', NULL);
INSERT INTO `GTDCategories` VALUES (22, 1, 1, '', NULL);

-- --------------------------------------------------------

-- 
-- Структура таблицы `GTDFiles`
-- 

DROP TABLE IF EXISTS `GTDFiles`;
CREATE TABLE IF NOT EXISTS `GTDFiles` (
  `id` int(11) NOT NULL auto_increment,
  `folder_id` int(11) default NULL,
  `file_name` varchar(256) default NULL,
  `file_path` varchar(256) default NULL,
  `level` int(1) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `folder_id` (`folder_id`,`file_name`,`file_path`,`level`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=8 ;

-- 
-- Дамп данных таблицы `GTDFiles`
-- 

INSERT INTO `GTDFiles` VALUES (1, 1, 'Z:	mpphpC140.tmp', 'appuser_files11	z.txt', 0);
INSERT INTO `GTDFiles` VALUES (2, 1, 'n.eap', 'appuser_files11\n.eap', 0);
INSERT INTO `GTDFiles` VALUES (3, 1, 'db.GIF', 'app#user_files#1#1#db.GIF', 0);
INSERT INTO `GTDFiles` VALUES (4, 1, '', 'app#user_files#1#1#', 0);
INSERT INTO `GTDFiles` VALUES (5, 1, '', 'app#user_files#1#1#', 0);
INSERT INTO `GTDFiles` VALUES (6, 1, '', 'app#user_files#1#1#', 0);
INSERT INTO `GTDFiles` VALUES (7, 1, '', 'app#user_files#1#1#', 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `GTDfolders`
-- 

DROP TABLE IF EXISTS `GTDfolders`;
CREATE TABLE IF NOT EXISTS `GTDfolders` (
  `id` int(11) NOT NULL auto_increment,
  `category_id` int(11) default NULL,
  `parent_id` int(11) default NULL,
  `folder_name` varchar(256) default NULL,
  `level` int(1) default NULL,
  PRIMARY KEY  (`id`),
  KEY `category_id` (`category_id`),
  KEY `parent_id` (`parent_id`,`folder_name`),
  KEY `level` (`level`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=5 ;

-- 
-- Дамп данных таблицы `GTDfolders`
-- 

INSERT INTO `GTDfolders` VALUES (1, 1, 0, 'папка 1', NULL);
INSERT INTO `GTDfolders` VALUES (2, 1, 1, 'Kirill', NULL);
INSERT INTO `GTDfolders` VALUES (3, 1, 1, 'cvvxcv', NULL);
INSERT INTO `GTDfolders` VALUES (4, 1, 2, 'ttt', NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=267 DEFAULT CHARSET=utf8 AUTO_INCREMENT=267 ;

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
INSERT INTO `action` VALUES (17, 9, 'TopList', NULL, NULL, 'top_photo');
INSERT INTO `action` VALUES (18, 9, 'Album', NULL, NULL, 'albums_photo');
INSERT INTO `action` VALUES (19, 9, 'View', NULL, NULL, 'view_photo');
INSERT INTO `action` VALUES (20, 9, 'User', NULL, NULL, NULL);
INSERT INTO `action` VALUES (21, 8, 'User', NULL, NULL, NULL);
INSERT INTO `action` VALUES (22, 8, 'Create', NULL, NULL, 'save_album');
INSERT INTO `action` VALUES (23, 8, 'Upload', NULL, NULL, 'upload_photo_form');
INSERT INTO `action` VALUES (24, 8, 'Save', NULL, NULL, NULL);
INSERT INTO `action` VALUES (25, 8, 'UploadForm', NULL, NULL, 'upload_pic');
INSERT INTO `action` VALUES (26, 8, 'CreateForm', NULL, NULL, 'create_album');
INSERT INTO `action` VALUES (27, 8, 'Create', NULL, NULL, NULL);
INSERT INTO `action` VALUES (28, 8, 'List', NULL, NULL, 'albums');
INSERT INTO `action` VALUES (29, 9, 'Edit', NULL, NULL, 'edit_photo');
INSERT INTO `action` VALUES (30, 9, 'Comment', NULL, NULL, 'comment_photo');
INSERT INTO `action` VALUES (31, 8, 'ListSave', NULL, NULL, 'save_album_list');
INSERT INTO `action` VALUES (32, 9, 'RatePhoto', NULL, NULL, 'vote_photo');
INSERT INTO `action` VALUES (33, 9, 'CommentDelete', NULL, NULL, 'del_photo_comment');
INSERT INTO `action` VALUES (34, 9, 'Save', NULL, NULL, 'save_photo_list');
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
INSERT INTO `action` VALUES (101, 15, 'List', NULL, NULL, 'user_questions');
INSERT INTO `action` VALUES (102, 15, 'ViewQuestion', NULL, NULL, 'view_question');
INSERT INTO `action` VALUES (103, 15, 'AnswerDelete', NULL, NULL, 'delete_answer');
INSERT INTO `action` VALUES (104, 15, 'AddAnswer', NULL, NULL, 'add_answer');
INSERT INTO `action` VALUES (105, 15, 'ManagedQuestion', NULL, NULL, 'managed_question');
INSERT INTO `action` VALUES (106, 15, 'Delete', NULL, NULL, 'delete_question');
INSERT INTO `action` VALUES (107, 9, 'LastList', NULL, NULL, 'last_photo');
INSERT INTO `action` VALUES (108, 16, 'CatalogList', 1, NULL, 'blog_catalog_list');
INSERT INTO `action` VALUES (109, 16, 'CatalogEdit', NULL, NULL, 'blog_catalog_edit');
INSERT INTO `action` VALUES (110, 16, 'CatalogSave', NULL, NULL, 'blog_catalog_save');
INSERT INTO `action` VALUES (111, 16, 'CatalogSaveTags', NULL, NULL, 'blog_catalog_save_tags');
INSERT INTO `action` VALUES (112, 16, 'CatalogDeleteTag', NULL, NULL, 'blog_catalog_delete_tag');
INSERT INTO `action` VALUES (113, 10, 'Edit', NULL, NULL, 'blog_edit');
INSERT INTO `action` VALUES (114, 10, 'Save', NULL, NULL, 'blog_save');
INSERT INTO `action` VALUES (115, 10, 'EditBranch', NULL, NULL, 'blog_edit_branch');
INSERT INTO `action` VALUES (116, 10, 'SaveBranch', NULL, NULL, 'blog_save_branch');
INSERT INTO `action` VALUES (117, 10, 'PostList', NULL, NULL, 'posts');
INSERT INTO `action` VALUES (118, 10, 'Comments', NULL, NULL, 'blog_post_comments');
INSERT INTO `action` VALUES (119, 10, 'SaveComment', NULL, NULL, 'blog_save_comment');
INSERT INTO `action` VALUES (120, 10, 'EditComment', NULL, NULL, 'blog_edit_comment');
INSERT INTO `action` VALUES (121, 10, 'DeleteComment', NULL, NULL, 'blog_delete_comment');
INSERT INTO `action` VALUES (122, 10, 'PostEdit', NULL, NULL, 'blog_post_edit');
INSERT INTO `action` VALUES (123, 10, 'PostSave', NULL, NULL, 'blog_post_save');
INSERT INTO `action` VALUES (124, 10, 'PostDelete', NULL, NULL, 'blog_post_delete');
INSERT INTO `action` VALUES (125, 17, 'Index', NULL, NULL, 'admin_questions');
INSERT INTO `action` VALUES (126, 17, 'CatList', NULL, NULL, 'admin_cat_list');
INSERT INTO `action` VALUES (127, 17, 'MoveCat', NULL, NULL, 'admin_move_cat');
INSERT INTO `action` VALUES (128, 17, 'ManagedCat', NULL, NULL, 'admin_managed_cat');
INSERT INTO `action` VALUES (129, 17, 'DeleteCat', NULL, NULL, 'delete_cat');
INSERT INTO `action` VALUES (130, 17, 'QuestionList', NULL, NULL, 'admin_question_list');
INSERT INTO `action` VALUES (131, 17, 'DeleteQuestion', NULL, NULL, 'admin_delete_question');
INSERT INTO `action` VALUES (132, 17, 'EditQuestion', NULL, NULL, 'admin_edit_question');
INSERT INTO `action` VALUES (133, 15, 'UserQuestions', NULL, NULL, 'my_questions');
INSERT INTO `action` VALUES (134, 10, 'AjaxChangeBranch', NULL, NULL, 'ajax_change_branch');
INSERT INTO `action` VALUES (135, 18, 'List', NULL, NULL, 'subscribes');
INSERT INTO `action` VALUES (136, 18, 'AjaxBlogCatalogTree', NULL, NULL, 'subscribe_blog_catalog');
INSERT INTO `action` VALUES (137, 18, 'AjaxBlogTree', NULL, NULL, 'subscribe_blog_tree');
INSERT INTO `action` VALUES (138, 18, 'Change', NULL, NULL, 'subscribe_change');
INSERT INTO `action` VALUES (139, 13, 'BanHistory', NULL, NULL, 'admin_ban_history');
INSERT INTO `action` VALUES (140, 3, 'RegistrationForm', NULL, NULL, 'registration');
INSERT INTO `action` VALUES (141, 3, 'Registration', NULL, NULL, 'do_registration');
INSERT INTO `action` VALUES (142, 3, 'CheckLogin', NULL, NULL, 'check_login');
INSERT INTO `action` VALUES (143, 3, 'ChangeCountry', NULL, NULL, 'registration_change_country');
INSERT INTO `action` VALUES (144, 3, 'ChangeState', NULL, NULL, 'registration_change_state');
INSERT INTO `action` VALUES (145, 3, 'ValidateRegistration', NULL, NULL, 'registration_validate');
INSERT INTO `action` VALUES (146, 3, 'Activation', NULL, NULL, 'activation');
INSERT INTO `action` VALUES (147, 3, 'CompleteRegistration', NULL, NULL, 'complete_registration');
INSERT INTO `action` VALUES (148, 3, 'ProfileEdit', NULL, NULL, 'profile_edit');
INSERT INTO `action` VALUES (149, 3, 'AvatarEdit', NULL, NULL, 'avatar_edit');
INSERT INTO `action` VALUES (150, 19, 'List', NULL, NULL, 'article_list');
INSERT INTO `action` VALUES (151, 19, 'LastList', NULL, NULL, 'last_article');
INSERT INTO `action` VALUES (152, 19, 'TopList', NULL, NULL, 'top_article');
INSERT INTO `action` VALUES (153, 19, 'AddArticle', NULL, NULL, 'add_article');
INSERT INTO `action` VALUES (154, 19, 'AjaxChangeCat', NULL, NULL, 'ajax_change_cat');
INSERT INTO `action` VALUES (155, 19, 'AjaxAddPage', NULL, NULL, 'ajax_add_page');
INSERT INTO `action` VALUES (156, 19, 'ArticleView', NULL, NULL, 'view_article');
INSERT INTO `action` VALUES (157, 19, 'Vote', NULL, NULL, 'vote_article');
INSERT INTO `action` VALUES (158, 27, 'AddComment', NULL, NULL, 'add_comment');
INSERT INTO `action` VALUES (159, 27, 'DeleteComment', NULL, NULL, 'delete_comment');
INSERT INTO `action` VALUES (160, 20, 'ResetRate', NULL, NULL, 'reset_article_rate');
INSERT INTO `action` VALUES (161, 20, 'ShowTree', NULL, NULL, 'article_tree');
INSERT INTO `action` VALUES (162, 20, 'EditSection', NULL, NULL, 'edit_section');
INSERT INTO `action` VALUES (163, 20, 'DeleteSection', NULL, NULL, 'delete_article_section');
INSERT INTO `action` VALUES (164, 20, 'DeleteArticle', NULL, NULL, 'admin_delete_article');
INSERT INTO `action` VALUES (165, 20, 'SetCompetition', NULL, NULL, 'set_competition');
INSERT INTO `action` VALUES (166, 19, 'UserArticleList', NULL, NULL, 'user_articles');
INSERT INTO `action` VALUES (167, 20, 'SetActive', NULL, NULL, 'set_active_article');
INSERT INTO `action` VALUES (168, 19, 'EditArticle', NULL, NULL, 'edit_article');
INSERT INTO `action` VALUES (169, 19, 'DeleteArticle', NULL, NULL, 'delete_article');
INSERT INTO `action` VALUES (171, 21, 'BookmarksView', NULL, 'Title_BookmarksView', 'bookmarks_view');
INSERT INTO `action` VALUES (170, 21, 'BookmarksList', NULL, 'Title_BookmarksList', 'bookmarks_list');
INSERT INTO `action` VALUES (172, 21, 'BookmarksUser', NULL, 'Title_BookmarksUser', 'bookmarks_user');
INSERT INTO `action` VALUES (173, 21, 'BookmarksMostVisit', NULL, 'Title_BookmarksMostVisit', 'bookmarks_most_visit');
INSERT INTO `action` VALUES (174, 21, 'BookmarksDelete', NULL, 'Удалить закладку', 'bookmarks_delete');
INSERT INTO `action` VALUES (175, 21, 'BookmarksManage', NULL, 'Редактировать закладку', 'bookmarks_manage');
INSERT INTO `action` VALUES (176, 21, 'BookmarksCommentAdd', NULL, 'Добавить комментарий к закладке', 'bookmarks_comment_add');
INSERT INTO `action` VALUES (177, 21, 'BookmarksCommentDelete', NULL, 'Удалить комментарий к закладке', 'bookmarks_comment_delete');
INSERT INTO `action` VALUES (178, 21, 'BookmarksCategoryEdit', NULL, 'Создание и редактирование категории', 'bookmarks_category_edit');
INSERT INTO `action` VALUES (179, 21, 'BookmarksCategorySave', NULL, 'Сохранение категории', 'bookmarks_category_save');
INSERT INTO `action` VALUES (180, 21, 'BookmarksCategorySaveMessage', NULL, 'Вывод сообщения о сохранении категории', 'bookmarks_category_save_message');
INSERT INTO `action` VALUES (181, 21, 'BookmarksImportMake', NULL, 'Импортирование закладок - процесс', 'bookmarks_import_make');
INSERT INTO `action` VALUES (182, 21, 'BookmarksImportForm', NULL, 'Импортирование закладок открытие формы', 'bookmarks_import_form');
INSERT INTO `action` VALUES (189, 22, 'SocialMainList', NULL, 'Action: Вывод основной страницы Соц.Позиций', 'social_main_list');
INSERT INTO `action` VALUES (185, 3, 'WhyPage', NULL, NULL, 'why_page');
INSERT INTO `action` VALUES (186, 3, 'License', NULL, NULL, 'license');
INSERT INTO `action` VALUES (187, 3, 'CheckEmail', NULL, NULL, 'check_email');
INSERT INTO `action` VALUES (190, 22, 'SocialLastAddPos', NULL, 'Action: Вывод последних добавленых Соц.Позиций(10 шт)', 'social_last_add_pos');
INSERT INTO `action` VALUES (191, 22, 'SocialView', NULL, 'Action: Соц.Позиций просмотр', 'social_view');
INSERT INTO `action` VALUES (192, 22, 'SocialUserList', NULL, 'Action: Соц.Позиций пользователя', 'social_user_list');
INSERT INTO `action` VALUES (193, 22, 'SocialDelete', NULL, 'Action: Соц.Позиций - удалить', 'social_delete');
INSERT INTO `action` VALUES (194, 22, 'SocialCommentAdd', NULL, 'Action: Добавить комментарий к Соц.Позиций', 'social_comment_add');
INSERT INTO `action` VALUES (195, 22, 'SocialManage', NULL, 'Action: Соц.Позиций - редактирование', 'social_manage');
INSERT INTO `action` VALUES (196, 22, 'SocialVoteAdd', NULL, 'Action: Оценить Соц.Позицию', 'social_vote_add');
INSERT INTO `action` VALUES (197, 22, 'SocialCommentDelete', NULL, 'Action: Удалить комментарий к Соц.Позиций', 'social_comment_delete');
INSERT INTO `action` VALUES (198, 22, 'SocialPosAdd', NULL, 'Action: Добавить Соц.Позицию', 'social_pos_add');
INSERT INTO `action` VALUES (199, 23, 'SearchUserMain', NULL, 'Action: Поиск знакомых', 'search_user_main');
INSERT INTO `action` VALUES (200, 23, 'SearchByInterest', NULL, 'Action: Поиск по интересам', 'search_by_interest');
INSERT INTO `action` VALUES (201, 20, 'EditArticle', NULL, NULL, 'admin_edit_article');
INSERT INTO `action` VALUES (202, 20, 'SaveArticle', NULL, NULL, 'save_article');
INSERT INTO `action` VALUES (203, 20, 'List', NULL, NULL, 'admin_list_article');
INSERT INTO `action` VALUES (204, 20, 'AddPage', NULL, NULL, 'add_page');
INSERT INTO `action` VALUES (205, 20, 'SaveSection', NULL, NULL, 'save_section');
INSERT INTO `action` VALUES (206, 20, 'UpSection', NULL, NULL, 'move_up_section');
INSERT INTO `action` VALUES (207, 20, 'DownSection', NULL, NULL, 'move_down_section');
INSERT INTO `action` VALUES (208, 19, 'SubjectVote', NULL, NULL, 'vote_subject');
INSERT INTO `action` VALUES (209, 19, 'CompetitionCatalog', NULL, NULL, 'subject_comp');
INSERT INTO `action` VALUES (210, 19, 'LastWinnersList', NULL, NULL, 'last_winners');
INSERT INTO `action` VALUES (211, 19, 'AddSubject', NULL, NULL, 'add_subject');
INSERT INTO `action` VALUES (212, 19, 'SaveSubject', NULL, NULL, 'save_subject');
INSERT INTO `action` VALUES (213, 19, 'CompetitionStage1', NULL, NULL, 'comp_stage1');
INSERT INTO `action` VALUES (214, 19, 'CompetitionStage2', NULL, NULL, 'comp_stage2');
INSERT INTO `action` VALUES (215, 19, 'CompetitionStage3', NULL, NULL, 'comp_stage3');
INSERT INTO `action` VALUES (216, 24, 'Controllers', 1, 'Управление контроллерами', 'controllers');
INSERT INTO `action` VALUES (217, 24, 'Actions', NULL, 'Управление действиями', 'actions');
INSERT INTO `action` VALUES (218, 24, 'ControllerSave', 0, 'Сохранение контроллера', 'controller_save');
INSERT INTO `action` VALUES (219, 24, 'ControllerAdd', 0, 'Добавление контроллера', 'controller_add');
INSERT INTO `action` VALUES (220, 24, 'ControllerDelete', 0, 'Удаление контроллера', 'controller_delete');
INSERT INTO `action` VALUES (221, 24, 'ActionSave', 0, 'Сохранение действия', 'action_save');
INSERT INTO `action` VALUES (222, 24, 'ActionAdd', 0, 'Добавление действия', 'action_add');
INSERT INTO `action` VALUES (223, 24, 'ActionDelete', 0, 'Удаление действия', 'action_delete');
INSERT INTO `action` VALUES (224, 25, 'News', NULL, 'новости RSS', 'news');
INSERT INTO `action` VALUES (225, 25, 'AddFeed', NULL, 'Добавление Feeds партнером', 'add_feed');
INSERT INTO `action` VALUES (226, 25, 'CronNews', NULL, 'работа крона, добавляет/удаляет новости по Feeds', 'cron_news');
INSERT INTO `action` VALUES (227, 25, 'MyFeeds', NULL, 'Вывод всех RSS лент партнера', 'my_feeds');
INSERT INTO `action` VALUES (228, 25, 'ChangeFeed', NULL, 'Изменение RSS', 'change_feed');
INSERT INTO `action` VALUES (229, 25, 'ChangeState', NULL, 'AJAX изменение статуса элементов RSS (banner, news_tree, feeds)', 'change_state');
INSERT INTO `action` VALUES (230, 25, 'SubscribeNews', NULL, 'подписаться на новости', 'subscribe_news');
INSERT INTO `action` VALUES (231, 25, 'ChangeNewsFavorite', NULL, 'AJAX изменение FavoriteNews для пользователя', 'change_news_favorite');
INSERT INTO `action` VALUES (232, 25, 'AddNewsTree', NULL, 'добавление ветки дерева', 'add_news_tree');
INSERT INTO `action` VALUES (233, 25, 'ChangeNewsTree', NULL, 'изменить ветвь дерева', 'change_news_tree');
INSERT INTO `action` VALUES (234, 25, 'ModerateNewsTree', NULL, 'модерация дерева категорий Админом', 'moderate_news_tree');
INSERT INTO `action` VALUES (235, 25, 'ModerateFeeds', NULL, 'модерация Админом RSS-лент и баннеров', 'moderate_feeds');
INSERT INTO `action` VALUES (236, 26, 'Debate', NULL, 'дебаты', 'debate');
INSERT INTO `action` VALUES (237, 26, 'DebateDelTheme', NULL, 'дебаты, удалить тему', 'debate_del_theme');
INSERT INTO `action` VALUES (238, 26, 'DebateVote', NULL, 'дебаты, голосование', 'debate_vote');
INSERT INTO `action` VALUES (239, 26, 'DebateChat', NULL, 'дебаты, чат', 'debate_chat');
INSERT INTO `action` VALUES (240, 26, 'DebateRefreshChat', NULL, 'дебаты, обновление окон чата', 'debate_refresh_chat');
INSERT INTO `action` VALUES (241, 26, 'DebateHelperCansay', NULL, 'дебаты, разрешить говорить пользователю', 'debate_helper_cansay');
INSERT INTO `action` VALUES (242, 26, 'DebatePausePress', NULL, 'дебаты, нажата кнопка ПАУЗА', 'debate_pause_press');
INSERT INTO `action` VALUES (243, 26, 'DebateEtapsChecker', NULL, 'дебаты, Ajax переключение по этапам', 'debate_etaps_checker');
INSERT INTO `action` VALUES (244, 26, 'DebateRules', NULL, 'дебаты, правила', 'debate_rules');
INSERT INTO `action` VALUES (245, 26, 'DebateHistory', NULL, 'дебаты, история', 'debate_history');
INSERT INTO `action` VALUES (246, 3, 'Saveprofile', NULL, 'редактировать профайл пользователя', 'save_profile');
INSERT INTO `action` VALUES (247, 3, 'Mood', NULL, 'управление фразами настроения', 'mood');
INSERT INTO `action` VALUES (248, 27, 'EditComment', NULL, NULL, 'edit_comment');
INSERT INTO `action` VALUES (249, 28, 'Mymessages', NULL, 'сообщения пользователя', 'my_messages');
INSERT INTO `action` VALUES (250, 28, 'GetFolderMessages', NULL, 'вывод сообщений пользователя, Ajax', 'get_folder_messages');
INSERT INTO `action` VALUES (251, 28, 'DelMessage', NULL, 'удаляет личное сообщение пользователя', 'del_message');
INSERT INTO `action` VALUES (252, 28, 'SendMessage', NULL, 'отправка личных сообщений', 'send_message');
INSERT INTO `action` VALUES (253, 28, 'CorrespondenceWith', NULL, 'переписка с конкретным пользователем', 'correspondence_with');
INSERT INTO `action` VALUES (254, 1, 'ChangeIndexTabs', NULL, 'Ajax, меняет состав табс-меню для пользователя', 'change_index_tabs');
INSERT INTO `action` VALUES (255, 3, 'RemindPassword', NULL, 'напоминание пароля ползователя', 'remind_password');
INSERT INTO `action` VALUES (256, 28, 'Friend', NULL, 'управление друзьями', 'friend');
INSERT INTO `action` VALUES (257, 29, 'AddComplaint', NULL, 'добавить жалобу в Арбитраж, Ajax', 'add_complaint');
INSERT INTO `action` VALUES (261, 30, 'GTD', NULL, NULL, 'gtd');
INSERT INTO `action` VALUES (262, 30, 'GTDAddCategory', NULL, '', 'add_category');
INSERT INTO `action` VALUES (263, 30, 'GTDViewFolders', NULL, '', 'view_folders');
INSERT INTO `action` VALUES (264, 30, 'GTDAddFolder', NULL, '', 'add_folder');
INSERT INTO `action` VALUES (265, 30, 'GTDViewFiles', NULL, '', 'view_files');
INSERT INTO `action` VALUES (266, 30, 'GTDAddFile', NULL, '', 'add_file');

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
  PRIMARY KEY  (`id`),
  KEY `ind` (`user_id`,`access`,`is_onmain`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- 
-- Дамп данных таблицы `album`
-- 

INSERT INTO `album` VALUES (1, 2, 10, 'Осень2', 2, 1, '2008-01-14 21:00:00');
INSERT INTO `album` VALUES (3, 2, 3, 'Мои фото', 1, 1, '2008-01-14 21:20:35');
INSERT INTO `album` VALUES (5, 1, 0, 'Весна', 1, 1, '2008-01-17 00:00:00');
INSERT INTO `album` VALUES (7, 1, 0, 'Зима', 2, 1, '2008-01-23 03:21:22');
INSERT INTO `album` VALUES (8, 1, 20, 'Лето', 0, 1, '2008-01-23 03:21:28');
INSERT INTO `album` VALUES (10, 1, 43, 'album3', 1, 1, '2008-02-27 13:32:20');
INSERT INTO `album` VALUES (11, 1, 0, 'album3434', 0, 1, '2008-02-27 13:32:34');
INSERT INTO `album` VALUES (12, 1, 0, 'asdsad', 0, 0, '2008-02-27 13:32:47');
INSERT INTO `album` VALUES (13, 1, 0, '32423423423f23434t344t', 2, 1, '2008-02-27 13:32:59');
INSERT INTO `album` VALUES (15, 1, 50, 'waer', 0, 1, '2008-03-05 14:10:54');
INSERT INTO `album` VALUES (16, 1, 64, 'test', 2, 0, '2008-12-15 16:33:01');

-- --------------------------------------------------------

-- 
-- Структура таблицы `answers`
-- 

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` bigint(20) NOT NULL auto_increment,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `avatar_id` int(11) NOT NULL,
  `warning_id` int(11) NOT NULL,
  `mood` int(11) NOT NULL,
  `adm_redacted` int(11) NOT NULL,
  `text` text character set utf8,
  `creation_date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=cp1251 PACK_KEYS=0 AUTO_INCREMENT=11 ;

-- 
-- Дамп данных таблицы `answers`
-- 

INSERT INTO `answers` VALUES (6, 66, 1, 0, 0, 0, 0, 'ага', '2008-03-15 14:09:11');
INSERT INTO `answers` VALUES (7, 72, 1, 0, 0, 0, 0, 'test', '2008-03-17 19:31:00');
INSERT INTO `answers` VALUES (8, 72, 1, 0, 0, 0, 0, 'test1', '2008-03-17 19:31:10');
INSERT INTO `answers` VALUES (9, 73, 1, 0, 0, 0, 0, 'да ничего не буит', '2008-04-22 20:37:44');
INSERT INTO `answers` VALUES (10, 73, 1, 0, 0, 0, 0, 'что-то будет!!!', '2008-04-22 20:48:32');

-- --------------------------------------------------------

-- 
-- Структура таблицы `arbitration`
-- 

DROP TABLE IF EXISTS `arbitration`;
CREATE TABLE IF NOT EXISTS `arbitration` (
  `id` bigint(20) NOT NULL auto_increment,
  `complaint_text` varchar(255) character set cp1251 default NULL,
  `user_id` bigint(20) default NULL,
  `complaint_on_user` bigint(20) default NULL,
  `arbitration_group_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `arbitration`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `arbitration_group`
-- 

DROP TABLE IF EXISTS `arbitration_group`;
CREATE TABLE IF NOT EXISTS `arbitration_group` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) character set cp1251 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `arbitration_group`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `article_comment`
-- 

DROP TABLE IF EXISTS `article_comment`;
CREATE TABLE IF NOT EXISTS `article_comment` (
  `id` bigint(20) NOT NULL auto_increment,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `avatar_id` int(11) NOT NULL,
  `warning_id` int(11) NOT NULL,
  `mood` int(11) NOT NULL,
  `mood_text` varchar(100) default NULL,
  `adm_redacted` int(11) NOT NULL,
  `text` text,
  `creation_date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=65 ;

-- 
-- Дамп данных таблицы `article_comment`
-- 

INSERT INTO `article_comment` VALUES (26, 9, 1, 0, 0, 0, NULL, 0, 'oppa', '2008-11-28 11:16:32');
INSERT INTO `article_comment` VALUES (27, 9, 1, 0, 0, 0, NULL, 0, 'wewww', '2008-11-28 11:16:41');
INSERT INTO `article_comment` VALUES (28, 9, 1, 0, 0, 0, NULL, 0, '1212', '2008-11-28 11:39:50');
INSERT INTO `article_comment` VALUES (29, 9, 1, 0, 0, 0, NULL, 0, '333', '2008-11-28 11:39:56');
INSERT INTO `article_comment` VALUES (31, 9, 1, 0, 0, 0, NULL, 0, '44555', '2008-11-28 11:40:06');
INSERT INTO `article_comment` VALUES (54, 9, 1, 0, 0, 0, NULL, 0, '[quote name="admin"]5555[/quote]\r\nhiiii', '2008-12-02 11:15:32');
INSERT INTO `article_comment` VALUES (33, 9, 1, 0, 0, 0, NULL, 0, '77777', '2008-11-28 11:40:19');
INSERT INTO `article_comment` VALUES (34, 9, 1, 0, 0, 0, NULL, 0, '8888', '2008-11-28 11:40:27');
INSERT INTO `article_comment` VALUES (35, 9, 1, 0, 0, 0, NULL, 0, '9999', '2008-11-28 11:40:34');
INSERT INTO `article_comment` VALUES (36, 9, 1, 0, 0, 0, NULL, 0, '112', '2008-11-28 11:40:43');
INSERT INTO `article_comment` VALUES (37, 9, 1, 0, 0, 0, NULL, 0, '2222', '2008-11-28 11:40:49');
INSERT INTO `article_comment` VALUES (38, 9, 1, 0, 0, 0, NULL, 0, '3333', '2008-11-28 11:40:55');
INSERT INTO `article_comment` VALUES (39, 9, 1, 0, 0, 0, NULL, 0, '4444', '2008-11-28 11:41:03');
INSERT INTO `article_comment` VALUES (40, 9, 1, 0, 0, 0, NULL, 0, '5555', '2008-11-28 11:41:09');
INSERT INTO `article_comment` VALUES (49, 9, 1, 0, 0, 0, NULL, 0, 'Добавить комментарий. Для этого ему нужно ввести текст комментария. Также пользователь должен иметь возможность выбрать: аватар для комментария; свое настроение из списка либо вписать настроение в текстовое поле.\r\n[quote name="admin"] Цитировать комментарий другого пользователя. Для этого рядом с каждым комментарием должна быть кнопка/ссылка «Цитировать». При нажатии на эту кнопку, текст данного комментария переносится в поле для добавления, заключенный в специальные теги вида . \r\n[/quote]\r\nДалее пользователь может отредактировать цитируемую часть и добавить свой комментарий. \r\n[quote name="test name"]\r\nУдалять свои комментарии.\r\n[/quote][quote name="ываываы"]\r\nУдалять свои комментарии.\r\n[/quote]\r\nОтредактировать свой уже добавленный комментарий.\r\n\r\n[quote name="sdfs"]\r\nvxzcvx\r\n[quote name="admin"]\r\ntest\r\n[/quote]\r\nxcvxcv\r\n[/quote]\r\nsdfsdfs', '2008-11-28 14:47:59');
INSERT INTO `article_comment` VALUES (51, 9, 1, 0, 0, 0, NULL, 0, '[quote name="admin"]Добавить комментарий. Для этого ему нужно ввести текст комментария. Также пользователь должен иметь возможность выбрать: аватар для комментария; свое настроение из списка либо вписать настроение в текстовое поле.\r\nДалее пользователь может отредактировать цитируемую часть и добавить свой комментарий. \r\n\r\nОтредактировать свой уже добавленный комментарий.[/quote]\r\nкенкенкен\r\n', '2008-12-01 10:22:08');
INSERT INTO `article_comment` VALUES (52, 9, 1, 0, 0, 0, NULL, 0, '[quote name="admin"]Добавить комментарий. Для этого ему нужно ввести текст комментария. Также пользователь должен иметь возможность выбрать: аватар для комментария; свое настроение из списка либо вписать настроение в текстовое поле.\r\nДалее пользователь может отредактировать цитируемую часть и добавить свой комментарий. \r\n\r\nОтредактировать свой уже добавленный комментарий.\r\n[/quote]\r\nxcvvxcccc[quote name="admin"]5555[/quote]zzzzzz\r\n', '2008-12-02 09:18:33');
INSERT INTO `article_comment` VALUES (53, 9, 1, 0, 0, 0, NULL, 0, '[quote name="admin"]Добавить комментарий. Для этого ему нужно ввести текст комментария. Также пользователь должен иметь возможность выбрать: аватар для комментария; свое настроение из списка либо вписать настроение в текстовое поле.\r\n\r\nДалее пользователь может отредактировать цитируемую часть и добавить свой комментарий. \r\n\r\nsdfsdfs[/quote]\r\nнееееет\r\n', '2008-12-02 09:18:55');
INSERT INTO `article_comment` VALUES (63, 9, 1, 43, 0, 0, 'весело )', 0, 'раз два три!', '2008-12-02 15:48:57');
INSERT INTO `article_comment` VALUES (64, 9, 1, 0, 11, 0, '', 1, '[quote name="admin"]раз два три![/quote]\r\n\r\nцитирую!\r\n\r\nадмин', '2008-12-02 15:49:28');
INSERT INTO `article_comment` VALUES (62, 9, 1, 40, 0, 0, 'туман', 1, 'Сука любовь', '2008-12-02 15:41:26');

-- --------------------------------------------------------

-- 
-- Структура таблицы `article_competition`
-- 

DROP TABLE IF EXISTS `article_competition`;
CREATE TABLE IF NOT EXISTS `article_competition` (
  `id` bigint(20) NOT NULL auto_increment,
  `id_article_tree` bigint(20) NOT NULL,
  `data_begin` datetime NOT NULL,
  `data_end` datetime NOT NULL,
  `reward` double default NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `article_competition`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `article_pages`
-- 

DROP TABLE IF EXISTS `article_pages`;
CREATE TABLE IF NOT EXISTS `article_pages` (
  `id` bigint(20) NOT NULL auto_increment,
  `article_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `p_text` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- 
-- Дамп данных таблицы `article_pages`
-- 

INSERT INTO `article_pages` VALUES (1, 1, 'Новая страница новой статьи', 'Новый текст новой страницы новой статьи');
INSERT INTO `article_pages` VALUES (2, 2, 'Test page1', 'Test page 1 text');
INSERT INTO `article_pages` VALUES (3, 3, 'страница', 'страница');
INSERT INTO `article_pages` VALUES (4, 4, '', '');
INSERT INTO `article_pages` VALUES (5, 5, 'Страница 1', 'Бизнесу не следует недооценивать кибертерроризм. Скажем, в Калифорнии, где землетрясение – явление отнюдь не редкое, нет, наверное, ни одной компании, которая бы не заботилась о собственной безопасности и сохранности своей конфиденциальной информации. Однако, когда речь заходит о виртуальном терроризме и его последствиях, некоторые до сих пор предпочитают отшучиваться, будто и нет такой проблемы. И, как показывает опыт, напрасно.\r\n\r\n            Что же должно быть на вооружении у малого бизнеса, для того чтобы не пострадать от действий кибертеррористов? Во-первых, - антивирусная программа. Стоимость их в среднем не превышает 100 долларов. Желательно также иметь в штате специалиста, который регулярно обновлял бы антивирусные базы. Большинство создателей антивирусных программ позволяют своим пользователям загружать обновления ежедневно, и даже ежечасно. Другим эффективным оружием против кибертерроризма является брандмауэр (программа, сканирующая сетевую активность и предотвращающая попытки внедрения в систему извне). Их стоимость колеблется от 50 долларов для домашнего бизнеса до нескольких тысяч для крупных предприятий, имеющих обширную интрасеть. Не менее важным условием безопасности данных является создание резервных копий важных документов. Для малых компаний вполне достаточно дублировать данные раз в неделю. Крупные компании, как правило, устанавливают специальное программное обеспечение, которое автоматически делает резервные копии и сохраняет их на носителях, к которым нет доступа из Интернета. Некоторые компании используют виртуальные частные сети (virtual private networks), для доступа к которым используется протокол PPTP, позволяющий удаленным пользователям безопасно обращаться к корпоративным сетям с помощью коммутируемого соединения, предоставляемого поставщиком интернет-услуг или с помощью прямого соединения к Интернету.\r\n\r\n            Марк Шертлер, вице-президент отдела безопасности компании “Primitive Logic Inc.” также рекомендует сотрудникам компаний использовать сложные пароли. «Многие в качестве пароля используют свое имя, либо фамилию, либо какое-либо легко запоминающееся слово. Это абсолютно недопустимо. Хакеры пользуются хитроумными программами, которые путем подбора простых распространенных слов в два счета могут вычислить ваш пароль. Поэтому используйте сложные пароли, типа: «dr8613zx”. Конечно, его не легко запомнить, но зато можете быть уверены, что ваша конфиденциальная информация будет в целости и сохранности» – говорит Шертлер\r\n\r\n            «Lewis and Roca” давно следуют этим советам, но после того ужасного теракта в Нью-Йорке в сентябре 2001 года, фирма стала еще более досконально изучать все слабые места собственной системе безопасности.  Внутренний отдел безопасности компании изучает, каким образом осуществляется доступ к их системе, включая Web –узел и корпоративную сеть. Сотрудники отдела также изучают возможность сохранения данных в случае природных катаклизмов, либо терактов. Но, по словам старшего сотрудника компании МакКормика, и этого не достаточно. «Увидев, как после теракта в Нью-Йорке по улицам Манхеттена летали «тучи» документов, которые принадлежали компаниям, чьи офисы располагались в Мировом торговом центре, мы поняли, что сохранность лишь электронных данных не может гарантировать нам стабильность и спокойствие. Бумажные документы значат для нас не меньше. Сейчас мы решаем проблему их оцифровки»- говорит он.\r\n\r\n            Тем не менее, несмотря на общую обеспокоенность проблемой виртуального терроризма, данные ФБР говорят о том, что чаще всего инциденты, связанные с порчей либо утратой информации происходят в стенах самих компаний. Во избежание этого, эксперты советуют компаниям тщательнее отслеживать активность в сети, устанавливать специальные программы, сигнализирующие об удалении больших объемов данных, а также устранить доступ бывших сотрудников к системе. Но, как признается специалист по безопасности компьютерных систем Генри Николз, нет и, вероятно, не будет ни одной компьютерной системы, которую бы не смогли взломать хакеры, какой бы хитроумной она ни была.\r\n\r\nВиртуальный терроризм. Часть 1.\r\n\r\nПо материалам: http://www.inc.com');
INSERT INTO `article_pages` VALUES (6, 6, 'Страница 1', 'Бизнесу не следует недооценивать кибертерроризм. Скажем, в Калифорнии, где землетрясение – явление отнюдь не редкое, нет, наверное, ни одной компании, которая бы не заботилась о собственной безопасности и сохранности своей конфиденциальной информации. Однако, когда речь заходит о виртуальном терроризме и его последствиях, некоторые до сих пор предпочитают отшучиваться, будто и нет такой проблемы. И, как показывает опыт, напрасно.\r\n\r\n            Что же должно быть на вооружении у малого бизнеса, для того чтобы не пострадать от действий кибертеррористов? Во-первых, - антивирусная программа. Стоимость их в среднем не превышает 100 долларов. Желательно также иметь в штате специалиста, который регулярно обновлял бы антивирусные базы. Большинство создателей антивирусных программ позволяют своим пользователям загружать обновления ежедневно, и даже ежечасно. Другим эффективным оружием против кибертерроризма является брандмауэр (программа, сканирующая сетевую активность и предотвращающая попытки внедрения в систему извне). Их стоимость колеблется от 50 долларов для домашнего бизнеса до нескольких тысяч для крупных предприятий, имеющих обширную интрасеть. Не менее важным условием безопасности данных является создание резервных копий важных документов. Для малых компаний вполне достаточно дублировать данные раз в неделю. Крупные компании, как правило, устанавливают специальное программное обеспечение, которое автоматически делает резервные копии и сохраняет их на носителях, к которым нет доступа из Интернета. Некоторые компании используют виртуальные частные сети (virtual private networks), для доступа к которым используется протокол PPTP, позволяющий удаленным пользователям безопасно обращаться к корпоративным сетям с помощью коммутируемого соединения, предоставляемого поставщиком интернет-услуг или с помощью прямого соединения к Интернету.\r\n\r\n            Марк Шертлер, вице-президент отдела безопасности компании “Primitive Logic Inc.” также рекомендует сотрудникам компаний использовать сложные пароли. «Многие в качестве пароля используют свое имя, либо фамилию, либо какое-либо легко запоминающееся слово. Это абсолютно недопустимо. Хакеры пользуются хитроумными программами, которые путем подбора простых распространенных слов в два счета могут вычислить ваш пароль. Поэтому используйте сложные пароли, типа: «dr8613zx”. Конечно, его не легко запомнить, но зато можете быть уверены, что ваша конфиденциальная информация будет в целости и сохранности» – говорит Шертлер\r\n\r\n            «Lewis and Roca” давно следуют этим советам, но после того ужасного теракта в Нью-Йорке в сентябре 2001 года, фирма стала еще более досконально изучать все слабые места собственной системе безопасности.  Внутренний отдел безопасности компании изучает, каким образом осуществляется доступ к их системе, включая Web –узел и корпоративную сеть. Сотрудники отдела также изучают возможность сохранения данных в случае природных катаклизмов, либо терактов. Но, по словам старшего сотрудника компании МакКормика, и этого не достаточно. «Увидев, как после теракта в Нью-Йорке по улицам Манхеттена летали «тучи» документов, которые принадлежали компаниям, чьи офисы располагались в Мировом торговом центре, мы поняли, что сохранность лишь электронных данных не может гарантировать нам стабильность и спокойствие. Бумажные документы значат для нас не меньше. Сейчас мы решаем проблему их оцифровки»- говорит он.\r\n\r\n            Тем не менее, несмотря на общую обеспокоенность проблемой виртуального терроризма, данные ФБР говорят о том, что чаще всего инциденты, связанные с порчей либо утратой информации происходят в стенах самих компаний. Во избежание этого, эксперты советуют компаниям тщательнее отслеживать активность в сети, устанавливать специальные программы, сигнализирующие об удалении больших объемов данных, а также устранить доступ бывших сотрудников к системе. Но, как признается специалист по безопасности компьютерных систем Генри Николз, нет и, вероятно, не будет ни одной компьютерной системы, которую бы не смогли взломать хакеры, какой бы хитроумной она ни была.\r\n\r\nВиртуальный терроризм. Часть 1.\r\n\r\nПо материалам: http://www.inc.com');
INSERT INTO `article_pages` VALUES (7, 7, 'Страница 1', 'Текст первой страницы');
INSERT INTO `article_pages` VALUES (8, 8, 'Страница 1', '<p><b>Текст страницы 1</b></p>');
INSERT INTO `article_pages` VALUES (9, 9, 'Украинский рынок акций идет ко дну, часть 1', '<p>Если бы кто-то из украинских фондовиков год назад сказал, что к середине 2008 года индекс ПФТС опустится ниже 800 пунктов, ему бы ни за что не поверили. Такого прогнозиста обозвали бы аматором и профаном, ведь уже тогда индекс ПФТС преодолел отметку в 1000 пунктов, показав более 100% роста за полгода.</p>\n<p>Но после того как с начала 2008 года индекс ПФТС рухнул на треть, профанами и аматорами выглядят эксперты-оптимисты, которые предсказывали к концу этого года преодоление рынком 2000 пунктов.</p>\n<p><b>Портфели &quot;ДЕЛА&quot; понесли рекордные потери</b></p>\n<p>События первого летнего месяца мало кому внушают оптимизм, скорее, наоборот. За последние две недели (период с 6 по 19 июня) индекс ПФТС обвалился на 11,8%. При этом в течение 8 из 9 торговых сессий, прошедших за это время, рынок падал и только 17 июня продемонстрировал незначительный плюс в 0,3%.</p>\n<p>Каких-то новых причин, способных вызвать такую коррекцию, аналитики назвать не могут - все апеллируют к хорошо знакомым обстоятельствам. &quot;Перегрев рынка в прошлом году, мировой финансовый кризис, укрепление гривни, политическая неопределенность&quot;, - перечисляет негативные факторы старший трейдер инвесткомпании &quot;Фойл Секьюритиз&quot; Вадим Самар.</p>\n<p>К этому набору можно добавить, что на прошлой неделе существенное давление на отечественный рынок оказывал внешний негативный фон. С 16 по 19 июня большинство мировых фондовых индексов дружно падали: Dow Jones IA - на 2,3%, Nikkei 225 - на 1,56%, FTSE 100 - на 1,6%. &quot;Ситуация на мировых рынках заставляет нерезидентов занимать выжидательную позицию относительно инвестирования в украинские бумаги, поэтому на рынке очень мало покупателей&quot;, - говорит брокер инвесткомпании &quot;Конкорд Капитал&quot; Анастасия Назаренко. Соглашаются с коллегой и в &quot;Тройке Диалог Украина&quot;. &quot;По сути, рынок падает из-за того, что предложение украинских акций есть, а спроса как не было, так и нет&quot;, - объясняет старший аналитик компании Роман Захаров.</p>\n<p>Редакционные инвестиции в украинские ценные бумаги не смогли избежать плачевной участи всего отечественного фондового рынка. За последние две недели (с 6 по 19 июня) наши портфели &quot;похудели&quot; на рекордные 85 тысяч гривен (-6% от общей стоимости их активов). Наибольшие потери понес портфель с агрессивной стратегией инвестирования, результат которого - минус 47 тысяч гривен (-9,1%). Не намного отстал &quot;Сбалансированный&quot; - минус 35 тысяч гривен (-8%). Убытки &quot;Консервативного&quot; в 1300 гривен на этом фоне выглядят чуть ли не фантастическим успехом.</p>');
INSERT INTO `article_pages` VALUES (10, 9, 'Украинский рынок акций идет ко дну, часть 2', '<p><b>&quot;Агрессивный&quot;. Попадало все, кроме Южного ГОКа</b></p>\n<p>В том, что больше других просел &quot;Агрессивный&quot;, чьи активы размещены в основном в акциях второго эшелона, ничего удивительного нет. Дело в том, что большинство этих бумаг продемонстрировали выдающуюся доходность в предыдущие периоды. Так что желающие их продать могут позволить себе значительно снизить цену и при этом остаться в небольшом плюсе. Так, девять из одиннадцати акций, входящих в этот портфель, подешевели более чем на 10%.</p>\n<p>Прекрасный результат для такого &quot;медвежьего&quot; рынка продемонстрировали бумаги Родовид Банка, показавшие &quot;всего-то&quot; минус 0,9% (здесь и далее указывается цена покупки (BID)). Одна из возможных причин их успеха - незначительная ликвидность: за две недели всего 7 сделок. Возможно, на мнение инвесторов, которые не спешат избавляться от бумаг этого банка, повлияло мнение аналитиков инвесткомпаний. К примеру, эксперты &quot;Конкорд Капитала&quot; видят более чем 50%-ный рост стоимости акций Родовид Банка в годичной перспективе.</p>\n<p>Но самой выдающейся акцией в этом портфеле за прошедший период стали бумаги Южного ГОКа, которые умудрились вырасти в цене на 0,6%. Искать рыночные и фундаментальные причины такого успеха бессмысленно. То, что ЮГОК дорожает уже пятый месяц кряду, невзирая на остальной рынок, имеет совсем другое объяснение. &quot;Бумаги Южного ГОКа скупаются компаниями, аффилированными с мажоритарными владельцами: группами &quot;Смарт&quot;, &quot;Метинвест&quot;, и &quot;Евраз&quot;. Следствием такой длительной целенаправленной скупки стало то, что вторичный рынок этих акций фактически отсутствует, поэтому они практически не подвержены рыночным колебаниям&quot;, - объясняет старший аналитик ИФГ &quot;Сократ&quot; Дмитрий Хорошун.</p>\n<p>Наибольшее падение котировок наблюдалось у акций &quot;АвтоКрАЗа&quot; (-20,2%), &quot;Днепроспецстали&quot; (-19,3%) и шахты &quot;Красноармейская-Западная №1&quot; (-18,4%). Самым правдоподобным объяснением такого резкого удешевления этих бумаг выглядит высказывание брокера крупной инвесткомпании. &quot;Наверное, кому-то очень надо было продать эти бумаги, вот они и попадали. Если бы на таком рынке продавцов было еще больше, могли бы вообще на 50-60% просесть&quot;, - объясняет торговец.</p>\n<p>Удивил своим результатом инвестиционный фонд &quot;Премиум-фонд Энергия&quot; - его падение составило всего 0,17%, в то время как результат большинства других фондов за аналогичный период составляет минус 5-10%. Но такой хороший результат объясняется не столько искусством управляющих фондом, сколько спецификой функционирования украинского рынка. Как объяснили в управляющей компании &quot;Сократ&quot;, некоторые бумаги фонда были проданы ранее и по более высокой цене, а фактическое зачисление средств от их продажи произошло намного позже.</p>');
INSERT INTO `article_pages` VALUES (11, 9, 'Украинский рынок акций идет ко дну, часть 3', '<p><b>&quot;Сбалансированный&quot;. Порадовал &quot;АрселорМиттал&quot;</b></p>\n<p>&quot;Голубые фишки&quot; оказались совсем ненадежным инструментом для инвестиций за минувшие две недели. Большинство из них подешевели на 10% и более. Итог - минус 35 тысяч за 9 торговых сессий - таких антирекордов &quot;Сбалансированный&quot; еще не устанавливал.</p>\n<p>Девять из десяти акций, входящих в состав этого портфеля снизились в цене, и только бумаги &quot;АрселорМиттал Кривой Рог&quot; смогли продемонстрировать положительную доходность, да еще какую - плюс 9% (!).</p>\n<p>Главная корпоративная новость по крупнейшему меткомбинату страны - рекордная выплата дивидендов за 2007 год на сумму около 5,8 миллиарда гривен (1,5 гривни на акцию). Такие дивиденды составляют около 9% от стоимости акции, что, по идее, и должно было подтолкнуть стоимость бумаг &quot;АрселорМиттал Кривой Рог&quot; к пропорциональному росту.</p>\n<p>Правда, аналитики так не думают. &quot;Отсечка реестра (дата, когда заканчивается внесение в список получателей дивидендов. - &quot;ДЕЛО&quot;) совпала с датой проведения собрания акционеров. Поэтому говорить, что новость о крупных дивидендах значительно повлияла на стоимость акций, я бы не стал (так как инвестору, купившему бумаги после даты отсечения, дивиденды выплачивать не будут. - &quot;ДЕЛО&quot;)&quot;, - говорит Дмитрий Хорошун. По его словам, основная причина стабильного удорожания этих бумаг - их скупка мажоритарным акционером, компанией &quot;АрселорМиттал&quot;.</p>\n<p>Снижение стоимости остальных девяти акций &quot;Сбалансированного&quot;, как и в случае с &quot;Агрессивным&quot;, инвесторы объясняют общими негативными рыночными тенденциями. Больше других на фоне общего падения рынка не повезло бумагам Енакиевского метзавода (-19,7%), &quot;Мариупольтяжмаша&quot; (-19,1%) и &quot;Укрнафты&quot; (-14,4%).</p>\n<p><b>&quot;Консервативный&quot;. Подвел инвестфонд</b></p>\n<p>Определенно, в нашей инвестиционной эпопее наступила черная полоса. Мало того, что рынок акций с начала года почти беспрерывно падает, так еще и вложения в более консервативные фининструменты - золото и депозит в евро - частенько стали демонстрировать отрицательную доходность.</p>\n<p>Вот и по результатам прошлых двух недель &quot;Консервативный&quot; показал минус 1,3 тысячи гривен. Правда, золото и евро перестали дешеветь и даже немного выросли в цене, на 0,8 и 0,2% соответственно. Но отрицательный результат инвестфонда &quot;Парекс фонд Украинских облигаций&quot; (-2,3%) напрочь перекрыл полученную доходность остальных инструментов.</p>');

-- --------------------------------------------------------

-- 
-- Структура таблицы `article_votes`
-- 

DROP TABLE IF EXISTS `article_votes`;
CREATE TABLE IF NOT EXISTS `article_votes` (
  `id` bigint(20) NOT NULL auto_increment,
  `article_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `vote` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Дамп данных таблицы `article_votes`
-- 

INSERT INTO `article_votes` VALUES (1, 8, 1, '', 86);
INSERT INTO `article_votes` VALUES (2, 9, 1, '', 7);
INSERT INTO `article_votes` VALUES (3, 9, 215, '', 100);
INSERT INTO `article_votes` VALUES (4, 9, 216, '', 95);
INSERT INTO `article_votes` VALUES (5, 15, 1, '', 5);

-- --------------------------------------------------------

-- 
-- Структура таблицы `articles`
-- 

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` bigint(20) NOT NULL auto_increment,
  `articles_tree_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `allowcomments` tinyint(4) NOT NULL,
  `rate_status` tinyint(4) NOT NULL,
  `rate` bigint(20) NOT NULL,
  `votes` bigint(20) NOT NULL,
  `comments` bigint(20) NOT NULL,
  `views` bigint(20) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- 
-- Дамп данных таблицы `articles`
-- 

INSERT INTO `articles` VALUES (9, 16, 'Украинский рынок акций идет ко дну', 1, 1, 1, 0, 0, 26, 489, '2008-06-24 14:38:25');
INSERT INTO `articles` VALUES (16, 19, 'Спорт должен быть спортивным!', 215, 0, 1, 0, 0, 0, 8, '2008-10-14 10:46:30');
INSERT INTO `articles` VALUES (15, 16, 'Новая тема', 1, 0, 1, 0, 1, 0, 4, '2008-10-14 10:45:09');

-- --------------------------------------------------------

-- 
-- Структура таблицы `articles_tree`
-- 

DROP TABLE IF EXISTS `articles_tree`;
CREATE TABLE IF NOT EXISTS `articles_tree` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `key` varchar(255) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- 
-- Дамп данных таблицы `articles_tree`
-- 

INSERT INTO `articles_tree` VALUES (17, 1, 'Политика', '00040001', 2, 0);
INSERT INTO `articles_tree` VALUES (14, 1, 'В России', '0001', 1, 0);
INSERT INTO `articles_tree` VALUES (15, 1, 'В Мире', '0005', 1, 0);
INSERT INTO `articles_tree` VALUES (16, 1, 'В Украине', '0004', 1, 0);
INSERT INTO `articles_tree` VALUES (18, 1, 'Экономика', '00010002', 2, 0);
INSERT INTO `articles_tree` VALUES (19, 1, 'Спорт', '00010003', 2, 0);
INSERT INTO `articles_tree` VALUES (20, 1, 'В Казахстане', '0006', 1, 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `avatars`
-- 

DROP TABLE IF EXISTS `avatars`;
CREATE TABLE IF NOT EXISTS `avatars` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `sys_av_id` int(11) NOT NULL default '0',
  `path` varchar(255) character set cp1251 default NULL,
  `av_name` varchar(50) default NULL,
  `def` tinyint(4) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

-- 
-- Дамп данных таблицы `avatars`
-- 

INSERT INTO `avatars` VALUES (48, 1, 6, '', 'hill', 1);
INSERT INTO `avatars` VALUES (45, 2, 0, '50367_1024_768.jpg', 'my', 1);
INSERT INTO `avatars` VALUES (49, 2, 5, '', 'winter', 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `ban_history`
-- 

DROP TABLE IF EXISTS `ban_history`;
CREATE TABLE IF NOT EXISTS `ban_history` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `type` int(2) default NULL,
  `action_by` int(11) default NULL,
  `warning_id` int(11) default NULL,
  `action_date` datetime default NULL,
  `banned_till` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

-- 
-- Дамп данных таблицы `ban_history`
-- 

INSERT INTO `ban_history` VALUES (28, 2, 1, 1, 1, '2008-03-19 03:56:10', '2008-03-27 00:00:00');
INSERT INTO `ban_history` VALUES (29, 2, 2, 1, NULL, '2008-03-19 03:56:15', NULL);
INSERT INTO `ban_history` VALUES (30, 2, 1, 1, 2, '2008-03-19 03:56:27', '2008-03-31 00:00:00');
INSERT INTO `ban_history` VALUES (31, 3, 1, 1, 3, '2008-03-19 03:56:39', '2008-03-31 00:00:00');
INSERT INTO `ban_history` VALUES (32, 2, 2, 1, NULL, '2008-03-19 03:58:35', NULL);
INSERT INTO `ban_history` VALUES (33, 2, 1, 1, 4, '2008-03-19 03:58:47', '2008-05-17 00:00:00');
INSERT INTO `ban_history` VALUES (34, 6, 1, 1, 5, '2008-06-23 09:24:31', '2008-12-12 00:00:00');
INSERT INTO `ban_history` VALUES (35, 2, 2, 1, NULL, '2008-10-30 11:31:05', NULL);
INSERT INTO `ban_history` VALUES (36, 3, 2, 1, NULL, '2008-11-07 10:22:25', NULL);
INSERT INTO `ban_history` VALUES (37, 6, 2, 1, NULL, '2008-11-14 13:00:40', NULL);
INSERT INTO `ban_history` VALUES (38, 2, 1, 1, 24, '2008-12-12 12:54:30', '2008-12-12 12:56:30');
INSERT INTO `ban_history` VALUES (39, 2, 2, 1, NULL, '2008-12-12 13:04:35', NULL);
INSERT INTO `ban_history` VALUES (40, 2, 1, 1, 27, '2008-12-12 13:06:47', '2008-12-12 13:08:47');
INSERT INTO `ban_history` VALUES (41, 2, 2, 1, NULL, '2008-12-12 13:22:50', NULL);
INSERT INTO `ban_history` VALUES (42, 2, 1, 1, 30, '2008-12-12 15:05:43', '2008-12-12 15:07:43');
INSERT INTO `ban_history` VALUES (43, 2, 2, 1, NULL, '2008-12-12 15:08:37', NULL);
INSERT INTO `ban_history` VALUES (44, 2, 1, 1, 31, '2008-12-12 15:28:47', '2008-12-13 00:00:00');
INSERT INTO `ban_history` VALUES (45, 2, 2, 1, NULL, '2008-12-12 15:30:34', NULL);
INSERT INTO `ban_history` VALUES (46, 2, 1, 1, 32, '2008-12-12 15:34:07', '2008-12-20 00:00:00');
INSERT INTO `ban_history` VALUES (47, 2, 2, 1, NULL, '2008-12-12 15:35:45', NULL);
INSERT INTO `ban_history` VALUES (48, 2, 1, 1, 33, '2008-12-12 15:36:10', '2008-12-21 00:00:00');
INSERT INTO `ban_history` VALUES (49, 2, 2, 1, NULL, '2008-12-12 15:36:27', NULL);
INSERT INTO `ban_history` VALUES (50, 2, 1, 1, 36, '2008-12-12 15:43:07', '2008-12-12 15:45:07');
INSERT INTO `ban_history` VALUES (51, 2, 2, 1, NULL, '2008-12-12 15:57:18', NULL);
INSERT INTO `ban_history` VALUES (52, 2, 2, 1, NULL, '2008-12-15 17:23:12', NULL);

-- --------------------------------------------------------

-- 
-- Структура таблицы `bc_tag`
-- 

DROP TABLE IF EXISTS `bc_tag`;
CREATE TABLE IF NOT EXISTS `bc_tag` (
  `id` bigint(20) NOT NULL auto_increment,
  `blog_catalog_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `posts_num` bigint(20) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `sortfield` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- 
-- Дамп данных таблицы `bc_tag`
-- 

INSERT INTO `bc_tag` VALUES (1, 5, 'a3', 1, 1, 1);
INSERT INTO `bc_tag` VALUES (2, 5, 'bbb', 2, 0, 0);
INSERT INTO `bc_tag` VALUES (6, 5, '12323432', 0, 1, 0);
INSERT INTO `bc_tag` VALUES (7, 5, '23324', 0, 0, 0);
INSERT INTO `bc_tag` VALUES (8, 5, 'asdas', 0, 1, 0);
INSERT INTO `bc_tag` VALUES (9, 1, '12', 0, 1, 0);
INSERT INTO `bc_tag` VALUES (10, 1, 'test', 0, 1, 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `blog`
-- 

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL,
  `title` varchar(255) character set cp1251 NOT NULL,
  `access` tinyint(4) NOT NULL,
  `creation_date` date NOT NULL,
  `creation_ip` varchar(15) character set cp1251 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Дамп данных таблицы `blog`
-- 

INSERT INTO `blog` VALUES (1, 1, 'Мой блог', 2, '2008-01-30', '127.0.0.1');
INSERT INTO `blog` VALUES (2, 225, 'Мой блог', 2, '2009-02-16', '127.0.0.1');

-- --------------------------------------------------------

-- 
-- Структура таблицы `blog_catalog`
-- 

DROP TABLE IF EXISTS `blog_catalog`;
CREATE TABLE IF NOT EXISTS `blog_catalog` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) character set cp1251 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- 
-- Дамп данных таблицы `blog_catalog`
-- 

INSERT INTO `blog_catalog` VALUES (1, 'раздел 1');
INSERT INTO `blog_catalog` VALUES (2, 'Кат 1.1');
INSERT INTO `blog_catalog` VALUES (3, 'Кат 1.23355');
INSERT INTO `blog_catalog` VALUES (4, 'Кат 2');
INSERT INTO `blog_catalog` VALUES (5, 'Кат 3_2');
INSERT INTO `blog_catalog` VALUES (6, 'Кат 4');
INSERT INTO `blog_catalog` VALUES (7, 'Кат 4.1');
INSERT INTO `blog_catalog` VALUES (8, 'Кат 4.2');
INSERT INTO `blog_catalog` VALUES (9, 'Кат 4.3');

-- --------------------------------------------------------

-- 
-- Структура таблицы `blog_comment`
-- 

DROP TABLE IF EXISTS `blog_comment`;
CREATE TABLE IF NOT EXISTS `blog_comment` (
  `id` bigint(20) NOT NULL auto_increment,
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `avatar_id` int(11) NOT NULL,
  `warning_id` int(11) NOT NULL,
  `mood` int(11) NOT NULL,
  `mood_text` varchar(100) default NULL,
  `adm_redacted` int(11) NOT NULL,
  `text` text,
  `creation_date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=4 ;

-- 
-- Дамп данных таблицы `blog_comment`
-- 

INSERT INTO `blog_comment` VALUES (1, 1, 1, 48, 17, 1, '', 1, 'testrr ен ен ене', '2008-12-04 14:57:37');
INSERT INTO `blog_comment` VALUES (3, 1, 1, 48, 0, 0, 'оппа', 0, '[quote name="admin"]tttt[/quote]\r\nttt', '2008-12-04 14:58:13');

-- --------------------------------------------------------

-- 
-- Структура таблицы `blog_post`
-- 

DROP TABLE IF EXISTS `blog_post`;
CREATE TABLE IF NOT EXISTS `blog_post` (
  `id` bigint(20) NOT NULL auto_increment,
  `ub_tree_id` bigint(20) NOT NULL,
  `bc_tag_id` bigint(20) NOT NULL,
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
  PRIMARY KEY  (`id`),
  KEY `ubt` (`ub_tree_id`),
  KEY `bct` (`bc_tag_id`),
  KEY `ind2` (`id`,`ub_tree_id`),
  KEY `access` (`ub_tree_id`,`access`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- 
-- Дамп данных таблицы `blog_post`
-- 

INSERT INTO `blog_post` VALUES (1, 1, 7, 'post1', 'smal text', 'sdfs\r\nfwer\r\ng34g\r\n5r\r\ng45\r\nh45\r\nh45', '2008-01-01', 3, 1, 13, 42, '3', 1, '127.0.0.1', 1);
INSERT INTO `blog_post` VALUES (5, 1, 1, 'post 4', 'asd', 'ft34t3434t34', '2008-01-04', 1, 1, 0, 1, '1', 1, '127.0.0.1', 1);
INSERT INTO `blog_post` VALUES (3, 18, 2, 'post35543434', '2323assdfvdf', '0f234fr34ft34', '2008-02-08', 3, 1, 2, 15, '2', 0, '127.0.0.1', 0);
INSERT INTO `blog_post` VALUES (9, 2, 6, 'pppp23', 'dsf', '423r', '2008-02-05', 2, 1, 1, 2, '2', 0, '127.0.0.1', 1);
INSERT INTO `blog_post` VALUES (4, 1, 0, 'post 4', '<p><i>asd</i></p>', '<p><b>ft34t3434t34</b></p>', '2008-01-04', 0, 1, 1, 1, '0', 0, '127.0.0.1', 1);
INSERT INTO `blog_post` VALUES (8, 18, 2, 'sdfdsf', 'sdf34ft', '34tr34', '2008-02-05', 2, 1, 0, 0, '1', 0, '127.0.0.1', 1);
INSERT INTO `blog_post` VALUES (10, 1, 0, 'Постег', '<p>ф<b>ывфывфы<br type="_moz" />\r\n</b></p>\r\n<p><b>2а2</b>а32а3</p>', '<p>фывй</p>\r\n<p>а23</p>\r\n<p>а3а4</p>\r\n<p>34а</p>\r\n<p>3а3а434а34а4</p>', '2008-03-17', 2, 1, 0, 0, '0', 0, '195.225.158.82', 1);

-- --------------------------------------------------------

-- 
-- Структура таблицы `blog_subscribe`
-- 

DROP TABLE IF EXISTS `blog_subscribe`;
CREATE TABLE IF NOT EXISTS `blog_subscribe` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL,
  `ub_tree_id` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `ind` (`ub_tree_id`,`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- 
-- Дамп данных таблицы `blog_subscribe`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `bookmarks`
-- 

DROP TABLE IF EXISTS `bookmarks`;
CREATE TABLE IF NOT EXISTS `bookmarks` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'ID пользователя, добавившего закладку',
  `bookmarks_tree_id` int(11) NOT NULL COMMENT 'ID раздела в дереве закладок',
  `url` text NOT NULL COMMENT 'URL закладки',
  `title` varchar(255) NOT NULL COMMENT 'Заголовок закладки',
  `description` text COMMENT 'Описание закладки',
  `is_public` tinyint(4) NOT NULL default '0' COMMENT 'Публичная ли закладка',
  `creation_date` datetime NOT NULL COMMENT 'Дата создания закладки',
  `views` int(11) NOT NULL default '0' COMMENT 'Число просмотров закладки',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Таблица закладок' AUTO_INCREMENT=33 ;

-- 
-- Дамп данных таблицы `bookmarks`
-- 

INSERT INTO `bookmarks` VALUES (1, 1, 8, 'http://auto.ru/', 'Автомобилики, разных типов и раскрасок, расцветок и цветов', 'Все про автомобили', 1, '2008-05-07 14:08:15', 4);
INSERT INTO `bookmarks` VALUES (2, 1, 13, 'http://my.hm/', 'Папка на кампике', 'Папка на моем личном компьютере', 1, '2008-05-07 17:14:47', 11);
INSERT INTO `bookmarks` VALUES (3, 2, 17, 'http://mail.ru/', 'mail.ru', 'Мой любимый почтовик', 1, '2008-05-07 17:14:53', 81);
INSERT INTO `bookmarks` VALUES (4, 1, 17, 'http://www.google.ru', 'Google - очень классный поисковик', 'Google - хороший поисковик, он не только прикольный, но и конечно лучший из поисковиков, развитый на данный момент. Впрочем о его сервисах и возможностях известно пожалуй чуть ли не каждому, кто знает, что такое интернет. Ля-ля ля ля тест на длинный description - достаточно длинный чтобы оценить как это будет выглядеть.', 0, '2008-05-09 00:31:34', 12503);
INSERT INTO `bookmarks` VALUES (5, 1, 13, 'http://admin.next24.hm/bookmarks_view/4/', 'Для девушек', 'Про девушек и не только', 1, '2008-05-01 19:15:34', 522);
INSERT INTO `bookmarks` VALUES (6, 1, 17, 'http://yahoo.com', 'TITLE: yahoo1', 'DESCR: yahoo\r\ntenp\r\nline 3', 1, '2008-05-07 19:15:10', 326);
INSERT INTO `bookmarks` VALUES (7, 1, 17, 'http://pochta.ru', 'Почта: pochta.ru', 'Почтовик, но менее известный', 1, '2008-05-07 17:15:18', 319);
INSERT INTO `bookmarks` VALUES (8, 2, 13, 'http://girl.com', 'Все о девушках да и не только', 'Тут вы можете почитать о девушках, всякое прекрасное, но этот сайт на англицком!', 1, '2008-05-03 23:59:00', 13);
INSERT INTO `bookmarks` VALUES (9, 1, 17, 'http://search.com', 'search', 'Малоизвестный поисковик Search.com', 1, '2008-05-07 14:09:13', 31);
INSERT INTO `bookmarks` VALUES (10, 1, 17, 'http://ff.com', 'seracher', 'Искалка бродилка', 1, '2008-05-07 14:09:13', 8);
INSERT INTO `bookmarks` VALUES (11, 1, 17, 'http://posmo.ru', 'mail', 'Письмеца заливалка', 1, '2008-05-07 14:09:14', 5);
INSERT INTO `bookmarks` VALUES (22, 1, 17, 'http://rsdn.ru/article/inet/jQuery.xml', 'Отличная штука', 'Удобный и быстрый JavaScript-фреймворк', 0, '2008-05-20 00:40:15', 1);
INSERT INTO `bookmarks` VALUES (23, 1, 8, 'http://ru.add-ons.mozilla.com/ru/firefox/bookmarks/', 'Расширения для работы с закладками', 'Расширения для работы с закладками', 0, '2008-05-28 17:24:19', 4);
INSERT INTO `bookmarks` VALUES (26, 1, 0, 'http://etorg/rss.php', 'еТорг - электронная коммерция, интернет торговля, новости интернет-магазинов, статьи и аналитика', 'еТорг - электронная коммерция, интернет торговля, новости интернет-магазинов, статьи и аналитика', 0, '2008-05-28 17:24:19', 1);
INSERT INTO `bookmarks` VALUES (27, 1, 0, 'http://ru.www.mozilla.com/ru/firefox/help/', 'Справка и руководства', 'Справка и руководства', 0, '2008-05-28 17:24:19', 0);
INSERT INTO `bookmarks` VALUES (28, 1, 0, 'http://ru.www.mozilla.com/ru/firefox/customize/', 'Настройка Firefox', 'Настройка Firefox', 0, '2008-05-28 17:24:19', 0);
INSERT INTO `bookmarks` VALUES (29, 1, 0, 'http://ru.www.mozilla.com/ru/firefox/community/', 'Присоединяйтесь к сообществу', 'Присоединяйтесь к сообществу', 0, '2008-05-28 17:24:19', 0);
INSERT INTO `bookmarks` VALUES (30, 1, 0, 'http://ru.www.mozilla.com/ru/firefox/about/', 'О нас', 'О нас', 0, '2008-05-28 17:24:19', 0);
INSERT INTO `bookmarks` VALUES (31, 1, 0, 'http://www.technotrade.com.ua/products.php?rubrika=%d2%ee%f7%ea%e8%20%e4%ee%f1%f2%f3%ef%e0&id_photo=7', 'Точки доступа, беспроводное сетевое оборудование, ТехноТрейд', 'Точки доступа, беспроводное сетевое оборудование, ТехноТрейд', 0, '2008-05-28 17:24:19', 0);
INSERT INTO `bookmarks` VALUES (32, 1, 0, 'http://forum.openx.org/index.php?showtopic=503419544&hl=flash%20banner&st=15', 'Small Question About Tracking Click Ad Flash - OpenX Community Forums', 'Small Question About Tracking Click Ad Flash - OpenX Community Forums', 0, '2008-05-28 17:24:19', 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `bookmarks_comment`
-- 

DROP TABLE IF EXISTS `bookmarks_comment`;
CREATE TABLE IF NOT EXISTS `bookmarks_comment` (
  `id` bigint(20) NOT NULL auto_increment,
  `bookmarks_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `avatar_id` int(11) NOT NULL,
  `warning_id` int(11) NOT NULL,
  `mood` int(11) NOT NULL,
  `mood_text` varchar(100) default NULL,
  `adm_redacted` int(11) NOT NULL,
  `text` text,
  `creation_date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=4 ;

-- 
-- Дамп данных таблицы `bookmarks_comment`
-- 

INSERT INTO `bookmarks_comment` VALUES (2, 7, 1, 34, 15, 0, 'gggg', 1, 'ggsdfgdfgdf\r\n\r\n\r\ndddsdfdf', '2008-12-02 16:59:26');
INSERT INTO `bookmarks_comment` VALUES (3, 7, 1, 40, 0, 0, '', 0, '[quote name="admin"]ggsdfgdfgdf[/quote]\r\nssss', '2008-12-02 16:59:33');

-- --------------------------------------------------------

-- 
-- Структура таблицы `bookmarks_tags`
-- 

DROP TABLE IF EXISTS `bookmarks_tags`;
CREATE TABLE IF NOT EXISTS `bookmarks_tags` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `name` varchar(100) NOT NULL COMMENT 'Имя тега',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Таблица тегов закладок' AUTO_INCREMENT=50 ;

-- 
-- Дамп данных таблицы `bookmarks_tags`
-- 

INSERT INTO `bookmarks_tags` VALUES (1, 'Реал');
INSERT INTO `bookmarks_tags` VALUES (2, 'Гугл');
INSERT INTO `bookmarks_tags` VALUES (3, 'Интернет');
INSERT INTO `bookmarks_tags` VALUES (4, 'Нравится');
INSERT INTO `bookmarks_tags` VALUES (5, 'Искать');
INSERT INTO `bookmarks_tags` VALUES (6, 'Сайт');
INSERT INTO `bookmarks_tags` VALUES (7, 'Клевый');
INSERT INTO `bookmarks_tags` VALUES (8, 'Реальный');
INSERT INTO `bookmarks_tags` VALUES (9, 'Лучший');
INSERT INTO `bookmarks_tags` VALUES (10, 'Нормальный');
INSERT INTO `bookmarks_tags` VALUES (11, 'Супер');
INSERT INTO `bookmarks_tags` VALUES (12, 'Точный');
INSERT INTO `bookmarks_tags` VALUES (13, 'Толковый');
INSERT INTO `bookmarks_tags` VALUES (14, 'Search');
INSERT INTO `bookmarks_tags` VALUES (15, 'Girls');
INSERT INTO `bookmarks_tags` VALUES (16, 'aaa');
INSERT INTO `bookmarks_tags` VALUES (17, 'bbb');
INSERT INTO `bookmarks_tags` VALUES (24, 'real');
INSERT INTO `bookmarks_tags` VALUES (23, 'tag02');
INSERT INTO `bookmarks_tags` VALUES (22, 'tag01');
INSERT INTO `bookmarks_tags` VALUES (34, 'ОченьДлинныйТегЧтобыПроверитьКакЭтоБудетВыглядетьИЧтоСЭтимДелать01');
INSERT INTO `bookmarks_tags` VALUES (33, 'mail.ru');
INSERT INTO `bookmarks_tags` VALUES (35, 'ОченьДлинныйТегЧтобыПроверитьКакЭтоБудетВыглядетьИЧтоСЭтимДелать02');
INSERT INTO `bookmarks_tags` VALUES (36, 'ОченьДлинныйТегЧтобыПроверитьКакЭтоБудетВыглядетьИЧтоСЭтимДелать03');
INSERT INTO `bookmarks_tags` VALUES (37, 'ОченьДлинныйТегЧтобыПроверитьКакЭтоБудетВыглядетьИЧтоСЭтимДелать04');
INSERT INTO `bookmarks_tags` VALUES (38, 'ОченьДлинныйТегЧтобыПроверитьКакЭтоБудетВыглядетьИЧтоСЭтимДелать05');
INSERT INTO `bookmarks_tags` VALUES (39, 'ОченьДлинныйТегЧтобыПроверитьКакЭтоБудетВыглядетьИЧтоСЭтимДелать06');
INSERT INTO `bookmarks_tags` VALUES (40, 'ОченьДлинныйТегЧтобыПроверитьКакЭтоБудетВыглядетьИЧтоСЭтимДелать07');
INSERT INTO `bookmarks_tags` VALUES (41, 'ОченьДлинныйТегЧтобыПроверитьКакЭтоБудетВыглядетьИЧтоСЭтимДелать08');
INSERT INTO `bookmarks_tags` VALUES (42, 'ТожеОченьДлинныйТегЧтобыПроверитьКакЭтоБудетВыглядетьИЧтоСЭтимДелать01');
INSERT INTO `bookmarks_tags` VALUES (43, 'ТожеОченьДлинныйТегЧтобыПроверитьКакЭтоБудетВыглядетьИЧтоСЭтимДелать02');
INSERT INTO `bookmarks_tags` VALUES (44, 'ТожеОченьДлинныйТегЧтобыПроверитьКакЭтоБудетВыглядетьИЧтоСЭтимДелать03');
INSERT INTO `bookmarks_tags` VALUES (45, 'ТожеОченьДлинныйТегЧтобыПроверитьКакЭтоБудетВыглядетьИЧтоСЭтимДелать04');
INSERT INTO `bookmarks_tags` VALUES (46, 'JavaScript');
INSERT INTO `bookmarks_tags` VALUES (47, 'быстрый');
INSERT INTO `bookmarks_tags` VALUES (48, 'удобный');
INSERT INTO `bookmarks_tags` VALUES (49, 'фреймворк');

-- --------------------------------------------------------

-- 
-- Структура таблицы `bookmarks_tags_links`
-- 

DROP TABLE IF EXISTS `bookmarks_tags_links`;
CREATE TABLE IF NOT EXISTS `bookmarks_tags_links` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `bookmarks_id` int(11) NOT NULL COMMENT 'bookmarks.ID закладки ',
  `bookmarks_tags_id` int(11) NOT NULL COMMENT 'bookmarks_tags.ID тега',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=92 DEFAULT CHARSET=latin1 COMMENT='Таблица связей закладок (bookmarks) и тегов (bookmarks_tags)' AUTO_INCREMENT=92 ;

-- 
-- Дамп данных таблицы `bookmarks_tags_links`
-- 

INSERT INTO `bookmarks_tags_links` VALUES (82, 6, 1);
INSERT INTO `bookmarks_tags_links` VALUES (78, 4, 4);
INSERT INTO `bookmarks_tags_links` VALUES (3, 10, 14);
INSERT INTO `bookmarks_tags_links` VALUES (86, 9, 14);
INSERT INTO `bookmarks_tags_links` VALUES (77, 4, 7);
INSERT INTO `bookmarks_tags_links` VALUES (76, 4, 5);
INSERT INTO `bookmarks_tags_links` VALUES (59, 5, 41);
INSERT INTO `bookmarks_tags_links` VALUES (75, 4, 2);
INSERT INTO `bookmarks_tags_links` VALUES (58, 5, 40);
INSERT INTO `bookmarks_tags_links` VALUES (57, 5, 39);
INSERT INTO `bookmarks_tags_links` VALUES (56, 5, 38);
INSERT INTO `bookmarks_tags_links` VALUES (37, 1, 22);
INSERT INTO `bookmarks_tags_links` VALUES (55, 5, 37);
INSERT INTO `bookmarks_tags_links` VALUES (54, 5, 36);
INSERT INTO `bookmarks_tags_links` VALUES (74, 4, 14);
INSERT INTO `bookmarks_tags_links` VALUES (51, 5, 15);
INSERT INTO `bookmarks_tags_links` VALUES (17, 3, 14);
INSERT INTO `bookmarks_tags_links` VALUES (53, 5, 35);
INSERT INTO `bookmarks_tags_links` VALUES (84, 7, 14);
INSERT INTO `bookmarks_tags_links` VALUES (52, 5, 34);
INSERT INTO `bookmarks_tags_links` VALUES (22, 11, 14);
INSERT INTO `bookmarks_tags_links` VALUES (50, 3, 33);
INSERT INTO `bookmarks_tags_links` VALUES (81, 6, 2);
INSERT INTO `bookmarks_tags_links` VALUES (60, 2, 42);
INSERT INTO `bookmarks_tags_links` VALUES (61, 2, 43);
INSERT INTO `bookmarks_tags_links` VALUES (62, 2, 44);
INSERT INTO `bookmarks_tags_links` VALUES (63, 2, 45);
INSERT INTO `bookmarks_tags_links` VALUES (83, 6, 7);
INSERT INTO `bookmarks_tags_links` VALUES (85, 7, 7);
INSERT INTO `bookmarks_tags_links` VALUES (87, 9, 7);
INSERT INTO `bookmarks_tags_links` VALUES (88, 22, 46);
INSERT INTO `bookmarks_tags_links` VALUES (89, 22, 47);
INSERT INTO `bookmarks_tags_links` VALUES (90, 22, 48);
INSERT INTO `bookmarks_tags_links` VALUES (91, 22, 49);

-- --------------------------------------------------------

-- 
-- Структура таблицы `bookmarks_tree`
-- 

DROP TABLE IF EXISTS `bookmarks_tree`;
CREATE TABLE IF NOT EXISTS `bookmarks_tree` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `parent_id` int(11) NOT NULL default '0' COMMENT 'ID родителя. Уровня в дереве всего 2.',
  `user_id` int(11) NOT NULL COMMENT 'ID пользователя, который добавил раздел',
  `name` varchar(100) NOT NULL COMMENT 'Имя раздела',
  `active` tinyint(4) NOT NULL default '0' COMMENT 'Активен ли раздел. Поле нужно для организации модерации.',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Таблица дерево закладок' AUTO_INCREMENT=25 ;

-- 
-- Дамп данных таблицы `bookmarks_tree`
-- 

INSERT INTO `bookmarks_tree` VALUES (2, 0, 1, 'Авто', 1);
INSERT INTO `bookmarks_tree` VALUES (8, 2, 1, 'Автомобили', 1);
INSERT INTO `bookmarks_tree` VALUES (9, 2, 1, 'Мото', 1);
INSERT INTO `bookmarks_tree` VALUES (12, 0, 1, 'Люди', 1);
INSERT INTO `bookmarks_tree` VALUES (13, 12, 1, 'Девушки', 1);
INSERT INTO `bookmarks_tree` VALUES (14, 12, 1, 'Парни', 1);
INSERT INTO `bookmarks_tree` VALUES (15, 12, 1, 'Знаменитости', 1);
INSERT INTO `bookmarks_tree` VALUES (16, 0, 1, 'Сайты', 1);
INSERT INTO `bookmarks_tree` VALUES (17, 16, 1, 'Поисковики', 1);
INSERT INTO `bookmarks_tree` VALUES (18, 16, 1, 'Почтовики', 1);
INSERT INTO `bookmarks_tree` VALUES (19, 16, 1, 'Развлечение', 1);
INSERT INTO `bookmarks_tree` VALUES (20, 0, 1, 'TEST', 0);
INSERT INTO `bookmarks_tree` VALUES (21, 20, 1, 'pod1', 0);
INSERT INTO `bookmarks_tree` VALUES (22, 16, 1, 'О программировании', 0);
INSERT INTO `bookmarks_tree` VALUES (24, 0, 1, 'Test', 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `cities`
-- 

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(12) unsigned NOT NULL,
  `region_id` int(12) unsigned NOT NULL,
  `country_id` int(12) unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `rid` (`region_id`),
  KEY `cid` (`country_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Дамп данных таблицы `cities`
-- 

INSERT INTO `cities` VALUES (83, 82, 81, 'Агдам');
INSERT INTO `cities` VALUES (84, 82, 81, 'Агдаш');
INSERT INTO `cities` VALUES (85, 82, 81, 'Агджабеди');
INSERT INTO `cities` VALUES (86, 82, 81, 'Аджикенд');
INSERT INTO `cities` VALUES (87, 82, 81, 'Акстафа');
INSERT INTO `cities` VALUES (88, 82, 81, 'Али-Байрамлы');
INSERT INTO `cities` VALUES (89, 82, 81, 'Алунитаг');
INSERT INTO `cities` VALUES (90, 82, 81, 'Артем-Остров');
INSERT INTO `cities` VALUES (91, 82, 81, 'Астара');
INSERT INTO `cities` VALUES (92, 82, 81, 'Ахсу');
INSERT INTO `cities` VALUES (93, 82, 81, 'Баку');
INSERT INTO `cities` VALUES (94, 82, 81, 'Балаханы');
INSERT INTO `cities` VALUES (95, 82, 81, 'Банк');
INSERT INTO `cities` VALUES (96, 82, 81, 'Барда');
INSERT INTO `cities` VALUES (97, 82, 81, 'Белоканы');
INSERT INTO `cities` VALUES (278009, 82, 81, 'Биласувар');
INSERT INTO `cities` VALUES (98, 82, 81, 'Бинагади');
INSERT INTO `cities` VALUES (99, 82, 81, 'Бирмай');
INSERT INTO `cities` VALUES (100, 82, 81, 'Бузовна');
INSERT INTO `cities` VALUES (101, 82, 81, 'Варташен');
INSERT INTO `cities` VALUES (102, 82, 81, 'Гадрут');
INSERT INTO `cities` VALUES (103, 82, 81, 'Геокчай');
INSERT INTO `cities` VALUES (104, 82, 81, 'Гобустан');
INSERT INTO `cities` VALUES (105, 82, 81, 'Горадиз');
INSERT INTO `cities` VALUES (106, 82, 81, 'Гэтргян');
INSERT INTO `cities` VALUES (129, 82, 81, 'Гянджа (Кировобад)');
INSERT INTO `cities` VALUES (107, 82, 81, 'Дальмамедли');
INSERT INTO `cities` VALUES (108, 82, 81, 'Дашкесан');
INSERT INTO `cities` VALUES (109, 82, 81, 'Джалилабад');
INSERT INTO `cities` VALUES (110, 82, 81, 'Джебраил');
INSERT INTO `cities` VALUES (111, 82, 81, 'Дивичи');
INSERT INTO `cities` VALUES (112, 82, 81, 'Евлах');
INSERT INTO `cities` VALUES (113, 82, 81, 'Ждановск');
INSERT INTO `cities` VALUES (114, 82, 81, 'Закаталы');
INSERT INTO `cities` VALUES (115, 82, 81, 'Зангелан');
INSERT INTO `cities` VALUES (116, 82, 81, 'Зардоб');
INSERT INTO `cities` VALUES (117, 82, 81, 'Имишли');
INSERT INTO `cities` VALUES (118, 82, 81, 'Исмаиллы');
INSERT INTO `cities` VALUES (119, 82, 81, 'Истису');
INSERT INTO `cities` VALUES (120, 82, 81, 'Казанбулак');
INSERT INTO `cities` VALUES (121, 82, 81, 'Казах');
INSERT INTO `cities` VALUES (122, 82, 81, 'Кази-Магомед');
INSERT INTO `cities` VALUES (123, 82, 81, 'Карачала');
INSERT INTO `cities` VALUES (124, 82, 81, 'Касум-Исмаилов');
INSERT INTO `cities` VALUES (125, 82, 81, 'Кахи');
INSERT INTO `cities` VALUES (126, 82, 81, 'Кедабек');
INSERT INTO `cities` VALUES (127, 82, 81, 'Кельбаджар');
INSERT INTO `cities` VALUES (128, 82, 81, 'Кергез');
INSERT INTO `cities` VALUES (130, 82, 81, 'Кировск');
INSERT INTO `cities` VALUES (131, 82, 81, 'Кировский');
INSERT INTO `cities` VALUES (132, 82, 81, 'Куба');
INSERT INTO `cities` VALUES (133, 82, 81, 'Кубатлы');
INSERT INTO `cities` VALUES (89915689, 82, 81, 'Кусары');
INSERT INTO `cities` VALUES (134, 82, 81, 'Куткашен');
INSERT INTO `cities` VALUES (135, 82, 81, 'Кюрдамир');
INSERT INTO `cities` VALUES (136, 82, 81, 'Ленкорань');
INSERT INTO `cities` VALUES (137, 82, 81, 'Лерик');
INSERT INTO `cities` VALUES (138, 82, 81, 'Маргуни');
INSERT INTO `cities` VALUES (139, 82, 81, 'Мардакерт');
INSERT INTO `cities` VALUES (140, 82, 81, 'Масаллы');
INSERT INTO `cities` VALUES (141, 82, 81, 'Маштага');
INSERT INTO `cities` VALUES (142, 82, 81, 'Мингечаур');
INSERT INTO `cities` VALUES (143, 82, 81, 'Мир-Башир');
INSERT INTO `cities` VALUES (144, 82, 81, 'Нафталан');
INSERT INTO `cities` VALUES (145, 82, 81, 'Нефтечала');
INSERT INTO `cities` VALUES (146, 82, 81, 'Пушкино');
INSERT INTO `cities` VALUES (147, 82, 81, 'Саатлы');
INSERT INTO `cities` VALUES (148, 82, 81, 'Сабирабад');
INSERT INTO `cities` VALUES (149, 82, 81, 'Сабуичи');
INSERT INTO `cities` VALUES (150, 82, 81, 'Сальяны');
INSERT INTO `cities` VALUES (151, 82, 81, 'Сиазань');
INSERT INTO `cities` VALUES (152, 82, 81, 'Сумгаит');
INSERT INTO `cities` VALUES (153, 82, 81, 'Тауз');
INSERT INTO `cities` VALUES (154, 82, 81, 'Уджары');
INSERT INTO `cities` VALUES (155, 82, 81, 'Физули');
INSERT INTO `cities` VALUES (156, 82, 81, 'Ханлар');
INSERT INTO `cities` VALUES (157, 82, 81, 'Хачмас');
INSERT INTO `cities` VALUES (158, 82, 81, 'Худат');
INSERT INTO `cities` VALUES (159, 82, 81, 'Шамхор');
INSERT INTO `cities` VALUES (160, 82, 81, 'Шаумяновск');
INSERT INTO `cities` VALUES (161, 82, 81, 'Шеки');
INSERT INTO `cities` VALUES (162, 82, 81, 'Шемаха');
INSERT INTO `cities` VALUES (163, 82, 81, 'Ярдымлы');
INSERT INTO `cities` VALUES (165, 164, 81, 'Степанокерт');
INSERT INTO `cities` VALUES (166, 164, 81, 'Шуша');
INSERT INTO `cities` VALUES (168, 167, 81, 'Джульфа');
INSERT INTO `cities` VALUES (169, 167, 81, 'Ильичевск');
INSERT INTO `cities` VALUES (170, 167, 81, 'Нахичевань');
INSERT INTO `cities` VALUES (171, 167, 81, 'Ордубад');
INSERT INTO `cities` VALUES (172, 167, 81, 'Шахбуз');
INSERT INTO `cities` VALUES (175, 174, 173, 'Ангилья');
INSERT INTO `cities` VALUES (176, 174, 173, 'Сомбреро');
INSERT INTO `cities` VALUES (250, 249, 248, 'Антополь');
INSERT INTO `cities` VALUES (251, 249, 248, 'Барановичи');
INSERT INTO `cities` VALUES (252, 249, 248, 'Белоозерск');
INSERT INTO `cities` VALUES (253, 249, 248, 'Береза');
INSERT INTO `cities` VALUES (254, 249, 248, 'Береза Картуска');
INSERT INTO `cities` VALUES (255, 249, 248, 'Брест');
INSERT INTO `cities` VALUES (256, 249, 248, 'Высокое');
INSERT INTO `cities` VALUES (257, 249, 248, 'Ганцевичи');
INSERT INTO `cities` VALUES (258, 249, 248, 'Городище');
INSERT INTO `cities` VALUES (259, 249, 248, 'Давид-Городок');
INSERT INTO `cities` VALUES (260, 249, 248, 'Домачево');
INSERT INTO `cities` VALUES (261, 249, 248, 'Дрогичин');
INSERT INTO `cities` VALUES (262, 249, 248, 'Жабинка');
INSERT INTO `cities` VALUES (263, 249, 248, 'Ивацевичи');
INSERT INTO `cities` VALUES (264, 249, 248, 'Каменец');
INSERT INTO `cities` VALUES (265, 249, 248, 'Кобрин');
INSERT INTO `cities` VALUES (266, 249, 248, 'Лунинец');
INSERT INTO `cities` VALUES (267, 249, 248, 'Ляховичи');
INSERT INTO `cities` VALUES (268, 249, 248, 'Малорита');
INSERT INTO `cities` VALUES (105919706, 249, 248, 'Новолукомль');
INSERT INTO `cities` VALUES (366, 249, 248, 'Пинск');
INSERT INTO `cities` VALUES (270, 249, 248, 'Пружаны');
INSERT INTO `cities` VALUES (271, 249, 248, 'Столин');
INSERT INTO `cities` VALUES (273, 272, 248, 'Барань');
INSERT INTO `cities` VALUES (274, 272, 248, 'Бегомль');
INSERT INTO `cities` VALUES (275, 272, 248, 'Бешенковичи');
INSERT INTO `cities` VALUES (276, 272, 248, 'Богушевск');
INSERT INTO `cities` VALUES (277, 272, 248, 'Браслав');
INSERT INTO `cities` VALUES (278, 272, 248, 'Верхнедвинск');
INSERT INTO `cities` VALUES (279, 272, 248, 'Ветрино');
INSERT INTO `cities` VALUES (280, 272, 248, 'Видзы');
INSERT INTO `cities` VALUES (281, 272, 248, 'Витебск');
INSERT INTO `cities` VALUES (282, 272, 248, 'Воропаево');
INSERT INTO `cities` VALUES (283, 272, 248, 'Глубокое');
INSERT INTO `cities` VALUES (284, 272, 248, 'Городок');
INSERT INTO `cities` VALUES (285, 272, 248, 'Дисна');
INSERT INTO `cities` VALUES (286, 272, 248, 'Докшицы');
INSERT INTO `cities` VALUES (287, 272, 248, 'Друя');
INSERT INTO `cities` VALUES (288, 272, 248, 'Дубровно');
INSERT INTO `cities` VALUES (289, 272, 248, 'Езерище');
INSERT INTO `cities` VALUES (290, 272, 248, 'Лепель');
INSERT INTO `cities` VALUES (291, 272, 248, 'Лиозно');
INSERT INTO `cities` VALUES (292, 272, 248, 'Миоры');
INSERT INTO `cities` VALUES (293, 272, 248, 'Новополоцк');
INSERT INTO `cities` VALUES (294, 272, 248, 'Орша');
INSERT INTO `cities` VALUES (295, 272, 248, 'Полоцк');
INSERT INTO `cities` VALUES (296, 272, 248, 'Поставы');
INSERT INTO `cities` VALUES (297, 272, 248, 'Россоны');
INSERT INTO `cities` VALUES (298, 272, 248, 'Сенно');
INSERT INTO `cities` VALUES (299, 272, 248, 'Толочин');
INSERT INTO `cities` VALUES (300, 272, 248, 'Ушачи');
INSERT INTO `cities` VALUES (301, 272, 248, 'Чашники');
INSERT INTO `cities` VALUES (302, 272, 248, 'Шарковщина');
INSERT INTO `cities` VALUES (303, 272, 248, 'Шумилино');
INSERT INTO `cities` VALUES (305, 304, 248, 'Белицк');
INSERT INTO `cities` VALUES (306, 304, 248, 'Большевик');
INSERT INTO `cities` VALUES (307, 304, 248, 'Брагин');
INSERT INTO `cities` VALUES (308, 304, 248, 'Буда-Кошелево');
INSERT INTO `cities` VALUES (309, 304, 248, 'Василевичи');
INSERT INTO `cities` VALUES (310, 304, 248, 'Васильевка');
INSERT INTO `cities` VALUES (311, 304, 248, 'Ветка');
INSERT INTO `cities` VALUES (312, 304, 248, 'Гомель');
INSERT INTO `cities` VALUES (313, 304, 248, 'Добруш');
INSERT INTO `cities` VALUES (314, 304, 248, 'Ельск');
INSERT INTO `cities` VALUES (315, 304, 248, 'Житковичи');
INSERT INTO `cities` VALUES (316, 304, 248, 'Жлобин');
INSERT INTO `cities` VALUES (317, 304, 248, 'Калинковичи');
INSERT INTO `cities` VALUES (318, 304, 248, 'Корма');
INSERT INTO `cities` VALUES (319, 304, 248, 'Лельчицы');
INSERT INTO `cities` VALUES (320, 304, 248, 'Лоев');
INSERT INTO `cities` VALUES (321, 304, 248, 'Мозырь');
INSERT INTO `cities` VALUES (322, 304, 248, 'Наровля');
INSERT INTO `cities` VALUES (323, 304, 248, 'Октябрьский');
INSERT INTO `cities` VALUES (324, 304, 248, 'Петриков');
INSERT INTO `cities` VALUES (325, 304, 248, 'Речица');
INSERT INTO `cities` VALUES (71486925, 304, 248, 'Речица');
INSERT INTO `cities` VALUES (71509079, 304, 248, 'Речица');
INSERT INTO `cities` VALUES (326, 304, 248, 'Рогачев');
INSERT INTO `cities` VALUES (327, 304, 248, 'Светлогорск');
INSERT INTO `cities` VALUES (328, 304, 248, 'Хойники');
INSERT INTO `cities` VALUES (329, 304, 248, 'Чечерск');
INSERT INTO `cities` VALUES (331, 330, 248, 'Большая Берестовица');
INSERT INTO `cities` VALUES (332, 330, 248, 'Волковыск');
INSERT INTO `cities` VALUES (333, 330, 248, 'Вороново');
INSERT INTO `cities` VALUES (334, 330, 248, 'Гродно');
INSERT INTO `cities` VALUES (12363228, 330, 248, 'Дятлово');
INSERT INTO `cities` VALUES (335, 330, 248, 'Желудок');
INSERT INTO `cities` VALUES (336, 330, 248, 'Зельва');
INSERT INTO `cities` VALUES (337, 330, 248, 'Ивье');
INSERT INTO `cities` VALUES (338, 330, 248, 'Козловщина');
INSERT INTO `cities` VALUES (339, 330, 248, 'Кореличи');
INSERT INTO `cities` VALUES (340, 330, 248, 'Лида');
INSERT INTO `cities` VALUES (341, 330, 248, 'Мосты');
INSERT INTO `cities` VALUES (342, 330, 248, 'Новогрудок');
INSERT INTO `cities` VALUES (343, 330, 248, 'Островец');
INSERT INTO `cities` VALUES (344, 330, 248, 'Ошмяны');
INSERT INTO `cities` VALUES (345, 330, 248, 'Свислочь');
INSERT INTO `cities` VALUES (346, 330, 248, 'Слоним');
INSERT INTO `cities` VALUES (347, 330, 248, 'Сморгонь');
INSERT INTO `cities` VALUES (348, 330, 248, 'Щучин');
INSERT INTO `cities` VALUES (350, 349, 248, 'Березино');
INSERT INTO `cities` VALUES (351, 349, 248, 'Бобр');
INSERT INTO `cities` VALUES (352, 349, 248, 'Борисов');
INSERT INTO `cities` VALUES (353, 349, 248, 'Вилейка');
INSERT INTO `cities` VALUES (354, 349, 248, 'Воложин');
INSERT INTO `cities` VALUES (355, 349, 248, 'Городея');
INSERT INTO `cities` VALUES (356, 349, 248, 'Дзержинск');
INSERT INTO `cities` VALUES (357, 349, 248, 'Жодино');
INSERT INTO `cities` VALUES (358, 349, 248, 'Заславль');
INSERT INTO `cities` VALUES (359, 349, 248, 'Зеленый Бор');
INSERT INTO `cities` VALUES (360, 349, 248, 'Ивенец');
INSERT INTO `cities` VALUES (361, 349, 248, 'Клецк');
INSERT INTO `cities` VALUES (362, 349, 248, 'Копыль');
INSERT INTO `cities` VALUES (363, 349, 248, 'Крупки');
INSERT INTO `cities` VALUES (364, 349, 248, 'Логойск');
INSERT INTO `cities` VALUES (51376057, 349, 248, 'Любань');
INSERT INTO `cities` VALUES (365, 349, 248, 'Марьина Горка');
INSERT INTO `cities` VALUES (269, 349, 248, 'Минск');
INSERT INTO `cities` VALUES (367, 349, 248, 'Молодечно');
INSERT INTO `cities` VALUES (368, 349, 248, 'Мядель');
INSERT INTO `cities` VALUES (369, 349, 248, 'Несвиж');
INSERT INTO `cities` VALUES (370, 349, 248, 'Слуцк');
INSERT INTO `cities` VALUES (371, 349, 248, 'Смолевичи');
INSERT INTO `cities` VALUES (372, 349, 248, 'Солигорск');
INSERT INTO `cities` VALUES (373, 349, 248, 'Старые Дороги');
INSERT INTO `cities` VALUES (374, 349, 248, 'Столбцы');
INSERT INTO `cities` VALUES (375, 349, 248, 'Узда');
INSERT INTO `cities` VALUES (20715225, 349, 248, 'Фаниполь');
INSERT INTO `cities` VALUES (376, 349, 248, 'Червень');
INSERT INTO `cities` VALUES (378, 377, 248, 'Белыничи');
INSERT INTO `cities` VALUES (379, 377, 248, 'Бобруйск');
INSERT INTO `cities` VALUES (380, 377, 248, 'Быхов');
INSERT INTO `cities` VALUES (381, 377, 248, 'Глуск');
INSERT INTO `cities` VALUES (382, 377, 248, 'Глуша');
INSERT INTO `cities` VALUES (383, 377, 248, 'Горки');
INSERT INTO `cities` VALUES (384, 377, 248, 'Гродзянка');
INSERT INTO `cities` VALUES (385, 377, 248, 'Елизово');
INSERT INTO `cities` VALUES (386, 377, 248, 'Кировск');
INSERT INTO `cities` VALUES (387, 377, 248, 'Климовичи');
INSERT INTO `cities` VALUES (388, 377, 248, 'Кличев');
INSERT INTO `cities` VALUES (389, 377, 248, 'Костюковичи');
INSERT INTO `cities` VALUES (390, 377, 248, 'Краснополье');
INSERT INTO `cities` VALUES (391, 377, 248, 'Кричев');
INSERT INTO `cities` VALUES (392, 377, 248, 'Круглое');
INSERT INTO `cities` VALUES (393, 377, 248, 'Могилев');
INSERT INTO `cities` VALUES (394, 377, 248, 'Мстиславль');
INSERT INTO `cities` VALUES (395, 377, 248, 'Осиповичи');
INSERT INTO `cities` VALUES (396, 377, 248, 'Славгород');
INSERT INTO `cities` VALUES (397, 377, 248, 'Хотимск');
INSERT INTO `cities` VALUES (398, 377, 248, 'Чаусы');
INSERT INTO `cities` VALUES (399, 377, 248, 'Чериков');
INSERT INTO `cities` VALUES (400, 377, 248, 'Шклов');
INSERT INTO `cities` VALUES (403, 402, 401, 'Белиз-Сити');
INSERT INTO `cities` VALUES (427, 426, 425, 'Гамильтон');
INSERT INTO `cities` VALUES (973, 972, 971, 'Кан-То');
INSERT INTO `cities` VALUES (974, 972, 971, 'Рач-Гиа');
INSERT INTO `cities` VALUES (976, 975, 971, 'Нам-Динх');
INSERT INTO `cities` VALUES (977, 975, 971, 'Хайфон');
INSERT INTO `cities` VALUES (978, 975, 971, 'Ханой');
INSERT INTO `cities` VALUES (980, 979, 971, 'Вунг-Тау');
INSERT INTO `cities` VALUES (981, 979, 971, 'Сайгон');
INSERT INTO `cities` VALUES (983, 982, 971, 'Дананг');
INSERT INTO `cities` VALUES (984, 982, 971, 'Нячанг');
INSERT INTO `cities` VALUES (985, 982, 971, 'Пхан-Тхит');
INSERT INTO `cities` VALUES (986, 982, 971, 'Туи-Хоа');
INSERT INTO `cities` VALUES (988, 987, 971, 'Винь');
INSERT INTO `cities` VALUES (989, 987, 971, 'Хуэ');
INSERT INTO `cities` VALUES (991, 990, 971, 'Хон-Гаи');
INSERT INTO `cities` VALUES (993, 992, 971, 'Плейку');
INSERT INTO `cities` VALUES (996, 995, 994, 'Гонаивес');
INSERT INTO `cities` VALUES (1000, 999, 994, 'Порт-де-Пакс');
INSERT INTO `cities` VALUES (1002, 1001, 994, 'Порт-о-Пренс');
INSERT INTO `cities` VALUES (1004, 1003, 994, 'Лес-Кайес');
INSERT INTO `cities` VALUES (1006, 1005, 994, 'Джакмель');
INSERT INTO `cities` VALUES (1009, 1008, 1007, 'Пойнт-а-Питр');
INSERT INTO `cities` VALUES (1011, 1010, 1007, 'Бассе-Терре');
INSERT INTO `cities` VALUES (1282, 1281, 1280, 'Авадхара');
INSERT INTO `cities` VALUES (1283, 1281, 1280, 'Гагра');
INSERT INTO `cities` VALUES (1284, 1281, 1280, 'Гали');
INSERT INTO `cities` VALUES (1285, 1281, 1280, 'Гудаута');
INSERT INTO `cities` VALUES (1286, 1281, 1280, 'Гульрипш');
INSERT INTO `cities` VALUES (1287, 1281, 1280, 'Новый Афон');
INSERT INTO `cities` VALUES (1288, 1281, 1280, 'Очамчир');
INSERT INTO `cities` VALUES (1289, 1281, 1280, 'Пицунда');
INSERT INTO `cities` VALUES (1290, 1281, 1280, 'Сухуми');
INSERT INTO `cities` VALUES (1291, 1281, 1280, 'Ткварчели');
INSERT INTO `cities` VALUES (1293, 1292, 1280, 'Батуми');
INSERT INTO `cities` VALUES (1294, 1292, 1280, 'Кобулети');
INSERT INTO `cities` VALUES (1295, 1292, 1280, 'Хуло');
INSERT INTO `cities` VALUES (1297, 1296, 1280, 'Абастумани');
INSERT INTO `cities` VALUES (1298, 1296, 1280, 'Абаша');
INSERT INTO `cities` VALUES (1299, 1296, 1280, 'Агара');
INSERT INTO `cities` VALUES (1300, 1296, 1280, 'Адигени');
INSERT INTO `cities` VALUES (1301, 1296, 1280, 'Амбролаури');
INSERT INTO `cities` VALUES (1302, 1296, 1280, 'Аспиндза');
INSERT INTO `cities` VALUES (1303, 1296, 1280, 'Ахалкалаки');
INSERT INTO `cities` VALUES (1304, 1296, 1280, 'Ахалцихе');
INSERT INTO `cities` VALUES (1305, 1296, 1280, 'Ахмета');
INSERT INTO `cities` VALUES (1306, 1296, 1280, 'Бакуриани');
INSERT INTO `cities` VALUES (1307, 1296, 1280, 'Богдановка');
INSERT INTO `cities` VALUES (1308, 1296, 1280, 'Болниси');
INSERT INTO `cities` VALUES (1309, 1296, 1280, 'Боржоми');
INSERT INTO `cities` VALUES (1310, 1296, 1280, 'Вани');
INSERT INTO `cities` VALUES (1311, 1296, 1280, 'Гардабани');
INSERT INTO `cities` VALUES (1312, 1296, 1280, 'Гегечкори');
INSERT INTO `cities` VALUES (1313, 1296, 1280, 'Гори');
INSERT INTO `cities` VALUES (1314, 1296, 1280, 'Гурджаани');
INSERT INTO `cities` VALUES (1315, 1296, 1280, 'Джвари');
INSERT INTO `cities` VALUES (1316, 1296, 1280, 'Дманиси');
INSERT INTO `cities` VALUES (1317, 1296, 1280, 'Душети');
INSERT INTO `cities` VALUES (1318, 1296, 1280, 'Зестафони');
INSERT INTO `cities` VALUES (1319, 1296, 1280, 'Зугдиди');
INSERT INTO `cities` VALUES (1320, 1296, 1280, 'Казбеги');
INSERT INTO `cities` VALUES (1321, 1296, 1280, 'Карели');
INSERT INTO `cities` VALUES (1322, 1296, 1280, 'Каспи');
INSERT INTO `cities` VALUES (1323, 1296, 1280, 'Кваиси');
INSERT INTO `cities` VALUES (1324, 1296, 1280, 'Кварели');
INSERT INTO `cities` VALUES (1325, 1296, 1280, 'Коджори');
INSERT INTO `cities` VALUES (1326, 1296, 1280, 'Кутаиси');
INSERT INTO `cities` VALUES (1327, 1296, 1280, 'Лагодехи');
INSERT INTO `cities` VALUES (1328, 1296, 1280, 'Ланчхути');
INSERT INTO `cities` VALUES (1329, 1296, 1280, 'Ленингори');
INSERT INTO `cities` VALUES (1330, 1296, 1280, 'Лентехи');
INSERT INTO `cities` VALUES (1331, 1296, 1280, 'Марнеули');
INSERT INTO `cities` VALUES (1332, 1296, 1280, 'Махарадзе');
INSERT INTO `cities` VALUES (1333, 1296, 1280, 'Маяковский');
INSERT INTO `cities` VALUES (1334, 1296, 1280, 'Местиа');
INSERT INTO `cities` VALUES (1335, 1296, 1280, 'Они');
INSERT INTO `cities` VALUES (1336, 1296, 1280, 'Орджоникидзе');
INSERT INTO `cities` VALUES (1337, 1296, 1280, 'Пасанаури');
INSERT INTO `cities` VALUES (1338, 1296, 1280, 'Поти');
INSERT INTO `cities` VALUES (1339, 1296, 1280, 'Рустави');
INSERT INTO `cities` VALUES (1340, 1296, 1280, 'Сагареджо');
INSERT INTO `cities` VALUES (1341, 1296, 1280, 'Самтредиа');
INSERT INTO `cities` VALUES (1342, 1296, 1280, 'Сачхере');
INSERT INTO `cities` VALUES (1343, 1296, 1280, 'Сигнахи');
INSERT INTO `cities` VALUES (1344, 1296, 1280, 'Тбилиси');
INSERT INTO `cities` VALUES (1345, 1296, 1280, 'Телави');
INSERT INTO `cities` VALUES (1346, 1296, 1280, 'Тержола');
INSERT INTO `cities` VALUES (1347, 1296, 1280, 'Тетри-Цкаро');
INSERT INTO `cities` VALUES (1348, 1296, 1280, 'Тианети');
INSERT INTO `cities` VALUES (1349, 1296, 1280, 'Ткибули');
INSERT INTO `cities` VALUES (1350, 1296, 1280, 'Хашури');
INSERT INTO `cities` VALUES (1351, 1296, 1280, 'Хоби');
INSERT INTO `cities` VALUES (1352, 1296, 1280, 'Цагери');
INSERT INTO `cities` VALUES (1353, 1296, 1280, 'Цаленджиха');
INSERT INTO `cities` VALUES (1354, 1296, 1280, 'Цалка');
INSERT INTO `cities` VALUES (1355, 1296, 1280, 'Цители-Цкаро');
INSERT INTO `cities` VALUES (1356, 1296, 1280, 'Цнори');
INSERT INTO `cities` VALUES (1357, 1296, 1280, 'Цулукидзе');
INSERT INTO `cities` VALUES (1358, 1296, 1280, 'Цхакая');
INSERT INTO `cities` VALUES (1359, 1296, 1280, 'Цхалтубо');
INSERT INTO `cities` VALUES (1360, 1296, 1280, 'Чиатура');
INSERT INTO `cities` VALUES (1361, 1296, 1280, 'Чохатаури');
INSERT INTO `cities` VALUES (1362, 1296, 1280, 'Чхороцку');
INSERT INTO `cities` VALUES (1364, 1363, 1280, 'Джава');
INSERT INTO `cities` VALUES (1365, 1363, 1280, 'Цхинвали');
INSERT INTO `cities` VALUES (1382, 1381, 1380, 'Каир');
INSERT INTO `cities` VALUES (1384, 1383, 1380, 'Асуан');
INSERT INTO `cities` VALUES (1386, 1385, 1380, 'Асыут');
INSERT INTO `cities` VALUES (1388, 1387, 1380, 'Бени Суэф');
INSERT INTO `cities` VALUES (1390, 1389, 1380, 'Танта');
INSERT INTO `cities` VALUES (1392, 1391, 1380, 'Думият');
INSERT INTO `cities` VALUES (1395, 1394, 1393, 'Арад');
INSERT INTO `cities` VALUES (1396, 1394, 1393, 'Ашдод');
INSERT INTO `cities` VALUES (1397, 1394, 1393, 'Ашкелон');
INSERT INTO `cities` VALUES (1398, 1394, 1393, 'Бээр-Шева');
INSERT INTO `cities` VALUES (1399, 1394, 1393, 'Димона');
INSERT INTO `cities` VALUES (1400, 1394, 1393, 'Кирьят-Гат');
INSERT INTO `cities` VALUES (1401, 1394, 1393, 'Кирьят-Малахи');
INSERT INTO `cities` VALUES (58417233, 1394, 1393, 'Нетивот');
INSERT INTO `cities` VALUES (20787898, 1394, 1393, 'Сдерот');
INSERT INTO `cities` VALUES (1402, 1394, 1393, 'Эйлат');
INSERT INTO `cities` VALUES (4159626, 1403, 1393, 'Ариэль');
INSERT INTO `cities` VALUES (1404, 1403, 1393, 'Бнэй-Брак');
INSERT INTO `cities` VALUES (1405, 1403, 1393, 'Гэдера');
INSERT INTO `cities` VALUES (11911759, 1403, 1393, 'Кфар Саба');
INSERT INTO `cities` VALUES (1406, 1403, 1393, 'Лод');
INSERT INTO `cities` VALUES (1407, 1403, 1393, 'Натания');
INSERT INTO `cities` VALUES (1408, 1403, 1393, 'Нэс-Циона');
INSERT INTO `cities` VALUES (5908671, 1403, 1393, 'Од-а Шарон');
INSERT INTO `cities` VALUES (1409, 1403, 1393, 'Пэтах-Тиква');
INSERT INTO `cities` VALUES (1410, 1403, 1393, 'Раанана');
INSERT INTO `cities` VALUES (1411, 1403, 1393, 'Рамла');
INSERT INTO `cities` VALUES (1412, 1403, 1393, 'Ришон-ЛеЦион');
INSERT INTO `cities` VALUES (1413, 1403, 1393, 'Рош-ха-Аин');
INSERT INTO `cities` VALUES (1414, 1403, 1393, 'Рэховот');
INSERT INTO `cities` VALUES (1415, 1403, 1393, 'Явне');
INSERT INTO `cities` VALUES (1417, 1416, 1393, 'Акко');
INSERT INTO `cities` VALUES (1418, 1416, 1393, 'Акко (порт)');
INSERT INTO `cities` VALUES (1419, 1416, 1393, 'Афула');
INSERT INTO `cities` VALUES (1420, 1416, 1393, 'Кармиэль');
INSERT INTO `cities` VALUES (4778544, 1416, 1393, 'Кацрин');
INSERT INTO `cities` VALUES (4694853, 1416, 1393, 'Кирьят-Ата');
INSERT INTO `cities` VALUES (4692641, 1416, 1393, 'Кирьят-Ата');
INSERT INTO `cities` VALUES (1421, 1416, 1393, 'Кирьят-Тивон');
INSERT INTO `cities` VALUES (1422, 1416, 1393, 'Кирьят-Шмона');
INSERT INTO `cities` VALUES (4778382, 1416, 1393, 'Мигдаль аЭмек');
INSERT INTO `cities` VALUES (1423, 1416, 1393, 'Нагария');
INSERT INTO `cities` VALUES (1424, 1416, 1393, 'Нацэрэт');
INSERT INTO `cities` VALUES (1425, 1416, 1393, 'Сахнин');
INSERT INTO `cities` VALUES (1426, 1416, 1393, 'Тверия');
INSERT INTO `cities` VALUES (89871503, 1416, 1393, 'Хадера');
INSERT INTO `cities` VALUES (1428, 1416, 1393, 'Хайфа');
INSERT INTO `cities` VALUES (1427, 1416, 1393, 'Цфат');
INSERT INTO `cities` VALUES (1430, 1429, 1393, 'Далият-Эль-Кармэль');
INSERT INTO `cities` VALUES (1431, 1429, 1393, 'Зихрон-Яаков');
INSERT INTO `cities` VALUES (1432, 1429, 1393, 'Кирьят-Бялик');
INSERT INTO `cities` VALUES (1433, 1429, 1393, 'Кирьят-Моцкин');
INSERT INTO `cities` VALUES (1434, 1429, 1393, 'Кирьят-Ям');
INSERT INTO `cities` VALUES (10499564, 1429, 1393, 'Наария');
INSERT INTO `cities` VALUES (1435, 1429, 1393, 'Нэшэр');
INSERT INTO `cities` VALUES (1436, 1429, 1393, 'Ор-Акива');
INSERT INTO `cities` VALUES (1437, 1429, 1393, 'Пардэс-Ханна');
INSERT INTO `cities` VALUES (1438, 1429, 1393, 'Тират-Кармэль');
INSERT INTO `cities` VALUES (89851450, 1429, 1393, 'Хайфа');
INSERT INTO `cities` VALUES (21333801, 1429, 1393, 'Хефа-Хариш');
INSERT INTO `cities` VALUES (1439, 1429, 1393, 'Хэдэра');
INSERT INTO `cities` VALUES (1441, 1440, 1393, 'Бат-Ям');
INSERT INTO `cities` VALUES (1442, 1440, 1393, 'Герцелия');
INSERT INTO `cities` VALUES (1443, 1440, 1393, 'Гиватаим');
INSERT INTO `cities` VALUES (1444, 1440, 1393, 'Кирьят-Оно');
INSERT INTO `cities` VALUES (58423081, 1440, 1393, 'Лод');
INSERT INTO `cities` VALUES (105969378, 1440, 1393, 'Петах Тиква');
INSERT INTO `cities` VALUES (1445, 1440, 1393, 'Рамат-Ган');
INSERT INTO `cities` VALUES (1446, 1440, 1393, 'Рамат-Хашарон');
INSERT INTO `cities` VALUES (1447, 1440, 1393, 'Тель-Авив');
INSERT INTO `cities` VALUES (1448, 1440, 1393, 'Холон');
INSERT INTO `cities` VALUES (21333997, 1449, 1393, 'Бейт-шемеш');
INSERT INTO `cities` VALUES (1450, 1449, 1393, 'Иерусалим');
INSERT INTO `cities` VALUES (5036894, 1449, 1393, 'Модиин');
INSERT INTO `cities` VALUES (1453, 1452, 1451, 'Асансол');
INSERT INTO `cities` VALUES (1454, 1452, 1451, 'Байдьябати');
INSERT INTO `cities` VALUES (1455, 1452, 1451, 'Балли');
INSERT INTO `cities` VALUES (1456, 1452, 1451, 'Банкура');
INSERT INTO `cities` VALUES (1457, 1452, 1451, 'Барасат');
INSERT INTO `cities` VALUES (1458, 1452, 1451, 'Бхатпара');
INSERT INTO `cities` VALUES (1459, 1452, 1451, 'Даржилинг');
INSERT INTO `cities` VALUES (1460, 1452, 1451, 'Дум-Дум');
INSERT INTO `cities` VALUES (1461, 1452, 1451, 'Дургапур');
INSERT INTO `cities` VALUES (1462, 1452, 1451, 'Камархати');
INSERT INTO `cities` VALUES (1463, 1452, 1451, 'Кришнанагар');
INSERT INTO `cities` VALUES (1464, 1452, 1451, 'Кхарагпур');
INSERT INTO `cities` VALUES (1465, 1452, 1451, 'Наихати');
INSERT INTO `cities` VALUES (1466, 1452, 1451, 'Панихати');
INSERT INTO `cities` VALUES (1467, 1452, 1451, 'Титагарх');
INSERT INTO `cities` VALUES (1469, 1468, 1451, 'Биласпур');
INSERT INTO `cities` VALUES (1470, 1468, 1451, 'Бхилаи');
INSERT INTO `cities` VALUES (1471, 1468, 1451, 'Дург');
INSERT INTO `cities` VALUES (1472, 1468, 1451, 'Раипур');
INSERT INTO `cities` VALUES (1474, 1473, 1451, 'Багалкот');
INSERT INTO `cities` VALUES (20737950, 1473, 1451, 'Банглори');
INSERT INTO `cities` VALUES (1475, 1473, 1451, 'Белгаум');
INSERT INTO `cities` VALUES (1476, 1473, 1451, 'Беллари');
INSERT INTO `cities` VALUES (1477, 1473, 1451, 'Бияпур');
INSERT INTO `cities` VALUES (1478, 1473, 1451, 'Гадаг');
INSERT INTO `cities` VALUES (1479, 1473, 1451, 'Давангер');
INSERT INTO `cities` VALUES (1480, 1473, 1451, 'Колар Голд Филдс');
INSERT INTO `cities` VALUES (1481, 1473, 1451, 'Мангалор');
INSERT INTO `cities` VALUES (1482, 1473, 1451, 'Раичур');
INSERT INTO `cities` VALUES (1483, 1473, 1451, 'Сагар');
INSERT INTO `cities` VALUES (1484, 1473, 1451, 'Тумкур');
INSERT INTO `cities` VALUES (1485, 1473, 1451, 'Хоспет');
INSERT INTO `cities` VALUES (1486, 1473, 1451, 'Хубли');
INSERT INTO `cities` VALUES (1487, 1473, 1451, 'Шимога');
INSERT INTO `cities` VALUES (1489, 1488, 1451, 'Дехра Дун');
INSERT INTO `cities` VALUES (1490, 1488, 1451, 'Сринагар');
INSERT INTO `cities` VALUES (1492, 1491, 1451, 'Адони');
INSERT INTO `cities` VALUES (1493, 1491, 1451, 'Анакапал');
INSERT INTO `cities` VALUES (1494, 1491, 1451, 'Анантапур');
INSERT INTO `cities` VALUES (1495, 1491, 1451, 'Визианагарам');
INSERT INTO `cities` VALUES (1496, 1491, 1451, 'Вияиавада');
INSERT INTO `cities` VALUES (1497, 1491, 1451, 'Гунтакал');
INSERT INTO `cities` VALUES (1498, 1491, 1451, 'Гунтур');
INSERT INTO `cities` VALUES (1499, 1491, 1451, 'Какинада');
INSERT INTO `cities` VALUES (1500, 1491, 1451, 'Куддапах');
INSERT INTO `cities` VALUES (1501, 1491, 1451, 'Мачилипатнам');
INSERT INTO `cities` VALUES (1502, 1491, 1451, 'Нандиал');
INSERT INTO `cities` VALUES (1503, 1491, 1451, 'Низамабад');
INSERT INTO `cities` VALUES (1504, 1491, 1451, 'Проддатур');
INSERT INTO `cities` VALUES (1505, 1491, 1451, 'Тенали');
INSERT INTO `cities` VALUES (1506, 1491, 1451, 'Чирала');
INSERT INTO `cities` VALUES (1507, 1491, 1451, 'Читтур');
INSERT INTO `cities` VALUES (1508, 1491, 1451, 'Элуру');
INSERT INTO `cities` VALUES (1510, 1509, 1451, 'Дибругарх');
INSERT INTO `cities` VALUES (1511, 1509, 1451, 'Силчар');
INSERT INTO `cities` VALUES (1513, 1512, 1451, 'Беттиах');
INSERT INTO `cities` VALUES (1514, 1512, 1451, 'Бихар');
INSERT INTO `cities` VALUES (1515, 1512, 1451, 'Бхагалпур');
INSERT INTO `cities` VALUES (1516, 1512, 1451, 'Гэйа');
INSERT INTO `cities` VALUES (1517, 1512, 1451, 'Дарбханга');
INSERT INTO `cities` VALUES (1518, 1512, 1451, 'Катихар');
INSERT INTO `cities` VALUES (1519, 1512, 1451, 'Музаффарпур');
INSERT INTO `cities` VALUES (1520, 1512, 1451, 'Патна');
INSERT INTO `cities` VALUES (1522, 1521, 1451, 'Ахмадабад');
INSERT INTO `cities` VALUES (1523, 1521, 1451, 'Бхуй');
INSERT INTO `cities` VALUES (1524, 1521, 1451, 'Веравал');
INSERT INTO `cities` VALUES (1525, 1521, 1451, 'Годхра');
INSERT INTO `cities` VALUES (1526, 1521, 1451, 'Гондал');
INSERT INTO `cities` VALUES (1527, 1521, 1451, 'Дхорайи');
INSERT INTO `cities` VALUES (1528, 1521, 1451, 'Йодхпур');
INSERT INTO `cities` VALUES (1529, 1521, 1451, 'Морви');
INSERT INTO `cities` VALUES (1530, 1521, 1451, 'Навсари');
INSERT INTO `cities` VALUES (1531, 1521, 1451, 'Надиад');
INSERT INTO `cities` VALUES (1532, 1521, 1451, 'Патан');
INSERT INTO `cities` VALUES (1533, 1521, 1451, 'Порбандар');
INSERT INTO `cities` VALUES (1534, 1521, 1451, 'Райкот');
INSERT INTO `cities` VALUES (1535, 1521, 1451, 'Сурат');

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
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

-- 
-- Дамп данных таблицы `controller`
-- 

INSERT INTO `controller` VALUES (1, 'IndexController', 'Главная страница', 'Index', 0, 1);
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
INSERT INTO `controller` VALUES (16, 'BlogAdminController', 'Управление блогами', 'BlogAdmin', 1, NULL);
INSERT INTO `controller` VALUES (17, 'AdminQuestionAnswerController', 'Управление вопросами и группами', 'AdminQuestionAnswer', 1, NULL);
INSERT INTO `controller` VALUES (18, 'SubscribeController', 'Управление подписками', 'Subscribe', 0, NULL);
INSERT INTO `controller` VALUES (19, 'ArticleController', 'Статьи', 'Article', 0, NULL);
INSERT INTO `controller` VALUES (20, 'AdminArticleController', 'Статьи. Админ интефейс', 'AdminArticle', 1, NULL);
INSERT INTO `controller` VALUES (21, 'BookmarksController', 'Закладки', 'Bookmarks', 0, NULL);
INSERT INTO `controller` VALUES (22, 'SocialController', 'Социальные позиции(разделы)', 'Social', 0, NULL);
INSERT INTO `controller` VALUES (23, 'SearchUserController', 'Найти знакомых', 'SearchUser', 0, NULL);
INSERT INTO `controller` VALUES (24, 'DevController', 'Для разработчиков', 'Dev', NULL, NULL);
INSERT INTO `controller` VALUES (25, 'NewsController', 'RSS-новости', 'News', NULL, NULL);
INSERT INTO `controller` VALUES (26, 'DebateController', 'Дебаты', 'Debate', NULL, NULL);
INSERT INTO `controller` VALUES (27, 'BaseCommentController', 'Все комментарии', 'BaseComment', NULL, NULL);
INSERT INTO `controller` VALUES (28, 'MessagesController', 'личные сообщения пользователей', 'Messages', NULL, NULL);
INSERT INTO `controller` VALUES (29, 'ArbitrationController', 'Арбитраж, жалобы пользователей', 'Arbitration', NULL, NULL);
INSERT INTO `controller` VALUES (30, 'GTDController', 'раздел GTD', 'GTD', 0, NULL);

-- --------------------------------------------------------

-- 
-- Структура таблицы `countries`
-- 

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(12) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Дамп данных таблицы `countries`
-- 

INSERT INTO `countries` VALUES (4, 'Австралия');
INSERT INTO `countries` VALUES (63, 'Австрия');
INSERT INTO `countries` VALUES (81, 'Азербайджан');
INSERT INTO `countries` VALUES (582079, 'Албания');
INSERT INTO `countries` VALUES (582059, 'Алжир');
INSERT INTO `countries` VALUES (582086, 'Ангола');
INSERT INTO `countries` VALUES (173, 'Ангуилья');
INSERT INTO `countries` VALUES (23269623, 'Андорра');
INSERT INTO `countries` VALUES (23269624, 'Антарктика');
INSERT INTO `countries` VALUES (23269625, 'Антигуа и Барбуда');
INSERT INTO `countries` VALUES (23269688, 'Антильские о-ва');
INSERT INTO `countries` VALUES (177, 'Аргентина');
INSERT INTO `countries` VALUES (245, 'Армения');
INSERT INTO `countries` VALUES (7716093, 'Арулько');
INSERT INTO `countries` VALUES (23269622, 'Афганистан');
INSERT INTO `countries` VALUES (23269626, 'Ашмор и Картьер о-ва');
INSERT INTO `countries` VALUES (582029, 'Багамские о-ва');
INSERT INTO `countries` VALUES (23269627, 'Бангладеш');
INSERT INTO `countries` VALUES (582098, 'Барбадос');
INSERT INTO `countries` VALUES (23269628, 'Бассас да Индия');
INSERT INTO `countries` VALUES (582097, 'Бахрейн');
INSERT INTO `countries` VALUES (248, 'Беларусь');
INSERT INTO `countries` VALUES (401, 'Белиз');
INSERT INTO `countries` VALUES (404, 'Бельгия');
INSERT INTO `countries` VALUES (23269629, 'Бенин');
INSERT INTO `countries` VALUES (425, 'Бермуды');
INSERT INTO `countries` VALUES (428, 'Болгария');
INSERT INTO `countries` VALUES (582092, 'Боливия');
INSERT INTO `countries` VALUES (582028, 'Босния/Герцеговина');
INSERT INTO `countries` VALUES (582061, 'Ботсвана');
INSERT INTO `countries` VALUES (467, 'Бразилия');
INSERT INTO `countries` VALUES (23269632, 'Британская Океания');
INSERT INTO `countries` VALUES (23269633, 'Британские Виргинские о-ва');
INSERT INTO `countries` VALUES (23269634, 'Бруней');
INSERT INTO `countries` VALUES (23269635, 'Буркина Фасо');
INSERT INTO `countries` VALUES (23269636, 'Бурунди');
INSERT INTO `countries` VALUES (23269630, 'Бутан');
INSERT INTO `countries` VALUES (23269722, 'Валлис и Футуна о-ва');
INSERT INTO `countries` VALUES (23269721, 'Вануату');
INSERT INTO `countries` VALUES (616, 'Великобритания');
INSERT INTO `countries` VALUES (924, 'Венгрия');
INSERT INTO `countries` VALUES (582053, 'Венесуэла');
INSERT INTO `countries` VALUES (23269652, 'Восточный Тимор');
INSERT INTO `countries` VALUES (971, 'Вьетнам');
INSERT INTO `countries` VALUES (23269661, 'Габон');
INSERT INTO `countries` VALUES (994, 'Гаити');
INSERT INTO `countries` VALUES (23269670, 'Гайана');
INSERT INTO `countries` VALUES (23269662, 'Гамбия');
INSERT INTO `countries` VALUES (582066, 'Гана');
INSERT INTO `countries` VALUES (1007, 'Гваделупа');
INSERT INTO `countries` VALUES (23269666, 'Гватемала');
INSERT INTO `countries` VALUES (23269668, 'Гвинея');
INSERT INTO `countries` VALUES (23269669, 'Гвинея-Бисау');
INSERT INTO `countries` VALUES (1012, 'Германия');
INSERT INTO `countries` VALUES (23269667, 'Гернси о-в');
INSERT INTO `countries` VALUES (20738587, 'Гибралтар');
INSERT INTO `countries` VALUES (23269664, 'Глориосо о-ва');
INSERT INTO `countries` VALUES (2567393, 'Гондурас');
INSERT INTO `countries` VALUES (277557, 'Гонконг');
INSERT INTO `countries` VALUES (23269665, 'Гренада');
INSERT INTO `countries` VALUES (582052, 'Гренландия');
INSERT INTO `countries` VALUES (1258, 'Греция');
INSERT INTO `countries` VALUES (1280, 'Грузия');
INSERT INTO `countries` VALUES (34850173, 'Д.Р. Конго');
INSERT INTO `countries` VALUES (1366, 'Дания');
INSERT INTO `countries` VALUES (23269674, 'Джерси о-в');
INSERT INTO `countries` VALUES (23269650, 'Джибути');
INSERT INTO `countries` VALUES (23269673, 'Джон Майен о-ва');
INSERT INTO `countries` VALUES (23269651, 'Доминика');
INSERT INTO `countries` VALUES (2577958, 'Доминиканская республика');
INSERT INTO `countries` VALUES (23269655, 'Европы о-в');
INSERT INTO `countries` VALUES (1380, 'Египет');
INSERT INTO `countries` VALUES (34850922, 'Еретриа');
INSERT INTO `countries` VALUES (582081, 'Замбия');
INSERT INTO `countries` VALUES (23269723, 'Западная Сахара');
INSERT INTO `countries` VALUES (582056, 'Зимбабве');
INSERT INTO `countries` VALUES (1393, 'Израиль');
INSERT INTO `countries` VALUES (1451, 'Индия');
INSERT INTO `countries` VALUES (277559, 'Индонезия');
INSERT INTO `countries` VALUES (277561, 'Иордания');
INSERT INTO `countries` VALUES (3410238, 'Ирак');
INSERT INTO `countries` VALUES (1663, 'Иран');
INSERT INTO `countries` VALUES (1696, 'Ирландия');
INSERT INTO `countries` VALUES (582039, 'Исландия');
INSERT INTO `countries` VALUES (1707, 'Испания');
INSERT INTO `countries` VALUES (1786, 'Италия');
INSERT INTO `countries` VALUES (23269724, 'Йемен');
INSERT INTO `countries` VALUES (23269638, 'Кабо-Верде');
INSERT INTO `countries` VALUES (1894, 'Казахстан');
INSERT INTO `countries` VALUES (23269640, 'Кайманские о-ва');
INSERT INTO `countries` VALUES (23269637, 'Камбоджа');
INSERT INTO `countries` VALUES (2163, 'Камерун');
INSERT INTO `countries` VALUES (2172, 'Канада');
INSERT INTO `countries` VALUES (23269697, 'Катар');
INSERT INTO `countries` VALUES (582057, 'Кения');
INSERT INTO `countries` VALUES (2297, 'Кипр');
INSERT INTO `countries` VALUES (23269676, 'Кирибати');
INSERT INTO `countries` VALUES (2374, 'Китай');
INSERT INTO `countries` VALUES (23269643, 'Клипертона о-в');
INSERT INTO `countries` VALUES (23269644, 'Кокосовы (Килинг) о-ва');
INSERT INTO `countries` VALUES (582033, 'Колумбия');
INSERT INTO `countries` VALUES (23269645, 'Коморские о-ва');
INSERT INTO `countries` VALUES (582076, 'Конго (Brazzaville)');
INSERT INTO `countries` VALUES (23269646, 'Конго (Kinshasa)');
INSERT INTO `countries` VALUES (23269648, 'Кораловое море о-ва');
INSERT INTO `countries` VALUES (2430, 'Коста-Рика');
INSERT INTO `countries` VALUES (582077, 'Куба');
INSERT INTO `countries` VALUES (2443, 'Кувейт');
INSERT INTO `countries` VALUES (23269647, 'Кука о-ва');
INSERT INTO `countries` VALUES (2303, 'Кыргызстан');
INSERT INTO `countries` VALUES (23269677, 'Лаос');
INSERT INTO `countries` VALUES (2448, 'Латвия');
INSERT INTO `countries` VALUES (23269678, 'Лесото');
INSERT INTO `countries` VALUES (23269679, 'Либерия');
INSERT INTO `countries` VALUES (582060, 'Ливан');
INSERT INTO `countries` VALUES (2509, 'Ливия');
INSERT INTO `countries` VALUES (2514, 'Литва');
INSERT INTO `countries` VALUES (582095, 'Лихтенштейн');
INSERT INTO `countries` VALUES (2614, 'Люксембург');
INSERT INTO `countries` VALUES (23269683, 'Маврикий');
INSERT INTO `countries` VALUES (582069, 'Мавритания');
INSERT INTO `countries` VALUES (582109, 'Мадагаскар');
INSERT INTO `countries` VALUES (23269684, 'Майотт');
INSERT INTO `countries` VALUES (23269680, 'Макао');
INSERT INTO `countries` VALUES (582041, 'Македония');
INSERT INTO `countries` VALUES (582094, 'Малави');
INSERT INTO `countries` VALUES (277563, 'Малайзия');
INSERT INTO `countries` VALUES (582108, 'Мали');
INSERT INTO `countries` VALUES (23269681, 'Мальдивские о-ва');
INSERT INTO `countries` VALUES (582043, 'Мальта');
INSERT INTO `countries` VALUES (23269682, 'Мартиника о-в');
INSERT INTO `countries` VALUES (2617, 'Мексика');
INSERT INTO `countries` VALUES (582082, 'Мозамбик');
INSERT INTO `countries` VALUES (2788, 'Молдова');
INSERT INTO `countries` VALUES (2833, 'Монако');
INSERT INTO `countries` VALUES (2687701, 'Монголия');
INSERT INTO `countries` VALUES (23269685, 'Монтсерат');
INSERT INTO `countries` VALUES (582065, 'Морокко');
INSERT INTO `countries` VALUES (23269686, 'Мьянма (Бирма)');
INSERT INTO `countries` VALUES (582105, 'Мэн о-в');
INSERT INTO `countries` VALUES (582063, 'Намибия');
INSERT INTO `countries` VALUES (23269687, 'Науру');
INSERT INTO `countries` VALUES (582068, 'Непал');
INSERT INTO `countries` VALUES (23269691, 'Нигер');
INSERT INTO `countries` VALUES (582080, 'Нигерия');
INSERT INTO `countries` VALUES (1206, 'Нидерланды (Голландия)');
INSERT INTO `countries` VALUES (23269690, 'Никарагуа');
INSERT INTO `countries` VALUES (2837, 'Новая Зеландия');
INSERT INTO `countries` VALUES (23269689, 'Новая Каледония о-в');
INSERT INTO `countries` VALUES (2880, 'Норвегия');
INSERT INTO `countries` VALUES (23269693, 'Норфолк о-в');
INSERT INTO `countries` VALUES (23269692, 'Нюэ');
INSERT INTO `countries` VALUES (582051, 'О.А.Э.');
INSERT INTO `countries` VALUES (23269694, 'Оман');
INSERT INTO `countries` VALUES (582044, 'Пакистан');
INSERT INTO `countries` VALUES (582093, 'Панама');
INSERT INTO `countries` VALUES (582045, 'Папуа Новая Гвинея');
INSERT INTO `countries` VALUES (582072, 'Парагвай');
INSERT INTO `countries` VALUES (23269695, 'Парасел о-ва');
INSERT INTO `countries` VALUES (582046, 'Перу');
INSERT INTO `countries` VALUES (23269696, 'Питкэрн о-в');
INSERT INTO `countries` VALUES (2897, 'Польша');
INSERT INTO `countries` VALUES (3141, 'Португалия');
INSERT INTO `countries` VALUES (34851252, 'Пуэрто Рико');
INSERT INTO `countries` VALUES (3156, 'Реюньон');
INSERT INTO `countries` VALUES (23269642, 'Рождественские о-ва');
INSERT INTO `countries` VALUES (3159, 'Россия');
INSERT INTO `countries` VALUES (23269698, 'Руанда');
INSERT INTO `countries` VALUES (277555, 'Румыния');
INSERT INTO `countries` VALUES (5681, 'США');
INSERT INTO `countries` VALUES (5647, 'Сальвадор');
INSERT INTO `countries` VALUES (23269704, 'Самоа');
INSERT INTO `countries` VALUES (23269705, 'Сан-Марино');
INSERT INTO `countries` VALUES (23269706, 'Сан-Томе и Принсипи');
INSERT INTO `countries` VALUES (582048, 'Саудовская Аравия');
INSERT INTO `countries` VALUES (23269715, 'Свазиленд');
INSERT INTO `countries` VALUES (23269714, 'Свальбэрд');
INSERT INTO `countries` VALUES (23269701, 'Святая Люсия');
INSERT INTO `countries` VALUES (23269672, 'Святая земля');
INSERT INTO `countries` VALUES (23269699, 'Святой Елены о-в');
INSERT INTO `countries` VALUES (582040, 'Северная Корея');
INSERT INTO `countries` VALUES (582071, 'Сейшеллы');
INSERT INTO `countries` VALUES (23269663, 'Сектор Газа');
INSERT INTO `countries` VALUES (23269702, 'Сен-Пьер и Микелон');
INSERT INTO `countries` VALUES (582110, 'Сенегал');
INSERT INTO `countries` VALUES (23269700, 'Сент Китс и Невис');
INSERT INTO `countries` VALUES (23269703, 'Сент-Винсент и Гренадины');
INSERT INTO `countries` VALUES (23269707, 'Сербия и Черногория');
INSERT INTO `countries` VALUES (277565, 'Сингапур');
INSERT INTO `countries` VALUES (582067, 'Сирия');
INSERT INTO `countries` VALUES (5666, 'Словакия');
INSERT INTO `countries` VALUES (5673, 'Словения');
INSERT INTO `countries` VALUES (23269709, 'Соломоновы о-ва');
INSERT INTO `countries` VALUES (23269710, 'Сомали');
INSERT INTO `countries` VALUES (23269712, 'Спратли о-ва');
INSERT INTO `countries` VALUES (23269713, 'Судан');
INSERT INTO `countries` VALUES (5678, 'Суринам');
INSERT INTO `countries` VALUES (23269708, 'Сьерра-Леоне');
INSERT INTO `countries` VALUES (9575, 'Таджикистан');
INSERT INTO `countries` VALUES (582050, 'Таиланд');
INSERT INTO `countries` VALUES (277567, 'Тайвань');
INSERT INTO `countries` VALUES (582062, 'Танзания');
INSERT INTO `countries` VALUES (582112, 'Того');
INSERT INTO `countries` VALUES (23269716, 'Токелау о-ва');
INSERT INTO `countries` VALUES (23269717, 'Тонга');
INSERT INTO `countries` VALUES (23269718, 'Тринидад и Тобаго');
INSERT INTO `countries` VALUES (23269719, 'Тромелин о-в');
INSERT INTO `countries` VALUES (23269720, 'Тувалу');
INSERT INTO `countries` VALUES (582090, 'Тунис');
INSERT INTO `countries` VALUES (9638, 'Туркменистан');
INSERT INTO `countries` VALUES (9701, 'Туркс и Кейкос');
INSERT INTO `countries` VALUES (9705, 'Турция');
INSERT INTO `countries` VALUES (9782, 'Уганда');
INSERT INTO `countries` VALUES (9787, 'Узбекистан');
INSERT INTO `countries` VALUES (9908, 'Украина');
INSERT INTO `countries` VALUES (582075, 'Уругвай');
INSERT INTO `countries` VALUES (582084, 'Фалькийские о-ва');
INSERT INTO `countries` VALUES (23269656, 'Фарерские о-ва');
INSERT INTO `countries` VALUES (23269657, 'Фиджи');
INSERT INTO `countries` VALUES (582047, 'Филиппины');
INSERT INTO `countries` VALUES (10648, 'Финляндия');
INSERT INTO `countries` VALUES (10668, 'Франция');
INSERT INTO `countries` VALUES (23269658, 'Французская Гвинея');
INSERT INTO `countries` VALUES (23269659, 'Французская Полинезия');
INSERT INTO `countries` VALUES (23269660, 'Французские юж. и антаркт. о-ва');
INSERT INTO `countries` VALUES (23269671, 'Херд и Мак Дональнд о-ва');
INSERT INTO `countries` VALUES (277553, 'Хорватия');
INSERT INTO `countries` VALUES (582100, 'Центральная Африка');
INSERT INTO `countries` VALUES (582101, 'Чад');
INSERT INTO `countries` VALUES (10874, 'Чехия');
INSERT INTO `countries` VALUES (582031, 'Чили');
INSERT INTO `countries` VALUES (10904, 'Швейцария');
INSERT INTO `countries` VALUES (10933, 'Швеция');
INSERT INTO `countries` VALUES (582087, 'Шри-Ланка');
INSERT INTO `countries` VALUES (582064, 'Эквадор');
INSERT INTO `countries` VALUES (23269653, 'Экваториальная Гвинея');
INSERT INTO `countries` VALUES (23269654, 'Эритрея');
INSERT INTO `countries` VALUES (10968, 'Эстония');
INSERT INTO `countries` VALUES (582088, 'Эфиопия');
INSERT INTO `countries` VALUES (3661568, 'ЮАР');
INSERT INTO `countries` VALUES (11014, 'Южная Корея');
INSERT INTO `countries` VALUES (23269711, 'Южные Сандвичевы о-ва');
INSERT INTO `countries` VALUES (582106, 'Ямайка');
INSERT INTO `countries` VALUES (23269675, 'Ян де нова о-ва');
INSERT INTO `countries` VALUES (11060, 'Япония');

-- --------------------------------------------------------

-- 
-- Структура таблицы `debate_chat`
-- 

DROP TABLE IF EXISTS `debate_chat`;
CREATE TABLE IF NOT EXISTS `debate_chat` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `message` varchar(255) default NULL,
  `message_time` datetime default NULL,
  `debate_user_id` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `debate_chat`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `debate_etaps`
-- 

DROP TABLE IF EXISTS `debate_etaps`;
CREATE TABLE IF NOT EXISTS `debate_etaps` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `duration` int(11) default NULL,
  `start` datetime default NULL,
  `passed` int(11) default '0',
  `is_pause` tinyint(4) default NULL,
  `pause_start` datetime default NULL,
  `pause_passed` int(11) default '0',
  `pause_passed_sum` int(11) default '0',
  `is_active` tinyint(4) default NULL,
  `ord` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- 
-- Дамп данных таблицы `debate_etaps`
-- 

INSERT INTO `debate_etaps` VALUES (1, 'GetTheme', 10000, '2008-12-04 10:51:14', 4796, 0, '0000-00-00 00:00:00', 0, 0, 1, 1);
INSERT INTO `debate_etaps` VALUES (2, 'VoteTheme', 10000, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 2);
INSERT INTO `debate_etaps` VALUES (3, 'ChooseSecondUser', 10000, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 3);
INSERT INTO `debate_etaps` VALUES (4, 'ChooseHelpers', 10000, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 4);
INSERT INTO `debate_etaps` VALUES (5, 'GetStakes', 10000, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 5);
INSERT INTO `debate_etaps` VALUES (6, 'Debates', 10000, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 6);
INSERT INTO `debate_etaps` VALUES (7, 'Results', 10000, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 7);

-- --------------------------------------------------------

-- 
-- Структура таблицы `debate_helper_cansay`
-- 

DROP TABLE IF EXISTS `debate_helper_cansay`;
CREATE TABLE IF NOT EXISTS `debate_helper_cansay` (
  `id` int(11) NOT NULL auto_increment,
  `helper_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `debate_helper_cansay`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `debate_helper_check`
-- 

DROP TABLE IF EXISTS `debate_helper_check`;
CREATE TABLE IF NOT EXISTS `debate_helper_check` (
  `id` int(11) NOT NULL auto_increment,
  `helper_id` bigint(20) default NULL,
  `debate_user_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `debate_helper_check`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `debate_helpers_chat`
-- 

DROP TABLE IF EXISTS `debate_helpers_chat`;
CREATE TABLE IF NOT EXISTS `debate_helpers_chat` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `message` varchar(255) default NULL,
  `message_time` datetime default NULL,
  `debate_user_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `debate_helpers_chat`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `debate_history`
-- 

DROP TABLE IF EXISTS `debate_history`;
CREATE TABLE IF NOT EXISTS `debate_history` (
  `id` bigint(20) NOT NULL auto_increment,
  `start_time` datetime default NULL,
  `theme` varchar(200) default NULL,
  `stake_amount` double default NULL,
  `user_id_1` bigint(20) default NULL,
  `user_id_2` bigint(20) default NULL,
  `helper_id_1_1` bigint(20) default NULL,
  `helper_id_1_2` bigint(20) default NULL,
  `helper_id_2_1` bigint(20) default NULL,
  `helper_id_2_2` bigint(20) default NULL,
  `user1_vote` int(11) default NULL,
  `user2_vote` bigint(20) default NULL,
  `debate_protocol` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- 
-- Дамп данных таблицы `debate_history`
-- 

INSERT INTO `debate_history` VALUES (3, '2008-11-21 10:42:56', '', 0, 1, 2, 3, 4, 0, 0, 2, 1, 'admin[2008-11-21 11:43:33]1111\n2[2008-11-21 11:43:40]333\nadmin[2008-11-21 12:29:24]hiii\n2[2008-11-21 12:29:27]gggg\n3[2008-11-21 12:29:56]3453453\n3[2008-11-21 12:40:25]4444\n3[2008-11-21 12:43:01]44556666\n3[2008-11-21 12:43:10]gggg\nadmin[2008-11-21 12:44:11]dddd\n2[2008-11-21 12:44:23]ggggg\n3[2008-11-21 12:45:31]444\n3[2008-11-21 12:45:34]666\n');
INSERT INTO `debate_history` VALUES (2, '2008-11-21 10:11:50', '1111', 111, 1, 2, 0, 0, 0, 0, 0, 0, '2[2008-11-21 10:21:23]111\nadmin[2008-11-21 10:21:26]2222\n2[2008-11-21 10:21:28]333\nadmin[2008-11-21 10:21:30]444\n');
INSERT INTO `debate_history` VALUES (4, '2008-11-21 17:08:51', '3333', 6, 2, 1, 0, 0, 5, 0, 3, 0, '2[2008-11-21 17:38:04]FTHFGH\nadmin[2008-11-21 17:38:13]nmnm,\n2[2008-11-21 17:38:15]jkjk\n2[2008-11-21 17:39:57]соси а не пауза\n4[2008-11-21 17:40:37]я теперь здесь флудю!\n4[2008-11-21 17:41:11]ццукекеукеук\n4[2008-11-21 17:41:14]ууу\n4[2008-11-21 17:41:17]укук\n4[2008-11-21 17:41:24]кеуке\n2[2008-11-21 17:42:58]чсчсч\nadmin[2008-11-21 17:43:01]вавав\n');
INSERT INTO `debate_history` VALUES (5, '2008-11-24 10:23:24', '123', 4, 1, 3, 0, 0, 0, 0, 1, 1, 'admin[2008-11-24 10:52:52]123\n3[2008-11-24 10:53:16]hhh\n');
INSERT INTO `debate_history` VALUES (6, '2008-11-24 10:57:02', 'hello', 3.3, 1, 3, 0, 0, 0, 0, 0, 0, '3[2008-11-24 11:38:13],,,,\n');
INSERT INTO `debate_history` VALUES (7, '2008-11-24 11:43:31', '', 3.4, 1, 3, 0, 0, 0, 0, 2, 0, 'admin[2008-11-24 12:26:55]wereww\n3[2008-11-24 12:27:06]rrrr\n');
INSERT INTO `debate_history` VALUES (8, '2008-11-24 12:32:29', '1222222', 4.5, 5, 3, 1, 1, 2, 2, 2, 1, '2[2008-11-24 12:37:33]sdvf\n');
INSERT INTO `debate_history` VALUES (9, '2008-11-24 12:41:25', '1233', 2.7, 5, 3, 1, 0, 2, 0, 2, 0, '3[2008-11-24 12:53:34]opo\n');
INSERT INTO `debate_history` VALUES (10, '2008-11-24 12:55:50', '', 4, 5, 3, 2, 0, 1, 0, 0, 1, '4[2008-11-24 13:00:57]xfgxd\n2[2008-11-24 13:01:05]dfgf\n');
INSERT INTO `debate_history` VALUES (11, '2008-11-25 12:57:04', '111111as zsc zxcz xc z dsfsd gsdfgsfgsdf g hsdfh sdhgdh fgh fhfggsdfgsfgsdf g hsdfh sdhgdh fgh fhfggsdfgsfgsdf g hsdfh sdhgdh fgh fhfggsdfgsfgsdf g hsdfh sdhgdh fgh fhfg', 12, 3, 5, 6, 0, 0, 0, 1, 0, '3[2008-11-25 13:25:54]dfgdfgd\n4[2008-11-25 13:26:01]ggg\n5[2008-11-25 14:45:41]1234234\n');
INSERT INTO `debate_history` VALUES (12, '2008-11-25 15:37:15', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '');
INSERT INTO `debate_history` VALUES (13, '2008-12-03 10:00:13', 'juyh', 5, 2, 3, 1, 0, 5, 0, 3, 1, '3[2008-12-04 09:37:09]qwe\n2[2008-12-04 09:37:18]rrrt\n4[2008-12-04 09:38:29]fuck off!\nadmin[2008-12-04 09:38:41]fdfdfff\n2[2008-12-04 09:38:45]ssd\nadmin[2008-12-04 09:40:41]сука\nadmin[2008-12-04 09:40:49]нуууу\n4[2008-12-04 09:41:04]пошел ты\nadmin[2008-12-04 10:07:17]1222\n2[2008-12-04 10:07:27]ыва\nadmin[2008-12-04 10:08:25]ываыввп\nadmin[2008-12-04 10:08:46]\nспаибо конечно что стока квна выложил но че оно все в iflv будешь еще заливать лей пож в flv\nОтветить\n05 ноя 2008 18:10 rossiver   Cсылка\nЯ заливал всё в wmv формате, переконвертация произошла уже на серваке сайта.\nОтветить\n15 ноя 2008 16:08 AleXeich3   \n');
INSERT INTO `debate_history` VALUES (14, '2008-12-04 10:13:24', '56777  пг проро', 2.2, 3, 2, 5, 0, 1, 0, 3, 1, '2[2008-12-04 10:40:51]qwert\n3[2008-12-04 10:41:05]sdfsdf\n4[2008-12-04 10:43:53]ff\nadmin[2008-12-04 10:46:20]rtt\n3[2008-12-04 10:47:08]555\n3[2008-12-04 10:47:19]trt\n4[2008-12-04 10:47:26]tut\n2[2008-12-04 10:48:40]dfg\nadmin[2008-12-04 10:48:42]sdfg\n3[2008-12-04 10:48:44]erge\n');

-- --------------------------------------------------------

-- 
-- Структура таблицы `debate_now`
-- 

DROP TABLE IF EXISTS `debate_now`;
CREATE TABLE IF NOT EXISTS `debate_now` (
  `id` int(11) NOT NULL auto_increment,
  `start_time` datetime default NULL,
  `debate_theme_id` int(11) default NULL,
  `theme` varchar(200) default NULL,
  `stake_amount` double default '0',
  `user_id_1` bigint(20) default NULL,
  `user_id_2` bigint(20) default NULL,
  `helper_id_1_1` bigint(20) default NULL,
  `helper_id_1_2` bigint(20) default NULL,
  `helper_id_2_1` bigint(20) default NULL,
  `helper_id_2_2` bigint(20) default NULL,
  `is_ready_1` tinyint(4) default NULL,
  `is_ready_2` tinyint(4) default NULL,
  `helper_1_1_rate` bigint(20) default '0',
  `helper_1_2_rate` bigint(20) default '0',
  `helper_2_1_rate` bigint(20) default '0',
  `helper_2_2_rate` bigint(20) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `debate_now`
-- 

INSERT INTO `debate_now` VALUES (1, '2008-12-04 10:51:14', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `debate_stakes`
-- 

DROP TABLE IF EXISTS `debate_stakes`;
CREATE TABLE IF NOT EXISTS `debate_stakes` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `debate_user_id` bigint(20) default NULL,
  `stake_amount` double(20,2) default NULL,
  `debate_history_id` bigint(20) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

-- 
-- Дамп данных таблицы `debate_stakes`
-- 

INSERT INTO `debate_stakes` VALUES (1, 1, 2, 2.00, 16);
INSERT INTO `debate_stakes` VALUES (2, 1, 3, 4.00, 16);
INSERT INTO `debate_stakes` VALUES (3, 1, 2, 5.00, 16);
INSERT INTO `debate_stakes` VALUES (4, 1, 3, 5.00, 16);
INSERT INTO `debate_stakes` VALUES (5, 1, 3, 4.00, 16);
INSERT INTO `debate_stakes` VALUES (6, 1, 3, 4.00, 16);
INSERT INTO `debate_stakes` VALUES (7, 3, 1, 12.00, 1);
INSERT INTO `debate_stakes` VALUES (8, 3, 2, 5.00, 1);
INSERT INTO `debate_stakes` VALUES (9, 3, 2, 2.00, 4);
INSERT INTO `debate_stakes` VALUES (10, 3, 1, 3.00, 4);
INSERT INTO `debate_stakes` VALUES (11, 3, 2, 1.00, 4);
INSERT INTO `debate_stakes` VALUES (12, 2, 1, 5.00, 5);
INSERT INTO `debate_stakes` VALUES (13, 2, 3, 3.50, 5);
INSERT INTO `debate_stakes` VALUES (14, 2, 3, 6.80, 5);
INSERT INTO `debate_stakes` VALUES (15, 2, 1, 2.00, 6);
INSERT INTO `debate_stakes` VALUES (16, 2, 3, 3.00, 6);
INSERT INTO `debate_stakes` VALUES (17, 2, 1, 1.20, 6);
INSERT INTO `debate_stakes` VALUES (18, 2, 1, 3.00, 6);
INSERT INTO `debate_stakes` VALUES (19, 2, 3, 3.00, 6);
INSERT INTO `debate_stakes` VALUES (20, 2, 1, 1.00, 6);
INSERT INTO `debate_stakes` VALUES (21, 2, 1, 1.00, 6);
INSERT INTO `debate_stakes` VALUES (22, 2, 3, 1.00, 6);
INSERT INTO `debate_stakes` VALUES (23, 2, 3, 1.00, 6);
INSERT INTO `debate_stakes` VALUES (24, 2, 3, 1.00, 6);
INSERT INTO `debate_stakes` VALUES (25, 1, 2, 3.50, 6);
INSERT INTO `debate_stakes` VALUES (26, 2, 3, 1.00, 6);
INSERT INTO `debate_stakes` VALUES (27, 2, 3, 1.70, 6);
INSERT INTO `debate_stakes` VALUES (28, 2, 1, 12.89, 7);
INSERT INTO `debate_stakes` VALUES (29, 2, 1, 22.00, 7);
INSERT INTO `debate_stakes` VALUES (30, 2, 1, 2.00, 7);
INSERT INTO `debate_stakes` VALUES (31, 2, 1, 3.44, 7);
INSERT INTO `debate_stakes` VALUES (32, 2, 5, 3.00, 9);
INSERT INTO `debate_stakes` VALUES (33, 1, 5, 4.70, 9);
INSERT INTO `debate_stakes` VALUES (34, 2, 3, 4.70, 9);
INSERT INTO `debate_stakes` VALUES (35, 2, 3, 6.00, 10);
INSERT INTO `debate_stakes` VALUES (36, 5, 1, 44.00, 12);
INSERT INTO `debate_stakes` VALUES (37, 5, 1, 2.00, 12);
INSERT INTO `debate_stakes` VALUES (38, 5, 3, 4.00, 12);
INSERT INTO `debate_stakes` VALUES (39, 5, 2, 3.00, 13);
INSERT INTO `debate_stakes` VALUES (40, 5, 3, 3.30, 13);
INSERT INTO `debate_stakes` VALUES (41, 1, 2, 2.00, 13);
INSERT INTO `debate_stakes` VALUES (42, 1, 3, 5.30, 13);
INSERT INTO `debate_stakes` VALUES (43, 1, 2, 1.10, 13);
INSERT INTO `debate_stakes` VALUES (44, 1, 3, 0.20, 13);
INSERT INTO `debate_stakes` VALUES (45, 1, 3, 1.10, 13);
INSERT INTO `debate_stakes` VALUES (46, 1, 2, 1.11, 13);
INSERT INTO `debate_stakes` VALUES (47, 1, 3, 1.00, 13);
INSERT INTO `debate_stakes` VALUES (48, 1, 3, 0.10, 13);
INSERT INTO `debate_stakes` VALUES (49, 1, 3, 0.10, 13);
INSERT INTO `debate_stakes` VALUES (50, 1, 2, 0.10, 13);
INSERT INTO `debate_stakes` VALUES (51, 1, 2, 0.21, 13);
INSERT INTO `debate_stakes` VALUES (52, 5, 3, 0.20, 14);
INSERT INTO `debate_stakes` VALUES (53, 1, 3, 2.30, 14);
INSERT INTO `debate_stakes` VALUES (54, 1, 2, 1.10, 14);
INSERT INTO `debate_stakes` VALUES (55, 1, 2, 3.50, 14);
INSERT INTO `debate_stakes` VALUES (56, 1, 3, 5.20, 14);

-- --------------------------------------------------------

-- 
-- Структура таблицы `debate_theme`
-- 

DROP TABLE IF EXISTS `debate_theme`;
CREATE TABLE IF NOT EXISTS `debate_theme` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `theme` varchar(200) default NULL,
  `votes` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `debate_theme`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `debate_theme_vote`
-- 

DROP TABLE IF EXISTS `debate_theme_vote`;
CREATE TABLE IF NOT EXISTS `debate_theme_vote` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `debate_theme_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `debate_theme_vote`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `debate_user_vote`
-- 

DROP TABLE IF EXISTS `debate_user_vote`;
CREATE TABLE IF NOT EXISTS `debate_user_vote` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `debate_user_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `debate_user_vote`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `debate_users_chat`
-- 

DROP TABLE IF EXISTS `debate_users_chat`;
CREATE TABLE IF NOT EXISTS `debate_users_chat` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `message` varchar(255) default NULL,
  `message_time` datetime default NULL,
  `debate_user_id` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `debate_users_chat`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `favorite_news`
-- 

DROP TABLE IF EXISTS `favorite_news`;
CREATE TABLE IF NOT EXISTS `favorite_news` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `news_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=11 ;

-- 
-- Дамп данных таблицы `favorite_news`
-- 

INSERT INTO `favorite_news` VALUES (1, 1, 326);
INSERT INTO `favorite_news` VALUES (2, 1, 349);
INSERT INTO `favorite_news` VALUES (3, 1, 368);
INSERT INTO `favorite_news` VALUES (4, 1, 370);
INSERT INTO `favorite_news` VALUES (8, 1, 472);
INSERT INTO `favorite_news` VALUES (10, 1, 473);

-- --------------------------------------------------------

-- 
-- Структура таблицы `feeds`
-- 

DROP TABLE IF EXISTS `feeds`;
CREATE TABLE IF NOT EXISTS `feeds` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `name` varchar(50) default NULL,
  `url` text,
  `type` tinyint(4) default NULL,
  `state` tinyint(4) default NULL,
  `creation_date` datetime default NULL,
  `last_parse_date` datetime default NULL,
  `text_parse_type` tinyint(4) default '0',
  `is_partner` tinyint(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

-- 
-- Дамп данных таблицы `feeds`
-- 

INSERT INTO `feeds` VALUES (3, 1, 'test', 'http://pds-page.ucoz.ru/news/rss/', 0, 1, '2008-10-30 11:52:42', '0000-00-00 00:00:00', 0, 1);
INSERT INTO `feeds` VALUES (4, 2, 'SLO.ru - Последние версии лучших программ', 'http://www.slo.ru/news/fusionnews.xml', 0, 0, '2008-10-30 12:18:57', '2008-11-07 10:47:01', 0, 1);
INSERT INTO `feeds` VALUES (5, 2, 'Counter-Strike Mania', 'http://googis.info/news/rss/', 1, 0, '2008-10-30 12:23:19', '0000-00-00 00:00:00', 0, 1);
INSERT INTO `feeds` VALUES (6, 2, 'soft-best', 'http://soft-best.ws/rss.xml', 1, 1, '2008-10-30 12:26:58', '2008-11-17 17:02:57', 2, 1);
INSERT INTO `feeds` VALUES (7, 2, 'winblog', 'http://www.winblog.ru/category/softall/rss.xml', 0, 1, '2008-10-30 12:29:31', '2008-11-10 11:40:25', 0, 1);
INSERT INTO `feeds` VALUES (8, 1, '3dNews', 'http://www.3dnews.ru/games/rss/', 0, 0, '2008-11-03 17:56:33', '2008-11-10 11:40:21', 2, 1);
INSERT INTO `feeds` VALUES (9, 1, 'Yandex Business', 'http://news.yandex.ru/Russia/business.rss', 0, 1, '2008-11-03 17:58:20', '2008-11-17 17:03:19', 2, 1);
INSERT INTO `feeds` VALUES (10, 2, 'news-russia', 'http://news-russia.info/rss.xml', 0, 1, '2008-11-04 10:22:13', '2008-11-17 17:03:43', 0, 1);
INSERT INTO `feeds` VALUES (12, 1, 'lastnews', 'http://www.gazeta.ru/export/rss/lastnews.xml', 0, 1, '2008-11-04 14:43:17', '2008-11-17 17:03:57', 2, 1);
INSERT INTO `feeds` VALUES (14, 1, 'Sport', 'http://news.liga.net/sport/rss.xml', 0, 0, '2008-11-06 15:05:50', '2008-11-10 11:40:33', 0, 1);
INSERT INTO `feeds` VALUES (18, 3, 'ukrtelecom', 'http://www.ukrtelecom.ua/presscenter/rss', 0, 1, '2008-11-07 10:33:47', '2008-11-10 11:40:34', 2, 0);
INSERT INTO `feeds` VALUES (23, 1, 'ssssdd', 'http://123.asdasd', 0, 0, '2008-11-21 15:10:29', NULL, 0, 1);
INSERT INTO `feeds` VALUES (21, 3, 'test', 'testest', 1, 1, '2008-11-10 09:49:40', NULL, 2, 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `friend`
-- 

DROP TABLE IF EXISTS `friend`;
CREATE TABLE IF NOT EXISTS `friend` (
  `id` bigint(20) NOT NULL auto_increment,
  `friend_id` bigint(20) default NULL,
  `group_id` bigint(20) default '0',
  `user_id` bigint(20) default NULL,
  `note` varchar(100) default NULL,
  `is_mutual` tinyint(4) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- Дамп данных таблицы `friend`
-- 

INSERT INTO `friend` VALUES (1, 2, 0, 1, '', NULL);
INSERT INTO `friend` VALUES (2, 3, 0, 1, 'ggg', NULL);
INSERT INTO `friend` VALUES (3, 6, 0, 1, 'eeeee', NULL);
INSERT INTO `friend` VALUES (4, 5, 0, 1, 'rrrrrr56756', NULL);
INSERT INTO `friend` VALUES (6, 7, 0, 1, 'guk', NULL);

-- --------------------------------------------------------

-- 
-- Структура таблицы `friend_group`
-- 

DROP TABLE IF EXISTS `friend_group`;
CREATE TABLE IF NOT EXISTS `friend_group` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `name` varchar(100) default NULL,
  `editable` tinyint(4) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- Дамп данных таблицы `friend_group`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `interests`
-- 

DROP TABLE IF EXISTS `interests`;
CREATE TABLE IF NOT EXISTS `interests` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=270 DEFAULT CHARSET=latin1 AUTO_INCREMENT=270 ;

-- 
-- Дамп данных таблицы `interests`
-- 

INSERT INTO `interests` VALUES (1, 'велосипеды', 1);
INSERT INTO `interests` VALUES (2, 'водный спорт', 1);
INSERT INTO `interests` VALUES (3, 'музыка', 17);
INSERT INTO `interests` VALUES (4, 'прикольные сайты', 1);
INSERT INTO `interests` VALUES (5, 'комедии', 1);
INSERT INTO `interests` VALUES (6, 'мелодрамы', 1);
INSERT INTO `interests` VALUES (7, 'формула 1', 1);
INSERT INTO `interests` VALUES (8, 'футбол', 3);
INSERT INTO `interests` VALUES (9, 'девушки', 2);
INSERT INTO `interests` VALUES (10, 'компьютеры', 8);
INSERT INTO `interests` VALUES (11, 'программирование', 1);
INSERT INTO `interests` VALUES (12, 'web дизаен', 1);
INSERT INTO `interests` VALUES (13, 'фотошоп', 1);
INSERT INTO `interests` VALUES (14, 'машины', 1);
INSERT INTO `interests` VALUES (15, 'комп', 1);
INSERT INTO `interests` VALUES (16, 'гулянка', 1);
INSERT INTO `interests` VALUES (17, 'танцы', 6);
INSERT INTO `interests` VALUES (18, 'hip-hop', 1);
INSERT INTO `interests` VALUES (19, 'музыку в стиле хип-хоп', 1);
INSERT INTO `interests` VALUES (20, 'веселье', 1);
INSERT INTO `interests` VALUES (21, 'вокал', 1);
INSERT INTO `interests` VALUES (22, 'воллейбол', 1);
INSERT INTO `interests` VALUES (23, 'горы', 1);
INSERT INTO `interests` VALUES (24, 'дом', 1);
INSERT INTO `interests` VALUES (25, 'дети', 1);
INSERT INTO `interests` VALUES (26, 'жизнь', 1);
INSERT INTO `interests` VALUES (27, 'здоровье', 1);
INSERT INTO `interests` VALUES (28, 'игры', 1);
INSERT INTO `interests` VALUES (29, 'книги', 3);
INSERT INTO `interests` VALUES (30, 'кино', 14);
INSERT INTO `interests` VALUES (31, 'любовь', 1);
INSERT INTO `interests` VALUES (32, 'мультфмльмы', 1);
INSERT INTO `interests` VALUES (33, 'песни', 1);
INSERT INTO `interests` VALUES (34, 'поэзия', 1);
INSERT INTO `interests` VALUES (35, 'рисование', 1);
INSERT INTO `interests` VALUES (36, 'женщины', 1);
INSERT INTO `interests` VALUES (37, 'заниматься любовью', 1);
INSERT INTO `interests` VALUES (38, 'интересные люди', 1);
INSERT INTO `interests` VALUES (39, 'интернет', 6);
INSERT INTO `interests` VALUES (40, 'йони', 1);
INSERT INTO `interests` VALUES (41, 'нло', 1);
INSERT INTO `interests` VALUES (42, 'тайны', 1);
INSERT INTO `interests` VALUES (43, 'история', 1);
INSERT INTO `interests` VALUES (44, 'литература', 5);
INSERT INTO `interests` VALUES (45, 'фантастика', 1);
INSERT INTO `interests` VALUES (46, 'приключения', 1);
INSERT INTO `interests` VALUES (47, 'бизнес', 4);
INSERT INTO `interests` VALUES (48, 'красота', 2);
INSERT INTO `interests` VALUES (49, 'мода', 4);
INSERT INTO `interests` VALUES (50, 'искусство', 5);
INSERT INTO `interests` VALUES (51, 'дизайн', 1);
INSERT INTO `interests` VALUES (52, 'общение', 1);
INSERT INTO `interests` VALUES (53, 'музыка и чет еще ну ща нефспомню восновном живу музыкой кидать покетики с водой с балкона', 1);
INSERT INTO `interests` VALUES (54, 'ржать над тупой шуткой', 1);
INSERT INTO `interests` VALUES (55, 'улыбаться', 1);
INSERT INTO `interests` VALUES (56, 'шататься по городу', 1);
INSERT INTO `interests` VALUES (57, 'ездить по магазам и просто там шататься', 1);
INSERT INTO `interests` VALUES (58, 'жувать жвачку', 1);
INSERT INTO `interests` VALUES (59, 'гулять', 1);
INSERT INTO `interests` VALUES (60, 'не пить и некурить магдональдс самое главное просто обажаю узкие джинсы эт моя слабость люблю новые знакомства', 1);
INSERT INTO `interests` VALUES (61, 'Прогулки под солнцем', 1);
INSERT INTO `interests` VALUES (62, 'пробежки на ветру', 1);
INSERT INTO `interests` VALUES (63, 'мысли о всем', 1);
INSERT INTO `interests` VALUES (64, 'что в этом мире не вечно', 1);
INSERT INTO `interests` VALUES (65, 'плавание и танцы', 1);
INSERT INTO `interests` VALUES (66, 'Прогулки', 9);
INSERT INTO `interests` VALUES (67, 'плавание', 8);
INSERT INTO `interests` VALUES (68, 'занятия фитнесом', 1);
INSERT INTO `interests` VALUES (69, 'прыжки с парашютом', 1);
INSERT INTO `interests` VALUES (70, 'Лыжи', 2);
INSERT INTO `interests` VALUES (71, 'сноуборд', 2);
INSERT INTO `interests` VALUES (72, 'Бег по препятствиям', 1);
INSERT INTO `interests` VALUES (73, 'смежные и смешные', 1);
INSERT INTO `interests` VALUES (74, 'Карьера в большом городе', 1);
INSERT INTO `interests` VALUES (75, 'Главное - найти настоящего друга', 1);
INSERT INTO `interests` VALUES (76, 'а так - бег и танцы', 1);
INSERT INTO `interests` VALUES (77, 'Домашние животные', 3);
INSERT INTO `interests` VALUES (78, 'стиль', 3);
INSERT INTO `interests` VALUES (79, 'фотография', 7);
INSERT INTO `interests` VALUES (80, 'велосипед', 4);
INSERT INTO `interests` VALUES (81, 'Карьера', 5);
INSERT INTO `interests` VALUES (82, 'фитнес', 8);
INSERT INTO `interests` VALUES (83, 'образование', 1);
INSERT INTO `interests` VALUES (84, 'финансы', 1);
INSERT INTO `interests` VALUES (85, 'Имидж', 1);
INSERT INTO `interests` VALUES (86, 'макияж', 1);
INSERT INTO `interests` VALUES (87, 'маникюр', 1);
INSERT INTO `interests` VALUES (88, 'Дегустация шоколада', 1);
INSERT INTO `interests` VALUES (89, '"Спортивная ходьба (крестиком). Бег в мешках (по пересеченной местности). Прыжки (с шариками на роликах). Хоккей (на потолке). Футбол (в акваланге). Забеги (в ширину). Заплывы (в глубину). Метание копья (в игровые автоматы). Литрбол (5-45%)\r\n"', 1);
INSERT INTO `interests` VALUES (90, 'спорт', 11);
INSERT INTO `interests` VALUES (91, 'театр', 4);
INSERT INTO `interests` VALUES (92, 'ролики', 3);
INSERT INTO `interests` VALUES (93, 'club dance', 1);
INSERT INTO `interests` VALUES (94, 'strip dance', 1);
INSERT INTO `interests` VALUES (95, 'bicycling', 1);
INSERT INTO `interests` VALUES (96, 'skating', 1);
INSERT INTO `interests` VALUES (97, 'Почитать книги', 1);
INSERT INTO `interests` VALUES (98, 'посмотреть хорошее кино', 1);
INSERT INTO `interests` VALUES (99, 'отдохнуть от учебы', 1);
INSERT INTO `interests` VALUES (100, 'Автомобили', 6);
INSERT INTO `interests` VALUES (101, 'Бег', 3);
INSERT INTO `interests` VALUES (102, 'психология', 7);
INSERT INTO `interests` VALUES (103, 'путешествия', 7);
INSERT INTO `interests` VALUES (104, 'психоогия', 1);
INSERT INTO `interests` VALUES (105, 'шопинг', 1);
INSERT INTO `interests` VALUES (106, 'вкусная еда', 1);
INSERT INTO `interests` VALUES (107, 'Все что связано с активным отдыхом на природе.', 1);
INSERT INTO `interests` VALUES (108, 'Барби-кю', 1);
INSERT INTO `interests` VALUES (109, 'стихи', 3);
INSERT INTO `interests` VALUES (110, 'Работа', 7);
INSERT INTO `interests` VALUES (111, 'карьера и еще раз карьера', 1);
INSERT INTO `interests` VALUES (112, 'пешие прогулки на несколько километров', 1);
INSERT INTO `interests` VALUES (113, 'Собираю модели самолетов', 1);
INSERT INTO `interests` VALUES (114, 'Шью', 1);
INSERT INTO `interests` VALUES (115, 'вышиваю', 1);
INSERT INTO `interests` VALUES (116, 'создаю аксессуары', 1);
INSERT INTO `interests` VALUES (117, 'Брейк', 1);
INSERT INTO `interests` VALUES (118, 'поездки на природу', 1);
INSERT INTO `interests` VALUES (119, 'музеи', 2);
INSERT INTO `interests` VALUES (120, 'ночные клубы', 4);
INSERT INTO `interests` VALUES (121, 'собаки', 2);
INSERT INTO `interests` VALUES (122, 'мой кот', 1);
INSERT INTO `interests` VALUES (123, 'мой гардероб и отличная музыка', 1);
INSERT INTO `interests` VALUES (124, 'клубы', 1);
INSERT INTO `interests` VALUES (125, 'Люблю экстремальные виды спорта', 1);
INSERT INTO `interests` VALUES (126, '"Кино', 1);
INSERT INTO `interests` VALUES (127, 'уличные танцы"', 1);
INSERT INTO `interests` VALUES (128, 'наука', 1);
INSERT INTO `interests` VALUES (129, 'походы в театр', 1);
INSERT INTO `interests` VALUES (130, 'а лучше просмотр театра в хорошем качестве на двд ;)', 1);
INSERT INTO `interests` VALUES (131, 'Гулять на природе и в городе', 1);
INSERT INTO `interests` VALUES (132, 'бильярд', 1);
INSERT INTO `interests` VALUES (133, 'Кошки', 2);
INSERT INTO `interests` VALUES (134, 'лошади', 2);
INSERT INTO `interests` VALUES (135, 'поездки', 2);
INSERT INTO `interests` VALUES (136, 'йога', 2);
INSERT INTO `interests` VALUES (137, 'медитация', 1);
INSERT INTO `interests` VALUES (138, 'музыка. любимая работа', 1);
INSERT INTO `interests` VALUES (139, 'прогулки под дождем', 1);
INSERT INTO `interests` VALUES (140, 'Танцы музыка', 1);
INSERT INTO `interests` VALUES (141, 'домино и вино', 1);
INSERT INTO `interests` VALUES (142, 'ах оставьте', 1);
INSERT INTO `interests` VALUES (143, 'не так уж и интересно ;)', 1);
INSERT INTO `interests` VALUES (144, 'путешествия и прогулки', 1);
INSERT INTO `interests` VALUES (145, 'свобода самовыражения', 1);
INSERT INTO `interests` VALUES (146, 'паркур', 1);
INSERT INTO `interests` VALUES (147, 'сказки', 1);
INSERT INTO `interests` VALUES (148, 'Encounter Сноуборд ( freestyle', 1);
INSERT INTO `interests` VALUES (149, 'автостоп', 1);
INSERT INTO `interests` VALUES (150, 'делать деньги из воздуха', 1);
INSERT INTO `interests` VALUES (151, 'охота рыбалка', 1);
INSERT INTO `interests` VALUES (152, 'бродяжничество по сети', 1);
INSERT INTO `interests` VALUES (153, 'восточные танцы', 1);
INSERT INTO `interests` VALUES (154, 'прогулки на роликах', 1);
INSERT INTO `interests` VALUES (155, 'кирпичебросание', 1);
INSERT INTO `interests` VALUES (156, 'дизайн верстка', 1);
INSERT INTO `interests` VALUES (157, 'дорогие машины', 1);
INSERT INTO `interests` VALUES (158, 'Все что связано с водой!', 1);
INSERT INTO `interests` VALUES (159, 'да нет интересов', 1);
INSERT INTO `interests` VALUES (160, 'одна работа', 1);
INSERT INTO `interests` VALUES (161, 'Футболист-профессионал', 1);
INSERT INTO `interests` VALUES (162, 'путешествия по сети', 1);
INSERT INTO `interests` VALUES (163, 'машины спорт и вообще все интересное по жизни', 1);
INSERT INTO `interests` VALUES (164, 'поиск интересных людей в этом мире', 1);
INSERT INTO `interests` VALUES (165, 'прогулки на велосипедах', 1);
INSERT INTO `interests` VALUES (166, 'мечтаю поехать в горы', 1);
INSERT INTO `interests` VALUES (167, 'жарить шашлык на природе', 1);
INSERT INTO `interests` VALUES (168, 'отели', 1);
INSERT INTO `interests` VALUES (169, 'кофе', 1);
INSERT INTO `interests` VALUES (170, 'шоколад', 1);
INSERT INTO `interests` VALUES (171, 'смс', 1);
INSERT INTO `interests` VALUES (172, 'ночь', 1);
INSERT INTO `interests` VALUES (173, 'океан', 1);
INSERT INTO `interests` VALUES (174, 'чужие мысли', 1);
INSERT INTO `interests` VALUES (175, 'ветер', 1);
INSERT INTO `interests` VALUES (176, 'мечты...ect.', 1);
INSERT INTO `interests` VALUES (177, 'танцы ночами', 1);
INSERT INTO `interests` VALUES (178, 'физкультура и спорт!', 1);
INSERT INTO `interests` VALUES (179, 'в поиске', 1);
INSERT INTO `interests` VALUES (180, 'плавание на моторны лодках', 1);
INSERT INTO `interests` VALUES (181, 'яхтах', 1);
INSERT INTO `interests` VALUES (182, 'катаюсь с друзями на мотиках', 1);
INSERT INTO `interests` VALUES (183, 'учеба', 2);
INSERT INTO `interests` VALUES (184, 'и только она', 1);
INSERT INTO `interests` VALUES (185, 'хоккей', 1);
INSERT INTO `interests` VALUES (186, 'люблю фотографировать', 1);
INSERT INTO `interests` VALUES (187, 'рыбалка', 1);
INSERT INTO `interests` VALUES (188, 'велоспорт', 1);
INSERT INTO `interests` VALUES (189, 'Восточные единоборства', 1);
INSERT INTO `interests` VALUES (190, 'классический вид', 1);
INSERT INTO `interests` VALUES (191, 'Интересуюсь всем по немногу.', 1);
INSERT INTO `interests` VALUES (192, 'дайвинг', 1);
INSERT INTO `interests` VALUES (193, 'фотографирование путешествия', 1);
INSERT INTO `interests` VALUES (194, 'Пейнтбол', 1);
INSERT INTO `interests` VALUES (195, 'ну в общем все сказанно', 1);
INSERT INTO `interests` VALUES (196, 'лыжи и биатлон', 1);
INSERT INTO `interests` VALUES (197, 'пока по телевизору', 1);
INSERT INTO `interests` VALUES (198, 'Шейпинг', 1);
INSERT INTO `interests` VALUES (199, 'мотоциклы', 2);
INSERT INTO `interests` VALUES (200, 'тренажёрный зал', 1);
INSERT INTO `interests` VALUES (201, 'могу заниматься спортом', 1);
INSERT INTO `interests` VALUES (202, 'играть на пианино', 1);
INSERT INTO `interests` VALUES (203, 'плавать', 1);
INSERT INTO `interests` VALUES (204, 'путешествовать', 1);
INSERT INTO `interests` VALUES (205, 'но как понять', 1);
INSERT INTO `interests` VALUES (206, 'что действительно нужно?', 1);
INSERT INTO `interests` VALUES (207, 'Коньки', 1);
INSERT INTO `interests` VALUES (208, 'Информационные технологии', 1);
INSERT INTO `interests` VALUES (209, 'дизайн одежды', 1);
INSERT INTO `interests` VALUES (210, 'всё зависит от настроения и компании', 1);
INSERT INTO `interests` VALUES (211, 'танцы по максимуму!', 1);
INSERT INTO `interests` VALUES (212, 'разносторонние', 1);
INSERT INTO `interests` VALUES (213, 'компании', 1);
INSERT INTO `interests` VALUES (214, 'хорошее общество', 1);
INSERT INTO `interests` VALUES (215, 'отдых отработы и карьеры', 1);
INSERT INTO `interests` VALUES (216, 'фанат футбола', 1);
INSERT INTO `interests` VALUES (217, 'общение во всех отношениях', 1);
INSERT INTO `interests` VALUES (218, 'все подряд :)', 1);
INSERT INTO `interests` VALUES (219, 'русская баня;)', 1);
INSERT INTO `interests` VALUES (220, 'я будущий психолог', 1);
INSERT INTO `interests` VALUES (221, 'От настроениея зависит - все от гонок до поглощения попкорна в кино', 1);
INSERT INTO `interests` VALUES (222, 'люблю пожить со вкусом :)', 1);
INSERT INTO `interests` VALUES (223, 'Уважаю баскетбол играю с 5 лет', 1);
INSERT INTO `interests` VALUES (224, 'люблю гулять и фотографировать все', 1);
INSERT INTO `interests` VALUES (225, 'что вижу', 1);
INSERT INTO `interests` VALUES (226, 'ценю все то', 1);
INSERT INTO `interests` VALUES (227, 'что имею', 1);
INSERT INTO `interests` VALUES (228, 'стремлюс к большем', 1);
INSERT INTO `interests` VALUES (229, 'поэтому и интересов немеряно', 1);
INSERT INTO `interests` VALUES (230, 'скорее бы вернуться домой из армии ;)', 1);
INSERT INTO `interests` VALUES (231, 'регионоведение', 1);
INSERT INTO `interests` VALUES (232, 'искусство путешествий', 1);
INSERT INTO `interests` VALUES (233, 'музыка разума', 1);
INSERT INTO `interests` VALUES (234, 'вольная борьба', 1);
INSERT INTO `interests` VALUES (235, 'коллекционирование фотографий', 1);
INSERT INTO `interests` VALUES (236, 'ворвусь в музыку а может быть буду тупо лежать на диване и пялиться в потолок', 1);
INSERT INTO `interests` VALUES (237, 'походы по магазинам', 1);
INSERT INTO `interests` VALUES (238, 'dance', 1);
INSERT INTO `interests` VALUES (239, 'плету подвенечные венки', 1);
INSERT INTO `interests` VALUES (240, 'люблю готовить. мне нравится приносить людям новое творение от исскуство приготовление пищи', 1);
INSERT INTO `interests` VALUES (241, 'собираю монетки по одной копейке собрала уже более 100 рублей копейками :)', 1);
INSERT INTO `interests` VALUES (242, 'Люблю кататься на чем нибудь многосильном', 1);
INSERT INTO `interests` VALUES (243, 'люблю общаться с людьми :)', 1);
INSERT INTO `interests` VALUES (244, 'бодибилдинг', 1);
INSERT INTO `interests` VALUES (245, 'картинг', 1);
INSERT INTO `interests` VALUES (246, 'интернет и программирование', 1);
INSERT INTO `interests` VALUES (247, 'все от фитнеса до шахмат', 1);
INSERT INTO `interests` VALUES (248, 'люблю пробовать все новое', 1);
INSERT INTO `interests` VALUES (249, 'разносторонняя личность - и этим все сказанно', 1);
INSERT INTO `interests` VALUES (250, 'медитация и йога', 1);
INSERT INTO `interests` VALUES (251, 'Встресчи с друзьями', 1);
INSERT INTO `interests` VALUES (252, 'все остальне - мелочи жизни', 1);
INSERT INTO `interests` VALUES (253, 'музыка и спорт', 1);
INSERT INTO `interests` VALUES (254, 'у меня много амбиций', 1);
INSERT INTO `interests` VALUES (255, 'спортивное зашивание котов по мешкам', 1);
INSERT INTO `interests` VALUES (256, 'Занимаюсь продажей новых автомобилей', 1);
INSERT INTO `interests` VALUES (257, 'люблю гулять', 1);
INSERT INTO `interests` VALUES (258, 'Бег с сумками по пересеченной местности.(мастер спорта :D)', 1);
INSERT INTO `interests` VALUES (259, 'Интересы Интересы Интересы Интересы Интересы', 1);
INSERT INTO `interests` VALUES (260, 'gfdg', 1);
INSERT INTO `interests` VALUES (261, 'Интересы', 0);
INSERT INTO `interests` VALUES (262, '12333333', 0);
INSERT INTO `interests` VALUES (263, '7777', 0);
INSERT INTO `interests` VALUES (264, '777777', 0);
INSERT INTO `interests` VALUES (265, '1243', 0);
INSERT INTO `interests` VALUES (266, 'еееее', 0);
INSERT INTO `interests` VALUES (267, '123123', 0);
INSERT INTO `interests` VALUES (268, '234234', 0);
INSERT INTO `interests` VALUES (269, '11', 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `messages`
-- 

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) NOT NULL auto_increment,
  `header` varchar(255) character set cp1251 default NULL,
  `m_text` text character set cp1251,
  `send_date` datetime default NULL,
  `author_id` bigint(20) default '0',
  `recipient_id` bigint(20) default '0',
  `avatar_id` bigint(20) default '0',
  `is_read` tinyint(4) default '0',
  `is_deleted` tinyint(4) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- 
-- Дамп данных таблицы `messages`
-- 

INSERT INTO `messages` VALUES (1, 's', 'ddwew', '2008-12-04 17:46:21', 2, 1, 0, 1, 2);
INSERT INTO `messages` VALUES (2, '1', '12wdwd', '2008-12-04 17:46:21', 2, 1, 0, 1, 2);
INSERT INTO `messages` VALUES (9, 'www', 'eeee', '2008-12-08 13:23:15', 1, 2, 48, 1, 0);
INSERT INTO `messages` VALUES (4, 'tyty', 'ddd', '2008-12-08 11:58:44', 5, 1, NULL, 1, 0);
INSERT INTO `messages` VALUES (5, 'hiii', 'help', '2008-12-08 12:03:02', 6, 1, NULL, 1, 0);
INSERT INTO `messages` VALUES (6, '222', 'www', '2008-12-08 12:59:59', 1, 3, 48, 0, 0);
INSERT INTO `messages` VALUES (7, 'test', 'hii', '2008-12-08 13:00:22', 5, 2, 48, 1, 0);
INSERT INTO `messages` VALUES (8, 'sdfsdf', 'ffffff', '2008-12-08 13:01:25', 2, 1, 49, 1, 2);
INSERT INTO `messages` VALUES (10, 'hello', 'admin message', '2008-12-08 13:23:57', 7, 1, 48, 1, 0);
INSERT INTO `messages` VALUES (11, '&lt;script&gt;alert(111);&lt;/script&gt;', '&lt;script&gt;alert(2);&lt;/script&gt;\r\n\r\nsdf\r\n\r\nsdf\r\nsd\r\nf\r\nsd\r\nfs', '2008-12-08 13:25:47', 3, 1, 48, 1, 0);
INSERT INTO `messages` VALUES (12, 'Re: hiii', '&gt;&gt; help', '2008-12-08 15:00:51', 1, 7, 48, 0, 0);
INSERT INTO `messages` VALUES (13, 'Re2: sdfsdf', 'привет второй', '2008-12-08 15:46:59', 1, 2, 48, 1, 0);
INSERT INTO `messages` VALUES (14, 'еуые', 'сссссссссссс', '2008-12-10 14:32:43', 1, 3, 48, 0, 0);
INSERT INTO `messages` VALUES (15, '111111111', '2322222222222', '2008-12-10 14:32:58', 1, 3, 0, 0, 0);
INSERT INTO `messages` VALUES (16, '333', '444', '2008-12-10 14:33:39', 1, 2, 48, 0, 0);
INSERT INTO `messages` VALUES (17, '444', '555', '2008-12-10 14:38:24', 2, 1, 49, 1, 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `money_transaction`
-- 

DROP TABLE IF EXISTS `money_transaction`;
CREATE TABLE IF NOT EXISTS `money_transaction` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `partner_id` bigint(20) default NULL,
  `amount` double(20,2) default NULL,
  `transaction_date` datetime default NULL,
  `description` varchar(200) character set cp1251 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=264 DEFAULT CHARSET=utf8 AUTO_INCREMENT=264 ;

-- 
-- Дамп данных таблицы `money_transaction`
-- 

INSERT INTO `money_transaction` VALUES (1, 6, 0, 100.50, '2008-11-21 17:37:37', 'HJYH');
INSERT INTO `money_transaction` VALUES (2, 5, 0, 455.00, '2008-11-21 17:36:58', 'WERT');
INSERT INTO `money_transaction` VALUES (3, 1, 2, 56.00, '2008-11-13 15:44:25', 'просто так');
INSERT INTO `money_transaction` VALUES (4, 4, 2, 347.00, '2008-11-13 15:46:29', 'добавка');
INSERT INTO `money_transaction` VALUES (5, 3, 0, 200.00, '2008-11-13 15:47:58', 'добавка');
INSERT INTO `money_transaction` VALUES (16, 7, 0, 564.00, '2008-11-13 17:45:54', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (15, 1, 0, -4.00, '2008-11-13 17:45:48', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (14, 1, 0, 3.00, '2008-11-13 17:45:48', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (13, 1, 0, -3.00, '2008-11-13 17:45:41', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (12, 2, 0, 266.00, '2008-11-13 17:45:41', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (17, 1, 0, -10.00, '2008-11-13 17:45:54', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (18, 1, 0, 10.00, '2008-11-13 17:46:00', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (19, 1, 0, -20.00, '2008-11-13 17:46:00', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (20, 2, 1, 200.00, '2008-11-13 17:50:26', 'от Админа');
INSERT INTO `money_transaction` VALUES (21, 3, 1, 300.00, '2008-11-13 17:50:26', 'от Друзей');
INSERT INTO `money_transaction` VALUES (22, 1, 0, 20.00, '2008-11-13 17:57:30', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (23, 1, 0, -25.00, '2008-11-13 17:57:30', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (24, 1, 0, 25.00, '2008-11-13 17:57:43', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (25, 1, 0, -30.00, '2008-11-13 17:57:43', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (26, 3, 0, 30.00, '2008-11-13 17:58:47', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (27, 1, 0, -35.00, '2008-11-13 17:58:47', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (28, 1, 0, 35.00, '2008-11-13 17:58:58', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (29, 3, 0, -40.00, '2008-11-13 17:58:58', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (30, 3, 0, 40.00, '2008-11-13 17:59:19', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (31, 3, 0, -45.00, '2008-11-13 17:59:19', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (32, 3, 0, 45.00, '2008-11-13 17:59:41', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (33, 1, 0, -48.00, '2008-11-13 17:59:41', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (34, 1, 0, 48.00, '2008-11-13 17:59:52', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (35, 3, 0, -50.00, '2008-11-13 17:59:52', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (36, 3, 0, 50.00, '2008-11-13 18:00:03', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (103, 3, 0, -5.00, '2008-11-21 17:21:23', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (102, 1, 0, 4.00, '2008-11-21 17:21:23', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (101, 1, 0, -4.00, '2008-11-21 17:20:55', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (100, 3, 0, 3.00, '2008-11-21 17:20:55', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (99, 3, 0, -3.00, '2008-11-21 17:15:19', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (98, 1, 0, 2.00, '2008-11-21 17:15:19', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (97, 1, 0, -2.00, '2008-11-21 17:14:05', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (96, NULL, 0, 0.00, '2008-11-21 17:14:05', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (95, 2, 0, 111.00, '2008-11-21 10:23:34', 'В дебатах (id 2) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (94, 2, 0, -111.00, '2008-11-21 10:16:45', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (93, NULL, 0, 0.00, '2008-11-21 10:16:45', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (92, 3, 0, 5.00, '2008-11-21 09:22:40', 'В дебатах (id 1) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (91, 3, 0, 12.00, '2008-11-21 09:22:40', 'В дебатах (id 1) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (90, 2, 0, 12.00, '2008-11-21 09:22:40', 'В дебатах (id 1) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (89, 3, 0, -5.00, '2008-11-21 09:19:11', 'ставка в дебатах, на учасника ID = 2');
INSERT INTO `money_transaction` VALUES (88, 3, 0, -12.00, '2008-11-21 09:18:07', 'ставка в дебатах, на учасника ID = 1');
INSERT INTO `money_transaction` VALUES (87, 2, 0, -12.00, '2008-11-21 09:14:53', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (86, NULL, 0, 0.00, '2008-11-21 09:14:53', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (85, 6, 0, 200.00, '2008-11-20 16:57:54', 'просто');
INSERT INTO `money_transaction` VALUES (84, 2, 0, -12.00, '2008-11-20 16:53:37', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (83, NULL, 0, 0.00, '2008-11-20 16:53:37', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (82, 2, 0, 12.00, '2008-11-20 16:49:30', 'В дебатах (id 22) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (81, 2, 0, -12.00, '2008-11-20 16:41:37', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (80, NULL, 0, 0.00, '2008-11-20 16:41:37', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (79, 1, 0, -33.00, '2008-11-20 16:15:43', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (78, NULL, 0, 0.00, '2008-11-20 16:15:43', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (67, 1, 0, 7.00, '2008-11-20 13:08:10', 'Ваша ставка 5 nm выиграла в дебатах id=11');
INSERT INTO `money_transaction` VALUES (68, 1, 0, 3.00, '2008-11-20 13:20:43', 'Ваша ставка 2 nm выиграла в дебатах id=12');
INSERT INTO `money_transaction` VALUES (69, 1, 0, 7.00, '2008-11-20 13:20:43', 'Ваша ставка 5 nm выиграла в дебатах id=12');
INSERT INTO `money_transaction` VALUES (70, 1, 0, 3.00, '2008-11-20 13:33:16', 'Ваша ставка 2 nm выиграла в дебатах id=13');
INSERT INTO `money_transaction` VALUES (71, 1, 0, 7.50, '2008-11-20 13:33:16', 'Ваша ставка 5 nm выиграла в дебатах id=13');
INSERT INTO `money_transaction` VALUES (72, 1, 0, 3.00, '2008-11-20 13:45:59', 'Ваша ставка 2 nm выиграла в дебатах id=14');
INSERT INTO `money_transaction` VALUES (73, 1, 0, 7.50, '2008-11-20 13:45:59', 'Ваша ставка 5 nm выиграла в дебатах id=14');
INSERT INTO `money_transaction` VALUES (74, 1, 0, 3.00, '2008-11-20 13:58:34', 'Ваша ставка 2 nm выиграла в дебатах id=15');
INSERT INTO `money_transaction` VALUES (75, 1, 0, 7.50, '2008-11-20 13:58:34', 'Ваша ставка 5 nm выиграла в дебатах id=15');
INSERT INTO `money_transaction` VALUES (76, 1, 0, 3.00, '2008-11-20 14:12:09', 'Ваша ставка 2 nm выиграла в дебатах id=16');
INSERT INTO `money_transaction` VALUES (77, 1, 0, 7.00, '2008-11-20 14:12:09', 'Ваша ставка 5 nm выиграла в дебатах id=16');
INSERT INTO `money_transaction` VALUES (104, 3, 0, 5.00, '2008-11-21 17:21:46', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (105, 1, 0, -6.00, '2008-11-21 17:21:46', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (106, 3, 0, -2.00, '2008-11-21 17:34:06', 'ставка в дебатах, на учасника ID = 2');
INSERT INTO `money_transaction` VALUES (107, 3, 0, -3.00, '2008-11-21 17:34:12', 'ставка в дебатах, на учасника ID = 1');
INSERT INTO `money_transaction` VALUES (108, 3, 0, -1.00, '2008-11-21 17:34:41', 'ставка в дебатах, на учасника ID = 2');
INSERT INTO `money_transaction` VALUES (109, 3, 0, 3.00, '2008-11-21 17:51:24', 'Ваша ставка 2 nm выиграла в дебатах id=4');
INSERT INTO `money_transaction` VALUES (110, 3, 0, 1.00, '2008-11-21 17:51:24', 'Ваша ставка 1 nm выиграла в дебатах id=4');
INSERT INTO `money_transaction` VALUES (111, 2, 0, -3.00, '2008-11-24 10:37:51', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (112, 2, 0, 3.00, '2008-11-24 10:41:04', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (113, 3, 0, -3.00, '2008-11-24 10:41:04', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (114, 2, 0, 3.00, '2008-11-24 10:45:43', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (115, 3, 0, -4.00, '2008-11-24 10:45:43', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (116, 3, 0, 4.00, '2008-11-24 10:47:27', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (117, 2, 0, -4.00, '2008-11-24 10:47:27', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (118, 2, 0, -5.00, '2008-11-24 10:51:40', 'ставка в дебатах, на учасника ID = 1');
INSERT INTO `money_transaction` VALUES (119, 2, 0, -3.50, '2008-11-24 10:52:13', 'ставка в дебатах, на учасника ID = 3');
INSERT INTO `money_transaction` VALUES (120, 2, 0, -6.80, '2008-11-24 10:52:31', 'ставка в дебатах, на учасника ID = 3');
INSERT INTO `money_transaction` VALUES (121, 3, 0, 4.00, '2008-11-24 10:57:02', 'В дебатах (id 5) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (122, 2, 0, 5.00, '2008-11-24 10:57:02', 'В дебатах (id 5) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (123, 2, 0, 3.50, '2008-11-24 10:57:02', 'В дебатах (id 5) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (124, 2, 0, 6.80, '2008-11-24 10:57:02', 'В дебатах (id 5) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (125, 2, 0, -2.00, '2008-11-24 11:04:41', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (126, 2, 0, 2.00, '2008-11-24 11:07:06', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (127, 3, 0, -2.00, '2008-11-24 11:07:06', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (128, 3, 0, 2.00, '2008-11-24 11:07:48', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (129, 2, 0, -2.60, '2008-11-24 11:07:48', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (130, 2, 0, 2.60, '2008-11-24 11:11:37', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (131, 3, 0, -2.00, '2008-11-24 11:11:37', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (132, 3, 0, 2.00, '2008-11-24 11:14:22', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (133, 2, 0, -3.10, '2008-11-24 11:14:22', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (134, 2, 0, 3.10, '2008-11-24 11:15:16', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (135, 3, 0, -3.30, '2008-11-24 11:15:16', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (136, 2, 0, -2.00, '2008-11-24 11:21:11', 'ставка в дебатах, на учасника ID = 1');
INSERT INTO `money_transaction` VALUES (137, 2, 0, -3.00, '2008-11-24 11:21:16', 'ставка в дебатах, на учасника ID = 3');
INSERT INTO `money_transaction` VALUES (138, 2, 0, -1.20, '2008-11-24 11:23:01', 'ставка в дебатах, на учасника ID = 1');
INSERT INTO `money_transaction` VALUES (139, 2, 0, -3.00, '2008-11-24 11:23:44', 'ставка в дебатах, на учасника ID = 1');
INSERT INTO `money_transaction` VALUES (140, 2, 0, -3.00, '2008-11-24 11:24:30', 'ставка в дебатах, на учасника ID = 3');
INSERT INTO `money_transaction` VALUES (141, 2, 0, -1.00, '2008-11-24 11:26:00', 'ставка в дебатах, на учасника ID = 1');
INSERT INTO `money_transaction` VALUES (142, 2, 0, -1.00, '2008-11-24 11:26:31', 'ставка в дебатах, на учасника ID = 1');
INSERT INTO `money_transaction` VALUES (143, 2, 0, -1.70, '2008-11-24 11:37:14', 'ставка в дебатах, на учасника ID = 3');
INSERT INTO `money_transaction` VALUES (144, 3, 0, 3.30, '2008-11-24 11:43:31', 'В дебатах (id 6) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (145, 2, 0, 2.00, '2008-11-24 11:43:31', 'В дебатах (id 6) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (146, 2, 0, 3.00, '2008-11-24 11:43:31', 'В дебатах (id 6) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (147, 2, 0, 1.20, '2008-11-24 11:43:31', 'В дебатах (id 6) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (148, 2, 0, 3.00, '2008-11-24 11:43:31', 'В дебатах (id 6) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (149, 2, 0, 3.00, '2008-11-24 11:43:31', 'В дебатах (id 6) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (150, 2, 0, 1.00, '2008-11-24 11:43:31', 'В дебатах (id 6) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (151, 2, 0, 1.00, '2008-11-24 11:43:31', 'В дебатах (id 6) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (152, 2, 0, 1.00, '2008-11-24 11:43:31', 'В дебатах (id 6) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (153, 2, 0, 1.00, '2008-11-24 11:43:31', 'В дебатах (id 6) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (154, 2, 0, 1.00, '2008-11-24 11:43:31', 'В дебатах (id 6) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (155, 1, 0, 3.50, '2008-11-24 11:43:31', 'В дебатах (id 6) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (156, 2, 0, 1.00, '2008-11-24 11:43:31', 'В дебатах (id 6) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (157, 2, 0, 1.70, '2008-11-24 11:43:31', 'В дебатах (id 6) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (158, 1, 0, -1.20, '2008-11-24 12:09:55', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (159, 1, 0, 1.20, '2008-11-24 12:10:05', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (160, 2, 0, -3.20, '2008-11-24 12:10:05', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (161, 2, 0, 3.20, '2008-11-24 12:10:29', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (162, 3, 0, -3.40, '2008-11-24 12:10:29', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (163, 2, 0, -12.89, '2008-11-24 12:19:11', 'ставка в дебатах, на учасника ID = 1');
INSERT INTO `money_transaction` VALUES (164, 2, 0, -22.00, '2008-11-24 12:20:06', 'ставка в дебатах, на учасника ID = 1');
INSERT INTO `money_transaction` VALUES (165, 2, 0, -2.00, '2008-11-24 12:21:26', 'ставка в дебатах, на учасника ID = 1');
INSERT INTO `money_transaction` VALUES (166, 2, 0, -3.44, '2008-11-24 12:21:33', 'ставка в дебатах, на учасника ID = 1');
INSERT INTO `money_transaction` VALUES (167, 2, 0, 19.34, '2008-11-24 12:32:29', 'Ваша ставка 12.89 nm выиграла в дебатах id=7');
INSERT INTO `money_transaction` VALUES (168, 2, 0, 33.00, '2008-11-24 12:32:29', 'Ваша ставка 22.00 nm выиграла в дебатах id=7');
INSERT INTO `money_transaction` VALUES (169, 2, 0, 3.00, '2008-11-24 12:32:29', 'Ваша ставка 2.00 nm выиграла в дебатах id=7');
INSERT INTO `money_transaction` VALUES (170, 2, 0, 5.16, '2008-11-24 12:32:29', 'Ваша ставка 3.44 nm выиграла в дебатах id=7');
INSERT INTO `money_transaction` VALUES (171, 3, 0, -4.50, '2008-11-24 12:34:33', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (172, 3, 0, -2.70, '2008-11-24 12:43:32', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (173, 2, 0, -3.00, '2008-11-24 12:45:12', 'ставка в дебатах, на учасника ID = 5');
INSERT INTO `money_transaction` VALUES (174, 1, 0, -4.70, '2008-11-24 12:50:22', 'ставка в дебатах, на учасника ID = 5');
INSERT INTO `money_transaction` VALUES (175, 2, 0, -4.70, '2008-11-24 12:50:28', 'ставка в дебатах, на учасника ID = 3');
INSERT INTO `money_transaction` VALUES (176, 2, 0, 4.50, '2008-11-24 12:54:05', 'Ваша ставка 3.00 nm выиграла в дебатах id=9');
INSERT INTO `money_transaction` VALUES (177, 1, 0, 7.05, '2008-11-24 12:54:05', 'Ваша ставка 4.70 nm выиграла в дебатах id=9');
INSERT INTO `money_transaction` VALUES (178, 3, 0, -4.00, '2008-11-24 12:57:46', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (179, 2, 0, -6.00, '2008-11-24 12:59:30', 'ставка в дебатах, на учасника ID = 3');
INSERT INTO `money_transaction` VALUES (180, 3, 0, 6.00, '2008-11-24 13:01:51', 'Ваша ставка 4 nm выиграла в дебатах id=10');
INSERT INTO `money_transaction` VALUES (181, 2, 0, 9.00, '2008-11-24 13:01:51', 'Ваша ставка 6.00 nm выиграла в дебатах id=10');
INSERT INTO `money_transaction` VALUES (182, 3, 0, -3.00, '2008-11-24 17:26:29', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (183, 3, 0, 3.00, '2008-11-25 09:50:35', 'В дебатах (id 0) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (184, 5, 0, -12.00, '2008-11-25 13:01:21', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (185, 3, 0, -45.00, '2008-11-25 15:08:15', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (186, 5, 0, -44.00, '2008-11-25 15:10:59', 'ставка в дебатах, на учасника ID = 1');
INSERT INTO `money_transaction` VALUES (187, 5, 0, -2.00, '2008-11-25 15:11:20', 'ставка в дебатах, на учасника ID = 1');
INSERT INTO `money_transaction` VALUES (188, 5, 0, -4.00, '2008-11-25 15:12:34', 'ставка в дебатах, на учасника ID = 3');
INSERT INTO `money_transaction` VALUES (189, 5, 0, 66.00, '2008-11-25 15:16:36', 'Ваша ставка 44.00 nm выиграла в дебатах id=0');
INSERT INTO `money_transaction` VALUES (190, 5, 0, 3.00, '2008-11-25 15:16:36', 'Ваша ставка 2.00 nm выиграла в дебатах id=0');
INSERT INTO `money_transaction` VALUES (191, 5, 0, 44.00, '2008-11-25 15:41:25', 'В дебатах (id 12) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (192, 5, 0, 2.00, '2008-11-25 15:41:25', 'В дебатах (id 12) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (193, 5, 0, 4.00, '2008-11-25 15:41:25', 'В дебатах (id 12) была ничья. Ваша ставка возвращается');
INSERT INTO `money_transaction` VALUES (194, 224, 0, 2.50, '2008-11-26 10:07:49', 'За регистрацию');
INSERT INTO `money_transaction` VALUES (215, 1, 0, 1.12, '2008-11-27 17:32:16', 'Изменение регистрационных данных');
INSERT INTO `money_transaction` VALUES (196, 1, 0, -2.23, '2008-11-26 12:14:30', 'Изменение регистрационных данных');
INSERT INTO `money_transaction` VALUES (197, 1, 0, 0.30, '2008-11-26 12:17:18', 'Изменение регистрационных данных');
INSERT INTO `money_transaction` VALUES (198, 1, 0, 1.92, '2008-11-26 12:19:41', 'Изменение регистрационных данных');
INSERT INTO `money_transaction` VALUES (214, 1, 0, -1.13, '2008-11-27 17:31:35', 'Изменение регистрационных данных');
INSERT INTO `money_transaction` VALUES (202, 1, 0, -2.23, '2008-11-26 12:36:18', 'Изменение регистрационных данных');
INSERT INTO `money_transaction` VALUES (203, 1, 0, 2.23, '2008-11-26 12:41:34', 'Изменение регистрационных данных');
INSERT INTO `money_transaction` VALUES (213, 1, 0, 0.20, '2008-11-27 17:31:03', 'Изменение регистрационных данных');
INSERT INTO `money_transaction` VALUES (205, 1, 0, -0.10, '2008-11-26 12:45:59', 'Изменение регистрационных данных');
INSERT INTO `money_transaction` VALUES (206, 1, 0, 0.10, '2008-11-26 12:49:17', 'Изменение регистрационных данных');
INSERT INTO `money_transaction` VALUES (212, 1, 0, -0.10, '2008-11-27 17:30:28', 'Изменение регистрационных данных');
INSERT INTO `money_transaction` VALUES (211, 1, 0, -0.10, '2008-11-27 17:29:43', 'Изменение регистрационных данных');
INSERT INTO `money_transaction` VALUES (216, 1, 0, -1.00, '2008-12-03 15:12:20', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (217, 1, 0, 1.00, '2008-12-03 15:13:59', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (218, 3, 0, -1.20, '2008-12-03 15:13:59', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (219, 3, 0, 1.20, '2008-12-03 15:14:47', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (220, 1, 0, -1.30, '2008-12-03 15:14:47', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (221, 1, 0, 1.30, '2008-12-03 15:16:18', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (222, 3, 0, -2.00, '2008-12-03 15:16:18', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (223, 3, 0, 2.00, '2008-12-03 15:20:05', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (224, 1, 0, -2.20, '2008-12-03 15:20:05', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (225, 1, 0, 2.20, '2008-12-03 15:20:28', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (226, 3, 0, -3.00, '2008-12-03 15:20:28', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (227, 3, 0, 3.00, '2008-12-03 15:24:53', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (228, 1, 0, -4.00, '2008-12-03 15:24:53', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (229, 1, 0, 4.00, '2008-12-03 15:25:02', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (230, 3, 0, -5.00, '2008-12-03 15:25:02', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (231, 5, 0, -3.00, '2008-12-03 17:50:51', 'ставка в дебатах, на учасника ID = 2');
INSERT INTO `money_transaction` VALUES (232, 5, 0, -3.30, '2008-12-03 17:52:54', 'ставка в дебатах, на учасника ID = 3');
INSERT INTO `money_transaction` VALUES (233, 1, 0, -2.00, '2008-12-03 17:53:23', 'ставка в дебатах, на учасника ID = 2');
INSERT INTO `money_transaction` VALUES (234, 1, 0, -5.30, '2008-12-03 17:54:06', 'ставка в дебатах, на учасника ID = 3');
INSERT INTO `money_transaction` VALUES (235, 1, 0, -1.10, '2008-12-03 17:54:12', 'ставка в дебатах, на учасника ID = 2');
INSERT INTO `money_transaction` VALUES (236, 1, 0, -0.20, '2008-12-03 17:55:56', 'ставка в дебатах, на учасника ID = 3');
INSERT INTO `money_transaction` VALUES (237, 1, 0, -1.10, '2008-12-03 17:59:26', 'ставка в дебатах, на учасника ID = 3');
INSERT INTO `money_transaction` VALUES (238, 1, 0, -1.11, '2008-12-03 18:00:04', 'ставка в дебатах, на учасника ID = 2');
INSERT INTO `money_transaction` VALUES (239, 1, 0, -1.00, '2008-12-03 18:01:36', 'ставка в дебатах, на учасника ID = 3');
INSERT INTO `money_transaction` VALUES (240, 1, 0, -0.10, '2008-12-03 18:02:26', 'ставка в дебатах, на учасника ID = 3');
INSERT INTO `money_transaction` VALUES (241, 1, 0, -0.10, '2008-12-03 18:03:23', 'ставка в дебатах, на учасника ID = 3');
INSERT INTO `money_transaction` VALUES (242, 1, 0, -0.10, '2008-12-03 18:05:47', 'ставка в дебатах, на учасника ID = 2');
INSERT INTO `money_transaction` VALUES (243, 1, 0, -0.21, '2008-12-03 18:06:05', 'ставка в дебатах, на учасника ID = 2');
INSERT INTO `money_transaction` VALUES (244, 5, 0, 4.50, '2008-12-04 10:13:23', 'Ваша ставка 3.00 nm выиграла в дебатах id=13');
INSERT INTO `money_transaction` VALUES (245, 1, 0, 3.00, '2008-12-04 10:13:23', 'Ваша ставка 2.00 nm выиграла в дебатах id=13');
INSERT INTO `money_transaction` VALUES (246, 1, 0, 1.65, '2008-12-04 10:13:24', 'Ваша ставка 1.10 nm выиграла в дебатах id=13');
INSERT INTO `money_transaction` VALUES (247, 1, 0, 1.66, '2008-12-04 10:13:24', 'Ваша ставка 1.11 nm выиграла в дебатах id=13');
INSERT INTO `money_transaction` VALUES (248, 1, 0, 0.15, '2008-12-04 10:13:24', 'Ваша ставка 0.10 nm выиграла в дебатах id=13');
INSERT INTO `money_transaction` VALUES (249, 1, 0, 0.31, '2008-12-04 10:13:24', 'Ваша ставка 0.21 nm выиграла в дебатах id=13');
INSERT INTO `money_transaction` VALUES (250, 5, 0, -1.10, '2008-12-04 10:22:55', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (251, 5, 0, 1.10, '2008-12-04 10:23:10', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (252, 1, 0, -1.20, '2008-12-04 10:23:10', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (253, 1, 0, 1.20, '2008-12-04 10:23:32', 'возвращение ставки в дебатах');
INSERT INTO `money_transaction` VALUES (254, 2, 0, -2.20, '2008-12-04 10:23:32', 'ставка в дебатах, при выборе 2-го учасника');
INSERT INTO `money_transaction` VALUES (255, 5, 0, -0.20, '2008-12-04 10:38:11', 'ставка в дебатах, на учасника [userId = 3]');
INSERT INTO `money_transaction` VALUES (256, 1, 0, -2.30, '2008-12-04 10:38:30', 'ставка в дебатах, на учасника [userId = 3]');
INSERT INTO `money_transaction` VALUES (257, 1, 0, -1.10, '2008-12-04 10:38:37', 'ставка в дебатах, на учасника [userId = 2]');
INSERT INTO `money_transaction` VALUES (258, 1, 0, -3.50, '2008-12-04 10:39:12', 'ставка в дебатах, на учасника [userId = 2]');
INSERT INTO `money_transaction` VALUES (259, 1, 0, -5.20, '2008-12-04 10:39:48', 'ставка в дебатах, на учасника [userId = 3]');
INSERT INTO `money_transaction` VALUES (260, 5, 0, 0.30, '2008-12-04 10:51:14', 'Ваша ставка 0.20 nm выиграла в дебатах [debateId=14]');
INSERT INTO `money_transaction` VALUES (261, 1, 0, 3.45, '2008-12-04 10:51:14', 'Ваша ставка 2.30 nm выиграла в дебатах [debateId=14]');
INSERT INTO `money_transaction` VALUES (262, 1, 0, 7.80, '2008-12-04 10:51:14', 'Ваша ставка 5.20 nm выиграла в дебатах [debateId=14]');
INSERT INTO `money_transaction` VALUES (263, 225, 0, 0.50, '2009-02-16 16:43:10', 'За регистрацию');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Дамп данных таблицы `moods`
-- 

INSERT INTO `moods` VALUES (1, 1, '&lt;script&gt;alert(123);&lt;/script&gt;');
INSERT INTO `moods` VALUES (2, 1, '222');

-- --------------------------------------------------------

-- 
-- Структура таблицы `news`
-- 

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` bigint(20) NOT NULL auto_increment,
  `news_tree_feeds_id` bigint(20) default NULL,
  `title` varchar(255) default NULL,
  `link` varchar(255) default NULL,
  `short_text` text,
  `full_text` text,
  `category` varchar(100) default NULL,
  `pub_date` datetime default NULL,
  `enclosure` varchar(255) default NULL,
  `enclosure_type` varchar(50) default NULL,
  `comments` bigint(20) default '0',
  `views` bigint(20) default '0',
  `favorite_users` bigint(20) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=516 DEFAULT CHARSET=utf8 AUTO_INCREMENT=516 ;

-- 
-- Дамп данных таблицы `news`
-- 

INSERT INTO `news` VALUES (326, 8, 'Auslogics Disk Defrag 1.4.16.308 - дефрагментатор диска', 'http%3A%2F%2Fwww.winblog.ru%2Fsoftall%2Fsoftadm%2F1147764449-11090803.html', ' Программа позволяет осуществлять дефрагментацию диска, что приводит к улучшению его скоростных характеристик и повышает стабильность работы всей системы в...', ' Программа позволяет осуществлять дефрагментацию диска, что приводит к улучшению его скоростных характеристик и повышает стабильность работы всей системы в целом. Auslogics Disk Defrag существенно превосходит другие программы дефрагментации как по скорости работы, так и по качеству дефрагментации. Программа также намного быстрее стандартной утилиты дефрагментации Windows.', 'Софт: администрирование', '2008-09-11 04:20:00', '', '', 0, 0, 1);
INSERT INTO `news` VALUES (349, 10, 'Курс доллара к рублю на ММВБ на открытии снизился на 5 копеек', 'http%3A%2F%2Fnews.yandex.ru%2Fyandsearch%3Fcl4url%3Dwww.vz.ru%2Fnews%2F2008%2F11%2F10%2F227610.html%26amp%3Bcountry%3DRussia%26amp%3Bcat%3D6', 'Средневзвешенный курс евро по итогам единой торговой сессии расчетами today повысился на 5,74 копейки и составил 34,5653 рублей за...', 'Средневзвешенный курс евро по итогам единой торговой сессии расчетами today повысился на 5,74 копейки и составил 34,5653 рублей за евро.', '', '2008-11-10 10:33:43', '', '', 0, 0, 1);
INSERT INTO `news` VALUES (491, 10, 'Банки взяли у ЦБ на первом беззалоговом аукционе 143 млрд рублей', 'http%3A%2F%2Fnews.yandex.ru%2Fyandsearch%3Fcl4url%3Dwww.vz.ru%2Fnews%2F2008%2F11%2F17%2F229818.html%26amp%3Bcountry%3DRussia%26amp%3Bcat%3D6', 'Банк России по итогам сегодняшнего аукциона по предоставлению необеспеченных займов для кредитных организаций предоставит банкам 143,074 млрд рублей, сообщает пресс-служба биржи...', 'Банк России по итогам сегодняшнего аукциона по предоставлению необеспеченных займов для кредитных организаций предоставит банкам 143,074 млрд рублей, сообщает пресс-служба биржи ММВБ.', '', '2008-11-17 12:11:09', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (492, 10, 'Туроператор "Вояж-Люкс" приостановил работу из-за кризиса', 'http%3A%2F%2Fnews.yandex.ru%2Fyandsearch%3Fcl4url%3Dwww.rosbalt.ru%2F2008%2F11%2F17%2F542255.html%26amp%3Bcountry%3DRussia%26amp%3Bcat%3D6', 'Российская туристическая компания "Вояж-Люкс" оповестила сегодня через свой интернет-сайт всех партнеров и клиентов о том, что с 18 ноября вынуждена временно приостановить деятельность "в связи с невозможностью выполнения всех обязательств по предоставлению туристских...', 'Российская туристическая компания "Вояж-Люкс" оповестила сегодня через свой интернет-сайт всех партнеров и клиентов о том, что с 18 ноября вынуждена временно приостановить деятельность "в связи с невозможностью выполнения всех обязательств по предоставлению туристских услуг".', '', '2008-11-17 14:53:00', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (368, 13, 'Система пожаротушения на АПЛ &#xAB;Нерпа&#xBB; уже выходила из строя', 'http%3A%2F%2Fwww.gazeta.ru%2Fnews%2Flastnews%2F2008%2F11%2F10%2Fn_1293896.shtml', 'Неполадки в системе пожаротушения атомной подводной лодки, на которой в субботу погибли 20 человек, фиксировались не в первый раз, сообщил один из инженеров судостроительного завода &quot;Звезда&quot;.\r\n\r\n&quot;Летом этого года во время...', 'Неполадки в системе пожаротушения атомной подводной лодки, на которой в субботу погибли 20 человек, фиксировались не в первый раз, сообщил один из инженеров судостроительного завода &quot;Звезда&quot;.\r\n\r\n&quot;Летом этого года во время ...', '', '2008-11-10 10:40:00', '', '', 0, 0, 1);
INSERT INTO `news` VALUES (370, 13, 'Медведев подписал закон о политических партиях', 'http%3A%2F%2Fwww.gazeta.ru%2Fnews%2Flastnews%2F2008%2F11%2F10%2Fn_1293853.shtml', 'Президент России Дмитрий Медведев подписал закон, уточняющий условия финансирования политических партий в случае их реорганизации, сообщила в понедельник пресс-служба Кремля. \r\n\r\nФедеральный закон &quot;О внесении изменения в статью 32...', 'Президент России Дмитрий Медведев подписал закон, уточняющий условия финансирования политических партий в случае их реорганизации, сообщила в понедельник пресс-служба Кремля. \r\n\r\nФедеральный закон &quot;О внесении изменения в статью 32 ...', '', '2008-11-10 09:28:06', '', '', 0, 0, 1);
INSERT INTO `news` VALUES (515, 13, 'В Индонезии произошло землетрясение силой 7,7; есть угроза цунами', 'http%3A%2F%2Fwww.gazeta.ru%2Fnews%2Flastnews%2F2008%2F11%2F16%2Fn_1296741.shtml', 'В воскресенье в Индонезии произошло сильное землетрясение магнитудой 7,7 баллов. Как сообщила Национальная геологическая служба США, существует угроза цунами. Эпицентр подземного толчка находился в районе остров Сулавеси на глубине 10...', 'В воскресенье в Индонезии произошло сильное землетрясение магнитудой 7,7 баллов. Как сообщила Национальная геологическая служба США, существует угроза цунами. Эпицентр подземного толчка находился в районе остров Сулавеси на глубине 10 ...', '', '2008-11-16 19:34:00', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (514, 13, 'Взрыв произошел на автостоянке на юго-западе Москвы', 'http%3A%2F%2Fwww.gazeta.ru%2Fnews%2Flastnews%2F2008%2F11%2F16%2Fn_1296766.shtml', 'Взрыв прогремел в воскресенье на юго-западе Москвы. Взрывной волной повреждены три автомашины.  Как сообщил источник в правоохранительных органах столицы, пострадавших нет\r\n&quot;Взрыв прогремел на автостоянке в Южном Бутово недалеко от...', 'Взрыв прогремел в воскресенье на юго-западе Москвы. Взрывной волной повреждены три автомашины.  Как сообщил источник в правоохранительных органах столицы, пострадавших нет\r\n&quot;Взрыв прогремел на автостоянке в Южном Бутово недалеко от ...', '', '2008-11-16 20:57:00', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (513, 13, 'Американский шаттл Endeavour состыковался с МКС', 'http%3A%2F%2Fwww.gazeta.ru%2Fnews%2Flastnews%2F2008%2F11%2F17%2Fn_1296817.shtml', 'Космический корабль многоразового использования Endeavour совершил стыковку с Международной космической станцией. \r\n\r\nНеисправность антенны шаттла была устранена в пути. Поэтому командир Крис Фергюсон смог осуществить стыковку по радару....', 'Космический корабль многоразового использования Endeavour совершил стыковку с Международной космической станцией. \r\n\r\nНеисправность антенны шаттла была устранена в пути. Поэтому командир Крис Фергюсон смог осуществить стыковку по радару. ...', '', '2008-11-17 00:13:00', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (512, 13, '&quot;Ъ&quot;: Светлану Бахмину выписали в неизвестном направлении', 'http%3A%2F%2Fwww.gazeta.ru%2Fnews%2Flastnews%2F2008%2F11%2F17%2Fn_1296827.shtml', 'Бывшая юрист НК ЮКОС Светлана Бахмина, отбывающая срок за мошенничество в мордовской колонии и переведенная недавно в местную гражданскую больницу в связи с предстоящими родами, несколько дней назад покинула лечебницу, пищет газета...', 'Бывшая юрист НК ЮКОС Светлана Бахмина, отбывающая срок за мошенничество в мордовской колонии и переведенная недавно в местную гражданскую больницу в связи с предстоящими родами, несколько дней назад покинула лечебницу, пищет газета ...', '', '2008-11-17 01:21:00', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (511, 13, 'В Канаде в результате катастрофы небольшого самолета погибли семь человек', 'http%3A%2F%2Fwww.gazeta.ru%2Fnews%2Flastnews%2F2008%2F11%2F17%2Fn_1296852.shtml', 'Небольшой самолет потерпел крушение в Канаде у южного побережья провинции Британская Колумбия. В результате семь человек погибли, сообщил представитель спасательных служб.\r\n\r\nНа борту самолета-амфибии Grumman Goose находилось восемь...', 'Небольшой самолет потерпел крушение в Канаде у южного побережья провинции Британская Колумбия. В результате семь человек погибли, сообщил представитель спасательных служб.\r\n\r\nНа борту самолета-амфибии Grumman Goose находилось восемь ...', '', '2008-11-17 04:02:00', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (510, 13, 'На Камчатке инспектор ДПС сбил пешеходов', 'http%3A%2F%2Fwww.gazeta.ru%2Fnews%2Flastnews%2F2008%2F11%2F17%2Fn_1296867.shtml', 'В Петропавловске-Камчатском инспектор дорожно-патрульной службы, находясь за рулем собственного автомобиля в нерабочее время, сбил двух пешеходов на пешеходном переходе. \r\n\r\nЖенщина, попавшая под колеса, погибла, еще один пешеход...', 'В Петропавловске-Камчатском инспектор дорожно-патрульной службы, находясь за рулем собственного автомобиля в нерабочее время, сбил двух пешеходов на пешеходном переходе. \r\n\r\nЖенщина, попавшая под колеса, погибла, еще один пешеход ...', '', '2008-11-17 05:24:00', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (509, 13, 'В ДТП в Новгородской области пострадали 9 футбольных фанатов', 'http%3A%2F%2Fwww.gazeta.ru%2Fnews%2Flastnews%2F2008%2F11%2F17%2Fn_1296942.shtml', 'Автобус с футбольными болельщиками попал в аварию на федеральной трассе Москва - Санкт-Петербург в Новгородской области, пострадали девять человек, сообщил в понедельник источник в Новгородском управлении ГИБДД.\r\n\r\nВ автобусе находились...', 'Автобус с футбольными болельщиками попал в аварию на федеральной трассе Москва - Санкт-Петербург в Новгородской области, пострадали девять человек, сообщил в понедельник источник в Новгородском управлении ГИБДД.\r\n\r\nВ автобусе находились ...', '', '2008-11-17 09:34:41', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (508, 13, 'В Махачкале проводится спецоперация по задержанию боевиков', 'http%3A%2F%2Fwww.gazeta.ru%2Fnews%2Flastnews%2F2008%2F11%2F17%2Fn_1296973.shtml', 'Сотрудники правоохранительных органов проводят в Махачкале спецоперацию по нейтрализации группы боевиков.\r\n\r\nНа улице Маяковского в районе завода &#xAB;Эльтав&#xBB; группа из нескольких человек, предположительно участников незаконных...', 'Сотрудники правоохранительных органов проводят в Махачкале спецоперацию по нейтрализации группы боевиков.\r\n\r\nНа улице Маяковского в районе завода &#xAB;Эльтав&#xBB; группа из нескольких человек, предположительно участников незаконных ...', '', '2008-11-17 10:30:05', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (507, 13, 'Бахмина переведена в больницу в Московской области', 'http%3A%2F%2Fwww.gazeta.ru%2Fnews%2Flastnews%2F2008%2F11%2F17%2Fn_1296986.shtml', 'Бывший юрист ЮКОСа Светлана Бахмина, отбывающая наказание в мордовской колонии и направленная ранее из тюремной больницы в местную гражданскую, была переведена в медицинское учреждение Федеральной службы исполнения наказаний в Московской...', 'Бывший юрист ЮКОСа Светлана Бахмина, отбывающая наказание в мордовской колонии и направленная ранее из тюремной больницы в местную гражданскую, была переведена в медицинское учреждение Федеральной службы исполнения наказаний в Московской ...', '', '2008-11-17 10:53:00', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (506, 13, 'Ингушский чиновник и его супруга ранены при обстреле автомобиля', 'http%3A%2F%2Fwww.gazeta.ru%2Fnews%2Flastnews%2F2008%2F11%2F17%2Fn_1297036.shtml', 'Глава администрации муниципального округа Плиевский города Назрань и его супруга получили огнестрельные ранения в результате обстрела их автомашины, сообщил в понедельник по телефону представитель Следственного управления Следственного...', 'Глава администрации муниципального округа Плиевский города Назрань и его супруга получили огнестрельные ранения в результате обстрела их автомашины, сообщил в понедельник по телефону представитель Следственного управления Следственного ...', '', '2008-11-17 12:18:12', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (505, 13, 'Процесс по делу об убийстве Политковской будет открытым', 'http%3A%2F%2Fwww.gazeta.ru%2Fnews%2Flastnews%2F2008%2F11%2F17%2Fn_1297041.shtml', 'Процесс по делу об убийстве обозревателя &#xAB;Новой газеты&#xBB; Анны Политковской будет открытым. Об этом сообщил корреспондент &#xAB;Газеты.Ru&#xBB; из зала Московского окружного военного суда, в ходе заседания которого решался вопрос о...', 'Процесс по делу об убийстве обозревателя &#xAB;Новой газеты&#xBB; Анны Политковской будет открытым. Об этом сообщил корреспондент &#xAB;Газеты.Ru&#xBB; из зала Московского окружного военного суда, в ходе заседания которого решался вопрос о ...', '', '2008-11-17 12:31:40', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (504, 13, 'Дети Анны Политковской требуют компенсацию в 10 млн рублей', 'http%3A%2F%2Fwww.gazeta.ru%2Fnews%2Flastnews%2F2008%2F11%2F17%2Fn_1297065.shtml', 'Дети убитой журналистки Анны Политковской заявили иск о возмещении 10 миллионов рублей в качестве компенсации. Судья Московского окружного военного суда, где проходят слушания, признал потерпевших гражданскими истцами и принял иск....', 'Дети убитой журналистки Анны Политковской заявили иск о возмещении 10 миллионов рублей в качестве компенсации. Судья Московского окружного военного суда, где проходят слушания, признал потерпевших гражданскими истцами и принял иск. ...', '', '2008-11-17 13:24:50', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (503, 13, 'В Махачкале начался штурм дома с боевиками', 'http%3A%2F%2Fwww.gazeta.ru%2Fnews%2Flastnews%2F2008%2F11%2F17%2Fn_1297105.shtml', 'МВД и УФСБ России по Дагестану начали операцию по нейтрализации группы боевиков, блокированных в одной из квартир шестиэтажного дома в Махачкале. В пределах улиц Киримова, Лизы Чайкиной и Свердлова сегодня с 13:30 мск и до особого...', 'МВД и УФСБ России по Дагестану начали операцию по нейтрализации группы боевиков, блокированных в одной из квартир шестиэтажного дома в Махачкале. В пределах улиц Киримова, Лизы Чайкиной и Свердлова сегодня с 13:30 мск и до особого ...', '', '2008-11-17 14:32:00', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (502, 13, 'Водитель Mercedes, до смерти избивший пешехода, получил 7 лет', 'http%3A%2F%2Fwww.gazeta.ru%2Fnews%2Flastnews%2F2008%2F11%2F17%2Fn_1297136.shtml', 'Никулинский суд Москвы приговорил к 7 годам заключения Анатолия Силуянова за убийство пешехода, который мешал его машине первым стартовать на светофоре.\r\n\r\n&quot;Судья вынес приговор, согласно которому Силуянов признан виновным по статье...', 'Никулинский суд Москвы приговорил к 7 годам заключения Анатолия Силуянова за убийство пешехода, который мешал его машине первым стартовать на светофоре.\r\n\r\n&quot;Судья вынес приговор, согласно которому Силуянов признан виновным по статье ...', '', '2008-11-17 15:54:45', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (501, 13, 'В Махачкале в ходе спецоперации уничтожены четыре боевика', 'http%3A%2F%2Fwww.gazeta.ru%2Fnews%2Flastnews%2F2008%2F11%2F17%2Fn_1297154.shtml', 'В Махачкале на улице Киримова в ходе спецоперации спецназом ФСБ уничтожены четверо боевиков, сообщили в пресс- службе Управления ФСБ России по Дагестану.\r\n\r\n&quot;Активная фаза спецоперации завершена, сейчас в квартиру на 3 этаже...', 'В Махачкале на улице Киримова в ходе спецоперации спецназом ФСБ уничтожены четверо боевиков, сообщили в пресс- службе Управления ФСБ России по Дагестану.\r\n\r\n&quot;Активная фаза спецоперации завершена, сейчас в квартиру на 3 этаже ...', '', '2008-11-17 16:36:35', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (500, 11, 'Кризис имеет свои плюсы', 'http%3A%2F%2Fnews-russia.info%2Feconomy%2F2478-crisis-has-the-pluses.html', 'В Вашингтоне  прошло заседание Совета по международным отношениям, которое  было организовано после завершения саммита "большой...', 'В Вашингтоне  прошло заседание Совета по международным отношениям, которое  было организовано после завершения саммита "большой двадцатки".', 'Экономика', '2008-11-17 09:09:36', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (498, 11, 'Сергей Лазарев пересел на метро', 'http%3A%2F%2Fnews-russia.info%2Frumours%2F2480-sergey-infirmary-has-changed-on-metro.html', 'Любимец молодежи, красавчик и просто успешный музыкант - Сергей Лазарев, славился в столице самым крутым и навороченным авто, но недавно он был замечен в...', 'Любимец молодежи, красавчик и просто успешный музыкант - Сергей Лазарев, славился в столице самым крутым и навороченным авто, но недавно он был замечен в московском метро.', 'Слухи', '2008-11-17 09:36:32', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (499, 11, 'Банки вводят ограничения', 'http%3A%2F%2Fnews-russia.info%2Fbusiness%2F2479-banks-enter-restrictions.html', 'При выдаче кредита в любом российском банке  обязательно будет рассматриваться  сфера деятельности заёмщика. Такие ограничения введены в схему предоставления кредитов Банками...', 'При выдаче кредита в любом российском банке  обязательно будет рассматриваться  сфера деятельности заёмщика. Такие ограничения введены в схему предоставления кредитов Банками России.', 'Бизнес', '2008-11-17 09:15:32', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (497, 11, 'Путин за Великобританию на Евровидение', 'http%3A%2F%2Fnews-russia.info%2Fshow_business%2F2481-putin-for-great-britain-on-evrovidenie.html', 'Как сообщает британский композитор Эндрю Ллойд Уэббер, премьер-министр Российской Федерации Владимир Путин собирается голосовать на конкурсе «Евровидение-2009» в Москве за певца из...', 'Как сообщает британский композитор Эндрю Ллойд Уэббер, премьер-министр Российской Федерации Владимир Путин собирается голосовать на конкурсе «Евровидение-2009» в Москве за певца из Великобритании.', 'Шоу-бизнес', '2008-11-17 10:04:43', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (496, 11, 'Яблоки продлят нашу жизнь?', 'http%3A%2F%2Fnews-russia.info%2Fcommunity%2F2482-the-apple-will-prolong-our-life.html', 'По прогнозам медиков, регулярное потребление яблок способствует продлению срока жизни человека, а также омоложению организма. С подобным утверждением выступили британские ученые из Института исследований пищи города...', 'По прогнозам медиков, регулярное потребление яблок способствует продлению срока жизни человека, а также омоложению организма. С подобным утверждением выступили британские ученые из Института исследований пищи города Норич.', 'Oбщество', '2008-11-17 10:28:49', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (495, 11, 'Россия продаёт оружие', 'http%3A%2F%2Fnews-russia.info%2Fpolitics%2F2483-russia-sells-the-weapon.html', 'Глава российского внешнеполитического ведомства Сергей Лавров опроверг мнение о том, что Россия занимается продажей наступательных вооружений странам Латинской Америки и Карибского бассейна...', 'Глава российского внешнеполитического ведомства Сергей Лавров опроверг мнение о том, что Россия занимается продажей наступательных вооружений странам Латинской Америки и Карибского бассейна (ЛАКБ).', 'Политика', '2008-11-17 10:51:21', '', '', 0, 1, 0);
INSERT INTO `news` VALUES (493, 10, 'Чистая прибыль "Аэрофлота" выросла за 9 месяцев на 5,6%', 'http%3A%2F%2Fnews.yandex.ru%2Fyandsearch%3Fcl4url%3Dwww.rian.ru%2Feconomy%2F20081117%2F155340131.html%26amp%3Bcountry%3DRussia%26amp%3Bcat%3D6', 'ОАО Челябинский электрометаллургический комбинат в январе-сентябре 2008 года получило чистую прибыль, рассчитанную по РСБУ, в размере 2...', 'ОАО Челябинский электрометаллургический комбинат в январе-сентябре 2008 года получило чистую прибыль, рассчитанную по РСБУ, в размере 2 млрд.', '', '2008-11-17 15:46:06', '', '', 0, 8, 0);
INSERT INTO `news` VALUES (494, 11, 'В Америке горит штат', 'http%3A%2F%2Fnews-russia.info%2Fin_world%2F2484-in-america-staff-burns.html', 'Калифорния уже третий день находится во власти  лесных пожаров. Почти  800 домов уничтожены...', 'Калифорния уже третий день находится во власти  лесных пожаров. Почти  800 домов уничтожены огнём.', 'В мире', '2008-11-17 10:58:04', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (490, 10, 'Производители спиртного будут оплачивать лечение от алкоголизма', 'http%3A%2F%2Fnews.yandex.ru%2Fyandsearch%3Fcl4url%3Dwww.sibnovosti.ru%3A80%2Farticles%2F62501%26amp%3Bcountry%3DRussia%26amp%3Bcat%3D6', 'Поправки в закон "О госрегулировании производства и оборота этилового спирта, алкогольной и спиртосодержащей продукции" парламентарий обещает внести в Госдуму до конца...', 'Поправки в закон "О госрегулировании производства и оборота этилового спирта, алкогольной и спиртосодержащей продукции" парламентарий обещает внести в Госдуму до конца ноября.', '', '2008-11-17 12:48:00', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (489, 10, 'Саммит "двадцатки" не принял решений по увеличению капитала МВФ', 'http%3A%2F%2Fnews.yandex.ru%2Fyandsearch%3Fcl4url%3Dwww.vz.ru%2Fnews%2F2008%2F11%2F17%2F229837.html%26amp%3Bcountry%3DRussia%26amp%3Bcat%3D6', 'Замминистра финансов РФ  Дмитрий Панкин предсказывает, что следующий саммит "двадцатки" 30 апреля 2009 года будет очень...', 'Замминистра финансов РФ  Дмитрий Панкин предсказывает, что следующий саммит "двадцатки" 30 апреля 2009 года будет очень напряженным.', '', '2008-11-17 12:44:23', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (488, 10, 'Венесуэла построит свой первый ядерный реактор с помощью России', 'http%3A%2F%2Fnews.yandex.ru%2Fyandsearch%3Fcl4url%3Dwww.vedomosti.ru%2Fnewsline%2Findex.shtml%253F2008%2F11%2F17%2F684937%26amp%3Bcountry%3DRussia%26amp%3Bcat%3D6', 'Эксперты полагают, что решение Москвы начать возведение атомного реактора в Венесуэле отвечает стратегическим задачам России по продвижению ядерных технологий на мировые рынки, в частности, на рынки инвестиционно привлекательной Латинской...', 'Эксперты полагают, что решение Москвы начать возведение атомного реактора в Венесуэле отвечает стратегическим задачам России по продвижению ядерных технологий на мировые рынки, в частности, на рынки инвестиционно привлекательной Латинской Америки.', '', '2008-11-17 09:56:00', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (487, 10, 'Экономика Европы вступила в период рецессии впервые за 15 лет', 'http%3A%2F%2Fnews.yandex.ru%2Fyandsearch%3Fcl4url%3Dlenta.ru%2Fnews%2F2008%2F11%2F17%2Fjapan%2F%26amp%3Bcountry%3DRussia%26amp%3Bcat%3D6', 'Тем не менее, экономика Франции неожиданно для многих показала рост в 3 квартале, избежав рецессии, которая поразила экономику...', 'Тем не менее, экономика Франции неожиданно для многих показала рост в 3 квартале, избежав рецессии, которая поразила экономику Германии.', '', '2008-11-17 09:07:10', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (486, 10, 'Россия не может определиться с размером кредита для Исландии', 'http%3A%2F%2Fnews.yandex.ru%2Fyandsearch%3Fcl4url%3Dwww.mk.ru%2Fblogs%2FMK%2F2008%2F11%2F17%2Fsrochno%2F381475%2F%26amp%3Bcountry%3DRussia%26amp%3Bcat%3D6', 'Напомним, что оказавшаяся из-за кризиса на грани банкротства Исландия, получив отказ западных партнеров, обратилась за помощью к России, чем вызвала глубокое возмущение со стороны...', 'Напомним, что оказавшаяся из-за кризиса на грани банкротства Исландия, получив отказ западных партнеров, обратилась за помощью к России, чем вызвала глубокое возмущение со стороны Великобритании.', '', '2008-11-17 15:08:34', '', '', 0, 1, 0);
INSERT INTO `news` VALUES (484, 10, 'На Ставрополье ослаблен карантин по чуме свиней', 'http%3A%2F%2Fnews.yandex.ru%2Fyandsearch%3Fcl4url%3Dkp.ru%2Fonline%2Fnews%2F165790%2F%26amp%3Bcountry%3DRussia%26amp%3Bcat%3D6', 'В Краснодарском крае ожидается рост цен на свинину из-за уменьшения поголовья свиней, связанного со вспышкой африканской чумы в Новокубанском...', 'В Краснодарском крае ожидается рост цен на свинину из-за уменьшения поголовья свиней, связанного со вспышкой африканской чумы в Новокубанском районе.', '', '2008-11-17 14:47:00', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (485, 10, 'Цены на бензин в России снизились на 1,8%', 'http%3A%2F%2Fnews.yandex.ru%2Fyandsearch%3Fcl4url%3Dkp.ru%2Fonline%2Fnews%2F165749%2F%26amp%3Bcountry%3DRussia%26amp%3Bcat%3D6', 'Удешевление бензина было зафиксировано в 65 центрах субъектов РФ, в том числе в Ханты-Мансийске - на 9%, где цены на бензин марки АИ-92 снизились на 12,8%. В 18 центрах субъектов РФ цены на бензин остались на уровне предыдущей...', 'Удешевление бензина было зафиксировано в 65 центрах субъектов РФ, в том числе в Ханты-Мансийске - на 9%, где цены на бензин марки АИ-92 снизились на 12,8%. В 18 центрах субъектов РФ цены на бензин остались на уровне предыдущей недели.', '', '2008-11-17 14:14:00', '', '', 0, 1, 0);
INSERT INTO `news` VALUES (483, 10, 'Россия даст МВФ миллиард долларов на борьбу с кризисом', 'http%3A%2F%2Fnews.yandex.ru%2Fyandsearch%3Fcl4url%3Dwww.prime-tass.ru%2Fnews%2Fshow.asp%253Fid%253D837928%2526ct%253Dnews%26amp%3Bcountry%3DRussia%26amp%3Bcat%3D6', 'Глава Международного валютного фонда Доминик Штросс-Кан заявил, что потребуется большее количество финансирования для помощи восстановлению мировой...', 'Глава Международного валютного фонда Доминик Штросс-Кан заявил, что потребуется большее количество финансирования для помощи восстановлению мировой экономики.', '', '2008-11-17 06:46:58', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (481, 10, '"Двадцатка" согласовала принципы реформирования финансовых рынков', 'http%3A%2F%2Fnews.yandex.ru%2Fyandsearch%3Fcl4url%3Decho.msk.ru%2Fnews%2F553568-echo.html%26amp%3Bcountry%3DRussia%26amp%3Bcat%3D6', 'По мнению соруководителя аналитического департамента Deutsche Bank в России  Ярослава Лисоволика, в течение ближайших полугода-года основные меры будут предприниматься в рамках старых институтов, структур и инструментов, таких как МВФ и Всемирный...', 'По мнению соруководителя аналитического департамента Deutsche Bank в России  Ярослава Лисоволика, в течение ближайших полугода-года основные меры будут предприниматься в рамках старых институтов, структур и инструментов, таких как МВФ и Всемирный банк.', '', '2008-11-15 22:44:00', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (482, 10, 'Российские банки ужесточили требования для потенциальных заемщиков', 'http%3A%2F%2Fnews.yandex.ru%2Fyandsearch%3Fcl4url%3Dwww.utro.ru%2Fnews%2F2008%2F11%2F17%2F781528.shtml%26amp%3Bcountry%3DRussia%26amp%3Bcat%3D6', 'По мнению аналитика инвестиционного департамента ВТБ 24  Станислава Клещева, ввод ограничения на выдачу кредитов людям определенных профессий приведет возникновению социальной напряженности в регионах, где эти отрасли являются...', 'По мнению аналитика инвестиционного департамента ВТБ 24  Станислава Клещева, ввод ограничения на выдачу кредитов людям определенных профессий приведет возникновению социальной напряженности в регионах, где эти отрасли являются градообразующими.', '', '2008-11-17 07:42:02', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (479, 7, 'SMS №11 (ноябрь 2008)', 'http%3A%2F%2Fsoft-best.ws%2F1158480758-sms-11-nojabr-2008.html', 'Журнал “SMS” – ваш путеводитель в мобильном...', '<div align="center"><!--TBegin--><a href="http://soft-best.ws/uploads/posts/2008-11/1226883627_sms.jpg" onClick="return hs.expand(this)" ><img src="http://soft-best.ws/uploads/posts/2008-11/thumbs/1226883627_sms.jpg" style="border: none;" alt=''SMS №11 (ноябрь 2008)'' title=''SMS №11 (ноябрь 2008)''  /></a><!--TEnd--></div><br /><br /><!--colorstart:#000000--><span style="color:#000000"><!--/colorstart--><div align="center">Журнал “<b>SMS</b>” – ваш путеводитель в мобильном мире.</div><!--colorend--></span><!--/colorend-->', 'Книги', '2008-11-17 03:00:41', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (480, 7, 'Легейда В. - Самоучитель Photoshop CS2.', 'http%3A%2F%2Fsoft-best.ws%2F1158480757-legejjda-v.-samouchitel-photoshop-cs2..html', 'Цель книги - представить хорошо организованное учебное пособие по всем инструментам и операциям лучшего по...', '<div align="center"><!--TBegin--><a href="http://soft-best.ws/uploads/posts/2008-11/1226881754_photoshop_cs2.nastoyaschiy_samouchitel.jpg" onClick="return hs.expand(this)" ><img src="http://soft-best.ws/uploads/posts/2008-11/thumbs/1226881754_photoshop_cs2.nastoyaschiy_samouchitel.jpg" style="border: none;" alt=''Легейда В. - Самоучитель Photoshop CS2.'' title=''Легейда В. - Самоучитель Photoshop CS2.''  /></a><!--TEnd--></div><br /><!--colorstart:#336666--><span style="color:#336666"><!--/colorstart-->Цель книги - представить хорошо организованное учебное пособие по всем инструментам и операциям лучшего по состоянию на 2005 год редактора растровой графики - программы Photoshop версии CS2.<br />Книга содержит описание фундаментальных понятий, необходимых для работы с цифровыми изображениями. Каждая глава содержит информацию, которая поможет овладеть определенными навыками работы в Photoshop. Книга обеспечивает необходимые описания и объяснения, дает наглядные примеры использования различных техник, делает все аспекты программы более доступными и понятными. В книгу включено большое количество примеров обработки изображений, помогающих легко и быстро освоить приемы и методы работы с программой. Файлы необходимых примеров можно загрузить с web-сайта издательства.<!--colorend--></span><!--/colorend-->', 'Книги', '2008-11-17 02:37:41', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (477, 7, 'Приусадебное хозяйство №11 (ноябрь) 2008', 'http%3A%2F%2Fsoft-best.ws%2F1158480762-priusadebnoe-khozjajjstvo-11-nojabr-2008.html', '"Приусадебное хозяйство" - уникальная энциклопедия знаний для всех, кто имеет землю - будь то шесть дачных соток,...', '<div align="center"><!--TBegin--><a href="http://soft-best.ws/uploads/posts/2008-11/1226889112_priusadebnoe_hozyaystvo_11_2008.jpg" onClick="return hs.expand(this)" ><img src="http://soft-best.ws/uploads/posts/2008-11/thumbs/1226889112_priusadebnoe_hozyaystvo_11_2008.jpg" style="border: none;" alt=''Приусадебное хозяйство №11 (ноябрь) 2008'' title=''Приусадебное хозяйство №11 (ноябрь) 2008''  /></a><!--TEnd--></div><br /><!--colorstart:#000066--><span style="color:#000066"><!--/colorstart-->"<b>Приусадебное хозяйство</b>" - уникальная энциклопедия знаний для всех, кто имеет землю - будь то шесть дачных соток, крестьянская усадьба или фермерское хозяйство.<br />Журнал освещает богатейший практический опыт садоводов, огородников, владельцев домашней живности. Его отличительные черты - достоверность информации и поиск нового.<!--colorend--></span><!--/colorend-->', 'Книги', '2008-11-17 04:32:30', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (478, 7, 'Мой уютный дом №11 (ноябрь) 2008', 'http%3A%2F%2Fsoft-best.ws%2F1158480761-mojj-ujutnyjj-dom-11-nojabr-2008.html', '"Мой уютный дом" - журнал для тех, кто высоко ценит домашний уют, хочет сделать свой...', '<div align="center"><!--TBegin--><a href="http://soft-best.ws/uploads/posts/2008-11/1226885997_moy_uyutniy_dom_11_2008.jpg" onClick="return hs.expand(this)" ><img src="http://soft-best.ws/uploads/posts/2008-11/thumbs/1226885997_moy_uyutniy_dom_11_2008.jpg" style="border: none;" alt=''Мой уютный дом №11 (ноябрь) 2008'' title=''Мой уютный дом №11 (ноябрь) 2008''  /></a><!--TEnd--></div><br /><!--colorstart:#333333--><span style="color:#333333"><!--/colorstart-->"<b>Мой уютный дом</b>" - журнал для тех, кто высоко ценит домашний уют, хочет сделать свой дом удобным и красивым, находится в постоянном поиске свежих идей и решений. Журнал предоставляет читателям разнообразную и полезную информацию по оборудованию дома и квартиры, практические советы по оформлению, обзор современных направлений в дизайне интерьера. Раздел, посвященный кулинарии, в каждом номере предлагает рецепты вкусных блюд и рекомендации по сервировке красивого стола.<!--colorend--></span><!--/colorend-->', 'Книги', '2008-11-17 03:40:32', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (476, 7, 'Дом в саду №12 (декабрь) 2008', 'http%3A%2F%2Fsoft-best.ws%2F1158480767-dom-v-sadu-12-dekabr-2008.html', 'Часто возникают вопросы: что посадить, чем накрыть крышу, как провести воду? И у кого же...', '<div align="center"><!--TBegin--><a href="http://soft-best.ws/uploads/posts/2008-11/1226894413_dom_v_sadu_12-2008.jpg" onClick="return hs.expand(this)" ><img src="http://soft-best.ws/uploads/posts/2008-11/thumbs/1226894413_dom_v_sadu_12-2008.jpg" style="border: none;" alt=''Дом в саду №12 (декабрь) 2008'' title=''Дом в саду №12 (декабрь) 2008''  /></a><!--TEnd--></div><br /><!--colorstart:#990000--><span style="color:#990000"><!--/colorstart-->Часто возникают вопросы: что посадить, чем накрыть крышу, как провести воду? И у кого же спросить, как не у соседа, такого же садовода?<br />Поэтому главное в нашем журнале - письма читателей, в которых можно найти ответы на многие вопросы. В письмах Вы рассказываете как украсить сад летниками, удобрить почву, правильно обрезать кустарники. Есть и ценные советы по строительству.<br />Наши читатели - очень талантливый и умелый народ. Обмениваясь опытом, мы решим все проблемы, сделаем жизнь интереснее!"<!--colorend--></span><!--/colorend-->', 'Книги', '2008-11-17 06:00:47', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (475, 7, 'Сборник произведений Кирилла Еськова', 'http%3A%2F%2Fsoft-best.ws%2F1158480784-sbornik-proizvedenijj-kirilla-eskova.html', 'Кирилл Еськов – блестящий прозаик, публицист и сатирик. В сборник вошли его самые интересные и скандальные произведения «Евангелие от...', '<div align="center"><!--TBegin--><a href="http://soft-best.ws/uploads/posts/2008-11/1226910009_esk.jpg" onClick="return hs.expand(this)" ><img src="http://soft-best.ws/uploads/posts/2008-11/thumbs/1226910009_esk.jpg" style="border: none;" alt=''Сборник произведений Кирилла Еськова'' title=''Сборник произведений Кирилла Еськова''  /></a><!--TEnd--></div><br /><!--colorstart:#000000--><span style="color:#000000"><!--/colorstart-->Кирилл Еськов – блестящий прозаик, публицист и сатирик. В сборник вошли его самые интересные и скандальные произведения «Евангелие от Афрания» и «Последний кольценосец», а также приключенческие детективные повести и публицистические заметки «на полях». <br />В повести «Евангелие от Афрания» автор популярно, в виде художественного романа излагает свою гипотезу о возникновении христианства и жизни Иисуса. А роман «Последний кольценосец» - это попытка достаточно серьезного художественного взгляда на мир Средиземья Толкиена с другой стороны, со стороны Мордора. Читать необычно и достаточно увлекательно, написано в духе качественного фентези.<br />Читаем ироничного, иногда сатиричного до упора, но всегда интересного автора!<!--colorend--></span><!--/colorend-->', 'Книги', '2008-11-17 10:22:16', '', '', 0, 0, 0);
INSERT INTO `news` VALUES (474, 7, 'Модели с дистанционным управлением', 'http%3A%2F%2Fsoft-best.ws%2F1158480790-modeli-s-distancionnym-upravleniem.html', 'Модели с дистанционным управлением – книга для любителей запускать модели судов, катеров, парусных и моторных яхт. Книга позволит в...', '<div align="center"><!--TBegin--><a href="http://soft-best.ws/uploads/posts/2008-11/1226911729_modeli.jpg" onClick="return hs.expand(this)" ><img src="http://soft-best.ws/uploads/posts/2008-11/thumbs/1226911729_modeli.jpg" style="border: none;" alt=''Модели с дистанционным управлением'' title=''Модели с дистанционным управлением''  /></a><!--TEnd--></div><br /><!--colorstart:#000000--><span style="color:#000000"><!--/colorstart--><b>Модели с дистанционным управлением</b> – книга для любителей запускать модели судов, катеров, парусных и моторных яхт. Книга позволит в домашних условиях собрать, при минимуме необходимых радиотехнических знаний, вполне рабочую радиоуправляемую модель. Содержит много полезных советов и рекомендаций по конструированию аппаратуры телеуправления, по организации рабочего места, развитию навыков работы с измерительной и настроечной аппаратурой. Книга сугубо практическая, присутствуют схемы сборки, рекомендации, описания процесса и аппаратуры. Предназначена для моделистов-любителей.<!--colorend--></span><!--/colorend-->', 'Книги', '2008-11-17 10:51:15', '', '', 0, 1, 0);
INSERT INTO `news` VALUES (472, 7, 'National Geographic Traveler №11 (ноябрь) 2008', 'http%3A%2F%2Fsoft-best.ws%2F1158480809-national-geographic-traveler-11-nojabr-2008.html', 'National Geographic Traveler - самый читаемый в мире журнал о путешествиях. Красочные фотографии, интересные рассказы...', '<div align="center"><!--TBegin--><a href="http://soft-best.ws/uploads/posts/2008-11/1226926824_ng_traveler_11_2008.jpg" onClick="return hs.expand(this)" ><img src="http://soft-best.ws/uploads/posts/2008-11/thumbs/1226926824_ng_traveler_11_2008.jpg" style="border: none;" alt=''National Geographic Traveler №11 (ноябрь) 2008'' title=''National Geographic Traveler №11 (ноябрь) 2008''  /></a><!--TEnd--></div><br /><!--colorstart:#CC6600--><span style="color:#CC6600"><!--/colorstart--><b>National Geographic Traveler</b> - самый читаемый в мире журнал о путешествиях. Красочные фотографии, интересные рассказы о разных странах, подробные путеводители.<!--colorend--></span><!--/colorend-->', 'Книги', '2008-11-17 15:00:28', '', '', 0, 3, 1);
INSERT INTO `news` VALUES (473, 7, '1000 секретов Windows', 'http%3A%2F%2Fsoft-best.ws%2F1158480694-1000-sekretov-windows.html', 'В данном архиве материалы которые помогут новичку (да и нетолько) раобраться в ОС Windows. Как оптимизировать систему, разобраться с настройкой реестра,...', '<div align="center"><!--TBegin--><a href="http://soft-best.ws/uploads/posts/2008-11/1226845258_3ca0b68525ee.jpg" onClick="return hs.expand(this)" ><img src="http://soft-best.ws/uploads/posts/2008-11/thumbs/1226845258_3ca0b68525ee.jpg" style="border: none;" alt=''1000 секретов Windows'' title=''1000 секретов Windows''  /></a><!--TEnd--></div><br /><!--colorstart:#000000--><span style="color:#000000"><!--/colorstart-->В данном архиве материалы которые помогут новичку (да и нетолько) раобраться в ОС Windows. Как оптимизировать систему, разобраться с настройкой реестра, NTFS и FAT, администрирование дисков, установка и восстановление Windows с нуля, и многое другое. Метериалы представленны в текстовом виде: Документ Microsoft Office Word 97 - 2003<!--colorend--></span><!--/colorend-->', 'Книги', '2008-11-17 12:59:32', '', '', 0, 0, 1);

-- --------------------------------------------------------

-- 
-- Структура таблицы `news_banners`
-- 

DROP TABLE IF EXISTS `news_banners`;
CREATE TABLE IF NOT EXISTS `news_banners` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `code` text,
  `state` tinyint(4) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

-- 
-- Дамп данных таблицы `news_banners`
-- 

INSERT INTO `news_banners` VALUES (2, 2, '<script>\r\nalert("Counter-Strike Mania");\r\n</script>', 1);
INSERT INTO `news_banners` VALUES (3, 2, 'code-mode', 0);
INSERT INTO `news_banners` VALUES (8, 1, '', 0);
INSERT INTO `news_banners` VALUES (9, 1, 'banner ', 0);
INSERT INTO `news_banners` VALUES (10, 1, 'banner yandex test', 0);
INSERT INTO `news_banners` VALUES (11, 2, 'banner', 0);
INSERT INTO `news_banners` VALUES (13, 1, 'bannertty', 1);
INSERT INTO `news_banners` VALUES (15, 1, '<script>\r\nalert("dfdf");\r\n</script>', 1);
INSERT INTO `news_banners` VALUES (19, 3, '3333cvv', 1);
INSERT INTO `news_banners` VALUES (22, 3, 'setestdxg', 1);
INSERT INTO `news_banners` VALUES (24, 1, '', 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `news_comments`
-- 

DROP TABLE IF EXISTS `news_comments`;
CREATE TABLE IF NOT EXISTS `news_comments` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `avatar_id` bigint(20) default NULL,
  `warning_id` bigint(20) default NULL,
  `news_id` bigint(20) default NULL,
  `text` text,
  `mood` varchar(100) default NULL,
  `creation_date` int(11) default NULL,
  `adm_redacted` tinyint(4) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `news_comments`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `news_subscribe`
-- 

DROP TABLE IF EXISTS `news_subscribe`;
CREATE TABLE IF NOT EXISTS `news_subscribe` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `news_tree_feeds_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- Дамп данных таблицы `news_subscribe`
-- 

INSERT INTO `news_subscribe` VALUES (6, 1, 11);
INSERT INTO `news_subscribe` VALUES (5, 1, 7);

-- --------------------------------------------------------

-- 
-- Структура таблицы `news_tree`
-- 

DROP TABLE IF EXISTS `news_tree`;
CREATE TABLE IF NOT EXISTS `news_tree` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` bigint(20) default NULL,
  `user_id` bigint(20) default NULL,
  `name` varchar(100) default NULL,
  `state` tinyint(4) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- 
-- Дамп данных таблицы `news_tree`
-- 

INSERT INTO `news_tree` VALUES (1, 0, 1, 'Авто', 1);
INSERT INTO `news_tree` VALUES (2, 0, 1, 'Недвижимость', 1);
INSERT INTO `news_tree` VALUES (3, 1, 1, 'Отечественные', 1);
INSERT INTO `news_tree` VALUES (4, 1, 1, 'Иномарки', 1);
INSERT INTO `news_tree` VALUES (5, 2, 1, 'Продажа', 1);
INSERT INTO `news_tree` VALUES (6, 2, 1, 'Покупка', 1);
INSERT INTO `news_tree` VALUES (7, 6, 1, 'sub1', 1);
INSERT INTO `news_tree` VALUES (8, 6, 1, 'sub3', 1);
INSERT INTO `news_tree` VALUES (9, 6, 1, 'sub4', 1);
INSERT INTO `news_tree` VALUES (12, 5, 3, 'ttetst', 0);
INSERT INTO `news_tree` VALUES (19, 12, 1, '343', 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `news_tree_feeds`
-- 

DROP TABLE IF EXISTS `news_tree_feeds`;
CREATE TABLE IF NOT EXISTS `news_tree_feeds` (
  `id` bigint(20) NOT NULL auto_increment,
  `news_tree_id` int(11) default NULL,
  `feed_id` bigint(20) default NULL,
  `news_banner_id` bigint(20) default NULL,
  `category_tag` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

-- 
-- Дамп данных таблицы `news_tree_feeds`
-- 

INSERT INTO `news_tree_feeds` VALUES (1, 3, 1, NULL, NULL);
INSERT INTO `news_tree_feeds` VALUES (9, 8, 8, 9, '');
INSERT INTO `news_tree_feeds` VALUES (4, 7, 2, 8, '');
INSERT INTO `news_tree_feeds` VALUES (5, 3, 4, 0, '');
INSERT INTO `news_tree_feeds` VALUES (6, 4, 5, 2, 'Google Earth / Maps');
INSERT INTO `news_tree_feeds` VALUES (7, 4, 6, 3, 'Книги');
INSERT INTO `news_tree_feeds` VALUES (24, 19, 23, 24, '');
INSERT INTO `news_tree_feeds` VALUES (10, 3, 9, 10, '');
INSERT INTO `news_tree_feeds` VALUES (11, 8, 10, 11, '');
INSERT INTO `news_tree_feeds` VALUES (13, 4, 12, 13, '');
INSERT INTO `news_tree_feeds` VALUES (15, 3, 14, 15, '');
INSERT INTO `news_tree_feeds` VALUES (19, 7, 18, 19, '');
INSERT INTO `news_tree_feeds` VALUES (22, 7, 21, 22, 'xfgdfgdfghdrf');

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
  PRIMARY KEY  (`id`),
  KEY `pg` (`param_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

-- 
-- Дамп данных таблицы `param`
-- 

INSERT INTO `param` VALUES (1, 1, 'param_x', '3341', 'integer');
INSERT INTO `param` VALUES (4, 2, 'param1', '333str', 'string');
INSERT INTO `param` VALUES (28, 1, 'param_y', '34.23', 'float');
INSERT INTO `param` VALUES (29, 0, 'asdsad', '23', 'string');
INSERT INTO `param` VALUES (31, 9, 'param_x', '10', 'integer');
INSERT INTO `param` VALUES (34, 8, 'album_per_page', '8', 'integer');
INSERT INTO `param` VALUES (35, 8, 'top_per_page', '12', 'integer');
INSERT INTO `param` VALUES (36, 4, 'comment_per_page', '2', 'integer');
INSERT INTO `param` VALUES (37, 8, 'thumb_size', '100', 'integer');
INSERT INTO `param` VALUES (38, 4, 'asdas', '12', 'integer');
INSERT INTO `param` VALUES (39, 13, 'bookmarks_per_page', '5', 'integer');
INSERT INTO `param` VALUES (40, 14, 'social_pos_per_page', '3', 'integer');
INSERT INTO `param` VALUES (41, 15, 'search_user_per_page', '3', 'integer');
INSERT INTO `param` VALUES (42, 16, 'SEC_TO_DELETE_NEWS_FROM_FEEDS', '259200', 'integer');
INSERT INTO `param` VALUES (43, 16, 'NEWS_PER_PAGE', '15', 'integer');
INSERT INTO `param` VALUES (44, 17, 'THEMES_PER_PAGE', '5', 'integer');
INSERT INTO `param` VALUES (45, 17, 'PAUSE_DURATION_SEC', '120', 'integer');
INSERT INTO `param` VALUES (46, 17, 'HISTORY_PER_PAGE', '10', 'integer');
INSERT INTO `param` VALUES (51, 18, 'NUM_MESSAGES_ON_PAGE', '2', 'integer');
INSERT INTO `param` VALUES (52, 11, 'N_WARNINGS_TO_BAN', '3', 'integer');
INSERT INTO `param` VALUES (53, 11, 'T_BAN_TIME_SEC', '120', 'integer');
INSERT INTO `param` VALUES (54, 10, 'test', 'eee', 'string');
INSERT INTO `param` VALUES (55, 8, 'photo_per_page', '8', 'integer');
INSERT INTO `param` VALUES (56, 8, 'max_image_size', '100000', 'integer');
INSERT INTO `param` VALUES (57, 8, 'max_userdir_size', '300000', 'integer');

-- --------------------------------------------------------

-- 
-- Структура таблицы `param_group`
-- 

DROP TABLE IF EXISTS `param_group`;
CREATE TABLE IF NOT EXISTS `param_group` (
  `id` int(11) NOT NULL auto_increment,
  `label` varchar(80) character set cp1251 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

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
INSERT INTO `param_group` VALUES (12, 'ArticleController');
INSERT INTO `param_group` VALUES (13, 'BookmarksController');
INSERT INTO `param_group` VALUES (14, 'SocialController');
INSERT INTO `param_group` VALUES (15, 'SearchUserController');
INSERT INTO `param_group` VALUES (16, 'NewsController');
INSERT INTO `param_group` VALUES (17, 'DebateController');
INSERT INTO `param_group` VALUES (18, 'MessagesController');
INSERT INTO `param_group` VALUES (19, 'GTDController');
INSERT INTO `param_group` VALUES (20, 'DevController');

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
  KEY `album_id` (`album_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

-- 
-- Дамп данных таблицы `photo`
-- 

INSERT INTO `photo` VALUES (1, 1, 1, 'осень22', 'asd', 'as', 1, 1, 1, 1, 2, '2008-01-21 14:20:12');
INSERT INTO `photo` VALUES (3, 2, 3, 'моя фотка', 'wewer', 'er43', 1, 1, 2, 0, 0, '2008-01-21 14:21:12');
INSERT INTO `photo` VALUES (7, 1, 1, 'asasd3', '387cd1fec97b13b1beaa786f33fe2dd5.jpg', '', 0, 1, 1, 0, 0, '2008-01-22 20:26:06');
INSERT INTO `photo` VALUES (10, 1, 1, '', '72ae57b683699af82beb8ac09b5dfd9f.jpg', '', 1, 1, 2, 0, 0, '2008-01-22 20:32:40');
INSERT INTO `photo` VALUES (13, 2, 3, 'a', 'adf', 'dasf', 1, 1, 2, 0, 0, '2008-01-02 00:00:00');
INSERT INTO `photo` VALUES (15, 1, 7, 'М2', 'dca3c730965beac6703ac73758a0259d.jpg', '', 0, 1, 1, 0, 0, '2008-01-23 03:29:53');
INSERT INTO `photo` VALUES (27, 1, 12, '123213', '32b84508dfc483b0291d93a1617e058f.jpg', '32b84508dfc483b0291d93a1617e058f.jpg', 1, 1, 0, 0, 0, '2008-02-27 14:44:51');
INSERT INTO `photo` VALUES (30, 1, 7, 'asdsad', '79ad598f14ea78875e81ecc108fe8e95.jpg', '79ad598f14ea78875e81ecc108fe8e95.jpg', 0, 1, 2, 1, 10, '2008-02-27 15:12:25');
INSERT INTO `photo` VALUES (31, 1, 13, '21323', '3c6578a13196aca783ed648e5f1d366f.jpg', '3c6578a13196aca783ed648e5f1d366f.jpg', 1, 0, 2, 1, 10, '2008-03-03 10:47:42');
INSERT INTO `photo` VALUES (32, 1, 12, '', '31dfe9ad7500c543d9f5e8b737306748.jpg', '31dfe9ad7500c543d9f5e8b737306748.jpg', 0, 0, 0, 0, 0, '2008-03-03 12:14:44');
INSERT INTO `photo` VALUES (33, 1, 12, '', '1686ae3cb4fda1dfa728cabe3a1b5a71.jpg', '1686ae3cb4fda1dfa728cabe3a1b5a71.jpg', 0, 0, 0, 0, 0, '2008-03-03 12:14:45');
INSERT INTO `photo` VALUES (34, 1, 12, '', 'aeed94eb36efb6976f3ace038a7bbc81.jpg', 'aeed94eb36efb6976f3ace038a7bbc81.jpg', 0, 0, 0, 0, 0, '2008-03-03 12:15:02');
INSERT INTO `photo` VALUES (35, 1, 12, '', '25c10e75b330ca227a31cb50da1378cb.jpg', '25c10e75b330ca227a31cb50da1378cb.jpg', 0, 0, 0, 0, 0, '2008-03-03 12:15:02');
INSERT INTO `photo` VALUES (36, 1, 5, '', 'cc7e953802e40bdc35d1f79f3da16a74.jpg', 'cc7e953802e40bdc35d1f79f3da16a74.jpg', 0, 0, 0, 0, 0, '2008-03-03 12:16:49');
INSERT INTO `photo` VALUES (37, 1, 11, '', '7b193191a37f78e38ff6a6e951896b8f.jpg', '7b193191a37f78e38ff6a6e951896b8f.jpg', 0, 0, 2, 0, 0, '2008-03-03 12:17:14');
INSERT INTO `photo` VALUES (38, 1, 11, '', '633fbfe47db5e49d1ae2edd5c89fb257.jpg', '633fbfe47db5e49d1ae2edd5c89fb257.jpg', 0, 0, 2, 0, 0, '2008-03-03 12:17:14');
INSERT INTO `photo` VALUES (39, 1, 11, '', 'a86c0c872bcdaf9c759368283b51ed75.jpg', 'a86c0c872bcdaf9c759368283b51ed75.jpg', 0, 0, 1, 0, 0, '2008-03-03 12:18:50');
INSERT INTO `photo` VALUES (40, 1, 11, '', '2f88ed02638fee1cfba57b28d540b83c.jpg', '2f88ed02638fee1cfba57b28d540b83c.jpg', 0, 0, 1, 0, 0, '2008-03-03 12:18:50');
INSERT INTO `photo` VALUES (41, 1, 11, '', '99f51181e5a8e4b6eaf742554c215c07.jpg', '99f51181e5a8e4b6eaf742554c215c07.jpg', 0, 0, 1, 0, 0, '2008-03-03 12:18:50');
INSERT INTO `photo` VALUES (42, 1, 10, '34', 'a97a55445fa1315f62253e6b142632de.jpg', 'a97a55445fa1315f62253e6b142632de.jpg', 0, 1, 2, 0, 0, '2008-03-03 12:19:25');
INSERT INTO `photo` VALUES (43, 1, 10, '456', '21d1398d9782c4877b80bf775d86005a.jpg', '21d1398d9782c4877b80bf775d86005a.jpg', 0, 0, 1, 0, 0, '2008-03-03 12:19:25');
INSERT INTO `photo` VALUES (45, 1, 5, '23', 'a80bcc8ff450150b5b96ac0906997cb2.jpg', 'a80bcc8ff450150b5b96ac0906997cb2.jpg', 1, 1, 0, 0, 0, '2008-03-05 14:11:02');
INSERT INTO `photo` VALUES (46, 1, 13, 'Brave hart', 'fb3113bb787a799a94481239ae297031.jpg', 'fb3113bb787a799a94481239ae297031.jpg', 1, 1, 2, 1, 9, '2008-03-05 22:42:24');
INSERT INTO `photo` VALUES (47, 1, 5, '', '6af30bf1188824865d31d35cd40f5990.jpg', '6af30bf1188824865d31d35cd40f5990.jpg', 0, 0, 0, 0, 0, '2008-03-05 22:43:22');
INSERT INTO `photo` VALUES (48, 1, 5, 'asdsad', '441b12f9893f1ae99de9263ce1889391.jpg', '441b12f9893f1ae99de9263ce1889391.jpg', 1, 1, 0, 1, 10, '2008-03-05 22:43:34');
INSERT INTO `photo` VALUES (49, 1, 15, '123', '9e3393836c4a6e16be9e385f9aa682c8.jpg', '9e3393836c4a6e16be9e385f9aa682c8.jpg', 0, 1, 0, 0, 0, '2008-03-06 12:17:27');
INSERT INTO `photo` VALUES (50, 1, 15, '456', 'a5ddfe33fceba71b915a37e92c22bd32.jpg', 'a5ddfe33fceba71b915a37e92c22bd32.jpg', 1, 0, 0, 0, 0, '2008-03-06 12:17:27');
INSERT INTO `photo` VALUES (64, 1, 16, '', 'e204ef8f55dbb3103a5fd9ab6a662596.jpg', 'e204ef8f55dbb3103a5fd9ab6a662596.jpg', 0, 0, 2, 0, 0, '2008-12-15 17:19:33');
INSERT INTO `photo` VALUES (63, 1, 16, '', 'ea5aef8a85196f405e9739f42553dfa1.jpg', 'ea5aef8a85196f405e9739f42553dfa1.jpg', 0, 0, 2, 0, 0, '2008-12-15 17:19:33');
INSERT INTO `photo` VALUES (59, 1, 7, 'ДЛШО', 'd61c1f000971726777b5f34f6d72077c.jpg', 'd61c1f000971726777b5f34f6d72077c.jpg', 0, 0, 0, 0, 0, '2008-12-15 16:57:49');

-- --------------------------------------------------------

-- 
-- Структура таблицы `photo_comment`
-- 

DROP TABLE IF EXISTS `photo_comment`;
CREATE TABLE IF NOT EXISTS `photo_comment` (
  `id` bigint(20) NOT NULL auto_increment,
  `photo_id` int(11) default NULL,
  `user_id` int(11) NOT NULL,
  `avatar_id` int(11) NOT NULL,
  `warning_id` int(11) NOT NULL,
  `mood` int(11) NOT NULL,
  `mood_text` varchar(100) default NULL,
  `adm_redacted` int(11) NOT NULL,
  `text` text,
  `creation_date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=7 ;

-- 
-- Дамп данных таблицы `photo_comment`
-- 

INSERT INTO `photo_comment` VALUES (1, 46, 1, 34, 14, 1, '', 1, 'test\r\nadmin', '2008-12-02 16:46:12');
INSERT INTO `photo_comment` VALUES (3, 46, 1, 40, 0, 0, 'dfgdf', 0, '[quote name="admin"]test\r\nadmin[/quote]\r\n34445', '2008-12-02 16:51:18');
INSERT INTO `photo_comment` VALUES (4, 46, 1, 40, 0, 0, '', 0, 'vgjghj', '2008-12-02 16:51:29');
INSERT INTO `photo_comment` VALUES (6, 49, 1, 48, 0, 1, '', 0, 'test', '2008-12-04 14:41:16');

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
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

-- 
-- Дамп данных таблицы `photo_vote`
-- 

INSERT INTO `photo_vote` VALUES (15, 20, 1, '127.0.0.1');
INSERT INTO `photo_vote` VALUES (16, 26, 1, '127.0.0.1');
INSERT INTO `photo_vote` VALUES (17, 23, 1, '127.0.0.1');
INSERT INTO `photo_vote` VALUES (19, 23, 2, '127.0.0.1');
INSERT INTO `photo_vote` VALUES (20, 20, 2, '127.0.0.1');
INSERT INTO `photo_vote` VALUES (21, 17, 1, '127.0.0.1');
INSERT INTO `photo_vote` VALUES (22, 30, 1, '127.0.0.1');
INSERT INTO `photo_vote` VALUES (23, 46, 1, '127.0.0.1');
INSERT INTO `photo_vote` VALUES (24, 31, 1, '127.0.0.1');
INSERT INTO `photo_vote` VALUES (25, 48, 1, '195.39.211.224');

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
INSERT INTO `qq_tags` VALUES (62, 5, 0);
INSERT INTO `qq_tags` VALUES (63, 6, 0);
INSERT INTO `qq_tags` VALUES (64, 7, 0);
INSERT INTO `qq_tags` VALUES (65, 8, 0);
INSERT INTO `qq_tags` VALUES (65, 9, 0);
INSERT INTO `qq_tags` VALUES (65, 8, 0);
INSERT INTO `qq_tags` VALUES (65, 9, 0);
INSERT INTO `qq_tags` VALUES (65, 10, 0);
INSERT INTO `qq_tags` VALUES (66, 8, 0);
INSERT INTO `qq_tags` VALUES (67, 11, 0);
INSERT INTO `qq_tags` VALUES (68, 8, 0);
INSERT INTO `qq_tags` VALUES (69, 8, 0);
INSERT INTO `qq_tags` VALUES (69, 9, 0);
INSERT INTO `qq_tags` VALUES (69, 10, 0);
INSERT INTO `qq_tags` VALUES (70, 6, 0);
INSERT INTO `qq_tags` VALUES (71, 13, 0);
INSERT INTO `qq_tags` VALUES (71, 12, 0);
INSERT INTO `qq_tags` VALUES (71, 8, 0);
INSERT INTO `qq_tags` VALUES (72, 14, 0);
INSERT INTO `qq_tags` VALUES (72, 8, 0);
INSERT INTO `qq_tags` VALUES (72, 12, 0);
INSERT INTO `qq_tags` VALUES (72, 15, 0);
INSERT INTO `qq_tags` VALUES (73, 16, 0);
INSERT INTO `qq_tags` VALUES (73, 15, 0);
INSERT INTO `qq_tags` VALUES (73, 12, 0);
INSERT INTO `qq_tags` VALUES (73, 17, 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `question_tags`
-- 

DROP TABLE IF EXISTS `question_tags`;
CREATE TABLE IF NOT EXISTS `question_tags` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`),
  FULLTEXT KEY `name_2` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- 
-- Дамп данных таблицы `question_tags`
-- 

INSERT INTO `question_tags` VALUES (1, 'Tag');
INSERT INTO `question_tags` VALUES (2, 'Tag 1');
INSERT INTO `question_tags` VALUES (3, 'Tag 2');
INSERT INTO `question_tags` VALUES (4, '2332');
INSERT INTO `question_tags` VALUES (5, '1 2 3');
INSERT INTO `question_tags` VALUES (6, '');
INSERT INTO `question_tags` VALUES (7, 'милиция лампочка');
INSERT INTO `question_tags` VALUES (8, 'попугаи');
INSERT INTO `question_tags` VALUES (9, 'питон');
INSERT INTO `question_tags` VALUES (10, 'измерения');
INSERT INTO `question_tags` VALUES (11, 'лоло');
INSERT INTO `question_tags` VALUES (12, 'слон');
INSERT INTO `question_tags` VALUES (13, 'объем');
INSERT INTO `question_tags` VALUES (14, 'попугаи слон хобот');
INSERT INTO `question_tags` VALUES (15, 'хобот');
INSERT INTO `question_tags` VALUES (16, 'кошка');
INSERT INTO `question_tags` VALUES (17, 'попугай');

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
  `q_text` text NOT NULL,
  `creation_date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

-- 
-- Дамп данных таблицы `questions`
-- 

INSERT INTO `questions` VALUES (73, 0, 1, 2, 'Что будет если кошке на хвост посадить попугая у которого на хоботе сидит слон?', '2008-05-14 22:42:39');
INSERT INTO `questions` VALUES (71, 3, 1, 0, 'Сколько попугаев поместится в слоне?', '2008-04-22 18:52:43');
INSERT INTO `questions` VALUES (72, 3, 1, 2, 'Что будет, если попугаю на хобот посадить слона?', '2008-03-17 19:27:23');

-- --------------------------------------------------------

-- 
-- Структура таблицы `questions_cat`
-- 

DROP TABLE IF EXISTS `questions_cat`;
CREATE TABLE IF NOT EXISTS `questions_cat` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `sortfield` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- Дамп данных таблицы `questions_cat`
-- 

INSERT INTO `questions_cat` VALUES (3, 'Категория 1', 3);
INSERT INTO `questions_cat` VALUES (4, 'Категория 2', 5);
INSERT INTO `questions_cat` VALUES (6, 'Категория 3', 7);

-- --------------------------------------------------------

-- 
-- Структура таблицы `questions_comment`
-- 

DROP TABLE IF EXISTS `questions_comment`;
CREATE TABLE IF NOT EXISTS `questions_comment` (
  `id` bigint(20) NOT NULL auto_increment,
  `questions_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `avatar_id` int(11) NOT NULL,
  `warning_id` int(11) NOT NULL,
  `mood` int(11) NOT NULL,
  `mood_text` varchar(100) default NULL,
  `adm_redacted` int(11) NOT NULL,
  `text` text,
  `creation_date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=7 ;

-- 
-- Дамп данных таблицы `questions_comment`
-- 

INSERT INTO `questions_comment` VALUES (2, 73, 1, 34, 0, 0, 'вапвапвапва', 0, 'опаааа', '2008-12-02 16:32:18');
INSERT INTO `questions_comment` VALUES (3, 73, 1, 40, 13, 2, '', 1, '[quote name="admin"]опаааа[/quote]\r\nааааа556565656', '2008-12-02 16:35:20');
INSERT INTO `questions_comment` VALUES (4, 73, 1, 48, 0, 0, '', 0, 'oppa', '2008-12-10 13:09:43');
INSERT INTO `questions_comment` VALUES (5, 73, 2, 45, 36, 0, '3333', 1, '123', '2008-12-12 12:07:39');
INSERT INTO `questions_comment` VALUES (6, 73, 1, 48, 0, 0, 'ggg', 0, '[quote name="admin"]\r\n<BR>ааааа556565656[/quote]\r\ngfgh', '2009-02-16 22:27:28');

-- --------------------------------------------------------

-- 
-- Структура таблицы `regions`
-- 

DROP TABLE IF EXISTS `regions`;
CREATE TABLE IF NOT EXISTS `regions` (
  `id` int(12) unsigned NOT NULL,
  `country_id` int(12) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `cid` (`country_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Дамп данных таблицы `regions`
-- 

INSERT INTO `regions` VALUES (26942679, 4, 'Australian Capital Territory');
INSERT INTO `regions` VALUES (26942680, 4, 'New South Wales');
INSERT INTO `regions` VALUES (26942681, 4, 'Northern Territory');
INSERT INTO `regions` VALUES (26942682, 4, 'Queensland');
INSERT INTO `regions` VALUES (26942683, 4, 'South Australia');
INSERT INTO `regions` VALUES (26942684, 4, 'Tasmania');
INSERT INTO `regions` VALUES (26942685, 4, 'Victoria');
INSERT INTO `regions` VALUES (26942686, 4, 'Western Australia');
INSERT INTO `regions` VALUES (25663095, 63, 'Burgenland');
INSERT INTO `regions` VALUES (25663097, 63, 'K&#228;rnten');
INSERT INTO `regions` VALUES (25663098, 63, 'Nieder&#246;sterreich');
INSERT INTO `regions` VALUES (25663099, 63, 'Ober&#246;sterreich');
INSERT INTO `regions` VALUES (25663100, 63, 'Salzburg');
INSERT INTO `regions` VALUES (25663101, 63, 'Steiermark');
INSERT INTO `regions` VALUES (25663103, 63, 'Tirol');
INSERT INTO `regions` VALUES (25663105, 63, 'Vorarlberg');
INSERT INTO `regions` VALUES (25663106, 63, 'Wien');
INSERT INTO `regions` VALUES (82, 81, 'Азербайджан');
INSERT INTO `regions` VALUES (164, 81, 'Нагорный Карабах');
INSERT INTO `regions` VALUES (167, 81, 'Нахичеванская обл.');
INSERT INTO `regions` VALUES (25887438, 582079, 'Berat');
INSERT INTO `regions` VALUES (25887439, 582079, 'Diber');
INSERT INTO `regions` VALUES (25887440, 582079, 'Durres');
INSERT INTO `regions` VALUES (25887441, 582079, 'Elbasan');
INSERT INTO `regions` VALUES (25887442, 582079, 'Fier');
INSERT INTO `regions` VALUES (25887443, 582079, 'Gjirokaster');
INSERT INTO `regions` VALUES (25887444, 582079, 'Korce');
INSERT INTO `regions` VALUES (25887445, 582079, 'Kukes');
INSERT INTO `regions` VALUES (25887446, 582079, 'Lezhe');
INSERT INTO `regions` VALUES (25887447, 582079, 'Shkoder');
INSERT INTO `regions` VALUES (25887448, 582079, 'Tirane');
INSERT INTO `regions` VALUES (25887449, 582079, 'Vlore');
INSERT INTO `regions` VALUES (24350625, 582059, 'Алжир');
INSERT INTO `regions` VALUES (24349237, 582086, 'Ангола');
INSERT INTO `regions` VALUES (174, 173, 'Anguilla');
INSERT INTO `regions` VALUES (25902976, 23269623, 'Andorra la Vella');
INSERT INTO `regions` VALUES (25902971, 23269623, 'Canillo');
INSERT INTO `regions` VALUES (25902972, 23269623, 'Encamp');
INSERT INTO `regions` VALUES (25902977, 23269623, 'Escaldes-Engordany');
INSERT INTO `regions` VALUES (25902973, 23269623, 'La Massana');
INSERT INTO `regions` VALUES (25902974, 23269623, 'Ordino');
INSERT INTO `regions` VALUES (25902975, 23269623, 'Sant Julia de Loria');
INSERT INTO `regions` VALUES (24350737, 23269625, 'Антигуа и Барбуда');
INSERT INTO `regions` VALUES (26339018, 23269688, 'Виллемстад');
INSERT INTO `regions` VALUES (26551441, 177, 'Buenos Aires');
INSERT INTO `regions` VALUES (26551442, 177, 'Catamarca');
INSERT INTO `regions` VALUES (26551443, 177, 'Chaco');
INSERT INTO `regions` VALUES (26551444, 177, 'Chubut');
INSERT INTO `regions` VALUES (26551446, 177, 'Corrientes');
INSERT INTO `regions` VALUES (26551445, 177, 'C&#243;rdoba');
INSERT INTO `regions` VALUES (26551447, 177, 'Distrito Federal');
INSERT INTO `regions` VALUES (26551448, 177, 'Entre R&#237;os');
INSERT INTO `regions` VALUES (26551449, 177, 'Formosa');
INSERT INTO `regions` VALUES (26551450, 177, 'Jujuy');
INSERT INTO `regions` VALUES (26551451, 177, 'La Pampa');
INSERT INTO `regions` VALUES (26551452, 177, 'La Rioja');
INSERT INTO `regions` VALUES (26551453, 177, 'Mendoza');
INSERT INTO `regions` VALUES (26551454, 177, 'Misiones');
INSERT INTO `regions` VALUES (26551455, 177, 'Neuqu&#233;n');
INSERT INTO `regions` VALUES (26551456, 177, 'R&#237;o Negro');
INSERT INTO `regions` VALUES (26551457, 177, 'Salta');
INSERT INTO `regions` VALUES (26551458, 177, 'San Juan');
INSERT INTO `regions` VALUES (26551459, 177, 'San Luis');
INSERT INTO `regions` VALUES (26551460, 177, 'Santa Cruz');
INSERT INTO `regions` VALUES (26551461, 177, 'Santa Fe');
INSERT INTO `regions` VALUES (26551462, 177, 'Santiago del Estero');
INSERT INTO `regions` VALUES (26551463, 177, 'Tierra del Fuego');
INSERT INTO `regions` VALUES (26551464, 177, 'Tucum&#225;n');
INSERT INTO `regions` VALUES (25903222, 245, 'Aragatsotn');
INSERT INTO `regions` VALUES (25903223, 245, 'Ararat');
INSERT INTO `regions` VALUES (25903224, 245, 'Armavir');
INSERT INTO `regions` VALUES (25903227, 245, 'Lorri');
INSERT INTO `regions` VALUES (25903228, 245, 'Shirak');
INSERT INTO `regions` VALUES (25903230, 245, 'Tavush');
INSERT INTO `regions` VALUES (25903232, 245, 'Yerevan');
INSERT INTO `regions` VALUES (7716133, 7716093, 'Арулько');
INSERT INTO `regions` VALUES (24348905, 23269622, 'Афганистан');
INSERT INTO `regions` VALUES (11564803, 582029, 'Багамы');
INSERT INTO `regions` VALUES (24350872, 23269627, 'Бангладеш');
INSERT INTO `regions` VALUES (24351033, 582098, 'Барбадос');
INSERT INTO `regions` VALUES (24350832, 582097, 'Бахрейн');
INSERT INTO `regions` VALUES (249, 248, 'Брестская обл.');
INSERT INTO `regions` VALUES (272, 248, 'Витебская обл.');
INSERT INTO `regions` VALUES (304, 248, 'Гомельская обл.');
INSERT INTO `regions` VALUES (330, 248, 'Гродненская обл.');
INSERT INTO `regions` VALUES (349, 248, 'Минская обл.');
INSERT INTO `regions` VALUES (377, 248, 'Могилевская обл.');
INSERT INTO `regions` VALUES (402, 401, 'Belize');
INSERT INTO `regions` VALUES (25666401, 404, 'Antwerpen');
INSERT INTO `regions` VALUES (25666408, 404, 'Brabant Wallon');
INSERT INTO `regions` VALUES (25666396, 404, 'Bruxelles');
INSERT INTO `regions` VALUES (25666405, 404, 'Hainaut');
INSERT INTO `regions` VALUES (25666399, 404, 'Limburg');
INSERT INTO `regions` VALUES (25666402, 404, 'Li&#269;ge');
INSERT INTO `regions` VALUES (25666406, 404, 'Luxembourg');
INSERT INTO `regions` VALUES (25666409, 404, 'Nam');
INSERT INTO `regions` VALUES (25666404, 404, 'Namur');
INSERT INTO `regions` VALUES (25666398, 404, 'Oost-Vlaanderen');
INSERT INTO `regions` VALUES (25666400, 404, 'Vlaams Brabant');
INSERT INTO `regions` VALUES (25666397, 404, 'West-Vlaanderen');
INSERT INTO `regions` VALUES (24349206, 23269629, 'Бенин');
INSERT INTO `regions` VALUES (426, 425, 'Hamilton');
INSERT INTO `regions` VALUES (25922517, 428, 'Blagoevgrad');
INSERT INTO `regions` VALUES (25922518, 428, 'Burgas');
INSERT INTO `regions` VALUES (25922519, 428, 'Dobrich');
INSERT INTO `regions` VALUES (25922520, 428, 'Gabrovo');
INSERT INTO `regions` VALUES (25922521, 428, 'Grad Sofiya');
INSERT INTO `regions` VALUES (25922522, 428, 'Khaskovo');
INSERT INTO `regions` VALUES (25922524, 428, 'Kurdzhali');
INSERT INTO `regions` VALUES (25922526, 428, 'Kyustendil');
INSERT INTO `regions` VALUES (25922527, 428, 'Lovech');
INSERT INTO `regions` VALUES (25922516, 428, 'Mikhaylovgrad');
INSERT INTO `regions` VALUES (25922528, 428, 'Montana');
INSERT INTO `regions` VALUES (25922529, 428, 'Pazardzhik');
INSERT INTO `regions` VALUES (25922530, 428, 'Pernik');
INSERT INTO `regions` VALUES (25922531, 428, 'Pleven');
INSERT INTO `regions` VALUES (25922532, 428, 'Plovdiv');
INSERT INTO `regions` VALUES (25922533, 428, 'Razgrad');
INSERT INTO `regions` VALUES (25922534, 428, 'Ruse');
INSERT INTO `regions` VALUES (25922535, 428, 'Shumen');
INSERT INTO `regions` VALUES (25922536, 428, 'Silistra');
INSERT INTO `regions` VALUES (25922537, 428, 'Sliven');
INSERT INTO `regions` VALUES (25922538, 428, 'Smolyan');
INSERT INTO `regions` VALUES (25922539, 428, 'Sofiya');
INSERT INTO `regions` VALUES (25922540, 428, 'Stara Zagora');
INSERT INTO `regions` VALUES (25922541, 428, 'Turgovishte');
INSERT INTO `regions` VALUES (25922542, 428, 'Varna');
INSERT INTO `regions` VALUES (25922543, 428, 'Veliko Turnovo');
INSERT INTO `regions` VALUES (25922544, 428, 'Vidin');
INSERT INTO `regions` VALUES (25922545, 428, 'Vratsa');
INSERT INTO `regions` VALUES (25922546, 428, 'Yambol');
INSERT INTO `regions` VALUES (26523301, 582092, 'Chuquisaca');
INSERT INTO `regions` VALUES (26523302, 582092, 'Cochabamba');
INSERT INTO `regions` VALUES (26523303, 582092, 'El Beni');
INSERT INTO `regions` VALUES (26523304, 582092, 'La Paz');
INSERT INTO `regions` VALUES (26523305, 582092, 'Oruro');
INSERT INTO `regions` VALUES (26523306, 582092, 'Pando');
INSERT INTO `regions` VALUES (26523307, 582092, 'Potos&#237;');
INSERT INTO `regions` VALUES (26523308, 582092, 'Santa Cruz');
INSERT INTO `regions` VALUES (26523309, 582092, 'Tarija');
INSERT INTO `regions` VALUES (25906322, 582028, 'Federation of Bosnia and Herzegovina');
INSERT INTO `regions` VALUES (25906323, 582028, 'Republika Srpska');
INSERT INTO `regions` VALUES (24349384, 582061, 'Ботсвана');
INSERT INTO `regions` VALUES (26784055, 467, 'Acre');
INSERT INTO `regions` VALUES (26784056, 467, 'Alagoas');
INSERT INTO `regions` VALUES (26784057, 467, 'Amapa');
INSERT INTO `regions` VALUES (26784058, 467, 'Amazonas');
INSERT INTO `regions` VALUES (26784059, 467, 'Bahia');
INSERT INTO `regions` VALUES (26784060, 467, 'Ceara');
INSERT INTO `regions` VALUES (26784061, 467, 'Distrito Federal');
INSERT INTO `regions` VALUES (26784062, 467, 'Espirito Santo');
INSERT INTO `regions` VALUES (26784079, 467, 'Goias');
INSERT INTO `regions` VALUES (26784064, 467, 'Maranhao');
INSERT INTO `regions` VALUES (26784065, 467, 'Mato Grosso');
INSERT INTO `regions` VALUES (26784063, 467, 'Mato Grosso do Sul');
INSERT INTO `regions` VALUES (26784066, 467, 'Minas Gerais');
INSERT INTO `regions` VALUES (26784067, 467, 'Para');
INSERT INTO `regions` VALUES (26784068, 467, 'Paraiba');
INSERT INTO `regions` VALUES (26784069, 467, 'Parana');
INSERT INTO `regions` VALUES (26784080, 467, 'Pernambuco');
INSERT INTO `regions` VALUES (26784070, 467, 'Piaui');
INSERT INTO `regions` VALUES (26784072, 467, 'Rio Grande do Norte');
INSERT INTO `regions` VALUES (26784073, 467, 'Rio Grande do Sul');
INSERT INTO `regions` VALUES (26784071, 467, 'Rio de Janeiro');
INSERT INTO `regions` VALUES (26784074, 467, 'Rondonia');
INSERT INTO `regions` VALUES (26784075, 467, 'Roraima');
INSERT INTO `regions` VALUES (26784076, 467, 'Santa Catarina');
INSERT INTO `regions` VALUES (26784077, 467, 'Sao Paulo');
INSERT INTO `regions` VALUES (26784078, 467, 'Sergipe');
INSERT INTO `regions` VALUES (26784081, 467, 'Tocantins');
INSERT INTO `regions` VALUES (26337936, 23269633, 'Род-Таун');
INSERT INTO `regions` VALUES (24351078, 23269634, 'Бруней');
INSERT INTO `regions` VALUES (24349157, 23269635, 'Буркина Фасо');
INSERT INTO `regions` VALUES (24351098, 23269636, 'Бурунди');
INSERT INTO `regions` VALUES (24351061, 23269630, 'Бутан');
INSERT INTO `regions` VALUES (26344189, 23269722, 'Мата-Уту');
INSERT INTO `regions` VALUES (24349735, 23269721, 'Вануату');
INSERT INTO `regions` VALUES (25652120, 616, 'Channel Islands');
INSERT INTO `regions` VALUES (25652106, 616, 'England - East');
INSERT INTO `regions` VALUES (25652117, 616, 'England - East Midlands');
INSERT INTO `regions` VALUES (25652112, 616, 'England - London');
INSERT INTO `regions` VALUES (25652114, 616, 'England - North East');
INSERT INTO `regions` VALUES (25652109, 616, 'England - North West');
INSERT INTO `regions` VALUES (25652111, 616, 'England - South East');
INSERT INTO `regions` VALUES (25652108, 616, 'England - South West');
INSERT INTO `regions` VALUES (25652107, 616, 'England - West Midlands');
INSERT INTO `regions` VALUES (25652110, 616, 'England - Yorks & Humber');
INSERT INTO `regions` VALUES (25652121, 616, 'Isle of Man');
INSERT INTO `regions` VALUES (25652113, 616, 'Northern Ireland');
INSERT INTO `regions` VALUES (25652118, 616, 'Scotland Central');
INSERT INTO `regions` VALUES (25652105, 616, 'Scotland North');
INSERT INTO `regions` VALUES (25652119, 616, 'Scotland South');
INSERT INTO `regions` VALUES (25652116, 616, 'Wales North');
INSERT INTO `regions` VALUES (25652115, 616, 'Wales South');
INSERT INTO `regions` VALUES (25976562, 924, 'Bacs-Kiskun');
INSERT INTO `regions` VALUES (25976563, 924, 'Baranya');
INSERT INTO `regions` VALUES (25976564, 924, 'Bekes');
INSERT INTO `regions` VALUES (25976587, 924, 'Bekescsaba');
INSERT INTO `regions` VALUES (25976565, 924, 'Borsod-Abauj-Zemplen');
INSERT INTO `regions` VALUES (25976566, 924, 'Budapest');
INSERT INTO `regions` VALUES (25976567, 924, 'Csongrad');
INSERT INTO `regions` VALUES (25976568, 924, 'Debrecen');
INSERT INTO `regions` VALUES (25976588, 924, 'Dunaujvaros');
INSERT INTO `regions` VALUES (25976589, 924, 'Eger');
INSERT INTO `regions` VALUES (25976569, 924, 'Fejer');
INSERT INTO `regions` VALUES (25976586, 924, 'Gyor');
INSERT INTO `regions` VALUES (25976570, 924, 'Gyor-Moson-Sopron');
INSERT INTO `regions` VALUES (25976571, 924, 'Hajdu-Bihar');
INSERT INTO `regions` VALUES (25976572, 924, 'Heves');
INSERT INTO `regions` VALUES (25976590, 924, 'Hodmezovasarhely');
INSERT INTO `regions` VALUES (25976581, 924, 'Jasz-Nagykun-Szolnok');
INSERT INTO `regions` VALUES (25976591, 924, 'Kaposvar');
INSERT INTO `regions` VALUES (25976592, 924, 'Kecskemet');
INSERT INTO `regions` VALUES (25976573, 924, 'Komarom-Esztergom');
INSERT INTO `regions` VALUES (25976574, 924, 'Miskolc');
INSERT INTO `regions` VALUES (25976593, 924, 'Nagykanizsa');
INSERT INTO `regions` VALUES (25976575, 924, 'Nograd');
INSERT INTO `regions` VALUES (25976594, 924, 'Nyiregyhaza');
INSERT INTO `regions` VALUES (25976576, 924, 'Pecs');
INSERT INTO `regions` VALUES (25976577, 924, 'Pest');
INSERT INTO `regions` VALUES (25976578, 924, 'Somogy');
INSERT INTO `regions` VALUES (25976595, 924, 'Sopron');
INSERT INTO `regions` VALUES (25976579, 924, 'Szabolcs-Szatmar-Bereg');
INSERT INTO `regions` VALUES (25976580, 924, 'Szeged');
INSERT INTO `regions` VALUES (25976596, 924, 'Szekesfehervar');
INSERT INTO `regions` VALUES (25976597, 924, 'Szolnok');
INSERT INTO `regions` VALUES (25976598, 924, 'Szombathely');
INSERT INTO `regions` VALUES (25976599, 924, 'Tatabanya');
INSERT INTO `regions` VALUES (25976582, 924, 'Tolna');
INSERT INTO `regions` VALUES (25976583, 924, 'Vas');
INSERT INTO `regions` VALUES (25976600, 924, 'Veszprem');
INSERT INTO `regions` VALUES (25976584, 924, 'Veszprem');
INSERT INTO `regions` VALUES (25976585, 924, 'Zala');
INSERT INTO `regions` VALUES (25976601, 924, 'Zalaegerszeg');
INSERT INTO `regions` VALUES (26560661, 582053, 'Amazonas');
INSERT INTO `regions` VALUES (26560662, 582053, 'Anzoategui');
INSERT INTO `regions` VALUES (26560663, 582053, 'Apure');
INSERT INTO `regions` VALUES (26560664, 582053, 'Aragua');
INSERT INTO `regions` VALUES (26560665, 582053, 'Barinas');
INSERT INTO `regions` VALUES (26560666, 582053, 'Bol&#237;var');
INSERT INTO `regions` VALUES (26560667, 582053, 'Carabobo');
INSERT INTO `regions` VALUES (26560668, 582053, 'Cojedes');
INSERT INTO `regions` VALUES (26560670, 582053, 'Delta Amacuro');
INSERT INTO `regions` VALUES (26560684, 582053, 'Dependencias Federales');
INSERT INTO `regions` VALUES (26560685, 582053, 'Distrito Federal');
INSERT INTO `regions` VALUES (26560671, 582053, 'Falc&#243;n');
INSERT INTO `regions` VALUES (26560672, 582053, 'Gu&#225;rico');
INSERT INTO `regions` VALUES (26560673, 582053, 'Lara');
INSERT INTO `regions` VALUES (26560675, 582053, 'Miranda');
INSERT INTO `regions` VALUES (26560676, 582053, 'Monagas');
INSERT INTO `regions` VALUES (26560674, 582053, 'M&#233;rida');
INSERT INTO `regions` VALUES (26560677, 582053, 'Nueva Esparta');
INSERT INTO `regions` VALUES (26560678, 582053, 'Portuguesa');
INSERT INTO `regions` VALUES (26560679, 582053, 'Sucre');
INSERT INTO `regions` VALUES (26560681, 582053, 'Trujillo');
INSERT INTO `regions` VALUES (26560680, 582053, 'T&#225;chira');
INSERT INTO `regions` VALUES (26560686, 582053, 'Vargas');
INSERT INTO `regions` VALUES (26560682, 582053, 'Yaracuy');
INSERT INTO `regions` VALUES (26560683, 582053, 'Zulia');
INSERT INTO `regions` VALUES (24351270, 23269652, 'Восточный Тимор');
INSERT INTO `regions` VALUES (972, 971, 'Dong Bang Song Cuu Long');
INSERT INTO `regions` VALUES (975, 971, 'Dong Bang Song Hong');
INSERT INTO `regions` VALUES (979, 971, 'Dong Nam Bo');
INSERT INTO `regions` VALUES (982, 971, 'Duyen Hai Mien Trung');
INSERT INTO `regions` VALUES (987, 971, 'Khu Bon Cu');
INSERT INTO `regions` VALUES (990, 971, 'Mien Nui Va Trung Du');
INSERT INTO `regions` VALUES (992, 971, 'Thai Nguyen');
INSERT INTO `regions` VALUES (24351353, 23269661, 'Габон');
INSERT INTO `regions` VALUES (995, 994, 'Artibonite');
INSERT INTO `regions` VALUES (999, 994, 'Nord-Ouest');
INSERT INTO `regions` VALUES (1001, 994, 'Ouest');
INSERT INTO `regions` VALUES (1003, 994, 'Sud');
INSERT INTO `regions` VALUES (1005, 994, 'Sud-Est');
INSERT INTO `regions` VALUES (24350559, 23269670, 'Гайана');
INSERT INTO `regions` VALUES (24351613, 23269662, 'Гамбия');
INSERT INTO `regions` VALUES (24351635, 582066, 'Гана');
INSERT INTO `regions` VALUES (1008, 1007, 'Grande-Terre');
INSERT INTO `regions` VALUES (1010, 1007, 'Бас-Тер');
INSERT INTO `regions` VALUES (26426485, 23269666, 'Alta Verapaz');
INSERT INTO `regions` VALUES (26426486, 23269666, 'Baja Verapaz');
INSERT INTO `regions` VALUES (26426487, 23269666, 'Chimaltenango');
INSERT INTO `regions` VALUES (26426488, 23269666, 'Chiquimula');
INSERT INTO `regions` VALUES (26426489, 23269666, 'El Progreso');
INSERT INTO `regions` VALUES (26426490, 23269666, 'Escuintla');
INSERT INTO `regions` VALUES (26426491, 23269666, 'Guatemala');
INSERT INTO `regions` VALUES (26426492, 23269666, 'Huehuetenango');
INSERT INTO `regions` VALUES (26426493, 23269666, 'Izabal');
INSERT INTO `regions` VALUES (26426494, 23269666, 'Jalapa');
INSERT INTO `regions` VALUES (26426495, 23269666, 'Jutiapa');
INSERT INTO `regions` VALUES (26426496, 23269666, 'Pet&#233;n');
INSERT INTO `regions` VALUES (26426497, 23269666, 'Quetzaltenango');
INSERT INTO `regions` VALUES (26426498, 23269666, 'Quich&#233;');
INSERT INTO `regions` VALUES (26426499, 23269666, 'Retalhuleu');
INSERT INTO `regions` VALUES (26426500, 23269666, 'Sacatep&#233;quez');
INSERT INTO `regions` VALUES (26426501, 23269666, 'San Marcos');
INSERT INTO `regions` VALUES (26426502, 23269666, 'Santa Rosa');
INSERT INTO `regions` VALUES (26426503, 23269666, 'Solol&#225;');
INSERT INTO `regions` VALUES (26426504, 23269666, 'Suchitepequez');
INSERT INTO `regions` VALUES (26426505, 23269666, 'Totonicap&#225;n');
INSERT INTO `regions` VALUES (26426506, 23269666, 'Zacapa');
INSERT INTO `regions` VALUES (24349972, 23269668, 'Гвинея');
INSERT INTO `regions` VALUES (26338728, 23269669, 'Бисау');
INSERT INTO `regions` VALUES (25547954, 1012, 'Baden-W&#252;rttemberg');
INSERT INTO `regions` VALUES (25547955, 1012, 'Bayern');
INSERT INTO `regions` VALUES (25547966, 1012, 'Berlin');
INSERT INTO `regions` VALUES (25547953, 1012, 'Brandenburg');
INSERT INTO `regions` VALUES (25547967, 1012, 'Bremen');
INSERT INTO `regions` VALUES (25547957, 1012, 'Hamburg');
INSERT INTO `regions` VALUES (25547956, 1012, 'Hessen');
INSERT INTO `regions` VALUES (25547958, 1012, 'Mecklenburg-Vorpommern');
INSERT INTO `regions` VALUES (25547959, 1012, 'Niedersachsen');
INSERT INTO `regions` VALUES (25547960, 1012, 'Nordrhein-Westfalen');
INSERT INTO `regions` VALUES (25547961, 1012, 'Rheinland-Pfalz');
INSERT INTO `regions` VALUES (25547968, 1012, 'Saarland');
INSERT INTO `regions` VALUES (25547963, 1012, 'Sachsen');
INSERT INTO `regions` VALUES (25547964, 1012, 'Sachsen-Anhalt');
INSERT INTO `regions` VALUES (25547962, 1012, 'Schleswig-Holstein');
INSERT INTO `regions` VALUES (25547965, 1012, 'Th&#252;ringen');
INSERT INTO `regions` VALUES (26338680, 23269667, 'Сент-Питер-Порт');
INSERT INTO `regions` VALUES (25954789, 20738587, 'Gibraltar');
INSERT INTO `regions` VALUES (2567441, 2567393, 'Тегусигальпа');
INSERT INTO `regions` VALUES (277558, 277557, 'Гонконг');
INSERT INTO `regions` VALUES (26338620, 23269665, 'Сент-Джорджес');
INSERT INTO `regions` VALUES (25509139, 582052, 'Гренландия');
INSERT INTO `regions` VALUES (25955129, 1258, 'Aitolia kai Akarnania');
INSERT INTO `regions` VALUES (25955138, 1258, 'Akhaia');
INSERT INTO `regions` VALUES (25955136, 1258, 'Argolis');
INSERT INTO `regions` VALUES (25955141, 1258, 'Arkadhia');
INSERT INTO `regions` VALUES (25955118, 1258, 'Arta');
INSERT INTO `regions` VALUES (25955135, 1258, 'Attiki');
INSERT INTO `regions` VALUES (25955147, 1258, 'Dhodhekanisos');
INSERT INTO `regions` VALUES (25955102, 1258, 'Drama');
INSERT INTO `regions` VALUES (25955128, 1258, 'Evritania');
INSERT INTO `regions` VALUES (25955095, 1258, 'Evros');
INSERT INTO `regions` VALUES (25955134, 1258, 'Evvoia');
INSERT INTO `regions` VALUES (25955106, 1258, 'Florina');
INSERT INTO `regions` VALUES (25955131, 1258, 'Fokis');
INSERT INTO `regions` VALUES (25955127, 1258, 'Fthiotis');
INSERT INTO `regions` VALUES (25955108, 1258, 'Grevena');
INSERT INTO `regions` VALUES (25955139, 1258, 'Ilia');
INSERT INTO `regions` VALUES (25955110, 1258, 'Imathia');
INSERT INTO `regions` VALUES (25955115, 1258, 'Ioannina');
INSERT INTO `regions` VALUES (25955145, 1258, 'Iraklion');
INSERT INTO `regions` VALUES (25955121, 1258, 'Kardhitsa');
INSERT INTO `regions` VALUES (25955107, 1258, 'Kastoria');
INSERT INTO `regions` VALUES (25955112, 1258, 'Kavala');
INSERT INTO `regions` VALUES (25955125, 1258, 'Kefallinia');
INSERT INTO `regions` VALUES (25955123, 1258, 'Kerkira');
INSERT INTO `regions` VALUES (25955113, 1258, 'Khalkidhiki');
INSERT INTO `regions` VALUES (25955143, 1258, 'Khania');
INSERT INTO `regions` VALUES (25955150, 1258, 'Khios');
INSERT INTO `regions` VALUES (25955149, 1258, 'Kikladhes');
INSERT INTO `regions` VALUES (25955104, 1258, 'Kilkis');
INSERT INTO `regions` VALUES (25955137, 1258, 'Korinthia');
INSERT INTO `regions` VALUES (25955109, 1258, 'Kozani');
INSERT INTO `regions` VALUES (25955142, 1258, 'Lakonia');
INSERT INTO `regions` VALUES (25955119, 1258, 'Larisa');
INSERT INTO `regions` VALUES (25955146, 1258, 'Lasithi');
INSERT INTO `regions` VALUES (25955151, 1258, 'Lesvos');
INSERT INTO `regions` VALUES (25955124, 1258, 'Levkas');
INSERT INTO `regions` VALUES (25955122, 1258, 'Magnisia');
INSERT INTO `regions` VALUES (25955140, 1258, 'Messinia');
INSERT INTO `regions` VALUES (25955105, 1258, 'Pella');
INSERT INTO `regions` VALUES (25955114, 1258, 'Pieria');
INSERT INTO `regions` VALUES (25955117, 1258, 'Preveza');
INSERT INTO `regions` VALUES (25955144, 1258, 'Rethimni');
INSERT INTO `regions` VALUES (25955097, 1258, 'Rodhopi');
INSERT INTO `regions` VALUES (25955148, 1258, 'Samos');
INSERT INTO `regions` VALUES (25955103, 1258, 'Serrai');
INSERT INTO `regions` VALUES (25955116, 1258, 'Thesprotia');
INSERT INTO `regions` VALUES (25955111, 1258, 'Thessaloniki');
INSERT INTO `regions` VALUES (25955120, 1258, 'Trikala');
INSERT INTO `regions` VALUES (25955133, 1258, 'Voiotia');
INSERT INTO `regions` VALUES (25955100, 1258, 'Xanthi');
INSERT INTO `regions` VALUES (25955126, 1258, 'Zakinthos');
INSERT INTO `regions` VALUES (1281, 1280, 'Абхазия');
INSERT INTO `regions` VALUES (1292, 1280, 'Аджария');
INSERT INTO `regions` VALUES (1296, 1280, 'Грузия');
INSERT INTO `regions` VALUES (1363, 1280, 'Южная Осетия');
INSERT INTO `regions` VALUES (25816475, 1366, 'Arhus');
INSERT INTO `regions` VALUES (25816476, 1366, 'Bornholm');
INSERT INTO `regions` VALUES (25816477, 1366, 'Frederiksborg');
INSERT INTO `regions` VALUES (25816478, 1366, 'Fyn');
INSERT INTO `regions` VALUES (25816479, 1366, 'Kobenhavn');
INSERT INTO `regions` VALUES (25816481, 1366, 'Nordjylland');
INSERT INTO `regions` VALUES (25816482, 1366, 'Ribe');
INSERT INTO `regions` VALUES (25816483, 1366, 'Ringkobing');
INSERT INTO `regions` VALUES (25816484, 1366, 'Roskilde');
INSERT INTO `regions` VALUES (25816485, 1366, 'Sonderjylland');
INSERT INTO `regions` VALUES (25816480, 1366, 'Staden Kobenhavn');
INSERT INTO `regions` VALUES (25816486, 1366, 'Storstrom');
INSERT INTO `regions` VALUES (25816487, 1366, 'Vejle');
INSERT INTO `regions` VALUES (25816488, 1366, 'Vestsjalland');
INSERT INTO `regions` VALUES (25816489, 1366, 'Viborg');
INSERT INTO `regions` VALUES (26338805, 23269674, 'Сент-Элье');
INSERT INTO `regions` VALUES (24351245, 23269650, 'Джибути');
INSERT INTO `regions` VALUES (2578001, 2577958, 'Санто-доминго');
INSERT INTO `regions` VALUES (1381, 1380, 'Аль-Кахира');
INSERT INTO `regions` VALUES (1383, 1380, 'Асуан');
INSERT INTO `regions` VALUES (1385, 1380, 'Асьют');
INSERT INTO `regions` VALUES (1387, 1380, 'Бени-Суэйф');
INSERT INTO `regions` VALUES (1389, 1380, 'Гарбия');
INSERT INTO `regions` VALUES (1391, 1380, 'Думьят');
INSERT INTO `regions` VALUES (277674, 1380, 'Египет');
INSERT INTO `regions` VALUES (3409961, 1380, 'Синай');
INSERT INTO `regions` VALUES (24352245, 582081, 'Замбия');
INSERT INTO `regions` VALUES (24352201, 23269723, 'Западная Сахара');
INSERT INTO `regions` VALUES (24352262, 582056, 'Зимбабве');
INSERT INTO `regions` VALUES (58423734, 1393, 'Вади-Ара');
INSERT INTO `regions` VALUES (1449, 1393, 'Иерусалим');
INSERT INTO `regions` VALUES (21333896, 1393, 'Рамат ХаГолан');
INSERT INTO `regions` VALUES (1440, 1393, 'Тель-Авив');
INSERT INTO `regions` VALUES (1394, 1393, 'Хадаром');
INSERT INTO `regions` VALUES (1429, 1393, 'Хайфа');
INSERT INTO `regions` VALUES (1403, 1393, 'Хамеркац');
INSERT INTO `regions` VALUES (1416, 1393, 'Хацафон');
INSERT INTO `regions` VALUES (73730292, 1393, 'Шфела');
INSERT INTO `regions` VALUES (1452, 1451, 'Bangla');
INSERT INTO `regions` VALUES (1468, 1451, 'Chhattisgarh');
INSERT INTO `regions` VALUES (1473, 1451, 'Karnataka');
INSERT INTO `regions` VALUES (1488, 1451, 'Uttaranchal');
INSERT INTO `regions` VALUES (1491, 1451, 'Андхра-Прадеш');
INSERT INTO `regions` VALUES (1509, 1451, 'Ассам');
INSERT INTO `regions` VALUES (1512, 1451, 'Бихар');
INSERT INTO `regions` VALUES (1521, 1451, 'Гуджарат');
INSERT INTO `regions` VALUES (1539, 1451, 'Джамму и Кашмир');
INSERT INTO `regions` VALUES (277673, 1451, 'Индия');
INSERT INTO `regions` VALUES (1545, 1451, 'Керала');
INSERT INTO `regions` VALUES (1548, 1451, 'Мадхья-Прадеш');
INSERT INTO `regions` VALUES (1561, 1451, 'Манипур');
INSERT INTO `regions` VALUES (1563, 1451, 'Махараштра');
INSERT INTO `regions` VALUES (1586, 1451, 'Мегхалая');
INSERT INTO `regions` VALUES (1588, 1451, 'Орисса');
INSERT INTO `regions` VALUES (1591, 1451, 'Пенджаб');
INSERT INTO `regions` VALUES (1596, 1451, 'Пондишери');
INSERT INTO `regions` VALUES (1598, 1451, 'Раджастхан');
INSERT INTO `regions` VALUES (1612, 1451, 'Тамилнад');
INSERT INTO `regions` VALUES (1629, 1451, 'Трипура');
INSERT INTO `regions` VALUES (1631, 1451, 'Уттар-Прадеш');
INSERT INTO `regions` VALUES (1656, 1451, 'Харьяна');
INSERT INTO `regions` VALUES (1661, 1451, 'Чандигарх');
INSERT INTO `regions` VALUES (277560, 277559, 'Индонезия');
INSERT INTO `regions` VALUES (277562, 277561, 'Иордания');
INSERT INTO `regions` VALUES (3410574, 3410238, 'Багдад');
INSERT INTO `regions` VALUES (3410602, 3410238, 'Басра');
INSERT INTO `regions` VALUES (3410645, 3410238, 'Мосул');
INSERT INTO `regions` VALUES (1664, 1663, 'Azarbayjan-e Khavari');
INSERT INTO `regions` VALUES (1667, 1663, 'Esfahan');
INSERT INTO `regions` VALUES (1669, 1663, 'Hamadan');
INSERT INTO `regions` VALUES (1671, 1663, 'Kordestan');
INSERT INTO `regions` VALUES (1673, 1663, 'Markazi');
INSERT INTO `regions` VALUES (1675, 1663, 'Sistan-e Baluches');
INSERT INTO `regions` VALUES (1677, 1663, 'Yazd');
INSERT INTO `regions` VALUES (1679, 1663, 'Керман');
INSERT INTO `regions` VALUES (1681, 1663, 'Керманшахан');
INSERT INTO `regions` VALUES (1683, 1663, 'Мазендеран');
INSERT INTO `regions` VALUES (1686, 1663, 'Тегеран');
INSERT INTO `regions` VALUES (1688, 1663, 'Фарс');
INSERT INTO `regions` VALUES (1691, 1663, 'Хорасан');
INSERT INTO `regions` VALUES (1693, 1663, 'Хузистан');
INSERT INTO `regions` VALUES (27372684, 1696, 'Carlow');
INSERT INTO `regions` VALUES (27372700, 1696, 'Cavan');
INSERT INTO `regions` VALUES (27372695, 1696, 'Clare');
INSERT INTO `regions` VALUES (27372696, 1696, 'Cork');
INSERT INTO `regions` VALUES (27372701, 1696, 'Donegal');
INSERT INTO `regions` VALUES (27372677, 1696, 'Dublin');
INSERT INTO `regions` VALUES (27372678, 1696, 'Galway');
INSERT INTO `regions` VALUES (27372697, 1696, 'Kerry');
INSERT INTO `regions` VALUES (27372679, 1696, 'Kildare');
INSERT INTO `regions` VALUES (27372685, 1696, 'Kilkenny');
INSERT INTO `regions` VALUES (27372686, 1696, 'Laois');
INSERT INTO `regions` VALUES (27372680, 1696, 'Leitrim');
INSERT INTO `regions` VALUES (27372681, 1696, 'Limerick');
INSERT INTO `regions` VALUES (27372687, 1696, 'Longford');
INSERT INTO `regions` VALUES (27372688, 1696, 'Louth');
INSERT INTO `regions` VALUES (27372682, 1696, 'Mayo');
INSERT INTO `regions` VALUES (27372683, 1696, 'Meath');
INSERT INTO `regions` VALUES (27372702, 1696, 'Monaghan');
INSERT INTO `regions` VALUES (27372689, 1696, 'Offaly');
INSERT INTO `regions` VALUES (27372693, 1696, 'Roscommon');
INSERT INTO `regions` VALUES (27372694, 1696, 'Sligo');
INSERT INTO `regions` VALUES (27372698, 1696, 'Tipperary');
INSERT INTO `regions` VALUES (27372699, 1696, 'Waterford');
INSERT INTO `regions` VALUES (27372690, 1696, 'Westmeath');
INSERT INTO `regions` VALUES (27372691, 1696, 'Wexford');
INSERT INTO `regions` VALUES (27372692, 1696, 'Wicklow');
INSERT INTO `regions` VALUES (26818575, 582039, 'Akranes');
INSERT INTO `regions` VALUES (26818576, 582039, 'Akureyri');
INSERT INTO `regions` VALUES (26818577, 582039, 'Arnessysla');
INSERT INTO `regions` VALUES (26818578, 582039, 'Austur-Bardastrandarsysla');
INSERT INTO `regions` VALUES (26818579, 582039, 'Austur-Hunavatnssysla');
INSERT INTO `regions` VALUES (26818580, 582039, 'Austur-Skaftafellssysla');
INSERT INTO `regions` VALUES (26818581, 582039, 'Borgarfjardarsysla');
INSERT INTO `regions` VALUES (26818582, 582039, 'Dalasysla');
INSERT INTO `regions` VALUES (26818583, 582039, 'Eyjafjardarsysla');
INSERT INTO `regions` VALUES (26818584, 582039, 'Gullbringusysla');
INSERT INTO `regions` VALUES (26818585, 582039, 'Hafnarfjordur');
INSERT INTO `regions` VALUES (26818586, 582039, 'Husavik');
INSERT INTO `regions` VALUES (26818587, 582039, 'Isafjordur');
INSERT INTO `regions` VALUES (26818588, 582039, 'Keflavik');
INSERT INTO `regions` VALUES (26818589, 582039, 'Kjosarsysla');
INSERT INTO `regions` VALUES (26818590, 582039, 'Kopavogur');
INSERT INTO `regions` VALUES (26818591, 582039, 'Myrasysla');
INSERT INTO `regions` VALUES (26818592, 582039, 'Neskaupstadur');
INSERT INTO `regions` VALUES (26818593, 582039, 'Nordur-Isafjardarsysla');
INSERT INTO `regions` VALUES (26818594, 582039, 'Nordur-Mulasysla');
INSERT INTO `regions` VALUES (26818595, 582039, 'Nordur-Tingeyjarsysla');
INSERT INTO `regions` VALUES (26818596, 582039, 'Olafsfjordur');
INSERT INTO `regions` VALUES (26818597, 582039, 'Rangarvallasysla');
INSERT INTO `regions` VALUES (26818598, 582039, 'Reykjavik');
INSERT INTO `regions` VALUES (26818599, 582039, 'Saudarkrokur');
INSERT INTO `regions` VALUES (26818600, 582039, 'Seydisfjordur');
INSERT INTO `regions` VALUES (26818601, 582039, 'Siglufjordur');
INSERT INTO `regions` VALUES (26818602, 582039, 'Skagafjardarsysla');
INSERT INTO `regions` VALUES (26818603, 582039, 'Snafellsnes- og Hnappadalssysla');
INSERT INTO `regions` VALUES (26818604, 582039, 'Strandasysla');
INSERT INTO `regions` VALUES (26818605, 582039, 'Sudur-Mulasysla');
INSERT INTO `regions` VALUES (26818606, 582039, 'Sudur-Tingeyjarsysla');
INSERT INTO `regions` VALUES (26818607, 582039, 'Vestmannaeyjar');
INSERT INTO `regions` VALUES (26818608, 582039, 'Vestur-Bardastrandarsysla');
INSERT INTO `regions` VALUES (26818609, 582039, 'Vestur-Hunavatnssysla');
INSERT INTO `regions` VALUES (26818610, 582039, 'Vestur-Isafjardarsysla');
INSERT INTO `regions` VALUES (26818611, 582039, 'Vestur-Skaftafellssysla');
INSERT INTO `regions` VALUES (23915935, 1707, 'A Coru&#241;a');
INSERT INTO `regions` VALUES (23915957, 1707, 'Albacete');
INSERT INTO `regions` VALUES (23915955, 1707, 'Alicante/Alacant');
INSERT INTO `regions` VALUES (23915937, 1707, 'Almer&#237;a');
INSERT INTO `regions` VALUES (23915973, 1707, 'Asturias');
INSERT INTO `regions` VALUES (23915963, 1707, 'Badajoz');
INSERT INTO `regions` VALUES (23915962, 1707, 'Barcelona');
INSERT INTO `regions` VALUES (23915971, 1707, 'Burgos');
INSERT INTO `regions` VALUES (23915936, 1707, 'Cantabria');
INSERT INTO `regions` VALUES (23915944, 1707, 'Castell&#243;n/Castell&#243;');
INSERT INTO `regions` VALUES (23915948, 1707, 'Ceuta');
INSERT INTO `regions` VALUES (23915932, 1707, 'Ciudad Real');
INSERT INTO `regions` VALUES (23915958, 1707, 'Cuenca');
INSERT INTO `regions` VALUES (23915940, 1707, 'C&#225;ceres');
INSERT INTO `regions` VALUES (23915927, 1707, 'C&#225;diz');
INSERT INTO `regions` VALUES (23915956, 1707, 'C&#243;rdoba');
INSERT INTO `regions` VALUES (23915953, 1707, 'Girona');
INSERT INTO `regions` VALUES (23915954, 1707, 'Granada');
INSERT INTO `regions` VALUES (23915941, 1707, 'Guadalajara');
INSERT INTO `regions` VALUES (23915931, 1707, 'Guip&#250;zcoa');
INSERT INTO `regions` VALUES (23915967, 1707, 'Huelva');
INSERT INTO `regions` VALUES (23915972, 1707, 'Huesca');
INSERT INTO `regions` VALUES (23915970, 1707, 'Illes Balears');
INSERT INTO `regions` VALUES (23915952, 1707, 'Ja&#233;n');
INSERT INTO `regions` VALUES (23915947, 1707, 'La Rioja');
INSERT INTO `regions` VALUES (23915923, 1707, 'Las Palmas');
INSERT INTO `regions` VALUES (23915969, 1707, 'Le&#243;n');
INSERT INTO `regions` VALUES (58851413, 1707, 'Lleida');
INSERT INTO `regions` VALUES (23915968, 1707, 'Lleida');
INSERT INTO `regions` VALUES (23915946, 1707, 'Lugo');
INSERT INTO `regions` VALUES (23915964, 1707, 'Madrid');
INSERT INTO `regions` VALUES (23915961, 1707, 'Melilla');
INSERT INTO `regions` VALUES (23915949, 1707, 'Murcia');
INSERT INTO `regions` VALUES (23915974, 1707, 'M&#225;laga');
INSERT INTO `regions` VALUES (23915928, 1707, 'Navarra');
INSERT INTO `regions` VALUES (23915929, 1707, 'Ourense');
INSERT INTO `regions` VALUES (23915925, 1707, 'Palencia');
INSERT INTO `regions` VALUES (23915959, 1707, 'Pontevedra');
INSERT INTO `regions` VALUES (23915950, 1707, 'Salamanca');
INSERT INTO `regions` VALUES (23915939, 1707, 'Santa Cruz de Tenerife');
INSERT INTO `regions` VALUES (23915930, 1707, 'Segovia');
INSERT INTO `regions` VALUES (23915965, 1707, 'Sevilla');
INSERT INTO `regions` VALUES (23915924, 1707, 'Soria');
INSERT INTO `regions` VALUES (23915945, 1707, 'Tarragona');
INSERT INTO `regions` VALUES (23915960, 1707, 'Teruel');
INSERT INTO `regions` VALUES (23915943, 1707, 'Toledo');
INSERT INTO `regions` VALUES (23915951, 1707, 'Valladolid');
INSERT INTO `regions` VALUES (23915966, 1707, 'Val&#232;ncia');
INSERT INTO `regions` VALUES (23915933, 1707, 'Vizcaya');
INSERT INTO `regions` VALUES (23915926, 1707, 'Zamora');
INSERT INTO `regions` VALUES (23915938, 1707, 'Zaragoza');
INSERT INTO `regions` VALUES (23915934, 1707, '&#193;lava');
INSERT INTO `regions` VALUES (23915942, 1707, '&#193;vila');
INSERT INTO `regions` VALUES (23769294, 1786, 'Abruzzo - Chieti');
INSERT INTO `regions` VALUES (23769295, 1786, 'Abruzzo - Pescara');
INSERT INTO `regions` VALUES (23769296, 1786, 'Abruzzo - Teramo');
INSERT INTO `regions` VALUES (23769310, 1786, 'Basilicata - Matera');
INSERT INTO `regions` VALUES (23769309, 1786, 'Basilicata - Potenza');
INSERT INTO `regions` VALUES (23769311, 1786, 'Calabria - Catanzaro');
INSERT INTO `regions` VALUES (23769312, 1786, 'Calabria - Cosenza');
INSERT INTO `regions` VALUES (23769313, 1786, 'Calabria - Crotone');
INSERT INTO `regions` VALUES (23769314, 1786, 'Calabria - Reggio Calabria');
INSERT INTO `regions` VALUES (23769315, 1786, 'Calabria - Vibo Valentia');
INSERT INTO `regions` VALUES (23769300, 1786, 'Campania - Avellino');
INSERT INTO `regions` VALUES (23769301, 1786, 'Campania - Benevento');
INSERT INTO `regions` VALUES (23769302, 1786, 'Campania - Caserta');
INSERT INTO `regions` VALUES (23769299, 1786, 'Campania - Napoli');
INSERT INTO `regions` VALUES (23769303, 1786, 'Campania - Salerno');
INSERT INTO `regions` VALUES (23769263, 1786, 'Emilia Romagna - Bologna');
INSERT INTO `regions` VALUES (23769264, 1786, 'Emilia Romagna - Ferrara');
INSERT INTO `regions` VALUES (23769265, 1786, 'Emilia Romagna - Forl&#236;-Cesena');
INSERT INTO `regions` VALUES (23769266, 1786, 'Emilia Romagna - Modena');
INSERT INTO `regions` VALUES (23769267, 1786, 'Emilia Romagna - Parma');
INSERT INTO `regions` VALUES (23769268, 1786, 'Emilia Romagna - Piacenza');
INSERT INTO `regions` VALUES (23769269, 1786, 'Emilia Romagna - Ravenna');
INSERT INTO `regions` VALUES (23769270, 1786, 'Emilia Romagna - Reggio Emilia');
INSERT INTO `regions` VALUES (23769271, 1786, 'Emilia Romagna - Rimini');
INSERT INTO `regions` VALUES (23769256, 1786, 'Friuli Venezia Giulia - Gorizia');
INSERT INTO `regions` VALUES (23769257, 1786, 'Friuli Venezia Giulia - Pordenone');
INSERT INTO `regions` VALUES (23769255, 1786, 'Friuli Venezia Giulia - Trieste');
INSERT INTO `regions` VALUES (23769258, 1786, 'Friuli Venezia Giulia - Udine');
INSERT INTO `regions` VALUES (23769289, 1786, 'Lazio - Frosinone');
INSERT INTO `regions` VALUES (23769290, 1786, 'Lazio - Latina');
INSERT INTO `regions` VALUES (23769291, 1786, 'Lazio - Rieti');
INSERT INTO `regions` VALUES (23769288, 1786, 'Lazio - Roma');
INSERT INTO `regions` VALUES (23769292, 1786, 'Lazio - Viterbo');
INSERT INTO `regions` VALUES (23769259, 1786, 'Liguria - Genova');
INSERT INTO `regions` VALUES (23769260, 1786, 'Liguria - Imperia');
INSERT INTO `regions` VALUES (23769261, 1786, 'Liguria - La Spezia');
INSERT INTO `regions` VALUES (23769262, 1786, 'Liguria - Savona');
INSERT INTO `regions` VALUES (23769236, 1786, 'Lombardia - Bergamo');
INSERT INTO `regions` VALUES (23769237, 1786, 'Lombardia - Brescia');
INSERT INTO `regions` VALUES (23769238, 1786, 'Lombardia - Como');
INSERT INTO `regions` VALUES (23769239, 1786, 'Lombardia - Cremona');
INSERT INTO `regions` VALUES (23769240, 1786, 'Lombardia - Lecco');
INSERT INTO `regions` VALUES (23769241, 1786, 'Lombardia - Lodi');
INSERT INTO `regions` VALUES (23769242, 1786, 'Lombardia - Mantova');
INSERT INTO `regions` VALUES (23769235, 1786, 'Lombardia - Milano');
INSERT INTO `regions` VALUES (23769243, 1786, 'Lombardia - Pavia');
INSERT INTO `regions` VALUES (23769244, 1786, 'Lombardia - Sondrio');
INSERT INTO `regions` VALUES (23769245, 1786, 'Lombardia - Varese');
INSERT INTO `regions` VALUES (23769284, 1786, 'Marche - Ancona');
INSERT INTO `regions` VALUES (23769285, 1786, 'Marche - Ascoli Piceno');
INSERT INTO `regions` VALUES (23769286, 1786, 'Marche - Macerata');
INSERT INTO `regions` VALUES (23769287, 1786, 'Marche - Pesaro - Urbino');
INSERT INTO `regions` VALUES (23769297, 1786, 'Molise - Campobasso');
INSERT INTO `regions` VALUES (23769298, 1786, 'Molise - Isernia');
INSERT INTO `regions` VALUES (23769227, 1786, 'Piemonte - Alessandria');
INSERT INTO `regions` VALUES (23769228, 1786, 'Piemonte - Asti');
INSERT INTO `regions` VALUES (23769229, 1786, 'Piemonte - Biella');
INSERT INTO `regions` VALUES (23769230, 1786, 'Piemonte - Cuneo');
INSERT INTO `regions` VALUES (23769231, 1786, 'Piemonte - Novara');
INSERT INTO `regions` VALUES (23769226, 1786, 'Piemonte - Torino');
INSERT INTO `regions` VALUES (23769232, 1786, 'Piemonte - Verbania');
INSERT INTO `regions` VALUES (23769233, 1786, 'Piemonte - Vercelli');
INSERT INTO `regions` VALUES (23769304, 1786, 'Puglia - Bari');
INSERT INTO `regions` VALUES (23769305, 1786, 'Puglia - Brindisi');
INSERT INTO `regions` VALUES (23769306, 1786, 'Puglia - Foggia');
INSERT INTO `regions` VALUES (23769307, 1786, 'Puglia - Lecce');
INSERT INTO `regions` VALUES (23769308, 1786, 'Puglia - Taranto');
INSERT INTO `regions` VALUES (23769325, 1786, 'Sardegna - Cagliari');
INSERT INTO `regions` VALUES (23769326, 1786, 'Sardegna - Nuoro');
INSERT INTO `regions` VALUES (23769327, 1786, 'Sardegna - Oristano');
INSERT INTO `regions` VALUES (23769328, 1786, 'Sardegna - Sassari');
INSERT INTO `regions` VALUES (23769317, 1786, 'Sicilia - Agrigento');
INSERT INTO `regions` VALUES (23769318, 1786, 'Sicilia - Caltanissetta');
INSERT INTO `regions` VALUES (23769319, 1786, 'Sicilia - Catania');
INSERT INTO `regions` VALUES (23769320, 1786, 'Sicilia - Enna');
INSERT INTO `regions` VALUES (23769321, 1786, 'Sicilia - Messina');
INSERT INTO `regions` VALUES (23769316, 1786, 'Sicilia - Palermo');
INSERT INTO `regions` VALUES (23769322, 1786, 'Sicilia - Ragusa');
INSERT INTO `regions` VALUES (23769323, 1786, 'Sicilia - Siracusa');
INSERT INTO `regions` VALUES (23769324, 1786, 'Sicilia - Trapani');
INSERT INTO `regions` VALUES (23769273, 1786, 'Toscana - Arezzo');
INSERT INTO `regions` VALUES (23769272, 1786, 'Toscana - Firenze');
INSERT INTO `regions` VALUES (23769274, 1786, 'Toscana - Grosseto');
INSERT INTO `regions` VALUES (23769275, 1786, 'Toscana - Livorno');
INSERT INTO `regions` VALUES (23769276, 1786, 'Toscana - Lucca');
INSERT INTO `regions` VALUES (23769277, 1786, 'Toscana - Massa Carrara');
INSERT INTO `regions` VALUES (23769278, 1786, 'Toscana - Pisa');
INSERT INTO `regions` VALUES (23769279, 1786, 'Toscana - Pistoia');
INSERT INTO `regions` VALUES (23769280, 1786, 'Toscana - Prato');
INSERT INTO `regions` VALUES (23769281, 1786, 'Toscana - Siena');
INSERT INTO `regions` VALUES (23769247, 1786, 'Trentino Alto Adige - Bolzano');
INSERT INTO `regions` VALUES (23769246, 1786, 'Trentino Alto Adige - Trento');
INSERT INTO `regions` VALUES (23769282, 1786, 'Umbria - Perugia');
INSERT INTO `regions` VALUES (23769283, 1786, 'Umbria - Terni');
INSERT INTO `regions` VALUES (23769249, 1786, 'Veneto - Belluno');
INSERT INTO `regions` VALUES (23769250, 1786, 'Veneto - Padova');
INSERT INTO `regions` VALUES (23769251, 1786, 'Veneto - Rovigo');
INSERT INTO `regions` VALUES (23769252, 1786, 'Veneto - Treviso');
INSERT INTO `regions` VALUES (23769248, 1786, 'Veneto - Venezia');
INSERT INTO `regions` VALUES (23769253, 1786, 'Veneto - Verona');
INSERT INTO `regions` VALUES (23769254, 1786, 'Veneto - Vicenza');
INSERT INTO `regions` VALUES (24352230, 23269724, 'Йемен');
INSERT INTO `regions` VALUES (24351115, 23269638, 'Кабо-Верде');
INSERT INTO `regions` VALUES (2128, 1894, 'Акмолинская обл. (Целиноградская обл.)');
INSERT INTO `regions` VALUES (1895, 1894, 'Актюбинская обл.');
INSERT INTO `regions` VALUES (1911, 1894, 'Алма-Атинская обл.');
INSERT INTO `regions` VALUES (1924, 1894, 'Восточно-Казахстанская обл.');
INSERT INTO `regions` VALUES (1942, 1894, 'Гурьевская обл.');
INSERT INTO `regions` VALUES (1974, 1894, 'Джезказганская обл.');
INSERT INTO `regions` VALUES (1954, 1894, 'Жамбылская обл. (Джамбулская обл.)');
INSERT INTO `regions` VALUES (1934356, 1894, 'Западно-Казахстанская обл.');
INSERT INTO `regions` VALUES (277655, 1894, 'Казахстан');
INSERT INTO `regions` VALUES (1994, 1894, 'Карагандинская обл.');
INSERT INTO `regions` VALUES (2010, 1894, 'Кзыл-Ординская обл.');
INSERT INTO `regions` VALUES (2021, 1894, 'Кокчетавская обл.');
INSERT INTO `regions` VALUES (2040, 1894, 'Кустанайская обл.');
INSERT INTO `regions` VALUES (2055, 1894, 'Мангыстауская (Мангышлакская обл.)');
INSERT INTO `regions` VALUES (2061, 1894, 'Павлодарская обл.');
INSERT INTO `regions` VALUES (2074, 1894, 'Северо-Казахстанская обл.');
INSERT INTO `regions` VALUES (2105, 1894, 'Талды-Курганская обл.');
INSERT INTO `regions` VALUES (73717120, 1894, 'Тараз');
INSERT INTO `regions` VALUES (2120, 1894, 'Тургайская обл.');
INSERT INTO `regions` VALUES (2146, 1894, 'Чимкентская обл.');
INSERT INTO `regions` VALUES (24349569, 23269637, 'Камбоджа');
INSERT INTO `regions` VALUES (2164, 2163, 'Littoral');
INSERT INTO `regions` VALUES (2166, 2163, 'Sudouest');
INSERT INTO `regions` VALUES (2168, 2163, 'Северная');
INSERT INTO `regions` VALUES (2170, 2163, 'Центральная');
INSERT INTO `regions` VALUES (28282373, 2172, 'Alberta');
INSERT INTO `regions` VALUES (28283833, 2172, 'British Columbia');
INSERT INTO `regions` VALUES (28280842, 2172, 'Manitoba');
INSERT INTO `regions` VALUES (28274450, 2172, 'New Brunswick');
INSERT INTO `regions` VALUES (28273312, 2172, 'Newfoundland');
INSERT INTO `regions` VALUES (28285013, 2172, 'Northwest Territories');
INSERT INTO `regions` VALUES (28273797, 2172, 'Nova Scotia');
INSERT INTO `regions` VALUES (28284979, 2172, 'Nunavut');
INSERT INTO `regions` VALUES (28277752, 2172, 'Ontario');
INSERT INTO `regions` VALUES (28274389, 2172, 'Prince Edward Island');
INSERT INTO `regions` VALUES (28275766, 2172, 'Quebec');
INSERT INTO `regions` VALUES (28281551, 2172, 'Saskatchewan');
INSERT INTO `regions` VALUES (28285045, 2172, 'Yukon Territory');
INSERT INTO `regions` VALUES (26340775, 23269697, 'Доха');
INSERT INTO `regions` VALUES (26938989, 582057, 'Central');
INSERT INTO `regions` VALUES (26938990, 582057, 'Coast');
INSERT INTO `regions` VALUES (26938991, 582057, 'Eastern');
INSERT INTO `regions` VALUES (26938992, 582057, 'Nairobi Area');
INSERT INTO `regions` VALUES (26938993, 582057, 'North-Eastern');
INSERT INTO `regions` VALUES (26938994, 582057, 'Nyanza');
INSERT INTO `regions` VALUES (26938995, 582057, 'Rift Valley');
INSERT INTO `regions` VALUES (26938996, 582057, 'Western');
INSERT INTO `regions` VALUES (2298, 2297, 'Government controlled area');
INSERT INTO `regions` VALUES (2300, 2297, 'Turkish controlled area');
INSERT INTO `regions` VALUES (26942308, 23269676, 'Gilbert Islands');
INSERT INTO `regions` VALUES (26942309, 23269676, 'Line Islands');
INSERT INTO `regions` VALUES (26942310, 23269676, 'Phoenix Islands');
INSERT INTO `regions` VALUES (26819665, 2374, 'Anhui');
INSERT INTO `regions` VALUES (26819685, 2374, 'Beijing');
INSERT INTO `regions` VALUES (26819696, 2374, 'Chongqing');
INSERT INTO `regions` VALUES (26819671, 2374, 'Fujian');
INSERT INTO `regions` VALUES (26819679, 2374, 'Gansu');
INSERT INTO `regions` VALUES (26819693, 2374, 'Guangdong');
INSERT INTO `regions` VALUES (26819680, 2374, 'Guangxi');
INSERT INTO `regions` VALUES (26819681, 2374, 'Guizhou');
INSERT INTO `regions` VALUES (26819694, 2374, 'Hainan');
INSERT INTO `regions` VALUES (26819674, 2374, 'Hebei');
INSERT INTO `regions` VALUES (26819672, 2374, 'Heilongjiang');
INSERT INTO `regions` VALUES (26819673, 2374, 'Henan');
INSERT INTO `regions` VALUES (26819676, 2374, 'Hubei');
INSERT INTO `regions` VALUES (26819675, 2374, 'Hunan');
INSERT INTO `regions` VALUES (26819668, 2374, 'Jiangsu');
INSERT INTO `regions` VALUES (26819667, 2374, 'Jiangxi');
INSERT INTO `regions` VALUES (26819669, 2374, 'Jilin');
INSERT INTO `regions` VALUES (26819682, 2374, 'Liaoning');
INSERT INTO `regions` VALUES (26819683, 2374, 'Nei Mongol');
INSERT INTO `regions` VALUES (26819684, 2374, 'Ningxia');
INSERT INTO `regions` VALUES (26819670, 2374, 'Qinghai');
INSERT INTO `regions` VALUES (26819689, 2374, 'Shaanxi');
INSERT INTO `regions` VALUES (26819688, 2374, 'Shandong');
INSERT INTO `regions` VALUES (26819686, 2374, 'Shanghai');
INSERT INTO `regions` VALUES (26819687, 2374, 'Shanxi');
INSERT INTO `regions` VALUES (26819690, 2374, 'Sichuan');
INSERT INTO `regions` VALUES (26819691, 2374, 'Tianjin');
INSERT INTO `regions` VALUES (26819677, 2374, 'Xinjiang');
INSERT INTO `regions` VALUES (26819678, 2374, 'Xizang');
INSERT INTO `regions` VALUES (26819692, 2374, 'Yunnan');
INSERT INTO `regions` VALUES (26819666, 2374, 'Zhejiang');
INSERT INTO `regions` VALUES (26433762, 582033, 'Amazonas');
INSERT INTO `regions` VALUES (26433763, 582033, 'Antioquia');
INSERT INTO `regions` VALUES (26433764, 582033, 'Arauca');
INSERT INTO `regions` VALUES (26433765, 582033, 'Atl&#225;ntico');
INSERT INTO `regions` VALUES (26433791, 582033, 'Bol&#237;var');
INSERT INTO `regions` VALUES (26433792, 582033, 'Boyac&#225;');
INSERT INTO `regions` VALUES (26433793, 582033, 'Caldas');
INSERT INTO `regions` VALUES (26433766, 582033, 'Caquet&#225;');
INSERT INTO `regions` VALUES (26433788, 582033, 'Casanare');
INSERT INTO `regions` VALUES (26433767, 582033, 'Cauca');
INSERT INTO `regions` VALUES (26433769, 582033, 'Choc&#243;');
INSERT INTO `regions` VALUES (26433789, 582033, 'Cundinamarca');
INSERT INTO `regions` VALUES (26433768, 582033, 'C&#233;sar');
INSERT INTO `regions` VALUES (26433770, 582033, 'C&#243;rdoba');
INSERT INTO `regions` VALUES (26433790, 582033, 'Distrito Especial');
INSERT INTO `regions` VALUES (26433772, 582033, 'Guain&#237;a');
INSERT INTO `regions` VALUES (26433771, 582033, 'Guaviare');
INSERT INTO `regions` VALUES (26433773, 582033, 'Huila');
INSERT INTO `regions` VALUES (26433774, 582033, 'La Guajira');
INSERT INTO `regions` VALUES (26433794, 582033, 'Magdalena');
INSERT INTO `regions` VALUES (26433775, 582033, 'Meta');
INSERT INTO `regions` VALUES (26433776, 582033, 'Narino');
INSERT INTO `regions` VALUES (26433777, 582033, 'Norte de Santander');
INSERT INTO `regions` VALUES (26433778, 582033, 'Putumayo');
INSERT INTO `regions` VALUES (26433779, 582033, 'Quind&#237;o');
INSERT INTO `regions` VALUES (26433780, 582033, 'Risaralda');
INSERT INTO `regions` VALUES (26433781, 582033, 'San Andr&#233;s y Providencia');
INSERT INTO `regions` VALUES (26433782, 582033, 'Santander');
INSERT INTO `regions` VALUES (26433783, 582033, 'Sucre');
INSERT INTO `regions` VALUES (26433784, 582033, 'Tolima');
INSERT INTO `regions` VALUES (26433785, 582033, 'Valle del Cauca');
INSERT INTO `regions` VALUES (26433786, 582033, 'Vaup&#233;s');
INSERT INTO `regions` VALUES (26433787, 582033, 'Vichada');
INSERT INTO `regions` VALUES (24351170, 23269645, 'Коморские');
INSERT INTO `regions` VALUES (24351192, 582076, 'Конго (Brazzaville)');
INSERT INTO `regions` VALUES (26338097, 23269646, 'Конго');
INSERT INTO `regions` VALUES (26539816, 2430, 'Alajuela');
INSERT INTO `regions` VALUES (26539817, 2430, 'Cartago');
INSERT INTO `regions` VALUES (26539818, 2430, 'Guanacaste');
INSERT INTO `regions` VALUES (26539819, 2430, 'Heredia');
INSERT INTO `regions` VALUES (26539820, 2430, 'Lim&#243;n');
INSERT INTO `regions` VALUES (26539821, 2430, 'Puntarenas');
INSERT INTO `regions` VALUES (26539822, 2430, 'San Jos&#233;');
INSERT INTO `regions` VALUES (26774536, 582077, 'Camaguey');
INSERT INTO `regions` VALUES (26774537, 582077, 'Ciego de Avila');
INSERT INTO `regions` VALUES (26774538, 582077, 'Cienfuegos');
INSERT INTO `regions` VALUES (26774533, 582077, 'Ciudad de la Habana');
INSERT INTO `regions` VALUES (26774539, 582077, 'Granma');
INSERT INTO `regions` VALUES (26774540, 582077, 'Guantanamo');
INSERT INTO `regions` VALUES (26774542, 582077, 'Holguin');
INSERT INTO `regions` VALUES (26774535, 582077, 'Isla de la Juventud');
INSERT INTO `regions` VALUES (26774541, 582077, 'La Habana');
INSERT INTO `regions` VALUES (26774543, 582077, 'Las Tunas');
INSERT INTO `regions` VALUES (26774534, 582077, 'Matanzas');
INSERT INTO `regions` VALUES (26774532, 582077, 'Pinar del Rio');
INSERT INTO `regions` VALUES (26774544, 582077, 'Sancti Spiritus');
INSERT INTO `regions` VALUES (26774545, 582077, 'Santiago de Cuba');
INSERT INTO `regions` VALUES (26774546, 582077, 'Villa Clara');
INSERT INTO `regions` VALUES (2444, 2443, 'al-Jahra');
INSERT INTO `regions` VALUES (2446, 2443, 'al-Kuwayt');
INSERT INTO `regions` VALUES (26338158, 23269647, 'Аваруа');
INSERT INTO `regions` VALUES (2304, 2303, 'Иссык-Кульская обл.');
INSERT INTO `regions` VALUES (277550, 2303, 'Кыргызстан');
INSERT INTO `regions` VALUES (2316, 2303, 'Кыргызстан');
INSERT INTO `regions` VALUES (2327, 2303, 'Нарынская обл.');
INSERT INTO `regions` VALUES (2340, 2303, 'Ошская обл.');
INSERT INTO `regions` VALUES (2365, 2303, 'Таласская обл.');
INSERT INTO `regions` VALUES (24349541, 23269677, 'Лаос');
INSERT INTO `regions` VALUES (2449, 2448, 'Латвия');
INSERT INTO `regions` VALUES (24351699, 23269678, 'Лесото');
INSERT INTO `regions` VALUES (24349938, 23269679, 'Либерия');
INSERT INTO `regions` VALUES (2494137, 582060, 'Бейрут');
INSERT INTO `regions` VALUES (2510, 2509, 'Tarabulus');
INSERT INTO `regions` VALUES (2512, 2509, 'Бенгази');
INSERT INTO `regions` VALUES (2515, 2514, 'Литва');
INSERT INTO `regions` VALUES (25995661, 582095, 'Balzers');
INSERT INTO `regions` VALUES (25995662, 582095, 'Eschen');
INSERT INTO `regions` VALUES (25995663, 582095, 'Gamprin');
INSERT INTO `regions` VALUES (25995665, 582095, 'Mauren');
INSERT INTO `regions` VALUES (25995666, 582095, 'Planken');
INSERT INTO `regions` VALUES (25995667, 582095, 'Ruggell');
INSERT INTO `regions` VALUES (25995668, 582095, 'Schaan');
INSERT INTO `regions` VALUES (25995669, 582095, 'Schellenberg');
INSERT INTO `regions` VALUES (25995670, 582095, 'Triesen');
INSERT INTO `regions` VALUES (25995671, 582095, 'Triesenberg');
INSERT INTO `regions` VALUES (25995672, 582095, 'Vaduz');
INSERT INTO `regions` VALUES (25995943, 2614, 'Diekirch');
INSERT INTO `regions` VALUES (25995944, 2614, 'Grevenmacher');
INSERT INTO `regions` VALUES (25995945, 2614, 'Luxembourg');
INSERT INTO `regions` VALUES (24349513, 23269683, 'Маврикий');
INSERT INTO `regions` VALUES (26337773, 582069, 'Мавритания');
INSERT INTO `regions` VALUES (24349421, 582109, 'Мадагаскар');
INSERT INTO `regions` VALUES (25997123, 582041, 'Aracinovo');
INSERT INTO `regions` VALUES (25997124, 582041, 'Bac');
INSERT INTO `regions` VALUES (25997125, 582041, 'Belcista');
INSERT INTO `regions` VALUES (25997126, 582041, 'Berovo');
INSERT INTO `regions` VALUES (25997127, 582041, 'Bistrica');
INSERT INTO `regions` VALUES (25997128, 582041, 'Bitola');
INSERT INTO `regions` VALUES (25997129, 582041, 'Blatec');
INSERT INTO `regions` VALUES (25997130, 582041, 'Bogdanci');
INSERT INTO `regions` VALUES (25997131, 582041, 'Bogomila');
INSERT INTO `regions` VALUES (25997132, 582041, 'Bogovinje');
INSERT INTO `regions` VALUES (25997133, 582041, 'Bosilovo');
INSERT INTO `regions` VALUES (25997134, 582041, 'Brvenica');
INSERT INTO `regions` VALUES (25997135, 582041, 'Cair');
INSERT INTO `regions` VALUES (25997136, 582041, 'Capari');
INSERT INTO `regions` VALUES (25997137, 582041, 'Caska');
INSERT INTO `regions` VALUES (25997138, 582041, 'Cegrane');
INSERT INTO `regions` VALUES (25997139, 582041, 'Centar');
INSERT INTO `regions` VALUES (25997140, 582041, 'Centar Zupa');
INSERT INTO `regions` VALUES (25997141, 582041, 'Cesinovo');
INSERT INTO `regions` VALUES (25997142, 582041, 'Cucer-Sandevo');
INSERT INTO `regions` VALUES (25997143, 582041, 'Debar');
INSERT INTO `regions` VALUES (25997144, 582041, 'Delcevo');
INSERT INTO `regions` VALUES (25997145, 582041, 'Delogozdi');
INSERT INTO `regions` VALUES (25997146, 582041, 'Demir Hisar');
INSERT INTO `regions` VALUES (25997147, 582041, 'Demir Kapija');
INSERT INTO `regions` VALUES (25997148, 582041, 'Dobrusevo');
INSERT INTO `regions` VALUES (25997149, 582041, 'Dolna Banjica');
INSERT INTO `regions` VALUES (25997150, 582041, 'Dolneni');
INSERT INTO `regions` VALUES (25997152, 582041, 'Dorce Petrov');
INSERT INTO `regions` VALUES (25997153, 582041, 'Drugovo');
INSERT INTO `regions` VALUES (25997154, 582041, 'Dzepciste');
INSERT INTO `regions` VALUES (25997155, 582041, 'Gazi Baba');
INSERT INTO `regions` VALUES (25997156, 582041, 'Gevgelija');
INSERT INTO `regions` VALUES (25997157, 582041, 'Gostivar');
INSERT INTO `regions` VALUES (25997158, 582041, 'Gradsko');
INSERT INTO `regions` VALUES (25997159, 582041, 'Ilinden');
INSERT INTO `regions` VALUES (25997160, 582041, 'Izvor');
INSERT INTO `regions` VALUES (25997161, 582041, 'Jegunovce');
INSERT INTO `regions` VALUES (25997162, 582041, 'Kamenjane');
INSERT INTO `regions` VALUES (25997163, 582041, 'Karbinci');
INSERT INTO `regions` VALUES (25997164, 582041, 'Karpos');
INSERT INTO `regions` VALUES (25997165, 582041, 'Kavadarci');
INSERT INTO `regions` VALUES (25997166, 582041, 'Kicevo');
INSERT INTO `regions` VALUES (25997167, 582041, 'Kisela Voda');
INSERT INTO `regions` VALUES (25997168, 582041, 'Klecevce');
INSERT INTO `regions` VALUES (25997169, 582041, 'Kocani');
INSERT INTO `regions` VALUES (25997170, 582041, 'Konce');
INSERT INTO `regions` VALUES (25997171, 582041, 'Kondovo');
INSERT INTO `regions` VALUES (25997172, 582041, 'Konopiste');
INSERT INTO `regions` VALUES (25997173, 582041, 'Kosel');
INSERT INTO `regions` VALUES (25997174, 582041, 'Kratovo');
INSERT INTO `regions` VALUES (25997175, 582041, 'Kriva Palanka');
INSERT INTO `regions` VALUES (25997176, 582041, 'Krivogastani');
INSERT INTO `regions` VALUES (25997177, 582041, 'Krusevo');
INSERT INTO `regions` VALUES (25997178, 582041, 'Kuklis');
INSERT INTO `regions` VALUES (25997179, 582041, 'Kukurecani');
INSERT INTO `regions` VALUES (25997180, 582041, 'Kumanovo');
INSERT INTO `regions` VALUES (25997181, 582041, 'Labunista');
INSERT INTO `regions` VALUES (25997182, 582041, 'Lipkovo');
INSERT INTO `regions` VALUES (25997183, 582041, 'Lozovo');
INSERT INTO `regions` VALUES (25997184, 582041, 'Lukovo');
INSERT INTO `regions` VALUES (25997185, 582041, 'Makedonska Kamenica');
INSERT INTO `regions` VALUES (25997186, 582041, 'Makedonski Brod');
INSERT INTO `regions` VALUES (25997187, 582041, 'Mavrovi Anovi');
INSERT INTO `regions` VALUES (25997188, 582041, 'Meseista');
INSERT INTO `regions` VALUES (25997189, 582041, 'Miravci');
INSERT INTO `regions` VALUES (25997190, 582041, 'Mogila');
INSERT INTO `regions` VALUES (25997191, 582041, 'Murtino');
INSERT INTO `regions` VALUES (25997192, 582041, 'Negotino');
INSERT INTO `regions` VALUES (25997193, 582041, 'Negotino-Polosko');
INSERT INTO `regions` VALUES (25997194, 582041, 'Novaci');
INSERT INTO `regions` VALUES (25997195, 582041, 'Novo Selo');
INSERT INTO `regions` VALUES (25997196, 582041, 'Oblesevo');
INSERT INTO `regions` VALUES (25997197, 582041, 'Ohrid');
INSERT INTO `regions` VALUES (25997198, 582041, 'Orasac');
INSERT INTO `regions` VALUES (25997199, 582041, 'Orizari');
INSERT INTO `regions` VALUES (25997200, 582041, 'Oslomej');
INSERT INTO `regions` VALUES (25997201, 582041, 'Pehcevo');
INSERT INTO `regions` VALUES (25997202, 582041, 'Petrovec');
INSERT INTO `regions` VALUES (25997203, 582041, 'Plasnica');
INSERT INTO `regions` VALUES (25997204, 582041, 'Podares');
INSERT INTO `regions` VALUES (25997205, 582041, 'Prilep');
INSERT INTO `regions` VALUES (25997206, 582041, 'Probistip');
INSERT INTO `regions` VALUES (25997207, 582041, 'Radovis');
INSERT INTO `regions` VALUES (25997208, 582041, 'Rankovce');
INSERT INTO `regions` VALUES (25997209, 582041, 'Resen');
INSERT INTO `regions` VALUES (25997210, 582041, 'Rosoman');
INSERT INTO `regions` VALUES (25997211, 582041, 'Rostusa');
INSERT INTO `regions` VALUES (25997212, 582041, 'Samokov');
INSERT INTO `regions` VALUES (25997213, 582041, 'Saraj');
INSERT INTO `regions` VALUES (25997214, 582041, 'Sipkovica');
INSERT INTO `regions` VALUES (25997215, 582041, 'Sopiste');
INSERT INTO `regions` VALUES (25997216, 582041, 'Sopotnica');
INSERT INTO `regions` VALUES (25997217, 582041, 'Srbinovo');
INSERT INTO `regions` VALUES (25997219, 582041, 'Star Dojran');
INSERT INTO `regions` VALUES (25997218, 582041, 'Staravina');
INSERT INTO `regions` VALUES (25997220, 582041, 'Staro Nagoricane');
INSERT INTO `regions` VALUES (25997221, 582041, 'Stip');
INSERT INTO `regions` VALUES (25997222, 582041, 'Struga');
INSERT INTO `regions` VALUES (25997223, 582041, 'Strumica');
INSERT INTO `regions` VALUES (25997224, 582041, 'Studenicani');
INSERT INTO `regions` VALUES (25997225, 582041, 'Suto Orizari');
INSERT INTO `regions` VALUES (25997226, 582041, 'Sveti Nikole');
INSERT INTO `regions` VALUES (25997227, 582041, 'Tearce');
INSERT INTO `regions` VALUES (25997228, 582041, 'Tetovo');
INSERT INTO `regions` VALUES (25997229, 582041, 'Topolcani');
INSERT INTO `regions` VALUES (25997230, 582041, 'Valandovo');
INSERT INTO `regions` VALUES (25997231, 582041, 'Vasilevo');
INSERT INTO `regions` VALUES (25997232, 582041, 'Veles');
INSERT INTO `regions` VALUES (25997233, 582041, 'Velesta');
INSERT INTO `regions` VALUES (25997234, 582041, 'Vevcani');
INSERT INTO `regions` VALUES (25997235, 582041, 'Vinica');
INSERT INTO `regions` VALUES (25997236, 582041, 'Vitoliste');
INSERT INTO `regions` VALUES (25997237, 582041, 'Vranestica');
INSERT INTO `regions` VALUES (25997238, 582041, 'Vrapciste');
INSERT INTO `regions` VALUES (25997239, 582041, 'Vratnica');
INSERT INTO `regions` VALUES (25997240, 582041, 'Vrutok');
INSERT INTO `regions` VALUES (25997241, 582041, 'Zajas');
INSERT INTO `regions` VALUES (25997242, 582041, 'Zelenikovo');
INSERT INTO `regions` VALUES (25997243, 582041, 'Zelino');
INSERT INTO `regions` VALUES (25997244, 582041, 'Zitose');
INSERT INTO `regions` VALUES (25997245, 582041, 'Zletovo');
INSERT INTO `regions` VALUES (25997246, 582041, 'Zrnovci');
INSERT INTO `regions` VALUES (24351731, 582094, 'Малави');
INSERT INTO `regions` VALUES (277564, 277563, 'Малайзия');
INSERT INTO `regions` VALUES (24349106, 582108, 'Мали');
INSERT INTO `regions` VALUES (24351758, 23269681, 'Мальдивские о-ва');
INSERT INTO `regions` VALUES (26000779, 582043, 'Malta');
INSERT INTO `regions` VALUES (26338969, 23269682, 'Фор-де-Франс');
INSERT INTO `regions` VALUES (26455187, 2617, 'Aguascalientes');
INSERT INTO `regions` VALUES (26455188, 2617, 'Baja California');
INSERT INTO `regions` VALUES (26455189, 2617, 'Baja California Sur');
INSERT INTO `regions` VALUES (26455190, 2617, 'Campeche');
INSERT INTO `regions` VALUES (26455191, 2617, 'Chiapas');
INSERT INTO `regions` VALUES (26455192, 2617, 'Chihuahua');
INSERT INTO `regions` VALUES (26455193, 2617, 'Coahuila de Zaragoza');
INSERT INTO `regions` VALUES (26455194, 2617, 'Colima');
INSERT INTO `regions` VALUES (26455195, 2617, 'Distrito Federal');
INSERT INTO `regions` VALUES (26455196, 2617, 'Durango');
INSERT INTO `regions` VALUES (26455197, 2617, 'Guanajuato');
INSERT INTO `regions` VALUES (26455198, 2617, 'Guerrero');
INSERT INTO `regions` VALUES (26455200, 2617, 'Hidalgo');
INSERT INTO `regions` VALUES (26455201, 2617, 'Jalisco');
INSERT INTO `regions` VALUES (26455203, 2617, 'Michoac&#225;n de Ocampo');
INSERT INTO `regions` VALUES (26455205, 2617, 'Morelos');
INSERT INTO `regions` VALUES (26455202, 2617, 'M&#233;xico');
INSERT INTO `regions` VALUES (26455207, 2617, 'Nayarit');
INSERT INTO `regions` VALUES (26455208, 2617, 'Nuevo Le&#243;n');
INSERT INTO `regions` VALUES (26455209, 2617, 'Oaxaca');
INSERT INTO `regions` VALUES (26455210, 2617, 'Puebla');
INSERT INTO `regions` VALUES (26455211, 2617, 'Quer&#233;taro de Arteaga');
INSERT INTO `regions` VALUES (26455212, 2617, 'Quintana Roo');
INSERT INTO `regions` VALUES (26455213, 2617, 'San Luis Potos&#237;');
INSERT INTO `regions` VALUES (26455214, 2617, 'Sinaloa');
INSERT INTO `regions` VALUES (26455215, 2617, 'Sonora');
INSERT INTO `regions` VALUES (26455216, 2617, 'Tabasco');
INSERT INTO `regions` VALUES (26455217, 2617, 'Tamaulipas');
INSERT INTO `regions` VALUES (26455218, 2617, 'Tlaxcala');
INSERT INTO `regions` VALUES (26455219, 2617, 'Veracruz-Llave');
INSERT INTO `regions` VALUES (26455220, 2617, 'Yucat&#225;n');
INSERT INTO `regions` VALUES (26455221, 2617, 'Zacatecas');
INSERT INTO `regions` VALUES (6128697, 582082, 'Мозамбик');
INSERT INTO `regions` VALUES (2789, 2788, 'Молдова');
INSERT INTO `regions` VALUES (26001510, 2833, 'La Condamine');
INSERT INTO `regions` VALUES (26001511, 2833, 'Monaco');
INSERT INTO `regions` VALUES (26001512, 2833, 'Monte-Carlo');
INSERT INTO `regions` VALUES (2687732, 2687701, 'Улан-Батор');
INSERT INTO `regions` VALUES (4042477, 582065, 'Морокко');
INSERT INTO `regions` VALUES (20737850, 582065, 'Рабат');
INSERT INTO `regions` VALUES (4119771, 582065, 'Танжер');
INSERT INTO `regions` VALUES (24351780, 23269686, 'Мьянма (Бирма)');
INSERT INTO `regions` VALUES (1930798, 582105, 'Остров Мэн');
INSERT INTO `regions` VALUES (24349322, 582063, 'Намибия');
INSERT INTO `regions` VALUES (24349846, 23269687, 'Науру');
INSERT INTO `regions` VALUES (24351799, 582068, 'Непал');
INSERT INTO `regions` VALUES (24349010, 23269691, 'Нигер');
INSERT INTO `regions` VALUES (21338584, 582080, 'Нигерия');
INSERT INTO `regions` VALUES (33587969, 1206, 'Drenthe');
INSERT INTO `regions` VALUES (33587981, 1206, 'Flevoland');
INSERT INTO `regions` VALUES (33587970, 1206, 'Friesland');
INSERT INTO `regions` VALUES (33587971, 1206, 'Gelderland');
INSERT INTO `regions` VALUES (33587972, 1206, 'Groningen');
INSERT INTO `regions` VALUES (33587979, 1206, 'Lelystad');
INSERT INTO `regions` VALUES (33587973, 1206, 'Limburg');
INSERT INTO `regions` VALUES (33587974, 1206, 'Noord-Brabant');
INSERT INTO `regions` VALUES (33587975, 1206, 'Noord-Holland');
INSERT INTO `regions` VALUES (33587980, 1206, 'Overijssel');
INSERT INTO `regions` VALUES (33587976, 1206, 'Utrecht');
INSERT INTO `regions` VALUES (33587977, 1206, 'Zeeland');
INSERT INTO `regions` VALUES (33587978, 1206, 'Zuid-Holland');
INSERT INTO `regions` VALUES (26582423, 23269690, 'Boaco');
INSERT INTO `regions` VALUES (26582424, 23269690, 'Carazo');
INSERT INTO `regions` VALUES (26582425, 23269690, 'Chinandega');
INSERT INTO `regions` VALUES (26582426, 23269690, 'Chontales');
INSERT INTO `regions` VALUES (26582427, 23269690, 'Estel&#237;');
INSERT INTO `regions` VALUES (26582429, 23269690, 'Granada');
INSERT INTO `regions` VALUES (26582430, 23269690, 'Jinotega');
INSERT INTO `regions` VALUES (26582431, 23269690, 'Le&#243;n');
INSERT INTO `regions` VALUES (26582432, 23269690, 'Madriz');
INSERT INTO `regions` VALUES (26582433, 23269690, 'Managua');
INSERT INTO `regions` VALUES (26582434, 23269690, 'Masaya');
INSERT INTO `regions` VALUES (26582435, 23269690, 'Matagalpa');
INSERT INTO `regions` VALUES (26582436, 23269690, 'Nueva Segovia');
INSERT INTO `regions` VALUES (26582437, 23269690, 'Rio San Juan');
INSERT INTO `regions` VALUES (26582438, 23269690, 'Rivas');
INSERT INTO `regions` VALUES (26582440, 23269690, 'Zelaya');
INSERT INTO `regions` VALUES (2838, 2837, 'Auckland');
INSERT INTO `regions` VALUES (2841, 2837, 'Bay of Plenty');
INSERT INTO `regions` VALUES (2844, 2837, 'Canterbury');
INSERT INTO `regions` VALUES (2847, 2837, 'Gisborne');
INSERT INTO `regions` VALUES (2852, 2837, 'Manawatu-Wanganui');
INSERT INTO `regions` VALUES (2855, 2837, 'Marlborough');
INSERT INTO `regions` VALUES (2857, 2837, 'Nelson');
INSERT INTO `regions` VALUES (2859, 2837, 'Northland');
INSERT INTO `regions` VALUES (2861, 2837, 'Otago');
INSERT INTO `regions` VALUES (2863, 2837, 'Southland');
INSERT INTO `regions` VALUES (2866, 2837, 'Taranaki');
INSERT INTO `regions` VALUES (2869, 2837, 'Tasman');
INSERT INTO `regions` VALUES (2871, 2837, 'Waikato');
INSERT INTO `regions` VALUES (2874, 2837, 'Wellington');
INSERT INTO `regions` VALUES (2878, 2837, 'West Coast');
INSERT INTO `regions` VALUES (26339309, 23269689, 'Нумеа');
INSERT INTO `regions` VALUES (25789723, 2880, 'Akershus');
INSERT INTO `regions` VALUES (25789724, 2880, 'Aust-Agder');
INSERT INTO `regions` VALUES (25789725, 2880, 'Buskerud');
INSERT INTO `regions` VALUES (25789726, 2880, 'Finnmark');
INSERT INTO `regions` VALUES (25789727, 2880, 'Hedmark');
INSERT INTO `regions` VALUES (25789728, 2880, 'Hordaland');
INSERT INTO `regions` VALUES (25789729, 2880, 'More og Romsdal');
INSERT INTO `regions` VALUES (25789731, 2880, 'Nord-Trondelag');
INSERT INTO `regions` VALUES (25789730, 2880, 'Nordland');
INSERT INTO `regions` VALUES (25789732, 2880, 'Oppland');
INSERT INTO `regions` VALUES (25789733, 2880, 'Oslo');
INSERT INTO `regions` VALUES (25789734, 2880, 'Ostfold');
INSERT INTO `regions` VALUES (25789735, 2880, 'Rogaland');
INSERT INTO `regions` VALUES (25789736, 2880, 'Sogn og Fjordane');
INSERT INTO `regions` VALUES (25789737, 2880, 'Sor-Trondelag');
INSERT INTO `regions` VALUES (25789738, 2880, 'Telemark');
INSERT INTO `regions` VALUES (25789739, 2880, 'Troms');
INSERT INTO `regions` VALUES (25789740, 2880, 'Vest-Agder');
INSERT INTO `regions` VALUES (25789741, 2880, 'Vestfold');
INSERT INTO `regions` VALUES (26339832, 23269693, 'Кингстон');
INSERT INTO `regions` VALUES (20737651, 582051, 'Абу Даби');
INSERT INTO `regions` VALUES (2316780, 582051, 'Дубаи');
INSERT INTO `regions` VALUES (20736801, 582051, 'Шарджа');
INSERT INTO `regions` VALUES (24351812, 23269694, 'Оман');
INSERT INTO `regions` VALUES (7593366, 582044, 'Пакистан');
INSERT INTO `regions` VALUES (26515922, 582093, 'Bocas del Toro');
INSERT INTO `regions` VALUES (26515923, 582093, 'Chiriqu&#237;');
INSERT INTO `regions` VALUES (26515924, 582093, 'Cocl&#233;');
INSERT INTO `regions` VALUES (26515925, 582093, 'Col&#243;n');
INSERT INTO `regions` VALUES (26515926, 582093, 'Dari&#233;n');
INSERT INTO `regions` VALUES (26515927, 582093, 'Herrera');
INSERT INTO `regions` VALUES (26515928, 582093, 'Los Santos');
INSERT INTO `regions` VALUES (26515929, 582093, 'Panam&#225;');
INSERT INTO `regions` VALUES (26515930, 582093, 'San Blas');
INSERT INTO `regions` VALUES (26515931, 582093, 'Veraguas');
INSERT INTO `regions` VALUES (24349683, 582045, 'Папуа Новая Гвинея');
INSERT INTO `regions` VALUES (26418424, 582072, 'Alto Paraguay');
INSERT INTO `regions` VALUES (26418409, 582072, 'Alto Paran&#225;');
INSERT INTO `regions` VALUES (26418410, 582072, 'Amambay');
INSERT INTO `regions` VALUES (26418427, 582072, 'Asunci&#243;n');
INSERT INTO `regions` VALUES (26418411, 582072, 'Boquer&#243;n');
INSERT INTO `regions` VALUES (26418412, 582072, 'Caaguaz&#250;');
INSERT INTO `regions` VALUES (26418413, 582072, 'Caazap&#225;');
INSERT INTO `regions` VALUES (26418425, 582072, 'Canindey&#250;');
INSERT INTO `regions` VALUES (26418414, 582072, 'Central');
INSERT INTO `regions` VALUES (26418426, 582072, 'Chaco');
INSERT INTO `regions` VALUES (26418415, 582072, 'Concepci&#243;n');
INSERT INTO `regions` VALUES (26418416, 582072, 'Cordillera');
INSERT INTO `regions` VALUES (26418417, 582072, 'Guair&#225;');
INSERT INTO `regions` VALUES (26418418, 582072, 'Itap&#250;a');
INSERT INTO `regions` VALUES (26418419, 582072, 'Misiones');
INSERT INTO `regions` VALUES (26418420, 582072, 'Neembuc&#250;');
INSERT INTO `regions` VALUES (26418421, 582072, 'Paraguar&#237;');
INSERT INTO `regions` VALUES (26418422, 582072, 'Presidente Hayes');
INSERT INTO `regions` VALUES (26418423, 582072, 'San Pedro');
INSERT INTO `regions` VALUES (26391336, 582046, 'Amazonas');
INSERT INTO `regions` VALUES (26391337, 582046, 'Ancash');
INSERT INTO `regions` VALUES (26391338, 582046, 'Apur&#237;mac');
INSERT INTO `regions` VALUES (26391339, 582046, 'Arequipa');
INSERT INTO `regions` VALUES (26391340, 582046, 'Ayacucho');
INSERT INTO `regions` VALUES (26391341, 582046, 'Cajamarca');
INSERT INTO `regions` VALUES (26391342, 582046, 'Callao');
INSERT INTO `regions` VALUES (26391343, 582046, 'Cusco');
INSERT INTO `regions` VALUES (26391344, 582046, 'Huancavelica');
INSERT INTO `regions` VALUES (26391345, 582046, 'Hu&#225;nuco');
INSERT INTO `regions` VALUES (26391346, 582046, 'Ica');
INSERT INTO `regions` VALUES (26391347, 582046, 'Jun&#237;n');
INSERT INTO `regions` VALUES (26391348, 582046, 'La Libertad');
INSERT INTO `regions` VALUES (26391349, 582046, 'Lambayeque');
INSERT INTO `regions` VALUES (26391350, 582046, 'Lima');
INSERT INTO `regions` VALUES (26391351, 582046, 'Loreto');
INSERT INTO `regions` VALUES (26391352, 582046, 'Madre de Dios');
INSERT INTO `regions` VALUES (26391353, 582046, 'Moquegua');
INSERT INTO `regions` VALUES (26391354, 582046, 'Pasco');
INSERT INTO `regions` VALUES (26391355, 582046, 'Piura');
INSERT INTO `regions` VALUES (26391356, 582046, 'Puno');
INSERT INTO `regions` VALUES (26391357, 582046, 'San Mart&#237;n');
INSERT INTO `regions` VALUES (26391358, 582046, 'Tacna');
INSERT INTO `regions` VALUES (26391359, 582046, 'Tumbes');
INSERT INTO `regions` VALUES (26391360, 582046, 'Ucayali');
INSERT INTO `regions` VALUES (26340708, 23269696, 'Адамстаун');
INSERT INTO `regions` VALUES (26001747, 2897, 'Biala Podlaska');
INSERT INTO `regions` VALUES (26001748, 2897, 'Bialystok');
INSERT INTO `regions` VALUES (26001749, 2897, 'Bielsko');
INSERT INTO `regions` VALUES (26001750, 2897, 'Bydgoszcz');
INSERT INTO `regions` VALUES (26001751, 2897, 'Chelm');
INSERT INTO `regions` VALUES (26001752, 2897, 'Ciechanow');
INSERT INTO `regions` VALUES (26001753, 2897, 'Czestochowa');
INSERT INTO `regions` VALUES (26001800, 2897, 'Dolnoslaskie');
INSERT INTO `regions` VALUES (26001754, 2897, 'Elblag');
INSERT INTO `regions` VALUES (26001755, 2897, 'Gdansk');
INSERT INTO `regions` VALUES (26001756, 2897, 'Gorzow');
INSERT INTO `regions` VALUES (26001758, 2897, 'Jelenia Gora');
INSERT INTO `regions` VALUES (26001760, 2897, 'Kalisz');
INSERT INTO `regions` VALUES (26001761, 2897, 'Katowice');
INSERT INTO `regions` VALUES (26001762, 2897, 'Kielce');
INSERT INTO `regions` VALUES (26001763, 2897, 'Konin');
INSERT INTO `regions` VALUES (26001764, 2897, 'Koszalin');
INSERT INTO `regions` VALUES (26001765, 2897, 'Krakow');
INSERT INTO `regions` VALUES (26001766, 2897, 'Krosno');
INSERT INTO `regions` VALUES (26001801, 2897, 'Kujawsko-Pomorskie');
INSERT INTO `regions` VALUES (26001767, 2897, 'Legnica');
INSERT INTO `regions` VALUES (26001769, 2897, 'Leszno');
INSERT INTO `regions` VALUES (26001770, 2897, 'Lodz');
INSERT INTO `regions` VALUES (26001802, 2897, 'Lodzkie');
INSERT INTO `regions` VALUES (26001771, 2897, 'Lomza');
INSERT INTO `regions` VALUES (26001803, 2897, 'Lubelskie');
INSERT INTO `regions` VALUES (26001773, 2897, 'Lublin');
INSERT INTO `regions` VALUES (26001804, 2897, 'Lubuskie');
INSERT INTO `regions` VALUES (26001805, 2897, 'Malopolskie');
INSERT INTO `regions` VALUES (26001806, 2897, 'Mazowieckie');
INSERT INTO `regions` VALUES (26001774, 2897, 'Nowy Sacz');
INSERT INTO `regions` VALUES (26001775, 2897, 'Olsztyn');
INSERT INTO `regions` VALUES (26001776, 2897, 'Opole');
INSERT INTO `regions` VALUES (26001807, 2897, 'Opolskie');
INSERT INTO `regions` VALUES (26001777, 2897, 'Ostroleka');
INSERT INTO `regions` VALUES (26001778, 2897, 'Pila');
INSERT INTO `regions` VALUES (26001779, 2897, 'Piotrkow');
INSERT INTO `regions` VALUES (26001780, 2897, 'Plock');
INSERT INTO `regions` VALUES (26001810, 2897, 'Podkarpackie');
INSERT INTO `regions` VALUES (26001811, 2897, 'Podlaskie');
INSERT INTO `regions` VALUES (26001813, 2897, 'Pomorskie');
INSERT INTO `regions` VALUES (26001781, 2897, 'Poznan');
INSERT INTO `regions` VALUES (26001782, 2897, 'Przemysl');
INSERT INTO `regions` VALUES (26001783, 2897, 'Radom');
INSERT INTO `regions` VALUES (26001784, 2897, 'Rzeszow');
INSERT INTO `regions` VALUES (26001785, 2897, 'Siedlce');
INSERT INTO `regions` VALUES (26001786, 2897, 'Sieradz');
INSERT INTO `regions` VALUES (26001787, 2897, 'Skierniewice');
INSERT INTO `regions` VALUES (26001814, 2897, 'Slaskie');
INSERT INTO `regions` VALUES (26001788, 2897, 'Slupsk');
INSERT INTO `regions` VALUES (26001789, 2897, 'Suwalki');
INSERT INTO `regions` VALUES (26001815, 2897, 'Swietokrzyskie');
INSERT INTO `regions` VALUES (26001790, 2897, 'Szczecin');
INSERT INTO `regions` VALUES (26001791, 2897, 'Tarnobrzeg');
INSERT INTO `regions` VALUES (26001792, 2897, 'Tarnow');
INSERT INTO `regions` VALUES (26001793, 2897, 'Torun');
INSERT INTO `regions` VALUES (26001794, 2897, 'Walbrzych');
INSERT INTO `regions` VALUES (26001816, 2897, 'Warminsko-Mazurskie');
INSERT INTO `regions` VALUES (26001795, 2897, 'Warszawa');
INSERT INTO `regions` VALUES (26001817, 2897, 'Wielkopolskie');
INSERT INTO `regions` VALUES (26001796, 2897, 'Wloclawek');
INSERT INTO `regions` VALUES (26001797, 2897, 'Wroclaw');
INSERT INTO `regions` VALUES (26001818, 2897, 'Zachodniopomorskie');
INSERT INTO `regions` VALUES (26001798, 2897, 'Zamosc');
INSERT INTO `regions` VALUES (26001799, 2897, 'Zielona Gora');
INSERT INTO `regions` VALUES (24856976, 3141, 'Aveiro');
INSERT INTO `regions` VALUES (24856995, 3141, 'Azores');
INSERT INTO `regions` VALUES (24856977, 3141, 'Beja');
INSERT INTO `regions` VALUES (24856978, 3141, 'Braga');
INSERT INTO `regions` VALUES (24856979, 3141, 'Braganca');
INSERT INTO `regions` VALUES (24856980, 3141, 'Castelo Branco');
INSERT INTO `regions` VALUES (24856981, 3141, 'Coimbra');
INSERT INTO `regions` VALUES (24856982, 3141, 'Evora');
INSERT INTO `regions` VALUES (24856983, 3141, 'Faro');
INSERT INTO `regions` VALUES (24856985, 3141, 'Guarda');
INSERT INTO `regions` VALUES (24856986, 3141, 'Leiria');
INSERT INTO `regions` VALUES (24856987, 3141, 'Lisboa');
INSERT INTO `regions` VALUES (24856984, 3141, 'Madeira');
INSERT INTO `regions` VALUES (24856988, 3141, 'Portalegre');
INSERT INTO `regions` VALUES (24856989, 3141, 'Porto');
INSERT INTO `regions` VALUES (24856990, 3141, 'Santarem');
INSERT INTO `regions` VALUES (24856991, 3141, 'Setubal');
INSERT INTO `regions` VALUES (24856992, 3141, 'Viana do Castelo');
INSERT INTO `regions` VALUES (24856993, 3141, 'Vila Real');
INSERT INTO `regions` VALUES (24856994, 3141, 'Viseu');
INSERT INTO `regions` VALUES (25450162, 34851252, 'Puerto Rico');
INSERT INTO `regions` VALUES (3157, 3156, 'Saint-Denis');
INSERT INTO `regions` VALUES (1998532, 3159, 'Адыгея');
INSERT INTO `regions` VALUES (3160, 3159, 'Алтайский край');
INSERT INTO `regions` VALUES (3223, 3159, 'Амурская обл.');
INSERT INTO `regions` VALUES (3251, 3159, 'Архангельская обл.');
INSERT INTO `regions` VALUES (3282, 3159, 'Астраханская обл.');
INSERT INTO `regions` VALUES (3296, 3159, 'Башкортостан(Башкирия)');
INSERT INTO `regions` VALUES (3352, 3159, 'Белгородская обл.');
INSERT INTO `regions` VALUES (3371, 3159, 'Брянская обл.');
INSERT INTO `regions` VALUES (3407, 3159, 'Бурятия');
INSERT INTO `regions` VALUES (3437, 3159, 'Владимирская обл.');
INSERT INTO `regions` VALUES (3468, 3159, 'Волгоградская обл.');
INSERT INTO `regions` VALUES (3503, 3159, 'Вологодская обл.');
INSERT INTO `regions` VALUES (3529, 3159, 'Воронежская обл.');
INSERT INTO `regions` VALUES (3630, 3159, 'Дагестан');
INSERT INTO `regions` VALUES (3673, 3159, 'Еврейская обл.');
INSERT INTO `regions` VALUES (3675, 3159, 'Ивановская обл.');
INSERT INTO `regions` VALUES (3703, 3159, 'Иркутская обл.');
INSERT INTO `regions` VALUES (3751, 3159, 'Кабардино-Балкария');
INSERT INTO `regions` VALUES (3761, 3159, 'Калининградская обл.');
INSERT INTO `regions` VALUES (3827, 3159, 'Калмыкия');
INSERT INTO `regions` VALUES (3841, 3159, 'Калужская обл.');
INSERT INTO `regions` VALUES (3872, 3159, 'Камчатская обл.');
INSERT INTO `regions` VALUES (28180484, 3159, 'Карачаево-Черкесская Республика');
INSERT INTO `regions` VALUES (3892, 3159, 'Карелия');
INSERT INTO `regions` VALUES (3921, 3159, 'Кемеровская обл.');
INSERT INTO `regions` VALUES (3952, 3159, 'Кировская обл.');
INSERT INTO `regions` VALUES (3994, 3159, 'Коми');
INSERT INTO `regions` VALUES (4026, 3159, 'Костромская обл.');
INSERT INTO `regions` VALUES (4052, 3159, 'Краснодарский край');
INSERT INTO `regions` VALUES (4105, 3159, 'Красноярский край');
INSERT INTO `regions` VALUES (4176, 3159, 'Курганская обл.');
INSERT INTO `regions` VALUES (4198, 3159, 'Курская обл.');
INSERT INTO `regions` VALUES (4227, 3159, 'Липецкая обл.');
INSERT INTO `regions` VALUES (4243, 3159, 'Магаданская обл.');
INSERT INTO `regions` VALUES (4270, 3159, 'Марий Эл');
INSERT INTO `regions` VALUES (4287, 3159, 'Мордовия');
INSERT INTO `regions` VALUES (4312, 3159, 'Москва и Московская обл.');
INSERT INTO `regions` VALUES (4481, 3159, 'Мурманская обл.');
INSERT INTO `regions` VALUES (3563, 3159, 'Нижегородская (Горьковская)');
INSERT INTO `regions` VALUES (4503, 3159, 'Новгородская обл.');
INSERT INTO `regions` VALUES (4528, 3159, 'Новосибирская обл.');
INSERT INTO `regions` VALUES (4561, 3159, 'Омская обл.');
INSERT INTO `regions` VALUES (4593, 3159, 'Оренбургская обл.');
INSERT INTO `regions` VALUES (4633, 3159, 'Орловская обл.');
INSERT INTO `regions` VALUES (4657, 3159, 'Пензенская обл.');
INSERT INTO `regions` VALUES (4689, 3159, 'Пермский край');
INSERT INTO `regions` VALUES (4734, 3159, 'Приморский край');
INSERT INTO `regions` VALUES (4773, 3159, 'Псковская обл.');
INSERT INTO `regions` VALUES (28180669, 3159, 'Республика Тыва');
INSERT INTO `regions` VALUES (4800, 3159, 'Ростовская обл.');
INSERT INTO `regions` VALUES (4861, 3159, 'Рязанская обл.');
INSERT INTO `regions` VALUES (4891, 3159, 'Самарская обл.');
INSERT INTO `regions` VALUES (4925, 3159, 'Санкт-Петербург и область');
INSERT INTO `regions` VALUES (4969, 3159, 'Саратовская обл.');
INSERT INTO `regions` VALUES (5011, 3159, 'Саха (Якутия)');
INSERT INTO `regions` VALUES (5052, 3159, 'Сахалин');
INSERT INTO `regions` VALUES (5080, 3159, 'Свердловская обл.');
INSERT INTO `regions` VALUES (5151, 3159, 'Северная Осетия');
INSERT INTO `regions` VALUES (5161, 3159, 'Смоленская обл.');
INSERT INTO `regions` VALUES (5191, 3159, 'Ставропольский край');
INSERT INTO `regions` VALUES (28180601, 3159, 'Таймырский (Долгано-Ненецкий) АО');
INSERT INTO `regions` VALUES (5225, 3159, 'Тамбовская обл.');
INSERT INTO `regions` VALUES (5246, 3159, 'Татарстан');
INSERT INTO `regions` VALUES (3784, 3159, 'Тверская обл.');
INSERT INTO `regions` VALUES (5291, 3159, 'Томская обл.');
INSERT INTO `regions` VALUES (5312, 3159, 'Тува (Тувинская Респ.)');
INSERT INTO `regions` VALUES (5326, 3159, 'Тульская обл.');
INSERT INTO `regions` VALUES (5356, 3159, 'Тюменская обл. и Ханты-Мансийский АО');
INSERT INTO `regions` VALUES (5404, 3159, 'Удмуртия');
INSERT INTO `regions` VALUES (5432, 3159, 'Ульяновская обл.');
INSERT INTO `regions` VALUES (5458, 3159, 'Уральская обл.');
INSERT INTO `regions` VALUES (5473, 3159, 'Хабаровский край');
INSERT INTO `regions` VALUES (2316497, 3159, 'Хакасия');
INSERT INTO `regions` VALUES (5507, 3159, 'Челябинская обл.');
INSERT INTO `regions` VALUES (5543, 3159, 'Чечено-Ингушетия');
INSERT INTO `regions` VALUES (5555, 3159, 'Читинская обл.');
INSERT INTO `regions` VALUES (5600, 3159, 'Чувашия');
INSERT INTO `regions` VALUES (2415585, 3159, 'Чукотский АО');
INSERT INTO `regions` VALUES (5019394, 3159, 'Ямало-Ненецкий АО');
INSERT INTO `regions` VALUES (5625, 3159, 'Ярославская обл.');
INSERT INTO `regions` VALUES (24351901, 23269698, 'Руанда');
INSERT INTO `regions` VALUES (26054570, 277555, 'Alba');
INSERT INTO `regions` VALUES (26054571, 277555, 'Arad');
INSERT INTO `regions` VALUES (26054572, 277555, 'Arges');
INSERT INTO `regions` VALUES (26054573, 277555, 'Bacau');
INSERT INTO `regions` VALUES (26054574, 277555, 'Bihor');
INSERT INTO `regions` VALUES (26054575, 277555, 'Bistrita-Nasaud');
INSERT INTO `regions` VALUES (26054576, 277555, 'Botosani');
INSERT INTO `regions` VALUES (26054577, 277555, 'Braila');
INSERT INTO `regions` VALUES (26054578, 277555, 'Brasov');
INSERT INTO `regions` VALUES (26054579, 277555, 'Bucuresti');
INSERT INTO `regions` VALUES (26054580, 277555, 'Buzau');
INSERT INTO `regions` VALUES (26054609, 277555, 'Calarasi');
INSERT INTO `regions` VALUES (26054581, 277555, 'Caras-Severin');
INSERT INTO `regions` VALUES (26054582, 277555, 'Cluj');
INSERT INTO `regions` VALUES (26054583, 277555, 'Constanta');
INSERT INTO `regions` VALUES (26054584, 277555, 'Covasna');
INSERT INTO `regions` VALUES (26054585, 277555, 'Dambovita');
INSERT INTO `regions` VALUES (26054586, 277555, 'Dolj');
INSERT INTO `regions` VALUES (26054587, 277555, 'Galati');
INSERT INTO `regions` VALUES (26054610, 277555, 'Giurgiu');
INSERT INTO `regions` VALUES (26054588, 277555, 'Gorj');
INSERT INTO `regions` VALUES (26054589, 277555, 'Harghita');
INSERT INTO `regions` VALUES (26054590, 277555, 'Hunedoara');
INSERT INTO `regions` VALUES (26054591, 277555, 'Ialomita');
INSERT INTO `regions` VALUES (26054592, 277555, 'Iasi');
INSERT INTO `regions` VALUES (26054611, 277555, 'Ilfov');
INSERT INTO `regions` VALUES (26054593, 277555, 'Maramures');
INSERT INTO `regions` VALUES (26054594, 277555, 'Mehedinti');
INSERT INTO `regions` VALUES (26054595, 277555, 'Mures');
INSERT INTO `regions` VALUES (26054596, 277555, 'Neamt');
INSERT INTO `regions` VALUES (26054597, 277555, 'Olt');
INSERT INTO `regions` VALUES (26054598, 277555, 'Prahova');
INSERT INTO `regions` VALUES (26054599, 277555, 'Salaj');
INSERT INTO `regions` VALUES (26054600, 277555, 'Satu Mare');
INSERT INTO `regions` VALUES (26054601, 277555, 'Sibiu');
INSERT INTO `regions` VALUES (26054602, 277555, 'Suceava');
INSERT INTO `regions` VALUES (26054603, 277555, 'Teleorman');
INSERT INTO `regions` VALUES (26054604, 277555, 'Timis');
INSERT INTO `regions` VALUES (26054605, 277555, 'Tulcea');
INSERT INTO `regions` VALUES (26054607, 277555, 'Valcea');
INSERT INTO `regions` VALUES (26054606, 277555, 'Vaslui');
INSERT INTO `regions` VALUES (26054608, 277555, 'Vrancea');
INSERT INTO `regions` VALUES (25450117, 5681, 'Alabama');
INSERT INTO `regions` VALUES (25450116, 5681, 'Alaska');
INSERT INTO `regions` VALUES (25450120, 5681, 'American Samoa');
INSERT INTO `regions` VALUES (25450121, 5681, 'Arizona');
INSERT INTO `regions` VALUES (25450119, 5681, 'Arkansas');
INSERT INTO `regions` VALUES (25450114, 5681, 'Armed Forces Americas');
INSERT INTO `regions` VALUES (25450115, 5681, 'Armed Forces Europe');
INSERT INTO `regions` VALUES (25450118, 5681, 'Armed Forces Pacific');
INSERT INTO `regions` VALUES (25450122, 5681, 'California');
INSERT INTO `regions` VALUES (25450123, 5681, 'Colorado');
INSERT INTO `regions` VALUES (25450124, 5681, 'Connecticut');
INSERT INTO `regions` VALUES (25450126, 5681, 'Delaware');
INSERT INTO `regions` VALUES (25450125, 5681, 'District of Columbia');
INSERT INTO `regions` VALUES (25450128, 5681, 'Federated States of Micronesia');
INSERT INTO `regions` VALUES (25450127, 5681, 'Florida');
INSERT INTO `regions` VALUES (25450129, 5681, 'Georgia');
INSERT INTO `regions` VALUES (25450130, 5681, 'Guam');
INSERT INTO `regions` VALUES (25450131, 5681, 'Hawaii');
INSERT INTO `regions` VALUES (25450133, 5681, 'Idaho');
INSERT INTO `regions` VALUES (25450134, 5681, 'Illinois');
INSERT INTO `regions` VALUES (25450135, 5681, 'Indiana');
INSERT INTO `regions` VALUES (25450132, 5681, 'Iowa');
INSERT INTO `regions` VALUES (25450136, 5681, 'Kansas');
INSERT INTO `regions` VALUES (25450137, 5681, 'Kentucky');
INSERT INTO `regions` VALUES (25450138, 5681, 'Louisiana');
INSERT INTO `regions` VALUES (25450141, 5681, 'Maine');
INSERT INTO `regions` VALUES (25450142, 5681, 'Marshall Islands');
INSERT INTO `regions` VALUES (25450140, 5681, 'Maryland');
INSERT INTO `regions` VALUES (25450139, 5681, 'Massachusetts');
INSERT INTO `regions` VALUES (25450143, 5681, 'Michigan');
INSERT INTO `regions` VALUES (25450144, 5681, 'Minnesota');
INSERT INTO `regions` VALUES (25450147, 5681, 'Mississippi');
INSERT INTO `regions` VALUES (25450145, 5681, 'Missouri');
INSERT INTO `regions` VALUES (25450148, 5681, 'Montana');
INSERT INTO `regions` VALUES (25450151, 5681, 'Nebraska');
INSERT INTO `regions` VALUES (25450156, 5681, 'Nevada');
INSERT INTO `regions` VALUES (25450152, 5681, 'New Hampshire');
INSERT INTO `regions` VALUES (25450153, 5681, 'New Jersey');
INSERT INTO `regions` VALUES (25450154, 5681, 'New Mexico');
INSERT INTO `regions` VALUES (25450157, 5681, 'New York');
INSERT INTO `regions` VALUES (25450149, 5681, 'North Carolina');
INSERT INTO `regions` VALUES (25450150, 5681, 'North Dakota');
INSERT INTO `regions` VALUES (25450146, 5681, 'Northern Mariana Islands');
INSERT INTO `regions` VALUES (25450158, 5681, 'Ohio');
INSERT INTO `regions` VALUES (25450159, 5681, 'Oklahoma');
INSERT INTO `regions` VALUES (25450160, 5681, 'Oregon');
INSERT INTO `regions` VALUES (25450163, 5681, 'Palau');
INSERT INTO `regions` VALUES (25450161, 5681, 'Pennsylvania');
INSERT INTO `regions` VALUES (25450164, 5681, 'Rhode Island');
INSERT INTO `regions` VALUES (25450165, 5681, 'South Carolina');
INSERT INTO `regions` VALUES (25450166, 5681, 'South Dakota');
INSERT INTO `regions` VALUES (25450167, 5681, 'Tennessee');
INSERT INTO `regions` VALUES (25450168, 5681, 'Texas');
INSERT INTO `regions` VALUES (25450169, 5681, 'Utah');
INSERT INTO `regions` VALUES (25450172, 5681, 'Vermont');
INSERT INTO `regions` VALUES (25450171, 5681, 'Virgin Islands');
INSERT INTO `regions` VALUES (25450170, 5681, 'Virginia');
INSERT INTO `regions` VALUES (25450173, 5681, 'Washington');
INSERT INTO `regions` VALUES (25450174, 5681, 'West Virginia');
INSERT INTO `regions` VALUES (25450175, 5681, 'Wisconsin');
INSERT INTO `regions` VALUES (25450176, 5681, 'Wyoming');
INSERT INTO `regions` VALUES (5648, 5647, 'Ahuachapan');
INSERT INTO `regions` VALUES (5650, 5647, 'Cuscatlan');
INSERT INTO `regions` VALUES (5652, 5647, 'La Libertad');
INSERT INTO `regions` VALUES (5654, 5647, 'La Paz');
INSERT INTO `regions` VALUES (5656, 5647, 'La Union');
INSERT INTO `regions` VALUES (5658, 5647, 'San Miguel');
INSERT INTO `regions` VALUES (5660, 5647, 'San Salvador');
INSERT INTO `regions` VALUES (5662, 5647, 'Santa Ana');
INSERT INTO `regions` VALUES (5664, 5647, 'Sonsonate');
INSERT INTO `regions` VALUES (24349816, 23269704, 'Самоа');
INSERT INTO `regions` VALUES (26078979, 23269705, 'Acquaviva');
INSERT INTO `regions` VALUES (26078985, 23269705, 'Borgo Maggiore');
INSERT INTO `regions` VALUES (26078980, 23269705, 'Chiesanuova');
INSERT INTO `regions` VALUES (26078981, 23269705, 'Domagnano');
INSERT INTO `regions` VALUES (26078983, 23269705, 'Faetano');
INSERT INTO `regions` VALUES (26078984, 23269705, 'Fiorentino');
INSERT INTO `regions` VALUES (26078987, 23269705, 'Monte Giardino');
INSERT INTO `regions` VALUES (26078986, 23269705, 'San Marino');
INSERT INTO `regions` VALUES (26078988, 23269705, 'Serravalle');
INSERT INTO `regions` VALUES (26342943, 23269706, 'Сан-Томе');
INSERT INTO `regions` VALUES (24351947, 582048, 'Саудовская Аравия');
INSERT INTO `regions` VALUES (24352083, 23269715, 'Свазиленд');
INSERT INTO `regions` VALUES (26341136, 23269701, 'Кастри');
INSERT INTO `regions` VALUES (26340829, 23269699, 'Джеймстаун');
INSERT INTO `regions` VALUES (6453632, 582040, 'Korea');
INSERT INTO `regions` VALUES (26337705, 582071, 'Сейшеллы');
INSERT INTO `regions` VALUES (26342655, 23269702, 'Сен-Пьер');
INSERT INTO `regions` VALUES (26337840, 582110, 'Сенегал');
INSERT INTO `regions` VALUES (26341044, 23269700, 'Бастер');
INSERT INTO `regions` VALUES (26342892, 23269703, 'Кингстаун');
INSERT INTO `regions` VALUES (26343066, 23269707, 'Белград');
INSERT INTO `regions` VALUES (277566, 277565, 'Сингапур');
INSERT INTO `regions` VALUES (1923301, 582067, 'Дамаск');
INSERT INTO `regions` VALUES (26079155, 5666, 'Banska Bystrica');
INSERT INTO `regions` VALUES (26079156, 5666, 'Bratislava');
INSERT INTO `regions` VALUES (26079157, 5666, 'Kosice');
INSERT INTO `regions` VALUES (26079158, 5666, 'Nitra');
INSERT INTO `regions` VALUES (26079159, 5666, 'Presov');
INSERT INTO `regions` VALUES (26079160, 5666, 'Trencin');
INSERT INTO `regions` VALUES (26079161, 5666, 'Trnava');
INSERT INTO `regions` VALUES (26079162, 5666, 'Zilina');
INSERT INTO `regions` VALUES (26086117, 5673, 'Ajdovscina');
INSERT INTO `regions` VALUES (26086118, 5673, 'Beltinci');
INSERT INTO `regions` VALUES (26086120, 5673, 'Bled');
INSERT INTO `regions` VALUES (26086121, 5673, 'Bohinj');
INSERT INTO `regions` VALUES (26086123, 5673, 'Borovnica');
INSERT INTO `regions` VALUES (26086124, 5673, 'Bovec');
INSERT INTO `regions` VALUES (26086125, 5673, 'Brda');
INSERT INTO `regions` VALUES (26086126, 5673, 'Brezice');
INSERT INTO `regions` VALUES (26086127, 5673, 'Brezovica');
INSERT INTO `regions` VALUES (26086128, 5673, 'Celje');
INSERT INTO `regions` VALUES (26086129, 5673, 'Cerklje na Gorenjskem');
INSERT INTO `regions` VALUES (26086130, 5673, 'Cerknica');
INSERT INTO `regions` VALUES (26086131, 5673, 'Cerkno');
INSERT INTO `regions` VALUES (26086133, 5673, 'Crensovci');
INSERT INTO `regions` VALUES (26086134, 5673, 'Crna na Koroskem');
INSERT INTO `regions` VALUES (26086135, 5673, 'Crnomelj');
INSERT INTO `regions` VALUES (26086136, 5673, 'Divaca');
INSERT INTO `regions` VALUES (26086137, 5673, 'Dobrepolje');
INSERT INTO `regions` VALUES (26086243, 5673, 'Dobrova-Horjul-Polhov Gradec');
INSERT INTO `regions` VALUES (26086138, 5673, 'Dol pri Ljubljani');
INSERT INTO `regions` VALUES (26086244, 5673, 'Domzale');
INSERT INTO `regions` VALUES (26086139, 5673, 'Dornava');
INSERT INTO `regions` VALUES (26086140, 5673, 'Dravograd');
INSERT INTO `regions` VALUES (26086141, 5673, 'Duplek');
INSERT INTO `regions` VALUES (26086142, 5673, 'Gorenja Vas-Poljane');
INSERT INTO `regions` VALUES (26086143, 5673, 'Gorisnica');
INSERT INTO `regions` VALUES (26086144, 5673, 'Gornja Radgona');
INSERT INTO `regions` VALUES (26086145, 5673, 'Gornji Grad');
INSERT INTO `regions` VALUES (26086146, 5673, 'Gornji Petrovci');
INSERT INTO `regions` VALUES (26086147, 5673, 'Grosuplje');
INSERT INTO `regions` VALUES (26086148, 5673, 'Hrastnik');
INSERT INTO `regions` VALUES (26086149, 5673, 'Hrpelje-Kozina');
INSERT INTO `regions` VALUES (26086150, 5673, 'Idrija');
INSERT INTO `regions` VALUES (26086151, 5673, 'Ig');
INSERT INTO `regions` VALUES (26086152, 5673, 'Ilirska Bistrica');
INSERT INTO `regions` VALUES (26086153, 5673, 'Ivancna Gorica');
INSERT INTO `regions` VALUES (26086154, 5673, 'Izola-Isola');
INSERT INTO `regions` VALUES (26086245, 5673, 'Jesenice');
INSERT INTO `regions` VALUES (26086155, 5673, 'Jursinci');
INSERT INTO `regions` VALUES (26086246, 5673, 'Kamnik');
INSERT INTO `regions` VALUES (26086156, 5673, 'Kanal');
INSERT INTO `regions` VALUES (26086157, 5673, 'Kidricevo');
INSERT INTO `regions` VALUES (26086158, 5673, 'Kobarid');
INSERT INTO `regions` VALUES (26086159, 5673, 'Kobilje');
INSERT INTO `regions` VALUES (26086247, 5673, 'Kocevje');
INSERT INTO `regions` VALUES (26086160, 5673, 'Komen');
INSERT INTO `regions` VALUES (26086161, 5673, 'Koper-Capodistria');
INSERT INTO `regions` VALUES (26086162, 5673, 'Kozje');
INSERT INTO `regions` VALUES (26086163, 5673, 'Kranj');
INSERT INTO `regions` VALUES (26086164, 5673, 'Kranjska Gora');
INSERT INTO `regions` VALUES (26086165, 5673, 'Krsko');
INSERT INTO `regions` VALUES (26086166, 5673, 'Kungota');
INSERT INTO `regions` VALUES (26086248, 5673, 'Kuzma');
INSERT INTO `regions` VALUES (26086167, 5673, 'Lasko');
INSERT INTO `regions` VALUES (26086249, 5673, 'Lenart');
INSERT INTO `regions` VALUES (26086250, 5673, 'Litija');
INSERT INTO `regions` VALUES (26086168, 5673, 'Ljubljana');
INSERT INTO `regions` VALUES (26086169, 5673, 'Ljubno');
INSERT INTO `regions` VALUES (26086251, 5673, 'Ljutomer');
INSERT INTO `regions` VALUES (26086170, 5673, 'Logatec');
INSERT INTO `regions` VALUES (26086252, 5673, 'Loska Dolina');
INSERT INTO `regions` VALUES (26086171, 5673, 'Loski Potok');
INSERT INTO `regions` VALUES (26086253, 5673, 'Luce');
INSERT INTO `regions` VALUES (26086172, 5673, 'Lukovica');
INSERT INTO `regions` VALUES (26086254, 5673, 'Majsperk');
INSERT INTO `regions` VALUES (26086255, 5673, 'Maribor');
INSERT INTO `regions` VALUES (26086173, 5673, 'Medvode');
INSERT INTO `regions` VALUES (26086174, 5673, 'Menges');
INSERT INTO `regions` VALUES (26086175, 5673, 'Metlika');
INSERT INTO `regions` VALUES (26086176, 5673, 'Mezica');
INSERT INTO `regions` VALUES (26086256, 5673, 'Miren-Kostanjevica');
INSERT INTO `regions` VALUES (26086177, 5673, 'Mislinja');
INSERT INTO `regions` VALUES (26086178, 5673, 'Moravce');
INSERT INTO `regions` VALUES (26086179, 5673, 'Moravske Toplice');
INSERT INTO `regions` VALUES (26086180, 5673, 'Mozirje');
INSERT INTO `regions` VALUES (26086181, 5673, 'Murska Sobota');
INSERT INTO `regions` VALUES (26086182, 5673, 'Muta');
INSERT INTO `regions` VALUES (26086183, 5673, 'Naklo');
INSERT INTO `regions` VALUES (26086184, 5673, 'Nazarje');
INSERT INTO `regions` VALUES (26086185, 5673, 'Nova Gorica');
INSERT INTO `regions` VALUES (26086257, 5673, 'Novo Mesto');
INSERT INTO `regions` VALUES (26086186, 5673, 'Odranci');
INSERT INTO `regions` VALUES (26086187, 5673, 'Ormoz');
INSERT INTO `regions` VALUES (26086188, 5673, 'Osilnica');
INSERT INTO `regions` VALUES (26086189, 5673, 'Pesnica');
INSERT INTO `regions` VALUES (26086258, 5673, 'Piran');
INSERT INTO `regions` VALUES (26086190, 5673, 'Pivka');
INSERT INTO `regions` VALUES (26086191, 5673, 'Podcetrtek');
INSERT INTO `regions` VALUES (26086192, 5673, 'Postojna');
INSERT INTO `regions` VALUES (26086259, 5673, 'Preddvor');
INSERT INTO `regions` VALUES (26086260, 5673, 'Ptuj');
INSERT INTO `regions` VALUES (26086193, 5673, 'Puconci');
INSERT INTO `regions` VALUES (26086194, 5673, 'Racam');
INSERT INTO `regions` VALUES (26086195, 5673, 'Radece');
INSERT INTO `regions` VALUES (26086196, 5673, 'Radenci');
INSERT INTO `regions` VALUES (26086197, 5673, 'Radlje ob Dravi');
INSERT INTO `regions` VALUES (26086198, 5673, 'Radovljica');
INSERT INTO `regions` VALUES (26086261, 5673, 'Ribnica');
INSERT INTO `regions` VALUES (26086201, 5673, 'Rogaska Slatina');
INSERT INTO `regions` VALUES (26086199, 5673, 'Rogasovci');
INSERT INTO `regions` VALUES (26086202, 5673, 'Rogatec');
INSERT INTO `regions` VALUES (26086262, 5673, 'Ruse');
INSERT INTO `regions` VALUES (26086203, 5673, 'Semic');
INSERT INTO `regions` VALUES (26086204, 5673, 'Sencur');
INSERT INTO `regions` VALUES (26086206, 5673, 'Sentilj');
INSERT INTO `regions` VALUES (26086207, 5673, 'Sentjernej');
INSERT INTO `regions` VALUES (26086263, 5673, 'Sentjur pri Celju');
INSERT INTO `regions` VALUES (26086208, 5673, 'Sevnica');
INSERT INTO `regions` VALUES (26086209, 5673, 'Sezana');
INSERT INTO `regions` VALUES (26086210, 5673, 'Skocjan');
INSERT INTO `regions` VALUES (26086212, 5673, 'Skofja Loka');
INSERT INTO `regions` VALUES (26086214, 5673, 'Skofljica');
INSERT INTO `regions` VALUES (26086216, 5673, 'Slovenj Gradec');
INSERT INTO `regions` VALUES (26086264, 5673, 'Slovenska Bistrica');
INSERT INTO `regions` VALUES (26086218, 5673, 'Slovenske Konjice');
INSERT INTO `regions` VALUES (26086219, 5673, 'Smarje pri Jelsah');
INSERT INTO `regions` VALUES (26086221, 5673, 'Smartno ob Paki');
INSERT INTO `regions` VALUES (26086222, 5673, 'Sostanj');
INSERT INTO `regions` VALUES (26086223, 5673, 'Starse');
INSERT INTO `regions` VALUES (26086224, 5673, 'Store');
INSERT INTO `regions` VALUES (26086225, 5673, 'Sveti Jurij');
INSERT INTO `regions` VALUES (26086226, 5673, 'Tolmin');
INSERT INTO `regions` VALUES (26086227, 5673, 'Trbovlje');
INSERT INTO `regions` VALUES (26086228, 5673, 'Trebnje');
INSERT INTO `regions` VALUES (26086229, 5673, 'Trzic');
INSERT INTO `regions` VALUES (26086230, 5673, 'Turnisce');
INSERT INTO `regions` VALUES (26086231, 5673, 'Velenje');
INSERT INTO `regions` VALUES (26086232, 5673, 'Velike Lasce');
INSERT INTO `regions` VALUES (26086265, 5673, 'Videm');
INSERT INTO `regions` VALUES (26086233, 5673, 'Vipava');
INSERT INTO `regions` VALUES (26086234, 5673, 'Vitanje');
INSERT INTO `regions` VALUES (26086235, 5673, 'Vodice');
INSERT INTO `regions` VALUES (26086266, 5673, 'Vojnik');
INSERT INTO `regions` VALUES (26086236, 5673, 'Vrhnika');
INSERT INTO `regions` VALUES (26086237, 5673, 'Vuzenica');
INSERT INTO `regions` VALUES (26086238, 5673, 'Zagorje ob Savi');
INSERT INTO `regions` VALUES (26086267, 5673, 'Zalec');
INSERT INTO `regions` VALUES (26086239, 5673, 'Zavrc');
INSERT INTO `regions` VALUES (26086240, 5673, 'Zelezniki');
INSERT INTO `regions` VALUES (26086241, 5673, 'Ziri');
INSERT INTO `regions` VALUES (26086242, 5673, 'Zrece');
INSERT INTO `regions` VALUES (24349723, 23269709, 'Соломоновы о-ва');
INSERT INTO `regions` VALUES (26343406, 23269710, 'Могадишо');
INSERT INTO `regions` VALUES (24352028, 23269713, 'Судан');
INSERT INTO `regions` VALUES (5679, 5678, 'Paramaribo');
INSERT INTO `regions` VALUES (26343133, 23269708, 'Фритаун');
INSERT INTO `regions` VALUES (9576, 9575, 'Горно-Бадахшанская обл.');
INSERT INTO `regions` VALUES (9589, 9575, 'Кулябская обл.');
INSERT INTO `regions` VALUES (9596, 9575, 'Курган-Тюбинская обл.');
INSERT INTO `regions` VALUES (9605, 9575, 'Согдийская обл.');
INSERT INTO `regions` VALUES (9627, 9575, 'Таджикистан');
INSERT INTO `regions` VALUES (6128546, 582050, 'Тайланд');
INSERT INTO `regions` VALUES (90194551, 582050, 'Чон Бури');
INSERT INTO `regions` VALUES (277568, 277567, 'Тайвань');
INSERT INTO `regions` VALUES (24352137, 582062, 'Танзания');
INSERT INTO `regions` VALUES (24349189, 582112, 'Того');
INSERT INTO `regions` VALUES (26343634, 23269716, 'Факаофо');
INSERT INTO `regions` VALUES (24352168, 23269717, 'Тонга');
INSERT INTO `regions` VALUES (26344093, 23269718, 'Порт-оф-Спейн');
INSERT INTO `regions` VALUES (24352186, 23269720, 'Тувалу');
INSERT INTO `regions` VALUES (5640862, 582090, 'Tunisia');
INSERT INTO `regions` VALUES (9639, 9638, 'Ашхабадская обл.');
INSERT INTO `regions` VALUES (9653, 9638, 'Красноводская обл.');
INSERT INTO `regions` VALUES (9670, 9638, 'Марыйская обл.');
INSERT INTO `regions` VALUES (9682, 9638, 'Ташаузская обл.');
INSERT INTO `regions` VALUES (9685, 9638, 'Чарджоуская обл.');
INSERT INTO `regions` VALUES (9702, 9701, 'Grand Turk');
INSERT INTO `regions` VALUES (9706, 9705, 'Bartin');
INSERT INTO `regions` VALUES (9708, 9705, 'Bayburt');
INSERT INTO `regions` VALUES (9710, 9705, 'Karabuk');
INSERT INTO `regions` VALUES (9712, 9705, 'Адана');
INSERT INTO `regions` VALUES (9714, 9705, 'Айдын');
INSERT INTO `regions` VALUES (9716, 9705, 'Амасья');
INSERT INTO `regions` VALUES (9718, 9705, 'Анкара');
INSERT INTO `regions` VALUES (9720, 9705, 'Анталья');
INSERT INTO `regions` VALUES (9722, 9705, 'Артвин');
INSERT INTO `regions` VALUES (9724, 9705, 'Афьон');
INSERT INTO `regions` VALUES (9726, 9705, 'Балыкесир');
INSERT INTO `regions` VALUES (9728, 9705, 'Биледжик');
INSERT INTO `regions` VALUES (9730, 9705, 'Бурса');
INSERT INTO `regions` VALUES (9732, 9705, 'Газиантеп');
INSERT INTO `regions` VALUES (9734, 9705, 'Денизли');
INSERT INTO `regions` VALUES (9736, 9705, 'Измир');
INSERT INTO `regions` VALUES (9738, 9705, 'Испарта');
INSERT INTO `regions` VALUES (9740, 9705, 'Ичель');
INSERT INTO `regions` VALUES (9742, 9705, 'Кайсери');
INSERT INTO `regions` VALUES (9744, 9705, 'Карс');
INSERT INTO `regions` VALUES (9746, 9705, 'Коджаэли');
INSERT INTO `regions` VALUES (9749, 9705, 'Конья');
INSERT INTO `regions` VALUES (9751, 9705, 'Кыркларели');
INSERT INTO `regions` VALUES (9753, 9705, 'Кютахья');
INSERT INTO `regions` VALUES (9755, 9705, 'Малатья');
INSERT INTO `regions` VALUES (9757, 9705, 'Маниса');
INSERT INTO `regions` VALUES (9759, 9705, 'Сакарья');
INSERT INTO `regions` VALUES (9761, 9705, 'Самсун');
INSERT INTO `regions` VALUES (9763, 9705, 'Сивас');
INSERT INTO `regions` VALUES (9765, 9705, 'Стамбул');
INSERT INTO `regions` VALUES (9767, 9705, 'Трабзон');
INSERT INTO `regions` VALUES (9770, 9705, 'Чорум');
INSERT INTO `regions` VALUES (9772, 9705, 'Эдирне');
INSERT INTO `regions` VALUES (9774, 9705, 'Элязыг');
INSERT INTO `regions` VALUES (9776, 9705, 'Эрзинджан');
INSERT INTO `regions` VALUES (9778, 9705, 'Эрзурум');
INSERT INTO `regions` VALUES (9780, 9705, 'Эскишехир');
INSERT INTO `regions` VALUES (9783, 9782, 'Jinja');
INSERT INTO `regions` VALUES (9785, 9782, 'Kampala');
INSERT INTO `regions` VALUES (9788, 9787, 'Андижанская обл.');
INSERT INTO `regions` VALUES (9796, 9787, 'Бухарская обл.');
INSERT INTO `regions` VALUES (9806, 9787, 'Джизакская обл.');
INSERT INTO `regions` VALUES (9813, 9787, 'Каракалпакия');
INSERT INTO `regions` VALUES (9825, 9787, 'Кашкадарьинская обл.');
INSERT INTO `regions` VALUES (9832, 9787, 'Навоийская обл.');
INSERT INTO `regions` VALUES (9836, 9787, 'Наманганская обл.');
INSERT INTO `regions` VALUES (9844, 9787, 'Самаркандская обл.');
INSERT INTO `regions` VALUES (9851, 9787, 'Сурхандарьинская обл.');
INSERT INTO `regions` VALUES (9859, 9787, 'Сырдарьинская обл.');
INSERT INTO `regions` VALUES (9869, 9787, 'Ташкентская обл.');
INSERT INTO `regions` VALUES (9892, 9787, 'Ферганская обл.');
INSERT INTO `regions` VALUES (9905, 9787, 'Хорезмская обл.');
INSERT INTO `regions` VALUES (9909, 9908, 'Винницкая обл.');
INSERT INTO `regions` VALUES (9943, 9908, 'Волынская обл.');
INSERT INTO `regions` VALUES (9964, 9908, 'Днепропетровская обл.');
INSERT INTO `regions` VALUES (10002, 9908, 'Донецкая обл.');
INSERT INTO `regions` VALUES (10061, 9908, 'Житомирская обл.');
INSERT INTO `regions` VALUES (10094, 9908, 'Закарпатская обл.');
INSERT INTO `regions` VALUES (10111, 9908, 'Запорожская обл.');
INSERT INTO `regions` VALUES (10133, 9908, 'Ивано-Франковская обл.');
INSERT INTO `regions` VALUES (10165, 9908, 'Киевская обл.');
INSERT INTO `regions` VALUES (10201, 9908, 'Кировоградская обл.');
INSERT INTO `regions` VALUES (10227, 9908, 'Крымская обл.');
INSERT INTO `regions` VALUES (10259, 9908, 'Луганская обл.');
INSERT INTO `regions` VALUES (10318, 9908, 'Львовская обл.');
INSERT INTO `regions` VALUES (10354, 9908, 'Николаевская обл.');
INSERT INTO `regions` VALUES (10373, 9908, 'Одесская обл.');
INSERT INTO `regions` VALUES (10407, 9908, 'Полтавская обл.');
INSERT INTO `regions` VALUES (10437, 9908, 'Ровенская обл.');
INSERT INTO `regions` VALUES (10455, 9908, 'Сумская обл.');
INSERT INTO `regions` VALUES (10480, 9908, 'Тернопольская обл.');
INSERT INTO `regions` VALUES (277656, 9908, 'Украина');
INSERT INTO `regions` VALUES (10504, 9908, 'Харьковская обл.');
INSERT INTO `regions` VALUES (10535, 9908, 'Херсонская обл.');
INSERT INTO `regions` VALUES (10559, 9908, 'Хмельницкая обл.');
INSERT INTO `regions` VALUES (10583, 9908, 'Черкасская обл.');
INSERT INTO `regions` VALUES (10607, 9908, 'Черниговская обл.');
INSERT INTO `regions` VALUES (10633, 9908, 'Черновицкая обл.');
INSERT INTO `regions` VALUES (26420530, 582075, 'Artigas');
INSERT INTO `regions` VALUES (26420531, 582075, 'Canelones');
INSERT INTO `regions` VALUES (26420532, 582075, 'Cerro Largo');
INSERT INTO `regions` VALUES (26420533, 582075, 'Colonia');
INSERT INTO `regions` VALUES (26420534, 582075, 'Durazno');
INSERT INTO `regions` VALUES (26420535, 582075, 'Flores');
INSERT INTO `regions` VALUES (26420536, 582075, 'Florida');
INSERT INTO `regions` VALUES (26420537, 582075, 'Lavalleja');
INSERT INTO `regions` VALUES (26420538, 582075, 'Maldonado');
INSERT INTO `regions` VALUES (26420539, 582075, 'Montevideo');
INSERT INTO `regions` VALUES (26420540, 582075, 'Paysand&#250;');
INSERT INTO `regions` VALUES (26420542, 582075, 'Rivera');
INSERT INTO `regions` VALUES (26420543, 582075, 'Rocha');
INSERT INTO `regions` VALUES (26420541, 582075, 'R&#237;o Negro');
INSERT INTO `regions` VALUES (26420544, 582075, 'Salto');
INSERT INTO `regions` VALUES (26420545, 582075, 'San Jos&#233;');
INSERT INTO `regions` VALUES (26420546, 582075, 'Soriano');
INSERT INTO `regions` VALUES (26420547, 582075, 'Tacuaremb&#243;');
INSERT INTO `regions` VALUES (26420548, 582075, 'Treinta y Tres');
INSERT INTO `regions` VALUES (26338287, 23269656, 'Торсхавн');
INSERT INTO `regions` VALUES (24349779, 23269657, 'Фиджи');
INSERT INTO `regions` VALUES (24349603, 582047, 'Филиппины');
INSERT INTO `regions` VALUES (25802550, 10648, 'Eastern Finland');
INSERT INTO `regions` VALUES (25802547, 10648, 'Lapland');
INSERT INTO `regions` VALUES (25802548, 10648, 'Oulu');
INSERT INTO `regions` VALUES (25802549, 10648, 'Southern Finland');
INSERT INTO `regions` VALUES (25802551, 10648, 'Western Finland');
INSERT INTO `regions` VALUES (25802546, 10648, '&#208;•land');
INSERT INTO `regions` VALUES (23600843, 10668, 'Ain');
INSERT INTO `regions` VALUES (23600845, 10668, 'Aisne');
INSERT INTO `regions` VALUES (23600846, 10668, 'Allier');
INSERT INTO `regions` VALUES (23600849, 10668, 'Alpes-Maritimes');
INSERT INTO `regions` VALUES (23600847, 10668, 'Alpes-de-Haute-Provence');
INSERT INTO `regions` VALUES (23600851, 10668, 'Ardennes');
INSERT INTO `regions` VALUES (23600850, 10668, 'Ard&#232;che');
INSERT INTO `regions` VALUES (23600852, 10668, 'Ari&#232;ge');
INSERT INTO `regions` VALUES (23600853, 10668, 'Aube');
INSERT INTO `regions` VALUES (23600854, 10668, 'Aude');
INSERT INTO `regions` VALUES (23600855, 10668, 'Aveyron');
INSERT INTO `regions` VALUES (23600915, 10668, 'Bas Rhin');
INSERT INTO `regions` VALUES (23600856, 10668, 'Bouches-du-Rh&#244;ne');
INSERT INTO `regions` VALUES (23600857, 10668, 'Calvados');
INSERT INTO `regions` VALUES (23600858, 10668, 'Cantal');
INSERT INTO `regions` VALUES (23600859, 10668, 'Charente');
INSERT INTO `regions` VALUES (23600861, 10668, 'Charente Maritime');
INSERT INTO `regions` VALUES (23600863, 10668, 'Cher');
INSERT INTO `regions` VALUES (23600864, 10668, 'Corr&#232;ze');
INSERT INTO `regions` VALUES (23600866, 10668, 'Corse');
INSERT INTO `regions` VALUES (23600870, 10668, 'Creuse');
INSERT INTO `regions` VALUES (23600924, 10668, 'Deux-S&#232;vres');
INSERT INTO `regions` VALUES (23600865, 10668, 'Dordogne');
INSERT INTO `regions` VALUES (23600871, 10668, 'Doubs');
INSERT INTO `regions` VALUES (23600872, 10668, 'Dr&#244;me');
INSERT INTO `regions` VALUES (23600936, 10668, 'Essone');
INSERT INTO `regions` VALUES (23600873, 10668, 'Eure');
INSERT INTO `regions` VALUES (23600874, 10668, 'Eure-et-Loire');
INSERT INTO `regions` VALUES (23600875, 10668, 'Finist&#232;re');
INSERT INTO `regions` VALUES (23600876, 10668, 'Gard');
INSERT INTO `regions` VALUES (23600878, 10668, 'Gers');
INSERT INTO `regions` VALUES (23600879, 10668, 'Gironde');
INSERT INTO `regions` VALUES (23600916, 10668, 'Haut Rhin');
INSERT INTO `regions` VALUES (23600877, 10668, 'Haute-Garonne');
INSERT INTO `regions` VALUES (23600890, 10668, 'Haute-Loire');
INSERT INTO `regions` VALUES (23600900, 10668, 'Haute-Marne');
INSERT INTO `regions` VALUES (23600844, 10668, 'Haute-Savoie');
INSERT INTO `regions` VALUES (23600917, 10668, 'Haute-Sa&#244;ne');
INSERT INTO `regions` VALUES (23600932, 10668, 'Haute-Vienne');
INSERT INTO `regions` VALUES (23600848, 10668, 'Hautes-Alpes');
INSERT INTO `regions` VALUES (23600913, 10668, 'Hautes-Pyr&#233;n&#233;es');
INSERT INTO `regions` VALUES (23600937, 10668, 'Hauts-de-Seine');
INSERT INTO `regions` VALUES (23600880, 10668, 'H&#233;rault');
INSERT INTO `regions` VALUES (23600881, 10668, 'Ille et Vilaine');
INSERT INTO `regions` VALUES (23600882, 10668, 'Indre');
INSERT INTO `regions` VALUES (23600883, 10668, 'Indre-et-Loire');
INSERT INTO `regions` VALUES (23600884, 10668, 'Is&#232;re');
INSERT INTO `regions` VALUES (23600885, 10668, 'Jura');
INSERT INTO `regions` VALUES (23600886, 10668, 'Landes');
INSERT INTO `regions` VALUES (23600887, 10668, 'Loir-et-Cher');
INSERT INTO `regions` VALUES (23600888, 10668, 'Loire');
INSERT INTO `regions` VALUES (23600891, 10668, 'Loire Atlantique');
INSERT INTO `regions` VALUES (23600893, 10668, 'Loiret');
INSERT INTO `regions` VALUES (23600894, 10668, 'Lot');
INSERT INTO `regions` VALUES (23600895, 10668, 'Lot-et-Garonne');
INSERT INTO `regions` VALUES (23600896, 10668, 'Loz&#232;re');
INSERT INTO `regions` VALUES (23600897, 10668, 'Maine et Loire');
INSERT INTO `regions` VALUES (23600898, 10668, 'Manche');
INSERT INTO `regions` VALUES (23600899, 10668, 'Marne');
INSERT INTO `regions` VALUES (23600901, 10668, 'Mayenne');
INSERT INTO `regions` VALUES (23600902, 10668, 'Meurthe-et-Moselle');
INSERT INTO `regions` VALUES (23600903, 10668, 'Meuse');
INSERT INTO `regions` VALUES (23600904, 10668, 'Morbihan');
INSERT INTO `regions` VALUES (23600905, 10668, 'Moselle');
INSERT INTO `regions` VALUES (23600906, 10668, 'Ni&#232;vre');
INSERT INTO `regions` VALUES (23600907, 10668, 'Nord');
INSERT INTO `regions` VALUES (23600908, 10668, 'Oise');
INSERT INTO `regions` VALUES (23600909, 10668, 'Orne');
INSERT INTO `regions` VALUES (89736385, 10668, 'Pamandzi');
INSERT INTO `regions` VALUES (23600920, 10668, 'Paris');
INSERT INTO `regions` VALUES (23600910, 10668, 'Pas-de-Calais');
INSERT INTO `regions` VALUES (23600911, 10668, 'Puy-de-D&#244;me');
INSERT INTO `regions` VALUES (23600912, 10668, 'Pyr&#233;n&#233;es-Atlantiques');
INSERT INTO `regions` VALUES (23600914, 10668, 'Pyr&#233;n&#233;es-Orientales');
INSERT INTO `regions` VALUES (23600889, 10668, 'Rh&#244;ne');
INSERT INTO `regions` VALUES (23600918, 10668, 'Sarthe');
INSERT INTO `regions` VALUES (23600919, 10668, 'Savoie');
INSERT INTO `regions` VALUES (23600868, 10668, 'Sa&#244;ne et Loire');
INSERT INTO `regions` VALUES (23600921, 10668, 'Seine-Maritime');
INSERT INTO `regions` VALUES (23600938, 10668, 'Seine-Saint-Denis');
INSERT INTO `regions` VALUES (23600922, 10668, 'Seine-et-Marne');
INSERT INTO `regions` VALUES (23600925, 10668, 'Somme');
INSERT INTO `regions` VALUES (23600926, 10668, 'Tarn');
INSERT INTO `regions` VALUES (23600927, 10668, 'Tarn-et-Garonne');
INSERT INTO `regions` VALUES (23600935, 10668, 'Territoire de Belfort');
INSERT INTO `regions` VALUES (23600939, 10668, 'Val-de-Marne');
INSERT INTO `regions` VALUES (23600928, 10668, 'Var');
INSERT INTO `regions` VALUES (23600929, 10668, 'Vaucluse');
INSERT INTO `regions` VALUES (23600930, 10668, 'Vend&#233;e');
INSERT INTO `regions` VALUES (23600931, 10668, 'Vienne');
INSERT INTO `regions` VALUES (23600933, 10668, 'Vosges');
INSERT INTO `regions` VALUES (23600934, 10668, 'Yonne');
INSERT INTO `regions` VALUES (23600923, 10668, 'Yvelines');
INSERT INTO `regions` VALUES (65987463, 23269658, 'Caennes');
INSERT INTO `regions` VALUES (26338547, 23269659, 'Папеэте');
INSERT INTO `regions` VALUES (25943325, 277553, 'Bjelovarsko-Bilogorska');
INSERT INTO `regions` VALUES (25943326, 277553, 'Brodsko-Posavska');
INSERT INTO `regions` VALUES (25943327, 277553, 'Dubrovacko-Neretvanska');
INSERT INTO `regions` VALUES (25943345, 277553, 'Grad Zagreb');
INSERT INTO `regions` VALUES (25943328, 277553, 'Istarska');
INSERT INTO `regions` VALUES (25943329, 277553, 'Karlovacka');
INSERT INTO `regions` VALUES (25943330, 277553, 'Koprivnicko-Krizevacka');
INSERT INTO `regions` VALUES (25943331, 277553, 'Krapinsko-Zagorska');
INSERT INTO `regions` VALUES (25943332, 277553, 'Licko-Senjska');
INSERT INTO `regions` VALUES (25943333, 277553, 'Medimurska');
INSERT INTO `regions` VALUES (25943334, 277553, 'Osjecko-Baranjska');
INSERT INTO `regions` VALUES (25943335, 277553, 'Pozesko-Slavonska');
INSERT INTO `regions` VALUES (25943336, 277553, 'Primorsko-Goranska');
INSERT INTO `regions` VALUES (25943337, 277553, 'Sibensko-Kninska');
INSERT INTO `regions` VALUES (25943338, 277553, 'Sisacko-Moslavacka');
INSERT INTO `regions` VALUES (25943339, 277553, 'Splitsko-Dalmatinska');
INSERT INTO `regions` VALUES (25943340, 277553, 'Varazdinska');
INSERT INTO `regions` VALUES (25943341, 277553, 'Viroviticko-Podravska');
INSERT INTO `regions` VALUES (25943342, 277553, 'Vukovarsko-Srijemska');
INSERT INTO `regions` VALUES (25943343, 277553, 'Zadarska');
INSERT INTO `regions` VALUES (25943344, 277553, 'Zagrebacka');
INSERT INTO `regions` VALUES (24351128, 582101, 'Чад');
INSERT INTO `regions` VALUES (25826077, 10874, 'Hlavni Mesto Praha');
INSERT INTO `regions` VALUES (25826080, 10874, 'Jihocesky Kraj');
INSERT INTO `regions` VALUES (25826078, 10874, 'Jihomoravsky Kraj');
INSERT INTO `regions` VALUES (25826082, 10874, 'Karlovarsky Kraj');
INSERT INTO `regions` VALUES (25826083, 10874, 'Kralovehradecky Kraj');
INSERT INTO `regions` VALUES (25826086, 10874, 'Liberecky Kraj');
INSERT INTO `regions` VALUES (25826088, 10874, 'Moravskoslezsky Kraj');
INSERT INTO `regions` VALUES (25826087, 10874, 'Olomoucky Kraj');
INSERT INTO `regions` VALUES (25826089, 10874, 'Pardubicky Kraj');
INSERT INTO `regions` VALUES (25826090, 10874, 'Plzensky Kraj');
INSERT INTO `regions` VALUES (25826091, 10874, 'Stredocesky Kraj');
INSERT INTO `regions` VALUES (25826092, 10874, 'Ustecky Kraj');
INSERT INTO `regions` VALUES (25826081, 10874, 'Vysocina');
INSERT INTO `regions` VALUES (25826094, 10874, 'Zlinsky Kraj');
INSERT INTO `regions` VALUES (26421824, 582031, 'Ais&#233;n del General Carlos Ib&#225;nez del Campo');
INSERT INTO `regions` VALUES (26421825, 582031, 'Antofagasta');
INSERT INTO `regions` VALUES (26421826, 582031, 'Araucan&#237;a');
INSERT INTO `regions` VALUES (26421827, 582031, 'Atacama');
INSERT INTO `regions` VALUES (26421830, 582031, 'B&#237;o-B&#237;o');
INSERT INTO `regions` VALUES (26421834, 582031, 'Coquimbo');
INSERT INTO `regions` VALUES (26421836, 582031, 'Los Lagos');
INSERT INTO `regions` VALUES (26421837, 582031, 'Magallanes y de la Ant&#225;rtica Chilena');
INSERT INTO `regions` VALUES (26421838, 582031, 'Maule');
INSERT INTO `regions` VALUES (26421839, 582031, 'Region Metropolitana');
INSERT INTO `regions` VALUES (26421840, 582031, 'Tarapac&#225;');
INSERT INTO `regions` VALUES (26421823, 582031, 'Valpara&#237;so');
INSERT INTO `regions` VALUES (24450728, 10904, 'Aargau');
INSERT INTO `regions` VALUES (24450730, 10904, 'Appenzell Ausserrhoden');
INSERT INTO `regions` VALUES (24450729, 10904, 'Appenzell Innerrhoden');
INSERT INTO `regions` VALUES (24450732, 10904, 'Basel-Landschaft');
INSERT INTO `regions` VALUES (24450733, 10904, 'Basel-Stadt');
INSERT INTO `regions` VALUES (24450731, 10904, 'Bern');
INSERT INTO `regions` VALUES (24450734, 10904, 'Fribourg');
INSERT INTO `regions` VALUES (24450735, 10904, 'Gen&#232;ve');
INSERT INTO `regions` VALUES (24450736, 10904, 'Glarus');
INSERT INTO `regions` VALUES (24450737, 10904, 'Graub&#252;nden');
INSERT INTO `regions` VALUES (24450738, 10904, 'Jura');
INSERT INTO `regions` VALUES (24450739, 10904, 'Luzern');
INSERT INTO `regions` VALUES (24450740, 10904, 'Neuch&#226;tel');
INSERT INTO `regions` VALUES (24450741, 10904, 'Nidwalden');
INSERT INTO `regions` VALUES (24450742, 10904, 'Obwalden');
INSERT INTO `regions` VALUES (24450743, 10904, 'Sankt Gallen');
INSERT INTO `regions` VALUES (24450744, 10904, 'Schaffhausen');
INSERT INTO `regions` VALUES (24450746, 10904, 'Schwyz');
INSERT INTO `regions` VALUES (24450745, 10904, 'Solothurn');
INSERT INTO `regions` VALUES (58881848, 10904, 'St.Gallen');
INSERT INTO `regions` VALUES (24450747, 10904, 'Thurgau');
INSERT INTO `regions` VALUES (24450748, 10904, 'Ticino');
INSERT INTO `regions` VALUES (24450749, 10904, 'Uri');
INSERT INTO `regions` VALUES (24450751, 10904, 'Valais');
INSERT INTO `regions` VALUES (24450750, 10904, 'Vaud');
INSERT INTO `regions` VALUES (24450752, 10904, 'Zug');
INSERT INTO `regions` VALUES (24450753, 10904, 'Z&#252;rich');
INSERT INTO `regions` VALUES (25758719, 10933, 'Alvsborgs Lan');
INSERT INTO `regions` VALUES (25758720, 10933, 'Blekinge Lan');
INSERT INTO `regions` VALUES (25758728, 10933, 'Dalarnas Lan');
INSERT INTO `regions` VALUES (25758721, 10933, 'Gavleborgs Lan');
INSERT INTO `regions` VALUES (25758722, 10933, 'Goteborgs och Bohus Lan');
INSERT INTO `regions` VALUES (25758723, 10933, 'Gotlands Lan');
INSERT INTO `regions` VALUES (25758724, 10933, 'Hallands Lan');
INSERT INTO `regions` VALUES (25758725, 10933, 'Jamtlands Lan');
INSERT INTO `regions` VALUES (25758726, 10933, 'Jonkopings Lan');
INSERT INTO `regions` VALUES (25758727, 10933, 'Kalmar Lan');
INSERT INTO `regions` VALUES (25758729, 10933, 'Kristianstads Lan');
INSERT INTO `regions` VALUES (25758730, 10933, 'Kronobergs Lan');
INSERT INTO `regions` VALUES (25758731, 10933, 'Malmohus Lan');
INSERT INTO `regions` VALUES (25758732, 10933, 'Norrbottens Lan');
INSERT INTO `regions` VALUES (25758733, 10933, 'Orebro Lan');
INSERT INTO `regions` VALUES (25758734, 10933, 'Ostergotlands Lan');
INSERT INTO `regions` VALUES (25758743, 10933, 'Skane Lan');
INSERT INTO `regions` VALUES (25758735, 10933, 'Skaraborgs Lan');
INSERT INTO `regions` VALUES (25758736, 10933, 'Sodermanlands Lan');
INSERT INTO `regions` VALUES (25758742, 10933, 'Stockholms Lan');
INSERT INTO `regions` VALUES (25758737, 10933, 'Uppsala Lan');
INSERT INTO `regions` VALUES (25758738, 10933, 'Varmlands Lan');
INSERT INTO `regions` VALUES (25758739, 10933, 'Vasterbottens Lan');
INSERT INTO `regions` VALUES (25758740, 10933, 'Vasternorrlands Lan');
INSERT INTO `regions` VALUES (25758741, 10933, 'Vastmanlands Lan');
INSERT INTO `regions` VALUES (25758744, 10933, 'Vastra Gotaland');
INSERT INTO `regions` VALUES (24352015, 582087, 'Шри-Ланка');
INSERT INTO `regions` VALUES (26542702, 582064, 'Azuay');
INSERT INTO `regions` VALUES (26542703, 582064, 'Bol&#237;var');
INSERT INTO `regions` VALUES (26542704, 582064, 'Canar');
INSERT INTO `regions` VALUES (26542705, 582064, 'Carchi');
INSERT INTO `regions` VALUES (26542706, 582064, 'Chimborazo');
INSERT INTO `regions` VALUES (26542707, 582064, 'Cotopaxi');
INSERT INTO `regions` VALUES (26542708, 582064, 'El Oro');
INSERT INTO `regions` VALUES (26542709, 582064, 'Esmeraldas');
INSERT INTO `regions` VALUES (26542701, 582064, 'Gal&#225;pagos');
INSERT INTO `regions` VALUES (26542710, 582064, 'Guayas');
INSERT INTO `regions` VALUES (26542711, 582064, 'Imbabura');
INSERT INTO `regions` VALUES (26542712, 582064, 'Loja');
INSERT INTO `regions` VALUES (26542713, 582064, 'Los R&#237;os');
INSERT INTO `regions` VALUES (26542714, 582064, 'Manab&#237;');
INSERT INTO `regions` VALUES (26542715, 582064, 'Morona-Santiago');
INSERT INTO `regions` VALUES (26542721, 582064, 'Napo');
INSERT INTO `regions` VALUES (26542722, 582064, 'Orellana');
INSERT INTO `regions` VALUES (26542716, 582064, 'Pastaza');
INSERT INTO `regions` VALUES (26542717, 582064, 'Pichincha');
INSERT INTO `regions` VALUES (26542720, 582064, 'Sucumb&#237;os');
INSERT INTO `regions` VALUES (26542718, 582064, 'Tungurahua');
INSERT INTO `regions` VALUES (26542719, 582064, 'Zamora-Chinchipe');
INSERT INTO `regions` VALUES (26338224, 23269653, 'Малабо');
INSERT INTO `regions` VALUES (24351293, 23269654, 'Эритрея');
INSERT INTO `regions` VALUES (10969, 10968, 'Эстония');
INSERT INTO `regions` VALUES (24351315, 582088, 'Эфиопия');
INSERT INTO `regions` VALUES (3661590, 3661568, 'Йоханесбург');
INSERT INTO `regions` VALUES (11015, 11014, 'Cheju');
INSERT INTO `regions` VALUES (11017, 11014, 'Chollabuk');
INSERT INTO `regions` VALUES (11020, 11014, 'Chollanam');
INSERT INTO `regions` VALUES (11024, 11014, 'Chungcheongbuk');
INSERT INTO `regions` VALUES (11027, 11014, 'Chungcheongnam');
INSERT INTO `regions` VALUES (58396481, 11014, 'Guri');
INSERT INTO `regions` VALUES (11029, 11014, 'Incheon');
INSERT INTO `regions` VALUES (11031, 11014, 'Kangweon');
INSERT INTO `regions` VALUES (11035, 11014, 'Kwangju');
INSERT INTO `regions` VALUES (11037, 11014, 'Kyeonggi');
INSERT INTO `regions` VALUES (11040, 11014, 'Kyeongsangbuk');
INSERT INTO `regions` VALUES (11045, 11014, 'Kyeongsangnam');
INSERT INTO `regions` VALUES (11050, 11014, 'Pusan');
INSERT INTO `regions` VALUES (11052, 11014, 'Seoul');
INSERT INTO `regions` VALUES (11054, 11014, 'Taegu');
INSERT INTO `regions` VALUES (11056, 11014, 'Taejeon');
INSERT INTO `regions` VALUES (11058, 11014, 'Ulsan');
INSERT INTO `regions` VALUES (11566007, 11014, 'Южная Корея');
INSERT INTO `regions` VALUES (15789405, 582106, 'Ямайка');
INSERT INTO `regions` VALUES (11061, 11060, 'Айти');
INSERT INTO `regions` VALUES (11068, 11060, 'Акита');
INSERT INTO `regions` VALUES (11074, 11060, 'Аомори');
INSERT INTO `regions` VALUES (11080, 11060, 'Вакаяма');
INSERT INTO `regions` VALUES (11083, 11060, 'Гифу');
INSERT INTO `regions` VALUES (11088, 11060, 'Гумма');
INSERT INTO `regions` VALUES (11094, 11060, 'Ибараки');
INSERT INTO `regions` VALUES (11102, 11060, 'Ивате');
INSERT INTO `regions` VALUES (11108, 11060, 'Исикава');
INSERT INTO `regions` VALUES (11113, 11060, 'Кагава');
INSERT INTO `regions` VALUES (11116, 11060, 'Кагосима');
INSERT INTO `regions` VALUES (11121, 11060, 'Канагава');
INSERT INTO `regions` VALUES (11133, 11060, 'Киото');
INSERT INTO `regions` VALUES (11139, 11060, 'Коти');
INSERT INTO `regions` VALUES (11142, 11060, 'Кумамото');
INSERT INTO `regions` VALUES (11146, 11060, 'Миэ');
INSERT INTO `regions` VALUES (11151, 11060, 'Мияги');
INSERT INTO `regions` VALUES (11155, 11060, 'Миядзаки');
INSERT INTO `regions` VALUES (11162, 11060, 'Нагано');
INSERT INTO `regions` VALUES (11168, 11060, 'Нагасаки');
INSERT INTO `regions` VALUES (11173, 11060, 'Нара');
INSERT INTO `regions` VALUES (11178, 11060, 'Ниигата');
INSERT INTO `regions` VALUES (11185, 11060, 'Окаяма');
INSERT INTO `regions` VALUES (11189, 11060, 'Окинава');
INSERT INTO `regions` VALUES (11192, 11060, 'Осака');
INSERT INTO `regions` VALUES (11209, 11060, 'Сага');
INSERT INTO `regions` VALUES (11215, 11060, 'Сайтама');
INSERT INTO `regions` VALUES (11227, 11060, 'Сига');
INSERT INTO `regions` VALUES (11230, 11060, 'Сидзуока');
INSERT INTO `regions` VALUES (11233, 11060, 'Симане');
INSERT INTO `regions` VALUES (11248, 11060, 'Тиба');
INSERT INTO `regions` VALUES (11261, 11060, 'Токио');
INSERT INTO `regions` VALUES (11270, 11060, 'Токусима');
INSERT INTO `regions` VALUES (11273, 11060, 'Тотиги');
INSERT INTO `regions` VALUES (11279, 11060, 'Тоттори');
INSERT INTO `regions` VALUES (11283, 11060, 'Тояма');
INSERT INTO `regions` VALUES (11289, 11060, 'Фукуи');
INSERT INTO `regions` VALUES (11295, 11060, 'Фукуока');
INSERT INTO `regions` VALUES (11304, 11060, 'Фукусима');
INSERT INTO `regions` VALUES (11307, 11060, 'Хиросима');
INSERT INTO `regions` VALUES (11312, 11060, 'Хоккайдо');
INSERT INTO `regions` VALUES (11330, 11060, 'Хпого');
INSERT INTO `regions` VALUES (11340, 11060, 'Эхиме');
INSERT INTO `regions` VALUES (11346, 11060, 'Ямагата');
INSERT INTO `regions` VALUES (11354, 11060, 'Ямагути');
INSERT INTO `regions` VALUES (11363, 11060, 'Яманаси');
INSERT INTO `regions` VALUES (90194582, 23269675, 'Other');
INSERT INTO `regions` VALUES (90194581, 23269711, 'Other');
INSERT INTO `regions` VALUES (90194580, 582100, 'Other');
INSERT INTO `regions` VALUES (90194579, 23269671, 'Other');
INSERT INTO `regions` VALUES (90194578, 23269660, 'Other');
INSERT INTO `regions` VALUES (90194577, 582084, 'Other');
INSERT INTO `regions` VALUES (90194576, 23269719, 'Other');
INSERT INTO `regions` VALUES (90194575, 23269712, 'Other');
INSERT INTO `regions` VALUES (90194574, 23269663, 'Other');
INSERT INTO `regions` VALUES (90194573, 23269672, 'Other');
INSERT INTO `regions` VALUES (90194572, 23269714, 'Other');
INSERT INTO `regions` VALUES (90194571, 23269642, 'Other');
INSERT INTO `regions` VALUES (90194570, 23269695, 'Other');
INSERT INTO `regions` VALUES (90194569, 23269692, 'Other');
INSERT INTO `regions` VALUES (90194568, 23269685, 'Other');
INSERT INTO `regions` VALUES (90194567, 23269680, 'Other');
INSERT INTO `regions` VALUES (90194566, 23269684, 'Other');
INSERT INTO `regions` VALUES (90194565, 23269648, 'Other');
INSERT INTO `regions` VALUES (90194564, 23269644, 'Other');
INSERT INTO `regions` VALUES (90194563, 23269643, 'Other');
INSERT INTO `regions` VALUES (90194562, 23269640, 'Other');
INSERT INTO `regions` VALUES (90194561, 34850922, 'Other');
INSERT INTO `regions` VALUES (90194560, 23269655, 'Other');
INSERT INTO `regions` VALUES (90194559, 23269651, 'Other');
INSERT INTO `regions` VALUES (90194558, 23269673, 'Other');
INSERT INTO `regions` VALUES (90194557, 34850173, 'Other');
INSERT INTO `regions` VALUES (90194556, 23269664, 'Other');
INSERT INTO `regions` VALUES (90194555, 23269632, 'Other');
INSERT INTO `regions` VALUES (90194554, 23269628, 'Other');
INSERT INTO `regions` VALUES (90194553, 23269626, 'Other');
INSERT INTO `regions` VALUES (90194552, 23269624, 'Other');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `session_vars`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `social_comment`
-- 

DROP TABLE IF EXISTS `social_comment`;
CREATE TABLE IF NOT EXISTS `social_comment` (
  `id` bigint(20) NOT NULL auto_increment,
  `social_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `avatar_id` int(11) NOT NULL,
  `warning_id` int(11) NOT NULL,
  `mood` int(11) NOT NULL,
  `mood_text` varchar(100) default NULL,
  `adm_redacted` int(11) NOT NULL,
  `text` text,
  `creation_date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=5 ;

-- 
-- Дамп данных таблицы `social_comment`
-- 

INSERT INTO `social_comment` VALUES (2, 1, 1, 43, 16, 0, 'vddd', 1, 'fff\r\nadmin', '2008-12-02 17:05:37');
INSERT INTO `social_comment` VALUES (3, 1, 1, 39, 0, 1, '', 0, '[quote name="admin"]fff[/quote]\r\nfdghfghf', '2008-12-02 17:05:51');
INSERT INTO `social_comment` VALUES (4, 14, 1, 40, 0, 0, 'eee', 0, 'ttt', '2008-12-03 09:49:38');

-- --------------------------------------------------------

-- 
-- Структура таблицы `social_criteria`
-- 

DROP TABLE IF EXISTS `social_criteria`;
CREATE TABLE IF NOT EXISTS `social_criteria` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `name` varchar(255) NOT NULL COMMENT 'Имя критерия (например, "производительность")',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Критерии оценки социальной позиции' AUTO_INCREMENT=5 ;

-- 
-- Дамп данных таблицы `social_criteria`
-- 

INSERT INTO `social_criteria` VALUES (1, 'Обслуживание');
INSERT INTO `social_criteria` VALUES (2, 'Цена');
INSERT INTO `social_criteria` VALUES (3, 'Качество');
INSERT INTO `social_criteria` VALUES (4, 'Скорость');

-- --------------------------------------------------------

-- 
-- Структура таблицы `social_pos`
-- 

DROP TABLE IF EXISTS `social_pos`;
CREATE TABLE IF NOT EXISTS `social_pos` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `social_tree_id` int(11) NOT NULL default '0' COMMENT 'ID.Раздел в дереве',
  `user_id` int(11) NOT NULL default '0' COMMENT 'ID пользователя, добавившего позицию',
  `name` varchar(255) NOT NULL COMMENT 'Заголовок позиции',
  `creation_date` datetime NOT NULL COMMENT 'Дата создания позиции',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Позиция социальных разделов' AUTO_INCREMENT=15 ;

-- 
-- Дамп данных таблицы `social_pos`
-- 

INSERT INTO `social_pos` VALUES (1, 4, 1, 'Клевая клиника', '2008-06-02 01:00:00');
INSERT INTO `social_pos` VALUES (2, 10, 1, 'Машинка супер', '2008-06-01 22:00:00');
INSERT INTO `social_pos` VALUES (3, 10, 1, 'Абажаю это авто', '2008-05-31 00:59:58');
INSERT INTO `social_pos` VALUES (4, 10, 1, 'БМВ форева', '2008-06-01 23:58:00');
INSERT INTO `social_pos` VALUES (5, 10, 1, 'Суперская машина', '2008-06-04 23:00:00');
INSERT INTO `social_pos` VALUES (14, 10, 1, 'Test', '2008-06-16 10:33:36');
INSERT INTO `social_pos` VALUES (13, 10, 1, 'BMW M3', '2008-06-16 10:25:00');

-- --------------------------------------------------------

-- 
-- Структура таблицы `social_pos_criteria_votes`
-- 

DROP TABLE IF EXISTS `social_pos_criteria_votes`;
CREATE TABLE IF NOT EXISTS `social_pos_criteria_votes` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `social_pos_id` int(11) NOT NULL COMMENT 'social_pos.ID позиции',
  `social_criteria_id` int(11) NOT NULL COMMENT 'social_criteria.ID критерия привязаного к позиции',
  `votes_sum` int(11) NOT NULL COMMENT 'Общая сумма оценок этого критерия этой позиции',
  `votes_count` int(11) NOT NULL COMMENT 'Общее число оценок',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Таблица связи позиции(social_pos) с критерием(social_criteri' AUTO_INCREMENT=25 ;

-- 
-- Дамп данных таблицы `social_pos_criteria_votes`
-- 

INSERT INTO `social_pos_criteria_votes` VALUES (1, 1, 1, 36, 7);
INSERT INTO `social_pos_criteria_votes` VALUES (2, 1, 2, 27, 3);
INSERT INTO `social_pos_criteria_votes` VALUES (3, 5, 1, 44, 7);
INSERT INTO `social_pos_criteria_votes` VALUES (4, 1, 3, 22, 3);
INSERT INTO `social_pos_criteria_votes` VALUES (5, 5, 4, 15, 3);
INSERT INTO `social_pos_criteria_votes` VALUES (6, 5, 2, 37, 5);
INSERT INTO `social_pos_criteria_votes` VALUES (7, 4, 1, 2, 1);
INSERT INTO `social_pos_criteria_votes` VALUES (8, 4, 2, 5, 1);
INSERT INTO `social_pos_criteria_votes` VALUES (9, 4, 4, 8, 1);
INSERT INTO `social_pos_criteria_votes` VALUES (13, 12, 1, 1, 1);
INSERT INTO `social_pos_criteria_votes` VALUES (14, 12, 2, 1, 1);
INSERT INTO `social_pos_criteria_votes` VALUES (15, 12, 4, 1, 1);
INSERT INTO `social_pos_criteria_votes` VALUES (16, 13, 1, 1, 1);
INSERT INTO `social_pos_criteria_votes` VALUES (17, 13, 2, 1, 1);
INSERT INTO `social_pos_criteria_votes` VALUES (18, 13, 4, 1, 1);
INSERT INTO `social_pos_criteria_votes` VALUES (19, 14, 1, 7, 1);
INSERT INTO `social_pos_criteria_votes` VALUES (20, 14, 2, 6, 1);
INSERT INTO `social_pos_criteria_votes` VALUES (21, 14, 4, 10, 1);
INSERT INTO `social_pos_criteria_votes` VALUES (22, 2, 1, 8, 1);
INSERT INTO `social_pos_criteria_votes` VALUES (23, 2, 2, 3, 1);
INSERT INTO `social_pos_criteria_votes` VALUES (24, 2, 4, 7, 1);

-- --------------------------------------------------------

-- 
-- Структура таблицы `social_tree`
-- 

DROP TABLE IF EXISTS `social_tree`;
CREATE TABLE IF NOT EXISTS `social_tree` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `parent_id` int(11) NOT NULL default '0' COMMENT 'ID родителя. Уровня в дереве всего 2.',
  `name` varchar(255) NOT NULL COMMENT 'Имя раздела',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Таблица Дерево социальных разделов' AUTO_INCREMENT=14 ;

-- 
-- Дамп данных таблицы `social_tree`
-- 

INSERT INTO `social_tree` VALUES (1, 0, 'Медицина');
INSERT INTO `social_tree` VALUES (2, 0, 'Телефоны');
INSERT INTO `social_tree` VALUES (3, 0, 'Автомобили');
INSERT INTO `social_tree` VALUES (4, 1, 'Поликлиники');
INSERT INTO `social_tree` VALUES (5, 1, 'Стоматология');
INSERT INTO `social_tree` VALUES (6, 1, 'Аптеки');
INSERT INTO `social_tree` VALUES (7, 2, 'Сотовые');
INSERT INTO `social_tree` VALUES (8, 2, 'Стационарные');
INSERT INTO `social_tree` VALUES (9, 2, 'Спутниковые');
INSERT INTO `social_tree` VALUES (10, 3, 'BMW');
INSERT INTO `social_tree` VALUES (11, 3, 'ВАЗ');
INSERT INTO `social_tree` VALUES (12, 3, 'Mercedes');
INSERT INTO `social_tree` VALUES (13, 3, 'Honda');

-- --------------------------------------------------------

-- 
-- Структура таблицы `social_tree_criteria`
-- 

DROP TABLE IF EXISTS `social_tree_criteria`;
CREATE TABLE IF NOT EXISTS `social_tree_criteria` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `social_tree_id` int(11) NOT NULL COMMENT 'social_tree.ID раздела в дереве',
  `social_criteria_id` int(11) NOT NULL COMMENT 'social_criteria.ID критерия',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Кросс-таблица для связи категорий(social_tree) и критериев о' AUTO_INCREMENT=7 ;

-- 
-- Дамп данных таблицы `social_tree_criteria`
-- 

INSERT INTO `social_tree_criteria` VALUES (1, 10, 1);
INSERT INTO `social_tree_criteria` VALUES (2, 10, 2);
INSERT INTO `social_tree_criteria` VALUES (3, 10, 4);
INSERT INTO `social_tree_criteria` VALUES (4, 4, 1);
INSERT INTO `social_tree_criteria` VALUES (5, 4, 2);
INSERT INTO `social_tree_criteria` VALUES (6, 4, 3);

-- --------------------------------------------------------

-- 
-- Структура таблицы `social_votes`
-- 

DROP TABLE IF EXISTS `social_votes`;
CREATE TABLE IF NOT EXISTS `social_votes` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `social_pos_id` int(11) NOT NULL COMMENT 'social_pos.ID позиции',
  `user_id` int(11) NOT NULL COMMENT 'user.ID пользователя',
  `ip` varchar(255) NOT NULL COMMENT 'IP пользователя',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Голоса за позиции, для предотвращения повторного голосования' AUTO_INCREMENT=9 ;

-- 
-- Дамп данных таблицы `social_votes`
-- 

INSERT INTO `social_votes` VALUES (1, 5, 1, '127.0.0.1');
INSERT INTO `social_votes` VALUES (2, 4, 1, '127.0.0.1');
INSERT INTO `social_votes` VALUES (4, 12, 1, '77.120.77.168');
INSERT INTO `social_votes` VALUES (5, 1, 1, '195.39.210.203');
INSERT INTO `social_votes` VALUES (6, 13, 1, '195.39.210.203');
INSERT INTO `social_votes` VALUES (7, 14, 1, '78.106.34.38');
INSERT INTO `social_votes` VALUES (8, 2, 1, '83.167.112.19');

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
-- Структура таблицы `subject_votes`
-- 

DROP TABLE IF EXISTS `subject_votes`;
CREATE TABLE IF NOT EXISTS `subject_votes` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Дамп данных таблицы `subject_votes`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `sys_av`
-- 

DROP TABLE IF EXISTS `sys_av`;
CREATE TABLE IF NOT EXISTS `sys_av` (
  `id` int(11) NOT NULL auto_increment,
  `path` varchar(255) default NULL,
  `av_name` varchar(50) character set cp1251 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- Дамп данных таблицы `sys_av`
-- 

INSERT INTO `sys_av` VALUES (6, '50822_1280_1024.jpg', 'hill');
INSERT INTO `sys_av` VALUES (5, '50662_1280_1024.jpg', 'winter');

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
  `blog_catalog_id` int(11) NOT NULL,
  `blog_banner_id` bigint(20) NOT NULL,
  `name` varchar(255) character set cp1251 NOT NULL,
  `access` tinyint(4) NOT NULL,
  `key` varchar(255) character set cp1251 NOT NULL,
  `level` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `blog_id` (`blog_id`),
  KEY `bc_id` (`blog_id`,`blog_catalog_id`),
  KEY `access` (`blog_id`,`access`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED AUTO_INCREMENT=21 ;

-- 
-- Дамп данных таблицы `ub_tree`
-- 

INSERT INTO `ub_tree` VALUES (1, 1, 3, 0, 'Раздел', 2, '0001', 1);
INSERT INTO `ub_tree` VALUES (2, 1, 1, 0, 'v233', 2, '0002', 1);
INSERT INTO `ub_tree` VALUES (18, 1, 1, 0, 'asdsdfsdf', 2, '00010001', 2);
INSERT INTO `ub_tree` VALUES (19, 1, 7, 0, '2343', 2, '0019', 1);
INSERT INTO `ub_tree` VALUES (20, 1, 1, 0, 'name', 0, '00010002', 2);

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
) ENGINE=MyISAM AUTO_INCREMENT=648 DEFAULT CHARSET=utf8 AUTO_INCREMENT=648 ;

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
INSERT INTO `user_right` VALUES (97, 1, 9, 70, NULL, 1);
INSERT INTO `user_right` VALUES (98, 1, 16, 71, NULL, 1);
INSERT INTO `user_right` VALUES (99, 1, 16, 72, NULL, 1);
INSERT INTO `user_right` VALUES (100, 1, 16, 73, NULL, 1);
INSERT INTO `user_right` VALUES (101, 1, 16, 74, NULL, 1);
INSERT INTO `user_right` VALUES (102, 1, 16, 75, NULL, 1);
INSERT INTO `user_right` VALUES (103, 1, 10, 45, NULL, 1);
INSERT INTO `user_right` VALUES (104, 1, 10, 46, NULL, 1);
INSERT INTO `user_right` VALUES (105, 1, 10, 44, NULL, 1);
INSERT INTO `user_right` VALUES (106, 1, 10, 43, NULL, 1);
INSERT INTO `user_right` VALUES (107, 1, 10, 42, NULL, 1);
INSERT INTO `user_right` VALUES (108, 1, 10, 41, NULL, 1);
INSERT INTO `user_right` VALUES (109, 1, 10, 40, NULL, 1);
INSERT INTO `user_right` VALUES (110, 1, 10, 39, NULL, 1);
INSERT INTO `user_right` VALUES (111, 1, 10, 38, NULL, 1);
INSERT INTO `user_right` VALUES (112, 1, 10, 37, NULL, 1);
INSERT INTO `user_right` VALUES (113, 1, 10, 36, NULL, 1);
INSERT INTO `user_right` VALUES (114, 1, 10, 35, NULL, 1);
INSERT INTO `user_right` VALUES (115, 1, 9, 107, NULL, 1);
INSERT INTO `user_right` VALUES (116, 1, 15, 101, NULL, 1);
INSERT INTO `user_right` VALUES (117, 1, 15, 102, NULL, 1);
INSERT INTO `user_right` VALUES (118, 1, 15, 103, NULL, 1);
INSERT INTO `user_right` VALUES (119, 1, 15, 104, NULL, 1);
INSERT INTO `user_right` VALUES (120, 1, 15, 105, NULL, 1);
INSERT INTO `user_right` VALUES (121, 1, 15, 106, NULL, 1);
INSERT INTO `user_right` VALUES (122, 1, 16, 108, NULL, 1);
INSERT INTO `user_right` VALUES (123, 1, 16, 109, NULL, 1);
INSERT INTO `user_right` VALUES (124, 1, 16, 110, NULL, 1);
INSERT INTO `user_right` VALUES (125, 1, 16, 111, NULL, 1);
INSERT INTO `user_right` VALUES (126, 1, 16, 112, NULL, 1);
INSERT INTO `user_right` VALUES (127, 1, 10, 113, NULL, 1);
INSERT INTO `user_right` VALUES (128, 1, 10, 114, NULL, 1);
INSERT INTO `user_right` VALUES (129, 1, 10, 115, NULL, 1);
INSERT INTO `user_right` VALUES (130, 1, 10, 116, NULL, 1);
INSERT INTO `user_right` VALUES (131, 1, 10, 117, NULL, 1);
INSERT INTO `user_right` VALUES (132, 1, 10, 118, NULL, 1);
INSERT INTO `user_right` VALUES (133, 1, 10, 119, NULL, 1);
INSERT INTO `user_right` VALUES (134, 1, 10, 120, NULL, 1);
INSERT INTO `user_right` VALUES (135, 1, 10, 121, NULL, 1);
INSERT INTO `user_right` VALUES (136, 1, 10, 122, NULL, 1);
INSERT INTO `user_right` VALUES (137, 1, 10, 123, NULL, 1);
INSERT INTO `user_right` VALUES (138, 1, 10, 124, NULL, 1);
INSERT INTO `user_right` VALUES (139, 1, 17, 125, NULL, 1);
INSERT INTO `user_right` VALUES (140, 1, 17, 126, NULL, 1);
INSERT INTO `user_right` VALUES (141, 1, 17, 127, NULL, 1);
INSERT INTO `user_right` VALUES (142, 1, 17, 128, NULL, 1);
INSERT INTO `user_right` VALUES (143, 1, 17, 129, NULL, 1);
INSERT INTO `user_right` VALUES (144, 1, 17, 130, NULL, 1);
INSERT INTO `user_right` VALUES (145, 1, 17, 131, NULL, 1);
INSERT INTO `user_right` VALUES (146, 1, 17, 132, NULL, 1);
INSERT INTO `user_right` VALUES (147, 1, 15, 133, NULL, 1);
INSERT INTO `user_right` VALUES (148, 1, 10, 134, NULL, 1);
INSERT INTO `user_right` VALUES (149, 1, 18, 135, NULL, 1);
INSERT INTO `user_right` VALUES (150, 1, 18, 136, NULL, 1);
INSERT INTO `user_right` VALUES (151, 1, 18, 137, NULL, 1);
INSERT INTO `user_right` VALUES (152, 1, 18, 138, NULL, 1);
INSERT INTO `user_right` VALUES (153, 1, 13, 139, NULL, 1);
INSERT INTO `user_right` VALUES (154, 0, 3, 140, NULL, 1);
INSERT INTO `user_right` VALUES (155, 0, 3, 141, NULL, 1);
INSERT INTO `user_right` VALUES (156, 1, 3, 141, NULL, 1);
INSERT INTO `user_right` VALUES (157, 1, 3, 140, NULL, 1);
INSERT INTO `user_right` VALUES (158, 1, 3, 142, NULL, 1);
INSERT INTO `user_right` VALUES (159, 0, 3, 142, NULL, 1);
INSERT INTO `user_right` VALUES (160, 0, 3, 143, NULL, 1);
INSERT INTO `user_right` VALUES (161, 0, 3, 144, NULL, 1);
INSERT INTO `user_right` VALUES (162, 1, 3, 143, NULL, 1);
INSERT INTO `user_right` VALUES (163, 1, 3, 144, NULL, 1);
INSERT INTO `user_right` VALUES (164, 0, 3, 145, NULL, 1);
INSERT INTO `user_right` VALUES (165, 1, 3, 145, NULL, 1);
INSERT INTO `user_right` VALUES (166, 0, 3, 146, NULL, 1);
INSERT INTO `user_right` VALUES (167, 1, 3, 146, NULL, 1);
INSERT INTO `user_right` VALUES (168, 0, 3, 147, NULL, 1);
INSERT INTO `user_right` VALUES (169, 1, 3, 147, NULL, 1);
INSERT INTO `user_right` VALUES (170, 2, 1, 1, NULL, 1);
INSERT INTO `user_right` VALUES (171, 2, 3, 8, NULL, 1);
INSERT INTO `user_right` VALUES (172, 2, 3, 9, NULL, 1);
INSERT INTO `user_right` VALUES (173, 2, 3, 12, NULL, 1);
INSERT INTO `user_right` VALUES (174, 2, 3, 14, NULL, 1);
INSERT INTO `user_right` VALUES (175, 2, 3, 65, NULL, 1);
INSERT INTO `user_right` VALUES (176, 2, 3, 140, NULL, 1);
INSERT INTO `user_right` VALUES (177, 2, 3, 141, NULL, 1);
INSERT INTO `user_right` VALUES (178, 2, 3, 142, NULL, 1);
INSERT INTO `user_right` VALUES (179, 2, 3, 143, NULL, 1);
INSERT INTO `user_right` VALUES (180, 2, 3, 144, NULL, 1);
INSERT INTO `user_right` VALUES (181, 2, 3, 145, NULL, 1);
INSERT INTO `user_right` VALUES (182, 2, 3, 146, NULL, 1);
INSERT INTO `user_right` VALUES (183, 2, 3, 147, NULL, 1);
INSERT INTO `user_right` VALUES (184, 3, 3, 8, NULL, 1);
INSERT INTO `user_right` VALUES (185, 3, 3, 9, NULL, 1);
INSERT INTO `user_right` VALUES (186, 3, 3, 12, NULL, 1);
INSERT INTO `user_right` VALUES (187, 3, 3, 14, NULL, 1);
INSERT INTO `user_right` VALUES (188, 3, 3, 65, NULL, 1);
INSERT INTO `user_right` VALUES (189, 3, 3, 140, NULL, 0);
INSERT INTO `user_right` VALUES (190, 3, 3, 141, NULL, 0);
INSERT INTO `user_right` VALUES (191, 3, 1, 1, NULL, 1);
INSERT INTO `user_right` VALUES (192, 3, 8, 16, NULL, 1);
INSERT INTO `user_right` VALUES (193, 3, 8, 15, NULL, 1);
INSERT INTO `user_right` VALUES (194, 3, 8, 21, NULL, 1);
INSERT INTO `user_right` VALUES (195, 3, 8, 22, NULL, 1);
INSERT INTO `user_right` VALUES (196, 3, 8, 23, NULL, 1);
INSERT INTO `user_right` VALUES (197, 3, 8, 24, NULL, 1);
INSERT INTO `user_right` VALUES (198, 3, 8, 25, NULL, 1);
INSERT INTO `user_right` VALUES (199, 3, 8, 26, NULL, 1);
INSERT INTO `user_right` VALUES (200, 3, 8, 27, NULL, 1);
INSERT INTO `user_right` VALUES (201, 3, 8, 28, NULL, 1);
INSERT INTO `user_right` VALUES (202, 3, 8, 31, NULL, 1);
INSERT INTO `user_right` VALUES (203, 3, 9, 17, NULL, 1);
INSERT INTO `user_right` VALUES (204, 3, 9, 18, NULL, 1);
INSERT INTO `user_right` VALUES (205, 3, 9, 19, NULL, 1);
INSERT INTO `user_right` VALUES (206, 3, 9, 20, NULL, 1);
INSERT INTO `user_right` VALUES (207, 3, 9, 29, NULL, 1);
INSERT INTO `user_right` VALUES (208, 3, 9, 30, NULL, 1);
INSERT INTO `user_right` VALUES (209, 3, 9, 32, NULL, 1);
INSERT INTO `user_right` VALUES (210, 3, 9, 33, NULL, 1);
INSERT INTO `user_right` VALUES (211, 3, 9, 34, NULL, 1);
INSERT INTO `user_right` VALUES (212, 3, 9, 107, NULL, 1);
INSERT INTO `user_right` VALUES (213, 3, 10, 113, NULL, 1);
INSERT INTO `user_right` VALUES (214, 3, 10, 114, NULL, 1);
INSERT INTO `user_right` VALUES (215, 3, 10, 115, NULL, 1);
INSERT INTO `user_right` VALUES (216, 3, 10, 116, NULL, 1);
INSERT INTO `user_right` VALUES (217, 3, 10, 117, NULL, 1);
INSERT INTO `user_right` VALUES (218, 3, 10, 118, NULL, 1);
INSERT INTO `user_right` VALUES (219, 3, 10, 119, NULL, 1);
INSERT INTO `user_right` VALUES (220, 3, 10, 120, NULL, 1);
INSERT INTO `user_right` VALUES (221, 3, 10, 121, NULL, 1);
INSERT INTO `user_right` VALUES (222, 3, 10, 122, NULL, 1);
INSERT INTO `user_right` VALUES (223, 3, 10, 123, NULL, 1);
INSERT INTO `user_right` VALUES (224, 3, 10, 124, NULL, 1);
INSERT INTO `user_right` VALUES (225, 3, 10, 134, NULL, 1);
INSERT INTO `user_right` VALUES (226, 3, 11, 47, NULL, 0);
INSERT INTO `user_right` VALUES (227, 3, 11, 48, NULL, 0);
INSERT INTO `user_right` VALUES (228, 3, 11, 49, NULL, 0);
INSERT INTO `user_right` VALUES (229, 3, 11, 50, NULL, 0);
INSERT INTO `user_right` VALUES (230, 3, 12, 51, NULL, 0);
INSERT INTO `user_right` VALUES (231, 3, 12, 52, NULL, 0);
INSERT INTO `user_right` VALUES (232, 3, 12, 53, NULL, 0);
INSERT INTO `user_right` VALUES (233, 3, 12, 54, NULL, 0);
INSERT INTO `user_right` VALUES (234, 3, 13, 55, NULL, 0);
INSERT INTO `user_right` VALUES (235, 3, 13, 56, NULL, 0);
INSERT INTO `user_right` VALUES (236, 3, 13, 57, NULL, 0);
INSERT INTO `user_right` VALUES (237, 3, 13, 58, NULL, 0);
INSERT INTO `user_right` VALUES (238, 3, 13, 139, NULL, 0);
INSERT INTO `user_right` VALUES (239, 3, 15, 101, NULL, 1);
INSERT INTO `user_right` VALUES (240, 3, 15, 102, NULL, 1);
INSERT INTO `user_right` VALUES (241, 3, 15, 103, NULL, 1);
INSERT INTO `user_right` VALUES (242, 3, 15, 104, NULL, 1);
INSERT INTO `user_right` VALUES (243, 3, 15, 105, NULL, 1);
INSERT INTO `user_right` VALUES (244, 3, 15, 106, NULL, 1);
INSERT INTO `user_right` VALUES (245, 3, 15, 133, NULL, 1);
INSERT INTO `user_right` VALUES (246, 3, 16, 108, NULL, 0);
INSERT INTO `user_right` VALUES (247, 3, 16, 109, NULL, 0);
INSERT INTO `user_right` VALUES (248, 3, 16, 110, NULL, 0);
INSERT INTO `user_right` VALUES (249, 3, 16, 111, NULL, 0);
INSERT INTO `user_right` VALUES (250, 3, 16, 112, NULL, 0);
INSERT INTO `user_right` VALUES (251, 3, 18, 135, NULL, 1);
INSERT INTO `user_right` VALUES (252, 3, 18, 136, NULL, 1);
INSERT INTO `user_right` VALUES (253, 3, 18, 137, NULL, 1);
INSERT INTO `user_right` VALUES (254, 3, 18, 138, NULL, 1);
INSERT INTO `user_right` VALUES (255, 1, 3, 148, NULL, 1);
INSERT INTO `user_right` VALUES (256, 1, 3, 149, NULL, 1);
INSERT INTO `user_right` VALUES (258, 1, 19, 150, NULL, 1);
INSERT INTO `user_right` VALUES (259, 1, 19, 151, NULL, 1);
INSERT INTO `user_right` VALUES (260, 1, 19, 152, NULL, 1);
INSERT INTO `user_right` VALUES (261, 1, 19, 153, NULL, 1);
INSERT INTO `user_right` VALUES (262, 1, 19, 154, NULL, 1);
INSERT INTO `user_right` VALUES (263, 1, 19, 155, NULL, 1);
INSERT INTO `user_right` VALUES (264, 0, 19, 150, NULL, 1);
INSERT INTO `user_right` VALUES (265, 0, 19, 151, NULL, 1);
INSERT INTO `user_right` VALUES (266, 0, 19, 152, NULL, 1);
INSERT INTO `user_right` VALUES (271, 0, 19, 156, NULL, 1);
INSERT INTO `user_right` VALUES (273, 1, 19, 156, NULL, 1);
INSERT INTO `user_right` VALUES (274, 1, 19, 157, NULL, 1);
INSERT INTO `user_right` VALUES (275, 1, 19, 158, NULL, 1);
INSERT INTO `user_right` VALUES (276, 1, 19, 159, NULL, 1);
INSERT INTO `user_right` VALUES (277, 1, 20, 160, NULL, 1);
INSERT INTO `user_right` VALUES (278, 1, 20, 161, NULL, 1);
INSERT INTO `user_right` VALUES (279, 1, 20, 162, NULL, 1);
INSERT INTO `user_right` VALUES (280, 1, 20, 163, NULL, 1);
INSERT INTO `user_right` VALUES (281, 1, 20, 164, NULL, 1);
INSERT INTO `user_right` VALUES (282, 1, 20, 165, NULL, 1);
INSERT INTO `user_right` VALUES (283, 1, 19, 166, NULL, 1);
INSERT INTO `user_right` VALUES (284, 1, 4, 10, NULL, 0);
INSERT INTO `user_right` VALUES (285, 1, 4, 11, NULL, 0);
INSERT INTO `user_right` VALUES (286, 3, 2, 2, NULL, 0);
INSERT INTO `user_right` VALUES (287, 3, 2, 3, NULL, 0);
INSERT INTO `user_right` VALUES (288, 3, 2, 5, NULL, 0);
INSERT INTO `user_right` VALUES (289, 1, 20, 167, NULL, 1);
INSERT INTO `user_right` VALUES (290, 1, 19, 168, NULL, 1);
INSERT INTO `user_right` VALUES (291, 1, 19, 169, NULL, 1);
INSERT INTO `user_right` VALUES (307, 3, 21, 171, NULL, 1);
INSERT INTO `user_right` VALUES (306, 2, 21, 171, NULL, 1);
INSERT INTO `user_right` VALUES (305, 1, 21, 171, NULL, 1);
INSERT INTO `user_right` VALUES (304, 0, 21, 171, NULL, 1);
INSERT INTO `user_right` VALUES (303, 3, 21, 170, NULL, 1);
INSERT INTO `user_right` VALUES (302, 2, 21, 170, NULL, 1);
INSERT INTO `user_right` VALUES (301, 1, 21, 170, NULL, 1);
INSERT INTO `user_right` VALUES (300, 0, 21, 170, NULL, 1);
INSERT INTO `user_right` VALUES (308, 0, 21, 172, NULL, 1);
INSERT INTO `user_right` VALUES (309, 1, 21, 172, NULL, 1);
INSERT INTO `user_right` VALUES (310, 2, 21, 172, NULL, 1);
INSERT INTO `user_right` VALUES (311, 3, 21, 172, NULL, 1);
INSERT INTO `user_right` VALUES (312, 0, 21, 173, NULL, 1);
INSERT INTO `user_right` VALUES (313, 1, 21, 173, NULL, 1);
INSERT INTO `user_right` VALUES (314, 2, 21, 173, NULL, 1);
INSERT INTO `user_right` VALUES (315, 3, 21, 173, NULL, 1);
INSERT INTO `user_right` VALUES (316, 0, 21, 174, NULL, 1);
INSERT INTO `user_right` VALUES (317, 1, 21, 174, NULL, 1);
INSERT INTO `user_right` VALUES (318, 2, 21, 174, NULL, 1);
INSERT INTO `user_right` VALUES (319, 3, 21, 174, NULL, 1);
INSERT INTO `user_right` VALUES (320, 0, 21, 175, NULL, 1);
INSERT INTO `user_right` VALUES (321, 1, 21, 175, NULL, 1);
INSERT INTO `user_right` VALUES (322, 2, 21, 175, NULL, 1);
INSERT INTO `user_right` VALUES (323, 3, 21, 175, NULL, 1);
INSERT INTO `user_right` VALUES (324, 0, 21, 176, NULL, 1);
INSERT INTO `user_right` VALUES (325, 1, 21, 176, NULL, 1);
INSERT INTO `user_right` VALUES (326, 2, 21, 176, NULL, 1);
INSERT INTO `user_right` VALUES (327, 3, 21, 176, NULL, 1);
INSERT INTO `user_right` VALUES (328, 0, 21, 177, NULL, 1);
INSERT INTO `user_right` VALUES (329, 1, 21, 177, NULL, 1);
INSERT INTO `user_right` VALUES (330, 2, 21, 177, NULL, 1);
INSERT INTO `user_right` VALUES (331, 3, 21, 177, NULL, 1);
INSERT INTO `user_right` VALUES (332, 0, 15, 101, NULL, 1);
INSERT INTO `user_right` VALUES (333, 0, 15, 102, NULL, 1);
INSERT INTO `user_right` VALUES (334, 0, 15, 103, NULL, 1);
INSERT INTO `user_right` VALUES (335, 0, 15, 104, NULL, 1);
INSERT INTO `user_right` VALUES (336, 0, 15, 105, NULL, 1);
INSERT INTO `user_right` VALUES (337, 0, 15, 106, NULL, 1);
INSERT INTO `user_right` VALUES (338, 0, 15, 133, NULL, 1);
INSERT INTO `user_right` VALUES (339, 0, 21, 178, NULL, 1);
INSERT INTO `user_right` VALUES (340, 1, 21, 178, NULL, 1);
INSERT INTO `user_right` VALUES (341, 2, 21, 178, NULL, 1);
INSERT INTO `user_right` VALUES (342, 3, 21, 178, NULL, 1);
INSERT INTO `user_right` VALUES (343, 0, 21, 179, NULL, 1);
INSERT INTO `user_right` VALUES (344, 1, 21, 179, NULL, 1);
INSERT INTO `user_right` VALUES (345, 2, 21, 179, NULL, 1);
INSERT INTO `user_right` VALUES (346, 3, 21, 179, NULL, 1);
INSERT INTO `user_right` VALUES (347, 0, 21, 180, NULL, 1);
INSERT INTO `user_right` VALUES (348, 1, 21, 180, NULL, 1);
INSERT INTO `user_right` VALUES (349, 2, 21, 180, NULL, 1);
INSERT INTO `user_right` VALUES (350, 3, 21, 180, NULL, 1);
INSERT INTO `user_right` VALUES (351, 0, 21, 181, NULL, 1);
INSERT INTO `user_right` VALUES (352, 1, 21, 181, NULL, 1);
INSERT INTO `user_right` VALUES (353, 2, 21, 181, NULL, 1);
INSERT INTO `user_right` VALUES (354, 3, 21, 181, NULL, 1);
INSERT INTO `user_right` VALUES (355, 0, 21, 182, NULL, 1);
INSERT INTO `user_right` VALUES (356, 1, 21, 182, NULL, 1);
INSERT INTO `user_right` VALUES (357, 2, 21, 182, NULL, 1);
INSERT INTO `user_right` VALUES (358, 3, 21, 182, NULL, 1);
INSERT INTO `user_right` VALUES (373, 0, 22, 189, NULL, 1);
INSERT INTO `user_right` VALUES (367, 0, 3, 187, NULL, 1);
INSERT INTO `user_right` VALUES (368, 0, 3, 148, NULL, 1);
INSERT INTO `user_right` VALUES (369, 0, 3, 149, NULL, 1);
INSERT INTO `user_right` VALUES (370, 0, 3, 185, NULL, 1);
INSERT INTO `user_right` VALUES (371, 0, 3, 186, NULL, 1);
INSERT INTO `user_right` VALUES (374, 1, 22, 189, NULL, 1);
INSERT INTO `user_right` VALUES (375, 2, 22, 189, NULL, 1);
INSERT INTO `user_right` VALUES (376, 3, 22, 189, NULL, 1);
INSERT INTO `user_right` VALUES (377, 0, 22, 190, NULL, 1);
INSERT INTO `user_right` VALUES (378, 1, 22, 190, NULL, 1);
INSERT INTO `user_right` VALUES (379, 2, 22, 190, NULL, 1);
INSERT INTO `user_right` VALUES (380, 3, 22, 190, NULL, 1);
INSERT INTO `user_right` VALUES (381, 0, 22, 191, NULL, 1);
INSERT INTO `user_right` VALUES (382, 1, 22, 191, NULL, 1);
INSERT INTO `user_right` VALUES (383, 2, 22, 191, NULL, 1);
INSERT INTO `user_right` VALUES (384, 3, 22, 191, NULL, 1);
INSERT INTO `user_right` VALUES (385, 0, 22, 192, NULL, 1);
INSERT INTO `user_right` VALUES (386, 1, 22, 192, NULL, 1);
INSERT INTO `user_right` VALUES (387, 2, 22, 192, NULL, 1);
INSERT INTO `user_right` VALUES (388, 3, 22, 192, NULL, 1);
INSERT INTO `user_right` VALUES (389, 0, 22, 193, NULL, 1);
INSERT INTO `user_right` VALUES (390, 1, 22, 193, NULL, 1);
INSERT INTO `user_right` VALUES (391, 2, 22, 193, NULL, 1);
INSERT INTO `user_right` VALUES (392, 3, 22, 193, NULL, 1);
INSERT INTO `user_right` VALUES (393, 0, 22, 194, NULL, 1);
INSERT INTO `user_right` VALUES (394, 1, 22, 194, NULL, 1);
INSERT INTO `user_right` VALUES (395, 2, 22, 194, NULL, 1);
INSERT INTO `user_right` VALUES (396, 3, 22, 194, NULL, 1);
INSERT INTO `user_right` VALUES (397, 0, 22, 195, NULL, 1);
INSERT INTO `user_right` VALUES (398, 1, 22, 195, NULL, 1);
INSERT INTO `user_right` VALUES (399, 2, 22, 195, NULL, 1);
INSERT INTO `user_right` VALUES (400, 3, 22, 195, NULL, 1);
INSERT INTO `user_right` VALUES (401, 0, 22, 196, NULL, 1);
INSERT INTO `user_right` VALUES (402, 1, 22, 196, NULL, 1);
INSERT INTO `user_right` VALUES (403, 2, 22, 196, NULL, 1);
INSERT INTO `user_right` VALUES (404, 3, 22, 196, NULL, 1);
INSERT INTO `user_right` VALUES (405, 0, 22, 197, NULL, 1);
INSERT INTO `user_right` VALUES (406, 1, 22, 197, NULL, 1);
INSERT INTO `user_right` VALUES (407, 2, 22, 197, NULL, 1);
INSERT INTO `user_right` VALUES (408, 3, 22, 197, NULL, 1);
INSERT INTO `user_right` VALUES (409, 0, 22, 198, NULL, 1);
INSERT INTO `user_right` VALUES (410, 1, 22, 198, NULL, 1);
INSERT INTO `user_right` VALUES (411, 2, 22, 198, NULL, 1);
INSERT INTO `user_right` VALUES (412, 3, 22, 198, NULL, 1);
INSERT INTO `user_right` VALUES (413, 0, 23, 199, NULL, 1);
INSERT INTO `user_right` VALUES (414, 1, 23, 199, NULL, 1);
INSERT INTO `user_right` VALUES (415, 2, 23, 199, NULL, 1);
INSERT INTO `user_right` VALUES (416, 3, 23, 199, NULL, 1);
INSERT INTO `user_right` VALUES (417, 0, 23, 200, NULL, 1);
INSERT INTO `user_right` VALUES (418, 1, 23, 200, NULL, 1);
INSERT INTO `user_right` VALUES (419, 2, 23, 200, NULL, 1);
INSERT INTO `user_right` VALUES (420, 3, 23, 200, NULL, 1);
INSERT INTO `user_right` VALUES (421, 1, 20, 201, NULL, 1);
INSERT INTO `user_right` VALUES (422, 1, 20, 202, NULL, 1);
INSERT INTO `user_right` VALUES (423, 1, 20, 203, NULL, 1);
INSERT INTO `user_right` VALUES (424, 1, 20, 204, NULL, 1);
INSERT INTO `user_right` VALUES (425, 1, 20, 205, NULL, 1);
INSERT INTO `user_right` VALUES (426, 1, 20, 206, NULL, 1);
INSERT INTO `user_right` VALUES (427, 1, 20, 207, NULL, 1);
INSERT INTO `user_right` VALUES (428, 1, 19, 208, NULL, 1);
INSERT INTO `user_right` VALUES (429, 1, 19, 209, NULL, 1);
INSERT INTO `user_right` VALUES (430, 1, 19, 210, NULL, 1);
INSERT INTO `user_right` VALUES (431, 1, 19, 211, NULL, 1);
INSERT INTO `user_right` VALUES (432, 1, 19, 212, NULL, 1);
INSERT INTO `user_right` VALUES (433, 0, 19, 213, NULL, 1);
INSERT INTO `user_right` VALUES (434, 0, 19, 214, NULL, 1);
INSERT INTO `user_right` VALUES (435, 0, 19, 215, NULL, 1);
INSERT INTO `user_right` VALUES (436, 0, 24, 216, NULL, 1);
INSERT INTO `user_right` VALUES (437, 0, 24, 217, NULL, 1);
INSERT INTO `user_right` VALUES (438, 0, 24, 218, NULL, 1);
INSERT INTO `user_right` VALUES (439, 0, 24, 219, NULL, 1);
INSERT INTO `user_right` VALUES (440, 0, 24, 220, NULL, 1);
INSERT INTO `user_right` VALUES (441, 0, 24, 221, NULL, 1);
INSERT INTO `user_right` VALUES (442, 0, 24, 222, NULL, 1);
INSERT INTO `user_right` VALUES (443, 0, 24, 223, NULL, 1);
INSERT INTO `user_right` VALUES (444, 1, 24, 216, NULL, 1);
INSERT INTO `user_right` VALUES (445, 1, 24, 217, NULL, 1);
INSERT INTO `user_right` VALUES (446, 1, 24, 218, NULL, 1);
INSERT INTO `user_right` VALUES (447, 1, 24, 219, NULL, 1);
INSERT INTO `user_right` VALUES (448, 1, 24, 220, NULL, 1);
INSERT INTO `user_right` VALUES (449, 1, 24, 221, NULL, 1);
INSERT INTO `user_right` VALUES (450, 1, 24, 222, NULL, 1);
INSERT INTO `user_right` VALUES (451, 1, 24, 223, NULL, 1);
INSERT INTO `user_right` VALUES (452, 3, 19, 212, NULL, 1);
INSERT INTO `user_right` VALUES (453, 3, 19, 209, NULL, 1);
INSERT INTO `user_right` VALUES (454, 3, 19, 208, NULL, 1);
INSERT INTO `user_right` VALUES (455, 3, 19, 210, NULL, 1);
INSERT INTO `user_right` VALUES (456, 3, 19, 211, NULL, 1);
INSERT INTO `user_right` VALUES (457, 3, 19, 150, NULL, 1);
INSERT INTO `user_right` VALUES (458, 3, 19, 169, NULL, 1);
INSERT INTO `user_right` VALUES (459, 3, 19, 166, NULL, 1);
INSERT INTO `user_right` VALUES (460, 3, 19, 156, NULL, 1);
INSERT INTO `user_right` VALUES (461, 3, 19, 157, NULL, 1);
INSERT INTO `user_right` VALUES (462, 3, 19, 158, NULL, 1);
INSERT INTO `user_right` VALUES (463, 3, 19, 159, NULL, 1);
INSERT INTO `user_right` VALUES (464, 3, 19, 168, NULL, 1);
INSERT INTO `user_right` VALUES (465, 1, 3, 185, NULL, 1);
INSERT INTO `user_right` VALUES (466, 1, 3, 186, NULL, 1);
INSERT INTO `user_right` VALUES (467, 4, 3, 8, NULL, 1);
INSERT INTO `user_right` VALUES (468, 4, 3, 9, NULL, 1);
INSERT INTO `user_right` VALUES (469, 4, 3, 12, NULL, 1);
INSERT INTO `user_right` VALUES (470, 4, 3, 14, NULL, 1);
INSERT INTO `user_right` VALUES (471, 4, 3, 65, NULL, 1);
INSERT INTO `user_right` VALUES (472, 4, 3, 140, NULL, 1);
INSERT INTO `user_right` VALUES (473, 4, 3, 141, NULL, 1);
INSERT INTO `user_right` VALUES (474, 4, 3, 142, NULL, 1);
INSERT INTO `user_right` VALUES (475, 4, 3, 143, NULL, 1);
INSERT INTO `user_right` VALUES (476, 4, 3, 144, NULL, 1);
INSERT INTO `user_right` VALUES (477, 4, 3, 145, NULL, 1);
INSERT INTO `user_right` VALUES (478, 4, 3, 146, NULL, 1);
INSERT INTO `user_right` VALUES (479, 4, 3, 147, NULL, 1);
INSERT INTO `user_right` VALUES (480, 4, 3, 148, NULL, 1);
INSERT INTO `user_right` VALUES (481, 4, 3, 149, NULL, 1);
INSERT INTO `user_right` VALUES (482, 4, 3, 185, NULL, 1);
INSERT INTO `user_right` VALUES (483, 4, 3, 186, NULL, 1);
INSERT INTO `user_right` VALUES (484, 4, 3, 187, NULL, 1);
INSERT INTO `user_right` VALUES (485, 1, 25, 224, NULL, 1);
INSERT INTO `user_right` VALUES (486, 0, 25, 224, NULL, 1);
INSERT INTO `user_right` VALUES (487, 1, 25, 225, NULL, 1);
INSERT INTO `user_right` VALUES (488, 4, 25, 224, NULL, 1);
INSERT INTO `user_right` VALUES (489, 4, 25, 225, NULL, 1);
INSERT INTO `user_right` VALUES (490, 0, 25, 226, NULL, 1);
INSERT INTO `user_right` VALUES (491, 1, 25, 226, NULL, 1);
INSERT INTO `user_right` VALUES (492, 4, 25, 227, NULL, 1);
INSERT INTO `user_right` VALUES (493, 1, 25, 227, NULL, 1);
INSERT INTO `user_right` VALUES (494, 1, 25, 228, NULL, 1);
INSERT INTO `user_right` VALUES (495, 4, 25, 228, NULL, 1);
INSERT INTO `user_right` VALUES (496, 4, 25, 226, NULL, 1);
INSERT INTO `user_right` VALUES (497, 1, 25, 229, NULL, 1);
INSERT INTO `user_right` VALUES (498, 1, 25, 230, NULL, 1);
INSERT INTO `user_right` VALUES (499, 3, 25, 230, NULL, 1);
INSERT INTO `user_right` VALUES (500, 4, 25, 230, NULL, 1);
INSERT INTO `user_right` VALUES (501, 4, 25, 231, NULL, 1);
INSERT INTO `user_right` VALUES (502, 1, 25, 231, NULL, 1);
INSERT INTO `user_right` VALUES (503, 3, 25, 231, NULL, 1);
INSERT INTO `user_right` VALUES (504, 3, 25, 224, NULL, 1);
INSERT INTO `user_right` VALUES (505, 3, 25, 225, NULL, 1);
INSERT INTO `user_right` VALUES (506, 3, 25, 227, NULL, 1);
INSERT INTO `user_right` VALUES (507, 3, 25, 228, NULL, 1);
INSERT INTO `user_right` VALUES (508, 1, 25, 232, NULL, 1);
INSERT INTO `user_right` VALUES (509, 4, 25, 232, NULL, 1);
INSERT INTO `user_right` VALUES (510, 3, 25, 232, NULL, 1);
INSERT INTO `user_right` VALUES (511, 1, 25, 233, NULL, 1);
INSERT INTO `user_right` VALUES (512, 3, 25, 233, NULL, 1);
INSERT INTO `user_right` VALUES (513, 4, 25, 233, NULL, 1);
INSERT INTO `user_right` VALUES (514, 1, 25, 234, NULL, 1);
INSERT INTO `user_right` VALUES (515, 1, 25, 235, NULL, 1);
INSERT INTO `user_right` VALUES (516, 1, 26, 236, NULL, 1);
INSERT INTO `user_right` VALUES (517, 3, 26, 236, NULL, 1);
INSERT INTO `user_right` VALUES (518, 3, 26, 237, NULL, 1);
INSERT INTO `user_right` VALUES (519, 1, 26, 237, NULL, 1);
INSERT INTO `user_right` VALUES (520, 4, 26, 236, NULL, 1);
INSERT INTO `user_right` VALUES (521, 4, 26, 237, NULL, 1);
INSERT INTO `user_right` VALUES (522, 4, 26, 238, NULL, 1);
INSERT INTO `user_right` VALUES (523, 1, 26, 238, NULL, 1);
INSERT INTO `user_right` VALUES (524, 3, 26, 238, NULL, 1);
INSERT INTO `user_right` VALUES (525, 1, 26, 239, NULL, 1);
INSERT INTO `user_right` VALUES (526, 3, 26, 239, NULL, 1);
INSERT INTO `user_right` VALUES (527, 4, 26, 239, NULL, 1);
INSERT INTO `user_right` VALUES (528, 0, 26, 236, NULL, 1);
INSERT INTO `user_right` VALUES (529, 3, 25, 226, NULL, 1);
INSERT INTO `user_right` VALUES (530, 0, 26, 240, NULL, 1);
INSERT INTO `user_right` VALUES (531, 1, 26, 240, NULL, 1);
INSERT INTO `user_right` VALUES (532, 2, 26, 236, NULL, 1);
INSERT INTO `user_right` VALUES (533, 2, 26, 240, NULL, 1);
INSERT INTO `user_right` VALUES (534, 3, 26, 240, NULL, 1);
INSERT INTO `user_right` VALUES (535, 4, 26, 240, NULL, 1);
INSERT INTO `user_right` VALUES (536, 1, 26, 241, NULL, 1);
INSERT INTO `user_right` VALUES (537, 3, 26, 241, NULL, 1);
INSERT INTO `user_right` VALUES (538, 4, 26, 241, NULL, 1);
INSERT INTO `user_right` VALUES (539, 1, 26, 242, NULL, 1);
INSERT INTO `user_right` VALUES (540, 3, 26, 242, NULL, 1);
INSERT INTO `user_right` VALUES (541, 4, 26, 242, NULL, 1);
INSERT INTO `user_right` VALUES (542, 0, 26, 243, NULL, 1);
INSERT INTO `user_right` VALUES (543, 1, 26, 243, NULL, 1);
INSERT INTO `user_right` VALUES (544, 2, 26, 243, NULL, 1);
INSERT INTO `user_right` VALUES (545, 3, 26, 243, NULL, 1);
INSERT INTO `user_right` VALUES (546, 4, 26, 243, NULL, 1);
INSERT INTO `user_right` VALUES (547, 0, 26, 244, NULL, 1);
INSERT INTO `user_right` VALUES (548, 0, 26, 245, NULL, 1);
INSERT INTO `user_right` VALUES (549, 1, 26, 244, NULL, 1);
INSERT INTO `user_right` VALUES (550, 1, 26, 245, NULL, 1);
INSERT INTO `user_right` VALUES (551, 2, 26, 244, NULL, 1);
INSERT INTO `user_right` VALUES (552, 2, 26, 245, NULL, 1);
INSERT INTO `user_right` VALUES (553, 3, 26, 244, NULL, 1);
INSERT INTO `user_right` VALUES (554, 3, 26, 245, NULL, 1);
INSERT INTO `user_right` VALUES (555, 4, 26, 244, NULL, 1);
INSERT INTO `user_right` VALUES (556, 4, 26, 245, NULL, 1);
INSERT INTO `user_right` VALUES (557, 1, 3, 246, NULL, 1);
INSERT INTO `user_right` VALUES (558, 1, 3, 187, NULL, 1);
INSERT INTO `user_right` VALUES (559, 3, 3, 246, NULL, 1);
INSERT INTO `user_right` VALUES (560, 4, 3, 246, NULL, 1);
INSERT INTO `user_right` VALUES (561, 1, 3, 247, NULL, 1);
INSERT INTO `user_right` VALUES (562, 3, 3, 247, NULL, 1);
INSERT INTO `user_right` VALUES (563, 4, 3, 247, NULL, 1);
INSERT INTO `user_right` VALUES (564, 1, 27, 158, NULL, 1);
INSERT INTO `user_right` VALUES (565, 1, 27, 159, NULL, 1);
INSERT INTO `user_right` VALUES (566, 3, 27, 158, NULL, 1);
INSERT INTO `user_right` VALUES (567, 3, 27, 159, NULL, 1);
INSERT INTO `user_right` VALUES (568, 4, 27, 158, NULL, 1);
INSERT INTO `user_right` VALUES (569, 4, 27, 159, NULL, 1);
INSERT INTO `user_right` VALUES (570, 3, 19, 151, NULL, 1);
INSERT INTO `user_right` VALUES (571, 3, 19, 152, NULL, 1);
INSERT INTO `user_right` VALUES (572, 1, 27, 248, NULL, 1);
INSERT INTO `user_right` VALUES (573, 1, 28, 249, NULL, 1);
INSERT INTO `user_right` VALUES (574, 3, 28, 249, NULL, 1);
INSERT INTO `user_right` VALUES (575, 4, 28, 249, NULL, 1);
INSERT INTO `user_right` VALUES (576, 1, 28, 250, NULL, 1);
INSERT INTO `user_right` VALUES (577, 3, 28, 250, NULL, 1);
INSERT INTO `user_right` VALUES (578, 4, 28, 250, NULL, 1);
INSERT INTO `user_right` VALUES (579, 1, 28, 251, NULL, 1);
INSERT INTO `user_right` VALUES (580, 3, 28, 251, NULL, 1);
INSERT INTO `user_right` VALUES (581, 4, 28, 251, NULL, 1);
INSERT INTO `user_right` VALUES (582, 1, 28, 252, NULL, 1);
INSERT INTO `user_right` VALUES (583, 3, 28, 252, NULL, 1);
INSERT INTO `user_right` VALUES (584, 4, 28, 252, NULL, 1);
INSERT INTO `user_right` VALUES (585, 1, 28, 253, NULL, 1);
INSERT INTO `user_right` VALUES (586, 3, 28, 253, NULL, 1);
INSERT INTO `user_right` VALUES (587, 4, 28, 253, NULL, 1);
INSERT INTO `user_right` VALUES (588, 1, 1, 254, NULL, 1);
INSERT INTO `user_right` VALUES (589, 3, 1, 254, NULL, 1);
INSERT INTO `user_right` VALUES (590, 4, 1, 254, NULL, 1);
INSERT INTO `user_right` VALUES (591, 4, 1, 1, NULL, 1);
INSERT INTO `user_right` VALUES (592, 0, 3, 255, NULL, 1);
INSERT INTO `user_right` VALUES (593, 2, 3, 255, NULL, 1);
INSERT INTO `user_right` VALUES (594, 4, 8, 15, NULL, 1);
INSERT INTO `user_right` VALUES (595, 4, 8, 16, NULL, 1);
INSERT INTO `user_right` VALUES (596, 4, 8, 22, NULL, 1);
INSERT INTO `user_right` VALUES (597, 4, 8, 23, NULL, 1);
INSERT INTO `user_right` VALUES (598, 4, 8, 24, NULL, 1);
INSERT INTO `user_right` VALUES (599, 4, 8, 31, NULL, 1);
INSERT INTO `user_right` VALUES (600, 4, 8, 28, NULL, 1);
INSERT INTO `user_right` VALUES (601, 4, 8, 27, NULL, 1);
INSERT INTO `user_right` VALUES (602, 4, 8, 26, NULL, 1);
INSERT INTO `user_right` VALUES (603, 4, 8, 25, NULL, 1);
INSERT INTO `user_right` VALUES (604, 4, 8, 21, NULL, 1);
INSERT INTO `user_right` VALUES (605, 4, 17, 125, NULL, 0);
INSERT INTO `user_right` VALUES (606, 4, 17, 126, NULL, 1);
INSERT INTO `user_right` VALUES (607, 4, 17, 127, NULL, 1);
INSERT INTO `user_right` VALUES (608, 4, 17, 128, NULL, 1);
INSERT INTO `user_right` VALUES (609, 4, 17, 129, NULL, 1);
INSERT INTO `user_right` VALUES (610, 4, 17, 130, NULL, 1);
INSERT INTO `user_right` VALUES (611, 4, 17, 131, NULL, 1);
INSERT INTO `user_right` VALUES (612, 4, 17, 132, NULL, 1);
INSERT INTO `user_right` VALUES (613, 4, 15, 101, NULL, 1);
INSERT INTO `user_right` VALUES (614, 4, 15, 102, NULL, 1);
INSERT INTO `user_right` VALUES (615, 4, 15, 103, NULL, 1);
INSERT INTO `user_right` VALUES (616, 4, 15, 104, NULL, 1);
INSERT INTO `user_right` VALUES (617, 4, 15, 105, NULL, 1);
INSERT INTO `user_right` VALUES (618, 4, 15, 106, NULL, 1);
INSERT INTO `user_right` VALUES (619, 4, 15, 133, NULL, 1);
INSERT INTO `user_right` VALUES (620, 1, 3, 256, NULL, 1);
INSERT INTO `user_right` VALUES (621, 3, 3, 256, NULL, 1);
INSERT INTO `user_right` VALUES (622, 4, 3, 256, NULL, 1);
INSERT INTO `user_right` VALUES (623, 4, 28, 256, NULL, 1);
INSERT INTO `user_right` VALUES (624, 1, 28, 256, NULL, 1);
INSERT INTO `user_right` VALUES (625, 3, 28, 256, NULL, 1);
INSERT INTO `user_right` VALUES (626, 4, 9, 17, NULL, 1);
INSERT INTO `user_right` VALUES (627, 4, 9, 18, NULL, 1);
INSERT INTO `user_right` VALUES (628, 4, 9, 19, NULL, 1);
INSERT INTO `user_right` VALUES (629, 4, 9, 20, NULL, 1);
INSERT INTO `user_right` VALUES (630, 4, 9, 29, NULL, 1);
INSERT INTO `user_right` VALUES (631, 4, 9, 30, NULL, 1);
INSERT INTO `user_right` VALUES (632, 4, 9, 32, NULL, 1);
INSERT INTO `user_right` VALUES (633, 4, 9, 33, NULL, 1);
INSERT INTO `user_right` VALUES (634, 4, 9, 34, NULL, 1);
INSERT INTO `user_right` VALUES (635, 4, 9, 107, NULL, 1);
INSERT INTO `user_right` VALUES (636, 3, 30, 261, NULL, 1);
INSERT INTO `user_right` VALUES (637, 1, 30, 261, NULL, 1);
INSERT INTO `user_right` VALUES (638, 1, 30, 262, NULL, 1);
INSERT INTO `user_right` VALUES (639, 3, 30, 262, NULL, 1);
INSERT INTO `user_right` VALUES (640, 1, 30, 263, NULL, 1);
INSERT INTO `user_right` VALUES (641, 3, 30, 263, NULL, 1);
INSERT INTO `user_right` VALUES (642, 1, 30, 264, NULL, 1);
INSERT INTO `user_right` VALUES (643, 3, 30, 264, NULL, 1);
INSERT INTO `user_right` VALUES (644, 1, 30, 265, NULL, 1);
INSERT INTO `user_right` VALUES (645, 3, 30, 265, NULL, 1);
INSERT INTO `user_right` VALUES (646, 1, 30, 266, NULL, 1);
INSERT INTO `user_right` VALUES (647, 3, 30, 266, NULL, 1);

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- 
-- Дамп данных таблицы `user_type`
-- 

INSERT INTO `user_type` VALUES (0, 'Гость', 'Незарегестрированный пользователь2');
INSERT INTO `user_type` VALUES (1, 'Админ', 'Администраторы сайта');
INSERT INTO `user_type` VALUES (2, 'Неактивированные', 'Зарегестрировавшиеся, но не активированные пользователи');
INSERT INTO `user_type` VALUES (3, 'Зарегистрированный', 'Активированный аккаунт');
INSERT INTO `user_type` VALUES (4, 'Сайт-партнер', 'Сайт-партнер - пользователь, размещающий свои RSS-новости');

-- --------------------------------------------------------

-- 
-- Структура таблицы `users`
-- 

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL auto_increment,
  `login` varchar(255) character set cp1251 NOT NULL,
  `first_name` varchar(50) character set cp1251 default NULL,
  `middle_name` varchar(50) character set cp1251 default NULL,
  `last_name` varchar(50) character set cp1251 default NULL,
  `email` varchar(255) character set cp1251 NOT NULL,
  `pass` varchar(255) character set cp1251 NOT NULL,
  `salt` varchar(40) NOT NULL,
  `birth_date` date default NULL,
  `gender` tinyint(3) default NULL,
  `about` text character set cp1251,
  `interest` text character set cp1251,
  `books` text,
  `films` text,
  `musicians` text,
  `marital_status` varchar(255) default NULL,
  `icq` varchar(30) default NULL,
  `website` varchar(40) default NULL,
  `phone` varchar(40) default NULL,
  `mobile_phone` varchar(40) default NULL,
  `referal` int(10) unsigned NOT NULL default '0',
  `reg_date` datetime default NULL,
  `su_vis_date` datetime default NULL,
  `group_id` int(11) default NULL,
  `country_id` int(11) default NULL,
  `state_id` int(11) default NULL,
  `city_id` int(11) default NULL,
  `hash` varchar(255) character set cp1251 default NULL,
  `tabs_map` text,
  `reputation` double default NULL,
  `nextmoney` double default NULL,
  `user_type_id` tinyint(4) default NULL,
  `registration_date` datetime default NULL,
  `banned` int(2) default NULL,
  `banned_date` int(11) default '0',
  `warnings_fromlast_ban` int(11) default '0',
  `rate` int(11) default '0',
  `logged_time` bigint(20) default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=226 DEFAULT CHARSET=utf8 AUTO_INCREMENT=226 ;

-- 
-- Дамп данных таблицы `users`
-- 

INSERT INTO `users` VALUES (1, 'admin', 'Artem', 'Valerievich', 'Kuznetsov', 'admin@mail.ru', '33333333336bf67a836cc199c1becd3d27cb0d19a8', '3333333333', '1979-07-12', 1, 'О себе', '11', '222', '333', 'Любимые музыканты', 'женат', '1233444', '555555', '111', '2222', 0, NULL, NULL, 0, 173, 0, 0, '', 'a:4:{i:0;a:2:{s:2:"id";s:1:"0";s:8:"selected";b:1;}i:1;a:2:{s:2:"id";s:1:"1";s:8:"selected";b:1;}i:2;a:2:{s:2:"id";s:1:"2";s:8:"selected";b:1;}i:3;a:2:{s:2:"id";s:1:"3";s:8:"selected";b:1;}}', 0, 40.93, 1, '2008-01-04 00:00:00', 0, 0, 0, 8, 41903);
INSERT INTO `users` VALUES (2, '2', 'Тест', 'Пользователь', 'Фамилия', 'a@email.com', '33333333330343db98dcf6dd0601125a5d93ec8325', '3333333333', NULL, 1, 'asd', '', '', '', '', '', '', '', '', '', 0, NULL, NULL, 1, 1, NULL, NULL, 'sdfdsfsd', 'a:4:{i:0;a:2:{s:2:"id";s:1:"0";s:8:"selected";b:1;}i:1;a:2:{s:2:"id";s:1:"1";s:8:"selected";b:1;}i:2;a:2:{s:2:"id";s:1:"2";s:8:"selected";b:1;}i:3;a:2:{s:2:"id";s:1:"3";s:8:"selected";b:1;}}', 0, 474.77, 4, '2008-02-09 00:00:00', 0, 1229099387, 0, 5, 1963);
INSERT INTO `users` VALUES (3, '3', 'Василий', 'Иванович', 'Петров', '3@3.3', '3e9805f1319e9926db961a22c939ddb5cc4d4a8fcc', '3e9805f131', '1978-05-04', 1, 'asdfsdf', '', '', '', '', '', '', '', '', '', 0, NULL, NULL, 1, 1, NULL, NULL, 'werewr', 'a:4:{i:0;a:2:{s:2:"id";s:1:"0";s:8:"selected";b:1;}i:1;a:2:{s:2:"id";s:1:"3";s:8:"selected";b:1;}i:2;a:2:{s:2:"id";s:1:"2";s:8:"selected";b:1;}i:3;a:2:{s:2:"id";s:1:"1";s:8:"selected";b:1;}}', 0, 470.4, 3, NULL, 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (5, '4', '', '', '', 'as@as.ru', '33333333330343db98dcf6dd0601125a5d93ec8325', '3333333333', '1945-01-01', 0, '', NULL, '', '', '', '', '', '', '', '', 0, NULL, NULL, NULL, 3, 0, 0, NULL, '1111111', 0, 510.3, 3, '2008-03-23 17:33:08', 0, 0, 0, 2, 0);
INSERT INTO `users` VALUES (6, '5', '', '', '', 'asd@asd.ru', '33333333330343db98dcf6dd0601125a5d93ec8325', '3333333333', '1945-01-01', 0, '', NULL, '', '', '', '', '', '', '', '', 0, NULL, NULL, NULL, 3, 0, 0, NULL, '1111111', 0, 0, 3, '2008-03-23 17:33:38', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (7, '6', 'S', 'D', 'A', 'LexxUkr@gmail.com', '33333333330343db98dcf6dd0601125a5d93ec8325', '3333333333', '1984-05-09', 1, '', NULL, '', '', '', '', '', '', '', '', 0, NULL, NULL, NULL, 225, 3871, 21677, NULL, '1111111', 0, 0, 3, '2008-03-23 23:41:19', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (14, 'stepanov', '', '', '', 'stepanov@gekos.ru', 'b1de656572bee04bc206bfdc6921cdfef351a6bb1d', 'b1de656572', '1945-01-01', 0, '', NULL, '', '', '', '', '', '', '', '', 0, NULL, NULL, NULL, 4, 0, 0, NULL, '1111111', 0, 0, 3, '2008-06-13 16:32:56', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (15, 'avtootbet', '', '', '', 'avtootbet@yandex.ru', '086793cbe205fbe4c65343eaed4dea6eead8d2f42a', '086793cbe2', '1945-01-01', 0, '', NULL, '', '', '', '', '', '', '', '', 0, NULL, NULL, NULL, 4, 0, 0, NULL, '1111111', 0, 0, 3, '2008-06-16 09:26:49', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (16, 'kolmanovsky', '', '', '', 'kolmanovsky2007@yandex.ru', 'dd2e2ff214a6aa28f9bd37ad3a23a38f50411da32f', 'dd2e2ff214', '1945-01-01', 0, '', NULL, '', '', '', '', '', '', '', '', 0, NULL, NULL, NULL, 4, 0, 0, NULL, '1111111', 0, 0, 3, '2008-06-16 09:29:29', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (17, 'napishinapishimne', '', '', '', 'napishinapishimne@yandex.ru', '49828386d00d4dd3050a07488d7f47e92a9d1027c1', '49828386d0', '1945-01-01', 0, '', NULL, '', '', '', '', '', '', '', '', 0, NULL, NULL, NULL, 4, 0, 0, NULL, '1111111', 0, 0, 3, '2008-06-16 09:34:07', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (18, 'simonoff-stefan', '', '', '', 'simonoff-stefan@yandex.ru', '42efe8963d5535c340f862eaeb2be5def1a320d510', '42efe8963d', '1945-01-01', 0, '', NULL, '', '', '', '', '', '', '', '', 0, NULL, NULL, NULL, 4, 0, 0, NULL, '1111111', 0, 0, 3, '2008-06-16 09:36:12', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (19, 'abdulaselin', '', '', '', 'abdulaselin@yandex.ru', '389f4c6ebfc3132812229da9fe88d01d302756bb68', '389f4c6ebf', '1945-01-01', 0, '', NULL, '', '', '', '', '', '', '', '', 0, NULL, NULL, NULL, 4, 0, 0, NULL, '1111111', 0, 0, 3, '2008-06-16 09:36:50', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (20, 'lerman9000', '', '', '', 'lerman9000@yandex.ru', 'ca4667de1677bc44e2f839aa9cd157372a2fb71355', 'ca4667de16', '1945-01-01', 0, '', NULL, '', '', '', '', '', '', '', '', 0, NULL, NULL, NULL, 4, 0, 0, NULL, '1111111', 0, 0, 3, '2008-06-16 09:37:26', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (21, 'ZAZdriver', '', '', '', 'ZAZdriver@yandex.ru', '9f92e2dc2091572af21f51ce53880cd36c08cd0c56', '9f92e2dc20', '1945-01-01', 0, '', NULL, '', '', '', '', '', '', '', '', 0, NULL, NULL, NULL, 4, 0, 0, NULL, '1111111', 0, 0, 3, '2008-06-16 09:38:03', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (22, 'complector', '', '', '', 'complector@yandex.ru', '1b177240d70c2202a60e415873e030fe7cc3f37a81', '1b177240d7', '1945-01-01', 0, '', NULL, '', '', '', '', '', '', '', '', 0, NULL, NULL, NULL, 4, 0, 0, NULL, '1111111', 0, 0, 3, '2008-06-16 09:40:14', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (23, 'Samuray', 'Дмитрий', 'Геннадиевич', 'Амосов', 'samurais@gmail.com', '0a72158d1adf8aa205ead724249445a75fc39a72f8', '0a72158d1a', '1984-06-18', 1, 'Хочу найти друзей, одноклассников и единомышленников. Я брюнет, спортивного телосложения, не женат, живу один, снимаю квартиру, детей у меня нет, курю.  Я умею фотографировать, ездить на велосипеде, управляться с яхтой, вязать морские узлы, разбираться с компьютером и бытовой техникой... Разбираюсь в предметах: психология, интернет и техника. Знаю английский. ', NULL, 'Дети капитана Гранта, Черная метка, Остров сокровищ', 'Одиссея капитана Блада, Пираты Карибского моря', 'Олег Газманов, ДДТ', 'не женат', '467-567-356', '', '', '', 21, NULL, NULL, NULL, 3159, 3529, 3543, NULL, '1111111', 0, 0, 3, '2008-06-16 11:09:04', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (24, 'Innochka', 'Инна', 'Викторовна', 'Фролова', 'konfetka@list.ru', '6b4aedc2b9c9cc74ae5e33850a9e5840e494a1f13a', '6b4aedc2b9', '1987-06-18', 0, 'Люблю поболтать о всякой фигне))) Смотреть ТВ, и лазить в нете)', NULL, '"Отцы и дети", "Преступление и наказание"', '"Не родись красивой",  "Дневники няни" , "Любовь с уведомлением"\r\n', 'Fergie, Gwen Stefani и др.', 'нежената', '578-875-478', '', '', '', 0, NULL, NULL, NULL, 3159, 3675, 3689, NULL, '1111111', 0, 0, 3, '2008-06-16 11:18:21', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (25, 'MaxImus', 'Неводин', 'Александрович', 'Максим', 'maksimnv@mail.ru', '1988ad9e58b8756ce61bae840e373afcfc4c3eaf22', '1988ad9e58', '1985-07-18', 1, 'Я могу сказать про себя что я жизнерадостный человек, добрый (иногда наивный), отзывчивый, человек ищущий приключения на свою голову. Хочу найти друзей и любовь. Я брюнет, среднего телосложения, холост, живу с родителями, детей у меня нет, не курю.', NULL, '"Властелин колец", "Гарри Поттер и философский камень"', '"Властелин колец", "Гарри Поттер"', 'Enya, Nightwish', 'не женат', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3892, 3911, NULL, '1111111', 0, 0, 3, '2008-06-16 11:25:26', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (26, 'ZENNNN', 'Евгений', 'Иванович', 'Мостовой', 'mostovoy@bk.ru', 'ec5c00dfdd7294379455d28652ab36406bd7236877', 'ec5c00dfdd', '1982-07-22', 1, 'Я умею много что,но люблю гАмАтЬ!!!. Разбираюсь в предметах: русский язык, математика, дизайн и интернет. Знаю английский и немецкий. ', NULL, 'Приключения Электроника, Алиса в стране чудес, человек-амфибия', 'Терминатор, Терминатор-2, Терминатор-3', 'Ария, Раммштайн, Nine Inch Nails', '', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4243, 4258, NULL, '1111111', 0, 0, 3, '2008-06-16 11:32:37', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (27, 'Paul', 'Семен', 'Олегович', 'Павлов', 'pavlov-sen@yandex.ru', '534c709eaaaf24f91e7dfb4f075d8a77e67df771a9', '534c709eaa', '1989-06-23', 1, 'я общительный и энергичный парень, хочу найти здесь друзей\r\nЯ блондин, среднего телосложения, холост, живу с родителями, детей у меня нет, не курю.  Я умею танцевать. Знаю английский. \r\n', NULL, 'большая советская энциклопедия)', '8 Миля, Рэпер, Рэпер-2', '50 Cent, Эминем, Децл', '', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3675, 3686, NULL, '1111111', 0, 0, 3, '2008-06-16 11:39:23', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (28, 'BUrT', 'Сергей', 'Александрович', 'Стехин', 'stexxxxx@mail.ru', 'ff5b5c038365b54b28cb1b1eeeb1c2601532945b7d', 'ff5b5c0383', '1945-01-01', 1, 'Я крейзи человек!)В моих действиях часто нет смысла! Они просто абсурдные! Человек который любит рок и дружит с реперами не может быть нормальным!Мой кристальный ясен и полный красочных картин, ', NULL, NULL, NULL, NULL, '', '', '', '', '', 0, NULL, NULL, NULL, 9908, 10455, 10473, NULL, '1111111', 0, 0, 3, '2008-06-16 11:54:23', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (29, 'taisia', 'Таис', 'Ахмедовна', 'Джамшатова', 'taicia1979@rambler.ru', 'bd5c4885c61a7b5565be1e6801ff3d10d53576f2c7', 'bd5c4885c6', '1979-10-23', 0, 'с причудами..', NULL, 'фантастика,сказки,приключения,мистика.. Булгаков,Панов,Булычев,и многие другие...', 'комедии,романтика,фантастика,приключения,ужасы,меллодрамы', 'слушаю все подряд', '', '578479984', '', '', '', 0, NULL, NULL, NULL, 1894, 1974, 1985, NULL, '1111111', 0, 0, 3, '2008-06-16 12:03:50', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (30, 'FURDER', 'Виктор', 'Михайлович', 'Саблев', 'furder@gmail.com', 'aa85d696638930bc3af479c392b516a124da5d5499', 'aa85d69663', '1971-09-16', 1, 'Ведущий тренингов. Эксперт по отношениям. Разработка стратегий успешности. НЛП. Индивидуальные консультации. Рейки II. Тантра. Телесные практики. Массаж. Рефлексотерапия. Развитие чувственности.', NULL, '"Гиперболоид инженера Гарина", "Последняя война" (Кир Булычев)', 'Криминальное чтиво, Трасса 60,Чужие, Место встречи изменить нельзя, Апокалипсис, Форест Гамп, Бегущий по лезвию', 'Pink Floyd, The Beatles, Deep Purple', '', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3921, 3940, NULL, '1111111', 0, 0, 3, '2008-06-16 12:14:38', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (31, 'TANE4KA', 'Татьяна', 'Викторовна', 'Кравцова', 'kravtsova.t@gmail.com', 'dffa33eca4f70a07ff3c6e3c375174715d4c94ccd0', 'dffa33eca4', '1980-02-27', 0, 'Веселая, добрая, жизнерадостная и смешная. Желаю и вам того же.\r\n', NULL, 'Дозоры Лукьяненко, Гарри Поттер(не смейтесь), Братья Стугацкие, Стивен Кинг, Харуки Мураками, Робин Шарма', 'Бойцовский клуб, Искусственный интелект, Игры разума, Эффект бабочки, Матрица, Троя, Мистер и Миссис Смитт, Хроники Ридика, Сладкий ноябрь, все фильмы с участием Джони Деппа, Бреда Пита, Вина Дизеля, Киану Ривза', '', '', '678341976', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4319, NULL, '1111111', 0, 0, 3, '2008-06-16 12:20:00', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (32, 'sergey', 'Сергей', 'Дмитриевич', 'Иваненко', 'ivanenko@list.ru', '2d02c1bb45e8e9f3f87a6e3a4c3a488be0a13893fe', '2d02c1bb45', '1979-03-20', 1, 'По жизни оптимист, активная и жизнерадостный (но не всегда). Люблю спорт и романтику. Мечтаю... но не долго реальность жизни опускает на землю......', NULL, 'Мураками, Фаулз, Веллер, Акунин, О.Уальд, Ш.Бодлер', 'Гладиатор, Троя, Александр', 'Любимая - диско 80-х Вырос я на Наутилусе, Аквариуме, Кино, Rolling Stones, Beatles. что продолжаю слущать по сей день вместе с Чиж и Ко, Машина Времени, Земфира, Scorpions, Garbage,Blink 182 и многое другое... Вообще всеяден, кроме махровой попсы, тупого шансона и заунывно-лубочно-веселой русско-народной.', '', '438-489-587', '', '', '', 0, NULL, NULL, NULL, 9908, 10504, 10515, NULL, '1111111', 0, 0, 3, '2008-06-16 12:28:37', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (33, 'Agata', 'Ира', 'Сергеевна', 'Масонова', 'fufirka29@yandex.ru', '4fe20b8e78d6cffa1b1f037550af2cb0b8ec5ff155', '4fe20b8e78', '1992-05-21', 0, 'НУ я живу в основном музыкой..)\r\n\r\nлюблю веселых людей)\r\n\r\nну я даж не знаю че сказать))\r\n\r\nя новенькая))так что не удивляйтесь оформлению)хD\r\n\r\n', NULL, 'нету', 'Хэллоуин, Дом 1000 трупов, Дракула, Грот, Джек-Потрошитель, Зомби', 'Placebo, Nirvana, My Chemical Romance, 30 seconds to Mars, Marilyn Manson, Slipknot, The Used, Panic! At The Disco, FOb, Linkin Park, Limp Bizkit, Sum 41, alesana', '', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4338, NULL, '1111111', 0, 0, 3, '2008-06-16 12:36:07', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (34, 'adelia', '', '', '', 'adelia@inbox.ru', 'cfb2e2fd7268254f18f48e5912ed47898ab991ae62', 'cfb2e2fd72', '1945-01-01', 0, '', NULL, '', '', '', '', '', '', '', '', 0, NULL, NULL, NULL, 4, 0, 0, NULL, '1111111', 0, 0, 3, '2008-06-24 12:18:23', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (35, 'yves', 'Надежда', 'Савельевна  ', 'Валькова', 'adelia-marta1@yandex.ru', '34a9911b7cc1ac3f610f659c1c6af58ffc35df5727', '34a9911b7c', '1983-03-01', 0, 'Я ПРОСТО ЧУДО. Если я боюсь, то потерять что-то близкое и родное. Я говорю только то, что считаю нужным. Я решила, что я буду той кем я являюсь: немного застенчивой, чуточку стервозной.\r\n', NULL, 'Пауло Коэльо "Заир"', '"Красота по американски"', 'Enigma', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 1998532, 1998542, NULL, '1111111', 0, 0, 3, '2008-06-24 16:00:36', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (36, 'ylon', 'Лейла', 'Семеновна  ', 'Белогузова', 'adelia-marta2@yandex.ru', 'b55b15960e137b0179b306506aa8c9870d5a49e7c7', 'b55b15960e', '1990-05-02', 0, 'Не дурнушка, не красавица, не отвязная, и не зануда. Но всем, кто со мной общается, просто весело :)', NULL, 'Все книги Кэндес Бушнел', 'Дьявол носит "Прада"', 'Больше всего нравится зарубежная танцевальная музыка', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3160, 3166, NULL, '1111111', 0, 0, 3, '2008-06-24 16:06:34', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (37, 'wide', 'Егор', 'Анисимович  ', 'Александров', 'adelia-marta3@yandex.ru', 'ee65c37beb615c227c62c33efa8499f87671b2e8ec', 'ee65c37beb', '1989-06-04', 1, 'Дивный юноша обожающий альтернативу во всех направлениях, а может просто нарцисс', NULL, '', 'Сталкер\r\n', 'Альтернативная музыка\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3160, 3169, NULL, '1111111', 0, 0, 3, '2008-06-24 16:12:14', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (38, 'west', 'Денис', 'Аркадьевич  ', 'Манохин', 'adelia-marta4@yandex.ru', '5483971ba12918383f51a82d935ebdfe944a18661d', '5483971ba1', '1986-08-06', 1, 'Писатель, мыслитель... инженер', NULL, '"Молитва об Оуэне Мини" Ирвинга', 'Трасса 60', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 248, 249, 255, NULL, '1111111', 0, 0, 3, '2008-06-24 16:16:27', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (39, 'zhest', 'Нана', 'Руслановна  ', 'Демкова', 'adelia-marta5@yandex.ru', '28f6a976a3e4af9cc17401a4f4fbf05b740ac202ff', '28f6a976a3', '1984-03-08', 0, 'Не торопите события - вдруг не сможете за ними поспеть?', NULL, 'Любимая, любимая, очень, любимая, книга', '"Эквилибриум"', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3160, 3176, NULL, '1111111', 0, 0, 3, '2008-06-24 16:26:15', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (40, 'zhenya', 'Евгения', 'Степановна  ', 'Новгородцева', 'adelia-marta6@yandex.ru', '98a00cbeac58cad03be4368eccf1c587038d424fc9', '98a00cbeac', '1987-06-10', 0, 'Человек в этом мире людей', NULL, 'Еще не определилась', 'Фильмы с участием Миронова', 'что нибудь из зарубежного бессловесного транса', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3223, 3227, NULL, '1111111', 0, 0, 3, '2008-06-24 16:31:23', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (41, 'zoom', 'Виталий', 'Павлович', 'Белков', 'adelia-marta7@yandex.ru', '74962dc0e3b0b95489bf56ae3690d8f0a38ef1321b', '74962dc0e3', '1990-09-12', 1, '', NULL, '', '', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3223, 3245, NULL, '1111111', 0, 0, 3, '2008-06-24 17:03:01', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (42, 'tamara', 'Тамара', 'Всеволодовна  ', 'Истраиовна', 'adelia-marta8@yandex.ru', 'b68a4486f16d007230b86bc5c2d7ef05ce3df2bcf6', 'b68a4486f1', '1987-04-14', 0, 'я за яркость, красоту, позитивность, лучшее ведь враг хорошего', NULL, '', 'обыкновенное чудо, тот самый мюнхгаузен', 'moby, enya', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 9908, 10002, 10029, NULL, '1111111', 0, 0, 3, '2008-06-24 17:08:48', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (43, 'taina', 'Полина', 'Матвеевна  ', 'Зиберт', 'adelia-marta9@yandex.ru', '9e09f469cb3fc8b02ef7f8a9b4e0e4191847a95b92', '9e09f469cb', '1989-10-15', 0, 'Я открытая, честная, люблю приключений, вообщем очень хорошая!', NULL, 'Популярная психология\r\n', '', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3223, 3234, NULL, '1111111', 0, 0, 3, '2008-06-24 17:13:40', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (44, 'time', 'Кристина', 'Тарасовна  ', 'Александрова', 'adelia-marta10@yandex.ru', '90d80132666146023253bd834571bf3003f595bedb', '90d8013266', '1983-07-16', 0, 'Мое доверие безмерно.\r\nОдновременно его нет.\r\nЯ откровенна несомненно, \r\nНо недоступность - мой секрет.', NULL, 'Книги Виктории Токаревой', 'Светлые и добрые комедии', 'Бутусов', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3251, 3253, NULL, '1111111', 0, 0, 3, '2008-06-24 17:19:31', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (45, 'zyx89', 'Сергей', 'Романович  ', 'Брянский', 'adelia-marta11@yandex.ru', '42394173802f4657dfa9975a7212b71c8ff238b8d4', '4239417380', '1989-03-18', 1, 'восемь девять ноль три семьсот шестьдесят два двадцать девять сорок четыре\r\n', NULL, '', '', 'напавления поп-рок', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3251, 3271, NULL, '1111111', 0, 0, 3, '2008-06-24 17:24:29', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (46, 'zet88', 'Евгений', 'Леонидович  ', 'Иванов', 'adelia-marta12@yandex.ru', '4c0f9b68d9984b232719b783d38be9bb2c80f3e94f', '4c0f9b68d9', '1988-11-05', 1, 'Обычный человек без претензий', NULL, 'книги Макса Фрая', '', 'к чему это', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3251, 3277, NULL, '1111111', 0, 0, 3, '2008-06-24 17:29:09', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (47, 'voron', 'Николай', 'Робертович  ', 'Гришунин', 'adelia-marta13@yandex.ru', 'a6c10287b24b9fbc8c5e4effda85529e5da30d8228', 'a6c10287b2', '1987-03-13', 1, 'Студент-карьерист с большими амбициями ;)', NULL, '', '', 'Транс, электронная музыка', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3282, 3283, NULL, '1111111', 0, 0, 3, '2008-06-24 17:34:22', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (48, 'tima', 'Дуня', 'Владимировна  ', 'Боровая', 'adelia-marta14@yandex.ru', '3c52837a684fa07946cb9d735499e156c7df500096', '3c52837a68', '1986-10-02', 0, 'Очень даже хорошая, умная и вообще я считаю я очень симпатичная…\r\n', NULL, 'Свияш, Синельников\r\n', '', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3282, 3283, NULL, '1111111', 0, 0, 3, '2008-06-24 17:40:46', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (49, 'tanya', 'Татьяна', 'Вадимовна  ', 'Казарина', 'adelia-marta15@yandex.ru', 'b293298249b997379efb136d9d9161f50abc94b0a3', 'b293298249', '1982-05-20', 0, 'скромная, но иногда и могу показать коготки… А вообще у каждого есть свои слабости\r\n', NULL, 'Тонио Бенаквиста\r\n', 'Ванильное небо\r\n', 'Дженифер Лопес\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3282, 3284, NULL, '1111111', 0, 0, 3, '2008-06-24 17:45:54', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (50, 'vlad', 'Владимир', 'Антонович  ', 'Совдеев', 'adelia-marta16@yandex.ru', '7b0b246cf818f1efa8308db4c148f7767d62c70af5', '7b0b246cf8', '1990-08-30', 1, 'Говорят, на земле есть семь чудес света, но есть еще одно самое прекрасное - это Я, ведь Я — бесконечно доброе, феноменально умное, чертовски привлекательное, божественно красивое, исключительно порядочное и кристально честное, беспрецедентно талантливое, гиперсексуальное, бесподобно бесподобное — ЧУДОВИЩЕ!\r\n', NULL, 'стихи Омара Хаяма\r\n', 'Прибытие поезда\r\n', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3282, 3295, NULL, '1111111', 0, 0, 3, '2008-06-24 17:54:26', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (51, 'sever', 'Алиса', 'Глебовна  ', 'Парадкова', 'adelia-marta17@yandex.ru', '7172d0903eead59d1c6ae669b76365daea7e989fa6', '7172d0903e', '1984-09-04', 0, 'Всем привет!О себе говорить сложно и не правильно, поэтому я этого делать не буду.)\r\n', NULL, 'Зинаида Гиппиус Теффи\r\n', '', 'Карузо\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3282, 3283, NULL, '1111111', 0, 0, 3, '2008-06-24 18:03:33', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (52, 'sneg', 'Дарья', 'Герасимовна  ', 'Илеткина', 'adelia-marta18@yandex.ru', 'd15ec43c0c835cf1edcf073f07c52bf47107b21c3b', 'd15ec43c0c', '1989-03-22', 0, '"""Если ты чего-нибудь хочешь, Вся Вселенная будет способствовать тому, чтобы твое желание исполнилось"" Пауло Коэльо ""Алхимик"" ""Всегда стремись уловить тот миг, когда следует предпринять должные шаги"" Лао-цзы\r\n"\r\n', NULL, 'книги М.Барщевского\r\n', 'Зеленая миля\r\n', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 9908, 10504, 10532, NULL, '1111111', 0, 0, 3, '2008-06-24 18:16:55', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (53, 'snezshana', 'Снежана', 'Афанасьевна  ', 'Инютина', 'adelia-marta19@yandex.ru', 'ec9c55fb94409ed1bb32a0c3765a950f4725ce8728', 'ec9c55fb94', '1998-07-01', 0, 'Не люби никого, и ты будешь нравиться всем! Посылай к чёрту весь мир, и тобой будут восхищаться!\r\n', NULL, '"Гордость и предубеждение"\r\n', 'Студия 54\r\n', 'Классика\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3282, 3283, NULL, '1111111', 0, 0, 3, '2008-06-24 18:25:58', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (54, 'vist', 'Константин', 'Алексеевич  ', 'Погодин', 'adelia-marta20@yandex.ru', 'c74dc5a09a51ca0695175caa4899ef03b2a4707875', 'c74dc5a09a', '1983-01-12', 1, 'Молодой человек без проблем и отклонений\r\n', NULL, '', 'Scarface\r\n', 'Frank Sinatra\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3296, 3306, NULL, '1111111', 0, 0, 3, '2008-06-24 18:33:50', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (55, 'ural', 'Денис', 'Тарасович  ', 'Камохин', 'adelia-marta21@yandex.ru', '7024d9cfc95d200801b4a7d1e4be5caa9b6f6bac4d', '7024d9cfc9', '1982-06-19', 1, 'Стараюсь получить от этой жизни все... Какой я - не мне судить\r\n', NULL, '', '', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3296, 3345, NULL, '1111111', 0, 0, 3, '2008-06-24 18:44:40', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (56, 'uno2000', 'Андрей', 'Егорович  ', 'Камушкин', 'adelia-marta22@yandex.ru', 'a31055caf03794a8f0cce6325e2f7071e591d3d341', 'a31055caf0', '1984-01-09', 1, 'Дизайнер. Фотограф и вообще творческая личность.\r\n', NULL, '', '', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3352, 3354, NULL, '1111111', 0, 0, 3, '2008-06-24 18:48:59', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (57, 'ufolog', 'Николай', 'Андреевич  ', 'Патук', 'adelia-marta23@yandex.ru', '9309764054799f64ede3a4d4ff9b25692ebd97c75a', '9309764054', '1988-03-24', 1, 'Beautiful liar!\r\n', NULL, '', 'Бойцовский клуб', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3352, 3354, NULL, '1111111', 0, 0, 3, '2008-06-24 18:55:30', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (58, 'sabrina', 'Надежда', 'Игнатьевна  ', 'Ремнева', 'adelia-marta24@yandex.ru', '0102cca5e1cba05d86e15327d1c623ecd0e66c6c33', '0102cca5e1', '1988-10-26', 0, 'эксклюзивная личность) \r\n\r\n\r\nЯ бываю такая разная:\r\nто капризная, то прекрасная, \r\nто страшилище опупенное, \r\nто красавица - мисс вселенная, \r\nто покладиста, то с характером, \r\nто молчу, то ругаюся матерно, \r\nто в горящие избы на лошади...\r\nто отчаянно требую помощи, \r\nдверью хлопну- расставлю все точки \r\nто ласкаюсь пушистым комочком\r\nя люблю и тотчас ненавижу, \r\nя боюсь высоты, но на крышу \r\nвыхожу погулять темной ночкой...\r\nто жена, то примерная дочка...\r\nто смеюсь, то рыдаю белугой, \r\nто мирюсь, то ругаюсь с подругой, \r\n...\r\nне больна я, не в психике трещина, \r\nпросто я - стопроцентная женщина!\r\n', NULL, 'Шацкая "Стервология"\r\n', 'Блондинка в законе\r\n', 'Аврил Лавин\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3352, 3354, NULL, '1111111', 0, 0, 3, '2008-06-24 19:00:56', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (59, 'trust', 'Антон', 'Станиславович  ', 'Сернов', 'adelia-marta25@yandex.ru', 'b4a0efb22bcaed6a910ac25d7ff0cd8dbbdd9a3d99', 'b4a0efb22b', '1983-05-03', 1, 'Капитан Смоллет: характер скверный, любит говорить всем правду в глаза, от чего и страдает, не женат…\r\n', NULL, '', '', 'барды, авторская песня\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3371, 3376, NULL, '1111111', 0, 0, 3, '2008-06-24 19:05:05', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (60, 'smuta', 'Марина', 'Николаевна  ', 'Нижегородцева', 'adelia-marta26@yandex.ru', 'eb3cc79167061fcbfb5278d99435b6c7319dcc1837', 'eb3cc79167', '1987-01-10', 0, 'Милая, веселая блондинка\r\n', NULL, 'Сентиментальные романчики\r\n', '', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3371, 3376, NULL, '1111111', 0, 0, 3, '2008-06-24 19:09:46', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (61, 'siam', 'Луиза', 'Фёдоровна  ', 'Прокофьева', 'adelia-marta27@yandex.ru', 'd0226dec4296c8edf8343457621656fe1ce761a20b', 'd0226dec42', '1989-08-21', 0, 'Четыре черных чертенка чертили черными мелками черный чертеж, а один взял белый мелок... Давай нарисуем звезды.\r\n', NULL, 'Ярмарка тщеславия\r\n', 'Трасса 60\r\n', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3407, 3435, NULL, '1111111', 0, 0, 3, '2008-06-24 19:30:06', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (62, 'timerok', 'Роман', 'Артурович  ', 'Карпишин', 'adelia-marta28@yandex.ru', '57b0ce297931d3703addd5ee8505548552295b61e2', '57b0ce2979', '1986-04-06', 1, 'Отвечай за свои слова поступками\r\n', NULL, '', 'Крестный отец\r\n', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3437, 3446, NULL, '1111111', 0, 0, 3, '2008-06-24 19:43:40', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (63, 'sima', 'Елена', 'Владиславовна  ', 'Железина', 'adelia-marta29@yandex.ru', '56537d1f08c6473faff1b92549081c4785bf9dc22c', '56537d1f08', '1987-07-29', 0, 'интересная, в меру скромная, целе устремленная, общительная\r\n', NULL, '"Искусство войны"\r\n', '', 'Caf&#233; del mar\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3437, 3451, NULL, '1111111', 0, 0, 3, '2008-06-24 19:46:13', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (64, 'ten10', 'Вадим', 'Евгеньевич  ', 'Карасев', 'adelia-marta30@yandex.ru', '9378563af9a0a00d647b3c1b02c3e41b8549725fba', '9378563af9', '1985-01-20', 1, 'Жить надо\r\nчувствами, \r\nне только\r\nлишь умом:\r\nУвидеть радугу, \r\nуслышать\r\nвнешний гром, \r\nПознать любовь, \r\nочарованья\r\nсладость...\r\nУспеть познать...\r\nЧтоб не\r\nжалеть потом.', NULL, '', '', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 9908, 10165, 10184, NULL, '1111111', 0, 0, 3, '2008-06-24 20:00:59', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (65, 'timur', 'Тимур', 'Ильич  ', 'Иваков', 'adelia-marta31@yandex.ru', '4e7bc1635d14c74c64daf82ffa2d51b7b3d54c0229', '4e7bc1635d', '1990-03-02', 1, 'Проофессия волшебник\r\n', NULL, '', '', 'в стиле хип-хоп, рэп\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3468, 3472, NULL, '1111111', 0, 0, 3, '2008-06-24 20:08:32', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (66, 'sister', 'Алла', 'Григорьевна  ', 'Пентина', 'adelia-marta32@yandex.ru', '3e2a3c5a081f254898502659942604813b1ef37259', '3e2a3c5a08', '1989-09-18', 0, 'Самое прекрасное и светлое чудо-это Я!\r\n', NULL, 'Дневник Бриджит Джонс\r\n', '', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3371, 3376, NULL, '1111111', 0, 0, 3, '2008-06-24 20:11:45', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (67, 'romi', 'Екатерина', 'Ильинична  ', 'Степанова', 'adelia-marta33@yandex.ru', '918f7c17c3af42a26ee5d76f6b36cc5668564a49b4', '918f7c17c3', '1983-11-14', 0, 'Большинство людей счастливы настолько, насколько они решили быть счастливыми.\r\n', NULL, '', '"Танцующая в темноте"\r\n', 'Пугачева\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3503, 3526, NULL, '1111111', 0, 0, 3, '2008-06-24 20:40:43', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (68, 'sims', 'Евгений', 'Антонович  ', 'Пулин', 'adelia-marta34@yandex.ru', '296b239d0032bffa55b55544e5a598fa0b9d97fcac', '296b239d00', '1988-06-07', 1, 'Занимаюсь брэйком. Люблю порисовать. Играю на гитаре. Слушаю русский рэп.\r\n', NULL, '', '', 'Рэп, шансон\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3529, 3538, NULL, '1111111', 0, 0, 3, '2008-06-24 20:48:32', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (69, 'riza', 'Ксения', 'Макаровна  ', 'Неткачева', 'adelia-marta35@yandex.ru', '95ec6983bbeff527ad9d4189f444ab034c65927a8b', '95ec6983bb', '1984-10-16', 0, 'Девушка дождя\r\n', NULL, '', '', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3675, 3684, NULL, '1111111', 0, 0, 3, '2008-06-24 20:51:26', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (70, 'rita', 'Маргарита', 'Сергеевна  ', 'Базлина', 'adelia-marta36@yandex.ru', '2ef8effce6be21d9cf4d74bc88d3fdad6b8a544413', '2ef8effce6', '1988-06-04', 0, 'Я такая, какая есть, я не буду другой, \r\nЯ такая, какая есть, и я останусь такой. \r\nЯ наивна бываю, бываю вредна. \r\nНо такая, как есть, я на свете одна... \r\nЯ такая, как есть, я умею любить. \r\nКто увидит меня, тот не сможет забыть. \r\nЯ умею ласкать, но умею и бить. \r\nЯ умею спасать и умею губить... \r\nЯ такая, как есть, я похожа на мать... \r\nСтроя жизнь, я успеваю ломать... \r\nя немного грущу и немного смеюсь. \r\nЯ бесстрашна бываю, но я и боюсь. \r\nЯ такая, как есть, я люблю помогать, \r\nНо бывает, что я не могу не кричать. \r\nЯ бываю сильна, я бываю одна. \r\nМогу быть пылкой я, а потом холодна.. \r\nЯ такая, как есть, я не стану иной! \r\nЯ немного поплачу у вас за спиной, \r\nВытру слёзы и легко в ответ улыбнусь. \r\nИ такой, какая я есть, к вам опять повернусь...', NULL, 'Книги Стивена Кинга\r\n', 'Сайлент Хилл\r\n', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 248, 249, 255, NULL, '1111111', 0, 0, 3, '2008-06-24 21:00:52', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (71, 'sirrr', 'Федор', 'Сергеевич  ', 'Бондарь', 'adelia-marta37@yandex.ru', 'ebf9e19b59e7c9ca66d85ae39125dc17fce85b847a', 'ebf9e19b59', '1988-01-11', 1, 'Я, простой веселый парень, люблю общаться с веселыми интересными людьми, которых Бог не обделил чувством юмора, особенно если это девушки.по жизни Оптимист, про остальные мои качества с удовольствием роскажу при общении.\r\n', NULL, 'Александр и Юлия Свияш - улыбнись, пока не поздно!\r\n', 'Где находится нофелет\r\n', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3703, 3731, NULL, '1111111', 0, 0, 3, '2008-06-24 21:07:42', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (72, 'sadly', 'Егор', 'Герасимович  ', 'Онуфриев', 'adelia-marta38@yandex.ru', 'b80e1c1ef2ede803af1bfe8c28c993ae393258bb79', 'b80e1c1ef2', '1987-05-22', 1, 'ненавижу кошек, борщ и когда мне врут!\r\n', NULL, '', '', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3761, 3770, NULL, '1111111', 0, 0, 3, '2008-06-24 21:10:50', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (73, 'stan', 'Павел', 'Зиновьевич  ', 'Абруков', 'adelia-marta39@yandex.ru', '9c6351379dfe935575a6e67e11a549f11c684f62ca', '9c6351379d', '1990-02-01', 1, 'Беру от жизни все и ничего не отдаю в замен!\r\n', NULL, '', '', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3841, 3854, NULL, '1111111', 0, 0, 3, '2008-06-24 21:18:21', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (74, 'romana', 'Анастасия', 'Артемовна  ', 'Дербышева', 'adelia-marta40@yandex.ru', '243f41c3d88e204e48e0d5520c9758646dd880d6ac', '243f41c3d8', '1982-07-25', 0, '- Я не худая – я с красивыми формами\r\n- Я не красива – я черррртовски мила\r\n- Я не обжора – я гурман \r\n- Я не феминистка – я просто умнее\r\n- Я не высокомерная – я чуть-чуть капризная\r\n- Я не стерва – я непросто стерва\r\n- Я не разгильдяйка – я просто люблю поспать\r\n- Я не неряха – мне просто мало места в шкафах \r\n- Я не вру – я просто хорошо сочиняю\r\n- Я не пьяная – я задумчивая\r\n- Я не серьезная – мне скучно\r\n- Я не туплю – я не в настроении\r\n- Я над Вами не издеваюсь – я и жду того же\r\n- Я всех не ненавижу – всех я люблю, но некоторых меньше ', NULL, '', '', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3872, 3887, NULL, '1111111', 0, 0, 3, '2008-06-24 21:22:29', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (75, 'roza', 'Алиса', 'Андреевна  ', 'Овчинникова', 'adelia-marta41@yandex.ru', '5295f55a7f276912de2e97f38b7d78bab31e948178', '5295f55a7f', '1987-03-05', 0, 'Нравится жизнь и всё что с ней связано)\r\n', NULL, 'Коэльо Алхимик\r\n', 'Матрица\r\n', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3892, 3912, NULL, '1111111', 0, 0, 3, '2008-06-24 21:30:16', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (76, 'stop', 'Михаил', 'Игнатьевич  ', 'Ярмин', 'adelia-marta42@yandex.ru', 'd99ae05d4500e005d7d188f8ceae6186925ad7acfd', 'd99ae05d45', '1984-11-23', 1, 'Ты же знаешь, знаешь... Я очень хочу, \r\nДотянуться до солнца и не сгореть, \r\nРасправить крылья и полететь\r\nТанцевать с тобой, когда никого нет\r\nИ руки расскажут, что скрывает рассвет...', NULL, '', '', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3921, 3933, NULL, '1111111', 0, 0, 3, '2008-06-24 22:04:37', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (77, 'strange', 'Алексей', 'Мстиславович  ', 'Медведев', 'adelia-marta43@yandex.ru', '9939e8a70d578810a6562fe3c5d22f35c47fbb98e7', '9939e8a70d', '1983-09-24', 1, '"Успех чаще выпадает на долю того, кто смело действует, но его редко добиваются те, кто проявляет робость и постоянно опасается последствий.\r\n"\r\n', NULL, '', '21\r\n', 'клубная музыка\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3952, 3963, NULL, '1111111', 0, 0, 3, '2008-06-24 22:07:37', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (78, 'pomni', 'Татьяна', 'Николаевна  ', 'Автономова', 'adelia-marta44@yandex.ru', '37d5280708cc6d255ef7f6cf59e419547e480087c5', '37d5280708', '1990-04-26', 0, 'Странница во времени, ищущая верного спутника и друзей\r\n', NULL, 'слишком много, чтобы все перечислять\r\n', 'Завтрак у Тиффани\r\n', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4026, 4036, NULL, '1111111', 0, 0, 3, '2008-06-24 22:12:03', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (79, 'gost', 'Владимир', 'Матвеевич  ', 'Иринев', 'adelia-marta45@yandex.ru', '4e9cdff37be03d15f7232d5150378c419675edd814', '4e9cdff37b', '1987-10-10', 1, 'Весёлый, слегка чокнутый и прикольный\r\n', NULL, '', '', 'Рэп, рок, металл\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4052, 4079, NULL, '1111111', 0, 0, 3, '2008-06-24 22:14:38', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (80, 'pop-corm', 'Яна', 'Сергеевна  ', 'Ишуткина', 'adelia-marta46@yandex.ru', '9a9b45b2dd0eccbb0c18ce0a9ed0f541b61cf3990e', '9a9b45b2dd', '1986-06-06', 0, 'Я из провинции..там тяжело:(\r\n', NULL, '', 'Тариф на луггый свет\r\n', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4105, 4108, NULL, '1111111', 0, 0, 3, '2008-06-24 22:21:43', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (81, 'quest', 'Сергей', 'Вячеславович  ', 'Политаев', 'adelia-marta47@yandex.ru', 'b05049b172b8a6ecbc370b9b978f406ca730b2a0ce', 'b05049b172', '1985-08-21', 1, 'Легко отношусь к жизни. Но до определенных пределов. Стараюсь брать от жизни все. Люблю музыку. Занимаюсь брейком. Люблю авантюрные решения, адреналин. Не люблю сайты знакомств:) Но все равно интересно…\r\n', NULL, 'Сергей Лукьяненко. Танцы на снегу\r\n', 'Шаг вперед2, Уличные танцы, Ямакаси\r\n', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4105, 3409478, NULL, '1111111', 0, 0, 3, '2008-06-24 22:26:00', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (82, 'polly', 'Майя', 'Евгеньевна  ', 'Василенко', 'adelia-marta48@yandex.ru', 'ab496e18ba5afb6d496ad7df001c8f005554c9a37d', 'ab496e18ba', '1984-01-23', 0, 'Весьма положительный персонаж без обременения. Планов не строю, загадок не загадываю\r\n', NULL, '', 'Пляж, Титаник\r\n', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4593, 4618, NULL, '1111111', 0, 0, 3, '2008-06-24 23:03:08', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (83, 'linda', 'Инна', 'Егоровна  ', 'Макашина', 'adelia-marta49@yandex.ru', 'e49e423e463cc9295a29637f68ecb0cdc6dccf297f', 'e49e423e46', '1988-02-09', 0, 'избалованная как-то сказали)... Что есть, то есть) - УСЕ МОЁ =) Иногда я забываю отключить комп.. и поэтому онлайн:) чаще, чем кажется 8 ) P.S.Если я не ответила Вам сразу, значит отвечу чуть позже:)\r\n', NULL, '', '', 'Фортепианные концерты\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 1894, 1911, 1913, NULL, '1111111', 0, 0, 3, '2008-06-25 08:50:32', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (84, 'lainta', 'Валентина', 'Романовна  ', 'Клибышева', 'adelia-marta50@yandex.ru', '8255673e2cfc11c72516b1f46a3ae83f15caccdcf9', '8255673e2c', '1989-07-18', 0, 'НЕ СТАВЬТЕ ТОЧКУ, ГДЕ СЕРДЦЕ СТАВИТ ЗАПЯТУЮ!\r\nО себе: самостоятельная, капризная, амбициозная, просто сущий бес в юбки.\r\nНе люблю пафос и надуманные правила, которые кто-то когда-то ввел, все правила в жизни устанавливаю сама-без чьих-либо комментариев! \r\n', NULL, 'Макс  Фрай\r\n', 'Все, кроме глупых и пошлых американских комедий\r\n', 'Джаз и блюз\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4227, 4238, NULL, '1111111', 0, 0, 3, '2008-06-25 08:59:08', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (85, 'ledana', 'Галина', 'Денисовна  ', 'Азимутова', 'adelia-marta51@yandex.ru', 'f8528386eff7369939f03e4e2d9427354a77f6807f', 'f8528386ef', '1988-01-04', 0, 'Чтобы иметь ангельский характер, должно быть дьявольское терпение, которого у меня нет.\r\n', NULL, '', 'Иностранная поп-музыка\r\n', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3892, 3912, NULL, '1111111', 0, 0, 3, '2008-06-25 09:01:58', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (86, 'qooop', 'Дмитрий', 'Владиславович  ', 'Андронников', 'adelia-marta52@yandex.ru', 'adbbc98978f4a81359b9395d6d6a4537d2b1867993', 'adbbc98978', '1983-06-12', 1, 'Основатель Культа Зимбабы\r\n', NULL, 'Абрахам Меррит "Ползи тень"\r\n', 'Офицеры\r\n', 'еще не определился', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3921, 3933, NULL, '1111111', 0, 0, 3, '2008-06-25 09:04:27', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (87, 'quit', 'Николай', 'Борисович  ', 'Глинко', 'adelia-marta53@yandex.ru', '0c1a2ab5c5581dda513a78dc81e28a1869608b65a7', '0c1a2ab5c5', '1988-10-08', 1, 'Не совершенство, как и все со своими тараканами в голове, но стремлюсь усовершенствовать себя. Пройдя по жизни тысячи дорого, услышишь столько же мнений о себе, важней знать то, что думаешьи знаешь ТЫ сам о себе. Про себя не люблю много говорить, это не моё, но могу сказать лишь, что я добрый, отзывчивый и верный мэн, люблю отрываться, и проживать свою жизнь как мне хочеться.\r\n', NULL, '', 'Бойцовский клуб\r\n', 'авторская песня, грушинские сборки\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4270, 4274, NULL, '1111111', 0, 0, 3, '2008-06-25 09:25:47', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (88, 'lada', 'Тамара', 'Романовна  ', 'Бадяева', 'adelia-marta54@yandex.ru', 'd7bcc327005b2432bffc3cc8513cfaa6297508a0fc', 'd7bcc32700', '1987-03-16', 0, 'Я небо рисую синим, а серым рисую скалы.Мужчин обязательно сильных, а женщин конечно же слабыми.Но небо совсем не синее, а серые вовсе не скалы.Приходится быть сильной, а хочется быть слабой!\r\n', NULL, 'Брэм Стокер "Дракула"\r\n', 'У зеркала два лица, Колдовская любовь\r\n', 'электронная музыка\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4270, 4274, NULL, '1111111', 0, 0, 3, '2008-06-25 09:28:03', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (89, 'presto', 'Руслан', 'Кузьмич  ', 'Малкин', 'adelia-marta55@yandex.ru', '34004f081df0df0bf6ad3e4ad3016a9504f1d38f02', '34004f081d', '1987-11-01', 1, 'Уверен я, счастливец только тот, \r\nКто как последний день сегодняшний живёт. \r\nТогда спокойно может он сказать: \r\n-Будь завтра хоть потоп, я жизнь успел узнать!', NULL, '"Сто лет одиночества" Г.Г. Маркес\r\n', '', 'классики', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4270, 4274, NULL, '1111111', 0, 0, 3, '2008-06-25 09:33:17', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (90, 'olena', 'Олена', 'Гавриловна  ', 'Кащеева', 'adelia-marta56@yandex.ru', '08d828ba7bb18717c082e6b2eaf30523554293ad4c', '08d828ba7b', '1988-01-13', 0, 'ЖИЗНЬ-она как зебра, черная полоса- белая, задняя сторона зебры! Так что не надо вешать нос, все будет ништяк!\r\n', NULL, '"Пикник на обочине"\r\n', '"12"\r\n', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 09:36:12', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (91, 'olga', 'Ольга', 'Владимировна  ', 'Вострикова', 'adelia-marta57@yandex.ru', 'a3b8821854b2e4cd2a15d79dcbf3e9eb490cc697d4', 'a3b8821854', '1984-05-17', 0, 'собираю игрушки от киндер-сюрприза, считаю себя очень умной, т.к игрушки с надписью от 3-х до 5-ти лет умудряюсь собрать всего лишь за неделю! с чувством юмора-все в норме.\r\n', NULL, 'Бернард Вербер "Мы ангелы"\r\n', '"Код да Винчи"\r\n', 'те, что пишут не для певцов\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4313, NULL, '1111111', 0, 0, 3, '2008-06-25 09:39:13', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (92, 'parol', 'Дмитрий', 'Никитич  ', 'Алаев', 'adelia-marta58@yandex.ru', '5e34bf90e5b16cac856df9209fa6f0cfbe5deda276', '5e34bf90e5', '1982-09-09', 1, 'Ну ты и жук, Димка, настоящий жук\r\n', NULL, '', 'Альтернативное кино\r\n', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4358, NULL, '1111111', 0, 0, 3, '2008-06-25 09:42:04', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (93, 'olya', 'Ольга', 'Вячеславовна  ', 'Галинова', 'adelia-marta59@yandex.ru', '0f601180d9339f2569356dbf5c1d40fa0ae5c3a049', '0f601180d9', '1989-08-05', 0, 'всегда на позитиве\r\n', NULL, '', '', 'Этническая музыка\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4481, 4496, NULL, '1111111', 0, 0, 3, '2008-06-25 11:47:59', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (94, 'osta11', 'Регина', 'Станиславовна  ', 'Вахрова', 'adelia-marta60@yandex.ru', '4be7f6470be5413eccfa4bd057a99a98957e5d95b1', '4be7f6470b', '1987-06-15', 0, 'Общительная, веселая, вредная, интересная...Не ищу ничего сверхординарного, не верю в успешное знакомство по Интернету, может быть кто переубедит?\r\n', NULL, '', '', 'Поп музыка русская и иностранная\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 0, 0, NULL, '1111111', 0, 0, 3, '2008-06-25 11:56:14', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (95, 'petrov', 'Петр', 'Сергеевич  ', 'Абрамов', 'adelia-marta61@yandex.ru', 'bb8cd53539a3501fda541b7d8a4f52f5e4e6bfdf9f', 'bb8cd53539', '1990-07-20', 1, 'Служу в МЧС\r\n', NULL, '', '', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3563, 3612, NULL, '1111111', 0, 0, 3, '2008-06-25 11:58:16', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (96, 'petrov-vodkin', 'Петр', 'Геннадиевич  ', 'Мигусин', 'adelia-marta62@yandex.ru', 'a2af3a197e146afbee8695f27ef44d72a03ac0d2fa', 'a2af3a197e', '1983-07-02', 1, 'Человек без прошлого\r\n', NULL, '', '"отважное сердце"\r\n', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3563, 3612, NULL, '1111111', 0, 0, 3, '2008-06-25 12:00:42', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (97, 'oooops', 'Яна', 'Филипповна  ', 'Пазикова', 'adelia-marta63@yandex.ru', 'a96ec6cdaef968d66008c2e2598e3e1d70c70415c1', 'a96ec6cdae', '1988-04-22', 0, 'В меру скромная, вредная, язвительная... надеюсь по крайне мере, что в меру... )\r\n', NULL, '', 'Зачарованные\r\n', 'Alizee\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3563, 3612, NULL, '1111111', 0, 0, 3, '2008-06-25 12:02:47', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (98, 'opramag', 'Катерина', 'Богдановна  ', 'Артемьева', 'adelia-marta64@yandex.ru', '5fe896eb4f59d65a6d42cfea967d3ae58c7bd3eb1d', '5fe896eb4f', '1986-10-26', 0, 'Творческий человечек, 5 лет занимаюсь танцами, в направлении современный клубный танец..\r\n', NULL, '', '"Фрида"\r\n', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3563, 3612, NULL, '1111111', 0, 0, 3, '2008-06-25 12:04:45', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (99, 'pastor', 'Григорий', 'Игоревич  ', 'Александров', 'adelia-marta65@yandex.ru', '3e47af74a9d8125152cf44a329545f3bd9642ec65c', '3e47af74a9', '1984-11-28', 1, 'Одинокий волк в этом мире людей\r\n', NULL, 'Дозоры\r\n', '', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4503, 4517, NULL, '1111111', 0, 0, 3, '2008-06-25 12:07:14', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (100, 'ninarichi', 'Нина', 'Афанасьевна  ', 'Законова', 'adelia-marta66@yandex.ru', '9be98431179b2e73a3a2f187fbb76572368ae4741e', '9be9843117', '1988-08-10', 0, 'Терпеть ненавижу навязываться, посему этого делать не буду…\r\n', NULL, 'электронные\r\n', 'экранные копии с ходящими головами\r\n', 'немые и беззвучные\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4503, 277856, NULL, '1111111', 0, 0, 3, '2008-06-25 12:09:08', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (101, 'nonna', 'Ирина', 'Зиновьевна  ', 'Девнина', 'adelia-marta67@yandex.ru', '5f5975ebb31cc62cac6d3087d1d4b19994e2d3d4a5', '5f5975ebb3', '1985-09-26', 0, 'Самая обаятельная и привлекательная ;)\r\n', NULL, '', '', 'Русский рок\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4503, 277856, NULL, '1111111', 0, 0, 3, '2008-06-25 12:11:10', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (102, 'oden', 'Евгений', 'Алексеевич  ', 'Рузиев', 'adelia-marta68@yandex.ru', '1f7579dcf35c46984fcd40dbd85d040a70ccb80140', '1f7579dcf3', '1987-06-04', 1, 'парень который любит жизнь.Разносторонний и не занудливый…\r\n', NULL, 'книги по самобороне и боевым искусствам\r\n', 'Высокий блондин в черном ботинке\r\n', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4528, 4549, NULL, '1111111', 0, 0, 3, '2008-06-25 12:13:06', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (103, 'nann', 'Анна', 'Мироновна  ', 'Знаменская', 'adelia-marta69@yandex.ru', 'aa9e76fce4f6ea1c67f28657aa820e947d345c2d4d', 'aa9e76fce4', '1989-10-18', 0, 'Главное, не зацикливаться на одном! =)\r\n', NULL, '', '', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4528, 90035310, NULL, '1111111', 0, 0, 3, '2008-06-25 12:15:11', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (104, 'fire', 'Валентин', 'Артемович  ', 'Бажов', 'adelia-marta70@yandex.ru', '1cc5d69dd8e02f5d7b36c09e646e4c9c6bdd07144a', '1cc5d69dd8', '1987-07-01', 1, 'Самый необычный из необычных, и в то же время самый обычный из обычных... Это зависит от того, каким меня захочет собеседник увидеть, и каким я захочу для него открыться.', NULL, 'детективы\r\n', '', 'русский рок\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4528, 4549, NULL, '1111111', 0, 0, 3, '2008-06-25 12:17:10', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (105, 'olderman', 'Андрей', 'Ефимович  ', 'Валеев', 'adelia-marta71@yandex.ru', 'f9245f4361bbc31eeda659e531dda2c9116ace2cee', 'f9245f4361', '1983-01-14', 1, 'Весьма адекватен в поступках и весьма радикален во взглядах..\r\n', NULL, '', '', 'блюз, джаз\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4561, 4580, NULL, '1111111', 0, 0, 3, '2008-06-25 12:18:57', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (106, 'nasty', 'Анастасия', 'Анатольевна  ', 'Лявина', 'adelia-marta72@yandex.ru', 'bfeda2cb44d770f6b3061d7ef0482d619ff7ae7eca', 'bfeda2cb44', '1988-03-16', 0, 'вечно что-то придумываю :)\r\n', NULL, '', '', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4593, 4617, NULL, '1111111', 0, 0, 3, '2008-06-25 12:20:41', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (107, 'oleg', 'Олег', 'Викторович  ', 'Катин', 'adelia-marta73@yandex.ru', 'fc77d6b47484da34d2e7ce52f7809f0fa96681d0e8', 'fc77d6b474', '1987-10-03', 1, 'Скорее как клубок противоречий меня будет легче всего представить, но это не факт что плохо - но и не есть что это так прекрасно..\r\n', NULL, '', '', 'Не важно, какая музыка. Главное, чтобы она была качественной !', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 5681, 25450157, 0, NULL, '1111111', 0, 0, 3, '2008-06-25 12:23:02', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (108, 'nash', 'Владимир', 'Анатольевич  ', 'Либин', 'adelia-marta74@yandex.ru', '8aa11232e5c66fd6c85b08663aed3c7e3ba9ca6bbb', '8aa11232e5', '1990-05-26', 1, 'Люблю новые-интересные знакомства, ведь новые люди - новые истории. =)\r\n', NULL, 'легкий способ бросиь курить ;)\r\n', 'Жестокие игры 1. Основной инстинкт. С широко закрытыми глазами. Прогулка\r\n', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4633, 4650, NULL, '1111111', 0, 0, 3, '2008-06-25 12:25:04', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (109, 'nostar', 'Иван', 'Сергеевич  ', 'Бузин', 'adelia-marta75@yandex.ru', 'bd4297edda857b14da1c7e6efe5a8e2ded86b29827', 'bd4297edda', '1982-04-12', 1, 'Я вновь один на крыше старой часовни. Сверкают молнии. Небо наполняется влагой, чтобы спустя мгновение разразиться ливнем. Я смотрю на ночной город, на его безжизненные улицы, залитые светом уличных фонарей. Такие моменты особенно ценны, ведь я вновь растворяюсь в собственных мыслях. Всё происходящее вокруг уже не имеет значения…… Но время пришло, я расправляю крылья и последний раз стремительно пролетаю над городом, чтобы вновь продолжить свой путь туда, где завтра встанет солнце вновь слепя меня своими лучами.\r\n', NULL, 'поэзия серебрянного века\r\n', 'Эффект бабочки\r\n', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4657, 4682, NULL, '1111111', 0, 0, 3, '2008-06-25 12:26:45', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (110, 'natasha', 'Наталья', 'Эдуардовна  ', 'Браткина', 'adelia-marta76@yandex.ru', '5d503319360eacf0fa8f5abb7a9bd360f9506f571a', '5d50331936', '1987-10-19', 0, 'Изучаю финансы и биржу\r\n', NULL, '', 'хороший год\r\n', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 9908, 10165, 10184, NULL, '1111111', 0, 0, 3, '2008-06-25 12:28:39', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (111, 'mmimm', 'Александр', 'Данилович  ', 'Лазутин', 'adelia-marta77@yandex.ru', '229f56e3852360ccfa6dd6aedb64b2e79f8fa14402', '229f56e385', '1989-02-02', 1, 'Взрослый и добрый, целеустремленный и вменяемый\r\n', NULL, '', 'Шоу трумэна\r\n', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4657, 4682, NULL, '1111111', 0, 0, 3, '2008-06-25 12:37:08', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (112, 'mihan', 'Михаил', 'Юрьевич  ', 'Зеленков', 'adelia-marta78@yandex.ru', 'c96fa558ea97432c577edb2371cee47d040edf0657', 'c96fa558ea', '1988-08-02', 1, 'ищу друзей, как старый одинокий ослик иа\r\n', NULL, '', 'фильмы тарковского\r\n', 'Русская поп-музыка\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4689, 4720, NULL, '1111111', 0, 0, 3, '2008-06-25 12:38:56', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (113, 'miuki', 'Света', 'Олеговна  ', 'Полежаева', 'adelia-marta79@yandex.ru', '6d3339127b1d8959122e7ab32247b46720679efef7', '6d3339127b', '1986-06-20', 0, 'Красивая и странная, \r\nВесьма оригинальная. \r\nС виду неформальная, \r\nИ очень либеральная.\r\n', NULL, '', 'проклятье, звонок\r\n', 'русский рок, металл\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4689, 4708, NULL, '1111111', 0, 0, 3, '2008-06-25 12:41:23', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (114, 'mihail', 'Михаил', 'Германович  ', 'Новеньков', 'adelia-marta80@yandex.ru', 'caa2ef26d8981c1b1bcd6ec53e6227fe3c23f757f6', 'caa2ef26d8', '1984-11-07', 1, 'Черный (рыжий) фриц на белой ко...\r\nПонимайте как хотите?\r\n', NULL, '', '', 'игра нервов\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4734, 0, NULL, '1111111', 0, 0, 3, '2008-06-25 12:46:01', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (115, 'miha', 'Михаил', 'Дмитриевич  ', 'Иванов', 'adelia-marta81@yandex.ru', 'cec9b43b844181da708f79cfd3574edc27df95270b', 'cec9b43b84', '1988-01-22', 1, 'Весьма интересный человек с массой хороших качеств. Но есть и отрицательные моменты. А у кого их нет?! ', NULL, '', '', 'русский рок, блюз, этника\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4773, 4793, NULL, '1111111', 0, 0, 3, '2008-06-25 12:47:42', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (116, 'mokka', 'Ксения', 'Александровна  ', 'Рассадина', 'adelia-marta82@yandex.ru', '01cd20437f340fb78f6d31411b13c7f7e20e22c28b', '01cd20437f', '1988-04-11', 0, 'Девушка серьёзная, но хороший здоровый юмор люблю.\r\nХочу новую машину…', NULL, '', '', 'иностранная и русская поп музыка, много разных музыкантов', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4773, 0, NULL, '1111111', 0, 0, 3, '2008-06-25 12:49:43', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (117, 'lost', 'Василий', 'Григорьевич  ', 'Завалишин', 'adelia-marta83@yandex.ru', 'b8c6185e64e596100a7c1997cfe5d27a8abf494580', 'b8c6185e64', '1987-09-24', 1, 'Говорят хороший\r\n', NULL, 'давно не читал\r\n', 'аниме\r\n', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4800, 4848, NULL, '1111111', 0, 0, 3, '2008-06-25 12:51:21', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (118, 'marina', 'Марина', 'Валентиновна  ', 'Раветян', 'adelia-marta84@yandex.ru', '8f0988eb2559160631aa57dbd07e99b931732c79ba', '8f0988eb25', '1990-07-28', 0, 'Я не могу быть второй. Не могу быть даже Первой. Могу быть только Единственной!', NULL, '"мемуары гейши"\r\n', '', 'enya\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 248, 272, 281, NULL, '1111111', 0, 0, 3, '2008-06-25 12:53:09', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (119, 'most', 'Анастасия', 'Викентиевна  ', 'Еланская', 'adelia-marta85@yandex.ru', 'cc083feab2a5d69165dc1f45be85c5546eccfa2701', 'cc083feab2', '1982-02-09', 0, 'Любая сторона моей жизни имеет четкий стандарт качества. Любовь должна быть самой чистой, будущее- светлым, внешний вид-идеальным. Бороться за первое место по всем показателям очень трудно, но уровень ""хорошо"" меня не устраивает... )', NULL, '', 'мост в терабитию\r\n', 'этника\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4861, 4879, NULL, '1111111', 0, 0, 3, '2008-06-25 12:55:16', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (120, 'marta', 'Марта', 'Геннадиевна  ', 'Елкова', 'adelia-marta86@yandex.ru', '02dc4da531f9af0bb394b1446e415fb87cf2a2d84f', '02dc4da531', '1984-06-23', 0, '""Как угодно, только не как у всех, ""-пожалуй эти слова скажут всё обо мне...', NULL, '', '', 'DJ Poul Oakenfold\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4891, 4917, NULL, '1111111', 0, 0, 3, '2008-06-25 12:56:56', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (121, 'lote', 'Сергей', 'Анатольевич  ', 'Дечук', 'adelia-marta87@yandex.ru', '4611fed840cb2c1e17bb2b8bc2daae7752b060cd12', '4611fed840', '1983-11-14', 1, 'Я весёлый человечек, который любит красиво проводить время в компании интересных, весёлых, жизнерадостных людей!\r\n', NULL, '', 'Мы из будущего. Параграф 78\r\n', 'R&B, Latino и иногда восточные мотивы', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4891, 4909, NULL, '1111111', 0, 0, 3, '2008-06-25 13:03:12', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (122, 'leha', 'Алексей', 'Валерьевич  ', 'Акберов', 'adelia-marta88@yandex.ru', '2a08e68a5a4c8b9f0e88eca355d0ac8538e9beb1ab', '2a08e68a5a', '1985-05-19', 1, 'Ценю поступки, а не слова, в первую очередь. Доброту, ум, честность, открытость, умение идти на компромиссы и ладить с людьми.', NULL, '""Язык Телодвижения"" Аллана Пиза.\r\n', 'Властелин Колец\r\n', 'то, что крутят по радио - приходится слушать', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4925, 4962, NULL, '1111111', 0, 0, 3, '2008-06-25 13:05:15', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (123, 'lime', 'Дмитрий', 'Тимофеевич  ', 'Белеев', 'adelia-marta89@yandex.ru', 'c286f9009d288297a291d80ef1d425d058d237c024', 'c286f9009d', '1989-01-16', 1, 'Разносторонне развитый парень, твердо стоящий на своих ногах. Остальное интереснее узнавать из общения, не так ли?\r\n', NULL, '', 'звездные войны, футурама\r\n', 'нравится электронная музыка\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4925, 4962, NULL, '1111111', 0, 0, 3, '2008-06-25 13:07:56', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (124, 'kirsten', 'Максим', 'Гаврилович  ', 'Логинов', 'adelia-marta90@yandex.ru', 'b044e1cfba0e2966fbb0c8ce103af7d897ce0b2bb6', 'b044e1cfba', '1988-04-02', 1, 'Симпатичный спортсмен, веселый, общительный :)\r\n', NULL, '', '', 'электронная музыка', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4925, 4962, NULL, '1111111', 0, 0, 3, '2008-06-25 13:11:24', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (125, 'loren', 'София', 'Михайловна  ', 'Поручикова', 'adelia-marta91@yandex.ru', '6bc7b4e654f1bff33291c994212d03b9ef679368b0', '6bc7b4e654', '1989-10-21', 0, 'Я ненавижу ложь и довольно быстро всё прощаю. Я не умею злиться, тем более долго. Добра, порой даже слишком.\r\n', NULL, '', 'последний - кунгу фу панда и вообще анимация\r\n', 'музыка в стиле Punk Rock, Trance, Techno, Club, House', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4925, 4962, NULL, '1111111', 0, 0, 3, '2008-06-25 13:13:44', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (126, 'lora', 'Людмила', 'Эдуардовна  ', 'Панкратова', 'adelia-marta92@yandex.ru', 'a93a958ac9bc48514c514f9adc6c4cc2aeb34d8d85', 'a93a958ac9', '1988-08-07', 0, 'Я - дождь. Меня не сделаешь своим, но свежести моей вкусив однажды, не уталишь иною влагой жажды. \r\n', NULL, '', '', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4925, 4962, NULL, '1111111', 0, 0, 3, '2008-06-25 13:15:33', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (127, 'Jkim', 'Алексей', 'Петрович  ', 'Отенов', 'adelia-marta93@yandex.ru', '082a5d41bb92421cb442d879dc15129d03fa33b754', '082a5d41bb', '1987-03-04', 1, 'иногда спокойный и рассудительный, иногда сумасшедший и спонтанный, люблю веселье, терпеть не могу высокомерие, человек не должен ставить себя выше других!\r\n', NULL, '', 'Питер FM\r\n', 'современная популярная музыка\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4969, 5005, NULL, '1111111', 0, 0, 3, '2008-06-25 13:17:25', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (128, 'kot00', 'Борис', 'Олегович  ', 'Киреев', 'adelia-marta94@yandex.ru', '0c2814f28233ce04c201caf67cdad720b7fd4ddecd', '0c2814f282', '1988-02-15', 1, 'Мягкий и пушистый\r\n', NULL, '', 'Человек-паук\r\n', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4969, 4975, NULL, '1111111', 0, 0, 3, '2008-06-25 13:19:23', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (129, 'lynn', 'Юлия', 'Андреевна  ', 'Гукова', 'adelia-marta95@yandex.ru', 'f175f4f7e9565d61d4f4037018df2c006e362acb4e', 'f175f4f7e9', '1982-05-02', 0, 'если не пускают в дверь, надо лезть в окно;-) даже если в мини)\r\n', NULL, 'Пауло Коэльо\r\n', 'добрые искренние и веселые комедии\r\n', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5011, 5051, NULL, '1111111', 0, 0, 3, '2008-06-25 13:21:23', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (130, 'jumi', 'Павел', 'Леонтьевич  ', 'Баймышев', 'adelia-marta96@yandex.ru', 'c3bf9dc5d669c9cef5c8691e5925b12d4643799df1', 'c3bf9dc5d6', '1988-11-06', 1, 'ищу приключения на свою голову и на все остальное тоже :)\r\n', NULL, 'читаю о том, как аборигены ели Кука\r\n', 'я бы посмотрел фильм о том,  как аборигены ели Кука, только в сетке чето не нашел ;)\r\n', 'веселая аборигенская музыка\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5080, 5106, NULL, '1111111', 0, 0, 3, '2008-06-25 13:23:39', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (131, 'lena', 'Елена', 'Аркадьевна  ', 'Анцева', 'adelia-marta97@yandex.ru', '752a37434f07441fefe5f164e0773488ea098ba166', '752a37434f', '1984-07-17', 0, 'Самая счастливая женщина на свете\r\n', NULL, '', '', 'танцевальная музыка. Не важно, кто её написал\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5080, 5106, NULL, '1111111', 0, 0, 3, '2008-06-25 13:25:46', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (132, 'juney', 'Олег', 'Давидович  ', 'Абдулов', 'adelia-marta98@yandex.ru', 'c8271e1451b37a86ffa5406e96c291f328811d0cc5', 'c8271e1451', '1990-09-05', 1, 'Я достаточно целеустремленный парень. Люблю спорт машины и красивых девушек\r\n', NULL, 'мастер и маргарита\r\n', '', 'рэп, русский рок\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5080, 5106, NULL, '1111111', 0, 0, 3, '2008-06-25 13:27:51', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (133, 'love', 'Александра', 'Валентиновна  ', 'Мазенкова', 'adelia-marta99@yandex.ru', '76990980818279b359a2b7ca0ee252a239fbe4f817', '7699098081', '1988-03-18', 0, 'Она выйдет на темный балкон,\r\nОна молча посмотрит вниз. \r\nИ, стряхнув черно-белый сон, \r\nОна встанет на скользкий карниз...\r\nОна сделает шаг вперед, \r\nСердце сладко замрет в груди…\r\nВы решили, она упадет?\r\nЧто вы! Нет! Она полетит...', NULL, 'Ремарк, Вербер, Тосс', 'У каждого своё кино ;)\r\n', 'У каждого своё кино ;)	Counting Crows, Jack Johnson, Keith Urban, Yoav, Snow Patrol... а вообще - от настроения зависит - могу слушать всё :)\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5161, 5184, NULL, '1111111', 0, 0, 3, '2008-06-25 13:31:21', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (134, 'koshka', 'Виктория', 'Даниловна  ', 'Ерпылева', 'adelia-marta100@yandex.ru', '8bba7b9a9059da6b03d22f1b8727da68652506928a', '8bba7b9a90', '1986-01-01', 0, 'Я не пытаюсь тут найти свою половинку, т.к я одно целое.Но по крайней мере хочу найти новых друзей.', NULL, 'Инструкция по эксплуатации Кена.', 'Ангел-А', 'Этническая музыка , нью-эйдж', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5191, 4869166, NULL, '1111111', 0, 0, 3, '2008-06-25 13:33:38', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (135, 'karina', 'Карина', 'Фёдоровна  ', 'Анохина', 'adelia-marta101@yandex.ru', '9e9c51863b762bdf15b4906936296000f5608ea90e', '9e9c51863b', '1982-01-13', 0, 'Очаровательная, самостоятельная, виду активный образ жизни!\r\n', NULL, '', 'Dancer\r\n', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5161, 5184, NULL, '1111111', 0, 0, 3, '2008-06-25 15:52:17', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (136, 'jungle', 'Вадим', 'Антонович  ', 'Акулов', 'adelia-marta102@yandex.ru', 'c9249fb8808c9b2ff652a9d18e0daf377f05a252e8', 'c9249fb880', '1984-07-20', 1, 'Привет всем! : ) \r\nРаботаю в интернете, ищу партнеров\r\n', NULL, '"Война и мир" "Преступление и наказание", другие серьезные книги\r\n', 'Зеленая миля, Форест Гамп\r\n', 'танцевальная музыка\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5191, 5219, NULL, '1111111', 0, 0, 3, '2008-06-25 15:55:01', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (137, 'katty', 'Юлия', 'Сергеевна  ', 'Горохина', 'adelia-marta103@yandex.ru', 'eb7bc68cc5bff229086f2da7dac04e17cf5cd2dac6', 'eb7bc68cc5', '1988-06-03', 0, 'Здесь нет особой красоты, она не всем дается. \r\nЗдесь только тень моей души, в которой сердце бьется...', NULL, 'самую любимую еще не прочитала', '', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5225, 5242, NULL, '1111111', 0, 0, 3, '2008-06-25 15:58:09', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (138, 'kotena', 'Залина', 'Борисовна  ', 'Боркова', 'adelia-marta104@yandex.ru', 'ca77a23fc333da889924267dd9d6ffb62ade56e3e5', 'ca77a23fc3', '1988-11-22', 0, 'Мне нравиться долго нельзя, \r\nКак цепь мне не сносна привычка, \r\nВедь я ускользну, как змея, \r\nВспорхну и умчусь я, как птичка, \r\nТо истиной дышит во мне все, \r\nТо все во мне притворно и ложно, \r\nПонять невозможно меня, \r\nЗато не любить, невозможно!\r\n', NULL, '', '', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5225, 5242, NULL, '1111111', 0, 0, 3, '2008-06-25 15:59:51', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (139, 'jara', 'Татьяна', 'Валерьевна  ', 'Илясова', 'adelia-marta105@yandex.ru', 'e0fcbc79eee3b47044347d05067d71be9fb8fbbb97', 'e0fcbc79ee', '1988-10-07', 0, 'Я дерзкая и смелая, веселая и общительная, капризная и непредсказуемая\r\n', NULL, '', 'фильмы с участием Джима Керри\r\n', 'предпочитаю игать сама, на нервах\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5246, 5269, NULL, '1111111', 0, 0, 3, '2008-06-25 16:01:53', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (140, 'jimbo', 'Наталия', 'Иннокентиевна  ', 'Волоскова', 'adelia-marta106@yandex.ru', '38fe3a1dd5548c97ea2c7ddeed2f7610e02bb6a5c6', '38fe3a1dd5', '1989-03-21', 0, 'Я такая как есть, я не буду другой, я такая как есть я останусь такой. Я наивная бываю, бываю вредна, но такая как есть я на свете одна. Я такая, как есть, я умею любить. Кто увидит меня, тот не сможет забыть. Я умею ласкать, но умею и бить. Я умею спасать и умею губить. Я такая, как есть я похожа на страсть. Строя жизнь я себя успеваю ломать. Я немного грущу и немного смеюсь. Я бесстрашна бываю, но я и боюсь. Я такая как есть я люблю помогать, но бывает, что я не могу не кричать. Я бываю вольна, я бываю одна. Пылкой быть я могу, а потом холодна. Я такая как есть, я не стану иной.', NULL, '', 'дьявол носит прада\r\n', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5246, 5269, NULL, '1111111', 0, 0, 3, '2008-06-25 16:03:56', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (141, 'jane', 'Милана', 'Васильевна  ', 'Егрова', 'adelia-marta107@yandex.ru', '6d7e9c72e6c641a09859b65de8af3df7e8c7932a2a', '6d7e9c72e6', '1983-09-08', 0, 'я веселый и общительный человек, люблю интересные компании в которых можно узнать много нового и интересного\r\n', NULL, '"Casual"\r\n', '', 'R`n`B\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5246, 5268, NULL, '1111111', 0, 0, 3, '2008-06-25 16:05:57', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (142, 'junior', 'Анатолий', 'Юрьевич  ', 'Александров', 'adelia-marta108@yandex.ru', 'e0cdfff460b7ca705a6d1a4abc5dc8ada963668bf4', 'e0cdfff460', '1987-04-14', 1, 'Непредсказуемый\r\n', NULL, 'Пока - учебники, но зато по литературе\r\n', 'не смотрю\r\n', 'нравится музыка без слов\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5246, 5269, NULL, '1111111', 0, 0, 3, '2008-06-25 16:08:09', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (143, 'Jack', 'Сергей', 'Александрович  ', 'Даров', 'adelia-marta109@yandex.ru', '5628f9c4e21163b8f2e17521c78b08bb616fb24c35', '5628f9c4e2', '1985-02-10', 1, 'учеба, тренировки, отдых с друзьями\r\n', NULL, '', '', 'предпочитаю танцевальную музыку', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3784, 3823, NULL, '1111111', 0, 0, 3, '2008-06-25 16:10:28', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (144, 'iivo', 'Олег', 'Алексеевич  ', 'Ильин', 'adelia-marta110@yandex.ru', 'e099a919a7aae573f40b2750f2365704bcfba66caa', 'e099a919a7', '1988-08-19', 1, 'А я просто хороший парень\r\n', NULL, '', '', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5291, 5296, NULL, '1111111', 0, 0, 3, '2008-06-25 16:12:35', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (145, 'inout', 'Андрей', 'Макарович  ', 'Трофимов', 'adelia-marta111@yandex.ru', 'beb3994b5f033c10f21847dff9923693f118b4b5e9', 'beb3994b5f', '1990-11-11', 1, 'С немалым чувством юмора и защитным слоем сарказма и иронии.\r\n', NULL, '', '', 'исполнители рэп, хип хоп, Дельфин\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5291, 5310, NULL, '1111111', 0, 0, 3, '2008-06-25 16:14:38', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (146, 'iskander', 'Дмитрий', 'Всеволодович  ', 'Маховиков', 'adelia-marta112@yandex.ru', 'd611bbd7323df0864df1d73e28a0fe0953a824a05b', 'd611bbd732', '1982-07-02', 1, 'Белый, пушистый в черную полоску.\r\n', NULL, '', '"Энциклопедия относительного и абсолютного знания"\r\n', 'все, что хорошо звучит\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5326, 5352, NULL, '1111111', 0, 0, 3, '2008-06-25 16:16:59', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (147, 'iskra', 'Алена', 'Дмитриевна  ', 'Изекеева', 'adelia-marta113@yandex.ru', 'bf45c3272d8263005438a1230ebb031cb657047185', 'bf45c3272d', '1989-01-12', 0, 'Самое важное - искренность. Открытость.. \r\n', NULL, '', '', 'представители электронной музыки\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5326, 5332, NULL, '1111111', 0, 0, 3, '2008-06-25 16:19:18', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (148, 'iney', 'Тимур', 'Андреевич  ', 'Абакумов', 'adelia-marta114@yandex.ru', '223339fdb6be49ef83e6ee814de40c586c9bc419b0', '223339fdb6', '1990-06-16', 1, 'стараюсь быть всегда оптимистом. + не люблю ограничивать себя, но и не превосхожу границы.\r\n', NULL, 'Дьявол и синьорита Прим\r\n', '', '...по настроению', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5356, 5395, NULL, '1111111', 0, 0, 3, '2008-06-25 16:21:49', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (149, 'irina', 'Ирина', 'Филипповна  ', 'Пырьева', 'adelia-marta115@yandex.ru', '9ab7ad1077d91316e89a0dc40a8f1d06ba17bc64f1', '9ab7ad1077', '1988-01-09', 0, 'Независимая оптимистка, слегка упрямая. Иногда бунтарка против стандартов и правил\r\n', NULL, '', '', 'Мне нравятся все музыкальные направления.\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5356, 5395, NULL, '1111111', 0, 0, 3, '2008-06-25 16:23:48', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (150, 'ira2000', 'Ирина', 'Никитична  ', 'Будилова', 'adelia-marta116@yandex.ru', '8017c3a8026e279e3a7a6ce4a82ad29c25471e0e67', '8017c3a802', '1984-09-03', 0, 'Вы пересекаете весь мир в поисках счастья, а оно всегда рядом, на расстоянии вытянутой руки от любого человека…\r\n', NULL, '', 'Доктор Джекил и миссис Хайд\r\n', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5356, 5391, NULL, '1111111', 0, 0, 3, '2008-06-25 16:25:54', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (151, 'immortal', 'Мария', 'Алексеевна  ', 'Ваткин', 'adelia-marta117@yandex.ru', '18928e31d4f5696584b25ee8df1cc9afd8524eff19', '18928e31d4', '1986-05-07', 0, 'Разная\r\n', NULL, '', '', 'все понемногу', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5356, 5379, NULL, '1111111', 0, 0, 3, '2008-06-25 16:39:17', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (152, 'Ivan', 'Иван', 'Богданович  ', 'Гаврилов', 'adelia-marta118@yandex.ru', 'c1a0e6ac36d13650464ffcf17da0b1c49dac834081', 'c1a0e6ac36', '1989-11-25', 1, 'Пускай другие рассказывают обо мне!\r\n', NULL, '', 'Такси, Форсаж, черная дыра\r\n', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5356, 5399, NULL, '1111111', 0, 0, 3, '2008-06-25 16:43:33', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (153, 'inna', 'Инна', 'Юрьевна  ', 'Савиинова', 'adelia-marta119@yandex.ru', 'c3aad5bdb371b37fb01878185fd7ff85bafd86136b', 'c3aad5bdb3', '1990-04-06', 0, 'Я учитель биологии.Друзья считают меня красивой, загадочной и умной.Еще я учу 2 иностранных языка.\r\n', NULL, '', '', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5356, 5391, NULL, '1111111', 0, 0, 3, '2008-06-25 16:45:24', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (154, 'horek', 'Ринат', 'Глебович  ', 'Иванов', 'adelia-marta120@yandex.ru', 'f6a45ba3b9a125d99270ab667e14238b733a977ed8', 'f6a45ba3b9', '1987-10-27', 1, 'Не без недостатков, но в общем хороший\r\n', NULL, '', '', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5356, 5394, NULL, '1111111', 0, 0, 3, '2008-06-25 16:47:24', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (155, 'horna', 'Наталья', 'Давидовна  ', 'Галазинова', 'adelia-marta121@yandex.ru', '9b26f4a51be79834b4ab78f10d33f4d9c5ce035f2e', '9b26f4a51b', '1989-02-20', 0, 'Нуууу... я такая... умная! \r\nАга)\r\n', NULL, 'Книги Свияша\r\n', '', 'Эни Мориконе\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5356, 5380, NULL, '1111111', 0, 0, 3, '2008-06-25 16:50:26', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (156, 'hallo', 'Анна', 'Кирилловна  ', 'Бойцова', 'adelia-marta122@yandex.ru', 'fecd6747d9749bddf109e9e1fa49e872b7de9658ae', 'fecd6747d9', '1989-03-17', 0, 'Люблю радоваться жизни и даже всяким мелочам, так как именно из них и складывается наша жизнь!\r\n', NULL, '', 'Пираты карибского моря, Троя, Форсаж...', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5432, 5456, NULL, '1111111', 0, 0, 3, '2008-06-25 16:52:53', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (157, 'HFTM', 'Виктор', 'Иванович  ', 'Востряк', 'adelia-marta123@yandex.ru', '30b3485fad89b8fd6c2d9be725514f6a03f9ddb391', '30b3485fad', '1983-02-25', 1, 'Неординарная, веселая и добрая личность, со всеми присущими человеку недостатками и достоинствами\r\n', NULL, '', '', 'dark elektro', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5473, 5504, NULL, '1111111', 0, 0, 3, '2008-06-25 16:55:20', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (158, 'Hivest', 'Дмитрий', 'Денисович  ', 'Наумов', 'adelia-marta124@yandex.ru', 'cd3e85ae16bd62efc34c4e32e4ef24eaa78c8bab54', 'cd3e85ae16', '1986-01-26', 1, 'НЕСАМОДОСТАТОЧНЫЙ (самого себя мне не достаточно)', NULL, '', 'Достучаться до небес, жестокие игры, Афера Томаса Крауна, Осень в Нью-Йорке, Фартовый и др.', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5507, 5539, NULL, '1111111', 0, 0, 3, '2008-06-25 16:57:43', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (159, 'helly', 'Алина', 'Фёдоровна  ', 'Каталышева', 'adelia-marta125@yandex.ru', 'd9eb370190a302f95c2ede0f1313f2ad262a6987d2', 'd9eb370190', '1987-08-01', 0, 'я сама не знаю какая я\r\n', NULL, '', 'все фильмы нравятся, а еще хочу собрать коллекцию всех фильмов, что получили оскар\r\n', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5600, 5619, NULL, '1111111', 0, 0, 3, '2008-06-25 16:59:57', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (160, 'Halk', 'Тарас', 'Сергеевич  ', 'Зубов', 'adelia-marta126@yandex.ru', '342ca57699665061ecebe22017f01691c58c911f19', '342ca57699', '1989-06-24', 1, 'В полном расцвете сил! Настоящий карлсон\r\n', NULL, 'Михаил Успенский "Время Оно"', 'Достучаться до небес\r\n', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5600, 5619, NULL, '1111111', 0, 0, 3, '2008-06-25 17:02:17', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (161, 'helga', 'Светлана', 'Игоревна  ', 'Митина', 'adelia-marta127@yandex.ru', 'd0b7f7ee0abb0a8f3667ddb6edc5058d27704fcf41', 'd0b7f7ee0a', '1981-11-27', 0, 'Веселая и спортивная\r\n', NULL, '', '', 'Иностранная поп-музыка, а кто - практически не важно', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5019394, 5020365, NULL, '1111111', 0, 0, 3, '2008-06-25 17:04:28', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (162, 'Gie88', 'Илья', 'Павлович  ', 'Лебедь', 'adelia-marta128@yandex.ru', '9b53c6b28968be9ed06e162d2c655053ca1b5d11f1', '9b53c6b289', '1988-02-02', 1, 'Это я\r\n', NULL, '', '', 'диджеи\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5625, 5646, NULL, '1111111', 0, 0, 3, '2008-06-25 17:06:24', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (163, 'Gregory', 'Григорий', 'Викентиевич  ', 'Игряшов', 'adelia-marta129@yandex.ru', '29b47c66c390fbe53cce0c4b4e85c0344efd913786', '29b47c66c3', '1989-09-15', 1, 'Всё познаётся в общении \r\n', NULL, '', '', 'музыканты в направлениях Vocal Trance, Melodic Trance, Progressive Trance, Synth pop, Future Pop, EBM, TBM, Electropop, IDM,DJing', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4358, NULL, '1111111', 0, 0, 3, '2008-06-25 17:08:59', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (164, 'pantera', 'Рада', 'Сергеевна  ', 'Кадушкина', 'adelia-marta130@yandex.ru', '15d03868431937cd8eded9a4822239474e9b1a73a7', '15d0386843', '1984-05-23', 0, 'не вижу смысла описывать какая я, симпатичная или нет, какие у меня глаза и т.п. Что касается характера...это вопрос времени, т.е. общения', NULL, '', '', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 17:11:06', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (165, 'bagira', 'Екатерина', 'Александровна', 'Беленко', 'adelia-marta131@yandex.ru', '90085b669b84d23792dcba37575f1a6867f624a37e', '90085b669b', '1989-01-07', 0, 'Интересная, целеустремленная...Красивая и милая…\r\n', NULL, '', 'Гордость и предубеждение\r\n', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 17:13:02', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (166, 'Grig', 'Кирилл', 'Александрович  ', 'Кисленко', 'adelia-marta132@yandex.ru', '8d4c3b029941695b98fa4425dd61636666396ac2ec', '8d4c3b0299', '1988-10-21', 1, 'А так я...решать вам.\r\n', NULL, '', 'Рокки, Леон, Близнецы-Драконы, Полицейская история, 5 элемент, Крепкий орешек...', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4398, NULL, '1111111', 0, 0, 3, '2008-06-25 17:14:58', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (167, 'grim', 'Елена', 'Георгиевна  ', 'Дадаева', 'adelia-marta133@yandex.ru', 'd89d5f4b34f813d1677721cdfef3378e07eb9ac143', 'd89d5f4b34', '1986-05-24', 0, 'вооружена и опасна!)\r\n', NULL, '', '', 'почти все!по настроению...)', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 17:16:43', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (168, 'Favorit', 'Олег', 'Михайлович  ', 'Абаев', 'adelia-marta134@yandex.ru', '6ddc81406bc000354003a428788617c5278b3d900b', '6ddc81406b', '1990-10-28', 1, 'располагающий к себе человек) ', NULL, '', 'комедии', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 17:18:43', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (169, 'Vlada', 'Влада', 'Степановна  ', 'Азаева', 'adelia-marta135@yandex.ru', '452f96a8c690aa5c2197f00279648f022fc93828de', '452f96a8c6', '1987-07-11', 0, 'добрая, весёлая !\r\n', NULL, '', '', 'иностранный рок\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 17:20:59', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (170, 'Favn', 'Александр', 'Константинович  ', 'Васько', 'adelia-marta136@yandex.ru', 'd0030429c5dd949f76690172cfbf57b8dae15314a1', 'd0030429c5', '1984-11-03', 1, 'Почти идеальный \r\n', NULL, 'да не читаю я :) надоедает\r\n', 'все то, что сейчас идет в кино\r\n', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 17:23:24', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (171, 'Frank', 'Виталий', 'Тарасович  ', 'Калинин', 'adelia-marta137@yandex.ru', 'f1389b590c44e002aad665f514c666fd949a45cab4', 'f1389b590c', '1983-06-13', 1, 'очень хороший человек. немного стеснительный. люблю общаться с интересными людьми. служу по контракту в армии.\r\n', NULL, '', '', 'поп-музканты\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 17:25:26', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (172, 'ezsh', 'Антон', 'Олегович  ', 'Болотников', 'adelia-marta138@yandex.ru', 'ac82bab8489dcc1c9ebf83743808bcd891f575a333', 'ac82bab848', '1988-09-19', 1, 'ищу вдохновения\r\n', NULL, '', '', 'Танцевальная музыка\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 17:27:32', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (173, 'evgeny', 'Евгений', 'Фёдорович  ', 'Адамов', 'adelia-marta139@yandex.ru', '44ca035c62bb255d2faccb552a90b8cfb9d631914f', '44ca035c62', '1988-01-17', 1, 'Я уверенный, оптимист, серьезный в каких то делах.Характер не вспыльчивый, но иногда, если вывести.Добрый.Люблю слушать музыку, особенно альтернативу.Учусь на 2 курсе в универе на таможенника.Работаю в строительной компании снабженцем.Ну а остальное при общении:)', NULL, '', '', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4398, NULL, '1111111', 0, 0, 3, '2008-06-25 17:29:18', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (174, 'gina', 'Наталья', 'Робертовна  ', 'Мамонтова', 'adelia-marta140@yandex.ru', 'c21ac01831a7a5b41599945767d4c234a88df25fb0', 'c21ac01831', '1987-03-06', 0, 'а прям Талант ходячий!) идеальный подбор...и честно ведь!', NULL, '', 'титаник', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 17:32:39', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (175, 'fishka', 'Ольга', 'Викторовна  ', 'Адрианова', 'adelia-marta141@yandex.ru', 'f9ad480bfcc0d3547679d7482855fa73686e6a2419', 'f9ad480bfc', '1988-11-25', 0, 'Больше 5 слов писать не умею ) ( и читать тоже )\r\n', NULL, '', '', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3371, 3376, NULL, '1111111', 0, 0, 3, '2008-06-25 17:34:28', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (176, 'fint', 'Людмила', 'Николаевна  ', 'Засорина', 'adelia-marta142@yandex.ru', '0df7948333e018c75223c530fde9532d9de35beadb', '0df7948333', '1988-08-28', 0, 'Все перед вами :)\r\n', NULL, '', '', 'по прихоти\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 5191, 5219, NULL, '1111111', 0, 0, 3, '2008-06-25 17:36:20', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (177, 'fromto', 'Алена', 'Акимовна', 'Петрова', 'adelia-marta143@yandex.ru', '1fcfad999d8dffc24080cf64bb04e49ee5a6190dde', '1fcfad999d', '1989-01-05', 0, 'Самая, самая…\r\n', NULL, '99 франков, конец света или страна чудес без тормозов\r\n', '', 'что нибудь поспокойнее\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 17:38:09', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (178, 'ed84', 'Эдуард', 'Аркадьевич  ', 'Арташин', 'adelia-marta144@yandex.ru', '106c81e279fe7def291bf2305849142899685cd277', '106c81e279', '1984-01-27', 1, 'Объективно можно судить только со стороны, не буду принижать или завышать самооценку.\r\n', NULL, '', '', 'завсит от настроения\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 17:40:03', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (179, 'feona', 'Анастасия', 'Арсеньевна  ', 'Ерзутова', 'adelia-marta145@yandex.ru', '065f55cabbbc45df2490453f93ab6daba6e6d1ffa7', '065f55cabb', '1985-06-23', 0, 'Добрая, интересная, общительная\r\n', NULL, 'книги оксаны робски\r\n', '99 франков\r\n', 'милен фармер\r\n', 'а это важно?', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 17:42:09', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (180, 'Eddy', 'Эдуард', 'Арсеньевич  ', 'Гаман', 'adelia-marta146@yandex.ru', '746f181575bbcdcf98d966f57dcd293cbb316c257a', '746f181575', '1988-07-22', 1, 'Я пожалуй самый что нинаесть обычный человек. В любом случае, я не тот человек, в присутствии которого можно расслабиться.\r\n', NULL, '', 'предпочитаю экшен\r\n', 'да все без особого разбора\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 17:44:12', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (181, 'fina', 'Олеся', 'Ивановна  ', 'Мастыкова', 'adelia-marta147@yandex.ru', '5fb4e777a47bed7e7f6efd678e704f6160bb60fb05', '5fb4e777a4', '1984-11-04', 0, 'Целеустремленная, жизнерадостная и общительная девушка. Немного капризная и упрямая.\r\n', NULL, '', 'любые книги, главное, чтобы они давали пищу для ума\r\n', 'предпочитаю танцевальную музыку. А там очень много разных композиторов\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 17:48:35', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (182, 'Dmitry', 'Дмитрий', 'Фёдорович  ', 'Боят', 'adelia-marta148@yandex.ru', '664a524f7adaf2dee0928a3282446cd092b554b85b', '664a524f7a', '1987-04-21', 1, 'Обычно не интересуюь мнением других, а свое высказывают даже в том случае, когда об этом вовсе не просят, пренебрегая тактом или приличиями. Я независим во всех отношениях, "идти на компромисс" не моя стихия. Но при всё этом справедлив и рассудителен.', NULL, '', '', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 17:50:20', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (183, 'malysh', 'Марина', 'Павловна  ', 'Кетмелева', 'adelia-marta149@yandex.ru', 'a2b21560b1bd4f6349cf5c997fbc2283a35977792d', 'a2b21560b1', '1988-09-09', 0, 'Веселая, добрая, отзывчивая, симпатичная и пусть все так проо себя говорят, я то не только говорю, но и соответствую ;) ', NULL, '', '', 'дюран дюран\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 17:51:58', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (184, 'Dima-N', 'Дмитрий', 'Иванович  ', 'Айдов', 'adelia-marta150@yandex.ru', '64ec47fd008412574abdd284d4776cd8ba3a193458', '64ec47fd00', '1986-10-19', 1, 'Я такой какой есть! Я такой один! Такого нигде не найдешь!:) \r\n', NULL, '', '', 'современные', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 17:53:49', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (185, 'aisha', 'Юлия', 'Серафимовна  ', 'Веренок', 'adelia-marta151@yandex.ru', '3466bd71bc2446e7acaa94b61fb3bed89639643767', '3466bd71bc', '1988-05-03', 0, 'без предрассудков, но с принципами и планкой. учусь, работаю, развлекаюсь.аспирантка, путешественница, в меру- карьеристка, в меру- умница, стремлюсь к гармонии и душевному равновесию при наличии всего того, что из этого равновесия выводит. и, как говорится в одной глупой рекламе"долой пустые понты!"', NULL, '', '', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 17:55:44', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (186, 'elena', 'Елена', 'Филипповна  ', 'Авершина', 'adelia-marta152@yandex.ru', 'd9c59007bdfe7f686ca6ee60d5bbff023fb7566149', 'd9c59007bd', '1990-08-17', 0, 'Я молодая, уверенная в себе, заботливая, слегка болтливая, приятная девушка)Люблю все оригинальное и красивое)У меня нестандартный подход к жизни, но я очень стабильна в своем выборе)\r\n', NULL, '', '', 'Progressive trance, electro.techno (Armin van Buuren, Above&Beyond, Markus Schulz)', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 17:57:35', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (187, 'Dima', 'Дмитрий', 'Валентинович  ', 'Иванецкий', 'adelia-marta153@yandex.ru', 'e8bcd33cd0018e3e9b8861d7d1d48827b538d3c7fb', 'e8bcd33cd0', '1989-07-15', 1, 'Работаю. Учусь.\r\nЛюблю активный отдых и путешествия.\r\nУвлекаюсь экстремальными видами спорта.\r\nЛюблю смотреть фильмы.\r\nМузыка от настроения…', NULL, '', '', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 17:59:12', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (188, 'Damir', 'Роман', 'Русланович  ', 'Алатов', 'adelia-marta154@yandex.ru', '2829a23c67c03f08e8892e9a7fb3d696c897a5d37b', '2829a23c67', '1983-03-07', 1, 'Всегда хочу чего то нового, новых знакомств, съездить туда где ещё небыл и много приятных вещей.\r\n', NULL, '', 'угнать за 60 секунд\r\n', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 18:00:49', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (189, 'darkin', 'Сергей', 'Афанасьевич  ', 'Водянов', 'adelia-marta155@yandex.ru', 'e1c5c943eecb921443f20c70a22648bdfa9bdb7796', 'e1c5c943ee', '1988-08-13', 1, 'яркая личность\r\n', NULL, '', 'Властелин колец\r\n', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 18:02:39', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (190, 'Dakota', 'Андрей', 'Георгиевич  ', 'Вотяков', 'adelia-marta156@yandex.ru', '389696b501d183e0ed43c4b207ab9f3a521a489d61', '389696b501', '1989-06-11', 1, 'Дикий и неадекватный\r\n', NULL, '', 'Бойцовский клуб\r\n', 'Techno; Trance; Drum''n''Bass и все, что с этим связанно', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4561, 4580, NULL, '1111111', 0, 0, 3, '2008-06-25 18:04:42', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (191, 'eva-lik', 'Татьяна', 'Эдуардовна  ', 'Дельнова', 'adelia-marta157@yandex.ru', '2bc395b7c5784d0335ee0a6d5c2ead8bd4138ebf5d', '2bc395b7c5', '1984-04-09', 0, 'самый жизнерадостный человек на свете. люблю природу, особенно когда я одна. \r\n', NULL, '', '', 'не люблю музыку at all', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 18:06:43', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (192, 'drive', 'Настя', 'Петровна  ', 'Мартиросян', 'adelia-marta158@yandex.ru', '72cce069c30a54b789e9386cabe361bd20c4725649', '72cce069c3', '1985-09-01', 0, ':)\r\n', NULL, '', '', 'r''n''b\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4800, 4848, NULL, '1111111', 0, 0, 3, '2008-06-25 18:08:19', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (193, 'divine', 'Маргарита', 'Степановна  ', 'Ламина', 'adelia-marta159@yandex.ru', '274ead83027120927e9024592ff3d979fd54151198', '274ead8302', '1989-07-05', 0, 'Любовь-дитя иллюзии и одновременно мать разочарования.\r\n', NULL, 'написаные ветками ивы на воде\r\n', 'те, что люди видят, когда закрывают глаза\r\n', 'шум дождя и водопада\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4925, 4962, NULL, '1111111', 0, 0, 3, '2008-06-25 18:09:50', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (194, 'Cotvot', 'Евгений', 'Вадимович  ', 'Грехнев', 'adelia-marta160@yandex.ru', '2e039abda4169307f369fe4684ebcc041a70bee819', '2e039abda4', '1987-03-03', 1, 'Друзья и знакомые говорят что я милый, добрый, отзывчевый, заботливый человек.', NULL, '', 'Шрек\r\n', 'шансон', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 18:14:26', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (195, 'diva', 'Виктория', 'Петровна  ', 'Ковалюк', 'adelia-marta161@yandex.ru', 'b70da4d3f32bc293e5c7a879b727750677804c851a', 'b70da4d3f3', '1989-02-20', 0, 'У меня свои тараканы в голове :) но могу и поделиться', NULL, '"Ден Браун "" Ангелы и Демоны""\r\n', 'Prison break, Горбатая гора, Эфект бабочки\r\n', 'stim, anderwat sd, гуф, баста, многоточие\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4925, 4962, NULL, '1111111', 0, 0, 3, '2008-06-25 18:17:25', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (196, 'catty', 'Валерия', 'Ефремовна  ', 'Савельева', 'adelia-marta162@yandex.ru', '0005867c1e27c75f9529154269a73022b0b2602ffd', '0005867c1e', '1990-09-02', 0, 'Со стороны видней\r\n', NULL, '', '', 'предпочитаю электронную музыку\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 18:20:07', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (197, 'catcat', 'Елена', 'Сергеевна  ', 'Жоголева', 'adelia-marta163@yandex.ru', 'b219c3b7a3f4e1bf33c104fe61cb68f065e3a26f1c', 'b219c3b7a3', '1987-05-22', 0, 'Веселая, энергичная.девушка с позитивным отношением к жизни\r\n', NULL, '', 'Фильмы Никиты Михалкова\r\n', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4925, 4962, NULL, '1111111', 0, 0, 3, '2008-06-25 18:23:19', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (198, 'corol', 'Илья', 'Адамович', 'Божак', 'adelia-marta164@yandex.ru', 'fa3c9c10897226ad565189d168081db7a58643f806', 'fa3c9c1089', '1989-01-21', 1, 'Класный парень\r\n', NULL, '', '', 'электрохаус', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4925, 4962, NULL, '1111111', 0, 0, 3, '2008-06-25 18:25:07', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (199, 'Collin', 'Николай', 'Иванович  ', 'Иванов', 'adelia-marta165@yandex.ru', '70cdf733479662f2d28c837294f500b8c4a0785a40', '70cdf73347', '1989-10-28', 1, 'Нам всегда кажется, что нас любят за то, что мы хороши. А не догадываемся, что любят нас оттого, что хороши те, кто нас любит. ', NULL, '', '', 'шансон', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4925, 4962, NULL, '1111111', 0, 0, 3, '2008-06-25 18:27:01', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (200, 'Bank', 'Владимир', 'Александрович  ', 'Вазей', 'adelia-marta166@yandex.ru', '2adddc14668f242408b4a5a4d9c41841d2e45c2e93', '2adddc1466', '1983-05-10', 1, 'Я - подарок, который не требует ухода. Задуман, Разработан и Сотворен по результат\r\n', NULL, '', 'Автостопом по галактике\r\n', 'М.Круг.\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4925, 4961, NULL, '1111111', 0, 0, 3, '2008-06-25 18:28:43', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (201, 'beauty', 'Наташа', 'Германовна  ', 'Варламина', 'adelia-marta167@yandex.ru', '5504c5bf46da09f3a3dce55c4a7e8a8f45f1fd0efa', '5504c5bf46', '1982-10-26', 0, 'адекватнная, с уравновешенным \r\nхарактером, симпотичная, воспитанная и умная', NULL, 'понедельникк начинается в субботу, факультет патологии\r\n', 'банльно, но с легким паром\r\n', 'бардовские исполнители\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4925, 4943, NULL, '1111111', 0, 0, 3, '2008-06-25 18:30:37', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (202, 'betty', 'Юля', 'Станиславовна  ', 'Савина', 'adelia-marta168@yandex.ru', 'd7985e7528c9d30d945bffb5f9fcc5ef876e574a7b', 'd7985e7528', '1987-07-04', 0, 'Я разносторонний человек, у меня много интересов.Люблю веселье, активный отдых, большие компании.Очень не люблю скучать!. \r\n', NULL, '12 стульев\r\n', 'люблю советские комедии, а еще очень понравился сериал ""Ликвидация"', '', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3841, 3863, NULL, '1111111', 0, 0, 3, '2008-06-25 18:32:22', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (203, 'banner', 'Евгений', 'Львович  ', 'Агеев', 'adelia-marta169@yandex.ru', '33ad65b4cf60120f0018c76cef2376e35edd74bf9c', '33ad65b4cf', '1989-11-18', 1, 'Хитёр.Властолюбив.Беспринципиален.Мил.Хам.Вместе с тем спокоен, уверен, иногда беспощаден и невероятно нагл на фоне собственной учтивости и деликатности.Легко втираюсь в доверие.Получаю от жизни то, что хочу получить.Не спонсор, но любимому человеку готов отдать всё чем сказочно богат.Дрессировке не поддаюсь.Джеймс Бонд просто отдыхает, нервно куря за дверью', NULL, '', '17 мгновений весны\r\n', 'kosheen, schiller\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3921, 3933, NULL, '1111111', 0, 0, 3, '2008-06-25 18:34:30', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (204, 'Allan', 'Александр', 'Сергеевич  ', 'Иванов', 'adelia-marta170@yandex.ru', 'c040b7ce2169d0514e9c63dfac1b24353adc4f6cda', 'c040b7ce21', '1981-06-01', 1, 'Сильный не тот, кто после полученного удара дал сдачи, а тот кто сумел выстоять на ногах и не упал !', NULL, 'отечественная фантастика, Беляев, Стругацкие\r\n', '', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3952, 3963, NULL, '1111111', 0, 0, 3, '2008-06-25 18:36:18', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (205, 'aloha', 'Алена', 'Олеговна  ', 'Гольдина', 'adelia-marta171@yandex.ru', '3a28da9ac3c8f4c12b8343ee5899d3fb187c9bc18f', '3a28da9ac3', '1988-09-14', 0, 'Веселая, спортивная, с чувством юмора!\r\n', NULL, '', '', 'классическая муз-ыка, а вообще - по настроению\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4734, 4741, NULL, '1111111', 0, 0, 3, '2008-06-25 18:38:11', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (206, 'Bart', 'Константин', 'Александрович  ', 'Агапов', 'adelia-marta172@yandex.ru', 'ff581314ab40a314f6ea48cc8891c2f95a7c847513', 'ff581314ab', '1989-03-16', 1, 'Я люблю)... Стоять под дождем на крыше своего дома... Проводить съемки по десять часов, зная, что на отдых останется часа четыре, а с утра все повторится... Книги, хорошие были и останутся (пусть не говорят, что мое поколение - самое нечитающее), а плохими, как и раньше, я буду шкафы подпирать... \r\n', NULL, '"Тропик козерога" Генри Миллера', '', 'фанк. DDT, Dusty Bottom, Ted Nash Quarted, Superfunk, Pink Floyd, Jamiroquai, Simply Red, Chris Rea', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4052, 4094, NULL, '1111111', 0, 0, 3, '2008-06-25 18:40:04', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (207, 'boris', 'Борис', 'Илларионович  ', 'Никитенко', 'adelia-marta173@yandex.ru', '2fae08f6524ba78a8544809c6f750c7bcbabf174f4', '2fae08f652', '1984-11-03', 1, 'мой номер 245, на телогреечке печать…\r\n', NULL, 'Любимые писатели  Акутагава, Баркер, Приставкин, Роллечек, Алан Маршалл, Эрнст Сетон - Томпсон, Приемыхов, Дюрренматт, Буковский\r\n', '', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4052, 4094, NULL, '1111111', 0, 0, 3, '2008-06-25 18:41:45', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (208, 'Ashli', 'Илья', 'Иннокентиевич  ', 'Строженов', 'adelia-marta174@yandex.ru', '62ea4ba0f90edeefb3fc1405f893714849f5261411', '62ea4ba0f9', '1990-03-26', 1, 'Веселый я, занимаюсь Стантрайдингом, Боевым Самбо, просто гоняю на мотоцикле, увлекаюсь Футболом, Хоккеем,\r\n', NULL, '', '', 'DnB', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4052, 4094, NULL, '1111111', 0, 0, 3, '2008-06-25 18:43:29', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (209, 'anny', 'Аня', '', 'Лущенко', 'adelia-marta175@yandex.ru', '9b2416dbf77fb4b00daded4f1174e2fa987f93586f', '9b2416dbf7', '1988-10-12', 0, 'Всегда открыта для общениz', NULL, '', '', 'меломанка в крайней стадии мании', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 9908, 10373, 10398, NULL, '1111111', 0, 0, 3, '2008-06-25 18:45:29', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (210, 'Abrvalg', 'Олег', 'Владимирович  ', 'Бровин', 'adelia-marta176@yandex.ru', '86af0881ee2029730c469b5958d317f140d3025d0d', '86af0881ee', '1986-05-19', 1, 'Клубок потиворечий\r\n', NULL, '', '', 'этнический рэп\r\n', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 9908, 10373, 10398, NULL, '1111111', 0, 0, 3, '2008-06-25 18:47:21', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (211, 'ankora', 'Анастасия', 'Александровна  ', 'Варламова', 'adelia-marta177@yandex.ru', '74e8ed97d7407fcc5a91b1abdb30a6c5d1a41ba8e7', '74e8ed97d7', '1982-08-02', 0, 'Такая, какая есть\r\n', NULL, '', '', 'люблю танцевальную музыку\r\n', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3352, 3354, NULL, '1111111', 0, 0, 3, '2008-06-25 18:49:18', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (212, 'Armand', 'Дмитрий', 'Васильевич  ', 'Львов', 'adelia-marta178@yandex.ru', '2567176da092dbc06ee3c07e804ce637aa5cddb622', '2567176da0', '1984-09-02', 1, 'Внешне - простой и, вроде бы, даже, обычный.\r\nХотя, поговорка ""по одёжке встречают...провожают тоже плохо"" - 100% не про меня)\r\nВот и думай,те какой же я...\r\n', NULL, '', '', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 3952, 3963, NULL, '1111111', 0, 0, 3, '2008-06-25 18:51:18', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (213, 'Alley', 'Константин', 'Витальевич  ', 'Александров', 'adelia-marta179@yandex.ru', 'f066e1f2b0e64627400fe62f078bd304b672389c93', 'f066e1f2b0', '1988-03-20', 1, 'Фартовый\r\n', NULL, 'читаю все подряд, особенно журналы\r\n', '', '', 'холост', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4402, NULL, '1111111', 0, 0, 3, '2008-06-25 18:52:59', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (214, 'alla', 'Алла', 'Сергеевна  ', 'Байкова', 'adelia-marta180@yandex.ru', '9eea68d12945bdc03b359a24427a2e4b9d11906826', '9eea68d129', '1988-07-07', 0, 'Истинная арийка, характер нордический твердый...и т.д и т.п.=)\r\n', NULL, 'мастер и маргарита\r\n', 'москва слезам не верит вообще люблю все старые фильмы\r\n', 'слушаю радио "Relax" и все в нем', 'не замужем', '', '', '', '', 0, NULL, NULL, NULL, 3159, 4312, 4400, NULL, '1111111', 0, 0, 3, '2008-06-25 18:54:46', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (215, 'sergey_ben', '', '', '', 'bondarev.serg@gmail.com', 'ad997580e1a1c54fb98facc6829f6222974c6c77c7', 'ad997580e1', '1908-00-01', 0, '', NULL, '', '', '', '', '', '', '', '', 0, NULL, NULL, NULL, 4, 0, 0, NULL, '1111111', 0, 0, 3, '2008-09-22 16:01:42', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (216, 'serg', 'Сергей', '', '', 'bondareff.serg@gmail.com', 'e2a2ec0a4bf6120b97571d8f12852d0a867786b046', 'e2a2ec0a4b', '1908-00-01', 1, '', NULL, '', '', '', '', '', '', '', '', 0, NULL, NULL, NULL, 4, 0, 0, NULL, '1111111', 0, 0, 3, '2008-09-23 15:34:24', 0, 0, 0, 0, 0);
INSERT INTO `users` VALUES (224, 'qwas', 'sdfsd', 'dfg', 'qweerr', 'ipartemk@mail.ru', '7e064d1e1ebce866735449b964dbfb2697e0850a7e', '7e064d1e1e', '1911-00-01', 1, 'sdf', NULL, 'ghj', 'jkl', 'l;''', 'rrr', '234', '555', '66', '777', 1, NULL, NULL, NULL, 582059, 24350625, 0, NULL, '1111111', 0, 2.5, 3, '2008-11-26 10:07:49', 0, 0, 0, 14, 0);
INSERT INTO `users` VALUES (225, 'kirill', '', '', '', 'iio@ttt.ru', '684b0f648c56ec346a6656dfb64ddfeb449c7e0524', '684b0f648c', '1909-00-01', 0, '', NULL, '', '', '', '', '', '', '', '', 0, NULL, NULL, NULL, 4, 0, 0, NULL, 'a:4:{i:0;a:2:{s:2:"id";s:1:"0";s:8:"selected";b:1;}i:1;a:2:{s:2:"id";s:1:"1";s:8:"selected";b:1;}i:2;a:2:{s:2:"id";s:1:"3";s:8:"selected";b:1;}i:3;a:2:{s:2:"id";s:1:"2";s:8:"selected";b:1;}}', 0, 0.5, 3, '2009-02-16 16:43:10', 0, 0, 0, 0, 70);

-- --------------------------------------------------------

-- 
-- Структура таблицы `users_interests`
-- 

DROP TABLE IF EXISTS `users_interests`;
CREATE TABLE IF NOT EXISTS `users_interests` (
  `user_id` bigint(20) NOT NULL,
  `interest_id` bigint(20) NOT NULL,
  PRIMARY KEY  (`user_id`,`interest_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Дамп данных таблицы `users_interests`
-- 

INSERT INTO `users_interests` VALUES (23, 1);
INSERT INTO `users_interests` VALUES (23, 2);
INSERT INTO `users_interests` VALUES (23, 3);
INSERT INTO `users_interests` VALUES (24, 3);
INSERT INTO `users_interests` VALUES (24, 4);
INSERT INTO `users_interests` VALUES (24, 5);
INSERT INTO `users_interests` VALUES (24, 6);
INSERT INTO `users_interests` VALUES (25, 7);
INSERT INTO `users_interests` VALUES (25, 8);
INSERT INTO `users_interests` VALUES (25, 9);
INSERT INTO `users_interests` VALUES (25, 10);
INSERT INTO `users_interests` VALUES (25, 11);
INSERT INTO `users_interests` VALUES (25, 12);
INSERT INTO `users_interests` VALUES (25, 13);
INSERT INTO `users_interests` VALUES (26, 9);
INSERT INTO `users_interests` VALUES (26, 14);
INSERT INTO `users_interests` VALUES (26, 15);
INSERT INTO `users_interests` VALUES (26, 16);
INSERT INTO `users_interests` VALUES (27, 17);
INSERT INTO `users_interests` VALUES (27, 18);
INSERT INTO `users_interests` VALUES (27, 19);
INSERT INTO `users_interests` VALUES (29, 3);
INSERT INTO `users_interests` VALUES (29, 17);
INSERT INTO `users_interests` VALUES (29, 20);
INSERT INTO `users_interests` VALUES (29, 21);
INSERT INTO `users_interests` VALUES (29, 22);
INSERT INTO `users_interests` VALUES (29, 23);
INSERT INTO `users_interests` VALUES (29, 24);
INSERT INTO `users_interests` VALUES (29, 25);
INSERT INTO `users_interests` VALUES (29, 26);
INSERT INTO `users_interests` VALUES (29, 27);
INSERT INTO `users_interests` VALUES (29, 28);
INSERT INTO `users_interests` VALUES (29, 29);
INSERT INTO `users_interests` VALUES (29, 30);
INSERT INTO `users_interests` VALUES (29, 31);
INSERT INTO `users_interests` VALUES (29, 32);
INSERT INTO `users_interests` VALUES (29, 33);
INSERT INTO `users_interests` VALUES (29, 34);
INSERT INTO `users_interests` VALUES (29, 35);
INSERT INTO `users_interests` VALUES (30, 36);
INSERT INTO `users_interests` VALUES (30, 37);
INSERT INTO `users_interests` VALUES (30, 38);
INSERT INTO `users_interests` VALUES (30, 39);
INSERT INTO `users_interests` VALUES (30, 40);
INSERT INTO `users_interests` VALUES (31, 41);
INSERT INTO `users_interests` VALUES (31, 42);
INSERT INTO `users_interests` VALUES (31, 43);
INSERT INTO `users_interests` VALUES (31, 44);
INSERT INTO `users_interests` VALUES (31, 45);
INSERT INTO `users_interests` VALUES (31, 46);
INSERT INTO `users_interests` VALUES (31, 47);
INSERT INTO `users_interests` VALUES (31, 48);
INSERT INTO `users_interests` VALUES (31, 49);
INSERT INTO `users_interests` VALUES (31, 50);
INSERT INTO `users_interests` VALUES (31, 51);
INSERT INTO `users_interests` VALUES (32, 30);
INSERT INTO `users_interests` VALUES (32, 52);
INSERT INTO `users_interests` VALUES (33, 53);
INSERT INTO `users_interests` VALUES (33, 54);
INSERT INTO `users_interests` VALUES (33, 55);
INSERT INTO `users_interests` VALUES (33, 56);
INSERT INTO `users_interests` VALUES (33, 57);
INSERT INTO `users_interests` VALUES (33, 58);
INSERT INTO `users_interests` VALUES (33, 59);
INSERT INTO `users_interests` VALUES (33, 60);
INSERT INTO `users_interests` VALUES (35, 61);
INSERT INTO `users_interests` VALUES (35, 62);
INSERT INTO `users_interests` VALUES (35, 63);
INSERT INTO `users_interests` VALUES (35, 64);
INSERT INTO `users_interests` VALUES (35, 65);
INSERT INTO `users_interests` VALUES (36, 17);
INSERT INTO `users_interests` VALUES (36, 66);
INSERT INTO `users_interests` VALUES (36, 67);
INSERT INTO `users_interests` VALUES (36, 68);
INSERT INTO `users_interests` VALUES (36, 69);
INSERT INTO `users_interests` VALUES (37, 70);
INSERT INTO `users_interests` VALUES (37, 71);
INSERT INTO `users_interests` VALUES (38, 72);
INSERT INTO `users_interests` VALUES (39, 73);
INSERT INTO `users_interests` VALUES (40, 29);
INSERT INTO `users_interests` VALUES (40, 30);
INSERT INTO `users_interests` VALUES (40, 44);
INSERT INTO `users_interests` VALUES (42, 74);
INSERT INTO `users_interests` VALUES (43, 75);
INSERT INTO `users_interests` VALUES (43, 76);
INSERT INTO `users_interests` VALUES (44, 44);
INSERT INTO `users_interests` VALUES (44, 49);
INSERT INTO `users_interests` VALUES (44, 77);
INSERT INTO `users_interests` VALUES (44, 78);
INSERT INTO `users_interests` VALUES (44, 79);
INSERT INTO `users_interests` VALUES (46, 79);
INSERT INTO `users_interests` VALUES (46, 80);
INSERT INTO `users_interests` VALUES (47, 47);
INSERT INTO `users_interests` VALUES (47, 81);
INSERT INTO `users_interests` VALUES (47, 82);
INSERT INTO `users_interests` VALUES (47, 83);
INSERT INTO `users_interests` VALUES (47, 84);
INSERT INTO `users_interests` VALUES (48, 48);
INSERT INTO `users_interests` VALUES (48, 85);
INSERT INTO `users_interests` VALUES (48, 86);
INSERT INTO `users_interests` VALUES (48, 87);
INSERT INTO `users_interests` VALUES (49, 88);
INSERT INTO `users_interests` VALUES (50, 89);
INSERT INTO `users_interests` VALUES (51, 3);
INSERT INTO `users_interests` VALUES (51, 44);
INSERT INTO `users_interests` VALUES (51, 50);
INSERT INTO `users_interests` VALUES (51, 90);
INSERT INTO `users_interests` VALUES (51, 91);
INSERT INTO `users_interests` VALUES (52, 66);
INSERT INTO `users_interests` VALUES (52, 67);
INSERT INTO `users_interests` VALUES (52, 80);
INSERT INTO `users_interests` VALUES (52, 92);
INSERT INTO `users_interests` VALUES (52, 93);
INSERT INTO `users_interests` VALUES (52, 94);
INSERT INTO `users_interests` VALUES (52, 95);
INSERT INTO `users_interests` VALUES (52, 96);
INSERT INTO `users_interests` VALUES (53, 97);
INSERT INTO `users_interests` VALUES (53, 98);
INSERT INTO `users_interests` VALUES (53, 99);
INSERT INTO `users_interests` VALUES (54, 47);
INSERT INTO `users_interests` VALUES (54, 100);
INSERT INTO `users_interests` VALUES (55, 3);
INSERT INTO `users_interests` VALUES (55, 10);
INSERT INTO `users_interests` VALUES (55, 67);
INSERT INTO `users_interests` VALUES (55, 101);
INSERT INTO `users_interests` VALUES (55, 102);
INSERT INTO `users_interests` VALUES (56, 50);
INSERT INTO `users_interests` VALUES (56, 79);
INSERT INTO `users_interests` VALUES (56, 103);
INSERT INTO `users_interests` VALUES (57, 3);
INSERT INTO `users_interests` VALUES (57, 10);
INSERT INTO `users_interests` VALUES (57, 30);
INSERT INTO `users_interests` VALUES (57, 78);
INSERT INTO `users_interests` VALUES (57, 102);
INSERT INTO `users_interests` VALUES (58, 3);
INSERT INTO `users_interests` VALUES (58, 79);
INSERT INTO `users_interests` VALUES (58, 90);
INSERT INTO `users_interests` VALUES (58, 100);
INSERT INTO `users_interests` VALUES (58, 104);
INSERT INTO `users_interests` VALUES (58, 105);
INSERT INTO `users_interests` VALUES (58, 106);
INSERT INTO `users_interests` VALUES (59, 107);
INSERT INTO `users_interests` VALUES (60, 108);
INSERT INTO `users_interests` VALUES (61, 30);
INSERT INTO `users_interests` VALUES (61, 44);
INSERT INTO `users_interests` VALUES (61, 109);
INSERT INTO `users_interests` VALUES (62, 10);
INSERT INTO `users_interests` VALUES (62, 50);
INSERT INTO `users_interests` VALUES (62, 90);
INSERT INTO `users_interests` VALUES (62, 110);
INSERT INTO `users_interests` VALUES (63, 81);
INSERT INTO `users_interests` VALUES (63, 111);
INSERT INTO `users_interests` VALUES (64, 67);
INSERT INTO `users_interests` VALUES (64, 101);
INSERT INTO `users_interests` VALUES (64, 112);
INSERT INTO `users_interests` VALUES (65, 113);
INSERT INTO `users_interests` VALUES (67, 114);
INSERT INTO `users_interests` VALUES (67, 115);
INSERT INTO `users_interests` VALUES (67, 116);
INSERT INTO `users_interests` VALUES (68, 109);
INSERT INTO `users_interests` VALUES (68, 117);
INSERT INTO `users_interests` VALUES (69, 77);
INSERT INTO `users_interests` VALUES (69, 110);
INSERT INTO `users_interests` VALUES (70, 30);
INSERT INTO `users_interests` VALUES (70, 39);
INSERT INTO `users_interests` VALUES (70, 91);
INSERT INTO `users_interests` VALUES (70, 118);
INSERT INTO `users_interests` VALUES (70, 119);
INSERT INTO `users_interests` VALUES (70, 120);
INSERT INTO `users_interests` VALUES (71, 79);
INSERT INTO `users_interests` VALUES (71, 90);
INSERT INTO `users_interests` VALUES (71, 102);
INSERT INTO `users_interests` VALUES (71, 103);
INSERT INTO `users_interests` VALUES (72, 3);
INSERT INTO `users_interests` VALUES (72, 10);
INSERT INTO `users_interests` VALUES (72, 90);
INSERT INTO `users_interests` VALUES (72, 100);
INSERT INTO `users_interests` VALUES (72, 103);
INSERT INTO `users_interests` VALUES (73, 39);
INSERT INTO `users_interests` VALUES (73, 90);
INSERT INTO `users_interests` VALUES (73, 120);
INSERT INTO `users_interests` VALUES (74, 30);
INSERT INTO `users_interests` VALUES (74, 47);
INSERT INTO `users_interests` VALUES (74, 100);
INSERT INTO `users_interests` VALUES (74, 121);
INSERT INTO `users_interests` VALUES (75, 122);
INSERT INTO `users_interests` VALUES (75, 123);
INSERT INTO `users_interests` VALUES (77, 81);
INSERT INTO `users_interests` VALUES (77, 90);
INSERT INTO `users_interests` VALUES (77, 110);
INSERT INTO `users_interests` VALUES (77, 124);
INSERT INTO `users_interests` VALUES (78, 30);
INSERT INTO `users_interests` VALUES (78, 91);
INSERT INTO `users_interests` VALUES (78, 119);
INSERT INTO `users_interests` VALUES (79, 125);
INSERT INTO `users_interests` VALUES (80, 79);
INSERT INTO `users_interests` VALUES (80, 80);
INSERT INTO `users_interests` VALUES (80, 92);
INSERT INTO `users_interests` VALUES (80, 109);
INSERT INTO `users_interests` VALUES (81, 3);
INSERT INTO `users_interests` VALUES (81, 102);
INSERT INTO `users_interests` VALUES (81, 126);
INSERT INTO `users_interests` VALUES (81, 127);
INSERT INTO `users_interests` VALUES (82, 3);
INSERT INTO `users_interests` VALUES (82, 100);
INSERT INTO `users_interests` VALUES (82, 102);
INSERT INTO `users_interests` VALUES (82, 128);
INSERT INTO `users_interests` VALUES (83, 129);
INSERT INTO `users_interests` VALUES (83, 130);
INSERT INTO `users_interests` VALUES (84, 3);
INSERT INTO `users_interests` VALUES (84, 10);
INSERT INTO `users_interests` VALUES (84, 90);
INSERT INTO `users_interests` VALUES (84, 100);
INSERT INTO `users_interests` VALUES (85, 3);
INSERT INTO `users_interests` VALUES (85, 103);
INSERT INTO `users_interests` VALUES (86, 131);
INSERT INTO `users_interests` VALUES (87, 66);
INSERT INTO `users_interests` VALUES (87, 67);
INSERT INTO `users_interests` VALUES (87, 80);
INSERT INTO `users_interests` VALUES (88, 17);
INSERT INTO `users_interests` VALUES (89, 132);
INSERT INTO `users_interests` VALUES (90, 81);
INSERT INTO `users_interests` VALUES (90, 82);
INSERT INTO `users_interests` VALUES (90, 103);
INSERT INTO `users_interests` VALUES (91, 77);
INSERT INTO `users_interests` VALUES (91, 121);
INSERT INTO `users_interests` VALUES (91, 133);
INSERT INTO `users_interests` VALUES (91, 134);
INSERT INTO `users_interests` VALUES (92, 79);
INSERT INTO `users_interests` VALUES (92, 90);
INSERT INTO `users_interests` VALUES (92, 135);
INSERT INTO `users_interests` VALUES (93, 82);
INSERT INTO `users_interests` VALUES (93, 136);
INSERT INTO `users_interests` VALUES (93, 137);
INSERT INTO `users_interests` VALUES (94, 30);
INSERT INTO `users_interests` VALUES (94, 39);
INSERT INTO `users_interests` VALUES (94, 138);
INSERT INTO `users_interests` VALUES (95, 82);
INSERT INTO `users_interests` VALUES (95, 101);
INSERT INTO `users_interests` VALUES (96, 139);
INSERT INTO `users_interests` VALUES (98, 30);
INSERT INTO `users_interests` VALUES (98, 140);
INSERT INTO `users_interests` VALUES (98, 141);
INSERT INTO `users_interests` VALUES (100, 142);
INSERT INTO `users_interests` VALUES (100, 143);
INSERT INTO `users_interests` VALUES (101, 30);
INSERT INTO `users_interests` VALUES (101, 49);
INSERT INTO `users_interests` VALUES (101, 78);
INSERT INTO `users_interests` VALUES (102, 144);
INSERT INTO `users_interests` VALUES (103, 17);
INSERT INTO `users_interests` VALUES (103, 82);
INSERT INTO `users_interests` VALUES (103, 145);
INSERT INTO `users_interests` VALUES (104, 66);
INSERT INTO `users_interests` VALUES (104, 67);
INSERT INTO `users_interests` VALUES (104, 136);
INSERT INTO `users_interests` VALUES (105, 146);
INSERT INTO `users_interests` VALUES (106, 147);
INSERT INTO `users_interests` VALUES (107, 148);
INSERT INTO `users_interests` VALUES (108, 149);
INSERT INTO `users_interests` VALUES (110, 150);
INSERT INTO `users_interests` VALUES (111, 151);
INSERT INTO `users_interests` VALUES (112, 152);
INSERT INTO `users_interests` VALUES (113, 153);
INSERT INTO `users_interests` VALUES (113, 154);
INSERT INTO `users_interests` VALUES (114, 155);
INSERT INTO `users_interests` VALUES (115, 67);
INSERT INTO `users_interests` VALUES (116, 82);
INSERT INTO `users_interests` VALUES (117, 156);
INSERT INTO `users_interests` VALUES (118, 66);
INSERT INTO `users_interests` VALUES (118, 82);
INSERT INTO `users_interests` VALUES (119, 134);
INSERT INTO `users_interests` VALUES (120, 157);
INSERT INTO `users_interests` VALUES (121, 158);
INSERT INTO `users_interests` VALUES (122, 159);
INSERT INTO `users_interests` VALUES (122, 160);
INSERT INTO `users_interests` VALUES (123, 71);
INSERT INTO `users_interests` VALUES (123, 135);
INSERT INTO `users_interests` VALUES (124, 161);
INSERT INTO `users_interests` VALUES (125, 162);
INSERT INTO `users_interests` VALUES (127, 3);
INSERT INTO `users_interests` VALUES (127, 10);
INSERT INTO `users_interests` VALUES (128, 3);
INSERT INTO `users_interests` VALUES (128, 10);
INSERT INTO `users_interests` VALUES (128, 39);
INSERT INTO `users_interests` VALUES (128, 163);
INSERT INTO `users_interests` VALUES (129, 164);
INSERT INTO `users_interests` VALUES (130, 165);
INSERT INTO `users_interests` VALUES (130, 166);
INSERT INTO `users_interests` VALUES (131, 66);
INSERT INTO `users_interests` VALUES (132, 167);
INSERT INTO `users_interests` VALUES (133, 8);
INSERT INTO `users_interests` VALUES (133, 110);
INSERT INTO `users_interests` VALUES (133, 133);
INSERT INTO `users_interests` VALUES (133, 168);
INSERT INTO `users_interests` VALUES (133, 169);
INSERT INTO `users_interests` VALUES (133, 170);
INSERT INTO `users_interests` VALUES (133, 171);
INSERT INTO `users_interests` VALUES (133, 172);
INSERT INTO `users_interests` VALUES (133, 173);
INSERT INTO `users_interests` VALUES (133, 174);
INSERT INTO `users_interests` VALUES (133, 175);
INSERT INTO `users_interests` VALUES (133, 176);
INSERT INTO `users_interests` VALUES (134, 177);
INSERT INTO `users_interests` VALUES (135, 178);
INSERT INTO `users_interests` VALUES (136, 29);
INSERT INTO `users_interests` VALUES (136, 30);
INSERT INTO `users_interests` VALUES (137, 179);
INSERT INTO `users_interests` VALUES (138, 17);
INSERT INTO `users_interests` VALUES (138, 66);
INSERT INTO `users_interests` VALUES (139, 180);
INSERT INTO `users_interests` VALUES (139, 181);
INSERT INTO `users_interests` VALUES (140, 3);
INSERT INTO `users_interests` VALUES (140, 30);
INSERT INTO `users_interests` VALUES (140, 39);
INSERT INTO `users_interests` VALUES (140, 66);
INSERT INTO `users_interests` VALUES (140, 120);
INSERT INTO `users_interests` VALUES (141, 182);
INSERT INTO `users_interests` VALUES (142, 183);
INSERT INTO `users_interests` VALUES (142, 184);
INSERT INTO `users_interests` VALUES (143, 185);
INSERT INTO `users_interests` VALUES (145, 186);
INSERT INTO `users_interests` VALUES (146, 187);
INSERT INTO `users_interests` VALUES (147, 70);
INSERT INTO `users_interests` VALUES (147, 92);
INSERT INTO `users_interests` VALUES (147, 188);
INSERT INTO `users_interests` VALUES (148, 189);
INSERT INTO `users_interests` VALUES (148, 190);
INSERT INTO `users_interests` VALUES (149, 191);
INSERT INTO `users_interests` VALUES (150, 192);
INSERT INTO `users_interests` VALUES (151, 30);
INSERT INTO `users_interests` VALUES (151, 91);
INSERT INTO `users_interests` VALUES (151, 193);
INSERT INTO `users_interests` VALUES (152, 194);
INSERT INTO `users_interests` VALUES (153, 195);
INSERT INTO `users_interests` VALUES (154, 196);
INSERT INTO `users_interests` VALUES (154, 197);
INSERT INTO `users_interests` VALUES (155, 102);
INSERT INTO `users_interests` VALUES (156, 103);
INSERT INTO `users_interests` VALUES (156, 198);
INSERT INTO `users_interests` VALUES (157, 67);
INSERT INTO `users_interests` VALUES (157, 110);
INSERT INTO `users_interests` VALUES (157, 199);
INSERT INTO `users_interests` VALUES (158, 200);
INSERT INTO `users_interests` VALUES (159, 201);
INSERT INTO `users_interests` VALUES (159, 202);
INSERT INTO `users_interests` VALUES (159, 203);
INSERT INTO `users_interests` VALUES (159, 204);
INSERT INTO `users_interests` VALUES (159, 205);
INSERT INTO `users_interests` VALUES (159, 206);
INSERT INTO `users_interests` VALUES (161, 207);
INSERT INTO `users_interests` VALUES (162, 120);
INSERT INTO `users_interests` VALUES (163, 208);
INSERT INTO `users_interests` VALUES (164, 49);
INSERT INTO `users_interests` VALUES (164, 209);
INSERT INTO `users_interests` VALUES (165, 210);
INSERT INTO `users_interests` VALUES (167, 211);
INSERT INTO `users_interests` VALUES (168, 212);
INSERT INTO `users_interests` VALUES (169, 3);
INSERT INTO `users_interests` VALUES (169, 66);
INSERT INTO `users_interests` VALUES (169, 213);
INSERT INTO `users_interests` VALUES (169, 214);
INSERT INTO `users_interests` VALUES (170, 81);
INSERT INTO `users_interests` VALUES (170, 110);
INSERT INTO `users_interests` VALUES (170, 215);
INSERT INTO `users_interests` VALUES (172, 3);
INSERT INTO `users_interests` VALUES (172, 50);
INSERT INTO `users_interests` VALUES (173, 216);
INSERT INTO `users_interests` VALUES (174, 217);
INSERT INTO `users_interests` VALUES (175, 218);
INSERT INTO `users_interests` VALUES (176, 219);
INSERT INTO `users_interests` VALUES (177, 102);
INSERT INTO `users_interests` VALUES (177, 220);
INSERT INTO `users_interests` VALUES (178, 221);
INSERT INTO `users_interests` VALUES (179, 222);
INSERT INTO `users_interests` VALUES (180, 223);
INSERT INTO `users_interests` VALUES (181, 224);
INSERT INTO `users_interests` VALUES (181, 225);
INSERT INTO `users_interests` VALUES (183, 226);
INSERT INTO `users_interests` VALUES (183, 227);
INSERT INTO `users_interests` VALUES (183, 228);
INSERT INTO `users_interests` VALUES (183, 229);
INSERT INTO `users_interests` VALUES (184, 230);
INSERT INTO `users_interests` VALUES (185, 231);
INSERT INTO `users_interests` VALUES (186, 232);
INSERT INTO `users_interests` VALUES (186, 233);
INSERT INTO `users_interests` VALUES (188, 90);
INSERT INTO `users_interests` VALUES (188, 103);
INSERT INTO `users_interests` VALUES (188, 110);
INSERT INTO `users_interests` VALUES (188, 183);
INSERT INTO `users_interests` VALUES (189, 234);
INSERT INTO `users_interests` VALUES (189, 235);
INSERT INTO `users_interests` VALUES (190, 236);
INSERT INTO `users_interests` VALUES (191, 237);
INSERT INTO `users_interests` VALUES (192, 238);
INSERT INTO `users_interests` VALUES (193, 239);
INSERT INTO `users_interests` VALUES (194, 240);
INSERT INTO `users_interests` VALUES (195, 241);
INSERT INTO `users_interests` VALUES (196, 242);
INSERT INTO `users_interests` VALUES (197, 243);
INSERT INTO `users_interests` VALUES (198, 8);
INSERT INTO `users_interests` VALUES (199, 244);
INSERT INTO `users_interests` VALUES (200, 90);
INSERT INTO `users_interests` VALUES (200, 199);
INSERT INTO `users_interests` VALUES (200, 245);
INSERT INTO `users_interests` VALUES (201, 246);
INSERT INTO `users_interests` VALUES (202, 247);
INSERT INTO `users_interests` VALUES (202, 248);
INSERT INTO `users_interests` VALUES (203, 249);
INSERT INTO `users_interests` VALUES (205, 82);
INSERT INTO `users_interests` VALUES (205, 250);
INSERT INTO `users_interests` VALUES (206, 251);
INSERT INTO `users_interests` VALUES (206, 252);
INSERT INTO `users_interests` VALUES (208, 253);
INSERT INTO `users_interests` VALUES (209, 254);
INSERT INTO `users_interests` VALUES (210, 255);
INSERT INTO `users_interests` VALUES (212, 256);
INSERT INTO `users_interests` VALUES (213, 257);
INSERT INTO `users_interests` VALUES (214, 258);
INSERT INTO `users_interests` VALUES (223, 259);
INSERT INTO `users_interests` VALUES (224, 260);

-- --------------------------------------------------------

-- 
-- Структура таблицы `users_online`
-- 

DROP TABLE IF EXISTS `users_online`;
CREATE TABLE IF NOT EXISTS `users_online` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) default '0',
  `time_login` bigint(20) default '0',
  `last_update` bigint(20) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=125 DEFAULT CHARSET=utf8 AUTO_INCREMENT=125 ;

-- 
-- Дамп данных таблицы `users_online`
-- 

INSERT INTO `users_online` VALUES (124, 1, 1234976672, 1234976907);

-- --------------------------------------------------------

-- 
-- Структура таблицы `warning`
-- 

DROP TABLE IF EXISTS `warning`;
CREATE TABLE IF NOT EXISTS `warning` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL,
  `cause` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

-- 
-- Дамп данных таблицы `warning`
-- 

INSERT INTO `warning` VALUES (1, 2, 'За мат');
INSERT INTO `warning` VALUES (2, 2, 'Просто так!!!');
INSERT INTO `warning` VALUES (3, 3, 'Тестовый бан');
INSERT INTO `warning` VALUES (4, 2, 'на год!');
INSERT INTO `warning` VALUES (5, 6, 'fgh');
INSERT INTO `warning` VALUES (6, 1, 'fuck you');
INSERT INTO `warning` VALUES (7, 1, 'fuck you');
INSERT INTO `warning` VALUES (8, 1, '666');
INSERT INTO `warning` VALUES (9, 1, 'yyht');
INSERT INTO `warning` VALUES (10, 1, 'че за хуйня, маты в эфире');
INSERT INTO `warning` VALUES (11, 1, 'плохо себя ведешь!');
INSERT INTO `warning` VALUES (12, 0, 'Че за шняга? <script>alert(123); </script>');
INSERT INTO `warning` VALUES (13, 1, 'хуй');
INSERT INTO `warning` VALUES (14, 1, ' 45555');
INSERT INTO `warning` VALUES (15, 1, 'gggg');
INSERT INTO `warning` VALUES (16, 1, '444');
INSERT INTO `warning` VALUES (17, 1, 'ппп');
INSERT INTO `warning` VALUES (18, 2, '1');
INSERT INTO `warning` VALUES (19, 2, '2');
INSERT INTO `warning` VALUES (20, 2, '3');
INSERT INTO `warning` VALUES (21, 2, '4');
INSERT INTO `warning` VALUES (22, 2, 'q1');
INSERT INTO `warning` VALUES (23, 2, 'q2');
INSERT INTO `warning` VALUES (24, 2, 'q3');
INSERT INTO `warning` VALUES (25, 2, 'w1');
INSERT INTO `warning` VALUES (26, 2, 'w2');
INSERT INTO `warning` VALUES (27, 2, 'w3');
INSERT INTO `warning` VALUES (28, 2, 'a1');
INSERT INTO `warning` VALUES (29, 2, 'a2');
INSERT INTO `warning` VALUES (30, 2, 'a3');
INSERT INTO `warning` VALUES (31, 2, 'rrrr');
INSERT INTO `warning` VALUES (32, 2, '4444');
INSERT INTO `warning` VALUES (33, 2, 'tyjkgykg');
INSERT INTO `warning` VALUES (34, 2, 'gkg');
INSERT INTO `warning` VALUES (35, 2, 'hhh');
INSERT INTO `warning` VALUES (36, 2, 'jjj');
