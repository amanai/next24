<?php
class NewsView extends BaseSiteView{
	protected $_dir = 'news';

	function ContentPage(){
	   $this -> setTemplate(null, 'news.tpl.php');
	}
	
	public function ShowTree($aNews,$bossId = 0, $padding = 0){
        $padding += 10;
        foreach( $aNews as $id=>$news){
          if($bossId!=$news['parent_id'])continue;
          echo '<li style="padding-left:'.$padding.'px;"><a href = "#">'.$news['name'].'</a></li>';
          $this->ShowTree($aNews,$news['id'],$padding);
       }
    }
		
}
?>