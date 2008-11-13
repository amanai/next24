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
	    $this-> _view -> assign('isAdmin', $isAdmin);
	    $this-> _view -> assign('user_id', $user->id);
        
	    $this-> _view -> assign('tab_list', TabController::getDebateTabs(true, false, false)); // Show tabs
		
	    $debateModel->stopEtap(2);
	    $debateModel->startEtap(3);
	    
		$activeEtap = $debateModel->getActiveEtap();
		if (!$activeEtap){
		    $activeEtap = $debateModel->getFirstEtap();
		    $debateModel->startEtap($activeEtap['id']); // set ACTIVE to first etap
		}
		$debateNow = $debateModel->getDebateNow();
		
		if ($activeEtap['name']=='GetTheme'){
    		// ETAP 1. Get Theme from Users.
    		if ($request->addTheme && $request->theme){
    		   $debateModel->addTheme($user->id, $request->theme, 0);
    		   Project::getResponse()->redirect(Project::getRequest()->createUrl('Debate', 'Debate'));
    		}
    		// PAGER
    		$record_per_page = $this -> getParam("THEMES_PER_PAGE");
    		$pager_view = new SitePagerView();
    	    $record_count = $debateModel->getThemesCount();
    	    $pages_number = $pager_view->getPagesNumber($record_count, $record_per_page);
    	    $current_page_number=$request->getKeyByNumber(0);
    	    $debate_pager = $pager_view->show3('Debate', 'Debate', array(), $pages_number, $current_page_number);
    	    $this-> _view -> assign('debate_pager', $debate_pager);
    	    $page_settings = array("record_per_page"=>$record_per_page, "current_page_number"=>$current_page_number+1);
    		// END PAGER
    		$aThemes = $debateModel->getAllThemes($page_settings, "debate_theme.id DESC");
    		$this-> _view -> assign('aThemes', $aThemes);
    		$this -> _view -> DebateThemeProposalPage();
    		
    		// END ETAP 1.
    		
		}elseif($activeEtap['name']=='VoteTheme'){
		    // ETAP 2. Vote for Theme
    		if ($request->addTheme && $request->theme){
    		   $debateModel->addTheme($user->id, $request->theme, 0);
    		   Project::getResponse()->redirect(Project::getRequest()->createUrl('Debate', 'Debate'));
    		}
    		// PAGER
    		$record_per_page = $this -> getParam("THEMES_PER_PAGE");
    		$pager_view = new SitePagerView();
    	    $record_count = $debateModel->getThemesCount();
    	    $pages_number = $pager_view->getPagesNumber($record_count, $record_per_page);
    	    $current_page_number=$request->getKeyByNumber(0);
    	    $debate_pager = $pager_view->show3('Debate', 'Debate', array(), $pages_number, $current_page_number);
    	    $this-> _view -> assign('debate_pager', $debate_pager);
    	    $page_settings = array("record_per_page"=>$record_per_page, "current_page_number"=>$current_page_number+1);
    		// END PAGER
    		$aThemes = $debateModel->getAllThemes($page_settings, "debate_theme.votes DESC");
    		$this-> _view -> assign('aThemes', $aThemes);
    		
    		$isVoted = $debateModel->getThemeVoteByUserId($user->id);
    		$this-> _view -> assign('isVoted', $isVoted);
            
    		$this -> _view -> DebateVoteThemePage();
    		
    		// END ETAP 2.
    		
    		
		}elseif($activeEtap['name']=='ChooseSecondUser'){
		    // ETAP 3. Election for Secont USER , by auction, who pay more - get part in debate
		    $userModel = new UserModel();
		    if ($request->doStake && $request->stake_amount && $user->nextmoney >=$request->stake_amount){
		       $result = $debateModel->doStakeSecondUser($user->id, $request->stake_amount, $debateNow);
		       if ($result){
		           $userModel->changeUserMoney($debateNow['user_id_2'], 0, $debateNow['stake_amount'], "возвращение ставки в дебатах");
		           $userModel->changeUserMoney($user->id, 0, -$request->stake_amount, "ставка в дебатах, при выборе 2-го учасника");
		       }
    		   Project::getResponse()->redirect(Project::getRequest()->createUrl('Debate', 'Debate'));
    		}

    		$this-> _view -> assign('debateTheme', $debateNow['theme']);
    		$this-> _view -> assign('debateStakeAmount', $debateNow['stake_amount']);
    		
    		$currentUser = $userModel->getUserById($user->id);
    		$this-> _view -> assign('currentUser', $currentUser);
    		$user1 = $userModel->getUserById($debateNow['user_id_1']);
    		$this-> _view -> assign('debateUser1', $user1);
    		$user2 = $userModel->getUserById($debateNow['user_id_2']);
    		$this-> _view -> assign('debateUser2', $user2);
    		

    		/*
    		
    		$userModel->changeUserMoney(1, 2, -4.1, "добавка");
    		*/
    		$this -> _view -> DebateChooseSecondUserPage();
    		
    		// END ETAP 3. Election for Secont USER , by auction
		}
		
		$this -> _view -> parse();
	}
	
	
	public function DebateDelThemeAction(){
	    $debateModel = new DebateModel();
	    $request = Project::getRequest();
	    $user = Project::getUser()->getDbUser();
	    $isAdmin = ($user->user_type_id == 1)?true:false;
	    $theme_id = $request->theme_id;
	    $theme = $debateModel->getThemeById($theme_id);
	    
	    if ($theme && ($isAdmin || $theme['user_id'] == $user->id)){
	        $debateModel->deleteTheme($theme_id);
	    }
	    Project::getResponse()->redirect(Project::getRequest()->createUrl('Debate', 'Debate'));
	}
	
	public function DebateVoteAction(){
	    $debateModel = new DebateModel();
	    $request = Project::getRequest();
	    $user = Project::getUser()->getDbUser();
	    $isAdmin = ($user->user_type_id == 1)?true:false;
	    
	    if ($request->subject == 'theme'){ // vote for theme. Etap 2
	        $theme = $debateModel->getThemeById($request->theme_id);
	        $isVoted = $debateModel->getThemeVoteByUserId($user->id);
	        if ($theme && !$isVoted){
	            $debateModel->addThemeVote($user->id, $request->theme_id);
	        }
	    }
	    
	    Project::getResponse()->redirect(Project::getRequest()->createUrl('Debate', 'Debate'));
	}

}
?>