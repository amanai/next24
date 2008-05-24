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
		
		function RegistrationForm($info){
			$this -> set($info);
			$this -> setTemplate(null, 'registration.tpl.php');
		}
		
		function Activation($info){
			$this -> set($info);
			$this -> setTemplate(null, 'activation.tpl.php');
		}
		
		function CompleteRegistration($info = array()){
			$this -> set($info);
			$this -> setTemplate(null, 'complete_registration.tpl.php');
		}
		
		function ChangeCountry($info){
			$response = Project::getAjaxResponse();
			$this -> set($info);
			$this -> setTemplate($this -> _dir, 'state_list.tpl.php');
			$response -> block('state_div', true, $this -> parse());
			
			$info = array();
			$info['city_list'] = array();
			$this -> set($info);
			$this -> setTemplate($this -> _dir, 'city_list.tpl.php');
			$response -> block('city_div', true, $this -> parse());
		}
		
		function ChangeState($info){
			$response = Project::getAjaxResponse();
			$this -> set($info);
			$this -> setTemplate($this -> _dir, 'city_list.tpl.php');
			$response -> block('city_div', true, $this -> parse());
		}
		
		
		function ProfileEdit($info){
			$this -> set($info);
			$this -> setTemplate(null, 'profile_edit.tpl.php');
		}
		
}
?>