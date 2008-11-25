<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
	

<input type="hidden" name="currEtap" id="currEtap" value="Results" />
<input type="hidden" name="refreshNow" id="refreshNow" value="0" />
<!-- Правила дебатов. -->


<h2>История завершенных дебатов.</h2>


<br /><div id="brok"></div>

<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">

	<div style="text-align: left; margin: 0px -10px;">
	<table  class="questions">
	<tr>
	   <td><b>Время начала</b></td>
	   <td><b>Тема</b></td>
	   <td><b>1-й участник</b><br/>[помощники]</td>
	   <td><b>Количество голосов</b></td>
	   <td><b>2-й участник</b><br/>[помощники]</td>
	   <td><b>Количество голосов</b></td>
	</tr>
	<?php 
	$userModel = new UserModel(); $i=1;
	foreach ($this->aDebateHistory as $debateHistory){
	    if ($i/2 == 1){$tr_id = ""; $i=1;} else {$tr_id = "cmod_tab2"; $i++;}
	    $user1 = $userModel->getUserById($debateHistory['user_id_1']);
	    $user2 = $userModel->getUserById($debateHistory['user_id_2']);
	    $helper1_1 = $userModel->getUserById($debateHistory['helper_id_1_1']);
	    $helper1_2 = $userModel->getUserById($debateHistory['helper_id_1_2']);
	    $helper2_1 = $userModel->getUserById($debateHistory['helper_id_2_1']);
	    $helper2_2 = $userModel->getUserById($debateHistory['helper_id_2_2']);
	    echo '
	    <tr id="'.$tr_id.'">
	       <td>'.$debateHistory['start_time'].'</td>
	       <td>'.$debateHistory['theme'].'</td>
	       <td>
	           <a href="'.$this->createUrl('User', 'Profile', null, $user1['login']).'">'.$user1['login'].'</a><br/>[';
	         if ($helper1_1){
	           echo '<a href="'.$this->createUrl('User', 'Profile', null, $helper1_1['login']).'">'.$helper1_1['login'].'</a>';
	         }
	         if ($helper1_1 && $helper1_2){
	           echo '; ';  
	         }
	         if ($helper1_2){
	           echo '<a href="'.$this->createUrl('User', 'Profile', null, $helper1_2['login']).'">'.$helper1_2['login'].'</a>';
	         }
	         if (!$helper1_1 && !$helper1_2){
	           echo 'без помощников';  
	         }
	    echo '
	       ]
	       </td>
	       <td>'.$debateHistory['user1_vote'].'</td>
	       <td>
	           <a href="'.$this->createUrl('User', 'Profile', null, $user2['login']).'">'.$user2['login'].'</a><br/>[';
	         if ($helper2_1){
	           echo '<a href="'.$this->createUrl('User', 'Profile', null, $helper2_1['login']).'">'.$helper2_1['login'].'</a>';
	         }
	         if ($helper2_1 && $helper2_2){
	           echo '; ';  
	         }
	         if ($helper2_2){
	           echo '<a href="'.$this->createUrl('User', 'Profile', null, $helper2_2['login']).'">'.$helper2_2['login'].'</a>';
	         }
	         if (!$helper2_1 && !$helper2_2){
	           echo 'без помощников';  
	         }
	    echo '
	       ]
	       </td>
	       <td>'.$debateHistory['user2_vote'].'</td>
	    </tr>
	    ';
	}
	?>	
	</table>
	</div>
<?php echo $this->debate_pager;  ?>
</div></div></div></div>


<!-- /Правила дебатов. -->








    </div>
</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>