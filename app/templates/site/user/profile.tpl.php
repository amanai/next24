<?php include($this -> _include('../header.tpl.php')); ?>
<?php  if ($this->user_profile['id']==$this->current_user->id){ ?>
				<ul class="view-filter clearfix">
					<li><strong><?
					if(!trim($this->user_name)) echo 'Нет имени';
					else echo $this->user_name;?><span></span></strong></li>
					<?php  if ($this->user_profile['id']==$this->current_user->id){ ?>
					<li><a href="<?php echo $this -> createUrl('User', 'ProfileEdit');?>">Настройки профиля</a></li>
					<? } ?>
				</ul>
				<!-- /view-filter -->
				<div class="user-profile">
					<div class="clearfix">
						<dl class="main-info">
							<?php $online = Project::getUser()->getDbUser()->isUserOnline($this->user_profile['id']); ?>
							<dt><span class="user-status"><span class="online"><?=$online?'online':'offline';?></span></span> <strong>
							<?if(!trim($this->user_name)) echo 'Нет имени';
								else echo $this->user_name;?></strong>  / <span class="nick"><?=$this->user_profile['login'];?></span> /</dt>
							<?php $avator_path = ($this->user_default_avatar['sys_av_id'])?$this->user_default_avatar['sys_path']:$this->user_default_avatar['path']; 
	    						if(!$avator_path || $avator_path == 'no.png') $avator_path = $this->image_url.'avatar/no90.jpg';
	    						else $avator_path = $this->image_url.'avatar/'.$avator_path;							
							?>
							<dd class="av"><img alt="<?php echo $this->user_default_avatar['av_name'];?>" src="<?php echo $avator_path;?>" /></dd>
							<dd><?=$this->user_location;?></dd>
							<dd>На сайте: <span class="date">12 дней</span></dd>
							<dd>Настроение: <em><?=$this->user_profile['mood'];?></em> <?php  if ($this->user_profile['id']==$this->current_user->id){ ?><a href="<?php echo $this -> createUrl('User', 'ProfileEdit');?>" class="script-link"><span class="t">изменить</span></a><? } ?></dd>
							<dd>Статус: <em><?=$this->user_profile['status'];?></em> <?php  if ($this->user_profile['id']==$this->current_user->id){ ?><a href="<?php echo $this -> createUrl('User', 'ProfileEdit');?>" class="script-link"><span class="t">изменить</span></a><? } ?></dd>
						</dl>
						<div class="about-info">
							<div class="ttl"><strong>О себе</strong> <?php  if ($this->user_profile['id']==$this->current_user->id){ ?><a href="<?php echo $this -> createUrl('User', 'ProfileEdit');?>" class="script-link"><span class="t">изменить</span></a><? } ?></div>
							<div class="cnt">
								<? if ($this->user_profile['about']) { ?>
									<?=$this->user_profile['about'];?>
								<? } ?>	
							</div>	
						</div>
						<div class="rating-info">
							<div class="ttl"><strong>Рейтинг: <span class="nr"><? $nr = Project::getUser()->getDbUser()->getUserRateNMByRegistrationData($this->user_profile['id']); echo $nr['rate']; ?> NR</span></strong></div>
							<div class="cnt">
								Профиль заполнен на:
								<div class="rating-view">
									<strong><?=$this->user_profile['rate']*10; ?>%</strong>
									<div style="width:<?=$this->user_profile['rate']*10; ?>%;"></div>
								</div>
								<a href="#" class="script-link"><span class="t">подробнее о рейтинге</span></a>
							</div>
						</div>
					</div>
					<ul class="user-tabs clearfix">
						<?php include($this -> _include('../tab_panel_profile.tpl.php')); ?>
					</ul>
					<!-- /user-tabs -->
				</div>
				<!-- /user-profile -->
<? } else { ?>
				<div class="user-title"> 
					<?php $online = Project::getUser()->getDbUser()->isUserOnline($this->user_profile['id']); ?>
					<h1><?=$this->user_name;?></h1> <span class="user-status"><span class="online"><?=$online?'online':'offline';?></span></span> 
				</div> 
				<div class="user-profile"> 
					<div class="clearfix"> 
						<dl class="main-info"> 
							<dt> <strong><?=$this->user_name;?></strong>  / <span class="nick"><?=$this->user_profile['login']; ?></span> /</dt>
							<?php $avator_path = ($this->user_default_avatar['sys_av_id'])?$this->user_default_avatar['sys_path']:$this->user_default_avatar['path']; ?>
							<dd class="av"><img alt="<?php echo $this->user_default_avatar['av_name'];?>" src="<?php echo $this->image_url."avatar/".$avator_path;?>" /></dd> 
							<dd><?=$this->user_location;?></dd> 
							<dd>На сайте: <span class="date">12 дней</span></dd> 
							<dd>Настроение: <em>супер!</em></dd> 
							<dd>Статус: <em>хочу есть и пить</em></dd> 
						</dl> 
						<div class="about-info"> 
							<div class="ttl"><strong>О себе</strong></div> 
							<div class="cnt"><?=$this->user_profile['about']; ?></div> 
						</div> 
						<div class="rating-info"> 
							<div class="ttl"><strong>Рейтинг: <span class="nr"><? $nr = Project::getUser()->getDbUser()->getUserRateNMByRegistrationData($this->user_profile['id']); echo $nr['rate']; ?> NR</span></strong></div> 
							<div class="rating-vote"> 
								<a href="#" class="vote-up"><strong>+</strong></a> 
								<a href="#" class="vote-down"><strong><span>&ndash;</span></strong></a> 
							</div> 
						</div> 
					</div> 
					<div class="relationship"> 
						<p>Отношение пользователя к вам: <strong>Прикольный чуваг - респектус! Обращайся если что.</strong></p> 
						<p>Ваше отношение к пользователю: <strong class="no">Не указано!</strong> <a href="#">Указать свое отношение</a></p> 
					</div> 
					<!-- /relationship --> 
					<div class="user-sub-menu"><div class="bg"><div class="bg"> 
						<ul> 
							<li><a href="<?php echo $this -> createUrl('Messages','SendMessage',null,$this->current_user->id);?>">Написать сообщение</a> |</li> 
							<li><a href="<?php echo $this -> createUrl('Messages','Friend',null,$this->current_user->id);?>">+ Добавить к себе в друзья</a> |</li> 
							<li><a href="#">Подписаться на изменения</a> |</li> 
							<li><a href="#">Отправить подарок</a> |</li> 
							<li><a href="#" class="spam-link">Игнорировать</a></li> 
						</ul> 
					</div></div></div> 
					<!-- /relationship --> 
					<ul class="user-tabs clearfix"> 
						<?php include($this -> _include('../tab_panel_profile.tpl.php')); ?>
					</ul> 
					<!-- /user-tabs --> 
				</div> 
				<!-- /user-profile --> 
<? } ?>				

				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<div class="profile-info">
							<div class="info-title">
								<div class="more-act"><?php  if ($this->user_profile['id']==$this->current_user->id){ ?>[ <a href="<?php echo $this -> createUrl('User', 'ProfileEdit');?>">изменить</a> ] <? } ?></div>
								<i class="arrow-icon up-arrow"></i><strong>Личная информация</strong>
							</div>
							<!-- /info-title -->
							<div class="info-entry">
								<dl class="personal-info clearfix">
									<dt>Логин:</dt>
									<dd><strong><?=$this->user_profile['login']; ?></strong></dd>
								<? if ($this->user_profile['last_name']) { ?>	
									<dt>Фамилия:</dt>
									<dd><?=$this->user_profile['last_name']; ?></dd>
								<? } ?>
								<?php if ($this->user_profile['first_name']) { ?>	
									<dt>Имя:</dt>
									<dd><?=$this->user_profile['first_name']; ?></dd>
								<? } ?>
								<?php if ($this->user_profile['middle_name']) { ?>	
									<dt>Отчество:</dt>
									<dd><?=$this->user_profile['middle_name']; ?></dd>
								<? } ?>	
								<? if ($this->user_name) { ?>
									<dt>Псевдоним:</dt>
									<dd><?=$this->user_name;?></dd>
								<? } ?>	
								<?php if ($this->user_profile['birth_date']) { ?>
									<dt>Дата рождения:</dt>
									<dd><?=$this->user_profile['birth_date'];?></dd>
								<? } ?>	
								<?php if ($this->user_profile['registration_date']) { ?>
									<dt>Дата регистрации</dt>
									<dd><?=$this->user_profile['registration_date'];?></dd>
								<? } ?>	
								<? if ($this->user_location) { ?>	
									<dt>Страна:</dt>
									<dd><?=$this->user_location;?></dd>
								<? } ?>
								<? if ($this->user_profile['city']) { ?>	
									<dt>Город:</dt>
									<dd><?=$this->user_profile['city']; ?></dd>	
								<? }?>
								<?php if ($this->user_profile['gender']) { ?>	
									<dt>Пол:</dt>
									<dd><?=$this->user_profile['gender']?'мужской':'женский';?></dd>
								<? } ?>	
								<? if ($this->user_profile['marital_status']) { ?>	
									<dt>Семейное положение:</dt>	
									<dd><?=$this->user_profile['marital_status'];?></dd>
								<? } ?>	
								<?php if($this->user_profile['icq']) {?>
									<dt>icq:</dt>
									<dd><a href="#"><?=$this->user_profile['icq']; ?></a></dd>
								<? } ?>	
									<dt>skype:</dt>
									<dd><a href="#">viktor200000</a></dd>
								<?php if($this->user_profile['website']) { ?>	
									<dt>Сайт:</dt>
									<dd><a href="<?=$this->user_profile['website']; ?>"><?=$this->user_profile['website']; ?></a></dd>
								<? } ?>	
								<? if ($this->user_profile['phone']) { ?>	
									<dt>Телефон:</dt>
									<dd><?=$this->user_profile['phone'];?></dd>
								<? } ?>
								<? if ($this->user_profile['mobile_phone']) { ?>	
									<dt>Мобильный телефон</dt>
									<dd><?=$this->user_profile['mobile_phone'];?></dd>
								<? } ?>	
								<? if ($this->user_interests) { ?>
									<dt>Интересы:</dt>
									<dd><?=$this->user_interests;?></dd>
								<? } ?>
								<? if ($this->user_profile['books']) { ?>
									<dt>Любимые книги:</dt>
									<dd><?=$this->user_profile['books'];?></dd>
								<? } ?>	
								<? if ($this->user_profile['films']) { ?>
									<dt>Любимые фильмы:</dt>
									<dd><?=$this->user_profile['films'];?></dd>
								<? } ?>		
								<? if ($this->user_profile['musicians']) { ?>
									<dt>Любымые музыканты:</dt>
									<dd><?=$this->user_profile['musicians'];?></dd>
								<? } ?>	
								<?php if ($this->user_profile['email']) { ?>																											
									<dt>Адрес e-mail:</dt>
									<dd><a href="mailto:<?=$this->user_profile['email']; ?>"><?=$this->user_profile['email']; ?></a></dd>
								<? } ?>	
								<?if ($this->places) { ?>
									<dt>Места учебы, работы, отдыха, службы</dt>
									<dd>
										<table>
										<? foreach ($this->places as $place) { ?>
											<tr>
												<td><?=$place['date_start'];?>&nbsp;&mdash;&nbsp;<?=$place['date_end'];?> гг.</td>		
												<td>
													<b><?=$place['name'];?></b>
													<br />
													<div><?=$place['city'];?></div>
												</td>
											</tr>

										<? } ?>
										</table>
									</dd>
								<? } ?>											
								</dl>
							</div>
							<!-- /info-entry -->
						</div>
						<!-- /profile-info -->					
						<div class="profile-info">
							<div class="info-title">
								<div class="more-act">[ <a href="<?php echo $this -> createUrl('Messages', 'Friend');?>">все друзья</a> ]</div>
								<i class="arrow-icon up-arrow"></i><strong>Друзья</strong> <!--  (112)	 -->
							</div>
							<!-- /info-title -->
							<div class="info-entry">						
								<ul class="friends-profile-view clearfix">
								<? if (is_array($this->friend_list_model)) { ?>
								<?php foreach ($this->friend_list_model as $value) { ?>
								<?php $loop_user = Project::getUser()->getDbUser()->getUserById($value); 
									  $avatar = Project::getUser()->getDbUser()->getUserAvatar($value);
									$avPath = $avatar['path'];
									if(!$avPath || $avPath == 'no.png') $avPath = 'no25.jpg';
								?>
									<li>
										<span class="av"><a href="<?php echo $this->createUrl('User','Profile',null,$loop_user['login']);?>"><img src="<?=$this->image_url.'avatar/'.$avPath;?>" alt="" style="width:25px;height:25px;" /></a></span>
										<a href="<?php echo $this->createUrl('User','Profile',null,$loop_user['login']);?>" class="nm"><?=$loop_user['first_name']; ?> <?=$loop_user['last_name']; ?></a>
										<span class="where"><?=$loop_user['country']?$loop_user['country'].' , ':''; ?><?=$loop_user['city'] ?></span>
									</li>							
								<?php } ?>
								<? } ?>	
								</ul>
							</div>
							<!-- /info-entry -->
						</div>					
						<div class="profile-info">
							<div class="info-title">
								<div class="more-act">[ <a href="<?php echo $this -> createUrl('Messages', 'Friend');?>">все друзья</a> ]</div>
								<i class="arrow-icon up-arrow"></i><strong>В друзьях</strong> <!--  (112)	 -->
							</div>
							<!-- /info-title -->
							<div class="info-entry">							
								<ul class="friends-profile-view clearfix">
								<? if (is_array($this->in_friend_list_model)) { ?>
								<?php foreach ($this->in_friend_list_model as $value) { ?>
								<?php $loop_user = Project::getUser()->getDbUser()->getUserById($value['user_id']); 
									  $avatar = Project::getUser()->getDbUser()->getUserAvatar($value['user_id']);
									  $avPath = $avatar['path'];
									  if(!$avPath || $avPath == 'no.png') $avPath = 'no25.jpg';
								?>
									<li>
										<span class="av"><a href="<?php echo $this->createUrl('User','Profile',null,$loop_user['login']);?>"><img src="<?=$this->image_url.'avatar/'.$avPath;?>" alt="" style="width:25px;height:25px;" /></a></span>
										<a href="<?php echo $this->createUrl('User','Profile',null,$loop_user['login']);?>" class="nm"><?=$loop_user['first_name']; ?> <?=$loop_user['last_name']; ?></a>
										<span class="where"><?=$loop_user['country']?$loop_user['country'].' , ':''; ?><?=$loop_user['city'] ?></span>
									</li>							
								<?php } ?>
								<? } ?>									
								</ul>
							</div>
							<!-- /info-entry -->
						</div>
						<!-- /profile-info -->
						<div class="profile-info">
							<div class="info-title">
								<i class="arrow-icon up-arrow"></i><strong>Лента событий в подписке</strong> <!-- (112) -->
							</div>
							<!-- /info-title -->
							<div class="info-entry">
								<ul class="event-list">
									<li><a href="#">Андрей Шевченко</a> и <a href="#">Викторчик</a> теперь друзья</li>
									<li><a href="#">Ярослав Мудрый</a> добавил <a class="srv-link">комментарий</a> к своей личной <a class="srv-link">фотографии</a></li>
									<li><a href="#">Андрей Шевченко</a> и <a href="#">Викторчик</a> теперь друзья</li>
									<li><a href="#">Ярослав Мудрый</a> добавил <a class="srv-link">комментарий</a> к своей личной <a class="srv-link">фотографии</a></li>
									<li><a href="#">Андрей Шевченко</a> и <a href="#">Викторчик</a> теперь друзья</li>
									<li><a href="#">Ярослав Мудрый</a> добавил <a class="srv-link">комментарий</a> к своей личной <a class="srv-link">фотографии</a></li>
									<li class="view-more last"><a href="#">Вся лента событий в подписке</a> (1145)</li>
								</ul>
							</div>
							<!-- /info-entry -->
						</div>
						<!-- /profile-info -->
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<div class="navigation">
							<div class="title alt-title"><h2>Фотоальбомы</h2></div>
							<ul class="short-list photo-short-list">
							<?php if(is_array($this->last_4_albums)) { ?>
							<?php foreach ($this->last_4_albums as $value) {?>
								<li>
									<dl class="clearfix">
										<dt><a href="<?php echo $this -> createUrl('Photo','Album').'/'.$value['album_id'].'/';?>"><img src="<?=$this->last_4_albums['thumbnail'];?>" alt="" /></a></dt>
										<dd><a href="<?php echo $this -> createUrl('Photo','Album').'/'.$value['album_id'].'/';?>"><?=$value['name'];?></a></dd>
										<dd><?=$value['pht_cnt'];?> фото</dd>
									</dl>
								</li>							
							<? } ?>
							<? } ?>
								<li class="view-more"><a href="<?php echo $this -> createUrl('Album','List');?>">Все альбомы</a> <!-- (5) --></li>
							</ul>
						</div>
			  			<div class="navigation">
							<div class="title alt-title"><h2>В блоге</h2></div>
							<ul class="short-list text-short-list">
							<?php if(is_array($this->last_4_blog_posts)) {?>
							<?php foreach ($this->last_4_blog_posts as $value) { ?>
								<li>
									<span class="date"><?=$value['creation_date'];?></span>
									<a href="<?php echo $this -> createUrl('Blog','Comments').'/'.$value['id'].'/0/0/';?>"><?=$value['title'];?></a>
								</li>							
							<? } ?>
							<? } ?>
								<li class="view-more"><a href="<?php echo $this -> createUrl('Blog','PostList');?>">Все сообщения в блоге</a> <!-- (15) --></li>
							</ul>
						</div>
			<!--			<div class="navigation">
							<div class="title alt-title"><h2>В дневниках</h2></div>
							<ul class="short-list text-short-list">
								<li>
									<span class="date">18 декабря 2008, 19:46</span>
									<a href="#">Трехмерные танки на Flash!</a>
								</li>
								<li>
									<span class="date">18 декабря 2008, 19:46</span>
									<a href="#">Трехмерные танки на Flash!</a>
								</li>
								<li>
									<span class="date">18 декабря 2008, 19:46</span>
									<a href="#">Трехмерные танки на Flash!</a>
								</li>
								<li>
									<span class="date">18 декабря 2008, 19:46</span>
									<a href="#">Трехмерные танки на Flash!</a>
								</li>
								<li>
									<span class="date">18 декабря 2008, 19:46</span>
									<a href="#">Трехмерные танки на Flash!</a>
								</li>
								<li class="view-more"><a href="#">Вся лента в дневнике</a> (354)</li>
							</ul>  -->
							<?php //include($this -> _include('control_panel.tpl.php')); ?>
						</div>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->
<?php include($this -> _include('../footer.tpl.php')); ?>