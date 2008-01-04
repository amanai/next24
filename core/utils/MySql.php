<?

class MySql
{
	static public $logFile = null;

	static public $defaultLink = null;

	static public function initDb(){
		self::$defaultLink = self::connect(DB_SERVERNAME, DB_USERNAME, DB_PASS);
		self::select_db(DB_NAME);
	}

	static public function logError($code, $error)
	{
		if (self::$logFile === null)
			return;

		$f = @fopen(self::$logFile, "a");
		if (!$f)
			return;
		$d = date("Y-m-d H:i:s");

		$b = array_slice(debug_backtrace(), 1);
		$trace = "";
		foreach ($b as $k=>$place)
			$trace .= "  {$place["file"]}, line {$place["line"]}: {$place["function"]}\n";

		$url = "";
		if (isset($_SERVER['REQUEST_URI']))
			$url = $_SERVER['REQUEST_URI']."\n";

		$st = "";
		if (isset($_SERVER['REQUEST_TIME']))
			$st = "\nrequest time: ".date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME'])."\n";

		fwrite($f, "{$d}{$st} {$error}\n{$trace}{$url}{$code}\n\n");
		fclose($f);
	}

	/**
	 * Wrapper for mysql_query, to extend it with logging abilities
	 *
	 * @param string $sql
	 * @param resource $link
	 * @param array $handledCodes 2DO! which mysql error codes are handled by caller, and 
	 *                            therefore shouldnt be written to log
	 * @param int $timeThreshold 2DO! all queries taking longer than this value (sec) are written 
	 *                           to error log. 0 for no limit.
	 * @return resource
	 */
	static public function query($sql, $link = null, $handledCodes = array(), &$retCode = null, $timeThreshold = 10)
	{
		if ($link === null)
			$link = self::$defaultLink;

		$res = Mysql::_query($sql, $link);
		$n = Mysql::errno($link);
		if ($n)
			$e = Mysql::error($link);

		// if not handled by application, try handling (just exception, to prevent further processing):
		//  2002 Can't connect to local MySQL server through socket '%s' (%d)
		//  2003 Can't connect to MySQL server on '%s' (%d)
		if (($n == 2002 || $n == 2003) && !in_array($n, $handledCodes))
		{
			Mysql::logError($n, $e);
			throw new Exception("Mysql: unable to connect");
		}

		// if not handled by application, try handling (autoreconnect):
		//  2006 Mysql server has gone away
		//  2013 Lost connection during query
		if (($n == 2006 || $n == 2013) && !in_array($n, $handledCodes))
		{
			if (!Mysql::ping($link))
			{
				$e = Mysql::error($link);
				Mysql::logError($sql, "{$n}: {$e} // ping reconnect failed");
				throw new Exception("Mysql: connection lost, ping reconnect failed");
			}

			$res = Mysql::_query($sql, $link);
			$n = Mysql::errno($link);
			if ($n)
				$e = Mysql::error($link)." // after ping reconnect";
		}

		// if not handled by application, try handling (just retry query):
		//  1205 Lock wait timeout
		if ($n == 1205 && !in_array($n, $handledCodes))
			if (isset($_SERVER['REQUEST_TIME']) && $_SERVER['REQUEST_TIME'] > time() - 1)
			{
				$res = Mysql::_query($sql, $link);
				$n = Mysql::errno($link);
				if ($n)
					$e = Mysql::error($link)." // after retry";
			}

		if ($n && !in_array($n, $handledCodes))
		{
			//$e = Mysql::error($link);
			Mysql::logError($sql, "{$n}: {$e}");
		}
		else if (func_num_args() >= 4)
			$retCode = $n;

		return $res;
	}

	static function query_row($sql, $link = null)
	{
		if ($link === null)
			$link = self::$defaultLink;

		$ret = array();

		$res = Mysql::query($sql, $link);
		if (!empty($res)){
			if ($r = mysql_fetch_assoc($res)){
				$ret = $r;
			}
			mysql_free_result($res);
		}

		return $ret;
	}

	static function query_array($sql, $index_by = '', $link = null)
	{
		if ($link === null)
			$link = self::$defaultLink;

		$ret = array();
		
		$res = Mysql::query($sql, $link);
		
		if (!empty($res)){
			while($r = mysql_fetch_assoc($res)){
				if ($index_by == ''){
					$ret[] = $r;
				}else{
					$ret[$r[$index_by]] = $r;
				}
			}
		mysql_free_result($res);
		}
		
		return $ret;
	}

	static function insert_array($table_name, $arr, $link = null)
	{
		if ($link === null)
			$link = self::$defaultLink;

		$names = implode(', ', array_keys($arr));
		$values = implode(', ', array_values($arr));

		Mysql::query(
				"insert into $table_name($names) values($values)", $link
			    );

		if ($link === null)
			return mysql_insert_id();
		else 
			return mysql_insert_id($nk);
	}

	static function query_grouped_array($sql, $keys, $link = null)
	{
		if ($link === null)
			$link = self::$defaultLink;

		$ret = array();

		$kn = count($keys);

		$res = Mysql::query($sql, $link);
		while($r = mysql_fetch_assoc($res)){
			$cn = & $ret;
			for ($i = 0; $i < $kn; $i++){
				if ($i < $kn - 1){
					if (!isset($cn[$r[$keys[$i]]])){
						$cn[$r[$keys[$i]]] = array();
					}
					$cn = & $cn[$r[$keys[$i]]];
				}else{
					$cn[$r[$keys[$i]]] = $r;
				}
			}
		}
		mysql_free_result($res);

		return $ret;
	}

	static function query_iterator($sql, $link=null)
	{
		if ($link === null)
			$link = self::$defaultLink;

		// returns object implementing Iterator for $sql /// use in foreach only ... NOT seekable
		// or throws Exceptions
		// first column will be extracted also as key
		//  foreach ( $qi as   $k => $v) // will make, for instance
		// 		$k = 12343
		//		$v = array('id'=> '12343', 'data' => 'some data')
		return new QueryIterator($sql, $link);
	}

	static function real_escape_string($s, $link=null)
	{
		if ($link === null)
			$link = self::$defaultLink;

		if ($link !== null)
			return mysql_real_escape_string($s, $link);
		else 
			return mysql_real_escape_string($s);
	}

	static function error($link=null)
	{
		if ($link === null)
			$link = self::$defaultLink;

		if ($link !== null)
			return mysql_error($link);
		else 
			return mysql_error();
	}

	static function errno($link=null)
	{
		if ($link === null)
			$link = self::$defaultLink;

		if ($link !== null)
			return mysql_errno($link);
		else 
			return mysql_errno();
	}

	static function select_db($dbName, $link=null)
	{
		if ($link === null)
			$link = self::$defaultLink;

		if ($link !== null)
			return mysql_select_db($dbName, $link);
		else 
			return mysql_select_db($dbName);
	}

	static function ping($link=null)
	{
		if ($link === null)
			$link = self::$defaultLink;

		if ($link !== null)
			return mysql_ping($link);
		else 
			return mysql_ping();
	}

	static function _query($sql, $link=null)
	{
		if ($link !== null)
			return mysql_query($sql, $link);
		else 
			return mysql_query($sql);
	}

	static function insert_id($link=null)
	{
		if ($link === null)
			$link = self::$defaultLink;

		if ($link !== null)
			return mysql_insert_id($link);
		else 
			return mysql_insert_id();
	}

	static function affected_rows($link=null)
	{
		if ($link === null)
			$link = self::$defaultLink;

		if ($link !== null)
			return mysql_affected_rows($link);
		else 
			return mysql_affected_rows();
	}

	static $linkCache = array();

	static function connect($server, $username, $password)
	{
		$hash = md5(serialize(array($server, $username, $password)));

		if (!isset(self::$linkCache[$hash]))
		{
			$link = mysql_connect($server, $username, $password);
			if (!$link)
			{
				$n = Mysql::errno();
				$e = Mysql::error();
				Mysql::logError("connect", "{$n}: {$e}");
			}
			else 
			{
				Mysql::query("set character_set_client='utf8'", $link);
				Mysql::query("set character_set_connection='utf8'", $link);
				Mysql::query("set character_set_results='utf8'", $link);
			}

			self::$linkCache[$hash] = $link;
		}

		return self::$linkCache[$hash];
	}
}

class QueryIterator implements Iterator {
	function __construct($sql, $link){
		$this->sql = $sql;
		$this->link = $link;	
		$this->res = null;
		$this->cur = false;
		$this->key = null;
	}
	function current(){
		return $this->cur;
	}
	function key(){
		if ($this->key){
			return $this->cur[$this->key];			
		}
		return false;
	}
	function valid(){
		return ($this->cur !== false);
	}
	function next(){
		$this->cur = ($this->res) ? mysql_fetch_assoc($this->res) : false;
		return $this->current();
	}
	function rewind(){
		if ($this->res){
			mysql_free_result($this->res);
			$this->res = null;
		}
		$this->res = Mysql::query($this->sql, $this->link);
		$this->next();

		// getting index for key collumn
		if ($this->cur){
			$k = array_keys($this->cur);
			$this->key = $k[0];
		}else{
			$this->key = false;
		}
	}
	function __destruct(){
		if ($this->res) {
			mysql_free_result($this->res);
		}
	}
}

?>
