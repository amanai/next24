<?php
class CBaseController {
	protected $param_group;
	protected $_controller_model;
	protected $_action_model;
	protected $_view = null;

	public function __construct($view = null) {
		if ($view !== null) {
			$this->_view = new $view;
		}
	}

	public function init(& $controller_model, & $action_model) {
		$this->_controller_model = $controller_model;
		$this->_action_model = $action_model;
		$this -> param_group = get_class($this);
	}

	public function getContent() {
		return $this->_view->getContent();
	}
	
	public function setContent($content) {
		return $this->_view->setContent($content);
	}

	/**
	 * Get default url for this controller: create as current controller name+default action
	 */
	protected function getDefaultUrl() {
		$action_model = new ActionModel;
		$action_model->loadDefault($this->_controller_model->id);
		return Project :: getRequest()->createUrl(null, $action_model->name);
	}

	public function getParam($param_name, $default = null) {
		$model = new ParamModel;
		$param_value = $model->getParam($this->param_group, $param_name);
		return ($param_value === null) ? $default : $param_value;
	}

	public function getCommonParam($param_name, $default = null) {
		$model = new ParamModel;
		$param_value = $model->getParam(null, $param_name);
		return ($param_value === null) ? $default : $param_value;
	}

	public function getParamGroup() {
		return $this->param_group;
	}

	public function setParamGroup($value = null) {
		if ($value === null) {
			$this->param_group = trim(get_class($this));
		} else {
			$this->param_group = $value;
		}
	}
}
?>
