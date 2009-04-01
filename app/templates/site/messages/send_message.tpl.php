<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../profile_line.tpl.php')); ?>
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<h2 class="page-ttl">Написать Сообщение</h2>
						<form class="write-message" action="#">
							<table>
								<tbody>
									<tr>
										<td class="label">Кому</td>
										<?php if ($this->message_to == "admin"){ ?>
										<td><div class="wrp">
						          			Администрации <input type="hidden" value="admin" name="message_to" />
						          		</div></td>	
						     			<? }else{ ?>
										<td><div class="wrp">
											<span class="field-help"><label for="f1">Выбрать из списка друзей</label></span>
											<select id="f1" name="recipient" id="recipient" onchange="messageRecipientChange(1);">
						          				<option value="0">Список друзей</option>
						         				<?php foreach ($this->user_friends as $friend){ ?>
						              				<option value="<?=$friend['login']; ?>"><?=$friend['login']; ?></option>
						          				<? } ?>
											</select>
										</div></td>
										<td><div class="wrp">
											<span class="field-help"><label for="f2">Ввести имя вручную</label></span>
											<input type="text" id="f2" name="recipient_name" value="<?=$this->recipient_name; ?>" onchange="messageRecipientChange(2);" />  <!-- id="recipient_name" -->
										</div></td>
										<? } ?>
									</tr>
									<tr>
										<td class="label"><label for="f3">Тема</label></td>
										<td colspan="2">
											<input type="text" class="big" id="f3" name="mess_header" value="<?=$this->mess_header; ?>" />
										</td>
									</tr>
									<tr>
										<td colspan="3">
											<label for="f4" class="label">Сообщение</label>
											<textarea rows="8" cols="30" id="f4" name="m_text"><?=$this->m_text; ?></textarea>
										</td>
									</tr>
									<tr>
										<td colspan="3">
											<div class="label"><label for="f5">Выберите аватар для сообщения</label></div>
											<select id="f5" name="avatar_id">
                			    				<option value="0"> [Ваши аватары] </option>
                    							<?php foreach ($this->user_avatars as $user_avatar){
                    			    				$selected = ($user_avatar['id']==$this->default_avatar['id'])?"selected=\"selected\"":"";
                    			    				echo '<option value="'.$user_avatar['id'].'" '.$selected.'>'.$user_avatar['av_name'].'</option>';
                    							} ?>
											</select>
										</td>
									</tr>
								</tbody>
							</table>
							<div class="button"><input type="submit" name="Submit" alt="Отправить" value="Отпавить сообщение" /></div>
						</form>
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<?php include($this -> _include('control_panel.tpl.php')); ?>
					</div>
					<!-- /sidebar -->
					<div id="myMessagePager"></div>
				</div>
				<!-- /columns-page -->
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>