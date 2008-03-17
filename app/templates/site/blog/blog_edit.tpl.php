<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
		<!-- Блог::редактирование поста -->
		<table width="100%" height="100%" cellpadding="0">
		<tr>
			<td class="next24u_left">
				<!-- левый блок -->
					<!-- левый блок -->
							<div class="block_ee1"><div class="block_ee2">
								<div class="block_ee3">
									<div class="block_ee4">
										<div class="block_title"><h2><? echo $this->blog_info['title'];  ?></h2></div>
											<?php require('blog_left_tree.tpl.php'); ?>
										</div>
									</div>
								</div>
							</div>
							<?php echo $this -> control_panel; ?>
					<!-- /левый блок -->
				<!-- /левый блок -->
			</td>
			<td class="next24u_right">
					<div class="info" id="flash_message"><?php echo $this -> flash_messages; ?></div>
					<!-- Создание/редактирование поста -->
					<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
					<?php require('form_blog.tpl.php'); ?>
					</div></div></div></div>
					<!-- /Создание/редактирование поста -->
					
				</td>
			</tr>
			</table>
			<!-- /Блог::редактирование поста -->
		</div>
	</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>