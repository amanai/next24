<?php
require_once(CORE_PATH.'CMailer.php');

class CErrorHandler 
{
	public function __construct() 
	{
		$log = getManager('CLog');
		@set_exception_handler(array($this, 'exception_handler'));
		@set_error_handler(array($this, 'error_handler'));
		
	}

	public function exception_handler($exception) 
	{
		$exc = "EXCEPTION. Code: ".$exception->getCode()."; Message: ".$exception->getMessage()."; Script: ".$exception->getFile()."; Line: ".$exception->getLine()."; Trace: ".$exception->getTraceAsString()."; Output: ".$exception->__toString().";";
		//����� � ��������
		$log->writeLog($exc);
		//�������� ������ �� ����
        $mail = new CMailer("Server", "Server", "Admin", ADMIN_MAIL, "Exception", $exc, true);
	}

	public function error_handler($errno, $errstr, $errfile, $errline) 
	{
	    $errortype = array (
	                E_ERROR           => "Error",
	                E_WARNING         => "Warning",
	                E_PARSE           => "Parsing Error",
	                E_NOTICE          => "Notice",
	                E_CORE_ERROR      => "Core Error",
	                E_CORE_WARNING    => "Core Warning",
	                E_COMPILE_ERROR   => "Compile Error",
	                E_COMPILE_WARNING => "Compile Warning",
	                E_USER_ERROR      => "User Error",
	                E_USER_WARNING    => "User Warning",
	                E_USER_NOTICE     => "User Notice",
	                E_STRICT          => "Runtime Notice"
	                );
	    // set of errors for which a var trace will be saved
	    $user_errors = array(E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);
	    $err = "ERROR. Number: ".$errno."; Type: ".$errortype[$errno]."; Msg: ".$errmsg."; Script: ".$filename."; Line: ".$linenum.";";
	    if (in_array($errno, $user_errors)) {
	        $err .= " Var dump: " . print_r($vars) . ";";
	    }
		//����� � ��������
		$log->writeLog($err);
		//�������� ������ �� ����
	    if ($errno == E_USER_ERROR) {
	        $mail = new CMailer("Server", "Server", "Admin", ADMIN_MAIL, "Critical User Error", $err, true);
	    }
	}
    
}

?>
