<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
		<!-- ПРОФИЛЬ -->
		<table width="100%" height="100%" cellpadding="0">
		<tr>
			<td>
				<!-- правый блок -->
					<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
						<div class="block_title">
								<div class="block_title_left"><h2>Переписка между пользователями <?php echo $this->user_login." и ".$this->correspondent_user_login ?></h2></div>
								<div class="block_title_right">
									<img src="<?php echo $this -> image_url;?>/close.png" width="21" height="24" onclick="ShowOrHide(this, 'user_profile_js'); return false;" style="cursor: pointer;" />
								</div>
						</div>

						<div id="user_profile_js">
						<div class="cmod_messages">
							<?php
							$i = 1;
							foreach ($this->aMessages as $message){
							    if ($i/2 == 1){$i = 1;} else {$i++;}
							    echo '
							    <div class="cmod_tab'.$i.'">
        							<h3>'.$message['author_id'].'</h3>,  <h3>'.$message['header'].'</h3>,  '.$message['send_date'].'  <a onclick="return DelMessage(112);" href="#">удалить</a>
        							<p>
        								'.$message['m_text'].'
        							</p>
        						</div>';
							}
							?>
						</div>
						</div>

					</div></div></div></div>
					<div id="myMessagePager"></div>
				<!-- /правый блок -->
			</td>
		</tr>
		</table>
		<!-- /ПРОФИЛЬ -->
	</div>

</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>