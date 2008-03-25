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

}

?>