<?php
	class IndexController extends CBaseController{
		
		function __construct($view_class = null){
			if ($view_class === null){
				$view_class = "HomeView";
			}
			parent::__construct($view_class);
		}
		
		public function IndexAction(){			
			
			$this -> _view -> Home();
			$this -> _view -> parse();
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