<?php

class CRule
{
	var $valid = true;
	var $field;
	var $errorMsg;

	public function __construct($field, $errorMsg = null)
	{
		$this->field = $field;
		$this->errorMsg = $errorMsg;
	}

	public function initErrorMsg()
	{
		$this->errorMsg;
	}

	public function inti()
	{
	}

	public function validate()
	{
		return false;
	}

	public function getError()
	{
		if (!$this->valid) {
			return array($this->field => $this->errorMsg);
		}
		return array();
	}
}

?>
