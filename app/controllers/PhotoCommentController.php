<?php
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'BaseCommentController.php');
class PhotoCommentController extends BaseCommentController{

		function __construct($View = null, $params = array(), $vars = array()){
			parent::__construct('PhotoComment', $View, $params, $vars);
		}
		
		
	}
?>