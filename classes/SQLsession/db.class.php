<?
/*
 *	Database abstraction, static object db interface
 *	(C) "Alternatyvus Valdymas", 2001
 *	http://www.avc.lt, info@avc.lt
 */

// dzhibas, 2001.07.09 - class correction
// js, 2001.07.09

//!! core lib
//! database abstraction, static object db interface

/*!
	this is the older version of database abstraction layer.
*/

class Db
{

    /// the server to connect to
    var $server;
    /// the database to use
    var $dbname;
    /// the username to use
    var $user;
    /// the password to use
    var $password;
    
	var $on_error = 'report';


	var $connection;
	var $queryresult;

   /*!
      Constructs a new Db object, connects to the db server and
      selects the desired database.

	  login data is taken from gb_ini
    */
	function Db($oe = 'report')
	{
		global $DB_HOST, $DB_USER, $DB_PASSWD, $DB_DBNAME;
      
		$this->on_error = $oe;

        $this->server = $DB_HOST;
        $this->dbname = $DB_DBNAME;
        $this->user = $DB_USER;
        $this->password = $DB_PASSWD;
		
		$this->connect();

	}

	function connect($server='', $user='', $password='', $dbname='')
	{
		if ($server)
		{
			$this->server = $server;
			$this->dbname = $user;
			$this->user = $password;
			$this->password = $dbname;
		}

        $this->connection = @mysql_pconnect( $this->server, $this->user, $this->password )
            or $this->error( "could not connect to the database server ($this->server, $this->user)." );
        
        @mysql_select_db( $this->dbname )
            or $this->error( "could not select the database ($this->DB)." );
	}

	/*!
		executes query, returns query result handle
	*/
	function &query($q, $print = false)
	{
		if ($print) { echo "<br><b>query: </b>" . htmlentities($q) . "<br>";}

		($this->queryresult =& mysql_query($q, $this->connection)) or 
				$this->error("<b>bad SQL query</b>: " . htmlentities($q) . "<br><b>". mysql_error() ."</b>");

		return $this->queryresult;
	}

	
	// js, 2001.07.10, array -> assoc
	function get_array()
	{
		return mysql_fetch_assoc($this->queryresult);
	}

	function free_result()
	{
		return mysql_free_result($this->queryresult);
	}

	/*!
		returns two dimensional assoc array
		frees mysql result
	*/
	function &get_result( $sql = '' )
	{
		if ($sql) { $this->query($sql); }
		$c = 0;
		while ($row = mysql_fetch_assoc($this->queryresult))
		{
			$res[$c] = $row;
			$c++;
		}
		mysql_free_result($this->queryresult);
		return $res;
	}

	function &get_result_array( $sql = '' )
	{
		if ($sql) { $this->query($sql); }
		$c = 0;
		while ($row = mysql_fetch_array($this->queryresult))
		{
			$res[$c] = $row;
			$c++;
		}
		mysql_free_result($this->queryresult);
		return $res;
	}

	/*!
		is query result set empty ?
	*/
	function is_empty($sql = '')
	{
		if ($sql) { $this->query($sql); }
		if (0 == mysql_num_rows($this->queryresult)) 
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	/*!
		is query result set valid ?
	*/
	function not_empty($sql = '')
	{
		if ($sql) { $this->query($sql); }
		if (0 == mysql_num_rows($this->queryresult)) 
		{
			return false;
		}
		else 
		{
			return true;
		}
	}

	
	function close()
	{
		mysql_close();
	}


	function get_insert_id()
	{
		return mysql_insert_id();
	}


	/*!
		\param $mas assiociative array, keys - column names
	*/
	function insert_query($mas, $table)
	{
		while(list($k,$v)=each($mas))
		{
			$to[] = $k;
			$val[] = $v;
		}

		$sql = "INSERT INTO $table (".implode(',',$to).") VALUES ('".implode("','",$val)."')";
		$result =& $this->query( $sql );
		
		if ($result) { return true; } else { return false; }
	}


	/*!
		Updated by Nikolajus Krauklis 2001.12.14 - fix bug with IDS ($where)
		\param $mas assiociative array, keys - column names
	*/
	function update_query($mas, $table, $id)
	{
		if (is_array($id)) 
		{
			while(list($idn,$idv)=each($id)) 
			{
				$where[] = $idn."='$idv'";	
			}
		} 
		else 
		{
			$where[] = "id=$id";	
		}
		
		while(list($k,$v)=each($mas))
		{	
			$to[] = $k."='$v'";
		}

		$sql = "UPDATE $table SET ".implode(',',$to)." WHERE ".implode(" AND ",$where);
		
		$result =& $this->query( $sql );

		return $result;
	}

	/*!
		\param $mas assiociative array, keys - column names
	*/
	function replace_query($mas, $table, $print = false)
	{
		while(list($k,$v)=each($mas))
		{	
			$to[] = $k;
			$val[] = $v;
		}

		$sql = "REPLACE INTO $table  (".implode(',',$to).") VALUES ('".implode("','",$val)."')";
		
		$result =& $this->query( $sql, $print );

		return $result;
	}


    	/*!
    	  Prints the error message.
    	*/
    	function error($errmsg) 
    	{ 
    	    echo  "<br><font color='#CC0066'><b>db</b>: ". $errmsg ."</font><br>";
			if ('halt' == $this->on_error) { exit; }
    	}


}


?>