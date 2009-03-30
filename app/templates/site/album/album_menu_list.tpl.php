<?php foreach($this -> album_menu_list as $key => $item){ ?>
	<?php if ($this -> album_id != $item['id']){ ?>
		<li>
			<i class="arrow-icon"></i>
			<?php if ($this -> album_owner) {?>
			<a href="<?php echo PhotoController::getAlbumEditUrl($item['id'], $item['login']);?>" class="with-icon-s" style="float:left;">
				<i class="icon-s write-s-icon"></i>
			</a>
			<?php }?>
			<a <?php if ($this -> album_owner) {echo 'style="margin-left: 17px;"';}?> href="<?php echo PhotoController::getAlbumUrl($item['id'], $item['login']);?>">	
				<?php echo $item['name'];?>
			</a>	
		</li>
	<?php } else { ?>
		<li class="active">
			<i class="arrow-icon"></i>
			<?php if ($this -> album_owner) {?>
			<a style="margin-bottom: 10px;" href="<?php echo PhotoController::getAlbumEditUrl($item['id'], $item['login']);?>" class="with-icon-s">
				<i class="icon-s write-s-icon"></i>
			</a>	
			<?php }?>
			<?php echo $item['name'];?>
		</li>	
	<? } ?>
<?php } ?>		