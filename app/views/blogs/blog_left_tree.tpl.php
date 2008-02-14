<?php foreach($this->branch_list as $key => $item){ ?>
	<p style="padding-left:<? echo  $item['level']*10;?>px;">
		<a href="<?php echo $this->router->createUrl('Blog', 'Post', array('id'=>$item['id']));?>"><? echo $item['name']; ?></a>
		<?php if ($this->blog_owner) {?>
			<a href="<?php echo $this->router->createUrl('Blog', 'EditBranch', array('id'=>$item['id']));?>"><img src="<?php echo IMG_URL; ?>edit.gif" alt="Редактировать раздел" class="editbtn" height="12" width="11"></a>
		<?php }?>
	</p>
<?php } ?>