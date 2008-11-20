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
			<td align="left" colspan="3"> <div class="ChatMessagesB_helpers" id="chat_messages_helpers"></div> </td>
	    </tr>
	    <tr>
		    <td colspan="2"> 
		       <textarea id="chat_text_helpers" name="chat_text_helpers" cols="58" rows="1"></textarea>
			</td>
			<td>
			   <input type="button" onclick="javascript:send_message(\'chat_text_helpers\', \'chat_messages_helpers\');" value="Сказать" />
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
			<td align="left" colspan="3"> <div class="ChatMessagesB_helpers" id="chat_messages_users"></div> </td>
	    </tr>
	    ';
	}
	
	public function showUsersChatMessageBox(){
	    echo '
	    <tr>
		    <td colspan="2"> 
		       <textarea id="chat_text_users" name="chat_text_users" cols="58" rows="1"></textarea>
			</td>
			<td>
			   <input type="button" onclick="javascript:send_message(\'chat_text_users\', \'chat_messages_users\');" value="Сказать" />
			</td>
		</tr>
	    ';
	}
	
	public function showWinnerHelpersName($winnerHelper1, $winnerHelper2, $user_id){
	    $helpersName = '';
	    if ($winnerHelper1['id']){
	        $helpersName .= '<a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $winnerHelper1['login']).'">';
    	    if ($winnerHelper1['id'] == $user_id) $helpersName .= 'Вы';
    	    else $helpersName .= $winnerHelper1['login'];
    	    $helpersName .= '</a>';
	    }
	    if ($winnerHelper1['id'] && $winnerHelper2['id']) $helpersName .= ' и ';
	    if ($winnerHelper2['id']){
	        $helpersName .= '<a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $winnerHelper2['login']).'">';
    	    if ($winnerHelper2['id'] == $user_id) $helpersName .= 'Вы';
    	    else $helpersName .= $winnerHelper2['login'];
    	    $helpersName .= '</a>';
	    }
	    
	    return $helpersName;
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
	    $response -> block("timeLeft",  true, $message['etapTimeLeftMin']);
	    if ($message['refreshNow']) $response -> attribute("refreshNow", "value", 1);
	}
	
	function returnChat($message){
		$response = Project::getAjaxResponse();
		$response -> append('chat_messages', $message['htmlChatText']);
		$response -> append('chat_messages_helpers', $message['htmlChatHelpersText']);
		$response -> append('chat_messages_users', $message['htmlChatUsersText']);
		
		 // hide/show message box for Debate Users
		if ($message['isHelperCanSay'] || $message['userNumber']) $response -> show('debate_MessageboxForDebateUsers');
		else $response -> hide('debate_MessageboxForDebateUsers');
		
		 // show message box for HELPER when Pause
		 if ($message['isPause'] && !$message['userNumber']) $response -> show('debate_MessageboxForDebateUsers');
		
		if ($message['userNumber']){  // hide/show button "helper can say"
		    if ($message['helperSay1'] == 'show') $response -> show('helperSay1');
		    elseif ($message['helperSay1'] == 'hide') $response -> hide('helperSay1');
		    
		    if ($message['helperSay2'] == 'show') $response -> show('helperSay2');
		    elseif ($message['helperSay2'] == 'hide') $response -> hide('helperSay2');
		    
		    // hide button PAUSE , if already pressed
		    /*
		    if (isset($message['hide_pause']) && $message['hide_pause']){
		        $response -> hide('pause'.$message['userNumber']);
		        $response -> show('pauseText'.$message['userNumber']);
		    }else{
		        $response -> show('pause'.$message['userNumber']);
		        $response -> hide('pauseText'.$message['userNumber']);
		    }
		    */
		    if ($message['hide_pause1']){
		        $response -> hide('pause1'); $response -> show('pauseText1');
		    }else{
		        $response -> show('pause1'); $response -> hide('pauseText1');
		    }
		    if ($message['hide_pause2']){
		        $response -> hide('pause2'); $response -> show('pauseText2');
		    }else{
		        $response -> show('pause2'); $response -> hide('pauseText2');
		    }
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