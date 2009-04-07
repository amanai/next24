<?php include($this -> _include('../header.tpl.php')); ?>
				<div class="debate-page">
					<ul class="view-filter clearfix">
						<?php include($this -> _include('../tab_panel.tpl.php')); ?>
					</ul>
					<input type="hidden" name="currEtap" id="currEtap" value="VoteTheme" />
					<input type="hidden" name="refreshNow" id="refreshNow" value="0" />	
					<?php $this->showTimer(); ?>				
					<!-- /view-filter -->
					<div class="d-head">
						<div class="title clearfix">
							<div class="stage">Этап <strong>2</strong> из 7. Выбор темы для дебатов</div>
							<div class="time">Осталось <span>30</span> мин. <span>24</span> сек.</div>
						</div>
						<p>Вы можете предложить свою тему для дебатов. Если ваша тема победит, при последующем голосовании вы станете учасником дебатов.</p>
						<p><span class="alert">ВНИМАНИЕ!</span> Если вы уверены, что сможете учавствовать в дебатах, то не стоит отправлять тему на конкурс. Прочитайте сначала <a href="#">правила дебатов</a></p>
					</div>
					<!-- /d-head -->
					<h1><span>Тема дебатов:</span> ?</h1>
					<div class="d-wrap clearfix">
						<div class="d-content"><div class="inn" id="themeDivTable">
							<table class="stat-table questions">
								<thead>
									<tr>
										<th class="main-row">Тема</th>
										<th>Предложил</th>
										<th>Голосов</th>
										<th>Действия</th>
									</tr>
								</thead>
								<tbody>
        						<?php 
        							$i=1;
        							foreach ($this->aThemes as $theme){
            							//if ($i/2 == 1){$tr_id = ""; $i=1;} else {$tr_id = "cmod_tab2"; $i++;}
            							$tr_id = "cmod_tab2";
            							if ($this->user_id && !$this->isVoted && $this->user_id != $theme['user_id']) {$vote = '<a href="javascript: void(0);" onclick="vote_theme('.$theme['debate_theme_id'].', \'theme\');">голосовать</a>';} else $vote='-';
            							echo '
        									<tr id="'.$tr_id.'">
        										<td class="qv"><a href="#">'.$theme['debate_theme_theme'].'</a></td>
        										<td class="av"><a class="avatar-link" href="'.$this->createUrl('User', 'Profile', null, $theme['login']).'"><img src="assets/i/temp/avatar.s.jpg" alt="" class="avatar" /><span class="t">'.$theme['login'].'</span></a></td>
        										<td class="an">'.(int)$theme['debate_theme_votes'].'</td>
        										<td class="act"><i class="big-icon vote-en-icon"></i>'.$vote.'</td>
        									</tr>';
        							} ?>									
								</tbody>
							</table>
							<ul class="short-pages-list">
								<?php //echo $this->debate_pager;  ?>
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
<?php include($this -> _include('../footer.tpl.php')); ?>