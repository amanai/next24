<?php

class MessagesController extends SiteController{
	
	function __construct($view_class = null){
		if ($view_class === null){
			$view_class = "MessagesView";
		}
		parent::__construct($view_class);
	}		
	
	public function MymessagesAction(){
	    $messagesModel = new MessagesModel();
	    $friendModel = new FriendModel();
	    $user = Project::getUser() -> getDbUser();
	    
	    $this -> _view -> assign('tab_list', TabController::getOwnTabs(false, false, false, false, false, false, false, false, true));
	    
	    $aFriendGroups = $friendModel->getUserFriendGroups($user->id);
	    $this -> _view -> assign('aFriendGroups', $aFriendGroups);
	    
	    $aGroupMessagesCount = $this->getGroupMessagesCount($messagesModel, $aFriendGroups, $user);
	    $this -> _view -> assign('isShowMessageGroups', true);
	    $this -> _view -> assign('aGroupMessagesCount', $aGroupMessagesCount);
	    
	    // PAGER
		$record_per_page = $this -> getParam("NUM_MESSAGES_ON_PAGE");
		$pager_view = new SitePagerView();
	    $record_count = $messagesModel->getCountMessagesToUser($user->id, -1, 1, -1);
	    $pages_number = $pager_view->getPagesNumber($record_count, $record_per_page);
	    $current_page_number = $request->current_page; // current page
	    $current_page_number = ($current_page_number>=$pages_number)?$pages_number-1:$current_page_number;
	    $debate_pager = $pager_view->show_ajax('Messages', 'GetFolderMessages', array("groupName"=>". Все сообщения", "groupId"=>-1), $pages_number, $current_page_number);
	    $this -> _view -> assign('myMessagePager', $debate_pager);
	    $page_settings = array("record_per_page"=>$record_per_page, "current_page_number"=>$current_page_number+1);
		// END PAGER
	    $aMessages = $messagesModel->getAllMessagesToUser($page_settings, $user->id, -1, 1, -1);
	    $this -> _view -> assign('aMessages', $aMessages);
	    
        $this -> _view -> MyMessagesPage();
		$this -> _view -> parse();
	}
	
	function getGroupMessagesCount($messagesModel, $aFriendGroups, $user){
	    $aGroupMessagesCount = array();
	    $aGroupMessagesCount[0] = array("new"=>$messagesModel->getCountMessagesToUser($user->id, 0, 1, 0), "read"=>$messagesModel->getCountMessagesToUser($user->id, 0, 1, 1));
	    foreach ($aFriendGroups as $frientGroup){
	        $aGroupMessagesCount[$frientGroup['id']] = 
	           array("new"=>$messagesModel->getCountMessagesToUser($user->id, $frientGroup['id'], 1, 0),
	                 "read"=>$messagesModel->getCountMessagesToUser($user->id, $frientGroup['id'], 1, 1));
	    }
	    $aGroupMessagesCount['all']=
	           array("new"=>$messagesModel->getCountMessagesToUser($user->id, -1, 1, 0),
	                 "read"=>$messagesModel->getCountMessagesToUser($user->id, -1, 1, 1));
	    return $aGroupMessagesCount;
	}
	
	// переписка с конретным пользователем
	public function CorrespondenceWithAction(){
	    $messagesModel = new MessagesModel();
	    $userModel = new UserModel();
	    $user = Project::getUser() -> getDbUser();
	    $request = Project::getRequest();
	    
	    $corr_user_id = $request->corr_user_id;
	    $this -> _view -> assign('tab_list', TabController::getOwnTabs(false, false, false, false, false, false, false, false, false, $corr_user_id));
	    $correspondent_user = $userModel->getUserById($corr_user_id);
	    $this -> _view -> assign('user_login', $user->login);
	    $this -> _view -> assign('correspondent_user_login', $correspondent_user['login']);
	    $this -> _view -> assign('corr_user_id', $request->corr_user_id);
	    $this -> _view -> assign('correspondent_user', $correspondent_user);
	    $this -> _view -> assign('correspondent_user_avatar', $userModel->getUserAvatar($request->corr_user_id));
	    $this -> _view -> assign('user_id', $user->id);
	    $this -> _view -> assign('curr_user', $userModel->getUserById($user->id));
	    $this -> _view -> assign('curr_user_avatar', $userModel->getUserAvatar($user->id));
	    $this -> _view -> assign('curr_user_avatars', $userModel->getAllUserAvatars($user->id));
	    
	    $aMessages = $messagesModel->getCorrespondenceBetweenUsers(array($user->id, $correspondent_user['id']));
	    $this -> _view -> assign('aMessages', $aMessages);
	    
	    $this -> _view -> CorrespondenceWithPage();
		$this -> _view -> parse();
		
	}
	
	// переписка с конретным пользователем Ajax
	function returnCorrespondentPage(){
	    $messagesModel = new MessagesModel();
	    $userModel = new UserModel();
	    $user = Project::getUser() -> getDbUser();
	    $request = Project::getRequest();
	    
	    $corr_user_id = $request->corr_user_id;
	    $correspondent_user = $userModel->getUserById($corr_user_id);
	    $message['corr_user_id'] = $request->corr_user_id;
	    $this -> _view -> assign('user_id', $user->id);
	    
	    $aMessages = $messagesModel->getCorrespondenceBetweenUsers(array($user->id, $correspondent_user['id']));
	    $message['aMessages'] = $aMessages;
	    
	    $this -> _view -> returnCorrespondentPage($message);
        $this -> _view -> ajax();
	}
	
	
	public function SendMessageAction(){
	    $messagesModel = new MessagesModel();
	    $friendModel = new FriendModel();
	    $userModel = new UserModel();
	    $user = Project::getUser() -> getDbUser();
	    $request = Project::getRequest();
	    $this -> _view -> clearFlashMessages();
	    
	    $message_to = $request->message_to;
	    $mess_header = trim($request->mess_header);
	    $m_text = trim($request->m_text);
	    $recipient_name = trim($request->recipient_name);
	    
	    $this -> _view -> assign('tab_list', TabController::getOwnTabs(false, false, false, false, false, false, false, false, true));
	    
	    if ($request->message_action == 'new_message'){
	        $noErrors = true;
	        if (!$request->recipient && !$recipient_name && $message_to != "admin"){
	            $this -> _view -> addFlashMessage(FM::ERROR, "Выберите из списка друзей или введите имя вручную");
	            $noErrors = false;
	        }else{
	            if ($message_to == "admin"){
	                $aAdmins = $userModel->getUsersByType(1);
	            }else{
    	            $recipient_name = ($recipient_name)?$recipient_name:$request->recipient;
    	            $recipient = $userModel->getUserByLogin($recipient_name);
    	            if (!$recipient){
        	            $this -> _view -> addFlashMessage(FM::ERROR, "Такого пользователя нет");
        	            $noErrors = false;
    	            }
	            }
	        }
	        
	        if (!$mess_header){
	            $this -> _view -> addFlashMessage(FM::ERROR, "Введите тему сообщения");
	            $noErrors = false;
	        }
	        if (!$m_text){
	            $this -> _view -> addFlashMessage(FM::ERROR, "Введите текст сообщения");
	            $noErrors = false;
	        }
	        
	        if ($noErrors){
	            if ($message_to == "admin"){
	                foreach ($aAdmins as $admin){
	                    $this->sendMessage($mess_header, $m_text, $user->id, $admin['id'], $request->avatar_id, 0, 0);
	                }
	                $addUrl = '/message_to:admin';
	            }else{
	                $this->sendMessage($mess_header, $m_text, $user->id, $recipient['id'], $request->avatar_id, 0, 0);
	                $addUrl = '';
	            }
	            $redirect_controller = ($request->redirect_controller)?$request->redirect_controller:'Messages';
	            $redirect_action = ($request->redirect_action)?$request->redirect_action:'SendMessage';
	            $redirect_url = ($request->redirect_url)?$request->redirect_url:"/message_action:sent".$addUrl;
	            
                Project::getResponse()->redirect(Project::getRequest()->createUrl($redirect_controller, $redirect_action).$redirect_url);
	        }
	    
	    }elseif ($request->message_action == 'reply'){ // ответить на сообщение
	        $messagesModel->load($request->mess_id);
	        if ($messagesModel->id == $request->mess_id && $messagesModel->recipient_id == $user->id){
        	    $mess_header = "Re: ".$messagesModel->header;
        	    $m_text = ">> ".$messagesModel->m_text;
        	    $author = $userModel->getUserById($messagesModel->author_id);
        	    $recipient_name = $author['login'];
	        }
	    
	    }elseif ($request->message_action == 'sent'){
	        $this -> _view -> addFlashMessage(FM::INFO, "Ваше сообщение успешно отправлено. Можете отправить еще сообщение");
	    }
	    
	    $this -> _view -> assign('message_to', $message_to);
	    $this -> _view -> assign('mess_header', $mess_header);
	    $this -> _view -> assign('m_text', $m_text);
	    $this -> _view -> assign('recipient_name', $recipient_name);
	    $this -> _view -> assign('user_friends', $friendModel->getFriends($user->id));
	    
	    $aGroupMessagesCount['all']=
	           array("new"=>$messagesModel->getCountMessagesToUser($user->id, -1, 1, 0),
	                 "read"=>$messagesModel->getCountMessagesToUser($user->id, -1, 1, 1));
	    $this -> _view -> assign('aGroupMessagesCount', $aGroupMessagesCount);
	    $this -> _view -> assign('user_avatars', $userModel->getAllUserAvatars($user->id));
	                 
	                 
	    $this -> _view -> SendMessagePage();
		$this -> _view -> parse();
	}
	
	function sendMessage($mess_header, $m_text, $user_id, $resipient_id, $avatar_id, $is_read, $is_deleted){
	    $messagesModel = new MessagesModel();
	    $messagesModel->header = stripslashes(htmlspecialchars($mess_header));
        $messagesModel->m_text = stripslashes(htmlspecialchars($m_text));
        $messagesModel->send_date = date("Y-m-d H:i:s");
        $messagesModel->author_id = $user_id;
        $messagesModel->recipient_id = $resipient_id;
        $messagesModel->avatar_id = $avatar_id;
        $messagesModel->is_read = $is_read;
        $messagesModel->is_deleted = $is_deleted;
        $messageId = $messagesModel->save();
        return $messageId;
	}
	
	// возвращает сообщений пользователя AJAX
	public function GetFolderMessagesAction(){
	    $messagesModel = new MessagesModel();
	    $user = Project::getUser() -> getDbUser();
	    $request = Project::getRequest();
	    
        // PAGER
		$record_per_page = $this -> getParam("NUM_MESSAGES_ON_PAGE");
		$pager_view = new SitePagerView();
	    $record_count = $messagesModel->getCountMessagesToUser($user->id, $request->groupId, 1, -1);
	    $pages_number = $pager_view->getPagesNumber($record_count, $record_per_page);
	    $current_page_number = $request->current_page; // current page
	    $current_page_number = ($current_page_number>=$pages_number)?$pages_number-1:$current_page_number;
	    $debate_pager = $pager_view->show_ajax('Messages', 'GetFolderMessages', array("groupName"=>$request->groupName, "groupId"=>$request->groupId), $pages_number, $current_page_number);
	    $message['myMessagePager'] = $debate_pager;
	    $page_settings = array("record_per_page"=>$record_per_page, "current_page_number"=>$current_page_number+1);
		// END PAGER
	    $aMessages = $messagesModel->getAllMessagesToUser($page_settings, $user->id, $request->groupId, 1, -1);
	    //print_r($aMessages);
	    
	    $message['aMessages'] = $aMessages;
	    $message['groupId'] = (int)$request->groupId;
	    $message['groupName'] = $request->groupName;
	    $message['current_page'] = $request->current_page;
	    $message['messageCountAll']['new'] = $messagesModel->getCountMessagesToUser($user->id, -1, 1, 0);
	    $message['messageCountAll']['read'] = $messagesModel->getCountMessagesToUser($user->id, -1, 1, 1);
	    $message['messageCountGroup']['new'] = $messagesModel->getCountMessagesToUser($user->id, $request->groupId, 1, 0);
	    $message['messageCountGroup']['read'] = $messagesModel->getCountMessagesToUser($user->id, $request->groupId, 1, 1);
	    foreach ($aMessages as $userMessage){
	        $messagesModel->changeOneValue('messages', $userMessage['messages_id'], 'is_read', 1);
	    }
	    
	    $this -> _view -> returnFolderMessages($message);
        $this -> _view -> ajax();
	}
	
	//  AJAX, удаление сообщения
	public function DelMessageAction(){
	    $messagesModel = new MessagesModel();
	    $user = Project::getUser() -> getDbUser();
	    $request = Project::getRequest();
	    
	    $isSave = false;
	    $thisMessage = $messagesModel->load($request->messageId);
	    if ($thisMessage){
	        $messagesModel->load($request->messageId);
	        if ($thisMessage && $thisMessage['author_id'] == $user->id){
    	        $isSave = true;
    	        $messagesModel->is_deleted = 1;
    	    }elseif ($thisMessage && $thisMessage['recipient_id'] == $user->id){
    	        $isSave = true;
    	        $messagesModel->is_deleted = 2;
    	    }
    	    if ($isSave) {
    	        $messagesModel->save();
    	    }
	    }
	    
    	if ($request->pageName == "mymessages"){
    	    $this->GetFolderMessagesAction();
    	}elseif ($request->pageName == "correspondent"){
    	    $this->returnCorrespondentPage();
    	}
	}
	
	
	/* FRIEND PART */
		
	public function FriendAction(){
	    $request = Project::getRequest();
	    $this -> _view -> clearFlashMessages();
	    $user = Project::getUser()->getDbUser();
	    $userModel = new UserModel();
	    $friendModel = new FriendModel();
	    $messagesModel = new MessagesModel();
	    $isDefAction = true;
	    //$this -> _view -> addFlashMessage(FM::ERROR, "Выберите из списка друзей или введите имя вручную");
	    
	    if ($request->messageAction == "changeGroup"){
	        $group_id = $request->group_id;
	        $friendGroup = $friendModel->getFriendGroupById($group_id);
	        if ($friendGroup){
	           $isDefAction = false;
	           if ($request->save_group){
	               $group_name = $request->group_name;
	               if (!$friendModel->isDublicateGroup($user->id, htmlspecialchars($group_name))){
	                   $friendModel->changeOneValue('friend_group', $group_id, 'name', htmlspecialchars($group_name));
	               }else{
	                   $this -> _view -> addFlashMessage(FM::ERROR, "Группа с таким именем уже существует");
	               }
	               
	           }elseif ($request->del_group){
	               $friendModel -> changeFriendsGroup($user->id, $group_id, 0);
	               $friendModel->delOneRecord('friend_group', $group_id);
	               Project::getResponse()->redirect(Project::getRequest()->createUrl('Messages', 'Friend'));
	               
	           }else{
	               $group_name = $friendGroup['name'];
	           }
	           $this -> _view -> assign('pageAction', 'changeGroup');
	           $this -> _view -> assign('groupName', $group_name);
	        }
	        $this -> _view -> assign('group_id', $group_id);
	        
	        
	    }elseif ($request->messageAction == "changeFriend"){ 
	       $friend_table_id = $request->friend_table_id;
	       $friend = $friendModel->getFriendById($friend_table_id);
	       if ($friend){
	           if ($request->save_friend){
	               $friendModel->load($friend_table_id);
	               $friendModel->group_id = $request->group_id;
	               $friendModel->note = htmlspecialchars($request->note);
	               $friendModel->save();
	               Project::getResponse()->redirect(Project::getRequest()->createUrl('Messages', 'Friend'));
	           }
	           $isDefAction = false;
	           $this -> _view -> assign('pageAction', 'changeFriend');
	           $this -> _view -> assign('friend', $friend);
	           $this -> _view -> assign('aFriendGroups', $friendModel->getUserFriendGroups($user->id));
	       }	 
	             
	    
	    
	    }elseif ($request->messageAction == "addGroupFriend"){
	        if ($request->add_group){
	            if (!$friendModel->isDublicateGroup($user->id, htmlspecialchars($request->group_name))){
                   $friendModel->addFriendGroup($user->id, $request->group_name, null);
	               Project::getResponse()->redirect(Project::getRequest()->createUrl('Messages', 'Friend'));
               }else{
                   $this -> _view -> addFlashMessage(FM::ERROR, "Группа с таким именем уже существует");
               }
	            
	        }elseif ($request->add_friend){
	            $friend = $userModel->getUserByLogin($request->friend_name);
	            if ($friend && $friendModel->isFriend($user->id, $friend['id'])){
	                $this -> _view -> addFlashMessage(FM::ERROR, "Этот пользователь уже добавлен в Ваши друзья");
	            }elseif ($friend){
                   $friendModel->load(0);
                   $friendModel->friend_id = $friend['id'];
                   $friendModel->user_id = $user->id;
                   $friendModel->group_id = 0;
                   $friendModel->save();
	               Project::getResponse()->redirect(Project::getRequest()->createUrl('Messages', 'Friend'));
               }else{
                   $this -> _view -> addFlashMessage(FM::ERROR, "Пользователя с таким именем нет");
               }
	            
	        }
	        
	    }
	    if ($isDefAction){
	        $this -> _view -> assign('pageAction', 'main');
	    }
	    
	    $aGroupMessagesCount = array();
	    $aGroupMessagesCount['all']=
	           array("new"=>$messagesModel->getCountMessagesToUser($user->id, -1, 1, 0),
	                 "read"=>$messagesModel->getCountMessagesToUser($user->id, -1, 1, 1));
	    $this -> _view -> assign('aGroupMessagesCount', $aGroupMessagesCount);
	    
	    $aFriendGroups = $friendModel->getUserFriendGroups($user->id);
	    $this -> _view -> assign('aFriendGroups', $aFriendGroups);
	    $this -> _view -> assign('user_id', $user->id);
	    
	    $this -> _view -> FriendPage();
		$this -> _view -> parse();
	}
	
	
	
	
}
?>