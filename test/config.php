<?php
	define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'].str_replace(basename($_SERVER['SCRIPT_FILENAME']), '', $_SERVER['SCRIPT_NAME']));
	
	define('APP_PATH', BASE_PATH.'app/');
	define('CORE_PATH', BASE_PATH.'core/');
	
	define('CONTROLLERS_PATH', APP_PATH.'controllers/');
	define('MODELS_PATH', APP_PATH.'models/');
	define('VIEWS_PATH', APP_PATH.'views/');
	
	
	define('DEFAULT_CONTROLLER', 'Index');
	define('DEFAULT_ACTION', 'Index');
	
	
	class FLASH_MSG_TYPES{
		static public $error 	= 0;
		static public $warning 	= 1;
		static public $note 	= 2;
		static public $done 	= 3;
		
		static public $colors 	= array(
			'red',
			'yellow',
			'black',
			'green',
		);
	}
	
?>