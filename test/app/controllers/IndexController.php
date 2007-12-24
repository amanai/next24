<?php
	class IndexController{
		
		public function IndexAction($params){
			echo "IndexController/IndexAction<br/><br/>";
			echo "params - ";
			echo '<pre>';
			print_r($params);
			echo '</pre>';
		}
	}
?>