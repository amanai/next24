<?php

class QuestionAnswerView extends BaseSiteView {
	protected $_dir = 'QuestionAnswer';
	
	public function QuestionList($data) {
		$this->setTemplate(null, 'question_list.tpl.php');
		$this->set($data);
	}
	
	public function ViewQuestion($data) {
	    $this->_js_files[] = 'jquery.js';
		$this->setTemplate(null, 'question.tpl.php');
		$this->set($data);
		
	}
	
	public function ManagedQuestion($data) {
		$this->setTemplate(null, 'add_question.tpl.php');
		$this->set($data);
	}
	
	public function MyQuestionList($data) {
		$this->setTemplate(null, "my_question_list.tpl.php");
		$this->set($data);
	}
	
	
	
}

?>