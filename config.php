<?php
	define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'].str_replace(basename($_SERVER['SCRIPT_FILENAME']), '', $_SERVER['SCRIPT_NAME']));
	define('BASE_URL',  'http://'.$_SERVER['HTTP_HOST'].substr(str_replace(basename($_SERVER['SCRIPT_FILENAME']), '', $_SERVER['SCRIPT_NAME']), 0, -1).'/');
		
	define('APP_PATH', BASE_PATH.'app/');
	define('CORE_PATH', BASE_PATH.'core/');
	
	define('CSS_URL', BASE_URL.'app/css/');
	define('JS_URL', BASE_URL.'app/js/');
	define('IMG_URL', BASE_URL.'app/images/');
	define('USER_UPLOAD_DIR', 'users');
		
	define('MANAGER_PATH', CORE_PATH.'managers/');
	define('UTILS_PATH', CORE_PATH.'utils/');
	
	
	define('INTERFACES_PATH', APP_PATH.'interfaces/');
	
	define('CONTROLLERS_PATH', APP_PATH.'controllers/');
	define('MODELS_PATH', APP_PATH.'models/');
	define('VIEWS_PATH', APP_PATH.'views/');
	define('TEMPLATES_PATH', APP_PATH.'templates/');
	
	
	define('DEFAULT_CONTROLLER', 'Index');
	define('DEFAULT_ACTION', 'Index');

	define('TABLE_PREFIX', '');	define('DEFAULT_TPL', VIEWS_PATH . 'main.tpl.php');	
	define('DB_SERVERNAME', 'next24.ru');
	define('DB_USERNAME', 'next24');
	define('DB_PASS', 'kduzo2vfsl4b');
	define('DB_NAME', 'next24');
	
	define('ADMIN_MAIL', 'admin@next24.ru');

	
	require_once(CORE_PATH.'constants.php');
?>