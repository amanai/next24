<?php 
foreach($this->comment_list as $key => $item){ 
?>
	<div class="block_ee1"><div class="block_ee2"><div class="block_ee3">
				<div class="block_ee4" style="width: 100%;">
					<div class="block_title">
						<div class="block_title_left">
							<h2><a href="<?php echo UserController::getProfileUrl($item['login']);?>"><?php echo $item['login'];?></a></h2>
						</div>
						<div class="block_title_right">
							<?php if ($item['del_link'] !== false) { ?>
								<span class="dellink"> (<a href="<?php echo $item['del_link'];?>" >Удалить комментарий</a>)</span>
							<?php } ?>
							<?php echo date("j F Y H:i", strtotime($item['creation_date']));?>
						</div>
					</div>
					<div class="av_preview av_gallery right5">
					<?php 
					if ($item['avatar_id'] && $item['base_avatar_id']){
					   $avatar_path = ($item['sys_av_id'])?$item['sys_av_path']:$item['avatar_path']; 
					?>
					   <img style="margin: 5px;" alt="<?php echo $item['avatar_name'];?>" src="<?php echo $this->image_url."avatar/".$avatar_path; ?>"/>
					<?php
					}
					?>
					</div>
					<div class="comment_text">
					<?php 
					echo $this->parseCommentText($item['text']);
					//echo nl2br($item['text']);
					?>
					
					<?php 
					if ($item['mood'] && $item['mood_name']){
					?>
					<br/><hr class="hr_comment"  align="left" />
					<div class="micro3"><?php echo $item['mood_name']; ?></div>
					<?php } ?>
					</div>
				</div>
				<div class="rmb14">
				</div>
	</div></div></div>
<?php
}
?>
<? echo $this -> comment_list_pager;?>
