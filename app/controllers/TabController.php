<?php
class TabController{
	
		static public function getMainAlbumTabs($selected_last = false, $selected_photo = false, $selected_top = false){
			$request = Project::getRequest();
			$tabs = array(
							0 => array(
									'name' => 'Последние альбомы',
									'title' => 'Фотоальбомы',
									'selected' => $selected_last,
								 	'url' => $request -> createUrl('Album', 'LastList', null, false)
									),
							1 => array(
									'name' => 'Топ фотографий',
									'title' => 'Топ фотографий',
									'selected' => $selected_photo,
								 	'url' => $request -> createUrl('Photo', 'TopList', null, false)
									),
							2 => array(
									'name' => 'Топ альбомов',
									'title' => 'Топ альбомов',
									'selected' => $selected_top,
								 	'url' => $request -> createUrl('Album', 'TopList', null, false)
									),
							);
			return $tabs;
		}
		
		function getOwnTabs($selected_profile = false, $selected_album = false, $selected_diary = false, $selected_arch_diary = false, $friends = false, $pm = false, $blog = false, $subscribe = false){
			$request = Project::getRequest();
			$tabs = array();
			$tabs[] = array(
							'name' => 'Профиль',
							'title' => 'Об авторе',
							'selected' => $selected_profile,
						 	'url' => $request -> createUrl('User', 'Profile')
							);
			
			$tabs[] = array(
							'name' => 'Фотоальбом',
							'title' => 'Фотоальбом',
							'selected' => $selected_album,
						 	'url' => $request -> createUrl('Album', 'List')
							);
			$tabs[] = array(
							'name' => 'Блог',
							'title' => 'Блог',
							'selected' => $blog,
						 	'url' => $request -> createUrl('Blog', 'PostList')
							);
			$tabs[] = array(
							'name' => 'Дневник',
							'title' => 'Дневник',
							'selected' => $selected_diary,
						 	'url' => '#'
							);
			$tabs[] = array(
							'name' => 'Архив дневника',
							'title' => 'Архив дневника',
							'selected' => $selected_diary,
						 	'url' => '#'
							);
			$tabs[] = array(
							'name' => 'Лента друзей',
							'title' => 'Лента друзей',
							'selected' => $friends,
						 	'url' => '#'
							);
			$tabs[] = array(
							'name' => 'Подписка',
							'title' => 'Подписка',
							'selected' => $subscribe,
						 	'url' => $request -> createUrl('Subscribe', 'List')
							);
			
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			if (($user_id > 0) && ($request_user_id != $user_id)){
				$tabs[] = array(
							'name' => 'Переписка с '. Project::getUser() -> getShowedUser() -> login,
							'title' => 'Персональные сообщения',
							'selected' => $pm,
						 	'url' => '#'
							);
			}
			return $tabs;
		}
		
		static public function getRegistrationTabs($selected1 = false, $selected2 = false, $selected3 = false, $complete_registration = false) {
			$request = Project::getRequest();
			$tabs = array(
							0 => array(
									'name' => 'Регистрация',
									'title' => 'Регистрация нового пользователя',
									'selected' => $selected1,
								 	'url' => $request -> createUrl('User', 'RegistrationForm', null, false)
									),
							1 => array(
									'name' => 'Зачем нужна регистрация',
									'title' => 'Зачем нужна регистрация',
									'selected' => $selected2,
								 	'url' => $request -> createUrl('User', 'WhyPage', null, false)
									),
							2 => array(
									'name' => 'Лицензионное соглашение',
									'title' => 'Лицензионное соглашение',
									'selected' => $selected3,
								 	'url' => $request -> createUrl('User', 'License', null, false)
									)
							);
			if ($complete_registration) {
				$tabs[]= array(
								'name' => 'Регистрация окончена',
								'title' => 'Регистрация окончена',
								'selected' => true,
								'url' => $request -> createUrl('User', 'CompleteRegistration', null, false)
								);
			}
			return $tabs;
		}
		
		static public function getNewsTabs($selected1 = false, $selected2 = false, $selected3 = false, $one_news = false, $aNews = array()) {
			$request = Project::getRequest();
			$tabs = array(
							0 => array(
									'name' => 'Новости',
									'title' => 'Новости ввиде дерева',
									'selected' => $selected1,
								 	'url' => $request -> createUrl('News', 'News', null, false)
									),
							1 => array(
									'name' => 'Мои RSS ленты',
									'title' => 'Мои RSS ленты',
									'selected' => $selected3,
								 	'url' => $request -> createUrl('News', 'MyFeeds', null, false)
									)		
							);

			if ($selected2){
				$tabs[]= array(
								'name' => 'Добавить RSS ленту',
								'title' => 'Добавить RSS ленту',
								'selected' => true,
							 	'url' => $request -> createUrl('News', 'AddFeed', null, false)
								);
			}
			
			if ($one_news){
				$tabs[]= array(
								'name' => $aNews['title'],
								'title' => $aNews['title'],
								'selected' => true,
								'url' => $request -> createUrl('News', 'News', null, false)."/news_id:".$aNews['id']
								);
			}
			return $tabs;
		}
		
		static public function getMainArticleTabs($selected_cat = false, $selected_last_wins = false,/* $selected_top = false,*/ $selectded_competition = false, $selected_add_subject = false, $selected_view_article = false, /*$selected_managed_article = false,*/ $view_article_name = ""/*, $managed_article_name = "Новая статья"*/ ) {
			$request = Project::getRequest();
			$tabs = array(
							0 => array(
									'name' => 'Каталог статей',
									'title' => 'Каталог статей',
									'selected' => $selected_cat,
								 	'url' => $request -> createUrl('Article', 'List', null, false)
									),
							
			/*				1 => array(
									'name' => 'Последние статьи',
									'title' => 'Последние статьи',
									'selected' => $selected_last,
								 	'url' => $request -> createUrl('Article', 'LastList', null, false)
									),
							2 => array(
									'name' => 'Топ статей',
									'title' => 'Топ статей',
									'selected' => $selected_top,
								 	'url' => $request -> createUrl('Article', 'TopList', null, false)
									),*/
							);
		/*	if(Project::getUser()->getDbUser()->id > 0) {
				$tabs[] = array(
							'name' => 'Мои статьи',
							'title' => 'Мои статьи',
							'selected' => $selected_user_list,
							'url' => $request -> createUrl('Article', 'UserArticleList', null, false)
							);
				$tabs[] = array(
							'name' => $managed_article_name,
							'title' => $managed_article_name,
							'selected' => $selected_managed_article,
							'url' => $request -> createUrl('Article', 'AddArticle', null, false)
							);
			}*/
			if(	(ARTICLE_COMPETITION_STATUS::getCompetitionStage() == ARTICLE_COMPETITION_STATUS::COMPETITION_START ||
				 ARTICLE_COMPETITION_STATUS::getCompetitionStage() == ARTICLE_COMPETITION_STATUS::COMPETITION_VOTE) &&
				 Project::getUser()->getDbUser()->id > 0) {
				$tabs[] = array(
							'name' => 'Конкурс тем',
							'title' => 'Конкурс тем',
							'selected' => $selectded_competition,
							'url' => $request->createUrl('Article', 'CompetitionCatalog', null, false)
							);
			}
			if($selected_view_article === true) {
				$tabs[] = array(
							'name' => $view_article_name,
							'title' => $view_article_name,
							'selected' => $selected_view_article,
							'url' => '#',
							);
			}
			if(Project::getUser()->getDbUser()->id > 0) {
				if($selected_add_subject === true) {
					$tabs[] = array(
								'name' => 'Предложение темы',
								'title' => 'Предложение темы',
								'selected' => $selected_add_subject,
								'url' => $request->createUrl('Article', 'AddSubject', null, false)
								);
				}
				$tabs[] = array(
							'name' => 'Победители прошлого конкурса',
							'title' => 'Победители прошлого конкурса',
							'selected' => $selected_last_wins,
							'url' => $request->createUrl('Article', 'LastWinnersList', null, false)
							);
			}
			return $tabs;
		}
  
  static public function getSearchUserTabs(
    $p_selected_tab_main_search = false, 
    $p_selected_tab_search_interest = false) {
    $request = Project::getRequest();
    $tabs = array(
            0 => array(
                'name' => 'Найти знакомых',
                'title' => 'Найти знакомых',
                'selected' => $p_selected_tab_main_search,
                 'url' => $request -> createUrl('SearchUser', 'SearchUserMain', null, false)
                ),
            1 => array(
                'name' => 'Поиск по интересам',
                'title' => 'Поиск по интересам',
                'selected' => $p_selected_tab_search_interest,
                 'url' => $request -> createUrl('SearchUser', 'SearchByInterest', null, false)
                ),
            );
    return $tabs;
  }  

  static public function getBookmarksTabs(
    $p_selected_tab_list_name = false, 
    $p_selected_tab_most_visit = false, 
    $p_selected_tab_my_list_name = false, 
    $p_selected_tab_add_bookmark = false, 
    $p_selected_tab_category_edit = false, 
    $p_selected_tab_bookmarks_import = false,
    $p_selected_tab_bookmarks_view = false,
    $p_selected_tab_bookmarks_view_name = ""
    ) {
    $request = Project::getRequest();
    $tabs = array(
            0 => array(
                'name' => 'Каталог закладок',
                'title' => 'Каталог закладок',
                'selected' => $p_selected_tab_list_name,
                 'url' => $request -> createUrl('Bookmarks', 'BookmarksList', null, false)
                ),
            1 => array(
                'name' => 'Самые посещаемые',
                'title' => 'Самые посещаемые',
                'selected' => $p_selected_tab_most_visit,
                 'url' => $request -> createUrl('Bookmarks', 'BookmarksMostVisit', null, false)
                ),
            );
            
            
      $user_id = (int)Project::getUser() -> getDbUser() -> id;
      if ($user_id > 0){
        $tabs[] = array(
              'name' => 'Мои закладки',
              'title' => 'Мои закладки',
              'selected' => $p_selected_tab_my_list_name,
               'url' => $request -> createUrl('Bookmarks', 'BookmarksUser', null, false)
              );
      }

      if($p_selected_tab_add_bookmark === true) {
        $tabs[] = array(
              'name' => 'Добавить закладку',
              'title' => 'Добавить закладку',
              'selected' => $p_selected_tab_add_bookmark,
              'url' => '#'
              );
      }

      if($p_selected_tab_category_edit === true) {
        $tabs[] = array(
              'name' => 'Категория',
              'title' => 'Категория',
              'selected' => $p_selected_tab_category_edit,
              'url' => '#'
              );
      }

      if($p_selected_tab_bookmarks_import === true) {
        $tabs[] = array(
              'name' => 'Импорт',
              'title' => 'Импорт',
              'selected' => $p_selected_tab_bookmarks_import,
              'url' => '#'
              );
      }

      if($p_selected_tab_bookmarks_view === true) {
        $tabs[] = array(
              'name' => $p_selected_tab_bookmarks_view_name,
              'title' => $p_selected_tab_bookmarks_view_name,
              'selected' => $p_selected_tab_bookmarks_view,
              'url' => '#'
              );
      }
    return $tabs;
  }  

  static public function getSocialTabs(
    $p_selected_tab_main_list = false, 
    $p_selected_tab_last_add_pos_list = false, 
    $p_selected_tab_user_list = false, 
    $p_selected_tab_soc_pos_add = false,
    $p_selected_tab_view_soc_pos = false,
    $p_selected_tab_view_soc_pos_name = ""
    ) {
    $request = Project::getRequest();
    $tabs = array(
            0 => array(
                'name' => 'Каталог позиций',
                'title' => 'Каталог позиций',
                'selected' => $p_selected_tab_main_list,
                 'url' => $request -> createUrl('Social', 'SocialMainList', null, false)
                ),
            1 => array(
                'name' => 'Самые посещаемые',
                'title' => 'Самые посещаемые',
                'selected' => $p_selected_tab_last_add_pos_list,
                 'url' => $request -> createUrl('Social', 'SocialLastAddPos', null, false)
                ),
            );
            
            
      $user_id = (int)Project::getUser() -> getDbUser() -> id;
      if ($user_id > 0){
        $tabs[] = array(
              'name' => 'Мои позиции',
              'title' => 'Мои позиции',
              'selected' => $p_selected_tab_user_list,
               'url' => $request -> createUrl('Social', 'SocialUserList', null, false)
              );
      }

      if($p_selected_tab_soc_pos_add === true) {
        $tabs[] = array(
              'name' => 'Добавление позиции',
              'title' => 'Добавление позиции',
              'selected' => $p_selected_tab_soc_pos_add,
              'url' => '#'
              );
      }

      if($p_selected_tab_view_soc_pos === true) {
        $tabs[] = array(
              'name' => $p_selected_tab_view_soc_pos_name,
              'title' => $p_selected_tab_view_soc_pos_name,
              'selected' => $p_selected_tab_view_soc_pos,
              'url' => '#'
              );
      }

    return $tabs;
  }  

}
?>
