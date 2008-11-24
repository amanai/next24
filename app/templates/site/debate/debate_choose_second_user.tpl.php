<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
	

<input type="hidden" name="currEtap" id="currEtap" value="ChooseSecondUser" />
<input type="hidden" name="refreshNow" id="refreshNow" value="0" />
<!-- Этап 3 из 7. Идет выбор второго участника дебатов. -->
<div class="block_ee1 debati_time"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
	Осталось <span id="timeLeft"></span> мин.
</div></div></div></div>


<h2>Этап 3 из 7. Идет выбор второго участника дебатов.</h2>
Если вы хотите стать вторым участником дебатов, вы должны перебить максимальную ставку. Если вы проиграете дебаты – ваша ставка 
не возвращается.
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
	   </div>
	   </td>
	   <td valign="top" width="50%"> 
	   
	   
	   <!-- center part -->
	
	    <form name="frmStake" action="" method="POST">
		<table class="questions">
		<tr>
			<td align="left" colspan="3"> <div class="center"><b>Тема дебатов: <?php echo $this->debateNow['theme']; ?></b></div></td>
            </tr>
		<tr>
			<td align="left"> Текущая ставка: </td>
			<td>
			     <?php 
			     echo $this->debateNow['stake_amount']." nm"; 
			     ?>
			</td>
			<td>
			     <?php 
			     if($this->debateUser2){ 
			         $user2 = $this->debateUser2;
			         if ($user2['id'] == $this->user_id) {
			             echo '(это Ваша ставка)';
			         }else{
			             echo '(поставил '.'<a href="'.$this->createUrl('User', 'Profile', null, $user2['login']).'">'.$user2['login'].'</a>)'; 
			         }
			     } 
			     ?>
			</td>
		</tr>
		<tr>
			<td align="left"> У Вас на счету: </td>
			<td>
			     <?php 
			     $currentUser = $this->currentUser;
			     echo (int)$currentUser['nextmoney']." nm"; 
			     ?>
			</td>
			<td>&nbsp;</td>
		</tr>
		<?php 
		if ($this->debateUser1['id'] != $this->user_id && $this->debateUser2['id'] != $this->user_id){
		    echo '
		<tr>
			<td align="left"> &nbsp;</td>
			<td nowrap>
			     <input type="text" size=4 name="stake_amount" />
			</td>
			<td><input type="submit" name="doStake" value="Сделать ставку" /></td>
		</tr>
		      ';
		}    
		?>
        
		</table>
		</form>
	   <!-- / center part -->
	   
	   </td>
	   <td valign="top">
	   <div class="block_d_ld2">
	   <?php 
	   $this->showQuestionAvator();
	   ?>
	   </div>
	   </td>
	</tr>
	</table>
	   
		
	</div></div>

		
</div></div></div></div>



<!-- /Этап 3 из 7. Идет выбор второго участника дебатов. -->








    </div>
</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>