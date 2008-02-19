<?php include('header.tpl.php'); ?>
<div class="desktop">
	<div class="item admins">
		<h3><a href="<?=$this -> createUrl('AdminUser', 'List')?>">Администраторы системы</a></h3>
		В этом разделе вы сможете управлять администраторами системы и пользователями системы.
	</div>
	<div class="item settings">
		<h3><a href="<?=$this -> createUrl('AdminParameter', 'GroupList')?>">Параметры системы</a></h3>
		В этом разделе вы сможете управлять настройками системы.
	</div>
</div>
<?php include('footer.tpl.php'); ?>