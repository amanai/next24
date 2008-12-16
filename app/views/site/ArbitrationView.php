<?php
class ArbitrationView extends BaseSiteView{
	protected $_dir = 'arbitration';

	
	
	/**
     *  Pages VIEW
     *
     */
	
    

	/**
     * END Pages VIEW
     *
     */

	
	/**
     * AJAX Functions
     *
     */
	
	function returnArbitrationAdded($message){
	    $response = Project::getAjaxResponse();
		$response -> block('complaintArbitration'.$message['item_id'], true, "Жалоба отправлена");
	}
	
	
	/**
     * END AJAX Functions
     *
     */
		
}
?>