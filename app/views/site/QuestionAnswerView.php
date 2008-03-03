<?php

class QuestionAnswerView extends BaseSiteView {
	protected $_dir = 'QuestionAnswer';
	
	public function QuestionList($data) {
		$this->setTemplate(null, 'question_list.tpl.php');
		$this->set($data);
	}
	
	public function ViewQuestion($data) {
		$this->setTemplate(null, 'question.tpl.php');
		$this->set($data);
		
	}
	
	
	
}

?>