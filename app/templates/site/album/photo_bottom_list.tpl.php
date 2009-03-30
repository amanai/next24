<?php foreach($this->photo_list as $key => $item){ ?>
	<li>
		<a href="<?php echo PhotoController::getPhotoUrl($item['id'], $item['login']);?>">
		<?php if ($item['thumbnail'] !== false){ ?>
			<img src="<?php echo $item['thumbnail']; ?>" id="iborder" alt="<?php echo $item['name']; ?> <?php echo date("j F Y", strtotime($item['creation_date']));?>"/></a>
		<?php } else { ?>
			<img src="<?php echo $this -> image_url; ?>noimage.gif" id="iborder"/></a>
		<?php } ?>
		</a>
	</li>
	<!-- 	
	<?php echo PhotoController::getPhotoUrl($item['id'], $item['login']);?>
	 -->
<? } ?>