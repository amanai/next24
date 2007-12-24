<?
	/*!
		This is SQLsession example.
	*/

	include_once("db.class.php");
	include_once("sqlsession.class.php");
	
	$DB_HOST = 'localhost';
	$DB_USER = 'root';
	$DB_PASSWD = '';
	$DB_DBNAME = 'php';
	
	$g_db = new Db();
	$g_sess = new sqlSession();

	if (isset($action)&&$action=="make") {
		$g_sess -> set_var("username",$user);	
	}
	
	if (isset($action)&&$action=="kill") {
		$g_sess->logout();
		header("Location:example.php");	
	}
	
	if (!isset($username)) {
		echo "<form method=post>";
		echo "Username <input type=text name=user value=''><br><br>";
		echo "<input type=hidden name=action value='make'><br>";
		echo "<input type=submit value=Submit>";
		echo "</form>";
	} else {
		
		echo "Session started<br>";
		echo "Session ID: ".$g_sess->return_sessionID()."<br>";
		
		echo "Your UserName: " . $g_sess->get_var("username");
		
		echo "<br><br>Now session will be alive $g_sess->MAX_UNAUTH_IDLE sec.";
		
		/*!
				or if you set in sqlsession class
		
				Load vars from database to GLOBALS or not? 1 = true, 0 = false;
				var $load_vars = 1;
				
				you may just type:
				
				echo "Vartotojo vardas:" . $username;
						
		*/
		
		echo "<br><br><a href='example.php'>Refresh</a>";
		echo "<br><br><a href='example.php?action=kill'>Kill session</a>";
	}

	
?>
