<?php
	define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'].str_replace(basename($_SERVER['SCRIPT_FILENAME']), '', $_SERVER['SCRIPT_NAME']));
	
	define('APP_PATH', BASE_PATH.'app/');
	define('CORE_PATH', BASE_PATH.'core/');
	
	define('CONTROLLERS_PATH', APP_PATH.'controllers/');
	define('MODELS_PATH', APP_PATH.'models/');
	define('VIEWS_PATH', APP_PATH.'views/');
	
	
	define('DEFAULT_CONTROLLER', 'Index');
	define('DEFAULT_ACTION', 'Index');

	define('TABLE_PREFIX', '');	define('APPLICATION_PATH', 'app/');	define('VIEW_PATH', APPLICATION_PATH . 'view/');	define('DEFAULT_TPL', VIEW_PATH . 'main.tpl.php');	
	define('DB_SERVERNAME', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'next24');
	

	include(CORE_PATH.'constants.php');
?>