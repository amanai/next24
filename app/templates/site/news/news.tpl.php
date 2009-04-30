<?php include($this -> _include('../header.tpl.php')); ?>
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<ul class="view-filter clearfix">
							<?php include($this -> _include('../tab_panel.tpl.php')); ?>
						</ul>
						<!-- /view-filter -->
						<div class="display-filter clearfix">
							<div class="number-filter">
								показывать по: <strong>10</strong> | <a href="#">20</a> | <a href="#">30</a> ответов
							</div>
							<?php if (!$this -> isShowOneNews){ // не одна новость ?> 
							<?php if ($this->shownow != "allnews"){ ?>
								<div class="type-filter">
									отображать: <a href="<?php echo $this->createUrl('News', 'News', null, false); ?>/view:full/">списком</a> | <a href="<?php echo $this->createUrl('News', 'News', null, false); ?>/view:report/">сводкой</a>
								</div>							
							<?php } ?>
							<?php } ?>							
						</div>
						<!-- /display-filter -->					 
						<div class="blog-table">
						<?php if ($this -> isShowOneNews){ // одна новость ?> 
							<div class="section">
								<div class="title clearfix">
									<h2>								
										<a href="#"><?php $tmp = $this->ShowNewsTreeBreadCrumbByNewsTreeId($this->news['news_tree_id'], true); echo substr($tmp,0,strpos($tmp,'»'));?></a>
									</h2>
								<!-- 	<p><a href="#">157 категорий</a> <span class="spr">|</span> <a href="#">2567 новостей</a> в этом разделе</p> -->
								</div>
								<div class="holder clearfix">
									<ul class="short-view">
										<li></li>
									</ul>
									<div class="full-view">
										<h3>
											<a href="#">
												<?=$this->news['news_title']; ?>
												<?php 
												 if ($this->news['favorite_news_id']) { 
												 	$star_class = 'class="star-icon full-star"';
												 	echo '<i class="star-icon full-star"></i>';
												 }
												 else {
												 	$star_class = 'class="star-icon empty-star"';
													echo '<i class="star-icon empty-star"></i>';
												 }													
												if ($this->user_id){
    				           						echo '<a onclick=\'ajax('.AjaxRequest::getJsonParam("News", "ChangeNewsFavorite", array("news_id"=>$this->news['news_id'], "imgUrl"=>$this -> image_url), "POST").', true);
        				        					\' href="javascript: void(0);"><i '.$star_class.' id="imgstar'.$this->news['news_id'].'"></i></a>';												 			
												 } else { 
												 	echo '<i '.$star_class.'></i>';												 												 	
												}
												//<img src="'.$this -> image_url.$starGif.'" id="imgstar'.$this->news['news_id'].'">
												?>
											</a>
										</h3>
										<div class="breadcrumbs">
											<?php echo $this->ShowNewsTreeBreadCrumbByNewsTreeId($this->news['news_tree_id'], true); ?>
										</div>
										<!-- <a href="#"><img src="assets/i/temp/temp.5.jpg" alt="Что же в имени твоем! 3.0D" /></a> -->
										<p>
											<?php echo $this->news['news_full_text'];?>
										</p>
										<?php echo $this->news['pub_date']; ?>
										<?php echo $this->news['feeds_name']; ?>
		          						<?php if ($this->news['code']){
		               						echo '<div class="news_banner">'.$this->news['code'].'</div>';
		           						} ?>										
										<!-- <div class="more"><a href="#">читать дальше</a> &rarr;</div>  -->
									</div>
								</div>
							</div>
							<!-- /section -->						
	       				<?php }else{ // много категорий
	          				switch ($this->newsViewFilter){ // Filter options
	               				case 'news_all':
	                   				$aNewsTree = $this -> getAllNewsTree();
	                   				$isOnlyFavoriteNews = false;
	                   				$isOnlySubscribeNewsTree = false;
	                   			break;
	               				case 'news_subscribe':
	                   				$aNewsTree = $this -> getNewsTreeByListNewsSubscribe($this->aNewsSubscribe);
	                   				$isOnlyFavoriteNews = false;
	                   				$isOnlySubscribeNewsTree = true;
	                   			break;
	               				case 'news_stared':
	                   				$aNewsTree = $this -> getNewsTreeByUserFavorite($this->user_id);
	                   				$isOnlyFavoriteNews = true;
	                   				$isOnlySubscribeNewsTree = false;
	                   			break;
	           				}           
	           				$isShowSomeNews = false;           
	           				if ($this->filterNewsTreeFeeds){ // filter by news_tree_feeds_ID
	               				$newsCount = $this -> getNewsCountByNewsTreeFeedsId($this->filterNewsTreeFeeds, $this->user_id, $isOnlySubscribeNewsTree, $isOnlyFavoriteNews);
	               				if ($newsCount){
	                   				$isShowSomeNews=true;
	       					?>
							<div class="section">
					<!-- 		<?php echo $this->ShowNewsTreeBreadCrumbByNewsTreeFeedsId($this->filterNewsTreeFeeds, false); if ($this->shownow != "allnews"){?> (<a href="<?php echo $this->createUrl('News', 'News', null, false)."/shownow:allnews/filterNewsTreeFeeds:".$this->filterNewsTreeFeeds; ?>">все новости [<?php echo $newsCount; ?>]</a>)<?php } ?> -->
								<div class="title clearfix">
									<h2><a href="#"><?php $tmp = $this->ShowNewsTreeBreadCrumbByNewsTreeFeedsId($this->filterNewsTreeFeeds, true); echo substr($tmp,0,strpos($tmp,'»')); echo '( '.substr($tmp,2+(-1)*(strlen($tmp)-strpos($tmp,'->'))).' )';?></a></h2>
									<p>
									<!-- <a href="#">157 категорий</a> 
										<span class="spr">|</span>  -->
											<?php if ($this->shownow != "allnews"){?> 
												<a href="<?php echo $this->createUrl('News', 'News', null, false)."/shownow:allnews/filterNewsTreeFeeds:".$this->filterNewsTreeFeeds; ?>">
													<?php echo $newsCount; ?> 
													новостей
												</a>
											<?php } ?>
											в этом разделе
									</p>
								</div>
								<div class="holder clearfix">
    				   			<?php 
    		           				echo $this->ShowNewsListPreviewByNewsTreeFeedsIdNova($this->filterNewsTreeFeeds, $this->newsViewType, $this->user_id, $this->nShowRows, $this->page_settings, $isOnlySubscribeNewsTree, $isOnlyFavoriteNews);
    		           				if ($this->shownow == "allnews"){
    			         				echo $this->news_tree_pager; 
    			       				}
    			       			?>								
								</div>
							</div>
							<!-- /section -->		
	       					<?php
	      						}
	           				}else{ // NO filter by news_tree_feeds_ID  	           
    	           				foreach ($aNewsTree as $newsTree){
    	               				if ($this->filterNewsTree){
    	                   				$aNewsTreeChildren = $this -> getNewsTreeChildren($this->filterNewsTree);
    	                   				if ($newsTree['id'] != $this->filterNewsTree && !$this -> isChild($aNewsTreeChildren, $newsTree['id'])) continue;
    	               				}
    	               				$newsCount = $this -> getNewsCountByNewsTreeId($newsTree['id'], $this->user_id, $isOnlySubscribeNewsTree, $isOnlyFavoriteNews);
    	               				if ($newsCount < 1) continue;
    	               				$isShowSomeNews = true;
    	               
    	   					?>
    	   					
	       					<div class="section">
    							<div class="title clearfix">
    					 			<h2><a href="#"><?php $tmp = $this->ShowNewsTreeBreadCrumbByNewsTreeId($newsTree['id'], false); echo substr($tmp,0,strpos($tmp,'»'));?></a></h2>  <!-- <?php if ($this->shownow  != "allnews"){ ?> (<a href="<?php echo $this->createUrl('News', 'News', null, false)."/shownow:allnews/filterNewsTree:".$newsTree['id']; ?>">все новости [<?php echo $newsCount; ?>]</a>)<?php } ?> -->
    					 			<p><!-- <a href="#">157 категорий</a> <span class="spr">|</span>--> <a href="<?php echo $this->createUrl('News', 'News', null, false)."/shownow:allnews/filterNewsTree:".$newsTree['id']; ?>"><?php echo $newsCount; ?> новостей</a> в этом разделе</p>
    							</div>
    							<div class="holder clearfix">    				
    				 	 			<?php
    		          					echo $this->ShowNewsListPreviewByNewsTreeIdNova($newsTree['id'], $this->newsViewType, $this->user_id, $this->nShowRows, $this->page_settings, $isOnlySubscribeNewsTree, $isOnlyFavoriteNews);
    		         	 				if ($this->shownow == "allnews"){
    			      	 					echo $this->news_tree_pager; 
    			      	 				}
    			      	 			?>
    							</div>
    						</div>    	   					
  
  <!--    	   					
							<div class="section">
								<div class="title clearfix">
									<h2><a href="#"><?php echo $this->ShowNewsTreeBreadCrumbByNewsTreeId($newsTree['id'], false); ?></a></h2>
									<p>
										<?php if ($this->shownow  != "allnews"){ ?> 
											<a href="<?php echo $this->createUrl('News', 'News', null, false)."/shownow:allnews/filterNewsTree:".$newsTree['id']; ?>">
												<?php echo $newsCount; ?> 
												новостей
											</a>
										<?php } ?>
										в этом разделе
									</p>
								</div>
								<div class="holder clearfix">
    				   			<?php 
    		           				echo $this->ShowNewsListPreviewByNewsTreeId($newsTree['id'], $this->newsViewType, $this->user_id, $this->nShowRows, $this->page_settings, $isOnlySubscribeNewsTree, $isOnlyFavoriteNews);
    		           				if ($this->shownow == "allnews"){
    			         				echo $this->news_tree_pager; 
    			       				}
    			       			?>								
									<ul class="short-view">
										<li></li>
									</ul>
									<div class="full-view">
										<h3><a href="#">Что же в имени твоем! 3.0D</a><i class="star-icon empty-star"></i></h3>
										<div class="breadcrumbs">
											▪ <a href="#">Последние посты</a> » <a href="#">РождествоM</a> » С рождеством!
										</div>
										<a href="#"><img src="assets/i/temp/temp.5.jpg" alt="Что же в имени твоем! 3.0D" /></a>
										<p>Если зайти сейчас на главный сайт компании — можно посмотреть веселый мультик на знакомую тему, так сказать, «пародию на ... </p>
										<div class="more"><a href="#">читать дальше</a> &rarr;</div>
									</div>
								</div>
							</div>	-->
							<!-- /section -->    	   					
    	   					<?php
    	           				}
	           				}
	           				if (!$isShowSomeNews){
	       					?>  
    	        			<!-- Нет новостей -->
    						<div>
    							<div>
    					   			<h2>
    					    			Нет новостей для отображения
    					   			</h2>
    							</div>
    						</div> 				
    						<div>
    				    		Вы не подписаны ни на одну ленту новостей, либо в лентах на которые вы подписаны нет новостей.<br />
                        		Вы можете выбрать ленты для подписки в меню «Категории» слева. После выбора лент нажмите «Сохранить подписку».  
    						</div>
    			<!-- / Нет новостей -->   	       					       					 
    	   					<?php             
	           				}
	      				}
		   				?>
						</div>
						<!-- /display-table -->		   					       					 	   					       					
					</div></div>
					<!-- /main -->
					<?php //if (!$this -> isShowOneNews){ // не одна новость ?> 
					<?php //if ($this->shownow != "allnews"){?>				
					<div class="sidebar">
						<div class="navigation">
							<div class="title">
								<h2>Блоги</h2>
								<i title="Показать фильтр" class="filter-link icon hide-filter-icon"></i>
							</div>
							<form class="filter" action="#" method="get">
								<ul>
									<li><select><option>Авто</option></select></li>
									<li><select><option>AUDI</option></select></li>
									<li><select><option>Выберете раздел</option></select></li>
									<li><select disabled="disabled"><option>Выберете раздел выше</option></select></li>
								</ul>
							</form>					
							<form action="<?php echo $this->createUrl('News', 'SubscribeNews', null, false); ?>" method="POST">
								<ul class="nav-list">
                        		<?php 
                        			$aLeafs = $this->getAllLeafs($this->news_tree_list);
                        			$this->BuildTree($aLeafs, $this->news_tree_list, 0, $this->aNewsSubscribe, $this->user_id); echo $this->_htmlTree; 
                        		?>
                    			</ul>
                    			<?php if ($this->user_id){ ?>
                   					<input type="submit" name="subscribe" value="Сохранить подписку" />
                    			<?php } ?>
                    		</form>
						</div>
					</div>
					<?php //} ?>
					<?php //} ?>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->		
<?php include($this -> _include('../footer.tpl.php')); ?>