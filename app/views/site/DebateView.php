<?php
class DebateView extends BaseSiteView{
	protected $_dir = 'debate';
	
	public function showUserAvator($userAvator, $imgUrl){
		$user = Project::getUser()->getDbUser()->getUserById($userAvator['user_id']);
		echo '<div class="avatar">';
		echo '<a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $user['login']).'">';
		if ($userAvator['path'] && $userAvator['path']!='no.png'){
	       $src = ($userAvator['path'])?$imgUrl.'avatar/'.$userAvator['path']:$imgUrl.'avatar/'.$userAvator['sys_path'];
	       echo '<img src="'.$src.'" />';
	   	}else{
	       echo '<img src="'.$imgUrl.'avatar/no90.jpg" />';
	   	}
	   	echo '<span class="member-name">'.$user['login'].'</span>';
	   	echo '</a>';
		echo '</div>'; 
		echo '<ul class="controll clearfix"> 
				<li><a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $user['login']).'" title="Написать сообщение"><i class="icon mail-icon"></i></a></li> 
				<li><a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $user['login']).'" title="Статьи"><i class="icon mbook-icon"></i></a></li> 
				<li><a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $user['login']).'" title="Добавить"><i class="icon adduser-icon"></i></a></li> 
				<li><a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $user['login']).'" title="Комментарии"><i class="icon mcomm-icon"></i></a></li> 
			</ul>'; 
	}
	
	public function showQuestionAvator(){
	/*   echo '
	   <div class="debate_avator">
	   <img src="'.$this -> image_url.'avatar/question.png" />
	   </div>
	   <br /><br />	 
	   ';  */
		echo '<img src="'.$this -> image_url.'avatar/question.png" alt="" />';
	}
	
	public function showMessageboxForDebateUsers($userNumber = 0, $isHide = 0){
	    echo '
	    <tr id="debate_MessageboxForDebateUsers">
	        <td colspan="3">
		      <table align="center">
		       <tr>
		          <td><div class="center"><textarea id="chat_text" name="chat_text" cols="58" rows="3"></textarea></div></td>
    		      <td>
        		      <p class="padding3"><input type="button" onclick="javascript:send_message(\'chat_text\', \'chat_messages\', '.$isHide.');" value="Сказать" /></p>';
        	    if ($userNumber){
        	       echo '
        			   <p class="padding3">
        			     <input id="pause'.$userNumber.'" type="button" value="Перерыв" onclick="javascript:pauseSet(\'pause'.$userNumber.'\', '.$userNumber.');" />
        			   </p>';
        	    }
        	    echo '		
    		      </td>
    		   </tr>
    		  </table>
			</td>
		</tr>
	    ';
	    if ($userNumber){
	        echo '
	        <tr id="pauseText1" style="display: none;">
	           <td colspan="3">
	           <div class="center">1-й участник просит паузу</div>
	           </td>
	        <tr><tr id="pauseText2" style="display: none;">
	           <td colspan="3">
	           <div class="center">2-й участник просит паузу</div>
	           </td>
	        <tr><tr id="pauseText3" style="display: none;">
	           <td colspan="3">
	           <div class="center">Перерыв</div>
	           </td>
	        <tr>
	        ';
	    }
	}
	
	public function showAllowSayHelpers($helper1, $helper2){
	    echo '
	    <tr>
		    <td colspan="3"> 
		       <div class="center">
		       ';
	    if ($helper1){
	        echo '<input type="button" value="Разрешить сказать '.$helper1['login'].'" id="helperSay1" onclick="helperSay(\'helperSay1\', '.$helper1['id'].');" />&nbsp;&nbsp;';
	    }if ($helper2){
	        echo '<input type="button" value="Разрешить сказать '.$helper2['login'].'" id="helperSay2" onclick="helperSay(\'helperSay2\', '.$helper2['id'].');" /></div>';
	    }
	    echo '
			</td>
		</tr>
	    ';
	}
	
	public function showHelpersChat(){
	    echo '
	    <tr>
			<td colspan="3"><div class="center"><b>Чат помощников</b></div></td>
        </tr>
        <tr>
			<td align="left" colspan="3"><div class="center"><div class="ChatMessagesB_helpers" id="chat_messages_helpers"></div></div></td>
	    </tr>
	    <tr>
		    <td colspan="3">
		      <table align="center">
		       <tr>
		          <td><div class="center"><textarea id="chat_text_helpers" name="chat_text_helpers" cols="58" rows="1"></textarea></div></td>
    		      <td><div class="center"><input type="button" onclick="javascript:send_message(\'chat_text_helpers\', \'chat_messages_helpers\');" value="Сказать" /></div></td>
    		   </tr>
    		  </table>
			</td>
		</tr>
	    ';
	}
	
	public function showUsersChat(){
	    echo '
	    <tr>
			<td colspan="3"><div class="center"><b>Чат пользователей</b></div></td>
        </tr>
        <tr>
			<td align="left" colspan="3"><div class="center"><div class="ChatMessagesB_helpers" id="chat_messages_users"></div></div></td>
	    </tr>
	    ';
	}
	
	public function showUsersChatMessageBox(){
	    echo '
	    <tr>
	        <td colspan="3">
		      <table align="center">
		       <tr>
		          <td><div class="center"><textarea id="chat_text_users" name="chat_text_users" cols="58" rows="1"></textarea></div></td>
    		      <td><div class="center"><input type="button" onclick="javascript:send_message(\'chat_text_users\', \'chat_messages_users\');" value="Сказать" /></div></td>
    		   </tr>
    		  </table>
			</td>
		</tr>
	    ';
	}
	
	public function showWinnerHelpersName($winnerHelper1, $winnerHelper2, $user_id){
	    $helpersName = ''; $helpersCount = 0;
	    if ($winnerHelper1['id']){
	        $helpersCount ++;
	        $helpersName .= '<a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $winnerHelper1['login']).'">';
    	    if ($winnerHelper1['id'] == $user_id) $helpersName .= 'Вы';
    	    else $helpersName .= $winnerHelper1['login'];
    	    $helpersName .= '</a>';
	    }
	    if ($winnerHelper1['id'] && $winnerHelper2['id']) $helpersName .= ' и ';
	    if ($winnerHelper2['id']){
	        $helpersCount ++;
	        $helpersName .= '<a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $winnerHelper2['login']).'">';
    	    if ($winnerHelper2['id'] == $user_id) $helpersName .= 'Вы';
    	    else $helpersName .= $winnerHelper2['login'];
    	    $helpersName .= '</a>';
	    }
	    if ($helpersCount == 2) $helpersName = " и его помощники ".$helpersName;
	    elseif ($helpersCount == 1) $helpersName = " и его помощник ".$helpersName;
        
	    return $helpersName;
	}
	
	public function showTimer(){
		echo '<div class="time debati_time">Осталось <span id="timeLeft" class=""></span></div>';
	 /*   echo '
	    <div class="debati_time">
	       Осталось <span id="timeLeft" class=""></span>
        </div>'; */
		//<div class="time">Осталось <span>30</span> мин. <span>24</span> сек.</div>
	}
	

    /**
     * Pages VIEW
     *
     */
    // etap 1
    function DebateThemeProposalPage(){
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'debate.js';
	    $this -> setTemplate(null, 'debate_theme_proposal.tpl.php');
	}
	
	// etap 2
	function DebateVoteThemePage(){
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'debate.js';
	    $this -> setTemplate(null, 'debate_vote_theme.tpl.php');
	}
	
	// etap 3
	function DebateChooseSecondUserPage(){
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'debate.js';
	    $this -> setTemplate(null, 'debate_choose_second_user.tpl.php');
	}
	
	// etap 4
	function DebateChooseHelpersPage(){
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'debate.js';
	    $this -> setTemplate(null, 'debate_choose_helpers.tpl.php');
	}
	
	// etap 5
	function DebateGetStakesPage(){
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'debate.js';
	    $this -> setTemplate(null, 'debate_get_stakes.tpl.php');
	}
	
	// etap 6
	function DebatePage(){
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'debate.js';
	    $this -> setTemplate(null, 'debate_chat.tpl.php');
	}
	
	// etap 7
	function ResultsPage(){
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'debate.js';
	    $this -> setTemplate(null, 'debate_result.tpl.php');
	}
	
	
	function RulesPage(){
	    //$this->_js_files[] = 'debate.js';
	    $this -> setTemplate(null, 'debate_rules.tpl.php');
	}
	
	function HistoryPage(){
	    //$this->_js_files[] = 'debate.js';
	    $this -> setTemplate(null, 'debate_history.tpl.php');
	}
	
	/**
     * END Pages VIEW
     *
     */
	
	/**
     * AJAX Functions
     *
     */
	
	function etapsChecker($message){
	    $response = Project::getAjaxResponse();
	    $timeLeft = "";
	    if ($message['etapTimeLeftMin']) $timeLeft .= $message['etapTimeLeftMin']." мин. ";
	    $timeLeft .= $message['etapTimeLeftSec']." сек.";
	    $response -> block("timeLeft",  true, $timeLeft);
	    if ($message['etapTimeLeftMin'] < 3){
	        $response -> attribute("timeLeft", "class", "red");
	    }else{
	        $response -> attribute("timeLeft", "class", "");
	    }
	    if ($message['refreshNow']) $response -> attribute("refreshNow", "value", 1);
	}
	
	function returnNewThemes($message){
	    $debateModel = new DebateModel();
	    $response = Project::getAjaxResponse();
        $lastThemeId = $message['lastThemeId'];
        $aNewThemes = $debateModel->getNewThemeById($lastThemeId);
 		$userModel = new UserModel();	       
        foreach ($aNewThemes as $newTheme){
			$user_default_avatar = $userModel->getUserAvatar($newTheme['user_id']);
			$avator_path = ($user_default_avatar['sys_av_id'])?$user_default_avatar['sys_path']:$user_default_avatar['path']; 
	    	if(!$avator_path || $avator_path == 'no.png') $avator_path = $this->image_url.'avatar/no25.jpg';
	    	else $avator_path = $this->image_url.'avatar/'.$avator_path;        	
            if ($message['isAdmin'] || $message['user_id'] == $newTheme['user_id']) {$delTheme = '<a href="'.Project::getRequest()->createUrl('Debate', 'DebateDelTheme').'/theme_id:'.$newTheme['debate_theme_id'].'" class="red">Удалить</a> ';} else $delTheme='';
			$strTr = '<tr>
        				<td class="qv"><a href="#">'.$delTheme.$newTheme['debate_theme_theme'].'</a></td>
        				<td class="av"><a class="avatar-link" href="'.Project::getRequest()->createUrl('User', 'Profile', null, $newTheme['login']).'"><img src="'.$avator_path.'" alt="" class="avatar" style="width:25px;height:25px;"/><span class="t">'.$newTheme['login'].'</span></a></td>
        			  </tr>';
            $response -> append('themeTable', $strTr);
        }
	}
	
	function returnThemesVote($message){
	    $debateModel = new DebateModel();
	    $response = Project::getAjaxResponse();
        $lastThemeId = $message['lastThemeId'];
        $aThemes = $debateModel->getAllThemes("debate_theme.votes DESC");
        $isVoted = $debateModel->getThemeVoteByUserId($message['user_id']);
        $strTable = '<table class="stat-table questions">
						<thead>
							<tr>
								<th class="main-row">Тема</th>
								<th>Предложил</th>
								<th>Голосов</th>
								<th>Действия</th>
							</tr>
						</thead>
						<tbody>';
        $userModel = new UserModel();       
        foreach ($aThemes as $theme){
            if ($message['user_id'] && !$isVoted && $message['user_id'] != $theme['user_id']){
                $vote = '<i class="big-icon vote-en-icon"></i><a href="javascript: void(0);" onclick="vote_theme('.$theme['debate_theme_id'].', \'theme\');">голосовать</a>';
            } 
            elseif ($message['user_id'] == $theme['user_id']) $vote='<span class="my-vote"><i class="big-icon vote-my-icon"></i>моя тема</span>';
            else $vote='<span><i class="big-icon vote-ds-icon"></i>голос принят</span>';
			$user_default_avatar = $userModel->getUserAvatar($theme['user_id']);
			$avator_path = ($user_default_avatar['sys_av_id'])?$user_default_avatar['sys_path']:$user_default_avatar['path']; 
	    	if(!$avator_path || $avator_path == 'no.png') $avator_path = $this->image_url.'avatar/no25.jpg';
	    	else $avator_path = $this->image_url.'avatar/'.$avator_path;             
            $strTable .= '<tr>
        					<td class="qv"><a href="#">'.$theme['debate_theme_theme'].'</a></td>
        					<td class="av"><a class="avatar-link" href="'.Project::getRequest()->createUrl('User', 'Profile', null, $theme['login']).'"><img src="'.$avator_path.'" alt="" class="avatar" style="width:25px;height:25px;" /><span class="t">'.$theme['login'].'</span></a></td>
        					<td class="an">'.(int)$theme['debate_theme_votes'].'</td>
        					<td class="act">'.$vote.'</td>
        				</tr>';
        }
        $strTable .= '</tbody>
        			</table>';
        $response -> block('themeDivTable', true, $strTable);
	}
	
	function returnStakeSecondUser($message){
	    $response = Project::getAjaxResponse();
        $user2 = $message['user2'];
        
        if($user2){ 
	         if ($user2['id'] == $message['user_id']) {
	             $strTable = '(это Ваша ставка)';
	             $response -> hide('doStakeBtn');
	             $response -> hide('stake_amount');
	         }else{
	             $strTable = '(поставил '.'<a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $user2['login']).'">'.$user2['login'].'</a>)'; 
	             $response -> show('doStakeBtn');
	             $response -> show('stake_amount');
	         }
	    } 
	    $response -> block('stake_btn', '<tr class="place last"> 
												<th></th> 
													<td class="vl"> 
														<div class="status"> 
															<span class="st-ok"><i class="big-icon ok-icon"></i>Ставка сделана!</span> 
														</div> 
													</td> 
												</tr>');
        $response -> block('stakeUserInfo', true, $strTable);
        $response -> block('stakeAmount', true, $message['stake_amount'].' nm');
	}
	
	function returnChooseHelpers($message){
	    $response = Project::getAjaxResponse();
	    $helperTable = $message['helperTable'];    
	    $isDebateUser = $message['isDebateUser'];
		if ($isDebateUser){
			$strTable = '<div class="inn clearfix"> 
									<table class="stat-table">
										<thead> 
											<tr> 
												<th class="main-row">Помошник</th> 
												<th>Голосов</th> 
												<th>Действия</th> 
											</tr> 
										</thead>
										<tbody>';
			foreach ($message['aDebateUserHelpers'] as $debateUserHelpers){ 
				$tr_id = "cmod_tab2";
				$strTable .= '<tr id="'.$tr_id.'"> 
								<td class="av"><a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $debateUserHelpers['login']).'" class="avatar-link"><img src="assets/i/temp/avatar.s.jpg" alt="" class="avatar" /><span class="t">'.$debateUserHelpers['login'].'</span></a></td> 
								<td class="an">'.(int)$debateUserHelpers['rate'].'</td>';
				$strTable .= 	'<td class="act">';
				if ($message['isDebateUserCanAddHelpers'] &&  
		            $message['debateNow']['helper_id_'.$message['userNumber'].'_1'] != $debateUserHelpers['helper_id'] && 
		            $message['debateNow']['helper_id_'.$message['userNumber'].'_2'] != $debateUserHelpers['helper_id'] ){ // т.е. не был еще выбран
		            $strTable .= '<a href="'.Project::getRequest()->createUrl('Debate', 'Debate').'/check_helper:'.$debateUserHelpers['helper_id'].'"><i class="big-icon vote-en-icon"></i>Выбрать</a>';
		        }else {
		            $strTable .= '-';
		        }
		        $strTable .= '</td></tr>';				
			}
			$strTable .= '</tbody>
						</table>
						</div>';														 						
	 } elseif ($message['user_id'] && !$helperTable){ 
	 	$strTable .= '<div class="inn">
	 					<ul class="helpers">
	 						<li id="helper1tr"><a href="#"><i class="big-icon helpers-icon" id="helper1btn" onclick="wantBeHelper(1);"></i>Я хочу стать помошником <strong>'.$message['debateUser1']['login'].'</strong></a></li>
	 						<li id="helper2tr"><a href="#"><i class="big-icon helpers-icon" id="helper2dtn" onclick="wantBeHelper(2);"></i>Я хочу стать помошником <strong>'.$message['debateUser2']['login'].'</strong></a></li>
	 					</ul>
	 				  </div>';
	 } elseif ($helperTable){ 	
		$strTable .= '<div class="in"> 
						<h2 class="status"><span class="st-ok"><i class="big-icon ok-icon"></i>Вы выбрали быть помощником у '.$helperTable['login'].'</span></h2> 
					</div>';					
	 } elseif(!$message['user_id']) { 
	 	$strTable .= '<div class="in"> 
						<h2 class="status"><span class="st-ok" style="color:red;">Что бы принять участие в дебатах, необходимо <a href="'.Project::getRequest()->createUrl('User', 'RegistrationForm').'">зарегистрироваться</a></span></h2> 
					</div>';					
	 }	    
	$response -> block('centerTable', true, $strTable);

		$strHelpersList = '<dt>Помощники</dt>';	
		if ($message['helper1_1']){
		    $strHelpersList .= '<dd><a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $message['helper1_1']['login']).'">'.$message['helper1_1']['login'].'</a></dd>';
		}else $strHelpersList .= '<dd>?</dd>';
		if ($message['helper1_2']){
		    $strHelpersList .= '<dd><a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $message['helper1_2']['login']).'">'.$message['helper1_2']['login'].'</a></dd>';
		}else $strHelpersList .= '<dd>?</dd>';
		$response -> block('helpersList1', true, $strHelpersList);
		
		$strHelpersList = '<dt>Помощники</dt>';
		if ($message['helper2_1']){
		    $strHelpersList .= '<dd><a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $message['helper2_1']['login']).'">'.$message['helper2_1']['login'].'</a></dd>';
		}else $strHelpersList .= '<dd>?</dd>';
		if ($message['helper2_2']){
		    $strHelpersList .= '<dd><a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $message['helper2_2']['login']).'">'.$message['helper2_2']['login'].'</a></dd>';
		}else $strHelpersList .= '<dd>?</dd>';
		$response -> block('helpersList2', true, $strHelpersList);
	}
	
	
	function returnDoStakePage($message){
	    $response = Project::getAjaxResponse();
	    if($message['userNumber']) {
	    	$strTable = '<form action="" method="post" name="stakesform">
										<table class="alt"> 
											<tr class="current"> 
												<th>Ставки на Вас:</th> 
												<td class="vl"> 
													<span class="count">'.(int)$message['stakesCount'].'</span> 
												</td> 
											</tr> 
											<tr class="current"> 
												<th>На сумму:</th> 
												<td class="vl"> 
													<span class="nm no-nm">'.$message['stakesSum'].' nm</span> 
												</td> 
											</tr>';
	    	if ($message['userNumber'] && $message['isReady']){ 
	    		
	    	}elseif ($message['userNumber']){
	    		$strTable .= '<tr class="current last"> 
								<td colspan="2" class="vl vl-center">
									<input type="hidden" name="user_ready" value="Я готов к дебатам" />
									<button class="ready-button" onclick="document.stakesform.submit();">Я готов к дебатам</button> 
								</td> 
							</tr>';
	    	}
			$strTable .= '</table>
						</form>';
		}elseif ($message['user_id']){	 
	    	$currentUser = $message['currentUser'];
		     if ($message['aUserStakes']){
                $sum = 0;
                foreach ($message['aUserStakes'] as $userStake){
                    $sum += $userStake['stake_amount'];
                }
            }
            //<span class="from">( <a href="#">petrovich</a> )</span>
	    	$strTable = '<table> 
							<tr class="current"> 
								<th>Текущая ставка:</th> 
								<td class="vl"> 
									<span class="nm">'.$sum.' nm</span>  
								</td> 
							</tr> 
							<tr class="current last"> 
								<th>Всего ставок:</th> 
								<td class="vl"> 
									<span class="count">'.(int)$message['stakesCount'].'</span> 
								</td> 
							</tr> 
							<tr class="place first"> 
								<th> 
									У вас на счету:
								</th> 
								<td class="vl"> 
									<span class="nm no-nm">'.$currentUser['nextmoney'].' nm</span>';
	    						if($currentUser['nextmoney']==0) {
	    							$strTable .= '<span class="alert">У вас не достаточно средств на счету. <a href="#">Пополнить</a></span>'; 
	    						} 
						$strTable .= '</td> 
							</tr> 
							<tr class="place last"> 
								<th> 
									Сделать ставку:
								</th> 
								<td class="vl"> 
									<fieldset> 
										<div class="input-field"><input type="text" value="15" name="stake_amount" id="stake_amount" /> nm</div> 
										<div class="button-field"> 
											<button class="vote-button" id="doStake1" onclick="doStake(1);">Поставить на <strong>'.$message['debateUser1']['login'].'</strong></button> 
											<button class="vote-button" id="doStake2" onclick="doStake(2);">Поставить на <strong>'.$message['debateUser2']['login'].'</strong></button>
										</div> 
									</fieldset>
								</td> 
							</tr>';
							if ($this->aUserStakes){
                			$strTable .= '
                    		<tr class="place last">
								<th> 
									Ваши ставки:
								</th> 
            					<td class="vl">';
                				$sum = 0;
                				foreach ($this->aUserStakes as $userStake){
                    				$sum += $userStake['stake_amount'];
                    				$strTable .= '<b>'.$userStake['stake_amount'].'</b> nm на ';
                   					if ($userStake['debate_user_id'] == $this->debateUser1['id']) $strTable .= $this->debateUser1['login'];
                    				else $strTable .= $this->debateUser2['login'];
                    				$strTable .= '<br/>';
                				}
            					$strTable .= '		     
            								</td>
            									</tr>';
            								$strTable .= '
                    							<tr class="place last">
            										<th> Всего: </th>
            										<td class="vl"><b>'.$sum.'</b> nm</td>
            									</tr>';
            				}
            	$strTable .= '</table></form>';						
		}	
	    
	/*    if($message['userNumber']){ $strTemp = 'Ставок на Вас:'; } else{ $strTemp = 'Всего ставок:';}
	    $strTable = '
	    <form action="" method="post">
	    <table class="questions">
		<tr> 
			<td colspan="3"><div class="center width_400"><b>Тема дебатов: '.$message['debateNow']['theme'].'</b></div></td>
        </tr>
		<tr>
			<td> '.$strTemp.' </td>
			<td>
			     '.(int)$message['stakesCount'].'
			</td>
			<td>&nbsp;</td>
	    </tr>
		<tr>
		    <td> На сумму: </td>
			<td>
			     '.$message['stakesSum'].' nm
			</td>
			<td>&nbsp;</td>
		</tr>
		';
		
        if ($message['userNumber'] && $message['isReady']){

        }elseif ($message['userNumber']){
            $strTable .= '
        <tr>
		    <td colspan="3"><div class="center"><input type="submit" name="user_ready" size="300" value="Я готов к дебатам" /></div></td>
		</tr>   
            ';            
        }elseif ($message['user_id']){
            $currentUser = $message['currentUser'];
            $strTable .= '
        <tr>
		    <td> У Вас на счету: </td>
			<td>
			    '.$currentUser['nextmoney'].' nm 
			</td>
			<td>&nbsp;</td>
		</tr> 
		<tr>
			<td align="left"> Ставка: </td>
			<td nowrap>
			     <input type="text" size=4 name="stake_amount" id="stake_amount" />
			</td>
			<td>
			   <input type="button" name="doStake1" id="doStake1" onclick="doStake(1);" value="Сделать ставку на '.$message['debateUser1']['login'].'" /><br/><br/>
			   <input type="button" name="doStake2" id="doStake2" onclick="doStake(2);" value="Сделать ставку на '.$message['debateUser2']['login'].'" />
			</td>
		</tr>  
            ';
            if ($message['aUserStakes']){
                $strTable .= '
                    <tr>
            			<td align="left"> Ваши ставки: </td>
            			<td colspan = "2">';
                $sum = 0;
                foreach ($message['aUserStakes'] as $userStake){
                    $sum += $userStake['stake_amount'];
                    $strTable .= '<b>'.$userStake['stake_amount'].'</b> nm на ';
                    if ($userStake['debate_user_id'] == $message['debateUser1']['id']) $strTable .= $message['debateUser1']['login'];
                    else $strTable .= $message['debateUser2']['login'];
                    $strTable .= '<br/>';
                }
            	$strTable .= '		     
            			</td>
            		</tr>  
                ';
            	$strTable .= '
                    <tr>
            			<td align="left"> Всего: </td>
            			<td colspan = "2"><b>'.$sum.'</b> nm</td>
            		</tr>';
            }
        }
        $strTable .= '</table></form>'; */
	    $response -> block('centerTable', true, $strTable);
	}
	
	function returnChat($message){
		$response = Project::getAjaxResponse();
		$response -> append('chat_messages', $message['htmlChatText']);
		$response -> append('chat_messages_helpers', $message['htmlChatHelpersText']);
		$response -> append('chat_messages_users', $message['htmlChatUsersText']);
		
		 // hide/show message box for Debate Users
		if ($message['isHelperCanSay'] || $message['userNumber']) $showMessageboxForDebateUsers = true;
		else $showMessageboxForDebateUsers = false;
		
		 // show message box for HELPER when Pause
		 if ($message['isPause'] && !$message['userNumber']){
		     $showMessageboxForDebateUsers = true;
		 }elseif($message['isPause'] && $message['userNumber']){
		     $showMessageboxForDebateUsers = false;
		 }
		 
		
		if ($message['userNumber']){  // hide/show button "helper can say"
		    if ($message['helperSay1'] == 'show') $showHelperSay1 = true;
		    elseif ($message['helperSay1'] == 'hide') $showHelperSay1 = false;
		    
		    if ($message['helperSay2'] == 'show') $showHelperSay2 = true;
		    elseif ($message['helperSay2'] == 'hide') $showHelperSay2 = false;
		    
		    // hide button PAUSE , if already pressed
		    if ($message['hide_pause1']){
		        $response -> hide('pause1'); $showPauseText1=true;
		    }else{
		        $response -> show('pause1'); $showPauseText1=false;
		    }
		    if ($message['hide_pause2']){
		        $response -> hide('pause2'); $showPauseText2=true;
		    }else{
		        $response -> show('pause2'); $showPauseText2=false;
		    }
		    if ($message['isPause']){
		        $showPauseText1=false;
		        $showPauseText2=false;
		        $showHelperSay1 = false;
		        $showHelperSay2 = false;
		        $response -> show('pauseText3');
		    }else{
		        $response -> hide('pauseText3');
		    }
		    
		    if ($showHelperSay1) $response -> show('helperSay1');
    		else $response -> hide('helperSay1');
    		if ($showHelperSay2) $response -> show('helperSay2');
    		else $response -> hide('helperSay2');
		    
		    if ($showPauseText1) $response -> show('pauseText1');
    		else $response -> hide('pauseText1');
    		if ($showPauseText2) $response -> show('pauseText2');
    		else $response -> hide('pauseText2');
		}
		
		if ($message['isPause']){ // PAUSE
	        $response -> show('pauseTitle');
	        $response -> show('pauseDescription');
	        $response -> hide('pauseOffDescription');
	    }else{
	        $response -> hide('pauseTitle');
	        $response -> hide('pauseDescription');
	        $response -> show('pauseOffDescription');
	    }
		
		//  hide/show button vote_for_user in debate
        if (!$message['isUserVoted'] && $message['user_id']){
            $response -> show('vote_for_user_1');
            $response -> show('vote_for_user_2');
        }
        else {
            $response -> hide('vote_for_user_1');
            $response -> hide('vote_for_user_2');
        }
        
        
        if ($showMessageboxForDebateUsers) $response -> show('debate_MessageboxForDebateUsers');
		else $response -> hide('debate_MessageboxForDebateUsers');
		
		
	}
	
	function helperCansay($message){
	    $response = Project::getAjaxResponse();
	    $response->hide($message['elementId']);
	}
	/*
	function test($message){
		$response = Project::getAjaxResponse();
		$response -> block($message['table'].$message['id'], true, $message['text']);
		$response -> attribute($message['table'].$message['id'], "class", $message['text']);
	}
	*/

	/**
     * END AJAX Functions
     *
     */
		
}
?>