<?php
	define('USER_UPLOAD_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'users');
	error_reporting(E_ALL);
	include 'core' . DIRECTORY_SEPARATOR . 'Project.php';
	include 'core' . DIRECTORY_SEPARATOR . 'CApp.php';
	Project::initErrorHandlers();
	$app = new CApp();
	$app -> init(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'main_config.xml');	
	$controller = $app -> run();
	$app -> complete($controller);
?>