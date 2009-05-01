<?php include($this -> _include('../header.tpl.php')); ?>
				<div class="debate-page">
					<ul class="view-filter clearfix">
						<?php include($this -> _include('../tab_panel.tpl.php')); ?>
					</ul>
					<input type="hidden" name="currEtap" id="currEtap" value="VoteTheme" />
					<input type="hidden" name="refreshNow" id="refreshNow" value="0" />					
					<!-- /view-filter -->
					<div class="d-head">
						<div class="title clearfix">
							<div class="stage">Этап <strong>2</strong> из 7. Выбор темы для дебатов</div>
							<?php $this->showTimer(); ?>
						</div>
						<p>Вы можете предложить свою тему для дебатов. Если ваша тема победит, при последующем голосовании вы станете учасником дебатов.</p>
						<p><span class="alert">ВНИМАНИЕ!</span> Если вы уверены, что сможете учавствовать в дебатах, то не стоит отправлять тему на конкурс. Прочитайте сначала <a href="<?php echo $this->createUrl('Debate', 'DebateRules') ?>">правила дебатов</a></p>
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
            							if ($this->user_id && !$this->isVoted && $this->user_id != $theme['user_id']) {$vote = '<i class="big-icon vote-en-icon"></i><a href="javascript: void(0);" onclick="vote_theme('.$theme['debate_theme_id'].', \'theme\');">голосовать</a>';} 
            							elseif ($this->user_id == $theme['user_id']) $vote='<span class="my-vote"><i class="big-icon vote-my-icon"></i>моя тема</span>';
            							else $vote='<span><i class="big-icon vote-ds-icon"></i>голос принят</span>';
          								$userModel = new UserModel();
										$user_default_avatar = $userModel->getUserAvatar($theme['user_id']);
										$avator_path = ($user_default_avatar['sys_av_id'])?$user_default_avatar['sys_path']:$user_default_avatar['path']; 
	    								if(!$avator_path || $avator_path == 'no.png') $avator_path = $this->image_url.'avatar/no25.jpg';
	    								else $avator_path = $this->image_url.'avatar/'.$avator_path;	  							
            							echo '
        									<tr id="'.$tr_id.'">
        										<td class="qv"><a href="#">'.$theme['debate_theme_theme'].'</a></td>
        										<td class="av"><a class="avatar-link" href="'.$this->createUrl('User', 'Profile', null, $theme['login']).'"><img src="'.$avator_path.'" alt="" class="avatar" style="width:25px;height:25px;" /><span class="t">'.$theme['login'].'</span></a></td>
        										<td class="an">'.(int)$theme['debate_theme_votes'].'</td>
        										<td class="act">'.$vote.'</td>
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