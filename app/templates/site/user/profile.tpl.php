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
				<!-- правый блок -->
					<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
						<div class="block_title">
								<div class="block_title_left"><h2>Профиль пользователя</h2></div>
								<div class="block_title_right">
									<!--<img src="<?=$this -> image_url;?>/close.png" width="21" height="24" onclick="ShowOrHide(this, 'user_profile_js')" style="cursor: pointer;" />-->
									<img src="<?php echo $this -> image_url;?>/close.png" width="21" height="24" onclick="ShowOrHide(this, 'user_profile_js'); return false;" style="cursor: pointer;" />
								</div>
						</div>

						<div id="user_profile_js">
							<table width="100%" cellpadding="3">
							<tr>
								<td width="150"><b>Пользователь</b></td>
								<td><?=$this->user_profile['login'];?></td>
							</tr>
							<? if ($this->user_name) { ?>
							<tr>
								<td><b>Имя пользователя</b></td>
								<td>
									<?=$this->user_name;?>
								</td>
							</tr>
							<? } ?>
							<tr>
								<td><b>Дата рождения</b></td>
								<td><?=$this->user_profile['birth_date'];?></td>
							</tr>
							<tr>
								<td><b>Дата регистрации</b></td>
								<td><?=$this->user_profile['registration_date'];?></td>
							</tr>
							<tr>
								<td><b>Пол</b></td>
								<td><?=$this->user_profile['gender']?'мужской':'женский';?></td>
							</tr>
							
							<? if ($this->user_location) { ?>
							<tr>
								<td><b>Расположение</b></td>
								<td><?=$this->user_location;?></td>
							</tr>
							<? } ?>
							<? if ($this->user_profile['marital_status']) { ?>
							<tr>
								<td><b>Семейное положение</b></td>
								<td><?=$this->user_profile['marital_status'];?></td>
							</tr>
							<? } ?>
							<? if ($this->user_profile['phone']) { ?>
							<tr>
								<td><b>Телефон</b></td>
								<td><?=$this->user_profile['phone'];?></td>
							</tr>
							<? } ?>
							<? if ($this->user_profile['mobile_phone']) { ?>
							<tr>
								<td><b>Мобильный телефон</b></td>
								<td><?=$this->user_profile['mobile_phone'];?></td>
							</tr>
							<? } ?>
							
							</table>
						</div>

					</div></div></div></div>
					
					<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
						<div class="block_title">
								<div class="block_title_left"><h2>О пользователе</h2></div>
								<div class="block_title_right">
									<img src="<?php echo $this -> image_url;?>/open.png" width="21" height="24" onclick="ShowOrHide(this, 'user_profile_js1'); return false;" style="cursor: pointer;" />
								</div>
						</div>

						<div id="user_profile_js1" style="display: none;">
							<table width="100%" cellpadding="3">
							<? if ($this->user_profile['about']) { ?>
							<tr>
								<td width="150"><b>О себе</b></td>
								<td align="left">
									<?=$this->user_profile['about'];?>
								</td>
							</tr>
							<? } ?>
							<? if ($this->user_interests) { ?>
							<tr>
								<td><b>Интересы</b></td>
								<td><?=$this->user_interests;?></td>
							</tr>
							<? } ?>
							<? if ($this->user_profile['books']) { ?>
							<tr>
								<td><b>Любимые книги</b></td>
								<td align="left">
									<?=$this->user_profile['books'];?>
								</td>
							</tr>
							<? } ?>
							<? if ($this->user_profile['films']) { ?>
							<tr>
								<td><b>Любимые фильмы</b></td>
								<td align="left">
									<?=$this->user_profile['films'];?>
								</td>
							</tr>
							<? } ?>
							<? if ($this->user_profile['musicians']) { ?>
							<tr>
								<td><b>Любимые музыканты</b></td>
								<td align="left">
									<?=$this->user_profile['musicians'];?>
								</td>
							</tr>
							<? } ?>
							<? if ($this->friend_list) { ?>
							<tr>
								<td><b>Друзья</b></td>
								<td>
									
									<?=$this -> friend_list; ?>
								</td>
							</tr>
							<? } ?>
							<? if ($this->in_friend_list) { ?>
							<tr>
								<td><b>В друзьях у</b></td>
								<td>
									<?=$this -> in_friend_list; ?>
								</td>
							</tr>
							<? } ?>
							</table>
						</div>

					</div></div></div></div>
					
					<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
						<div class="block_title">
								<div class="block_title_left"><h2>Последние данные</h2></div>
								<div class="block_title_right">
									<img src="<?php echo $this -> image_url;?>/open.png" width="21" height="24" onclick="ShowOrHide(this, 'user_profile_js2'); return false;" style="cursor: pointer;" />
								</div>
						</div>

						<div id="user_profile_js2" style="display: none;">
							<table width="100%" cellpadding="3">
							<tr>
								<td width="150"><b>&nbsp;</b></td>
								<td>
									&nbsp;
								</td>
							</tr>
							</table>
						</div>

					</div></div></div></div>
				<!-- /правый блок -->
			</td>
		</tr>
		</table>
		<!-- /ПРОФИЛЬ -->
	</div>

</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>