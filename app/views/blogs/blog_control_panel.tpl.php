<?php if ($this->blog_owner) {?>
	<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
		<div class="block_title"><h2>���������� ������</h2></div>
			<p><a href="<?php echo $this->router->createUrl('Blog', 'Edit');?>">�������������</a></p>
			<p><a href="<?php echo $this->router->createUrl('Blog', 'EditBranch', array('blog_id'=>$this->blog_info['id']));?>">������� ������</a></p>
			<p><a href="<?php echo $this->router->createUrl('Blog', 'PostEdit');?>">����� ����</a></p>
	</div></div></div></div>
<?php } ?>