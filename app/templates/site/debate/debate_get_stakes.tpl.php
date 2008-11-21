<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
	

<input type="hidden" name="currEtap" id="currEtap" value="GetStakes" />
<input type="hidden" name="refreshNow" id="refreshNow" value="0" />
<!-- Этап 5 из 7. Подтверждение готовности, прием ставок. -->
<div class="block_ee1 debati_time"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
	Осталось <span id="timeLeft"></span> мин.
</div></div></div></div>


<h2>Этап 5 из 7. Подтверждение готовности, прием ставок.</h2>
<?php 
if ($this->userNumber && $this->isReady){ 
    echo 'Подождите пока будут сделаны ставки и участники подтвердят свою готовность к дебатам.';
}elseif($this->userNumber){
    echo 'Вы должны подтвердить вашу готовность к дебатам в течении отведенного времени в правом верхнем углу.';
}else{
    echo 'Вы можете поставить на любого из участников дебатов. Если участник, на которого вы поставили, выиграет – ваша ставка умножается на 1.5
Если участник проиграет то вы полностью теряете ставку.';
}
?>
<br /><div id="brok"></div>

<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">

    <div style="text-align: center; margin: 0px -10px;">
	<div style="text-align: center;">
	
	<table class="debate_user" align="center">
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
	   
         <!-- center part  -->	   
	    <form name="frmStake" action="" method="POST">
		<table class="questions">
		<tr>
			<td colspan="3"><div class="center"><b>Тема дебатов: <?php echo $this->debateNow['theme']; ?></b></div></td>
        </tr>
		<tr>
			<td align="left"> <?php if($this->userNumber){ echo 'Ставок на Вас:'; } else{ echo 'Всего ставок:';} ?> </td>
			<td>
			     <?php echo (int)$this->stakesCount; ?>
			</td>
			<td>&nbsp;</td>
	    </tr>
		<tr>
		    <td> На сумму: </td>
			<td>
			     <?php echo (int)$this->stakesSum; ?> nm
			</td>
			<td>&nbsp;</td>
		</tr>
		<?php 
        if ($this->userNumber && $this->isReady){

        }elseif ($this->userNumber){
            echo '
        <tr>
		    <td colspan="3"><input type="submit" name="user_ready" size="300" value="Я готов к дебатам" /></td>
		</tr>   
            ';            
        }else{
            $currentUser = $this->currentUser;
            echo '
        <tr>
		    <td> У Вас на счету: </td>
			<td>
			    '.(int)$currentUser['nextmoney'].' nm 
			</td>
			<td>&nbsp;</td>
		</tr> 
		<tr>
			<td align="left"> Ставка: </td>
			<td nowrap>
			     <input type="text" size=4 name="stake_amount" />
			</td>
			<td>
			   <input type="submit" name="doStake1" value="Сделать ставку на '.$this->debateUser1['login'].'" /><br/><br/>
			   <input type="submit" name="doStake2" value="Сделать ставку на '.$this->debateUser2['login'].'" />
			</td>
		</tr>  
            ';
            if ($this->aUserStakes){
                echo '
                    <tr>
            			<td align="left"> Ваши ставки: </td>
            			<td colspan = "2">';
                $sum = 0;
                foreach ($this->aUserStakes as $userStake){
                    $sum += $userStake['stake_amount'];
                    echo '<b>'.$userStake['stake_amount'].'</b> nm на ';
                    if ($userStake['debate_user_id'] == $this->debateUser1['id']) echo $this->debateUser1['login'];
                    else echo $this->debateUser2['login'];
                    echo '<br/>';
                }
            	echo '		     
            			</td>
            		</tr>  
                ';
            	echo '
                    <tr>
            			<td align="left"> Всего: </td>
            			<td colspan = "2"><b>'.$sum.'</b> nm</td>
            		</tr>';
            }
        }
        ?>

		</table>
		</form>
		<!-- / center part  -->
		
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



<!-- /Этап 5 из 7. Подтверждение готовности, прием ставок. -->








    </div>
</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>