
<?php if(isset($this->userData['first_name'])) {?>
����� ���������� <?php echo $this->userData['first_name'].' '.$this->userData['last_name']; ?>!<br/>
<a href="<?php echo $this->router->createUrl('User', 'Logout')?>">�����</a>
<?php } else { ?>
<form action="<?php echo $this->router->createUrl('User', 'Login')?>" method="POST">
<input type="hidden" value="<?php echo $this->lastPath; ?>" name="lastPath">
�����: <input type="text" name="login"><br/>
������: <input type="password" name="pass"><br/>
<input type="submit" value="�����">
</form>
<?php } ?>
	
<a href="<?php echo $this->router->createUrl('Rights')?>">���������� �������</a>
	
<?php echo $this->content; ?>	