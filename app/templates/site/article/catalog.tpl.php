<div class="block_ee1">
	<div class="block_ee2">
		<div class="block_ee3">
			<div class="block_ee4">
				<div class="block_title"><h2>Категории</h2></div>
				<?php /*foreach($this->cat_list as $item){ ?>
					<p><a href="<?=$this->createUrl('Article', 'List', array($item['id'])) ?>"><?=$item['name']?></a></p>
				<?php }*/ ?>
				
				<!-- панель сделаю всё нормально 26го -->
<style type="text/css">
.close_folder {
  padding-left: 30px;
  font-weight: bolder; line-height: 14px; cursor: pointer;
  background-image: url(<?=$this -> image_url."icons/plus.gif"; ?>);
  background-repeat: no-repeat;
  padding-bottom: 3px
}

.open_folder {
  padding-left: 20px;
  font-weight: bolder; line-height: 14px; cursor: pointer;
  background-image: url(<?=$this -> image_url."icons/minus.gif"; ?>);
  background-repeat: no-repeat;
  padding-bottom: 3px
}
</style>
<script language="javascript">
function set(id_el, key) {
    el = document.getElementById(key);
    p_el = document.getElementById(id_el);
    if (el.style.display=="none") {
        el.style.display="block";
        p_el.style.backgroundImage = "url(<?=$this -> image_url."icons/minus.gif"; ?>)";


    } else {
        el.style.display="none";
        p_el.style.backgroundImage = "url(<?=$this -> image_url."icons/plus.gif"; ?>)";
        
    }
 
   
}
</script>


				
				<?php
					
					foreach ($this->root as $node) {
						?> 
							<div class="close_folder" id="p_<?=$node['key']?>" onClick="javascript: set(this.id, '<?=$node['key']?>');"><?=$node['name']." key "?>
						<?
						tree($node['key'], $this->child);
						echo "</div>";
					}
					
					function tree($key, $child) {
					?>
								<div class="close_folder" style="display: none;" onClick=" <? if($child[key($child[$key])] != "") { ?>javascript: set(this.id, '<?=key($child[$key]);?>'); <? } ?>event.cancelBubble=true;"  id="<?=$key?>">
							<?
				
						
						foreach ($child[$key] as $subNode) {
							echo $subNode['name'];
							if(count($child[$subNode['key']]) > 0){
								tree($subNode['key'], $child);
							}
								
						}
						echo "</div>";
					}
				
				?>

	

			</div>
		</div>
	</div>
</div>