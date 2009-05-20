<?php

session_start();
if (!isset($_SESSION['ss'])) {
    $_SESSION['ss'] = $_SERVER['HTTP_HOST'];
	echo 'Setting value...<br>';
}
echo $_SESSION['ss'];
//тест комита, а заодно русского языка в треке
?>