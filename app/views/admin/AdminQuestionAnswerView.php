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
		$this->setTemplate($this->_dir, "managed_cat.tpl.php");
		$this->set($data);
	}
	
	public function QuestionList($data) {
		$this->setTemplate($this->_dir, "question_list.tpl.php");
		$this->set($data);
	}
	
	public function EditQuestion($data) {
		$this->setTemplate($this->_dir, "edit_question.tpl.php");
		$this->set($data);
	}
}

?>