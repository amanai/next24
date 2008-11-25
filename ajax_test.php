<?php
	$res=array();
	
	$res['status']=0;
	sleep(1);
	
	if ($_POST['name']&&$_POST['email']&&$_POST['company']&&$_POST['company_info']&&$_POST['troubles']) {
		include('class.phpmailer.php');								
		$m = new PHPMailer();										
		$body  = 'Имя: '.iconv("UTF-8", "WINDOWS-1251", $_POST['name']).'<br>';					
		$body .= 'Email: '.iconv("UTF-8", "WINDOWS-1251", $_POST['email']).'<br>';					
		$body .= 'Телефон: '.iconv("UTF-8", "WINDOWS-1251", $_POST['phone']).'<br>';
		$body .= 'Название компании: '.iconv("UTF-8", "WINDOWS-1251", $_POST['company']).'<br>';
		$body .= 'Адрес сайта: '.iconv("UTF-8", "WINDOWS-1251", $_POST['url']).'<br>';
		$body .= 'Размер компании: '.iconv("UTF-8", "WINDOWS-1251", $_POST['company_size']).'<br>';
		$body .= '<hr>';
		$body .= 'Чем занимается компания: '.iconv("UTF-8", "WINDOWS-1251", $_POST['company_info']).'<br>';
		$body .= '<hr>';
		$body .= 'Описание проблемы: '.iconv("UTF-8", "WINDOWS-1251", $_POST['troubles']).'<br>';				
		$body .= '<hr>';					
		$body .= 'Дата отправки: '.date('d.m.Y H:i:s');												
		$m->CharSet = 'windows-1251';							
		$m->From = 'admin@anti-krizis.com';
		$m->FromName = 'Anti-Krizis Robot';
		$m->Subject = 'Заявка с сайта anti-krizis.com';
		$m->Body = $body;
		$m->IsHTML(true);					
		$m->AddAddress('step.victor@gmail.com', 'Victor');							
		$m->AddCC('smartgekos@gmail.com', 'Artem');					
		if ($m->Send())	$res['status']=1;
	} else {
		$res['status']=0;
	}
	
	echo json_encode($res);
?>