<?php $router = getManager('CRouter'); ?>
<?php $session = getManager('CSession'); ?>
<?php $userData = unserialize($session->read('user')); ?>
<?php $lastPath = $session->read('LAST_PATH'); ?>

	
<?php if(isset($userData['id'])) {?>
����� ���������� <?php echo $userData['first_name'].' '.$userData['last_name']; ?>!<br/>
<a href="<?php echo $router->createUrl('User', 'Logout')?>">�����</a>
<?php } else { ?>
<form action="<?php echo $router->createUrl('User', 'Login')?>" method="POST">
<input type="hidden" value="<?php echo $lastPath; ?>" name="lastPath">
�����: <input type="text" name="login"><br/>
������: <input type="password" name="pass"><br/>
<input type="submit" value="�����">
</form>
<?php } ?>