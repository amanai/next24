<?php
class MessagesView extends BaseSiteView{
	protected $_dir = 'messages';

	
	/**
     *  Pages VIEW
     *
     */
	
    function MyMessagesPage(){
	    $this->_js_files[] = 'jquery.js';
	    $this -> setTemplate(null, 'my_messages.tpl.php');
	}

	/**
     * END Pages VIEW
     *
     */

	
	/**
     * AJAX Functions
     *
     */
	/*
	function ChangeState($message){
		$response = Project::getAjaxResponse();
		$response -> block($message['table'].$message['id'], true, $message['text']);
		//print_r($response -> getResponse());
	}
	*/
	
	/**
     * END AJAX Functions
     *
     */
		
}
?>