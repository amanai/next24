<?php include($this -> _include('../header.tpl.php')); ?>
				<div class="debate-page"> 
					<ul class="view-filter clearfix" id="modules-cpanel"> 
						<?php include($this -> _include('../tab_panel.tpl.php')); ?>
					</ul> 
					<input type="hidden" name="currEtap" id="currEtap" value="ChooseSecondUser" />
					<input type="hidden" name="refreshNow" id="refreshNow" value="0" />
					<?php $this->showTimer(); ?>					
					<!-- /view-filter --> 
					<div class="d-head"> 
						<div class="title clearfix"> 
							<div class="stage">Этап <strong>3</strong> из 7. Идет выбор второго участника дебатов</div> 
							<div class="time">Осталось <span>30</span> мин. <span>24</span> сек.</div> 
						</div> 
						<p>Вы можете предложить свою тему для дебатов. Если ваша тема победит, при последующем голосовании вы станете учасником дебатов.</p> 
						<p><span class="alert">ВНИМАНИЕ!</span> Если вы уверены, что сможете учавствовать в дебатах, то не стоит отправлять тему на конкурс. Прочитайте сначала <a href="#">правила дебатов</a></p> 
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
											<span class="alert">У вас не достаточно средств на счету. <a href="#">Пополнить</a></span> 
										</td> 
									</tr> 
									<?php
									if ($this->user_id && $this->debateUser1['id'] != $this->user_id){
		    							echo '
										<tr class="place last">
											<th>Сделать ставку:</th>
											<td class="vl"> 
												<form action="#" method="post"><fieldset> 
													<div class="input-field">
														<input type="text" name="stake_amount" id="stake_amount" /> nm
													</div> 
													<div class="button-field"> 
														<input type="button" name="doStake" id="doStakeBtn" onclick="doStakeSecondUser();" value="Сделать ставку" />
													<!--	<button name="doStake" id="doStakeBtn" onclick="doStakeSecondUser();">Поставить</button> 	-->
													</div> 
												</fieldset>
												</form> 
											</td> 											
										</tr>';
									}?>									
								</table> 
							</div> 
							<!-- /bid --> 
						</div></div> 
						<!-- /d-content --> 
						<div class="member-info l-side"> 
							<div class="avatar">
								<a href="<?=$this->createUrl('User', 'Profile', null, $this->debateUser1['login']);?>">
	   								<?php $this->showUserAvator($this->user1_avatar, $this -> image_url); ?>
									<span class="member-name"><?=$this->debateUser1['login']; ?></span>
								</a>
							</div> 
							<ul class="controll clearfix"> 
								<li><a href="#" title="Написать сообщение"><i class="icon mail-icon"></i></a></li> 
								<li><a href="#" title="Статьи"><i class="icon mbook-icon"></i></a></li> 
								<li><a href="#" title="Добавить"><i class="icon adduser-icon"></i></a></li> 
								<li><a href="#" title="Комментарии"><i class="icon mcomm-icon"></i></a></li> 
							</ul> 
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
 
 
 
 
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
	

<input type="hidden" name="currEtap" id="currEtap" value="ChooseSecondUser" />
<input type="hidden" name="refreshNow" id="refreshNow" value="0" />
<!-- Этап 3 из 7. Идет выбор второго участника дебатов. -->
<?php $this->showTimer(); ?>


<h2>Этап 3 из 7. Идет выбор второго участника дебатов.</h2>
Если вы хотите стать вторым участником дебатов, вы должны перебить максимальную ставку. Если вы проиграете дебаты – ваша ставка 
не возвращается.
<br /><div id="brok"></div>

<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">

    <div style="text-align: center; margin: 0px -10px;">
	<div style="text-align: center;">
	<table class="debate_user" align="center">
	<tr>
	   <td valign="top">
	   <div class="block_d_ld2">
	   <h2><?php echo '<a href="'.$this->createUrl('User', 'Profile', null, $this->debateUser1['login']).'">'.$this->debateUser1['login'].'</a>'; ?></h2>
	   <?php 
	   $this->showUserAvator($this->user1_avatar, $this -> image_url);
	   ?>
	   </div>
	   </td>
	   <td valign="top"> 
	   
	   
	   <!-- center part -->
	
	    
		<table class="questions">
		<tr>
			<td align="left" colspan="3"> <div class="center width_400"><b>Тема дебатов: <?php echo $this->debateNow['theme']; ?></b></div></td>
            </tr>
		<tr>
			<td align="left"> Текущая ставка: </td>
			<td>
			     <span id="stakeAmount">
			     <?php 
			     echo $this->debateNow['stake_amount']." nm"; 
			     ?>
			     </span>
			</td>
			<td>
			     <span id="stakeUserInfo">
			     <?php 
			     if($this->debateUser2){ 
			         $user2 = $this->debateUser2;
			         if ($user2['id'] == $this->user_id) {
			             echo '(это Ваша ставка)';
			         }else{
			             echo '(поставил '.'<a href="'.$this->createUrl('User', 'Profile', null, $user2['login']).'">'.$user2['login'].'</a>)'; 
			         }
			     } 
			     ?>
			     </span>
			</td>
		</tr>
		<tr>
			<td align="left"> У Вас на счету: </td>
			<td>
			     <?php
			     $currentUser = $this->currentUser;
			     echo (int)$currentUser['nextmoney']." nm";
			     ?>
			</td>
			<td>&nbsp;</td>
		</tr>
		<?php
		if ($this->user_id && $this->debateUser1['id'] != $this->user_id){
		    echo '
		<tr>
			<td align="left"> &nbsp;</td>
			<td nowrap>
			     <input type="text" size=4 name="stake_amount" id="stake_amount" />
			</td>
			<td><input type="button" name="doStake" id="doStakeBtn" onclick="doStakeSecondUser();" value="Сделать ставку" /></td>
		</tr>
		      ';
		}
		?>
        
		</table>

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
	   
		
	</div></div>

		
</div></div></div></div>



<!-- /Этап 3 из 7. Идет выбор второго участника дебатов. -->








    </div>
</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>