<div class="block_ee1"><div class="block_ee2">
	<div class="block_ee3">
		<div class="block_ee4">
			<div class="block_title"><h2>Фотоальбомы</h2></div>
				<?php foreach($this -> album_menu_list as $key => $item){ ?>
					<p>
						<?php if ($this -> album_id != $item['id']){ ?><a href="<?php echo PhotoController::getAlbumUrl($item['id'], $item['login']);?>"><?php } ?><img src="<?php echo $this -> image_url;?>/folder.png" width="15" height="12" id="ico2" /><?php echo $item['name'];?><?php if ($this->album_id != $item['id']){ ?></a><?php } ?>
						<?php if ($this -> album_owner) {?>
							<a href="<?php echo PhotoController::getAlbumEditUrl($item['id'], $item['login']);?>"><img src="<?php echo $this -> image_url; ?>edit.gif" alt="Редактировать альбом" class="editbtn" height="12" width="11"></a>
						<?php }?>
					</p>
				<?php } ?>
			</div>
		</div>
	</div>
</div>