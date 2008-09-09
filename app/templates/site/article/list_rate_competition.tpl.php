<table class="questions" width="100%">
	<tr>
		<td><b>Название</b></td>
		<td><b>Кол-во<br /> коментариев</b></td>
		<td><b>Кол-во<br /> просмотров</b></td>
		<td><b>Статус</b></td>
	</tr>
	<?foreach ($this->article_list as $key => $item):?>
	<tr id=<?php if($key%2==0) { ?>"cmod_tab2"<?php } else { ?>"cmod_tab1"<?php } ?>>
		<td style="text-align: left; white-space: normal;">
			<a href="<?=$this->createUrl('Article', 'ArticleView', array($item['id']))?>"><?=$item['title']?></a>
		</td>
		<td style="text-align: center;"><?=$item['title']?></td>
		<td style="text-align: center;"><?=$item['full_path']?></td> <!--TODO-->
		<td style="text-align: center;"><?=$item['login']?></td>
		<td style="text-align: center;">
			<?
				if($this->can_vote && $item['user_id'] != Project::getUser()->getDbUser()->id) {
					echo "<a href=".$this->createUrl('Article', 'SubjectVote', array($item['id'])).">Голосовать за тему</a></td>";
				} else {
					echo " - ";
				}
			?>
		<td><?=$item['comments']?></td>
		<td><?=$item['views']?></td>
		<td><?=$item['rate_status'] == ARTICLE_RATE_STATUS::WINNER ? "Winner" : ""?></td>

	</tr>
	<?endforeach;?>
</table>