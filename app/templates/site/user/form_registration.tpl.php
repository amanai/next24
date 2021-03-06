<form action="<?=$this->edit?$this -> createUrl('User', 'Saveprofile'):$this -> createUrl('User', 'Registration'); ?>" method="post" id="register_form">
<?=$this -> flash_messages; ?>

<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
<div class="block_title">
		<div class="block_title_left"><h1>Обязательные данные</h1></div>
		<div class="block_title_right">
			<img src="<?php echo $this -> image_url;?>/<?=(($this->helper->user_profile_js_state==1||!$this->helper->user_profile_js_state)?'close.png':'open.png')?>" width="21" height="24" onclick="ShowOrHide(this, 'user_profile_js'); setState('user_profile_js_state'); return false;" style="cursor: pointer;" />
		</div>
</div>

<input type="hidden" name="user_profile_js_state" id="user_profile_js_state" value="<?=($this->helper->user_profile_js_state?$this->helper->user_profile_js_state:1)?>"/>
<div id="user_profile_js" <?=(($this->helper->user_profile_js_state==1||!$this->helper->user_profile_js_state)?'':'style="display: none;"')?>>

<table class="regdetails" cellpadding="5">
	<tr>
		<td colspan="2">
			<p>Символом <span class="necessary">*</span> отмечены поля, обязательные для заполнения.</p><br/>
		</td>
	</tr>
	<tr>
		<td class="label<?=($this->email_error?' red':'')?>">Email</td>
		<td>
			<? if (!$this->edit) { ?>
			<input type="text" name="email" onBlur='if ($(this).val().length>0) { sendParams(<?=$this->check_email; ?>, {"email":$(this).val()}, true); }' value="<?php echo $this -> helper -> email;?>" class="field"/><span class="necessary">*</span>
			<div id="email_check_result"></div>
			<div id="micro2" style="width: 350px;">Ваш электронный адрес. Пожалуйста, указывайте существующий адрес, так как на него вам будет отправлена техническая информация о доступе на сайт.</div>
			<? } else { ?>
			<?=$this -> helper -> email;?>
			<? } ?>		
		</td>
	</tr>
	<tr>
		<td class="label<?=($this->login_error?' red':'')?>">Логин</td>
		<td>
			<? if (!$this->edit) { ?>
			<input type="text" name="login" onBlur='if ($(this).val().length>0) { sendParams(<?=$this->check_login; ?>, {"login":$(this).val()}, true); }' id="login" value="<?php echo $this -> helper -> login;?>" class="field"/><span class="necessary">*</span>
			<div id="login_check_result"></div>
			<div id="micro2" style="width: 350px;">Логин — это ваше имя внутри сайта, старайтесь выбирать осмысленное название. Вы можете использовать латинские буквы и цифры, а также подчеркивание и символ дефиса. Имя не должно начинаться с дефиса или подчеркивания и должно быть не короче четырех символов.</div>
			<? } else { ?>
			<?=$this -> helper -> login;?>
			<? } ?>
		</td>
	</tr>
	<tr>
		<td class="label<?=($this->pass_error?' red':'')?>"><? if (!$this->edit) { ?>Пароль<? } else { ?>Новый пароль (если хотите изменить)<? } ?></td>
		<td>
			<input type="password" name="pwd" class="field"/><span class="necessary">*</span>
			<div id="micro2" style="width: 350px;">Пароль может содержать латинские буквы, цифры и спецсимволы и должен быть не короче 6 символов.</div>
		</td>
	</tr>
	<tr>
		<td class="label">Подтверждение пароля</td>
		<td>
			<input type="password" name="pwd_repeat" class="field"/><span class="necessary">*</span>
			<div id="micro2" style="width: 350px;">Должен полностью совпадать с паролем.</div>
		</td>
	</tr>
	<? if (!$this->edit){ ?>
	<tr>
		<td class="label<?=($this->captcha_error?' red':'')?>">Текст с картинки</td>
		<td>
			<img src="<?=$this -> image_url;?>kcaptcha/" align="absmiddle"/>
			<input type="text" name="captcha" style="width: 210px;" value="" class="field"/><span class="necessary">*</span>
			<div id="micro2" style="width: 350px;">Введите текст, который вы видите на картинке.</div>
		</td>
	</tr>
	<? } ?>
</table>
</div>
</div></div></div></div>


<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
<div class="block_title">
		<div class="block_title_left"><h1>Основная информация о себе (+15 баллов рейтинга максимально, +1.5 NextMoney максимально)</h1></div>
		<div class="block_title_right">
			<img src="<?php echo $this -> image_url;?>/<?=(($this->helper->user_profile_js1_state==2||!$this->helper->user_profile_js1_state)?'open.png':'close.png')?>" width="21" height="24" onclick="ShowOrHide(this, 'user_profile_js1'); setState('user_profile_js1_state'); return false;" style="cursor: pointer;" />
		</div>
</div>

<input type="hidden" name="user_profile_js1_state" id="user_profile_js1_state" value="<?=($this->helper->user_profile_js1_state?$this->helper->user_profile_js1_state:2)?>"/>
<div id="user_profile_js1" <?=(($this->helper->user_profile_js_state==2||!$this->helper->user_profile_js_state)?'style="display: none;"':'')?>>
<table class="regdetails" cellpadding="4">

	<tr>
		<td class="label">Фамилия</td>
		<td>
			<input type="text" name="surname" value="<?php echo $this -> helper -> surname;?>" class="field"/>
			<div id="micro2" style="width: 350px;">Ваша реальная фамилия. Допустима кириллица, пробел и символ дефиса. Если вы хотите участвовать в поиске своих друзей, пожалуйста, введите свою реальную фамилию.</div>
		</td>
	</tr>
	<tr>
		<td class="label">Имя</td>
		<td>
			<input type="text" name="name" value="<?php echo $this -> helper -> name;?>" class="field"/>
			<div id="micro2" style="width: 350px;">Ваше реальное имя. Допустима кириллица, пробел и символ дефиса. Если вы хотите участвовать в поиске своих друзей, пожалуйста, введите своё реальное имя.</div>
		</td>
	</tr>
	<tr>
		<td class="label">Отчество</td>
		<td>
			<input type="text" name="father_name" value="<?php echo $this -> helper -> father_name;?>" class="field"/>
			<div id="micro2" style="width: 350px;">Ваше отчество. Допустима кириллица, пробел и символ дефиса. Если вы хотите участвовать в поиске своих друзей, пожалуйста, введите свое реальное отчество.</div>
		</td>
	</tr>
	<tr>
		<td class="label">Дата рождения</td>
		<td>
			<select style="width:40px;" name="day">
				<?php foreach($this -> day_list as $item) { ?>
					<option value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> day === (int)$item['id']){ echo 'selected="selected"';}?>><?php echo $item['value'];?></option>
				<?php } ?>
			</select>
			<select style="width:120px;" name="month">
				<?php foreach($this -> month_list as $item) { ?>
					<option value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> month === (int)$item['id']){ echo 'selected="selected"';}?>><?php echo $item['value'];?></option>
				<?php } ?>
			</select>
			<select style="width:50px;" name="year">
				<?php foreach($this -> year_list as $item) { ?>
					<option value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> year === (int)$item['id']){ echo 'selected="selected"';}?>><?php echo $item['value'];?></option>
				<?php } ?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="label">Страна</td>
		<td>
			<select name="country" id="country" onChange='changeList(<?=$this->change_country_param;?>, this);' class="field">
				<?php foreach($this -> country_list as $item) { ?>
					<option value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> country === (int)$item['id']){ echo 'selected="selected"';}?>><?php echo $item['name'];?></option>
				<?php } ?>
			</select>
			<div id="loading"></div>
			<div id="micro2" style="width: 350px;">Страна проживания.</div>
		</td>
	</tr>
	<tr>
		<td class="label">Область</td>
		<td>
			<div id="state_div">
			<?php if ($this->state_list) { ?>
				<select name="state" id="state" onChange='changeList(<?=$this->change_state_param;?>, this);' class="field">
					<option value="0">---</option>
					<?php foreach($this -> state_list as $item) { ?>
						<option value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> state === (int)$item['id']){ echo 'selected="selected"';}?>><?php echo $item['name'];?></option>
					<?php } ?>
				</select>
			<?php } else { ?>
			
				<select class="field" name="state">
					<option value="0">---</option>
				</select>
				
			<? } ?>
			</div>
			<div id="micro2" style="width: 350px;">Область проживания.</div>
		</td>
	</tr>
	<tr>
		<td class="label">Город</td>
		<td>
			<div id="city_div">
				
			<?php if ($this->city_list) { ?>
				<select name="city" id="city" class="field">
					<option value="0">---</option>
					<?php foreach($this -> city_list as $item) { ?>
						<option value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> city === (int)$item['id']){ echo 'selected';}?>><?php echo $item['name'];?></option>
					<?php } ?>
				</select>
			<?php } else { ?>
			
				<select class="field" name="city">
					<option value="0">---</option>
				</select>
				
			<? } ?>
			
			</div>
			<div id="micro2" style="width: 350px;">Город проживания.</div>
		</td>
	</tr>
	<tr>
		<td class="label">Пол</td>
		<td>
			<input type="radio" name="gender" id="gender_male" value="1" class="radio"<?=($this->helper->gender==1?' checked="checked"':'')?>/><label for="gender_male">Мужской</label>
			<input type="radio" name="gender" id="gender_female" value="0" class="radio"<?=($this->helper->gender==0?' checked="checked"':'')?>/><label for="gender_female">Женский</label>
		</td>
	</tr>
	<tr>
		<td class="label">Семейное положение</td>
		<td>
			<input type="text" name="marital_status" value="<?php echo $this -> helper -> marital_status;?>" class="field"/>
			<div id="micro2" style="width: 350px;">Ваше семейное положение.</div>
		</td>
	</tr>
	<tr>
		<td class="label">ICQ</td>
		<td>
			<input type="text" name="icq" value="<?php echo $this -> helper -> icq;?>" class="field"/>
			<div id="micro2" style="width: 350px;">Ваш номер ICQ.</div>
		</td>
	</tr>
	<tr>
		<td class="label">Сайт</td>
		<td>
			<input type="text" name="website" value="<?php echo $this -> helper -> website;?>" class="field"/>
		</td>
	</tr>
	<tr>
		<td class="label">Телефон</td>
		<td>
			<input type="text" name="phone" value="<?php echo $this -> helper -> phone;?>" class="field"/>
		</td>
	</tr>
	<tr>
		<td class="label">Мобильный телефон</td>
		<td>
			<input type="text" name="mobile_phone" value="<?php echo $this -> helper -> mobile_phone;?>" class="field"/>
		</td>
	</tr>
</table>
</div>
</div></div></div></div>


<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
<div class="block_title">
		<div class="block_title_left"><h1>Дополнительная информация о себе (+4 балла рейтинга максимально, +1.5 NextMoney максимально)</h1></div>
		<div class="block_title_right"><img src="<?php echo $this -> image_url;?>/<?=(($this->helper->user_profile_js2_state==2||!$this->helper->user_profile_js2_state)?'open.png':'close.png')?>" width="21" height="24" onclick="ShowOrHide(this, 'user_profile_js2'); setState('user_profile_js2_state'); return false;" style="cursor: pointer;" /></div>
</div>
<input type="hidden" name="user_profile_js2_state" id="user_profile_js2_state" value="<?=($this->helper->user_profile_js2_state?$this->helper->user_profile_js2_state:2)?>"/>
<div id="user_profile_js2" <?=(($this->helper->user_profile_js2_state==2||!$this->helper->user_profile_js2_state)?'style="display: none;"':'')?>>
<table class="regdetails" cellpadding="4">
	
	<tr>
		<td class="label">О себе</td>
		<td>
			<textarea name="about"><?php echo $this -> helper -> about;?></textarea>
		</td>
	</tr>
	<tr>
		<td class="label">Интересы</td>
		<td>
			<textarea name="interest"><?php echo $this -> helper -> interest;?></textarea>
			<div id="micro2" style="width: 350px;">Ваши интересы, перечисленные через запятую.</div>
		</td>
	</tr>
	<tr>
		<td class="label">Любимые книги</td>
		<td>
			<textarea name="books"><?php echo $this -> helper -> books;?></textarea>
			<div id="micro2" style="width: 350px;">Ваши любимые книги, перечисленные через запятую.</div>
		</td>
	</tr>
	<tr>
		<td class="label">Любимые фильмы</td>
		<td>
			<textarea name="films"><?php echo $this -> helper -> films;?></textarea>
			<div id="micro2" style="width: 350px;">Ваши любимые фильмы, перечисленные через запятую.</div>
		</td>
	</tr>
	<tr>
		<td class="label">Любимые музыканты</td>
		<td>
			<textarea name="musicians"><?php echo $this -> helper -> musicians;?></textarea>
			<div id="micro2" style="width: 350px;">Ваши любимые музаканты, перечисленные через запятую.</div>
		</td>
	</tr>
	<? if (!$this->edit) { ?>
	<tr>
		<td class="label">Логин порекомендовавшего зарегистрироваться</td>
		<td>
			<input type="text" name="referer" value="<?php echo $this -> helper -> referer;?>" class="field"/>
			<div id="micro2" style="width: 350px;">Логин пользователя, порекомендовавшего Вам зарегистрироваться в next24.ru.</div>
		</td>
	</tr>
	<? } ?>
</table>
</div>
</div></div></div></div>
<input type="submit" name="register" value="<? if (!$this->edit) { ?>Зарегистрируйте меня<? } else { ?>Сохранить профиль<? } ?>" />
</form>
