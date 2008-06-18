
	<div style="float: left;"><h3>Статьи</h3></div>
	<div class="options">
		<div class="button bnormal" style="float: left;"><a href="<?=$this->add_link?>">Добавить</a></div>
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
			<td>
				<a href='<?=$this->createUrl($this->controller, $this->edit_action, array($item['id']))?>'>[Редактировать]</a> 
				<a href="#" onclick='ajax(<?=AjaxRequest::getJsonParam($this->controller, $this->delete_article_action, array($item['id']));?>)'>[Удалить]</a> 
				<a href="#" onclick='ajax(<?=AjaxRequest::getJsonParam($this->controller, $this->reset_rate_action, array($item['id']));?>)' >[Сбросить рейтинг]</a>
			</td>
		</tr>
	<? endforeach;?>
</table>

<?=var_dump($this->req)?>

<?=$this->list_pager_html?>