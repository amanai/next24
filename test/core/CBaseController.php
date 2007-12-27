<?php
class CBaseController
{
	/*
	* $params - ��������� �� �������� ������, � �.�., ��� ��� ����� ����������� ��������
	* $vars - ��� ��� ������. ����� ���������� ��� ����������� ������������� � �����������, �������� ������ ���������� �� ������ ������� � �.�.
	*/
	var $params = array();
	var $vars = array();
	
	/*
	����������� �������� ���������, ���������� � �������������
	*/
	function __construct($View=null, $params = array(), $vars = array())
	{
		$this->params = $params;
		$this->vars = $vars;
		$this->view = $View;
	}
	function _getParam($name)
	{
		return $this->params[$name];
	}
	function getVars($num)
	{
		return $this->vars[$num];
	}

	function getQueryString()
	{
		$session = getManager('CSession');
		return $session->get_var(get_class($this));
	}
	function saveQueryString()
	{
		$session = getManager('CSession');
		$session->set_var(get_class($this), $this->getParamsStr());
	}
	function getParamsStr()
	{
		$str = array();
		foreach ((array)$this->params as $name => $value) 
		{
			$str[] = $name;
			$str[] = $value;
		}
		return implode("/", $str);
	}
	
	protected function runSubaction($function, $params=array()){
		$className = get_class($this);
		$meth = get_class_methods($className);
		if(!in_array($function, $meth)) {return false;}
		
		$actionName = debug_backtrace();
		$actionName = $actionName[1]['function'];

		$rightsManager = getManager('CRightsManager');
		if(!$rightsManager->checkAccess($className, $actionName, $function)){return false;}
		$this->$function();	
		
	}
}
?>
