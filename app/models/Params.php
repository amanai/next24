<?php
	class Params extends CBaseModel{
		
		public function getParam($group_name, $param_name){
			if ($group_name !== null){
				// TODO:: need caching
				$this->resetSql();
				$this-> join('params_group', 'params_group.id = params.params_group_id AND LOWER(params_group.label)=LOWER("'.$this -> escape($group_name).'")', "INNER");
				$this->where(' LOWER(params.name) = LOWER("'.$this -> escape($param_name).'")');
				$this->cols('params.value as value, params.php_type as php_type');
				$rez = $this->getOne();
			} else {
				$this->resetSql();
				$this->where(' LOWER(name) = LOWER("'.$this -> escape($param_name).'")');
				$this->where(' CAST(params_group_id AS UNSIGNED) = 0');
				$this->cols('*');
				$rez = $this->getOne();
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
	}
?>