<?php
	
	define('USER_TYPE_GUEST', '0');
		
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
	
	function quotesEscape($str){
		$search = array('"', "'");
		$replace = array('\"', "\'");
		return str_replace($search, $replace, $str);
	}
?>