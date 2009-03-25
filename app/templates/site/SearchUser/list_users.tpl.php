<!-- TEMPLATE: Список пользоватетелей -->
<?php $finded_user_num = count($this->list_search_user); ?>
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
	<?php if($item['logged_time']) {
			$online_offline = 'online-icon';
	}
	else {
			$online_offline = 'offline-icon';
	}	
//	print '<pre>';
//		print_r($item);
//	print '</pre>';	
	?>
		<li class="it clearfix">
			<dl>
				<dt><a href="<?=$request->createUrl('Index','Index', null, $item['login']);?>" class="with-icon-s"><i class="icon-s <?=$online_offline; ?>"></i><?=$item['first_name']; ?> <?=$item['last_name']; ?></a> [ <a href="<?=$request->createUrl('Index','Index', null, $item['login']);?>"><?=$item['login']; ?></a> ]</dt>
				<dd class="av"><a href="<?=$request->createUrl('Index','Index', null, $item['login']);?>"><img class="avatar" src="assets/i/temp/avatar.bb.jpg" alt="" /></a></dd>
				<dd>
					<? if ($item['country_name'] != '') { echo $item['country_name'].','; } ?>
					<?=$item['city_name'];?>
					<? if ($item['user_age'] != '') { ?>
            			,<?=$item['user_age'];?> лет<br />
          			<? } ?>
          			<? if ($item['registration_date'] != '') { ?>
            			Зарегистрирован : <?=date_format(new DateTime($item['registration_date']),'d.m.Y');?><br />
          			<? } ?>
				</dd>
				<dd><span>последний раз был на сайте:</span> <?=(int) date("m",$item['logged_time']); ?> минуту назад</dd>
				<dd>
					<ul>
						<li><a href="<?php echo $this->createUrl('Blog', 'PostList', null, $item['login']); ?>">Блог пользователя</a> (15)</li>
						<li><a href="<?php echo $this->createUrl('Album', 'List', null, $item['login']); ?>">Фото пользователя</a> (<?=$item['count_photos']; ?>)</li>
					</ul>
				</dd>
			</dl>
			<ul class="links">
				<li><a href="<?=$request->createUrl('Index','Index', null, $item['login']); ?>">Профиль пользователя</a></li>
				<li><a href="<?=Project::getRequest() -> createUrl('Messages', 'CorrespondenceWith').'/corr_user_id:'.$item['id']; ?>" class="new-link">Переписка</a> (12)</li>
				<li><a href="<?php echo $this -> createUrl('Messages', 'SendMessage');?>">Написать сообщение</a></li>
				<li><a href="<?php echo $this->createUrl('Messages', 'Friend'); ?>">Добавить в друзья</a></li>
				<li><a href="<?php echo $this -> createUrl('Messages', 'SendMessage');?>/message_to:admin" class="spam-link">Пожаловаться на пользователя</a></li>
			</ul>
		</li>
	<? } ?>					
	</ul>
<? } ?> 
