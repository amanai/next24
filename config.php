<?
require_once('_autoload.php');

//Mysql::$logFile = "/home/www/www.domport.com/logs/sql-error.log";
//Mysql::$logFile = "c:/web/logs/wisegeek-sql-error.log";
$link = Mysql::connect($dbHost="localhost", $dbUser="root", $dbPass="");
Mysql::$defaultLink = $link;

mysql_select_db($dbDb="tree_test");

header("Content-Type: text/html; charset=UTF-8");
mb_internal_encoding("UTF-8");
?>
