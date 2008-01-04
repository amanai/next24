<?php
/*
	var $formFields = array(
		'title' => array(
		'name' => 'title',
		'title' => 'Название',
		'desc' => 'Описание',
		'type' => FORM_FIELD_TEXT,
		'required' => true,
            ),
*/
require_once 'CBaseView.php';

class CFormData
{
    var $title			= '';
    var $tpl			= VIEWS_PATH.'form/form.tpl.php';
	var $action			= '';
	var $method			= '';
	var $enctype		= '';
	var $submit_text	= '';
	var $cancel_text	= '';
	var $cancel_url		= '';
	var $fields			= array();
	var $data			= array();
	var $hidden			= array();
	var $error			= array();

	var $view;
	
	public function __construct($formTitle='', $formTpl = VIEWS_PATH.'form/form.tpl.php', $formAction='', $formMethod = 'POST', $formEnctype = '', $formSubmitText = '', $formCancelText = '', $formCancelUrl = '', $formFields = array(), $formData = array(), $formHidden = array(), $formError = array())
	{
		$this->title		= $formTitle;
		$this->tpl			= $formTpl;
		$this->action		= $formAction;
		$this->method		= $formMethod;
		$this->enctype		= $formEnctype;
		$this->submit_text	= $formSubmitText;
		$this->cancel_text	= $formCancelText;
		$this->cancel_url	= $formCancelUrl;
		$this->fields		= $formFields;
		$this->data			= $formData;
		$this->hidden		= $formHidden;
		$this->error		= $formError;

		$this->view	= new CBaseView($this->tpl);
	}

	public function setTitle($formTitle='')
	{
		$this->title = $formTitle;
	}
	
	public function setTpl($formTpl = VIEWS_PATH.'form/form.tpl.php')
	{
		$this->tpl = $formTpl;
	}
	
	public function setAction($formAction='')
	{
		$this->action = $formAction;
	}
	
	public function setMethod($formMethod = 'POST')
	{
		$this->method = $formMethod;
	}
	
	public function setEnctype($formEnctype = '')
	{
		$this->enctype = $formEnctype;
	}
	
	public function setSubmitText($formSubmitText = 'Ok')
	{
		$this->submit_text = $formSubmitText;
	}
	
	public function setCancelText($formCancelText = 'Отмена')
	{
		$this->cancel_text = $formCancelText;
	}
	
	public function setCancelUrl($formCancelUrl = '')
	{
		$this->cancel_url = $formCancelUrl;
	}
	
	public function setFields($formFields = array())
	{
		$this->fields = $formCancelUrl;
	}
	
	public function setData($formData = array())
	{
		$this->data = $formCancelUrl;
	}
	
	public function setHidden($formHidden = array())
	{
		$this->hidden = $formHidden;
	}
	
	public function setError($formError = array())
	{
		$this->error = $formError;
	}
	
	public function setView($formTpl = VIEWS_PATH.'form/form.tpl.php')
	{
		$this->setTpl($formTpl);
		unset($this->view);
		$this->view	= new CBaseView($this->tpl);
	}
	
	public function initForm()
	{
		$this->view->form = array(
			'action'		=> $this->action,
			'method'		=> $this->method,
			'enctype'		=> $this->enctype,
			'SubmitText'	=> $this->submit_text,
			'CancelText'	=> $this->cancel_text,
			'CancelUrl'		=> $this->cancel_url,
			'fields'		=> $this->fields,
			'data'			=> $this->data,
			'hidden'		=> $this->hidden,
			'error'			=> array(),
		);
	}

	public function renderForm()
	{
		$this->view->render($this->tpl);
	}

	public function validate()
	{
		$data = $this->data;
		$valid = true;
		$this->error = array();

		require_once CORE_PATH . 'CValidator.php';
		$Validator = new CValidator($this->data);

		foreach ((array)$this->fields as $key => $field) 
		{
			if ($field['required'] == true) 
			{
				$Validator->addRule(new Required($field['name'], $field['title'] . ' обязательное поле'));
			}
			if ($field['validator_name'] != '') 
			{
				$Validator->addRule(new $field['validator']($field['name'], $field['validator_msg']));
			}
		}
		$valid = $Validator->validate();
		$this->error = $Validator->getError();
		return $valid;
	}

	public function __destruct()
	{
	}
}

?>
