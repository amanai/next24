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
		static public function getPublicBlogTabs($selected_list = false,$seleted_pop_list = false,$selected_week_list = false,$selected_tags = false) {
			$request = Project::getRequest();
			$tabs = array(
							0 => array(
									'name' => 'Последние посты',
									'title' => 'Последние посты',
									'selected' => $selected_list,
								 	'url' => $request -> createUrl('Blog', 'PublicList', null, false)
									),
							1 => array(
									'name' => 'Популярные посты',
									'title' => 'Популярные посты',
									'selected' => $seleted_pop_list,
								 	'url' => $request -> createUrl('Blog', 'PublicPopList', null, false)
									),
							2 => array(
									'name' => 'TOP 100 за неделю',
									'title' => 'TOP 100 за неделю',
									'selected' => $selected_week_list,
								 	'url' => $request -> createUrl('Blog', 'PublicTopWeekList', null, false)
									),
							3 => array(
									'name' => '<i class="icon tags-icon"></i>Тэги',
									'title' => 'Тэги',
									'selected' => $selected_tags,
								 	'url' => $request -> createUrl('Blog', 'PublicTagsList', null, false)
									),									
							);
			return $tabs;			
		}
/*		function getOwnTabs($selected_profile = false, $selected_album = false, $selected_diary = false, $selected_arch_diary = false, 
		                    $friends = false, $pm = false, $blog = false, $societies = false, $subscribe = false, $messages = false, $correspondent_user_id = 0){
			$request = Project::getRequest();
			$userModel = new UserModel();
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
							'name' => 'Сообщества',
							'title' => 'Сообщества',
							'selected' => $societies,
						 	'url' => $request -> createUrl('Societies', 'PostList')
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
			if (($user_id > 0) && ($request_user_id != $user_id) && !$request->corr_user_id){
				$tabs[] = array(
							'name' => 'Переписка с '. Project::getUser() -> getShowedUser() -> login,
							'title' => 'Персональные сообщения',
							'selected' => $pm,
						 	'url' => $request -> createUrl('Messages', 'CorrespondenceWith').'/corr_user_id:'.$request_user_id
							);
			}
			if($user_id){
			    $isShow = false;
			    if ($request_user_id == $user_id){
			        $sName = 'Мои сообщения';
			        $isShow = true;
			    }else{
			        $sName = 'Сообщения пользователя '.Project::getUser() -> getDbUser() ->  login;
			        if ($messages) $isShow = true;
			    }
			    if ($isShow){
			     $tabs[] = array(
							'name' => $sName,
							'title' => $sName,
							'selected' => $messages,
						 	'url' => $request -> createUrl('Messages', 'Mymessages')
							);
			    }
			}
			
			if ($correspondent_user_id){
			    
			    $correspodentUser = $userModel->getUserById($correspondent_user_id);
			    if ($correspodentUser){
    			    $tabs[] = array(
    							'name' => 'Переписка с '. $correspodentUser['login'],
    							'title' => 'Персональные сообщения',
    							'selected' => true,
    						 	'url' => $request -> createUrl('Messages', 'CorrespondenceWith').'/corr_user_id:'.$correspondent_user_id
    							);
			    }
			}
			return $tabs;
		} */
		
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
		
		function getOwnTabs($selected_profile = false, $selected_friends = false, $selected_album = false,
							$selected_blog = false, $selected_diary = false, $selected_bookmarks = false,
							$selected_question_answer = false, $selected_subscribe = false, $selected_my_score = false,
							$selected_my_messages = false){
			$request = Project::getRequest();
			$userModel = new UserModel();
			$tabs = array();
			$tabs[] = array(
							'name' => 'Профиль',
							'title' => 'Об авторе',
							'selected' => $selected_profile,
						 	'url' => $request -> createUrl('User', 'Profile')
							);
			
			$tabs[] = array(
							'name' => 'Друзья', //<em>(112)</em>
							'title' => 'Друзья',
							'selected' => $selected_friends,
						 	'url' => $request -> createUrl('Messages', 'Friend')
							);
			$tabs[] = array(
							'name' => 'Фотоальбом',  //<em>(5)</em>
							'title' => 'Фотоальбом',
							'selected' => $selected_album,
						 	'url' => $request -> createUrl('Album', 'List')
							);
			$tabs[] = array(
							'name' => 'Блог',
							'title' => 'Блог',
							'selected' => $selected_blog,
						 	'url' => $request -> createUrl('Blog', 'PostList')
							);							
			$tabs[] = array(
							'name' => 'Дневник',
							'title' => 'Дневник',
							'selected' => $selected_diary,
						 	'url' => '#'
							);
			$tabs[] = array(
							'name' => 'Закладки',
							'title' => 'Закладки',
							'selected' => $selected_bookmarks,
						 	'url' => $request -> createUrl('Bookmarks', 'BookmarksUser')
							);
			$tabs[] = array(
							'name' => 'Ответы',
							'title' => 'Ответы',
							'selected' => $selected_question_answer,
						 	'url' => $request -> createUrl('QuestionAnswer', 'UserQuestions')
							);
			$tabs[] = array(
							'name' => 'Подписка',
							'title' => 'Подписка',
							'selected' => $selected_subscribe,
						 	'url' => $request -> createUrl('News', 'MyFeeds') //, null, Project::getUser() -> getDbUser() ->  login
							);
			$tabs[] = array(
							'name' => 'Мой счет',
							'title' => 'Мой счет',
							'selected' => $selected_my_score,
						 	'url' => '#'
							);		
			$tabs[] = array(
							'name' => 'Мои сообщения', //<em class="alt">(<span>3</span>)</em>
							'title' => 'Мои сообщения',
							'selected' => $selected_my_messages,
						 	'url' => $request -> createUrl('Messages', 'Mymessages')
							);													
			return $tabs;
		}		
		
		static public function getNewsTabs(
		          $user_id, $isAdmin = false, $selected_news = false, $selected_addfeed = false, $selected_myrss = false, 
		          $selected_addnewstree = false, $one_news = false, $aNews = array(),  $all_news=false,  $all_news_title="",
		          $isModerateFeeds = false, $isModerateNewsTree = false, $change_feed = false, $favorite = false
		          ) {
			$request = Project::getRequest();
			$tabs = array(
							0 => array(
									'name' => 'Все новости',
									'title' => 'Новости ввиде дерева',
									'selected' => $selected_news,
								 	'url' => $request -> createUrl('News', 'News', null, false).'/view:news_all/'
									)
										
							);				
			$user_id = Project::getUser() -> getDbUser() -> id;
			if($user_id) {				
				$tabs[]= array(
								'name' => 'Только подписанные',
								'title' => 'Только подписанные',
								'selected' => $selected_myrss,
							 	'url' => $request -> createUrl('News', 'News', null, false).'/view:news_subscribe/'
								);	
				$tabs[]= array(
								'name' => 'Избранные',  //(254)
								'title' => 'Избранные', //(254)
								'selected' => $favorite,
							 	'url' => $request -> createUrl('News', 'News', null, false).'/view:news_stared/'
								);	
			}						
#####												
/*				$tabs[]= array(
								'name' => 'Мои RSS-ленты',
								'title' => 'Мои RSS-ленты',
								'selected' => $selected_myrss,
							 	'url' => $request -> createUrl('News', 'MyFeeds', null, false)
								);		*/					
######
/*
			if ($user_id){
				$tabs[]= array(
								'name' => 'Мои RSS-ленты',
								'title' => 'Мои RSS-ленты',
								'selected' => $selected_myrss,
							 	'url' => $request -> createUrl('News', 'MyFeeds', null, false)
								);
			}
			
			if ($selected_addfeed){
				$tabs[]= array(
								'name' => 'Добавить RSS-ленту',
								'title' => 'Добавить RSS-ленту',
								'selected' => true,
							 	'url' => $request -> createUrl('News', 'AddFeed', null, false)
								);
			}
			
			if ($change_feed){
				$tabs[]= array(
								'name' => 'Изменение RSS-ленты',
								'title' => 'Изменение RSS-ленты',
								'selected' => true,
							 	'url' => $request -> createUrl('News', 'MyFeeds', null, false)
								);
			}
			
			if ($selected_addnewstree){
				$tabs[]= array(
								'name' => 'Добавить новую ветвь в дерево',
								'title' => 'Добавить новую ветвь в дерево',
								'selected' => true,
							 	'url' => $request -> createUrl('News', 'AddNewsTree', null, false)
								);
			}
			*/
			if ($one_news){
				$tabs[]= array(
								'name' => $aNews['title'],
								'title' => $aNews['title'],
								'selected' => true,
								'url' => $request -> createUrl('News', 'News', null, false)."/news_id:".$aNews['id']
								);
			}
			
			if ($all_news){
				$tabs[]= array(
								'name' => $all_news_title,
								'title' => $all_news_title,
								'selected' => true,
							 	'url' => $request -> createUrl('News', 'News', null, false)
								);
			}
/*			
			if ($isAdmin){
			    $tabs[]= array(
								'name' => "Управление RSS-лентами",
								'title' => "Управление RSS-лентами",
								'selected' => $isModerateFeeds,
							 	'url' => $request -> createUrl('News', 'ModerateFeeds', null, false)
								);
			    $tabs[]= array(
								'name' => "Управление деревом каталогов",
								'title' => "Управление деревом каталогов",
								'selected' => $isModerateNewsTree,
							 	'url' => $request -> createUrl('News', 'ModerateNewsTree', null, false)
								);
			}
*/			
			return $tabs;
		}
		

		static public function getNewsProfileTabs(
					$selected_myrss = false
						
		          ) {
			$request = Project::getRequest();
			if ($user_id){
				$tabs[]= array(
								'name' => 'Мои RSS-ленты',
								'title' => 'Мои RSS-ленты',
								'selected' => $selected_myrss,
							 	'url' => $request -> createUrl('News', 'MyFeeds', null, false)
								);
			}
			
			if ($change_feed){
				$tabs[]= array(
								'name' => 'Изменение RSS-ленты',
								'title' => 'Изменение RSS-ленты',
								'selected' => true,
							 	'url' => $request -> createUrl('News', 'MyFeeds', null, false)
								);
			}
			
			if ($isAdmin){
			    $tabs[]= array(
								'name' => "Управление RSS-лентами",
								'title' => "Управление RSS-лентами",
								'selected' => $isModerateFeeds,
							 	'url' => $request -> createUrl('News', 'ModerateFeeds', null, false)
								);
			    $tabs[]= array(
								'name' => "Управление деревом каталогов",
								'title' => "Управление деревом каталогов",
								'selected' => $isModerateNewsTree,
							 	'url' => $request -> createUrl('News', 'ModerateNewsTree', null, false)
								);
			}
			
			return $tabs;
		}
				
		
		
		
		static public function getDebateTabs($isAdmin = false, $debate = false, $debate_rules = false, $debate_history = false ){
			$request = Project::getRequest();
			$tabs = array(
							0 => array(
									'name' => 'Дебаты',
									'title' => 'Дебаты',
									'selected' => $debate,
								 	'url' => $request -> createUrl('Debate', 'Debate', null, false)
									),
							1 => array(
									'name' => 'Правила дебатов',
									'title' => 'Правила дебатов',
									'selected' => $debate_rules,
								 	'url' => $request -> createUrl('Debate', 'DebateRules', null, false)
									),
							2 => array(
									'name' => 'Завершенные дебаты',
									'title' => 'Завершенные дебаты',
									'selected' => $debate_history,
								 	'url' => $request -> createUrl('Debate', 'DebateHistory', null, false)
									)
							);
			if ($isAdmin){
			    
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
                'name' => 'Популярные закладки',
                'title' => 'Популярные закладки',
                'selected' => $p_selected_tab_most_visit,
                 'url' => $request -> createUrl('Bookmarks', 'BookmarksMostVisit', null, false)
                ),
            );
            
            
      $user_id = (int)Project::getUser() -> getDbUser() -> id;
      if ($user_id > 0){
   /*     $tabs[] = array(
              'name' => 'Мои закладки',
              'title' => 'Мои закладки',
              'selected' => $p_selected_tab_my_list_name,
               'url' => $request -> createUrl('Bookmarks', 'BookmarksUser', null, false)
              ); */
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

  static public function getQuestionAnswerTabs(
    $p_selected_tab_list_name = false, 
    $p_selected_tab_most_visit = false, 
    $p_selected_tab_stats = false
    ) {
    $request = Project::getRequest();
    $tabs = array(
            0 => array(
                'name' => 'Вопросы',
                'title' => 'Вопросы',
                'selected' => $p_selected_tab_list_name,
                 'url' => $request->createUrl('QuestionAnswer','List', null, false)
                ),
            1 => array(
                'name' => 'Популярные вопросы',
                'title' => 'Популярные вопросы',
                'selected' => $p_selected_tab_most_visit,
                 'url' => $request->createUrl('QuestionAnswer','ListPop', null, false)
                ),
            2 => array(
                'name' => 'Подробная статистика',
                'title' => 'Подробная статистика',
                'selected' => $p_selected_tab_stats,
                 'url' => $request->createUrl('QuestionAnswer','ListStat', null, false)
                ),                
            );
            
 /*           
      $user_id = (int)Project::getUser() -> getDbUser() -> id;
      if ($user_id > 0){
        $tabs[] = array(
              'name' => 'Мои вопросы',
              'title' => 'Мои вопросы',
              'selected' => $p_selected_tab_my_list_name,
               'url' => $request->createUrl('QuestionAnswer','UserQuestions',null,false)
              );
      }
        $tabs[] = array(
              'name' => 'Задать вопрос',
              'title' => 'Задать вопрос',
              'selected' => $p_selected_tab_add_question,
               'url' => $request->createUrl('QuestionAnswer', 'ManagedQuestion',null,false)
              );     */ 
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
  
    static public function getVariableTabs($aTabsParams) {
    	$request = Project::getRequest();
    	foreach ($aTabsParams as $tabParams){
    	    $tabs[] = array(
							'name' => $tabParams['name'],
							'title' => $tabParams['title'],
							'selected' => $tabParams['selected'],
						 	'url' => $request -> createUrl($tabParams['controller_name'], $tabParams['action_name'], null, false)
    					);
    	}
    	
    	return $tabs;
    }

}
?>
