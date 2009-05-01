<?php include($this -> _include('../header.tpl.php')); ?>
				<div class="debate-page"> 
					<ul class="view-filter clearfix"> 
						<li><strong>Активные дебаты<span></span></strong></li> 
						<li><a href="#">Завершенные дебаты</a></li> 
						<li class="alt"><a href="#">Победители</a></li> 
					</ul> 
					<!-- /view-filter --> 
					<div class="d-head"> 
						<div class="title clearfix"> 
							<div class="stage">Этап <strong>5</strong> из 7. Идет выбор второго участника дебатов</div> 
							<div class="time">Осталось <span>30</span> мин. <span>24</span> сек.</div> 
						</div> 
						<p>Вы можете предложить свою тему для дебатов. Если ваша тема победит, при последующем голосовании вы станете учасником дебатов.</p> 
						<p><span class="alert">ВНИМАНИЕ!</span> Если вы уверены, что сможете учавствовать в дебатах, то не стоит отправлять тему на конкурс. Прочитайте сначала <a href="<?php echo $this->createUrl('Debate', 'DebateRules') ?>">правила дебатов</a></p> 
					</div> 
					<!-- /d-head --> 
					<h1><span>Тема дебатов:</span> Есть ли жизнь на марсе?</h1> 
					<div class="d-wrap clearfix"> 
						<div class="d-content"><div class="inn"> 
							<div class="bid"> 
								<table> 
									<tr class="current"> 
										<th>Текущая ставка:</th> 
										<td class="vl"> 
											<span class="nm">20 nm</span> <span class="from">( <a href="#">petrovich</a> )</span> 
										</td> 
									</tr> 
									<tr class="current last"> 
										<th>Всего ставок:</th> 
										<td class="vl"> 
											<span class="count">422</span> 
										</td> 
									</tr> 
									<tr class="place first"> 
										<th> 
											У вас на счету:
										</th> 
										<td class="vl"> 
											<span class="nm no-nm">15 nm</span> 
											<span class="alert">У вас не достаточно средств на счету. <a href="#">Пополнить</a></span> 
										</td> 
									</tr> 
									<tr class="place last"> 
										<th> 
											Сделать ставку:
										</th> 
										<td class="vl"> 
											<form action="#" method="post"><fieldset> 
												<div class="input-field"><input type="text" value="15" /> nm</div> 
												<div class="button-field"> 
													<button class="vote-button">Поставить на <strong>madvic</strong></button> 
													<button class="vote-button">Поставить на <strong>fedor</strong></button> 
												</div> 
											</fieldset></form> 
										</td> 
									</tr> 
								</table> 
							</div> 
							<!-- /bid --> 
						</div></div> 
						<!-- /d-content --> 
						<div class="member-info l-side"> 
							<div class="avatar"><a href="#"><img src="assets/i/temp/avatar.b.jpg" alt="" /><span class="member-name">madvic</span></a></div> 
							<div class="member-status"><span class="no">не готов</span></div> 
							<ul class="controll clearfix"> 
								<li><a href="#" title="Написать сообщение"><i class="icon mail-icon"></i></a></li> 
								<li><a href="#" title="Статьи"><i class="icon mbook-icon"></i></a></li> 
								<li><a href="#" title="Добавить"><i class="icon adduser-icon"></i></a></li> 
								<li><a href="#" title="Комментарии"><i class="icon mcomm-icon"></i></a></li> 
							</ul> 
							<dl> 
								<dt>Помощники</dt> 
								<dd><a href="#">fedor</a></dd> 
								<dd><a href="#">madvic</a></dd> 
							</dl> 
						</div> 
						<div class="member-info r-side"> 
							<div class="avatar"><a href="#"><img src="assets/i/temp/avatar.b.jpg" alt="" /><span class="member-name">fedor</span></a></div> 
							<div class="member-status"><span class="ok">готов</span></div> 
							<ul class="controll clearfix"> 
								<li><a href="#" title="Написать сообщение"><i class="icon mail-icon"></i></a></li> 
								<li><a href="#" title="Статьи"><i class="icon mbook-icon"></i></a></li> 
								<li><a href="#" title="Добавить"><i class="icon adduser-icon"></i></a></li> 
								<li><a href="#" title="Комментарии"><i class="icon mcomm-icon"></i></a></li> 
							</ul> 
							<dl> 
								<dt>Помощники</dt> 
								<dd><a href="#">madvic</a></dd> 
								<dd><a href="#">fedor</a></dd> 
							</dl> 
						</div> 
					</div> 
					<!-- /d-wrap --> 
					
					
				</div> 
				<!-- /debate-page --> 
				
				
				
				
				
				
				
				
				
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
	

<input type="hidden" name="currEtap" id="currEtap" value="GetStakes" />
<input type="hidden" name="refreshNow" id="refreshNow" value="0" />
<!-- Этап 5 из 7. Подтверждение готовности, прием ставок. -->
<?php $this->showTimer(); ?>


<h2>Этап 5 из 7. Подтверждение готовности, прием ставок.</h2>
<?php 
if ($this->userNumber && $this->isReady){ 
    echo 'Подождите пока будут сделаны ставки и участники подтвердят свою готовность к дебатам.';
}elseif($this->userNumber){
    echo 'Вы должны подтвердить вашу готовность к дебатам в течении отведенного времени в правом верхнем углу.';
}else{
    echo 'Вы можете поставить на любого из участников дебатов. Если участник, на которого вы поставили, выиграет – ваша ставка умножается на 1.5
Если участник проиграет то вы полностью теряете ставку.';
}
?>
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
	   <h2>Помощники</h2>
	   <?php 
	   if ($this->helper1_1){
	       echo '<p><a href="'.$this->createUrl('User', 'Profile', null, $this->helper1_1['login']).'">'.$this->helper1_1['login'].'</a></p>'; 
	   }else echo '<p>&nbsp;</p>';
	   if ($this->helper1_2){
	       echo '<p><a href="'.$this->createUrl('User', 'Profile', null, $this->helper1_2['login']).'">'.$this->helper1_2['login'].'</a></p>'; 
	   }else echo '<p>&nbsp;</p>';
	   ?>
	   <br /><br />
	   <p><input type="button" name="vote_for_user_1" id="vote_for_user_1" onclick="voteForDebateUser(<?php echo $this->debateUser1['id'] ?>);" value="Голосовать за <?php echo $this->debateUser1['login']; ?>" /></p>
	   </div>
	   </td>
	   <td valign="top"> 
	   
         <!-- center part  -->	   
	    <div id="centerTable">
	    <form action="" method="POST">
		<table class="questions">
		<tr> 
			<td colspan="3"><div class="center width_400"><b>Тема дебатов: <?php echo $this->debateNow['theme']; ?></b></div></td>
        </tr>
		<tr>
			<td> <?php if($this->userNumber){ echo 'Ставок на Вас:'; } else{ echo 'Всего ставок:';} ?> </td>
			<td>
			     <?php echo (int)$this->stakesCount; ?>
			</td>
			<td>&nbsp;</td>
	    </tr>
		<tr>
		    <td> На сумму: </td>
			<td>
			     <?php echo $this->stakesSum; ?> nm
			</td>
			<td>&nbsp;</td>
		</tr>
		<?php 
        if ($this->userNumber && $this->isReady){

        }elseif ($this->userNumber){
            echo '
        <tr>
		    <td colspan="3"><div class="center"><input type="submit" name="user_ready" size="300" value="Я готов к дебатам" /></div></td>
		</tr>   
            ';            
        }elseif ($this->user_id){
            $currentUser = $this->currentUser;
            echo '
        <tr>
		    <td> У Вас на счету: </td>
			<td>
			    '.$currentUser['nextmoney'].' nm 
			</td>
			<td>&nbsp;</td>
		</tr> 
		<tr>
			<td align="left"> Ставка: </td>
			<td nowrap>
			     <input type="text" size=4 name="stake_amount" id="stake_amount" />
			</td>
			<td>
			   <input type="button" name="doStake1" id="doStake1" onclick="doStake(1);" value="Сделать ставку на '.$this->debateUser1['login'].'" /><br/><br/>
			   <input type="button" name="doStake2" id="doStake2" onclick="doStake(2);" value="Сделать ставку на '.$this->debateUser2['login'].'" />
			</td>
		</tr>  
            ';
            if ($this->aUserStakes){
                echo '
                    <tr>
            			<td align="left"> Ваши ставки: </td>
            			<td colspan = "2">';
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
            		</tr>  
                ';
            	echo '
                    <tr>
            			<td align="left"> Всего: </td>
            			<td colspan = "2"><b>'.$sum.'</b> nm</td>
            		</tr>';
            }
        }
        ?>

		</table>
		</form>
		</div>
		<!-- / center part  -->
		
	   </td>
	   <td valign="top">
	   <div class="block_d_ld2">
	   <h2><?php echo '<a href="'.$this->createUrl('User', 'Profile', null, $this->debateUser2['login']).'">'.$this->debateUser2['login'].'</a>'; ?></h2>
	   <?php 
	   $this->showUserAvator($this->user2_avatar, $this -> image_url);
	   ?>
	   <h2>Помощники</h2>
	   <?php 
	   if ($this->helper2_1){
	       echo '<p><a href="'.$this->createUrl('User', 'Profile', null, $this->helper2_1['login']).'">'.$this->helper2_1['login'].'</a></p>'; 
	   }else echo '<p>&nbsp;</p>';
	   if ($this->helper2_2){
	       echo '<p><a href="'.$this->createUrl('User', 'Profile', null, $this->helper2_2['login']).'">'.$this->helper2_2['login'].'</a></p>'; 
	   }else echo '<p>&nbsp;</p>';
	   ?>
	   <br /><br />
	   <p><input type="button" name="vote_for_user_2" id="vote_for_user_2" onclick="voteForDebateUser(<?php echo $this->debateUser2['id'] ?>);" value="Голосовать за <?php echo $this->debateUser2['login']; ?>" /></p>
	   </div>
	   </td>
	</tr>
	</table>
		
	</div></div>

		
</div></div></div></div>



<!-- /Этап 5 из 7. Подтверждение готовности, прием ставок. -->








    </div>
</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>