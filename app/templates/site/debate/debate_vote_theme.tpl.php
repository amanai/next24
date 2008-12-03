<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
	

<input type="hidden" name="currEtap" id="currEtap" value="VoteTheme" />
<input type="hidden" name="refreshNow" id="refreshNow" value="0" />
<!-- Этап 2 из 7. Идет выбор темы для дебатов. -->
<?php $this->showTimer(); ?>


<h2>Этап 2 из 7. Идет выбор темы для дебатов.</h2>
Вы можете проголосовать за любую тему из предложенных ниже.
<br /><div id="brok"></div>

<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">

	<div style="text-align: center; margin: 0px -10px;">
	<div style="text-align: center;">
	
	<table class="debate_user" align="center">
	<tr>
	   <td valign="top">
	   <div class="block_d_ld2">
	   <?php 
	   $this->showQuestionAvator();
	   ?>
	   </div>
	   </td>
	   <td valign="top"> 
	   
	   
	   <!-- center part -->
	   <div id="themeDivTable">
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
            //if ($i/2 == 1){$tr_id = ""; $i=1;} else {$tr_id = "cmod_tab2"; $i++;}
            $tr_id = "cmod_tab2";
            if ($this->user_id && !$this->isVoted && $this->user_id != $theme['user_id']) {$vote = '<a href="javascript: void(0);" onclick="vote_theme('.$theme['debate_theme_id'].', \'theme\');">голосовать</a>';} else $vote='-';
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
	   
	</div>
	</div>

	<?php //echo $this->debate_pager;  ?>
	
</div></div></div></div>



<!-- /Этап 2 из 7. Идет выбор темы для дебатов. -->








    </div>
</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>