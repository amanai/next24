<?php if ($this->blog_owner) {?>
	<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
		<div class="block_title"><h2>Управление блогом</h2></div>
			<p><a href="<?php echo $this->router->createUrl('Blog', 'Edit');?>">Редактировать</a></p>
			<p><a href="<?php echo $this->router->createUrl('Blog', 'EditBranch', array('blog_id'=>$this->blog_info['id']));?>">Создать раздел</a></p>
			<p><a href="<?php echo $this->router->createUrl('Blog', 'PostEdit');?>">Новый пост</a></p>
	</div></div></div></div>
<?php } ?>