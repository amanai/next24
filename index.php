<?php
	// Time seek
	$t1 = microtime(true);
	$GLOBALS['query_counter'] = 0;
	// ---------
	
	define('USER_UPLOAD_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'users');
	error_reporting(E_ALL);
	include 'core' . DIRECTORY_SEPARATOR . 'Project.php';
	include 'core' . DIRECTORY_SEPARATOR . 'CApp.php';
	Project::initErrorHandlers();
	$app = new CApp();
	$app -> init(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'main_config.xml'); // 0,1538 sec	
	$controller = $app -> run(); // 0,0875 sec
	$app -> complete($controller);
	
	// Time seek
	$t2 = microtime(true);
	echo '<!-- Generation time '.round($t2-$t1, 4).' sec, queries '.$GLOBALS['query_counter'].' -->';
	// ----------
?>