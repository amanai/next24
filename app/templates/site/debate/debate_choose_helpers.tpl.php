<?php include($this -> _include('../header.tpl.php')); ?>
				<div class="debate-page"> 
					<ul class="view-filter clearfix"> 
						<?php include($this -> _include('../tab_panel.tpl.php')); ?>
					</ul> 
					<!-- /view-filter --> 
					<div class="d-head"> 
					<input type="hidden" name="currEtap" id="currEtap" value="ChooseHelpers" />
					<input type="hidden" name="refreshNow" id="refreshNow" value="0" />
						<div class="title clearfix"> 
							<div class="stage">Этап <strong>4</strong> из 7. Выбор помошников</div> 
							<?php $this->showTimer(); ?>
						</div> 
						<p>Вы можете предложить свою тему для дебатов. Если ваша тема победит, при последующем голосовании вы станете учасником дебатов.</p> 
						<p><span class="alert">ВНИМАНИЕ!</span> Если вы уверены, что сможете учавствовать в дебатах, то не стоит отправлять тему на конкурс. Прочитайте сначала <a href="<?php echo $this->createUrl('Debate', 'DebateRules'); ?>">правила дебатов</a></p> 
					</div> 
					
					
					<?php 
				/*		if ($this->isDebateUser){ 
    						echo 'Вам необходимо выбрать себе 2-х помощников. Если вы не выберите себе помощников в течении отведенного времени, то они будут 
									Назначены вам автоматически из числа изъявивших желание пользователей.';
						}else{
    						echo 'Если вы хотите стать помощников одного из участников дебатов нажмите на кнопку «Я хочу быть помощником» с желаемым участником.
							ВНИМАНИЕ. Перед тем, как нажимать на кнопку обязательно ознакомьтесь с обязанностями помощников.';
						} */ ?>
					<br /><div id="brok"></div>		
				
								
					<!-- /d-head --> 
					<h1><span>Тема дебатов:</span> <?php echo $this->debateNow['theme']; ?></h1> 
					<div class="d-wrap clearfix"> 
						<div class="d-content">
						<form name="frmCheckHelper" action="" method="post" id="centerTable">
						<?php if ($this->isDebateUser){ ?>
							<div class="inn clearfix"> 
									<table class="stat-table">
										<thead> 
											<tr> 
												<th class="main-row">Помошник</th> 
												<th>Голосов</th> 
												<th>Действия</th> 
											</tr> 
										</thead>
										<tbody>
										<?php foreach ($this->aDebateUserHelpers as $debateUserHelpers){ 
		        						$tr_id = "cmod_tab2";
										echo '<tr id="'.$tr_id.'"> 
											<td class="av"><a href="'.$this->createUrl('User', 'Profile', null, $debateUserHelpers['login']).'" class="avatar-link"><img src="assets/i/temp/avatar.s.jpg" alt="" class="avatar" /><span class="t">'.$debateUserHelpers['login'].'</span></a></td> 
											<td class="an">'.(int)$debateUserHelpers['rate'].'</td>';
											echo '<td class="act">';
		        							if ($this->isDebateUserCanAddHelpers &&  
		            							$this->debateNow['helper_id_'.$this->userNumber.'_1'] != $debateUserHelpers['helper_id'] && 
		            							$this->debateNow['helper_id_'.$this->userNumber.'_2'] != $debateUserHelpers['helper_id'] ){ // т.е. не был еще выбран
		            								echo '<a href="'.$this->createUrl('Debate', 'Debate').'/check_helper:'.$debateUserHelpers['helper_id'].'"><i class="big-icon vote-en-icon"></i>Выбрать</a>';
		        							}else {
		            							echo '-';
		        							}
		        							echo '</td>';				 
										echo '</tr>';															
										}?>	
									</tbody>
								</table>
						</div>															 						
						<? } elseif ($this->user_id && !$this->helperTable){ ?>
						<div class="inn"> 
								<ul class="helpers"> 
									<li id="helper1tr"><a href="#"><i class="big-icon helpers-icon" id="helper1btn" onclick="wantBeHelper(1);"></i>Я хочу стать помошником <strong><?=$this->debateUser1['login'];?></strong></a></li> 
									<li id="helper2tr"><a href="#"><i class="big-icon helpers-icon" id="helper2dtn" onclick="wantBeHelper(2);"></i>Я хочу стать помошником <strong><?=$this->debateUser2['login'];?></strong></a></li> 
								</ul> 
								<!-- /bid --> 
						</div>
						<? }elseif ($this->helperTable){ ?>						
							<div class="in"> 
								<h2 class="status"><span class="st-ok"><i class="big-icon ok-icon"></i>Вы выбрали быть помощником у <?=$this->helperTable['login'];?></span></h2> 
							</div>
						<? }elseif(!$this->user_id){ ?>
							<div class="in"> 
								<h2 class="status"><span class="st-ok" style="color:red;">Что бы принять участие в дебатах, необходимо <a href="<?=$this->createUrl('User', 'RegistrationForm');?>">зарегистрироваться</a></span></h2> 
							</div>						
						<? } ?>
					<!--  	<ul class="short-pages-list"> 
								<li><a href="#">1</a></li> 
								<li><a href="#">2</a></li> 
								<li><strong>3</strong></li> 
								<li><a href="#">4</a></li> 
							</ul>   -->
							</form>
						</div> 
						<!-- /d-content --> 
						<div class="member-info l-side"> 
	   					<?php $this->showUserAvator($this->user1_avatar, $this -> image_url); ?>
	   					<dl id="helpersList1">
	   						<dt>Помощники</dt> 
	   						<?php if ($this->helper1_1) {?>
	   							<dd><a href="<?=$this->createUrl('User', 'Profile', null, $this->helper1_1['login']); ?>"><?=$this->helper1_1['login']; ?></a></dd> 
	   						<? } else { ?>
	   							<dd>?</dd>
	   						<? } ?>
	   						<?php if ($this->helper1_2){ ?>
	   							<dd><a href="<?=$this->createUrl('User', 'Profile', null, $this->helper1_2['login']);?>"><?=$this->helper1_2['login'];?></a></dd> 
	   						<? } else { ?>
	   							<dd>?</dd>
	   						<? } ?>
	   					</dl>	
	   					<?php 
	   					//<div id="helpersList1">
	   					//	if ($this->helper1_1){
	       				//		echo '<p><a href="'.$this->createUrl('User', 'Profile', null, $this->helper1_1['login']).'">'.$this->helper1_1['login'].'</a></p>'; 
	   					//	}else echo '<p>&nbsp;</p>';
	   					//	if ($this->helper1_2){
	       				//		echo '<p><a href="'.$this->createUrl('User', 'Profile', null, $this->helper1_2['login']).'">'.$this->helper1_2['login'].'</a></p>'; 
	   					//	}else echo '<p>&nbsp;</p>';
	   						//</div>
	   					?>	   					
						</div> 
						<div class="member-info r-side"> 
	   					<?php $this->showUserAvator($this->user2_avatar, $this -> image_url); ?>

	   					<dl id="helpersList2">
	   						<dt>Помощники</dt> 
	   						<?php if ($this->helper2_1) {?>
	   							<dd><a href="<?=$this->createUrl('User', 'Profile', null, $this->helper2_1['login']); ?>"><?=$this->helper2_1['login']; ?></a></dd> 
	   						<? } else { ?>
	   							<dd>?</dd>
	   						<? } ?>
	   						<?php if ($this->helper2_2){ ?>
	   							<dd><a href="<?=$this->createUrl('User', 'Profile', null, $this->helper2_2['login']);?>"><?=$this->helper2_2['login'];?></a></dd> 
	   						<? } else { ?>
	   							<dd>?</dd>
	   						<? } ?>
	   					</dl>		   					   					
	   					<?php 
	   					//<div id="helpersList2">
	   					//	if ($this->helper2_1){
	       				//		echo '<p><a href="'.$this->createUrl('User', 'Profile', null, $this->helper2_1['login']).'">'.$this->helper2_1['login'].'</a></p>'; 
	   					//	}else echo '<p>&nbsp;</p>';
	   					//	if ($this->helper2_2){
	       				//		echo '<p><a href="'.$this->createUrl('User', 'Profile', null, $this->helper2_2['login']).'">'.$this->helper2_2['login'].'</a></p>'; 
	  					//	}else echo '<p>&nbsp;</p>';
	  					//</div>	
	   					?>   						   					
						</div> 
					</div> 
					<!-- /d-wrap --> 				
				</div> 
				<!-- /debate-page --> 
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>