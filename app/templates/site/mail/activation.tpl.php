Приветствеум Вас <?php echo $this -> login_name;?>,

Вы заполнили региcтрационную форму на сайте <?php echo $this -> registration_url;?>
Для завершения регистрации нажмите на ссылку активации снизу:

<?php echo $this -> activation_url;?>

Напоминаем Ваши данные:
Имя пользователя: <?php echo $this -> login_name;?>
<?php if ($this -> password) { ?>
Пароль: <?php echo $this -> password;?>
<?php } ?>

Пожалуйста, храните пароль в надёжном месте.

-------------------------
<?php if ($this -> support_email) { ?>
	Если Вы получили это письмо по ошибке, или у Вас есть вопросы, пожалуйста, пишите нам: <?php echo $this -> support_email;?>
<?php } ?>

С наилучшими пожеланиями,
Next24.RU