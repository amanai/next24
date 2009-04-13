<?php

class QuestionAnswerView extends BaseSiteView {
	protected $_dir = 'QuestionAnswer';
	
	public function QuestionList($data) {
		$this->_js_files[]='jquery.js';
		$this->_js_files[]='dropdown.js';
		$this->setTemplate(null, 'question_list.tpl.php');
		$this->set($data);
	}
	public function QuestionPopList($data) {
		$this->_js_files[]='jquery.js';
		$this->_js_files[]='dropdown.js';		
		$this->setTemplate(null, 'question_pop_list.tpl.php');
		$this->set($data);		
	}
	public function QuestionStatList($data) {
		$this->setTemplate(null, 'question_stat_list.tpl.php');
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
	public function MyAnswersList($data) {
		$this->_js_files[]='jquery.js';
		$this->_js_files[]='dropdown.js';		
		$this->setTemplate(null, "my_answers_list.tpl.php");
		$this->set($data);		
	}
}

?>