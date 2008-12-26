<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
		<!-- ПРОФИЛЬ -->
		<table width="100%" height="100%" cellpadding="0">
		<tr>
			<td>
				<!-- правый блок -->
					<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
						<div class="block_title">
								<div class="block_title_left"><h2>Переписка между пользователями <?php echo $this->user_login." и ".$this->correspondent_user_login ?></h2></div>
								<div class="block_title_right">
									<img src="<?php echo $this -> image_url;?>/close.png" width="21" height="24" onclick="ShowOrHide(this, 'user_profile_js'); return false;" style="cursor: pointer;" />
								</div>
						</div>

						<div id="user_profile_js">
						<div class="cmod_messages" id="cmod_messages">
							<?php
							$i = 1;
							foreach ($this->aMessages as $message){
							    if ($i/2 == 1){$i = 1;} else {$i++;}
							    echo '
							    <div class="cmod_tab'.$i.'">
        							<h3>'.$message['author_login'].'</h3>,  <h3>'.$message['header'].'</h3>,  '.$message['send_date'].'  
        						';
							    if ($message['author_id'] != $this->user_id){
        							echo '
        							<a href="'.Project::getRequest() -> createUrl('Messages', 'SendMessage').'/message_action:reply/mess_id:'.$message['id'].'"><b>написать сообщение</b></a> | 
        							<a onclick="return DelMessageCorrespondence('.$message['messages_id'].', '.$this->corr_user_id.');" href="javascript: void(0);"><b>удалить</b></a>';
							    }
        						echo '
        							<p>
        								'.nl2br($message['m_text']).'
        							</p>
        						</div>';
							}
							?>
						</div>
						</div>

					</div></div></div></div>
					
					<?=$this -> flash_messages; ?>
					<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
					
					<div class="block_title">
								<div class="block_title_left"><h2>Отправить сообщение</h2></div>
								<div class="block_title_right">
									<img src="<?php echo $this -> image_url;?>/close.png" width="21" height="24" onclick="ShowOrHide(this, 'user_profile_js2'); return false;" style="cursor: pointer;" />
								</div>
					</div>
					
					<div id="user_profile_js2">
					<form method="post" action="<?php echo Project::getRequest() -> createUrl('Messages', 'SendMessage'); ?>">
					<input type="hidden" value="new_message" name="message_action" />
					<input type="hidden" value="Messages" name="redirect_controller" />
					<input type="hidden" value="CorrespondenceWith" name="redirect_action" />
					<input type="hidden" value="/corr_user_id:<?php echo $this->correspondent_user['id']; ?>" name="redirect_url" />
					<input type="hidden" value="<?php echo $this->correspondent_user['login']; ?>" name="recipient_name" />
					<table width="100%">
					<tr>
					   <td valign="top" style="padding-right: 20px;">
					   <h2 style="margin-bottom: 5px;"><?php echo '<a href="'.Project::getRequest() -> createUrl('User', 'Profile', null, $this->curr_user['login']).'">'.$this->curr_user['login'].'</a>'; ?></h2>
					   <div class="av_preview">
					   <?php $avator_path = ($this->curr_user_avatar['sys_av_id'])?$this->curr_user_avatar['sys_path']:$this->curr_user_avatar['path']; ?>
	                   <img style="margin: 5px;" alt="<?php echo $this->curr_user_avatar['av_name'];?>" src="<?php echo $this->image_url."avatar/".$avator_path;?>"/>
					   </div>
					   <!--
					   <p class="icons">
					   <a href="/u/ipartemk/diary/"><img height="16" width="16" align="absmiddle" alt="Дневник пользователя" src="<?php echo $this->image_url; ?>icons/diary1.gif"/></a> 
					   <a href="/u/ipartemk/album/"><img height="16" width="16" align="absmiddle" alt="Альбом пользователя" src="<?php echo $this->image_url; ?>icons/albums.gif"/></a> 
					   <a href="/u/ipartemk/pm/"><img height="16" width="16" align="absmiddle" alt="Отправить личное сообщение пользователю" src="<?php echo $this->image_url; ?>icons/pm.gif"/></a>  
					   <a href="/addfriend/ipartemk/"><img height="16" width="16" align="absmiddle" alt="Добавить пользователя в друзья" src="<?php echo $this->image_url; ?>icons/addfriend.gif"/></a>
					   </p>
					   -->
					   </td>
					   <td width="100%">
					   <input type="text" name="mess_header" style="width: 100%;"/>
					   <textarea name="m_text" style="width: 100%; height: 150px;" ></textarea>
					   </td>
					   
					   <td valign="top" align="left" style="padding-left: 20px;">
					   <h2 style="margin-bottom: 5px;"><?php echo '<a href="'.Project::getRequest() -> createUrl('User', 'Profile', null, $this->correspondent_user['login']).'">'.$this->correspondent_user['login'].'</a>'; ?></h2>
					   <div class="av_preview">
					   <?php $avator_path = ($this->correspondent_user_avatar['sys_av_id'])?$this->correspondent_user_avatar['sys_path']:$this->correspondent_user_avatar['path']; ?>
	                   <img style="margin: 5px;" alt="<?php echo $this->correspondent_user_avatar['av_name'];?>" src="<?php echo $this->image_url."avatar/".$avator_path;?>"/>
					   </div>
					   </td>
					</tr>
					<tr>
				            <td>&nbsp;</td>
				            <td>
				            Выберите аватар для сообщения:
				            <select name="avatar_id" >
                			    <option value="0" /> [Ваши аватары]
                    			<?php
                    			foreach ($this->curr_user_avatars as $user_avatar){
                    			    $selected = ($user_avatar['id']==$this->default_avatar['id'])?"selected":"";
                    			    echo '<option value="'.$user_avatar['id'].'" '.$selected.' />'.$user_avatar['av_name'];
                    			}
                    			?>
                			    </select>
				            </td>
				            <td>&nbsp;</td>
				        </tr>
					<tr>
					   <td>&nbsp;</td>
					   <td align="right" style="padding-right: 5px;">
					   <input type="submit" value="Отправить" alt="Отправить" name="Submit"/>
					   </td>
					   <td>&nbsp;</td>
					</tr>
					</table>
					</form>
					</div></div></div></div>
					
					<div id="myMessagePager"></div>
				<!-- /правый блок -->
			</td>
		</tr>
		</table>
		<!-- /ПРОФИЛЬ -->
	</div>

</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>