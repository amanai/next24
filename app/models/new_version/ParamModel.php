<?php
class ActionModel extends BaseModel{
		function __construct(){
			parent::__construct('param');
		}
		
		function getByGroup($group_name){
			$DE = Project::getDatabase();
			return $DE -> select("SELECT param.name as name, param.value as value, param.php_type as php_type from param 
									INNER JOIN param_group ON param_group.id = param.param_group_id AND LOWER(param_group.label)=LOWER(?)", $group_name);
		}
		
		public function getParam($group_name, $param_name){
			if ($group_name !== null){
				// TODO:: need caching
				$DE = Project::getDatabase();
				$sql = "SELECT param.value as value, param.php_type as php_type " .
						" FROM param " .
						" INNER JOIN param_group ON param_group.id = param.param_group_id AND LOWER(param_group.label)=LOWER(?) " .
						" WHERE LOWER(params.name) = LOWER(?)";
											
				$rez = $DE -> selectRow($sql, $group_name, $param_name);
			} else {
				$sql = "SELECT * " .
					   " FROM  param " .
						" WHERE LOWER(params.name) = LOWER(?) " .
						" AND CAST(params_group_id AS UNSIGNED) = 0";
				$rez = $DE -> selectRow($sql, $param_name);
			}
			
			if (count($rez) === 0){
				return null;
			}
			$default_type = "string";
			$param_type = trim(strtolower($rez['php_type']));
			$value = $rez['value'];
			$ret = $value;
			switch($param_type){
				case "string":
						$ret = $value;
						break;
				case "integer":
						$ret = (int)$value;
						break;
				case "float":
						$ret = (float)$value;
						break;
				case "array":
						$tmp = unserialize($value);
						if (is_array($value)){
							$ret = $tmp;
						} else {
							$ret = array();
						}
						break;
				case "boolean":
						$ret = (bool)$value;
						break;
				default:
						$ret = $value;
						break;
					
			}
			return $ret;
		}
		
		function exists($group_id, $param_name){
			$sql = "SELECT * " .
					   " FROM  param " .
						" WHERE " .
						" params_group_id = ?d" .
						" AND LOWER(params.name) = LOWER(?)";
			$rez = $DE -> selectRow($sql, $group_id, $param_name);
			if (count($rez) === 0){
				return false;
			} else {
				return $rez;
			}
		}
		
		function casting(){
			switch(trim(strtolower($this -> get('php_type')))){
				case "string":
						break;
				case "integer":
						$this -> value = (int)$this -> value;
						break;
				case "float":
						$val = str_replace(',', '.', $this -> value);
						$this -> value = (float)$val;
						break;

				case "boolean":
						$this -> value = (bool)$this -> value;
						break;
				default:
						//$ret = $value;
						break;
					
			}
		}
}
?>