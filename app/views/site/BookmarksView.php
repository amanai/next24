<?php

class BookmarksView extends BaseSiteView {
	protected $_dir = 'Bookmarks';
    //protected $_dir = 'QuestionAnswer';

	public function BookmarksList($data) {
		$this->setTemplate(null, 'bookmarks_list.tpl.php');
		$this->set($data);
	}

	public function ViewBookmarks($data) {
		$this->setTemplate(null, 'bookmarks.tpl.php');
		$this->set($data);

	}

    /*
	public function QuestionList($data) {
		$this->setTemplate(null, 'question_list.tpl.php');
		$this->set($data);
	}

	public function ViewQuestion($data) {
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

    */
	
	
}

?>