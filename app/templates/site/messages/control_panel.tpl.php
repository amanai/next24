<div class="user-action">
	<ul>
		<li><i class="icon mail-b-icon"></i>Личная почта (<span class="of-all-count"><?=$this->aGroupMessagesCount['all']['new']; ?></span> / <?=($this->aGroupMessagesCount['all']['read']+$this->aGroupMessagesCount['all']['new']); ?>)</li>   <!--  <?php echo $this -> createUrl('Messages', 'Mymessages');?>  -->
		<li><a href="<?php echo $this -> createUrl('Messages', 'SendMessage');?>"><i class="icon write-b-icon"></i>Написать сообщение</a></li>
		<li><a href="<?php echo $this -> createUrl('Messages', 'SendMessage');?>/message_to:admin"><i class="icon admin-mail-b-icon"></i>Письмо администрации</a></li>
		<li><a href="<?php echo $this -> createUrl('Messages', 'Friend');?>"><i class="icon settings-b-icon"></i>Настройки блога(Управление друзьями)</a></li>
	</ul>
</div>
<?php if ($this->isShowMessageGroups){ ?>
<div class="navigation">
	<div class="title">
		<h2>Группы</h2>
		<i title="Показать фильтр" class="filter-link icon show-filter-icon"></i>
	</div>
	<ul class="nav-list">
		<li><a href="javascript: void(0);" onclick="ShowMessages(0, 0, '. Общая');">Общая</a> <span class="all-inf" id="total_mes0">( <span class="of-all-count"><?=$this->aGroupMessagesCount[0]['new']; ?></span> / <?=($this->aGroupMessagesCount[0]['read']+$this->aGroupMessagesCount[0]['new']); ?> )</span></li>
    <?php foreach ($this->aFriendGroups as $friendGroup){ ?>	
		<li><a href="javascript: void(0);" onclick="ShowMessages(0, <?php echo $friendGroup['id'].", '. ".$friendGroup['name']."'"; ?>);"><?=$friendGroup['name'];?></a> <span class="all-inf" id="total_mes<?php echo $friendGroup['id'];?>">( <span class="of-all-count"><?=$this->aGroupMessagesCount[$friendGroup['id']]['new']; ?></span> / <?=$this->aGroupMessagesCount[$friendGroup['id']]['read']; ?> )</span></li>
	<?php } ?>		
	</ul>
</div>
<?php } ?>