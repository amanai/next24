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
		$response->block($data['block_name'], true, $this->parse());
	}
}

?>