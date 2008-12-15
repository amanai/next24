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
	
	/*
	function returnCorrespondentPage($message){
	    $response = Project::getAjaxResponse();
	    $htmlMess=""; $i = 1;
		foreach ($message['aMessages'] as $userMessage){
		    if ($i/2 == 1){$i = 1;} else {$i++;}
		    $htmlMess .= '
		    <div class="cmod_tab'.$i.'">
				<h3>'.$userMessage['author_login'].'</h3>,  <h3>'.$userMessage['header'].'</h3>,  '.$userMessage['send_date'].'  
				
				';
			    if ($userMessage['author_id'] != $this->user_id){
					$htmlMess .= '
					<a href="'.Project::getRequest() -> createUrl('Messages', 'SendMessage').'/message_action:reply/mess_id:'.$userMessage['id'].'"><b>написать сообщение</b></a> | 
            		<a onclick="return DelMessageCorrespondence('.$userMessage['messages_id'].', '.$message['corr_user_id'].');" href="javascript: void(0);"><b>удалить</b></a>';
			    }
			$htmlMess .= '
				<p>
					'.$userMessage['m_text'].'
				</p>
			</div>';
		}
		$response -> block('cmod_messages', true, $htmlMess);
	}
	*/
	
	
	/**
     * END AJAX Functions
     *
     */
		
}
?>