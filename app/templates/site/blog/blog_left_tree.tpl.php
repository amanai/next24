<?php  if (is_array($this->branch_list)) { ?>
	<?php foreach($this->branch_list as $key => $item){ ?>
	<?php 
//	print '<pre>';
//		print_r($item);
//	print '</pre>';	
	?>
		<? // $item['level'];?>
			<li>
				<?php if ($this->blog_owner) {?>
					<a class="with-icon-s" style="margin-bottom:10px; padding-right:0;margin-right:0;" href="<?php echo $this->createUrl('Blog', 'EditBranch', array($item['id']));?>"><i class="icon-s write-s-icon"></i></a>
				<?php }else{?>
		 			<a href="<?php echo $this->createUrl('Blog', 'DoSubscribe', array("tree_id"=>$item['id'])); ?>" id="micro">
				<?php if ($item['subscribe_id']){
							echo "[отписаться]";
						}else{
			   	 			echo "[подписаться]";
						} ?>
					</a>
				<? }?>			
				<a class="with-icon-s" style="margin-left:0;padding-left:0;" href="<?php echo $this->createUrl('Blog', 'PostList', array($item['id']));?>"><? echo $item['name']; ?></a> <!-- (8)  -->
			</li>
	<? } ?>
<? } ?>