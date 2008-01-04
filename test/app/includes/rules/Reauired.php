<?php

require_once CORE_PATH . 'CRule.php';

class Required extends CRule
{
	function vatidate(&$data)
	{
		if (empty($data[$this->field])) {
			$this->valid = false;
		}
		return $this->valid;
	}

	function initErrorMsg()
	{
		if ($this->errorMsg === null) {
			return ucwords(str_replace('_', ' ', $this->field)) . ' is required';
		}
	}
}

?>
