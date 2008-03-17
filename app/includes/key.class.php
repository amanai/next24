<?
/******************************
*	
*	Key is Array itself with few additions:
*		- it splits string provided to constructor on components
*		- and converts componentes to string representattion on casting to string (__toString)
*
*/
 

	class Key extends ArrayObject{
		function __construct($char_key){
			$arr = array();
			if ($char_key){
				$arr = str_split($char_key, 4);
				foreach($arr as &$i){
					$i = (int) $i;
				}
			}
			parent::__construct($arr);
		}
		function __toString(){
			$res = '';
			foreach (($this) as $i){
				$res .= str_pad($i, 4 ,'0', STR_PAD_LEFT);
			}
			return $res;
		}
		function __get($name){
			if ($name == "level"){ 
				return count($this);
			}else{
				return null;
			}
		}
		function getParent(){
			$k = $this."";
			return new Key(substr($k, 0, strlen($k)-4));
		}
	}



//$a = new Key('001600020009');
//$b = $a->getParent();
//
//print_r( $a);
//print $a;
//print "\n\n";
//
//
//print_r($b);
//print $b;
//print "\n\n";
?>
