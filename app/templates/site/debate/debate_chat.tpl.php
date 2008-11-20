<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
	

<input type="hidden" name="currEtap" id="currEtap" value="Debates" />
<input type="hidden" name="refreshNow" id="refreshNow" value="0" />
<!-- Этап 6 из 7. Дебаты. -->
<div class="block_ee1 debati_time"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
	Осталось минут - <span id="timeLeft"></span>
</div></div></div></div>


<h2>Этап 6 из 7. Дебаты. <?php if ($this->activeEtap['is_pause']) echo "Перерыв." ?> </h2>
<?php 
if ($this->userNumber && $this->isReady){ 
    echo 'Подождите пока будут сделаны ставки и участники подтвердят свою готовность к дебатам.';
}
?>
<?php
if ($this->activeEtap['is_pause']){
    echo 'Дебаты прерваны на перерыв. Во время перерыва в окне дебатов могут оставлять свои сообщения помощники.';
}elseif ($this->userNumber){ // Debate User
	echo 'Вы можете общаться с другим участником дебатов, так также сделать запрос на перерыв на 10 минут. Перерыв будет объявлен только при
подтверждении его другим участником дебатов.';
}elseif($this->userIdFromHelper){ // Helper
    echo 'Вы можете подсказывать своему участнику дебатов как лучше вести линию разговора. По окончании дебатов, участник выставит вам оценку,
поэтому постарайтесь подсказывать по существу.';
}elseif($this->user_id){ // registred User
    echo 'Вы можете общаться в чате с другими пользователями. ВНИМАНИЕ – мат в чате запрещен.
Кроме того, вы можете проголосовать за одного из участников дебатов.';
}else{ // Guest (not registred user)
    echo 'Вы можете только следить за ходом дебатов. Что бы оставлять сообщения нужно зарегистрироваться.';
}
?>

<br /><div id="brok"></div>

<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">

    <div style="text-align: center; margin: 0px -10px;">
	<div style="width: 10%;">
	
	<table class="debate_user">
	<tr>
	   <td valign="top">
	   <div class="block_d_ld2">
	   <h2><?php echo '<a href="'.$this->createUrl('User', 'Profile', null, $this->debateUser1['login']).'">'.$this->debateUser1['login'].'</a>'; ?></h2>
	   <?php 
	   $this->showUserAvator($this->user1_avatar, $this -> image_url);
	   ?>
	   <h2>Помощники</h2>
	   <?php 
	   if ($this->helper1_1){
	       echo '<p><a href="'.$this->createUrl('User', 'Profile', null, $this->helper1_1['login']).'">'.$this->helper1_1['login'].'</a></p>'; 
	   }else echo '<p>&nbsp;</p>';
	   if ($this->helper1_2){
	       echo '<p><a href="'.$this->createUrl('User', 'Profile', null, $this->helper1_2['login']).'">'.$this->helper1_2['login'].'</a></p>'; 
	   }else echo '<p>&nbsp;</p>';
	   ?>
	   <br /><br />
	   <p><input type="button" name="vote_for_user_1" id="vote_for_user_1" onclick="voteForDebateUser(<?php echo $this->debateUser1['id'] ?>);" value="Голосовать за <?php echo $this->debateUser1['login']; ?>" /></p>
	   </div>
	   </td>
	   <td valign="top"> 
	   
         <!-- chat part  -->	   
		<table class="questions">
		<tr>
			<td colspan="3"><div class="center"><b>Тема дебатов: <?php echo $this->debateNow['theme']; ?></b></div></td>
        </tr>
		<tr>
			<td align="left" colspan="3"> <div class="ChatMessagesB" id="chat_messages"></div> </td>
	    </tr>
	    <?php
	    if ($this->activeEtap['is_pause']){ // PAUSE
	        if ($this->userNumber){ // Debate User
	            $this->showHelpersChat();
	            
	        }elseif($this->userIdFromHelper){ // Helper
	            $this->showMessageboxForDebateUsers(0, 0);
	            $this->showHelpersChat();
	            
	        }elseif($this->user_id){ // registred User
    		    $this->showUsersChat();
    		    $this->showUsersChatMessageBox();
    		    
    		}else{ // Guest (not registred user)
    		    $this->showUsersChat();
    		    
    		}
	        // STOP PAUSE
	        
	    }elseif ($this->userNumber){ // Debate User
    		$this->showMessageboxForDebateUsers($this->userNumber, 0);
    		if ($this->user_id == $this->debateUser1['id']){
    		  $this->showAllowSayHelpers($this->helper1_1, $this->helper1_2);
    		}else{
    		  $this->showAllowSayHelpers($this->helper2_1, $this->helper2_2);
    		}
    		$this->showHelpersChat();
    		
		}elseif($this->userIdFromHelper){ // Helper
		    $this->showMessageboxForDebateUsers($this->userNumber, 1);
		    $this->showHelpersChat();
		    
		}elseif($this->user_id){ // registred User
		    $this->showUsersChat();
		    $this->showUsersChatMessageBox();
		    
		}else{ // Guest (not registred user)
		    $this->showUsersChat();
		    
		}
		?>
		
		</table>
		<!-- / chat part  -->
		
	   </td>
	   <td valign="top">
	   <div class="block_d_ld2">
	   <h2><?php echo '<a href="'.$this->createUrl('User', 'Profile', null, $this->debateUser2['login']).'">'.$this->debateUser2['login'].'</a>'; ?></h2>
	   <?php 
	   $this->showUserAvator($this->user2_avatar, $this -> image_url);
	   ?>
	   <h2>Помощники</h2>
	   <?php 
	   if ($this->helper2_1){
	       echo '<p><a href="'.$this->createUrl('User', 'Profile', null, $this->helper2_1['login']).'">'.$this->helper2_1['login'].'</a></p>'; 
	   }else echo '<p>&nbsp;</p>';
	   if ($this->helper2_2){
	       echo '<p><a href="'.$this->createUrl('User', 'Profile', null, $this->helper2_2['login']).'">'.$this->helper2_2['login'].'</a></p>'; 
	   }else echo '<p>&nbsp;</p>';
	   ?>
	   <br /><br />
	   <p><input type="button" name="vote_for_user_2" id="vote_for_user_2" onclick="voteForDebateUser(<?php echo $this->debateUser2['id'] ?>);" value="Голосовать за <?php echo $this->debateUser2['login']; ?>" /></p>
	   </div>
	   </td>
	</tr>
	</table>
	</div></div>

		
</div></div></div></div>



<!-- /Этап 6 из 7. Дебаты. -->








    </div>
</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>