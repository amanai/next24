<?php
	class IndexController extends CBaseController{
		
		public function IndexAction(){
			echo "IndexController/IndexAction<br/><br/>";
			echo "params - ";
			echo '<pre>';
			print_r($this->params);
			echo '</pre>';
			?>
			<form method="post" >
				<input type="text" name="test"/>
				<input type="submit" >
			</form>
			<?php
				
			$this->runSubaction('sub1');
			$this->runSubaction('sub2');
		}
		
		
		public function sub1(){
			echo 'sub1<br/><br/>';
		}
		
		public function sub2(){
			echo 'sub2<br/><br/>';
			echo 'url examples - <br/><br/>';
			
			$router = getManager('CRouter');
			echo $router->createUrl() .'<br/>';
			echo $router->createUrl('contrl') .'<br/>';
			echo $router->createUrl('contrl', 'action') .'<br/>';
			echo $router->createUrl('contrl', 'action', "par1").'<br/>';
			echo $router->createUrl('contrl', 'action', array("par1"=>"aaa")).'<br/>';
		}
	}
?>