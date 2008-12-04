<div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
	<div class="block_title"><h2>Управление</h2></div>
	<a href="<?php echo $this -> createUrl('Messages', 'Mymessages');?>">Личная почта</a><br />
	<a href="<?php echo $this -> createUrl('User', 'ProfileEdit');?>">Написать письмо</a><br />
	<a href="<?php echo $this -> createUrl('User', 'ProfileEdit');?>">Письмо администрации</a><br />
	<a href="<?php echo $this -> createUrl('User', 'ProfileEdit');?>">Управление друзьями</a><br />
	
</div></div></div>

<?php 
if ($this->user_profile['id']==$this->current_user->id){ 
?>
<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
	<div class="block_title"><h2>Управление</h2></div>

	<a href="<?php echo $this -> createUrl('User', 'ProfileEdit');?>">Редактировать профиль</a><br />
	<a href="<?php echo $this -> createUrl('User', 'AvatarEdit');?>">Редактировать аватары</a>
	<a href="<?php echo $this -> createUrl('User', 'Mood');?>">Фразы настроения</a>

</div></div></div></div>
<?php
} 
?>