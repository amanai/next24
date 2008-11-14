<?php
class DebateView extends BaseSiteView{
	protected $_dir = 'debate';

    /**
     * Pages VIEW
     *
     */
    // etap 1
    function DebateThemeProposalPage(){
	    $this->_js_files[] = 'jquery.js';
	    //$this->_js_files[]='blockUI.js';
	    //$this->_js_files[]='ajax.js';
	    $this->_css_files[]='debate.css';
	    $this -> setTemplate(null, 'debate_theme_proposal.tpl.php');
	}
	
	// etap 2
	function DebateVoteThemePage(){
	    $this->_js_files[] = 'jquery.js';
	    //$this->_js_files[]='blockUI.js';
	    //$this->_js_files[]='ajax.js';
	    $this->_css_files[]='debate.css';
	    $this -> setTemplate(null, 'debate_vote_theme.tpl.php');
	}
	
	// etap 3
	function DebateChooseSecondUserPage(){
	    $this->_js_files[] = 'jquery.js';
	    //$this->_js_files[]='blockUI.js';
	    //$this->_js_files[]='ajax.js';
	    $this->_css_files[]='debate.css';
	    $this -> setTemplate(null, 'debate_choose_second_user.tpl.php');
	}
	
	// etap 4
	function DebateChooseHelpersPage(){
	    $this->_js_files[] = 'jquery.js';
	    //$this->_js_files[]='blockUI.js';
	    //$this->_js_files[]='ajax.js';
	    $this->_css_files[]='debate.css';
	    $this -> setTemplate(null, 'debate_choose_helpers.tpl.php');
	}
	
	// etap 5
	function DebateGetStakesPage(){
	    $this->_js_files[] = 'jquery.js';
	    //$this->_js_files[]='blockUI.js';
	    //$this->_js_files[]='ajax.js';
	    $this->_css_files[]='debate.css';
	    $this -> setTemplate(null, 'debate_get_stakes.tpl.php');
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