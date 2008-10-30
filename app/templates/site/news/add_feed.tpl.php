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
					<div class="block_title"><h2>Выберите раздел</h2></div>
					
					<ul class="checkbox_tree">
                        <?php 
                        $aLeafs = $this->getAllLeafs($this->news_list);
                        $this->BuildTree_radio($aLeafs, $this->news_list, 0); echo $this->_htmlTree; 
                        ?>
                    </ul>

					

				</div></div></div></div>


				

			<!-- /левый блок -->

		</td>
		<td class="next24u_right">



			<!-- Категория -->
			<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
			
			    <div class="block_title">
					<div class="block_title_left"><h2>Введите название RSS ленты</h2></div>
				</div>
				<div id="rss_cat_n1">
				<input type="text" name="feed_name" />
				</div>
				
				<div class="block_title">
					<div class="block_title_left"><h2>Введите URL RSS ленты</h2></div>
				</div>
				<div id="rss_cat_n1">
				<input type="text" name="feed_url" />
				</div>
				
				<div class="block_title">
					<div class="block_title_left"><h2>Если в ленте нужно использовать только конкретную категорию, можно ввести ее имя</h2></div>
				</div>
				<div id="rss_cat_n1">
				<input type="text" name="category_tag" />
				</div>				
				
				<div class="block_title">
					<div class="block_title_left"><h2>Код баннера</h2></div>
				</div>
				<div id="rss_cat_n1">
				<textarea name="code" cols="45" rows="7"></textarea>
				</div>		
				
				<div class="block_title">
					<div class="block_title_left"><input type="submit" value="Добавить"></div>
				</div>

			</div></div></div></div>
			<!-- /Категория -->

		</td>
	</tr>
	</table>
	</form>
		
	</div>

</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>