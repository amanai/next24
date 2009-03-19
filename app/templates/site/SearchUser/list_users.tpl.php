<!-- TEMPLATE: Список пользоватетелей -->
<?php $finded_user_num = count($this->list_search_user); ?>
<?php if($finded_user_num == 0) { ?>
	<h2>Ничего не найдено</h2>
<?php } else { ?>	
	<h2>Найдено <span><?=$finded_user_num; ?></span> пользователя:</h2>
	<ul class="user-blog-view">
	<? foreach($this->list_search_user as $key => $item) { ?>
		<li class="it clearfix">
			<dl>
				<dt><a href="<?=$request->createUrl('Index','Index', null, $item['login']);?>" class="with-icon-s"><i class="icon-s online-icon"></i>Юзерский Юзер</a> [ <a href="<?=$request->createUrl('Index','Index', null, $item['login']);?>"><?=$item['login']; ?></a> ]</dt>
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
				<dd><span>последний раз был на сайте:</span> 1 минуту назад</dd>
				<dd>
					<ul>
						<li><a href="<?php echo $this->createUrl('Blog', 'PostList', null, $item['login']); ?>">Блог пользователя</a> (15)</li>
						<li><a href="<?php echo $this->createUrl('Album', 'List', null, $item['login']); ?>">Фото пользователя</a> (5)</li>
					</ul>
				</dd>
			</dl>
			<ul class="links">
				<li><a href="<?=$request->createUrl('Index','Index', null, $item['login']); ?>">Профиль пользователя</a></li>
				<li><a href="#" class="new-link">Переписка</a> (12)</li>
				<li><a href="#">Написать сообщение</a></li>
				<li><a href="#">Добавить в друзья</a></li>
				<li><a href="#" class="spam-link">Пожаловаться на пользователя</a></li>
			</ul>
		</li>
	<? } ?>					
	</ul>
<? } ?> 
