<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
	<div class="block_title"><h2><?=$this->user_profile['login'];?></h2></div>
</div></div></div></div>

<? if ($this->user_profile['id']==$this->current_user->id) { ?>
<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
	<div class="block_title"><h2>Управление</h2></div>

	<a href="<?php echo $this -> createUrl('User', 'ProfileEdit');?>">Редактировать профиль</a><br />
	<a href="<?php echo $this -> createUrl('User', 'AvatarEdit');?>">Редактировать аватары</a>

</div></div></div></div>
<? } ?>