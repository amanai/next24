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
	public function BuildTree($aLeafs, $aNews, $parentId = 0, $aNewsSubscribe, $isNewsTreeStateActive = true, $isFeedsStateActive = true ){
        $imgUrl = $this -> image_url;
        $newsUrl = Project::getRequest()->createUrl('News', 'News');
        foreach( $aNews as $id=>$news){
          if ($isNewsTreeStateActive && !$news['state']) continue;
          if($parentId!=$news['parent_id'])continue;
          $newsUrl = Project::getRequest()->createUrl('News', 'News');
          // get RSS-feeds for leaves on tree
          $aFeeds = $this -> getFeedsByNewsTreeId($news['id']);
          
          if (in_array($news['id'], $aLeafs) && count($aFeeds)==0){
            $htmlImg = '';
          }else {
            $htmlImg = '<img class="minus" height="11" width="11" alt="" src="'.$this -> image_url.'1x1.gif" /> ';
          }
          
          $this->_htmlTree .= '
          <li >
            '.$htmlImg.'
            <label><a href="'.$newsUrl.'/filterNewsTree:'.$news['id'].'">'.$news['name'].'</a></label>
            <ul class="checkbox_tree">';
          
          
          foreach ($aFeeds as $feed){
              if ($isFeedsStateActive && !$feed['state']) continue;
              $checked = ($this-> isInArrayNewsSubscribe($aNewsSubscribe, $feed['news_tree_feeds_id']))?'checked':'';
              $this->_htmlTree .= '<li><input type="checkbox" class="bCheckTree" name="news_tree_feeds[]" value="'.$feed['news_tree_feeds_id'].'" '.$checked.' /> <i><a href="'.$newsUrl.'/filterNewsTreeFeeds:'.$feed['news_tree_feeds_id'].'">'.$feed['name'].'</a></i></li>';
          }
          
          $this->BuildTree($aLeafs, $aNews, $news['id'], $aNewsSubscribe);
          $this->_htmlTree .= '
            </ul>
          </li>';
       }
    }
    
    
    /* build News Tree with Radio buttons for Site-partners, for adding RSS-feeds, and save it in $_htmlTree */
	public function BuildTree_radio($aLeafs, $aNews, $parentId = 0, $checkId = 0){
        if (!$checkId && is_array($aLeafs) && count($aLeafs)>0) $checkId = $aLeafs[0];
	    $imgUrl = $this -> image_url;
        foreach( $aNews as $id=>$news){
          if($parentId!=$news['parent_id']) continue;
          $newsUrl = Project::getRequest()->createUrl('News', 'News');
          if (in_array($news['id'], $aLeafs)){
            $bChecked = ($news['id'] == $checkId)?'checked="yes"':'';
            //echo $news['id']." = ".$checkId." ; ".$bChecked."<hr>";
            $htmlInputRadio = '<input type="radio" name="news_tree_id" value="'.$news['id'].'" '.$bChecked.' />';
            $htmlImg = '';
          }else {
            $htmlInputRadio = '';
            $htmlImg = '<img class="minus" height="11" width="11" alt="" src="'.$this -> image_url.'1x1.gif" /> ';
          }
          
          $this->_htmlTree .= '
          <li >
            '.$htmlImg.'
            <label>'.$htmlInputRadio.' '.$news['name'].'</label>
            <ul class="checkbox_tree">';
          
          $this->BuildTree_radio($aLeafs, $aNews, $news['id'], $checkId);
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
    
    public function ShowNewsTreeBreadCrumb($aNewsTreeBreadCrumb, $isSetAnchor=true){
        $sNewsTreeBreadCrumb = '';
        $newsUrl = Project::getRequest()->createUrl('News', 'News');
        if (count($aNewsTreeBreadCrumb)>0){
            foreach ($aNewsTreeBreadCrumb as $newsTree){
                if ($isSetAnchor) $sNewsTreeBreadCrumb .= '<a href="'.$newsUrl.'/news_tree_id:'.$newsTree['id'].'">';
                $sNewsTreeBreadCrumb .= $newsTree['name'];
                if ($isSetAnchor) $sNewsTreeBreadCrumb .= '</a>';
                $sNewsTreeBreadCrumb .= ' -> ';
            }
            $sNewsTreeBreadCrumb = substr($sNewsTreeBreadCrumb, 0, -3);
        }else{
            $sNewsTreeBreadCrumb = 'Категория';
        }
        return  $sNewsTreeBreadCrumb;
    }
    
    public function ShowNewsTreeBreadCrumbByNewsTreeId($news_tree_id, $isSetAnchor=true){
        $newsModel = new NewsModel();
        $newsModel -> getNewsTreeBreadCrumb($news_tree_id);
	    $newsModel ->_aNewsTreeBreadCrumb = array_reverse($newsModel ->_aNewsTreeBreadCrumb);
	    $aNewsTreeBreadCrumb = $newsModel ->_aNewsTreeBreadCrumb;
        $sNewsTreeBreadCrumb = $this->ShowNewsTreeBreadCrumb($aNewsTreeBreadCrumb, $isSetAnchor);
        return  $sNewsTreeBreadCrumb;
    }
    
    public function ShowNewsTreeBreadCrumbByNewsTreeFeedsId($news_tree_feeds_id, $isSetAnchor=true){
        $newsModel = new NewsModel();
        $newsTreeFeeds = $newsModel -> getNewsTreeFeedsById($news_tree_feeds_id);
        $newsModel -> getNewsTreeBreadCrumb($newsTreeFeeds['news_tree_id']);
	    $newsModel ->_aNewsTreeBreadCrumb = array_reverse($newsModel ->_aNewsTreeBreadCrumb);
	    $aNewsTreeBreadCrumb = $newsModel ->_aNewsTreeBreadCrumb;
        $sNewsTreeBreadCrumb = $this->ShowNewsTreeBreadCrumb($aNewsTreeBreadCrumb, $isSetAnchor);
        if ($newsTreeFeeds['feeds_name']) $sNewsTreeBreadCrumb .= ' -> '.$newsTreeFeeds['feeds_name'];
        return  $sNewsTreeBreadCrumb;
    }
    
    public function ShowNewsListPreviewByNewsTreeFeedsId($news_tree_feeds_id, $newsViewType){
        $request = Project::getRequest();
        $newsModel = new NewsModel();
        $newsUrl = Project::getRequest()->createUrl('News', 'News');
        $imgUrl = $this -> image_url;
        
        $htmlNewsListPreview = '<table>';
        $aNews = $newsModel -> getNewsByNewsTreeFeedsId($news_tree_feeds_id, true, true, true);
        $countNews = count($aNews);
        if ($newsViewType == 'report'){ // report news list
            if ($countNews > 0){
                $news = array_shift($aNews);
                $htmlNewsListPreview .= '
                    <tr>';
                $htmlNewsListPreview .= '
                        <td class="arh_x1">
    						<h3><a href="'.$newsUrl.'/news_id:'.$news['news_id'].'">'.$news['news_title'].'</a><span style="font-weight: normal;"> <img src="'.$imgUrl.'star.gif">&nbsp; ('.$news['pub_date'].')</span></h3><br />
    						'.$news['news_short_text'].'
    					</td>';
                $countNews --;
            }
            $nRows = ($countNews>3)?3:$countNews;
            $htmlNewsListPreview .= '
                        <td class="arh_x2">
    						<ul class="list_style1">';
            for($i=0; $i<$nRows; $i++){
                $htmlNewsListPreview .= '                    
    							<li><a href="'.$newsUrl.'/news_id:'.$aNews[$i]['news_id'].'">'.$aNews[$i]['news_title'].'</a> <img src="'.$imgUrl.'star.gif"> ('.$aNews[$i]['pub_date'].')</li>
                ';
            }
            $htmlNewsListPreview .= '
                            </ul>
    					</td>
    			    </tr>';
        } else{ // full news list
            $nRows = ($countNews>4)?4:$countNews;
            for($i=0; $i<$nRows; $i++){
                $htmlNewsListPreview .= '
                    <tr>
                        <td class="arh_x1">
    						<h3><a href="'.$newsUrl.'/news_id:'.$aNews[$i]['news_id'].'">'.$aNews[$i]['news_title'].'</a><span style="font-weight: normal;"> <img src="'.$imgUrl.'star.gif">&nbsp; ('.$aNews[$i]['pub_date'].')</span></h3><br />
    						'.$aNews[$i]['news_short_text'].'
    					</td>
    				</tr>';
            }
        }
        $htmlNewsListPreview .= '
            </table>';
        
        return $htmlNewsListPreview;
    }
    
    public function ShowNewsListPreviewByNewsTreeId($news_tree_id, $newsViewType, $user_id = 0){
        $request = Project::getRequest();
        $newsModel = new NewsModel();
        $newsUrl = Project::getRequest()->createUrl('News', 'News');
        $imgUrl = $this -> image_url;
        
        $htmlNewsListPreview = '<table>';
        $aNews = $newsModel -> getNewsByNewsTreeId($news_tree_feeds_id, $user_id, true, true, true);
        $countNews = count($aNews);
        if ($newsViewType == 'report'){ // report news list
            if ($countNews > 0){
                $news = array_shift($aNews);
                if ($news['favorite_news_id']) $starGif = "star.gif"; else $starGif = "star_no.gif"; 
                $htmlNewsListPreview .= '
                    <tr>';
                $htmlNewsListPreview .= '
                        <td class="arh_x1">
    						<h3><a href="'.$newsUrl.'/news_id:'.$news['news_id'].'">'.$news['news_title'].'</a><span style="font-weight: normal;"> <img src="'.$imgUrl.$starGif.'">&nbsp; ('.$news['pub_date'].')</span></h3><br />
    						'.$news['news_short_text'].'
    					</td>';
                $countNews --;
            }
            $nRows = ($countNews>3)?3:$countNews;
            $htmlNewsListPreview .= '
                        <td class="arh_x2">
    						<ul class="list_style1">';
            for($i=0; $i<$nRows; $i++){
                $htmlNewsListPreview .= '                    
    							<li><a href="'.$newsUrl.'/news_id:'.$aNews[$i]['news_id'].'">'.$aNews[$i]['news_title'].'</a> <img src="'.$imgUrl.'star.gif"> ('.$aNews[$i]['pub_date'].')</li>
                ';
            }
            $htmlNewsListPreview .= '
                            </ul>
    					</td>
    			    </tr>';
        }else{ // full news list
            $nRows = ($countNews>4)?4:$countNews;
            for($i=0; $i<$nRows; $i++){
                $htmlNewsListPreview .= '
                    <tr>
                        <td class="arh_x1">
    						<h3><a href="'.$newsUrl.'/news_id:'.$aNews[$i]['news_id'].'">'.$aNews[$i]['news_title'].'</a><span style="font-weight: normal;"> <img src="'.$imgUrl.'star.gif"> &nbsp; ('.$aNews[$i]['pub_date'].')</span></h3><br />
    						'.$aNews[$i]['news_short_text'].'
    					</td>
    				</tr>';
            }
        }
        $htmlNewsListPreview .= '
            </table>';
        
        return $htmlNewsListPreview;
    }
    
    public function getNewsTreeByListNewsSubscribe($aNewsSubscribe){
        $newsModel = new NewsModel();
        return $newsModel -> getNewsTreeByListNewsSubscribe($aNewsSubscribe);
    }
    
    public function getNewsCountByNewsTreeFeedsId($news_tree_feeds_id, $isFeedActive = true, $isNewsTreeActive = true, $isNewsBannersActive = true){
        $newsModel = new NewsModel();
        $newsCount = $newsModel -> getNewsCountByNewsTreeFeedsId($news_tree_feeds_id, $isFeedActive, $isNewsTreeActive, $isNewsBannersActive);
        return  $newsCount;
    }
    
    public function getNewsCountByNewsTreeId($news_tree_id, $user_id = 0, $isFeedActive = true, $isNewsTreeActive = true, $isNewsBannersActive = true){
        $newsModel = new NewsModel();
        $newsCount = $newsModel -> getNewsCountByNewsTreeId($news_tree_id, $user_id, $isFeedActive, $isNewsTreeActive, $isNewsBannersActive);
        return  $newsCount;
    }
    
    
    public function ShowUserFeeds(){
        $request = Project::getRequest();
        $newsModel = new NewsModel();
        $user = Project::getUser()->getDbUser();
    }
    
    public function getNewsTreeChildren($news_tree_id){
        $newsModel = new NewsModel();
        $newsModel -> getNewsTreeChildren($news_tree_id);
        return $newsModel -> _aNewsTreeChildren;
    }
    
    public function isChild($aNewsTreeChildren, $news_tree_id){
        foreach ($aNewsTreeChildren as $newsTreeChildren){
            if ($newsTreeChildren['id'] == $news_tree_id) return true;
        }
        return false;
    }
    
    
    
    function AddFeedPage(){
	    $this->_js_files[] = 'jquery.js';
	    $this->_js_files[] = 'news_tree.js';
	    $this->_css_files[] = 'news_tree.css';
	   $this -> setTemplate(null, 'add_feed.tpl.php');
	}
	
	function MyFeedPage(){
	   $this->_js_files[] = 'jquery.js';
	   $this->_js_files[]='blockUI.js';
	   $this->_js_files[]='ajax.js';
	   $this -> setTemplate(null, 'my_feed.tpl.php');
	}
	
	function ActivateBanner($message){
		$response = Project::getAjaxResponse();
		$response -> block($message[1].$message[0], true, $message[2]);
		//print_r($response -> getResponse());
	}
	
	function isInArrayNewsSubscribe($aNewsSubscribe, $news_tree_feeds_id){
	    foreach ($aNewsSubscribe as $newsSubscribe){
	        if ($news_tree_feeds_id == $newsSubscribe['news_tree_feeds_id']) return true;
	    }
	    return false;
	}
		
}
?>