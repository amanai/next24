<?php
class UserView extends BaseSiteView{
	protected $_dir = 'user';
		
		
		function Profile($info){
			$this -> setTemplate(null, 'profile.tpl.php');
		}
		
		function Login($info){
			$this -> setTemplate(null, 'login.tpl.php');
		}
		
}
?>