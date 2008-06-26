
<div class="list" id="list_block">
	<div style="float: left;"><h3>Каталог статей</h3></div>
	<div class="options">
		<div class="button bnormal" style="float: left;"><a href="#" onclick='ajax(<?=AjaxRequest::getJsonParam('AdminArticle', 'EditSection');?>)'>Добавить</a></div>
	</div>
<table class="list_table">
	<tr class="head">
		<td>Категория</td>
		<td>Статус</td>
		<td>Действие</td>
	</tr>
	<? foreach ($this->tree as $n): ?>
		<tr>
			<td>
				<?=str_repeat("&nbsp;&nbsp;&nbsp;",  $n['level'] -1)?>
				<?=$n['name']?><br>
			</td>
			<td><?=$n['active'] == 1 ? "Active" : "Draft"?></td>
			<td>
				<a href="#" onclick='ajax(<?=AjaxRequest::getJsonParam('AdminArticle', 'EditSection', array($n['id']));?>)'>[Редактировать]</a> 
				<a href="#" onclick='ajax(<?=AjaxRequest::getJsonParam('AdminArticle', 'DeleteSection', array($n['id']))?>)'>[Удалить]</a> 
				<a href="#" onclick='ajax(<?=AjaxRequest::getJsonParam('AdminArticle', 'SetCompetition', array($n['id']));?>)'>[Добавить конкурс]</a> 
				<a href="#" onclick='ajax(<?=AjaxRequest::getJsonParam('AdminArticle', 'SetActive', array($n['id']));?>)'>[Активировать]</a> 
				<a href="#" onclick='ajax(<?=AjaxRequest::getJsonParam('AdminArticle', 'UpSection', array($n['id']));?>)'>[Поднять категорию]</a> 
				<a href="#" onclick='ajax(<?=AjaxRequest::getJsonParam('AdminArticle', 'DownSection', array($n['id']));?>)'>[Опустить категорию]</a>
			</td>
		</tr>
	<? endforeach;?>
</table>
</div>