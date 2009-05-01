<?php
class NewsView extends BaseSiteView{
	protected $_dir = 'news';
	public $_htmlTree = '';
	protected $newsUrl = '/news';

	
	function getFeedsByNewsTreeId($news_tree_id){
	    $newsModel = new NewsModel();
	    return $newsModel->getFeedsByNewsTreeId($news_tree_id);
	}
	
	/* build News Tree , and save it in $_htmlTree */
	public function BuildTree($aLeafs, $aNewsTreeList, $parentId = 0, $aNewsSubscribe, $user_id, $isNewsTreeStateActive = true, $isFeedsStateActive = true ){
        $imgUrl = $this -> image_url;
        $newsUrl = Project::getRequest()->createUrl('News', 'News');
        foreach( $aNewsTreeList as $id=>$news){
          if ($isNewsTreeStateActive && !$news['state']) continue;
          if($parentId!=$news['parent_id'])continue;
          $newsUrl = Project::getRequest()->createUrl('News', 'News');
          // get RSS-feeds for leaves on tree
          $aFeeds = $this -> getFeedsByNewsTreeId($news['id']);
          
          if (in_array($news['id'], $aLeafs) && count($aFeeds)==0){
            $htmlImg = '';
          }else {
         //   $htmlImg = '<img class="minus" height="11" width="11" alt="" src="'.$this -> image_url.'1x1.gif" /> ';
            $htmlImg = '<i class="arrow-icon"></i>';
          }
          
          $this->_htmlTree .= '
          <li >
            '.$htmlImg.'
            <label><a href="'.$newsUrl.'/filterNewsTree:'.$news['id'].'">'.$news['name'].'</a></label>
            <ul class="nav-list">';
          
          
          foreach ($aFeeds as $feed){
              if ($isFeedsStateActive && !$feed['state']) continue;
              if (!$feed['is_partner'] && $feed['user_id'] != $user_id) continue;
              $checked = ($this-> isInArrayNewsSubscribe($aNewsSubscribe, $feed['news_tree_feeds_id']))?'checked':'';
              $this->_htmlTree .= '<li>';
              if ($user_id){
                $this->_htmlTree .= '<input type="checkbox" class="bCheckTree" name="news_tree_feeds[]" value="'.$feed['news_tree_feeds_id'].'" '.$checked.' />';
              }
              $this->_htmlTree .= ' <i><a href="'.$newsUrl.'/filterNewsTreeFeeds:'.$feed['news_tree_feeds_id'].'">'.$feed['name'].'</a></i></li>';
          }
          
          $this->BuildTree($aLeafs, $aNewsTreeList, $news['id'], $aNewsSubscribe, $user_id, $isNewsTreeStateActive, $isFeedsStateActive);
          $this->_htmlTree .= '
            </ul>
          </li>';
       }
    }
    
    
    /* build News Tree with Radio buttons for Site-partners, for adding RSS-feeds, and save it in $_htmlTree */
	public function BuildTree_radio($aLeafs, $aNews, $parentId = 0, $checkId = 0, $showAllRadioButtons = true){
        if (!$checkId && is_array($aLeafs) && count($aLeafs)>0) $checkId = $aLeafs[0];
	    $imgUrl = $this -> image_url;
        foreach( $aNews as $id=>$news){
          if($parentId!=$news['parent_id']) continue;
          $newsUrl = Project::getRequest()->createUrl('News', 'News');
          if (in_array($news['id'], $aLeafs)){
            $isLeaf = true;
            $htmlImg = '';
          }else {
            $isLeaf = false;
            $htmlImg = '<img class="minus" height="11" width="11" alt="" src="'.$this -> image_url.'1x1.gif" /> ';
          }
          if ($isLeaf || $showAllRadioButtons){
              $bChecked = ($news['id'] == $checkId)?'checked="yes"':'';
              $htmlInputRadio = '<input type="radio" name="news_tree_id" value="'.$news['id'].'" '.$bChecked.' />';
          }else $htmlInputRadio = "";
          
          if ($news['state']) {$s1=""; $s2="";} else {$s1="<s>"; $s2="</s>";}
          
          $this->_htmlTree .= '
          <li >
            '.$htmlImg.'
            <label style="white-space: nowrap; ">'.$htmlInputRadio.' '.$s1.$news['name'].$s2.'</label>
            <ul class="nav-list">';
          
          $this->BuildTree_radio($aLeafs, $aNews, $news['id'], $checkId, $showAllRadioButtons);
          $this->_htmlTree .= '
            </ul>
          </li>';
          
       }
    }

	public function BuildTree_select($aLeafs, $aNews, $parentId = 0, $checkId = 0, $showAllRadioButtons = true){
        if (!$checkId && is_array($aLeafs) && count($aLeafs)>0) $checkId = $aLeafs[0];
	    $imgUrl = $this -> image_url;
        foreach( $aNews as $id=>$news){
          if($parentId!=$news['parent_id']) continue;
          $newsUrl = Project::getRequest()->createUrl('News', 'News');
          if (in_array($news['id'], $aLeafs)){
            $isLeaf = true;
            $htmlImg = '';
          }else {
            $isLeaf = false;
            $htmlImg = '<img class="minus" height="11" width="11" alt="" src="'.$this -> image_url.'1x1.gif" /> ';
          }
          if ($isLeaf || $showAllRadioButtons){
              $bChecked = ($news['id'] == $checkId)?'checked="yes"':'';
              $htmlInputRadio = '<input type="radio" name="news_tree_id" value="'.$news['id'].'" '.$bChecked.' />';
          }else $htmlInputRadio = "";
          
          if ($news['state']) {$s1=""; $s2="";} else {$s1="<s>"; $s2="</s>";}
          
          $this->_htmlTree .= '
          <li >
            '.$htmlImg.'
            <label style="white-space: nowrap; ">'.$htmlInputRadio.' '.$s1.$news['name'].$s2.'</label>
            <ul class="nav-list">';
          
          $this->BuildTree_select($aLeafs, $aNews, $news['id'], $checkId, $showAllRadioButtons);
          $this->_htmlTree .= '
            </ul>
          </li>';
          
       }
    }    
    
    
    /* build News Tree  for Admin moderation . Can EDIT and DELETE branches */
	public function BuildTree_moderate($aLeafs, $aNews, $parentId = 0){
	    $newsModel = new NewsModel();
        if (!$checkId && is_array($aLeafs) && count($aLeafs)>0) $checkId = $aLeafs[0];
	    $imgUrl = $this -> image_url;
        foreach( $aNews as $id=>$news){
          if($parentId!=$news['parent_id']) continue;
          $ChangeNewsTreeUrl = Project::getRequest()->createUrl('News', 'ChangeNewsTree');
          if (in_array($news['id'], $aLeafs)){
            $isLeaf = true;
            $htmlImg = '';
          }else {
            $isLeaf = false;
            $htmlImg = '<img class="minus" height="11" width="11" alt="" src="'.$this -> image_url.'1x1.gif" /> ';
          }
          if ($news['state']) {$isStrikeClass="not_strike"; $dodel='';} else {$isStrikeClass="strike"; $dodel='class="to-del"';}
          $user = $newsModel -> getUserById($news['user_id']);
          
 /*         $this->_htmlTree .= '
          <li >
            '.$htmlImg.'
            <label style="white-space: nowrap; "><span id="news_tree'.$news['id'].'" class="'.$isStrikeClass.'">'.$news['name'].'</span>
            [<a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $user['login']).'">'.$user['login'].'</a>]';
          $this->_htmlTree .= '
		    <a onclick=\'
	        ajax('.AjaxRequest::getJsonParam("News", "ChangeState", array("id"=>$news['id'], "element"=>"news_tree", "attr"=>"strike", "text1"=>"strike", "text2"=>"not_strike" ), "POST").', true);
	        \' href="javascript: void(0);">Изменить статус</a> <a href="'.$ChangeNewsTreeUrl.'/tree_id:'.$news['id'].'/deleteNewsTree:1/">Удалить</a>';
          $this->_htmlTree .= '   
            </label>
            <ul class="nav-list">';
          
          $this->BuildTree_moderate($aLeafs, $aNews, $news['id']);
          $this->_htmlTree .= '
            </ul>
          </li>';  */		         
          $this->_htmlTree .= '
          <li '.$dodel.'>
          		<dl class="clearfix">
          			<dt><a href="#" class="with-icon-s '.$isStrikeClass.'" id="news_tree'.$news['id'].'"><i class="icon-s close-s-icon"></i>'.$news['name'].'</a></dt>
					<dd class="act">
						<a onclick=\'
	        ajax('.AjaxRequest::getJsonParam("News", "ChangeState", array("id"=>$news['id'], "element"=>"news_tree", "attr"=>"strike", "text1"=>"strike", "text2"=>"not_strike" ), "POST").', true);
	        \' href="javascript: void(0);" class="script-link"><span class="t">изменить статус</span></a>
						<a href="'.$ChangeNewsTreeUrl.'/tree_id:'.$news['id'].'/deleteNewsTree:1/" class="delete-link">удалить</a>
					</dd> 
					<dd class="who">добавил <a href="'.Project::getRequest()->createUrl('User', 'Profile', null, $user['login']).'">'.$user['login'].'</a></dd>	
				</dl>									         			
            <ul>';        
         	 	$this->BuildTree_moderate($aLeafs, $aNews, $news['id']);
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
    
    // check is this element have children (or is last element in tree hierarchy)
    function isLeaf($elementId){
        $newsModel = new NewsModel();
        return $newsModel->isLeaf($elementId);
    }
    
    public function ShowNewsTreeBreadCrumb($aNewsTreeBreadCrumb, $isSetAnchor=true){
        $sNewsTreeBreadCrumb = '';
        $newsUrl = Project::getRequest()->createUrl('News', 'News');
        if (count($aNewsTreeBreadCrumb)>0){
            foreach ($aNewsTreeBreadCrumb as $newsTree){
                if ($isSetAnchor) $sNewsTreeBreadCrumb .= '<a href="'.$newsUrl.'/filterNewsTree:'.$newsTree['id'].'">';
                $sNewsTreeBreadCrumb .= $newsTree['name'];
                if ($isSetAnchor) $sNewsTreeBreadCrumb .= '</a>';
                $sNewsTreeBreadCrumb .= ' » ';
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
        $newsUrl = Project::getRequest()->createUrl('News', 'News');
        $newsTreeFeeds = $newsModel -> getNewsTreeFeedsById($news_tree_feeds_id);
        $newsModel -> getNewsTreeBreadCrumb($newsTreeFeeds['news_tree_id']);
	    $newsModel ->_aNewsTreeBreadCrumb = array_reverse($newsModel ->_aNewsTreeBreadCrumb);
	    $aNewsTreeBreadCrumb = $newsModel ->_aNewsTreeBreadCrumb;
        $sNewsTreeBreadCrumb = $this->ShowNewsTreeBreadCrumb($aNewsTreeBreadCrumb, $isSetAnchor);
        if ($newsTreeFeeds['feeds_name']){
            $sNewsTreeBreadCrumb .= ' -> ';
            if ($isSetAnchor) $sNewsTreeBreadCrumb .= '<a href="'.$newsUrl.'/filterNewsTreeFeeds:'.$news_tree_feeds_id.'">';
            $sNewsTreeBreadCrumb .= $newsTreeFeeds['feeds_name'];
            if ($isSetAnchor) $sNewsTreeBreadCrumb .= '</a>'; 
        }
        return  $sNewsTreeBreadCrumb;
    }
    
    public function ShowNewsListPreviewByNewsTreeFeedsId($news_tree_feeds_id, $newsViewType, $user_id = 0, $nShowRows=4, $page_settings, $isOnlySubscribeNewsTree = false, $isOnlyFavoriteNews = false){
        $newsModel = new NewsModel();
        
        $aNews = $newsModel -> getNewsByNewsTreeFeedsId($news_tree_feeds_id, $user_id, $isOnlySubscribeNewsTree, $isOnlyFavoriteNews, $page_settings, true, true, true);
        return $this -> ShowNewsListPreviewView( $newsViewType, $aNews, $nShowRows, $user_id);
    }
    public function ShowNewsListPreviewByNewsTreeFeedsIdNova($news_tree_feeds_id, $newsViewType, $user_id = 0, $nShowRows=4, $page_settings, $isOnlySubscribeNewsTree = false, $isOnlyFavoriteNews = false){
        $newsModel = new NewsModel();
        
        $aNews = $newsModel -> getNewsByNewsTreeFeedsId($news_tree_feeds_id, $user_id, $isOnlySubscribeNewsTree, $isOnlyFavoriteNews, $page_settings, true, true, true);
        return $this -> ShowNewsListPreviewViewNova( $newsViewType, $aNews, $nShowRows, $user_id);
    }    
    
    public function ShowNewsListPreviewByNewsTreeId($news_tree_id, $newsViewType, $user_id = 0, $nShowRows=4, $page_settings, $isOnlySubscribeNewsTree = false, $isOnlyFavoriteNews = false){
        $newsModel = new NewsModel();
        
        $aNews = $newsModel -> getNewsByNewsTreeId($news_tree_id, $user_id, $isOnlySubscribeNewsTree, $isOnlyFavoriteNews, $page_settings, true, true, true);
        return $this -> ShowNewsListPreviewView( $newsViewType, $aNews, $nShowRows, $user_id);
    }   
    public function ShowNewsListPreviewView( $newsViewType, $aNews, $nShowRows=4, $user_id){
        $newsUrl = Project::getRequest()->createUrl('News', 'News');
        $imgUrl = $this -> image_url;
        $countNews = count($aNews);

        $htmlNewsListPreview = '<table>';
        if ($newsViewType == 'report'){ // report news list
            if ($countNews > 0){
                $news = array_shift($aNews);
                if ($news['favorite_news_id']) $starGif = "star_on.gif"; else $starGif = "star_off.gif"; 
                $htmlNewsListPreview .= '
                    <tr>';
                $htmlNewsListPreview .= '
                        <td class="arh_x1">
    						<h3><a href="'.$newsUrl.'/news_id:'.$news['news_id'].'">'.$news['news_title'].'</a><span style="font-weight: normal;"> ';
                if ($user_id){
                    $htmlNewsListPreview .= '
    						    <a onclick=\'
        				        ajax('.AjaxRequest::getJsonParam("News", "ChangeNewsFavorite", array("news_id"=>$news['news_id'], "imgUrl"=>$imgUrl), "POST").', true);
        				        \' href="javascript: void(0);"><img src="'.$imgUrl.$starGif.'" id="imgstar'.$news['news_id'].'"></a>';
                }
                $htmlNewsListPreview .= '
        				        &nbsp; ('.$news['pub_date'].')</span></h3><br />
    						'.$news['news_short_text'].'
    					</td>';
                $countNews --;
            }
            $nRows = ($countNews>3)?3:$countNews;
            $htmlNewsListPreview .= '
                        <td class="arh_x2">
    						<ul class="list_style1">';
            for($i=0; $i<$nRows; $i++){
                if ($aNews[$i]['favorite_news_id']) $starGif = "star_on.gif"; else $starGif = "star_off.gif"; 
                $htmlNewsListPreview .= '                    
    							<li><a href="'.$newsUrl.'/news_id:'.$aNews[$i]['news_id'].'">'.$aNews[$i]['news_title'].'</a> ';
                if ($user_id){
                    $htmlNewsListPreview .= ' 
    							<a onclick=\'
        				        ajax('.AjaxRequest::getJsonParam("News", "ChangeNewsFavorite", array("news_id"=>$aNews[$i]['news_id'], "imgUrl"=>$imgUrl), "POST").', true);
        				        \' href="javascript: void(0);"><img src="'.$imgUrl.$starGif.'" id="imgstar'.$aNews[$i]['news_id'].'"></a> ';
                }
                $htmlNewsListPreview .= ' 
    							('.$aNews[$i]['pub_date'].')</li>
                ';
            }
            $htmlNewsListPreview .= '
                            </ul>
    					</td>
    			    </tr>';
        }else{ // full news list
            if ($nShowRows) $nRows = ($countNews>$nShowRows)?$nShowRows:$countNews;
            else $nRows = $countNews;
            for($i=0; $i<$nRows; $i++){
                if ($aNews[$i]['favorite_news_id']) $starGif = "star_on.gif"; else $starGif = "star_off.gif"; 
                $htmlNewsListPreview .= '
                    <tr>
                        <td class="arh_x1">
    						<h3><a href="'.$newsUrl.'/news_id:'.$aNews[$i]['news_id'].'">'.$aNews[$i]['news_title'].'</a><span style="font-weight: normal;"> ';
                if ($user_id){
                    $htmlNewsListPreview .= '
    						<a onclick=\'
    				        ajax('.AjaxRequest::getJsonParam("News", "ChangeNewsFavorite", array("news_id"=>$aNews[$i]['news_id'], "imgUrl"=>$imgUrl), "POST").', true);
    				        \' href="javascript: void(0);"><img src="'.$imgUrl.$starGif.'" id="imgstar'.$aNews[$i]['news_id'].'"></a>';
                }
                $htmlNewsListPreview .= '
    						 &nbsp; ('.$aNews[$i]['pub_date'].')</span></h3><br />
    						'.$aNews[$i]['news_short_text'].'
    					</td>
    				</tr>';
            }
        }
        $htmlNewsListPreview .= '
            </table>';
        
        return $htmlNewsListPreview;
    }
    public function ShowNewsListPreviewByNewsTreeIdNova($news_tree_id, $newsViewType, $user_id = 0, $nShowRows=4, $page_settings, $isOnlySubscribeNewsTree = false, $isOnlyFavoriteNews = false){
        $newsModel = new NewsModel();
        
        $aNews = $newsModel -> getNewsByNewsTreeId($news_tree_id, $user_id, $isOnlySubscribeNewsTree, $isOnlyFavoriteNews, $page_settings, true, true, true);
        return $this -> ShowNewsListPreviewViewNova( $newsViewType, $aNews, $nShowRows, $user_id);
    }
        
    public function ShowNewsListPreviewViewNova( $newsViewType, $aNews, $nShowRows=4, $user_id){
        $newsUrl = Project::getRequest()->createUrl('News', 'News');
        $imgUrl = $this -> image_url;
        $countNews = count($aNews);
        if ($newsViewType == 'report'){ // report news list
        	if ($countNews > 0){
        	//	$countNews --;
        	}
        	if($countNews!=1) {
        	$nRows = ($countNews>3)?3:$countNews;
        	$htmlNewsListPreview .= '<ul class="short-view">';
            	for($i=1; $i<$nRows+1; $i++){
                	if ($aNews[$i]['favorite_news_id']) {
                		$star_class = 'class="star-icon full-star"'; 
                	}
                	else {
                		$star_class = 'class="star-icon empty-star"';
                	}
                	$htmlNewsListPreview .= '                    
    							<li><a href="'.$newsUrl.'/news_id:'.$aNews[$i]['news_id'].'"><i class="icon this-icon"></i>'.$aNews[$i]['news_title'].'</a>';
                	if ($user_id){
                		  $htmlNewsListPreview .= '<i id="imgstar'.$aNews[$i]['news_id'].'" '.$star_class.' onclick=\'if($(this).hasClass("full-star")) {$(this).removeClass("full-star"); $(this).addClass("empty-star");} else {$(this).removeClass("empty-star"); $(this).addClass("full-star");} ajax('.AjaxRequest::getJsonParam("News", "ChangeNewsFavorite", array("news_id"=>$aNews[$i]['news_id'], "imgUrl"=>$imgUrl), "POST").', true);\'></i>';
                	}
                	else {
                		 $htmlNewsListPreview .= '<i '.$star_class.'></i>';
                	}
            		$htmlNewsListPreview .= '</li>';
            	}        		
        	$htmlNewsListPreview .= '</ul>';
        	}
        	if ($countNews > 0){
        		$news = array_shift($aNews);
        	    if ($news['favorite_news_id']) {
                	$star_class = 'class="star-icon full-star"'; 
                }
                else {
                	$star_class = 'class="star-icon empty-star"';
                }
        		$htmlNewsListPreview .= '<div class="full-view">';
        			$htmlNewsListPreview .= '<h3><a href="'.$newsUrl.'/news_id:'.$news['news_id'].'">'.$news['news_title'].'</a>';
        			if ($user_id){
        				$htmlNewsListPreview .= '<i id="imgstar'.$news['news_id'].'" '.$star_class.' onclick=\'if($(this).hasClass("full-star")) {$(this).removeClass("full-star"); $(this).addClass("empty-star");} else {$(this).removeClass("empty-star"); $(this).addClass("full-star");} ajax('.AjaxRequest::getJsonParam("News", "ChangeNewsFavorite", array("news_id"=>$news['news_id'], "imgUrl"=>$imgUrl), "POST").', true);\'></i>';
        			}
        			else {
        				$htmlNewsListPreview .= '<i '.$star_class.'></i>';	
        			}
        			$htmlNewsListPreview .= '</h3>';
        			$htmlNewsListPreview .= '<div class="breadcrumbs">
        										▪ '.$this->ShowNewsTreeBreadCrumbByNewsTreeId($news['news_tree_id']).'
											</div>';
        		//	$htmlNewsListPreview .= '<a href="'.$newsUrl.'/news_id:'.$news['news_id'].'"><img src="assets/i/temp/temp.5.jpg" alt="Что же в имени твоем! 3.0D" /></a>';
        			$htmlNewsListPreview .= '<p>'.$news['news_short_text'].' ... </p>';
        			if($countNews > 1) {
        				$htmlNewsListPreview .= '<div class="more"><a href="'.$newsUrl.'/news_id:'.$news['news_id'].'">читать дальше</a> &rarr;</div>';
        			}	
        		$htmlNewsListPreview .= '</div>';	
        	}	
        } else { // full news list
            if ($nShowRows) $nRows = ($countNews>$nShowRows)?$nShowRows:$countNews;
            else $nRows = $countNews;
            for($i=0; $i<$nRows; $i++){
       	    if ($aNews[$i]['favorite_news_id']) {
                	$star_class = 'class="star-icon full-star"'; 
                }
                else {
                	$star_class = 'class="star-icon empty-star"';
                }
        		$htmlNewsListPreview .= '<div class="full-view">';
        			$htmlNewsListPreview .= '<h3><a href="'.$newsUrl.'/news_id:'.$aNews[$i]['news_id'].'">'.$aNews[$i]['news_title'].'</a>';
        			if ($user_id){
        				$htmlNewsListPreview .= '<i id="imgstar'.$aNews[$i]['news_id'].'" '.$star_class.' onclick=\'if($(this).hasClass("full-star")) {$(this).removeClass("full-star"); $(this).addClass("empty-star");} else {$(this).removeClass("empty-star"); $(this).addClass("full-star");} ajax('.AjaxRequest::getJsonParam("News", "ChangeNewsFavorite", array("news_id"=>$aNews[$i]['news_id'], "imgUrl"=>$imgUrl), "POST").', true);\'></i>';
        			}
        			else {
        				$htmlNewsListPreview .= '<i '.$star_class.'></i>';	
        			}
        			$htmlNewsListPreview .= '</h3>';
        			$htmlNewsListPreview .= '<div class="breadcrumbs">
        										▪ '.$this->ShowNewsTreeBreadCrumbByNewsTreeId($aNews[$i]['news_tree_id']).'
											</div>';
        		//	$htmlNewsListPreview .= '<a href="'.$newsUrl.'/news_id:'.$news['news_id'].'"><img src="assets/i/temp/temp.5.jpg" alt="Что же в имени твоем! 3.0D" /></a>';
        			$htmlNewsListPreview .= '<p>'.$aNews[$i]['news_short_text'].' ... </p>';
        		//	if($countNews > 1) {
        			$htmlNewsListPreview .= '<div class="more"><a href="'.$newsUrl.'/news_id:'.$news['news_id'].'">читать дальше</a> &rarr;</div>';
        		//	}	//$aNews[$i]['pub_date']
        		$htmlNewsListPreview .= '</div>';	
            }
        }
        return $htmlNewsListPreview;
    }
    
    
    public function getAllNewsTree(){
        $newsModel = new NewsModel();
        return $newsModel -> getAllNewsTree();
    }
    
    
    public function getNewsTreeByListNewsSubscribe($aNewsSubscribe){
        $newsModel = new NewsModel();
        return $newsModel -> getNewsTreeByListNewsSubscribe($aNewsSubscribe);
    }
    
    public function getNewsTreeByUserFavorite($user_id){
        $newsModel = new NewsModel();
        return $newsModel -> getNewsTreeByUserFavorite($user_id);
    }
    
    
    
    public function getNewsCountByNewsTreeFeedsId($news_tree_feeds_id, $user_id = 0, $isOnlySubscribeNewsTree = false, $isOnlyFavoriteNews = false, $isFeedActive = true, $isNewsTreeActive = true, $isNewsBannersActive = true){
        $newsModel = new NewsModel();
        $newsCount = $newsModel -> getNewsCountByNewsTreeFeedsId($news_tree_feeds_id, $user_id, $isOnlySubscribeNewsTree, $isOnlyFavoriteNews, $isFeedActive, $isNewsTreeActive, $isNewsBannersActive);
        return  $newsCount;
    }
    
    public function getNewsCountByNewsTreeId($news_tree_id, $user_id = 0, $isOnlySubscribeNewsTree = false, $isOnlyFavoriteNews = false, $isFeedActive = true, $isNewsTreeActive = true, $isNewsBannersActive = true){
        $newsModel = new NewsModel();
        $newsCount = $newsModel -> getNewsCountByNewsTreeId($news_tree_id, $user_id, $isOnlySubscribeNewsTree, $isOnlyFavoriteNews, $isFeedActive, $isNewsTreeActive, $isNewsBannersActive);
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
    
    function isInArrayNewsSubscribe($aNewsSubscribe, $news_tree_feeds_id){
	    foreach ($aNewsSubscribe as $newsSubscribe){
	        if ($news_tree_feeds_id == $newsSubscribe['news_tree_feeds_id']) return true;
	    }
	    return false;
	}
    
    
    /**
     * Pages VIEW
     *
     */
    
    function NewsPage(){
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'news_tree.js';
	    $this->_css_files[] = 'news_tree.css';
	    $this -> setTemplate(null, 'news.tpl.php');
	}
    
    function AddFeedPage(){
	    $this->_js_files[] = 'news_tree.js';
	    $this->_css_files[] = 'news_tree.css';
	   $this -> setTemplate(null, 'add_feed.tpl.php');
	}
	
	function ModerateNewsTreePage(){
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'news_tree.js';
	    $this->_css_files[] = 'news_tree.css';
	    $this -> setTemplate(null, 'moderate_news_tree.tpl.php');
	}
	
	function ModerateFeedsPage(){
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'news_tree.js';
	    $this->_css_files[] = 'news_tree.css';
	    $this -> setTemplate(null, 'moderate_feeds.tpl.php');
	}
	
	function AddNewsTreePage(){
	    $this->_js_files[] = 'news_tree.js';
	    $this->_css_files[] = 'news_tree.css';
	   $this -> setTemplate(null, 'add_news_tree.tpl.php');
	}
	
	function MyFeedPage(){
	   $this->_js_files[]='blockUI.js';
	   $this->_js_files[]='ajax.js';
	   $this->_js_files[] = 'news_tree.js';
	   $this->_css_files[] = 'news_tree.css';
	   $this -> setTemplate(null, 'my_feed.tpl.php');
	}
	
	/**
     * END Pages VIEW
     *
     */
	
	/**
     * AJAX Functions
     *
     */
	
	function ChangeState($message){
		$response = Project::getAjaxResponse();
		$response -> block($message['table'].$message['id'], true, $message['text']);
		//print_r($response -> getResponse());
	}
	
	function ChangeState2($message){
		$response = Project::getAjaxResponse();
		$response -> attribute($message['table'].$message['id'], "class", $message['text']);
		//print_r($response -> getResponse());
	}
	
    function ChangeNewsFavorite($message){
		$response = Project::getAjaxResponse();
		if ($message['val']) $starGif = "star_on.gif"; else $starGif = "star_off.gif"; 
		$response -> attribute('imgstar'.$message['newsId'], 'src', $message['imgUrl'].$starGif);
		//print_r($response -> getResponse());
	}
	
	/**
     * END AJAX Functions
     *
     */
		
}
?>