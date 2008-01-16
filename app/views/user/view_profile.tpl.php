			<!-- Главный блок, с вкладками (Контент) -->
			<div class="tab-page" id="modules-cpanel">
				<script type="text/javascript">var tabPane1 = new WebFXTabPane( document.getElementById( "modules-cpanel" ), 1 )</script>

				<div class="tab-page">
					<h2 class="tab">Профиль</h2>
					<!-- ПРОФИЛЬ -->
					<table width="100%" height="100%" cellpadding="0">
					<tr>
						<td class="next24u_left">
							<!-- левый блок -->
								<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
									<div class="block_title"><h2>Управление</h2></div>

									<a href="#">Редактировать профиль</a><br />
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
											<td><?php echo $this->userData['login'];?></td>
										</tr>
											<td><b>Имя пользователя</b></td>
											<td><?php echo $this->userData['last_name'].' '.$this->userData['first_name'].' '.$this->userData['middle_name'];?></td>
										</tr>
											<td><b>Дата рождения</b></td>
											<td><?php echo $this->userData['birth_date_formatted'];?></td>
										</tr>
											<td><b>Дата регистрации</b></td>
											<td><?php echo $this->userData['registration_date_formatted'];?></td>
										</tr>
											<td><b>Пол</b></td>
											<td><?php echo $this->userData['gender_formatted'];?></td>
										</tr>
											<td><b>Расположение</b></td>
											<td><?php echo $this->userData['city'];?></td>
										</tr>
											<td><b>Интересы</b></td>
											<td><?php echo $this->userData['interests'];?></td>
										</tr>
											<td><b>Репутация</b></td>
											<td><?php echo $this->userData['reputation'];?> Посмотреть репутацию  (Плюс - Минус)</td>
										</tr>
										</table>
										<table width="100%" cellpadding="3">
										<tr>
											<td colspan="2"><b>О себе</b></td>
										</tr>
										<tr>
											<td colspan="2"><i>
												<?php echo $this->userData['about'];?>
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