<? if ($this->showed_user_profile['id'] == $this->current_user->id) {?>
<?php $user = Project::getUser()->getDbUser()->getUserById($this->current_user->id); ?>
				<ul class="view-filter clearfix">
					<li><strong><?=implode(' ',array($user['last_name'],$user['first_name'],$user['middle_name']));?><span></span></strong></li>
					<li><a href="<?php echo $this -> createUrl('User', 'ProfileEdit');?>">Настройки профиля</a></li>
				</ul>
				<!-- /view-filter -->
				<div class="user-profile">
					<div class="clearfix">
						<dl class="main-info">
							<?php $online = Project::getUser()->getDbUser()->isUserOnline($this->current_user->id); ?>
							<dt><span class="user-status"><span class="online"><?=$online?'online':'offline';?></span></span> <strong><?=implode(' ',array($user['last_name'],$user['first_name'],$user['middle_name']));?></strong>  / <span class="nick"><?=$user['login'];?></span> /</dt>
							<?php 
							$userModel = new UserModel();
							$user_default_avatar = $userModel->getUserAvatar($this->current_user->id);
							?>
							<?php $avator_path = ($user_default_avatar['sys_av_id'])?$user_default_avatar['sys_path']:$user_default_avatar['path']; ?>
							<dd class="av"><img alt="<?php echo $this->user_default_avatar['av_name'];?>" src="<?php echo $this->image_url."avatar/".$avator_path;?>" /></dd>
							<dd>Украина, Киев</dd>
							<dd>На сайте: <span class="date">12 дней</span></dd>
							<dd>Настроение: <em>супер!</em> <a href="<?php echo $this -> createUrl('User', 'ProfileEdit');?>" class="script-link"><span class="t">изменить</span></a></dd>
							<dd>Статус: <em>хочу есть и пить</em> <a href="<?php echo $this -> createUrl('User', 'ProfileEdit');?>" class="script-link"><span class="t">изменить</span></a></dd>
						</dl>
						<div class="about-info">
							<div class="ttl"><strong>О себе</strong> <a href="<?php echo $this -> createUrl('User', 'ProfileEdit');?>" class="script-link"><span class="t">изменить</span></a></div>
							<div class="cnt"><?=$user['about']; ?></div>
						</div>
						<div class="rating-info">
							<div class="ttl"><strong>Рейтинг: <span class="nr"><? $nr = Project::getUser()->getDbUser()->getUserRateNMByRegistrationData($this->current_user->id); echo $nr['rate']; ?> NR</span></strong></div>
							<div class="cnt">
								Профиль заполнен на:
								<div class="rating-view">
									<strong><?=$user['rate']*10; ?>%</strong>
									<div style="width:<?=$user['rate']*10; ?>%;"></div>
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
<? } else {?>
<?php $user = Project::getUser()->getDbUser()->getUserById($this->showed_user_profile['id']); ?>
				<div class="user-title"> 
				<?php $online = Project::getUser()->getDbUser()->isUserOnline($this->showed_user_profile['id']); ?>
					<h1><?=implode(' ',array($user['last_name'],$user['first_name'],$user['middle_name']));?></h1> <span class="user-status"><span class="online"><?=$online?'online':'offline';?></span></span> 
				</div> 
				<div class="user-profile"> 
					<div class="clearfix"> 
						<dl class="main-info"> 
							<dt> <strong><?=implode(' ',array($user['last_name'],$user['first_name'],$user['middle_name']));?></strong>  / <span class="nick"><?=$user['login']; ?></span> /</dt>
							<?php 
							$userModel = new UserModel();
							$user_default_avatar = $userModel->getUserAvatar($this->showed_user_profile['id']);
							?>
							<?php $avator_path = ($user_default_avatar['sys_av_id'])?$user_default_avatar['sys_path']:$user_default_avatar['path']; ?>
							<dd class="av"><img alt="<?php echo $user_default_avatar['av_name'];?>" src="<?php echo $this->image_url."avatar/".$avator_path;?>" /></dd> 
							<dd>Украина, Киев</dd> 
							<dd>На сайте: <span class="date">12 дней</span></dd> 
							<dd>Настроение: <em>супер!</em></dd> 
							<dd>Статус: <em>хочу есть и пить</em></dd> 
						</dl> 
						<div class="about-info"> 
							<div class="ttl"><strong>О себе</strong></div> 
							<div class="cnt"><?=$user['about']; ?></div> 
						</div> 
						<div class="rating-info"> 
							<div class="ttl"><strong>Рейтинг: <span class="nr"><? $nr = Project::getUser()->getDbUser()->getUserRateNMByRegistrationData($this->showed_user_profile['id']); echo $nr['rate']; ?> NR</span></strong></div> 
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