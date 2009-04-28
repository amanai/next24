<?php include($this -> _include('../header.tpl.php')); ?>
				<ul class="view-filter clearfix">
					<li><strong><?=$this->user_name;?><span></span></strong></li>
					<?php  if ($this->user_profile['id']==$this->current_user->id){ ?>
					<li><a href="<?php echo $this -> createUrl('User', 'ProfileEdit');?>">Настройки профиля</a></li>
					<? } ?>
				</ul>
				<!-- /view-filter -->

				<div class="user-profile">
					<div class="clearfix">
						<dl class="main-info">
							<dt><span class="user-status"><span class="online">online</span></span> <strong><?=$this->user_name;?></strong>  / <span class="nick"><?=$this->user_profile['login'];?></span> /</dt>
							<?php $avator_path = ($this->user_default_avatar['sys_av_id'])?$this->user_default_avatar['sys_path']:$this->user_default_avatar['path']; ?>
							<dd class="av"><img alt="<?php echo $this->user_default_avatar['av_name'];?>" src="<?php echo $this->image_url."avatar/".$avator_path;?>" /></dd>
							<dd><?=$this->user_location;?></dd>
							<dd>На сайте: <span class="date">12 дней</span></dd>
							<dd>Настроение: <em>супер!</em> <a href="#" class="script-link"><span class="t">изменить</span></a></dd>
							<dd>Статус: <em>хочу есть и пить</em> <a href="#" class="script-link"><span class="t">изменить</span></a></dd>
						</dl>
						<div class="about-info">
							<div class="ttl"><strong>О себе</strong> <a href="#" class="script-link"><span class="t">изменить</span></a></div>
							<div class="cnt">
								<? if ($this->user_profile['about']) { ?>
									<?=$this->user_profile['about'];?>
								<? } ?>	
							</div>	
						</div>
						<div class="rating-info">
							<div class="ttl"><strong>Рейтинг: <span class="nr">420 NR</span></strong></div>
							<div class="cnt">
								Профиль заполнен на:
								<div class="rating-view">
									<strong>48%</strong>
									<div style="width:48%;"></div>
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

				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<div class="profile-info">
							<div class="info-title">
								<div class="more-act">[ <a href="<?php echo $this -> createUrl('Messages', 'Friend');?>">все друзья</a> ]</div>
								<i class="arrow-icon up-arrow"></i><strong>Друзья</strong> (112)
							</div>
							<!-- /info-title -->
							<div class="info-entry">
								<? if ($this->friend_list) { ?>
									<?=$this -> friend_list; ?>
								<? } ?>
								<? if ($this->in_friend_list) { ?>
									<?=$this -> in_friend_list; ?>
								<? } ?>								
								<ul class="friends-profile-view clearfix">
									<li>
										<span class="av"><a href="#"><img src="assets/i/temp/avatar.bbb.jpg" alt="" /></a></span>
										<a href="#" class="nm">Андрей Шевченко</a>
										<span class="where">Украина, Киев</span>
									</li>
									<li>
										<span class="av"><a href="#"><img src="assets/i/temp/avatar.bbb.jpg" alt="" /></a></span>
										<a href="#" class="nm">Антонина Степановна</a>
										<span class="where">Великобритания, Лондон</span>
									</li>
									<li>
										<span class="av"><a href="#"><img src="assets/i/temp/avatar.bbb.jpg" alt="" /></a></span>
										<a href="#" class="nm">Андрей Шевченко</a>
										<span class="where">Украина, Киев</span>
									</li>
									<li>
										<span class="av"><a href="#"><img src="assets/i/temp/avatar.bbb.jpg" alt="" /></a></span>
										<a href="#" class="nm">Андрей Шевченко</a>
										<span class="where">Украина, Киев</span>
									</li>
									<li>
										<span class="av"><a href="#"><img src="assets/i/temp/avatar.bbb.jpg" alt="" /></a></span>
										<a href="#" class="nm">Андрей Шевченко</a>
										<span class="where">Украина, Киев</span>
									</li>
									<li>
										<span class="av"><a href="#"><img src="assets/i/temp/avatar.bbb.jpg" alt="" /></a></span>
										<a href="#" class="nm">Андрей Шевченко</a>
										<span class="where">Украина, Киев</span>
									</li>
									<li>
										<span class="av"><a href="#"><img src="assets/i/temp/avatar.bbb.jpg" alt="" /></a></span>
										<a href="#" class="nm">Андрей Шевченко</a>
										<span class="where">Украина, Киев</span>
									</li>
									<li>
										<span class="av"><a href="#"><img src="assets/i/temp/avatar.bbb.jpg" alt="" /></a></span>
										<a href="#" class="nm">Андрей Шевченко</a>
										<span class="where">Украина, Киев</span>
									</li>
								</ul>
							</div>
							<!-- /info-entry -->
						</div>
						<!-- /profile-info -->
						<div class="profile-info">
							<div class="info-title">
								<i class="arrow-icon up-arrow"></i><strong>Лента событий в подписке</strong> (112)
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
						<div class="profile-info">
							<div class="info-title">
								<div class="more-act">[ <a href="<?php echo $this -> createUrl('User', 'ProfileEdit');?>">изменить</a> ]</div>
								<i class="arrow-icon up-arrow"></i><strong>Личная информация</strong>
							</div>
							<!-- /info-title -->
							<div class="info-entry">
								<dl class="personal-info clearfix">
									<dt>Логин:</dt>
									<dd><strong>madvic</strong></dd>
									<dt>Фамилия:</dt>
									<dd>Шпаков</dd>
									<dt>Имя:</dt>
									<dd>Виктор</dd>
									<dt>Отчество:</dt>
									<dd>Батькович</dd>
								<? if ($this->user_name) { ?>
									<dt>Псевдоним:</dt>
									<dd><?=$this->user_name;?></dd>
								<? } ?>	
									<dt>Дата рождения:</dt>
									<dd><?=$this->user_profile['birth_date'];?></dd>
									<dt>Дата регистрации</dt>
									<dd><?=$this->user_profile['registration_date'];?></dd>
								<? if ($this->user_location) { ?>	
									<dt>Страна:</dt>
									<dd><?=$this->user_location;?></dd>
									<dt>Город:</dt>
									<dd><?=$this->user_location;?></dd>
								<? } ?>	
									<dt>Пол:</dt>
									<dd><?=$this->user_profile['gender']?'мужской':'женский';?></dd>
								<? if ($this->user_profile['marital_status']) { ?>	
									<dt>Семейное положение:</dt>	
									<dd><?=$this->user_profile['marital_status'];?></dd>
								<? } ?>	
									<dt>icq:</dt>
									<dd><a href="#">712121</a></dd>
									<dt>skype:</dt>
									<dd><a href="#">viktor200000</a></dd>
									<dt>Сайт:</dt>
									<dd><a href="#">www.madvic.ru</a></dd>
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
									<dt>Адрес e-mail:</dt>
									<dd><a href="#">madcros@gmail.com</a></dd>
								<?if ($this->places) { ?>
									<dt>Места учебы, работы, отдыха, службы</dt>
									<dd>
										<table cellpadding="10">
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
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<div class="navigation">
							<div class="title alt-title"><h2>Фотоальбомы</h2></div>
							<ul class="short-list photo-short-list">
								<li>
									<dl class="clearfix">
										<dt><a href="#"><img src="assets/i/temp/foto.s.jpg" alt="" /></a></dt>
										<dd><a href="#">Мой Альбом</a></dd>
										<dd>12 фото</dd>
									</dl>
								</li>
								<li>
									<dl class="clearfix">
										<dt><a href="#"><img src="assets/i/temp/foto.s.jpg" alt="" /></a></dt>
										<dd><a href="#">Мой Альбом</a></dd>
										<dd>12 фото</dd>
									</dl>
								</li>
								<li>
									<dl class="clearfix">
										<dt><a href="#"><img src="assets/i/temp/foto.s.jpg" alt="" /></a></dt>
										<dd><a href="#">Мой Альбом</a></dd>
										<dd>12 фото</dd>
									</dl>
								</li>
								<li class="view-more"><a href="<?php echo $this -> createUrl('Album','List');?>">Все альбомы</a> (5)</li>
							</ul>
						</div>
			  			<div class="navigation">
							<div class="title alt-title"><h2>В блоге</h2></div>
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
								<li class="view-more"><a href="<?php echo $this -> createUrl('Blog','PostList');?>">Все сообщения в блоге</a> (15)</li>
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