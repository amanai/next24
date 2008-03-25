<?php

class ArticleView extends BaseSiteView {
	protected $_dir = 'Article';
	
	public function ArticleList($data) {
		$this->setTemplate(null, 'list_article.tpl.php');
		$this->set($data);
	}
	
	public function AddArticle($data) {
		$this->setTemplate(null, 'add_article.tpl.php');
		$this->set($data);
	}
	
	public function AjaxChangeCat($data) {
		$this->setTemplate(null, 'change_cat.tpl.php');
		$this->set($data);
		$response = Project::getAjaxResponse();
		$response->block($data['block_name'], true, $this->parse()); //TODO: addBlock
	}
	
	public function AjaxAddPage($data) {
		$this->setTemplate(null, 'page_article.tpl.php');
		$this->set($data);
		$response = Project::getAjaxResponse();
		$response->block('pages', true, $this->parse()); //TODO: addBlock
	}
	
	public function LastList($data) {
		$this->setTemplate(null, 'list.tpl.php');
		$this->set($data);	
	}
	
	public function TopList($data) {
		$this->setTemplate(null, 'list.tpl.php');
		$this->set($data);
	}
	
	public function ViewArticle($data) {
		$this->setTemplate(null, 'view_article.tpl.php');
		$this->set($data);
	}
	
	function ShowPager($count_pages, $current_page, $controller = null, $action = null, $params = array(), $user = null){
			$this -> setTemplate(null, '../pager2.tpl.php');
			$this -> assign('current_controller', $controller);
			$this -> assign('current_action', $action);
			$this -> assign('current_user', $user);
			$this -> assign('pager_params', $params);
			$this -> assign('pages_number', (int)$count_pages);
			$this -> assign('current_page_number', (int)$current_page);
			return $this -> parse();
	}
}

?>