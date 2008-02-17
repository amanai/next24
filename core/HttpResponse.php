<?php
/**
 * HttpResponse class
 */
class HttpResponse extends ApplicationManager implements IManager{
	/**
	 * @var boolean whether to buffer output
	 */
	private $_bufferOutput = true;
	/**
	 * @var THttpCookieCollection list of cookies to return
	 */
	private $_cookies = null;
	/**
	 * @var integer response status code
	 */
	private $_status = 200;
	/**
	 * @var string content type
	 */
	private $_contentType = null;
	/**
	 * @var string character set, e.g. UTF-8
	 */
	private $_charset = '';
	
		public function initialize(IConfigParameter $configuration){
			Project::setResponse($this);
			$this -> _common_config($configuration);
			if (($defaultCharset = $configuration -> get('DefaultCharset', null)) !== null){
				$this -> _charset = $defaultCharset;
				unset($defaultCharset);
			}
			if (($contentType = $configuration -> get('ContentType', null)) !== null){
				$this -> _contentType = $contentType;
				unset($contentType);
			}
			
			if (($cacheExpire = $configuration -> get('CacheExpire', null)) !== null){
				$this -> setCacheExpire($cacheExpire);
				unset($cacheExpire);
			}
			
			if (($cacheControl = $configuration -> get('CacheControl', null)) !== null){
				$this -> setCacheControl($cacheControl);
				unset($cacheControl);
			}
			ob_start();
			
		}

		/**
		 * Destructor.
		 * Flushes any existing content in buffer.
		 */
		public function __destruct()
		{
			if($this->_bufferOutput)
				@ob_end_flush();
		}
	
	
		/**
		 * @return integer time-to-live for cached session pages in minutes, this has no effect for nocache limiter. Defaults to 180.
		 */
		public function getCacheExpire()
		{
			return session_cache_expire();
		}
	
		/**
		 * @param integer time-to-live for cached session pages in minutes, this has no effect for nocache limiter.
		 */
		public function setCacheExpire($value)
		{
			session_cache_expire((int)$value);
		}
	
		/**
		 * @return string cache control method to use for session pages
		 */
		public function getCacheControl()
		{
			return session_cache_limiter();
		}
	
		/**
		 * @param string cache control method to use for session pages. Valid values
		 *               include none/nocache/private/private_no_expire/public
		 */
		public function setCacheControl($value)
		{
			$value = strtolower(trim($value));
			$modes = array('none','nocache','private','private_no_expire','public');
			if (in_array($value, $modes)){
				session_cache_limiter($value);
			}
		}
	
		/**
		 * @return string content type, default is text/html
		 */
		public function setContentType($type)
		{
			//$this -> _debugger -> add(AppDebugger::RESPONSE, "Set content type:".$type);
			$this->_contentType = $type;
		}
	
		/**
		 * @return string current content type
		 */
		public function getContentType()
		{
			return $this->_contentType;
		}
	
		/**
		 * @return string output charset.
		 */
		public function getCharset()
		{
			return $this->_charset;
		}
	
		/**
		 * @param string output charset.
		 */
		public function setCharset($charset)
		{
			//$this -> _debugger -> add(AppDebugger::RESPONSE, "Set charset:".$charset);
			$this->_charset = $charset;
		}
	
		/**
		 * @return boolean whether to enable output buffer
		 */
		public function getBufferOutput()
		{
			return $this->_bufferOutput;
		}
	
		/**
		 * @param boolean whether to enable output buffer
		 * @throws TInvalidOperationException if session is started already
		 */
		public function setBufferOutput($value)
		{
			if($this -> _initialized)
				throw new operationException('httpresponse_bufferoutput_unchangeable');
			else
				$this -> _bufferOutput=(bool)$value;
		}
	
		/**
		 * @return integer HTTP status code, defaults to 200
		 */
		public function getStatusCode()
		{
			return $this -> _status;
		}
	
		/**
		 * @param integer HTTP status code
		 */
		public function setStatusCode($status)
		{
			$this -> _status = (int)$status;
		}
	
		/**
		 * Outputs a string.
		 * It may not be sent back to user immediately if output buffer is enabled.
		 * @param string string to be output
		 */
		public function write($str)
		{
			echo $str;
		}
	
		/**
		 * Sends a file back to user.
		 * Make sure not to output anything else after calling this method.
		 * @param string file name
		 * @param string content to be set. If null, the content will be read from the server file pointed to by $fileName.
		 * @param string mime type of the content.
		 * @param array list of headers to be sent
		 * @throws TInvalidDataValueException if the file cannot be found
		 */
		public function writeFile($fileName,$content=null,$mimeType=null,$headers=null)
		{
			$this -> _debugger -> add(AppDebugger::RESPONSE, "Write file started");
			static $defaultMimeTypes=array(
				'css'=>'text/css',
				'gif'=>'image/gif',
				'jpg'=>'image/jpeg',
				'jpeg'=>'image/jpeg',
				'htm'=>'text/html',
				'html'=>'text/html',
				'js'=>'javascript/js'
			);
	
			if($mimeType===null)
			{
				$mimeType='text/plain';
				if(function_exists('mime_content_type'))
					$mimeType=mime_content_type($fileName);
				else if(($ext=strrchr($fileName,'.'))!==false)
				{
					$ext=substr($ext,1);
					if(isset($defaultMimeTypes[$ext]))
						$mimeType=$defaultMimeTypes[$ext];
				}
			}
			$fn=basename($fileName);
			if(is_array($headers))
			{
				foreach($headers as $h)
					header($h);
			}
			else
			{
				header('Pragma: public');
				header('Expires: 0');
				header('Cache-Component: must-revalidate, post-check=0, pre-check=0');
			}
			header("Content-type: $mimeType");
			header('Content-Length: '.($content===null?filesize($fileName):strlen($content)));
			header("Content-Disposition: attachment; filename=\"$fn\"");
			header('Content-Transfer-Encoding: binary');
			if($content===null)
				readfile($fileName);
			else
				echo $content;
		}
	
		/**
		 * Redirects the browser to the specified URL.
		 * The current application will be terminated after this method is invoked.
		 * @param string URL to be redirected to. If the URL is a relative one, the base URL of
		 * the current request will be inserted at the beginning.
		 */
		public function redirect($url){
			//if (Project::getApplication() -> getRequestCompleted()){
				header('Location: '.str_replace('&amp;','&',$url));
				exit();
			//}
			/*if(!$this->getApplication()->getRequestCompleted())
				$this->getApplication()->onEndRequest();
			if($url[0]==='/')
				$url=$this->getRequest()->getBaseUrl().$url;
			header('Location: '.str_replace('&amp;','&',$url));
			exit();*/
		}
	
		/**
		 * Reloads the current page.
		 * The effect of this method call is the same as user pressing the
		 * refresh button on his browser (without post data).
		 **/
		public function reload(){
			$this->redirect(Project::getRequest()->getRequestUri());
		}
	
		/**
		 * Outputs the buffered content, sends content-type and charset header.
		 */
		public function flush(){
			$this->sendContentTypeHeader();
			if($this->_bufferOutput)
				ob_flush();
		}
	
		/**
		 * Sends content type header if charset is not empty.
		 */
		public function sendContentTypeHeader(){
			$charset=$this->getCharset();
		
			if($charset!=='')
			{
				$contentType=$this->_contentType===null?'text/html':$this->_contentType;
				$this->appendHeader('Content-Type: '.$contentType.';charset='.$charset);
			}
			else if($this->_contentType!==null)
				$this->appendHeader('Content-Type: '.$this->_contentType.';charset=UTF-8');
		}
	
		/**
		 * Returns the content in the output buffer.
		 * The buffer will NOT be cleared after calling this method.
		 * Use {@link clear()} is you want to clear the buffer.
		 * @return string output that is in the buffer.
		 */
		public function getContents(){
			return $this->_bufferOutput?ob_get_contents():'';
		}
	
		/**
		 * Clears any existing buffered content.
		 */
		public function clear()	{
			if($this->_bufferOutput)
				ob_clean();
		}
	
		/**
		 * Sends a header.
		 * @param string header
		 */
		public function appendHeader($value){
			header($value);
		}
	
		/**
		 * Writes a log message into error log.
		 * This method is simple wrapper of PHP function error_log.
		 * @param string The error message that should be logged
		 * @param integer where the error should go
		 * @param string The destination. Its meaning depends on the message parameter as described above
		 * @param string The extra headers. It's used when the message parameter is set to 1. This message type uses the same internal function as mail() does.
		 * @see http://us2.php.net/manual/en/function.error-log.php
		 */
		public function appendLog($message,$messageType=0,$destination='',$extraHeaders='')	{
			error_log($message,$messageType,$destination,$extraHeaders);
		}
}
?>