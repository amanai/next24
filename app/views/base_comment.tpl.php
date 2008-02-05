<div class="block_ee1">
	<?php	foreach($this->userData['comment_list'] as $comment){?>
		
		<div class="block_title">
			<div class="block_title_left"><h2><a href="#"><?php echo $comment['first_name'];?></a></h2></div>
			<div class="block_title_right">
				<?php if ($comment['comment_owner'] || $this->userData['blog_owner']) { ?>
					<span class="dellink"> (<a href="<?php echo $this->router->createUrl($this->userData['delete_comment_controller'], $this->userData['delete_comment_action'], $comment['delete_comment_param']);?>" >Удалить комментарий</a>)</span>
				<?php } ?>
				<?php echo date("j F Y H:i", strtotime($comment['creation_date']));?></div>
		</div>
		<div class="block_d_ld1">
			<div class="block_d_ld2">
				<img src="<?php echo IMG_URL?>/x2.png" id="iborder" height="90" width="90">
			</div>
		</div>
		<div>
			<?php echo $comment['text'];?>									
		</div>
		<div class="rmb14"></div>
	<?php	}?>
	<?php include(VIEWS_PATH.'pager.tpl.php'); ?>
	<?php if ($this->userData['allow_add_comment']) { ?>
		<form action="<?php echo $this->router->createUrl($this->userData['add_comment_controller'], $this->userData['add_comment_action']);?>" method="post">
			<?php if($this->userData['add_comment_page_number'] > 0) { ?>
				<input type="hidden" name="pn" value="<?php echo $this->userData['add_comment_page_number'];?>" />
			<?php } ?>
			<input type="hidden" name="id" value="<?php echo $this->userData['add_comment_item_id'];?>" />
				<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
					<table width="100%">
						<tr>
							<td><h2>Оставить комментарий</h2></td>
						</tr>
			
						<tr>
							<td><textarea name="comment" style="width: 100%; height: 100px;"></textarea></td>
						</tr>
						<tr>
							<td align="right" style="padding-right: 5px;"><input type="submit" name="Submit" value="Комментировать"></td>
						</tr>
					</table>
					<a name="comments"></a>
				</div></div></div></div>
		</form>
	<?php } ?>
</div>
