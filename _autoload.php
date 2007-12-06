<?
	function __autoload($classname){
		$reg = array(
			// classes
			'BasicNode'	=> 'classes/basic_node.class.php'
			, 'Key'	=> 'classes/key.class.php'
			


			// core
			, 'ioPage' 	=> 'classes/page.class.php'
			, 'Mysql' 	=> 'classes/Mysql.php'
		);

		if (isset($reg[$classname])){
			require_once($reg[$classname]);
		}else{
			return false;
		}
	}
?>
