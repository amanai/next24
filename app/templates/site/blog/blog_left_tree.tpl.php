<?php if (is_array($this->branch_list)) { ?>
	<?php foreach($this->branch_list as $key => $item){ ?>
		<p style="padding-left:<? echo  $item['level']*10;?>px;">
			<a href="<?php echo $this->createUrl('Blog', 'PostList', array($item['id']));?>"><? echo $item['name']; ?></a>
			<?php if ($this->blog_owner) {?>
				<a href="<?php echo $this->createUrl('Blog', 'EditBranch', array($item['id']));?>"><img src="<?php echo $this -> image_url; ?>edit.gif" alt="Редактировать раздел" class="editbtn" height="12" width="11"></a>
			<?php }?>
		</p>
	<?php } ?>
<?php } ?>