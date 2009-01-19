<?php include($this -> _include('../popup_header.tpl.php')); ?>

<div style="width: 300px; display: table; margin: 10px;">
	<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
		<div class="block_title"><h2><?=($this->type==0?'Оклонение':'Одобрение');?> категории <?=$this->category->name;?></h2></div>
	
		<form action="<?=$this->createUrl('Bookmarks', 'AllowDenyCategory', array('id'=>$this->category->id, 'type'=>$this->type)); ?>" method="post">
		
			<table width="100%" cellpadding="2">
			<? if ($this->type==1) { ?>
				<tr>
					<td width="100">
						<input type="checkbox" name="rename" value="1" id="rename" onClick="if ($('#rename').attr('checked')) {$('#name').slideDown('fast')} else {$('#name').slideUp('fast')};"/><label for="rename">переименовать</label>
						<div id="name" style="display: none;">
							Новое имя:<br/>
							<input type="text" name="name" value="<?=$this->category->name;?>"/>
							<br/><br/>
						</div>
					</td>
				</tr>
			<? } ?>
				<tr>
					<td width="100">
					
						Причина/комментарий:<br/>
						<textarea style="width: 100%; height: 100px;" name="comment"></textarea>
					
					</td>
				</tr>
				<tr>
					<td align="right" style="padding-right: 6px;">
		
						<input type="submit" alt="Отправить" value="Отправить" />
					
					</td>
				</tr>
			<table>
		
		</form>	

		</div></div></div></div>

</div>

<?php include($this -> _include('../popup_footer.tpl.php')); ?>

