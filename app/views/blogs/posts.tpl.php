			<!-- ������� ����, � ��������� (�������) -->
			<div class="tab-page" id="modules-cpanel">
				<script type="text/javascript">var tabPane1 = new WebFXTabPane( document.getElementById( "modules-cpanel" ), 1 )</script>

				<div class="tab-page">
					<h2 class="tab">����</h2>
					<!-- ������� -->
					<table width="100%" height="100%" cellpadding="0">
					<tr>
						<tr>
							<td class="next24_right">
								<table width="100%" height="100%" cellpadding="0">
									<tr>
										<td class="next24u_left">
										<!-- ����� ���� -->
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
				
									<!-- /����� ���� -->
				
						
						</td>
						<td class="next24u_right">
							<!-- ������ ������ -->
							<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
								<?php foreach ($this->post_list as $key=>$item){?>
									<div class="block_title" id="record_93">
										<div class="block_title_left"><h2><?php echo $item['title']; ?></h2></div>
										<div class="block_title_right"><?php echo date("j F Y", strtotime($item['creation_date']));?> | <span class="tags"><a href="#taglink" class="astable">_TAG_</a></span></div>
									</div>
									<div>
										<?php echo $item['small_text']; ?><br><br>
										<div style="text-align: left;">
											<span><a href="<?php echo $this->router->createUrl('Blog', 'Comments', array('id'=>$item['id']));?>#comments">��������������</a></span>&nbsp;&nbsp;
											<span><a href="<?php echo $this->router->createUrl('Blog', 'Comments', array('id'=>$item['id']));?>">������ ����������� (<?php echo $item['comments_count'];?>)</a></span>&nbsp;&nbsp;
											<?php if ($item['owner'] === true) { ?>
												<span><a href="<?php echo $this->router->createUrl('Blog', 'PostEdit', array('id'=>$item['id']));?>">�������������</a></span>&nbsp;&nbsp;
												<span><a href="<?php echo $this->router->createUrl('Blog', 'PostDelete', array('id'=>$item['id']));?>" class="redlink">�������</a></span>
											<? } ?>
										</div>
									</div>
									<br>
							<?php }?>
	
		
</div></div></div></div>

							<!-- /������ ������ -->
							<!-- ������� -->
							<?php include(VIEWS_PATH.'pager.tpl.php'); ?>
							<!-- /������� -->
						</td>
					</tr>
					
					</table>
					<!-- /������� -->
				</div>

			</div>
			<!-- /������� ����, � ��������� (�������) -->