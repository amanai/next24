<?php
class NewsView extends BaseSiteView{
	protected $_dir = 'news';
	public $_htmlTree = '';
	protected $newsUrl = '/news';

	
	
	
	function NewsPage(){
	    $this->_js_files[] = 'jquery.js';
	    $this->_js_files[] = 'news_tree.js';
	    $this->_css_files[] = 'news_tree.css';
	   $this -> setTemplate(null, 'news.tpl.php');
	}
	
	function getFeedsByNewsTreeId($news_tree_id){
	    $newsModel = new NewsModel();
	    return $newsModel->getFeedsByNewsTreeId($news_tree_id);
	}
	
	/* build News Tree , and save it in $_htmlTree */
	public function BuildTree($aNews,$bossId = 0){
        $imgUrl = $this -> image_url;
        foreach( $aNews as $id=>$news){
          if($bossId!=$news['parent_id'])continue;
          $newsUrl = $this->newsUrl;
          $this->_htmlTree .= '
          <li >
            <img class="minus" height="11" width="11" alt="" /> 
            <label><input type="checkbox"/> <a href="'.$newsUrl.'/news_tree_id:'.$news['id'].'">'.$news['name'].'</a></label>
            <ul class="checkbox_tree">';
          
          // get feeds for leaves on tree
          $aFeeds = $this -> getFeedsByNewsTreeId($news['id']);
          foreach ($aFeeds as $feed){
              $this->_htmlTree .= '<li><label><input type="checkbox"/> '.$feed['name'].'</label></li>';
          }
          
          $this->BuildTree($aNews,$news['id']);
          $this->_htmlTree .= '
            </ul>
          </li>';
          
       }
    }
    
    public function ShowNewsTreeBreadCrumb($aNewsTreeBreadCrumb){
        $sNewsTreeBreadCrumb = '';
        $newsUrl = $this->newsUrl;
        if (count($aNewsTreeBreadCrumb)>0){
            foreach ($aNewsTreeBreadCrumb as $newsTree){
                $sNewsTreeBreadCrumb .= '<a href="'.$newsUrl.'/news_tree_id:'.$newsTree['id'].'">'.$newsTree['name'].'</a> -> ';
            }
            $sNewsTreeBreadCrumb = substr($sNewsTreeBreadCrumb, 0, -3);
        }else{
            $sNewsTreeBreadCrumb = 'Категория';
        }
        return  $sNewsTreeBreadCrumb;
    }
    
    function AddFeedPage(){
	    $this->_js_files[] = 'jquery.js';
	    $this->_js_files[] = 'news_tree.js';
	    $this->_css_files[] = 'news_tree.css';
	   $this -> setTemplate(null, 'add_feed.tpl.php');
	}
		
}
?>