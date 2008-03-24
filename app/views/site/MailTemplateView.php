<?php
class MailTemplateView extends BaseSiteView{
	protected $_dir = 'mail';
	
		function Activation($info){
			$this -> setTemplate(null, 'activation.tpl.php');
			$this -> set($info);
		}
}
?>