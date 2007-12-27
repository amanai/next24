<?php
	if(file_exists('local/config.php')) include 'local/config.php';
	else include 'config.php';

	include 'core/CApp.php';

	function vdie(){
		$vars = func_get_args();
		foreach ($vars as $var) {
			$funct = $funct ? $funct : (is_scalar($var) || is_null($var) ? 'var_dump' : 'print_r');
	    	print("<pre>");
	    	$funct($var);
	    	print("</pre>");
		}
	    exit();
	} 

	global $app;

	$app = new CApp();	
	$app->run();
		
	function getManager($name){
		global $app;
		return $app->getManager($name);
	}
	



?>