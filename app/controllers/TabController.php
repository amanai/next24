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
		
		static public function getMainArticleTabs($selected_cat = false, $selected_last = false, $selected_top = false, /*$selected_user_list = false,*/ $selected_view_article = false, /*$selected_managed_article = false,*/ $view_article_name = ""/*, $managed_article_name = "Новая статья"*/ ) {
			$request = Project::getRequest();
			$tabs = array(
							0 => array(
									'name' => 'Каталог статей',
									'title' => 'Каталог статей',
									'selected' => $selected_cat,
								 	'url' => $request -> createUrl('Article', 'List', null, false)
									),
							1 => array(
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
									),
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
			if($selected_view_article === true) {
				$tabs[] = array(
							'name' => $view_article_name,
							'title' => $view_article_name,
							'selected' => $selected_view_article,
							'url' => '#',
							);
			}
			return $tabs;
		}
}
?>
