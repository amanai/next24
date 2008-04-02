<?php include($this -> _include('../header.tpl.php')); ?>
<div class="list" id="list_block">
	<div style="float: left;"><h3>Каталог статей</h3></div>
	<div class="options">
		<div class="button bnormal" style="float: left;"><a href="#" onclick='ajax(<?=AjaxRequest::getJsonParam('AdminArticle', 'ManagedSection');?>)'>Добавить</a></div>
	</div>
<table class="list_table">
	<tr class="head">
		<td>Категория</td>
		<td>Действие</td>
	</tr>
	<? foreach ($this->tree as $n): ?>
		<tr>
			<td>
				<?=str_repeat("&nbsp;&nbsp;&nbsp;",  $n['level'] -1)?>
				<?=$n['name']?><br>
			</td>
			<td><a href="#" onclick='ajax(<?=AjaxRequest::getJsonParam('AdminArticle', 'ManagedSection', array($n['id']));?>)'>[Редактировать]</a> <a href="<?=$this->createUrl('AdminArticle', 'DeleteSection', array($n['id']));?>">[Удалить]</a></td>
		</tr>
	<? endforeach;?>
</table>
</div>
<?php include($this -> _include('../footer.tpl.php')); ?>