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
							<div class="type-filter">
								отображать: <a href="<?php echo $this->createUrl('News', 'News', null, false); ?>/view:full/">списком</a> | <strong>сводкой</strong> <!--  <?php echo $this->createUrl('News', 'News', null, false); ?>/view:report/ -->
							</div>
						</div>
						<!-- /display-filter -->
						<div class="blog-table">					
							<?php 
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
//							$aNewsTree = $this -> getAllNewsTree(); 										
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
    					 				<h2><a href="#"><?php echo $this->ShowNewsTreeBreadCrumbByNewsTreeId($newsTree['id'], false);  if ($this->shownow  != "allnews"){ ?> (<a href="<?php echo $this->createUrl('News', 'News', null, false)."/shownow:allnews/filterNewsTree:".$newsTree['id']; ?>">все новости [<?php echo $newsCount; ?>]</a>)<?php } ?></a></h2>
    					 				<p><a href="#">157 категорий</a> <span class="spr">|</span> <a href="#"><?php echo $newsCount; ?> новостей</a> в этом разделе</p>
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
    	   					<?php } ?>						
						</div>
						<!-- /display-table -->
					</div></div>
					<!-- /main -->
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
							<?php if (!$this -> isShowOneNews){ // не одна новость ?> 
								<?php if ($this->shownow != "allnews"){?>
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
								<?php } ?>
								<?php if ($this->user_id){ ?>
									<h2>Управление</h2>
									<div>
						 				<a href="<?php echo $this->createUrl('News', 'AddFeed', null, false); ?>" >Добавить RSS-ленту</a><br />
						 				<a href="<?php echo $this->createUrl('News', 'AddNewsTree', null, false); ?>" >Добавить новую ветвь в дерево</a>
									</div>
								<?php } ?>								
							<?php } ?>
						</div>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->
<!-- /Главный блок, с вкладками (Контент) -->				
<?php include($this -> _include('../footer.tpl.php')); ?>