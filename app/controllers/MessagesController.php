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
	    $aGroupMessagesCount = array();
	    $aGroupMessagesCount[0] = array("new"=>$messagesModel->getCountMessagesToUser($user->id, 0, 0, 0), "read"=>$messagesModel->getCountMessagesToUser($user->id, 0, 0, 1));
	    foreach ($aFriendGroups as $frientGroup){
	        $aGroupMessagesCount[$frientGroup['id']] = 
	           array("new"=>$messagesModel->getCountMessagesToUser($user->id, $frientGroup['id'], 0, 0),
	                 "read"=>$messagesModel->getCountMessagesToUser($user->id, $frientGroup['id'], 0, 1));
	    }
	    $this -> _view -> assign('isShowMessageGroups', true);
	    $this -> _view -> assign('aGroupMessagesCount', $aGroupMessagesCount);
	    
        $this -> _view -> MyMessagesPage();
		$this -> _view -> parse();
	}
	
	// возвращает сообщений пользователя AJAX
	public function GetFolderMessagesAction(){
	    $messagesModel = new MessagesModel();
	    $user = Project::getUser() -> getDbUser();
	    $request = Project::getRequest();
	    
        // PAGER
		$record_per_page = $this -> getParam("NUM_MESSAGES_ON_PAGE");
		$pager_view = new SitePagerView();
	    $record_count = $messagesModel->getCountMessagesToUser($user->id, $request->groupId, 0, -1);
	    $pages_number = $pager_view->getPagesNumber($record_count, $record_per_page);
	    $current_page_number = $request->getKeyByNumber(0);
	    $debate_pager = $pager_view->show3('Messages', 'Mymessages', array(), $pages_number, $current_page_number);
	    $message['myMessagePager'] = $debate_pager;
	    $page_settings = array("record_per_page"=>$record_per_page, "current_page_number"=>$current_page_number+1);
		// END PAGER
	    $aMessages = $messagesModel->getAllMessagesToUser($page_settings, $user->id, $request->groupId, 0, -1);
	    
	    $message['aMessages'] = $aMessages;
	    $message['itemId'] = $request->toElement;
	    $message['groupId'] = $request->groupId;
	    $message['groupName'] = $request->groupName;
	    $message['pageNumber'] = $request->pageNumber;
	    $message['messageCount']['new'] = $messagesModel->getCountMessagesToUser($user->id, $request->groupId, 0, 0);
	    $message['messageCount']['read'] = $messagesModel->getCountMessagesToUser($user->id, $request->groupId, 0, 1);
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
	    if ($thisMessage) {
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
	    
    	    
	    $this->GetFolderMessagesAction();
	}
	
	
	
}
?>