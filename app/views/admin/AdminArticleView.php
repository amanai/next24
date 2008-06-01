<?php

class AdminArticleView extends BaseAdminView {
	protected $_dir = 'articles';
	
	public function ShowTree($data) {
		$this->setTemplate($this->_dir, 'tree.tpl.php');
		$this->set($data);
	}
	
	public function ManagedSection($data) {
		$response = Project::getAjaxResponse();
		$response -> save();
		$response -> clearBlock($this -> _flesh_messages_block);
		$response -> hide('edit_block');
		$response -> enable('list_block');
		$data['cancel_param'] = $response -> getResponse();
		$response -> restore();
		$this->set($data);
		$this->setTemplate($this->_dir, 'managed_section.tpl.php');
		$response->block('edit_block', true, $this->parse());
		$response->disable('list_block');
	}
	
	public function SetCompetition($data) {
		$response = Project::getAjaxResponse();
		$response -> save();
		$response -> clearBlock($this -> _flesh_messages_block);
		$response -> hide('edit_block');
		$response -> enable('list_block');
		$data['cancel_param'] = $response -> getResponse();
		$response -> restore();
		$this->set($data);
		$this->setTemplate($this->_dir, 'add_competition.tpl.php');
		$response->block('edit_block', true, $this->parse());
		$response->disable('list_block');
	}
	
	public function ArticleList($data) {
		$this->setTemplate($this->_dir, 'article_list.tpl.php');
		$this->set($data);
	}
	
}

?>