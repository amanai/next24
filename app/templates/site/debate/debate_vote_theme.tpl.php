<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
	


<!-- Этап 2 из 7. Идет выбор темы для дебатов. -->
<div class="block_ee1 debati_time"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
	Осталось 30 минут
</div></div></div></div>


<h2>Этап 2 из 7. Идет выбор темы для дебатов.</h2>
Вы можете проголосовать за любую тему из предложенных ниже.
<br /><div id="brok"></div>

<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">

	<div style="text-align: center; margin: 0px -10px;">
	<div style="width: 40%;">
		<table class="questions">
		<tr>
			<td style="text-align: left;"> <b>Тема</b></td>
			<td> <b>Предложил</b></td>
			<td> <b>Голосов</b></td>
			<td> <b>Действия</b></td>
		</tr>
        <?php 
        $i=1;
        foreach ($this->aThemes as $theme){
            if ($i/2 == 1){$tr_id = ""; $i=1;} else {$tr_id = "cmod_tab2"; $i++;}
            if (!$this->isVoted && $this->user_id != $theme['user_id']) {$vote = '<a href="'.$this->createUrl('Debate', 'DebateVote').'/subject:theme/theme_id:'.$theme['debate_theme_id'].'">голосовать</a>';} else $vote='-';
            echo '
        		<tr id="'.$tr_id.'">
        			<td style="text-align: left;">'.$theme['debate_theme_theme'].'</td>
        			<td><a href="'.$this->createUrl('User', 'Profile', null, $theme['login']).'">'.$theme['login'].'</a></td>
        			<td>'.(int)$theme['debate_theme_votes'].'</td>
        			<td>'.$vote.'</td>
        		</tr>
		      ';
        }
        ?>		
		</table>
	</div>
	</div>

	<?php echo $this->debate_pager;  ?>
	
</div></div></div></div>



<!-- /Этап 2 из 7. Идет выбор темы для дебатов. -->








    </div>
</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>