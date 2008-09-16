<div class="block_ee1">
	<div class="block_ee2">
		<div class="block_ee3">
			<div class="block_ee4">
				<div class="block_title"><h2>Категории</h2></div>
				
		

	<ul class="cat_tree" style="margin-left: -20px;">
	<?foreach ($this->tree as $key => $node):?>
		<?if ($node['level'] == 1):?> 
			<?if (haveChild($node['key'], $this->tree)):?>
				<li>
					<?if ($this->selected_node['id'] == $node['id']) :?>
						<img src="<?=Project::getRequest()->getBaseUrl()."/app/images/cat2_open.png"?>" />
						<?=$node['name']?>
						<ul class="cat_tree">
					<?else :?>
						<?if (strpos($this->selected_node['key'], $node['key']) === 0) :?>
							<a href="<?=$node['link']?>"><img src="<?=Project::getRequest()->getBaseUrl()."/app/images/cat2_open.png"?>" /></a>
							<a href="<?=$node['link']?>"><?=$node['name']?></a>
							<ul class="cat_tree">
						<?else :?>
							<a href="<?=$node['link']?>"><img src="<?=Project::getRequest()->getBaseUrl()."/app/images/cat2.gif"?>" /></a>
							<a href="<?=$node['link']?>"><?=$node['name']?></a>
							<ul class="cat_tree" style="display: none">
						<?endif;?>
					<?endif;?>
				
					<? createTree($node, $this) ?>
				</ul>
				</li>
			<?else :?>
				<li>
					<?if ($this->selected_node['id'] == $node['id']) :?>
						<?=$node['name']?>
					<?else :?>
						<a href="<?=$node['link']?>"><?=$node['name']?></a>
					<?endif;?>
				</li>
			<?endif;?>	
		<?endif;?>
	<?endforeach;?>
	</ul>
	<?
		function createTree($parent, $obj) {
			foreach ($obj->tree as $key => $node) {
				if($parent['key'] == substr($node['key'], 0, -4)){ ?>
					<? if(haveChild($node['key'], $obj->tree)) :?>
						<li>
							<?if ($obj->selected_node['id'] == $node['id']) :?>
								<img src="<?=Project::getRequest()->getBaseUrl()."/app/images/cat2_open.png"?>" />
								<?=$node['name']?>
								<ul class="cat_tree" >
							<?else :?>
								
								<?if (strpos($obj->selected_node['key'], $node['key']) === 0) :?>
									<a href="<?=$node['link']?>"><img src="<?=Project::getRequest()->getBaseUrl()."/app/images/cat2_open.png"?>" /></a>
									<a href="<?=$node['link']?>"><?=$node['name']?></a>
									<ul class="cat_tree">
								<?else :?>
									<a href="<?=$node['link']?>"><img src="<?=Project::getRequest()->getBaseUrl()."/app/images/cat2.gif"?>" /></a>
									<a href="<?=$node['link']?>"><?=$node['name']?></a>
									<ul class="cat_tree" style="display: none">
								<?endif;?>
							<?endif;?>
						
						<? createTree($node, $obj) ?>
						</ul>
						</li>
					<?else :?>
						<li>
							<?if ($obj->selected_node['id'] == $node['id']) :?>
								<?=$node['name']?>
							<?else :?>
								<a href="<?=$node['link']?>"><?=$node['name']?></a>
							<?endif;?>
						</li>
					<?endif;?>
					<?
				}
			}
		}
		
		function haveChild($parent, $tree) {
			$i = 0;
			foreach ($tree as $k => $n) if($parent == substr($n['key'], 0, -4)) $i++;
			if($i == 0) {
				return false;
			} else {
				return true;
			}
		}
	?>

			
					
					
					

	
   
			</div>
		</div>
	</div>
</div>