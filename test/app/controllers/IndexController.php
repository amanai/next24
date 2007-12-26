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
		}
	}
?>