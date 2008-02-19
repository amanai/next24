<?php
class DatabaseManager extends ApplicationManager implements IManager{
	
	private $_driver;
	
	private $_DSN;
	
			function initialize(IConfigParameter $configuration){
				$this -> _DSN = $configuration -> get('DSN');
				$this -> _common_config($configuration);
				$this -> _driver = DbSimple_Generic::connect($this -> _DSN);
				if (!is_object($this -> _driver)){
					throw new DbException("No connection to database");
				}
				$this -> _driver -> query("SET NAMES utf8");
				$this -> _driver -> setLogger($configuration -> get('native_logger'));
				//$this -> _driver -> setLogger('myLogger');
				Project::setDatabase($this);
			}
			
			function getDriver(){
				return $this -> _driver;
			}
			
}

// TODO:: move to another functions?
function myLogger($db, $sql){
  $caller = $db->findLibraryCaller();
  $tip = "at ".@$caller['file'].' line '.@$caller['line'];
  // Печатаем запрос (конечно, Debug_HackerConsole лучше)
  //echo "<xmp title=\"$tip\">"; print_r($sql); echo "</xmp>";
  //echo '~~~'.print_r($sql).'~~~';
  if ( ($logger = Project::get("logger")) !== null){
		//$logger -> writeLog($tip."::".$sql);
  }
}
?>
