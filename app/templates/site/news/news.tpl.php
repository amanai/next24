<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	
	<div class="tab-page tab-page-selected">
	<table width="100%" height="100%" cellpadding="0">
	<tr>
		<td class="next24u_left">
			<!-- левый блок -->

				<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
					<div class="block_title"><h2>Отображать каналы RSS</h2></div>
					
					<form action="<?php echo $this->createUrl('News', 'SubscribeNews', null, false); ?>" method="POST">
					<ul class="checkbox_tree">
                        <?php 
                        $aLeafs = $this->getAllLeafs($this->news_list);
                        $this->BuildTree($aLeafs, $this->news_list, 0, $this->aNewsSubscribe); echo $this->_htmlTree; 
                        ?>
                    </ul>
                    <input type="submit" name="subscribe" value="Подписаться на новости" />
                    </form>
					

				</div></div></div></div>


				<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
					<div class="block_title"><h2>Вид отображения</h2></div>
					<div class="rss_cat">
						 <a href="<?php echo $this->createUrl('News', 'News', null, false); ?>/view:full/" class="<?php echo $this -> viewCheckedClass[0]; ?>" >Полный список новостей</a><br />
						 <a href="<?php echo $this->createUrl('News', 'News', null, false); ?>/view:report/" class="<?php echo $this -> viewCheckedClass[1]; ?>">Сводка новостей</a><br />
						 <br />
						 <a href="<?php echo $this->createUrl('News', 'News', null, false); ?>/view:news_all/" class="<?php echo $this -> viewFilterCheckedClass[0]; ?>">Все новости</a><br />
						 <a href="<?php echo $this->createUrl('News', 'News', null, false); ?>/view:news_subscribe/" class="<?php echo $this -> viewFilterCheckedClass[1]; ?>">Только подписка</a><br />
						 <a href="<?php echo $this->createUrl('News', 'News', null, false); ?>/view:news_stared/" class="<?php echo $this -> viewFilterCheckedClass[2]; ?>">Только избранное</a>
					</div>
				</div></div></div></div>
				
				<?php if ($this->isPartner || $this->isAdmin){ ?>
				<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
					<div class="block_title"><h2>Управление</h2></div>
					<div class="rss_cat">
						 <a href="<?php echo $this->createUrl('News', 'AddFeed', null, false); ?>" >Добавить RSS-ленту</a>
					</div>
				</div></div></div></div>
				<?php } ?>

			<!-- /левый блок -->

		</td>
		<td class="next24u_right">


           <?php 
	       if ($this -> isShowOneNews){ // одна новость
	       ?>  
	         <!-- Одна новость -->
			<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
				<div class="block_title">
					<div class="block_title_left">
					   <h2>
					       <?php 
				           echo $this->news['news_title'];
					       ?>
					   </h2>
					</div>
					<div class="block_title_right"><img src="<?php echo $this -> image_url;?>close.png" align="left" width="21" height="24" onclick="ShowOrHide(this, 'rss_cat_n1')" style="cursor: pointer;" /></div>
				</div>
				
				<div id="rss_cat_n1">
				    <?php 
		           if (strpos($this->news['enclosure_type'], "image") !== false){
		               echo '<img src="'.$this->news['enclosure'].'">';
		           }
		           echo $this->news['news_full_text'];
		           if ($this->news['code']){
		               echo "<hr>".$this->news['code'];
		           }
			       ?>
					<div class="rmb14"></div>

				</div>

			</div></div></div></div>
			<!-- /Одна новость -->
	       <?php    
	       }else{ // много категорий
	           if ($this->filterNewsTreeFeeds){ // filter by news_tree_feeds_ID
	               $newsCount = $this -> getNewsCountByNewsTreeFeedsId($this->filterNewsTreeFeeds);
	       ?>
	           <!-- Категория -->
    			<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
    				<div class="block_title">
    					<div class="block_title_left">
    					   <h2>
    					   <?php echo $this->ShowNewsTreeBreadCrumbByNewsTreeFeedsId($this->filterNewsTreeFeeds, false); ?> (<a href="<?php echo $this->createUrl('News', 'News', null, false); ?>">все новости [<?php echo $newsCount; ?>]</a>)
    					   </h2>
    					</div>
    					<div class="block_title_right"><img src="<?php echo $this -> image_url;?>close.png" align="left" width="21" height="24" onclick="ShowOrHide(this, 'rss_cat_n<?php echo $this->filterNewsTreeFeeds;?>')" style="cursor: pointer;" /></div>
    				</div>
    				
    				<div id="rss_cat_n<?php echo $this->filterNewsTreeFeeds;?>">
    				   <?php 
    		           echo $this->ShowNewsListPreviewByNewsTreeFeedsId($this->filterNewsTreeFeeds, $this->newsViewType);
    			       ?>
    					<div class="rmb14"></div>
    
    				</div>
    
    			</div></div></div></div>
    			<!-- /Категория -->
	       <?php
	           }else{ // NO filter by news_tree_feeds_ID
    	           $aNewsTree = $this -> getNewsTreeByListNewsSubscribe($this->aNewsSubscribe);
    	           foreach ($aNewsTree as $newsTree){
    	               if ($this->filterNewsTree){
    	                   $aNewsTreeChildren = $this -> getNewsTreeChildren($this->filterNewsTree);
    	                   if ($newsTree['id'] != $this->filterNewsTree && !$this -> isChild($aNewsTreeChildren, $newsTree['id'])) continue;
    	               }
    	               $newsCount = $this -> getNewsCountByNewsTreeId($newsTree['id'], $this->user_id);
    	               if ($newsCount < 1) continue;
    	               
    	   ?>
    			<!-- Категория -->
    			<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
    				<div class="block_title">
    					<div class="block_title_left">
    					   <h2>
    					   <?php echo $this->ShowNewsTreeBreadCrumbByNewsTreeId($newsTree['id'], false); ?> (<a href="<?php echo $this->createUrl('News', 'News', null, false); ?>">все новости [<?php echo $newsCount; ?>]</a>)
    					   </h2>
    					</div>
    					<div class="block_title_right"><img src="<?php echo $this -> image_url;?>close.png" align="left" width="21" height="24" onclick="ShowOrHide(this, 'rss_cat_n<?php echo $newsTree['id'];?>')" style="cursor: pointer;" /></div>
    				</div>
    				
    				<div id="rss_cat_n<?php echo $newsTree['id'];?>">
    				   <?php 
    		           echo $this->ShowNewsListPreviewByNewsTreeId($newsTree['id'], $this->newsViewType, $this->user_id);
    			       ?>
    					<div class="rmb14"></div>
    
    				</div>
    
    			</div></div></div></div>
    			<!-- /Категория -->
    	   <?php
    	           }
	           }    
	       }
		   ?>

		</td>
	</tr>
	</table>
		
	</div>

</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>