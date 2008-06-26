<?php

class AdminArticleView extends BaseAdminView {
	protected $_dir = 'articles';
	
	public function ShowTree($data) {
		$this->setTemplate($this->_dir, 'main_section.tpl.php');
		$this->set($data);
	}
	
	public function EditSection($data) {
		$response = Project::getAjaxResponse();
		$response->save();
		$response->clearBlock($this->_flesh_messages_block);
		$response->hide('edit_block');
		$response->enable('list_block');
		$data['cancel_param'] = $response->getResponse();
		$response->restore();
		$this->set($data);
		$this->setTemplate($this->_dir, 'managed_section.tpl.php');
		$response->block('edit_block', true, $this->parse());
		$response->disable('list_block');
	}
	
	public function SetCompetition($data) {
		$response = Project::getAjaxResponse();
		$response->save();
		$response->clearBlock($this->_flesh_messages_block);
		$response->hide('edit_block');
		$response->enable('list_block');
		$data['cancel_param'] = $response->getResponse();
		$response->restore();
		$this->set($data);
		$this->setTemplate($this->_dir, 'add_competition.tpl.php');
		$response->block('edit_block', true, $this->parse());
		$response->disable('list_block');
	}
	
	public function ArticleList($data) {
		$this->setTemplate($this->_dir, 'main.tpl.php');
		$pagerView = new DefaultPagerView();
		$data['list_pager_html'] = $pagerView->show($data['list_pager'], $data['controller'], $data['list_action']); 
		$this->set($data);
	}
	
	public function EditArticle($data) {
		$id = isset($data['edit_data']['id']) ? (int)$data['edit_data']['id'] : 0;
		$response = Project::getAjaxResponse();
		$response->save();
		$response->clearBlock($this->_flesh_messages_block);
		$response->hide('edit_block');
		$response->enable('list_block');
		$data['cancel_param'] = $response->getResponse();
		$response->restore();
		$this->set($data);
		$this->setTemplate($this->_dir, 'edit_article.tpl.php');
		$response->block('edit_block', true, $this->parse());
	}
	
	public function AjaxArticleList($data) {
		$response = Project::getAjaxResponse();
		$this->setTemplate($this->_dir, 'article_list.tpl.php');
		$response->clearBlock('edit_block');
		$response->hide('edit_block');
		$pagerView = new DefaultPagerView();
		$data['list_pager_html'] = $pagerView->show($data['list_pager'], $data['controller'], $data['list_action']); 
		$this->set($data);
		$response->block('list_block', true, $this->parse());
	}
	
	public function AddPage($data) {
		$response = Project::getAjaxResponse();
		$this -> set($data);
		$this -> setTemplate($this -> _dir, 'page.tpl.php');
		$response -> block('page_div', true, $this -> parse());
	}
	
	public function AjaxSectionList($data) {
		$response = Project::getAjaxResponse();
		$this->setTemplate($this->_dir, 'tree.tpl.php');
		$response->clearBlock('edit_block');
		$response->hide('edit_block');
		$this->set($data);
		$response->block('list_block', true, $this->parse());
	}
	
	
}

?>