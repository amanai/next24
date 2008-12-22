<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
	<div class="block_title"><h2><?=$this->user_profile['login'];?></h2></div>
	<div class="av_preview">
	<?php $avator_path = ($this->user_default_avatar['sys_av_id'])?$this->user_default_avatar['sys_path']:$this->user_default_avatar['path']; ?>
	<img style="margin: 5px;" alt="<?php echo $this->user_default_avatar['av_name'];?>" src="<?php echo $this->image_url."avatar/".$avator_path;?>"/>
	
	</div>

<?php 
if ($this->user_profile['id']!=$this->current_user->id&&$this->current_user->id){ 
?>

					<div class="block_title"><h2>Ваше отношение к <?=$this->user_profile['login'];?></h2></div>

					<b><?=$this->my_relation?$this->my_relation:'не установлено';?></b><br/>
					<a href="#" onclick="showRelationForm(); return false;" id="change_relation_link"><?=$this->my_relation?'сменить свое отношение':'установить свое отношение';?></a>
					
					<div id="relations_form" style="display: none;">
					<form action="<?=$this -> createUrl('User', 'ChangeRelation'); ?>" method="POST">
						<table width="100%" cellpadding="2">
						<tr>
							<td>Отношение:</td>
							<td>
								<select name="relation" id="relation_select" onchange="relationSelect();">
								<? foreach ($this->relations as $relation) { ?>
									<option id="relation_select_<?=$relation['id'];?>" value="<?=$relation['id'];?>"<?=($relation['name']==$this->my_relation)?' selected="selected"':''?>><?=$relation['name'];?></option>
								<? } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Свой вариант:</td>
							<td><input type="text" name="relation_text" id="relation_text" value="<?=$this->my_relation;?>"/></td>
						</tr>
						<tr>
							<td colspan="2"><input type="submit" name="set_relation" value="<?=$this->my_relation?'Сменить':'Установить';?>"></td>
						</tr>
						</table>
					</form>
					</div>
					<br/><br/>
	
					<div class="block_title"><h2>Отношение <?=$this->user_profile['login'];?> к вам</h2></div>
					
					<b><?=$this->my_relation?($this->his_relation?$this->his_relation:'не установлено'):'<a href="#" onclick="showRelationForm(); return false;">чтобы посмотреть, вы должны установить свое отношение</a>';?></b><br/><br/>


<?php
} 
?>

</div></div></div></div>

<?php 
if ($this->user_profile['id']==$this->current_user->id){ 
?>
<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
	<div class="block_title"><h2>Управление</h2></div>

	<a href="<?php echo $this -> createUrl('User', 'ProfileEdit');?>">Редактировать профиль</a><br />
	<a href="<?php echo $this -> createUrl('User', 'AvatarEdit');?>">Редактировать аватары</a><br />
	<a href="<?php echo $this -> createUrl('User', 'Mood');?>">Фразы настроения</a><br />
	<a href="<?php echo $this -> createUrl('Places', 'Index');?>">Места работы, учебы</a>

</div></div></div></div>
<?php
} 
?>