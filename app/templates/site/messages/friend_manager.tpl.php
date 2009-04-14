<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../profile_line.tpl.php')); ?>
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
					<?=$this -> flash_messages; ?>
						<?php if ($this->pageAction == 'main'){ ?>
							<h2 class="page-ttl">Управление группами</h2>
							<form class="groups-control clearfix" action="<?php echo Project::getRequest() -> createUrl('Messages', 'Friend'); ?>" method="post">
								<fieldset class="add-group"><div>
									<label for="f1">Добавить новую группу</label>
									<table><tr>
										<td class="input-field">
											<input type="text" id="f1" name="group_name" value="" />
										</td>
										<td class="button-field">
											<input type="submit" name="add_group" value="Добавить" />
										</td>
									</tr></table>
								</div></fieldset>
								<fieldset class="add-user"><div>
									<label for="f2">Добавить пользователя в друзья</label>
									<table><tr>
										<td class="input-field">
											<input type="text" id="f2" name="friend_name" value="" />
										</td>
										<td class="button-field">
											<input type="submit" name="add_friend" value="Добавить" />
										</td>
									</tr></table>
								</div></fieldset>
							</form>						
							<!-- /groups-control -->						
							<dl class="groups-list">
								<dt><i class="icon folder-b-icon"></i><a href="#" class="frind-list-dropdown">Общая</a> (<?=$this->getCountFriendInGroups($this->user_id, 0)?>)</dt>
								<?=$this->showFriendsInGroup($this->user_id, 0); ?>
							</dl>						
							<?php foreach ($this->aFriendGroups as $friendGroup){ ?>					   			   
								<dl class="groups-list">
									<dt>
										<i class="icon folder-b-icon"></i>
										<a href="#" class="frind-list-dropdown"><?=$friendGroup['name'] ?></a> (<?=$this->getCountFriendInGroups($this->user_id, $friendGroup['id'])?>)
										<?php echo '<form class="editForm" name="e_form_'.$friendGroup['id'].'" method="post" action="'.Project::getRequest() -> createUrl('Messages', 'Friend').'">
            					   			<input type="hidden" value="'.$friendGroup['id'].'" name="group_id" />
            					   			<input type="hidden" value="changeGroup" name="messageAction" />
            					   			<a onclick="this.parentNode.submit(); return false;" href="#">редактировать</a>
            					  		</form>'; ?>
									</dt>
									<?=$this->showFriendsInGroup($this->user_id, $friendGroup['id']); ?>				   					
								</dl>					   
							<? } ?>					
                       <? }elseif ($this->pageAction == 'changeGroup'){ ?>
					    <div>
							<h2><a href="<?php echo Project::getRequest() -> createUrl('Messages', 'Friend'); ?>">Управление группами</a> » Редактирование группы <?php echo $this->groupName; ?></h2>
						</div>
						<div>
    						<form method="post" action="<?php echo Project::getRequest() -> createUrl('Messages', 'Friend'); ?>">
    						<input type="hidden" value="<?php echo $this->group_id; ?>" name="group_id" />
            				<input type="hidden" value="changeGroup" name="messageAction" />
                        	Имя:  <input type="text" value="<?php echo $this->groupName; ?>" name="group_name" style="width: 200px;"/> 
                        		<input type="submit" value="Сохранить" name="save_group"/> 
                        		<input type="submit" value="Удалить" onclick="return confirm('После удаления группы все пользователи из нее\nбудут перемещены в группу Общая.\nВы уверены?');" name="del_group"/>
                        	<input type="hidden" value="edit_group" name="action"/>
                        	<input type="hidden" value="178" name="groupid"/>
                        	</form>
						</div>				
					   <? }elseif ($this->pageAction == 'changeFriend'){ ?> 
					    <div>
							<h2><a href="<?php echo Project::getRequest() -> createUrl('Messages', 'Friend'); ?>">Управление группами</a> » Редактирование друга  <?php echo $this->friend['friend_login']; ?></h2>
						</div>
						<div>
    						<form method="post" action="<?php echo Project::getRequest() -> createUrl('Messages', 'Friend'); ?>">
    						<input type="hidden" value="<?php echo $this->friend['id']; ?>" name="friend_table_id" />
            				<input type="hidden" value="changeFriend" name="messageAction" />          
                        	Заметка:  <input type="text" value="<?php echo $this->friend['note']; ?>" name="note" style="width: 200px;"/><br/><br/>
                        	Группа:  
                        		<select style="width: 200px;" name="group_id">
                        			<option selected value="0"> Общая
                        			<?php foreach ($this->aFriendGroups as $friendGroup){
                        			    $selected = ($this->friend['group_id'] == $friendGroup['id'])?"selected='1'":"";
                        			    echo '<option '.$selected.' value="'.$friendGroup['id'].'"> '.$friendGroup['name'];
                        			} ?>                       		
                        		</select>
                        	<div class="submBut">
                        		<input type="submit" class="button" value="Сохранить" name="save_friend"/>  
                        	</div>
                        	<input type="hidden" value="edit_friend" name="action"/>
                        	<input type="hidden" value="181" name="friendid"/>
                        	</form>
						</div>					   					   					   
					   <? } ?> 					   					
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<?php include($this -> _include('control_panel.tpl.php')); ?>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>