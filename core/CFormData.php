<?php
/*
	var $formFields = array(
		'title' => array(
		'name' => 'title',
		'title' => 'Название',
		'desc' => 'Описание',
		'type' => FORM_FIELD_TEXT,
		'validator_name' => 'Required',
		'validator_msg' => 'обязательное поле',
		
            ),
*/

class CFormData
{
    var $title			= '';
    var $tpl			= 'form/form.tpl.php';
	var $action			= '';
	var $method			= '';
	var $enctype		= '';
	var $script			= '';
	var $submit_text	= '';
	var $cancel_text	= '';
	var $cancel_url		= '';
	var $fields			= array();
	var $data			= array();
	var $hidden			= array();
	var $error			= array();

	var $view;
	
	public function __construct($formTitle='', $formTpl = 'form/form.tpl.php', $formAction='', $formMethod = 'POST', $formEnctype = '', $formSubmitText = '', $formCancelText = '', $formCancelUrl = '', $formFields = array(), $formData = array(), $formHidden = array(), $formError = array(), $formScript = '')
	{
		$this->title		= $formTitle;
		$this->tpl			= VIEWS_PATH.$formTpl;
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
		$this->script		= $formScript;

		$this->view	= new CBaseView($this->tpl);
	}

	public function setTitle($formTitle='')
	{
		$this->title = $formTitle;
	}
	
	public function setTpl($formTpl = 'form/form.tpl.php')
	{
		$this->tpl = VIEWS_PATH.$formTpl;
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
		$this->fields = $formFields;
	}
	
	public function setData($formData = array())
	{
		$this->data = $formData;
	}
	
	public function setHidden($formHidden = array())
	{
		$this->hidden = $formHidden;
	}
	
	public function setError($formError = array())
	{
		$this->error = $formError;
	}

	public function setScript($formScript = array())
	{
		$this->script = $formError;
	}
	
	public function setView($formTpl = 'form/form.tpl.php')
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
			'error'			=> $this->error,
			'script'		=> $this->script,
		);

	}

	public function renderForm()
	{
		$this->view->render($this->tpl);
		return $this->view->content;
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
/*			if (isset($field['required']) && ($field['required'] == true)) 
			{
				$Validator->addRule(new Required($field['name'], $field['title'] . ' обязательное поле'));
			}*/
			if (isset($field['validator_name']) && ($field['validator_name'] != '')) 
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
