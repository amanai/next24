<?php include($this -> _include('../header.tpl.php')); ?>
				<div class="columns-page clearfix"> 
					<div class="main"><div class="wrap"> 
						<ul class="view-filter clearfix"> 
							<?php include($this -> _include('../tab_panel.tpl.php')); ?>
						</ul> 
						<!-- /view-filter --> 
						<div class="content-header alt-content-header"> 
							<h2>Предложить тему</h2> 
							<form action="<?=$this->createUrl('Article', 'SaveSubject')?>" method="post" class="article-form">
								<?=$this->message?> 
								<table> 
									<tr> 
										<td class="label-field"> 
											<label for="title">Тема:</label> 
										</td> 
										<td class="input-field" colspan="2"> 
											<input name="title" id="title" <?if($this->active == false) echo 'disabled="disabled"';?> type="text" value="" /> 
										</td> 
									</tr> 
									<tr> 
										<td class="label-field"> 
											<label for="parent_id">Категория:</label> 
										</td> 
										<td class="select-field"> 
											<select id="parent_id" name="parent_id" <?if($this->active == false) echo 'disabled="disabled"';?>>
												<option value="0" > Выбрать </option>
												<?foreach ($this->tree as $n):?>
													<option value="<?=$n['id']?>"><?=str_repeat("&nbsp;&nbsp;&nbsp;",  $n['level'] -1)?><?=$n['name']?></option>
												<?endforeach;?>
											</select>										
										</td> 
										<td class="button-field"><input type="submit" value="Предложить тему" /></td> 
									</tr> 
								</table> 
							</form> 
						</div> 
						<? if($this->competition_control == true) {
								include($this -> _include('list_start_competition.tpl.php'));
							} else {
								include($this -> _include('list_rate_competition.tpl.php'));	
						}?>							
					</div></div> 
					<!-- /main --> 
					<div class="sidebar"> 
						<? //if($this->competition_control == true) include($this -> _include('control_panel.tpl.php')); ?>
						<div class="navigation"> 
							<div class="title"> 
								<h2>Категории</h2> 
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
							<?php include($this -> _include('catalog_comp.tpl.php')); ?>
						</div> 
					</div> 
					<!-- /sidebar --> 
				</div> 
				<!-- /columns-page --> 
<?php include($this -> _include('../footer.tpl.php')); ?>
