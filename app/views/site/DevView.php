<?php
class DevView extends BaseSiteView{
	protected $_dir = 'dev';
		
		function Controllers(){
			$this -> setTemplate(null, 'controllers.tpl.php');
		}
		
		function Actions(){
			$this -> setTemplate(null, 'actions.tpl.php');
		}
		
}
?>