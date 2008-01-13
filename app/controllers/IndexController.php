<?php
	class IndexController extends CBaseController{
		
		function __construct($View=null, $params = array(), $vars = array()){
			parent::__construct($View, $params, $vars);
		}
		
		public function IndexAction(){			
			$this->initCommonData();			
			$this->view->display();
			
/*			echo "IndexController/IndexAction<br/><br/>";
			echo "config:<br>";
			
			$params = getManager('CParams');
			echo "param1 = " . $params->getParam("param1");
			echo "<br/>test_group = ";
			echo '<pre>';
			print_r($params->getParamsGroup("test_group"));
			echo '</pre>';
			
			echo "<br/><br/>GET/POST params - ";
			echo '<pre>';
			print_r($this->params);
			echo '</pre>';
			echo '
			<form method="post" >
				<input type="text" name="test"/>
				<input type="submit" >
			</form>';
			
*/				
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