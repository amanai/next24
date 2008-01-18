<div class="block_ee1">
	<?php foreach($this->userData['comment_list'] as $comment){?>
		
		<div class="block_title">
			<div class="block_title_left"><h2><a href="#"><?php echo $comment['first_name'];?></a></h2></div>
			<div class="block_title_right"><?php echo $comment['creation_date'];?></div>
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
	<?php } ?>
</div>
