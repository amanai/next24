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
	    
	    $sessiovVars = Project::getSession();
		$sessiovVars->add('debateChatId', 0);
		$sessiovVars->add('debateChatHelpersId', 0);
		$sessiovVars->add('debateChatUsersId', 0);
        
	    $this-> _view -> assign('tab_list', TabController::getDebateTabs(true, false, false)); // Show tabs
		
	    //$debateModel->stopEtap(7);
	    //$debateModel->startEtap(6);
	    //$debateModel->pauseOnEtap(6);
	    //$debateModel->pauseOffEtap(6);
	    $this->DebateEtapsCheckerAction(false);
	    
		$activeEtap = $debateModel->getActiveEtap();
		if (!$activeEtap){
		    $activeEtap = $debateModel->getFirstEtap();
		    $debateModel->startEtap($activeEtap['id']); // set ACTIVE to first etap
		    $debateModel->truncateTable('debate_now');
    		$debateModel->addDebateNow();
		}
		$debateNow = $debateModel->getDebateNow();
		if (!$debateNow) {
		    $debateModel->addDebateNow();
		    $debateNow = $debateModel->getDebateNow();
		}
		$this-> _view -> assign('debateNow', $debateNow);
		$this-> _view -> assign('activeEtap', $activeEtap);
		
		$userNumber = $debateModel->getUserNumber($debateNow, $user->id);
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
    		
    		$currentUser = $userModel->getUserById($user->id);
    		$this-> _view -> assign('currentUser', $currentUser);
    		$user1 = $userModel->getUserById($debateNow['user_id_1']);
    		$this-> _view -> assign('debateUser1', $user1);
    		$user2 = $userModel->getUserById($debateNow['user_id_2']);
    		$this-> _view -> assign('debateUser2', $user2);
    		
    		$aUserStakes = $debateModel->getDebateStakesByUserId($user->id, 0);
    		$this-> _view -> assign('aUserStakes', $aUserStakes);
    		
    		$this -> _view -> DebateGetStakesPage();
    		
    		// END ETAP 5. Stakes from users on Debate Users
    		
    		
		}elseif($activeEtap['name']=='Debates'){
		    // ETAP 6. DEBATE'S Chats 
		    $userModel = new UserModel();
		    
		    $currentUser = $userModel->getUserById($user->id);
    		$this-> _view -> assign('currentUser', $currentUser);
    		$user1 = $userModel->getUserById($debateNow['user_id_1']);
    		$this-> _view -> assign('debateUser1', $user1);
    		$user2 = $userModel->getUserById($debateNow['user_id_2']);
    		$this-> _view -> assign('debateUser2', $user2);
    		
    		$user1_avatar = $userModel->getUserAvatar($debateNow['user_id_1']);
    		$this-> _view -> assign('user1_avatar', $user1_avatar);
    		$user2_avatar = $userModel->getUserAvatar($debateNow['user_id_2']);
    		$this-> _view -> assign('user2_avatar', $user2_avatar);
    		
    		$helper1_1 = $userModel->getUserById($debateNow['helper_id_1_1']);
    		$this-> _view -> assign('helper1_1', $helper1_1);
    		$helper1_2 = $userModel->getUserById($debateNow['helper_id_1_2']);
    		$this-> _view -> assign('helper1_2', $helper1_2);
    		$helper2_1 = $userModel->getUserById($debateNow['helper_id_2_1']);
    		$this-> _view -> assign('helper2_1', $helper2_1);
    		$helper2_2 = $userModel->getUserById($debateNow['helper_id_2_2']);
    		$this-> _view -> assign('helper2_2', $helper2_2);
    		
    		$userIdFromHelper = $debateModel->getUserByHelper($debateNow, $user->id);
    		$this-> _view -> assign('userIdFromHelper', $userIdFromHelper);
    		
    		$aHelperCanSay = $debateModel->getHelperCanSay2();
    		$this-> _view -> assign('aHelperCanSay', $aHelperCanSay);
		    
		    $this -> _view -> DebatePage();

		    // END ETAP 6. DEBATE'S Chats 
		    
		    
		}elseif($activeEtap['name']=='Results'){
		    // ETAP 7. Last Etap. Results
		    $userModel = new UserModel();
		    
		    if ($request->estimateHelper){
		        if ($request->helper1){
		            $debateModel->changeOneValue('debate_now', $debateNow['id'], 'helper_'.$userNumber.'_1_rate', $request->helper1);
		        }
		        if ($request->helper2){
		            $debateModel->changeOneValue('debate_now', $debateNow['id'], 'helper_'.$userNumber.'_2_rate', $request->helper2);
		        }
		        Project::getResponse()->redirect(Project::getRequest()->createUrl('Debate', 'Debate'));
		    }
		    
		    $currentUser = $userModel->getUserById($user->id);
    		$this-> _view -> assign('currentUser', $currentUser);
    		
    		$userIdFromHelper = $debateModel->getUserByHelper($debateNow, $user->id);
    		$this-> _view -> assign('userIdFromHelper', $userIdFromHelper);
    		
    		$debateResult = $debateModel->getDebateResults();
    		$this-> _view -> assign('debateResult', $debateResult);
    		
    		$winnerUserId = $debateModel->getWinnerId($debateResult, $debateNow);
    		$winnerUserNumber = $debateModel->getUserNumber($debateNow, $winnerUserId);
    		$winnerUser = $userModel->getUserById($winnerUserId);
    		$this-> _view -> assign('winnerUser', $winnerUser);
    		$this-> _view -> assign('winnerUserNumber', $winnerUserNumber);
    		
    		$winnerHelper1 = $userModel->getUserById($debateNow['helper_id_'.$winnerUserNumber.'_1']);
    		$this-> _view -> assign('winnerHelper1', $winnerHelper1);
    		$winnerHelper2 = $userModel->getUserById($debateNow['helper_id_'.$winnerUserNumber.'_2']);
    		$this-> _view -> assign('winnerHelper2', $winnerHelper2);
    		
    		$currentUser = $userModel->getUserById($user->id);
    		$this-> _view -> assign('currentUser', $currentUser);
    		$currentHelper1 = $userModel->getUserById($debateNow['helper_id_'.$userNumber.'_1']);
    		$this-> _view -> assign('currentHelper1', $currentHelper1);
    		$currentHelper2 = $userModel->getUserById($debateNow['helper_id_'.$userNumber.'_2']);
    		$this-> _view -> assign('currentHelper2', $currentHelper2);
    		
    		if ($userNumber && !$debateNow['helper_'.$userNumber.'_1_rate'] && !$debateNow['helper_'.$userNumber.'_2_rate']){
    		    // not estimated
    		    $this-> _view -> assign('isEstimated', false);
    		}else $this-> _view -> assign('isEstimated', true);
    		
		    $this -> _view -> ResultsPage();

		    // END ETAP 7. Last Etap. Results 
		}
		
		$this -> _view -> parse();
	}
	
	// дебаты, Ajax переключение по этапам
	public function DebateEtapsCheckerAction($isAjax = true){
	    $debateModel = new DebateModel();
	    $request = Project::getRequest();
	    $message = array();
	    $sessiovVars = Project::getSession();
	    
	    $activeEtap = $debateModel->getActiveEtap();
	    if (!$activeEtap){
		    $activeEtap = $debateModel->getFirstEtap();
		    $debateModel->startEtap($activeEtap['id']); // set ACTIVE to first etap
		}
		
		$debateNow = $debateModel->getDebateNow();
		if (!$debateNow) {
		    $debateModel->addDebateNow();
		    $debateNow = $debateModel->getDebateNow();
		}
		
		$debateModel->setPassedEtap($activeEtap['id']);
		$etapTimeLeft = $debateModel->checkEtapDuration($activeEtap['id']);
		if ($etapTimeLeft <= 0){ // START new Etap
		    $this->switchEtap($activeEtap, $debateNow);
		    $message['refreshNow'] = 1;
		}else $message['refreshNow'] = 0;
		if ($sessiovVars->getKey('currEtap') != $activeEtap['name']){
		    $sessiovVars->add('currEtap', $activeEtap['name']);
		    $message['refreshNow'] = 1;
		}
		
		$etapTimeLeftMin = intval($etapTimeLeft/60) + 1;
		
		$message['etapTimeLeftMin'] = $etapTimeLeftMin;
	    
	    if ($isAjax){
    	    $this -> _view -> etapsChecker($message);
        	$this -> _view -> ajax();
	    }
	    //Project::getResponse()->redirect(Project::getRequest()->createUrl('Debate', 'Debate'));
	}
	
	function switchEtap($activeEtap, $debateNow){ // SWITCH Etap to next 
	    $debateModel = new DebateModel();
	    $userModel = new UserModel();
	    $nextEtap = $debateModel->getNextEtap($activeEtap['id']);
	    if (!$nextEtap) $nextEtap = $debateModel->getFirstEtap();

	    if ($activeEtap['name']=='GetTheme'){
    		// ETAP 1. Get Theme from Users.
    		if (!$debateModel->getThemesCount()){
    		    $nextEtap = $debateModel->getFirstEtap();
    		    $debateModel->truncateTable('debate_now');
    		    $debateModel->addDebateNow();
    		}
    		// END ETAP 1.
    		
		}elseif($activeEtap['name']=='VoteTheme'){
		    // ETAP 2. Vote for Theme
    		$winnerTheme = $debateModel->getVoteWinnerTheme();
    		if ($winnerTheme){
    		    $debateModel->changeOneValue('debate_now', $debateNow['id'], 'debate_theme_id', $winnerTheme['debate_theme_id']);
    		    $debateModel->changeOneValue('debate_now', $debateNow['id'], 'theme', $winnerTheme['theme']);
    		    $theme = $debateModel->getThemeById($winnerTheme['debate_theme_id']);
    		    $debateModel->changeOneValue('debate_now', $debateNow['id'], 'user_id_1', $theme['user_id']);
    		}else{
    		    $debateModel->truncateTable('debate_theme');
    		    $debateModel->truncateTable('debate_now');
    		    $nextEtap = $debateModel->getFirstEtap();
    		    $debateModel->truncateTable('debate_now');
    		    $debateModel->addDebateNow();
    		}
    		// END ETAP 2.
    		
		}elseif($activeEtap['name']=='ChooseSecondUser'){
		    // ETAP 3. Election for Secont USER , by auction, who pay more - get part in debate
		    if (!$debateNow['stake_amount'] || !$debateNow['user_id_2']){
		        $debateModel->truncateTable('debate_theme');
		        $debateModel->truncateTable('debate_theme_vote');
		        $debateModel->truncateTable('debate_now');
		        $debateModel->addDebateNow();
    		    $nextEtap = $debateModel->getFirstEtap();
		    }
    		// END ETAP 3. Election for Secont USER , by auction
    		
    		
		}elseif($activeEtap['name']=='ChooseHelpers'){
		    // ETAP 4. Election for Helpers
		    if (!$debateNow['helper_id_1_1']){
		        $helper_id = $debateModel->getHelperByDebateUserId_exept($debateNow['user_id_1'], $debateNow['helper_id_1_2']);
		        $debateModel->changeOneValue('debate_now', $debateNow['id'], 'helper_id_1_1', $helper_id);
		    }if (!$debateNow['helper_id_1_2']){
		        $helper_id = $debateModel->getHelperByDebateUserId_exept($debateNow['user_id_1'], $debateNow['helper_id_1_1']);
		        $debateModel->changeOneValue('debate_now', $debateNow['id'], 'helper_id_1_2', $helper_id);
		    }if (!$debateNow['helper_id_2_1']){
		        $helper_id = $debateModel->getHelperByDebateUserId_exept($debateNow['user_id_2'], $debateNow['helper_id_2_2']);
		        $debateModel->changeOneValue('debate_now', $debateNow['id'], 'helper_id_2_1', $helper_id);
		    }if (!$debateNow['helper_id_2_2']){
		        $helper_id = $debateModel->getHelperByDebateUserId_exept($debateNow['user_id_2'], $debateNow['helper_id_2_1']);
		        $debateModel->changeOneValue('debate_now', $debateNow['id'], 'helper_id_2_2', $helper_id);
		    }
    		// END ETAP 4. Election for Helpers
    		
		}elseif($activeEtap['name']=='GetStakes'){
		    // ETAP 5. Stakes from users on Debate Users
		 	$debateModel->changeOneValue('debate_now', $debateNow['id'], 'is_ready_1', 1);
		 	$debateModel->changeOneValue('debate_now', $debateNow['id'], 'is_ready_2', 1);
    		// END ETAP 5. Stakes from users on Debate Users
    		
    		
		}elseif($activeEtap['name']=='Debates'){
		    // ETAP 6. DEBATE'S Chats 
		    
		    // END ETAP 6. DEBATE'S Chats 
		    
		}elseif($activeEtap['name']=='Results'){
		    // ETAP 7. Last Etap. Results
		    $debateResult = $debateModel->getDebateResults();
		    $debate_protocol = $debateModel->getChatInText('debate_chat', 0);
		    $debate_history_id = $debateModel -> addDebateHistory($debateNow['start_time'], $debateNow['theme'], 
		                      $debateNow['stake_amount'], $debateNow['user_id_1'], $debateNow['user_id_2'], 
		                      $debateNow['helper_id_1_1'], $debateNow['helper_id_1_2'], $debateNow['helper_id_2_1'], $debateNow['helper_id_2_2'], 
		                      $debateResult[$debateNow['user_id_1']], $debateResult[$debateNow['user_id_2']], $debate_protocol);
                              
            $userModel -> changeUserRate($debateNow['helper_id_1_1'], $debateNow['helper_1_1_rate']);
            $userModel -> changeUserRate($debateNow['helper_id_1_2'], $debateNow['helper_1_2_rate']);
            $userModel -> changeUserRate($debateNow['helper_id_2_1'], $debateNow['helper_2_1_rate']);
            $userModel -> changeUserRate($debateNow['helper_id_2_2'], $debateNow['helper_2_2_rate']);
            
            // pay stake Winners = stake*1,5
    		$winnerUserId = $debateModel->getWinnerId($debateResult, $debateNow);
    		if ($winnerUserId){
                $aWinStakes = $debateModel->getDebateStakesByDebateUserId($winnerUserId, 0);
                // pay to WinnerUser 2
                if ($winnerUserId == $debateNow['user_id_2']){
                    $userModel->changeUserMoney($winnerUserId, 0, $debateNow['stake_amount']*1.5, "Ваша ставка ".$debateNow['stake_amount']." nm выиграла в дебатах id=".$debate_history_id);
                }
    		}else{
    		    $aWinStakes = $debateModel->getDebateStakes(0);
    		    $mess = "В дебатах (id ".$debate_history_id.") была ничья. Ваша ставка возвращается";
    		    // return money to user 2
    		    $userModel->changeUserMoney($debateNow['user_id_2'], 0, $debateNow['stake_amount'], $mess);
    		}
            foreach ($aWinStakes as $winStake){
                if ($winnerUserId){
                     $message = "Ваша ставка ".$winStake['stake_amount']." nm выиграла в дебатах id=".$debate_history_id;
                     $stake_amount = $winStake['stake_amount']*1.5;
                }else{
                    $message = $mess;
                    $stake_amount = $winStake['stake_amount'];
                }
                $userModel->changeUserMoney($winStake['user_id'], 0, $stake_amount, $message);
            }
            
            $debateModel->setStakeHistoryId(0, $debate_history_id);
            
            // empty all tables
            $debateModel->truncateTable('debate_now');
            $debateModel->truncateTable('debate_theme');
            $debateModel->truncateTable('debate_theme_vote');
            $debateModel->truncateTable('debate_helper_check');
            $debateModel->truncateTable('debate_helper_cansay');
            $debateModel->truncateTable('debate_user_vote');
            $debateModel->truncateTable('debate_chat');
            $debateModel->truncateTable('debate_helpers_chat');
            $debateModel->truncateTable('debate_users_chat');
            
            
		    // END ETAP 7. Last Etap. Results 
		}
		$debateModel->stopEtap($activeEtap['id']);
		$debateModel->startEtap($nextEtap['id']);
		$this->DebateEtapsCheckerAction();
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
	    $debateNow = $debateModel->getDebateNow();
	    
	    if ($request->subject == 'theme'){ // vote for theme. Etap 2
	        $theme = $debateModel->getThemeById($request->theme_id);
	        $isVoted = $debateModel->getThemeVoteByUserId($user->id);
	        if ($theme && !$isVoted){
	            $debateModel->addThemeVote($user->id, $request->theme_id);
	        }
	    }elseif ($request->subject == 'debateUser'){
	        $debate_user_id = $request->debate_user_id;
	        $isVoted = $debateModel->isUserDebateVoted($user->id);
	        if ($debate_user_id && !$isVoted && 
	             ($debateNow['user_id_1'] == $debate_user_id || $debateNow['user_id_2'] == $debate_user_id )
	           ){
	            $debateModel->addDebateVote($user->id, $debate_user_id);
	        }
	    }
	    
	    if ($request->isAjax){
	        // refresh All Chat's
            $this->DebateRefreshChat();
	    }else{
	       Project::getResponse()->redirect(Project::getRequest()->createUrl('Debate', 'Debate'));
	    }
	}
	
	public function DebateChatAction(){
	    $debateModel = new DebateModel();
	    $userModel = new UserModel();
	    $request = Project::getRequest();
	    $user = Project::getUser()->getDbUser();
	    $message = array();
	    $debateNow = $debateModel->getDebateNow();
	    $activeEtap = $debateModel->getActiveEtap();
		$userNumber = $debateModel->getUserNumber($debateNow, $user->id);
	    
	    switch ($request->areaId){
	        case 'chat_messages':
	            $dbTable = "debate_chat";
	            $debate_user_id = 0;
	            
	            // after helper say , he can't say also
	            if (!$activeEtap['is_pause'] && $debateModel->getUserByHelper($debateNow, $user->id)){ // user is a Helper
	                $debateModel->delHelperCanSay($user->id);
	            }
	            break;
	        case 'chat_messages_helpers':
	            $dbTable = "debate_helpers_chat";
	            $debate_user_id = $debateModel->getUserByHelper($debateNow, $user->id);
	            if (!$debate_user_id && $userNumber) $debate_user_id=$user->id;
	            break;
	        case 'chat_messages_users':
	            $dbTable = "debate_users_chat";
	            $debate_user_id = 0;
	            break;
	        default:
	            //echo $request->areaId;
	            return false;
	            break;
	    }
        
	    $message_time = date("Y-m-d H:i:s");
        $debateModel -> addChatLine($dbTable, $user->id, $request->textValue, $message_time, $debate_user_id);
        
        // refresh All Chat's
        $this->DebateRefreshChat();
        
	}
	
	public function DebateRefreshChatAction(){
	    // refresh All Chat's
        $this->DebateRefreshChat();
	}
	
	// refresh All Chat's
	function DebateRefreshChat(){
	    $debateModel = new DebateModel();
	    $user = Project::getUser()->getDbUser();
	    $sessiovVars = Project::getSession();
		$debateChatId = $sessiovVars->getKey('debateChatId');
		$debateChatHelpersId = $sessiovVars->getKey('debateChatHelpersId');
		$debateChatUsersId = $sessiovVars->getKey('debateChatUsersId');
		$message = array();
		$debateNow = $debateModel->getDebateNow();
        $activeEtap = $debateModel->getActiveEtap();
        $userNumber = $debateModel->getUserNumber($debateNow, $user->id);
        
		$message['user_id'] = $user->id;
	    
	    $aChatLines = $debateModel->getChatLines('debate_chat', $debateChatId);
        $htmlChatText = $debateModel->getHtmlChatText($aChatLines);
        $lastId = $debateModel->getLastIdFromArray($aChatLines);
        if ($lastId)  $sessiovVars->add('debateChatId', $lastId);
        
        $debate_user_id = $debateModel->getUserByHelper($debateNow, $user->id);
	    if (!$debate_user_id && $userNumber) $debate_user_id=$user->id;
        $aChatHelpersLines = $debateModel->getChatLines('debate_helpers_chat', $debateChatHelpersId, $debate_user_id);
        $htmlChatHelpersText = $debateModel->getHtmlChatText($aChatHelpersLines);
        $lastId = $debateModel->getLastIdFromArray($aChatHelpersLines);
        if ($lastId) $sessiovVars->add('debateChatHelpersId', $lastId);
        
        $aChatUsersLines = $debateModel->getChatLines('debate_users_chat', $debateChatUsersId);
        $htmlChatUsersText = $debateModel->getHtmlChatText($aChatUsersLines);
        $lastId = $debateModel->getLastIdFromArray($aChatUsersLines);
        if ($lastId) $sessiovVars->add('debateChatUsersId', $debateModel->getLastIdFromArray($aChatUsersLines));
        
        $message['htmlChatText'] = $htmlChatText;
        $message['htmlChatHelpersText'] = $htmlChatHelpersText;
        $message['htmlChatUsersText'] = $htmlChatUsersText;
        
        // show or hide Changeable elements
        
        $message['isPause'] = $activeEtap['is_pause'];
        
		if ($debateNow['user_id_1'] == $user->id) $userNumber = 1;
		elseif ($debateNow['user_id_2'] == $user->id) $userNumber = 2;
		else $userNumber = 0; 
		$message['userNumber'] = $userNumber;
		
		// hide/show message box for Debate Users
        $isHelperCanSay = $debateModel->isHelperCanSay($user->id);
        $message['isHelperCanSay'] = $isHelperCanSay;
        
        if ($userNumber){ // hide/show button "helper can say"
            if ($debateModel->isHelperCanSay($debateNow['helper_id_'.$userNumber.'_1'])) $message['helperSay1'] = 'hide';
            else $message['helperSay1'] = 'show';
            
            if ($debateModel->isHelperCanSay($debateNow['helper_id_'.$userNumber.'_2'])) $message['helperSay2'] = 'hide';
            else $message['helperSay2'] = 'show';
            
            // hide button PAUSE , if already pressed
            //if (!$debateNow['is_ready_'.$userNumber]) $message['hide_pause'] = $userNumber;
            if (!$debateNow['is_ready_1']) $message['hide_pause1'] = 1; else $message['hide_pause1'] = 0;
            if (!$debateNow['is_ready_2']) $message['hide_pause2'] = 1; else $message['hide_pause2'] = 0;
        }
        
        //  hide/show button vote_for_user in debate
        if ($debateModel->isUserDebateVoted($user->id)) $message['isUserVoted'] = 1;
        else $message['isUserVoted'] = 0;
        
        $this -> _view -> returnChat($message);
    	$this -> _view -> ajax();

	}
	
	// allow to say helper
	function DebateHelperCansayAction(){
	    $debateModel = new DebateModel();
	    $userModel = new UserModel();
	    $request = Project::getRequest();
	    $user = Project::getUser()->getDbUser();
	    $message = array();
	    
	    if ($request->helper_id && !$debateModel->isHelperCanSay($request->helper_id)){
	        $debateModel->addHelperCanSay($request->helper_id);
	        
	    }
	    $message['elementId'] = $request->elementId;
	    $this -> _view -> helperCansay($message);
        $this -> _view -> ajax();
	}
	
	
	function DebatePausePressAction(){
	    $debateModel = new DebateModel();
	    $userModel = new UserModel();
	    $request = Project::getRequest();
	    $user = Project::getUser()->getDbUser();
	    
	    $debateNow = $debateModel->getDebateNow();
	    $userNumber = $debateModel->getUserNumber($debateNow, $user->id);
	    
	    if ($request->userNumber && $userNumber == $request->userNumber){
	        $debateModel->changeOneValue('debate_now', $debateNow['id'], 'is_ready_'.$userNumber, 0);
	    }
	}
	
	
}
?>