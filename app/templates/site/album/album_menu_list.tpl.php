<?php foreach($this -> album_menu_list as $key => $item){ ?>
	<?php if ($this -> album_id != $item['id']){ ?>
		<li>
			<i class="arrow-icon"></i>
			<?php if ($this -> album_owner) {?>
			<a href="<?php echo PhotoController::getAlbumEditUrl($item['id'], $item['login']);?>" class="with-icon-s" style="float:left;">
				<i class="icon-s write-s-icon"></i>
			</a>
			<?php }?>
			<a style="margin-left: 17px;" href="<?php echo PhotoController::getAlbumUrl($item['id'], $item['login']);?>">	
				<?php echo $item['name'];?>
			</a>	
		</li>
	<?php } else { ?>
		<li class="active">
			<i class="arrow-icon"></i>
			<?php if ($this -> album_owner) {?>
			<a href="<?php echo PhotoController::getAlbumEditUrl($item['id'], $item['login']);?>" class="with-icon-s">
				<i class="icon-s write-s-icon"></i>
			</a>	
			<?php }?>
			<?php echo $item['name'];?>
		</li>	
	<? } ?>
<?php } ?>								
		
		
<!-- 		

	<li class="active"><i class="arrow-icon"></i><a href="#" class="with-icon-s"><i class="icon-s write-s-icon"></i>Альбом 1</a></li>
	<li><i class="arrow-icon"></i><a href="#" class="with-icon-s"><i class="icon-s write-s-icon"></i>Альбом 2</a></li>
	<li><i class="arrow-icon"></i><a href="#" class="with-icon-s"><i class="icon-s write-s-icon"></i>Альбом 3</a></li>
	<li><i class="arrow-icon"></i><a href="#" class="with-icon-s"><i class="icon-s write-s-icon"></i>Альбом 4</a></li>
	
							
				<?php foreach($this -> album_menu_list as $key => $item){ ?>
					<li><i class="arrow-icon"></i>
						<?php if ($this -> album_id != $item['id']){ ?>
							<a href="<?php echo PhotoController::getAlbumUrl($item['id'], $item['login']);?>">
						<?php } ?>
						<?php echo $item['name'];?>
						<?php if ($this->album_id != $item['id']){ ?>
							</a>
						<?php } ?>
						<?php if ($this -> album_owner) {?>
							<br /><a style="font-size: 75%; color: gray;" href="<?php echo PhotoController::getAlbumEditUrl($item['id'], $item['login']);?>">[ редактировать ]</a>
						<?php }?>
					</li>
				<?php } ?>	
-->				