<?php
class AppCrypt{
	static private $_salt_length = 10;
	
		static function generateSalt($salt = null){
			if ($salt === null){
				return substr(md5(uniqid(rand(), true)), 0, self::$_salt_length);
			}
			else {
				$salt = substr($salt, 0, self::$_salt_length);
			}
		}
		static function getHash($plainText, $salt = null){
			$salt = ($salt === null) ? self::generateSalt($salt) : $salt;
			return $salt . md5($salt . $plainText);
		}
}
?>
