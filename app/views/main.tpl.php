
<?php if(isset($this->userData['first_name'])) {?>
Добро пожаловать <?php echo $this->userData['first_name'].' '.$this->userData['last_name']; ?>!<br/>
<a href="<?php echo $this->router->createUrl('User', 'Logout')?>">Выход</a>
<?php } else { ?>
<form action="<?php echo $this->router->createUrl('User', 'Login')?>" method="POST">
<input type="hidden" value="<?php echo $this->lastPath; ?>" name="lastPath">
Логин: <input type="text" name="login"><br/>
Пароль: <input type="password" name="pass"><br/>
<input type="submit" value="Логин">
</form>
<?php } ?>
	
<a href="<?php echo $this->router->createUrl('Rights')?>">Управление правами</a>
	
<?php echo $this->content; ?>	