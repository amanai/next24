<?php
class MessagesView extends BaseSiteView{
	protected $_dir = 'messages';

	public function getCountFriendInGroups($user_id, $group_id) {
		$friendModel = new FriendModel();
		$aFirends = $friendModel->getFriendsInGroup($user_id, $group_id);
		return count($aFirends);
	}
	
	public function showFriendsInGroup($user_id, $group_id){
	    $friendModel = new FriendModel();
	    $aFirends = $friendModel->getFriendsInGroup($user_id, $group_id);
	    $htmlStr = "";
	    $counter = count($aFirends);
	    $i = 1;
	    foreach ($aFirends as $friend){   
	        $htmlStr .= '<dd class="friend-list-dd '.(($counter==$i)?'last':'').'">
							<a class="nm" href="'.Project::getRequest() -> createUrl('User', 'Profile', null, $friend['login']).'">'.$friend['login'].'<img src="assets/i/temp/avatar.s.jpg" class="avatar" alt="" /></a>
							<span class="memo">( <span>Заметка</span>: '.$friend['note'].' )</span>
							<div class="act">
	               				<form name="editForm" method="post" action="'.Project::getRequest() -> createUrl('Messages','Friend').'">
	               					<input type="hidden" value="changeFriend" name="messageAction" />
	               					<input type="hidden" value="'.$friend['id'].'" name="friend_table_id"/>
	               					<a onclick="this.parentNode.submit(); return false;" href="#">редактировать</a>
	               				</form>													
							</div>
						</dd>';	 
	        $i++;       
	    }
	    return $htmlStr;
	}
	
	/**
     *  Pages VIEW
     *
     */
	
    function MyMessagesPage(){
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'messages.js';
	    $this -> setTemplate(null, 'my_messages.tpl.php');
	}
	
    function SendMessagePage(){
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'messages.js';
	    $this -> setTemplate(null, 'send_message.tpl.php');
	}
	
    function CorrespondenceWithPage(){
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'messages.js';
	    $this -> setTemplate(null, 'correspondence_with.tpl.php');
	}
	
	
	function FriendPage(){
	    $this -> setTemplate(null, 'friend_manager.tpl.php');
	}

	/**
     * END Pages VIEW
     *
     */

	
	/**
     * AJAX Functions
     *
     */
	
	function returnFolderMessages($message){
		$response = Project::getAjaxResponse();
		$htmlMess = ""; $i = 1;
		foreach ($message['aMessages'] as $userMessage){
		    if ($i/2 == 1){$i = 1;} else {$i++;}
		    if ($userMessage['avatars_id']){
		        if ($userMessage['sys_av_id']){
		            $avPath = $userMessage['sys_av_path'];
		        }else{
		            $avPath = $userMessage['avatars_path'];
		        }
		        $avName = $userMessage['avatars_av_name'];
		    }else {
		        $avPath = 'no.png';
		        $avName = 'no image';
		    }
		    if (!$userMessage['is_read']) $sIsRead = ' - <span id="red">Новое</span>';
		    else $sIsRead = '';
		    $htmlMess .= '
		    <div class="cmod_tab'.$i.'">
				<table class="cmod_x">
				<tr>
					<td class="cmod_x1" rowspan="2">
						<h2><a href="'.Project::getRequest() -> createUrl('User', 'Profile', null, $userMessage['author_login']).'">'.$userMessage['author_login'].'</a></h2>
						<div class="av_preview"><img src="'.$this->image_url.'avatar/'.$avPath.'" alt="'.$avName.'" style="margin: 5px;"/></div>
					</td>
					<td class="cmod_x2a" rowspan="2">
						<p>'.$userMessage['send_date'].$sIsRead.'</p>
						<h3>'.$userMessage['header'].'</h3><br/>
						'.$userMessage['m_text'].'
					</td>
					<td class="cmod_x4">
					   <a onclick="return DelMessage('.$userMessage['messages_id'].', '.(int)$message['current_page'].', '.(int)$message['groupId'].', \''.$message['groupName'].'\');" href="javascript: void(0);">удалить</a>
					</td>
				</tr>
				<tr>
				    <td class="cmod_x3">
						<a href="'.Project::getRequest() -> createUrl('Messages', 'SendMessage').'/message_action:reply/mess_id:'.$userMessage['id'].'"><b>написать сообщение</b></a>  |  
						<a href="'.Project::getRequest() -> createUrl('Messages', 'CorrespondenceWith').'/corr_user_id:'.$userMessage['author_id'].'"><b>читать переписку</b></a><br/>
					</td>
				</tr>
				</table>
			</div>
		    
    	    ';
		}
		if (!$htmlMess) $htmlMess = "В данной группе нет писем";
		
		$response -> block('cmod_messages', true, $htmlMess);
		$response -> block('titleGroupName', true, $message['groupName']);
		$response -> block('total_mesall', true, '(<font class="red">'.$message['messageCountAll']['new'].'</font>/'.$message['messageCountAll']['read'].')');
		$response -> block('total_mes'.$message['groupId'], true, '(<font class="red">'.$message['messageCountGroup']['new'].'</font>/'.$message['messageCountGroup']['read'].')');
		$response -> block('myMessagePager', true, $message['myMessagePager']);
		
	}
	
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
	
	
	/**
     * END AJAX Functions
     *
     */
		
}
?>