<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../profile_line.tpl.php')); ?>	


				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
			<!--  			<ul class="view-filter clearfix">
							<?php include($this -> _include('../tab_panel.tpl.php')); ?>
						</ul>	-->
						<!-- /view-filter -->
						<div class="display-filter clearfix">
							<div class="number-filter">
								показывать по: <strong>10</strong> | <a href="#">20</a> | <a href="#">30</a> элементов
							</div>
						</div>
						<!-- /display-filter -->
						<div class="rss-view">
						<table>
							<thead>
								<tr>
									<th>Название RSS</th>
									<th>URL</th>
									<th>Тег категории</th>
									<? if ($this->is_partner) { ?>
									<th>Код баннера</th>
									<? } ?>
									<th>Раздел</th>
									<th>Добавил</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
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
        					   <td class="name"><a href="'.$newsTreeFeeds['url'].'">'.$newsTreeFeeds['feeds_name'].'</a><span class="status">статус: <span class="active list_status" id="feeds'.$newsTreeFeeds['feed_id'].'">'.$feeds_state.'</span></span>';
                            //<div class="list_status" id="feeds'.$newsTreeFeeds['feed_id'].'">'.$feeds_state.'</div>
        					if ($this -> isAdmin){
        				        echo '<span class="act">[ <a onclick=\'
            				        document.getElementById("feeds'.$newsTreeFeeds['feed_id'].'").innerHTML="<img src='.$this -> image_url.'loader2.gif >";
            				        ajax
            				        ('.
            				        AjaxRequest::getJsonParam("News", "ChangeState", array("id"=>$newsTreeFeeds['feed_id'], "element"=>"feeds"), "POST").', true
            				        );
            				        \' href="javascript: void(0);">
                                    изменить статус</a> ]</span>';
        				    }    				    
        				    echo '   
        					   </td>
        					   <td class="url"><a href="'.$newsTreeFeeds['url'].'">'.$newsTreeFeeds['url'].'</a></td>
        					   <td class="tag">'.(($newsTreeFeeds['category_tag'])?$newsTreeFeeds['category_tag']:'---').'</td>';
if ($this->is_partner) {
        					echo ' <td class="ban">';
        				    if ($newsTreeFeeds['news_banner_id']){ // we have a banner
        				        echo '
        					       <a href="javascript:void(0);" class="show_banner">Скрыть</a><div class="code banner_code">'.htmlspecialchars($newsTreeFeeds['code']).'</div><span class="status">статус: <span class="no-active list_status" id="news_banners'.$newsTreeFeeds['news_banner_id'].'">'.$news_banners_state.'</span></span>';
        				        if ($this -> isAdmin){
        				        echo '<span class="act">[ <a onclick=\'
            				        document.getElementById("news_banners'.$newsTreeFeeds['news_banner_id'].'").innerHTML="<img src='.$this -> image_url.'loader2.gif >";
            				        ajax
            				        ('.
            				        AjaxRequest::getJsonParam("News", "ChangeState", array("id"=>$newsTreeFeeds['news_banner_id'], "element"=>"news_banners"), "POST").', true
            				        );
            				        \' href="javascript: void(0);">
                                    изменить статус</a> ]</span>';
        				        }
        				    }else{ // no banners in this RSS
        				        echo 'нет кода баннера';
        				    }
        				    echo '
        					   </td>';
}
        					  echo ' <td class="section">'.$this->ShowNewsTreeBreadCrumbByNewsTreeId($newsTreeFeeds['news_tree_id']).'<span class="status active list_status" id="news_tree'.$newsTreeFeeds['news_tree_id'].'">'.$news_tree_state.'</span>';
        				    echo '
        					   </td>
        					   
        					   <td class="who"><a href="'.$this->createUrl('User', 'Profile', null, $newsTreeFeeds['user_login']).'">'.$newsTreeFeeds['user_login'].'</a><span class="status">['.$is_partner.']</span></td>
        					   <td class="action">
									<a href="'.$this->createUrl('News', 'ChangeFeed', null, false).'/news_tree_feeds_id:'.$newsTreeFeeds['news_tree_feeds_id'].'/" title="Редактировать" class="func"><i class="icon edit-icon"></i></a>
									<a href="#" title="Удалить" class="func"><i class="icon delete-icon"></i></a>        					   
        					   </td>
        					</tr>					
                            ';
                        }					
    					?>
							</tbody>
						</table>
						</div>
						<!-- /rss-view -->
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<div class="user-action">
							<ul>
								<li><a href="<?=$this->createUrl('News', 'MyFeeds', null, false)?>"><i class="icon rss-icon"></i>Мои RSS-ленты</a></li>
								<li><a href="<?=$this->createUrl('News', 'AddFeed', null, false)?>"><i class="icon rss-add-icon"></i>Добавить RSS-ленту</a></li>
								<li><a href="<?=$this->createUrl('News', 'AddNewsTree', null, false)?>"><i class="icon cat-add-icon"></i>Добавить Каталог</a></li>
								<li><a href="<?=$this->createUrl('News', 'ModerateFeeds', null, false)?>"><i class="icon rss-set-icon"></i>Настройка RSS-лент</a></li>
								<li><a href="<?=$this->createUrl('News', 'ModerateNewsTree', null, false)?>"><i class="icon cat-set-icon"></i>Настройка Каталога</a></li>
							</ul>
						</div>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>