			<!-- Главный блок, с вкладками (Контент) -->
			<div class="tab-page" id="modules-cpanel">
				<script type="text/javascript">var tabPane1 = new WebFXTabPane( document.getElementById( "modules-cpanel" ), 1 )</script>

				<div class="tab-page">
					<h2 class="tab">Блог</h2>
					<!-- ПРОФИЛЬ -->
					<table width="100%" height="100%" cellpadding="0">
					<tr>
						<tr>
							<td class="next24_right">
								<table width="100%" height="100%" cellpadding="0">
									<tr>
										<td class="next24u_left">
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
											<?php require('blog_control_panel.tpl.php'); ?>
				
									<!-- /левый блок -->
				
						
						</td>
						<td class="next24u_right">
							<!-- Создание нового раздела -->
							<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
									<div class="block_title" id="record_93">
										<div class="block_title_left"><h2><?php echo $this->post_info['title']; ?></h2></div>
										<div class="block_title_right"><?php echo date("j F Y", strtotime($this->post_info['creation_date']));?> | <span class="tags"><a href="#taglink" class="astable">_TAG_</a></span></div>
									</div>
									<div>
										<?php echo $this->post_info['full_text']; ?><br><br>
										
									</div>
									<br>
							</div></div></div></div>
							
							<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
								<?php include(VIEWS_PATH.'/base_comment.tpl.php'); ?>
							</div></div></div></div>
							<!-- /Создание нового альбома -->
						</td>
					</tr>
					</table>
					<!-- /ПРОФИЛЬ -->
				</div>

			</div>
			<!-- /Главный блок, с вкладками (Контент) -->