
<table class="questions" width="100%">
	<tr>
		<td style="text-align: center;"><b>Дата публикации</b></td>
		<td style="text-align: center;"><b>Тема</b></td>
		<td style="text-align: center;"><b>Категория</b></td>
		<td style="text-align: center;"><b>Автор</b></td>
	</tr>
	<?foreach ($this->article_list as $key => $item):?>
	<tr id=<?php if($key%2==0) { ?>"cmod_tab2"<?php } else { ?>"cmod_tab1"<?php } ?>>
		<td style="text-align: center; white-space: normal;">
			<?=$item['creation_date']?>
		</td>
		<td style="text-align: center;"><?=$item['title']?></td>
		<td style="text-align: center;"><?=$item['full_path']?></td> <!--TODO-->
		<td style="text-align: center;"><?=$item['login']?></td>
	</tr>
	<?endforeach;?>
</table>