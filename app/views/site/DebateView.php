<?php
class DebateView extends BaseSiteView{
	protected $_dir = 'debate';

    /**
     * Pages VIEW
     *
     */
    
    function DebateThemeProposalPage(){
	    $this->_js_files[] = 'jquery.js';
	    //$this->_js_files[]='blockUI.js';
	    //$this->_js_files[]='ajax.js';
	    $this->_css_files[]='debate.css';
	    $this -> setTemplate(null, 'debate_theme_proposal.tpl.php');
	}
	
	function DebateVoteThemePage(){
	    $this->_js_files[] = 'jquery.js';
	    //$this->_js_files[]='blockUI.js';
	    //$this->_js_files[]='ajax.js';
	    $this->_css_files[]='debate.css';
	    $this -> setTemplate(null, 'debate_vote_theme.tpl.php');
	}
	
	function DebateChooseSecondUserPage(){
	    $this->_js_files[] = 'jquery.js';
	    //$this->_js_files[]='blockUI.js';
	    //$this->_js_files[]='ajax.js';
	    $this->_css_files[]='debate.css';
	    $this -> setTemplate(null, 'debate_choose_second_user.tpl.php');
	}
	
	/**
     * END Pages VIEW
     *
     */
	
	/**
     * AJAX Functions
     *
     */
	
	function test($message){
		$response = Project::getAjaxResponse();
		$response -> block($message['table'].$message['id'], true, $message['text']);
	}

	/**
     * END AJAX Functions
     *
     */
		
}
?>