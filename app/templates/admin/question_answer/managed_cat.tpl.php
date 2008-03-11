<?php include($this -> _include('../header.tpl.php')); ?>
	<div class="list">
			<table class="dialog">
				<tr>
					<td class="h_left"><img src="<?=$this -> image_url?>1x1.gif" alt=""/></td>
					<td class="h_cen">
						<table>
							<tr>
								<td class="text">
									<?=$this->action_name?>
								</td>
								<td>
									<div class="button bclose"><a href="<?=$this->createUrl('AdminQuestionAnswer','CatList')?>">X</a></div>
								</td>
							</tr>
						</table>
					</td>
					<td class="h_right"><img src="<?=$this -> image_url?>1x1.gif" alt=""/></td>
				</tr>
				<tr>
					<td class="c_left">&nbsp;</td>
					<td class="c_cen">
					
						<!-- САМ ДИАЛОГ -->
						<form id="form_managed" action="<?=$this->createUrl('AdminQuestionAnswer', 'ManagedCat', array(Project::getRequest()->getKeyByNumber(0), 1))?>" method="POST">
						<table cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td class="left_col">
								Название: &nbsp;&nbsp;
								</td>
								<td class="right_col" style="width: 100%;">
								<input type="text" class="field" name="name" value="<?=$this->cat['name']?>">
								</td>
							</tr>
							<tr>
								<td class="left_col">
								Вставить после:</td>
								<td class="right_col">
								<select name="after_item">
												<option value="0">--Наверх--</option>
								        	<?foreach ($this->cat_list as $cat):?>
								        		<option value="<?=$cat['sortfield']?>"><?=$cat['name']?></option>
								        	<?endforeach;?>
							        </select>
								</td>
							</tr>
						</table>
						</form>
						<!-- -->

					</td>
					<td class="c_right">&nbsp;</td>
				</tr>
				<tr>
					<td class="b_left">&nbsp;</td>
					<td class="b_cen"><div class="b_delim">
						<div class="button bbig" style="float: right;"><a href="#">Отмена</a></div>
						<div class="button bbig" style="float: right;"><a href="#" name="submit" onclick='document.getElementById("form_managed").submit();'>Сохранить</a></div>
					</div></td>
					<td class="b_right">&nbsp;</td>
				</tr>
			</table>
	</div>
<?php include($this -> _include('../footer.tpl.php')); ?>