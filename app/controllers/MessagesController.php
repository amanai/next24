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
	    
	    $this -> _view -> assign('tab_list', TabController::getOwnTabs(false, false, false, false, false, false, false, false, true));
	    
	    $aMessages = $messagesModel->getAllMessages();
	    $this -> _view -> assign('aMessages', $aMessages);
	    
        $this -> _view -> MyMessagesPage();
		$this -> _view -> parse();
	}
	
	
	
}
?>