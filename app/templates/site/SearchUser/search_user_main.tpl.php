<?php include($this -> _include('../header.tpl.php')); ?>
<?php $request = Project::getRequest(); ?>
<!-- TEMPLATE: "Найти знакомых" - основная вкладка -->
				<div class="friends-page">
					<ul class="view-filter clearfix">
						<?php include($this -> _include('../tab_panel.tpl.php')); ?>
					</ul>
					<!-- /view-filter -->
					<form class="find-friends" name="frm_search" method="post" action="<?=$this->createUrl('SearchUser', 'SearchUserMain');?>">
						<fieldset>
							<ul>
								<li>
									<span class="field">
										<label for="f1" class="label">Я ищу</label>
										<select id="f1" name="select_search_sex">
                 							<option value="0" <? if ($this->p_search_sex == 0) echo 'selected="selected"';?>>девушку</option>
                 							<option value="1" <? if ($this->p_search_sex == 1) echo 'selected="selected"';?>>парня</option>
                 							<option value="2" <? if ($this->p_search_sex == 2) echo 'selected="selected"';?>>парня или девушку</option>
										</select>
									</span>
									<span class="field">
										<span class="label">В возрасте</span> 
										<label for="f2" class="sub-label">от</label>
										<input type="text" id="f2" size="2" name="inp_search_age_from" value="<?=$this->p_search_age_from;?>" /> 
										<label for="f3" class="sub-label">до</label>
										<input type="text" id="f3" size="2" name="inp_search_age_to" value="<?=$this->p_search_age_to;?>" />
									</span>
								</li>
								<li>
									<span class="field">
										<label for="f4" class="label">Страна</label>
										<select id="f4" name="select_search_counrty">
             								<option value="0">не важно</option>
           									<? foreach($this->list_country as $key=>$val) { ?>
             									<option value="<?=$val['id'];?>" <? if ($this->p_search_counrty == $val['id']) echo 'selected="selected"';?>><?=$val['name'];?></option>
           									<? } ?>
										</select>
									</span>
									<span class="field">
										<label for="f5" class="label">Город</label>
										<select id="f5">
											<option>Россия</option>
											<option>Россия</option>
										</select>
									</span>
								</li>
								<li>
									<span class="field">
										<label for="f6" class="label">Имя на сайте</label>
										<input type="text" id="f6" size="60" name="inp_search_login" value="<?=$this->p_search_login;?>" /> 
									</span>
									<span class="field">
										<label for="f7" class="label">C фото</label>
										<input type="checkbox" id="f7" name="chk_search_with_photo" <? if ($this->p_search_with_photo == true) echo 'checked="checked"';?> />
									</span>
								</li>
								<li>
									<input type="submit" value="Найти" name="btn_search" />
								</li>
							</ul>
						</fieldset>
						<input type="hidden" name="inp_hide" value="find">
					</form>
					<!-- /find-friends -->
  					<!-- Выдача результата поиска -->
						<?php include($this -> _include('list_users.tpl.php')); ?>
  					<!-- /Выдача результата поиска -->					
					<!-- /user-blog-view -->
					  <!-- Pager - страничная листалка -->  
    					<?=$this->search_user_list_pager; ?>
  					<!-- /Pager - страничная листалка -->  
				</div>
				<!-- /friends-page -->
<?php include($this -> _include('../footer.tpl.php')); ?>