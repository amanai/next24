<?php include($this -> _include('../header.tpl.php')); ?>
<div class="list" id="list_block">
	<div style="float: left;"><h3>Статьи</h3></div>
	<div class="options">
		<div class="button bnormal" style="float: left;"><a href="#" onclick='ajax(<?=AjaxRequest::getJsonParam('AdminArticle', 'AddArticle');?>)'>Добавить</a></div>
	</div>
<table class="list_table">
	<tr class="head">
		<td>Загаловок статьи</td>
		<td>Кол-во комментариев</td>
		<td>Статус</td>
		<td>Действие</td>
	</tr>
	<? foreach ($this->article_list as $item): ?>
		<tr>
			<td><?=$item['title']?></td>
			<td><?=$item['comments']?></td>
			<td>Статус</td>
			<td><a href="#" onclick='ajax(<?=AjaxRequest::getJsonParam('AdminArticle', 'ManagedSection', array($n['id']));?>)'>[Редактировать]</a> <a href="<?=$this->createUrl('AdminArticle', 'DeleteSection', array($n['id']));?>">[Удалить]</a> <a href="#" onclick='ajax(<?=AjaxRequest::getJsonParam('AdminArticle', 'SetCompetition', array($n['id']));?>)'>[Добавить конкурс]</a> <a href="<?=$this->createUrl('AdminArticle', 'SetActive', array($n['id']));?>">[Активировать]</a></td>
		</tr>
	<? endforeach;?>
</table>
</div>
<?php include($this -> _include('../footer.tpl.php')); ?>