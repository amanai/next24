<?php
class DebateView extends BaseSiteView{
	protected $_dir = 'debate';
	
	public function showUserAvator($userAvator, $imgUrl){
	    echo '<div class="debate_avator">';
	    if ($userAvator){
	       $src = ($userAvator['path'])?$userAvator['path']:$imgUrl.'avator/'.$userAvator['sys_name'];
	       echo '<img src="'.$src.'" />';
	   }else{
	       echo '<img src="'.$imgUrl.'avator/no.png" />';
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
	   echo '
	   <div class="debate_avator">
	   <img src="'.$this -> image_url.'avator/question.png" />
	   </div>
	   <br /><br />	 
	   ';
	}
	
	public function showMessageboxForDebateUsers($userNumber = 0, $isHide = 0){
	    echo '
	    <tr id="debate_MessageboxForDebateUsers">
		    <td colspan="2"> 
		       <textarea id="chat_text" name="chat_text" cols="58" rows="3"></textarea>
			</td>
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
		       <tr><td><div class="center"><textarea id="chat_text_helpers" name="chat_text_helpers" cols="58" rows="1"></textarea></div></td></tr>
    		   <tr><td><div class="center"><input type="button" onclick="javascript:send_message(\'chat_text_helpers\', \'chat_messages_helpers\');" value="Сказать" /></div></td></tr>
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
		       <tr><td><div class="center"><textarea id="chat_text_users" name="chat_text_users" cols="58" rows="1"></textarea></div></td></tr>
    		   <tr><td><div class="center"><input type="button" onclick="javascript:send_message(\'chat_text_users\', \'chat_messages_users\');" value="Сказать" /></div></td></tr>
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