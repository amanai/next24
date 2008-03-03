<div class="block_ee1">
	<div class="block_ee2">
		<div class="block_ee3">
			<div class="block_ee4">
				<div class="block_title"><h2>Категории</h2></div>
				<?php foreach($this->question_cat_list as $item){ ?>
					<p><a href="<?=$this->createUrl('QuestionAnswer', 'List', array(cat_id=>$item['id']))?>"><?=$item['name']?></a></p>
				<?php } ?>
				<?php if($this->tag_list) { ?>
					<div class="block_title"><h2>Теги категории</h2></div>
					<?php foreach($this->tag_list as $item){ ?>
						<a href="<?=$this->createUrl('QuestionAnswer', 'List', array(cat_id=>Project::getRequest()->cat_id, tag_id=>$item['id']))?>"><?=$item['name']?></a>		
				<?php } } ?>
			</div>
		</div>
	</div>
</div>