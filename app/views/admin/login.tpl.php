<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head><title>Авторизация</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
	<link href="<?php echo CSS_URL?>main.css" type="text/css" rel="StyleSheet"/>
	<link href="<?php echo CSS_URL?>dialog.css" type="text/css" rel="StyleSheet"/>
	<script type="text/javascript" src="<?php echo JS_URL?>jquery.js"></script>
	<script type="text/javascript" src="<?php echo JS_URL?>jquery_pngfix.js"></script>
	<script type="text/javascript" src="<?php echo JS_URL?>init.js"></script>

</head><body>
<form action="<?php echo $this->router->createUrl('Admin', 'Login')?>" name="login" method="POST">
<table cellspacing="0" cellpadding="0" border="0" width="100%" height="100%">
<tr><td align="center" valign="middle">
			<table class="dialog">
				<tr>
					<td class="h_left">&nbsp;</td>
					<td class="h_cen">
						<div class="text">Вход в систему</div>
					</td>

					<td class="h_right">&nbsp;</td>
				</tr>
				<tr>
					<td class="c_left">&nbsp;</td>
					<td class="c_cen"><table cellspacing="4" style="font-family: Arial; font-size: 12px;">
						<?php if ($this -> login_result === false) { ?>
							<tr><td colspan="2" align="center"><font color="red">Неправильное имя или пароль</font></td></tr>
						<?php } ?>
						<tr><td>Имя</td><td><input type="text" name="u_login" value=""/></td></tr><tr><td>Пароль</td><td><input type="password" name="u_pass" value=""/><input type="hidden" name="auth_enter" value="1"></td></tr></table></td>
					<td class="c_right">&nbsp;</td>
				</tr>

				<tr>
					<td class="b_left">&nbsp;</td>
					<td class="b_cen"><div class="b_delim">
						<div class="button bbig" style="float: right;"><a href="#" onClick="document.forms.login.submit();">Вход</a></div>
					</div></td>
					<td class="b_right">&nbsp;</td>
				</tr>
			</table>

			
			</td>
			</tr>
			</table>
</form></body>
</html>