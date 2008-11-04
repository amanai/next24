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
                        $this->BuildTree($aLeafs, $this->news_list, 0); echo $this->_htmlTree; 
                        ?>
                    </ul>
                    <input type="submit" name="subscribe" value="Подписаться на новости" />
                    </form>
					

				</div></div></div></div>


				<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
					<div class="block_title"><h2>Вид отображения</h2></div>
					<div class="rss_cat">
						 <input type="checkbox" /> Полный список новостей<br />
						 <input type="checkbox" /> Сводка новостей
					</div>
				</div></div></div></div>

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
	           foreach ($this->aNewsSubscribe as $newsSubscribe){
	       ?>
			<!-- Категория -->
			<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
				<div class="block_title">
					<div class="block_title_left">
					   <h2>
					   <?php echo $this->ShowNewsTreeBreadCrumbByNewsTreeFeedsId($newsSubscribe['news_tree_feeds_id']); ?> (<a href="<?php echo $this->createUrl('News', 'News', null, false); ?>">все новости</a>)
					   </h2>
					</div>
					<div class="block_title_right"><img src="<?php echo $this -> image_url;?>close.png" align="left" width="21" height="24" onclick="ShowOrHide(this, 'rss_cat_n1')" style="cursor: pointer;" /></div>
				</div>
				
				<div id="rss_cat_n1">
				   <?php 
		           echo $this->ShowNewsListPreview($newsSubscribe['news_tree_feeds_id']);
			       ?>
					<div class="rmb14"></div>

				</div>

			</div></div></div></div>
			<!-- /Категория -->
		   <?php
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