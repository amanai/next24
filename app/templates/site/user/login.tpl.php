<?php include($this -> _include('../header.tpl.php')); ?>
<form action="<?php echo $this->createUrl('User', 'Login')?>" method="POST">
	<input type="hidden" value="<?php echo $this->lastPath; ?>" name="lastPath">
	<table align="center" cellpadding="0">
	<tr>
	   <td colspan="2"><?=$this -> flash_messages; ?></td>
	</tr>
	<tr>
		<td>Логин:</td>
		<td><input type="text" style="width: 130px;" name="login"/></td>
	</tr>
	<tr>
		<td>Пароль:</td>
		<td><input type="password" style="width: 130px;" name="pass"/></td>
	</tr>
	<tr>
		<td colspan="2">
			<div class="user2_x"><input type="checkbox" style="padding: 0px;" /> Запомнить <input type="submit" value="Вход" style="width: 45px;" /></div>
			<div class="user2_x"><a href="#">Потеряли пароль?</a> | <a href="<?php echo $this->createUrl('User', 'RegistrationForm');?>">Регистрация</a></div>
		</td>
	</tr>
	</table>
</form>
<?php include($this -> _include('../footer.tpl.php')); ?>