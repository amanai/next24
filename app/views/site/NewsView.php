<?php
class NewsView extends BaseSiteView{
	protected $_dir = 'news';
	public $_htmlTree = '';

	function ContentPage(){
	    $this->_js_files = array();
	    $this->_js_files[] = 'jquery.js';
	    //$this->_js_files[] = 'news_tree.js';
	    $this->_css_files[] = 'news_tree.css';
	   $this -> setTemplate(null, 'news.tpl.php');
	}
	
	public function BuildTree($aNews,$bossId = 0){
        $imgUrl = $this -> image_url;
        foreach( $aNews as $id=>$news){
          if($bossId!=$news['parent_id'])continue;
          $this->_htmlTree .= '
          <li >
            <img class="minus" height="11" width="11" alt="" src="'.$imgUrl.'chb_minus.png"/> <label><input type="checkbox"/> '.$news['name'].'</label>
            <ul class="checkbox_tree">';
          
          $this->BuildTree($aNews,$news['id']);
          
          $this->_htmlTree .= '
            </ul>
          </li>';
          
       }
    }
		
}
?>