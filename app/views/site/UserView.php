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
		
		function RegistrationForm(){
			$this->_css_files[]='registration.css';
			$this->_js_files[]='jquery.js';
			$this->_js_files[]='xpath.js';
			$this->_js_files[]='blockUI.js';
			$this->_js_files[]='ajax.js';
			$this -> setTemplate(null, 'registration.tpl.php');
		}
		
		function Registration($info){
			$this -> set($info);
			$this -> setTemplate('mail', 'registration.tpl.php');
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
		
		function CheckLogin($message){
			$response = Project::getAjaxResponse();
			$response -> block('login_check_result', true, $message);
		}
		
		function CheckEmail($message){
			$response = Project::getAjaxResponse();
			$response -> block('email_check_result', true, $message);
		}
		
		
		function ProfileEdit($info){
			$this -> set($info);
			$this -> setTemplate(null, 'profile_edit.tpl.php');
		}
		
}
?>