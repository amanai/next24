<?php

class DebateController extends SiteController{
	
	function __construct($view_class = null){
		if ($view_class === null){
			$view_class = "DebateView";
		}
		parent::__construct($view_class);
	}
	
	public function DebateAction(){
	    $debateModel = new DebateModel();
	    $request = Project::getRequest();
	    $user = Project::getUser()->getDbUser();
	    if (!$user->id) $user->id = 0;
	    $isAdmin = ($user->user_type_id == 1)?true:false;
        
	    $this-> _view -> assign('tab_list', TabController::getDebateTabs(true, false, false)); // Show tabs
		//$this-> _view -> assign('hello', "Hello World!"); 
		$activeEtap = $debateModel->getActiveEtap();
		if (!$activeEtap){
		    $activeEtap = $debateModel->getFirstEtap();
		    $debateModel->changeOneValue("debates_etap", $activeEtap['id'], 'is_active', 1); // set ACTIVE to first etap
		}
        
		$this -> _view -> DebateThemeProposalPage();
		$this -> _view -> parse();
	}

}
?>