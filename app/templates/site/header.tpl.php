<!DOCTYPE html 	PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title><?=$this->page_title;?></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="<?=$this->getBothCJ($this -> _css_files,'css');?>" type="text/css" rel="StyleSheet"/>
		<script type="text/javascript" src="<?=$this->getBothCJ($this -> _js_files,'js');?>"></script>
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
		<link id="page_favicon" href="/favicon.ico" rel="icon" type="image/x-icon" />
		<link type="text/css" rel="stylesheet" href="/app/css/screen.css"  media="screen" />
		<!--[if lte IE 7]><link type="text/css" rel="stylesheet" href="/app/css/ie.css"  media="screen" /><![endif]-->
		<!--[if lte IE 6]><script language="javascript" type="text/javascript" src="/app/css/minmax.js"></script><![endif]-->
	</head>
	<body id="main">

		<div class="bone">

			<div class="head">

				<p class="logo"><a href="<?php echo $this->createUrl('Index', 'Index', null, false); ?>" title="Главная страница"><img src="/app/images/logo.png" alt="Next24" /></a></p>

				<div class="site-info clearfix">
					<p>Новое на портале: <a href="#">Появился раздел Дебаты</a>.</p>
					<ul>
						<li class="alt"><a href="#">Тур по сайту</a> |</li>
						<li><a href="#">О проекте</a> |</li>
						<li><a href="#">Сервисы</a> |</li>
						<li><a href="#">Обратная связь</a> |</li>
						<li><a href="#">Реклама</a></li>
					</ul>
				</div>
				<!-- /site-info -->

				<div class="user-bar clearfix">
				<?php 
				//	$v_session = Project::getSession();
				//	print '<pre>!!!!!!!!!!!!!!';
				//		 print_r($v_session -> getKey('logged', false));
				//	print '</pre>';	 				
				?>
				<?php if($this->current_user && ((int)$this->current_user->id > 0)) {?>
				<?php 
					$nr = Project::getUser()->getDbUser()->getUserRateNMByRegistrationData($this->current_user->id);				
				?>
					<ul>
						<li class="user-link"><a href="<?php echo $this->createUrl('User', 'Profile', null, $this->current_user->login)?>"><img style="width: 28px; height: 25px;" src="assets/i/temp/user.png" alt="<?php echo $this->current_user->login;?>" /><?php echo $this->current_user->login;?></a></li>
						<li class="updates-link"><i class="icon updates-icon"></i><a href="#" class="script-link"><span class="t">Обновления (30)</span><i class="arrow-icon"></i></a></li>
						<li class="actions-link"><i class="icon actions-icon"></i><a href="#" class="script-link"><span class="t">Действия</span><i class="arrow-icon"></i></a></li>
						<li class="rating-link"><i class="icon rating-icon"></i><a href="#"><?=$nr['rate']; ?> nr</a> <span class="sep">|</span> <a href="#" class="alt"><?=$nr['nm']; ?> nm</a></li>
						<li class="login-link">
							<span class="settings-link"><i class="icon settings-icon"></i><a href="<?php echo $this->createUrl('User', 'Profile', null, $this->current_user->login)?>">Настройки</a></span>
							<span class="logout-link"><a href="<?php echo $this->createUrl('User', 'Logout')?>">Выход</a></span>
						</li>
					</ul>					
				<?php } else { ?>
					<ul>
						<li class="not-login-link">
							<i class="icon close-icon"></i><span class="cabinet-link"><a href="/site_login" class="script-link"><span class="t">Личный кабинет</span></a></span>
							| <span class="register-link"><a href="<?php echo $this->createUrl('User', 'RegistrationForm');?>">Регистрация</a></span>
						</li>
					</ul>				
				<? } ?>	
				</div>
				<!-- /user-bar -->
				<?php if($this->current_user && ((int)$this->current_user->id > 0)) {?>
				<ul class="user-menu">
					<li><a href="<?php echo $this->createUrl('User', 'Profile', null, $this->current_user->login)?>"><span>Профиль</span></a> |</li>
					<li><a href="<?php echo $this->createUrl('Messages', 'Mymessages', null, $this->current_user->login)?>"><span>Мои сообщения</span> <em class="alt">(<span>3</span>)</em></a> |</li>
					<li><a href="<?php echo $this->createUrl('Messages', 'Friend'); ?>"><span>Друзья</span> <em>(35)</em></a> |</li>
					<li><a href="<?php echo $this->createUrl('Album', 'List', null, $this->current_user->login)?>"><span>Фотоальбом</span> <em>(5)</em></a> |</li>
					<li><a href="<?php echo $this->createUrl('Blog', 'PostList', null, $this->current_user->login)?>"><span>Блог</span> <em>(5)</em></a> |</li>
					<li><a href="#"><span>Дневник</span> <em>(8)</em></a> |</li>
					<li><a href="<?php echo $this->createUrl('Bookmarks', 'BookmarksUser', null, $this->current_user->login);?>"><span>Закладки</span> <em>(39)</em></a> |</li>
					<li><a href="<?php echo $this->createUrl('QuestionAnswer', 'UserQuestions', null, $this->current_user->login); ?>"><span>Ответы</span> <em>(3)</em></a> |</li>
					<li><a href="<?php echo $this->createUrl('Subscribe', 'List', null, $this->current_user->login)?>"><span>Подписка</span> <em>(4)</em></a></li>
				</ul>
				<!-- /user-menu -->
				<? } ?>
				<?php $request = Project::getRequest(); ?>
				<?php $currentController = $request->getCurrentControllerName(); ?>
				<ul class="menu clearfix">
					<li class="no-text <? if($currentController=='Index') {echo 'active';}?>"><a href="<?php echo $this->createUrl('Index', 'Index', null, false); ?>" title="Рабочий стол"><i class="icon desktop-icon"></i></a></li>
					<li class="no-text"><a href="#" title="Моя страница"><i class="icon home-icon"></i></a></li>
					<li <? if($currentController=='News') {echo 'class="active"';}?>><a href="<?php echo $this->createUrl('News', 'News', null, false).'/view:news_all/'; ?>"><i class="icon news-icon"></i>Новости</a></li>
					<li class="alt <? if($currentController=='Debate') {echo 'active';}?>"><a href="<?php echo $this->createUrl('Debate', 'DebateHistory', null, false); ?>"><i class="icon debate-icon"></i>Дебаты</a></li>
					<li <? if($currentController=='Article') {echo 'class="active"';}?>><a href="<?php echo $this->createUrl('Article', 'List', null, false); ?>"><i class="icon articles-icon"></i>Статьи</a></li>
					<li <? if($currentController=='Album') {echo 'class="active"';}?>><a href="<?php echo $this->createUrl('Album', 'LastList', null, false); ?>"><i class="icon foto-icon"></i>Фото</a></li>
					<li <? if($currentController=='QuestionAnswer') {echo 'class="active"';}?>><a href="<?php echo $this->createUrl('QuestionAnswer', 'List', null, false); ?>"><i class="icon answers-icon"></i>Ответы</a></li>
					<li <? if($currentController=='Blog') {echo 'class="active"';}?>><a href="<?php echo $this->createUrl('Blog', 'PublicList', null, false); ?>"><i class="icon blogs-icon"></i>Блоги</a></li>
					<li <? if($currentController=='Social') {echo 'class="active"';}?>><a href="<?php echo $this->createUrl('Social', 'SocialMainList', null, false); ?>"><i class="icon social-icon"></i>Социальные сервисы</a></li>
					<li <? if($currentController=='Bookmarks') {echo 'class="active"';}?>><a href="<?php echo $this->createUrl('Bookmarks', 'BookmarksList', null, false); ?>"><i class="icon bookmarks-icon"></i>Закладки</a></li>
					<li <? if($currentController=='SearchUser') {echo 'class="active"';}?>><a href="<?php echo $this->createUrl('SearchUser','SearchUserMain',null,false); ?>"><i class="icon friends-icon"></i>Найти знакомых</a></li>
				</ul>
				<!-- /menu -->

			</div>
			<!-- /head -->

			<div class="middle">		