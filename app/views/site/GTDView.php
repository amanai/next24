<?php
class GTDView extends BaseSiteView{
	protected $_dir = 'gtd';
	
	public function GTDOutput($data) {
		$this->setTemplate(null, 'gtd.tpl.php');
		$this->set($data);
	}	
}		
?>