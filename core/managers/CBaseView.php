<?php/*������� ����� �������������*/class CBaseView extends CBaseManager {	protected $template	= null;	protected $_vars		= array();	protected $content	= '';	protected $userData = array();		function __get($var){		if (isset($this -> userData[$var])){			return $this -> userData[$var];		} else {			return null;		}	}				function __set($var, $val){		$this -> userData[$var] = $val;	}	/*	����������� ������	$template - ��� ���������� �������	*/
	function __construct($template = null)	{		if (empty($template)) 		{			$this->template = DEFAULT_TPL;		} 		else 		{			$this->template = $template;		}	}		
	/*	��������� ���������� �������	$tpl - ��� ���������� �������	*/
	function setTemplate($tpl)	{		$this->template = $tpl;	}
	/*	���������� ������� ���������� ��� ������������� �������	$var - ��� ����������	$value - �������� ����������	*/
	function assign($var, $value)	{		$this->_vars[$var] = $value;		$this->$var = $value;	}
	/*	��������� �������	$file - ��� ����� � �������� ����������	$content_name - ��� ������������� ������� � ������� ��������������� ��������	*/
	function render($file, $content_name = 'main')	{		ob_start();		include $file;//		$this->content[$content_name] .=  ob_get_clean();		$this->content .=  ob_get_clean();				foreach ($this->_vars as $name => $value) 		{			unset($this->_vars[$name]);		}		$this->_vars = array();	}		/**	 * Now not used. Used when pages was in cp1251, but ajax response got as utf8	 */	function translate_to_utf8(&$source){		foreach ($source as $name => $value){			if (is_array($value)){				$source[$name] = $this -> translate_to_utf8($value);			} elseif (is_string($value)) {				//var_dump($value, mb_detect_encoding($value));				$source[$name] = iconv('CP1251', 'UTF-8', $value);				//var_dump($source[$name]);			}		}		return $source;	}		function ajaxRender($file, $content_name = 'main'){		ob_start();		//$this -> translate_to_utf8($this->_vars);		//die;		include $file;//		$this->content[$content_name] .=  ob_get_clean();		$this->content .=  ob_get_clean();				foreach ($this->_vars as $name => $value) 		{			unset($this->_vars[$name]);		}		$this->_vars = array();		return $this->content;	}		function getContent(){		return $this->content;	}	/*	����������� ���������� �������	*/
	function display(){		//$fm = getManager('CFlashMessage');CFlashMessage		//$this -> _flash_messages = $fm		require_once($this->template);	}		function response($object){		echo $object -> getResponse();		die;	}}?>