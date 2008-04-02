<?php include($this -> _include('../header.tpl.php')); ?>
<div class="list" id="list_block">
	<div style="float: left;"><h3>Каталог статей</h3></div>
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
			<td><a href="#">[Редактировать]</a> <a href="#">[Удалить]</a></td>
		</tr>
	<? endforeach;?>
</table>
</div>
<?php include($this -> _include('../footer.tpl.php')); ?>