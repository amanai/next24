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
				<?php if ($this->count_user_avatars < 10){ ?>
				<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
					<div class="block_title">
							<div class="block_title_left"><h2>Загрузка аватара</h2></div>
							<div class="block_title_right">
								<img height="24" width="21" style="cursor: pointer;" onclick="ShowOrHide(this, 'user_profile_js'); return false;" src="<?=$this -> image_url;?>close.png"/>
							</div>
					</div>
					<div id="user_profile_js" style="display: block;">
    					<span id="micro2">Аватар - это картинка, которая может быть показана рядом с вашим именем в комментариях, блоге, личном профиле и т.д.</br>
                        Размер аватара будет автоматически изменен до 90х90 пикселей. </span>
                        
						<form enctype="multipart/form-data" method="post" action="">
                		<input type="hidden" name="avatar_action" value="create_avatar"/>
                		<table>
                			<tbody><tr>
                				<td width="100" valign="top">Название:</td>
                				<td>
									<input type="text" id="newava_name" style="width: 300px;" name="newava_name" value="<?php echo $this->newava_name;?>" />
									<br/><span id="micro2">Не длиннее 50 символов</span>
                				</td>
                			</tr>
                			<tr>
                				<td valign="top">Аватар:</td>
                				<td>
									<input type="file" id="newava_file" style="width: 300px;" name="newava_file" />
									<br/><span id="micro2">Принимаются форматы GIF, JPEG, PNG</span>
                				</td>
                			</tr>
                			<?php if ($this->isAdmin){ ?>
                			<tr>
                				<td valign="top">Ситемный аватар :</td>
                				<td>
									<input type="checkbox" id="is_system" name="is_system" />
									<br/><span id="micro2">Администраторская функия</span>
                				</td>
                			</tr>
                			<?php } ?>
                			
                			
                		</tbody></table>
                		<br />
                		<input type="submit" style="padding: 0px;" value="Загрузить аватар"/>
                		</form>
					</div>
				</div></div></div></div>
				
				
				<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
					<div class="block_title">
							<div class="block_title_left"><h2>Выбор системного аватара</h2></div>
							<div class="block_title_right">
								<img height="24" width="21" style="cursor: pointer;" onclick="ShowOrHide(this, 'user_profile_js3'); return false;" src="<?=$this -> image_url;?>open.png"/>
							</div>
					</div>
					<div id="user_profile_js3" style="display: none;">
                        
						<form method="post" action="">
                		<input type="hidden" name="avatar_action" value="sys_avatar"/>
                		<?php
                    	foreach ($this->sys_avatars as $sys_avatar){
                    	?>
    				    <div class="av_gallery">
    					<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
        					<div align="center" class="block_title">
        						<input type="text" style="width: 100px;" value="<?php echo $sys_avatar['av_name'];?>" name="avatar_names[<?php echo $sys_avatar['id'];?>]"/>
        					</div>
        					<div class="av_preview"><img style="margin: 5px;" alt="<?php echo $sys_avatar['av_name'];?>" src="<?php echo $this->image_url."avatar/".$sys_avatar['path'];?>"/></div>
        					<div class="block_title2">
        						<span id="micro">Выбрать</span>   <input type="radio" value="<?php echo $sys_avatar['id'];?>" name="avatar_check" /><br/>
        						<?php if ($this->isAdmin){ ?>
        						<span id="micro">Удалить</span>   <input type="checkbox" name="avatars_delete[<?php echo $sys_avatar['id'];?>]"/>
        						<?php } ?>
        					</div>
        				</div></div></div></div>
        				</div>
        				<?php
                    	}
                    	?>
                    	<br clear="left" />
                		<input type="submit" style="padding: 0px;" value="Выбрать<?php if ($this->isAdmin){ echo "/изменить"; }?> аватар"/>
                		</form>
                		
					</div>
    				
				</div></div></div></div>
				
				<?php } ?>
				
				<?php if ($this->count_user_avatars){ ?>
				
				<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
					<div class="block_title">
							<div class="block_title_left"><h2>Управление аватарами</h2></div>
							<div class="block_title_right">
								<!--<img src="<?=$this -> image_url;?>close.png" width="21" height="24" onclick="ShowOrHide(this, 'user_profile_js')" style="cursor: pointer;" />-->
								<img height="24" width="21" style="cursor: pointer;" onclick="ShowOrHide(this, 'user_profile_js2'); return false;" src="<?=$this -> image_url;?>close.png"/>
							</div>
					</div>
					<div id="user_profile_js2" style="display: block;">
					
					<form method="post" action="">
                	<input type="hidden" name="avatar_action" value="change_avatar"/>
                	
                	<?php
                	foreach ($this->user_avatars as $user_avatar){
                	    $avator_path = ($user_avatar['sys_av_id'])?$user_avatar['sys_path']:$user_avatar['path'];
                	?>
				    <div class="av_gallery">
					<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
    					<div align="center" class="block_title">
    						<input type="text" style="width: 100px;" value="<?php echo $user_avatar['av_name'];?>" name="avatar_names[<?php echo $user_avatar['id'];?>]"/>
    					</div>
    					<div class="av_preview"><img style="margin: 5px;" alt="<?php echo $user_avatar['av_name'];?>" src="<?php echo $this->image_url."avatar/".$avator_path;?>"/></div>
    					<div class="block_title2">
    						<span id="micro">По умолчанию</span>   <input type="radio" value="<?php echo $user_avatar['id'];?>" name="avatar_default" <?php if ($user_avatar['def']) echo "checked"; ?> /><br/>
    						<span id="micro">Удалить</span>   <input type="checkbox" name="avatars_delete[<?php echo $user_avatar['id'];?>]"/>
    					</div>
    				</div></div></div></div>
    				</div>
    				<?php
                	}
                	?>
    				
    				<br clear="left" />
    				<input type="submit" value="Сохранить изменения">
    				</form>
    				
    				</div>
    				
				</div></div></div></div>
				
				<?php } ?>
    				
				<!-- /правый блок -->
			</td>
		</tr>
		</table>
		<!-- /РЕГИСТРАЦИЯ -->
	</div>

</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>