<div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
	<div class="block_title"><h2>Управление</h2></div>
	<a href="<?php echo $this -> createUrl('Messages', 'Mymessages');?>">Личная почта</a><br />
	<a href="<?php echo $this -> createUrl('User', 'ProfileEdit');?>">Написать письмо</a><br />
	<a href="<?php echo $this -> createUrl('User', 'ProfileEdit');?>">Письмо администрации</a><br />
	<a href="<?php echo $this -> createUrl('User', 'ProfileEdit');?>">Управление друзьями</a><br />
	
</div></div></div>

<?php 
if ($this->isShowMessageGroups){ 
?>
<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
	<div class="block_title"><h2>Группы</h2></div>

    <p><a href="javascript: void(0);" onclick="ShowMessages(0, 0, '. Общие');"><img height="12" width="15" id="ico2" src="<?php echo $this -> image_url;?>/folder.png"/>Общие <span id="total_mes0">(<?php echo '<font class="red">'.$this->aGroupMessagesCount[0]['new'].'</font>/'.$this->aGroupMessagesCount[0]['read']; ?>)</span></a></p>
    <?php
	foreach ($this->aFriendGroups as $friendGroup){
	?>
	<p><a href="javascript: void(0);" onclick="ShowMessages(0, <?php echo $friendGroup['id'].", '. ".$friendGroup['name']."'"; ?>);"><img height="12" width="15" id="ico2" src="<?php echo $this -> image_url;?>/folder.png"/>Общие <span id="total_mes0">(<?php echo '<font class="red">'.$this->aGroupMessagesCount[$friendGroup['id']]['new'].'</font>/'.$this->aGroupMessagesCount[$friendGroup['id']]['read']; ?>)</span></a></p> 
	<?php
	}					           
    ?>

</div></div></div></div>
<?php
} 
?>