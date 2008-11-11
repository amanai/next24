<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	
	<div class="tab-page tab-page-selected">
	
	<form name="frmFeeds" action="" method="POST">
	<input type="hidden" name="frmAction" value="add">
	<table width="100%" height="100%" cellpadding="0">
	<tr>
		<td class="next24u_left">
			<!-- левый блок -->

				<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
					<div class="block_title"><h2>Список подключенных RSS-лент</h2></div>
					
					
                    
                    <div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
                        <table class="questions">
                         <tbody><tr>
                          <td><b>Название RSS</b></td>
                          <td><b>URL</b></td>
                          <td><b>Тег<br />категории</b></td>
                          <td><b>Код баннера</b></td>
                          <td><b>Раздел</b></td>
                         
                          <td><b>Добавил</b></td>
                         </tr>
                         <?php 
                    
                        foreach ($this->aListNewsTreeFeeds as $newsTreeFeeds){
                            switch ($newsTreeFeeds['text_parse_type']){
                                case 1:
                                    $text_parse_type = 'htmlspecialchars';
                                    break;
                                case 2:
                                    $text_parse_type = 'не изменяется';
                                    break;
                                default:
                                    $text_parse_type = 'strip_tags';
                                    break;
                            }
                            $news_tree_state = ($newsTreeFeeds['news_tree_state'])?'активный':'не провереннный';
                            $feeds_state = ($newsTreeFeeds['feeds_state'])?'активный':'не провереннный';
                            $news_banners_state = ($newsTreeFeeds['news_banners_state'])?'активный':'не провереннный';
                            $is_partner = ($newsTreeFeeds['is_partner'])?'партнер':'пользователь';
                            echo '
                            <tr id="cmod_tab2">
        					   <td>'.$newsTreeFeeds['feeds_name'].'<div class="list_status" id="feeds'.$newsTreeFeeds['feed_id'].'">'.$feeds_state.'</div>';
        					if ($this -> isAdmin){
        				        echo '<a onclick=\'
            				        document.getElementById("feeds'.$newsTreeFeeds['feed_id'].'").innerHTML="<img src='.$this -> image_url.'loader2.gif >";
            				        ajax
            				        ('.
            				        AjaxRequest::getJsonParam("News", "ChangeState", array("id"=>$newsTreeFeeds['feed_id'], "element"=>"feeds"), "POST").', true
            				        );
            				        \' href="javascript: void(0);">
                                    Изменить статус</a>';
        				    }    				    
        				    echo '   
        					   </td>
        					   <td>'.$newsTreeFeeds['url'].'</td>
        					   <td>'.$newsTreeFeeds['category_tag'].'</td>
        					   <td>';
        				    if ($newsTreeFeeds['news_banner_id']){ // we have a banner
        				        echo '
        					       <a href="javascript:void(0);" class="show_banner">Показать код баннера</a><div class="banner_code"><pre>'.htmlspecialchars($newsTreeFeeds['code']).'</pre></div><div class="list_status" id="news_banners'.$newsTreeFeeds['news_banner_id'].'">'.$news_banners_state.'</div>';
        				        if ($this -> isAdmin){
        				        echo '<a onclick=\'
            				        document.getElementById("news_banners'.$newsTreeFeeds['news_banner_id'].'").innerHTML="<img src='.$this -> image_url.'loader2.gif >";
            				        ajax
            				        ('.
            				        AjaxRequest::getJsonParam("News", "ChangeState", array("id"=>$newsTreeFeeds['news_banner_id'], "element"=>"news_banners"), "POST").', true
            				        );
            				        \' href="javascript: void(0);">
                                    Изменить статус</a>';
        				        }
        				    }else{ // no banners in this RSS
        				        echo 'нет кода баннера';
        				    }
        				    echo '
        					   </td>
        					   <td>'.$this->ShowNewsTreeBreadCrumbByNewsTreeId($newsTreeFeeds['news_tree_id']).'<div class="list_status" id="news_tree'.$newsTreeFeeds['news_tree_id'].'">'.$news_tree_state.'</div>';
        				    echo '
        					   </td>
        					   
        					   <td><a href="'.$this->createUrl('User', 'Profile', null, $newsTreeFeeds['user_login']).'">'.$newsTreeFeeds['user_login'].'</a> ['.$is_partner.']</td>
        					   <td><a href="'.$this->createUrl('News', 'ChangeFeed', null, false).'/news_tree_feeds_id:'.$newsTreeFeeds['news_tree_feeds_id'].'/">Change</a></td>
        					</tr>					
                            ';
                        }					
    					?>
                         </tbody></table>

                    </div></div></div></div>

				</div></div></div></div>
				           
			<!-- /левый блок -->

		
		</td>
	</tr>
	</table>
	</form>
		
	</div>

</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>