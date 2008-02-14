<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
	<title><?php echo $this -> title; ?> | Административый интерфейс</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="<?php echo CSS_URL?>main.css" type="text/css" rel="StyleSheet"/>
	<link href="<?php echo CSS_URL?>desktop.css" type="text/css" rel="StyleSheet"/>
	<link href="<?php echo CSS_URL?>list.css" type="text/css" rel="StyleSheet"/>
	<link href="<?php echo CSS_URL?>dialog.css" type="text/css" rel="StyleSheet"/>
	<link href="<?php echo CSS_URL?>ajax.css" type="text/css" rel="StyleSheet"/>
	<link href="<?php echo CSS_URL?>datepicker.css" type="text/css" rel="StyleSheet"/>
	
	<script type="text/javascript" src="<?php echo JS_URL?>jquery.js"></script>
	<script type="text/javascript" src="<?php echo JS_URL?>jquery_pngfix.js"></script>
	<script type="text/javascript" src="<?php echo JS_URL?>init.js"></script>
	<script type="text/javascript" src="<?php echo JS_URL?>xpath.js"></script>
	<script type="text/javascript" src="<?php echo JS_URL?>blockUI.js"></script>
	<script type="text/javascript" src="<?php echo JS_URL?>ajax.js"></script>
	<script type="text/javascript" src="<?php echo JS_URL?>datepicker.js"></script>
</head>

<body>

<table class="main">
	<!-- Header -->
	<tr>
		<td colspan="2" class="header">
			<div class="left">
				Административный интерфейс сайта next24.ru
			</div>

			<div class="right">
				<div class="button bbig"><a href="<?php echo $this->router->createUrl('Admin', 'Logout')?>">Выход</a></div>
			</div>
		</td>
	</tr>
	<!-- /Header -->
	<!-- Middle -->
	<tr>

		<td class="c_left">
			<div class="mm">
				<table class="head">
					<tr>
						<td class="left">&nbsp;</td>
						<td class="cen">Главное меню</td>
						<td class="right">&nbsp;</td>
					</tr>

				</table>
				<ul>
					<?php foreach ($this -> main_menu as $menu_item) { ?>
						<li><a href="<?php echo $menu_item['link']; ?>"><?php echo $menu_item['name']; ?></a></li>
					<?php } ?>
				</ul>

				<table class="mm_footer">
					<tr>
						<td class="left">&nbsp;</td>
						<td class="cen">&nbsp;</td>
						<td class="right">&nbsp;</td>
					</tr>
				</table>
			</div>
		</td>

		<td class="c_middle">
			<div class="info">
				<div class="welcome">Здравствуйте, <?php echo $this -> userData['first_name']." ".$this -> userData['middle_name']; ?></div>
				<div class="lastvisit"><img src="<?php echo IMG_URL?>visit_left.gif" alt=""/><div>Вы зарегистрованы <?php echo date("Y-m-d", strtotime($this -> userData['registration_date'])); ?></div><img src="<?php echo IMG_URL?>visit_right.gif" alt=""/></div>
			</div>
		
			<?php echo $this->content; ?>
		</td>

	</tr>
	<!-- /Middle -->
	<!-- Footer -->
	<tr>
		<td colspan="2" class="footer">
			<div class="left">(с) Next24.ru Group. Все права защищены.</div>
			<div class="right"><a href="#">Личные данные</a> | <a href="#">Наверх</a> | <a href="#">Выход</a></div>

		</td>
	</tr>
	<!-- /Footer -->
</table>

</body>
</html>