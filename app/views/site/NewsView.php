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
	public function BuildTree($aLeafs, $aNews, $parentId = 0){
        $imgUrl = $this -> image_url;
        foreach( $aNews as $id=>$news){
          if($parentId!=$news['parent_id'])continue;
          $newsUrl = $this->newsUrl;
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
            <label><input type="checkbox" />'.$news['name'].'</label>
            <ul class="checkbox_tree">';
          
          
          foreach ($aFeeds as $feed){
              $this->_htmlTree .= '<li><label><input type="checkbox"  name="news_tree_feeds[]" value="'.$feed['news_tree_feeds_id'].'" /> '.$feed['name'].'</label></li>';
          }
          
          $this->BuildTree($aLeafs, $aNews,$news['id']);
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
          $newsUrl = $this->newsUrl;
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
        $newsUrl = $this->newsUrl;
        if (count($aNewsTreeBreadCrumb)>0){
            foreach ($aNewsTreeBreadCrumb as $newsTree){
                if ($isSetAnchor) $sNewsTreeBreadCrumb .= '<a href="'.$newsUrl.'/news_tree_id:'.$newsTree['id'].'">';
                $sNewsTreeBreadCrumb .= $newsTree['name'];
                if ($isSetAnchor) $sNewsTreeBreadCrumb .= '</a>';
                $sNewsTreeBreadCrumb .= '->';
            }
            $sNewsTreeBreadCrumb = substr($sNewsTreeBreadCrumb, 0, -2);
        }else{
            $sNewsTreeBreadCrumb = 'Категория';
        }
        return  $sNewsTreeBreadCrumb;
    }
    
    public function ShowNewsTreeBreadCrumbByNewsTreeId($news_tree_id){
        $newsModel = new NewsModel();
        $newsModel -> getNewsTreeBreadCrumb($news_tree_id);
	    $newsModel ->_aNewsTreeBreadCrumb = array_reverse($newsModel ->_aNewsTreeBreadCrumb);
	    $aNewsTreeBreadCrumb = $newsModel ->_aNewsTreeBreadCrumb;
        $sNewsTreeBreadCrumb = $this->ShowNewsTreeBreadCrumb($aNewsTreeBreadCrumb);
        return  $sNewsTreeBreadCrumb;
    }
    
    public function ShowNewsTreeBreadCrumbByNewsTreeFeedsId($news_tree_feeds_id){
        $newsModel = new NewsModel();
        $newsTreeFeeds = $newsModel -> getNewsTreeFeedsById($news_tree_feeds_id);
        $newsModel -> getNewsTreeBreadCrumb($newsTreeFeeds['news_tree_id']);
	    $newsModel ->_aNewsTreeBreadCrumb = array_reverse($newsModel ->_aNewsTreeBreadCrumb);
	    $aNewsTreeBreadCrumb = $newsModel ->_aNewsTreeBreadCrumb;
        $sNewsTreeBreadCrumb = $this->ShowNewsTreeBreadCrumb($aNewsTreeBreadCrumb, false);
        if ($newsTreeFeeds['feeds_name']) $sNewsTreeBreadCrumb .= '->'.$newsTreeFeeds['feeds_name'];
        return  $sNewsTreeBreadCrumb;
    }
    
    public function ShowNewsListPreview($news_tree_feeds_id){
        $request = Project::getRequest();
        $newsModel = new NewsModel();
        $newsUrl = $this->newsUrl;
        
        $news_tree_id = ($request->news_tree_id)?$request->news_tree_id:0;
        $htmlNewsListPreview = '<table>';
        $aNews = $newsModel -> getNewsByNewsTreeId($news_tree_id, true, true, true);
        $isFirstTd = true;
        foreach ($aNews as $news){
            $htmlNewsListPreview .= '
                <tr>
                    <td class="arh_x1">
						<h3><a href="'.$newsUrl.'/news_id:'.$news['news_id'].'">'.$news['news_title'].'</a><span style="font-weight: normal;"> &nbsp; ('.$news['pub_date'].')</span></h3><br />
						'.$news['news_short_text'].'
					</td>';
            if ($isFirstTd){
                $htmlNewsListPreview .= '
                    <td class="arh_x2">
						<ul class="list_style1">
							<li><a href="#">Самолет "Аэрофлота" сел в "Шереметьево" с отказавшим двигателем</a> (18.07.2007)</li>
							<li><a href="#">МИД РФ не спешит с ответными мерами в адрес Великобритании</a> (17.07.2007)</li>
							<li><a href="#">В Назрани обстреляли дом родственников Зязикова</a> (16.07.2007)</li>
							<li><a href="#">В Назрани обстреляли дом родственников Зязикова</a> (16.07.2007)</li>
							<li><a href="#">В Назрани обстреляли дом родственников Зязикова</a> (16.07.2007)</li>
							<li><a href="#">В Назрани обстреляли дом родственников Зязикова</a> (16.07.2007)</li>
							<li><a href="#">В Назрани обстреляли дом родственников Зязикова</a> (16.07.2007)</li>
							<li><a href="#">В Назрани обстреляли дом родственников Зязикова</a> (16.07.2007)</li>
						</ul>
					</td>
                ';
                $isFirstTd = false;
            } else $htmlNewsListPreview .= '';
            $htmlNewsListPreview .= '
			    </tr>';

        }
        $htmlNewsListPreview .= '</table>';
        
        return $htmlNewsListPreview;
    }
    
    
    public function ShowUserFeeds(){
        $request = Project::getRequest();
        $newsModel = new NewsModel();
        $user = Project::getUser()->getDbUser();
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
		
}
?>