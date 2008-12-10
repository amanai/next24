<?php
class HomeView extends BaseSiteView{
	
    public function getTabsNames($tabs_map, $user_id){
        $htmlStr = "";
        foreach ($tabs_map['selected_tabs'] as $tab){
            if ($tab['selected']){
                $tab_id = $tab['id'];
                $tab_name = $tabs_map['main_tabs'][$tab_id]['name'];
                $htmlStr .= '
                    <div onmouseout="TabOut(this);" onmouseover="TabOver(this);" id="tab'.$tab_id.'" class="tab"><a onclick="return ActivateTab('.$tab_id.');" href="#">'.$tab_name.'</a> ';
                if ($user_id){
                    $htmlStr .= '
                        <a onclick="return UserCloseTab('.$tab_id.');" href="#"><img height="11" width="8" src="'.$this->image_url.'w3.png"/></a>';
                }
                $htmlStr .= '
                    </div>
                ';
            }
        }
        return $htmlStr;
    }
    
    public function getAddTabsInputs($tabs_map){
        $htmlStr = "";
        foreach ($tabs_map['selected_tabs'] as $tab){
            if ($tab['selected']) $checked = 'checked="checked"'; else $checked = '';
            $tab_id = $tab['id'];
            $tab_name = $tabs_map['main_tabs'][$tab_id]['name'];
            $htmlStr .= '<input name="tabInputs" type="checkbox" '.$checked.' value="'.$tab_id.'" id="manager_tab'.$tab_id.'"/> '.$tab_name.'<br/>';
        }
        return $htmlStr;
    }
    
    public function getTabsPages($tabs_map){
        $user = Project::getUser() -> getDbUser();
        $htmlStr = "";
        foreach ($tabs_map['selected_tabs'] as $tab){
                $tab_id = $tab['id'];
                $tab_name = $tabs_map['main_tabs'][$tab_id]['name'];
                switch ($tab_id){
                    case 0:
                        $htmlPage = $this->viewNewsPage($user->id);
                        break;
                    case 1:
                        $htmlPage = $this->viewArticlePage($user->id);
                        break;
                    case 2:
                        $htmlPage = $this->viewAlbumPage($user->id);
                        break;
                    case 3:
                        $htmlPage = $this->viewQuestionPage($user->id);
                        break;
                    default:
                        $htmlPage = "";
                        break;
                }
                $htmlStr .= '
                    <div id="page'.$tab_id.'" class="tab-page">
                    '.$htmlPage.'
                    </div>
                ';
        }
        return $htmlStr;
    }
    
    function viewNewsPage($user_id){
        $htmlPage = "";
        $user_id = (int)$user_id;
        
        $newsModel = new NewsModel();
        $newsView = new NewsView();
        $aNewsSubscribe = $newsModel -> getNewsSubscribeByUserId($user_id);
        if (!$aNewsSubscribe){
            $aNewsTree = $newsView -> getAllNewsTree();
            $isOnlySubscribeNewsTree = false;
        }else{
            $aNewsTree = $newsView -> getNewsTreeByListNewsSubscribe($aNewsSubscribe);
            $isOnlySubscribeNewsTree = true;
        }
        foreach ($aNewsTree as $newsTree){
           $newsCount = $newsView -> getNewsCountByNewsTreeId($newsTree['id'], $user_id, $isOnlySubscribeNewsTree);
           if ($newsCount < 1) continue;
           $htmlPage .= '
        	<!-- Категория -->
        	<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
        		<div class="block_title">
        			<div class="block_title_left">
        			   <h2>
        			   '.$newsView->ShowNewsTreeBreadCrumbByNewsTreeId($newsTree['id'], false).' (<a href="'.Project::getRequest()->createUrl('News', 'News', null, false).'/shownow:allnews/filterNewsTree:'.$newsTree['id'].'">все новости ['.$newsCount.']</a>)
        			   </h2>
        			</div>
        			<div class="block_title_right"><img src="'.$this -> image_url.'close.png" width="21" height="24" onclick="ShowOrHide(this, \'rss_cat_n'.$newsTree['id'].'\')" style="cursor: pointer;" /></div>
        		</div>
        		
        		<div id="rss_cat_n'.$newsTree['id'].'">'.
                   $newsView->ShowNewsListPreviewByNewsTreeId($newsTree['id'], 'full', $user_id, 4, array(), $isOnlySubscribeNewsTree).'
        		   <div class="rmb14"></div>
        		</div>
        
        	</div></div></div></div>
        	<!-- /Категория -->
           ';

       }
       return $htmlPage;
    }
    
    function viewArticlePage($user_id){
        $htmlPage = "";
        $user_id = (int)$user_id;
        $articleModel = new ArticleModel();
        $aLastArticles = $articleModel->getLastArticles(10);
        foreach ($aLastArticles as $article){
            $htmlPage .= '
                <div class="articles_t">
        			<h1><a href="'.Project::getRequest()->createUrl('Article', 'ArticleView').'/'.$article['id'].'">'.$article['title'].'</a></h1> <div id="micro"><img height="16" width="16" id="ico2" src="'.$this->image_url.'time.png"/> '.$article['creation_date'].'</div>
        		</div>
                <div class="articles_c">
    				<br/><p>'.$articleModel -> getNWordsFromText($article['page_text'], 100).'...</p>
    			</div>';
        }
            
        return $htmlPage;
    }
    
    
    function viewAlbumPage($user_id){
        $htmlPage = "";
        $user_id = (int)$user_id;
        $albumModel = new AlbumModel();
        $aAlbums = $albumModel->loadAll(0, 0);
        foreach ($aAlbums  as $key => $item){
            $imgSrc = ($item['thumbnail']===false)?$this -> image_url.'noimage.gif' :$this -> image_url.$item['thumbnail'];
            $htmlPage .= '
                <div class="photo_gallery">
				<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
					<div class="block_title">
                        <h2><a href="'.PhotoController::getAlbumUrl($item['id'], $item['login']).'">'.$item['name'].'</a></h2>
					</div>
					<div style="width: 140px; height: 112px; text-align: center;">
                        <a href="'.PhotoController::getAlbumUrl($item['id'], $item['login']).'"><img src="'.$imgSrc.'" /></a>
					</div>
					<div class="block_title2">
                        <a href="'.UserController::getProfileUrl($item['login']).'">'.$item['login'].'</a><br />
						<span id="micro">'.date("j F Y", strtotime($item['creation_date'])).'</span>
					</div>
				</div></div></div></div>
				</div>
            ';
        }
            
        return $htmlPage;
    }
    
    
    function viewQuestionPage($user_id){
        $htmlPage = '
                <table class="questions">
    			<tr>
    				<td style="width: 100%; text-align: left;"><b>Вопросы пользователей</b></td>
    				<td><b>Автор</b></td>
    				<!--<td><b>Ответов</b></td>-->
    				<td><b>Дата создания</b></td>
    			</tr>';
        $user_id = (int)$user_id;
        $questionModel = new QuestionModel();
        $aQuestions = $questionModel->loadWhere();
        foreach ($aQuestions  as $question){
            $htmlPage .= '
    			<tr id="cmod_tab2">
    				<td style="width: 100%; text-align: left;"><img height="14" width="14" id="ico2" src="'.$this->image_url.'faq.png"/> <a href="'.Project::getRequest()->createUrl('QuestionAnswer', 'ViewQuestion').'/'.$question['id'].'">'.$question['q_text'].'</a></td>
    				<td><a href="'.UserController::getProfileUrl($question['login']).'">'.$question['login'].'</a></td>
    				<!--<td>'.$question['a_count'].'</td>-->
    				<td>'.$question['creation_date'].'</td>
    			</tr>
            ';
        }
        $htmlPage .= '</table>';
            
        return $htmlPage;
    }
    
    // PAGE
	function Home(){
	    $this->_js_files[] = 'jquery.js';
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[] = 'jquery-ui.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[]='tabs_main.js';
	    $this->_css_files[] = 'tabs_main.css';
		$this -> setTemplate(null, 'home.tpl.php');
	}
	// END PAGE
	
	
	// AJAX
	
	function returnTabs($message){
	    $response = Project::getAjaxResponse();
	    $tabs_map = $message['tabs_map'];
	    $htmlTopTabs = $this->getTabsNames($tabs_map, $message['user_id']);
	    $htmlInputs = $this->getAddTabsInputs($tabs_map);
	    
		$response -> block('top_tabs', true, $htmlTopTabs);
		$response -> block('AddTabsInputs', true, $htmlInputs);
		$response -> runFunction('CloseAllTabs(1)');
	}
	// END AJAX
}
?>