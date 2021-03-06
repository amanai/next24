<!-- TEMPLATE: Список пользоватетелей -->
<?php $finded_user_num = $this->counter_users;?>
<?php if($finded_user_num == 0) { ?>
	<h2>Ничего не найдено</h2>
<?php } else { ?>	
	<?php if($finded_user_num==1){ ?>
		<h2>Найден <span><?=$finded_user_num; ?></span> пользователь:</h2>
	<? } else { ?>		
		<h2>Найдено <span><?=$finded_user_num; ?></span> пользователя:</h2>
	<? } ?>
	<ul class="user-blog-view">
	<? foreach($this->list_search_user as $key => $item) { ?>
	<?php if($item['time_online']) {
			$online_offline = 'online-icon';
	}
	else {
			$online_offline = 'offline-icon';
	}	
	?>
		<li class="it clearfix">
			<dl>
			<?php 
				$userModel = new UserModel();
				$user_default_avatar = $userModel->getUserAvatar($item['id']);
			?>
			<?php $avator_path = ($user_default_avatar['sys_av_id'])?$user_default_avatar['sys_path']:$user_default_avatar['path']; 
	    		if(!$avator_path || $avator_path == 'no.png') $avator_path = $this->image_url.'avatar/no90.jpg';
	    		else $avator_path = $this->image_url.'avatar/'.$avator_path;													
			?>			
				<dt><a href="<?=$request->createUrl('Index','Index', null, $item['login']);?>" class="with-icon-s"><i class="icon-s <?=$online_offline; ?>"></i><?=$item['first_name']; ?> <?=$item['last_name']; ?></a> [ <a href="<?=$request->createUrl('Index','Index', null, $item['login']);?>"><?=$item['login']; ?></a> ]</dt>
				<dd class="av"><a href="<?=$request->createUrl('Index','Index', null, $item['login']);?>"><img class="avatar" alt="<?php echo $user_default_avatar['av_name'];?>" src="<?php echo $avator_path;?>" /></a></dd>
				<dd>
					<? if ($item['country_name'] != '') { echo $item['country_name'].','; } ?>
					<?=$item['city_name'];?>, 
					<? if ($item['user_age'] != '') { ?>
            			 <?=$item['user_age'];?> лет<br />
          			<? } ?>
          			<? if ($item['registration_date'] != '') { ?>
            			Зарегистрирован : <?=date_format(new DateTime($item['registration_date']),'d.m.Y');?><br />
          			<? } ?>
				</dd>
				<dd>
					<?php if($item['time_online']) { ?>
						<span>последний раз был на сайте:</span> <?=(int) date("m",time() - $item['time_online']); ?> минуты назад
					<? } ?>
				</dd>
				<dd>
					<ul>
						<li><a href="<?php echo $this->createUrl('Blog', 'PostList', null, $item['login']); ?>">Блог пользователя</a> (<?=$item['cnt_blog']?>)</li>
						<li><a href="<?php echo $this->createUrl('Album', 'List', null, $item['login']); ?>">Фото пользователя</a> (<?=$item['count_photos']; ?>)</li>
					</ul>
				</dd>
			</dl>
			<ul class="links">
				<li><a href="<?=$request->createUrl('Index','Index', null, $item['login']); ?>">Профиль пользователя</a></li>
				<li><a href="<?=Project::getRequest() -> createUrl('Messages', 'CorrespondenceWith',null,$this->current_user->login).'/corr_user_id:'.$item['id']; ?>" class="new-link">Переписка</a> (<?=$item['cnt_msg']; ?>)</li>
				<li><a href="<?php echo $this -> createUrl('Messages', 'SendMessage',null,$this->current_user->login);?>">Написать сообщение</a></li>
				<li><a href="<?php echo $this->createUrl('Messages', 'Friend',null,$this->current_user->login); ?>">Добавить в друзья</a></li>
				<li><a href="<?php echo $this -> createUrl('Messages', 'SendMessage',null,$this->current_user->login);?>/message_to:admin" class="spam-link">Пожаловаться на пользователя</a></li>
			</ul>
		</li>
	<? } ?>					
	</ul>
<? } ?> 
