<?php include($this -> _include('../header.tpl.php')); ?>

<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	
	<div class="tab-page tab-page-selected">
	
	<form name="frmFeeds" action="" method="POST" >
	<input type="hidden" name="frmAction" value="<?php echo $this -> frmAction; ?>">
	
	<!-- Загрузка изображений -->
	<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
        <?=$this -> flash_messages; ?>
        <table width="100%" height="100%" cellpadding="0">
	    <tr>
	       <td class="next24u_left">
	           <?php if ($this->user_id){ ?>
				<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
					<div class="block_title"><h2>Управление</h2></div>
					<div class="rss_cat">
						 <a href="<?php echo $this->createUrl('News', 'AddFeed', null, false); ?>" >Добавить RSS-ленту</a><br />
						 <a href="<?php echo $this->createUrl('News', 'AddNewsTree', null, false); ?>" >Добавить новую ветвь в дерево</a>
					</div>
				</div></div></div></div>
				<?php } ?>
	       </td>
	       
	       <td class="next24u_right">
                <div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
        		<div class="block_title"><h2>Управление деревом каталогов</h2></div>
        		</div></div></div></div>

        		<ul class="checkbox_tree">
                <?php 
                $aLeafs = $this->getAllLeafs($this->news_list);
                $this->BuildTree_moderate($aLeafs, $this->news_list, 0); echo $this->_htmlTree; 
                ?>
                </ul>
        		
            </td>
        </tr>
        </table>		
		

	</div></div></div></div>
	<!-- /Загрузка изображений -->
	</form>
		
	</div>

</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>