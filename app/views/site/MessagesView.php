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
		$userModel = new UserModel();    
	    foreach ($aFirends as $friend){   
	    	$user_default_avatar = $userModel->getUserAvatar($friend['id']);
	    	$avator_path = ($user_default_avatar['sys_av_id'])?$user_default_avatar['sys_path']:$user_default_avatar['path'];	
	    	if(!$avator_path || $avator_path == 'no.png') $avator_path = $this->image_url.'avatar/no25.jpg';
	    	else $avator_path = $this->image_url.'avatar/'.$avator_path;
	        $htmlStr .= '<dd class="friend-list-dd '.(($counter==$i)?'last':'').'">
							<a class="nm" href="'.Project::getRequest() -> createUrl('User', 'Profile', null, $friend['login']).'">'.$friend['login'].'<img src="'.$avator_path.'" class="avatar" alt="'.$user_default_avatar['av_name'].'" /></a>
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
		        $avPath = 'no90.jpg';
		        $avName = 'no image';
		    }
		    if (!$userMessage['is_read']) $sIsRead = '<dd class="message-status unread-message-status"><div class="status-wrp"><span class="with-icon-s"><i class="icon-s mess-unread-icon"></i>Ваше последнее отправленное сообщение не прочтено</span></div></dd>';
		    else $sIsRead = '';
		    $htmlMess .= '<li class="it clearfix">
					<dl>
						<dt><a href="'.Project::getRequest() -> createUrl('User', 'Profile', null, $userMessage['author_login']).'" class="with-icon-s"><i class="icon-s online-icon"></i>'.$userMessage['author_login'].'</a> [ <a href="'.Project::getRequest() -> createUrl('User', 'Profile', null, $userMessage['author_login']).'">'.$userMessage['author_login'].'</a> ]</dt>
						<dd class="av"><a href="'.Project::getRequest() -> createUrl('User', 'Profile', null, $userMessage['author_login']).'"><img class="avatar" src="'.$this->image_url.'avatar/'.$avPath.'" alt="'.$avName.'" /></a></dd>
						<dd class="date">'.$userMessage['send_date'].'</dd>
						<dd class="theme">'.$userMessage['header'].'</dd>
						<dd class="message srv-msg">'.nl2br($userMessage['m_text']).'</dd>
						'.$sIsRead.'
					</dl>
					<ul class="links">
						<li><a href="'.Project::getRequest() -> createUrl('Messages', 'CorrespondenceWith').'/corr_user_id:'.$userMessage['author_id'].'" class="new-link">Переписка</a>  ( <span class="of-all-count">1</span> / 12)</li>
						<li><a href="'.Project::getRequest() -> createUrl('Messages', 'SendMessage').'/message_action:reply/mess_id:'.$userMessage['id'].'">Написать сообщение</a></li>
						<li><a href="#">Добавить в друзья</a></li>
						<li><a onclick="return DelMessage('.$userMessage['messages_id'].', '.(int)$message['current_page'].', '.(int)$message['groupId'].', \''.$message['groupName'].'\');" href="javascript: void(0);" class="spam-link">Удалить</a></li>
					</ul>
				</li>';
		}
		if (!$htmlMess) $htmlMess = "В данной группе нет писем";
		
		$response -> block('cmod_messages', true, $htmlMess);
		$response -> block('titleGroupName', true, $message['groupName']);
		$response -> block('total_mesall', true, '( <span class="of-all-count">'.$message['messageCountAll']['new'].'</span> / '.$message['messageCountAll']['read'].' )');
		$response -> block('total_mes'.$message['groupId'], true, '( <span class="of-all-count">'.$message['messageCountGroup']['new'].'</span> / '.$message['messageCountGroup']['read'].' )');
		$response -> block('myMessagePager', true, $message['myMessagePager']);
		
	}

	
	function returnAllFolderMessages($message){
		$response = Project::getAjaxResponse();
		$htmlMess = ""; $i = 1;
		//foreach ($message['aMessages'] as $userMessage){
		foreach ($message as $userMessage){
		    if ($i/2 == 1){$i = 1;} else {$i++;}
		    if ($userMessage['avatars_id']){
		        if ($userMessage['sys_av_id']){
		            $avPath = $userMessage['sys_av_path'];
		        }else{
		            $avPath = $userMessage['avatars_path'];
		        }
		        $avName = $userMessage['avatars_av_name'];
		    }else {
		        $avPath = 'no90.jpg';
		        $avName = 'no image';
		    }
		    if (!$userMessage['is_read']) $sIsRead = '<dd class="message-status unread-message-status"><div class="status-wrp"><span class="with-icon-s"><i class="icon-s mess-unread-icon"></i>Ваше последнее отправленное сообщение не прочтено</span></div></dd>';
		    else $sIsRead = '';
		    $htmlMess .= '<li class="it clearfix">
					<dl>
						<dt><a href="'.Project::getRequest() -> createUrl('User', 'Profile', null, $userMessage['author_login']).'" class="with-icon-s"><i class="icon-s online-icon"></i>'.$userMessage['author_login'].'</a> [ <a href="'.Project::getRequest() -> createUrl('User', 'Profile', null, $userMessage['author_login']).'">'.$userMessage['author_login'].'</a> ]</dt>
						<dd class="av"><a href="'.Project::getRequest() -> createUrl('User', 'Profile', null, $userMessage['author_login']).'"><img class="avatar" src="'.$this->image_url.'avatar/'.$avPath.'" alt="'.$avName.'" /></a></dd>
						<dd class="date">'.$userMessage['send_date'].'</dd>
						<dd class="theme">'.$userMessage['header'].'</dd>
						<dd class="message srv-msg">'.nl2br($userMessage['m_text']).'</dd>
						'.$sIsRead.'
					</dl>
					<ul class="links">
						<li><a href="'.Project::getRequest() -> createUrl('Messages', 'CorrespondenceWith').'/corr_user_id:'.$userMessage['author_id'].'" class="new-link">Переписка</a>  ( <span class="of-all-count">1</span> / 12)</li>
						<li><a href="'.Project::getRequest() -> createUrl('Messages', 'SendMessage').'/message_action:reply/mess_id:'.$userMessage['id'].'">Написать сообщение</a></li>
						<li><a href="#">Добавить в друзья</a></li>
						<li><a onclick="return DelMessage('.$userMessage['messages_id'].', '.(int)$message['current_page'].', '.(int)$message['groupId'].', \''.$message['groupName'].'\');" href="javascript: void(0);" class="spam-link">Удалить</a></li>
					</ul>
				</li>';
		}		
		if (!$htmlMess) $htmlMess = "В данной группе нет писем";
		$response -> block('cmod_messages', true, $htmlMess);
		//$response -> block('titleGroupName', true, $message['groupName']);
		//$response -> block('total_mesall', true, '( <span class="of-all-count">'.$message['messageCountAll']['new'].'</span> / '.$message['messageCountAll']['read'].' )');
		//$response -> block('total_mes'.$message['groupId'], true, '( <span class="of-all-count">'.$message['messageCountGroup']['new'].'</span> / '.$message['messageCountGroup']['read'].' )');
		//$response -> block('myMessagePager', true, $message['myMessagePager']); 
		
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