<?php
/**
 * Exception classes file
 */

/**
 * appException class
 *
 * This class is base for all generated exceptions at application
 *
 * appException provides the functionality of showing error to web browser.
 * appException looks for file message.txt, where try to get exception message by internal message code.
 * If no found message at file, then show this code directly into browser.
  */
class AppException extends Exception{
	private $_errorCode = '';


	

	/**
	 * Constructor.
	 */
	public function __construct($errorMessage)
	{
		$this -> _errorCode = $errorMessage;
		parent::__construct($errorMessage);
		$this -> showErrorScreen();
	}
	
	public function showErrorScreen(){
		echo "~~<font color='#ff0000'><b>".$this -> _errorCode."<b></font>~~";
		echo BACKTRACE();
		die();
		// TODO:: here can be sending information about exception to admin of site and logging
		
	}

	/**
	 * @return string error code
	 */
	public function getErrorCode()
	{
		return $this -> _errorCode;
	}

	/**
	 * @param string error code
	 */
	public function setErrorCode($code)
	{
		$this -> _errorCode=$code;
	}

	/**
	 * @return string error message
	 */
	public function getErrorMessage()
	{
		return $this -> getMessage();
	}

	/**
	 * @param string error message
	 */
	protected function setErrorMessage($message)
	{
		$this -> message=$message;
	}
}

/**
 * coreException is the base class for all core-level exceptions
 */
class CoreException extends AppException{
}

/**
 * ConfigurationException represents an exception caused by invalid configurations,
 * such as error in an configuration files.
 */
class ConfigurationException extends CoreException{
}

/**
 * IOExcept
 * ion represents an exception related with improper IO operations.
 */
class IOException extends CoreException{
}

/**
 * InvalidActionException
 * represents an exception related with invalid operations.
 */
class InvalidActionException extends CoreException{
}

/**
 * InvalidActionException
 * represents an exception related with invalid operations.
 */
class InvalidValueException extends CoreException{
}

/**
 * SoftwareSupportException exception
 * exception related with support software on server.
 */
class SoftwareSupportException extends CoreException{
}

/**
 * Cache exception
 * exception related with cache problems on server.
 */
class CacheException extends CoreException{
}

/**
 * Database exception
 * exception related with cache problems on server.
 */
class DbException extends CoreException{
}

/**
 * Security exception
 * problems with security settings.
 */
class securityException extends CoreException{
	
}


/**
 * Template exceptions
 * problems with template settings.
 */
class TemplateException extends CoreException{
	
}

/**
 * Utilities exceptions
 * problems with utilities.
 */
class UtilityException extends CoreException{
	
}
?>