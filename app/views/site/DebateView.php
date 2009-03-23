<?php
class DebateView extends BaseSiteView{
	protected $_dir = 'debate';
	
	public function showUserAvator($userAvator, $imgUrl){

	    echo '<div class="debate_avator">';
	    if ($userAvator){
	       $src = ($userAvator['path'])?$imgUrl.'avatar/'.$userAvator['path']:$imgUrl.'avatar/'.$userAvator['sys_path'];
	       echo '<img src="'.$src.'" />';
	   }else{
	       echo '<img src="'.$imgUrl.'avatar/no.png" />';
	   }
	   echo '
	   </div>
	   <div class="block_d_ld_icons">
			<a href="#"><img height="16" width="16" src="'.$this -> image_url.'d_ld_ico1.png"/></a>
			<a href="#"><img height="16" width="16" src="'.$this -> image_url.'d_ld_ico2.png"/></a>
			<a href="#"><img height="16" width="16" src="'.$this -> image_url.'d_ld_ico3.png"/></a>
	   </div>
	   <br /><br />	 
	   ';
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
	    echo '
	    <div class="debati_time">
	       Осталось <span id="timeLeft" class=""></span>
        </div>';
	}
	

    /**
     * Pages VIEW
     *
     */
    // etap 1
    function DebateThemeProposalPage(){
	    $this->_js_files[] = 'jquery.js';
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'debate.js';
	    $this->_css_files[]='debate.css';
	    $this -> setTemplate(null, 'debate_theme_proposal.tpl.php');
	}
	
	// etap 2
	function DebateVoteThemePage(){
	    $this->_js_files[] = 'jquery.js';
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'debate.js';
	    $this->_css_files[]='debate.css';
	    $this -> setTemplate(null, 'debate_vote_theme.tpl.php');
	}
	
	// etap 3
	function DebateChooseSecondUserPage(){
	    $this->_js_files[] = 'jquery.js';
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'debate.js';
	    $this->_css_files[]='debate.css';
	    $this -> setTemplate(null, 'debate_choose_second_user.tpl.php');
	}
	
	// etap 4
	function DebateChooseHelpersPage(){
	    $this->_js_files[] = 'jquery.js';
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'debate.js';
	    $this->_css_files[]='debate.css';
	    $this -> setTemplate(null, 'debate_choose_helpers.tpl.php');
	}
	
	// etap 5
	function DebateGetStakesPage(){
	    $this->_js_files[] = 'jquery.js';
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'debate.js';
	    $this->_css_files[]='debate.css';
	    $this -> setTemplate(null, 'debate_get_stakes.tpl.php');
	}
	
	// etap 6
	function DebatePage(){
	    $this->_js_files[] = 'jquery.js';
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'debate.js';
	    $this->_css_files[]='debate.css';
	    $this -> setTemplate(null, 'debate_chat.tpl.php');
	}
	
	// etap 7
	function ResultsPage(){
	    $this->_js_files[] = 'jquery.js';
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'debate.js';
	    $this->_css_files[]='debate.css';
	    $this -> setTemplate(null, 'debate_result.tpl.php');
	}
	
	
	function RulesPage(){
	    //$this->_js_files[] = 'debate.js';
	    $this->_css_files[]='debate.css';
	    $this -> setTemplate(null, 'debate_rules.tpl.php');
	}
	
	function HistoryPage(){
	    //$this->_js_files[] = 'debate.js';
	    $this->_css_files[]='debate.css';
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
        
        foreach ($aNewThemes as $newTheme){
            if ($message['isAdmin'] || $message['user_id'] == $newTheme['user_id']) {$delTheme = '<a href="'.Project::getRequest()->createUrl('Debate', 'DebateDelTheme').'/theme_id:'.$newTheme['debate_theme_id'].'" class="red">Удалить</a> ';} else $delTheme='';
            $strTr = '
                <tr id="cmod_tab2">
        			<td style="text-align: left;">'.$delTheme.$newTheme['debate_theme_theme'].'</td>
        			<td><a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $newTheme['login']).'">'.$newTheme['login'].'</a></td>
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
        
        $strTable = '
        <table class="questions">
		<tr>
			<td style="text-align: left;"> <b>Тема</b></td>
			<td> <b>Предложил</b></td>
			<td> <b>Голосов</b></td>
			<td> <b>Действия</b></td>
		</tr>
        ';
        foreach ($aThemes as $theme){
            if ($message['user_id'] && !$isVoted && $message['user_id'] != $theme['user_id']){
                $vote = '<a href="javascript: void(0);" onclick="vote_theme('.$theme['debate_theme_id'].', \'theme\');">голосовать</a>';
            } 
            else $vote='-';
            $strTable .= '
        		<tr id="cmod_tab2">
        			<td style="text-align: left;">'.$theme['debate_theme_theme'].'</td>
        			<td><a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $theme['login']).'">'.$theme['login'].'</a></td>
        			<td>'.(int)$theme['debate_theme_votes'].'</td>
        			<td>'.$vote.'</td>
        		</tr>
		      ';
        }
        $strTable .= '</table>';
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
        $response -> block('stakeUserInfo', true, $strTable);
        $response -> block('stakeAmount', true, $message['stake_amount'].' nm');
	}
	
	function returnChooseHelpers($message){
	    $response = Project::getAjaxResponse();
	    $helperTable = $message['helperTable'];
	    
	    $isDebateUser = $message['isDebateUser'];
	    $strTable = '<table  class="questions">';
		if ($isDebateUser){
		    $strTable .= '
		      <tr>
		          <td><b>Помощник</b></td>
		          <td><b>Рейтинг</b></td>
		          <td><b>Действия</b></td>
		      </tr>
		    ';
		    foreach ($message['aDebateUserHelpers'] as $debateUserHelpers){
		        $tr_id = "cmod_tab2";
		        $strTable .= '
		      <tr id="'.$tr_id.'">
		          <td><a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $debateUserHelpers['login']).'">'.$debateUserHelpers['login'].'</a></td>
		          <td>'.(int)$debateUserHelpers['rate'].'</td>
		          <td>';
		        if ($message['isDebateUserCanAddHelpers'] &&  
		            $message['debateNow']['helper_id_'.$message['userNumber'].'_1'] != $debateUserHelpers['helper_id'] && 
		            $message['debateNow']['helper_id_'.$message['userNumber'].'_2'] != $debateUserHelpers['helper_id'] ){ // т.е. не был еще выбран
		            $strTable .= '<a href="'.Project::getRequest()->createUrl('Debate', 'Debate').'/check_helper:'.$debateUserHelpers['helper_id'].'">выбрать</a>';
		        }else {
		            $strTable .= '-';
		        }
		        $strTable .= '
		          </td>
		      </tr>
		          ';
		    }
		}elseif ($message['user_id'] && !$helperTable){
		    $strTable .= '
    		<tr id="helper1tr">
    			<td colspan="2"><div class="center"><input type="button" size=250 id="helper1btn" name="helper1" onclick="wantBeHelper(1);" value="Я хочу быть помощником участника '.$message['debateUser1']['login'].'" /></div></td>
    		</tr><tr id="helper2tr">
    			<td colspan="2"><div class="center"><input type="button" size=250 id="helper2dtn" name="helper2" onclick="wantBeHelper(2);" value="Я хочу быть помощником участника '.$message['debateUser2']['login'].'" /></div></td>
    		</tr>
		    ';
		}elseif ($helperTable){
		    $strTable .= '
		    <tr>
    			<td colspan="2"><div class="center" id=>Вы выбрали быть помощником у '.$helperTable['login'].'</div></td>
    		</tr>
		    ';
		}elseif(!$message['user_id']){
		    $strTable .= '
		    <tr>
    			<td colspan="2"><div class="center">Что бы принять участие в дебатах, необходимо зарегистрироваться</div></td>
    		</tr>
    		
		    ';
		}
		$strTable .= '</table>';
		$response -> block('centerTable', true, $strTable);

		$strHelpersList = '';
		if ($message['helper1_1']){
		    $strHelpersList .= '<p><a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $message['helper1_1']['login']).'">'.$message['helper1_1']['login'].'</a></p>';
		}else $strHelpersList .= '<p>&nbsp;</p>';
		if ($message['helper1_2']){
		    $strHelpersList .= '<p><a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $message['helper1_2']['login']).'">'.$message['helper1_2']['login'].'</a></p>';
		}else $strHelpersList .= '<p>&nbsp;</p>';
		$response -> block('helpersList1', true, $strHelpersList);
		
		$strHelpersList = '';
		if ($message['helper2_1']){
		    $strHelpersList .= '<p><a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $message['helper2_1']['login']).'">'.$message['helper2_1']['login'].'</a></p>';
		}else $strHelpersList .= '<p>&nbsp;</p>';
		if ($message['helper2_2']){
		    $strHelpersList .= '<p><a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $message['helper2_2']['login']).'">'.$message['helper2_2']['login'].'</a></p>';
		}else $strHelpersList .= '<p>&nbsp;</p>';
		$response -> block('helpersList2', true, $strHelpersList);
	}
	
	
	function returnDoStakePage($message){
	    $response = Project::getAjaxResponse();
	    
	    if($message['userNumber']){ $strTemp = 'Ставок на Вас:'; } else{ $strTemp = 'Всего ставок:';}
	    $strTable = '
	    <form action="" method="POST">
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
        $strTable .= '</table></form>';
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