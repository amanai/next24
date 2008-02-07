<?php
class CBaseController 
{
	/*
	* $params - ��������� �� �������� ������, � �.�., ��� ��� ����� ����������� ��������
	* $vars - ��� ��� ������. ����� ���������� ��� ����������� ������������� � �����������, �������� ������ ���������� �� ������ ������� � �.�.
	*/
	var $params = array();
	var $vars = array();
	var $view;
	var $model;
	var $param_group;
	
	/*
	����������� �������� ���������, ���������� � �������������
	*/
	function __construct($View=null, $params = array(), $vars = array())
	{
		$this -> setParamGroup();
		$this->params = $params;
		$this->vars = $vars;
		(!is_null($View)) ? ($this->view = $View) : ($this->view = new CBaseView());
	}
	
	function __get($var){
		if (isset($this -> params[$var])){
			return $this -> params[$var];
		} else {
			return null;
		}
	}
			
	function __set($var, $val){
		$this -> params[$var] = $val;
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
	
	
	public function IndexAction(){
		$router = getManager('CRouter');
		$session = getManager('CSession');
		$lastPath = $session->read('LAST_PATH');
		($lastPath)?$router->redirect($lastPath):$router->redirect($$router->createUrl());
		
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
	
	protected function setModel($modelName){
		if(file_exists(MODELS_PATH.$modelName.'.php')){
			require_once(MODELS_PATH.$modelName.'.php');
			$this->model = new $modelName;
		}
	}
	
	public function initCommonData(){
		$router = getManager('CRouter');
		$session = getManager('CSession');
		$userData = unserialize($session->read('user'));
		$lastPath = $session->read('LAST_PATH');

		$this->view->assign('userData', $userData);
		$this->view->assign('lastPath', $lastPath);
		$this->view->assign('router', $router);
	}
	
	/**
	 * ����� �������� ������������ �����������. ������� ��������� ��� ������ ����������� (��������������� � ������������ ������� ������� setParamGroup ��� ����������).
	 * �������� � ������ ������������������ (���������� � ������� �������� � �������)
	 * ���� ��������� ���, ������������ �������� $default, ������ null �� ���������.
	 */
	public function getParam($param_name, $default = null){
		$config = getManager('CParams');
		$param_value = $config -> getParam($this -> param_group, $param_name);
		return ($param_value === null) ? $default : $param_value;
	}
	
	/**
	 * ����� ����� �������� ������������(�� ��������� �� � ����� �������)
	 */
	public function getCommonParam($param_name, $default = null){
		$config = getManager('CParams');
		$param_value = $config -> getParam(null, $param_name);
		return ($param_value === null) ? $default : $param_value;
	}
	
	
	
	public function getParamGroup(){
		return $this -> param_group;
	}
	
	public function setParamGroup($value = null){
		if ($value === null){
			$this -> param_group = trim(get_class($this));
		} else {
			$this -> param_group = $value;
		}
	}
}
?>
