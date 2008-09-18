<html>
<head>
	<title>Next24</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<!--<script type="text/javascript" src="<?php echo $this -> js_url;?>sys.js"></script>
	<script type="text/javascript" src="<?php echo $this -> js_url;?>tab.js"></script>
	<script type="text/javascript" src="<?php echo $this -> js_url;?>jquery.js"></script>
	<script type="text/javascript" src="<?php echo $this -> js_url;?>xpath.js"></script>
	<script type="text/javascript" src="<?php echo $this -> js_url;?>blockUI.js"></script>
	<script type="text/javascript" src="<?php echo $this -> js_url;?>ajax.js"></script>
	<script type="text/javascript" src="<?php echo $this -> js_url;?>jquery.dimensions.js"></script>
	<script type="text/javascript" src="<?php echo $this -> js_url;?>jquery.date_input.pack.js"></script>
	<script type="text/javascript" src="<?php echo $this -> js_url;?>jquery.date_input.ru_RU.js"></script>
	<script type="text/javascript" src="<?php echo $this -> js_url;?>jquery.date_input.format.js"></script>-->
	
	<link href="<?=$this->getBothCJ($this -> _css_files,'css');?>" type="text/css" rel="StyleSheet"/>
	<script type="text/javascript" src="<?=$this->getBothCJ($this -> _js_files,'js');?>"></script>
</head>
<body>
<table width="100%" height="100%" cellpadding="0">
<tr>
	<td class="header">
		<!-- HEADER -->
		<table width="100%" height="180" cellpadding="0">
		<tr>
			<td width="270"><a href="/"><img src="<?php echo $this -> image_url;?>logo.png" width="270" height="180" /></a></td>
			<td class="header2" align="right">
				<!-- Блок авторизации -->
				<?php if($this->current_user && ((int)$this->current_user->id > 0)) {?>
					<table width="210" height="125" cellpadding="0">
					<tr>
						<td class="user1"> </td>
						<td class="user2">

							<div class="user2_title">ДОБРО ПОЖАЛОВАТЬ</div>
							<div class="user2_zz">
								<a href="<?php echo $this->createUrl('User', 'Profile', null, $this->current_user->login)?>">Профиль</a><br />
								<a href="<?php echo $this->createUrl('Photo', 'LastList', null, $this->current_user->login)?>">Фотоальбом</a><br />
								<a href="<?php echo $this->createUrl('Subscribe', 'List', null, $this->current_user->login)?>">Подписка</a><br />

								<a href="#">Дневник</a><br />
								<!--<a href="#">Сообщения</a>-->
							</div>

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
								<div class="user2_x"><input type="checkbox" id="remember" name="remember" value="1" style="padding: 0px;" /> <label for="remember"></>Запомнить</label> <input type="submit" value="Вход" style="width: 45px;" /></div>
								<div class="user2_x"><a href="#">Забыли пароль?</a> | <a href="<?php echo $this->createUrl('User', 'RegistrationForm');?>">Регистрация</a></div>
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
						<a href="<?php echo $this->createUrl('Article', 'List', null, false); ?>">Статьи</a><br />
						<a href="<?php echo $this->createUrl('SearchUser','SearchUserMain'); ?>">Найти знакомых</a><br />
						<a href="#">Дневники</a><br />
						<a href="<?php echo $this->createUrl('QuestionAnswer', 'List', null, false); ?>">Вопрос-ответ</a><br />
						<a href="<?php echo $this->createUrl('Album', 'LastList', null, false); ?>">Фотоальбомы</a><br />
            <a href="<?php echo $this->createUrl('Bookmarks', 'BookmarksList', null, false); ?>">Закладки</a><br />
            <a href="<?php echo $this->createUrl('Social', 'SocialMainList', null, false); ?>">Соц. разделы</a>
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