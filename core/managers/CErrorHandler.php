<?php
class CErrorHandler extends ApplicationManager implements IManager{
	private $log = null;
	public function initialize(IConfigParameter $configuration){
		$this -> _config = $configuration;
		Project::setErrorHandler($this);
	}
	
	
	public function handleException($exception) 
	{
		die($exception);
		$exc = "EXCEPTION. Code: ".$exception->getCode()."; Message: ".$exception->getMessage()."; Script: ".$exception->getFile()."; Line: ".$exception->getLine()."; Trace: ".$exception->getTraceAsString()."; Output: ".$exception->__toString().";";
		//вывод в протокол
		if ( ($log = Project::get($this -> _config -> get('logger_id')))){
			$log -> writeLog($exc);
		}
		if ( $this -> _config -> get('send_mail') === true ){
			//отправка админу на мыло
	        $mail = new CMailer("Server", "Server", "Admin", ADMIN_MAIL, "Exception", $exc, true);
		}
	}

	public function handlePhpError($errno, $errstr, $errfile, $errline) 
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
//	    $user_errors = array(E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);
	    $err = "[".$errortype[$errno]."] ".$errno."; Script: ".$errfile."; Line: ".$errline."; Msg: ".$errstr;
//	    if (in_array($errno, $user_errors)) {
//	        $err .= " Var dump: " . print_r($vars) . ";";
//	    }
// TODO:: generate exception, if error has level for exception
		//вывод в протокол
		if ( ($log = Project::get($this -> _config -> get('logger_id')))){
			
			$log -> writeLog($err);
		}
		if ( $this -> _config -> get('send_mail') === true ){
			//отправка админу на мыло TODO:: mail params get from configuration
		    if ($errno == E_USER_ERROR) {
		        $mail = new CMailer("Server", "Server", "Admin", ADMIN_MAIL, "Critical User Error", $err, true);
		    }
		}
	}
    
}

?>
