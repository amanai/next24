<html>
<head>
	<title>Next24</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="<?php echo $this -> css_url;?>style.css" type="text/css" rel="StyleSheet" />
	<link href="<?php echo $this -> css_url;?>tabpane.css" type="text/css" rel="StyleSheet"	/>
	<script type="text/javascript" src="<?php echo $this -> js_url;?>tabpane.js"></script>
	<script type="text/javascript" src="<?php echo $this -> js_url;?>sys.js"></script>		
</head>
<body>
<table width="100%" height="100%" cellpadding="0">
<tr>
	<td class="header">
		<!-- HEADER -->
		<table width="100%" height="180" cellpadding="0">
		<tr>
			<td width="270"><a href="#"><img src="<?php echo $this -> image_url;?>logo.png" width="270" height="180" /></a></td>
			<td class="header2" align="right">
				<!-- Блок авторизации -->
				<?php if((int)$this->current_user->id > 0) {?>
					<table width="210" height="125" cellpadding="0">
					<tr>
						<td class="user1"> </td>
						<td class="user2">

							<div class="user2_title">ДОБРО ПОЖАЛОВАТЬ</div>
							<div class="user2_zz">
								<a href="<?php echo $this->createUrl('User', 'Profile', null, $this->current_user->login)?>">Профиль</a><br />
								<a href="<?php echo $this->createUrl('Album', 'List', null, $this->current_user->login)?>">Фотоальбом</a><br />
								<a href="#">Дневник</a><br />
								<a href="#">Сообщения</a>
							</div>

							<div style="float: left;"><a href="#"><img src="<?php echo $this -> image_url;?>open.png" width="21" height="24" /></a></div>
							<div align="right" style="padding-top: 7px;">Вы вошли как: <a href="<?php echo $this->createUrl('User', 'Profile', null, $this->current_user->login)?>"><?php echo $this->current_user->login;?></a></div>

						</td>
						<td class="user3"> </td>
						<td width="20"><a href="<?php echo $this->createUrl('User', 'Logout')?>"><img src="<?php echo $this -> image_url;?>exit.png" width="20" height="63" /></a></td>
					</tr>
					</table>					
				<?php } else { ?>
					<table width="220" height="125" cellpadding="0">
					<tr>
						<td class="user1"> </td>
						<td class="user2">
							<form action="<?php echo $this->createUrl('User', 'Login')?>" method="POST">
								<input type="hidden" value="<?php echo $this->lastPath; ?>" name="lastPath">
								<div class="user2_title">АВТОРИЗАЦИЯ</div>
								<table align="center" cellpadding="0">
								<tr>
									<td>Логин:</td>
									<td><input type="text" style="width: 130px;" name="login"/></td>
								</tr>
								<tr>
									<td>Пароль:</td>
									<td><input type="password" style="width: 130px;" name="pass"/></td>
								</tr>
								</table>
								<div class="user2_x"><input type="checkbox" style="padding: 0px;" /> Запомнить <input type="submit" value="Вход" style="width: 45px;" /></div>
								<div class="user2_x"><a href="#">Потеряли пароль?</a> | <a href="#">Регистрация</a></div>
							</form>
						</td>
						<td class="user3"> </td>
					</tr>
					</table>	
				<?php } ?>		
				<!-- /Блок авторизации -->
			
							</td>
			<td width="170">
				<!-- Навигация -->
				<table width="170" height="180" cellpadding="0">
				<tr>
					<td class="menu1"> </td>
					<td class="menu2"> </td>
					<td class="menu3">
						<a href="#">Новости</a><br />
						<a href="#">Статьи</a><br />
						<a href="#">Найти знакомых</a><br />
						<a href="#">Дневники</a><br />
						<a href="<?php echo $this->createUrl('QuestionAnswer', 'List', null, false)?>">Вопрос-ответ</a><br />
						<a href="<?php echo $this->createUrl('Album', 'LastList', null, false);?>">Фотоальбомы</a><br />
						<a href="#">Топы</a>
					</td>
				</tr>
				</table>
				<!-- /Навигация -->
			</td>
		</tr>
		</table>		
		<!-- /HEADER -->
	</td>
</tr>
<tr>
	<td valign="top">
	<!-- ТЕЛО САЙТА -->
	<table width="100%" cellpadding="0">
	<tr>
		<td class="next24">