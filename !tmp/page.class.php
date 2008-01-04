<?
/**
 * outPage 
 * 	Handles HTTP response output
 * 	See renderPage dox for more
 * 
 * @package output_handling 
 * @version $id$
 */
class outPage{
	/**
	 * result_code 
	 * 
	 * @var string HTTP responnce code .. default: 200 
	 * @access public
	 */
	public $result_code = '';
	/**
	 * headers 
	 * 
	 * @var array Extra headers to be included in HTTP Responce
	 * @access public
	 */
	public $headers = array();
	/**
	 * raw 
	 * 
	 * @var string This string will be pasted in body of HTTP response if no other special vars specified
	 * @access public
	 */
	public $raw = '';	
	/**
	 * head 
	 * 
	 * @var array Strings to be included in <head> tag thru $_['HEAD'] in template. Usefull for meta/title/css/js unsing template
	 * @access public
	 */
	public $head = array();	
	/**
	 * body 
	 * 
	 * @var string raw content of <body> .. Hadn't used (yet ;)
	 * @access public
	 */
	public $body = '';	
	/**
	 * onload 
	 * 
	 * @var string To be included in onload arg of body thru $_['ONLOAD'] in template. Usefull for starting js 
	 * @access public
	 */
	public $onload = '';		
	/**
	 * data 
	 * 
	 * @var array This array will be translated to $_ in template scope. (HEAD  and ONLOAD will be added before rendering)
	 * @access public
	 */
	public $data = array();	// data for template
	/**
	 * json 
	 * 
	 * @var mixed If this var contains array it will be json_encoded
	 * @access public
	 */
	public $json = null;	// make this array to have it json_encoded
	/**
	 * json_callback 
	 * 
	 * @var string name of json callback to be used with $json
	 * @access public
	 */
	public $json_callback = ''; 	// name of json callback
	/**
	 * gzip_content 
	 * 
	 * @var bool Enables/disables content gzipping if browser allows
	 * @access public
	 */
	public $gzip_content = false;
	/**
	 * template_name 
	 * 
	 * @var string Filename of template to be rendered with $_
	 * @access public
	 */
	public $template_name = '';	// template filename

	function __construct(){
		$this->result_codes_enum = array(
			'200' => '200 OK'
			, '301' => '301 Moved Permanently'
			, '302' => '302 Found'
			, '404' => '404 Not Found'
		);		
	}

	/**
	 * renderPage 
	 *	Allows several modes of output (in order of precedece):
	 *		- json - $json_callback should be set - outputs json encoded call
	 *		- raw - $raw should be set - outputs raw data
	 *		- html - $body should be set - constructs html using $body and $head
	 *		- template - $template_name should be set - outputs rendered template	 	
	 * 
	 * @access public
	 * @return void
	 */
	function renderPage(){
		if ($this->gzip_content){
			ob_start("ob_gzhandler");
		}
		if ($this->result_code and isset($this->result_codes_enum[$this->result_code])){
			header($_SERVER['HTTP_PROTOCOL'].' '.$this->result_codes_enum[$this->result_code]);			
		}
		$this->headers = array_unique($this->headers);
		if (count($this->headers)){
			array_map('header', $this->headers);
		}

		if ($this->json_callback != ''){
			echo $this->json_callback.'('.json_encode($this->data).')';
		}elseif($this->raw != ''){
			echo $this->raw;
		}elseif ($this->body != ''){
			print "<html>\n";
			print "<head>\n";
			print implode("\n",array_unique($this->head));
			print "</head>\n<body onload='".strtr($this->onload, array("'" => "\\'"))."'>\n";
			print $this->body;
			print "\n</body>\n</html>";
		}elseif ($this->template_name != ''){
			$_ = $this->data;
			$_['HEAD'] = implode("\n",array_unique($this->head));
			$_['ONLOAD'] = strtr($this->onload, array("'" => "\\'"));

			require_once($this->template_name);
		}
	}

	/**
	 * go_home  
	 * 	makes redirect to homepage of site
	 * 
	 * @access public
	 * @return void
	 */
	function go_home(){
		$this->headers[] = 'Location: http://'.$_SERVER['HTTP_HOST'].'/';
	}
	/**
	 * go_page 
	 * 	Makes redirect to current page excluding query vars (?a=2&..)
	 *
	 * @param string $suffix String to be added after clean page url
	 * @access public
	 * @return void
	 */
	function go_page($suffix = ''){
		$url = $_SERVER['REQUEST_URI'];
		$off = strpos($url, '?');
		if ($off){
			$url = substr($url, 0, $off);
		}
		$url .= $suffix;
		$this->headers[] = 'Location: http://'.$_SERVER['HTTP_HOST'].$url;
	}
}

/**
 * ioPage 
 * 	handles incoming params
 * @uses outPage
 * @package 
 * @version $id$
 */
class ioPage extends outPage{
	protected $modes = array(); 	// allowed modes  = array(  // first one is default if any
					//	 	'mode_name 1' => array( 	// allowed vars
					//			'var_name' => 'var_type',	// bool/int/float/string
					//			'var_name' => 'var_type'
					//		),
					//		'mode_name 2' => array()
					//	)
	function __construct($modes = array()){
		$this->modes = $modes;

		//var_dump($_REQUEST);
		//var_dump($_SERVER['REQUEST_URI']);

		if (!$this->run_mode()){
			unset($_REQUEST['mode']);
			$this->run_mode();
		}
	}

	function run_mode(){
		// runs  mode. returns true if all is ok

		// default mode
		if (isset($_REQUEST['mode'])){
			//print_r(array_keys($this->modes));
			if (in_array($_REQUEST['mode'], array_keys($this->modes))){
				$mode = $_REQUEST['mode'];
			}else{
				$mode = null;
			}
		}else{
			//print_r($this);
			if (count($this->modes) > 0){
				$keys = array_keys($this->modes);
				$mode = $keys[0];
			}else{
				$mode = null;
			}
		}
		//print $mode;
		if ($mode !== null){
			$vars = $this->check_mode_variables($this->modes[$mode]);
			if ($vars !== null){
				$this->$mode($vars);
				return true;
			}else{
				return false;
			}
		}else{
			print "mode not found <br><pre>\n";
			print_r($_REQUEST);
			return false;
		}
	}

	function check_mode_variables($vars_template){
		// returns array of filtered vars if ok, null elseway
		//var_dump($_REQUEST);
		//var_dump($vars_template);
		$vars = array();
		foreach ($vars_template as $name => $type){
			if ($type == 'bool'){
				$vars[$name] = (bool) isset($_REQUEST[$name]);
			}elseif ($type == 'file'){
				if (isset($_FILES[$name])){
					$vars[$name] = $_FILES[$name];
				}else{
					return null;
				}
			}else{
				if (isset($_REQUEST[$name])){
					if ($type == 'int'){
						$vars[$name] = (int) $_REQUEST[$name];
					}elseif ($type == 'string'){
						$vars[$name] = rawurldecode($_REQUEST[$name]);
					}elseif ($type == 'js_string'){
						$vars[$name] = $this->js_unescape(rawurldecode($_REQUEST[$name]));
					}elseif ($type == 'float'){
						$vars[$name] = (float) $_REQUEST[$name];
					}elseif ($type == 'bool'){
						$vars[$name] = (bool) $_REQUEST[$name];
					}elseif ($type == 'email'){
						if (preg_match(
							'/^[a-z][0-9a-z]+(?:[\.\_\-][0-9a-z]+)*@[a-z0-9]+(?:[\.\_\-][0-9a-z]+)*\.[a-z]{2,4}$/i'
							,$_REQUEST[$name]
						)){
							$vars[$name] = $_REQUEST[$name];
						}else{
							//print "-{$_REQUEST[$name]}-";
						}
					}elseif ($type == 'hash'){
						if (preg_match('/^[0-9a-f]{32}$/',$_REQUEST[$name])){
							$vars[$name] = $_REQUEST[$name];
						}
					}else{
						// all the types should be here
						throw "not handled type";
					}
				}else{
					return null;
				}
			}
		}
		return $vars;
	}
	
	function js_unescape($s){
		$s = preg_replace_callback(
			"/[\x80-\xff]/",
			create_function('$s', 'return "%u00".base_convert(ord($s[0]),10,16);'),
			$s);
		$s = preg_replace_callback(
			"/\%u([0-9a-fA-F]{4})/",
			create_function(
				'$s',
				'return iconv("UCS-2BE", "UTF-8", pack("n", base_convert($s[1], 16, 10)));'
				),
			$s);
		return $s;
	}
}

?>
