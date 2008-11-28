<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
		<!-- РЕГИСТРАЦИЯ -->
		<table width="100%" height="100%" cellpadding="0">
		<tr>
			<td class="next24u_left">
				<!-- левый блок -->
				<?php  include($this -> _include('control_panel.tpl.php')); ?>
				<!-- /левый блок -->
			</td>
			<td class="next24u_right">
				<!-- правый блок -->
				<?=$this -> flash_messages; ?>
				
				<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
					<div class="block_title">
							<div class="block_title_left"><h2>Управление фразами настроения</h2></div>
							<div class="block_title_right">
								<img height="24" width="21" style="cursor: pointer;" onclick="ShowOrHide(this, 'user_profile_js'); return false;" src="http://admin.gek_next24.ru/app/images//close.png"/>
							</div>
					</div>
					<div id="user_profile_js" style="display: block;">
    					<span id="micro2">Эти фразы Вы можете использовать в своих комментариях</span>
                        
						<form method="post" action="">
                		<input type="hidden" name="mood_action" value="ok"/>
                		<table>
                			<tbody><tr>
                				<td width="100" valign="top">Название:</td>
                				<td>
									<input type="text" id="mood_name" style="width: 300px;" name="mood_name" value="" />
									<br/><span id="micro2">Не длиннее 100 символов</span>
                				</td>
                				<td valign="top"><input type="submit" name="add_mood" value="Добавить" /></td>
                			</tr>
                			<?php 
                			if (($this->user_profile['id']==$this->current_user->id || $this->isAdmin) && $this->user_moods){ 
                			?>
                			<tr>
                				<td valign="top" colspan="3">Изменить существующие:</td>
                			</tr>
                			<?php 
                			    foreach ($this->user_moods as $mood){
                			?>
                			<tr>
                				<td valign="top">&nbsp;</td>
                				<td>
									<input type="text"  style="width: 300px;" id="moods[<?php echo $mood['id']; ?>]" name="moods[<?php echo $mood['id']; ?>]" value = "<?php echo $mood['name']; ?>" />
                				</td>
           				        <td> Удалить <input type="checkbox" name="del_moods[<?php echo $mood['id']; ?>]" value="<?php echo $mood['id']; ?>" /></td>
                			</tr>
                			<?php 
                			    }
                			?>
                			<tr>
                				<td valign="top" colspan="3"><input type="submit" name="change_mood" value="Сохранить изменения" /></td>
                			</tr>
                			<?php 
                			} 
                			?>
                			
                		</tbody></table>
                		</form>
					</div>
				</div></div></div></div>
				
				
    				
				<!-- /правый блок -->
			</td>
		</tr>
		</table>
		<!-- /РЕГИСТРАЦИЯ -->
	</div>

</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>