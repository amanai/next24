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
        <?php
        if (!$this->isAdded){ // news not added yet
        ?>
            <div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
        	<div class="block_title"><h2><?php echo $this -> submitValue; ?> ветвь дерева</h2></div>
        	</div></div></div></div>

    		<table width="10%" cellpadding="5">
    		<tr>
    			<td nowrap>Название категории<span class="red">*</span>:</td>
    			<td><input type="text" name="news_tree_name" value="<?php echo $this -> news_tree_name; ?>" /><br />
    			     <span id="micro2">Будет отображаться в дереве лент.</span>
    			</td>
    		</tr>
    		<tr>
    			<td nowrap>Выберите в какой категории она будет находиться <span class="red">*</span>:</td>
    			<td>
    			    <ul class="checkbox_tree">
    			     <li>
                        <img height="11" width="11" src="http://gek_next24.ru/app/images/1x1.gif" alt="" class="minus"/> 
                        <label><input type="radio" value="0" name="news_tree_id"/> Корневой раздел</label>
                        <ul class="checkbox_tree">
                        <?php 
                        $aLeafs = $this->getAllLeafs($this->news_list);
                        $this->BuildTree_radio($aLeafs, $this->news_list, 0, $this->news_tree_parent_id, true); echo $this->_htmlTree; 
                        ?>
                        </ul>
                     </li>
                    </ul>
    			</td>
    		</tr>
    		<tr>
    			<td colspan="2" align="right">&nbsp;</td>
    		</tr>
    		<tr>
    			<td colspan="2" align="right"><input type="submit" value="<?php echo $this -> submitValue; ?>"> <input type="reset" value="Сброс"></td>
    		</tr>
    		</table>
		
		<?php
        } // news not added yet
        ?>

	</div></div></div></div>
	<!-- /Загрузка изображений -->
	</form>
		
	</div>

</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>