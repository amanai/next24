<?php
class FM {
	const	ERROR	= 1;
	const	WARNING	= 2;
	const	INFO	= 3;
}
class BaseView{
	private $_dataSource = array();
	private $_content;
	protected $_base_dir = null;
	protected $_dir = '/';
	protected $_file;
	protected $css_url;
	protected $js_url;
	public    $image_url;
	protected $cj_cache_url;
	protected $css_path;
	protected $js_path;
	protected $cj_cache_path;
	protected $_fullpath;
	
	protected $_fm_priority;
	protected $_flesh_messages = array();
	protected $_flesh_messages_block = 'flash_message';
	protected $helper;
	
		function __construct(){
			
			$this -> _fm_priority = array(FM::ERROR => 1, FM::WARNING => 2, FM::INFO => 3);
			
			$request = Project::getRequest();
			$url = $request -> getHost();
			$parent_url = $request -> getParentHost();
			$tm = Project::getTemplateManager();
			$this -> css_url = $url . $tm -> getCssPath();
			$this -> js_url = $url . $tm -> getJsPath();
			$this -> css_path = $_SERVER['DOCUMENT_ROOT'].'/'.$tm -> getCssPath();
			$this -> js_path = $_SERVER['DOCUMENT_ROOT'].'/'.$tm -> getJsPath();
			//$this -> image_url = $url . $tm -> getImagePath();
			
			$this -> image_url =  $parent_url . $tm -> getImagePath();
			$this -> cj_cache_url = $url . $tm -> getCJCachePath();
			$this -> cj_cache_path = $_SERVER['DOCUMENT_ROOT'].'/'.$tm -> getCJCachePath();
			
			$this -> helper = &$request;
		}
		
		function __get($param){
			return (isset($this -> _dataSource[$param]) ? $this -> _dataSource[$param] : null);
		}
		
		function getDataSource(){
			return $this -> _dataSource;
		}
	
		function parse(){
			$messages='';
			foreach ($this -> _fm_priority as $category => $priority){
				if (isset($this -> _flesh_messages[$category]) && count($this -> _flesh_messages[$category])){
					$view = new FlashMessageView();
					$view->setTemplate($this -> _base_dir);
					// TODO:: write only hight priority messages
					$messages.=$view -> show($this -> _flesh_messages[$category], $category);
					//$this -> assign('flash_messages', $view -> show($this -> _flesh_messages[$category], $category));
					//break;
				}
			}
			$this -> assign('flash_messages', $messages);
			
			$template_root = Project::getTemplateManager() -> getTemplateDir();
			if ($this -> _base_dir !== null){
				$template_root .= $this -> _base_dir;
			}
			
			$template_root .= DIRECTORY_SEPARATOR . $this -> _dir . DIRECTORY_SEPARATOR;
			$this -> _fullpath = $template_root . $this -> _file;
			ob_start();
			include($this -> _fullpath);
			$this -> _content = ob_get_contents();
			ob_end_clean();
			return $this -> _content;
		}
		
		function ajax(){
			$response = Project::getAjaxResponse();
			foreach ($this -> _fm_priority as $category => $priority){
				if (isset($this -> _flesh_messages[$category]) && count($this -> _flesh_messages[$category])){
					$view = new FlashMessageView();
					// TODO:: write only hight priority messages
					$response -> addBlock(md5(uniqid()), $this -> _flesh_messages_block, $view -> show($this -> _flesh_messages[$category]));
					break;
				}
			}
			return $this -> _content = $response -> getResponse();
		}
		
		function addFlashMessage($category, $message){
			$category = (int)$category;
			if (!isset($this -> _fm_priority[$category])){
				// TODO:: wrong flash message category
				return false;
			}
			if (!isset($this -> _flesh_messages[$category])) {
				$this -> _flesh_messages[$category] = array();
			}
			$this -> _flesh_messages[$category][] = $message;
		}
		
		function clearFlashMessages(){
			Project::getAjaxResponse() -> clearBlock($this -> _flesh_messages_block);
		}
		
		private function createUrl($controller = null, $action = null, $param = null, $user = null){
			return Project::getRequest() -> createUrl($controller, $action, $param, $user);
		}
		
		function getContent(){
			return $this -> _content;
		}
		
		function setContent($content){
			$this -> _content = $content;
		}
		
		function set($param){
			// TODO:: need to check, if parameters already exists
			$this -> _dataSource = array_merge($this -> _dataSource, $param);
		}
		
		function assign($key, $value){
			$this -> _dataSource[$key] = $value;
		}
		
		function setTemplate($dir = null, $file = null){
			// TODO:: need checking for existing
			if ($dir){
				$this -> _dir = $dir;
			}
			if ($file){
				$this -> _file = $file;
			}
		}
		
		function _include($rel_path){
			$dir = dirname($this -> _fullpath);
			$arr = explode(DIRECTORY_SEPARATOR, $this -> _fullpath);
			array_pop($arr); // Delete file name
			$c = count(explode('../', $rel_path)) - 1;
			for($i = 0; $i < $c; $i++){
				array_pop($arr);// Go to 1 level upper
			}
			$file = implode(DIRECTORY_SEPARATOR, $arr) . DIRECTORY_SEPARATOR . basename($rel_path);
			return $file;
		}
		
		function escape($str){
			return $str;
		}
		
		function filter($filterName){
			// TODO:: can be realize in classes, which need it
		}
		
		function getBothCJ($files, $type='css') {
			$cachename='';
			$en_path=$type=='css'?$this->css_path:$this->js_path;
			if (is_array($files)&&!empty($files)) {
				foreach ($files as $file) {
					$file=$en_path.$file;
					$cachename.=$file.filemtime($file);
				}
				$cachename=md5($cachename).'.'.$type;
				if (file_exists($this->cj_cache_path.$cachename)) return $this->cj_cache_url.$cachename;
				else return $this->createCJCache($files, $en_path, $cachename);
			}
		}
		
		function createCJCache($files, $en_path, $cachename) {
			$both='';
			if ($fp=fopen($this->cj_cache_path.$cachename, 'w')) {
				foreach ($files as $file) {
					fwrite($fp, file_get_contents($en_path.$file)."\r\n");
				}
				fclose($fp);
				return $this->cj_cache_url.$cachename;
			}
		}
}
?>