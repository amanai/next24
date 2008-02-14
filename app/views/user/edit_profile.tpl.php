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

									Редактировать профиль<br />

								</div></div></div></div>
							<!-- /левый блок -->
						</td>
						<td class="next24u_right">
							<!-- правый блок -->
								<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
									<div class="block_title"><h2>Профиль пользователя</h2></div>
									<form action="<?php echo $this->router->createUrl('User', 'Saveprofile')?>" method="post">
									<table cellpadding="3">
									<tr>
										<td width="150" valign="top" style="padding-top: 5px;"><b>E-Mail</b></td>
										<td>
											<input type="text" style="width: 200px;" name="email" value="<?php echo $this->userData['email'];?>" /><br />
											<span id="micro2">Пожалуйста, указывайте существующий адрес,<br />так как на него вам будет отправлена техническая информация о доступе на сайт.</span>
										</td>
									</tr>
									<tr>
										<td valign="top" style="padding-top: 5px;"><b>Фамилия</b></td>
										<td>
											<input type="text" style="width: 200px;" name="last_name" value="<?php echo $this->userData['last_name'];?>"/><br />
											<span id="micro2">Ваша реальная фамилия. Допустима кириллица, пробел и символ дефиса.</span>
										</td>
									</tr>
									<tr>
										<td><b>Имя</b></td>
										<td valign="top" style="padding-top: 5px;">
											<input type="text" style="width: 200px;" name="first_name" value="<?php echo $this->userData['first_name'];?>"/><br />
											<span id="micro2">Ваше реальное имя. Допустима кириллица, пробел и символ дефиса.</span>
										</td>
									</tr>
									<tr>
										<td><b>Отчество</b></td>
										<td valign="top" style="padding-top: 5px;">
											<input type="text" style="width: 200px;" name="middle_name" value="<?php echo $this->userData['middle_name'];?>"/><br />
											<span id="micro2">Ваше отчество. Допустима кириллица, пробел и символ дефиса.</span>
										</td>
									</tr>
									<tr>
										<td><b>Дата рождения</b></td>
										<td>
											<select name="birth_day">
												<?php for($i=1;$i<=31;$i++){?>
												<?php $selected = ""; ?>
												<?php if($i == $this->userData['birth_day']) $selected = 'selected="selected"';?>
												<option <?php echo $selected;?> ><?php echo $i;?></option>
												<?php }?>
											</select>
											
											<select name="birth_month">
												<option <?php echo $this->userData['birth_month'][1];?> value="1">января</option>
												<option <?php echo $this->userData['birth_month'][2];?> value="2">февраля</option>
												<option <?php echo $this->userData['birth_month'][3];?> value="3">марта</option>
												<option <?php echo $this->userData['birth_month'][4];?> value="4">апреля</option>
												<option <?php echo $this->userData['birth_month'][5];?> value="5">мая</option>
												<option <?php echo $this->userData['birth_month'][6];?> value="6">июня</option>
												<option <?php echo $this->userData['birth_month'][7];?> value="7">июля</option>
												<option <?php echo $this->userData['birth_month'][8];?> value="8">августа</option>
												<option <?php echo $this->userData['birth_month'][9];?> value="9">сентября</option>
												<option <?php echo $this->userData['birth_month'][10];?> value="10">октября</option>
												<option <?php echo $this->userData['birth_month'][11];?> value="11">ноября</option>
												<option <?php echo $this->userData['birth_month'][12];?> value="12">декабря</option>
											</select>
											
											<select name="birth_year">
												<?php for($i=1940;$i<=date("Y");$i++){?>
												<?php $selected = "";?>
												<?php if($i == $this->userData['birth_year']) $selected = 'selected="selected"';?>
												<option <?php echo $selected;?> ><?php echo $i;?></option>
												<?php }?>
											</select>
										</td>
									</tr>
									<tr>
										<td><b>Страна</b></td>
										<td valign="top" style="padding-top: 5px;">
											<select name="country_id">
												<?php foreach($this->userData['countries'] as $country){?>
												<?php $selected = "";?>
												<?php if($country['id'] == $this->userData['country_id']) $selected = 'selected="selected"';?>
												<option <?php echo $selected;?> value="<?php echo $country['id'];?>"><?php echo $country['name'];?></option>
												<?php }?>
											</select><br />
											<span id="micro2">Страна проживания.</span>
										</td>
									</tr>
									<tr>
										<td valign="top" style="padding-top: 5px;"><b>Город</b></td>
										<td>
											<input type="text" style="width: 200px;" name="city" value="<?php echo $this->userData['city'];?>"/><br />
											<span id="micro2">Город проживания. Допустима латиница, кирилица, пробел и дефис.</span>
										</td>
									</tr>
									<tr>
										<td><b>Пол</b></td>
										<td>
											<input name="gender" value="0" type="radio" <?php echo $this->userData['gender_formatted'][0];?> /> Мужской  &nbsp;&nbsp;
											<input name="gender" value="1" type="radio" <?php echo $this->userData['gender_formatted'][1];?>/> Женский
										</td>
									</tr>
									<tr>
										<td><b>О себе</b></td>
										<td>
											<textarea style="width: 450px; height: 100px;" name="about"><?php echo $this->userData['about'];?></textarea><br />
											<span id="micro2">Информация о себе.</span>
										</td>
									</tr>
									<tr>
										<td><b>Интересы</b></td>
										<td>
											<textarea style="width: 450px; height: 100px;" name="interest"><?php echo $this->userData['interest'];?></textarea><br />
											<span id="micro2">Ваши интересы. Слова и словосочетания разделенные запятой.</span>
										</td>
									</tr>
									<tr>
										<td colspan="2" align="right"><input type="submit" value="Сохранить изменение" /></td>
									</tr>
									</table>
									</form>
								</div></div></div></div>



								<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
									<div class="block_title"><h2>Места учебы, работы, отдыха, службы</h2></div>


									<table cellpadding="3">
									<tr>
										<td width="150"><b>Нового места</b></td>
										<td>
											<select>
												<option>выберите тип</option>
												<option>Учебы</option>
												<option>Работы</option>
												<option>Отдыха</option>
												<option>Службы</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><b>Страна</b></td>
										<td>
											<select>
												<option>Россия</option>
												<option>Эстония</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><b>Город</b></td>
										<td><input type="text" style="width: 200px;" /></td>
									</tr>
									<tr>
										<td><b>Тип</b></td>
										<td><input type="text" style="width: 200px;" /></td>
									</tr>
									<tr>
										<td><b>Место</b></td>
										<td><input type="text" style="width: 200px;" /></td>
									</tr>
									<tr>
										<td colspan="2" align="right"><input type="submit" value="Добавить" /></td>
									</tr>
									</table>


								</div></div></div></div>



								<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
									<div class="block_title"><h2>Аватар</h2></div>

									<table cellpadding="3">
									<tr>
										<td colspan="2" id="micro2">Аватар - это картинка, которая может быть показана рядом с вашим именем в комментариях, блоге, личном профиле и т.д.<br/> Аватар должен быть не более 100х100 пикселей.</td>
									</tr>
									<tr>
										<td width="150" valign="top" style="padding-top: 5px;"><b>Файл</br></td>
										<td>
											<input type="file" style="width: 450px;" /><br />
											<span id="micro2">Принимаются форматы GIF, JPG, PNG</span>
										</td>
									</tr>
									<tr>
										<td colspan="2" align="right"><input type="submit" value="Загрузить аватар"></td>
									</tr>
									</table>

								</div></div></div></div>
							<!-- /правый блок -->
						</td>
					</tr>
					</table>
					<!-- /ПРОФИЛЬ -->
				</div>
			</div>
			<!-- /Главный блок, с вкладками (Контент) -->