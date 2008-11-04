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
					
					<?php include($this -> _include('news_tree.tpl.php')); ?>

					

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



			<!-- Категория -->
			<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
				<div class="block_title">
					<div class="block_title_left">
					   <h2>
					       <?php 
					       if ($this -> isShowOneNews){
					           echo $this->news['news_title'];
					       }else{
					           echo $this->ShowNewsTreeBreadCrumb($this->aNewsTreeBreadCrumb); ?> (<a href="<?php echo $this->createUrl('News', 'News', null, false); ?>">все новости</a>)
					       <?php
					       }
					       ?>
					   </h2>
					</div>
					<div class="block_title_right"><img src="<?php echo $this -> image_url;?>close.png" align="left" width="21" height="24" onclick="ShowOrHide(this, 'rss_cat_n1')" style="cursor: pointer;" /></div>
				</div>
				
				<div id="rss_cat_n1">
				    <?php 
			       if ($this -> isShowOneNews){
			           if (strpos($this->news['enclosure_type'], "image") !== false){
			               echo '<img src="'.$this->news['enclosure'].'">';
			           }
			           echo $this->news['news_full_text'];
			           if ($this->news['code']){
			               echo "<hr>".$this->news['code'];
			           }
			       }else{
			           echo $this->ShowNewsListPreview();
			       }
			       ?>
					<div class="rmb14"></div>

				</div>

			</div></div></div></div>
			<!-- /Категория -->

		</td>
	</tr>
	</table>
		
	</div>

</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>