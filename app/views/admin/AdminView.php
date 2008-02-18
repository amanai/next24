<?php
class AdminView extends BaseAdminView{
	
	
		function Desktop(){
			$this -> setTemplate(null, 'desktop.tpl.php');
			
		}
		
		function Login(){
			$this -> setTemplate(null, 'login.tpl.php');
		}
}
?>
