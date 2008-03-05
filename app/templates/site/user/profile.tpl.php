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
					<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
						<div class="block_title"><h2>Управление</h2></div>

						<a href="">Редактировать профиль</a><br />
						<a href="#">Редактировать аватары</a>

					</div></div></div></div>
				<!-- /левый блок -->
			</td>
			<td class="next24u_right">
				<!-- правый блок -->
					<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
						<div class="block_title">
								<div class="block_title_left"><h2>Профиль пользователя</h2></div>
								<div class="block_title_right"><img src="<?php echo IMG_URL?>/close.png" width="21" height="24" onclick="ShowOrHide(this, 'user_profile_js')" style="cursor: pointer;" /></div>
						</div>

						<div id="user_profile_js">
							<table width="100%" cellpadding="3">
							<tr>
								<td width="150"><b>Пользователь</b></td>
								<td><?php echo $this->user_profile['login'];?></td>
							</tr>
								<td><b>Имя пользователя</b></td>
								<td><?php echo $this->user_profile['last_name'].' '.$this->user_profile['first_name'].' '.$this->user_profile['middle_name'];?></td>
							</tr>
								<td><b>Дата рождения</b></td>
								<td><?php echo $this->user_profile['birth_date'];?></td>
							</tr>
								<td><b>Дата регистрации</b></td>
								<td><?php echo $this->user_profile['registration_date'];?></td>
							</tr>
								<td><b>Пол</b></td>
								<td><?php echo $this->user_profile['gender_formatted'];?></td>
							</tr>
								<td><b>Расположение</b></td>
								<td><?php echo $this->user_profile['city'];?></td>
							</tr>
								<td><b>Интересы</b></td>
								<td><?php echo $this->user_profile['interest'];?></td>
							</tr>
								<td><b>Репутация</b></td>
								<td><?php echo $this->user_profile['reputation'];?> Посмотреть репутацию  (Плюс - Минус)</td>
							</tr>
							
							</tr>
								<td><b>Друзья</b></td>
								<td>
									<?php echo $this -> friend_list; ?>
								</td>
							</tr>
							</tr>
								<td><b>В друзьях у</b></td>
								<td>
									<?php echo $this -> in_friend_list; ?>
								</td>
							</tr>
							</table>
							<table width="100%" cellpadding="3">
							<tr>
								<td colspan="2"><b>О себе</b></td>
							</tr>
							<tr>
								<td colspan="2"><i>
									<?php echo $this->user_profile['about'];?>
								</i></td>
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