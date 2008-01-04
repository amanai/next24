<?php

class CValidator
{
	var $rules = array();
	var $data = array();
	var $error = array();

	public function __construct(&$data)
	{
		$this->data =& $data;
		$this->initRules();
	}

	public function initRules()
	{
		if ($handle = opendir(RULE_DIR_PATH)) 
		{
		    while ($file = readdir($handle)) 
			{ 
				if (preg_match("/[A-Za-z]+\.php$/", $file)) 
				{
					require_once RULE_DIR_PATH . $file;
				}
		    }
		    closedir($handle); 
		}
	}

	public function addRule(&$rule)
	{
		$this->rules[] =& $rule;
	}

	public function validate()
	{
		$valid = true;

		foreach ($this->rules as $rule) 
		{
			if (!$rule->vatidate($this->data)) 
			{
				$this->error += $rule->getError();
				$valid = false;
			}
		}
		return $valid;
	}

	public function getError()
	{
		return $this->error;
	}
}

?>
