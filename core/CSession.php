<?php

class CSession extends CBaseManager {
	
	private $_autoStart=false;

	private $_initialized = false;

	private $_started = false;

	/// Session table
	var $session_table = "session";
	
	/// Session vars table
	var $session_vars_table = "session_vars";
	
	/// Max unauthorized users can be. After that session and session vars will be deleted
	var $MAX_UNAUTH_IDLE = 3600;	// 1h
	
	/// Load vars from database to GLOBALS or not? 1 = true, 0 = false;
	var $load_vars = 1;
	
	/// inner array for variables
	var $variables;
	
	/*!
		Class constructor.
		To constructor you should forward database link
		From cookies get session id and class variable $session set this ID, after that 
		proceed demand_session()
	*/
//	function __construct() 


	public function init(){		
		$this->_initialized=true;	
		
		session_set_save_handler(
			array($this, 'open'), 
			array($this, 'close'), 
			array($this, 'read'), 
			array($this, 'write'), 
			array($this, 'destroy'), 
			array($this, 'gc'));
		session_start();
	}

	public function open(){
		if(!$this -> _started) {			
			$this -> _started = true;
		}

        return true;
	}

	function write($varname, $value)
	{
		if(!$this->valid_session())
		{
			return false;
		}
		  $sql = "SELECT id FROM " . $this->session_vars_table . " WHERE name='" . $varname . "' AND session='" . $this->getSessionID() . "'";
		  $rez = Mysql::query_array($sql);

		  if (!$rez[0]) {
		  	$rez = Mysql::query("INSERT INTO " . $this->session_vars_table . "  
		  			(name,session,value) VALUES
		  			('" . $varname . "', '" . $this->getSessionID() . "', '" . $value . "')");
		  } else {
		  	$mas["value"] = $value;
//		  	$ids["session"] = $this->session;
		  	$ids["name"] = $varname;
		  	$sql = "UPDATE " . $this->session_vars_table . " SET `value` = '" . $value . "' WHERE name='" . $varname . "' AND session='" . $this->getSessionID() . "'";
		  	Mysql::query($sql);
		  }
		  
		  $GLOBALS[$varname] = $value;
		  $this->variables[$varname] = $value;
		  $this->s_touch();
	}

	/*!
		Get variable value from inner array
		\param $varname - variable name 	
	*/
	function read($varname)
	{
		$this->s_touch();
		if(!$this->valid_session())
		{
			return false;
		}

		if (isset($this->variables[$varname])) 
		{
			return $this->variables[$varname];
		}
		else
		{
			return false;
		}
	}	

	/*!
		delete all session vars 
		Kill session
	*/
	function close() {			
		if(!$this -> _started) {			
			$this -> _started = true;
		}
	 	session_write_close();
	 	return true;
	}	
	
	/*!
		Drop variable from user session.
		+ nk, 2001.12.13 ( added this function )
	*/
	
	function clear($varname) 
	{
		$sql = "DELETE from " . $this->session_vars_table . " WHERE name='" . $varname . "' AND session='" . $this->getSessionID() . "'";
		Mysql::query($sql);
		unset($this->variables[$varname]);
		return true;	
	}
	
	/*!
		Logout user from system and delete all session vars and session ID
		Kill session
	*/
	function destroy() {
		Mysql::query("DELETE FROM " . $this->session_table . " WHERE id='" . $this->getSessionID() . "'");
		Mysql::query("DELETE FROM " . $this->session_vars_table . " WHERE session='" . $this->getSessionID() . "'");
		if (isset($_COOKIE[session_name()])) {
  			setcookie(session_name(), '', 1, '/');
		}
		return true;
	}		
	
	function gc() {
		// Kill old sessions where idle MAX_UNAUTH_IDLE seconds
		$result = MySql::query_array("SELECT vars.id 
					FROM " . $this->session_table . " AS sess, " . $this->session_vars_table . " AS vars 
					WHERE sess.id=vars.session AND sess.lastaction < ". (time() - $this->MAX_UNAUTH_IDLE), '');
		// DELETE old sessions VARS
		if (is_array($result)) 
		{
			while (list($key,$val) = each($result)) 
			{
		 	 	MySql::query("DELETE FROM " . $this->session_vars_table ." WHERE id=".$val['id']);
		 	}
		}
		 
		// kill Sessions after MAX_UNAUTH_IDLE for the sake of resources!
		$rez = MySql::query("DELETE FROM " . $this->session_table . " WHERE lastaction < ".(time()-$this->MAX_UNAUTH_IDLE));

		return true;
	}	
	
	public function getSessionID(){
		return session_id();
	}

	function loadvars()
	{
		$session = $this->getSessionID();
		$result = MySql::query_array("SELECT * FROM " . $this->session_vars_table . " WHERE session='" . $this->getSessionID() . "'");
		if($result)
		{
		 	while(list($key,$val) = each($result)) 
			{
				$GLOBALS[$val['name']] = $val['value'];
				$this->variables[$val['name']] = $val['value'];
			}
		}
	}


	function s_touch()
	{
		 MySql::query("UPDATE " . $this->session_table . " SET lastaction=".time()." WHERE id='" . $this->getSessionID() . "'");
	}


	function valid_session()
	{
		 $res = MySql::query_row("SELECT count(id) as count_s FROM " . $this->session_table . " WHERE id='" . $this->getSessionID() . "'");		 
	 
		 if ($res['count_s'] == 0){
			$rez = MySql::query("INSERT INTO " . $this->session_table . " VALUES ('" . $this->getSessionID() . "',".time().",'".$GLOBALS['REMOTE_ADDR']."')");		
	        $this->s_touch();		 	 
		 }
		 $this->loadvars();	 
		 $this->gc();
		 $res = MySql::query_row("SELECT count(id) as count_s FROM " . $this->session_table . " WHERE id='" . $this->getSessionID() . "'");	
	 
		 if ($res['count_s'] != 0)
		 	return true;
		 else
		 	return false;
	}





/*

	function init() 
	{
		if (isset($GLOBALS['session'])) 
		{ 
			$this->session = $GLOBALS['session'];
			
			if ($this->globalID == 1) 
			{
				$GLOBALS['SID'] = $this->session;
			}
		} 
		else 
		{
			$this->session = false; 
		}
		
		mt_srand ((double) microtime() * 1000000);
		if (mt_rand(0, 20) < 3) { $this->killold(); }
		$this->demand_session();
		
		parent::init();
	}
*/
	/*!
		Begin session:
		validating session ID if isset ID loadvars from database to globals (if,
		$this->loadvars == 1 ), else if not set session ID or session ID corrupted
		created new session		
	*/	
/*	function demand_session()
	{
 		if (!$this->valid_session($this->session))
		{
	  		$this->session=$this->begin_session();
  		}
		else 
		{
  			if ($this->load_vars == 1) 
			{
  				 $this->loadvars($this->session);
  			}
		 	$this->s_touch($this->session);
  		}
	}
	
	*/




	/*!
		Generating new session ID, inserting to database and set cookie to user
	*/
/*	function begin_session()
	{
		$sesscode = $this->gencode();
		
		setcookie("session",$sesscode, false, "/");
		 
		if ($this->globalID == 1) 
		{
			$GLOBALS['SID'] = $sesscode;
		}
		 
		 return $sesscode;
	}
*/	

	/*!
		Generating sessionID (look at $this->session_code_lenght)

		2001.07.11 js
			+ $sid initialisation
			+ more unique srand
	*/
/*	function gencode()
	{
	
		$this->killold();
		$sid = 0;
		mt_srand ((double) microtime() * 1000000);
		$Puddle = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		
		for($index=0; $index < $this->session_code_length - 1; $index++)
		{
			$sid .= substr($Puddle, (mt_rand()%(strlen($Puddle))), 1);
		}
		
		// If by some miracle this id exists, return 0. It will not pass
		// when it is checked next.
		if ($this->valid_session($sid)) { $sid = 'INVALID'; }

		return $sid;
	}*/
	
	/*!
		Get data (variables) from database and make it GLOBALS if $this->loadvars is set to 1
	*/



	

	
	/*!
		Is variable registered for this session
	*/
/*	function is_registered($varname)
	{
		$res = Mysql::query("SELECT * FROM " . $this->session_vars_table . " 
					WHERE session='" . $this->session . "' AND name='" . $varname . "'", $this->db);
		if($res)
			return true;
		else
			return false;
	}*/

	/*!
		Return session ID
	*/	
/*	function return_sessionID()
	{
		return $this->session;	
	}*/
	
	/*!
		Login User into the system. 
	*/
/*	function user_login($userID)
	{
		 $this->demand_session();
		 Mysql::query("UPDATE " . $this->session_table . " 
					SET userID = '" . $userID . "' 
					WHERE id='" . $this->session . "'", $this->db);
	}*/



	
	/*!
		Is user logged in into system, and if so method returns user ID
	*/
/*	function user_logged_in()
	{
		$this->killold();

		$result = MySql::query_row("SELECT userID 
					FROM " . $this->session_table . " 
					WHERE id='" . $this->session . "'", $this->db);

		if (!empty($result['userID'])) 
		{
			return $result['userID'];
		} 
		else 
		{
			return false;
		}
	}*/

	/*!
		Returns how many users online
	*/
/*	function users_online($who = "all", $interval=1800)
	{
		switch ($who) 
		{
			case "all":
					$query = "SELECT COUNT(*) AS kiek 
						FROM " . $this->session_table . " 
						WHERE LastAction > ". (time()-$interval);
				break;

			case "registered":
					$query = "SELECT COUNT(*) AS kiek 
						FROM " . $this->session_table . " 
						WHERE userID IS NOT NULL AND LastAction > ". (time()-$interval);
				break;
		}
		
		if (empty($query))
		{
				$query= "SELECT COUNT(*) as kiek FROM " . $this->session_table . " WHERE LastAction > ". (time()-$interval);
		}

		$result = MySql::query_row($query, $this->db);

		if ($result)
		{
			return $result['kiek'];
		}
		else
		{
			return false;
		}
	}*/

} //end of class


?>
