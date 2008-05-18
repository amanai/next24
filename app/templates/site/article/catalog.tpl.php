<div class="block_ee1">
	<div class="block_ee2">
		<div class="block_ee3">
			<div class="block_ee4">
				<div class="block_title"><h2>Категории</h2></div>
				<?php /*foreach($this->cat_list as $item){ ?>
					<p><a href="<?=$this->createUrl('Article', 'List', array($item['id'])) ?>"><?=$item['name']?></a></p>
				<?php }*/ ?>
				
				
<style type="text/css">
.node {
    padding-left: 20px;
}
</style>
<script language="javascript">
function set(id_el, key) {
    el = document.getElementById("child_key_"+key);
    p_el = document.getElementById(id_el);
    if (el.style.display=="none") {
        el.style.display="block";

    } else {
        el.style.display="none";
        
    }
}
</script>
				
				<?php
					
					foreach ($this->root as $node) {
						?> <div id='p_<?=$node['key']?>' onClick="set(this.id, '<?=$node['key']?>')"><?=$node['name']?></div><?
						tree($node['key'], $this->child);
					}
					
					function tree($key, $child) {
					
						
						foreach ($child[$key] as $subNode) {
							if(count($child[$subNode['key']]) > 0) {
								?><div class='node' id='child_key_<?=$key?>' style='display: none' onClick="set(this.id, '<?=$subNode['key']?>')"><?
								
								echo "+".$subNode['name']."<br />";
								tree($subNode['key'], $child);
							} else {
								?><div class='node' id='child_key_<?=$key?>' style='display: none'><?
								echo "-".$subNode['name']."<br />";
								
							}
						}
						echo "</div>";
					}
				
				?>

	

			</div>
		</div>
	</div>
</div>