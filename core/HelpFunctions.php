<?php
class HelpFunctions{

		
		static function encode($str){
			return strtr($str, array('<'=>'&lt;','>'=>'&gt;','"'=>'&quot;'));
		}
		
		static function decode($str){
			return strtr($str, array('&lt;'=>'<','&gt;'=>'>','&quot;'=>'"'));
		}
	
		static function isString($str){
			$str = trim($str);
			if (strlen($str) == 0){
				return false;
			} else {
				return true;
			}
		}
		
		static function isStringByKey($array, $key, $lower = true){
			if (!is_array($array)){
				return false;
			}
			$key = ($lower === true) ? trim(strtolower($key)) : trim($key);
			if (!isset($array[$key])){
				return false;
			}
			if (strlen(trim($array[$key])) == 0){
				return false;
			}
			
			return true;
		}
		
		static function changeArrayCase($array, $lower = true, $cKey = true, $cValue = false, $trim = true){
			if (($cKey === true) || ($cValue === true)){
				$buffer = array();
				foreach ($array as $key => &$value){
					if ($cKey === true){
						$oldKey = $key;
						$key = ($lower === true)?strtolower(trim($key)):strtoupper(trim($key));
					} else {
						$oldKey = null;
					}
					if ($cValue === true){
						$value = ($lower === true)?strtolower($value):strtoupper($value);
					}
					if ($trim === true){
						if (is_string($value)){
							$value = trim($value);
						}
					}
					if (($oldKey !== null) && ($oldKey !== $key)){
						unset($oldKey);
					}
					$buffer[$key] = $value;
					unset($array[$key]);
				}
				return $buffer;
			}
			return $array;
		}
		
		static function Lower($param, $cKey = true, $cValue = false, $trim = true){
			if (is_array($param)){
				return self::changeArrayCase($param, true, $cKey, $cValue, $trim);
			} elseif(is_string($param)){
				return ($trim === true)?strtolower(trim($param)):strtolower($param);
			} else {
				return $param;
			}
		}
		
		static function Upper($param, $cKey = true, $cValue = false, $trim = true){
			if (is_array($param)){
				return self::changeArrayCase($param, false, $cKey, $cValue, $trim);
			} elseif(is_string($param)){
				return strtoupper(trim($param));
			} else {
				return $param;
			}
		}
		
		static function strips(&$el) {
			if (is_array($el)){
				foreach($el as $k=>$v){
					$this -> strips($el[$k]);
				}
			} else {
				$el = stripslashes($el);
			}
		}
		
		function backtrace($debugInfo = null){
			if (is_null($debugInfo)) {
				$debugInfo = debug_backtrace();
			} else {
				if (!is_array($debugInfo)) {
					return 'must be array';
				}
			}
			$str = '<table border="1px"><tr><th>File</th><th>Function</th><th>Line</th><th>Params</th></tr>';
			foreach ( $debugInfo as $value ) {
					$str .= '<tr><td>'.$value['file'].'</td><td>'.$value['function'].'</td><td>'.$value['line'].'</td><td>';
					$first = true;
					$args = $value['args'];
					if (is_array($args)) {
						foreach ($args as $arg) {
							if (!$first){
								$str .= '<br>';
							} else {
								$first = false;
							}
							if (is_object($arg)) {
								$str .= get_class($arg);
							} else {
								$str .= $arg;
							}
						}
					}
					$str .=  '</td></tr>';
			}
			$str .= '</table>';
			return $str;
		}
		
		/**
		 * Resize image
		 */
		private function _imageResize($fn, $new_fn, $toWidth){
			$p = pathinfo($fn);
			$ext = isset($p['extension'])?$p['extension']:null;
			list($width, $height) = getimagesize($fn);
			if ($toWidth < $width) {
				$percent = (float)$toWidth/$width;
				$newwidth = $width * $percent;
				$newheight = $height * $percent;
				$thumb = imagecreatetruecolor($newwidth, $newheight);
				$source = self::ImageMake($fn, $ext);
				if ($source == false){
					//error creating image source
					return false;
				}
				imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
				self::imageSave($thumb, $new_fn, $ext);
			}
		}
		
		function imageSave($resource, $name, $ext){
			switch ($ext) {
				case	'jpg'	:
									imagejpeg($resource, $name);
									break;
				case	'png'	:
									imagepng($resource, $name);
									break;
				case	'gif'	:
									imagegif($resource, $name);
									break;
				default			:
									break;
			}
		}
		
		function ImageMake($filename, $ext){
			$ext = strtolower(trim($ext));
			switch ($ext) {
				case	'jpg'	:
					$res = @imagecreatefromjpeg($filename);
					break;
				case	'png'	:
					$res = @imagecreatefrompng($filename);
					break;
				case	'gif'	:
					$res = @imagecreatefromgif($filename);
					break;
				default			:
					$res = false;
					break;
			}
			return $res;
		}
}
?>