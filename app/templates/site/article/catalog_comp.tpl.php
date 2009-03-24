	<ul class="nav-list">
	<?foreach ($this->tree as $key => $node):?>
		<?if ($node['level'] == 1):?> 
			<?if (haveChild($node['key'], $this->tree)):?>
				<li>
					<?if ($this->selected_node['id'] == $node['id']) :?>
						<i class="arrow-icon"></i>
						<?=$node['name']?>
						<ul class="nav-list">
					<?else :?>
						<?if (strpos($this->selected_node['key'], $node['key']) === 0) :?>
							<i class="arrow-icon"></i>
							<a href="<?=$node['link']?>"><?=$node['name']?></a>
							<ul class="nav-list">
						<?else :?>
							<i class="arrow-icon"></i>
							<a href="<?=$node['link']?>"><?=$node['name']?></a>
							<ul class="nav-list">
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
								<i class="arrow-icon"></i>
								<?=$node['name']?>
								<ul class="nav-list" >
							<?else :?>
								
								<?if (strpos($obj->selected_node['key'], $node['key']) === 0) :?>
									<i class="arrow-icon"></i>
									<a href="<?=$node['link']?>"><?=$node['name']?></a>
									<ul class="nav-list">
								<?else :?>
									<i class="arrow-icon"></i>
									<a href="<?=$node['link']?>"><?=$node['name']?></a>
									<ul class="nav-list">
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