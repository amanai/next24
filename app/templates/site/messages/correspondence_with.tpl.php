<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../profile_line.tpl.php')); ?>
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<h2 class="page-ttl"><a href="<?=$request -> createUrl('Messages', 'Mymessages'); ?>">Личная почта</a> <span class="spr">»</span> Переписка с <a href="<?php echo $this->createUrl('User', 'Profile', null, $this->correspondent_user_login)?>" class="user-lnk"><?=$this->correspondent_user_login; ?></a></h2>
							<div class="chat">
								<div class="chat-entry main-chat message-chat">
									<ul>
									<?php foreach ($this->aMessages as $message){
							   		if ($message['author_id'] != $this->user_id){
							    		$answer_class = 'class="alt"';
							   		 }
							   		 else {
							   		 	$answer_class = '';											
							   		 }
							    	echo '<li '.$answer_class.'>
							    			<div class="meta">
							    				<a href="'.$this->createUrl('User', 'Profile', null, $message['author_login']).'">'.$message['author_login'].'</a>';
												if ($message['author_id'] != $this->user_id){
							    					echo '<br /><a href="'.Project::getRequest() -> createUrl('Messages', 'SendMessage').'/message_action:reply/mess_id:'.$message['id'].'">написать сообщение</a>';
							   					}							    	
							    				echo '<span class="date">[ '.$message['send_date'].' ]</span>';
							   					 if ($message['author_id'] != $this->user_id){
							    					echo '<span class="ctrl">[ <a onclick="return DelMessageCorrespondence('.$message['messages_id'].', '.$this->corr_user_id.');" href="javascript: void(0);" class="delete-link">удалить</a> ]</span>';
							   		 			}	
							    		 echo '</div>	
							    		<p>
							    			'.$message['header'].'
							    		</p>
							    		<p>
							    			'.nl2br($message['m_text']).'
							    		</p>	
							    	  </li>';
									}?>									
									</ul>
								</div>
								<!-- /chat-entry -->
							</div>
							<!-- /chat -->
							<?=$this -> flash_messages; ?>
							<h2>Новое сообщение</h2>
							<div class="new-mess">
								<form action="<?php echo Project::getRequest() -> createUrl('Messages', 'SendMessage'); ?>" method="post">
									<div>
										<input type="text" name="mess_header" style="width: 99%; margin-bottom: 3px;" />
										<textarea rows="10" cols="50" name="m_text"></textarea>
										<input type="hidden" value="new_message" name="message_action" />
										<input type="hidden" value="Messages" name="redirect_controller" />
										<input type="hidden" value="CorrespondenceWith" name="redirect_action" />
										<input type="hidden" value="/corr_user_id:<?php echo $this->correspondent_user['id']; ?>" name="redirect_url" />
										<input type="hidden" value="<?php echo $this->correspondent_user['login']; ?>" name="recipient_name" />	
				           				Выберите аватар для сообщения:
				            			<select name="avatar_id" >
                			   				 <option value="0"> [Ваши аватары] </option>
                    						<?php foreach ($this->curr_user_avatars as $user_avatar){
                    			    			$selected = ($user_avatar['id']==$this->default_avatar['id'])?"selected":"";
                    			    			echo '<option value="'.$user_avatar['id'].'" '.$selected.'>'.$user_avatar['av_name'].'</option>';
                    						} ?>
                			    		</select>																		
										<input type="submit" value="Отправить сообщение" alt="Отправить" name="Submit" />
									</div>
								</form>
							</div>
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<?php include($this -> _include('control_panel.tpl.php')); ?>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>