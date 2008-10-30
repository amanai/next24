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
	public function BuildTree($aLeafs, $aNews,$parentId = 0){
        $imgUrl = $this -> image_url;
        foreach( $aNews as $id=>$news){
          if($parentId!=$news['parent_id'])continue;
          $newsUrl = $this->newsUrl;
          // get RSS-feeds for leaves on tree
          $aFeeds = $this -> getFeedsByNewsTreeId($news['id']);
          
          if (in_array($news['id'], $aLeafs) && count($aFeeds)==0){
            $htmlImg = '';
          }else {
            $htmlImg = '<img class="minus" height="11" width="11" alt="" /> ';
          }
          
          $this->_htmlTree .= '
          <li >
            '.$htmlImg.'
            <label><input type="checkbox" name="" value="" /> <a href="'.$newsUrl.'/news_tree_id:'.$news['id'].'">'.$news['name'].'</a></label>
            <ul class="checkbox_tree">';
          
          
          foreach ($aFeeds as $feed){
              $this->_htmlTree .= '<li><label><input type="checkbox"/> '.$feed['name'].'</label></li>';
          }
          
          $this->BuildTree($aLeafs, $aNews,$news['id']);
          $this->_htmlTree .= '
            </ul>
          </li>';
          
       }
    }
    
    
    /* build News Tree with Radio buttons for Site-partners, for adding RSS-feeds, and save it in $_htmlTree */
	public function BuildTree_radio($aLeafs, $aNews, $parentId = 0){
        $imgUrl = $this -> image_url;
        foreach( $aNews as $id=>$news){
          if($parentId!=$news['parent_id']) continue;
          $newsUrl = $this->newsUrl;
          
          if (in_array($news['id'], $aLeafs)){
            $htmlInputRadio = '<input type="radio" name="news_tree_id" value="'.$news['id'].'" />';
            $htmlImg = '';
          }else {
            $htmlInputRadio = '';
            $htmlImg = '<img class="minus" height="11" width="11" alt="" /> ';
          }
          
          $this->_htmlTree .= '
          <li >
            '.$htmlImg.'
            <label>'.$htmlInputRadio.' '.$news['name'].'</label>
            <ul class="checkbox_tree">';
          
          $this->BuildTree_radio($aLeafs, $aNews, $news['id']);
          $this->_htmlTree .= '
            </ul>
          </li>';
          
       }
    }
    
    // return Array of leafs
    function getAllLeafs($aNews){
        $aLeafs = array();
        foreach ($aNews as $news){
            if ($this->isLeaf($news['id'])){
                $aLeafs[]=$news['id'];
            }
        }
        return $aLeafs;
    }
    
    // check is this element have children (is last element in tree hierarchy)
    function isLeaf($elementId){
        $newsModel = new NewsModel();
        return $newsModel->isLeaf($elementId);
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