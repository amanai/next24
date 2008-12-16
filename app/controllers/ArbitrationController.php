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
	    $userModel = new UserModel();
	    $arbitrationModel = new ArbitrationModel();
	    $request = Project::getRequest();
	    
	    $user_login = $request->user_login;
	    $complaint_on_user = $userModel->getUserByLogin($user_login);
	    if ($complaint_on_user){
	        $arbitrationModel->load(0);
	        
	        $arbitrationModel->user_id = $user->id;
	        $arbitrationModel->complaint_on_user = $complaint_on_user['id'];
	        $arbitrationModel->complaint_text = $_SERVER['HTTP_REFERER']." ".htmlspecialchars($request->complaint_text);
	        $arbitrationModel->arbitration_group_id = $request->arbitration_group_id;
	        $arbitrationModel->save();
	        
	        $message['item_id'] = (int)$request->item_id;
	        
	        $this -> _view -> returnArbitrationAdded($message);
            $this -> _view -> ajax();
	    }
	    

	    
	    
	}
	
}
?>