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
				<!-- правый блок -->
					<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
						<div class="block_title">
								<div class="block_title_left"><h2>Управление группами</h2></div>
								<div class="block_title_right">
									<img src="<?php echo $this -> image_url;?>/close.png" width="21" height="24" onclick="ShowOrHide(this, 'user_profile_js'); return false;" style="cursor: pointer;" />
								</div>
						</div>

						<div id="user_profile_js">
    						<div class="img_height5">
        						<img height="12" width="15" id="ico2" src="<?php echo $this->image_url; ?>folder.png"/> 
        						Общая <span class="personActions"><form class="editForm" name="e_form_$friend->fr_id" method="post" action="/user/friends/editgroup/"><input type="hidden" value="178" name="groupid"/><span id="micro">[ <a onclick="this.parentNode.parentNode.submit(); return false;" href="#">редактировать</a> ]</span></form></span>
        						<?php echo $this->showFriendsInGroup($this->user_id, 0); ?>
    							  
        					<?php
        					foreach ($this->aFriendGroups as $friendGroup){
        					   echo'
        					   <img height="12" width="15" id="ico2" src="'.$this->image_url.'folder.png"/> 
        					   '.$friendGroup['name'].' <span class="personActions"><form class="editForm" name="e_form_$friend->fr_id" method="post" action="/user/friends/editgroup/"><input type="hidden" value="178" name="groupid"/><span id="micro">[ <a onclick="this.parentNode.parentNode.submit(); return false;" href="#">редактировать</a> ]</span></form></span>
        					   ';
        					   echo $this->showFriendsInGroup($this->user_id, $friendGroup['id']);
        					}
        					?>
        				    </div>
						</div>

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