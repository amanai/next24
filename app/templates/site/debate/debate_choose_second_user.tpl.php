<?php include($this -> _include('../header.tpl.php')); ?>
				<div class="debate-page"> 
					<ul class="view-filter clearfix" id="modules-cpanel"> 
						<?php include($this -> _include('../tab_panel.tpl.php')); ?>
					</ul> 
					<input type="hidden" name="currEtap" id="currEtap" value="ChooseSecondUser" />
					<input type="hidden" name="refreshNow" id="refreshNow" value="0" />					
					<!-- /view-filter --> 
					<div class="d-head"> 
						<div class="title clearfix"> 
							<div class="stage">Этап <strong>3</strong> из 7. Идет выбор второго участника дебатов</div> 
							<?php $this->showTimer(); ?> 
						</div> 
						<p>Вы можете предложить свою тему для дебатов. Если ваша тема победит, при последующем голосовании вы станете учасником дебатов.</p> 
						<p><span class="alert">ВНИМАНИЕ!</span> Если вы уверены, что сможете учавствовать в дебатах, то не стоит отправлять тему на конкурс. Прочитайте сначала <a href="<?php echo $this->createUrl('Debate', 'DebateRules') ?>">правила дебатов</a></p> 
					</div> 
					<!-- /d-head --> 
					<h1><span>Тема дебатов:</span> <?php echo $this->debateNow['theme']; ?> Если вы уверены, что сможете учавствовать в дебатах, то не стоит отправлять тему на конкурс.</h1> 
					<div class="d-wrap clearfix" id="brok"> 
						<div class="d-content"><div class="inn"> 
							<div class="bid"> 
								<table> 
									<tr class="current last"> 
										<th>Текущая ставка:</th> 
										<td class="vl"> 
											<span class="nm" id="stakeAmount">			     
											<?php echo $this->debateNow['stake_amount']." nm"; ?></span>
											<span class="from" id="stakeUserInfo"> 
			     							<?php 
			     							if($this->debateUser2){ 
			         							$user2 = $this->debateUser2;
			         							if ($user2['id'] == $this->user_id) {
			             							echo '( это Ваша ставка )';
			         							}else{
			            							echo '( <a href="'.$this->createUrl('User', 'Profile', null, $user2['login']).'">'.$user2['login'].'</a> )'; 
			         							}
			     							} ?>	
			     							</span>										
										</td> 
									</tr> 
									<tr class="place first"> 
										<th>У вас на счету:</th> 
										<td class="vl"> 
											<span class="nm no-nm"> 
				     						<?php
			    								 $currentUser = $this->currentUser;
			     								echo (int)$currentUser['nextmoney']." nm";
			     							?>	
			     							</span>	
			     							<?if(abs($currentUser['nextmoney'])==0) { ?>								
												<span class="alert">У вас не достаточно средств на счету. <a href="#">Пополнить</a></span>
											<? } ?>	 
										</td> 
									</tr> 
									<?php
									if ($this->user_id && $this->debateUser1['id'] != $this->user_id){
										if(!$this->debateNow['stake_amount']) {
		    							echo '
										<tr class="place last" id="stake_btn">
											<th>Сделать ставку:</th>
											<td class="vl"> 
												<form action="#" method="post"><fieldset> 
													<div class="input-field">
														<input type="text" name="stake_amount" id="stake_amount" /> nm
													</div> 
													<div class="button-field"> 
													<!--	<input type="button" name="doStake" id="doStakeBtn" onclick="doStakeSecondUser();" value="Сделать ставку" />  -->
													<button name="doStake" id="doStakeBtn" onclick="doStakeSecondUser();">Поставить</button>
													</div> 
												</fieldset>
												</form> 
											</td> 											
										</tr>';
										}
										else {
											echo '<tr class="place last"> 
												<th></th> 
													<td class="vl"> 
														<div class="status"> 
															<span class="st-ok"><i class="big-icon ok-icon"></i>Ставка сделана!</span> 
														</div> 
													</td> 
												</tr> ';
										}
									}
									?>									
								</table> 
							</div> 
							<!-- /bid --> 
						</div></div> 
						<!-- /d-content --> 
						<div class="member-info l-side"> 
	   						<?php $this->showUserAvator($this->user1_avatar, $this -> image_url, $this->debateUser1['id'], $this->debateUser1['login']); ?>
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