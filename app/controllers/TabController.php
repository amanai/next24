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
		
		function getOwnTabs($selected_profile = false, $selected_album = false, $selected_diary = false, $selected_arch_diary = false, $friends = false, $pm = false, $blog = false){
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
}
?>
