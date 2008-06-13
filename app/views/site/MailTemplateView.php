<?php
class MailTemplateView extends BaseSiteView{
	protected $_dir = 'mail';
	
		function Registration($info){
			$this -> setTemplate(null, 'registartion.tpl.php');
			$this -> set($info);
		}
}
?>