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
  padding-left: 28px;
  line-height: 14px;
  background-image: url(http://next24/app/images/icons/plus.gif);
  background-repeat: no-repeat;
  padding-bottom: 3px;
  
}

.open_folder {
  padding-left: 28px;
  line-height: 14px; 
  background-image: url(http://next24/app/images/icons/minus.gif);
  background-repeat: no-repeat;
  padding-bottom: 3px;
}

.item {
  padding-left: 0px;
  padding: 0px;
 
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


				
								
					<?foreach ($this->root as $node):?> 
						<?if (count($this->child[$node['key']]) > 0):?> 
							<div class="close_folder"><b><a href="javascript: set(this.id, '<?=$node['key'];?>')" style="text-decoration:none;"><?=$node['name']?></a></b>
							<? tree($node['key'], $this->child, $this); ?>
							</div>
						<?else :?> 
							<div class="item"><b>»</b> <a href="<?=Project::getRequest()->createUrl('Article', 'List', array($subNode['id']));?>"><?=$node['name']?></a></div>
						<?endif;?>
					<?endforeach;?>
					
					<?function tree($key, $child, $obj) { ?>					
						<div id="<?=$key?>" style="display: none">
						<?foreach ($child[$key] as $subNode) :?>
								<?if(count($child[$subNode['key']]) > 0):?>
									<div class="close_folder" id="p_<?=$subNode['key']?>" ><b ><a href="javascript: set(this.id, '<?=key($child[$key]);?>')" style="text-decoration:none;"><?=$subNode['name']?></a></b>
									<?tree($subNode['key'], $child, $obj);?>
									</div>
								<?else :?> 
									<div class="item" id="p_<?=$subNode['key']?>" ><b>»</b> <a href="<?=Project::getRequest()->createUrl('Article', 'List', array($subNode['id']));?>"><?=$subNode['name']?></a></div>
								<?endif;?>
									
						<?endforeach;?>
						</div>
					<? } ?>

	

			</div>
		</div>
	</div>
</div>