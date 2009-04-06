<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../profile_line.tpl.php')); ?>	


				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<?=$this -> flash_messages; ?>
						<h2 class="page-ttl"><?php echo $this -> submitValue; ?> RSS-ленту</h2>
						<form class="main-form" action="#" method="post" name="frmFeeds">
						<input type="hidden" name="frmAction" value="<?php echo $this -> frmAction; ?>">
							<fieldset>
								<ul class="clearfix">
									<li class="field-it">
										<div class="label"><label for="f1">Название RSS-ленты <em>*</em></label></div>
										<div class="field f-mid">
											<input type="text" id="f1" name="feed_name" value="<?php echo $this -> feed_name; ?>" />
											<span class="field-help">Будет отображаться в дереве лент</span>
										</div>
									</li>
									<li class="field-it">
										<div class="label"><label for="f2">URL RSS-ленты <em>*</em></label></div>
										<div class="field f-mid">
											<input type="text" id="f2" name="feed_url" value="<?php echo $this -> feed_url; ?>" />
											<span class="field-help">Полный URL вашей RSS-ленты</span>
										</div>
									</li>
									<? if ($this->is_partner) { ?>
									<li class="field-it">
										<div class="label"><label for="f2">Код баннера:</label></div>
										<div class="field f-mid">
											<textarea name="code" cols="45" rows="7"><?php echo $this -> code; ?></textarea>
											<span class="field-help">Можно будет заполнить позже или заменить</span>
										</div>
									</li>									
									<? } ?>									
									<li class="field-it">
										<div class="label"><label for="f3">Категория в ленте</label></div>
										<div class="field f-mid">
											<input type="text" id="f3" name="category_tag" value="<?php echo $this -> category_tag; ?>" />
										</div>
									</li>
									<li class="field-help"><div>Если лента экспортирует новости одной категории, либо вы не хотите сопоставлять категории – оставьте это поле пустым. Если лента экспортирует 
новости разных категорий, то вам нужно провести сопоставление всех категорий в ленте с категориями на сайте. Для этого напишите в этом поле 
символическое название категории, так, как оно пишется в ленте, например «Авто». Одну ленту можно добавлять несколько раз с разными 
значениями этого поля – тогда все категории будут сопоставлены. </div></li>
									<li class="field-it">
										<div class="label">Выберите категорию <em>*</em></div>
										<div class="field f-mid">
											<select><option>Выберите категорию</option></select>
										</div>
										<div class="field f-mid">
											<select><option>Выберите категорию 1</option></select>
										</div>
										<div class="field f-mid">
											<select><option>Выберите категорию 2</option></select>
										</div>
			    						<ul class="checkbox_tree">
                    						<?php 
                    							$aLeafs = $this->getAllLeafs($this->news_list);
                    							$this->BuildTree_radio($aLeafs, $this->news_list, 0, $this->news_tree_id, false); echo $this->_htmlTree; 
                    						?>
                						</ul>										
									</li>
									<?php if ($this->isChange && $this -> isAdmin){ ?>
									<li class="field-it">
										<div class="label">Способ преобразования текста: <em>*</em></div>
										<div class="field f-mid">
			    							<select name="text_parse_type">
        		    							<option value=0 <?php if ($this->text_parse_type == 0) echo 'selected'; ?>> striptags
        		    							<option value=1 <?php if ($this->text_parse_type == 1) echo 'selected'; ?>> htmlspecialchars
        		    							<option value=2 <?php if ($this->text_parse_type == 2) echo 'selected'; ?>> ничего не менять, для доверенных сайтов
        									</select>
										</div>
									</li>			
									<?php } ?>										
								</ul>
								<div class="button big-button">
									<input type="submit" value="<?php echo $this -> submitValue; ?>"> 
									<input type="reset" value="Сброс">
									<?php if ($this->isChange){ ?>
										<input type="submit" name="deleteRss" value="Delete">
									<?php } ?>									
								</div>
							</fieldset>
						</form>
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<div class="user-action">
							<ul>
								<li><a href="<?=$this->createUrl('News', 'MyFeeds', null, false)?>"><i class="icon rss-icon"></i>Мои RSS-ленты</a></li>
								<li><a href="<?=$this->createUrl('News', 'AddFeed', null, false)?>"><i class="icon rss-add-icon"></i>Добавить RSS-ленту</a></li>
								<li><a href="<?=$this->createUrl('News', 'AddNewsTree', null, false)?>"><i class="icon cat-add-icon"></i>Добавить Каталог</a></li>
								<li><a href="<?=$this->createUrl('News', 'ModerateFeeds', null, false)?>"><i class="icon rss-set-icon"></i>Настройка RSS-лент</a></li>
								<li><a href="<?=$this->createUrl('News', 'ModerateNewsTree', null, false)?>"><i class="icon cat-set-icon"></i>Настройка Каталога</a></li>
							</ul>
						</div>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>