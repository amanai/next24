<?php
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'AppJson.php');
class AjaxRequest{
	
	
	
		static function getJsonParam($controller, $action, $params, $method = "GET", $async = true, $encode = true){
			$param = self::getParam($controller, $action, $params, $method, $async, 'json');
			if ($encode){
				return AppJson::encode($param);
			} else {
				return $param;
			}
			
		}

		static function getParam($controller, $action, $params, $method, $async = false, $dataType = 'json'){
			$router = Project::getRequest();
			if (!is_array($params)){
				$params = array();
			}
			if (!in_array($method, array("POST", "GET"))){
				$method = "POST";
				$url = $router -> createUrl($controller, $action);
			} else {
				$url = $router -> createUrl($controller, $action, $params);
				//$url = str_replace(":", "___", $url);
			}
			$param = array(
							'url'=> $url,
							'type'=> $method,
							'async'=> $async,
							'data'=> (($method == "POST")?$params:''),
							'dataType'=> $dataType
							);
			return $param;
		}
}
?>
