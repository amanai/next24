<?php
	$t1 = microtime(true);
	$GLOBALS['query_counter'] = 0;
	define('USER_UPLOAD_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'users');
	error_reporting(E_ALL);
	include 'core' . DIRECTORY_SEPARATOR . 'Project.php';
	include 'core' . DIRECTORY_SEPARATOR . 'CApp.php';
	Project::initErrorHandlers();
	$app = new CApp();
	$app -> init(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'main_config.xml');	
	$controller = $app -> run();
	$app -> complete($controller);
	$t2 = microtime(true);
	//var_dump(($t2 - $t1));
	//var_dump($GLOBALS['query_counter']);
?>