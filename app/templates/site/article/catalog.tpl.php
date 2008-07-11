<div class="block_ee1">
	<div class="block_ee2">
		<div class="block_ee3">
			<div class="block_ee4">
				<div class="block_title"><h2>Категории</h2></div>
				<?php /*foreach($this->cat_list as $item){ ?>
					<p><a href="<?=$this->createUrl('Article', 'List', array($item['id'])) ?>"><?=$item['name']?></a></p>
				<?php }*/ ?>
				
		
<style type="text/css">
.close_folder {
  padding-left: 28px;
}

.open_folder {
  padding-left: 28px; 
}

.item {
  padding-left: 0px;
  padding: 0px;
}

</style>



	
			
					
					
					<?foreach ($this->root as $node):?>
						<?if (count($this->child[$node['key']]) > 0):?>
							<a href="<?=Project::getRequest()->createUrl('Article', 'List', array($node['id']))?>"><img src='<?if(strpos($this->select_node['key'], $node['key']) === 0):?><?=$this -> image_url."icons/minus.gif"; ?><?else :?><?=$this -> image_url."icons/plus.gif"; ?><?endif;?>' /><b> <?=$node['name']?></b></a><div <?if(strpos($this->select_node['key'], $node['key']) === 0):?>class="open_folder" <?else :?>class="close_folder" <?endif;?>>
								<? tree($node['key'], $this->child, $this); ?>
							</div>
						<?else :?>
							<div class="item"><b>»</b> <a href="<?=Project::getRequest()->createUrl('Article', 'List', array($node['id']));?>"><?=$node['name']?></a></div>
						<?endif;?>
					<?endforeach;?>
					
					<?function tree($key, $child, $obj) { ?>
					
						<?foreach ($child[$key] as $subNode) :?>
							<? if (strpos($obj->select_node['key'], substr($subNode['key'], 0, -4)) === 0) : ?>
								<?if(count($child[$subNode['key']]) > 0):?>
									<a href="<?=Project::getRequest()->createUrl('Article', 'List', array($subNode['id']))?>"><img src='<?if(strpos($obj->select_node['key'], $subNode['key']) === 0) :?><?=Project::getRequest()->getBaseUrl()."/app/images/icons/minus.gif"; ?><?else :?><?=Project::getRequest()->getBaseUrl()."/app/images/icons/plus.gif"; ?><?endif;?>' /><b> <?=$subNode['name']?></b></a>
									<div <?if(strpos($obj->select_node['key'], $subNode['key']) === 0) :?>class="open_folder"<?else :?> class="close_folder" <?endif;?> >
										<?tree($subNode['key'], $child, $obj);?>
									</div>
								<?else :?>
									<div><b>»</b> <a href="<?=Project::getRequest()->createUrl('Article', 'List', array($subNode['id']))?>"><?=$subNode['name']?></a></div>
								<?endif;?>
							<?endif;?>
						<?endforeach;?>
					<? } ?>

	
   
			</div>
		</div>
	</div>
</div>