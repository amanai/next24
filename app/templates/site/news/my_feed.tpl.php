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
					<div class="block_title"><h2>Список подключенных RSS лент</h2></div>
					
					<table cellpadding="5" border="1">
					<tr>
					   <th>Название RSS</th>
					   <th>URL</th>
					   <th>Тег<br />категории</th>
					   <th>Код баннера</th>
					   <th>Раздел</th>
					   <th>Преобразование<br />текста</th>
					   <th>&nbsp;</th>
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
                        $news_tree_state = ($newsTreeFeeds['news_tree_state'])?'active':'not moderated';
                        $feeds_state = ($newsTreeFeeds['feeds_state'])?'active':'not moderated';
                        $news_banners_state = ($newsTreeFeeds['news_banners_state'])?'active':'not moderated';
                        echo '
                        <tr>
    					   <td>'.$newsTreeFeeds['feeds_name'].'<br/><i><b>'.$feeds_state.'</b></i></td>
    					   <td>'.$newsTreeFeeds['url'].'</td>
    					   <td>'.$newsTreeFeeds['category_tag'].'</td>
    					   <td>'.htmlspecialchars($newsTreeFeeds['code']).'<br/><i><b>'.$news_banners_state.'</b></i></td>
    					   <td>'.$this->ShowNewsTreeBreadCrumbByNewsTreeId($newsTreeFeeds['news_tree_id']).'<br/><i><b>'.$news_tree_state.'</b></i></td>
    					   <td>'.$text_parse_type.'</td>
    					   <td><a href="'.$this->createUrl('News', 'ChangeFeed', null, false).'/news_tree_feeds_id:'.$newsTreeFeeds['news_tree_feeds_id'].'/">Change</a></td>
    					</tr>					
                        ';
                    }					
					?>
					</table>

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