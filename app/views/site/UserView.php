<?php
class UserView extends BaseSiteView{
	protected $_dir = 'user';
		
		
		function Profile(){
			$this->_js_files[]='relations.js';
			
			$request = Project::getRequest();
			
			// Имя пользователя
			$tmp=array();
			if ($this->user_profile['last_name']) $tmp[]=$this->user_profile['last_name'];
			if ($this->user_profile['first_name']) $tmp[]=$this->user_profile['first_name'];
			if ($this->user_profile['middle_name']) $tmp[]=$this->user_profile['middle_name'];
			$this->user_name = $tmp?implode(' ', $tmp):false;
			
			// Местоположение
			$tmp=array();
			if ($this->user_profile['country']) $tmp[]=$this->user_profile['country'];
			if ($this->user_profile['state']) $tmp[]=$this->user_profile['state'];
			if ($this->user_profile['city']) $tmp[]=$this->user_profile['city'];
			$this->user_location = $tmp?implode(' ', $tmp):false;
			
			// Список друзей
			$tmp=array();
			foreach($this->friend_list as &$item){
				$login = $item;
				$tmp[] = '<a href="' . $request -> createUrl('User', 'Profile', null, $login) . '">' . $login . '</a>';
			}
			$this->friend_list = $tmp?implode(', ', $tmp):false;
			
			// У кого мы в друзьях
			$tmp=array();
			foreach($this->in_friend_list as &$item){
				$login = $item['login'];
				$tmp[] = '<a href="' . $request -> createUrl('User', 'Profile', null, $login) . '">' . $login . '</a>';
			}
			$this->in_friend_list = $tmp?implode(', ', $tmp):false;
			
			// Наши интересы
			$this->assign('user_interests', implode(', ', $this->user_interests));
			$this -> setTemplate(null, 'profile.tpl.php');
		}
		
		function Login($info){
			$this -> setTemplate(null, 'login.tpl.php');
		}
		
		function RegistrationForm(){
			$this->_css_files[]='registration.css';
			$this->_js_files[]='xpath.js';
			$this->_js_files[]='blockUI.js';
			$this->_js_files[]='ajax.js';
			$this -> setTemplate(null, 'registration.tpl.php');
		}
		
		function Registration($info){
			$this -> set($info);
			$this -> setTemplate('', 'registration.tpl.php');
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
		
		
		function ProfileEdit(){
			$this->_css_files[]='registration.css';
			
			$this->helper = $this->user;
			$date = explode('-', $this->user->birth_date);
			$this -> helper -> day = $date[2];
			$this -> helper -> month = $date[1];
			$this -> helper -> year = $date[0];
			
			$this -> helper -> surname = $this->helper->last_name;
			$this -> helper -> name = $this->helper->first_name;
			$this -> helper -> father_name = $this->helper->middle_name;
			
			$this -> helper -> country = $this->helper->country_id;
			$this -> helper -> city = $this->helper->city_id;
			$this -> helper -> state = $this->helper->state_id;
			// Имя пользователя
			$tmp=array();
			if ($this->user_profile['last_name']) $tmp[]=$this->user_profile['last_name'];
			if ($this->user_profile['first_name']) $tmp[]=$this->user_profile['first_name'];
			if ($this->user_profile['middle_name']) $tmp[]=$this->user_profile['middle_name'];
			$this->user_name = $tmp?implode(' ', $tmp):false;
			
			// Местоположение
			$tmp=array();
			if ($this->user_profile['country']) $tmp[]=$this->user_profile['country'];
			if ($this->user_profile['state']) $tmp[]=$this->user_profile['state'];
			if ($this->user_profile['city']) $tmp[]=$this->user_profile['city'];
			$this->user_location = $tmp?implode(' ', $tmp):false;
									
			$this -> assign('edit', true);
			$this->_js_files[]='xpath.js';
			$this->_js_files[]='blockUI.js';
			$this->_js_files[]='ajax.js';			
			$this -> setTemplate(null, 'profile_edit.tpl.php');
		}
		
		function AvatarEdit(){
			// Имя пользователя
			$tmp=array();
			if ($this->user_profile['last_name']) $tmp[]=$this->user_profile['last_name'];
			if ($this->user_profile['first_name']) $tmp[]=$this->user_profile['first_name'];
			if ($this->user_profile['middle_name']) $tmp[]=$this->user_profile['middle_name'];
			$this->user_name = $tmp?implode(' ', $tmp):false;

			// Местоположение
			$tmp=array();
			if ($this->user_profile['country']) $tmp[]=$this->user_profile['country'];
			if ($this->user_profile['state']) $tmp[]=$this->user_profile['state'];
			if ($this->user_profile['city']) $tmp[]=$this->user_profile['city'];
			$this->user_location = $tmp?implode(' ', $tmp):false;

			
			$this->_css_files[]='registration.css';
			
			$this -> setTemplate(null, 'avatar_edit.tpl.php');
		}
		
		function MoodPage(){
			// Имя пользователя
			$tmp=array();
			if ($this->user_profile['last_name']) $tmp[]=$this->user_profile['last_name'];
			if ($this->user_profile['first_name']) $tmp[]=$this->user_profile['first_name'];
			if ($this->user_profile['middle_name']) $tmp[]=$this->user_profile['middle_name'];
			$this->user_name = $tmp?implode(' ', $tmp):false;

			// Местоположение
			$tmp=array();
			if ($this->user_profile['country']) $tmp[]=$this->user_profile['country'];
			if ($this->user_profile['state']) $tmp[]=$this->user_profile['state'];
			if ($this->user_profile['city']) $tmp[]=$this->user_profile['city'];
			$this->user_location = $tmp?implode(' ', $tmp):false;
						
			$this->_css_files[]='registration.css';
			
			$this -> setTemplate(null, 'mood.tpl.php');
		}
		
		function ContentPage(){
			$this -> setTemplate(null, 'content_page.tpl.php');
		}
		
		function RemindPassword(){
			$this -> setTemplate(null, 'remind_password.tpl.php');
		}
		
		
		
}
?>