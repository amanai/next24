<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
	<title><?php echo $this -> title; ?> | Административый интерфейс</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="<?php echo $this -> css_url;?>main.css" type="text/css" rel="StyleSheet"/>
	<link href="<?php echo $this -> css_url;?>desktop.css" type="text/css" rel="StyleSheet"/>
	<link href="<?php echo $this -> css_url;?>list.css" type="text/css" rel="StyleSheet"/>
	<link href="<?php echo $this -> css_url;?>dialog.css" type="text/css" rel="StyleSheet"/>
	<link href="<?php echo $this -> css_url;?>ajax.css" type="text/css" rel="StyleSheet"/>
	<link href="<?php echo $this -> css_url;?>datepicker.css" type="text/css" rel="StyleSheet"/>
	
	<script type="text/javascript" src="<?php echo $this -> js_url;?>jquery.js"></script>
	<script type="text/javascript" src="<?php echo $this -> js_url;?>jquery_pngfix.js"></script>
	<script type="text/javascript" src="<?php echo $this -> js_url;?>init.js"></script>
	<script type="text/javascript" src="<?php echo $this -> js_url;?>xpath.js"></script>
	<script type="text/javascript" src="<?php echo $this -> js_url;?>blockUI.js"></script>
	<script type="text/javascript" src="<?php echo $this -> js_url;?>ajax.js"></script>
	<script type="text/javascript" src="<?php echo $this -> js_url;?>datepicker.js"></script>
	<script type="text/javascript" src="<?php echo $this -> js_url;?>menu.js"></script>
</head>

<body>

<div class="sm" id="sub2"><ul>
	<li><a href="<?=$this->createUrl('AdminQuestionAnswer','CatList')?>">Категории вопросов</a></li>
	<li><a href="<?=$this->createUrl('AdminQuestionAnswer','QuestionList')?>">Вопросы</a></li>
</ul></div>
<div class="sm" id="sub3"><ul>
		<li><a href="<?=$this->createUrl('AdminArticle','ShowTree')?>">Категории статей</a></li>
	<li><a href="<?=$this->createUrl('AdminArticle','List')?>">Статьи</a></li>
</ul></div>

<table class="main">
	<!-- Header -->
	<tr>
		<td colspan="2" class="header">
			<div class="left">
				Административный интерфейс сайта next24.ru
			</div>

			<div class="right">
				<div class="button bbig"><a href="<?php echo $this -> createUrl('Admin', 'Logout')?>">Выход</a></div>
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
					<li><a href="#" class="sub" id="_sub2">Вопросы</a></li>
					<li><a href="#" class="sub" id="_sub3">Статьи</a></li>
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
				<div class="welcome">Здравствуйте, <?php echo $this -> current_user -> first_name." ".$this -> current_user -> middle_name; ?></div>
				<div class="lastvisit"><img src="<?php echo $this -> image_url;?>visit_left.gif" alt=""/><div>Вы зарегистрованы <?php echo date("Y-m-d", strtotime($this -> current_user -> registration_date)); ?></div><img src="<?php echo $this -> image_url?>visit_right.gif" alt=""/></div>
			</div>
			<?php echo $this -> flash_messages; ?>
			<div id="edit_block"></div>