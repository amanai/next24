<link href="<?php echo $this -> css_url;?>registration.css" type="text/css" rel="StyleSheet" />
<script type="text/javascript" src="<?php echo $this -> js_url;?>jquery.autocomplete-1.4.2.js"></script>
<form action="<?php echo $this -> save_url; ?>" method="post" id="register_form">
<table class="registration_form" cellpadding="4">

	<tr>
		<td class="registration_form label">Логин*</td>
		<td class="registration_form value"><input type="text" style="float:left;" name="login" value="<?php echo $this -> helper -> login;?>" /></td>
	</tr>
	<tr>
		<td class="registration_form label">Пароль*</td>
		<td class="registration_form value"><input type="password" name="pwd" /></td>
	</tr>
	<tr>
		<td class="registration_form label">Подтверждение пароля*</td>
		<td class="registration_form value"><input type="password" name="pwd_repeat" /></td>
	</tr>
	<tr>
		<td class="registration_form label">Email*</td>
		<td class="registration_form value"><input type="text" name="email" value="<?php echo $this -> helper -> email;?>" /></td>
	</tr>
	<tr>
		<td class="registration_form label">Фамилия</td>
		<td class="registration_form value"><input type="text" name="surname" value="<?php echo $this -> helper -> surname;?>" /></td>
	</tr>
	<tr>
		<td class="registration_form label">Имя</td>
		<td class="registration_form value"><input type="text" name="name" value="<?php echo $this -> helper -> name;?>" /></td>
	</tr>
	<tr>
		<td class="registration_form label">Отчество</td>
		<td class="registration_form value"><input type="text" name="father_name" value="<?php echo $this -> helper -> father_name;?>" /></td>
	</tr>
	<tr>
		<td class="registration_form label">Дата рождения</td>
		<td class="registration_form value">
			<select style="width:50px;" name="year">
				<?php foreach($this -> year_list as $item) { ?>
					<option value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> year === (int)$item['id']){ echo 'selected';}?>><?php echo $item['value'];?></option>
				<?php } ?>
			</select>
			<select style="width:120px;" name="month">
				<?php foreach($this -> month_list as $item) { ?>
					<option value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> year === (int)$item['id']){ echo 'selected';}?>><?php echo $item['value'];?></option>
				<?php } ?>
			</select>
			<select style="width:40px;" name="day">
				<?php foreach($this -> day_list as $item) { ?>
					<option value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> year === (int)$item['id']){ echo 'selected';}?>><?php echo $item['value'];?></option>
				<?php } ?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="registration_form label">Страна</td>
		<td class="registration_form value">
			<select name="country">
				<?php foreach($this -> country_list as $item) { ?>
					<option onclick='ajax(<?php echo $item['change_country_param'];?>);' value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> country === (int)$item['id']){ echo 'selected';}?>><?php echo $item['title'];?></option>
				<?php } ?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="registration_form label">Область</td>
		<td class="registration_form value">
			<div id="state_div">
				<select></select>
			</div>
			<!--<input type="text" name="state" value="<?php echo $this -> helper -> state;?>" />-->
		</td>
	</tr>
	<tr>
		<td class="registration_form label">Город</td>
		<td class="registration_form value">
			<div id="city_div">
				<select></select>
			</div>
			<!--<input type="text" name="city" value="<?php echo $this -> helper -> city;?>" />-->
		</td>
	</tr>
	<tr>
		<td class="registration_form label">Пол</td>
		<td class="registration_form value">
			<input type="radio" name="gender" value="0" />ж
			<input type="radio" name="gender" value="1" />м
		</td>
	</tr>
	<tr>
		<td class="registration_form label">Семейное положение</td>
		<td class="registration_form value"><input type="text" name="martial_status" value="<?php echo $this -> helper -> martial_status;?>" /></td>
	</tr>
	<tr>
		<td class="registration_form label">ICQ</td>
		<td class="registration_form value"><input type="text" name="icq" value="<?php echo $this -> helper -> icq;?>" /></td>
	</tr>
	<tr>
		<td class="registration_form label">Сайт</td>
		<td class="registration_form value"><input type="text" name="website" value="<?php echo $this -> helper -> website;?>" /></td>
	</tr>
	<tr>
		<td class="registration_form label">Телефон</td>
		<td class="registration_form value"><input type="text" name="phone" value="<?php echo $this -> helper -> phone;?>" /></td>
	</tr>
	<tr>
		<td class="registration_form label">Мобильный телефон</td>
		<td class="registration_form value"><input type="text" name="mobile_phone" value="<?php echo $this -> helper -> mobile_phone;?>" /></td>
	</tr>
	<tr>
		<td class="registration_form label">О себе</td>
		<td class="registration_form value">
			<textarea name="about"><?php echo $this -> helper -> about;?></textarea>
		</td>
	</tr>
	<tr>
		<td class="registration_form label">Интересы</td>
		<td class="registration_form value">
			<textarea name="interest"><?php echo $this -> helper -> interest;?></textarea>
		</td>
	</tr>
	<tr>
		<td class="registration_form label">Любимые книги</td>
		<td class="registration_form value">
			<textarea name="books"><?php echo $this -> helper -> books;?></textarea>
		</td>
	</tr>
	<tr>
		<td class="registration_form label">Любимые фильмы</td>
		<td class="registration_form value">
			<textarea name="films"><?php echo $this -> helper -> films;?></textarea>
		</td>
	</tr>
	<tr>
		<td class="registration_form label">Любимые музыканты</td>
		<td class="registration_form value">
			<textarea name="musicians"><?php echo $this -> helper -> musicians;?></textarea>
		</td>
	</tr>
	<tr>
		<td class="registration_form label">Логин порекомендовавшего зарегистрироваться</td>
		<td class="registration_form value"><input type="text" name="referer" value="<?php echo $this -> helper -> referer;?>" /></td>
	</tr>
	<tr>
		<td align="center"><input type="button" onclick='save(<?php echo $this -> validate_param; ?>)' value="Проверить данные" /></td>
		<td align="center"><input type="button" onclick='save(<?php echo $this -> save_param; ?>)' value="Зарегистрироваться" /></td>
	</tr>
</table>
