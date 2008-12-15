<?php

class ArbitrationController extends SiteController{
	
	function __construct($view_class = null){
		if ($view_class === null){
			$view_class = "ArbitrationView";
		}
		parent::__construct($view_class);
	}		
	
	// возвращает сообщений пользователя AJAX
	public function AddComplaintAction(){
	    $messagesModel = new MessagesModel();
	    $user = Project::getUser() -> getDbUser();
	    $request = Project::getRequest();
	    
	    
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
	
}
?>