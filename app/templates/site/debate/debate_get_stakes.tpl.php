<?php include($this -> _include('../header.tpl.php')); ?>
				<div class="debate-page"> 
					<ul class="view-filter clearfix"> 
						<?php include($this -> _include('../tab_panel.tpl.php')); ?>
					</ul> 
					<!-- /view-filter --> 
					<div class="d-head"> 
						<input type="hidden" name="currEtap" id="currEtap" value="GetStakes" />
						<input type="hidden" name="refreshNow" id="refreshNow" value="0" />
						<div class="title clearfix"> 
							<div class="stage">Этап <strong>5</strong> из 7. Идет выбор второго участника дебатов</div> 
							<?php $this->showTimer(); ?>
						</div> 
						<p>Вы можете предложить свою тему для дебатов. Если ваша тема победит, при последующем голосовании вы станете учасником дебатов.</p> 
						<p><span class="alert">ВНИМАНИЕ!</span> Если вы уверены, что сможете учавствовать в дебатах, то не стоит отправлять тему на конкурс. Прочитайте сначала <a href="#">правила дебатов</a></p> 
					</div> 
					<?php 
					//if ($this->userNumber && $this->isReady){ 
    				//	echo 'Подождите пока будут сделаны ставки и участники подтвердят свою готовность к дебатам.';
					//}elseif($this->userNumber){
    				//	echo 'Вы должны подтвердить вашу готовность к дебатам в течении отведенного времени в правом верхнем углу.';
					//}else{
    				//	echo 'Вы можете поставить на любого из участников дебатов. Если участник, на которого вы поставили, выиграет – ваша ставка умножается на 1.5
					//			Если участник проиграет то вы полностью теряете ставку.';
					//}
					?>
					<br /><div id="brok"></div>
					<!-- /d-head --> 
					<h1><span>Тема дебатов:</span> <?php echo $this->debateNow['theme']; ?></h1> 
					<div class="d-wrap clearfix"> 
						<div class="d-content">
							<div class="inn"> 					
								<div class="bid" id="centerTable">
									<form action="" method="post" name="stakesform">
									<?php if($this->userNumber) { ?>
										<table class="alt"> 
											<tr class="current"> 
												<th>Ставки на Вас:</th> 
												<td class="vl"> 
													<span class="count"><?php echo (int)$this->stakesCount; ?></span> 
												</td> 
											</tr> 
											<tr class="current"> 
												<th>На сумму:</th> 
												<td class="vl"> 
													<span class="nm no-nm"><?php echo $this->stakesSum; ?> nm</span> 
												</td> 
											</tr> 
											<?php if ($this->userNumber && $this->isReady) { ?>
											<?php } elseif ($this->userNumber){ ?>
											<tr class="current last"> 
												<td colspan="2" class="vl vl-center">
												<!--  <input class="ready-button" type="submit" name="user_ready" value="Я готов к дебатам" />  -->
														<input type="hidden" name="user_ready" value="Я готов к дебатам" />
												 <button class="ready-button" onclick="document.stakesform.submit();">Я готов к дебатам</button> 
												</td> 
											</tr>
											<? } ?> 
										</table> 
									<?php } elseif ($this->user_id){ ?>
									<?php $currentUser = $this->currentUser; ?>	
									<?php if ($this->aUserStakes){
                						$sum = 0;
               						  	foreach ($this->aUserStakes as $userStake){
                    						$sum += $userStake['stake_amount'];
                						}
            						} ?>
										<table> 
											<tr class="current"> 
												<th>Текущая ставка:</th> 
												<td class="vl"> 
													<span class="nm"><?=$sum; ?> nm</span> <span class="from">( <a href="#">petrovich</a> )</span> 
												</td> 
											</tr> 
											<tr class="current last"> 
												<th>Всего ставок:</th> 
												<td class="vl"> 
													<span class="count"><?php echo (int)$this->stakesCount; ?></span> 
												</td> 
											</tr> 
											<tr class="place first"> 
												<th> 
													У вас на счету:
												</th> 
												<td class="vl"> 
													<span class="nm no-nm"><?=$currentUser['nextmoney']; ?> nm</span> 
													<?php if($currentUser['nextmoney']==0) {?>
														<span class="alert">У вас не достаточно средств на счету. <a href="#">Пополнить</a></span>
													<? } ?>	 
												</td> 
											</tr> 
											<tr class="place last"> 
												<th> 
													Сделать ставку:
												</th> 
												<td class="vl"> 
													<fieldset> 
														<div class="input-field"><input type="text" value="15" name="stake_amount" id="stake_amount" /> nm</div> 
														<div class="button-field"> 
															<button class="vote-button" id="doStake1" onclick="doStake(1);">Поставить на <strong><?=$this->debateUser1['login']; ?></strong></button> 
															<button class="vote-button" id="doStake2" onclick="doStake(2);">Поставить на <strong><?=$this->debateUser2['login'];?></strong></button> 
													<?php 	//	<input type="button" name="doStake1" id="doStake1" onclick="doStake(1);" value="Сделать ставку на '.$this->debateUser1['login'].'" />
			   												//<input type="button" name="doStake2" id="doStake2" onclick="doStake(2);" value="Сделать ставку на '.$this->debateUser2['login'].'" />
			   												?>
														</div> 
													</fieldset>
												</td> 
											</tr>
											<?php if ($this->aUserStakes){
                							echo '
                    							<tr class="place last">
												<th> 
													Ваши ставки:
												</th> 
            										<td class="vl">';
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
            									</tr>';
            								echo '
                    							<tr class="place last">
            										<th> Всего: </th>
            										<td class="vl"><b>'.$sum.'</b> nm</td>
            									</tr>';
            								} 	?>								
									<? } ?>
										</table>
									</form> 
								</div>			
						</div></div> 
						<!-- /d-content --> 
						<div class="member-info l-side"> 
	  					<?php $this->showUserAvator($this->user1_avatar, $this -> image_url); ?>
							<dl> 
								<dt>Помощники</dt> 
								<?php if ($this->helper1_1){
	       								echo '<dd><a href="'.$this->createUrl('User', 'Profile', null, $this->helper1_1['login']).'">'.$this->helper1_1['login'].'</a></dd>'; 
	   								}else echo '<dd>?</dd>';
	   								if ($this->helper1_2){
	       								echo '<dd><a href="'.$this->createUrl('User', 'Profile', null, $this->helper1_2['login']).'">'.$this->helper1_2['login'].'</a></dd>'; 
	   								}else echo '<dd>?</dd>';
	   							?>
							</dl> 
						</div> 
						<div class="member-info r-side"> 
						<?php $this->showUserAvator($this->user2_avatar, $this -> image_url);?>
						<!-- 
							<div class="avatar"><a href="#"><img src="assets/i/temp/avatar.b.jpg" alt="" /><span class="member-name">fedor</span></a></div> 
							<div class="member-status"><span class="ok">готов</span></div> 
							<ul class="controll clearfix"> 
								<li><a href="#" title="Написать сообщение"><i class="icon mail-icon"></i></a></li> 
								<li><a href="#" title="Статьи"><i class="icon mbook-icon"></i></a></li> 
								<li><a href="#" title="Добавить"><i class="icon adduser-icon"></i></a></li> 
								<li><a href="#" title="Комментарии"><i class="icon mcomm-icon"></i></a></li> 
							</ul>  -->
							<dl> 
								<dt>Помощники</dt> 
	   							<?php 
	   								if ($this->helper2_1){
	       								echo '<dd><a href="'.$this->createUrl('User', 'Profile', null, $this->helper2_1['login']).'">'.$this->helper2_1['login'].'</a></dd>'; 
	   								}else echo '<dd>?</dd>';
	   								if ($this->helper2_2){
	       								echo '<dd><a href="'.$this->createUrl('User', 'Profile', null, $this->helper2_2['login']).'">'.$this->helper2_2['login'].'</a></dd>'; 
	  								}else echo '<dd>?</dd>';
	   							?>								
							</dl> 
						</div> 
					</div> 
					<!-- /d-wrap --> 				
				</div> 
				<!-- /debate-page --> 
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>