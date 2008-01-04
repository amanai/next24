<?php/*базовый класс представления*/class CBaseView{	var $template	= null;	var $_vars		= array();	var $content	= array();	/*	конструктор класса	$template - имя каркасного шаблона	*/
	function __construct($template = null)	{		if (empty($template)) 		{			$this->mainTpl = DEFAULT_TPL;		} 		else 		{			$this->template = $template;		}	}
	/*	установка каркасного шаблона	$tpl - имя каркасного шаблона	*/
	function setTemplate($tpl)	{		$this->template = $tpl;	}
	/*	заполнение массива переменных для генерируемого шаблона	$var - имя переменной	$value - значение переменной	*/
	function assign($var, $value)	{		$this->_vars[$var] = $value;		$this->$var = $value;	}
	/*	генерация шаблона	$file - имя файла с шаблоном переменной	$content_name - имя генерируемого шаблона в массиве сгенерированных шаблонов	*/
	function render($file, $content_name = 'main')	{		ob_start();		include VIEW_PATH . $file;		$this->content[$content_name] .=  ob_get_clean();		foreach ($this->_vars as $name => $value) 		{			unset($this->_vars[$name]);		}		$this->_vars = array();	}	/*	отображение каркасного шаблона	*/
	function display()	{		include($this->template);	}}?>