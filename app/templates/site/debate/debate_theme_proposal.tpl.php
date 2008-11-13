<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
	


<!-- Этап 1 из 7. Идет прием тем для дебатов. -->
<div class="block_ee1 debati_time"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
	Осталось 30 минут
</div></div></div></div>


<h2>Этап 1 из 7. Идет прием тем для дебатов.</h2>
Вы можете свою тему для дебатов. Если ваша тема победит при последующем голосовании вы станете участником дебатов.
ВНИМАНИЕ. Если вы не уверены, что сможете участвовать в дебатах то не отправляйте тему на конкурс. Прочитайте сначала <a href="#">правила дебатов</a>.
<br /><div id="brok"></div>

<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">

	<div style="text-align: center; margin: 0px -10px;">
	<div style="width: 40%;">
		<table class="questions">
		<tr>
			<td style="text-align: left;"> <b>Тема</b></td>
			<td> <b>Предложил</b></td>
		</tr>
        <?php 
        $i=1;
        foreach ($this->aThemes as $theme){
            if ($i/2 == 1){$tr_id = ""; $i=1;} else {$tr_id = "cmod_tab2"; $i++;}
            if ($this->isAdmin || $this->user_id == $theme['user_id']) {$delTheme = '<a href="'.$this->createUrl('Debate', 'DebateDelTheme').'/theme_id:'.$theme['debate_theme_id'].'" class="red">Удалить</a> ';} else $delTheme='';
            echo '
        		<tr id="'.$tr_id.'">
        			<td style="text-align: left;">'.$delTheme.$theme['debate_theme_theme'].'</td>
        			<td><a href="'.$this->createUrl('User', 'Profile', null, $theme['login']).'">'.$theme['login'].'</a></td>
        		</tr>
		      ';
        }
        ?>		
		</table>
	</div>
	</div>

	<?php echo $this->debate_pager;  ?>
	
</div></div></div></div>


<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
	<div class="block_title"><h2>Новая тема</h2></div>
	<!-- Новая тема -->
	<div>
		<form action="" name="frmAddTheme">
			<table width="100%">
			<tr>
				<td width="100%"><input type="text" name="theme" style="width: 100%;" /></td>
				<td><input type="submit" name="addTheme" value="Предложить" /></td>
			</tr>
			</table>
		</form>
	</div>
	<!-- /Новая тема -->
</div></div></div></div>
<!-- /Этап 1 из 7. Идет прием тем для дебатов. -->








    </div>
</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>