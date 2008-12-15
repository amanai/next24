<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
		<!-- ПРОФИЛЬ -->
		<table width="100%" height="100%" cellpadding="0">
		<tr>
			<td class="next24u_left">
				<!-- левый блок -->
					<?php include($this -> _include('control_panel.tpl.php')); ?>
				<!-- /левый блок -->
			</td>
			<td class="next24u_right">
			<?=$this -> flash_messages; ?>
				<!-- правый блок -->
					<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
					
					   <?php
					   if ($this->pageAction == 'main'){
					   ?>
						<div class="block_title">
								<div class="block_title_left"><h2>Управление группами</h2></div>
								<div class="block_title_right">
									<img src="<?php echo $this -> image_url;?>/close.png" width="21" height="24" onclick="ShowOrHide(this, 'user_profile_js'); return false;" style="cursor: pointer;" />
								</div>
						</div>

						<div id="user_profile_js">
    						<div class="img_height5">
        						<img height="12" width="15" id="ico2" src="<?php echo $this->image_url; ?>folder.png"/> 
        						Общая
        						<?php echo $this->showFriendsInGroup($this->user_id, 0); ?>
    							  
        					<?php
        					foreach ($this->aFriendGroups as $friendGroup){
        					   echo'
        					   <img height="12" width="15" id="ico2" src="'.$this->image_url.'folder.png"/> 
        					   '.$friendGroup['name'].' <span class="personActions">
            					   <form class="editForm" name="e_form_'.$friendGroup['id'].'" method="post" action="'.Project::getRequest() -> createUrl('Messages', 'Friend').'">
            					   <input type="hidden" value="'.$friendGroup['id'].'" name="group_id" />
            					   <input type="hidden" value="changeGroup" name="messageAction" />
            					   <span id="micro">[ <a onclick="this.parentNode.parentNode.submit(); return false;" href="#">редактировать</a> ]</span>
            					   </form>
        					   </span>
        					   ';
        					   echo $this->showFriendsInGroup($this->user_id, $friendGroup['id']);
        					}
        					?>
        				    </div>
						</div>
						<br />
						<form method="post" action="<?php echo Project::getRequest() -> createUrl('Messages', 'Friend'); ?>">
						<input type="hidden" value="addGroupFriend" name="messageAction" />
						<table>
                    	<tbody><tr>
                    		<td width="190" valign="top">Добавить новую группу</td>
                    		<td><input type="text" style="width: 200px;" name="group_name"/></td>
                    		<td><input type="submit" name="add_group" value="Добавить"/></td>
                    	</tr>
                    	<tr>
                    		<td valign="top">Добавить пользователя в друзья</td>
                    		<td><input type="text" style="width: 200px;" name="friend_name"/></td>
                    		<td><input type="submit" name="add_friend" value="Добавить"/></td>
                    	</tr>
                    	</tbody></table>
                    	</form>
						
                       <?php
					   }elseif ($this->pageAction == 'changeGroup'){
					   ?>
					    <div class="block_title">
								<div class="block_title_left"><h2><a href="<?php echo Project::getRequest() -> createUrl('Messages', 'Friend'); ?>">Управление группами</a> » Редактирование группы <?php echo $this->groupName; ?></h2></div>
								<div class="block_title_right">
									<img src="<?php echo $this -> image_url;?>/close.png" width="21" height="24" onclick="ShowOrHide(this, 'user_profile_js'); return false;" style="cursor: pointer;" />
								</div>
						</div>

						<div id="user_profile_js">
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
						
						
						
						
					   <?php
					   }elseif ($this->pageAction == 'changeFriend'){
					   ?> 
					    <div class="block_title">
								<div class="block_title_left"><h2><a href="<?php echo Project::getRequest() -> createUrl('Messages', 'Friend'); ?>">Управление группами</a> » Редактирование друга  <?php echo $this->friend['friend_login']; ?></h2></div>
								<div class="block_title_right">
									<img src="<?php echo $this -> image_url;?>/close.png" width="21" height="24" onclick="ShowOrHide(this, 'user_profile_js'); return false;" style="cursor: pointer;" />
								</div>
						</div>

						<div id="user_profile_js">
    						<form method="post" action="<?php echo Project::getRequest() -> createUrl('Messages', 'Friend'); ?>">
    						<input type="hidden" value="<?php echo $this->friend['id']; ?>" name="friend_table_id" />
            				<input type="hidden" value="changeFriend" name="messageAction" />
           
                        	Заметка:  <input type="text" value="<?php echo $this->friend['note']; ?>" name="note" style="width: 200px;"/><br/><br/>
                        	Группа:  
                        		<select style="width: 200px;" name="group_id">
                        			<option selected value="0"> Общая
                        			<?php
                        			foreach ($this->aFriendGroups as $friendGroup){
                        			    $selected = ($this->friend['group_id'] == $friendGroup['id'])?"selected='1'":"";
                        			    echo '<option '.$selected.' value="'.$friendGroup['id'].'"> '.$friendGroup['name'];
                        			}
                        			?>
                        		
                        		</select>
                        	<div class="submBut">
                        		<input type="submit" class="button" value="Сохранить" name="save_friend"/>  
                        	</div>
                        	<input type="hidden" value="edit_friend" name="action"/>
                        	<input type="hidden" value="181" name="friendid"/>
                        	</form>
						</div>
					   
					   
					   
					   <?php
					   }
					   ?> 
					</div></div></div></div>
				<!-- /правый блок -->
			</td>
		</tr>
		</table>
		<!-- /ПРОФИЛЬ -->
	</div>

</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>