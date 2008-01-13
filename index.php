<?php
	if(file_exists('local/config.php')) include 'local/config.php';
	include 'config.php';

	include 'core/CApp.php';

	function vdie(){
		$vars = func_get_args();
		foreach ($vars as $var) {
			$funct = isset($funct) ? $funct : (is_scalar($var) || is_null($var) ? 'var_dump' : 'print_r');
	    	print("<pre>");
	    	$funct($var);
	    	print("</pre>");
		}
	    exit();
	}
/*
$rights = array("IndexController"=>array("IndexAction"=>array("sub2", "sub1")),
				"TestController"=>array("IndexAction"=>array(), "DeleteAction"=>array(), "EditAction"=>array(), "AddAction"=>array(), "SaveAction"=>array()),
				"UserController"=>array("LoginAction"=>array(), "LogoutAction"=>array()),
				"RightsController"=>array("IndexAction"=>array(), "SaveAction"=>array()),
				);
echo serialize($rights);
die;
*/


	global $app;
	$app = new CApp();	
	$app->run();


	function getManager($name){
		global $app;
		return $app->getManager($name);
	}
	



?>