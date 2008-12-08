<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
		<!-- ПРОФИЛЬ -->
		<table width="100%" height="100%" cellpadding="0">
		<tr>
			<td class="next24u_left">
				<!-- левый блок -->
					<?php include($this -> _include('control_panel.tpl.php')); ?>
				<!-- /левый блок -->
			</td>
			<td class="next24u_right">
			        <?=$this -> flash_messages; ?>
				<!-- правый блок -->
					<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
						<div class="block_title">
								<div class="block_title_left"><h2>Отправить сообщение</h2></div>
								<div class="block_title_right">
									<img src="<?php echo $this -> image_url;?>/close.png" width="21" height="24" onclick="ShowOrHide(this, 'user_profile_js'); return false;" style="cursor: pointer;" />
								</div>
						</div>
						
						<div id="user_profile_js">
						<form method="post" action="">
						<input type="hidden" value="new_message" name="message_action" />
						<table width="100%">
						<tr>
						  <td>Кому</td>
						  <td>
						      <?php if ($this->message_to == "admin"){
						          echo 'Администрации <input type="hidden" value="admin" name="message_to" />';
						      }else{
						      ?>

						      <table class="recipients">
						      <tr>
						          <td class="caption">Выберите из списка друзей</td>
						          <td>
						          <select name="recipient" id="recipient" onchange="messageRecipientChange(1);">
						          <option value="0">Список друзей</option>
						          <?php
						          foreach ($this->user_friends as $friend){
						              echo '
						              <option value="'.$friend['login'].'">'.$friend['login'].'</option>
						              ';
						          }
						          ?>
						          </select>
						          </td>
						      </tr>
						      <tr>
						          <td class="caption">Или введите имя вручную</td>
						          <td><input type="text" class="field" name="recipient_name" id="recipient_name" value="<?php echo $this->recipient_name; ?>" onchange="messageRecipientChange(2);" /></td>
						      </tr>
						      </table>
						      <?php } ?>
						  </td>
				        </tr>
				        <tr>
				            <td width="100">Тема: </td>
				            <td><input type="text" style="width: 100%;" name="mess_header" value="<?php echo $this->mess_header; ?>" /></td>
				        </tr>
				        <tr>
				            <td>Сообщение:</td>
				            <td><textarea style="width: 100%; height: 250px;" name="m_text"><?php echo $this->m_text; ?></textarea></td>
				        </tr>
				        <tr>
				            <td>Выберите аватор для сообщения:</td>
				            <td>
				            <select name="avatar_id" >
                			    <option value="0" /> [Ваши аваторы]
                    			<?php
                    			foreach ($this->user_avatars as $user_avatar){
                    			    $selected = ($user_avatar['id']==$this->default_avatar['id'])?"selected":"";
                    			    echo '<option value="'.$user_avatar['id'].'" '.$selected.' />'.$user_avatar['av_name'];
                    			}
                    			?>
                			    </select>
				            </td>
				        </tr>
				        </table>
				        <input type="submit" onclick="submit" alt="Отправить" class="button" value="Отправить" name="Submit"/>
				        </form>
				        </div>

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