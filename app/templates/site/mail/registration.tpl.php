Здравствуйте, <?php echo $this -> login_name;?>

Вы успешно зарегистрированы на сайте <?php echo $this -> registration_url;?>. 

Ваши данные для доступа:

  Логин: <?php echo $this -> login_name;?>
 <?php if ($this -> password) { ?>
  Пароль: <?php echo $this -> password;?>
<?php } ?>

Сменить пароль вы можете в личном кабинете.

----------------------------------------------------
Служба автоматической корреспонденции www.next24.ru
<?php if ($this -> support_email) { ?>
Если Вы получили это письмо по ошибке, или у Вас есть вопросы, пожалуйста, пишите нам: <?php echo $this -> support_email;?>
<?php } ?>