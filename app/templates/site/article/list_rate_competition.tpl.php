<table class="stat-table"> 
	<thead> 
		<tr> 
			<th class="main-row">Тема</th> 
			<th>Автор</th> 
			<th>Оценка</th> 
			<th>Дата создания</th> 
			<th>Действие</th>
		</tr> 
	</thead> 
	<tbody>
	<?foreach ($this->article_list as $key => $item):?>
	<?php 
		$user = Project::getUser()->getDbUser()->getUserByLogin($item['login']);
		$avatar = Project::getUser()->getDbUser()->getUserAvatar($user['id']);
		$avPath = $avatar['path'];
		if(!$avPath || $avPath == 'no.png') $avPath = 'no25.jpg';
	?>		
	<tr> 
		<td class="qv">
			<a href="<?=$this->createUrl('Article', 'ArticleView', array($item['id']))?>"><?=$item['title']?></a>
			<div class="breadcrumbs">
				<?=$item['full_path']?>
			</div>
		</td> 
		<td class="av"><a href="<?php echo $this->createUrl('User', 'Profile', null, $item['login'])?>" class="avatar-link"><img src="<?=$this->image_url.'avatar/'.$avPath;?>" style="width:25px;height:25px;" alt="" class="avatar" /><span class="t"><?=$item['login']?></span></a></td> 
		<td class="an"><?=$item['votes'];?></td> 
		<td class="date"><?=$item['creation_date']?></td> 
		<td>
			<? if($this->can_vote && $item['user_id'] != Project::getUser()->getDbUser()->id) {
					echo "<a href=".$this->createUrl('Article', 'SubjectVote', array($item['id'])).">Голосовать за тему</a></td>";
				} else {
					echo " - ";
			} ?>		
		</td>		
	</tr> 	
	<?endforeach;?>	 
	</tbody> 
</table> 