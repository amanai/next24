<?php include($this -> _include('../header.tpl.php')); ?>
	<div class="list">
 	    <div style="float: left;"><h3>Категория</h3></div>	



<table class="dialog">
				<tr>
					<td class="h_left"><img src="<?=$this -> image_url?>1x1.gif" alt=""/></td>
					<td class="h_cen">
						<table>
							<tr>
								<td class="text">
									Добавление пользователя системы
								</td>
								<td>
									<div class="button bclose"><a href="#">X</a></div>
								</td>
							</tr>
						</table>
					</td>
					<td class="h_right"><img src="<?=$this -> image_url?>1x1.gif" alt=""/></td>
				</tr>
					<form action="<?=$this->createUrl('AdminQuestionAnswer', 'ManagedCat', array(Project::getRequest()->getKeyByNumber(0)))?>" method="POST">
				<tr>
					<td class="c_left">&nbsp;</td>
					<td class="c_cen" style="width: 100%;">
					
						<!-- САМ ДИАЛОГ -->
					
						<table cellspacing="0" cellpadding="0" border="0" >
							<tr>
								<td class="left_col">Название: &nbsp;&nbsp;</td>
								<td class="right_col" ><input type="text" class="field" name="name" value="<?=$this->cat['name']?>"></td>
							</tr>
							<tr>
								<td class="left_col">Вставитьт после: &nbsp;&nbsp;</td>
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
						
						<!-- -->

					</td>
					<td class="c_right">&nbsp;</td>
				</tr>
				<tr>
					<td class="b_left">&nbsp;</td>
					<td class="b_cen"><div class="b_delim">
						<input type="reset" value="Отмена">
						<input type="submit" name="save" value="Сохранить">
					</div></td>
					<td class="b_right">&nbsp;</td>
				</tr>
				</form>
			</table>
	</div>
<?php include($this -> _include('../footer.tpl.php')); ?>