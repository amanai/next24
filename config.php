<?php

	define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'].str_replace(basename($_SERVER['SCRIPT_FILENAME']), '', $_SERVER['SCRIPT_NAME']));
	
	define('APP_PATH', BASE_PATH.'app/');
	define('CORE_PATH', BASE_PATH.'core/');
	
	define('MANAGER_PATH', CORE_PATH.'managers/');
	define('UTILS_PATH', CORE_PATH.'utils/');
	define('RULE_DIR_PATH', UTILS_PATH.'rules/');
	
	define('CONTROLLERS_PATH', APP_PATH.'controllers/');
	define('MODELS_PATH', APP_PATH.'models/');
	define('VIEWS_PATH', APP_PATH.'views/');
	
	define('FORM_FIELD_PATH', VIEWS_PATH.'form/field/');

	define('FORM_FIELD_TEXT', FORM_FIELD_PATH . 'text.tpl.php');

	define('FORM_FIELD_TEXTAREA', FORM_FIELD_PATH . 'textarea.tpl.php');

	define('FORM_FIELD_HTMLEDITOR', FORM_FIELD_PATH . 'htmleditor.tpl.php');

	define('FORM_FIELD_SELECT', FORM_FIELD_PATH . 'select.tpl.php');

	define('FORM_FIELD_DATE', FORM_FIELD_PATH . 'date.tpl.php');

	define('FORM_FIELD_PASSWORD', FORM_FIELD_PATH . 'password.tpl.php');

	define('FORM_FIELD_CHECKBOX', FORM_FIELD_PATH . 'checkbox.tpl.php');

	define('FORM_FIELD_IMAGE', FORM_FIELD_PATH . 'image.tpl.php');
	
	define('DEFAULT_CONTROLLER', 'Index');
	define('DEFAULT_ACTION', 'Index');

	define('TABLE_PREFIX', '');
	define('DEFAULT_TPL', VIEWS_PATH . 'main.tpl.php');
	
	define('DB_SERVERNAME', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'gek_next24');
	

	include(CORE_PATH.'constants.php');
?>