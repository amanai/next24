
<table class="questions" width="100%">
	<tr>
		<td style="text-align: center;"><b>Дата публикации</b></td>
		<td style="text-align: center;"><b>Тема</b></td>
		<td style="text-align: center;"><b>Категория</b></td>
		<td style="text-align: center;"><b>Авторы</b></td>
		<td style="text-align: center;"><b>Действие</b></td>
	</tr>
	<?foreach ($this->article_list as $key => $item):?>
	<tr id=<?php if($key%2==0) { ?>"cmod_tab2"<?php } else { ?>"cmod_tab1"<?php } ?>>
		<td style="text-align: center;">
			<?=$item['creation_date']?>
		</td>
		<td style="text-align: center;"><?=$item['title']?></td>
		<td style="text-align: center;"><?=$item['full_path']?></td> <!--TODO-->
		<td style="text-align: center;"><?=$item['login']?></td>
		<td style="text-align: center;">
			<?
				if($this->can_vote && $item['user_id'] != Project::getUser()->getDbUser()->id) {
					echo "<a href=".$this->createUrl('Article', 'Vote', array($item['id'])).">Голосовать за тему</a></td>";
				} else {
					echo " - ";
				}
			?>
	</tr>
	<?endforeach;?>
</table>
