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
				    <?=$this -> flash_messages; ?>
					<div class="block_title"><h2>Список всех RSS-лент</h2></div>
					
					<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
                      <form action="" method="post" name="frm_find">
                      <input type="hidden" value="find" name="1"/>
                      <table>
                      <tr>
                        <td valign="top"><b>Модерация</b>:</td>
                        <td valign="top">
                            <input type="checkbox" value="1" name="banner_state" <?php if ($this->banner_state) echo "checked"; ?> /> Не проверенные баннеры;<br />
                            <input type="checkbox" value="1" name="feeds_state" <?php if ($this->feeds_state) echo "checked"; ?> /> Не проверенные RSS-ленты
                        </td>
                      </tr><tr>  
                        <td valign="top"><b>Источник</b>:</td>
                        <td valign="top">
                            <input type="radio" name="feed_is_partner" value="2" <?php if ($this->feed_is_partner==2) echo "checked"; ?>  /> Партнер<br />
                            <input type="radio" name="feed_is_partner" value="1" <?php if ($this->feed_is_partner==1) echo "checked"; ?>  /> Пользователь<br />
                            <input type="radio" name="feed_is_partner" value="0" <?php if ($this->feed_is_partner==0) echo "checked"; ?>  /> Все
                        </td>
                      </tr><tr>  
                        <td valign="top"><b>Логин автора</b>:</td>
                        <td valign="top">
                            <input type="text" name="user_login" value="<?php echo $this->user_login; ?>" />
                        </td>
                      </tr><tr>  
                        <td valign="middle" align="center" colspan="2"><input type="submit" value="искать" name="btn_find"/></td>
                      </tr>
                      </table>  
                      </form>
                    </div></div></div></div>
                    
                    <div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
                        <table class="questions">
                         <tbody><tr>
                          <td><b>Название RSS</b></td>
                          <td><b>URL</b></td>
                          <td><b>Тег<br />категории</b></td>
                          <td><b>Код баннера</b></td>
                          <td><b>Раздел</b></td>
                          <td><b>Преобразование<br />текста</b></td>
                          <td><b>Добавил</b></td>
                         </tr>
                         <?php 
                        $i=1;
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
                            if ($i/2 == 1){$i=1; $tr_id="cmod_tab1";}else {$i++; $tr_id="cmod_tab2";}
                            echo '
                            <tr id="'.$tr_id.'">
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
        					   <td>'.$text_parse_type.'</td>
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