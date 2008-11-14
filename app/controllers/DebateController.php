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
		
	    //$debateModel->stopEtap(4);
	    //$debateModel->startEtap(5);
	    
		$activeEtap = $debateModel->getActiveEtap();
		if (!$activeEtap){
		    $activeEtap = $debateModel->getFirstEtap();
		    $debateModel->startEtap($activeEtap['id']); // set ACTIVE to first etap
		}
		$debateNow = $debateModel->getDebateNow();
		
		if ($debateNow['user_id_1'] == $user->id) $userNumber = 1;
		elseif ($debateNow['user_id_2'] == $user->id) $userNumber = 2;
		else $userNumber = 0;
		$this-> _view -> assign('userNumber', $userNumber);
		
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
		       $stake_amount = abs($request->stake_amount);
		       $result = $debateModel->doStakeSecondUser($user->id, $stake_amount, $debateNow);
		       if ($result){
		           $userModel->changeUserMoney($debateNow['user_id_2'], 0, $debateNow['stake_amount'], "возвращение ставки в дебатах");
		           $userModel->changeUserMoney($user->id, 0, -$stake_amount, "ставка в дебатах, при выборе 2-го учасника");
		       }
    		   Project::getResponse()->redirect(Project::getRequest()->createUrl('Debate', 'Debate'));
    		}

    		$this-> _view -> assign('debateNow', $debateNow);
    		
    		$currentUser = $userModel->getUserById($user->id);
    		$this-> _view -> assign('currentUser', $currentUser);
    		$user1 = $userModel->getUserById($debateNow['user_id_1']);
    		$this-> _view -> assign('debateUser1', $user1);
    		$user2 = $userModel->getUserById($debateNow['user_id_2']);
    		$this-> _view -> assign('debateUser2', $user2);
            
    		$this -> _view -> DebateChooseSecondUserPage();
    		
    		// END ETAP 3. Election for Secont USER , by auction
    		
    		
		}elseif($activeEtap['name']=='ChooseHelpers'){
		    // ETAP 4. Election for Helpers
		    $userModel = new UserModel();
		    
		    if ($request->helper1){
		       $debateModel->addHelperCheck($user->id, $debateNow['user_id_1']);
    		   Project::getResponse()->redirect(Project::getRequest()->createUrl('Debate', 'Debate'));
    		}elseif ($request->helper2){
		       $debateModel->addHelperCheck($user->id, $debateNow['user_id_2']);
    		   Project::getResponse()->redirect(Project::getRequest()->createUrl('Debate', 'Debate'));
    		}elseif ($request->check_helper){
    		    $isInHelperTable = $debateModel->isInHelperTable($request->check_helper);
    		    if ($isInHelperTable && $isInHelperTable['debate_user_id'] == $user->id){
    		        if (!$userNumber) Project::getResponse()->redirect(Project::getRequest()->createUrl('Debate', 'Debate'));
    		        
    		        if ($debateNow['helper_id_'.$userNumber.'_1'] != $request->check_helper && $debateNow['helper_id_'.$userNumber.'_2'] != $request->check_helper){
        		        if (!$debateNow['helper_id_'.$userNumber.'_1']){
        		          $debateModel->changeOneValue('debate_now', $debateNow['id'], 'helper_id_'.$userNumber.'_1', $request->check_helper);
        		        }elseif (!$debateNow['helper_id_'.$userNumber.'_2']){
        		          $debateModel->changeOneValue('debate_now', $debateNow['id'], 'helper_id_'.$userNumber.'_2', $request->check_helper);
        		        }
    		        }
    		    }
    		    Project::getResponse()->redirect(Project::getRequest()->createUrl('Debate', 'Debate'));
    		}
    		
    		$this-> _view -> assign('debateNow', $debateNow);
    		
    		$currentUser = $userModel->getUserById($user->id);
    		$this-> _view -> assign('currentUser', $currentUser);
    		$user1 = $userModel->getUserById($debateNow['user_id_1']);
    		$this-> _view -> assign('debateUser1', $user1);
    		$user2 = $userModel->getUserById($debateNow['user_id_2']);
    		$this-> _view -> assign('debateUser2', $user2);
    		
    		$helperTable = $debateModel->isInHelperTable($user->id);
    		$this-> _view -> assign('helperTable', $helperTable);
    		
    		if ($userNumber){
		        $aDebateUserHelpers = $debateModel->getHelpersByDebateUserId($user->id);
		        $this-> _view -> assign('aDebateUserHelpers', $aDebateUserHelpers);
		        $this-> _view -> assign('isDebateUser', true);
		        
		        if (!$debateNow['helper_id_'.$userNumber.'_1'] || !$debateNow['helper_id_'.$userNumber.'_2']){
		           $this-> _view -> assign('isDebateUserCanAddHelpers', true);
		        }else{
		            $this-> _view -> assign('isDebateUserCanAddHelpers', false);
		        }
		    }else{
		        $this-> _view -> assign('isDebateUser', false);
		    }
    		
    		$this -> _view -> DebateChooseHelpersPage();
    		
    		// END ETAP 4. Election for Helpers
    		
    		
    		
		}elseif($activeEtap['name']=='GetStakes'){
		    // ETAP 5. Stakes from users on Debate Users
		    $userModel = new UserModel();
		    
		    if (($request->doStake1 || $request->doStake2 ) && $request->stake_amount && $user->nextmoney >=$request->stake_amount){
		       $stake_amount = abs($request->stake_amount);
		       $debate_user_id = ($request->doStake1)?$debateNow['user_id_1']:$debateNow['user_id_2'];
		       
		       $debateModel->doStake($user->id, $debate_user_id, $stake_amount, 0);
	           $userModel->changeUserMoney($user->id, 0, -$stake_amount, "ставка в дебатах, на учасника ID = ".$debate_user_id);

    		   Project::getResponse()->redirect(Project::getRequest()->createUrl('Debate', 'Debate'));
    		}elseif ($request->user_ready){
    		   $debateModel -> changeOneValue('debate_now', $debateNow['id'], 'is_ready_'.$userNumber, 1); 
    		   
    		   Project::getResponse()->redirect(Project::getRequest()->createUrl('Debate', 'Debate'));
    		}
            
    		if ($userNumber){
    		    $isReady = ($debateNow['is_ready_'.$userNumber])?true:false;
    		    $this-> _view -> assign('isReady', $isReady);
    		    
    		    $this-> _view -> assign('stakesCount', $debateModel->getDebateStakesCount($user->id, 0));
    		    $this-> _view -> assign('stakesSum', $debateModel->getDebateStakesSum($user->id, 0));
    		}else{
    		    $this-> _view -> assign('stakesCount', $debateModel->getDebateStakesCount(0, 0));
    		    $this-> _view -> assign('stakesSum', $debateModel->getDebateStakesSum(0, 0));
    		}
    		
    		$this-> _view -> assign('debateNow', $debateNow);
    		
    		$currentUser = $userModel->getUserById($user->id);
    		$this-> _view -> assign('currentUser', $currentUser);
    		$user1 = $userModel->getUserById($debateNow['user_id_1']);
    		$this-> _view -> assign('debateUser1', $user1);
    		$user2 = $userModel->getUserById($debateNow['user_id_2']);
    		$this-> _view -> assign('debateUser2', $user2);
    		
    		$aUserStakes = $debateModel->getDebateStakesByUserId($user->id);
    		$this-> _view -> assign('aUserStakes', $aUserStakes);
    		
    		
    		
    		
            
    		$this -> _view -> DebateGetStakesPage();
    		
    		// END ETAP 5. Stakes from users on Debate Users
    		
    		
		}elseif($activeEtap['name']=='Debates'){
		    // ETAP 6. DEBATE'S Chats 
		    // END ETAP 6. DEBATE'S Chats 
		    
		    
		}elseif($activeEtap['name']=='Results'){
		    // ETAP 7. Last Etap. Results 
		    // END ETAP 7. Last Etap. Results 
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