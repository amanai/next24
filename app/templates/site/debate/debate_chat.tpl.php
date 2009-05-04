<?php include($this -> _include('../header.tpl.php')); ?>
			<div class="debate-page"> 
					<ul class="view-filter clearfix"> 
						<?php include($this -> _include('../tab_panel.tpl.php')); ?>
					</ul> 
					<!-- /view-filter --> 
					<div class="d-head"> 
						<input type="hidden" name="currEtap" id="currEtap" value="Debates" />
						<input type="hidden" name="refreshNow" id="refreshNow" value="0" />
						<div class="title clearfix"> 
							<div class="stage">Этап <strong>6</strong> из 7. Идет выбор второго участника дебатов</div> 
							<?php $this->showTimer(); ?> 
						</div> 
						<p>Вы можете предложить свою тему для дебатов. Если ваша тема победит, при последующем голосовании вы станете учасником дебатов.</p> 
						<p><span class="alert">ВНИМАНИЕ!</span> Если вы уверены, что сможете учавствовать в дебатах, то не стоит отправлять тему на конкурс. Прочитайте сначала <a href="#">правила дебатов</a></p> 
					</div> 
					<?php 
						if ($this->userNumber && $this->isReady){ 
    						echo 'Подождите пока будут сделаны ставки и участники подтвердят свою готовность к дебатам.';
						}
					?>
					<!-- /d-head --> 
					<h1><span>Тема дебатов:</span> <?php echo $this->debateNow['theme']; ?>
					<br /><span id="pauseTitle" style="color:red;font-size:120%;">Перерыв !</span>
					<br /><span id="pauseDescription" style="font-size:14px;">Дебаты прерваны на перерыв. Во время перерыва в окне дебатов могут оставлять свои сообщения помощники.</span>
					<br/>
					<span id="pauseOffDescription" style="font-size:14px;">
					<?php
						if ($this->activeEtap['is_pause']){
    						echo '';
						}elseif ($this->userNumber){ // Debate User
							echo 'Вы можете общаться с другим участником дебатов, так также сделать запрос на перерыв на 10 минут. Перерыв будет объявлен только при
								подтверждении его другим участником дебатов.';
						}elseif($this->userIdFromHelper){ // Helper
    						echo 'Вы можете подсказывать своему участнику дебатов как лучше вести линию разговора. По окончании дебатов, участник выставит вам оценку,
								поэтому постарайтесь подсказывать по существу.';
						}elseif($this->user_id){ // registred User
    						echo 'Вы можете общаться в чате с другими пользователями. ВНИМАНИЕ – мат в чате запрещен.
							Кроме того, вы можете проголосовать за одного из участников дебатов.';
						}else{ // Guest (not registred user)
    						echo 'Вы можете только следить за ходом дебатов. Что бы оставлять сообщения нужно зарегистрироваться.';
						}
					?>
					</span>
					<br /><div id="brok"></div>	
					</h1> 
					<div class="d-wrap clearfix"> 
						<div class="d-content"> 
							<div class="inn chat"> 
							
							
							
							
							
							
         <!-- chat part  -->	   
		<table class="questions">
		<tr>
			<td colspan="3"><div class="center width_400"><b>Тема дебатов: <?php echo $this->debateNow['theme']; ?></b></div></td>
        </tr>
		<tr>
			<td align="left" colspan="3"><div class="center"><div class="ChatMessagesB" id="chat_messages"></div></div></td>
	    </tr>
	    <?php
	    if ($this->activeEtap['is_pause']){ // PAUSE
	        if ($this->userNumber){ // Debate User
	            $this->showHelpersChat();
	            
	        }elseif($this->userIdFromHelper){ // Helper
	            $this->showMessageboxForDebateUsers(0, 0);
	            $this->showHelpersChat();
	            
	        }elseif($this->user_id){ // registred User
    		    $this->showUsersChat();
    		    $this->showUsersChatMessageBox();
    		    
    		}else{ // Guest (not registred user)
    		    $this->showUsersChat();
    		    
    		}
	        // STOP PAUSE
	        
	    }elseif ($this->userNumber){ // Debate User
    		$this->showMessageboxForDebateUsers($this->userNumber, 0);
    		if ($this->user_id == $this->debateUser1['id']){
    		  $this->showAllowSayHelpers($this->helper1_1, $this->helper1_2);
    		}else{
    		  $this->showAllowSayHelpers($this->helper2_1, $this->helper2_2);
    		}
    		$this->showHelpersChat();
    		
		}elseif($this->userIdFromHelper){ // Helper
		    $this->showMessageboxForDebateUsers($this->userNumber, 1);
		    $this->showHelpersChat();
		    
		}elseif($this->user_id){ // registred User
		    $this->showUsersChat();
		    $this->showUsersChatMessageBox();
		    
		}else{ // Guest (not registred user)
		    $this->showUsersChat();
		    
		}
		?>
		
		</table>
		<!-- / chat part  -->
		
		
		
									
								<div class="chat-entry main-chat"> 
									<ul> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix my-mess"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
									</ul> 
								</div> 
								<!-- /chat-entry --> 
								<h2>Чат пользоваелей</h2> 
								<div class="chat-entry"> 
									<ul> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix my-mess"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
									</ul> 
									<form action="#" method="post"> 
										<fieldset> 
											<table> 
												<tr> 
													<td class="input-field"><input type="text" value="Наклацайте название темы, котрую вы хотите предложить в этом поле" /></td> 
													<td class="input-button"><input type="submit" value="Сказать" /></td> 
												</tr> 
											</table> 
										</fieldset> 
									</form> 
								</div> 
								<!-- /chat-entry --> 
								<h2>Чат с помошниками</h2> 
								<div class="chat-entry"> 
									<ul> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix my-mess"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
										<li class="clearfix"> 
											<div class="meta"><a href="#">fedor</a> <span class="date">[ 19.08.09 в 18:55 ]</span></div> 
											<p>Но на последних снимках замечено множество других интересных образований, явно не природного происхождения</p> 
										</li> 
									</ul> 
									<form action="#" method="post"> 
										<fieldset> 
											<table> 
												<tr> 
													<td class="input-field"><input type="text" value="Наклацайте название темы, котрую вы хотите предложить в этом поле" /></td> 
													<td class="input-button"><input type="submit" value="Сказать" /></td> 
												</tr> 
											</table> 
										</fieldset> 
									</form> 
								</div> 
								<!-- /chat-entry --> 
							</div> 
						</div> 
						<!-- /d-content --> 
						<div class="member-info l-side"> 
						<!-- <div class="avatar"><a href="#"><img src="assets/i/temp/avatar.b.jpg" alt="" /><span class="member-name">madvic<i class="arrow-icon write-icon"></i></span></a></div> 
							<ul class="controll clearfix"> 
								<li><a href="#" title="Написать сообщение"><i class="icon mail-icon"></i></a></li> 
								<li><a href="#" title="Статьи"><i class="icon mbook-icon"></i></a></li> 
								<li><a href="#" title="Добавить"><i class="icon adduser-icon"></i></a></li> 
								<li><a href="#" title="Комментарии"><i class="icon mcomm-icon"></i></a></li> 
							</ul> -->
							<?php $this->showUserAvator($this->user1_avatar, $this -> image_url); ?> 
							<dl> 
								<dt>Помощники</dt> 
								<?php 
	   								if ($this->helper1_1){
	       								echo '<dd><a href="'.$this->createUrl('User', 'Profile', null, $this->helper1_1['login']).'">'.$this->helper1_1['login'].'</a>'; //<span>помощь</span></dd>
	   								}else echo '<dd>?</dd>';
	   								if ($this->helper1_2){
	       								echo '<dd><a href="'.$this->createUrl('User', 'Profile', null, $this->helper1_2['login']).'">'.$this->helper1_2['login'].'</a>'; //<span>помощь</span></dd>
	   								}else echo '<dd>?</dd>';
	   							?>
							</dl> 
							<a class="vote" href="javascript: void(0);" id="vote_for_user_1" onclick="voteForDebateUser(<?php echo $this->debateUser1['id'] ?>);">Голосовать за <strong><?php echo $this->debateUser1['login']; ?></strong></a> 
						</div> 
						<div class="member-info r-side"> 
	   						<?php $this->showUserAvator($this->user2_avatar, $this -> image_url); ?>
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
							<a class="vote" id="vote_for_user_2" href="javascript: void(0);" onclick="voteForDebateUser(<?php echo $this->debateUser2['id'] ?>);">Голосовать за <strong><?php echo $this->debateUser2['login']; ?></strong></a> 
						</div> 
					</div> 
					<!-- /d-wrap --> 
					
					
				</div> 
				<!-- /debate-page --> 
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>