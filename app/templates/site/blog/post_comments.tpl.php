<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
		<!-- Блог::список комментариев поста -->
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
					<!-- Создание нового раздела -->
					<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
							<div class="block_title" id="record_93">
								<div class="block_title_left"><h2><?php echo $this->post_title; ?></h2></div>
								<div class="block_title_right"><?php echo date("j F Y", strtotime($this->post_creation_date));?> | <span class="tags"><a href="#taglink" class="astable"><?php echo $this->post_tag; ?></a></span></div>
							</div>
							<div>
							
            					<?php 
            					if ($this->user_avatar){
            					   $user_avatar = $this->user_avatar;
            					   $avatar_path = ($user_avatar['sys_av_id'])?$user_avatar['sys_av_path']:$user_avatar['path']; 
            					?>
            					   <div class="av_preview av_gallery right5">
            					   <img style="margin: 5px;" alt="<?php echo $user_avatar['av_name'];?>" src="<?php echo $this->image_url."avatar/".$avatar_path; ?>"/>
            					   </div>
            					<?php
            					}
            					?>            					
								<?php echo $this->full_text; ?><br>
								<?php if($this->post_mood) echo '<hr align="left" class="hr_comment"/><div class="micro3">'.$this->post_mood.'</div>'; ?>
							</div>
							<br>
							
					</div></div></div></div>
					<div style="clear: both;">
						<?php echo $this->blog_banner_code; ?><hr/>
					</div>

					<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
					<a name="comments"></a>
						<?php echo $this -> comment_list; ?>
					</div></div></div></div>
					
				</td>
			</tr>
			</table>
			<!-- /Блог::список комментариев поста -->
		</div>
	</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>