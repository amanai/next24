<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->

				<div class="debate-page">
					<ul class="view-filter clearfix">
						<?php include($this -> _include('../tab_panel.tpl.php')); ?>
					</ul>
					<!-- /view-filter -->
					<div class="d-head">
						<div class="title clearfix">
							<div class="stage">Этап <strong>1</strong> из 7. Прием тем для дебатов</div>
							<input type="hidden" name="currEtap" id="currEtap" value="GetTheme" />
							<input type="hidden" name="refreshNow" id="refreshNow" value="0" />
							<?php $this->showTimer(); ?>
							<div class="time">Осталось <span>30</span> мин. <span>24</span> сек.</div>
						</div>
						<p>Вы можете предложить свою тему для дебатов. Если ваша тема победит, при последующем голосовании вы станете учасником дебатов.</p>
						<p><span class="alert">ВНИМАНИЕ!</span> Если вы уверены, что сможете учавствовать в дебатах, то не стоит отправлять тему на конкурс. Прочитайте сначала <a href="<?php echo $this->createUrl('Debate', 'DebateRules') ?>">правила дебатов</a></p>
						<?php if ($this->user_id){ ?>
						<form class="add-theme" action="#" method="get"><div class="bg"><div class="bg">
							<table>
								<tr>
									<td class="input-field"><input type="text" name="theme" id="theme" value="Наклацайте название темы, котрую вы хотите предложить в этом поле" /></td>
									<td class="input-button"><input type="button" name="addTheme" onclick="javascript:add_theme('theme');" value="Предожить свою тему" /></td>
								</tr>
							</table>
						</div></div></form>
						<? } ?>						
					</div>
					<!-- /d-head -->
					<h1><span>Тема дебатов:</span> ?</h1>
					<div class="d-wrap clearfix">
						<div class="d-content"><div class="inn">
							<table class="stat-table" id="themeTable">
								<thead>
									<tr>
										<th>Тема</th>
										<th>Предложил</th>
									</tr>
								</thead>
								<tbody>
        						<?php $i=1; foreach ($this->aThemes as $theme){
            						//if ($i/2 == 1){$tr_id = ""; $i=1;} else {$tr_id = "cmod_tab2"; $i++;}
            						$tr_id = "cmod_tab2";
            						if ($this->isAdmin || $this->user_id == $theme['user_id']) {$delTheme = '<a href="'.$this->createUrl('Debate', 'DebateDelTheme').'/theme_id:'.$theme['debate_theme_id'].'" class="red">Удалить</a> ';} else $delTheme='';
           							echo '
        								<tr id="'.$tr_id.'">
        									<td class="qv"><a href="#">'.$delTheme.$theme['debate_theme_theme'].'</a></td>
        									<td class="av"><a class="avatar-link" href="'.$this->createUrl('User', 'Profile', null, $theme['login']).'"><img src="assets/i/temp/avatar.s.jpg" alt="" class="avatar" /><span class="t">'.$theme['login'].'</span></a></td>
        								</tr>';
        						} ?>									
								</tbody>
							</table>
							
							<ul class="short-pages-list">
								<?php echo $this->debate_pager;  ?>
							</ul>
						</div></div>
						<!-- /d-content -->
						<div class="member-info l-side">
							<div class="avatar">
	   							<?php $this->showQuestionAvator(); ?>							
							</div>
						</div>
						<div class="member-info r-side">
							<div class="avatar">
								<?php $this->showQuestionAvator(); ?>
							</div>
						</div>
					</div>
					<!-- /d-wrap -->
					
					
				</div>
				<!-- /debate-page -->
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>