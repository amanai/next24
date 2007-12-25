<?php
class CBaseController{
	var $params = array();	var $vars = array();	/*	конструктор получает параметры, переменные и представление	*/
	function __construct(&$View, $params = array(), $vars = array())	{		$this->params = $params;		$this->vars = $vars;		$this->view =& $View;	}
	function _getParam($name)	{		return $this->params[$name];	}
	function getVars($num)	{		return $this->vars[$num];	}	function getQueryString()	{		return CSession::set(get_class($this));	}
	function saveQueryString()	{		CSession::set(get_class($this), $this->getParamsStr());	}
	function getParamsStr()	{		$str = array();		foreach ((array)$this->params as $name => $value) 		{			$str[] = $name;			$str[] = $value;		}		return implode("/", $str);	}}?>
