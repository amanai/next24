<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
		<!-- Блог::список постов -->
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
				<!-- Список постов -->
							<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
								<?php if (is_array($this->post_list)){?>
									<?php foreach ($this->post_list as $key=>$item){?>
										<div class="block_title" id="record_93">
											<div class="block_title_left"><h2><?php echo $item['title']; ?></h2></div>
											<div class="block_title_right">
											<?php if ($item['edit_link']) {echo '<a href="'.$item['edit_link'] . '">Редактировать</a> | ';}?>
											<?php if ($item['del_link']) {echo '<a href="'.$item['del_link'] . '">Удалить</a> | ';}?>
											<?php echo date("j F Y", strtotime($item['creation_date']));?> | <span class="tags"><a href="#taglink" class="astable"><?php echo $item['tag_name']; ?></a></span></div>
										</div>
										<div>
											<?php echo $item['small_text']; ?><br><br>
											<div style="text-align: left;">
												<span><a href="<?php echo $item['comment_link'];?>">читать полностью</a></span>&nbsp;&nbsp;
												<span><a href="<?php echo $item['comment_link'];?>#comments">читать комментарии (<?php echo $item['comments_count'];?>)</a></span>&nbsp;&nbsp;
												<?php if ($item['owner'] === true) { ?>
													<span><a href="<?php echo $this->createUrl('Blog', 'PostEdit', array($item['id']));?>">редактировать</a></span>&nbsp;&nbsp;
													<span><a href="<?php echo $this->createUrl('Blog', 'PostDelete', array($item['id']));?>" class="redlink">удалить</a></span>
												<? } ?>
											</div>
										</div>
										<br>
									<?php }?>
								<?php }?>
	
		
</div></div></div></div>

							<!-- /Список постов -->
							<!-- Листинг -->
							<?php echo $this -> post_list_pager;?>
							<!-- /Листинг -->
			</td>
		</tr>
		</table>
		<!-- /Блог::список постов -->
	</div>

</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>