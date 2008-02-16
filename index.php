<?php


require_once('!tmp/Node.php');

error_reporting(E_ALL^E_NOTICE);
	if(file_exists('local/config.php')) include 'local/config.php';
	include 'config.php';



require_once(CORE_PATH . 'AppException.php');
include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Project.php');

/**
 * TODO:: hardcoded list of includes pathes. May be later it will come from configuration file or other place.
 */
$pathes = array(
				VIEWS_PATH, 
				MODELS_PATH, 
				CONTROLLERS_PATH, 
				UTILS_PATH, 
				MANAGER_PATH, 
				APP_PATH,
				CORE_PATH,
				INTERFACES_PATH);

foreach ($pathes as $p){
	set_include_path(get_include_path() . PATH_SEPARATOR . $p);
}

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
	$app -> init(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'main_config.xml');	
	$app->run();


	function getManager($name){
		global $app;
		return $app->getManager($name);
	}
	



?>