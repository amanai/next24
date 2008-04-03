<?php

class AdminQuestionAnswerView extends BaseAdminView {
	protected $_dir = 'question_answer';
	
	public function Index() {
		$this->setTemplate($this->_dir, "index.tpl.php");
	}
	
	public function CatList($data) {
		$this->setTemplate($this->_dir, "question_cat_list.tpl.php");
		$this->set($data);
	}
	
	public function ManagedCat($data) {
		$response = Project::getAjaxResponse();
		$response -> save();
		$response -> clearBlock($this -> _flesh_messages_block);
		$response -> hide('edit_block');
		$response -> enable('list_block');
		$data['cancel_param'] = $response -> getResponse();
		$response -> restore();
		$this->set($data);
		$this->setTemplate($this->_dir, 'managed_cat.tpl.php');
		$response->block('edit_block', true, $this->parse());
		$response->disable('list_block');
	}
	
	public function QuestionList($data) {
		$this->setTemplate($this->_dir, "question_list.tpl.php");
		$this->set($data);
	}
	
	public function EditQuestion($data) {
		$response = Project::getAjaxResponse();
		$response -> save();
		$response -> clearBlock($this -> _flesh_messages_block);
		$response -> hide('edit_block');
		$response -> enable('list_block');
		$data['cancel_param'] = $response -> getResponse();
		$response -> restore();
		$this->set($data);
		$this->setTemplate($this->_dir, 'edit_question.tpl.php');
		$response->block('edit_block', true, $this->parse());
		$response->disable('list_block');
	}
}

?>