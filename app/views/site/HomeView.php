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
            $htmlStr .= '<label><input name="tabInputs" type="checkbox" '.$checked.' value="'.$tab_id.'" id="manager_tab'.$tab_id.'"/> '.$tab_name.'</label><br/>';
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
        $htmlPage = '<ul class="content-preview-list">';
        foreach ($aNewsTree as $newsTree){
       /*    $newsCount = $newsView -> getNewsCountByNewsTreeId($newsTree['id'], $user_id, $isOnlySubscribeNewsTree);
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
        		</div>'; */
        $htmlPage .= '<li class="expanded-view">
						<h3><a href="#">МИД России: Тбилиси выдает желаемое за действительное <img src="assets/i/temp/temp.1.jpg" alt="МИД России: Тбилиси выдает желаемое за действительное" /></a></h3>
						<p>В Москве опровергают сообщения о том, что якобы минувшим днем российские войска в Южной Осетии вели огонь по грузинской территории... <a href="#">»</a></p>
						<div class="meta">
							<span class="auth">Вести.Ru</span>
							<span class="date">20 минут назад</span>
						</div>
					</li>';		
        /*		$htmlPage .= '<div id="rss_cat_n'.$newsTree['id'].'">'.
                   $newsView->ShowNewsListPreviewByNewsTreeId($newsTree['id'], 'full', $user_id, 4, array(), $isOnlySubscribeNewsTree).'
        		   <div class="rmb14"></div>
        		</div>
        
        	</div></div></div></div>
        	<!-- /Категория -->
           '; */

       }
       $htmlPage .= '</ul>';
       return $htmlPage;
    }
    
    function viewArticlePage($user_id){
        $htmlPage = "";
        $user_id = (int)$user_id;
        $articleModel = new ArticleModel();
        $aLastArticles = $articleModel->getLastArticles(10);
        $htmlPage = '<ul class="content-preview-list articles-preview-list">';
        foreach ($aLastArticles as $article){
      /*      $htmlPage .= '
                <div class="articles_t">
        			<h1><a href="'.Project::getRequest()->createUrl('Article', 'ArticleView').'/'.$article['id'].'">'.$article['title'].'</a></h1> <div id="micro"><img height="16" width="16" id="ico2" src="'.$this->image_url.'time.png"/> '.$article['creation_date'].'</div>
        		</div>
                <div class="articles_c">
    				<br/><p>'.$articleModel -> getNWordsFromText($article['page_text'], 100).'</p>
    			</div>'; */
            $htmlPage .= '<li class="expanded-view">
							<h3><a href="'.Project::getRequest()->createUrl('Article', 'ArticleView').'/'.$article['id'].'">'.$article['title'].' <img src="'.$this->image_url.'time.png" alt="'.$article['title'].'" /></a></h3>
							<p>'.$articleModel -> getNWordsFromText($article['page_text'], 100).' <a href="'.Project::getRequest()->createUrl('Article', 'ArticleView').'/'.$article['id'].'">»</a></p>
							<div class="meta">
								<span class="auth">Вести.Ru</span>
								<span class="date">'.$article['creation_date'].' минут назад</span>
							</div>
						</li>';
        }
        $htmlPage .= '</ul>';    
        return $htmlPage;
    }
    
    
    function viewAlbumPage($user_id){
        $htmlPage = "";
        $user_id = (int)$user_id;
        $albumModel = new AlbumModel();
        $aAlbums = $albumModel->loadAll(0, 0);
        $htmlPage = '<ul class="foto-preview-list clearfix">';
        foreach ($aAlbums  as $key => $item){
        	$dir = '/users/'.$item['login'].'/album'.'/thumbs/';
        	
            $imgSrc = (!$item['thumbnail'])?$this -> image_url.'noimage.gif' :$dir.$item['thumbnail'];
            $htmlPage .= '<li>
							<dl>
								<dt><a href="'.PhotoController::getAlbumUrl($item['id'], $item['login']).'"><img src="'.$imgSrc.'" alt="" /></a></dt>
								<dd class="auth"><a href="'.UserController::getProfileUrl($item['login']).'" class="with-icon-s"><i class="icon-s user-icon"></i>'.$item['login'].'</a></dd>
								<dd><a href="'.PhotoController::getAlbumUrl($item['id'], $item['login']).'" class="with-icon-s"><i class="icon-s category-icon"></i>'.$item['name'].'</a> (14)</dd>
							</dl>
						</li>';
       /*     $htmlPage .= '
                <div class="photo_gallery">
				<div class="block_ee1" style="width: 170px;"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
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
            '; */
        }
        $htmlPage .= '</ul>';    
        return $htmlPage;
    }
    
    
    function viewQuestionPage($user_id){
    /*    $htmlPage = '
                <table class="questions">
    			<tr>
    				<td style="width: 100%; text-align: left;"><b>Вопросы пользователей</b></td>
    				<td><b>Автор</b></td>
    				<!--<td><b>Ответов</b></td>-->
    				<td><b>Дата создания</b></td>
    			</tr>'; */
        $user_id = (int)$user_id;
        $questionModel = new QuestionModel();
        $aQuestions = $questionModel->loadWhere();
        $htmlPage = '<ul class="question-preview-list clearfix">';
        foreach ($aQuestions  as $question){
        /*    $htmlPage .= '
    			<tr id="cmod_tab2">
    				<td style="width: 100%; text-align: left;"><img height="14" width="14" id="ico2" src="'.$this->image_url.'faq.png"/> <a href="'.Project::getRequest()->createUrl('QuestionAnswer', 'ViewQuestion').'/'.$question['id'].'">'.$question['q_text'].'</a></td>
    				<td><a href="'.UserController::getProfileUrl($question['login']).'">'.$question['login'].'</a></td>
    				<!--<td>'.$question['a_count'].'</td>-->
    				<td>'.$question['creation_date'].'</td>
    			</tr>
            '; */
            $htmlPage .= '<li>
							<dl>
								<dt><a href="'.UserController::getProfileUrl($question['login']).'" class="with-icon-s"><i class="icon-s user-icon"></i>'.$question['login'].'</a> спрашивает</dt>
								<dd class="question"><a href="'.Project::getRequest()->createUrl('QuestionAnswer', 'ViewQuestion').'/'.$question['id'].'">'.$question['q_text'].'</a></dd>
								<dd class="reply"><a href="'.Project::getRequest()->createUrl('QuestionAnswer', 'ViewQuestion').'/'.$question['id'].'">'.$question['a_count'].' ответов</a></dd>
							</dl>
						</li>';
        }
    //    $htmlPage .= '</table>';
        $htmlPage .= '</ul>';    
        return $htmlPage;
    }
    
    // PAGE
	function Home(){
	    $this->_js_files[]='blockUI.js';
	  //  $this->_js_files[] = 'jquery-ui.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[]='tabs_main.js';
	    $this->_css_files[] = 'tabs_main.css';
		$this -> setTemplate(null, 'home.tpl.php');
	}
	function HomeBlank(){
	    $this->_js_files[]='blockUI.js';
	  //  $this->_js_files[] = 'jquery-ui.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[]='tabs_main.js';
	    $this->_css_files[] = 'tabs_main.css';
		$this -> setTemplate(null, 'home_blank.tpl.php');
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
	public function ViewArticle($data) {
		$this->setTemplate(null, 'view_article.tpl.php');
		$this->set($data);
	}
	
/*	public function UserArticleList($data) {
		$this->setTemplate(null, 'user_article_list.tpl.php');
		$this->set($data);
	}
*/	
	public function CompetitionArticleList($data) {
		$this->setTemplate(null, 'competition.tpl.php');
		$this->set($data);
	}
	
	public function AddSubject($data) {
		$this->setTemplate(null, 'add_subject.tpl.php');
		$this->set($data);
	}
	
	public function LastWinnersList($data) {
		$this->setTemplate(null, 'last_winners_list.tpl.php');
		$this->set($data);
	}
	public function getCountFriendInGroups($user_id, $group_id) {
		$friendModel = new FriendModel();
		$aFirends = $friendModel->getFriendsInGroup($user_id, $group_id);
		return count($aFirends);
	}
	
	public function showFriendsInGroup($user_id, $group_id){
	    $friendModel = new FriendModel();
	    $aFirends = $friendModel->getFriendsInGroup($user_id, $group_id);
	    $htmlStr = "";
	    $counter = count($aFirends);
	    $i = 1;
	    foreach ($aFirends as $friend){   
	        $htmlStr .= '<dd class="friend-list-dd '.(($counter==$i)?'last':'').'">
							<a class="nm" href="'.Project::getRequest() -> createUrl('User', 'Profile', null, $friend['login']).'">'.$friend['login'].'<img src="assets/i/temp/avatar.s.jpg" class="avatar" alt="" /></a>
							<span class="memo">( <span>Заметка</span>: '.$friend['note'].' )</span>
							<div class="act">
	               				<form name="editForm" method="post" action="'.Project::getRequest() -> createUrl('Messages','Friend').'">
	               					<input type="hidden" value="changeFriend" name="messageAction" />
	               					<input type="hidden" value="'.$friend['id'].'" name="friend_table_id"/>
	               					<a onclick="this.parentNode.submit(); return false;" href="#">редактировать</a>
	               				</form>													
							</div>
						</dd>';	 
	        $i++;       
	    }
	    return $htmlStr;
	}
	
	/**
     *  Pages VIEW
     *
     */
	
    function MyMessagesPage(){
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'messages.js';
	    $this -> setTemplate(null, 'my_messages.tpl.php');
	}
	
    function SendMessagePage(){
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'messages.js';
	    $this -> setTemplate(null, 'send_message.tpl.php');
	}
	
    function CorrespondenceWithPage(){
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[] = 'messages.js';
	    $this -> setTemplate(null, 'correspondence_with.tpl.php');
	}
	
	
	function FriendPage(){
	    $this -> setTemplate(null, 'friend_manager.tpl.php');
	}

	/**
     * END Pages VIEW
     *
     */

	
	/**
     * AJAX Functions
     *
     */
	
	function returnFolderMessages($message){
		$response = Project::getAjaxResponse();
		$htmlMess = ""; $i = 1;
		foreach ($message['aMessages'] as $userMessage){
		    if ($i/2 == 1){$i = 1;} else {$i++;}
		    if ($userMessage['avatars_id']){
		        if ($userMessage['sys_av_id']){
		            $avPath = $userMessage['sys_av_path'];
		        }else{
		            $avPath = $userMessage['avatars_path'];
		        }
		        $avName = $userMessage['avatars_av_name'];
		    }else {
		        $avPath = 'no.png';
		        $avName = 'no image';
		    }
		    if (!$userMessage['is_read']) $sIsRead = ' - <span id="red">Новое</span>';
		    else $sIsRead = '';
		    $htmlMess .= '
		    <div class="cmod_tab'.$i.'">
				<table class="cmod_x">
				<tr>
					<td class="cmod_x1" rowspan="2">
						<h2><a href="'.Project::getRequest() -> createUrl('User', 'Profile', null, $userMessage['author_login']).'">'.$userMessage['author_login'].'</a></h2>
						<div class="av_preview"><img src="'.$this->image_url.'avatar/'.$avPath.'" alt="'.$avName.'" style="margin: 5px;"/></div>
					</td>
					<td class="cmod_x2a" rowspan="2">
						<p>'.$userMessage['send_date'].$sIsRead.'</p>
						<h3>'.$userMessage['header'].'</h3><br/>
						'.$userMessage['m_text'].'
					</td>
					<td class="cmod_x4">
					   <a onclick="return DelMessage('.$userMessage['messages_id'].', '.(int)$message['current_page'].', '.(int)$message['groupId'].', \''.$message['groupName'].'\');" href="javascript: void(0);">удалить</a>
					</td>
				</tr>
				<tr>
				    <td class="cmod_x3">
						<a href="'.Project::getRequest() -> createUrl('Messages', 'SendMessage').'/message_action:reply/mess_id:'.$userMessage['id'].'"><b>написать сообщение</b></a>  |  
						<a href="'.Project::getRequest() -> createUrl('Messages', 'CorrespondenceWith').'/corr_user_id:'.$userMessage['author_id'].'"><b>читать переписку</b></a><br/>
					</td>
				</tr>
				</table>
			</div>
		    
    	    ';
		}
		if (!$htmlMess) $htmlMess = "В данной группе нет писем";
		
		$response -> block('cmod_messages', true, $htmlMess);
		$response -> block('titleGroupName', true, $message['groupName']);
		$response -> block('total_mesall', true, '(<font class="red">'.$message['messageCountAll']['new'].'</font>/'.$message['messageCountAll']['read'].')');
		$response -> block('total_mes'.$message['groupId'], true, '(<font class="red">'.$message['messageCountGroup']['new'].'</font>/'.$message['messageCountGroup']['read'].')');
		$response -> block('myMessagePager', true, $message['myMessagePager']);
		
	}
	
	function returnCorrespondentPage($message){
	    $response = Project::getAjaxResponse();
	    $htmlMess=""; $i = 1;
		foreach ($message['aMessages'] as $userMessage){
		    if ($i/2 == 1){$i = 1;} else {$i++;}
		    $htmlMess .= '
		    <div class="cmod_tab'.$i.'">
				<h3>'.$userMessage['author_login'].'</h3>,  <h3>'.$userMessage['header'].'</h3>,  '.$userMessage['send_date'].'  
				
				';
			    if ($userMessage['author_id'] != $this->user_id){
					$htmlMess .= '
					<a href="'.Project::getRequest() -> createUrl('Messages', 'SendMessage').'/message_action:reply/mess_id:'.$userMessage['id'].'"><b>написать сообщение</b></a> | 
            		<a onclick="return DelMessageCorrespondence('.$userMessage['messages_id'].', '.$message['corr_user_id'].');" href="javascript: void(0);"><b>удалить</b></a>';
			    }
			$htmlMess .= '
				<p>
					'.$userMessage['m_text'].'
				</p>
			</div>';
		}
		$response -> block('cmod_messages', true, $htmlMess);
	}		
}
?>