
<table class="questions" width="100%">
	<tr>
		<td><b>Дата публикации</b></td>
		<td><b>Тема</b></td>
		<td><b>Категория</b></td>
		<td><b>Авторы</b></td>
		<td><b>Действие</b></td>
	</tr>
	<?foreach ($this->article_list as $key => $item):?>
	<tr id=<?php if($key%2==0) { ?>"cmod_tab2"<?php } else { ?>"cmod_tab1"<?php } ?>>
		<td style="text-align: left; white-space: normal;">
			<?=$item['creation_date']?>
		</td>
		<td><?=$item['title']?></td>
		<td><?=$item['articles_tree_id']?></td> <!--TODO-->
		<td><?=$item['user_id']?></td>
		<td><a href="#">Голосовать за тему</a></td>
	</tr>
	<?endforeach;?>
</table>