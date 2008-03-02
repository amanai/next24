<?php
class UserView extends BaseSiteView{
	protected $_dir = 'user';
		
		
		function Profile($info){
			$request = Project::getRequest();
			foreach($info['friend_list'] as &$item){
				$login = $item;
				$item = '<a href="' . $request -> createUrl('User', 'Profile', null, $login) . '">' . $login . '</a>';
			}
			
			foreach($info['in_friend_list'] as &$item){
				$login = $item['login'];
				$item = '<a href="' . $request -> createUrl('User', 'Profile', null, $login) . '">' . $login . '</a>';
			}
			
			$info['friend_list'] = implode(',', $info['friend_list']);
			$info['in_friend_list'] = implode(',', $info['in_friend_list']);
			$this -> setTemplate(null, 'profile.tpl.php');
			$this -> set($info);
		}
		
		function Login($info){
			$this -> setTemplate(null, 'login.tpl.php');
		}
		
}
?>