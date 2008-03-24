<div class="block_ee1">
	<div class="block_ee2">
		<div class="block_ee3">
			<div class="block_ee4">
				<div class="block_title"><h2>Категории</h2></div>
				<?php foreach($this->cat_list as $item){ ?>
					<p><a href="<?=$this->createUrl('Article', 'List', array($item['id'])) ?>"><?=$item['name']?></a></p>
				<?php } ?>
			</div>
		</div>
	</div>
</div>