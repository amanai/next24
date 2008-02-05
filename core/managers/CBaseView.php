<?php/*������� ����� �������������*/class CBaseView extends CBaseManager {	var $template	= null;	var $_vars		= array();	var $content	= '';		/*	����������� ������	$template - ��� ���������� �������	*/
	function __construct($template = null)	{		if (empty($template)) 		{			$this->template = DEFAULT_TPL;		} 		else 		{			$this->template = $template;		}	}		
	/*	��������� ���������� �������	$tpl - ��� ���������� �������	*/
	function setTemplate($tpl)	{		$this->template = $tpl;	}
	/*	���������� ������� ���������� ��� ������������� �������	$var - ��� ����������	$value - �������� ����������	*/
	function assign($var, $value)	{		$this->_vars[$var] = $value;		$this->$var = $value;	}
	/*	��������� �������	$file - ��� ����� � �������� ����������	$content_name - ��� ������������� ������� � ������� ��������������� ��������	*/
	function render($file, $content_name = 'main')	{		ob_start();		include $file;//		$this->content[$content_name] .=  ob_get_clean();		$this->content .=  ob_get_clean();				foreach ($this->_vars as $name => $value) 		{			unset($this->_vars[$name]);		}		$this->_vars = array();	}	/*	����������� ���������� �������	*/
	function display(){		require_once($this->template);	}}?>