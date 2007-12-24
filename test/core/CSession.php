<?php

class CSession
{
	function start()
	{
	}

	function close()
	{
//		session_write_close();
	}

	function set($key, $data)
	{
		CSession::start();
		$_SESSION[$key] = $data;
		CSession::close();
	}

	function get($key)
	{
		CSession::start();
		$data = $_SESSION[$key];
		CSession::close();
		return $data;
	}

	function clear($key)
	{
		CSession::start();
		unset($_SESSION[$key]);
		CSession::close();
	}
}

?>
