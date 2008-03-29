<?php

class AdminArticleView extends BaseAdminView {
	protected $_dir = 'articles';
	
	public function ShowTree($data) {
		$this->setTemplate('articles', 'tree.tpl.php');
		$this->set($data);
	}
	
	public function ManagedSection($data) {
		$this->setTemplate('articles', 'managed_section.tpl.php');
		$this->set($data);
	}
	
}

?>