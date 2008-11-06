<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	
	<div class="tab-page tab-page-selected">
	
	<form name="frmFeeds" action="" method="POST" onsubmit="return validateAddRss(this);">
	<input type="hidden" name="frmAction" value="<?php echo $this -> frmAction; ?>">
	
	<!-- Загрузка изображений -->
	<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">

		<h1><?php echo $this -> submitValue; ?> RSS-ленту</h1>
		<br /><br />
		<table width="10%" cellpadding="5">
		<tr>
			<td nowrap>Название RSS-ленты <span class="red">*</span>:</td>
			<td><input type="text" name="feed_name" value="<?php echo $this -> feed_name; ?>" /><br />
			     <span id="micro2">Будет отображаться в дереве лент.</span>
			</td>
		</tr>
		<tr>
			<td nowrap>URL RSS-ленты  <span class="red">*</span>:</td>
			<td><input type="text" name="feed_url" value="<?php echo $this -> feed_url; ?>" /><br />
			     <span id="micro2">Полный URL вашей RSS-ленты.</span>
			</td>
		</tr>
		<tr>
			<td nowrap>Код баннера:</td>
			<td><textarea name="code" cols="45" rows="7"><?php echo $this -> code; ?></textarea><br />
			     <span id="micro2">Можно будет заполнить позже или заменить.</span>
			</td>
		</tr>
		<tr>
			<td nowrap>Категория в ленте:</td>
			<td><input type="text" name="category_tag" value="<?php echo $this -> category_tag; ?>" /><br />
			     <span id="micro2">Если лента экспортирует новости одной категории, либо вы не хотите сопоставлять категории – оставьте это поле пустым.
                        Если лента экспортирует новости разных категорий, то вам нужно провести сопоставление всех категорий в ленте с категориями на сайте. Для этого напишите в этом поле символическое название категории, так, как оно пишется в ленте, например «Авто». Одну ленту можно добавлять несколько раз с разными значениями этого поля – тогда все категории будут сопоставлены.
                </span>
			</td>
		</tr>
		<tr>
			<td nowrap>Выберите категорию <span class="red">*</span>:</td>
			<td>
			    <ul class="checkbox_tree">
                    <?php 
                    $aLeafs = $this->getAllLeafs($this->news_list);
                    $this->BuildTree_radio($aLeafs, $this->news_list, 0, $this->news_tree_id); echo $this->_htmlTree; 
                    ?>
                </ul>
			</td>
		</tr>
		<?php if ($this->isChange && $this -> isAdmin){ ?>
		<tr>
			<td nowrap>Способ преобразования текста:</td>
			<td>
			    <select name="text_parse_type">
        		    <option value=0 <?php if ($this->text_parse_type == 0) echo 'selected'; ?>> striptags
        		    <option value=1 <?php if ($this->text_parse_type == 1) echo 'selected'; ?>> htmlspecialchars
        		    <option value=2 <?php if ($this->text_parse_type == 2) echo 'selected'; ?>> ничего не менять, для доверенных сайтов
        		</select>
			</td>
		</tr>
		<?php } ?>	
		<tr>
			<td colspan="2" align="right">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" value="<?php echo $this -> submitValue; ?>"> <input type="reset" value="Сброс"> <?php if ($this->isChange){ ?><input type="submit" name="deleteRss" value="Delete"><?php } ?></td>
		</tr>
		</table>

	</div></div></div></div>
	<!-- /Загрузка изображений -->
	</form>
		
	</div>

</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>