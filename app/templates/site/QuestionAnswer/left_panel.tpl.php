<div class="navigation">
	<div class="title">
		<h2>Категории</h2>
		<i title="Показать фильтр" class="filter-link icon show-filter-icon"></i>
	</div>
	<ul class="nav-list">
	<?php if(!$this->action) { ?>
		<?php foreach($this->question_cat_list as $item){ ?>
			<li><a href="<?=$this->createUrl('QuestionAnswer', 'UserQuestions', array($item['id'])) ?>"><?=$item['name']?></a></li>
		<?php } ?>		
	<?php } else { ?>
		<?php foreach($this->question_cat_list as $item){ ?>
			<li><a href="<?=$this->createUrl('QuestionAnswer', 'UserQuestions', array($item['id'])) ?>"><?=$item['name']?></a></li>
		<?php } ?>	
	<?php } ?>						
	</ul>
</div>